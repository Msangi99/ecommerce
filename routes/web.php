<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use Livewire\Volt\Volt;

Route::view('/', 'welcome')->name('welcome');
Route::get('/product/{product}', [App\Http\Controllers\PublicProductController::class, 'show'])->name('product.show');
Route::get('/category/{category}', [App\Http\Controllers\PublicCategoryController::class, 'show'])->name('category.show');

Route::get('dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified', 'active'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Volt::route('register/dealer', 'pages.auth.dealer-register')->name('dealer.register');
    Route::get('register/dealer/pending', [App\Http\Controllers\DealerRegisterController::class, 'pending'])->name('dealer.pending');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        $totalCustomers = \App\Models\User::where('role', 'customer')->count();
        $totalOrders = \App\Models\Order::count();
        $totalProducts = \App\Models\Product::count();
        $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('totalCustomers', 'totalOrders', 'totalProducts', 'recentOrders'));
    })->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    
    // Dealers Management
    Route::get('dealers', [App\Http\Controllers\Admin\DealerController::class, 'index'])->name('dealers.index');
    Route::get('dealers/{user}', [App\Http\Controllers\Admin\DealerController::class, 'show'])->name('dealers.show');
    Route::patch('dealers/{user}/approve', [App\Http\Controllers\Admin\DealerController::class, 'approve'])->name('dealers.approve');
    Route::patch('dealers/{user}/reject', [App\Http\Controllers\Admin\DealerController::class, 'reject'])->name('dealers.reject');

    // Orders
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);

    // Customers
    Route::get('customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');

    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Reports
    Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');

    // System Helpers (for cPanel/Shared Hosting)
    Route::get('system/storage-link', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        try {
            // Check if link already exists
            if (file_exists(public_path('storage'))) {
                return 'Storage link already exists. <a href="/admin/dashboard">Back</a>';
            }
            
            // Create symlink
            app('files')->link(storage_path('app/public'), public_path('storage'));
            return 'Storage link created successfully. <a href="/admin/dashboard">Back</a>';
        } catch (\Exception $e) {
            return 'Error creating link: ' . $e->getMessage();
        }
    })->name('system.storage-link');
});

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{item}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [App\Http\Controllers\OrderController::class, 'store'])->name('checkout.store');

    Route::get('checkout/pay/{order}', [App\Http\Controllers\SelcomController::class, 'pay'])->name('selcom.pay');
    Route::get('checkout/status/{order}', [App\Http\Controllers\SelcomController::class, 'checkStatus'])->name('selcom.status');
    Route::resource('addresses', App\Http\Controllers\AddressController::class);
});

require __DIR__.'/auth.php';

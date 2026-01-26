<x-admin-layout>
    <div class="py-12 px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Category Management</h1>
            <a href="{{ route('admin.categories.create') }}"
                class="px-4 py-2 bg-[#fa8900] text-white rounded-md hover:bg-orange-600 transition-colors shadow-sm font-medium">
                Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 font-medium text-slate-900">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Products Count</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3 text-slate-500 font-mono">{{ $category->id }}</td>
                            <td class="px-6 py-3 font-medium text-slate-900">{{ $category->name }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-semibold">
                                    {{ $category->products_count }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-right flex justify-end gap-3">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="text-brand-orange hover:text-orange-700 font-medium">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
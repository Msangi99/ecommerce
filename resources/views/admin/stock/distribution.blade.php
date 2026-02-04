<x-admin-layout>
    <div class="py-12 px-8">
        <h1 class="text-2xl font-bold text-slate-900">Distribution Sales</h1>
        <p class="mt-2 text-slate-600">Manage distribution sales here.</p>

        <div class="mt-8 bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase text-slate-500">
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Reference</th>
                        <th class="px-6 py-3">Distributor</th>
                        <th class="px-6 py-3">Amount</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-slate-500">No distribution sales found.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 tracking-tight">Product List</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your product inventory.</p>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            @can('export-product')
                                <a href="#" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition duration-150 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Export Product
                                </a>
                            @endcan

                            {{-- Implementasi Component AddProduct (Sesuai Modul 7) --}}
                            <a href="{{ route('product.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition duration-150 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Product
                            </a>
                        </div>
                    </div>

                    {{-- Alert Success Message --}}
                    @if (session('success'))
                        <div class="mb-6 px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 rounded-lg text-sm font-bold italic">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="w-full text-sm text-left divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Owner</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100 italic">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 font-bold text-gray-900 dark:text-gray-100">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $product->quantity > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' }}">
                                                {{ $product->quantity }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-700 dark:text-gray-200 font-mono font-bold">
                                            Rp {{ number_format((int)$product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-medium">
                                            {{ $product->user->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                {{-- View Button --}}
                                                <a href="{{ route('product.show', $product->id) }}" class="p-1.5 rounded-md text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition" title="View">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                
                                                @can('update', $product)
                                                    {{-- IMPLEMENTASI COMPONENT (PENUGASAN MODUL 7) --}}
                                                    <x-action-button type="edit" :url="route('product.edit', $product->id)" />
                                                    <x-action-button type="delete" :url="route('product.delete', $product->id)" />
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                            No products found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-12" style="background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div style="background: white; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0;">
                
                {{-- Header Section --}}
                <div style="padding: 32px; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(to right, #ffffff, #f1f5f9); border-bottom: 1px solid #e2e8f0;">
                    <div>
                        <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">Product List</h1>
                        <p style="color: #64748b; font-size: 15px; margin-top: 4px;">Manage and monitor your current stock and products.</p>
                    </div>
                    
                    <div style="display: flex; gap: 12px;">
                        @can('export-product')
                        <a href="{{ route('product.export') }}" 
                           style="background: linear-gradient(135deg, #059669 0%, #047857 100%) !important; color: white !important; padding: 12px 24px; border-radius: 10px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2); transition: all 0.2s; font-size: 14px;">
                           EXPORT
                        </a>
                        @endcan

                        <a href="{{ route('product.create') }}" 
                           style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important; color: white !important; padding: 12px 24px; border-radius: 10px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transition: all 0.2s; font-size: 14px;">
                           <span style="font-size: 20px;">+</span> ADD PRODUCT
                        </a>
                    </div>
                </div>

                {{-- Table Body --}}
                <div style="padding: 24px;">
                    @if (session('success'))
                        <div style="margin-bottom: 20px; padding: 14px 20px; background: #ecfdf5; border: 1px solid #10b981; color: #065f46; border-radius: 10px; font-size: 14px; font-weight: 600;">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <div style="overflow-x: auto; border-radius: 12px; border: 1px solid #f1f5f9;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="background: #f8fafc;">
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em;">#</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em;">Product Info</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em;">Category</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em; text-align: center;">Qty</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em;">Price</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em; text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                                    <td style="padding: 20px 24px; color: #94a3b8; font-family: font-mono;">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td style="padding: 20px 24px;">
                                        <div style="font-weight: 700; color: #1e293b; font-size: 16px;">{{ $product->name }}</div>
                                        <div style="font-size: 12px; color: #94a3b8; margin-top: 2px;">Owner: {{ $product->user->name ?? '-' }}</div>
                                    </td>
                                    <td style="padding: 20px 24px;">
                                        <div style="display: inline-block; background: #f5f3ff; color: #7c3aed; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase; border: 1px solid #ddd6fe;">
                                            {{ $product->category->name ?? 'UNCATEGORIZED' }}
                                        </div>
                                    </td>
                                    <td style="padding: 20px 24px; text-align: center;">
                                        <div style="font-weight: 700; color: {{ $product->quantity > 0 ? '#1e293b' : '#e11d48' }};">
                                            {{ $product->quantity }}
                                        </div>
                                    </td>
                                    <td style="padding: 20px 24px;">
                                        <div style="font-weight: 800; color: #0f172a;">Rp {{ number_format((int)$product->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td style="padding: 20px 24px; text-align: right;">
                                        <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                            <a href="{{ route('product.show', $product->id) }}" 
                                               style="background: #f1f5f9; color: #475569; padding: 8px; border-radius: 8px; border: 1px solid #e2e8f0; display: inline-flex;">
                                                👁️
                                            </a>
                                            @can('update', $product)
                                            <a href="{{ route('product.edit', $product->id) }}" 
                                               style="background: #f1f5f9; color: #475569; padding: 8px 12px; border-radius: 8px; font-weight: 700; font-size: 13px; text-decoration: none; border: 1px solid #e2e8f0;">
                                               Edit
                                            </a>
                                            <form action="{{ route('product.delete', $product->id) }}" method="POST" style="display: inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        style="background: #fff1f2; color: #e11d48; padding: 8px 12px; border-radius: 8px; font-weight: 700; font-size: 13px; border: 1px solid #ffe4e6; cursor: pointer;"
                                                        onclick="return confirm('Hapus produk?')">
                                                    Delete
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="padding: 60px; text-align: center; color: #94a3b8;">
                                        <div style="font-size: 40px; margin-bottom: 10px;">📦</div>
                                        <p style="font-style: italic; font-size: 15px;">No products found.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="padding: 20px 32px; background: #f8fafc; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 13px;">
                    Showing <strong>{{ $products->count() }}</strong> products in total.
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-12" style="background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div style="background: white; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0;">
                
                <div style="padding: 32px; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(to right, #ffffff, #f1f5f9); border-bottom: 1px solid #e2e8f0;">
                    <div>
                        <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">Category List</h1>
                        <p style="color: #64748b; font-size: 15px; margin-top: 4px;">Manage and organize your product classifications.</p>
                    </div>
                    
                    <a href="{{ route('category.create') }}" 
                       style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important; color: white !important; padding: 12px 24px; border-radius: 10px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transition: all 0.2s; font-size: 14px;">
                       <span style="font-size: 20px;">+</span> ADD CATEGORY
                    </a>
                </div>

                <div style="padding: 24px;">
                    <div style="overflow-x: auto; border-radius: 12px; border: 1px solid #f1f5f9;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="background: #f8fafc;">
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em;">#</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em;">Category Name</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em; text-align: center;">Total Products</th>
                                    <th style="padding: 18px 24px; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em; text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                                    <td style="padding: 20px 24px; color: #94a3b8; font-family: font-mono;">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td style="padding: 20px 24px;">
                                        <span style="font-weight: 700; color: #1e293b; font-size: 16px;">{{ $category->name }}</span>
                                    </td>
                                    <td style="padding: 20px 24px; text-align: center;">
                                        <div style="display: inline-block; background: #eff6ff; color: #2563eb; padding: 6px 14px; border-radius: 8px; font-size: 13px; font-weight: 700; border: 1px solid #dbeafe;">
                                            {{ $category->products_count }} <span style="font-weight: 500; font-size: 12px; color: #60a5fa; margin-left: 4px;">Items</span>
                                        </div>
                                    </td>
                                    <td style="padding: 20px 24px; text-align: right;">
                                        <div style="display: flex; justify-content: flex-end; gap: 12px;">
                                            <a href="{{ route('category.edit', $category->id) }}" 
                                               style="background: #f1f5f9; color: #475569; padding: 8px 16px; border-radius: 8px; font-weight: 700; font-size: 13px; text-decoration: none; transition: all 0.2s; border: 1px solid #e2e8f0;">
                                               Edit
                                            </a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        style="background: #fff1f2; color: #e11d48; padding: 8px 16px; border-radius: 8px; font-weight: 700; font-size: 13px; border: 1px solid #ffe4e6; cursor: pointer; transition: all 0.2s;"
                                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="padding: 60px; text-align: center; color: #94a3b8;">
                                        <div style="font-size: 40px; margin-bottom: 10px;">📂</div>
                                        <p style="font-style: italic; font-size: 15px;">No categories found. Start by adding one!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="padding: 20px 32px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; align-items: center; color: #64748b; font-size: 13px;">
                    Showing <strong>{{ $categories->count() }}</strong> categories in total.
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
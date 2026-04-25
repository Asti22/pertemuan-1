<x-app-layout>
    <div class="py-12" style="background-color: #0f172a; min-height: 100vh;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            {{-- CONTAINER UTAMA --}}
            <div style="background: #1e293b; border-radius: 16px; border: 1px solid #334155; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                <div class="p-8">

                    {{-- HEADER --}}
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 32px;">
                        <a href="{{ route('product.index') }}" 
                           style="padding: 8px; border-radius: 8px; color: #94a3b8; background: #0f172a; border: 1px solid #334155; transition: all 0.2s; text-decoration: none;"
                           onmouseover="this.style.color='white'; this.style.borderColor='#4f46e5'"
                           onmouseout="this.style.color='#94a3b8'; this.style.borderColor='#334155'">
                            <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 style="font-size: 24px; font-weight: 800; color: white; letter-spacing: -0.025em; margin: 0;">Add Product</h2>
                            <p style="font-size: 14px; color: #94a3b8; margin-top: 4px;">Fill in the details to add a new product to inventory.</p>
                        </div>
                    </div>

                    {{-- FORM --}}
                    <form action="{{ route('product.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 24px;">
                        @csrf

                        {{-- NAMA PRODUK --}}
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #cbd5e1; margin-bottom: 8px;">
                                Product Name <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Wireless Headphones"
                                   style="width: 100%; padding: 12px 16px; background: #0f172a; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#334155' }}; border-radius: 10px; color: white; font-size: 14px; transition: all 0.2s; outline: none;"
                                   onfocus="this.style.borderColor='#4f46e5'; this.style.ring='2px #4f46e5'">
                            @error('name')
                                <p style="margin-top: 8px; font-size: 13px; color: #f87171; font-weight: 700;">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- DROPDOWN KATEGORI (Baru Sesuai Instruksi) --}}
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #cbd5e1; margin-bottom: 8px;">
                                Category <span style="color: #ef4444;">*</span>
                            </label>
                            <select name="category_id" 
                                    style="width: 100%; padding: 12px 16px; background: #0f172a; border: 1px solid {{ $errors->has('category_id') ? '#ef4444' : '#334155' }}; border-radius: 10px; color: white; font-size: 14px; outline: none; appearance: none;">
                                <option value="" style="color: #64748b;">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p style="margin-top: 8px; font-size: 13px; color: #f87171; font-weight: 700;">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- QUANTITY & PRICE --}}
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; color: #cbd5e1; margin-bottom: 8px;">
                                    Quantity <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="number" name="quantity" value="{{ old('quantity', 0) }}" placeholder="0"
                                       style="width: 100%; padding: 12px 16px; background: #0f172a; border: 1px solid {{ $errors->has('quantity') ? '#ef4444' : '#334155' }}; border-radius: 10px; color: white; font-size: 14px; outline: none;">
                                @error('quantity')
                                    <p style="margin-top: 8px; font-size: 13px; color: #f87171; font-weight: 700;">⚠️ {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; color: #cbd5e1; margin-bottom: 8px;">
                                    Price (Rp) <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="number" name="price" value="{{ old('price', 0) }}" placeholder="0" step="0.01"
                                       style="width: 100%; padding: 12px 16px; background: #0f172a; border: 1px solid {{ $errors->has('price') ? '#ef4444' : '#334155' }}; border-radius: 10px; color: white; font-size: 14px; outline: none;">
                                @error('price')
                                    <p style="margin-top: 8px; font-size: 13px; color: #f87171; font-weight: 700;">⚠️ {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- OWNER / USER --}}
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #cbd5e1; margin-bottom: 8px;">
                                Owner <span style="color: #ef4444;">*</span>
                            </label>
                            <select name="user_id" 
                                    style="width: 100%; padding: 12px 16px; background: #0f172a; border: 1px solid {{ $errors->has('user_id') ? '#ef4444' : '#334155' }}; border-radius: 10px; color: white; font-size: 14px; outline: none;">
                                <option value="">-- Select Owner --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ (old('user_id') ?? Auth::id()) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} {{ $user->id == Auth::id() ? '(Me)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p style="margin-top: 8px; font-size: 13px; color: #f87171; font-weight: 700;">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- BUTTON ACTIONS --}}
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 16px; padding-top: 24px; border-top: 1px solid #334155;">
                            <a href="{{ route('product.index') }}" 
                               style="padding: 10px 20px; border-radius: 10px; border: 1px solid #334155; color: #94a3b8; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.2s;"
                               onmouseover="this.style.background='#334155'; this.style.color='white'"
                               onmouseout="this.style.background='transparent'; this.style.color='#94a3b8'">
                                Cancel
                            </a>
                            <button type="submit" 
                                    style="padding: 10px 24px; background: #4f46e5; color: white; border-radius: 10px; font-size: 14px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 4px 14px rgba(79, 70, 229, 0.4); transition: all 0.2s;"
                                    onmouseover="this.style.background='#4338ca'; this.style.transform='translateY(-1px)'"
                                    onmouseout="this.style.background='#4f46e5'; this.style.transform='translateY(0)'">
                                Save Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
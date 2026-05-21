@extends('layouts.admin')

@section('title', 'Add Product | Hi Venus')

@push('styles')
<style>
    body {
        background-color: #fcf9f8;
        /* Enhanced Playful Pattern */
        background-image: 
            radial-gradient(#ff85d0 2px, transparent 2px),
            radial-gradient(#38bbef 2px, transparent 2px);
        background-size: 32px 32px;
        background-position: 0 0, 16px 16px;
        position: relative;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(#e5e2e1 1px, transparent 1px), linear-gradient(90deg, #e5e2e1 1px, transparent 1px);
        background-size: 64px 64px;
        opacity: 0.3;
        z-index: -1;
        pointer-events: none;
    }

    .kawaii-card {
        background: white;
        border: 4px solid #1b1c1c;
        box-shadow: 8px 8px 0px 0px #1b1c1c;
    }

    .kawaii-input {
        border: 3px solid #1b1c1c;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.2s ease;
        background-color: white;
        width: 100%;
    }

    .kawaii-input:focus {
        outline: none;
        border-color: #38bbef;
        box-shadow: 4px 4px 0px 0px #1b1c1c;
        transform: translate(-2px, -2px);
    }

    .kawaii-button {
        border: 4px solid #1b1c1c;
        transition: all 0.1s ease;
        position: relative;
        cursor: pointer;
    }

    .kawaii-button:active {
        transform: translate(4px, 4px);
        box-shadow: 0px 0px 0px 0px #1b1c1c !important;
    }
</style>
@endpush

@section('content')
<div class="animate-fade-in relative z-10">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background bg-white/80 inline-block px-2 rounded">Add Product</h2>
            <nav class="flex gap-2 text-on-surface-variant font-label-bold bg-white/80 inline-block px-2 rounded mt-1">
                <span class="">Products</span>
                <span class="">/</span>
                <span class="text-primary">Create New</span>
            </nav>
        </div>
    </header>

    <div class="max-w-5xl mx-auto relative z-10">
        <form class="grid grid-cols-1 lg:grid-cols-3 gap-8" id="productForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Left Column: Form Details -->
            <div class="lg:col-span-2 space-y-8">
                <div class="kawaii-card p-8 rounded-lg relative overflow-hidden">
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-secondary-container border-4 border-on-background rotate-12 flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-background" data-icon="edit">edit</span>
                    </div>
                    
                    <h3 class="font-headline-lg text-2xl mb-6">Basic Info</h3>
                    
                    <div class="space-y-6">
                        <div class="flex flex-col gap-2">
                            <label class="font-label-bold text-on-surface-variant">Product Name</label>
                            <input name="name" class="kawaii-input font-body-md" placeholder="e.g. Dreamy Cloud Sweater" type="text" value="{{ old('name') }}" required>
                            @error('name')<span class="text-error text-sm font-bold">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label class="font-label-bold text-on-surface-variant">Category</label>
                                <select name="category_id" class="kawaii-input font-body-md appearance-none" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<span class="text-error text-sm font-bold">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <label class="font-label-bold text-on-surface-variant">Price (Rp)</label>
                                <input name="price" class="kawaii-input font-body-md" placeholder="0" type="number" min="0" value="{{ old('price') }}" required>
                                @error('price')<span class="text-error text-sm font-bold">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <label class="font-label-bold text-on-surface-variant">Description</label>
                            <textarea name="description" class="kawaii-input font-body-md" placeholder="Tell us about this magical product..." rows="4" required>{{ old('description') }}</textarea>
                            @error('description')<span class="text-error text-sm font-bold">{{ $message }}</span>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label class="font-label-bold text-on-surface-variant">Stock Quantity</label>
                                <input name="initial_stock" class="kawaii-input font-body-md" placeholder="0" type="number" min="0" value="{{ old('initial_stock', 0) }}" required>
                                @error('initial_stock')<span class="text-error text-sm font-bold">{{ $message }}</span>@enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-label-bold text-on-surface-variant">SKU</label>
                                <input class="kawaii-input font-body-md" placeholder="HV-000" type="text" readonly disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Variants Section -->
                <div class="kawaii-card p-8 rounded-lg">
                    <h3 class="font-headline-lg text-2xl mb-6 flex items-center gap-2">
                        Add Variants
                        <span class="material-symbols-outlined text-primary" data-icon="palette">palette</span>
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 min-w-[200px]">
                                <label class="font-label-bold text-on-surface-variant mb-2 block">Available Sizes</label>
                                <div class="flex gap-2">
                                    <button class="w-10 h-10 kawaii-button bg-surface border-2 flex items-center justify-center font-bold hover:bg-secondary-container" type="button">S</button>
                                    <button class="w-10 h-10 kawaii-button bg-primary-container border-2 flex items-center justify-center font-bold text-on-primary-container shadow-[2px_2px_0px_0px_#1b1c1c]" type="button">M</button>
                                    <button class="w-10 h-10 kawaii-button bg-surface border-2 flex items-center justify-center font-bold hover:bg-secondary-container" type="button">L</button>
                                    <button class="w-10 h-10 kawaii-button bg-surface border-2 flex items-center justify-center font-bold hover:bg-secondary-container" type="button">XL</button>
                                </div>
                            </div>
                            <div class="flex-1 min-w-[200px]">
                                <label class="font-label-bold text-on-surface-variant mb-2 block">Color Options</label>
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#ff85d0] border-4 border-on-background cursor-pointer hover:scale-110 transition-transform"></div>
                                    <div class="w-8 h-8 rounded-full bg-[#38bbef] border-4 border-on-background cursor-pointer hover:scale-110 transition-transform"></div>
                                    <div class="w-8 h-8 rounded-full bg-[#fdd73b] border-4 border-on-background cursor-pointer hover:scale-110 transition-transform"></div>
                                    <div class="w-8 h-8 rounded-full bg-[#ffffff] border-4 border-on-background cursor-pointer hover:scale-110 transition-transform flex items-center justify-center">
                                        <span class="material-symbols-outlined text-xs" data-icon="add">add</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Image & Actions -->
            <div class="space-y-8">
                <!-- Image Upload -->
                <div class="kawaii-card p-4 rounded-lg flex flex-col items-center gap-4 text-center">
                    <div class="w-full aspect-square border-4 border-dashed border-outline-variant rounded-lg bg-surface-container-low flex flex-col items-center justify-center gap-4 relative overflow-hidden group">
                        
                        <!-- Image Preview -->
                        <img id="imagePreview" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCpMYTN0QmYyn1l7DGzHpqh5pv4OouUTsl5rteXYn0_OI5IxNpOYnf9a6rAXdGJBAkSxyAbccOpS-nHXT-G9jBStadhN8k0iro1s1e_MMb2LTED2mKw0Uco2v-Xjsu7YiFbkFgjK_YcmKmapg6qMQgRCEepLyXTgNQkMp2Pl4iagR3GUBskKQ29wwZgjOFKuzkQy0dSdluzwgaIFsAqEDpvPe1MAx4fnm3mjJ0RDyxGuBH_Guso6t9XcR7IldtyN23ZVXpCcE28RR1L" class="w-full h-full object-cover rounded-lg rotate-2 opacity-80 absolute inset-0 z-0">
                        
                        <div class="absolute inset-0 bg-white/40 flex flex-col items-center justify-center hover:bg-white/10 transition-colors cursor-pointer z-10" onclick="document.getElementById('imageInput').click()">
                            <div class="w-16 h-16 bg-white border-4 border-on-background rounded-full flex items-center justify-center mb-2 shadow-[4px_4px_0px_0px_#1b1c1c] group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl" data-icon="cloud_upload">cloud_upload</span>
                            </div>
                            <span class="font-label-bold text-on-background px-4 py-1 bg-secondary-container border-2 border-on-background rounded-full">Upload Image</span>
                        </div>
                        
                        <input type="file" name="image" id="imageInput" class="hidden" accept="image/jpeg,image/png,image/webp" required>
                    </div>
                    @error('image')<p class="text-error text-sm font-bold w-full text-left">{{ $message }}</p>@enderror
                    <p class="text-xs text-on-surface-variant italic">Supported formats: JPG, PNG (Max 5MB)</p>
                </div>
                
                <!-- Visibility -->
                <div class="kawaii-card p-6 rounded-lg">
                    <h3 class="font-label-bold text-lg mb-4">Store Visibility</h3>
                    
                    <label class="flex items-center justify-between p-3 bg-surface-container rounded-lg border-2 border-on-background cursor-pointer">
                        <span class="font-label-bold">Online Store</span>
                        <input type="checkbox" name="is_visible" value="1" class="hidden peer" checked>
                        <div class="w-12 h-6 bg-surface-dim rounded-full border-2 border-on-background relative shadow-[2px_2px_0px_0px_#1b1c1c] peer-checked:bg-primary transition-colors">
                            <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full border border-on-background transition-transform peer-checked:translate-x-6"></div>
                        </div>
                    </label>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col gap-4">
                    <button class="w-full kawaii-button bg-primary text-on-primary py-5 rounded-lg font-headline-lg text-xl shadow-[8px_8px_0px_0px_#1b1c1c] hover:bg-primary-container hover:text-on-primary-container" type="submit">
                        Save Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="w-full kawaii-button bg-surface text-on-background py-4 rounded-lg font-label-bold shadow-[4px_4px_0px_0px_#1b1c1c] hover:bg-surface-dim flex justify-center items-center">
                        Cancel Changes
                    </a>
                </div>
                
                <!-- Fun Decorative Badge -->
                <div class="kawaii-card bg-secondary-container p-6 rounded-lg rotate-3 border-dashed border-4 border-on-background relative">
                    <div class="absolute -top-3 -left-3 bg-white border-2 border-on-background rounded-full px-3 py-1 text-[10px] font-bold">PRO TIP</div>
                    <p class="font-label-bold italic text-on-secondary-container">"Adding 3+ photos increases sales by 40%! Sparkle it up! ✨"</p>
                    <span class="material-symbols-outlined absolute bottom-2 right-2 text-primary opacity-30" data-icon="mood">mood</span>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image Preview functionality
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    
    imageInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('opacity-30', 'rotate-2');
                imagePreview.classList.add('opacity-100');
            }
            
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Form submission animation
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = 'Creating Magic... ✨';
        btn.classList.add('pointer-events-none', 'opacity-80');
    });

    // Add visual interest to inputs
    document.querySelectorAll('.kawaii-input').forEach(input => {
        input.addEventListener('focus', () => {
            const colors = ['#ff85d0', '#38bbef', '#fdd73b'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            input.style.borderColor = randomColor;
        });
        input.addEventListener('blur', () => {
            input.style.borderColor = '#1b1c1c';
        });
    });
</script>
@endpush

@extends('layouts.admin')

@section('title', 'Add Product | Hi Venus')

@push('styles')
<style>
    /* Hide default admin layout pattern to use custom one */
    main > div.absolute.inset-0.z-0 {
        display: none !important;
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

    .kawaii-input.input-error {
        border-color: #ba1a1a;
        box-shadow: 4px 4px 0px 0px #ba1a1a;
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

    /* Toggle switch */
    .toggle-track {
        width: 48px;
        height: 24px;
        border-radius: 9999px;
        border: 2px solid #1b1c1c;
        position: relative;
        cursor: pointer;
        transition: background-color 0.2s ease;
        box-shadow: 2px 2px 0px 0px #1b1c1c;
    }
    .toggle-track.active {
        background-color: #9e357b;
    }
    .toggle-track:not(.active) {
        background-color: #dcd9d9;
    }
    .toggle-knob {
        position: absolute;
        top: 3px;
        width: 14px;
        height: 14px;
        background: white;
        border-radius: 9999px;
        border: 1px solid #1b1c1c;
        transition: transform 0.2s ease;
    }
    .toggle-track.active .toggle-knob {
        transform: translateX(24px);
    }
    .toggle-track:not(.active) .toggle-knob {
        transform: translateX(3px);
    }

    /* Size button toggle */
    .size-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 3px solid #1b1c1c;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s ease;
        user-select: none;
    }
    .size-btn:hover {
        transform: translate(-1px, -1px);
        box-shadow: 3px 3px 0px 0px #1b1c1c;
    }
    .size-btn.selected {
        background-color: #ff85d0;
        color: #1b1c1c;
        box-shadow: 2px 2px 0px 0px #1b1c1c;
        transform: translate(-1px, -1px);
    }
    .size-btn:not(.selected) {
        background-color: white;
    }

    /* Color swatch */
    .color-swatch {
        width: 32px;
        height: 32px;
        border-radius: 9999px;
        border: 4px solid #1b1c1c;
        cursor: pointer;
        transition: all 0.15s ease;
        position: relative;
    }
    .color-swatch:hover {
        transform: scale(1.15);
    }
    .color-swatch.selected::after {
        content: '✓';
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        color: #1b1c1c;
    }

    /* Upload area */
    .upload-area {
        transition: all 0.2s ease;
    }
    .upload-area.drag-over {
        border-color: #9e357b !important;
        background-color: #ffd8eb !important;
        transform: scale(1.02);
    }
    .upload-area.border-error {
        border-color: #ba1a1a !important;
        background-color: #ffebeb !important;
        animation: shake 0.5s ease;
    }
    .upload-area .upload-hint {
        transition: opacity 0.2s ease;
    }
    .upload-area.has-image .upload-hint {
        opacity: 0;
    }
    .upload-area.has-image:hover .upload-hint {
        opacity: 1;
        background: rgba(255,255,255,0.85) !important;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-8px); }
        75% { transform: translateX(8px); }
    }

    /* Shimmer loading for submit */
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    .btn-loading {
        background: linear-gradient(90deg, #9e357b 40%, #ff85d0 50%, #9e357b 60%) !important;
        background-size: 200% 100% !important;
        animation: shimmer 1.5s infinite;
        pointer-events: none;
    }
</style>
@endpush

@section('content')
<!-- Custom Background Pattern Layer just for this page -->
<div class="fixed inset-0 z-0 ml-72 pointer-events-none" style="background-color: #fcf9f8; background-image: radial-gradient(#ff85d0 2px, transparent 2px), radial-gradient(#38bbef 2px, transparent 2px); background-size: 32px 32px; background-position: 0 0, 16px 16px;">
    <div class="absolute inset-0" style="background-image: linear-gradient(#e5e2e1 1px, transparent 1px), linear-gradient(90deg, #e5e2e1 1px, transparent 1px); background-size: 64px 64px; opacity: 0.3;"></div>
</div>

<div class="animate-fade-in relative z-10">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background bg-white/80 inline-block px-2 rounded">Add Product</h2>
            <nav class="flex gap-2 text-on-surface-variant font-label-bold bg-white/80 inline-block px-2 rounded mt-1">
                <a href="{{ route('admin.products.index') }}" class="hover:text-primary transition-colors">Products</a>
                <span>/</span>
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
                        <span class="material-symbols-outlined text-on-background">edit</span>
                    </div>
                    
                    <h3 class="font-headline-lg text-2xl mb-6">Basic Info</h3>
                    
                    <div class="space-y-6">
                        <div class="flex flex-col gap-2">
                            <label for="productName" class="font-label-bold text-on-surface-variant">Product Name</label>
                            <input id="productName" name="name" class="kawaii-input font-body-md @error('name') input-error @enderror" placeholder="e.g. Dreamy Cloud Sweater" type="text" value="{{ old('name') }}" required>
                            @error('name')<span class="text-error text-sm font-bold flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span> {{ $message }}</span>@enderror
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="productCategory" class="font-label-bold text-on-surface-variant">Category</label>
                                <select id="productCategory" name="category_id" class="kawaii-input font-body-md appearance-none @error('category_id') input-error @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<span class="text-error text-sm font-bold flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span> {{ $message }}</span>@enderror
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <label for="productPrice" class="font-label-bold text-on-surface-variant">Price (Rp)</label>
                                <input id="productPrice" name="price" class="kawaii-input font-body-md @error('price') input-error @enderror" placeholder="0" type="number" min="0" value="{{ old('price') }}" required>
                                @error('price')<span class="text-error text-sm font-bold flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span> {{ $message }}</span>@enderror
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <label for="productDescription" class="font-label-bold text-on-surface-variant">Description</label>
                            <textarea id="productDescription" name="description" class="kawaii-input font-body-md @error('description') input-error @enderror" placeholder="Tell us about this magical product..." rows="4" required>{{ old('description') }}</textarea>
                            @error('description')<span class="text-error text-sm font-bold flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span> {{ $message }}</span>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="productStock" class="font-label-bold text-on-surface-variant">Stock Quantity</label>
                                <input id="productStock" name="initial_stock" class="kawaii-input font-body-md @error('initial_stock') input-error @enderror" placeholder="0" type="number" min="0" value="{{ old('initial_stock', 0) }}" required>
                                @error('initial_stock')<span class="text-error text-sm font-bold flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span> {{ $message }}</span>@enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-label-bold text-on-surface-variant">SKU</label>
                                <input id="skuField" class="kawaii-input font-body-md bg-surface-container-low text-on-surface-variant" placeholder="Auto-generated" type="text" readonly>
                                <span class="text-xs text-on-surface-variant italic">Will be auto-generated on save</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Variants Section -->
                <div class="kawaii-card p-8 rounded-lg">
                    <h3 class="font-headline-lg text-2xl mb-6 flex items-center gap-2">
                        Add Variants
                        <span class="material-symbols-outlined text-primary">palette</span>
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="flex flex-wrap gap-8">
                            <div class="flex-1 min-w-[200px]">
                                <label class="font-label-bold text-on-surface-variant mb-3 block">Available Sizes</label>
                                <div class="flex gap-2" id="sizeSelector">
                                    <div class="size-btn" data-size="S">S</div>
                                    <div class="size-btn selected" data-size="M">M</div>
                                    <div class="size-btn" data-size="L">L</div>
                                    <div class="size-btn" data-size="XL">XL</div>
                                </div>
                                <!-- Hidden inputs for selected sizes -->
                                <div id="sizeInputs">
                                    <input type="hidden" name="sizes[]" value="M">
                                </div>
                            </div>
                            <div class="flex-1 min-w-[200px]">
                                <label class="font-label-bold text-on-surface-variant mb-3 block">Color Options</label>
                                <div class="flex gap-3 items-center" id="colorSelector">
                                    <div class="color-swatch selected" data-color="#ff85d0" style="background-color: #ff85d0;"></div>
                                    <div class="color-swatch" data-color="#38bbef" style="background-color: #38bbef;"></div>
                                    <div class="color-swatch" data-color="#fdd73b" style="background-color: #fdd73b;"></div>
                                    <div class="color-swatch flex items-center justify-center" data-color="custom" style="background-color: #ffffff;" id="addColorBtn">
                                        <span class="material-symbols-outlined text-sm">add</span>
                                    </div>
                                </div>
                                <div id="colorInputs">
                                    <input type="hidden" name="colors[]" value="#ff85d0">
                                </div>
                                <!-- Color picker (hidden by default) -->
                                <input type="color" id="colorPicker" class="hidden" value="#aabbcc">
                            </div>
                        </div>
                        <p class="text-xs text-on-surface-variant italic mt-2">💡 Tip: Click to toggle sizes and colors. Variants will be created for each combination after saving.</p>
                        
                        <!-- Dynamic Variant Preview Section -->
                        <div class="mt-6 border-t-2 border-dashed border-on-background pt-6 hidden" id="variantPreviewSection">
                            <h4 class="font-label-bold text-md mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-primary font-bold">analytics</span>
                                Stock & Variant Distribution Preview
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3" id="variantPreviewList">
                                <!-- Preview cards injected by JS -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Image & Actions -->
            <div class="space-y-8">
                <!-- Image Upload -->
                <div class="kawaii-card p-4 rounded-lg flex flex-col items-center gap-4 text-center">
                    <div class="upload-area w-full aspect-square border-4 border-dashed border-outline-variant rounded-lg bg-surface-container-low flex flex-col items-center justify-center gap-4 relative overflow-hidden group" id="uploadArea">
                        
                        <!-- Image Preview -->
                        <img id="imagePreview" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCpMYTN0QmYyn1l7DGzHpqh5pv4OouUTsl5rteXYn0_OI5IxNpOYnf9a6rAXdGJBAkSxyAbccOpS-nHXT-G9jBStadhN8k0iro1s1e_MMb2LTED2mKw0Uco2v-Xjsu7YiFbkFgjK_YcmKmapg6qMQgRCEepLyXTgNQkMp2Pl4iagR3GUBskKQ29wwZgjOFKuzkQy0dSdluzwgaIFsAqEDpvPe1MAx4fnm3mjJ0RDyxGuBH_Guso6t9XcR7IldtyN23ZVXpCcE28RR1L" class="w-full h-full object-cover rounded-lg rotate-2 opacity-80 absolute inset-0 z-0">
                        
                        <div class="upload-hint absolute inset-0 bg-white/40 flex flex-col items-center justify-center hover:bg-white/10 transition-all cursor-pointer z-10" id="uploadHint">
                            <div class="w-16 h-16 bg-white border-4 border-on-background rounded-full flex items-center justify-center mb-2 shadow-[4px_4px_0px_0px_#1b1c1c] group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl" id="uploadIcon">cloud_upload</span>
                            </div>
                            <span class="font-label-bold text-on-background px-4 py-1 bg-secondary-container border-2 border-on-background rounded-full" id="uploadLabel">Upload Image</span>
                            <span class="text-xs text-on-surface-variant mt-2 hidden" id="dragHint">or drag & drop here</span>
                        </div>
                        
                        <input type="file" name="image" id="imageInput" class="hidden" accept="image/jpeg,image/png,image/webp">
                    </div>
                    
                    <!-- Beautiful Custom Error Message for Image -->
                    <p class="text-error text-sm font-bold w-full text-left flex items-center gap-1 hidden shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] p-2 bg-error-container border-2 border-on-background rounded-lg animate-bounce" id="imageError">
                        <span class="material-symbols-outlined text-sm">error</span> Please upload a product image!
                    </p>

                    <!-- File info after selection -->
                    <div id="fileInfo" class="hidden w-full text-left">
                        <div class="flex items-center justify-between bg-surface-container rounded-lg p-2 border-2 border-on-background">
                            <div class="flex items-center gap-2 overflow-hidden">
                                <span class="material-symbols-outlined text-primary">image</span>
                                <span class="font-label-bold text-sm truncate" id="fileName"></span>
                            </div>
                            <button type="button" id="removeImage" class="text-error hover:bg-error-container rounded-full p-1 transition-colors">
                                <span class="material-symbols-outlined text-sm">close</span>
                            </button>
                        </div>
                        <span class="text-xs text-on-surface-variant" id="fileSize"></span>
                    </div>
                    @error('image')<p class="text-error text-sm font-bold w-full text-left flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span> {{ $message }}</p>@enderror
                    <p class="text-xs text-on-surface-variant italic" id="formatHint">Supported formats: JPG, PNG, WEBP (Max 5MB)</p>
                </div>
                
                <!-- Visibility & Store Settings -->
                <div class="kawaii-card p-6 rounded-lg space-y-4">
                    <h3 class="font-label-bold text-lg mb-2">Store Settings</h3>
                    
                    <div class="flex items-center justify-between p-3 bg-surface-container rounded-lg border-2 border-on-background">
                        <div class="flex flex-col">
                            <span class="font-label-bold">Online Store</span>
                            <span class="text-xs text-on-surface-variant">Visible in catalog</span>
                        </div>
                        <input type="checkbox" name="is_visible" id="isVisibleCheckbox" class="sr-only" checked value="1">
                        <div class="toggle-track active" id="visibilityToggle">
                            <div class="toggle-knob"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-surface-container rounded-lg border-2 border-on-background">
                        <div class="flex flex-col">
                            <span class="font-label-bold">Featured Product</span>
                            <span class="text-xs text-on-surface-variant">Show on homepage</span>
                        </div>
                        <input type="checkbox" name="is_featured" id="isFeaturedCheckbox" class="sr-only" value="1">
                        <div class="toggle-track" id="featuredToggle">
                            <div class="toggle-knob"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col gap-4">
                    <button class="w-full kawaii-button bg-primary text-on-primary py-5 rounded-lg font-headline-lg text-xl shadow-[8px_8px_0px_0px_#1b1c1c] hover:bg-primary-container hover:text-on-primary-container flex items-center justify-center gap-2" type="submit" id="submitBtn">
                        <span class="material-symbols-outlined">save</span>
                        Save Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="w-full kawaii-button bg-surface text-on-background py-4 rounded-lg font-label-bold shadow-[4px_4px_0px_0px_#1b1c1c] hover:bg-surface-dim flex justify-center items-center gap-2">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Cancel Changes
                    </a>
                </div>
                
                <!-- Fun Decorative Badge -->
                <div class="kawaii-card bg-secondary-container p-6 rounded-lg rotate-3 border-dashed border-4 border-on-background relative">
                    <div class="absolute -top-3 -left-3 bg-white border-2 border-on-background rounded-full px-3 py-1 text-[10px] font-bold">PRO TIP</div>
                    <p class="font-label-bold italic text-on-secondary-container">"Adding 3+ photos increases sales by 40%! Sparkle it up! ✨"</p>
                    <span class="material-symbols-outlined absolute bottom-2 right-2 text-primary opacity-30">mood</span>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ========== IMAGE UPLOAD with Drag & Drop ==========
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const uploadArea = document.getElementById('uploadArea');
    const uploadHint = document.getElementById('uploadHint');
    const uploadIcon = document.getElementById('uploadIcon');
    const uploadLabel = document.getElementById('uploadLabel');
    const dragHint = document.getElementById('dragHint');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeImage = document.getElementById('removeImage');
    const formatHint = document.getElementById('formatHint');
    const imageError = document.getElementById('imageError');
    const productForm = document.getElementById('productForm');

    // Show drag hint on desktop
    dragHint.classList.remove('hidden');

    // Click to upload
    uploadHint.addEventListener('click', () => imageInput.click());

    // Drag & Drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('drag-over');
    });
    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('drag-over');
    });
    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('drag-over');
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            imageInput.files = e.dataTransfer.files;
            handleImageSelect(e.dataTransfer.files[0]);
        }
    });

    // File input change
    imageInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            handleImageSelect(e.target.files[0]);
        }
    });

    function handleImageSelect(file) {
        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('❌ Format tidak didukung! Gunakan JPG, PNG, atau WEBP.');
            return;
        }
        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('❌ Ukuran file terlalu besar! Maksimal 5MB.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('opacity-80', 'rotate-2');
            imagePreview.classList.add('opacity-100');
            uploadArea.classList.add('has-image');
            
            // Show file info
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            fileInfo.classList.remove('hidden');
            formatHint.classList.add('hidden');
            imageError.classList.add('hidden');
            uploadArea.classList.remove('border-error');
        }
        reader.readAsDataURL(file);
    }

    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }

    // Remove image
    removeImage.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.src = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCpMYTN0QmYyn1l7DGzHpqh5pv4OouUTsl5rteXYn0_OI5IxNpOYnf9a6rAXdGJBAkSxyAbccOpS-nHXT-G9jBStadhN8k0iro1s1e_MMb2LTED2mKw0Uco2v-Xjsu7YiFbkFgjK_YcmKmapg6qMQgRCEepLyXTgNQkMp2Pl4iagR3GUBskKQ29wwZgjOFKuzkQy0dSdluzwgaIFsAqEDpvPe1MAx4fnm3mjJ0RDyxGuBH_Guso6t9XcR7IldtyN23ZVXpCcE28RR1L';
        imagePreview.classList.add('opacity-80', 'rotate-2');
        imagePreview.classList.remove('opacity-100');
        uploadArea.classList.remove('has-image');
        fileInfo.classList.add('hidden');
        formatHint.classList.remove('hidden');
    });


    // ========== TOGGLE SWITCHES ==========
    const visibilityToggle = document.getElementById('visibilityToggle');
    const isVisibleCheckbox = document.getElementById('isVisibleCheckbox');

    visibilityToggle.addEventListener('click', function() {
        const isActive = this.classList.contains('active');
        if (isActive) {
            this.classList.remove('active');
            isVisibleCheckbox.checked = false;
        } else {
            this.classList.add('active');
            isVisibleCheckbox.checked = true;
        }
    });

    const featuredToggle = document.getElementById('featuredToggle');
    const isFeaturedCheckbox = document.getElementById('isFeaturedCheckbox');

    featuredToggle.addEventListener('click', function() {
        const isActive = this.classList.contains('active');
        if (isActive) {
            this.classList.remove('active');
            isFeaturedCheckbox.checked = false;
        } else {
            this.classList.add('active');
            isFeaturedCheckbox.checked = true;
        }
    });


    // ========== SIZE SELECTOR ==========
    const sizeSelector = document.getElementById('sizeSelector');
    const sizeInputsContainer = document.getElementById('sizeInputs');

    sizeSelector.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('selected');
            updateSizeInputs();
            updateVariantPreview();
        });
    });

    function updateSizeInputs() {
        sizeInputsContainer.innerHTML = '';
        sizeSelector.querySelectorAll('.size-btn.selected').forEach(btn => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'sizes[]';
            input.value = btn.dataset.size;
            sizeInputsContainer.appendChild(input);
        });
    }


    // ========== COLOR SELECTOR ==========
    const colorSelector = document.getElementById('colorSelector');
    const colorInputsContainer = document.getElementById('colorInputs');
    const addColorBtn = document.getElementById('addColorBtn');
    const colorPicker = document.getElementById('colorPicker');

    colorSelector.querySelectorAll('.color-swatch:not(#addColorBtn)').forEach(swatch => {
        swatch.addEventListener('click', function() {
            this.classList.toggle('selected');
            updateColorInputs();
            updateVariantPreview();
        });
    });

    addColorBtn.addEventListener('click', function() {
        colorPicker.click();
    });

    colorPicker.addEventListener('input', function() {
        const color = this.value;
        // Check if color already exists
        const exists = colorSelector.querySelector(`.color-swatch[data-color="${color}"]`);
        if (exists) {
            exists.classList.add('selected');
            updateColorInputs();
            updateVariantPreview();
            return;
        }
        // Add new swatch before the + button
        const newSwatch = document.createElement('div');
        newSwatch.className = 'color-swatch selected';
        newSwatch.dataset.color = color;
        newSwatch.style.backgroundColor = color;
        newSwatch.addEventListener('click', function() {
            this.classList.toggle('selected');
            updateColorInputs();
            updateVariantPreview();
        });
        colorSelector.insertBefore(newSwatch, addColorBtn);
        updateColorInputs();
        updateVariantPreview();
    });

    function updateColorInputs() {
        colorInputsContainer.innerHTML = '';
        colorSelector.querySelectorAll('.color-swatch.selected').forEach(swatch => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'colors[]';
            input.value = swatch.dataset.color;
            colorInputsContainer.appendChild(input);
        });
    }


    // ========== DYNAMIC VARIANT PREVIEW ==========
    const stockInput = document.getElementById('productStock');
    const variantPreviewSection = document.getElementById('variantPreviewSection');
    const variantPreviewList = document.getElementById('variantPreviewList');

    function updateVariantPreview() {
        const selectedSizes = Array.from(sizeSelector.querySelectorAll('.size-btn.selected')).map(btn => btn.dataset.size);
        const selectedColors = Array.from(colorSelector.querySelectorAll('.color-swatch.selected')).map(swatch => {
            const color = swatch.dataset.color;
            if (color.startsWith('#')) {
                return matchColorName(color);
            }
            return color;
        });

        function matchColorName(hex) {
            switch(hex.toLowerCase()) {
                case '#ff85d0': return 'Pink';
                case '#38bbef': return 'Blue';
                case '#fdd73b': return 'Yellow';
                default: return 'Custom';
            }
        }

        const activeSizes = selectedSizes.length > 0 ? selectedSizes : ['Default'];
        const activeColors = selectedColors.length > 0 ? selectedColors : ['Default'];

        const totalStock = parseInt(stockInput.value) || 0;
        const totalCount = activeSizes.length * activeColors.length;

        // Hide preview if there are no real selections
        if (totalCount <= 1 && activeSizes[0] === 'Default' && activeColors[0] === 'Default') {
            variantPreviewSection.classList.add('hidden');
            return;
        }

        variantPreviewSection.classList.remove('hidden');
        variantPreviewList.innerHTML = '';

        const baseStock = Math.floor(totalStock / totalCount);
        const remainder = totalStock % totalCount;

        let index = 0;
        activeSizes.forEach(size => {
            activeColors.forEach(color => {
                const stock = index === 0 ? (baseStock + remainder) : baseStock;
                index++;

                const skuSuffix = (size !== 'Default' || color !== 'Default') 
                    ? `-${size.substring(0, 2).toUpperCase()}-${color.substring(0, 3).toUpperCase()}` 
                    : '';

                const card = document.createElement('div');
                card.className = 'flex items-center justify-between p-3 bg-surface-container-low border-2 border-on-background rounded-lg text-xs';
                card.innerHTML = `
                    <div class="flex flex-col">
                        <span class="font-bold">Size: ${size} | Color: ${color}</span>
                        <span class="text-[10px] text-on-surface-variant font-mono">SKU Preview: HV-XXXX${skuSuffix}</span>
                    </div>
                    <span class="bg-primary text-on-primary font-bold px-2 py-1 rounded border border-on-background">${stock} Stock</span>
                `;
                variantPreviewList.appendChild(card);
            });
        });
    }

    // Bind preview listeners
    stockInput.addEventListener('input', updateVariantPreview);


    // ========== FORM SUBMISSION & CLIENT-SIDE VALIDATION ==========
    productForm.addEventListener('submit', function(e) {
        // Validate that image file has been uploaded
        if (!imageInput.files || imageInput.files.length === 0) {
            e.preventDefault();
            imageError.classList.remove('hidden');
            uploadArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            uploadArea.classList.add('border-error');
            setTimeout(() => {
                uploadArea.classList.remove('border-error');
            }, 1000);
            return false;
        }

        // Show cute shimmer loading state on the button
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin mr-2">progress_activity</span> Saving Product...';
        btn.classList.add('btn-loading');
    });


    // ========== INPUT FOCUS EFFECTS ==========
    document.querySelectorAll('.kawaii-input').forEach(input => {
        input.addEventListener('focus', () => {
            if (input.classList.contains('input-error')) return;
            const colors = ['#ff85d0', '#38bbef', '#fdd73b'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            input.style.borderColor = randomColor;
        });
        input.addEventListener('blur', () => {
            if (input.classList.contains('input-error')) return;
            input.style.borderColor = '#1b1c1c';
        });
        // Clear error state on input
        input.addEventListener('input', () => {
            input.classList.remove('input-error');
            input.style.borderColor = '';
        });
    });

    // Initialize variant preview on load
    updateVariantPreview();

});
</script>
@endpush

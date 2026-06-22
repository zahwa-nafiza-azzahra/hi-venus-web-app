@extends('layouts.admin')

@section('title', 'Add Product | Hi Venus')

@push('styles')
<style>
    /* Hide default admin layout pattern to use custom one */
    main > div.absolute.inset-0.z-0 {
        display: none !important;
    }

    /* Remove native number input spinner so our custom +/- stepper looks clean */
    .no-spinner::-webkit-outer-spin-button,
    .no-spinner::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .no-spinner {
        -moz-appearance: textfield;
        appearance: textfield;
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
    
    .img-slide { display: none; }
    .img-slide.active { display: flex; }
    .thumb-dot.active {
        background: #9e357b;
        border-color: #1b1c1c;
        transform: scale(1.2);
    }
    .carousel-arrow {
        transition: all 0.15s;
    }
    .carousel-arrow:hover {
        transform: scale(1.1);
    }
    .carousel-arrow:active {
        transform: scale(0.95);
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-surface-container-low border-2 border-dashed border-on-background rounded-lg relative">
                            <div class="absolute -top-3 left-4 bg-primary text-on-primary px-3 py-1 rounded-full text-xs font-bold border-2 border-on-background comic-shadow-sm rotate-[-2deg]">Variant Editor ✨</div>
                            
                            <!-- Sizes Input -->
                            <div class="flex-1 min-w-[200px]">
                                <label class="font-label-bold text-on-surface-variant mb-2 block">Daftar Ukuran</label>
                                <div class="flex gap-2 mb-2">
                                    <input type="text" id="sizeInput" class="kawaii-input font-body-md flex-1" placeholder="Cth: S, M, XL, 42..." autocomplete="off">
                                    <button type="button" id="addSizeBtn" class="bg-secondary-container text-on-secondary-container border-2 border-on-background px-4 rounded-lg font-bold hover:bg-secondary-container/80 transition-colors">+</button>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-2" id="sizeTagsContainer">
                                    <!-- Size tags will appear here -->
                                </div>
                                <div id="sizeInputs"></div>
                                <p class="text-xs text-on-surface-variant mt-1">Ketik ukuran lalu tekan Enter/Tambah.</p>
                            </div>

                            <!-- Colors Input -->
                            <div class="flex-1 min-w-[200px]">
                                <label class="font-label-bold text-on-surface-variant mb-2 block">Daftar Warna</label>
                                <div class="flex gap-2 mb-2">
                                    <input type="color" id="colorHexInput" class="h-10 w-12 border-2 border-on-background rounded p-0 cursor-pointer" value="#ff85d0">
                                    <input type="text" id="colorNameInput" class="kawaii-input font-body-md flex-1" placeholder="Cth: Pink, Hitam, Merah..." autocomplete="off">
                                    <button type="button" id="addColorBtn" class="bg-secondary-container text-on-secondary-container border-2 border-on-background px-4 rounded-lg font-bold hover:bg-secondary-container/80 transition-colors">+</button>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-2" id="colorTagsContainer">
                                    <!-- Color tags will appear here -->
                                </div>
                                <div id="colorInputs"></div>
                                <p class="text-xs text-on-surface-variant mt-1">Pilih warna, ketik nama, lalu tambah.</p>
                            </div>
                        </div>
                        <p class="text-xs text-on-surface-variant italic mt-2">💡 Tip: Varian produk akan otomatis dibuat berdasarkan kombinasi Ukuran dan Warna yang dimasukkan di atas.</p>
                        
                        <!-- Dynamic Variant Preview Section -->
                        <div class="mt-6 border-t-2 border-dashed border-on-background pt-6 hidden" id="variantPreviewSection">
                            <h4 class="font-label-bold text-md mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-primary font-bold">analytics</span>
                                Stock & Variant Distribution
                            </h4>
                            <p class="text-xs text-on-surface-variant italic mb-3">✏️ Stock per varian dibagi otomatis, tapi kamu bisa edit manual angkanya kalau mau distribusi yang beda.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3" id="variantPreviewList">
                                <!-- Preview cards injected by JS -->
                            </div>
                            <div id="variantStockWarning" class="hidden mt-4 p-3 rounded-lg border-2 border-error bg-error-container text-on-error-container text-xs font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">error</span>
                                <span id="variantStockWarningText"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Image & Actions -->
            <div class="space-y-6">
                <!-- Hidden inputs for multi-slide images -->
                <div id="slide-inputs-container">
                    @for($i = 0; $i < 4; $i++)
                        <input type="file" name="slide_images[{{ $i }}]" id="slide-input-{{ $i }}" class="hidden" accept="image/*" onchange="handleSlideFileChange({{ $i }}, this)">
                        <input type="hidden" name="remove_slides[{{ $i }}]" id="remove-slide-{{ $i }}" value="0">
                        <input type="hidden" name="existing_images[{{ $i }}]" id="existing-slide-{{ $i }}" value="0">
                    @endfor
                </div>

                <!-- Image Upload (Carousel Style) -->
                <div class="kawaii-card p-4 rounded-lg flex flex-col items-center gap-4 text-center">
                    <label class="block font-label-bold text-label-bold text-left w-full mb-1 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">collections</span>
                        Product Images
                        <span class="bg-secondary-container text-on-secondary-container text-[10px] font-bold px-2 py-0.5 rounded-full border-2 border-on-background">up to 4</span>
                    </label>

                    {{-- Main Carousel --}}
                    <div class="relative bg-surface-container-low border-4 border-on-background rounded-lg overflow-hidden aspect-square w-full comic-shadow" id="img-carousel">
                        
                        {{-- Slide 1 --}}
                        <div class="img-slide active absolute inset-0 items-center justify-center animate-fade-in" data-slide="0">
                            <img id="preview-0" alt="Slide 1" class="w-4/5 h-4/5 object-contain rotate-[-3deg] transition-transform hover:rotate-0 duration-300"
                                src="https://placehold.co/400x400/f5d4e8/9e357b?text=Upload+Slide+1"/>
                            <div class="absolute top-4 right-4 bg-tertiary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm rotate-12">MAIN</div>
                        </div>

                        {{-- Slide 2 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center animate-fade-in" data-slide="1">
                            <img id="preview-1" alt="Slide 2" class="w-4/5 h-4/5 object-contain rotate-[2deg] transition-transform hover:rotate-0 duration-300"
                                src="https://placehold.co/400x400/d4e8f5/357b9e?text=Empty+Slide"/>
                            <div class="absolute top-4 right-4 bg-primary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm -rotate-12">SLIDE 2</div>
                        </div>

                        {{-- Slide 3 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center animate-fade-in" data-slide="2">
                            <img id="preview-2" alt="Slide 3" class="w-4/5 h-4/5 object-contain rotate-[-2deg] transition-transform hover:rotate-0 duration-300"
                                src="https://placehold.co/400x400/e8f5d4/7b9e35?text=Empty+Slide"/>
                            <div class="absolute top-4 right-4 bg-secondary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm rotate-6">SLIDE 3</div>
                        </div>

                        {{-- Slide 4 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center animate-fade-in" data-slide="3">
                            <img id="preview-3" alt="Slide 4" class="w-4/5 h-4/5 object-contain rotate-[3deg] transition-transform hover:rotate-0 duration-300"
                                src="https://placehold.co/400x400/f5e8d4/9e7b35?text=Empty+Slide"/>
                            <div class="absolute top-4 right-4 bg-tertiary-fixed border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm -rotate-6">SLIDE 4</div>
                        </div>

                        {{-- Prev Arrow --}}
                        <button type="button" id="prev-btn" onclick="changeSlide(-1)"
                            class="carousel-arrow absolute left-3 top-1/2 -translate-y-1/2 bg-white border-3 border-on-background w-10 h-10 flex items-center justify-center rounded-full comic-shadow-sm z-10">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>

                        {{-- Next Arrow --}}
                        <button type="button" id="next-btn" onclick="changeSlide(1)"
                            class="carousel-arrow absolute right-3 top-1/2 -translate-y-1/2 bg-white border-3 border-on-background w-10 h-10 flex items-center justify-center rounded-full comic-shadow-sm z-10">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>

                        {{-- Slide counter --}}
                        <div class="absolute bottom-3 left-3 bg-black/60 text-white text-[10px] font-bold px-2 py-0.5 rounded-full" id="slide-counter">1 / 4</div>
                    </div>

                    {{-- Dot Indicators --}}
                    <div class="flex justify-center gap-2 mt-1">
                        <button type="button" onclick="goToSlide(0)" class="thumb-dot active w-3 h-3 rounded-full border-2 border-on-background bg-primary transition-all" id="dot-0"></button>
                        <button type="button" onclick="goToSlide(1)" class="thumb-dot w-3 h-3 rounded-full border-2 border-on-background bg-surface-container transition-all" id="dot-1"></button>
                        <button type="button" onclick="goToSlide(2)" class="thumb-dot w-3 h-3 rounded-full border-2 border-on-background bg-surface-container transition-all" id="dot-2"></button>
                        <button type="button" onclick="goToSlide(3)" class="thumb-dot w-3 h-3 rounded-full border-2 border-on-background bg-surface-container transition-all" id="dot-3"></button>
                    </div>

                    {{-- Thumbnail Strip --}}
                    <div class="grid grid-cols-4 gap-2 w-full mt-1">
                        @for($i = 0; $i < 4; $i++)
                        <div onclick="goToSlide({{ $i }})" id="thumb-{{ $i }}"
                            class="cursor-pointer border-4 border-on-background rounded-lg overflow-hidden aspect-square bg-surface-container-low hover:scale-105 transition-transform {{ $i == 0 ? 'ring-4 ring-primary ring-offset-1' : '' }}">
                            <img id="thumb-img-{{ $i }}" class="w-full h-full object-cover" 
                                src="https://placehold.co/100x100/eeeeee/aaaaaa?text={{ $i + 1 }}"
                                alt="Thumbnail {{ $i+1 }}"/>
                        </div>
                        @endfor
                    </div>

                    {{-- Beautiful Custom Error Message for Image --}}
                    <p class="text-error text-sm font-bold w-full text-left flex items-center gap-1 hidden shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] p-2 bg-error-container border-2 border-on-background rounded-lg animate-bounce" id="imageError">
                        <span class="material-symbols-outlined text-sm">error</span> Please upload a primary product image!
                    </p>

                    @error('slide_images.0')<p class="text-error text-sm font-bold w-full text-left flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span> {{ $message }}</p>@enderror

                    {{-- Upload Buttons Row --}}
                    <div class="w-full mt-2">
                        <p class="font-label-bold text-[11px] text-on-surface-variant text-left mb-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">info</span>
                            Select a slide first, then click upload
                        </p>
                        <div class="grid grid-cols-2 gap-3 w-full">
                            <button type="button" onclick="triggerActiveUpload()"
                                class="bg-white border-3 border-on-background p-3 font-label-bold text-sm flex items-center justify-center gap-2 hover:bg-surface-container-high transition-colors active:translate-y-1 cursor-pointer rounded-lg comic-shadow-sm">
                                <span class="material-symbols-outlined text-primary">upload</span>
                                Upload Slide <span id="upload-slot-label">1</span>
                            </button>
                            <button type="button" onclick="removeCurrentSlide()"
                                class="bg-white border-3 border-on-background p-3 font-label-bold text-sm text-error flex items-center justify-center gap-2 hover:bg-error-container transition-colors active:translate-y-1 rounded-lg comic-shadow-sm">
                                <span class="material-symbols-outlined">delete</span>
                                Remove Slide
                            </button>
                        </div>
                    </div>
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

    // ========== MULTI-SLIDE CAROUSEL CONTROLLER ==========
    let currentSlideIndex = 0;
    const totalSlides = 4;
    
    // Default placeholders for empty/removed states
    const placeholders = {
        0: 'https://placehold.co/400x400/f5d4e8/9e357b?text=Upload+Slide+1',
        1: 'https://placehold.co/400x400/d4e8f5/357b9e?text=Empty+Slide',
        2: 'https://placehold.co/400x400/e8f5d4/7b9e35?text=Empty+Slide',
        3: 'https://placehold.co/400x400/f5e8d4/9e7b35?text=Empty+Slide'
    };
    
    const thumbPlaceholders = {
        0: 'https://placehold.co/100x100/eeeeee/aaaaaa?text=1',
        1: 'https://placehold.co/100x100/eeeeee/aaaaaa?text=2',
        2: 'https://placehold.co/100x100/eeeeee/aaaaaa?text=3',
        3: 'https://placehold.co/100x100/eeeeee/aaaaaa?text=4'
    };

    window.goToSlide = function(index) {
        if (index < 0 || index >= totalSlides) return;
        currentSlideIndex = index;
        
        // Update slides visibility
        document.querySelectorAll('.img-slide').forEach((slide, i) => {
            if (i === index) {
                slide.classList.add('active');
                slide.style.display = 'flex';
            } else {
                slide.classList.remove('active');
                slide.style.display = 'none';
            }
        });
        
        // Update Dots
        document.querySelectorAll('.thumb-dot').forEach((dot, i) => {
            if (i === index) {
                dot.classList.add('active');
                dot.style.background = '#9e357b';
            } else {
                dot.classList.remove('active');
                dot.style.background = '';
            }
        });
        
        // Update Thumbnail active highlight
        document.querySelectorAll('[id^="thumb-"]').forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.add('ring-4', 'ring-primary', 'ring-offset-1');
            } else {
                thumb.classList.remove('ring-4', 'ring-primary', 'ring-offset-1');
            }
        });
        
        // Update Slide Counter
        document.getElementById('slide-counter').textContent = `${index + 1} / ${totalSlides}`;
        
        // Update Upload button label text
        document.getElementById('upload-slot-label').textContent = index + 1;
    }

    window.changeSlide = function(direction) {
        let newIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
        goToSlide(newIndex);
    }
    
    window.triggerActiveUpload = function() {
        document.getElementById(`slide-input-${currentSlideIndex}`).click();
    }
    
    window.handleSlideFileChange = function(index, input) {
        const file = input.files[0];
        if (file) {
            // Validate size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('❌ File size is too large! Maximum 5MB.');
                input.value = '';
                return;
            }
            
            // Validate format
            const validFormats = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!validFormats.includes(file.type)) {
                alert('❌ Unsupported format! Use JPG, PNG, or WEBP.');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                // Update Slide Preview
                const previewImg = document.getElementById(`preview-${index}`);
                previewImg.src = e.target.result;
                
                // Update Thumbnail Strip Image
                const thumbImg = document.getElementById(`thumb-img-${index}`);
                thumbImg.src = e.target.result;
                
                // Reset remove flag
                document.getElementById(`remove-slide-${index}`).value = '0';
                
                // Hide custom error if main slide is uploaded
                if (index === 0) {
                    document.getElementById('imageError').classList.add('hidden');
                }
                
                // Add scale haptic-like micro-animation to active slide preview
                previewImg.classList.add('scale-105');
                setTimeout(() => previewImg.classList.remove('scale-105'), 300);
            }
            reader.readAsDataURL(file);
        }
    }
    
    window.removeCurrentSlide = function() {
        // Clear file input
        const fileInput = document.getElementById(`slide-input-${currentSlideIndex}`);
        fileInput.value = '';
        
        // Mark as removed
        document.getElementById(`remove-slide-${currentSlideIndex}`).value = '1';
        document.getElementById(`existing-slide-${currentSlideIndex}`).value = '0';
        
        // Reset previews to default placeholders
        document.getElementById(`preview-${currentSlideIndex}`).src = placeholders[currentSlideIndex];
        document.getElementById(`thumb-img-${currentSlideIndex}`).src = thumbPlaceholders[currentSlideIndex];
        
        // Haptic shake animation on slide removal
        const slideEl = document.querySelector(`.img-slide[data-slide="${currentSlideIndex}"]`);
        if (slideEl) {
            slideEl.classList.add('animate-bounce');
            setTimeout(() => slideEl.classList.remove('animate-bounce'), 500);
        }
    }

    // Initialize slide display
    goToSlide(0);


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


    // ========== SIZE SELECTOR (TAGS) ==========
    const sizeInput = document.getElementById('sizeInput');
    const addSizeBtn = document.getElementById('addSizeBtn');
    const sizeTagsContainer = document.getElementById('sizeTagsContainer');
    const sizeInputsContainer = document.getElementById('sizeInputs');
    let sizesList = []; // store size strings

    function addSize(size) {
        size = size.trim().toUpperCase();
        if(!size || sizesList.includes(size)) return;
        sizesList.push(size);
        renderSizeTags();
        updateVariantPreview();
        sizeInput.value = '';
    }

    function removeSize(size) {
        sizesList = sizesList.filter(s => s !== size);
        renderSizeTags();
        updateVariantPreview();
    }

    function renderSizeTags() {
        sizeTagsContainer.innerHTML = '';
        sizeInputsContainer.innerHTML = '';
        sizesList.forEach(size => {
            // hidden input
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'sizes[]';
            hidden.value = size;
            sizeInputsContainer.appendChild(hidden);

            // ui tag
            const tag = document.createElement('div');
            tag.className = 'flex items-center gap-1 bg-surface-container-high border-2 border-on-background px-3 py-1 rounded-full font-label-bold text-sm';
            tag.innerHTML = `
                ${size}
                <button type="button" class="text-error font-bold ml-1 hover:scale-110">&times;</button>
            `;
            tag.querySelector('button').addEventListener('click', () => removeSize(size));
            sizeTagsContainer.appendChild(tag);
        });
    }

    addSizeBtn.addEventListener('click', () => addSize(sizeInput.value));
    sizeInput.addEventListener('keypress', (e) => {
        if(e.key === 'Enter') { e.preventDefault(); addSize(sizeInput.value); }
    });

    // ========== COLOR SELECTOR (TAGS) ==========
    const colorHexInput = document.getElementById('colorHexInput');
    const colorNameInput = document.getElementById('colorNameInput');
    const addColorBtn = document.getElementById('addColorBtn');
    const colorTagsContainer = document.getElementById('colorTagsContainer');
    const colorInputsContainer = document.getElementById('colorInputs');
    let colorsList = []; // store {name, hex} objects

    function addColor(name, hex) {
        name = name.trim();
        if(!name || colorsList.find(c => c.name.toLowerCase() === name.toLowerCase())) return;
        colorsList.push({name, hex});
        renderColorTags();
        updateVariantPreview();
        colorNameInput.value = '';
    }

    function removeColor(name) {
        colorsList = colorsList.filter(c => c.name !== name);
        renderColorTags();
        updateVariantPreview();
    }

    function renderColorTags() {
        colorTagsContainer.innerHTML = '';
        colorInputsContainer.innerHTML = '';
        colorsList.forEach(color => {
            // hidden input - we pass as a serialized string 'Name|Hex'
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'colors[]';
            hidden.value = color.name + '|' + color.hex;
            colorInputsContainer.appendChild(hidden);

            // ui tag
            const tag = document.createElement('div');
            tag.className = 'flex items-center gap-2 bg-surface-container-high border-2 border-on-background px-3 py-1 rounded-full font-label-bold text-sm';
            tag.innerHTML = `
                <span class="w-3 h-3 rounded-full border border-on-background" style="background-color: ${color.hex}"></span>
                ${color.name}
                <button type="button" class="text-error font-bold ml-1 hover:scale-110">&times;</button>
            `;
            tag.querySelector('button').addEventListener('click', () => removeColor(color.name));
            colorTagsContainer.appendChild(tag);
        });
    }

    addColorBtn.addEventListener('click', () => addColor(colorNameInput.value, colorHexInput.value));
    colorNameInput.addEventListener('keypress', (e) => {
        if(e.key === 'Enter') { e.preventDefault(); addColor(colorNameInput.value, colorHexInput.value); }
    });

    // ========== DYNAMIC VARIANT PREVIEW ==========
    const stockInput = document.getElementById('productStock');
    const variantPreviewSection = document.getElementById('variantPreviewSection');
    const variantPreviewList = document.getElementById('variantPreviewList');
    const variantManualEdits = new Map(); // key: "size|color" -> manually edited stock value

    function updateVariantPreview() {
        const selectedSizes = sizesList;
        const selectedColors = colorsList.map(c => c.name);

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
            variantManualEdits.clear();
            return;
        }

        variantPreviewSection.classList.remove('hidden');

        const baseStock = Math.floor(totalStock / totalCount);
        const remainder = totalStock % totalCount;

        // Build the current set of variant keys so we can prune stale manual edits
        const currentKeys = new Set();

        let index = 0;
        const fragment = document.createDocumentFragment();
        activeSizes.forEach(size => {
            activeColors.forEach(color => {
                const autoStock = index === 0 ? (baseStock + remainder) : baseStock;
                const key = size + '|' + color;
                currentKeys.add(key);
                index++;

                const skuSuffix = (size !== 'Default' || color !== 'Default') 
                    ? `-${size.substring(0, 2).toUpperCase()}-${color.substring(0, 3).toUpperCase()}` 
                    : '';

                // Use manually edited value if the user already touched this variant
                const displayStock = variantManualEdits.has(key) ? variantManualEdits.get(key) : autoStock;

                const card = document.createElement('div');
                card.className = 'flex items-center justify-between p-3 bg-surface-container-low border-2 border-on-background rounded-lg text-xs gap-3';
                card.innerHTML = `
                    <div class="flex flex-col">
                        <span class="font-bold">Size: ${size} | Color: ${color}</span>
                        <span class="text-[10px] text-on-surface-variant font-mono">SKU Preview: HV-XXXX${skuSuffix}</span>
                    </div>
                    <div class="flex items-center border-2 border-on-background rounded-full overflow-hidden bg-primary shrink-0">
                        <button type="button" class="variant-stock-decrement w-7 h-7 flex items-center justify-center text-on-primary font-bold hover:bg-primary-container transition-colors" data-variant-key="${key}">−</button>
                        <input type="number" min="0" inputmode="numeric"
                               class="variant-stock-input no-spinner w-12 text-center font-bold bg-primary text-on-primary border-x-2 border-on-background py-1"
                               data-variant-key="${key}"
                               name="variant_stock_map[${key}]"
                               value="${displayStock}">
                        <button type="button" class="variant-stock-increment w-7 h-7 flex items-center justify-center text-on-primary font-bold hover:bg-primary-container transition-colors" data-variant-key="${key}">+</button>
                    </div>
                `;
                fragment.appendChild(card);
            });
        });

        variantPreviewList.innerHTML = '';
        variantPreviewList.appendChild(fragment);

        // Drop manual edits for variants that no longer exist (size/color was deselected)
        Array.from(variantManualEdits.keys()).forEach(key => {
            if (!currentKeys.has(key)) variantManualEdits.delete(key);
        });

        // Listen for manual edits so future re-renders (e.g. typing total stock) don't overwrite them
        variantPreviewList.querySelectorAll('.variant-stock-input').forEach(input => {
            input.addEventListener('input', () => {
                const key = input.dataset.variantKey;
                const val = parseInt(input.value);
                variantManualEdits.set(key, isNaN(val) ? 0 : val);
                checkVariantStockTotal();
            });
        });

        // +/- stepper buttons
        variantPreviewList.querySelectorAll('.variant-stock-increment, .variant-stock-decrement').forEach(btn => {
            btn.addEventListener('click', () => {
                const key = btn.dataset.variantKey;
                const input = variantPreviewList.querySelector(`.variant-stock-input[data-variant-key="${key}"]`);
                let val = parseInt(input.value) || 0;
                val += btn.classList.contains('variant-stock-increment') ? 1 : -1;
                if (val < 0) val = 0;
                input.value = val;
                variantManualEdits.set(key, val);
                checkVariantStockTotal();
            });
        });

        checkVariantStockTotal();
    }

    // ========== VARIANT STOCK TOTAL VALIDATION ==========
    const variantStockWarning = document.getElementById('variantStockWarning');
    const variantStockWarningText = document.getElementById('variantStockWarningText');

    function checkVariantStockTotal() {
        const inputs = variantPreviewList.querySelectorAll('.variant-stock-input');
        if (inputs.length === 0) {
            variantStockWarning.classList.add('hidden');
            return true;
        }

        let sumVariants = 0;
        inputs.forEach(input => {
            sumVariants += parseInt(input.value) || 0;
        });

        const totalStock = parseInt(stockInput.value) || 0;

        if (sumVariants > totalStock) {
            variantStockWarningText.textContent = `Total stock varian (${sumVariants}) melebihi Stock Quantity (${totalStock})! Selisih: ${sumVariants - totalStock}.`;
            variantStockWarning.classList.remove('hidden');
            return false;
        } else if (sumVariants < totalStock) {
            variantStockWarningText.textContent = `Total stock varian (${sumVariants}) masih kurang dari Stock Quantity (${totalStock}). Sisa: ${totalStock - sumVariants}.`;
            variantStockWarning.classList.remove('hidden');
            return false;
        } else {
            variantStockWarning.classList.add('hidden');
            return true;
        }
    }

    // Bind preview listeners
    stockInput.addEventListener('input', updateVariantPreview);


    // ========== FORM SUBMISSION & CLIENT-SIDE VALIDATION ==========
    productForm.addEventListener('submit', function(e) {
        // Validate that primary slide image (slide-input-0) is uploaded
        const primaryInput = document.getElementById('slide-input-0');
        if (!primaryInput || !primaryInput.files || primaryInput.files.length === 0) {
            e.preventDefault();
            const errEl = document.getElementById('imageError');
            errEl.classList.remove('hidden');
            const carousel = document.getElementById('img-carousel');
            carousel.scrollIntoView({ behavior: 'smooth', block: 'center' });
            carousel.classList.add('border-error');
            setTimeout(() => {
                carousel.classList.remove('border-error');
            }, 1000);
            goToSlide(0);
            return false;
        }

        // Validate that variant stock totals match the declared Stock Quantity
        if (!checkVariantStockTotal()) {
            e.preventDefault();
            variantStockWarning.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
@extends('layouts.admin')

@section('title', 'Edit Product | Hi Venus Admin')

@push('styles')
<style>
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

    .kawaii-grid {
        background-image: 
            linear-gradient(to right, #e5e2e1 1px, transparent 1px),
            linear-gradient(to bottom, #e5e2e1 1px, transparent 1px);
        background-size: 40px 40px;
    }
    .kawaii-stripe {
        background: repeating-linear-gradient(45deg, #f0eded, #f0eded 10px, #fcf9f8 10px, #fcf9f8 20px);
    }
    .comic-shadow {
        box-shadow: 6px 6px 0px 0px rgba(27,28,28,1);
    }
    .comic-shadow-sm {
        box-shadow: 4px 4px 0px 0px rgba(27,28,28,1);
    }
    input:focus, select:focus, textarea:focus {
        outline: none !important;
        border-color: #38bbef !important;
        box-shadow: 0 0 0 4px rgba(56, 187, 239, 0.3) !important;
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
<div class="kawaii-grid -m-margin-desktop p-margin-desktop min-h-screen">
    <!-- Header Actions -->
    <div class="max-w-5xl mx-auto mb-10 flex justify-between items-center animate-fade-in-down">
        <a href="{{ request('return_url') ?: route('admin.products.index') }}" class="flex items-center gap-2 font-label-bold text-on-background bg-white border-4 border-on-background px-6 py-2 rounded-full comic-shadow-sm hover:translate-y-[-2px] active:translate-y-1 active:shadow-none transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
            Back to Inventory
        </a>
        <div class="flex gap-4">
            <span class="bg-tertiary-container text-on-tertiary-container border-2 border-on-background px-4 py-1 font-label-bold text-[12px] rotate-[-2deg] comic-shadow-sm">ID: #HV-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

    <!-- Central Edit Card -->
    <div class="max-w-5xl mx-auto bg-white border-4 border-on-background comic-shadow relative animate-fade-in-up">
        <!-- Decorative Stickers -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-20 h-20 rotate-12 z-20 hidden lg:block animate-float">
            <img alt="Sparkle Sticker" class="w-full h-full drop-shadow-[0_8px_8px_rgba(0,0,0,0.3)] object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAt91q5XOKFc_Ygv2E2IZspunaeVtiSHrgoNgkc110i-xn2Eh_3WpJ8EUv9DOAY0q3hkc4_1DiK_KSactMdfbOtoEA7rqt6ELyfVaFXIrNQZdydWpwMBoI8i5ShijNIxbijU7ra4k8kkorqnnHGSabIviirRUML9dCfNIfBIzEKUqvmZ1hQe0K_Al6z8GLmDuMTHbFKmkIPGs1COLcSBBT6Jvx_v3xg929NQ6uWiTRuE4e-gxXCfhjtvKJtcRqMNFFkac8p31WjKjXZ"/>
        </div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-16 h-16 -rotate-12 z-20 hidden lg:block animate-float" style="animation-delay: 1s;">
            <img alt="Heart Sticker" class="w-full h-full drop-shadow-[0_8px_8px_rgba(0,0,0,0.3)] object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFbVZSb01r8CrWFIfyd8YPyo8nbXu39zJ6JqxrDdg8aXAQ3gmVW62zZgbYnHDucklpVyZa9Oxrd3VU1WIa-NuOGjyVBVaQb5YmkCFX5FiVzRCfxI9uSGuVXRQaC9b1SeZmN8ijTzS5oynzbXryniQrahNzdJKf72-ySotsej2Z4ubPGxB4vQIMVwPd_sdomUXb7Jv8mkp30yYejuAySYpwG0oUXlPAuvhrRY0Tglfh0Lob-1jhmqmK2dLM3fs3hh1xYxF_OhOiqiFO"/>
        </div>

        <!-- Card Header -->
        <div class="border-b-4 border-on-background p-8 bg-secondary-container/20 flex items-center gap-4">
            <div class="bg-primary p-3 rounded-lg border-2 border-on-background rotate-[-3deg]">
                <span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">edit</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg text-on-background">Edit Product Details</h1>
        </div>

        @php
            $slideUrls = [];
            // Slide 0: Primary Image
            $slideUrls[0] = $product->image ? $product->image_url : null;
            // Slide 1-3: Additional Images
            $additional = is_array($product->images) ? $product->images : [];
            for ($i = 1; $i <= 3; $i++) {
                $slideUrls[$i] = isset($additional[$i-1]) ? (str_starts_with($additional[$i-1], 'http') ? $additional[$i-1] : asset('storage/' . $additional[$i-1])) : null;
            }
        @endphp

        <!-- Form Content -->
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="p-8 lg:p-12">
            @csrf
            <input type="hidden" name="return_url" value="{{ request('return_url') }}">
            
            <!-- Hidden inputs for multi-slide images -->
            <div id="slide-inputs-container">
                @for($i = 0; $i < 4; $i++)
                    <input type="file" name="slide_images[{{ $i }}]" id="slide-input-{{ $i }}" class="hidden" accept="image/*" onchange="handleSlideFileChange({{ $i }}, this)">
                    <input type="hidden" name="remove_slides[{{ $i }}]" id="remove-slide-{{ $i }}" value="0">
                    <input type="hidden" name="existing_images[{{ $i }}]" id="existing-slide-{{ $i }}" value="{{ $slideUrls[$i] ? '1' : '0' }}">
                @endfor
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
                <!-- Left Column: Image Carousel -->
                <div class="lg:col-span-5">
                    <label class="block font-label-bold text-label-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">collections</span>
                        Product Images
                        <span class="bg-secondary-container text-on-secondary-container text-[10px] font-bold px-2 py-0.5 rounded-full border-2 border-on-background">up to 4</span>
                    </label>

                    {{-- Main Carousel --}}
                    <div class="relative bg-surface-container-low border-4 border-on-background rounded-lg overflow-hidden aspect-square comic-shadow" id="img-carousel">
                        
                        {{-- Slide 1 (primary image) --}}
                        <div class="img-slide active absolute inset-0 items-center justify-center" data-slide="0">
                            <img id="preview-0" alt="Slide 1" class="w-4/5 h-4/5 object-contain rotate-[-3deg] transition-transform hover:rotate-0 duration-300"
                                src="{{ $slideUrls[0] ?? 'https://placehold.co/400x400/f5d4e8/9e357b?text=No+Image' }}"/>
                            <div class="absolute top-4 right-4 bg-tertiary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm rotate-12">MAIN</div>
                        </div>

                        {{-- Slide 2 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center" data-slide="1">
                            <img id="preview-1" alt="Slide 2" class="w-4/5 h-4/5 object-contain rotate-[2deg] transition-transform hover:rotate-0 duration-300"
                                src="{{ $slideUrls[1] ?? 'https://placehold.co/400x400/d4e8f5/357b9e?text=Empty+Slide' }}"/>
                            <div class="absolute top-4 right-4 bg-primary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm -rotate-12">SLIDE 2</div>
                        </div>

                        {{-- Slide 3 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center" data-slide="2">
                            <img id="preview-2" alt="Slide 3" class="w-4/5 h-4/5 object-contain rotate-[-2deg] transition-transform hover:rotate-0 duration-300"
                                src="{{ $slideUrls[2] ?? 'https://placehold.co/400x400/e8f5d4/7b9e35?text=Empty+Slide' }}"/>
                            <div class="absolute top-4 right-4 bg-secondary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm rotate-6">SLIDE 3</div>
                        </div>

                        {{-- Slide 4 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center" data-slide="3">
                            <img id="preview-3" alt="Slide 4" class="w-4/5 h-4/5 object-contain rotate-[3deg] transition-transform hover:rotate-0 duration-300"
                                src="{{ $slideUrls[3] ?? 'https://placehold.co/400x400/f5e8d4/9e7b35?text=Empty+Slide' }}"/>
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
                    <div class="flex justify-center gap-2 mt-3">
                        <button type="button" onclick="goToSlide(0)" class="thumb-dot active w-3 h-3 rounded-full border-2 border-on-background bg-primary transition-all" id="dot-0"></button>
                        <button type="button" onclick="goToSlide(1)" class="thumb-dot w-3 h-3 rounded-full border-2 border-on-background bg-surface-container transition-all" id="dot-1"></button>
                        <button type="button" onclick="goToSlide(2)" class="thumb-dot w-3 h-3 rounded-full border-2 border-on-background bg-surface-container transition-all" id="dot-2"></button>
                        <button type="button" onclick="goToSlide(3)" class="thumb-dot w-3 h-3 rounded-full border-2 border-on-background bg-surface-container transition-all" id="dot-3"></button>
                    </div>

                    {{-- Thumbnail Strip --}}
                    <div class="grid grid-cols-4 gap-2 mt-3">
                        @for($i = 0; $i < 4; $i++)
                        <div onclick="goToSlide({{ $i }})" id="thumb-{{ $i }}"
                            class="cursor-pointer border-4 border-on-background rounded-lg overflow-hidden aspect-square bg-surface-container-low hover:scale-105 transition-transform {{ $i == 0 ? 'ring-4 ring-primary ring-offset-1' : '' }}">
                            <img id="thumb-img-{{ $i }}" class="w-full h-full object-cover" 
                                src="{{ $slideUrls[$i] ?? 'https://placehold.co/100x100/eeeeee/aaaaaa?text=' . ($i+1) }}"
                                alt="Thumbnail {{ $i+1 }}"/>
                        </div>
                        @endfor
                    </div>

                    {{-- Upload Buttons Row --}}
                    <div class="mt-3">
                        <p class="font-label-bold text-[11px] text-on-surface-variant mb-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">info</span>
                            Click a thumbnail then upload to replace that slide
                        </p>
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" onclick="triggerActiveUpload()"
                                class="bg-white border-3 border-on-background p-3 font-label-bold text-sm flex items-center justify-center gap-2 hover:bg-surface-container-high transition-colors active:translate-y-1 cursor-pointer rounded-lg comic-shadow-sm">
                                <span class="material-symbols-outlined text-primary">upload</span>
                                Upload to Slide <span id="upload-slot-label">1</span>
                            </button>
                            <button type="button" onclick="removeCurrentSlide()"
                                class="bg-white border-3 border-on-background p-3 font-label-bold text-sm text-error flex items-center justify-center gap-2 hover:bg-error-container transition-colors active:translate-y-1 rounded-lg comic-shadow-sm">
                                <span class="material-symbols-outlined">delete</span>
                                Remove Slide
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form Fields -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Product Name -->
                    <div>
                        <label class="block font-label-bold text-label-bold mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">label</span>
                            Product Name
                        </label>
                        <input name="name" class="w-full bg-white border-3 border-on-background p-4 font-body-md rounded-lg comic-shadow-sm focus:shadow-none focus:translate-x-1 focus:translate-y-1 transition-all" type="text" value="{{ old('name', $product->name) }}" required/>
                        @error('name')<p class="mt-1 text-xs text-error font-bold italic">{{ $message }}</p>@enderror
                    </div>

                    <!-- Category & Price Row -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-bold text-label-bold mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">category</span>
                                Category
                            </label>
                            <select name="category_id" class="w-full bg-white border-3 border-on-background p-4 font-body-md rounded-lg comic-shadow-sm appearance-none">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-bold text-label-bold mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">payments</span>
                                Price (Rp)
                            </label>
                            <input name="price" class="w-full bg-white border-3 border-on-background p-4 font-body-md rounded-lg comic-shadow-sm" type="number" value="{{ old('price', $product->price) }}" required/>
                            @error('price')<p class="mt-1 text-xs text-error font-bold italic">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Variants (Size & Color Builder) -->
                    <div class="space-y-4">
                        <label class="block font-label-bold text-label-bold mb-1 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">palette</span>
                            Add Variants 🎨
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-surface-container/60 border-3 border-on-background p-5 rounded-lg">
                            <!-- Sizes -->
                            <div>
                                <p class="font-bold text-sm mb-3 text-on-surface-variant uppercase tracking-wider">Available Sizes</p>
                                <div class="flex flex-wrap gap-2 min-h-[44px]" id="size-tag-container"></div>
                                <div class="flex gap-2 mt-3">
                                    <input type="text" id="new-size-input" placeholder="Add custom size (e.g. XXL)"
                                        onkeydown="if(event.key==='Enter'){event.preventDefault();addSize();}"
                                        class="flex-grow border-2 border-on-background p-2 rounded-lg text-sm font-bold focus:outline-none focus:border-primary bg-white transition-colors">
                                    <button type="button" onclick="addSize()"
                                        class="px-4 py-2 bg-primary text-on-primary border-2 border-on-background rounded-lg text-sm font-bold">+ Add</button>
                                </div>
                            </div>

                            <!-- Colors -->
                            <div>
                                <p class="font-bold text-sm mb-3 text-on-surface-variant uppercase tracking-wider">Color Options</p>
                                <div class="flex flex-wrap gap-3 items-end min-h-[56px]" id="color-circle-container"></div>
                                <div id="color-name-popup" class="hidden mt-3 items-center gap-2">
                                    <div class="w-8 h-8 rounded-full border-2 border-on-background flex-shrink-0" id="color-preview-dot"></div>
                                    <input type="text" id="new-color-name-input" placeholder="Color name (e.g. Mocha)"
                                        onkeydown="if(event.key==='Enter'){event.preventDefault();confirmAddColor();}"
                                        class="flex-grow border-2 border-on-background p-2 rounded-lg text-sm font-bold focus:outline-none focus:border-primary bg-white">
                                    <button type="button" onclick="confirmAddColor()"
                                        class="px-3 py-2 bg-primary text-on-primary border-2 border-on-background rounded-lg text-sm font-bold flex-shrink-0">OK</button>
                                </div>
                            </div>
                        </div>

                        <p class="text-xs bg-amber-50 text-amber-700 border border-amber-200 rounded-lg px-3 py-2 flex items-start gap-2">
                            <span>&#x1F4A1;</span>
                            <em>Tip: Click to toggle sizes and colors. Variants will be created for each combination after saving. Existing stocks are preserved for matching combinations.</em>
                        </p>

                        <!-- Variant Combination Preview -->
                        <div id="variant-preview-section" class="hidden">
                            <div class="flex items-center gap-2 mb-3 border-t-2 border-dashed border-on-background pt-4">
                                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">bar_chart</span>
                                <h4 class="font-bold text-sm">Stock &amp; Variant Distribution Preview</h4>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="variant-preview-grid"></div>
                        </div>

                        <div id="variant-hidden-inputs"></div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-label-bold text-label-bold mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">description</span>
                            Long Description
                        </label>
                        <textarea name="description" class="w-full bg-white border-3 border-on-background p-4 font-body-md rounded-lg comic-shadow-sm" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Toggles -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                        <div class="flex items-center justify-between bg-surface-container border-3 border-on-background p-4 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-label-bold">Featured Product</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" class="sr-only peer" {{ $product->is_featured ? 'checked' : '' }}>
                                <div class="w-14 h-8 bg-surface-container-highest border-2 border-on-background peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-on-background after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary-container"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between bg-surface-container border-3 border-on-background p-4 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">visibility</span>
                                <span class="font-label-bold">Visible in Store</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_visible" class="sr-only peer" {{ $product->is_visible ? 'checked' : '' }}>
                                <div class="w-14 h-8 bg-surface-container-highest border-2 border-on-background peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-on-background after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-secondary-container"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="mt-12 pt-10 border-t-4 border-on-background flex flex-col md:flex-row justify-end gap-6">
                <a href="{{ request('return_url') ?: route('admin.products.index') }}" class="bg-secondary-fixed text-on-secondary-fixed border-4 border-on-background px-10 py-4 font-headline-lg-mobile text-headline-lg-mobile comic-shadow hover:translate-y-[-4px] hover:translate-x-[-2px] hover:shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] transition-all active:translate-y-1 active:shadow-none order-2 md:order-1 text-center">
                    Discard Changes
                </a>
                <button type="submit" class="bg-primary-container text-on-primary-container border-4 border-on-background px-12 py-4 font-headline-lg-mobile text-headline-lg-mobile comic-shadow hover:translate-y-[-4px] hover:translate-x-[-2px] hover:shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] transition-all active:translate-y-1 active:shadow-none order-1 md:order-2 flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">save</span>
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Decorative footer elements -->
    <div class="max-w-5xl mx-auto mt-12 flex justify-center gap-8 opacity-40">
        <span class="material-symbols-outlined text-4xl">auto_awesome</span>
        <span class="material-symbols-outlined text-4xl">pets</span>
        <span class="material-symbols-outlined text-4xl">celebration</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentSlideIndex = 0;
    const totalSlides = 4;
    
    // Default placeholders for empty/removed states
    const placeholders = {
        0: 'https://placehold.co/400x400/f5d4e8/9e357b?text=No+Image',
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

    function goToSlide(index) {
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

    function changeSlide(direction) {
        let newIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
        goToSlide(newIndex);
    }
    
    function triggerActiveUpload() {
        document.getElementById(`slide-input-${currentSlideIndex}`).click();
    }
    
    function handleSlideFileChange(index, input) {
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
                
                // Add scale haptic-like micro-animation to active slide preview
                previewImg.classList.add('scale-105');
                setTimeout(() => previewImg.classList.remove('scale-105'), 300);
            }
            reader.readAsDataURL(file);
        }
    }
    
    function removeCurrentSlide() {
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

    // Form Loading State
    const editForm = document.querySelector('form');
    const submitBtn = editForm.querySelector('button[type="submit"]');
    
    if (editForm && submitBtn) {
        editForm.addEventListener('submit', function(e) {
            // Serialize variant data FIRST (before image check)
            serializeVariantData();

            // Verify at least one image remains
            let hasAtLeastOneImage = false;
            for (let i = 0; i < totalSlides; i++) {
                const fileInput = document.getElementById(`slide-input-${i}`);
                const isRemoved = document.getElementById(`remove-slide-${i}`).value === '1';
                const hasExisting = document.getElementById(`existing-slide-${i}`).value === '1';
                if ((fileInput.files && fileInput.files.length > 0) || (hasExisting && !isRemoved)) {
                    hasAtLeastOneImage = true;
                    break;
                }
            }
            if (!hasAtLeastOneImage) {
                e.preventDefault();
                alert('❌ Product must have at least one image!');
                goToSlide(0);
                return false;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="material-symbols-outlined animate-spin">sync</span>
                Saving...
            `;
            submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    }

    // Success Haptic Feedback (Visual only)
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('scale-[1.01]');
        });
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('scale-[1.01]');
        });
    });
    
    // Initialise slide display
    goToSlide(0);

    // ===== Variant Builder =====
    let selectedSizes  = [];
    let selectedColors = []; // [{name, hex}]
    let variantStocks  = {}; // "size|color" -> stock
    let pendingHex     = null;

    const existingVariants = @json($product->variants);
    const presetSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

    function initVariantBuilder() {
        const sizeSet  = new Set();
        const colorMap = {};
        existingVariants.forEach(v => {
            if (v.size  && v.size  !== 'Default') sizeSet.add(v.size);
            if (v.color && v.color !== 'Default') colorMap[v.color] = v.color_hex || null;
            variantStocks[`${v.size}|${v.color}`] = v.stock;
        });
        selectedSizes  = [...sizeSet];
        selectedColors = Object.entries(colorMap).map(([name, hex]) => ({name, hex}));
        renderSizeTags();
        renderColorCircles();
        renderPreview();
    }

    function renderSizeTags() {
        const c = document.getElementById('size-tag-container');
        if (!c) return;
        let html = '';
        presetSizes.forEach(s => {
            const on = selectedSizes.includes(s);
            html += `<button type="button" onclick="toggleSize('${s}')" data-size="${s}"
                class="px-4 py-2 border-4 border-on-background font-bold rounded-lg text-sm transition-all ${on ? 'bg-primary text-on-primary' : 'bg-white hover:bg-surface-container'}">${s}</button>`;
        });
        selectedSizes.filter(s => !presetSizes.includes(s)).forEach(s => {
            html += `<div class="flex items-center gap-1">
                <span class="px-4 py-2 border-4 border-on-background font-bold rounded-lg text-sm bg-primary text-on-primary">${s}</span>
                <button type="button" onclick="removeSize('${s}')" class="text-error hover:scale-125 transition-transform">
                    <span class="material-symbols-outlined text-base">close</span>
                </button>
            </div>`;
        });
        c.innerHTML = html;
    }

    function renderColorCircles() {
        const c = document.getElementById('color-circle-container');
        if (!c) return;
        let html = '';
        selectedColors.forEach((color, idx) => {
            html += `<div class="relative group flex flex-col items-center gap-1">
                <div class="relative">
                    <div class="w-12 h-12 rounded-full border-4 border-on-background flex items-center justify-center ring-4 ring-primary ring-offset-2"
                        style="background-color:${color.hex || '#ccc'}">
                        <span class="material-symbols-outlined text-white text-lg drop-shadow" style="font-variation-settings:'FILL' 1">check</span>
                    </div>
                    <button type="button" onclick="removeColor(${idx})"
                        class="absolute -top-1 -right-1 w-5 h-5 bg-error text-white rounded-full text-xs hidden group-hover:flex items-center justify-center border-2 border-white leading-none font-bold">&times;</button>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant max-w-[48px] text-center truncate">${color.name}</span>
            </div>`;
        });
        html += `<div class="flex flex-col items-center gap-1">
            <button type="button" onclick="document.getElementById('color-picker-input').click()"
                class="w-12 h-12 rounded-full border-4 border-dotted border-on-background bg-surface-container-high flex items-center justify-center hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-on-surface-variant">add</span>
            </button>
            <span class="text-[10px] font-bold text-on-surface-variant">Tambah</span>
            <input type="color" id="color-picker-input" class="sr-only" onchange="showColorPrompt(this.value)">
        </div>`;
        c.innerHTML = html;
    }

    function renderPreview() {
        const section = document.getElementById('variant-preview-section');
        const grid    = document.getElementById('variant-preview-grid');
        if (!section || !grid) return;
        if (selectedSizes.length === 0 || selectedColors.length === 0) {
            section.classList.add('hidden'); return;
        }
        section.classList.remove('hidden');
        let html = '';
        selectedSizes.forEach(size => {
            selectedColors.forEach(color => {
                const key   = `${size}|${color.name}`;
                const stock = variantStocks[key] ?? 0;
                const sku   = `HV-XXXX-${size.substring(0,2).toUpperCase()}-${color.name.substring(0,3).toUpperCase()}`;
                const inputId = 'stock-input-' + key.replace(/[^a-z0-9]/gi, '-');
                html += `<div class="bg-white border-2 border-on-background rounded-xl p-3 flex flex-col gap-2" style="box-shadow:3px 3px 0 #1b1c1c">
                    <div class="min-w-0">
                        <p class="font-bold text-sm truncate">Size: <span class="text-primary">${size}</span> &middot; Color: <span style="color:${color.hex||'#333'}">${color.name}</span></p>
                        <p class="text-[10px] text-on-surface-variant font-mono mt-0.5 truncate">SKU: ${sku}</p>
                    </div>
                    <div class="flex items-center justify-end">
                        <div class="flex items-center border-2 border-on-background rounded-full overflow-hidden bg-primary">
                            <button type="button" onclick="stepVariantStock('${key}', -1)"
                                class="w-7 h-7 flex items-center justify-center text-on-primary font-bold hover:bg-primary-container transition-colors">&minus;</button>
                            <input type="number" min="0" value="${stock}" data-key="${key}" id="${inputId}"
                                oninput="variantStocks['${key}']=parseInt(this.value)||0"
                                class="no-spinner w-14 text-center font-bold bg-primary text-on-primary border-x-2 border-on-background py-1 focus:outline-none">
                            <button type="button" onclick="stepVariantStock('${key}', 1)"
                                class="w-7 h-7 flex items-center justify-center text-on-primary font-bold hover:bg-primary-container transition-colors">&plus;</button>
                        </div>
                    </div>
                </div>`;
            });
        });
        grid.innerHTML = html;
    }

    function stepVariantStock(key, delta) {
        const current = variantStocks[key] ?? 0;
        const next = Math.max(0, current + delta);
        variantStocks[key] = next;
        const inputId = 'stock-input-' + key.replace(/[^a-z0-9]/gi, '-');
        const input = document.getElementById(inputId);
        if (input) input.value = next;
    }

    function toggleSize(s) {
        selectedSizes.includes(s) ? (selectedSizes = selectedSizes.filter(x => x !== s)) : selectedSizes.push(s);
        renderSizeTags(); renderPreview();
    }
    function removeSize(s) { selectedSizes = selectedSizes.filter(x => x !== s); renderSizeTags(); renderPreview(); }
    function addSize() {
        const inp = document.getElementById('new-size-input');
        const s = inp.value.trim().toUpperCase();
        if (s && !selectedSizes.includes(s)) { selectedSizes.push(s); renderSizeTags(); renderPreview(); }
        inp.value = '';
    }
    function showColorPrompt(hex) {
        pendingHex = hex;
        const dot = document.getElementById('color-preview-dot');
        const pop = document.getElementById('color-name-popup');
        if (dot) dot.style.backgroundColor = hex;
        if (pop) { pop.classList.remove('hidden'); pop.style.display = 'flex'; }
        const inp = document.getElementById('new-color-name-input');
        if (inp) setTimeout(() => inp.focus(), 50);
    }
    function confirmAddColor() {
        const inp = document.getElementById('new-color-name-input');
        const pop = document.getElementById('color-name-popup');
        const name = inp ? inp.value.trim() : '';
        if (name && pendingHex && !selectedColors.some(c => c.name.toLowerCase() === name.toLowerCase())) {
            selectedColors.push({name, hex: pendingHex});
            renderColorCircles(); renderPreview();
        }
        if (pop) { pop.classList.add('hidden'); pop.style.display = ''; }
        if (inp) inp.value = '';
        const picker = document.getElementById('color-picker-input');
        if (picker) picker.value = '#000000';
        pendingHex = null;
    }
    function removeColor(idx) { selectedColors.splice(idx, 1); renderColorCircles(); renderPreview(); }

    function serializeVariantData() {
        // Sync stocks from DOM inputs
        document.querySelectorAll('[data-key]').forEach(inp => {
            variantStocks[inp.dataset.key] = parseInt(inp.value) || 0;
        });
        const c = document.getElementById('variant-hidden-inputs');
        if (!c) return;
        c.innerHTML = '';
        const h = (name, val) => { const el = document.createElement('input'); el.type='hidden'; el.name=name; el.value=val; c.appendChild(el); };
        selectedSizes.forEach(s => h('sizes[]', s));
        selectedColors.forEach(col => { h('color_names[]', col.name); h('color_hexes[]', col.hex || ''); });
        selectedSizes.forEach(s => selectedColors.forEach(col => h(`variant_stock_map[${s}|${col.name}]`, variantStocks[`${s}|${col.name}`] ?? 0)));
    }

    initVariantBuilder();
</script>
@endpush
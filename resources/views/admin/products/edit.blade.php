@extends('layouts.admin')

@section('title', 'Edit Product | Hi Venus Admin')

@push('styles')
<style>
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
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 font-label-bold text-on-background bg-white border-4 border-on-background px-6 py-2 rounded-full comic-shadow-sm hover:translate-y-[-2px] active:translate-y-1 active:shadow-none transition-all">
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

        <!-- Form Content -->
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="p-8 lg:p-12">
            @csrf
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
                                src="{{ $product->image ? $product->image_url : 'https://placehold.co/400x400/f5d4e8/9e357b?text=No+Image' }}"/>
                            <div class="absolute top-4 right-4 bg-tertiary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm rotate-12">MAIN</div>
                        </div>

                        {{-- Slide 2 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center" data-slide="1">
                            <img id="preview-1" alt="Slide 2" class="w-4/5 h-4/5 object-contain rotate-[2deg] transition-transform hover:rotate-0 duration-300"
                                src="https://placehold.co/400x400/d4e8f5/357b9e?text=+"/>
                            <div class="absolute top-4 right-4 bg-primary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm -rotate-12">SLIDE 2</div>
                        </div>

                        {{-- Slide 3 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center" data-slide="2">
                            <img id="preview-2" alt="Slide 3" class="w-4/5 h-4/5 object-contain rotate-[-2deg] transition-transform hover:rotate-0 duration-300"
                                src="https://placehold.co/400x400/e8f5d4/7b9e35?text=+"/>
                            <div class="absolute top-4 right-4 bg-secondary-container border-2 border-on-background px-3 py-1 font-label-bold text-[10px] comic-shadow-sm rotate-6">SLIDE 3</div>
                        </div>

                        {{-- Slide 4 --}}
                        <div class="img-slide absolute inset-0 items-center justify-center" data-slide="3">
                            <img id="preview-3" alt="Slide 4" class="w-4/5 h-4/5 object-contain rotate-[3deg] transition-transform hover:rotate-0 duration-300"
                                src="https://placehold.co/400x400/f5e8d4/9e7b35?text=+"/>
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
                                src="{{ $i == 0 && $product->image ? $product->image_url : 'https://placehold.co/100x100/eeeeee/aaaaaa?text=' . ($i+1) }}"
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
                            <label class="bg-white border-3 border-on-background p-3 font-label-bold text-sm flex items-center justify-center gap-2 hover:bg-surface-container-high transition-colors active:translate-y-1 cursor-pointer rounded-lg comic-shadow-sm">
                                <span class="material-symbols-outlined text-primary">upload</span>
                                Upload to Slide <span id="upload-slot-label">1</span>
                                <input type="file" name="image" id="slide-upload-input" class="hidden" accept="image/*">
                            </label>
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

                    <!-- Stock -->
                    <div>
                        <label class="block font-label-bold text-label-bold mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">inventory_2</span>
                            Stock Quantity
                        </label>
                        <div class="flex items-center gap-4">
                            <input class="w-full bg-white border-3 border-on-background p-4 font-body-md rounded-lg comic-shadow-sm" type="number" value="{{ $product->variants->sum('stock') }}" disabled/>
                            <span class="bg-secondary-container border-2 border-on-background px-4 py-2 font-label-bold whitespace-nowrap">Manage Variants</span>
                        </div>
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
                <a href="{{ route('admin.products.index') }}" class="bg-secondary-fixed text-on-secondary-fixed border-4 border-on-background px-10 py-4 font-headline-lg-mobile text-headline-lg-mobile comic-shadow hover:translate-y-[-4px] hover:translate-x-[-2px] hover:shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] transition-all active:translate-y-1 active:shadow-none order-2 md:order-1 text-center">
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
    // Image Preview Logic
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreview = document.querySelector('.lg\\:col-span-5 img');
    
    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.add('scale-105');
                    setTimeout(() => imagePreview.classList.remove('scale-105'), 300);
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Form Loading State
    const editForm = document.querySelector('form');
    const submitBtn = editForm.querySelector('button[type="submit"]');
    
    if (editForm && submitBtn) {
        editForm.addEventListener('submit', function() {
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
</script>
@endpush

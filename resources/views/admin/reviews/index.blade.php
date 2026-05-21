@extends('layouts.admin')

@section('title', 'Review Moderation | Hi Venus')

@push('styles')
    <style>
        .kawaii-card {
            background: white;
            border: 4px solid #1b1c1c;
            box-shadow: 8px 8px 0px 0px #1b1c1c;
        }

        .sticker-card {
            border: 4px solid #1b1c1c;
            box-shadow: 8px 8px 0px 0px #1b1c1c;
            border-radius: 2rem;
            transition: all 0.2s ease;
        }

        .sticker-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 10px 10px 0px 0px #1b1c1c;
        }

        .btn-press:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px #1b1c1c !important;
        }

        .wonky-border {
            border: 3px solid #1b1c1c;
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
        }

        .sticker-rotate-left { transform: rotate(-2deg); }
        .sticker-rotate-right { transform: rotate(2deg); }

        ::-webkit-scrollbar { width: 12px; }
        ::-webkit-scrollbar-track { background: #fcf9f8; }
        ::-webkit-scrollbar-thumb { background: #9e357b; border: 3px solid #1b1c1c; border-radius: 10px; }
        
        .floating {
            animation: hover 3s ease-in-out infinite;
        }
        @keyframes hover {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#a52a80",
                        "primary-container": "#ff76ce",
                        "secondary": "#5f6132",
                        "secondary-container": "#fdd73b",
                        "tertiary": "#006c52",
                        "tertiary-container": "#38bbef",
                        "surface": "#fcf9f8",
                        "on-surface": "#1b1c1c",
                        "background": "#fcf9f8",
                        "on-background": "#1b1c1c",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "display": ["Comfortaa"],
                        "headline": ["Comfortaa"],
                        "body": ["Quicksand"],
                        "label-bold": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "display": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-lg": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "500"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
@endpush

@section('content')
<div class="animate-fade-in w-full text-on-surface font-body relative">

<!-- MAIN CONTENT -->
<main class="max-w-7xl mx-auto w-full">
<!-- HEADER -->
<div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12 relative">
<div class="relative">
<span class="absolute -top-10 -left-10 text-6xl rotate-[-15deg] animate-bounce">💬</span>
<h2 class="font-display text-display text-on-background leading-none">Review Moderation</h2>
<div class="mt-4 bg-[#FDFFC2] border-4 border-on-background px-6 py-2 rounded-full inline-block shadow-[4px_4px_0px_0px_#1b1c1c]">
<p class="font-body-lg text-primary font-bold">Manage the vibe of your community! ✨</p>
</div>
</div>
<div class="flex gap-6">
<button class="bg-tertiary-container text-on-background border-4 border-on-background p-4 px-8 font-bold rounded-2xl shadow-[8px_8px_0px_0px_#1b1c1c] btn-press transition-colors flex items-center gap-2">
<span class="material-symbols-outlined">done_all</span>
                    Approve All
                </button>
<button class="bg-error-container text-on-background border-4 border-on-background p-4 px-8 font-bold rounded-2xl shadow-[8px_8px_0px_0px_#1b1c1c] btn-press transition-colors flex items-center gap-2">
<span class="material-symbols-outlined">delete_sweep</span>
                    Delete Selected
                </button>
</div>
</div>

<!-- TABS -->
<div class="flex gap-4 mb-12 overflow-x-auto pb-4 no-scrollbar">
<a href="?status=all" class="{{ $status == 'all' ? 'bg-secondary-container shadow-[4px_4px_0px_0px_#1b1c1c]' : 'bg-white hover:bg-[#FDFFC2]' }} text-on-background border-4 border-on-background px-10 py-4 font-bold rounded-full text-lg whitespace-nowrap btn-press transition-colors">
                All ({{ $counts['all'] }})
</a>
<a href="?status=pending" class="{{ $status == 'pending' ? 'bg-secondary-container shadow-[4px_4px_0px_0px_#1b1c1c]' : 'bg-white hover:bg-[#FDFFC2]' }} text-on-background border-4 border-on-background px-10 py-4 font-bold rounded-full text-lg whitespace-nowrap btn-press transition-colors">
                Pending ({{ $counts['pending'] }})
</a>
<a href="?status=approved" class="{{ $status == 'approved' ? 'bg-secondary-container shadow-[4px_4px_0px_0px_#1b1c1c]' : 'bg-white hover:bg-[#94FFD8]' }} text-on-background border-4 border-on-background px-10 py-4 font-bold rounded-full text-lg whitespace-nowrap btn-press transition-colors">
                Approved ({{ $counts['approved'] }})
</a>
<a href="?status=rejected" class="{{ $status == 'rejected' ? 'bg-secondary-container shadow-[4px_4px_0px_0px_#1b1c1c]' : 'bg-white hover:bg-error-container' }} text-on-background border-4 border-on-background px-10 py-4 font-bold rounded-full text-lg whitespace-nowrap btn-press transition-colors">
                Rejected ({{ $counts['rejected'] }})
</a>
</div>

<!-- REVIEWS LIST -->
<div class="grid grid-cols-1 gap-12">
@forelse($reviews as $review)
<div class="sticker-card bg-white p-8 relative flex flex-col md:flex-row gap-8 items-start {{ $review->status == 'rejected' ? 'opacity-70 grayscale' : '' }}">
<!-- Checkbox Sticker -->
<div class="absolute -top-4 -left-4">
<label class="cursor-pointer">
<input class="hidden peer" type="checkbox"/>
<div class="w-12 h-12 bg-white border-4 border-on-background rounded-xl flex items-center justify-center peer-checked:bg-secondary-container transition-all shadow-[4px_4px_0px_0px_#1b1c1c]">
<span class="material-symbols-outlined hidden peer-checked:block text-on-background font-black">check</span>
</div>
</label>
</div>
<!-- Product Thumbnail Sticker -->
<div class="w-full md:w-56 flex-shrink-0">
<div class="bg-[#A3D8FF] wonky-border p-3 shadow-[6px_6px_0px_0px_#1b1c1c] {{ $loop->even ? 'sticker-rotate-left' : 'sticker-rotate-right' }} bg-white">
<div class="rounded-xl overflow-hidden border-2 border-on-background aspect-square">
<img alt="{{ $review->product->name ?? 'Product' }}" class="w-full h-full object-cover" src="{{ optional($review->product)->image_url ?? 'https://via.placeholder.com/300' }}"/>
</div>
<div class="pt-3 text-center">
<p class="font-bold text-xs uppercase tracking-tighter">{{ Str::limit($review->product->name ?? 'Unknown', 15) }}</p>
</div>
</div>
</div>
<!-- Content -->
<div class="flex-1 space-y-4">
<div class="flex flex-wrap justify-between items-start gap-4">
<div>
<h3 class="font-display text-3xl text-primary">{{ $review->user->name ?? 'Anonymous' }}</h3>
<div class="flex gap-1 mt-2 text-secondary-container">
    @for($i=1; $i<=5; $i++)
        @if($i <= $review->rating)
            <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">star</span>
        @else
            <span class="material-symbols-outlined text-4xl text-gray-300">star</span>
        @endif
    @endfor
</div>
</div>
@if($review->status == 'pending')
    <span class="font-bold bg-error-container px-4 py-1 border-2 border-on-background rounded-full text-sm italic">Pending Review</span>
@elseif($review->status == 'approved')
    <span class="font-bold bg-[#94FFD8] px-4 py-1 border-2 border-on-background rounded-full text-sm italic">{{ $review->created_at->diffForHumans() }}</span>
@else
    <span class="font-bold bg-error-container text-error px-4 py-1 border-2 border-on-background rounded-full text-sm italic">Rejected</span>
@endif
</div>
<p class="font-body-lg text-on-background leading-relaxed">
    "{{ $review->comment }}"
</p>
@if($review->image)
<div class="flex gap-4 pt-2">
<div class="w-24 h-24 border-4 border-on-background rounded-2xl overflow-hidden shadow-[4px_4px_0px_0px_#1b1c1c] sticker-rotate-right bg-[#94FFD8]">
<img alt="User review photo" class="w-full h-full object-cover" src="{{ str_starts_with($review->image, 'http') ? $review->image : asset('storage/' . $review->image) }}"/>
</div>
</div>
@endif
</div>
<!-- Actions -->
<div class="w-full md:w-40 flex md:flex-col gap-4">
@if($review->status !== 'approved')
<form action="{{ route('admin.reviews.status', $review->id) }}" method="POST" class="flex-1 flex">
    @csrf
    <input type="hidden" name="status" value="approved">
    <button class="w-full bg-secondary-container border-4 border-on-background p-4 rounded-2xl font-bold shadow-[4px_4px_0px_0px_#1b1c1c] btn-press flex items-center justify-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
        Approve
    </button>
</form>
@endif
@if($review->status !== 'rejected')
<form action="{{ route('admin.reviews.status', $review->id) }}" method="POST" class="flex-1 flex">
    @csrf
    <input type="hidden" name="status" value="rejected">
    <button class="w-full bg-white border-4 border-on-background p-4 rounded-2xl font-bold shadow-[4px_4px_0px_0px_#1b1c1c] btn-press flex items-center justify-center gap-2">
    <span class="material-symbols-outlined">visibility_off</span>
        Hide
    </button>
</form>
@endif
<form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="flex-1 flex">
    @csrf
    @method('DELETE')
    <button class="w-full bg-error-container border-4 border-on-background p-4 rounded-2xl font-bold shadow-[4px_4px_0px_0px_#1b1c1c] btn-press flex items-center justify-center gap-2 text-on-background">
    <span class="material-symbols-outlined">delete</span>
        Delete
    </button>
</form>
</div>
</div>
@empty
<div class="text-center p-10 bg-white sticker-card">
    <span class="text-4xl">📭</span>
    <p class="font-bold mt-4 text-xl">No reviews found!</p>
</div>
@endforelse
</div>

<!-- PAGINATION STICKER -->
<div class="mt-20 flex justify-center">
    {{ $reviews->links('pagination::tailwind') }}
</div>

</main>
<!-- FLOATING DECORATIVE ELEMENTS -->
<div class="fixed top-24 right-10 pointer-events-none select-none floating hidden xl:block z-0">
<span class="text-7xl drop-shadow-xl">💖</span>
</div>
<div class="fixed bottom-20 left-80 pointer-events-none select-none floating hidden xl:block z-0" style="animation-delay: -1s;">
<span class="text-7xl drop-shadow-xl">⭐</span>
</div>

</div>
@endsection

@push('scripts')
<script>
    // Interaction effects
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.sticker-card');
            if (this.checked) {
                card.style.borderColor = '#a52a80';
                card.style.boxShadow = '12px 12px 0px 0px #a52a80';
            } else {
                card.style.borderColor = '#1b1c1c';
                card.style.boxShadow = '8px 8px 0px 0px #1b1c1c';
            }
        });
    });
</script>
@endpush

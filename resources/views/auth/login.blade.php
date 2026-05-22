@extends('layouts.app')

@section('title', 'Login | Hi Venus')

@section('body_class', 'pattern-bg')

@push('styles')
<style>
    /* Custom Utilities for Maximalist Overlays */
    .pattern-bg {
        background-image: 
            radial-gradient(rgba(27,28,28,0.2) 3px, transparent 3px),
            linear-gradient(135deg, theme('colors.primary-container'), theme('colors.secondary-container'), theme('colors.tertiary-container'));
        background-size: 24px 24px, auto;
        background-attachment: fixed;
    }
    .scalloped-accent::before {
        content: '';
        position: absolute;
        inset: -12px;
        background-color: theme('colors.secondary-container');
        border-radius: theme('borderRadius.xl');
        z-index: -1;
        border: 4px solid theme('colors.on-background');
    }
</style>
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center p-margin-mobile md:p-margin-desktop relative overflow-hidden font-body-md text-on-background">
    <!-- Decorative Corner Elements -->
    <img class="absolute -top-12 -left-12 w-64 h-64 object-cover rounded-full border-4 border-on-background rotate-12 drop-shadow-[8px_8px_0px_rgba(27,28,28,1)] hidden lg:block z-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWIJNXPpYS9z0xzpZm8Q8xXObgHZwI7OV6I4nfiEVBoOG2Jh4f86es-3rcYpc4INUJP0j3vtsvz8TUqAeAo25Nh8yszoX3JMTA0ludvzVUfp8Ab6-de0n4_W3dHkgi98B6x4iXtvqr8CLkbA2bg4PuOLLVX81N_y4ztmychZsc1g16UGLVHfaz9qRnNETNb8GjioqSNUvIILCSXVqNvc_Uq4LNvRhVQSPaE_cWqXItCR4-HKl88QPc7HUIES0RKeuQDdH9tsK7_ILn" alt="Teddy Bear Illustration"/>
    <img class="absolute -bottom-16 -right-16 w-72 h-72 object-cover rounded-full border-4 border-on-background -rotate-12 drop-shadow-[8px_8px_0px_rgba(27,28,28,1)] hidden lg:block z-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnizOCZvQc3VMroMkdI4kf46_O_fwdojboqhdSbNXP8fOhN6DeeNqgZ2bnt3FPQw4_JppPeSK9cSUNY4WA8pBOmwtnDurdGWl7qorael0utya1pmFsHifgO1RJudNDid2nuD2Xx-ACRshRyrvzThyP2wGbOGP8mu8nckoXJP2Nk_DpAU0Uu7l9WQn77FhFjPkx0j5IUL1V-gbMZpwyuTh4Y_HrFjjluR-DqgEURKxHPA0f-_qlkHJ8ShXNf85ZtwZhZxpO2mEVU4yM" alt="Potted Plant Illustration"/>
    
    <!-- Floating Kawaii Icons -->
    <div class="absolute top-24 left-1/4 animate-[bounce_3s_infinite] drop-shadow-[6px_6px_0px_rgba(27,28,28,1)] z-0 hidden md:block">
        <span class="material-symbols-outlined text-8xl text-surface-bright" style="font-variation-settings: 'FILL' 1;">favorite</span>
    </div>
    <div class="absolute bottom-32 left-[30%] animate-[pulse_2s_infinite] drop-shadow-[6px_6px_0px_rgba(27,28,28,1)] z-0 hidden md:block">
        <span class="material-symbols-outlined text-7xl text-secondary-container" style="font-variation-settings: 'FILL' 1;">stars</span>
    </div>
    <div class="absolute top-1/3 right-1/4 animate-[bounce_4s_infinite] drop-shadow-[6px_6px_0px_rgba(27,28,28,1)] z-0 hidden md:block">
        <span class="material-symbols-outlined text-[100px] text-tertiary-container" style="font-variation-settings: 'FILL' 1;">pets</span>
    </div>
    <div class="absolute bottom-1/4 right-[20%] animate-[pulse_3s_infinite] drop-shadow-[6px_6px_0px_rgba(27,28,28,1)] z-0 hidden md:block">
        <span class="material-symbols-outlined text-6xl text-primary" style="font-variation-settings: 'FILL' 1;">favorite</span>
    </div>
    <div class="absolute top-[60%] left-16 animate-[bounce_5s_infinite] drop-shadow-[6px_6px_0px_rgba(27,28,28,1)] z-0 hidden md:block">
        <span class="material-symbols-outlined text-7xl text-inverse-primary" style="font-variation-settings: 'FILL' 1;">stars</span>
    </div>

    <!-- Main Card -->
    <div class="relative w-full max-w-lg z-10">
        <!-- Scalloped/Colorful underlay illusion -->
        <div class="scalloped-accent"></div>
        <div class="bg-surface-bright border-4 border-on-background rounded-xl p-8 relative flex flex-col gap-8 shadow-[12px_12px_0px_0px_rgba(27,28,28,1)]">
            <!-- Stickers -->
            <div class="absolute -top-8 -right-6 bg-tertiary-container border-4 border-on-background rounded-full w-16 h-16 flex items-center justify-center rotate-12 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                <span class="material-symbols-outlined text-on-background text-3xl" style="font-variation-settings: 'FILL' 1;">stars</span>
            </div>
            <div class="absolute -bottom-6 -left-6 bg-primary-container border-4 border-on-background rounded-full w-14 h-14 flex items-center justify-center -rotate-12 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                <span class="material-symbols-outlined text-on-background text-2xl" style="font-variation-settings: 'FILL' 1;">favorite</span>
            </div>

            <!-- Header -->
            <div class="text-center">
                <h1 class="font-headline-xl text-headline-xl text-primary italic">Hi Venus</h1>
                <p class="font-label-bold text-label-bold text-on-surface-variant mt-2 tracking-wide uppercase">Join the Kawaii Club</p>
            </div>

            <!-- Tabs -->
            <div class="flex gap-4 p-2 bg-surface-container-highest border-4 border-on-background rounded-lg">
                <button class="flex-1 font-label-bold text-label-bold text-on-background bg-secondary-container border-4 border-on-background rounded p-3 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] transform translate-y-0.5 translate-x-0.5">
                    Log In
                </button>
                <a href="{{ route('register') }}" class="flex-1 font-label-bold text-label-bold text-on-surface hover:bg-surface-variant rounded p-3 transition-colors text-center block">
                    Register
                </a>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
                @csrf
                <!-- Input: Login ID -->
                <div class="flex flex-col gap-2">
                    <label class="font-label-bold text-label-bold text-on-background flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">person</span>
                        Email Address or Username
                    </label>
                    <input name="login_id" class="w-full bg-surface-bright px-4 py-4 border-4 border-on-background rounded-lg font-body-md text-body-md focus:outline-none focus:border-tertiary-container focus:ring-0 shadow-[inset_0px_6px_0px_0px_rgba(27,28,28,0.08)] transition-colors placeholder:text-outline" placeholder="hello@hivenus.com or username" type="text" value="{{ old('login_id') }}" required autofocus/>
                    @error('login_id')
                        <p class="text-error text-xs font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input: Password -->
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <label class="font-label-bold text-label-bold text-on-background flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">lock</span>
                            Password
                        </label>
                        @if (Route::has('password.request'))
                            <a class="font-label-bold text-label-bold text-primary hover:underline decoration-4 underline-offset-4" href="{{ route('password.request') }}">Forgot?</a>
                        @endif
                    </div>
                    <input name="password" class="w-full bg-surface-bright px-4 py-4 border-4 border-on-background rounded-lg font-body-md text-body-md focus:outline-none focus:border-tertiary-container focus:ring-0 shadow-[inset_0px_6px_0px_0px_rgba(27,28,28,0.08)] transition-colors placeholder:text-outline" placeholder="••••••••" type="password" required/>
                </div>

                <!-- Custom Checkbox -->
                <div class="flex items-center gap-4 mt-2">
                    <label class="relative flex items-center cursor-pointer group">
                        <input name="remember" class="peer sr-only" type="checkbox"/>
                        <div class="w-8 h-8 border-4 border-on-background rounded bg-surface-bright peer-checked:bg-secondary-fixed transition-colors shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] group-hover:bg-surface-variant flex items-center justify-center">
                            <span class="material-symbols-outlined opacity-0 peer-checked:opacity-100 text-on-background text-xl font-bold" style="font-variation-settings: 'FILL' 1;">sentiment_satisfied</span>
                        </div>
                    </label>
                    <span class="font-label-bold text-label-bold text-on-background">Remember my vibes</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="mt-4 w-full bg-primary text-on-primary font-headline-lg-mobile text-headline-lg-mobile py-4 border-4 border-on-background rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] active:translate-y-[8px] active:translate-x-[8px] active:shadow-none transition-all flex items-center justify-center gap-3 group relative overflow-hidden">
                    <span class="relative z-10">Let's Go!</span>
                    <span class="material-symbols-outlined text-3xl relative z-10 group-hover:rotate-12 transition-transform" style="font-variation-settings: 'FILL' 1;">pets</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

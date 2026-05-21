@extends('layouts.app')

@section('title', 'Manajemen Profil - Hi Venus')

@section('body_class', 'grid-pattern')

@push('styles')
<style>
    .grid-pattern {
        background-color: #fcf9f8;
        background-image: radial-gradient(#c1e8ff 2px, transparent 2px);
        background-size: 32px 32px;
    }
    .sticker-rotate-right { transform: rotate(3deg); }
    .sticker-rotate-left { transform: rotate(-3deg); }
    .comic-border { border: 4px solid #1b1c1c; }
    .comic-shadow { box-shadow: 8px 8px 0px 0px rgba(27,28,28,1); }
</style>
@endpush

@section('content')
{{-- Use a div instead of nested main to avoid layout issues --}}
<div class="max-w-7xl mx-auto p-margin-mobile md:p-margin-desktop relative z-10">
    <header class="mb-12 flex justify-between items-end animate-fade-in-down">
        <div>
            <h2 class="font-headline-xl text-headline-xl text-primary sticker-rotate-left inline-block bg-white px-6 py-2 border-4 border-on-background shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">Manajemen Profil</h2>
            <p class="font-body-lg text-body-lg mt-4 text-on-surface-variant italic">Kelola identitas kawaimu di sini! ✨</p>
        </div>
        <div class="hidden lg:block animate-bounce">
            <span class="material-symbols-outlined text-[64px] text-tertiary-container">auto_awesome</span>
        </div>
    </header>

    @include('components.flash-messages')

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
        <!-- Form Edit Profil Section -->
        <section class="col-span-12 lg:col-span-7 space-y-gutter animate-fade-in-left">
            <div class="bg-white border-4 border-on-background p-8 shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
                <!-- Decorative Sparkle -->
                <span class="absolute -top-4 -right-4 material-symbols-outlined text-secondary-container text-6xl opacity-30">star</span>
                <h3 class="font-headline-lg text-headline-lg mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined">person_edit</span>
                    Informasi Dasar
                </h3>
                
                <form action="{{ route('settings.profile') }}" method="POST" class="space-y-8">
                    @csrf
                    <!-- Profile Photo -->
                    <div class="flex items-center gap-8 group">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full border-4 border-on-background overflow-hidden sticker-rotate-right bg-primary-fixed shrink-0 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                                <img id="avatar-preview" src="{{ auth()->user()->avatar ? auth()->user()->avatar_url : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.auth()->user()->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <label for="user-avatar-upload" class="absolute -bottom-2 -right-2 bg-secondary-container border-2 border-on-background w-10 h-10 rounded-full flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] cursor-pointer hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-sm">camera_alt</span>
                            </label>
                        </div>
                        <div class="space-y-2">
                            <p class="font-label-bold text-on-surface">Foto Profil</p>
                            <p class="text-[12px] text-on-surface-variant">Klik ikon kamera untuk mengganti foto.</p>
                        </div>
                    </div>

                    <!-- Inputs -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="font-label-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">badge</span>
                                Nama Lengkap
                            </label>
                            <input name="name" class="w-full border-4 border-on-background p-4 rounded-xl font-body-md focus:border-primary focus:ring-4 focus:ring-primary-fixed shadow-[inset_0_2px_4px_rgba(0,0,0,0.1)] outline-none transition-all" type="text" value="{{ old('name', auth()->user()->name) }}" required/>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">email</span>
                                Alamat Email
                            </label>
                            <input name="email" class="w-full border-4 border-on-background p-4 rounded-xl font-body-md focus:border-primary focus:ring-4 focus:ring-primary-fixed shadow-[inset_0_2px_4px_rgba(0,0,0,0.1)] outline-none transition-all" type="email" value="{{ old('email', auth()->user()->email) }}" required/>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">phone_iphone</span>
                                Nomor HP
                            </label>
                            <input name="phone" class="w-full border-4 border-on-background p-4 rounded-xl font-body-md focus:border-primary focus:ring-4 focus:ring-primary-fixed shadow-[inset_0_2px_4px_rgba(0,0,0,0.1)] outline-none transition-all" type="tel" value="{{ old('phone', auth()->user()->phone) }}"/>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-primary text-on-primary border-4 border-on-background px-10 py-4 rounded-2xl font-headline-lg shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center gap-4 group">
                            <span class="material-symbols-outlined group-hover:rotate-12 transition-transform">save</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Ubah Password Section -->
        <aside class="col-span-12 lg:col-span-5 space-y-gutter animate-fade-in-right">
            <div class="bg-tertiary-fixed border-4 border-on-background p-8 shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] sticker-rotate-right relative">
                <!-- Ribbon Label -->
                <div class="absolute -top-4 left-6 bg-secondary text-on-secondary border-3 border-on-background px-4 py-1 font-label-bold -rotate-2 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    Privasi & Keamanan
                </div>
                <h3 class="font-headline-lg text-headline-lg mb-8 mt-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">lock_reset</span>
                    Ubah Password
                </h3>
                <form action="{{ route('settings.password') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="font-label-bold">Password Lama</label>
                        <input name="current_password" class="w-full border-3 border-on-background p-4 rounded-xl font-body-md focus:border-primary focus:ring-4 focus:ring-primary-fixed shadow-[inset_0_2px_4px_rgba(0,0,0,0.1)]" placeholder="••••••••" type="password" required/>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-bold">Password Baru</label>
                        <input name="password" class="w-full border-3 border-on-background p-4 rounded-xl font-body-md focus:border-primary focus:ring-4 focus:ring-primary-fixed shadow-[inset_0_2px_4px_rgba(0,0,0,0.1)]" placeholder="••••••••" type="password" required/>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-bold">Konfirmasi Password Baru</label>
                        <input name="password_confirmation" class="w-full border-3 border-on-background p-4 rounded-xl font-body-md focus:border-primary focus:ring-4 focus:ring-primary-fixed shadow-[inset_0_2px_4px_rgba(0,0,0,0.1)]" placeholder="••••••••" type="password" required/>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-white border-3 border-on-background py-4 rounded-xl font-label-bold text-on-background hover:bg-on-background hover:text-white transition-all active:scale-95 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none">
                            Update Password 🔐
                        </button>
                    </div>
                </form>
            </div>

            <!-- Decorative Bento Elements -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-secondary-container border-4 border-on-background p-6 aspect-square flex flex-col items-center justify-center text-center sticker-rotate-left shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] animate-float">
                    <span class="material-symbols-outlined text-4xl mb-2">verified_user</span>
                    <p class="font-label-bold leading-tight">Akun<br>Terverifikasi</p>
                </div>
                <div class="bg-primary-fixed border-4 border-on-background p-6 aspect-square flex flex-col items-center justify-center text-center sticker-rotate-right shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] animate-float" style="animation-delay: 0.5s;">
                    <span class="material-symbols-outlined text-4xl mb-2">favorite</span>
                    <p class="font-label-bold leading-tight">Loyalitas<br>Venus</p>
                    <p class="text-[12px] mt-1 font-bold">Level 5</p>
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- Hidden Avatar Form -->
<form id="user-avatar-form" action="{{ route('settings.avatar') }}" method="POST" enctype="multipart/form-data" class="hidden">
    @csrf
    <input id="user-avatar-upload" type="file" name="avatar" onchange="document.getElementById('user-avatar-form').submit()">
</form>
@endsection

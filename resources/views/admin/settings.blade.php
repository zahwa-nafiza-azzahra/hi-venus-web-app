@extends('layouts.admin')

@section('title', 'Manajemen Profil | Hi Venus Admin')

@section('body_class', 'grid-pattern')

@push('styles')
<style>
    /* Override layout pattern */
    main > div.absolute.inset-0 { display: none !important; }
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
<div class="animate-fade-in">
    <!-- Header -->
    <header class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-end gap-6 relative">
        <div class="relative z-10">
            <div class="inline-block bg-white px-6 py-2 border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] rounded-2xl -rotate-1">
                <h2 class="font-headline-xl text-headline-xl text-primary">Manajemen Profil</h2>
            </div>
            <p class="font-body-lg text-body-lg mt-6 text-on-surface-variant font-bold italic flex items-center gap-2">
                <span class="material-symbols-outlined text-primary animate-pulse">sparkle</span>
                Kelola identitas kawaimu di sini! ✨
            </p>
        </div>
        <div class="hidden lg:block animate-float relative">
            <span class="material-symbols-outlined text-[80px] text-secondary-container drop-shadow-[4px_4px_0px_#1b1c1c]">auto_awesome</span>
        </div>
    </header>

    @include('components.flash-messages')

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mt-8">
        <!-- Form Edit Profil Section -->
        <section class="lg:col-span-7">
            <div class="bg-white border-4 border-on-background p-8 md:p-10 rounded-3xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden h-full">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-5 pointer-events-none bg-[radial-gradient(#9e357b_2px,transparent_2px)] [background-size:20px_20px]"></div>
                
                <h3 class="font-headline-lg text-headline-lg mb-10 flex items-center gap-4 relative">
                    <div class="w-12 h-12 bg-primary text-on-primary rounded-full flex items-center justify-center border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <span class="material-symbols-outlined">person_edit</span>
                    </div>
                    Informasi Dasar
                </h3>
                
                <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-8 relative">
                    @csrf
                    <!-- Profile Photo -->
                    <div class="flex flex-col sm:flex-row items-center gap-8 p-6 bg-surface-container-lowest border-4 border-on-background rounded-2xl border-dashed">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full border-4 border-on-background overflow-hidden bg-primary-fixed shrink-0 shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
                                <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.auth()->user()->name }}" class="w-full h-full object-cover">
                            </div>
                            <label for="avatar-upload" class="absolute -bottom-2 -right-2 bg-secondary-container border-4 border-on-background w-10 h-10 rounded-full flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] cursor-pointer hover:scale-110 transition-all">
                                <span class="material-symbols-outlined text-lg">camera_alt</span>
                            </label>
                        </div>
                        <div class="space-y-2 text-center sm:text-left">
                            <p class="font-black text-on-surface uppercase tracking-widest text-xs italic">Foto Profil Admin ✨</p>
                            <button type="button" onclick="document.getElementById('avatar-upload').click()" class="text-primary font-black underline underline-offset-4 hover:text-on-primary-fixed-variant transition-colors text-xs uppercase tracking-widest">Ganti Foto</button>
                        </div>
                    </div>

                    <!-- Inputs -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="font-black text-on-surface uppercase tracking-widest text-[10px] ml-2">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">badge</span>
                                <input name="name" class="w-full border-4 border-on-background p-4 pl-12 rounded-xl font-bold italic focus:border-primary focus:ring-0 shadow-[4px_4px_0px_0px_rgba(27,28,28,0.05)] outline-none transition-all bg-surface-bright" type="text" value="{{ old('name', auth()->user()->name) }}" required/>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-black text-on-surface uppercase tracking-widest text-[10px] ml-2">Alamat Email</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">email</span>
                                <input name="email" class="w-full border-4 border-on-background p-4 pl-12 rounded-xl font-bold italic focus:border-primary focus:ring-0 shadow-[4px_4px_0px_0px_rgba(27,28,28,0.05)] outline-none transition-all bg-surface-bright" type="email" value="{{ old('email', auth()->user()->email) }}" required/>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-black text-on-surface uppercase tracking-widest text-[10px] ml-2">Nomor HP</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">phone_iphone</span>
                                <input name="phone" class="w-full border-4 border-on-background p-4 pl-12 rounded-xl font-bold italic focus:border-primary focus:ring-0 shadow-[4px_4px_0px_0px_rgba(27,28,28,0.05)] outline-none transition-all bg-surface-bright" type="tel" value="{{ old('phone', auth()->user()->phone) }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-primary text-on-primary border-4 border-on-background px-10 py-4 rounded-2xl font-headline-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none active:scale-95 transition-all flex items-center gap-3 group">
                            <span class="material-symbols-outlined group-hover:rotate-12 transition-transform" style="font-variation-settings: 'FILL' 1;">save</span>
                            Simpan Profil 💖
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Ubah Password Section -->
        <aside class="lg:col-span-5 flex flex-col gap-10">
            <div class="bg-tertiary-fixed border-4 border-on-background p-8 md:p-10 rounded-3xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
                <!-- Decorative Icon -->
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-white/20 rounded-full flex items-center justify-center rotate-12">
                    <span class="material-symbols-outlined text-white text-6xl opacity-30">lock</span>
                </div>

                <h3 class="font-headline-lg text-headline-lg mb-8 flex items-center gap-3 relative">
                    <span class="material-symbols-outlined text-primary">key</span>
                    Ubah Password
                </h3>
                
                <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-6 relative">
                    @csrf
                    <div class="space-y-2">
                        <label class="font-black text-[10px] uppercase tracking-widest text-on-tertiary-fixed-variant ml-2">Password Lama</label>
                        <input name="current_password" class="w-full border-4 border-on-background p-4 rounded-xl font-bold focus:border-primary focus:ring-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)] bg-white" placeholder="••••••••" type="password" required/>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-[10px] uppercase tracking-widest text-on-tertiary-fixed-variant ml-2">Password Baru</label>
                        <input name="password" class="w-full border-4 border-on-background p-4 rounded-xl font-bold focus:border-primary focus:ring-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)] bg-white" placeholder="••••••••" type="password" required/>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-[10px] uppercase tracking-widest text-on-tertiary-fixed-variant ml-2">Konfirmasi Password Baru</label>
                        <input name="password_confirmation" class="w-full border-4 border-on-background p-4 rounded-xl font-bold focus:border-primary focus:ring-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)] bg-white" placeholder="••••••••" type="password" required/>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-on-background text-white border-4 border-on-background py-4 rounded-2xl font-headline-lg shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)] hover:translate-y-1 hover:shadow-none transition-all active:scale-95 flex items-center justify-center gap-2">
                            Update Kunci <span class="material-symbols-outlined">lock_open</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Decorative Bento Elements -->
            <div class="grid grid-cols-2 gap-6 flex-grow">
                <div class="bg-secondary-container border-4 border-on-background p-6 rounded-3xl flex flex-col items-center justify-center text-center shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:-rotate-2 transition-transform">
                    <div class="w-14 h-14 bg-white border-4 border-on-background rounded-full flex items-center justify-center mb-4 shadow-[4px_4px_0px_0px_#1b1c1c]">
                        <span class="material-symbols-outlined text-3xl text-primary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    </div>
                    <p class="font-headline-lg text-base leading-tight italic">Admin<br>Verified</p>
                </div>
                <div class="bg-primary-fixed border-4 border-on-background p-6 rounded-3xl flex flex-col items-center justify-center text-center shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:rotate-2 transition-transform">
                    <div class="w-14 h-14 bg-white border-4 border-on-background rounded-full flex items-center justify-center mb-4 shadow-[4px_4px_0px_0px_#1b1c1c]">
                        <span class="material-symbols-outlined text-3xl text-primary" style="font-variation-settings: 'FILL' 1;">favorite</span>
                    </div>
                    <p class="font-headline-lg text-base leading-tight italic">Venus<br>Spirit</p>
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- Hidden Avatar Form -->
<form id="avatar-form" action="{{ route('admin.settings.avatar') }}" method="POST" enctype="multipart/form-data" class="hidden">
    @csrf
    <input id="avatar-upload" type="file" name="avatar" onchange="document.getElementById('avatar-form').submit()">
</form>
@endsection

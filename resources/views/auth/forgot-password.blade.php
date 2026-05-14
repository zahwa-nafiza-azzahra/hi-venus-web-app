<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Lupa Password | Hi Venus</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=Fredoka:wght@500;600;700&family=Nunito:wght@400;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-background text-on-background font-sans flex items-center justify-center p-4">
    <main class="max-w-xl bg-surface p-7 md:p-12 text-center">
        <a href="{{ route('home') }}" class="mx-auto mb-7 inline-flex items-center gap-2 text-primary">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1;">favorite</span>
            <span class="font-display text-3xl">Hi Venus</span>
        </a>

        <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-2xl border-4 border-white bg-primary-fixed text-primary">
            <span class="material-symbols-outlined text-3xl">key</span>
        </div>

        <h1 class="bubble-title text-[3rem] md:text-[4rem]">Lupa Password?</h1>
        <p class="mx-auto mb-7 mt-2 max-w-sm text-sm font-bold text-on-surface-variant">Masukkan email akun Hi Venus, nanti kami kirim link reset password.</p>

        @if(session('status'))
        <div class="mb-5 rounded-2xl border-2 border-white bg-primary-fixed p-4 text-sm font-bold text-primary">
            {{ session('status') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-5 rounded-2xl border-2 border-white bg-error-container p-4 text-sm font-bold text-on-error-container">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5 text-left">
            @csrf
            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase text-on-surface-variant">Email</span>
                <span class="relative block">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary">mail</span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus class="w-full rounded-2xl border-2 border-white bg-surface-container-low py-4 pl-12 pr-4 text-sm font-bold text-on-surface focus:ring-2 focus:ring-primary/30">
                </span>
            </label>

            <button type="submit" class="candy-button w-full px-6 py-4">
                Kirim Link Reset
                <span class="material-symbols-outlined text-lg">send</span>
            </button>
        </form>

        <a href="{{ route('login') }}" class="mt-6 inline-flex items-center gap-1 text-xs font-black uppercase text-on-surface-variant hover:text-primary">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali Login
        </a>
    </main>
</body>
</html>


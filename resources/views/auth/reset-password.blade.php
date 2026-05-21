<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Reset Password | Hi Venus</title>
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
            <span class="material-symbols-outlined text-3xl">lock_reset</span>
        </div>

        <h1 class="bubble-title text-[3rem] md:text-[4rem]">Reset Password</h1>
        <p class="mx-auto mb-7 mt-2 max-w-sm text-sm font-bold text-on-surface-variant">Buat password baru untuk akun Hi Venus Anda.</p>

        @if($errors->any())
        <div class="mb-5 rounded-2xl border-2 border-white bg-error-container p-4 text-sm font-bold text-on-error-container">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5 text-left">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase text-on-surface-variant">Email</span>
                <input type="email" name="email" value="{{ request()->email }}" readonly class="w-full cursor-not-allowed rounded-2xl border-2 border-white bg-surface-container-low px-4 py-4 text-sm font-bold text-on-surface-variant">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase text-on-surface-variant">Password Baru</span>
                <input type="password" name="password" required autofocus class="w-full rounded-2xl border-2 border-white bg-surface-container-low px-4 py-4 text-sm font-bold text-on-surface focus:ring-2 focus:ring-primary/30">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase text-on-surface-variant">Konfirmasi Password</span>
                <input type="password" name="password_confirmation" required class="w-full rounded-2xl border-2 border-white bg-surface-container-low px-4 py-4 text-sm font-bold text-on-surface focus:ring-2 focus:ring-primary/30">
            </label>

            <button type="submit" class="candy-button w-full px-6 py-4">
                Update Password
                <span class="material-symbols-outlined text-lg">check_circle</span>
            </button>
        </form>
    </main>
</body>
</html>


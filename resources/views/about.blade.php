@extends('layouts.app')

@section('title', 'About Us - Hi Venus')

@section('content')
<div class="px-margin-mobile md:px-margin-desktop py-section-gap max-w-7xl mx-auto">
    {{-- Hero Section --}}
    <div class="relative bg-[#FFB6C1] border-4 border-on-background p-8 md:p-16 rounded-[40px] shadow-[8px_8px_0px_0px_#1b1c1c] text-center rotate-1 mb-20 overflow-hidden">
        {{-- Decorative Elements --}}
        <div class="absolute -top-10 -left-10 bg-[#FFD700] text-on-background w-32 h-32 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] flex items-center justify-center -rotate-12 animate-[bounce_3s_infinite]">
            <span class="material-symbols-outlined text-6xl">auto_awesome</span>
        </div>
        <div class="absolute -bottom-10 -right-10 bg-[#87CEEB] text-on-background w-24 h-24 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] flex items-center justify-center rotate-12 animate-[pulse_2s_infinite]">
            <span class="material-symbols-outlined text-5xl">stars</span>
        </div>
        
        <div class="relative z-10">
            <h1 class="text-display-lg md:text-[80px] font-headline-xl font-black text-on-background italic mb-6 leading-tight" style="text-shadow: 4px 4px 0px #fff;">
                Cerita Hi Venus ✨
            </h1>
            <p class="text-body-lg md:text-xl font-body-lg font-bold text-on-background bg-white/80 p-6 rounded-2xl border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] max-w-3xl mx-auto leading-relaxed -rotate-1 hover:rotate-0 transition-transform">
                Berawal dari kecintaan kami pada hal-hal lucu dan menggemaskan, <span class="text-[#FF1493] italic font-black">Hi Venus</span> lahir untuk membawa sedikit keajaiban ke dalam keseharianmu! Kami percaya setiap aksesoris punya cerita dan kebahagiaan kecilnya sendiri yang siap mencerahkan harimu. 💖
            </p>
        </div>
    </div>

    {{-- Value Props --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
        {{-- Card 1 --}}
        <div class="bg-[#FFF0F5] border-4 border-on-background p-8 rounded-[30px] shadow-[6px_6px_0px_0px_#1b1c1c] hover:-translate-y-2 hover:shadow-[10px_10px_0px_0px_#1b1c1c] transition-all -rotate-2">
            <div class="bg-[#FF69B4] text-white w-20 h-20 rounded-full flex items-center justify-center border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] mb-6">
                <span class="material-symbols-outlined text-4xl">favorite</span>
            </div>
            <h3 class="text-headline-md font-headline-md font-black text-on-background mb-3 italic">Dibuat dengan Cinta</h3>
            <p class="text-body-md font-bold text-on-background/80">Setiap barang di toko kami dipilih dan dikurasi dengan penuh cinta khusus buat kamu. Kualitas juara untuk si imut paripurna!</p>
        </div>

        {{-- Card 2 --}}
        <div class="bg-[#E0FFFF] border-4 border-on-background p-8 rounded-[30px] shadow-[6px_6px_0px_0px_#1b1c1c] hover:-translate-y-2 hover:shadow-[10px_10px_0px_0px_#1b1c1c] transition-all translate-y-4 md:translate-y-8">
            <div class="bg-[#00CED1] text-white w-20 h-20 rounded-full flex items-center justify-center border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] mb-6">
                <span class="material-symbols-outlined text-4xl">local_shipping</span>
            </div>
            <h3 class="text-headline-md font-headline-md font-black text-on-background mb-3 italic">Pengiriman Kilat</h3>
            <p class="text-body-md font-bold text-on-background/90">Gak sabar nunggu barang lucumu? Kami pastikan pengiriman cepat dan aman sampai tujuan. Cuss langsung meluncur!</p>
        </div>

        {{-- Card 3 --}}
        <div class="bg-[#F0FFF0] border-4 border-on-background p-8 rounded-[30px] shadow-[6px_6px_0px_0px_#1b1c1c] hover:-translate-y-2 hover:shadow-[10px_10px_0px_0px_#1b1c1c] transition-all rotate-2">
            <div class="bg-[#32CD32] text-white w-20 h-20 rounded-full flex items-center justify-center border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] mb-6">
                <span class="material-symbols-outlined text-4xl">support_agent</span>
            </div>
            <h3 class="text-headline-md font-headline-md font-black text-on-background mb-3 italic">CS Bestie Banget</h3>
            <p class="text-body-md font-bold text-on-background/80">Ada masalah atau mau curhat soal styling? Bestie MinV (Mimin Venus) siap sedia membantu kamu kapan aja!</p>
        </div>
    </div>
    
    {{-- Our Promise Section --}}
    <div class="bg-[#FFFACD] border-4 border-on-background p-10 md:p-12 rounded-[40px] shadow-[8px_8px_0px_0px_#1b1c1c] flex flex-col md:flex-row items-center gap-12 -rotate-1">
        <div class="w-full md:w-1/3 flex justify-center">
            <div class="w-48 h-48 bg-[#FFA07A] rounded-[40px] border-4 border-on-background shadow-[6px_6px_0px_0px_#1b1c1c] rotate-6 flex items-center justify-center overflow-hidden">
                <span class="material-symbols-outlined text-[100px] text-white animate-pulse">volunteer_activism</span>
            </div>
        </div>
        <div class="w-full md:w-2/3 text-center md:text-left">
            <h2 class="text-headline-lg font-headline-lg font-black text-on-background italic mb-4">Janji Manis Hi Venus 🎀</h2>
            <p class="text-body-lg font-bold text-on-background/80 leading-relaxed">
                Misi kami sederhana: <strong class="text-[#FF1493]">Bikin hari kamu lebih ceria!</strong> 
                Dari jepit rambut berbentuk awan sampai tas jinjing berbentuk stroberi, kami ada untuk memastikan kamu selalu punya alasan untuk tersenyum setiap kali bercermin. 
                Mari ciptakan dunia yang lebih kawaii bersama-sama!
            </p>
        </div>
    </div>
    </div>
    
    {{-- Store Info Section --}}
    <div class="mt-20 bg-[#E6E6FA] border-4 border-on-background p-10 md:p-12 rounded-[40px] shadow-[8px_8px_0px_0px_#1b1c1c] rotate-1">
        <div class="text-center mb-10">
            <h2 class="text-headline-lg font-headline-lg font-black text-on-background italic mb-4">Kunjungi Offline Store Kami 🛍️</h2>
            <p class="text-body-lg font-bold text-on-background/80">Mau liat barang-barang lucu secara langsung? Yuk mampir!</p>
        </div>
        
        <div class="flex flex-col md:flex-row gap-12 items-start justify-center">
            {{-- Info box --}}
            <div class="w-full md:w-1/2 flex flex-col gap-6">
                <div class="bg-white border-4 border-on-background p-6 rounded-2xl shadow-[4px_4px_0px_0px_#1b1c1c] flex items-start gap-4 hover:-rotate-1 transition-transform">
                    <div class="bg-[#FF69B4] text-white p-3 rounded-full border-2 border-on-background shrink-0">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-headline-sm font-black italic mb-1">Alamat</h4>
                        <p class="font-bold text-sm">Jl. Letnan Yusuf, Karangpoh Kulon, Babakan, Kec. Kalimanah, Kabupaten Purbalingga, Jawa Tengah 53371</p>
                    </div>
                </div>
                
                <div class="bg-white border-4 border-on-background p-6 rounded-2xl shadow-[4px_4px_0px_0px_#1b1c1c] flex items-start gap-4 hover:rotate-1 transition-transform">
                    <div class="bg-[#00CED1] text-white p-3 rounded-full border-2 border-on-background shrink-0">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <div>
                        <h4 class="font-headline-sm font-black italic mb-1">Telepon & WhatsApp</h4>
                        <p class="font-bold text-sm">0851-9856-8467</p>
                    </div>
                </div>

                <div class="bg-white border-4 border-on-background p-6 rounded-2xl shadow-[4px_4px_0px_0px_#1b1c1c] flex items-start gap-4 hover:-rotate-1 transition-transform">
                    <div class="bg-[#9e357b] text-white p-3 rounded-full border-2 border-on-background shrink-0">
                        <span class="material-symbols-outlined">alternate_email</span>
                    </div>
                    <div>
                        <h4 class="font-headline-sm font-black italic mb-1">Instagram</h4>
                        <p class="font-bold text-sm"><a href="https://instagram.com/hivenuspbg" target="_blank" class="text-[#FF1493] hover:underline">@hivenuspbg</a></p>
                    </div>
                </div>
            </div>

            {{-- Hours box --}}
            <div class="w-full md:w-1/2 bg-white border-4 border-on-background p-8 rounded-3xl shadow-[6px_6px_0px_0px_#1b1c1c] -rotate-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-[#FFA07A] text-white p-3 rounded-full border-2 border-on-background shrink-0">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <h4 class="font-headline-sm font-black italic text-xl">Jam Operasional</h4>
                </div>
                
                <ul class="flex flex-col gap-3 font-bold text-sm">
                    <li class="flex justify-between border-b-2 border-dashed border-on-background/20 pb-2"><span>Senin</span> <span>10.00 – 21.00</span></li>
                    <li class="flex justify-between border-b-2 border-dashed border-on-background/20 pb-2"><span>Selasa</span> <span>10.00 – 21.00</span></li>
                    <li class="flex justify-between border-b-2 border-dashed border-on-background/20 pb-2"><span>Rabu</span> <span>10.00 – 21.00</span></li>
                    <li class="flex justify-between border-b-2 border-dashed border-on-background/20 pb-2"><span>Kamis</span> <span>10.00 – 21.00</span></li>
                    <li class="flex justify-between border-b-2 border-dashed border-on-background/20 pb-2"><span>Jumat</span> <span>10.00 – 21.00</span></li>
                    <li class="flex justify-between border-b-2 border-dashed border-on-background/20 pb-2 text-[#FF1493]"><span>Sabtu</span> <span>10.00 – 21.00</span></li>
                    <li class="flex justify-between text-[#FF1493]"><span>Minggu</span> <span>10.00 – 21.00</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

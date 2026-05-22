@extends('layouts.admin')

@section('title', 'Manajemen Kasir | Hi Venus')

@push('styles')
    <style>
        .kawaii-card {
            background: white;
            border: 4px solid #1b1c1c;
            box-shadow: 8px 8px 0px 0px #1b1c1c;
            transition: transform 0.2s ease;
        }

        .wonky-border {
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
        }

        .press-effect:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px #1b1c1c !important;
        }

        .sticker-rotate-left { transform: rotate(-2deg); }
        .sticker-rotate-right { transform: rotate(2deg); }

        /* Custom Toggle Switch */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #1b1c1c;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #94FFD8; /* tertiary-container */
        }
        .toggle-checkbox {
            right: 0;
            z-index: 1;
            border-color: #1b1c1c;
            transition: all 0.3s;
        }
        .toggle-label {
            background-color: #ffdad6; /* error-container */
            border-color: #1b1c1c;
            transition: all 0.3s;
        }
    </style>
@endpush

@section('content')
<div class="animate-fade-in font-body-md text-on-surface min-h-screen relative pb-20">
    
    <!-- Header -->
    <section class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h2 class="font-display text-display text-on-surface">Manajemen Kasir 🌸</h2>
            <p class="font-body-lg text-on-surface-variant">Manage your kawaii cashiers and access control.</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('addCashierModal').classList.remove('hidden')" class="bg-primary text-on-primary border-4 border-on-surface px-6 py-3 rounded-2xl font-bold shadow-[4px_4px_0px_0px_#1b1c1c] press-effect flex items-center gap-2">
                <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span> Add Cashier
            </button>
        </div>
    </section>

    <!-- Success & Error Alerts -->
    @if(session('success'))
        <div class="mb-8 p-4 bg-tertiary-container border-4 border-on-surface rounded-xl shadow-[4px_4px_0px_0px_#1b1c1c] font-bold text-on-tertiary-container flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-8 p-4 bg-error-container border-4 border-on-surface rounded-xl shadow-[4px_4px_0px_0px_#1b1c1c] font-bold text-error flex flex-col gap-1">
            @foreach($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">error</span>
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    <!-- Cashiers Table -->
    <section class="kawaii-card p-8 rounded-lg overflow-x-auto relative">
        <div class="absolute -top-4 -right-4 sticker-rotate-right bg-secondary-container border-4 border-on-surface px-4 py-2 rounded-xl font-display font-black text-sm shadow-[4px_4px_0px_0px_#1b1c1c]">
            {{ $cashiers->count() }} STAFFS
        </div>
        
        <table class="w-full border-separate border-spacing-y-4">
            <thead>
                <tr class="text-left font-label-caps text-outline uppercase text-xs tracking-widest">
                    <th class="pb-2 px-4">Nama Kasir</th>
                    <th class="pb-2">Username</th>
                    <th class="pb-2 text-center">Status</th>
                    <th class="pb-2 text-right px-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-body-md">
                @forelse($cashiers as $cashier)
                    <tr class="bg-surface border-4 border-on-surface rounded-2xl group transition-all hover:-translate-y-1 hover:shadow-[4px_4px_0px_0px_#1b1c1c]">
                        <td class="py-4 px-4 rounded-l-2xl border-y-4 border-l-4 border-on-surface border-r-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full border-2 border-on-surface bg-primary-container flex items-center justify-center font-display font-black text-on-surface">
                                    {{ substr($cashier->name, 0, 1) }}
                                </div>
                                <span class="font-black text-lg text-on-surface">{{ $cashier->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 border-y-4 border-on-surface border-x-0 font-bold text-outline">
                            {{ $cashier->username }}
                        </td>
                        <td class="py-4 border-y-4 border-on-surface border-x-0 text-center">
                            <!-- Toggle Form -->
                            <form action="{{ route('admin.cashiers.toggle_status', $cashier->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in outline-none focus:outline-none">
                                    <input type="checkbox" name="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" {{ $cashier->is_active ? 'checked' : '' }} onChange="this.form.submit()"/>
                                    <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 border-4 cursor-pointer"></label>
                                </button>
                                <span class="font-bold text-xs uppercase {{ $cashier->is_active ? 'text-tertiary' : 'text-error' }}">{{ $cashier->is_active ? 'Active' : 'Inactive' }}</span>
                            </form>
                        </td>
                        <td class="py-4 px-4 rounded-r-2xl border-y-4 border-r-4 border-on-surface border-l-0 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick="openEditModal({{ $cashier }})" class="w-10 h-10 rounded-xl bg-secondary-container border-2 border-on-surface flex items-center justify-center hover:bg-secondary-fixed transition-colors shadow-[2px_2px_0px_0px_#1b1c1c] press-effect">
                                    <span class="material-symbols-outlined text-on-surface" style="font-size: 1.2rem;">edit</span>
                                </button>
                                <button onclick="openResetModal({{ $cashier }})" class="w-10 h-10 rounded-xl bg-error-container border-2 border-on-surface flex items-center justify-center hover:bg-[#ffb4ab] transition-colors shadow-[2px_2px_0px_0px_#1b1c1c] press-effect" title="Reset Password">
                                    <span class="material-symbols-outlined text-error" style="font-size: 1.2rem;">lock_reset</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 font-bold text-outline">
                            <span class="material-symbols-outlined text-6xl opacity-30 mb-2">person_off</span>
                            <p>Belum ada akun kasir.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>

<!-- Modal Create Cashier -->
<div id="addCashierModal" class="fixed inset-0 bg-on-surface/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-surface border-4 border-on-surface rounded-2xl w-full max-w-md shadow-[8px_8px_0px_0px_#1b1c1c] overflow-hidden transform sticker-rotate-left">
        <div class="bg-primary p-4 border-b-4 border-on-surface flex justify-between items-center">
            <h3 class="font-display font-black text-on-primary text-xl">✨ Tambah Kasir Baru</h3>
            <button onclick="document.getElementById('addCashierModal').classList.add('hidden')" class="text-on-primary hover:scale-110 transition-transform">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('admin.cashiers.store') }}" method="POST" class="p-6 flex flex-col gap-4">
            @csrf
            <div>
                <label class="block font-label-caps text-xs tracking-widest font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border-4 border-on-surface rounded-xl p-3 font-bold focus:outline-none focus:bg-secondary-container/20" placeholder="Misal: Budi Santoso">
            </div>
            <div>
                <label class="block font-label-caps text-xs tracking-widest font-bold mb-2">Username</label>
                <input type="text" name="username" required class="w-full border-4 border-on-surface rounded-xl p-3 font-bold focus:outline-none focus:bg-secondary-container/20" placeholder="Misal: budikasir">
            </div>
            <div>
                <label class="block font-label-caps text-xs tracking-widest font-bold mb-2">Password Awal</label>
                <input type="password" name="password" required class="w-full border-4 border-on-surface rounded-xl p-3 font-bold focus:outline-none focus:bg-secondary-container/20" placeholder="Minimal 8 karakter">
            </div>
            
            <button type="submit" class="w-full mt-4 bg-secondary text-on-secondary border-4 border-on-surface py-3 rounded-xl font-black text-lg shadow-[4px_4px_0px_0px_#1b1c1c] press-effect hover:-translate-y-1 transition-all">
                SIMPAN KASIR
            </button>
        </form>
    </div>
</div>

<!-- Modal Edit Cashier -->
<div id="editCashierModal" class="fixed inset-0 bg-on-surface/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-surface border-4 border-on-surface rounded-2xl w-full max-w-md shadow-[8px_8px_0px_0px_#1b1c1c] overflow-hidden transform sticker-rotate-right">
        <div class="bg-secondary-container p-4 border-b-4 border-on-surface flex justify-between items-center">
            <h3 class="font-display font-black text-on-surface text-xl">📝 Edit Kasir</h3>
            <button onclick="document.getElementById('editCashierModal').classList.add('hidden')" class="text-on-surface hover:scale-110 transition-transform">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="editForm" method="POST" class="p-6 flex flex-col gap-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-label-caps text-xs tracking-widest font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="edit_name" required class="w-full border-4 border-on-surface rounded-xl p-3 font-bold focus:outline-none focus:bg-primary-container/20">
            </div>
            <div>
                <label class="block font-label-caps text-xs tracking-widest font-bold mb-2">Username</label>
                <input type="text" name="username" id="edit_username" required class="w-full border-4 border-on-surface rounded-xl p-3 font-bold focus:outline-none focus:bg-primary-container/20">
            </div>
            
            <button type="submit" class="w-full mt-4 bg-primary text-on-primary border-4 border-on-surface py-3 rounded-xl font-black text-lg shadow-[4px_4px_0px_0px_#1b1c1c] press-effect hover:-translate-y-1 transition-all">
                UPDATE DATA
            </button>
        </form>
    </div>
</div>

<!-- Modal Reset Password -->
<div id="resetPasswordModal" class="fixed inset-0 bg-on-surface/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-surface border-4 border-on-surface rounded-2xl w-full max-w-sm shadow-[8px_8px_0px_0px_#1b1c1c] overflow-hidden">
        <div class="bg-error-container p-4 border-b-4 border-on-surface flex justify-between items-center">
            <h3 class="font-display font-black text-error text-xl">🔑 Reset Password</h3>
            <button onclick="document.getElementById('resetPasswordModal').classList.add('hidden')" class="text-error hover:scale-110 transition-transform">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="resetForm" method="POST" class="p-6 flex flex-col gap-4">
            @csrf
            <div>
                <p class="font-bold text-sm mb-4 text-outline">Masukkan password baru untuk kasir <span id="reset_name" class="text-on-surface font-black"></span>.</p>
                <label class="block font-label-caps text-xs tracking-widest font-bold mb-2">Password Baru</label>
                <input type="password" name="password" required class="w-full border-4 border-on-surface rounded-xl p-3 font-bold focus:outline-none focus:bg-error-container/20" placeholder="Minimal 8 karakter">
            </div>
            
            <button type="submit" class="w-full mt-2 bg-on-surface text-white border-4 border-on-surface py-3 rounded-xl font-black text-lg shadow-[4px_4px_0px_0px_#ffb4ab] press-effect hover:-translate-y-1 transition-all">
                GANTI PASSWORD
            </button>
        </form>
    </div>
</div>

<script>
    function openEditModal(cashier) {
        document.getElementById('edit_name').value = cashier.name;
        document.getElementById('edit_username').value = cashier.username;
        document.getElementById('editForm').action = '/admin/cashiers/' + cashier.id;
        document.getElementById('editCashierModal').classList.remove('hidden');
    }

    function openResetModal(cashier) {
        document.getElementById('reset_name').innerText = cashier.name;
        document.getElementById('resetForm').action = '/admin/cashiers/' + cashier.id + '/reset-password';
        document.getElementById('resetPasswordModal').classList.remove('hidden');
    }
</script>
@endsection

@extends('layouts.admin')
@section('title','Create User - Hi Venus')
@section('page-title', 'Create User')
@section('content')

<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm max-w-3xl">
    <div class="px-8 py-6 border-b border-outline-variant/10">
        <h3 class="font-black text-on-primary-fixed-variant">New User</h3>
        <p class="text-xs text-on-surface-variant mt-1">Tambah akun admin atau user.</p>
    </div>
    <form method="POST" action="{{ route('admin.users.store') }}" class="p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-2 gap-6">
            <div class="col-span-2 md:col-span-1">
                <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Name <span class="text-error">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full bg-surface-container-low border-0 rounded-xl px-4 py-3 text-on-surface font-medium focus:ring-2 focus:ring-primary/20 @error('name') ring-2 ring-error @enderror">
                @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Role <span class="text-error">*</span></label>
                <select name="role" required class="w-full bg-surface-container-low border-0 rounded-xl px-4 py-3 text-on-surface font-medium focus:ring-2 focus:ring-primary/20 @error('role') ring-2 ring-error @enderror">
                    <option value="user" {{ old('role','user')==='user'?'selected':'' }}>user</option>
                    <option value="admin" {{ old('role')==='admin'?'selected':'' }}>admin</option>
                </select>
                @error('role')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-2">
                <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Email <span class="text-error">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full bg-surface-container-low border-0 rounded-xl px-4 py-3 text-on-surface font-medium focus:ring-2 focus:ring-primary/20 @error('email') ring-2 ring-error @enderror">
                @error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-2">
                <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full bg-surface-container-low border-0 rounded-xl px-4 py-3 text-on-surface font-medium focus:ring-2 focus:ring-primary/20">
                @error('phone')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Password <span class="text-error">*</span></label>
                <input type="password" name="password" required
                       class="w-full bg-surface-container-low border-0 rounded-xl px-4 py-3 text-on-surface font-medium focus:ring-2 focus:ring-primary/20 @error('password') ring-2 ring-error @enderror">
                @error('password')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Confirm <span class="text-error">*</span></label>
                <input type="password" name="password_confirmation" required
                       class="w-full bg-surface-container-low border-0 rounded-xl px-4 py-3 text-on-surface font-medium focus:ring-2 focus:ring-primary/20">
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-primary-fixed text-on-primary-fixed px-8 py-3 rounded-xl font-bold uppercase tracking-widest border border-primary-fixed-dim/40 hover:opacity-90 active:scale-95 transition-all">
                Save
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-6 border border-outline-variant/20 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-all flex items-center">
                Back
            </a>
        </div>
    </form>
</div>

@endsection




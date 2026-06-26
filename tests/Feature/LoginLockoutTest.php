<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email'     => 'test@hivenus.test',
        'password'  => bcrypt('password123'),
        'role'      => 'user',
        'is_active' => true,
    ]);

    // Bersihkan rate limiter sebelum setiap test
    RateLimiter::clear('test@hivenus.test|127.0.0.1');
});

test('login berhasil dengan kredensial yang benar', function () {
    $response = $this->post('/login', [
        'login_id' => 'test@hivenus.test',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($this->user);
});

test('login gagal jika password salah', function () {
    $response = $this->post('/login', [
        'login_id' => 'test@hivenus.test',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('login_id');
    $this->assertGuest();
});

test('akun dikunci setelah 5 percobaan login gagal', function () {
    // 5 kali gagal
    for ($i = 0; $i < 5; $i++) {
        $this->post('/login', [
            'login_id' => 'test@hivenus.test',
            'password' => 'wrong-password',
        ]);
    }

    // Percobaan ke-6 dengan password BENAR harus tetap ditolak
    $response = $this->post('/login', [
        'login_id' => 'test@hivenus.test',
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('pesan lockout muncul saat terlalu banyak percobaan', function () {
    for ($i = 0; $i < 5; $i++) {
        $this->post('/login', [
            'login_id' => 'test@hivenus.test',
            'password' => 'wrong-password',
        ]);
    }

    $response = $this->post('/login', [
        'login_id' => 'test@hivenus.test',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
    expect(session('errors')->first('email'))->toContain('Terlalu banyak percobaan login');
});

test('login berhasil mereset jumlah percobaan gagal', function () {
    // 3 kali gagal
    for ($i = 0; $i < 3; $i++) {
        $this->post('/login', [
            'login_id' => 'test@hivenus.test',
            'password' => 'wrong-password',
        ]);
    }

    // Login berhasil
    $this->post('/login', [
        'login_id' => 'test@hivenus.test',
        'password' => 'password123',
    ]);

    Auth::logout();
    session()->flush();

    // Sekarang 4 kali gagal lagi seharusnya masih boleh (belum lock)
    for ($i = 0; $i < 4; $i++) {
        $this->post('/login', [
            'login_id' => 'test@hivenus.test',
            'password' => 'wrong-password',
        ]);
    }

    // Percobaan ke-5 masih belum lock (baru 4 setelah reset)
    $response = $this->post('/login', [
        'login_id' => 'test@hivenus.test',
        'password' => 'wrong-password',
    ]);

    // Harus error login_id bukan email (belum lockout)
    $response->assertSessionHasErrors('login_id');
});

test('login normal tidak terpengaruh sebelum mencapai batas percobaan', function () {
    // 2 kali gagal
    for ($i = 0; $i < 2; $i++) {
        $this->post('/login', [
            'login_id' => 'test@hivenus.test',
            'password' => 'wrong-password',
        ]);
    }

    // Login dengan benar harus berhasil
    $response = $this->post('/login', [
        'login_id' => 'test@hivenus.test',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($this->user);
});

# DOKUMEN IMPLEMENTASI
## Sistem Informasi Manajemen dan Layanan Toko Fashion "Hi Venus"

**Versi**: v1.0.0
**Tanggal**: 16 Juni 2026

### Tim Penulis (Kelompok Venus)
1. Mhd. Fahri Irfandi Dewantara (H1D024012)
2. Zahwa Nafiza Azzahra (H1D024015)
3. Zahratul Askia (H1D024016)
4. Amalia Maharani Andessy (H1D024032)

---

## Riwayat Revisi (Change Log)

| Tanggal | Versi | Deskripsi Perubahan | Penulis |
| :--- | :--- | :--- | :--- |
| 16 06 2026 | v1.0.0 | Rilis awal dokumen implementasi sesuai dengan status proyek akhir | Kelompok Venus |

---

## BAB 1: PENDAHULUAN

### 1.1 Tujuan Dokumen
Dokumen Implementasi ini merupakan catatan teknis resmi yang menghubungkan desain arsitektur sistem dengan kode aktual yang dibangun. Dokumen ini disusun untuk:
- Menyediakan panduan konfigurasi lingkungan pengembangan dan produksi bagi seluruh anggota tim.
- Mendokumentasikan tech stack, skema basis data, dan arsitektur fitur.
- Memfasilitasi proses *onboarding* bagi pengembang baru.
- Menjamin *reproducibility* agar sistem dapat dibangun ulang dari nol.

### 1.2 Ruang Lingkup Sistem
Sistem yang didokumentasikan dalam dokumen ini adalah **Hi Venus Web App**, sebuah aplikasi *e-commerce* dan *Point of Sales* (POS) yang dikembangkan untuk mengelola penjualan baju, aksesoris, tas, sepatu, dan perlengkapan *fashion* wanita secara daring bagi pelanggan, serta menyediakan antarmuka kasir dan dasbor analitik bagi staf/admin.

Ruang lingkup implementasi yang dicakup meliputi:
- Manajemen Pengguna, Hak Akses (RBAC), & Autentikasi
- Manajemen Katalog Produk, Kategori, & Varian (Warna/Ukuran)
- Manajemen Transaksi (Keranjang Belanja, Checkout, Wishlist)
- Sistem Kasir (Point of Sales) untuk Staf
- Dasbor Admin & Pelaporan (Transaksi, Ulasan, Voucher)

Sistem dibangun dengan arsitektur **Monolitik (MVC)** menggunakan *tech stack* Laravel.

---

## BAB 2: LINGKUNGAN IMPLEMENTASI

### 2.1 Spesifikasi Hardware

**2.1.1 Lingkungan Pengembangan (Development)**
- **Prosesor**: Intel Core i5 / AMD Ryzen 5 (setara)
- **Memori RAM**: Minimal 8 GB
- **Penyimpanan**: 256 GB SSD
- **Sistem Operasi**: Windows 10/11, macOS, atau Ubuntu 22.04 LTS
- **Koneksi Jaringan**: Broadband Internet (untuk instalasi Composer/NPM)

**2.1.2 Lingkungan Staging / Produksi (Render)**
- **Tipe Server**: Render Web Service
- **vCPU**: 1 vCPU (Berdasarkan paket Render)
- **Memori RAM**: 512 MB - 1 GB
- **Sistem Operasi**: Containerized (Render Native Environment)

### 2.2 Spesifikasi Software

| Kategori | Nama Software / Library | Versi | Keterangan |
| :--- | :--- | :--- | :--- |
| Bahasa Backend | PHP | ^8.4 | Bahasa pemrograman utama backend |
| Framework Backend | Laravel | ^13.0 | Framework MVC utama aplikasi |
| Bahasa Frontend | JavaScript | ES6+ | Interaktivitas UI & AJAX |
| Framework CSS | Tailwind CSS | 3.x | Styling antarmuka web |
| Runtime & Bundler | Node.js / Vite | v20 LTS | Manajemen aset frontend |
| Basis Data | MySQL | 8.x | RDBMS utama (Hosted di Railway) |
| PDF Generator | barryvdh/laravel-dompdf | * | Untuk cetak struk/laporan |

---

## BAB 3: IMPLEMENTASI BASIS DATA

### 3.1 Skema Tabel Utama (Struktur Logikal)

**Tabel `users`**
Mengelola data pengguna, pelanggan, staf kasir, dan admin.
- `id` (BIGINT, PK)
- `name` (VARCHAR)
- `email` (VARCHAR, UNIQUE)
- `password` (VARCHAR)
- `role` (ENUM/VARCHAR: 'admin', 'cashier', 'user')
- `phone`, `address` (VARCHAR)

**Tabel `categories`**
Mengelola kategori produk (misal: Tas, Sepatu, Dress Cantik, Atasan Lucu).
- `id` (BIGINT, PK)
- `name` (VARCHAR)
- `slug` (VARCHAR, UNIQUE)

**Tabel `products`**
Menyimpan data katalog produk.
- `id` (BIGINT, PK)
- `category_id` (BIGINT, FK ke categories)
- `name`, `slug`, `description`
- `price` (DECIMAL/INT)
- `stock` (INT)
- `image` (VARCHAR)
- `is_new`, `is_featured` (BOOLEAN)

**Tabel `product_variants`**
Menyimpan variasi ukuran dan warna dari setiap produk.
- `id` (BIGINT, PK)
- `product_id` (BIGINT, FK ke products)
- `size` (VARCHAR)
- `color` (VARCHAR)
- `color_hex` (VARCHAR)
- `stock` (INT)

**Tabel `orders`**
Pencatatan transaksi pembelanjaan (Checkout maupun POS).
- `id` (BIGINT, PK)
- `order_number` (VARCHAR, UNIQUE)
- `user_id` (BIGINT, FK ke users)
- `total_amount` (DECIMAL/INT)
- `status` (VARCHAR: 'pending', 'paid', 'completed', 'cancelled')

**Tabel `order_items`**
Rincian produk yang dibeli dalam sebuah transaksi.
- `id` (BIGINT, PK)
- `order_id` (BIGINT, FK ke orders)
- `product_id` (BIGINT, FK ke products)
- `quantity` (INT)
- `price` (DECIMAL/INT)

**Tabel `reviews`**
Sistem ulasan pembeli terhadap produk.
- `id` (BIGINT, PK)
- `product_id` (BIGINT, FK)
- `user_id` (BIGINT, FK)
- `rating` (INT 1-5)
- `comment` (TEXT)
- `status` (VARCHAR: 'pending', 'approved', 'rejected')

### 3.2 Relasi & Kardinalitas
- `users` (1) ke (N) `orders`
- `categories` (1) ke (N) `products`
- `products` (1) ke (N) `product_variants`
- `products` (1) ke (N) `reviews`
- `orders` (1) ke (N) `order_items`
- `products` (1) ke (N) `order_items`

### 3.3 Seeder (Data Awal)
Sistem menggunakan `UiUxTestDataSeeder` untuk memuat data *dummy* pengguna, produk (lengkap dengan variannya), pesanan, kategori (Tas, Sepatu, Dompet, Setelan, Dress Cantik, dll) untuk keperluan testing dan demonstrasi UI.

---

## BAB 4: IMPLEMENTASI ANTARMUKA (UI)

*Catatan: Dokumen ini merangkum fungsionalitas UI. Untuk screenshot dapat dilihat langsung melalui web browser (Aplikasi Live).*

### 4.1 Halaman Utama (Customer)
- **Home**: Menampilkan banner promo, New Arrivals, Best Sellers, dengan desain grid kawaii (warna pastel pink/mint).
- **Shop / Product Index**: Katalog produk dilengkapi filter kategori, pagination, dan *badge* 'NEW' atau 'HOT'.
- **Product Detail**: Menampilkan informasi harga, spesifikasi, pilihan varian warna/ukuran, serta Ulasan Pembeli.
- **Cart & Checkout**: Halaman keranjang belanja dengan ringkasan harga dan form detail pengiriman.

### 4.2 Halaman Dasbor (Admin & Cashier)
- **Admin Dashboard**: Statistik jumlah pengguna, produk, pesanan, dan total pendapatan. Grafik analitik ringkas.
- **POS (Point of Sales)**: Antarmuka kasir khusus untuk peran *Cashier* dalam memproses transaksi offline di toko fisik secara real-time.
- **Manajemen Katalog**: Form CRUD (Create, Read, Update, Delete) untuk produk, kategori, dan varian.
- **Manajemen Pesanan & Ulasan**: Halaman untuk mengubah status pesanan pelanggan dan melakukan moderasi ulasan (Approve/Reject).

### 4.3 Aturan Hak Akses (Role-Based Access Control)

Sistem mengimplementasikan RBAC dengan peran berikut:

| Fitur / Halaman | Admin | Cashier | User (Pelanggan) | Guest (Belum Login) |
| :--- | :--- | :--- | :--- | :--- |
| **Katalog Produk & Detail** | Akses Penuh | Akses Penuh | Akses Penuh | Akses (Tanpa Add to Cart) |
| **Keranjang & Wishlist** | Tidak Ada | Tidak Ada | Akses Penuh | Dialihkan ke Login |
| **Dasbor Analitik Utama** | Penuh | Tidak Ada | Tidak Ada | Tidak Ada |
| **Sistem Kasir (POS)** | Penuh | Penuh | Tidak Ada | Tidak Ada |
| **Manajemen Produk/Kategori** | CRUD | Baca | Tidak Ada | Tidak Ada |
| **Manajemen Ulasan & Order** | CRUD | Baca/Update Status| Lihat Milik Sendiri | Tidak Ada |
| **Manajemen Pengguna (Akun)** | CRUD | Tidak Ada | Update Profil Sendiri| Tidak Ada |

---

## BAB 5: PANDUAN INSTALASI & KONFIGURASI

### 5.1 Prasyarat Lingkungan
Pastikan software berikut sudah terinstal:
- PHP ^8.4 dan Composer
- Node.js v20 LTS dan NPM
- Database MySQL (Atau menggunakan remote connection ke Railway)
- Git

### 5.2 Langkah Eksekusi (Local Development)

**Langkah 1: Clone Repository**
```bash
git clone https://github.com/zahwa-nafiza-azzahra/hi-venus-web-app.git
cd hi-venus-web-app
```

**Langkah 2: Instalasi Dependensi**
```bash
composer install
npm install
```

**Langkah 3: Konfigurasi Environment**
```bash
cp .env.example .env
php artisan key:generate
```
*Buka file `.env` dan konfigurasikan koneksi `DB_*` ke database MySQL lokal atau remote.*

**Langkah 4: Migrasi & Seeder**
```bash
php artisan migrate:fresh --seed --seeder=UiUxTestDataSeeder
```
*Perintah ini akan membuat semua struktur tabel dan mengisi data awal berupa akun uji coba dan katalog produk dummy.*

**Langkah 5: Jalankan Server Pengembangan**
Jalankan dua perintah berikut di terminal yang berbeda:
```bash
php artisan serve
```
```bash
npm run dev
```

Aplikasi kini dapat diakses di `http://localhost:8000`.

---

## BAB 6: PENUTUP & VALIDASI

Dokumen Implementasi ini dibuat untuk memastikan bahwa seluruh fungsi, arsitektur, dan kode pada **Hi Venus** selaras dengan perancangan awal. Proyek ini telah berhasil memisahkan fungsionalitas publik (e-commerce pelanggan) dengan sistem internal (manajemen admin & POS Kasir).

**Status Deployment:**
Sistem telah di-deploy secara live menggunakan platform **Render** untuk *web service* dan **Railway** untuk basis data MySQL. Sinkronisasi dilakukan secara otomatis (CI/CD) melalui branch `main` pada repositori GitHub.

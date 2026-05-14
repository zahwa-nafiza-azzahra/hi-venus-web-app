# 🎀 Hi Venus - Boutique Management System

## 👩‍💻 Informasi Mahasiswa
| Atribut | Value |
|---------|-------|
| **Nama** | Zahwa Nafiza Azzahra |
| **NIM** | H1D024015 |
| **Kelas** | A |
| **Projek** | Hi Venus (Boutique Management System) |

---

## 📋 Deskripsi

**Hi Venus** adalah Sistem Manajemen Butik berbasis web yang dirancang dengan estetika visual **"Cartoon/Sticker-Art"** yang unik. Sistem ini tidak hanya berfungsi sebagai katalog produk online, tetapi juga mencakup fitur manajemen internal seperti **Point of Sale (POS)** untuk kasir, manajemen stok, dan dashboard analitik admin yang responsif dan interaktif.

---

## ✨ Fitur Utama

### 🛍️ Customer Experience
- **Katalog Produk Interaktif**: Tampilan produk dengan gaya kartu stiker yang menarik.
- **Shopping Cart**: Sistem keranjang belanja yang intuitif.
- **Checkout & Shipping**: Alur pemesanan yang linear dan mudah diikuti.
- **Desain Responsif**: Pengalaman belanja yang mulus di perangkat mobile maupun desktop.

### 💼 Admin & Management
- **Dashboard Admin**: Ringkasan statistik penjualan dan stok secara real-time.
- **POS (Point of Sale)**: Sistem kasir modern dengan fitur pencarian cepat dan perhitungan otomatis.
- **Manajemen Produk**: Pengelolaan data produk, kategori, dan varian (warna/ukuran).
- **Pengaturan Profil**: Kustomisasi profil admin dan pengelolaan keamanan akun.

---

## 🎨 Design Philosophy

Aplikasi ini menggunakan sistem desain **Cartoon/Comic Style** dengan karakteristik:
- **Chunky Borders**: Penggunaan border solid `4px` di hampir semua elemen UI.
- **Hard-Offset Shadows**: Bayangan tegas (bukan blur) untuk memberikan efek kedalaman "stiker".
- **Vibrant Palette**: Penggunaan warna-warna pastel yang cerah dan harmonis.
- **Micro-Animations**: Transisi halus dan efek hover yang membuat antarmuka terasa "hidup".

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | PHP 8.4, Laravel |
| **Database** | SQLite / MySQL |
| **Frontend** | Tailwind CSS v3, Vite |
| **Icons** | Material Symbols Outlined |
| **Templating** | Blade Engine |

---

## 🚀 Instalasi Lokal

### 1. Persiapan
Pastikan Anda memiliki PHP 8.4+, Composer, dan Node.js terinstal.

### 2. Clone & Setup
```bash
# Clone projek
git clone <repository-url> hi-venus
cd hi-venus

# Install dependensi
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
```

### 3. Database & Assets
```bash
# Jalankan migrasi dan seeder
php artisan migrate --seed

# Kompilasi aset frontend
npm run build # untuk produksi
# atau
npm run dev # untuk pengembangan
```

### 4. Jalankan Server
```bash
php artisan serve
```
Akses di: `http://localhost:8000`

---

## 🔐 Kredensial Admin Default
- **Email**: `admin@hi-venus.com` (atau cek `UserSeeder.php`)
- **Password**: `password`

---

© 2024 **Hi Venus** - Developed with ✨ and Sparkles.

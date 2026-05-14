# 🎀 Hi Venus - Boutique Management System

[![Akses Publik](https://img.shields.io/badge/Akses-Live_Demo-FF69B4?style=for-the-badge&logo=rocket)](https://hi-venus-web-app-production.up.railway.app/)

## 🚀 Akses Publik
Aplikasi ini telah dideploy dan dapat diakses secara publik melalui tautan berikut:
👉 **[https://hi-venus-web-app-production.up.railway.app/](https://hi-venus-web-app-production.up.railway.app/)**

---

## 📋 Deskripsi

**Hi Venus** adalah Sistem Manajemen Butik berbasis web yang dirancang dengan estetika visual **"Cartoon/Sticker-Art"** yang unik. Sistem ini tidak hanya berfungsi sebagai katalog produk online, tetapi juga mencakup fitur manajemen internal seperti **Point of Sale (POS)** untuk kasir, manajemen stok, dan dashboard analitik admin yang responsif dan interaktif.

Sistem ini dikembangkan untuk memberikan pengalaman manajemen ritel yang menyenangkan dengan antarmuka yang penuh warna namun tetap memiliki fungsionalitas tingkat perusahaan.

---

## ✨ Fitur Utama

### 🛍️ Customer Experience
- **Katalog Produk Interaktif**: Tampilan produk dengan gaya kartu stiker yang menarik dan dinamis.
- **Shopping Cart**: Sistem keranjang belanja yang intuitif dan real-time.
- **Checkout & Shipping**: Alur pemesanan yang linear, mudah diikuti, dan aman.
- **Order Tracking**: Pantau status pesanan dengan tampilan timeline yang estetik.
- **Wishlist & Reviews**: Simpan produk favorit dan berikan ulasan setelah berbelanja.

### 💼 Admin & Management
- **Dashboard Admin**: Ringkasan statistik penjualan, pendapatan, dan stok secara real-time.
- **POS (Point of Sale)**: Sistem kasir modern untuk transaksi langsung dengan fitur struk belanja digital.
- **Manajemen Produk & Stok**: Pengelolaan data produk, kategori, dan varian (warna/ukuran) secara terpusat.
- **Manajemen Staff & Pelanggan**: Kelola akun kasir dan data pelanggan dalam satu panel kontrol.
- **Pengaturan Profil**: Kustomisasi identitas admin dan pengelolaan keamanan akun.

---

## 🎨 Design Philosophy

Aplikasi ini menggunakan sistem desain **Kawaii-Pop / Cartoon Style** dengan karakteristik:
- **Chunky Borders**: Penggunaan border solid `4px` di hampir semua elemen UI untuk kesan komik.
- **Hard-Offset Shadows**: Bayangan tegas (bukan blur) untuk memberikan efek kedalaman "stiker".
- **Vibrant & Pastel Palette**: Penggunaan warna-warna yang cerah, harmonis, dan menyegarkan mata.
- **Bento Grid Layout**: Organisasi informasi menggunakan grid modern yang rapi dan terstruktur.

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | PHP 8.4, Laravel 11+ |
| **Database** | MySQL (Railway Managed) |
| **Frontend** | Tailwind CSS v4, Vite |
| **Icons** | Material Symbols Outlined |
| **Architecture** | MVC (Model View Controller) |

---

## 🔐 Kredensial Akses Demo

Anda dapat mencoba berbagai peran menggunakan akun berikut:

| Peran | Email | Password |
|-------|-------|----------|
| **Admin** | `admin@hi-venus.test` | `password` |
| **Kasir** | `kasir@hi-venus.test` | `password` |
| **User** | `user@hi-venus.test` | `password` |

---

## 🚀 Instalasi Lokal

### 1. Clone & Setup
```bash
git clone https://github.com/zahwa-nafiza-azzahra/hi-venus-web-app.git
cd hi-venus-web-app
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### 2. Database & Assets
```bash
php artisan migrate --seed
npm run build
```

### 3. Jalankan Server
```bash
php artisan serve
```

---

© 2024 **Hi Venus** - Developed with ✨ and Sparkles.

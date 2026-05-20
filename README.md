# 🎀 Hi Venus - Boutique Management System

[![Akses Publik](https://img.shields.io/badge/Akses-Live_Demo-FF69B4?style=for-the-badge&logo=rocket)](https://hi-venus-web-app.onrender.com/)

## 🚀 Akses Publik
Aplikasi ini telah dideploy dan dapat diakses secara publik melalui tautan berikut:
👉 **[https://hi-venus-web-app.onrender.com/](https://hi-venus-web-app.onrender.com/)**

---

## 📋 Deskripsi

**Hi Venus** adalah Sistem Manajemen Butik berbasis web yang komprehensif, dirancang untuk mengintegrasikan pengalaman belanja online dengan operasional bisnis internal secara efisien. Sistem ini mencakup katalog produk untuk pelanggan, modul **Point of Sale (POS)** untuk transaksi langsung, manajemen inventaris, serta dashboard analitik untuk pemantauan performa bisnis secara real-time.

Aplikasi ini bertujuan untuk memberikan solusi digital bagi pemilik butik dalam mengelola stok, transaksi, dan data pelanggan dalam satu platform yang terintegrasi dan mudah digunakan.

---

## ✨ Fitur Utama

### 🛍️ Customer Experience
- **Katalog Produk Interaktif**: Pencarian dan filter produk yang mudah untuk memudahkan pelanggan menemukan pakaian favorit.
- **Shopping Cart**: Sistem keranjang belanja yang responsif dengan perhitungan biaya otomatis.
- **Checkout & Shipping**: Alur pembayaran yang aman dengan integrasi detail pengiriman.
- **Order Tracking**: Pemantauan status pesanan dari tahap pemrosesan hingga pengiriman.
- **Wishlist & Reviews**: Fitur penyimpanan produk favorit dan pemberian ulasan kualitas produk.

### 💼 Admin & Management
- **Dashboard Analitik**: Visualisasi statistik penjualan, pendapatan harian, dan ringkasan stok.
- **POS (Point of Sale)**: Antarmuka kasir yang cepat untuk menangani transaksi di toko fisik dengan struk digital.
- **Manajemen Inventaris**: Pengelolaan data produk lengkap dengan kategori, harga, dan varian (ukuran/warna).
- **Manajemen User & Staff**: Pengaturan hak akses untuk admin, staf kasir, dan pengelolaan data pelanggan terdaftar.
- **Keamanan Akun**: Fitur pembaruan profil dan manajemen kata sandi yang terenkripsi.

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | PHP 8.4, Laravel 11+ |
| **Database** | MySQL (TiDB Serverless) |
| **Frontend** | Tailwind CSS v4, Vite |
| **Icons** | Material Symbols Outlined |
| **Architecture** | MVC (Model View Controller) |

---

## 🔐 Kredensial Akses Demo

Silakan gunakan akun berikut untuk mencoba fungsionalitas sistem:

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

© 2024 **Hi Venus** - Developed for Boutique Management Excellence.

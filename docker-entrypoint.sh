#!/bin/bash
set -e

echo "Menyiapkan aplikasi Laravel..."

echo "Menjalankan migrasi database..."
php artisan migrate --force || echo "Migrasi gagal (mungkin database belum terhubung), melanjutkan..."

# Membersihkan dan menyiapkan cache Laravel
php artisan optimize:clear
php artisan view:cache
php artisan event:cache
php artisan config:cache
php artisan route:cache

# Membuat symlink storage jika belum ada
php artisan storage:link || true



echo "Memulai server Apache..."
# Jalankan command default Docker (biasanya apache2-foreground)
exec "$@"

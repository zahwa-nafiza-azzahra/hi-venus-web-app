<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'total_amount', 'status',
        'payment_method', 'shipping_method', 'shipping_cost',
        'voucher_id', 'discount_amount', 'notes',
        'shipping_address', 'recipient_name', 'recipient_phone',
        'cashier_note', 'tracking_number',
        'confirmed_at', 'processed_at', 'shipped_at', 'completed_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'processed_at' => 'datetime',
        'shipped_at'   => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()    { return $this->belongsTo(User::class); }
    public function items()   { return $this->hasMany(OrderItem::class); }
    public function voucher() { return $this->belongsTo(Voucher::class); }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'Menunggu Konfirmasi',
            'paid'       => 'Pembayaran Dikonfirmasi',
            'processing' => 'Sedang Dikemas',
            'shipped'    => 'Dalam Pengiriman',
            'completed'  => 'Selesai',
            'cancelled'  => 'Dibatalkan',
            default      => 'Tidak Diketahui',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'bg-error-container text-on-error-container',
            'paid'       => 'bg-secondary-container text-on-secondary-container',
            'processing' => 'bg-tertiary-container text-on-tertiary-container',
            'shipped'    => 'bg-primary-container text-on-primary-container',
            'completed'  => 'bg-primary text-on-primary',
            'cancelled'  => 'bg-outline text-white',
            default      => 'bg-surface-variant text-on-surface-variant',
        };
    }

    public function getStatusStepAttribute(): int
    {
        return match($this->status) {
            'pending'    => 0,
            'paid'       => 1,
            'processing' => 2,
            'shipped'    => 3,
            'completed'  => 4,
            default      => -1,
        };
    }
}

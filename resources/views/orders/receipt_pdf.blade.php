<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Belanja {{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1b1c1c;
            line-height: 1.4;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .container {
            max-width: 680px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #d8c0cb;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #9e357b;
            margin: 0;
            letter-spacing: -1px;
        }
        .subtitle {
            font-size: 12px;
            color: #53424b;
            margin: 5px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .details-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        .details-table td {
            vertical-align: top;
            padding: 4px 0;
        }
        .details-title {
            font-weight: bold;
            color: #9e357b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .items-table th {
            border-bottom: 2px solid #1b1c1c;
            padding: 10px 0;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            color: #53424b;
        }
        .items-table td {
            padding: 12px 0;
            border-bottom: 1px solid #e5e2e1;
        }
        .item-name {
            font-weight: bold;
            color: #1b1c1c;
        }
        .item-meta {
            font-size: 11px;
            color: #53424b;
            margin-top: 3px;
        }
        .totals-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .totals-table td {
            padding: 5px 0;
        }
        .totals-table .label {
            text-align: right;
            padding-right: 20px;
            color: #53424b;
        }
        .totals-table .value {
            text-align: right;
            font-weight: bold;
            width: 120px;
        }
        .totals-table .grand-total td {
            border-top: 2px solid #1b1c1c;
            padding-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .totals-table .grand-total .value {
            color: #9e357b;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            border-top: 2px dashed #d8c0cb;
            padding-top: 20px;
            font-size: 11px;
            color: #53424b;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            background-color: #fdd73b;
            color: #1b1c1c;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            border-radius: 3px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="logo">Hi Venus</h1>
            <p class="subtitle">Struk Belanja Lucu</p>
        </div>

        <table class="details-table">
            <tr>
                <td style="width: 50%;">
                    <div class="details-title">Detail Pesanan</div>
                    <strong>No. Pesanan:</strong> #{{ $order->order_number }}<br>
                    <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y - H:i') }} WIB<br>
                    <strong>Metode Pembayaran:</strong> {{ $order->payment_method }}<br>
                    <strong>Status:</strong> <span class="badge" style="background-color: {{ $order->status === 'pending' ? '#ffe173' : ($order->status === 'cancelled' ? '#ffdad6' : '#c1e8ff') }};">{{ strtoupper($order->status) }}</span>
                </td>
                <td style="width: 50%;">
                    <div class="details-title">Alamat Pengiriman</div>
                    <strong>{{ $order->user->name }}</strong><br>
                    Jl. Strawberry No. 88, Cluster Pastel Blok C3<br/>
                    Kecamatan Harajuku, Jakarta Selatan<br/>
                    DKI Jakarta, 12345<br>
                    <strong>No. HP:</strong> {{ $order->user->phone ?? '+62 8xx-xxxx-xxxx' }}
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 55%;">Produk</th>
                    <th style="width: 15%; text-align: right;">Harga</th>
                    <th style="width: 10%; text-align: center;">Qty</th>
                    <th style="width: 20%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <div class="item-name">{{ $item->product->name }}</div>
                        @if($item->variant)
                        <div class="item-meta">
                            Size: {{ $item->variant->size }} | Color: {{ $item->variant->color }}
                        </div>
                        @endif
                    </td>
                    <td style="text-align: right;">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            <tr>
                <td class="label">Subtotal Produk</td>
                <td class="value">Rp {{ number_format($order->total_amount - $order->shipping_cost + $order->discount_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Ongkos Kirim ({{ $order->shipping_method ?? 'Ekspedisi' }})</td>
                <td class="value">Rp {{ number_format($order->shipping_cost ?? 15000, 0, ',', '.') }}</td>
            </tr>
            @if($order->discount_amount > 0)
            <tr style="color: #006687;">
                <td class="label">Diskon Voucher</td>
                <td class="value">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr class="grand-total">
                <td class="label">TOTAL BAYAR</td>
                <td class="value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima kasih sudah berbelanja barang lucu di Hi Venus! ✨</p>
            <p style="font-size: 10px; color: #a5959f; margin-top: 10px;">Jika ada pertanyaan, silakan hubungi Customer Service kami.</p>
        </div>
    </div>
</body>
</html>

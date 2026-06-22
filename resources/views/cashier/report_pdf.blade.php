<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Shift {{ $shiftCode }}</title>
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
        .summary-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        .summary-table td {
            vertical-align: top;
            padding: 8px;
            border: 1px solid #e5e2e1;
        }
        .summary-title {
            font-weight: bold;
            color: #53424b;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #9e357b;
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
        .footer {
            text-align: center;
            margin-top: 40px;
            border-top: 2px dashed #d8c0cb;
            padding-top: 20px;
            font-size: 11px;
            color: #53424b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="logo">Hi Venus</h1>
            <p class="subtitle">Laporan Shift Hari Ini</p>
            <p style="font-weight: bold; margin-top: 10px;">Kode Shift: #{{ $shiftCode }}</p>
            <p style="margin-top: 5px;">Tanggal: {{ now()->translatedFormat('d F Y') }}</p>
        </div>

        <table class="summary-table">
            <tr>
                <td style="width: 50%;">
                    <div class="summary-title">Total Transaksi</div>
                    <div class="summary-value">{{ $totalTransactions }}</div>
                </td>
                <td style="width: 50%;">
                    <div class="summary-title">Produk Terjual</div>
                    <div class="summary-value">{{ $productsSold }} Items</div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <div class="summary-title">Total Pendapatan</div>
                    <div class="summary-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </td>
                <td style="width: 50%;">
                    <div class="summary-title">Produk Terpopuler</div>
                    <div class="summary-value">{{ $popularProduct }}</div>
                </td>
            </tr>
        </table>

        <div style="font-weight: bold; font-size: 14px; margin-bottom: 10px; color: #9e357b;">Riwayat Transaksi Terakhir</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 25%;">ID Transaksi</th>
                    <th style="width: 20%;">Waktu</th>
                    <th style="width: 20%;">Metode</th>
                    <th style="width: 35%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $order)
                <tr>
                    <td>#{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->format('H:i') }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; font-style: italic;">Belum ada transaksi di shift ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>Laporan dicetak otomatis oleh sistem POS Hi Venus</p>
            <p>{{ now()->translatedFormat('d F Y H:i:s') }} WIB</p>
        </div>
    </div>
</body>
</html>

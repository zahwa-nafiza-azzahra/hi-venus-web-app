<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hi Venus Sales Report - {{ ucfirst($period) }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #161d1f;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            margin-bottom: 30px;
            border-bottom: 3px solid #1b1c1c;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #a52a80;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #54414b;
        }
        .meta-info {
            margin-bottom: 25px;
            width: 100%;
        }
        .meta-info td {
            padding: 4px 0;
        }
        .summary-boxes {
            width: 100%;
            margin-bottom: 30px;
        }
        .summary-box {
            background-color: #fcf9f8;
            border: 3px solid #1b1c1c;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
        }
        .summary-box .title {
            font-size: 10px;
            text-transform: uppercase;
            color: #87717c;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .summary-box .value {
            font-size: 20px;
            font-weight: bold;
            color: #161d1f;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #161d1f;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #1b1c1c;
            padding-bottom: 5px;
            text-transform: uppercase;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        table.data-table th {
            background-color: #f0eded;
            border: 2px solid #1b1c1c;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }
        table.data-table td {
            border: 2px solid #1b1c1c;
            padding: 8px 10px;
            font-size: 11px;
        }
        table.data-table tr:nth-child(even) {
            background-color: #fcf9f8;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            background-color: #e1e4a9;
            color: #636636;
            border: 1px solid #1b1c1c;
            border-radius: 4px;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
        }
        .badge-paid {
            background-color: #94FFD8;
            color: #004534;
        }
        .badge-completed {
            background-color: #F0FFF0;
            color: #32CD32;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #87717c;
            border-top: 1px solid #e0e0e0;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Hi Venus - Sales Report 📈</h1>
        <p>Real-time vibes of your store performance.</p>
    </div>

    <table class="meta-info">
        <tr>
            <td style="width: 50%;"><strong>Report Period:</strong> {{ ucfirst($period) }}</td>
            <td style="width: 50%; text-align: right;"><strong>Date Generated:</strong> {{ now()->format('d M Y, H:i') }}</td>
        </tr>
    </table>

    <table class="summary-boxes" cellspacing="10">
        <tr>
            <td style="width: 33%;">
                <div class="summary-box">
                    <div class="title">Total Revenue</div>
                    <div class="value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </td>
            <td style="width: 33%;">
                <div class="summary-box">
                    <div class="title">Total Transactions</div>
                    <div class="value">{{ number_format($totalTransactions) }}</div>
                </div>
            </td>
            <td style="width: 33%;">
                <div class="summary-box">
                    <div class="title">Conversion Rate</div>
                    <div class="value">{{ $conversionRate }}%</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Sales Trends ({{ ucfirst($period) }})</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Period Label</th>
                <th style="text-align: right;">Revenue</th>
                <th style="text-align: right;">Orders</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trends as $label => $data)
                <tr>
                    <td><strong>{{ $label }}</strong></td>
                    <td style="text-align: right;">Rp {{ number_format($data['raw_revenue'], 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ number_format($data['orders']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="page-break-before: always;"></div>

    <div class="section-title">Top Selling Products</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 8%;">Rank</th>
                <th>Product Name</th>
                <th style="text-align: right; width: 25%;">Price</th>
                <th style="text-align: right; width: 20%;">Units Sold</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $i => $product)
                <tr>
                    <td><strong>#{{ $i + 1 }}</strong></td>
                    <td>{{ $product->name }}</td>
                    <td style="text-align: right;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ $product->order_items_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Recent History</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Date</th>
                <th style="text-align: right;">Amount</th>
                <th style="text-align: center; width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
                <tr>
                    <td><strong>{{ $order->order_number }}</strong></td>
                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td style="text-align: center;">
                        <span class="badge badge-{{ $order->status }}">
                            {{ $order->status }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated automatically by Hi Venus Web Application. All rights reserved.
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Penjualan</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-0lax{
            text-align:center;
            vertical-align:top;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h3 class="text-center">Laporan Penjualan</h3>
    </header>
    <table class="tg" style="width: 100%">
        <thead>
            <tr>
                <th class="tg-0lax">NO</th>
                <th class="tg-0lax">Tanggal</th>
                <th class="tg-0lax">Invoice</th>
                <th class="tg-0lax">Sub Total</th>
                <th class="tg-0lax">Diskon</th>
                <th class="tg-0lax">Total</th>
                <th class="tg-0lax">Customer</th>
                <th class="tg-0lax">Kasir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td>{{ $sale->created_at->translatedFormat('d/m/y H:i:s') }}</td>
                    <td>{{ $sale->invoice }}</td>
                    <td style="text-align:right">{{ number_format($sale->total_price) }}</td>
                    <td style="text-align:right">{{ number_format($sale->discount) }}</td>
                    <td style="text-align:right">{{ number_format($sale->final_price) }}</td>
                    <td>{{ $sale->customer->name ?? 'umum' }}</td>
                    <td style="text-align:center;">{{ $sale->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
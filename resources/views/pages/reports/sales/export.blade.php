<table>
    <thead>
        <tr>
            <th style="width: 5px;text-align:center;font-weight:bold;font-family:sans-serif;">NO</th>
            <th style="width: 20px;text-align:center;font-weight:bold;font-family:sans-serif;">Tanggal</th>
            <th style="width: 15px;text-align:center;font-weight:bold;font-family:sans-serif;">Invoice</th>
            <th  style="width: 15px;text-align:center;font-weight:bold;font-family:sans-serif;">Customer</th>
            <th style="width: 15px;text-align:center;font-weight:bold;font-family:sans-serif;">Sub Total</th>
            <th style="width: 15px;text-align:center;font-weight:bold;font-family:sans-serif;">Diskon</th>
            <th style="width: 15px;text-align:center;font-weight:bold;font-family:sans-serif;">Total</th>
            <th style="width: 15px;text-align:center;font-weight:bold;font-family:sans-serif;">Tunai</th>
            <th style="width: 15px;text-align:center;font-weight:bold;font-family:sans-serif;">Kembalian</th>
            <th style="width: 20px;text-align:center;font-weight:bold;font-family:sans-serif;">Kasir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td style="font-family: sans-serif;text-align:center;">{{ $loop->iteration }}</td>
                <td style="font-family: sans-serif;">{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                <td style="font-family: sans-serif;">{{ $sale->invoice }}</td>
                <td style="font-family: sans-serif;">{{ $sale->customer->name ?? 'umum' }}</td>
                <td style="font-family: sans-serif;">{{ $sale->total_price }}</td>
                <td style="font-family: sans-serif;">{{ $sale->discount }}</td>
                <td style="font-family: sans-serif;">{{ $sale->final_price }}</td>
                <td style="font-family: sans-serif;">{{ $sale->cash }}</td>
                <td style="font-family: sans-serif;">{{ $sale->change }}</td>
                <td style="font-family: sans-serif;text-align:center;">{{ $sale->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
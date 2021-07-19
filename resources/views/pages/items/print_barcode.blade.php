<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Barcode {{ $item->barcode }}</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h2>Print Barcode {{ $item->barcode }}</h2>
    <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG($item->barcode, 'PDF417') }}" alt="{{ $item->barcode }}" style="margin-right:20px;height:100px; width:150px;"/>
</body>
</html>
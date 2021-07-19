@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">
                            Generator
                        </h6>   
                        <a href="{{ route('items.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-md-6 mb-2">
                        <h6>Barcode Generator</h6>
                        <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG($item->barcode, 'PDF417') }}" alt="{{ $item->barcode }}" style="height: 100px;width:130px"/>
                        <p>{{ $item->barcode }}</p>
                        <a href="{{ route('items.print.barcode', $item->id) }}" target="_blank" class="btn btn-sm btn-secondary">Print Barcode</a>
                    </div>
                    <div class="col-md-6">
                        <h6>QR-Code Generator</h6>
                        <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG($item->barcode, 'QRCODE') }}" alt="{{ $item->barcode }}" style="height: 100px;width:100px;"/>
                        <p>{{ $item->barcode }}</p>
                        <a href="{{ route('items.print.qrcode', $item->id) }}" target="_blank" class="btn btn-sm btn-secondary">Print Qrcode</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

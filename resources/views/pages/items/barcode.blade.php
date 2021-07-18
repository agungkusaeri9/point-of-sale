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
                    <div class="col-md-6 ">
                        <h6>Barcode Generator</h6>
                        <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG($item->barcode, 'PDF417') }}" alt="{{ $item->barcode }}"/>
                        <p>{{ $item->barcode }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>QR-Code Generator</h6>
                        <div class="w-100">
                            {!! DNS2D::getBarcodeHTML($item->barcode, 'QRCODE') !!}
                        </div>
                        <p>{{ $item->barcode }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

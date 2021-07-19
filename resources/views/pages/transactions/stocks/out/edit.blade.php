@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        Edit Barang Keluar
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks.out.update', $stock->id) }}" method="post" id="form">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="item_id" id="item_id" value="{{ $stock->item_id }}">
                        <div class="form-group">
                            <label for="">Barcode*</label>
                            <div class="input-group mb-3">
                                <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror" id="barcode" value="{{ $stock->item->barcode ??  old('barcode')  }}" readonly>
                            </div>
                            @error('barcode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row" id="detail">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" id="name" class="form-control" value="{{ $stock->item->barcode }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kateogri</label>
                                    <input type="text" id="category" class="form-control" value="{{ $stock->item->category->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <input type="text" id="unit" class="form-control" value="{{ $stock->item->unit->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="text" id="stock" class="form-control" value="{{ $stock->item->stock }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" id="price" class="form-control" value="{{ $stock->item->price }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty*</label>
                            <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ $stock->qty ?? old('qty') }}">
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $stock->description ?? old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">Supplier*</label>
                            <select name="supplier_id" id="supplier_id" class="form-control @error('description') is-invalid @enderror">
                                <option selected disabled>--Pilih Supplier--</option>
                                @foreach ($suppliers as $supplier)
                                    <option @if($supplier->id == $stock->supplier_id ?? old('supplier_id')) selected @endif value="{{ $stock->supplier_id ?? $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ route('stocks.out.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary px-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
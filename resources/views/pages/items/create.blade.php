@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        Tambah Item Baru
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="post" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="barcode">Barcode*</label>
                            <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror" value="{{ old('barcode') }}">
                            @error('barcode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Nama*</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category*</label>
                            <select name="category_id" id="category_id" class="form-control @error('name') is-invalid @enderror">
                                <option selected disabled>--Pilih Category--</option>
                                @foreach ($categories as $category)
                                    <option  @if($category->id == old('category_id')) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-inline">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="unit_id">Unit*</label>
                            <select name="unit_id" id="unit_id" class="form-control @error('name') is-invalid @enderror">
                                <option selected disabled>--Pilih Unit--</option>
                                @foreach ($units as $unit)
                                    <option @if($unit->id == old('unit_id')) selected @endif value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback d-inline">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        <div class="form-group">
                            <label for="price">Price*</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group float-right">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary px-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
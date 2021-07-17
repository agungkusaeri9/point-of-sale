@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        Edit Supplier
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="post" id="form">
                        @csrf
                        @method('patch')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama*</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $supplier->name ?? old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor Hp*</label>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $supplier->phone_number ?? old('phone_number') }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi*</label>
                                <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $supplier->description ?? old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat*</label>
                                <textarea name="address" id="address" cols="10" rows="5" class="form-control @error('address') is-invalid @enderror">{{ $supplier->address ?? old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary px-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
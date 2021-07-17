@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        Edit Customer
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.update', $customer->id) }}" method="post" id="form">
                        @csrf
                        @method('patch')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama*</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $customer->name ?? old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin*</label>
                                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="" disabled selected>--Pilih Jenis Kelamin--</option>
                                    <option value="L" @if($customer->gender === 'L') selected @endif>Laki-laki</option>
                                    <option value="P" @if($customer->gender === 'P') selected @endif>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor Hp*</label>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $customer->phone_number ?? old('phone_number') }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat*</label>
                                <textarea name="address" id="address" cols="10" rows="5" class="form-control @error('address') is-invalid @enderror">{{ $customer->address ?? old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary px-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
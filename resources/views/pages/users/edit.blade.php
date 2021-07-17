@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        Edit User
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="post" id="form">
                        @csrf
                        @method('patch')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name ?? old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username*</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username ?? old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email ?? old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password*</label>
                                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" cols="10" rows="3" class="form-control @error('address') is-invalid @enderror">{{ $user->address ?? old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Role">Role*</label>
                                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="" selected disabled>--Choose Role--</option>
                                    @foreach ($roles as $role)
                                        <option @if($role->name === $user->getRoleNames()->first() ?? old('role')) selected @endif value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('Role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary px-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
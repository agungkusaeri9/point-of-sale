@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h6 class="d-flex card-title">
                            Data Categories
                        </h6>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm" id="btnAdd"><i class="fas fa-add"></i> Tambah Category</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th style="min-width: 130px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus category ini?')"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@include('layouts.partials.toast')

<script type="text/javascript">
    $(function () {
      var otable = $('#table').DataTable();
    });
</script>
@endpush
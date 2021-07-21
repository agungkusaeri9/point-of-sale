@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="info-box">
                <div class="info-box-content">
                    <h5>Filter Data</h5>
                    <form action="{{ route('sales.filter') }}" method="post" class="d-inline">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="from" class="col-sm-3 col-form-label">Dari</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="from" name="from">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="to" class="col-sm-3 col-form-label">S/d</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="to" name="to">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="customer_id" class="col-sm-3 col-form-label">Customer</label>
                                            <div class="col-sm-9">
                                                <select name="customer_id" id="customer_id" class="form-control">
                                                    <option value="all" selected>--Semua--</option>
                                                    <option value="umum">Umum</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="invoice" class="col-sm-3 col-form-label">Invoice</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="invoice" name="invoice">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary float-right"><i class="fas fa-search"></i> Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="d-flex card-title">
                        Data Penjualan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Invoice</th>
                                    <th>Sub Total</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Customer</th>
                                    <th style="min-width: 130px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->created_at->translatedFormat('d/m/y H:i:s') }}</td>
                                        <td>{{ $sale->invoice }}</td>
                                        <td>{{ number_format($sale->total_price) }}</td>
                                        <td>{{ number_format($sale->discount) }}</td>
                                        <td>{{ number_format($sale->final_price) }}</td>
                                        <td>{{ $sale->customer->name ?? 'umum' }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            @role('admin')
                                            <form action="{{ route('sales.destroy', $sale->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus sale ini?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                            @endrole
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
        $('#table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush
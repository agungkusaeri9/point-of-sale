@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        Tambah Barang Keluar
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks.out.store') }}" method="post" id="form">
                        @csrf
                        <input type="hidden" name="item_id" id="item_id" value="">
                        <div class="form-group">
                            <label for="">Barcode*</label>
                            <div class="input-group mb-3">
                                <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror" id="barcode" value="{{  old('barcode')  }}" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info btn-primary" class="btnModal" data-toggle="modal" data-target="#modalItems"><i class="fas fa-search"></i></button>
                                </div>
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
                                    <input type="text" id="name" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kateogri</label>
                                    <input type="text" id="category" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <input type="text" id="unit" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="text" id="stock" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" id="price" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty*</label>
                            <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}">
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">Supplier*</label>
                            <select name="supplier_id" id="supplier_id" class="form-control @error('description') is-invalid @enderror">
                                <option selected value="">--Pilih Supplier--</option>
                                @foreach ($suppliers as $supplier)
                                    <option @if($supplier->id == old('supplier_id')) selected @endif value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
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

<div class="modal fade" id="modalItems">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table">
                    <thead>
                        <th>#</th>
                        <th>Barcode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->barcode }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->unit->name }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" id="pilih"
                                        data-id="{{ $item->id }}" 
                                        data-barcode="{{ $item->barcode }}"
                                        data-name="{{ $item->name }}"
                                        data-price="{{ number_format($item->price) }}"
                                        data-category="{{ $item->category->name }}"
                                        data-unit="{{ $item->unit->name }}"
                                        data-stock="{{ $item->stock }}"
                                        ><i class="fas fa-check"></i> Pilih</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
    $(function () {
      var otable = $('#table').DataTable();
    });
</script>
<script>
    $(function(){
        $(document).on('click','#pilih', function(){
            let item_id = $(this).data('id');
            let barcode = $(this).data('barcode');
            let name = $(this).data('name');
            let unit = $(this).data('unit');
            let price = $(this).data('price');
            let stock = $(this).data('stock');
            let category = $(this).data('category');
            $('#item_id').val(item_id);
            $('#barcode').val(barcode);
            $('#name').val(name);
            $('#unit').val(unit);
            $('#price').val(price);
            $('#stock').val(stock);
            $('#category').val(category);
            $('#modalItems').modal('hide');
        });
    })
</script>
@endpush
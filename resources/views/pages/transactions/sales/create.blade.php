@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="info-box" style="min-height: 180px">
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="date"
                                    value="{{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kasir" class="col-sm-3 col-form-label">Kasir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kasir" value="{{ auth()->user()->name }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_id" class="col-sm-3 col-form-label">Customer</label>
                            <div class="col-sm-9">
                                <select name="customer_id" id="customer_id" class="form-control">
                                    <option value="umum">Umum</option>
                                    @foreach ($customers as $customer)
                                        <option @if ($customer->id === $customer) selected @endif
                                            value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box" style="min-height: 180px">
                    <div class="info-box-content">
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="item_id" value id="item_id">
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-4 col-form-label">Barcode</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="barcode"
                                            class="form-control @error('barcode') is-invalid @enderror" id="barcode"
                                            value="{{ old('barcode') }}" readonly>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-info btn-primary" class="btnModal"
                                                data-toggle="modal" data-target="#modalItems"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @error('barcode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="qty" class="col-sm-4 col-form-label">Qty</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="qty" value="1" name="qty">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box" style="min-height: 180px">
                    <div class="info-box-content text-right">
                        <h5 class="text-right">Invoice <span class="font-weight-bold"
                                id="invoice">{{ $invoice }}</span></h5>
                        <div id="total" style="font-size: 70px;font-weight:400;">
                            {{ $sub_total }}
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tableCart">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barcode</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $c)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $c->item->barcode }}</td>
                                            <td>{{ $c->item->name }}</td>
                                            <td>{{ number_format($c->item->price) }}</td>
                                            <td>{{ $c->qty }}</td>
                                            <td>{{ number_format($c->price_total) }}</td>
                                            <td>
                                                <form action="{{ route('cart.destroy', $c->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i></button>
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
        <div class="row">
            <div class="col-md-3">
                <div class="info-box" style="min-height: 180px">
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="sub_total" class="col-sm-4 col-form-label">Sub Total</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="sub_total" readonly
                                    value="{{ $sub_total }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-sm-4 col-form-label">Diskon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="discount" value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-sm-4 col-form-label">Total</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="grand_total" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box" style="min-height: 180px">
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="cash" class="col-sm-4 col-form-label">Uang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cash" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="change" class="col-sm-4 col-form-label">Kembalian</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="change" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box" style="min-height: 180px">
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="note" class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <textarea name="note" id="note" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box" style="min-height: 180px">
                    <div class="info-box-content">
                        <div class="form-group">
                            <form action="{{ route('cart.deleteAll') }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" id="batal"><i class="fas fa-times"></i> Batal</button>
                            </form>
                            <br>
                            <button class="btn btn-success" id="checkout"><i class="fas fa-shopping-cart"></i>
                                Checkout</button>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
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
                                                data-id="{{ $item->id }}" data-barcode="{{ $item->barcode }}"><i
                                                    class="fas fa-check"></i> Pilih</button>
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
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
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
    @include('layouts.partials.toast')
    <script type="text/javascript">
        $(function() {
            var otable = $('#table').DataTable();
            var tableCart = $('#tableCart').DataTable({
                "searching": false,
                "ordering": false,
                "paging": false,
                "info": false,
            });
        });
    </script>
    <script>
        $(function() {
            $(document).on('click', '#pilih', function() {
                let barcode = $(this).data('barcode');
                let item_id = $(this).data('id');
                $('#barcode').val(barcode);
                $('#item_id').val(item_id);
                $('#modalItems').modal('hide');
            });

            let change = 0;
            let sub_total = $('#sub_total').val();
            let discount = $('#discount').val();
            if (discount == 0) {
                $('#grand_total').val(sub_total);
            }
            // let grand_total = sub_total - discount;
            // $('#grand_total').val(grand_total);
            $('#discount').keyup(function() {
                let discount = $('#discount').val();
                let grand_total = sub_total - discount;
                $('#grand_total').val(grand_total);
                $('#total').text(grand_total);
            })
            $('#cash').keyup(function() {
                let discount = $('#discount').val();
                let grand_total = sub_total - discount;
                let cash = $('#cash').val();
                let change = cash - grand_total;
                $('#change').val(change);
            })

            $('#checkout').on('click', function() {
                let invoice = $('#invoice').text();
                let customer_id = $('#customer_id').val();
                let total_price = $('#sub_total').val();
                let discount = $('#discount').val();
                let grand_total = $('#grand_total').val();
                let cash = $('#cash').val();
                let change = $('#change').val();
                let note = $('#note').val();

                $.ajax({
                    url: '{{ route('sales.store') }}',
                    type: 'POST',
                    data: {
                        "invoice": invoice,
                        "customer_id": customer_id,
                        "total_price": sub_total,
                        "discount": discount,
                        "final_price": grand_total,
                        "cash": cash,
                        "change": change,
                        "note": note,
                    },
                    // data: $('#formCheckout').serialize(),
                    dateType: 'JSON',
                    success: function(res) {
                        alert('berhasil');
                        window.location.href = '{{ route('sales.create') }}';
                    }
                })
            })
        })
    </script>
@endpush

<div class="row">
    <div class="col-12">      
      <!-- Main content -->
      <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
          <div class="col-12">
            <h4>
              <i class="fas fa-globe"></i> MY POS
              <small class="float-right">Tanggal : {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</small>
            </h4>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info mb-3">
          <div class="col-sm-4 invoice-col">
            Kasir
            <div class="font-weight-bold">
                {{ $sale->user->name }}
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            Customer
            <div class="font-weight-bold">
                {{ $sale->customer->name ?? 'Umum' }}
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice #{{ $sale->invoice }}</b>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->details as $detail)
                    <tr>
                        <td>{{ $detail->item->barcode }}</td>
                        <td>{{ $detail->item->name }}</td>
                        <td>{{ $detail->item->category->name }}</td>
                        <td>{{ $detail->item->price }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>
                          {{ $detail->item->price * $detail->qty }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <b>Keterangan :</b>
                <p>
                    {{ $sale->note }}
                </p>
            </div>
          <!-- /.col -->
          <div class="col-6">

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal</th>
                  <td>{{ number_format($sale->total_price) }}</td>
                </tr>
                <tr>
                  <th>Diskon</th>
                  <td>{{ number_format($sale->discount) }}</td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td>{{ number_format($sale->final_price) }}</td>
                </tr>
                <tr>
                    <th>Tunai</th>
                    <td>{{ number_format($sale->cash) }}</td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td>{{ number_format($sale->change) }}</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.invoice -->
    </div>
</div>
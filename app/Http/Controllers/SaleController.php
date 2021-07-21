<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    public function create()
    {
        $customers = Customer::get();
        $sale = Sale::latest()->first();
        $items = Item::orderBy('barcode','ASC')->get();
        $date = Carbon::now()->translatedFormat('ymd');
        if($sale === NULL)
        {
            $pad = Str::padLeft(1, 3, "0");
            $invoice = 'MI' . $date . $pad;
        }else{
            $invoiceLatest = $sale->invoice;
            $bag2 = Str::substr($invoiceLatest,2,6);
            if($bag2 == $date)
            {
                $bag3Latest = $bag2 = Str::substr($invoiceLatest,8,6);
                $bag3 = $bag3Latest + 1;
                $pad = Str::padLeft($bag3, 3, "0");
                $invoice = 'MI' . $date . $pad;
            }else{
                $pad = Str::padLeft(1, 3, "0");
                $invoice = 'MI' . $date . $pad;
            }

        }
        return view('pages.transactions.sales.create',[
            'title' => 'Checkout Penjualan',
            'customers' => $customers,
            'invoice' => $invoice,
            'items' => $items
        ]);
    }
}

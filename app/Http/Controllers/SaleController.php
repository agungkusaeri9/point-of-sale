<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    public function index()
    {
        $from = request('from');
        $to = request('to');
        $customer_id = request('customer_id');
        $invoice = request('invoice');
        if (request()->all()) {
            if ($invoice) {
                $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->where('invoice', $invoice)->get();
            } else {
                // jika dari dan sampai diisi
                if ($from && $to) {
                    if ($customer_id === 'all') {
                        $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->whereBetween('created_at', [$from, $to])->get();
                    } elseif ($customer_id === 'umum') {
                        $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->whereBetween('created_at', [$from, $to])->where('customer_id', NULL)->get();
                    } else {
                        $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->whereBetween('created_at', [$from, $to])->where('customer_id', $customer_id)->get();
                    }
                } else {
                    if ($customer_id === 'all') {
                        $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->get();
                    } elseif ($customer_id === 'umum') {
                        $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->where('customer_id', NULL)->get();
                    } else {
                        $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->where('customer_id', $customer_id)->get();
                    }
                }
            }
        } else {
            $sales = Sale::with('customer', 'user')->orderBy('id', 'DESC')->get();
        }
        $customers = Customer::orderBy('name', 'asc')->get();
        return view('pages.transactions.sales.index', [
            'title' => 'History Penjualan',
            'sales' => $sales,
            'customers' => $customers
        ]);
    }
    public function create()
    {
        $customers = Customer::get();
        $sale = Sale::latest()->first();
        $items = Item::orderBy('barcode', 'ASC')->get();
        $date = Carbon::now()->translatedFormat('ymd');
        if ($sale === NULL) {
            $pad = Str::padLeft(1, 3, "0");
            $invoice = 'MI' . $date . $pad;
        } else {
            $invoiceLatest = $sale->invoice;
            $bag2 = Str::substr($invoiceLatest, 2, 6);
            if ($bag2 == $date) {
                $bag3Latest = $bag2 = Str::substr($invoiceLatest, 8, 6);
                $bag3 = $bag3Latest + 1;
                $pad = Str::padLeft($bag3, 3, "0");
                $invoice = 'MI' . $date . $pad;
            } else {
                $pad = Str::padLeft(1, 3, "0");
                $invoice = 'MI' . $date . $pad;
            }
        }
        $cart = Cart::with('item')->where('user_id', auth()->id())->get();
        $sub_total = Cart::where('user_id', auth()->id())->sum('price_total');
        return view('pages.transactions.sales.create', [
            'title' => 'Checkout Penjualan',
            'customers' => $customers,
            'invoice' => $invoice,
            'items' => $items,
            'cart' => $cart,
            'sub_total' => $sub_total
        ]);
    }

    public function store()
    {
        if (request('customer_id') === "umum") {
            $customer_id = NULL;
        } else {
            $customer_id = request('customer_id');
        }
        $cart = Cart::where('user_id', auth()->id())->get();
        $sale = new Sale();
        $sale->invoice = request('invoice');
        $sale->customer_id = $customer_id;
        $sale->total_price = request('total_price');
        $sale->discount = request('discount');
        $sale->final_price = request('final_price');
        $sale->cash = request('cash');
        $sale->change = request('change');
        $sale->note = request('note');
        $sale->user_id = auth()->id();
        $sale->save();
        foreach ($cart as $c) {
            $sale->details()->create([
                'item_id' => $c->item_id,
                'qty' => $c->qty
            ]);
            $c->item->decrement('stock', $c->qty);
        }

        $cart = Cart::where('user_id', auth()->id())->delete();
        return response()->json(['success' => 'Berhasil']);
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return view('pages.transactions.sales.show', [
            'sale' => $sale
        ]);
    }

    public function destroy($id)
    {
        Sale::destroy($id);
        return redirect()->back()->with('success', 'Transaksi berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::with('item.unit','supplier')->where('type','out')->orderBy('id','DESC')->get();
        return view('pages.transactions.stocks.out.index',[
            'title' => 'Barang keluar',
            'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::with('category','unit')->orderBy('barcode','ASC')->get();
        $suppliers = Supplier::orderBy('name','ASC')->get();
        return view('pages.transactions.stocks.out.create',[
            'title' => 'Tambah Barang keluar',
            'items' => $items,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'item_id' => ['required','numeric'],
            'barcode' => ['required'],
            'qty' => ['required']
        ]);
        $itemStock = Item::findOrFail(request('item_id'))->stock;
        if($itemStock < request('qty'))
        {
            return redirect()->route('stocks.out.index')->with('failed','Qty tidak boleh melebihi stok barang');
        }
        $data = request()->all();
        $data['type'] = 'out';
        $data['user_id'] = auth()->id();
        $stock = Stock::create($data);
        $stock->item->decrement('stock',request('qty'));

        return redirect()->route('stocks.out.index')->with('success','Barang keluar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $suppliers = Supplier::orderBy('name','ASC')->get();
        return view('pages.transactions.stocks.out.edit',[
            'title' => 'Edit Barang keluar',
            'stock' => $stock,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'qty' => ['required']
        ]);
        $stock = Stock::findOrFail($id);
        $stock->item->increment('stock',$stock->qty);
        $stock->update([
            'qty' => request('qty'),
            'description' => request('description'),
            'supplier_id' => request('supplier_id')
        ]);
        $stock->item->decrement('stock',request('qty'));
        return redirect()->route('stocks.out.index')->with('success','Barang keluar berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->item->increment('stock', $stock->qty);
        $stock->delete();
        return redirect()->route('stocks.out.index')->with('success','Barang keluar berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::with('item.unit','supplier')->where('type','in')->orderBy('id','DESC')->get();
        return view('pages.transactions.stocks.in.index',[
            'title' => 'Barang Masuk',
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
        return view('pages.transactions.stocks.in.create',[
            'title' => 'Tambah Barang Masuk',
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
            'supplier_id' => ['required'],
            'qty' => ['required']
        ]);
        

        $data = request()->all();
        $data['type'] = 'in';
        $data['user_id'] = auth()->id();
        $stok = Stock::create($data);
        $stok->item->increment('stock',request('qty'));

        return redirect()->route('stocks.in.index')->with('success','Barang masuk berhasil ditambahkan');
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
        return view('pages.transactions.stocks.in.edit',[
            'title' => 'Edit Barang Masuk',
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
            'supplier_id' => ['required'],
            'qty' => ['required']
        ]);
        
        $stock = Stock::findOrFail($id);
        $stock->item->decrement('stock',$stock->qty);
        $stock->update([
            'qty' => request('qty'),
            'description' => request('description'),
            'supplier_id' => request('supplier_id')
        ]);
        $stock->item->increment('stock',request('qty'));

        return redirect()->route('stocks.in.index')->with('success','Barang masuk berhasil diupdate');
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
        $stock->item->decrement('stock', $stock->qty);
        $stock->delete();
        return redirect()->route('stocks.in.index')->with('success','Barang masuk berhasil dihapus');
    }
}

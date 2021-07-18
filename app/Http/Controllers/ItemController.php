<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('category','unit')->orderBy('name','ASC')->get();
        return view('pages.items.index',[
            'title' => 'Data Item',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $units = Unit::orderBy('name','ASC')->get();
        return view('pages.items.create',[
            'title' => 'Tambah Item',
            'categories' => $categories,
            'units' => $units
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
            'barcode' => ['required','unique:items,barcode'],
            'name' => ['required'],
            'category_id' => ['required'],
            'unit_id' => ['required'],
            'price' => ['required','numeric']
        ]);
        $data = request()->all();
        $data['slug'] = Str::slug(request('name'));
        Item::create($data);
        return redirect()->route('items.index')->with('success','Item berhasil ditambahkan');
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
        $item = Item::findOrFail($id);
        $categories = Category::orderBy('name','ASC')->get();
        $units = Unit::orderBy('name','ASC')->get();
        return view('pages.items.edit',[
            'title' => 'Edit Item',
            'categories' => $categories,
            'units' => $units,
            'item' => $item
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
            'barcode' => ['required',Rule::unique('items','barcode')->ignore($id)],
            'name' => ['required'],
            'category_id' => ['required'],
            'unit_id' => ['required'],
            'price' => ['required','numeric']
        ]);
        $data = request()->all();
        $data['slug'] = Str::slug(request('name'));
        $item = Item::findOrFail($id);
        $item->update($data);
        return redirect()->route('items.index')->with('success','Item berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->route('items.index')->with('success','Item berhasil dihapus');
    }
}

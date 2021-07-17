<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('name','ASC')->get();
        return view('pages.suppliers.index',[
            'title' => 'Data Suppliers',
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.suppliers.create',[
            'title' => 'Tambah Supplier',
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
            'name' => ['required','min:3'],
            'phone_number' => ['required','unique:suppliers,phone_number'],
            'description' => ['required'],
            'address' => ['required','min:5'],
        ]);
        $data = request()->all();
        Supplier::create($data);

        return redirect()->route('suppliers.index')->with('success','Supplier berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('pages.suppliers.edit',[
            'title' => 'Edit Supplier',
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        request()->validate([
            'name' => ['required','min:3'],
            'phone_number' => ['required',Rule::unique('suppliers','phone_number')->ignore($id)],
            'description' => ['required'],
            'address' => ['required','min:5'],
        ]);
        $supplier = Supplier::findOrFail($id);
        $data = request()->all();
        $supplier->update($data);

        return redirect()->route('suppliers.index')->with('success','Supplier berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success','Supplier berhasil dihapus');
    }
}

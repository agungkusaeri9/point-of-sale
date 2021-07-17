<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('name','ASC')->get();
        return view('pages.customers.index',[
            'title' => 'Data Customers',
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.customers.create',[
            'title' => 'Tambah Customer',
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
            'phone_number' => ['required','unique:customers,phone_number'],
            'gender' => ['required','in:L,P'],
            'address' => ['required','min:5'],
        ]);
        $data = request()->all();
        Customer::create($data);

        return redirect()->route('customers.index')->with('success','Customer berhasil ditambahkan');
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
        $customer = Customer::findOrFail($id);
        return view('pages.customers.edit',[
            'title' => 'Edit Customer',
            'customer' => $customer
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
            'name' => ['required','min:3'],
            'phone_number' => ['required',Rule::unique('customers','phone_number')->ignore($id)],
            'gender' => ['required','in:L,P'],
            'address' => ['required','min:5'],
        ]);
        $customer = Customer::findOrFail($id);
        $data = request()->all();
        $customer->update($data);

        return redirect()->route('customers.index')->with('success','Customer berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success','Customer berhasil dihapus');
    }
}

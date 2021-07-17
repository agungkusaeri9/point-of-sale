<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users.index',[
            'title' => 'Data Users'
        ]);
    }

    public function data()
    {
        $users = User::query();
        return datatables()->of($users)
            ->addIndexColumn()
            ->addColumn('role', function($users){
                return $users->getRoleNames()->first();
            })
            ->addColumn('action', 'pages.users.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'username' => ['required','unique:users,email'],
            'email' => ['required','email'],
            'password' => ['required','min:3'],
            'role' => ['required','in:admin,kasir'],
        ]);
        $data = request()->all();
        $data['password'] = bcrypt(request('password'));
        $user = User::create($data);
        $user->assignRole(request('role'));

        return response()->json(['code'=>200, 'message'=>'User Created successfully','data' => $user], 200);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name','ASC')->get();
        return view('pages.users.index',[
            'title' => 'Data Users',
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('pages.users.create',[
            'title' => 'Create new users',
            'roles' => $roles
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
            'username' => ['required','unique:users,username','alpha_dash'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:3'],
            'role' => ['required','in:admin,kasir'],
        ]);
        $data = request()->all();
        $data['password'] = bcrypt(request('password'));
        $user = User::create($data);
        $user->assignRole(request('role'));

        return redirect()->route('users.index')->with('success','User berhasil dibuat');
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
        $roles = Role::get();
        $user = User::findOrFail($id);
        return view('pages.users.edit',[
            'title' => 'Edit User',
            'roles' => $roles,
            'user' => $user
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
        $user = User::findOrFail($id);
        request()->validate([
            'name' => ['required','min:3'],
            'username' => ['required',Rule::unique('users','username')->ignore($id),'alpha_dash'],
            'email' => ['required','email',Rule::unique('users','email')->ignore($id)],
            'role' => ['required','in:admin,kasir'],
        ]);
        $data = request()->all();
        if(request('password'))
        {
            $data['password'] = bcrypt(request('password'));
        }else{
            $data['password'] = $user->password;
        }
        $user->update($data);
        $user->syncRoles(request('role'));

        return redirect()->route('users.index')->with('success','User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','User berhasil dihapus');
    }
}

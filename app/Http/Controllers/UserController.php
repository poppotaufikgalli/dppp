<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete("Hapus Data User", "Apakah anda yakin untuk menghapus data ini?");
        return view('admin.user.index', [
            'data' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.formulir', [
            'next'  => 'user.store',
            'method' => 'create',
            'group' => Group::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reqData = $request->all();
        /*$reqData['mfa'] = isset($reqData['mfa']) && $reqData['mfa'] == 'on' ? 1 : 0;

        if($reqData['mfa'] == 1){
            $google2fa = new Google2FA();
            $reqData['mfa_secret'] = $google2fa->generateSecretKey();
        }*/
        
        //dd($reqData);
        if(isset($reqData['aktif'])){
            $reqData['aktif'] = 1;
        }else{
            $reqData['aktif'] = 0;
        }

        $validator = Validator::make($reqData, [
            'name' => 'required|unique:users,name',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'gid' => 'required',
            'password' => 'required|min:8',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username telah terdaftar',

            'name.required' => 'Nama Pengguna tidak boleh kosong',
            'name.unique' => 'Nama Pengguna telah terdaftar',

            'email.required' => 'Email Pengguna tidak boleh kosong',
            'email.unique' => 'Email Pengguna telah terdaftar',

            'gid.required' => 'Group Pengguna tidak boleh kosong',

            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Panjang Password tidak Valid. minimal 8 karakter',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reqData['crid'] = $request->session()->get('nip');

        User::create($reqData);
        return redirect('/user')->withSuccess("Data User berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, string $id)
    {
        return view('admin.user.formulir', [
            'data'=> $user->find($id),
            'next'  => 'user.update',
            'method' => 'edit',
            'group' => Group::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $id = $request->id;
        $reqData = $request->only('nama', 'username', 'gid', 'aktif', 'email');
        if(isset($reqData['aktif'])){
            $reqData['aktif'] = 1;
        }else{
            $reqData['aktif'] = 0;
        }

        $validator = Validator::make($reqData, [
            'name' => 'required|unique:users,name,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|unique:users,email,'.$id,
        ],[
            'name.required' => 'Nama Pengguna tidak boleh kosong',
            'name.unique' => 'Nama Pengguna telah terdaftar',

            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username telah terdaftar',

            'email.required' => 'Email Pengguna tidak boleh kosong',
            'email.unique' => 'Email Pengguna telah terdaftar',
        ]);

        if($validator->fails())
        {
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }
        
        $user->find($id)->update($reqData);
        return redirect('user')->withSuccess('Data Pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, string $id)
    {
        $user->find($id)->delete();
        return redirect('user')->withSuccess('Data User berhasil dihapus');
    }

    public function resetPassword(User $user, Request $request)
    {
        $reqData = $request->only('password', 'password_confirmation');
        
        $id = $request->id;

        $data = $user->find($id);

        if($request->admin == 0){
            if (!Hash::check($request->password_old, $data->password)) {
                return back()->with('errors', "Password Lama tidak sesuai");
            }
        }

        $validator = Validator::make($reqData, [
            'password' => 'required|min:8|confirmed',
        ],[
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Panjang Password tidak Valid. minimal 8 karakter',
            'password.confirmed' => 'Password dan Konfirmasi Password tidak sesuai',
        ]);

        if($validator->fails())
        {
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }

        $data->update($reqData);

        if($request->admin == 0){
            return redirect()->back()->with('success', 'Password '.$data->name.' berhasil dirubah');    
        }else{
            return redirect('user')->with('success', 'Password '.$data->name.' berhasil dirubah');
        }
        
    }
}

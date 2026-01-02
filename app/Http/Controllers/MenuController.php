<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$data = Menu::isMain()->get();
        confirmDelete('Hapus Menu', 'Apakah anda yakin mau menghapus menu ini?');
        return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($ref)
    {
        return view('admin.menu.formulir', [
            'next' => 'menu.store',
            'method' => 'create',
            'ref_menu' => Menu::find($ref),
            'halaman' => Konten::isHalaman()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reqData = $request->all();
            
        $reqData['jns'] = $reqData['jns'][0];
        $reqData['kategori'] = 1;
        $validator = Validator::make($reqData, [
            'judul' => 'required|min:3|unique:menu,judul',
            'jns' => 'required',
            'target' => 'required'
        ],[
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.min' => 'Judul minimal 3 Karakter',
            'judul.unique' => 'Judul telah terdaftar',
            
            'jns.required' => 'Jenis tidak Valid',
            'target.required' => 'Target tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Menu::create($reqData);
        return redirect('menu')->withSuccess("Data Menu berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu, $id)
    {
        $data = $menu->with('referensi')->find($id);
        return view('admin.menu.formulir', [
            'next' => 'menu.update',
            'method' => 'edit',
            'data' => $data,
            'ref_menu' => $data->referensi,
            'halaman' => Konten::isHalaman()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $reqData = $request->only('ref', 'judul', 'jns', 'target');
        $id = $request->id;;
            
        $reqData['jns'] = $reqData['jns'][0];
        //$reqData['kategori'] = 1;
        $validator = Validator::make($reqData, [
            'judul' => ['required', 'min:3', Rule::unique('menu')->ignore($id)],
            'jns' => 'required',
            'target' => 'required'
        ],[
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.min' => 'Judul minimal 3 Karakter',
            'judul.unique' => 'Judul telah terdaftar',
            
            'jns.required' => 'Jenis tidak Valid',
            'target.required' => 'Target tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $menu->find($id)->update($reqData);
        return redirect('menu')->withSuccess("Data Menu berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, $id)
    {
        $menu->find($id)->delete();
        return redirect('menu')->withSuccess("Data Menu berhasil dihapus.");
    }
}

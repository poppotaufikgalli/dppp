<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class GroupController extends Controller
{
    protected function getControllerList($searchText='index')
    {
        $routelist = Route::getRoutes();
        //dd($routelist);
        $jns_hal = array_keys($this->jns_hal);
        $ret = [];
        foreach ($routelist as $key => $value) {
            if($value->getActionMethod() == $searchText){
                if(!in_array($value->getName(), $jns_hal)){
                    $ret[] = $value->getName();    
                }
            }
        }

        return $ret;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete('Hapus Group', 'Apakah anda yakin mau menghapus group ini?');
        return view('admin.group.index', [
            'data' => Group::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.group.formulir', [
            'next' => 'group.store',
            'method' => 'create',
            'routelist' => $this->getControllerList(),
            'kontenakses' => $this->jns_hal,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reqData = $request->only('nama');
        $validator = Validator::make($reqData, [
            'nama' => 'required|min:3|unique:group,nama',
        ],[
            'nama.required' => 'Nama Group tidak boleh kosong',
            'nama.min' => 'Nama Group minimal 3 Karakter',
            'nama.unique' => 'Nama Group telah terdaftar',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        if($request->input('lsakses')){
            $reqData['lsakses']['menu'] = json_encode($request->lsakses);
        }else{
            $reqData['lsakses']['menu'] = "null";
        }

        if($request->input('kontenakses')){
            $reqData['lsakses']['kontenakses'] =  json_encode($request->kontenakses);    
        }

        if(!isset($reqData['lsakses'])){
            return redirect()->back()->withErrors('Data akses masih kosong')->withInput();
        }

        $reqData['lsakses'] = json_encode($reqData['lsakses']);    
        
        //dd($reqData);
        Group::create($reqData);
        return redirect('/group')->with('success', "Data Group berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group, $id)
    {
        return view('admin.group.formulir', [
            'next' => 'group.update',
            'method' => 'edit',
            'routelist' => $this->getControllerList(),
            'kontenakses' => $this->jns_hal,
            'data' => $group->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $reqData = $request->only('nama');
        $id = $request->id;
        $validator = Validator::make($reqData, [
            'nama' => ['required', 'min:3', Rule::unique('group')->ignore($id)],
        ],[
            'nama.required' => 'Nama Group tidak boleh kosong',
            'nama.min' => 'Nama Group minimal 3 Karakter',
            'name.unique' => 'Nama Group telah terdaftar',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        $reqData['lsakses'] = [
            'menu' => json_encode($request->lsakses),
            'kontenakses' => json_encode($request->kontenakses),
        ];
        //$reqData['upid'] = $request->session()->get('nip');
        //dd($reqData);
        $group::find($id)->update($reqData);
        return redirect('/group')->with('success', "Data Group berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group, $id)
    {
        $group::find($id)->delete();
        return redirect('/group')->with('success', "Data Group berhasil dihapus.");
    }
}

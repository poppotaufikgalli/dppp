<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Storage::disk('public')->allFiles('banner');
        return view('admin.banner.index', [
            'banner' => $banner,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $reqData['guid'] = $request->guid;
        $validator = Validator::make($reqData, [
            'guid' => 'required|image|max:2048',
        ],[
            'guid.required' => 'File tidak boleh kosong',
            'guid.image' => 'File tidak Valid',
            'guid.max' => 'File melebihi 2 mb',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $path = $request->file('guid')->store('banner', 'public');
        
        return redirect('/banner')->with([
            'success'=> "Data Banner berhasil ditambahkan."
        ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

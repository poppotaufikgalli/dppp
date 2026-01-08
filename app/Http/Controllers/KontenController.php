<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    protected $lskonfig = [
        ['id'=>'po', 'judul'=>'popup'],
        ['id'=>'fb', 'judul'=>'facebook'], 
        ['id'=>'yt', 'judul'=>'youtube'], 
        ['id'=>'ig', 'judul'=>'instagram'], 
        ['id'=>'tk', 'judul'=>'tiktok'], 
        ['id'=>'vd', 'judul'=>'video'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jns = trim($request->route()->getPrefix(),'/');

        $konten = Konten::where('jns', $jns)->where(function($query) use($request){
            if(isset($request->publish) && $request->publish != 'A'){
                $query->where('publish', $request->publish);
            }
        })->paginate(10);

        confirmDelete("Hapus Data Konten", "Apakah anda yakin untuk menghapus data ini?");
        return view('admin.konten.index', [
            //'subtitle' => $this->jns_hal[$katagori],
            'jns' => $jns,
            'publish' => $request->publish,
            'data' => $konten,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jns = trim($request->route()->getPrefix(),'/');
        $data = [
            'jns' => $jns,
            'lsalbum' => Konten::isAlbum()->paginate(10),
            'next' => $jns.'.store',
            'method' => 'create',
        ];
        
        return view('admin.konten.formulir', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reqData = $request->only('jns','judul','guid', 'guid_text', 'alamat', 'content_at', 'popup', 'album_id');
        //dd($reqData);
        $reqData['isi'] = in_array($reqData['jns'], ['l', 'sm','qr']) ? $reqData['alamat'] : $request->input('editor');

        $reqData['isi'] = strip_tags($reqData['isi'], '<figure><oembed><img><p><h2><h4><strong><i><a><ul><ol><li><table><thead><tbody><tfoot><tr><th><td><blockquote>');
        $reqData['isi'] = preg_replace('#javascript:(.*?)\)#is', '', $reqData['isi']);
        $reqData['isi'] = preg_replace('#script:(.*?)\)#is', '', $reqData['isi']);
        
        $config = ['HTML.Allowed' => 'oembed'];

        if(in_array($reqData['jns'], ['l'])){
            $reqData['kategori'] = isset($request->kategori) ? $request->kategori : 1;
        }

        if(isset($reqData['popup'])){
            $reqData['popup'] = 1;
        }else{
            $reqData['popup'] = 0;
        }
        
        $validator = Validator::make($reqData, [
            'judul' => [
                'required',
                'min:3',
                Rule::unique('konten')->where(function ($query) use($reqData) {
                    return $query->where('judul', $reqData['judul'])
                    ->where('jns', $reqData['jns']);
                }),
            ],
            'jns' => 'required',
            'isi' => 'required|min:3',
            'guid' => 'sometimes|max:20000|mimetypes:image/jpeg,image/png',
            'alamat' => 'sometimes|url|unique:konten,isi',
        ],[
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.min' => 'Judul minimal 3 Karakter',
            'judul.unique' => 'Judul telah terdaftar',

            'isi.required' => 'Isi tidak boleh kosong',
            'isi.min' => 'Isi minimal 3 Karakter',

            'jns.required' => 'Jenis tidak Valid',
            
            'guid.max' => 'Ukuran Gambar melebihi 2 Mb',
            'guid.mimes' => 'Gambar tidak Valid',

            'alamat.url' => 'Alamat tidak Valid',
            'alamat.unique' => 'Alamat Telah terdaftar',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(isset($reqData['guid'])){
            $path = $request->file('guid')->store($reqData['jns'], 'public');
            $reqData['guid'] = $path;
        }

        if($reqData['popup'] == 1){
            Konten::where(['popup' => 1])->update(['popup' => 0]);    
        }
        
        Konten::create($reqData);
        if($reqData['jns'] == 'g'){
            return redirect()->back()->withSuccess("Data berhasil ditambahkan.");
        }
        return redirect($reqData['jns'].'/A')->withSuccess("Data berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Konten $konten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konten $konten, $id)
    {
        $dt = $konten->find($id);
        $data = [
            'data' => $dt,
            'lsalbum' => Konten::isAlbum()->paginate(10),
            'jns' => $dt->jns,
            'next' => $dt->jns.'.update',
            'method' => 'edit',

        ];

        if($dt->jns == 'g'){
            $data['lsalbum'] = Konten::isGaleri()->distinct()->pluck('guid_text');
        }

        return view('admin.konten.formulir', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konten $konten)
    {
        //dd($request->all());
        $id = $request->id;
        $reqData = $request->only('jns','judul','guid', 'guid_text', 'alamat', 'content_at', 'popup', 'album_id');
        $reqData['isi'] = in_array($reqData['jns'], ['l', 'sm']) ? $reqData['alamat'] : $request->input('editor');

        $reqData['isi'] = strip_tags($reqData['isi'], '<figure><oembed><img><p><h2><h4><strong><i><a><ul><ol><li><table><thead><tbody><tfoot><tr><th><td><blockquote>');
        $reqData['isi'] = preg_replace('#javascript:(.*?)\)#is', '', $reqData['isi']);
        $reqData['isi'] = preg_replace('#script:(.*?)\)#is', '', $reqData['isi']);
        
        $config = ['HTML.Allowed' => 'oembed'];

        if(in_array($reqData['jns'], ['l'])){
            $reqData['kategori'] = isset($request->kategori) ? $request->kategori : 1;
        }

        if(isset($reqData['popup'])){
            $reqData['popup'] = 1;
        }else{
            $reqData['popup'] = 0;
        }
        
        $validator = Validator::make($reqData, [
            'judul' => [
                'required',
                'min:3',
                Rule::unique('konten')->where(function ($query) use($reqData) {
                    return $query->where('judul', $reqData['judul'])
                    ->where('jns', $reqData['jns']);
                })->ignore($id),
            ],
            'jns' => 'required',
            'isi' => 'required|min:3',
            'guid' => 'sometimes|max:20000|mimetypes:image/jpeg,image/png',
        ],[
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.min' => 'Judul minimal 3 Karakter',
            'judul.unique' => 'Judul telah terdaftar',

            'isi.required' => 'Isi tidak boleh kosong',
            'isi.min' => 'Isi minimal 3 Karakter',

            'jns.required' => 'Jenis tidak Valid',
            
            'guid.max' => 'Ukuran Gambar melebihi 2 Mb',
            'guid.mimes' => 'Gambar tidak Valid',
        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(isset($reqData['guid'])){
            $path = $request->file('guid')->store($reqData['jns'], 'public');
            $reqData['guid'] = $path;
        }

        if($reqData['popup'] == 1){
            Konten::where(['popup' => 1])->update(['popup' => 0]);
        }
        
        $konten->find($id)->update($reqData);
        return redirect($reqData['jns'].'/A')->withSuccess("Data berhasil diubah");
    }

    public function publikasi(Request $request, Konten $konten, $id)
    {
        $data = $konten->find($id);
        $data->update([
            'publish' => $data->publish == 'Y' ? 'N' : 'Y',
        ]);

        return redirect($data->jns.'/A')->withSuccess($data->publish == 'N' ? 'Publikasi berhasil dibatalkan' : 'Data berhasil dipublikasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konten $konten, $id)
    {
        $data = $konten->find($id)->delete();
        
        return redirect()->back()->withSuccess('Data Konten berhasil dihapus');
    }

    public function galeri(Konten $konten, $id)
    {
        $data = $konten->find($id);
        confirmDelete("Hapus Item Galeri", "Apakah anda yakin untuk menghapus data ini?");
        return view('admin.konten.galeri', [
            'data' => $data,
            'jns' => $data->jns,
        ]);
    }

    public function galeri_store(Request $request)
    {
        $reqData = $request->only('jns','judul','guid', 'album_id', 'isi');
        
        $validator = Validator::make($reqData, [
            'judul' => [
                'required',
                'min:3',
                Rule::unique('konten')->where(function ($query) use($reqData) {
                    return $query->where('judul', $reqData['judul'])
                    ->where('jns', $reqData['jns']);
                }),
            ],
            'jns' => 'required',
            'isi' => 'required|min:3',
            'guid' => 'required|max:20000|mimetypes:image/jpeg,image/png',
        ],[
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.min' => 'Judul minimal 3 Karakter',
            'judul.unique' => 'Judul telah terdaftar',

            'jns.required' => 'Jenis tidak Valid',

            'isi.required' => 'Isi tidak boleh kosong',
            'isi.min' => 'Isi minimal 3 Karakter',
            
            'guid.max' => 'Ukuran Gambar melebihi 2 Mb',
            'guid.mimes' => 'Gambar tidak Valid',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(isset($reqData['guid'])){
            $path = $request->file('guid')->store($reqData['jns'], 'public');
            $reqData['guid'] = $path;
        }
        
        Konten::create($reqData);
        return redirect()->back()->withSuccess("Data berhasil ditambahkan.");
    }
}

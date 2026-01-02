<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;
use App\Models\BukuTamu;
use App\Models\Visited;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use DB;

class DinasController extends Controller
{
    public function __construct()
    {
        // method to save visitor by package: https://github.com/shetabit/visitor
        // visitor()->visit();
    }

    public function view()
    {
        // return view('main2', [
        //     'masonry' => Konten::isKonten()->whereIn('jns', ['b', 'g', 'h'])->get()->take(9),
        // ]);
        $kegiatan = Konten::isKonten()
                ->where('jns', 'k')
                ->whereMonth('content_at', date('m'))
                ->whereYear('content_at', date('Y'));
        return view('main', [
            'banner' => Konten::isKonten()->where('jns', 'bn')->paginate(6),
            'berita' => Konten::isKonten()->where('jns', 'b')->paginate(6),
            'galeri' => Konten::isKonten()->where('jns', 'g')->paginate(6),
            'kegiatan' => $kegiatan->get()->take(6),
            'keg' => $kegiatan->where('content_at', '>=', now())->orderBy('content_at')->first(),
            'popup' => Konten::isKonten()->firstWhere('popup', 1),
            //'masonry' => Konten::isKonten()->whereIn('jns', ['b', 'g', 'h'])->get()->take(9),
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function dashboard()
    {
        $bukutamu = BukuTamu::orderByDesc('created_at')->get();
        $konten_populer = Konten::isKonten()->orderByDesc('klik')->get()->take(10);
        $today = now()->format('Y-m-d');
        $visit_today = DB::table('shetabit_visits')
            ->select('ip')
            ->whereDate('created_at', '=', $today)
            ->get()
            ->count();
        $kunjungan = Visited::pluck('visit_day', 'tgl')->take(7);
        $kunjungan = [...$kunjungan, ...[$today => $visit_today]];
        //dd($kunjungan);
        return view('admin.dashboard', compact('bukutamu', 'konten_populer', 'kunjungan'));
    }

    public function page($page, $slug=null)
    {
        $jns = array_search(ucwords($page), $this->jns_hal, true);
        if(!$jns){
            return view('notfound');
        }
        
        $konten = Konten::isKonten()->where('jns', $jns)->get();
        $data = $konten->where('slug', $slug)->first();
        
        if(isset($data)){
            $data->klik += 1;
            $data->save();
        }

        return view('page', [
            'data' => $data,
            'jns' => $jns,
            'lsdata' => $slug == null ? $konten : $konten->toQuery()->paginate(6),
            'slug' => $slug,
            'page' => ucwords($page),
        ]);
    }

    public function bukutamu(Request $request)
    {
        if($request->isMethod('post')){
            $reqData = $request->only('nama', 'email', 'pesan');

            $validator = Validator::make($reqData, [
                'nama' => 'required|regex:/^[a-zA-Z0-9,. ]+$/',
                'email' => 'required|email',
                'pesan' => 'required|regex:/^[a-zA-Z0-9,. ]+$/',
            ],[
                'nama.required' => 'Nama tidak boleh kosong',
                'nama.regex' => 'Nama Tidak Valid',

                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email Tidak Valid',

                'pesan.required' => 'Pesan tidak boleh kosong',
                'pesan.regex' => 'Pesan Tidak Valid',
            ]);


            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $reqData['ip_address'] = $request->ip();

            //dd($reqData);

            BukuTamu::create($reqData);
      
            return redirect()->route('main')->withSuccess('Terima kasih telah mengisi buku tamu '.env('APP_NAME'));
            
        }else{
            return view('bukutamu');    
        }
    }
}

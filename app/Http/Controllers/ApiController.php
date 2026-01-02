<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Visited;
use DB;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function uploadCK(Request $request, $folder){
        $reqData['upload'] = $request->upload;
        $validator = Validator::make($reqData, [
            'upload' => 'required|mimes:png,jpg,jpeg|max:2048',
        ],[
            'upload.required' => 'File tidak boleh kosong',
            'upload.mimes' => 'File tidak Valid',
            'upload.max' => 'File melebihi 2 mb',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'uploaded' => false,
                'fileName' => '',
                'url' => '',
            ], 200);
        }

        $path = $request->file('upload')->store($folder, 'public');

        if($path){
            $retval = [
                'uploaded' => true,
                'fileName' => $path,
                'url' => '/storage/'.$path,
            ];
        }else{
            $retval = [
                'uploaded' => false,
                'fileName' => '',
                'url' => '',
            ];
        }

        return response()->json($retval, 200);
    }

    public function getListKunjungan($bln = null, $thn = null)
    {
        $thn = $thn ?? date('Y');
        $bln = $bln ?? date('m');
        $tanggal = Carbon::create($thn.'-'.$bln.'-01 00:00:00');
        $dari = $tanggal->copy()->startOfMonth()->format('Y-m-d H:i:s');
        $sampai = $tanggal->copy()->endOfMonth()->format('Y-m-d H:i:s');
        $data = DB::table('shetabit_visits')->whereBetween('created_at', [$dari, $sampai])->get();
        foreach($data as $d) {
            unset($d->headers);
        }
        $jml = count($data);
        
        return response()->json(compact('dari', 'sampai', 'jml', 'data'), 200);
    }

    public function getDataKunjungan()
    {
        $today = Carbon::now()->subDays(1)->format('Y-m-d');
        $online_user = DB::table('shetabit_visits')
            ->select('ip')
            ->whereBetween('created_at', [Carbon::now()->subHour()->format('Y-m-d H:i:s'), Carbon::now()->format('Y-m-d H:i:s')])
            ->get()
            ->unique('ip')
            ->count();
        $visit_day = DB::table('shetabit_visits')
            ->select('ip')
            ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
            ->get()
            ->unique('ip')
            ->count();
        $visited = Visited::where('tgl', $today)->orderByDesc('id')->first();

        if($visited == null){
            $visited = (object) $this->createVisitedCron();
            //dd($visited->visit_month);
        }
        
        $visit_month = ($visited->visit_month ?? 0) + $visit_day;
        $visit_year = ($visited->visit_year ?? 0) + $visit_day;
        $visit_total = ($visited->total ?? 0) + $visit_day;    
        
        return response()->json(compact('today','online_user', 'visit_day', 'visit_month', 'visit_year', 'visit_total'), 200);
        
    }   

    protected function createVisitedCron(){
        $create['tgl'] = Carbon::now()->subDays(1)->format('Y-m-d');
        $create['visit_day'] = DB::table('shetabit_visits')->select('ip')
            ->whereDate('created_at', '=', $create['tgl'])
            ->get()
            ->unique('ip')
            ->count();
        $create['visit_month'] = DB::table('shetabit_visits')->select('ip')
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->get()
            ->count();
        $create['visit_year'] = DB::table('shetabit_visits')->select('ip')
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->get()
            ->count();
        $create['total'] = DB::table('shetabit_visits')->select('ip')
            ->get()
            ->count();
        $data = Visited::where('tgl', $create['tgl'])->orderByDesc('id')->first();

        return $create;

        if(isset($data)){
            $data['updated_at'] = Carbon::now();
            $data->update($create);
        }else{
            $create['created_at'] = Carbon::now();
            DB::table('visiteds')->insert($create);
        }
    }
}

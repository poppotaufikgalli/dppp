<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Visited;
use App\Models\ShetabitVisits;
use Carbon\Carbon;
use DB;

class VisitedCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visited:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export Visited Info to visited table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
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
        if(isset($data)){
            $data['updated_at'] = Carbon::now();
            $data->update($create);
        }else{
            $create['created_at'] = Carbon::now();
            DB::table('visiteds')->insert($create);
        }
        
        \Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));
    }
}

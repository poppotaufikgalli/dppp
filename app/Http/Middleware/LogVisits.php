<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \Shetabit\Visitor\Models\Visit;
use Carbon\Carbon;

class LogVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $logHasSaved = false;

        //dd($request->visitor()); // firefox

        // create log for first binded model
        foreach ($request->route()->parameters() as $parameter) {
            if ($parameter instanceof Model) {
                visitor()->visit($parameter);

                $logHasSaved = true;

                break;
            }
        }
        
        //check last visit 1 hour
        $lastVisit = visit::orderByDesc('id')->first();
        //dd($lastVisit);
        if(isset($lastVisit)){
            
            $url = $lastVisit->url;
            $referer = $lastVisit->referer;
            
            $lasthit = $lastVisit->created_at;
            $ipaddr = $lastVisit->ip;
            $useragent = $lastVisit->useragent;

            $startTime = Carbon::parse($lasthit);
            $endTime = Carbon::now();
            $totalDuration = $startTime->diffInMinutes($endTime);
            //dd($startTime, $endTime, $totalDuration, (in_array(visitor()->url(), [$url, $referer])) || (visitor()->referer() != null), $totalDuration < 6);
            
            if( (in_array(visitor()->url(), [$url, $referer])) || (visitor()->referer() != null) ){
                //jangan disave
                if($totalDuration < 60){
                    $logHasSaved = true;    
                }
            }
        }

        // create log for normal visits
        if (!$logHasSaved) {
            visitor()->visit();    
        }

        return $next($request);
    }
}

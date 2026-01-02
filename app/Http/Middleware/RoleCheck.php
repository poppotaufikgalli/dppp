<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lsAkses = json_decode(Auth::user()->group->lsakses);
        $menu = json_decode($lsAkses->menu, true) ?? [];
        $konten = json_decode($lsAkses->kontenakses, true) ?? [];

        $currentPath = explode('.', Route::currentRouteName());
        
        if(in_array($currentPath[0], array_keys($menu))){
            if(isset($currentPath[1])){
                $subAction = $menu[$currentPath[0]];
                $scr = "_".$currentPath[1];

                if(!in_array($scr, $subAction)){
                    $subAction[] = $scr;
                    return redirect()->back()->withErrors("Aksi tidak sesuai hak akses!\nHubungi administrator");
                }
            }
            return $next($request);
        }else if(in_array($currentPath[0], array_keys($konten) )){
            if(isset($currentPath[1])){
                $subAction = $konten[$currentPath[0]];
                $scr = "_".$currentPath[1];
                // dd($currentPath, $subAction, $scr);

                if(!in_array($scr, $subAction)){
                    $subAction[] = $scr;
                    return redirect()->back()->withErrors("Aksi tidak sesuai hak akses!\nHubungi administrator");
                }
            }

            return $next($request);
        }

        return redirect('/unauthorize');
    }
}

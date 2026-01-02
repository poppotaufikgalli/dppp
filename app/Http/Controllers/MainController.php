<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Konten;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function GetMenu(){
        return $this->getStrukturMenu();
    }

    public function GetLink()
    {
        $retval = [];
        $lsKat = ['', 'Daerah', 'Nasional', 'Internasional'];
        $dlink = Konten::isLink()->get();
        if(isset($dlink)){
            foreach ($dlink as $key => $value) {
                $kat = $lsKat[$value->kategori];
                $retval[$kat][] = $value;
            }
        }
        return $retval;
    }

    public function GetSosmed()
    {
        $retval = Konten::isSosmed()->pluck('isi', 'guid');
        return $retval;
    }

    protected function getStrukturMenu($selKategori = 1){
        $lsmenu = Menu::where('kategori', $selKategori)->get();
        $retmenu = [];
        $main = [];
        $sub = [];
        $listMenu = [];
        if($lsmenu){
            foreach ($lsmenu as $key => $value) {
                $ref = $value->ref;
                $id = $value->id;
                if($ref > 0){
                    $sub[$ref][] = $value;
                }
            }

            foreach ($lsmenu as $key => $value) {
                $ref = $value->ref;
                $id = $value->id;
                if($ref == 0){
                    if(isset($sub[$id])){
                        $value['sub'] = $sub[$id];
                    }
                    $main[] = $value;
                }
            }
        }

        return ['main' => $main, 'sub' => $sub];
    }

    public function getHal($w=''){
        if($w==''){
            return $this->jns_hal;  
        }else{
            return $this->jns_hal[$w];  
        }
    } 

    /*public function GetVisits(){
        return VVisitor1::first();
    }*/
}

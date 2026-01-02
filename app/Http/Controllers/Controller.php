<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //    
    public $jns_hal = [
        'bn' => 'Banner',
        'b' => 'Berita',
        'bl' => 'Blog',
        //'g' => 'Galeri',
        'ag' => 'Album Galeri',
        'h' => 'Halaman',
        'k' => 'Kegiatan',
        'l' => 'Link',
        'sm' => 'Sosial Media',
    ];
}

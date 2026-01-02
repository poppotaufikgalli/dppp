<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $table = 'bukutamus';

    protected $fillable = [
        'nama',
        'email',
        'pesan',
        'ip_address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'ip_address',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    //
    protected $table = 'group';

    public function nakses()
    {
        return $this->hasMany(User::class, 'gid');
    }

    protected $fillable = [
        'nama',
        'lsakses',
        'crid',
        'upid',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->crid = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            //$model->crname = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->nama : "";
            $model->upid = NULL;
        });

        static::updating(function ($model) {
            $model->upid = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            //$model->upname = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->nama : "";
        });
    }
}

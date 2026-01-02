<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    public function referensi()
    {
        return $this->belongsTo(Menu::class, 'ref', 'id');
    }

    public function sub()
    {
        return $this->HasMany(Menu::class, 'ref', 'id');
    }

    public function halaman_target()
    {
        return $this->belongsTo(Konten::class, 'target', 'id');
    }

    #[Scope]
    protected function isMain(Builder $query)
    {
        $query->where('kategori', 1)->where('ref', 0);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'guid',
        'keterangan',
        'ref',
        'jns',
        'kategori',
        'target',
        'crid',
        'upid',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->crid = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            //$model->upid = NULL;
        });

        static::updating(function ($model) {
            $model->upid = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
        });
    }
}

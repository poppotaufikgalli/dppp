<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Konten extends Model
{
    use HasFactory;

    protected $table = 'konten';
    
    protected $appends = [
        //'ytUri',
        'truncateIsi',
    ];

    protected $casts = [
        //'isi'            => CleanHtml::class, // cleans both when getting and setting the value
        //'description'    => CleanHtmlInput::class, // cleans when setting the value
        //'isi'        => CleanHtmlOutput::class, // 
        'isi'   => PurifyHtmlOnGet::class,
        'publish_at' => 'datetime',
        'content_at' => 'datetime',
    ];

    /*public function getYtUriAttribute()
    {
        $uri = $this->isi;
        $doc = new DOMDocument();
        @$doc->loadHTML($uri);
        $el = $doc->getElementsByTagName('oembed');
        if(count($el)>0){
            return $el[0]->getAttribute('url');    
        }
        return null;
    }*/

    public function getTruncateIsiAttribute()
    {
        return substr($this->isi, 0, 20);
    }

    #[Scope]
    protected function isKonten(Builder $query)
    {
        $query->where('publish', 'Y')->orderBy('content_at', 'desc');
    }

    #[Scope]
    protected function isBerita(Builder $query)
    {
        $query->where('jns', 'b')->where('publish', 'Y');
    }

    #[Scope]
    protected function isHalaman(Builder $query)
    {
        $query->where('jns', 'h')->where('publish', 'Y');
    }

    #[Scope]
    protected function isLink(Builder $query)
    {
        $query->where('jns', 'l')->where('publish', 'Y');
    }

    #[Scope]
    protected function isGaleri(Builder $query)
    {
        $query->where('jns', 'g')->where('publish', 'Y');
    }

    #[Scope]
    protected function isSosmed(Builder $query)
    {
        $query->where('jns', 'sm')->where('publish', 'Y');
    }

    #[Scope]
    protected function isAlbum(Builder $query)
    {
        $query->where('jns', 'ag')->where('publish', 'Y');
    }

    public function gambar()
    {
        return $this->hasMany(Konten::class, 'album_id', 'id');
    }

    public function album()
    {
        return $this->belongsTo(Konten::class, 'album_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'isi',
        'guid',
        'guid_text',
        'album_id',
        'pdf',
        'jns',
        'kategori',
        'klik',
        'slug',
        'popup',
        'publish',
        'publish_at',
        'content_at',
        'crid',
        'upid',
        'pubid',
        'crname',
        'upname',
        'pubname',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->crid = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            $model->crname = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->nama : "";
            $model->upid = NULL;
        });

        static::updating(function ($model) {
            if($model->publish == 'Y'){
                $model->publish_at = Carbon::now();
                $model->slug = Str::slug($model->judul, '-');
                $model->pubname = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->nama : "";
            }else{
                $model->publish_at = NULL;
                $model->pubname = NULL;
                $model->upid = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
                $model->upname = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->nama : "";
            }
            //$model->updated_at = Carbon::now();
        });

        static::addGlobalScope('content_at', function (Builder $builder) {
            $builder->orderByDesc('content_at');
        });
    }
}

@extends('layouts.master')

@section('title', $kontens[$jns] ?? '')

@section('content')
    <div style="min-height: 60vh;">
        <nav aria-label="breadcrumb" class="breadcrumb-page d-flex justify-content-center align-items-center">
            <h4 class="text-white">{{isset($data) ? $data->judul : $page}}</h4>
        </nav>
        <div class="container">
            @if($slug == null)
                @if(isset($lsdata))
                    <div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
                        @foreach($lsdata as $key => $value)
                            <div class="col">
                                <div class="card bg-accent rounded-0 border-0 h-100">
                                    @if(isset($value->guid))
                                    <div class="ratio ratio-16x9">
                                        <img alt="{{$page}}-{{$value->guid}}" class="glightbox" src="{{asset('storage/'.$value->guid)}}" />
                                    </div>
                                    @endif
                                    <div class="card-body d-flex align-content-between flex-wrap">
                                        <h6 class="fs-6">
                                            {{$value->judul}}
                                        </h6>
                                        <a href="{{route('page', ['slug' => $value->slug, 'page' => ucwords($page)])}}" class="stretched-link"></a>
                                        <div class="d-flex justify-content-between w-100 small">
                                            <span class="card-text mt-2">{{$value->crname}}</span>
                                            <span class="card-text mt-2">{{$value->content_at?->diffForHumans()}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="mt-5 mb-3 h-title fw-bolder">404<br>{{$kontens[$jns]}} tidak ditemukan</h4>
                @endif
            @else
                <div class="row g-4">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        @if(isset($data))
                            <h1 class="mb-3 h-title fw-bolder"></h1>
                            @if(isset($data->guid))
                                <img src="{{asset('storage/'.$data->guid)}}" class="img-fluid glightbox" alt="{{$data->guid}}">
                                @if(isset($data->guid_text))
                                <div class="py-2 text-center bg-secondary bg-opacity-10">
                                    <span class="text-muted small">{{$data->jns == 'g' ? 'Album :' : ''}} {{$data->guid_text}}</span>
                                </div>
                                @endif
                                @if($jns == 'g')
                                    <div class="mt-4 text-center">
                                        <a href="{{asset('storage/'.$data->guid)}}" target="_blank" download="" class="btn btn-sm btn-outline-secondary">Download Gambar</a>
                                    </div>
                                @endif
                            @endif

                            <div class="position-relative my-4" style="text-align: justify;">
                                <p>{!! $data->isi !!}</p>
                            </div>
                            @if($data->album?->gambar?->count() > 0)
                            <hr class="my-4"/>
                            <h5>Album Galeri</h5>
                            <div class="row row-cols-1 row-cols-md-3 g-3 mb-3">
                                @foreach($data->album->gambar as $key => $value)
                                    <div class="col">
                                        <div class="card">
                                            <div class="ratio ratio-16x9">
                                                <img src="{{asset('storage/'.$value->guid)}}" class="object-fit-cover" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <span class="fw-semibold">{{$value->judul}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex gap-3">
                                        <span class="small align-items-center">
                                            Dilihat : 
                                            {{$data->klik}}
                                        </span>
                                        <div class="vr"></div>
                                        <span class="small">
                                            {{$data->content_at?->diffForHumans()}}
                                        </span>
                                        <div class="vr"></div>
                                        <span class="small">
                                            {{$data->crname}}
                                        </span>
                                    </div>
                                    <div class="pe-4">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}"onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="Share on Facebook" target="_blank" class="btn btn-sm btn-primary text-white">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                        <a href="https://web.whatsapp.com/send?text={{Request::url()}}" target="_blank" class="btn btn-sm btn-success">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?text={{Request::url()}}" data-action="share/whatsapp/share" target="_blank" class="btn btn-sm btn-info text-white twitter-share-button">
                                            <i class="bi bi-twitter"></i>
                                        </a>
                                    </div> 
                                </div> 
                            </div>
                        @else
                            <h4 class="mt-5 mb-3 h-title fw-bolder">404<br>{{$kontens[$jns]}} tidak ditemukan</h4>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="d-flex flex-column align-items-stretch flex-shrink-0">
                            <div class="py-3 px-2 border-bottom">
                                <span class="fw-semibold">{{$kontens[$jns]}} Lainnya</span>
                            </div>
                            <div class="list-group list-group-flush border-bottom scrollarea" id="linklainnya">
                                @if($lsdata)
                                    @foreach($lsdata as $key => $value)
                                        <a href="{{route('page', ['slug' => $value->slug, 'page' => $kontens[$jns] ])}}" class="list-group-item list-group-item-action {{isset($data) && $data->id == $value->id ? 'active' : ''}}" aria-current="{{isset($data) && $data->id == $value->id ? 'true' : false}}">
                                            <strong class="mb-1">{{$value->judul}}</strong>
                                            <div class="col-10 mb-1 small"><small>{{__($value->content_at?->diffForHumans())}}</small></div>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            {{$lsdata->links()}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container py-5">
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <div class="p-2 flex-shrink-1">
                <h5 class="fw-semibold py-2">Lihat Konten Lainnya</h5>
            </div>
            <div class="p-2 w-100">
                <div class="list-group list-group-horizontal">
                    <a href="{{route('page', ['page' => 'Berita' ])}}" class="list-group-item w-100 hvr-sweep-to-right">
                        Berita
                    </a>
                    <a href="{{route('page', ['page' => 'Blog' ])}}" class="list-group-item w-100 hvr-sweep-to-right">
                        Blog
                    </a>
                    <a href="{{route('page', ['page' => 'Album Galeri' ])}}" class="list-group-item w-100 hvr-sweep-to-right">
                        Album Galeri
                    </a>
                    <a href="{{route('page', ['page' => 'Kegiatan' ])}}" class="list-group-item w-100 hvr-sweep-to-right">
                        Kegiatan
                    </a>
                    <a href="{{route('page', ['page' => 'Halaman' ])}}" class="list-group-item w-100 hvr-sweep-to-right">
                        Halaman
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-content')
<script type="text/javascript"> 
    
</script>
@endsection
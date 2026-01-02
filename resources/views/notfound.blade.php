@extends('layouts.master')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div style="min-height: 60vh;">
        <div class="container" style="padding-top: 100px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Tidak Ditemukan</li>
                </ol>
            </nav>
            <div class="d-flex flex-column align-items-center">
                <div class="hvr-float-shadow mb-5">
                    <div class="error mx-auto" data-text="404">404</div>
                    <p class="lead text-gray-800 mb-5">Maaf, Halaman Tidak Ditemukan</p>
                </div>
                <a class="hvr-sweep-to-left px-2" href="{{route('main')}}">&larr; Kembali Ke Beranda</a>
            </div>
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
                    <a href="{{route('page', ['page' => 'Galeri' ])}}" class="list-group-item w-100 hvr-sweep-to-right">
                        Galeri
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
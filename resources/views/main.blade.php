@extends('layouts.master')

@section('title', "Beranda")

@section('content')
    @include('partials.carousel')

    <section>
        <div class="container py-5" data-aos="fade-up" data-aos-duration="1000">
            <div class="py-2 d-flex flex-column justify-content-center align-items-center">
                <h4 class="fw-bold py-2 hvr-float-shadow">BIDANG</h4>
                <p class="small">Bidang pada Dinas Pertanian, Pangan, dan Perikanan Kota Tanjungpinang memberikan pelayanan sesuai dengan tugas Pokok dan Fungsi Dinas</p>
            </div>
            <div class="row row-cols-1 row-cols-md-4 mb-3 text-center">
                <div class="col">
                    <div class="card h-100 rounded-3 shadow-sm border-accent hvr-float-shadow h-100">
                        <img src="{{asset('storage/images/tani.jpg')}}" class="card-img" alt="Bidang Pertanian" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <p class="color-accent">Bidang Pertanian</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 rounded-3 shadow-sm border-accent hvr-float-shadow h-100">
                        <img src="{{asset('storage/images/ternak.jpg')}}" class="card-img" alt="Bidang Pertanian" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <p class="color-accent">Bidang Peternakan, Kesehatan Hewan dan Kesehatan Masyarakat Veteriner</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 rounded-3 shadow-sm border-accent hvr-float-shadow h-100">
                        <img src="{{asset('storage/images/tahan.jpg')}}" class="card-img" alt="Bidang Pertanian" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <p class="color-accent">Bidang Ketahanan Pangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 rounded-3 shadow-sm border-accent hvr-float-shadow h-100">
                        <img src="{{asset('storage/images/ikan.webp')}}" class="card-img" alt="Bidang Pertanian" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <p class="color-accent">Bidang Perikanan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if(isset($berita) && count($berita) > 0)
    <section>
        <div class="container py-5" data-aos="fade-up" data-aos-duration="1000">
            <div class="py-2 d-flex justify-content-between align-items-start">
                <h4 class="fw-bold py-2 hvr-float-shadow">BERITA TERBARU</h4>
                <a href="{{route('page', ['page' => 'Berita'])}}" class="text-decoration-none">
                    <span class="hvr-sweep-to-right ps-1 pe-2">
                        Berita Lainnya
                    </span>
                </a>
            </div>
            
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($berita as $key => $value)
                    <div class="col">
                        <div class="card bg-accent rounded-0 border-0 h-100">
                            <div class="ratio ratio-16x9">
                                <img alt="berita-{{$value->guid}}" class="object-fit-cover glightbox" src="{{asset('storage/'.$value->guid)}}" />
                            </div>
                            <div class="card-body d-flex align-content-between flex-wrap">
                                <h5 class="fs-6 line-clamp">
                                    {{$value->judul}}
                                </h5>
                                <a href="{{route('page', ['slug' => $value->slug, 'page' => 'Berita'])}}" class="stretched-link"></a>
                                <div class="d-flex justify-content-between w-100 small">
                                    <span class="card-text mt-2">{{$value->crname}}</span>
                                    <span class="card-text mt-2">{{$value->content_at?->diffForHumans()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(isset($galeri) && count($galeri) > 0)
    <section>
        <div class="container py-5" data-aos="fade-up" data-aos-duration="1500">
            <div class="py-2 d-flex justify-content-between align-items-start">
                <h4 class="fw-bold hvr-float-shadow">GALERI</h4>
                <a href="{{route('page', ['page' => 'Galeri'])}}" class="text-decoration-none">
                    <span class="hvr-sweep-to-right ps-1 pe-2">
                        Galeri Lainnya
                    </span>
                </a>
            </div>
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach($galeri as $key => $value)
                            <li class="glide__slide">
                                <a href="{{route('page', ['slug' => $value->slug, 'page' => 'Galeri'])}}" class="">
                                    <div class="h-100 position-relative galeri-box">
                                        <div class="ratio ratio-4x3">
                                            <img alt="galeri-{{$value->guid}}" class="object-fit-cover galeri-img" src="{{asset('storage/'.$value->guid)}}" />
                                        </div>
                                        <div class="position-absolute bottom-0 w-100 bg-accent text-light p-2 galeri-text">
                                            <p class="lh-1 small mb-0 line-clamp">{{$value->judul}}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left bg-accent" data-glide-dir="<" style="border: none; box-shadow: none; --bs-bg-opacity: .5;">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="glide__arrow glide__arrow--right bg-accent" data-glide-dir=">" style="border: none; box-shadow: none; --bs-bg-opacity: .5;">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(isset($kegiatan) && count($kegiatan) > 0)
    <section>
        <div class="container py-5" data-aos="fade-up" data-aos-duration="2000">
            <h4 class="fw-bold py-2 hvr-float-shadow">KEGIATAN</h4>
            <div class="row g-4">
                <div class="col-sm-9">
                    @if(isset($keg))
                    <div class="px-2 pb-2 bg-accent">
                        <h5 class="fw-bold py-2">{{$keg->judul}}</h5>
                        <div class="row g-0 bg-light">
                            <div class="col p-2">
                                <div class="ratio ratio-4x3">
                                    <img src="{{asset('storage/'.$keg->guid)}}" class="object-fit-cover" alt="{{$keg->guid}}">
                                </div>
                                
                            </div>
                            <div class="col-sm-9 p-2 text-dark small position-relative">
                                <p class="text-muted">{{$keg->content_at?->translatedFormat('l, d M Y')}}</p>
                                <div class="line-clamp mb-2">
                                    {!! $keg->isi !!}
                                </div>
                                <a class="stretched-link hvr-sweep-to-right" href="{{route('page', ['slug' => $keg->slug, 'page' => 'Kegiatan'])}}">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-sm-3">
                    <div class="px-2 pb-2 bg-accent">
                        <h5 class="fw-bold py-2">{{\Carbon\Carbon::now()->translatedFormat('M Y')}}</h5>
                        <div class="list-group list-group-flush small lh-sm">
                            @foreach($kegiatan as $key => $value)
                                <a href="{{route('page', ['slug' => $value->slug, 'page' => 'Kegiatan'])}}" class="list-group-item list-group-item-action" aria-current="true">
                                    <p class="mb-1 {{isset($keg) && $keg->id == $value->id ? 'fw-bold' : ''}}">{{$value->judul}}</p>
                                    <span class="text-muted small float-end">{{$value->content_at?->translatedFormat('l, d M Y')}}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if($popup)
        <!-- Modal -->
        <div class="modal fade" id="modalPopup" tabindex="-1" aria-labelledby="modalPopupLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="ratio-4x3">
                            <img src="{{asset('storage/'.$popup->guid)}}" class="img-fluid">
                        </div>
                        <div class="my-2">
                            <a href="{{route('page', ['slug' => $popup->slug, 'page' => $kontens[$popup->jns]])}}" class="fs-6 stretched-link text-decoration-none text-dark">{{$popup->judul}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@push('scripts')

<script type="text/javascript">
    window.onload = (event)=> {
        const modalPopup = document.getElementById('modalPopup')
        if(modalPopup){
            console.log(modalPopup)
            const a = new bootstrap.Modal(document.getElementById('modalPopup'), {});
            a.show();
        }

        document.querySelectorAll('.carousel').forEach(el => {
            var inner = el.querySelector('.carousel-inner')
            console.log(inner.children[0].classList.add('active'))
        })
    }
    
    var lazyLoadInstance = new LazyLoad({});
    lazyLoadInstance.update();
</script>
@endpush
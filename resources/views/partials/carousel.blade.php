@if(isset($banner) && $banner->count() > 0)
<div class="min-vh-50">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($banner as $key => $value)
                @php($attr = $key == 0 ? 'class=active aria-current=true' : '' )
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$key}}" {{$attr}} aria-label="Slide {{$key+1}}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($banner as $key => $value)
                <div class="carousel-item">
                    <div class="ratio ratio-16x9">
                        <img data-src="{{asset('storage/'.$value->guid)}}" class="lazy object-fit-cover" alt="...">
                    </div>
                    <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.5);">
                        <h5 class="bg-accent m-2 p-2">{{$value->judul}}</h5>
                        <p class="small m-2 p-2">{!! $value->truncateIsi !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endif
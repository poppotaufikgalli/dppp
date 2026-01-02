@if(isset($masonry))
    <style>
        .masonry-container {
            display: grid;
            /*gap: 10px;*/
            grid-template-columns: repeat(auto-fill, minmax(50%, 1fr));
            grid-template-rows: masonry;
            .masonry-card{
                /*max-width: 33.33%;*/
                height: auto;
                overflow: hidden;
                position: relative;
                .masonry-card-img{
                    height: 100%;
                    object-fit: contain;
                }
                .masonry-card-text{
                    position: absolute;
                    bottom: 0;
                    padding: 5px 5px;
                    color: whitesmoke;
                    background-color: black;
                    width: 100%;
                    opacity: .7;
                    
                }
                &:hover{
                    .masonry-card-img{
                        transition: all .6s ease-in-out;
                        transform: scale(1.2);    
                    }
                } 
                &:has(:hover) :not(:hover){
                    .masonry-card-img{
                        transition: all .8s ease-in-out;
                        -webkit-filter: grayscale(1);
                        filter: grayscale(1);
                        opacity: .75;        
                    }
                }
            }
            .masonry-card:nth-child(n+1) {
                /*width: 75%;*/
                height: 75vh;
                /*width: 75vh;*/
            }
            .masonry-card:nth-child(n+2) {
                width: 100%;
                height: 25vh;
            }
        }   
        .card:nth-child(1){
            width: 100%;
                height: 25vh;
        }
    </style>
    <div class="container">
        <div class="row g-1" data-masonry='{ "percentPosition": true}'>
            @php($classList = ['col-sm-6 col-lg-4', 'col-sm-4 col-lg-2', 'col-sm-4 col-lg-2'])
            @foreach($masonry as $key => $value)
                @if($value->guid)
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-body">
                            <img src="{{asset('storage/'.$value->guid)}}" class="card-img" alt="{{$value->guid}}">
                            <div class="card-text">
                                <span class="small">{{$key}}. {{$kontens[$value->jns]}}</span>
                                <h5 class="fs-5 text-truncate">
                                    <a class="stretch-link text-decoration-none" href="{{route('page', ['page' => $kontens[$value->jns], 'slug' => $value->slug])}}">{{$value->judul}}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
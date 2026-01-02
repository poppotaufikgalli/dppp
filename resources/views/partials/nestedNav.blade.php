<ul class="dropdown-menu rounded-0 py-0 bg-transparent" style="font-size: 12px;">
    @foreach($data as $key => $value)
        @php($link = $value->jns == 0 ? "/#" : ($value->jns == 1 ? "/Halaman/".$value->halaman_target->slug : ($value->jns == 2 ? $value->target : "/".$kontens[$value->target])))
        @if(count($value->sub) > 0)
            <li class="nav-item bg-accent ps-2 py-0 border-bottom dropdown dropend">
                <a class="nav-link text-light dropdown-toggle dropdown-toggle-sub" href="{{$link}}" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">{{$value->judul}}</a>
                @include('partials.nestedNav', ['data' => $value->sub])
            </li>
        @else
            <li class="nav-item bg-accent ps-3 py-2 border-bottom">
                <a href="{{$link}}" class="text-light d-flex text-decoration-none">{{$value->judul}}</a>
            </li>
        @endif
    @endforeach
</ul>
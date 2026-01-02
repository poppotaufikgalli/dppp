@if(isset($menuSidebar) && isset($menuSidebar['main']))
<section>
	@foreach($menuSidebar['main'] as $key => $value)
		@php($img = $value->guid != '' ? asset('/images/menuIcon/'.$value->guid) : asset('/images/stack.svg'))
		<div class="mb-3 nbv-icon" style="background-image: url({{$img}})">
			<div class="text-bg-primary bg-opacity-50 p-4">
				<h5 class="h-title">{{$value->judul}}</h5>
				<span class="fst-italic fw-light lh-1">"{{$value->keterangan}}"</span>
			</div>
			<div class="bg-primary bg-opacity-10 px-4 py-2">
			@if(isset($value['sub']))
				<ul class="list-group list-group-flush">
					@foreach($value['sub'] as $k => $v)
					@php($link = $v->jns == 0 ? "/".$v->target : ($v->jns == 1 ? "/page/".$v->target : ($v->jns == 3 ? "/statjnsdokhukum/".$v->target :  ($v->jns == 4 ? "/statdokhukum/".$v->target :  ($v->jns == 5 ? "/lspage/".$v->target : $v->target) )  ) ) )
					<a href="{{$link}}" class="list-group-item lh-1 bg-transparent px-0 hvr-icon-forward">
						{{$v->judul}} <i class="bi bi-arrow-right-short float-end hvr-icon"></i>
					</a>
					@endforeach
				</ul>
			@endif
			</div>
		</div>
	@endforeach
</section>
@endif
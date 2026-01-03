<!-- Navigation-->
<div class="">
  <header class="border-bottom lh-1 py-3 small bg-main-accent text-white">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-12 col-md-6 pt-1">
					<span><i class="bi bi-telephone color-accent me-2"></i>(0771) 21822</span>
					<span><i class="bi bi-envelope color-accent mx-2"></i>dppp@tanjungpinangkota.go.id</span>
				</div>
				<div class="col-12 col-md-6 pt-1">
					<div class="d-flex justify-content-center justify-content-md-end align-items-center gap-2"> 
						@if($sosmed)
							@foreach($sosmed as $key => $value)
								<a class="text-primary hvr-float-shadow" href="{{$value}}" target="_blank">
									<img src="{{asset('storage/'.$key)}}" width="20px">
								</a>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
  	</header>
	<header class="border-bottom py-3">
		<div class="container">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-12 col-md-4 pt-1">
					<img src="{{asset('storage/images/logo-dp3.png')}}" alt="Logo Tanjungpinang" height="auto" width="100%">
				</div>
				<div class="col-12 col-md-7 pt-1 small">
					<div class="border border-accent rounded-pill p-2 px-5">
						<span>Jam Operasional</span>
						<div class="d-flex justify-content-between gap-2">
							<span class="fw-semibold">Senin - Kamis : 08.00 - 16.00</span>
							<span class="fw-semibold">Jumat : 08.00 - 15.00</span>
							<span class="fst-italic">Sabtu, Minggu & Libur Nasional : Tutup</span>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-1 pt-1 d-flex justify-content-end align-items-center">
					<a href="https://tanjungpinangkota.lapor.go.id" target="_blank" class="btn btn-secondary bg-main-accent text-white fw-semibold">Lapor</a>
				</div>
			</div>
		</div>
  	</header>
	<div class="bg-light small lh-1 py-1">
		<marquee>Selamat Datang di Dinas Pertanian Pangan dan Perikanan Kota Tanjungpinang</marquee>
	</div>
	<nav class="navbar navbar-expand-md bg-accent py-3">
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav small me-auto" id="mainNav">
					<li class="nav-item main-nav-item pe-4">
						<a class="nav-link text-uppercase fw-bold" aria-current="page" href="/">Beranda</a>
					</li>
					@foreach($navbars['main'] as $key => $value)
					@php($link = $value->jns == 0 ? "/#" : ($value->jns == 1 ? "/Halaman/".$value->halaman_target->slug : ($value->jns == 2 ? $value->target :  "/".$kontens[$value->target])))
						@if(count($value->sub) > 0)
							<li class="nav-item dropdown main-nav-item pe-4">
								<a class="nav-link text-uppercase fw-bold dropdown-toggle" href="{{$link}}" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">{{$value->judul}}</a>
								@include('partials.nestedNav', ['data' => $value->sub])
							</li>   
						@else
							<li class="nav-item main-nav-item pe-4">
								<a class="nav-link text-uppercase fw-bold" aria-current="page" href="{{$link}}">{{$value->judul}}</a>
							</li>   
						@endif
					@endforeach
				</ul>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</nav>
</div>
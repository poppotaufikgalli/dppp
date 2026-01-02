<!-- Footer-->
<footer class="footer py-5 border-top bg-tertiary-accent">
	<div class="container">
		<div class="row y-5">
			<div class="col-lg-6 h-100">
				<div class="d-flex flex-column mb-2">
					<label class="fw-bold  h-title">{{env('APP_NAME')}}</label>
				</div>
				<div class="d-flex flex-column mb-2 gap-1">
					<div class="d-flex justify-content-start gap-1 small">
						<i class="bi bi-geo-alt"></i> 
						<div class="d-flex flex-column justify-content-start">
							<label>Jl. Jendral Ahmad Yani KM.5, Tanjungpinang</label>
							<label>Kepulauan Riau</label>
						</div>
					</div>
					<div class="d-flex justify-content-start gap-1 small">
						<i class="bi bi-telephone"></i>
						<div class="d-flex flex-column justify-content-start">
							<label>(0771) 21822</label>
						</div>
					</div>
					<div class="d-flex justify-content-start gap-1 small">
						<i class="bi bi-envelope-at"></i>
						<a class="notranslate hvr-sweep-to-right" href="mailto:dpppp@tanjungpinangkota.go.id">dppp@tanjungpinangkota.go.id</a>
					</div>
					<div class="d-flex justify-content-start gap-1 small">
						<i class="bi bi-calendar2-check"></i>
						<div class="d-flex flex-column justify-content-start">
							<div class="d-flex justify-content-between gap-2">
								<label>Senin - Kamis</label>
								<label>08.00 s/d 16.00</label>
							</div>
							<div class="d-flex justify-content-between gap-2">
								<label>Jumat</label>
								<label>08.00 s/d 15.00</label>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-start gap-1 small mt-2 ps-3">
						@auth
							<a class="btn btn-sm btn-success" href="{{route('dashboard')}}">
								<i class="bi bi-laptop"></i>
								Dashboard
							</a>
							<a class="btn btn-sm btn-primary" href="{{route('logout')}}">
								<i class="bi bi-lock-fill"></i>
								Logout
							</a>
						@endauth
						@guest
							<a class="btn btn-sm btn-primary" href="{{route('login')}}">
								<i class="bi bi-lock-fill"></i>
								Login
							</a>
						@endguest
					</div>
					<hr>
					<div class="d-flex justify-content-start gap-1 small">
						<i class="bi bi-c-circle"></i>
						<div class="d-flex flex-column justify-content-start">
							<label>2025 | {{env('APP_NAME')}} | Versi 1.0</label>
						</div>
					</div>
					<!--<div class="d-flex justify-content-start gap-1 small">
						<i class="bi bi-p-circle"></i>
						<div class="d-flex flex-column justify-content-start">
							<label>Design & Develop by <img src="{{asset('images/diskominfo.png')}}" width="20" height="20"> Dinas Komunikasi dan Informatika Kota Tanjungpinang</label>
						</div>
					</div>-->
				</div>
			</div>
			<div class="col-lg-3 h-100">
				<div class="d-flex flex-column mb-2">
					<label class="fw-bold  h-title">Link Terkait</label>
				</div>
				@if(isset($links))
					<div class="d-flex flex-column">
						@foreach($links as $key => $value)
							@if(isset($value))
								<div class="d-flex row mb-2">
									<label class="p-0"># {{$key}}</label>
									@foreach($value as $k => $v)
										<div class="d-flex ps-1 pb-1">
											@if($v->guid)
												<div style="width: 20px;">
													<img src="{{asset('storage/'.$v->guid)}}" class="rounded" alt="{{$v->guid}}" height="18">
												</div>
											@else
												<i class="bi bi-link"></i>
											@endif
											<div class="align-items-center ms-2">
												<a href="{{$v->isi}}" class="small hvr-sweep-to-right text-decoration-none">
													{{$v->judul}}
												</a>
											</div>
										</div>
									@endforeach
								</div>
							@endif		
						@endforeach
					</div>
				@endif
			</div>
			<div class="col-lg-3 d-flex flex-column align-items-center">
				<div class="card small shadow-sm rounded-0 mt-5">
					 <div class="card-body row" id="divKunjungan">
						<span class="text-center">Kunjungan</span>
						<span class="col-6 border-success"><i class="bi bi-circle-fill text-success"></i> Online</span><span class="col-6 text-end" id="KunjunganOnline"></span>
						<span class="col-6">Hari Ini</span><span class="col-6 text-end" id="KunjunganHariIni"></span>
						<span class="col-6">Bulan Ini</span><span class="col-6 text-end" id="KunjunganBulanIni"></span>
						<span class="col-6">Tahun Ini</span><span class="col-6 text-end" id="KunjunganTahunIni"></span>
						<span class="col-6">Total</span><span class="col-6 text-end" id="KunjunganTotal"></span>
						<hr class="my-1">
						<div class="d-flex flex-column justify-content-center align-items-center">
							<span class="text-muted fst-italic small p-2" id="KunjunganAnda">Anda : {{Visitor::ip()}} | {{Visitor::browser()}} | {{Visitor::device()}}</span>
							<a class="btn btn-sm btn-success" href="{{route('bukutamu', ['judul' => 'Buku Tamu'])}}"><i class="bi-chat-left-text-fill"></i> Isi Buku Tamu</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<div id="preloader"></div>
<div class="gtranslate_wrapper"></div>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
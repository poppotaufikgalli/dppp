@extends('layouts.master-admin')

@section('title', $kontens[$jns] ?? 'Konten')

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex justify-content-between align-items-center">
					Konten : @yield('title')
					<div class="d-flex gap-1">
						<a href="{{route($jns.'.create')}}" class="btn btn-sm btn-primary">Tambah {{$kontens[$jns]}}</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="btn-group btn-group-sm mb-3" role="group" aria-label="Publikasi Data Check">
				  	<input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="A">
				  	<label class="btn btn-outline-danger" for="btnradio1">Semua</label>

				  	<input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="Y">
				  	<label class="btn btn-outline-success" for="btnradio2">Sudah Publikasi</label>

				  	<input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="N">
				  	<label class="btn btn-outline-secondary" for="btnradio3">Belum Publikasi</label>
				</div>
				<div class="table-responsive">
					<table class="table table-hover table-sm small" id="tbListData" width="100%" cellspacing="0">
						<thead class="table-dark">
							<tr>
								<th>No</th>
								@if(!in_array($jns, ['ag']))
									<th width="20%">Gambar</th>
								@endif
								<th width="30%">Judul</th>
								<th>Tanggal Konten</th>
								<th>Sudah Publikasi</th>
								<th>Tanggal Buat / Oleh</th>
								<th>Aksi</th>
								@if(!in_array($jns, ['g']))
								<th>Publikasi</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@if(count($data) > 0)
								@foreach($data as $key => $value)
									<tr class="publish-{{ $value->publish}}">
										<td class="text-center">{{$key +1}}</td>
										@if(!in_array($jns, ['ag']))
										<td>
											@if(isset($value->guid))
												<div class="ratio ratio-21x9">
													<img class="object-fit-contain" src="{{ asset('storage/'.$value->guid) }}" />
												</div>
											@endif
										</td>
										@endif
										<td>
											@if($value->popup == 1)
												<span class="badge bg-accent">
													<i class="bi bi-check-circle-fill"></i>
													Popup Halaman Depan
												</span>
												<br>
											@endif
											{{ $value->judul }}
											@if(in_array($jns, ['g']))
												<br>
												Album : {{$value->album?->judul}}
											@endif
											@if(in_array($jns, ['ag']))
												<br>
												Jumlah Item : {{$value->gambar?->count() ?? 0}}
											@endif
										</td>
										<td class="text-center">
											{{$value->content_at?->diffForHumans()}}
										</td>
										<td class="text-center">
											<i class="text-success bi {{ $value->publish == 'Y' ? 'bi-check-circle-fill' : '' }}"></i> 
										</td>
										<td class="text-center">{{ $value->created_at->format('d-m-Y H:i:s') }}<br/> {{$value->crname}}</td>
										<td>
											<div class="d-flex gap-1">
												<a href="{{route('page', ['page' => $kontens[$value->jns], 'slug' => $value->slug])}}" target="_blank" class="btn btn-xs {{$value->publish == 'N' ? 'disabled btn-outline-info' : 'btn-info text-white'}}"><i class="bi bi-eye"></i></a>
												<a href="{{route($jns.'.edit', ['id' => $value->id])}}" class="btn btn-xs {{$value->publish == 'Y' ? 'btn-outline-primary disabled' : 'btn-primary'}}"><i class="bi bi-pencil"></i></a>
												@if($value->jns == 'ag')
													<a href="{{route($jns.'.galeri', ['id' => $value->id])}}" class="btn btn-xs btn-warning"><i class="bi bi-image"></i></a>	
												@endif
												<a href="{{route($jns.'.destroy', ['id' => $value->id])}}" class="btn btn-xs btn-danger {{$value->publish == 'Y' ? 'btn-outline-danger disabled' : 'btn-danger'}}" data-confirm-delete="true"><i class="bi bi-trash"></i></a>
											</div>
										</td>
										<td>
											@if($value->jns !== 'g')
												<button class="btn btn-xs btn-{{$value->publish == 'N' ? 'success' : 'warning'}} ms-3" onclick="confirmPublish({{$value->id}}, '{{$jns}}', '{{$value->publish}}')">
													@if($value->publish == 'N')
														<i class="bi bi-check-circle-fill"></i> Publikasi
													@else
														<i class="bi bi-x-circle"></i> Batal
													@endif
												</button>
											@endif
										</td>                 
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="8" class="fst-italic text-center">Data belum ada</td>
								</tr>
							@endif
						</tbody>
					</table>
					<p>
						{{$data->links()}}
					</p>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
@endsection

@push('scripts')
<script type="text/javascript">
	window.onload = (event)=> {
		const lightbox = GLightbox({ selector: '.glightbox' });
		const jns = @json($jns);
		const publish = @json($publish) ?? '';

		document.querySelectorAll('.btn-check').forEach(el => {
			console.log(el.value == publish, el.value, publish)
			if(el.value == publish){
				el.checked = true
			}
			el.addEventListener('input', function(e) {
				//console.log(e.target.value)	
				window.location.href = `/${jns}/${e.target.value}`
			})
		})
	}

	function confirmPublish(id, jns, pub){
		var text = [
			"Publikasi Konten",
			"Apakah anda yakin untuk Mempublikasikan konten ini?",
			"Ya, Publikasikan!",
			"success",
			"green",
		];
		
		if(pub == 'Y'){
			text = [
				"Batal Publikasi Konten",
				"Apakah anda yakin untuk Membatalkan publikasi konten ini?",
				"Ya, Batalkan Publkasi",
				"error",
				"red"
			];
		}
		Swal.fire({
			title: text[0],
			text: text[1],
			icon: text[3],
			showCancelButton: true,
			confirmButtonColor: text[4],
			cancelButtonColor: "grey",
			confirmButtonText: text[2],
		}).then(function(result) {
            if (result.isConfirmed) {
                var form = document.createElement('form');
                form.action = `/${jns}/publikasi/`+id;
                form.method = 'POST';
                form.innerHTML = `
                @csrf
                @method('POST')
            `;
                document.body.appendChild(form);
                form.submit();
            }
        });
	}
</script>
@endpush
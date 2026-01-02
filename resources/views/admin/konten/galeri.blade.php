@extends('layouts.master-admin')

@section('title', $kontens[$jns] ?? 'Galeri Konten')

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-start align-items-center gap-1">
                        <a href="{{route($jns, ['publish' => 'A'])}}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        Item Galeri : {{ $data->judul }}
                    </div>
					<div class="d-flex gap-1">
						<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalGaleri">Tambah Item Galeri</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				@if($data->gambar)
					{!!$data->isi!!}
					<hr class="my-3">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @foreach($data->gambar as $key => $value)
                            <div class="col">
                                <div class="card h-100">
                                	<div class="ratio ratio-16x9">
                                		<img src="{{asset('storage/'.$value->guid)}}" class="object-fit-cover" alt="...">
                                	</div>
									<div class="card-body">
										<span class="fw-semibold">{{$value->judul}}</span>
									</div>
									<div class="card-footer">
										<a href="{{route('ag.destroy', ['id' => $value->id])}}" class="btn btn-xs btn-danger" data-confirm-delete="true"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
				@endif
			</div>
		</div>
	</div>
    @include('partials.modalGaleri')
	<!-- /.container-fluid -->
@endsection

@push('scripts')
<script type="text/javascript">
	function confirmDelete(id, jns){
		var text = [
			"Hapus Konten",
			"Apakah anda yakin untuk menghapus konten ini?",
			"Ya, Hapus!",
			"success",
			"green",
		];
		
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
                form.action = `/${jns}/destroy/`+id;
                form.method = 'DELETE';
                form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
                document.body.appendChild(form);
                form.submit();
            }
        });
	}
</script>
@endpush
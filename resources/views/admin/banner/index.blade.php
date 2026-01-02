@extends('layouts.master-admin')

@section('title', 'Manajemen Banner')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    @yield('title')
                    <div class="d-flex gap-1">
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-primary">Tambah Banner</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm small table-bordered" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Banner</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($banner) && count($banner) > 0)
                                @foreach($banner as $key => $value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <div class="ratio ratio-16x9">
                                                <img src="{{asset('storage/'.$value)}}" class="img-thumbnail">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('banner.destroy', ['guid' => $value])}}" class="btn btn-xs btn-danger" data-confirm-delete="true"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center fst-italic">Data Belum Tersedia</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="post" action="{{route('banner.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Banner</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <input type="file" class="form-control form-control-sm" accept="image/*" name="guid" id="guid">
                                    </div>
                                    <div class="ratio ratio-16x9">
                                        <img src="" id="imgPreview">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

        document.getElementById('guid').addEventListener('change', function(e){
            //console.log(e)
            const [file] = e.target.files
            if (file) {
                document.getElementById('imgPreview').src = URL.createObjectURL(file)
            }
        })
    }

    function confirmPublish(id, pub){
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
                form.action = `/konten/publikasi/`+id;
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
@extends('layouts.master-admin')

@section('title', 'Manajemen Menu')

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
                        <a href="{{route('menu.create', ['ref' => 0])}}" class="btn btn-sm btn-primary">Tambah Menu</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm small table-bordered" id="tbListData" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul Menu</th>
                                <th>Jenis</th>
                                <th width="30%">Target</th>
                                <th width="5%">Tambah Sub</th>
                                <th width="5%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($navbars))
                                @include('partials.menuTable', ['data' => $navbars['main'], 'mlvl' => 0])
                            @endif
                        </tbody>
                    </table>
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
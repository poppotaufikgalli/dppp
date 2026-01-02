@extends('layouts.master-admin')

@section('title', "Formulir Group")

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{route('group')}}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-chevron-left"></i>
                    </a>    
                    @yield('title')
                </div>
            </div>
            <div class="card-body">
                <form class="row" method="post" action="{{route($next, ['method' => $method])}}">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                          <input type="hidden" name="id" class="form-control form-control-sm" value="{{$data->id ?? null}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama Group</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="{{$data->nama ?? old('nama')}}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label col-form-label-sm">Menu Akses</label>
                        <div class="col-sm-10 table-responsive">
                            <table class="table table-sm small table-bordered">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th width="30%">Nama Route</th>
                                        <th>List</th>
                                        <!--<th>Tambah</th>-->
                                        <th>Simpan</th>
                                        <!--<th>Detail</th>
                                        <th>Edit</th>-->
                                        <th>Update</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($routelist)
                                        @php($lsAkses = isset($data) ? json_decode($data->lsakses) : '')
                                        @php($lsAkses = isset($lsAkses->menu) ? json_decode($lsAkses->menu) : '')
                                        @foreach($routelist as $key => $value)
                                            @php($akses = $lsAkses->$value ?? null)
                                            <tr class="text-center">
                                                <td class="text-start">
                                                    <label for="{{$value}}">{{ucfirst($value)}}</label>
                                                </td>
                                                @php($indexCh = isset($akses) && in_array('_index', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}} ch_index" type="checkbox" id="{{$value}}_index" name="lsakses[{{$value}}][]" value="_index" aria-label="{{$value}}_index" data-bs-target="{{$value}}" {{$indexCh}}>
                                                </td>
                                                @php($createCh = isset($akses) && in_array('_create', $akses) ? 'checked' : '')
                                                <!--<td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_create" name="lsakses[{{$value}}][]" value="_create" aria-label="{{$value}}_create" {{$createCh}}>
                                                </td>-->
                                                @php($storeCh = isset($akses) && in_array('_store', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_store" name="lsakses[{{$value}}][]" value="_store" aria-label="{{$value}}_store" {{$storeCh}}>
                                                </td>
                                                @php($showCh = isset($akses) && in_array('_show', $akses) ? 'checked' : '')
                                                <!--<td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_show" name="lsakses[{{$value}}][]" value="_show" aria-label="{{$value}}_show" {{$showCh}}>
                                                </td>-->
                                                @php($editCh = isset($akses) && in_array('_edit', $akses) ? 'checked' : '')
                                                <!--<td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_edit" name="lsakses[{{$value}}][]" value="_edit" aria-label="{{$value}}_edit" {{$editCh}}>
                                                </td>-->
                                                @php($updateCh = isset($akses) && in_array('_update', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_update" name="lsakses[{{$value}}][]" value="_update" aria-label="{{$value}}_update" {{$updateCh}}>
                                                </td>
                                                @php($destroyCh = isset($akses) && in_array('_destroy', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_destroy" name="lsakses[{{$value}}][]" value="_destroy" aria-label="{{$value}}_destroy" {{$destroyCh}}>
                                                </td>
                                            </tr>       
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label col-form-label-sm">Konten</label>
                        <div class="col-sm-10 table-responsive">
                            <table class="table small table-bordered">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <!--<th>&nbsp;</th>-->
                                        <th width="30%">Nama Konten</th>
                                        <th>List</th>
                                        <!--<th>Tambah</th>-->
                                        <th>Simpan</th>
                                        <!--<th>Detail</th>
                                        <th>Edit</th>-->
                                        <th>Update</th>
                                        <th>Hapus</th>
                                        <th>Publikasi</th>
                                        <!--<th>Item Galeri</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($kontenakses))
                                        @php($lsKonten = isset($data) ? json_decode($data->lsakses) : '')
                                        @php($lsKonten = isset($lsKonten->kontenakses) ? json_decode($lsKonten->kontenakses) : '')
                                        @foreach($kontenakses as $key => $value)
                                            @php($akses = $lsKonten->$key ?? null)
                                            <tr class="text-center">
                                                <!--<td>
                                                    <input class="form-check-input nama_route" type="checkbox" id="{{$value}}" name="lsakses_all[]" value="{{$value}}" aria-label="{{$value}}">
                                                </td>-->
                                                <td class="text-start">
                                                    <label for="{{$value}}">{{ucfirst($value)}}</label>
                                                </td>
                                                @php($indexCh = isset($akses) && in_array('_index', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}} ch_index" type="checkbox" id="{{$value}}_index" name="kontenakses[{{$key}}][]" value="_index" aria-label="{{$value}}_index" data-bs-target="{{$value}}" {{$indexCh}}>
                                                </td>
                                                @php($createCh = isset($akses) && in_array('_create', $akses) ? 'checked' : '')
                                                <!--<td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_create" name="kontenakses[{{$key}}][]" value="_create" aria-label="{{$value}}_create" {{$createCh}}>
                                                </td>-->
                                                @php($storeCh = isset($akses) && in_array('_store', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_store" name="kontenakses[{{$key}}][]" value="_store" aria-label="{{$value}}_store" {{$storeCh}}>
                                                </td>
                                                @php($showCh = isset($akses) && in_array('_show', $akses) ? 'checked' : '')
                                                <!--<td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_show" name="kontenakses[{{$key}}][]" value="_show" aria-label="{{$value}}_show" {{$showCh}}>
                                                </td>-->
                                                @php($editCh = isset($akses) && in_array('_edit', $akses) ? 'checked' : '')
                                                <!--<td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_edit" name="kontenakses[{{$key}}][]" value="_edit" aria-label="{{$value}}_edit" {{$editCh}}>
                                                </td>-->
                                                @php($updateCh = isset($akses) && in_array('_update', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_update" name="kontenakses[{{$key}}][]" value="_update" aria-label="{{$value}}_update" {{$updateCh}}>
                                                </td>
                                                @php($destroyCh = isset($akses) && in_array('_destroy', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_destroy" name="kontenakses[{{$key}}][]" value="_destroy" aria-label="{{$value}}_destroy" {{$destroyCh}}>
                                                </td>
                                                @php($verifCh = isset($akses) && in_array('_publikasi', $akses) ? 'checked' : '')
                                                <td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_publikasi" name="kontenakses[{{$key}}][]" value="_publikasi" aria-label="{{$value}}_publikasi" {{$verifCh}}>
                                                </td>
                                                @php($itemGaleriCh = isset($akses) && in_array('_upload', $akses) ? 'checked' : '')
                                                <!--<td>
                                                    <input class="form-check-input ch_{{$value}}" type="checkbox" id="{{$value}}_upload" name="kontenakses[{{$key}}][]" value="_upload" aria-label="{{$value}}_upload" {{$itemGaleriCh}}>
                                                </td>-->
                                            </tr>       
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            @if(in_array($method, ['create', 'edit']))
                                <button class="btn btn-sm btn-primary">Simpan</button>
                                <button class="btn btn-sm btn-dark" type="reset">Reset</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js-content')
<script type="text/javascript">
    window.onload = (event)=> {
    
    }
</script>
@endsection
@extends('layouts.master-admin')

@section('title', "Group dan Hak Akses")

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
                        <a href="{{route('group.create')}}" class="btn btn-sm btn-primary">Tambah Group dan Hak Akses</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm small table-bordered" id="tbListData" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th width="20%">Nama Group</th>
                                <th>Jumlah User</th>
                                <th width="40%">Hak Akses</th>
                                <th>Tanggal Daftar</th>
                                <th>Tanggal Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data)
                                @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td>{{ $value->nama }}</td>
                                        <td class="text-center">{{ count($value->nakses) }}</td>
                                        <td class="text-start">
                                            @if($value->lsakses)
                                                @php($lsAkses = json_decode($value->lsakses))
                                                @foreach($lsAkses as $el => $akses)
                                                    @php($llAkses = json_decode($akses))
                                                    @if($llAkses)
                                                        <!--<span class="d-block bg-accent">{{$el}}</span>-->
                                                        <table class="table table-sm">
                                                            <tr class="table-dark">
                                                                <th width="20%">Item</th>
                                                                <th width="20%">List</th>
                                                                <th width="20%">Simpan</th>
                                                                <th width="20%">Update</th>
                                                                <th width="20%">Hapus</th>
                                                                @if($el == 'kontenakses')
                                                                    <th>Publikasi</th>
                                                                @endif
                                                            </tr>
                                                            @foreach($llAkses as $ee => $ll)
                                                                <tr>
                                                                    @php($nama = $el == 'kontenakses' ? ($kontens[$ee] ?? '-') : ucwords($ee) )
                                                                    <td>{{$nama}}</td>
                                                                    <td class="text-center"><i class="bi {{in_array('_index', $ll) ? 'bi-check-circle' : ''}} text-success"></i> </td>
                                                                    <td class="text-center"><i class="bi {{in_array('_store', $ll) ? 'bi-check-circle' : ''}} text-success"></i> </td>
                                                                    <td class="text-center"><i class="bi {{in_array('_update', $ll) ? 'bi-check-circle' : ''}} text-success"></i> </td>
                                                                    <td class="text-center"><i class="bi {{in_array('_destroy', $ll) ? 'bi-check-circle' : ''}} text-success"></i> </td>
                                                                    @if($el == 'kontenakses')
                                                                        <td class="text-center"><i class="bi {{in_array('_publikasi', $ll) ? 'bi-check-circle' : ''}} text-success"></i> </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $value->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td class="text-center">{{ $value->updated_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{route('group.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                                <a href="{{route('group.destroy', ['id' => $value->id])}}" class="btn btn-xs {{count($value->nakses) > 0 ? 'btn-outline-danger disabled' : 'btn-danger'}}" data-confirm-delete="true"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </td>                 
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
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
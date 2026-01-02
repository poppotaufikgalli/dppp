@extends('layouts.master-admin')

@section('title', "User")

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    @yield('title')
                    <div class="d-flex gap-1">
                        <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Tambah User</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm small table-bordered" id="tbListData" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Aktif</th>
                                <th>Nama Group</th>
                                <th>Tanggal Daftar</th>
                                <th>Tanggal Update</th>
                                <!--<th>MFA</th>-->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data)
                              @foreach($data as $key => $value)
                                    <tr class="{{$value->aktif == 0 ? 'table-secondary' : ''}}">
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{$value->nama}}</td>
                                        <td class="text-center">{{$value->email}}</td>
                                        <td class="text-center">{{$value->username}}</td>
                                        <td class="text-center">{{$value->aktif == 1 ? 'Ya' : '-'}}</td>
                                        <td class="text-center">{{$value->group->nama}}</td>
                                        <td class="text-center">{{$value->created_at?->format('d-m-Y H:i:s')}}</td>
                                        <td class="text-center">{{$value->updated_at?->format('d-m-Y H:i:s')}}</td>
                                        <!--<td class="text-center">
                                            @if($value->mfa == 1)
                                                <a href="{{route('user.show', ['id' => $value->id])}}" class="btn btn-xs btn-success text-white">
                                                    <i class="bi bi-check-circle"></i>
                                                    MFA
                                                </a>
                                            @else
                                                <a href="{{route('user.show', ['id' => $value->id])}}" class="btn btn-xs btn-outline-secondary">
                                                    <i class="bi bi-gear"></i>
                                                    MFA
                                                </a>
                                            @endif
                                        </td>-->
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{route('user.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                                <a href="{{route('user.destroy', ['id' => $value->id])}}" class="btn btn-xs btn-danger" data-confirm-delete="true"><i class="bi bi-trash"></i></a>
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
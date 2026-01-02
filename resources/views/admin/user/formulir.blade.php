@extends('layouts.master-admin')

@section('title', "Formulir User")

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{route('user')}}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-chevron-left"></i>
                    </a>    
                    @yield('title')
                </div>
            </div>
            <div class="card-body">
                <form class="row" method="post" action="{{route($next, ['method' => $method])}}">
                    @csrf
                    <div class="mb-2 row">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="hidden" name="id" class="form-control form-control-sm" value="{{$data->id ?? null}}">
                            <input type="hidden" name="mfa_secret" class="mfa_secret" value="{{$data->mfa_secret ?? null}}">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="{{$data->nama ?? old('nama')}}">
                        </div>
                        <label for="nip" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{$data->email ?? old('email')}}" required>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="username" class="col-sm-2 col-form-label col-form-label-sm">Username</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" id="username" name="username" value="{{$data->username ?? old('username')}}" required>
                        </div>
                        <label for="password" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                        <div class="col-sm-4">
                            @if($method == 'create')
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-sm" id="password" name="password" value="{{$data->password ?? old('password')}}" required>
                                    <button type="button" id="btnPassword" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></button>
                                </div>
                            @endif

                            @if($method == 'edit')
                                <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#gantiPasswordModal" data-bs-admin="1" data-bs-id="{{$data->id}}">
                                    <i class="bi bi-key"></i> Ganti Password
                                </button>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label col-form-label-sm">Group</label>
                        <div class="col-sm-4">
                            <select class="form-select form-select-sm" id="gid" name="gid">
                                <option selected disabled>Pilih Group</option>
                                @if($group)
                                    @foreach($group as $key => $value)
                                        @if((isset($data->gid) && $data->gid == $value->id) || old('gid') == $value->id )
                                            <option value="{{$value->id}}" selected>{{$value->nama}}</option>
                                        @else
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <div class="form-check">
                                <input class="form-check-input form-check-input-sm" type="checkbox" id="gridCheck1" name="aktif" value="1" {{isset($data) && $data->aktif == 1 ? 'checked' : (old('aktif') == 1 ? 'checked' : '') }}>
                                <label class="form-check-label form-check-label-sm" for="gridCheck1">
                                    Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            @if(in_array($method, ['create', 'edit']))
                                <button class="btn btn-sm btn-primary" id="btnSubmit">Simpan</button>
                                <button class="btn btn-sm btn-dark" type="reset">Reset</button>
                            @endif
                        </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(){
        const btnPassword = document.getElementById('btnPassword')
        if(btnPassword){
            btnPassword.addEventListener('click', function(e){
                var password = document.getElementById('password')
                if(password.type == 'password'){
                    password.type = 'text'
                    this.innerHTML = '<i class="bi bi-eye-slash"></i>'
                }else{
                    password.type = 'password'
                    this.innerHTML = '<i class="bi bi-eye"></i>'
                }
            })
        }
    }); 

</script>
@endpush
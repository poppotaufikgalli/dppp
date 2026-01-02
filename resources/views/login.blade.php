@extends('layouts.master-login')

@section('title', "Login")

@section('content')
    <main class="w-100 m-auto p-1" style="max-width: 330px;">
        <div class=" d-flex align-items-center gap-2 mb-2">
            <a href="https://www.tanjungpinangkota.go.id" class="text-decoration-none d-flex">
                <img id="dp3-logo" src="{{asset('storage/images/logo-dp3.png')}}" alt="Logo DP3" height="50">
            </a>
        </div>
        <form method="POST" action="{{route('login')}}">
            @csrf
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{old('username')}}" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <button class="btn btn-accent text-light w-100 py-2" type="submit">Login</button>
            <div class="mt-5 text-center">
                <a href="/" class="hvr-sweep-to-left px-2"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
            </div>
        </form>
    </main>
@endsection

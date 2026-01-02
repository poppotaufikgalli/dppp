@extends('layouts.master')

@section('title', "Buku Tamu")

@section('content')
    <section>
        <div class="container" style="padding-top: 40px;">
            <div class="row g-4 mb-4">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <h2 class="mt-5 mb-3 h-title fw-bolder">Buku Tamu</h2>
                    <p class="fst-italic">Silahkan Isi Formulir Dibawah Ini</p>
                    <form class="row" method="post" action="{{route('bukutamu')}}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nama" name="nama" value="{{$data->nama ?? old('nama')}}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="email" name="email" value="{{$data->email ?? old('email')}}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="pesan" name="pesan" required>{{$data->pesan ?? old('pesan')}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="offset-sm-2 col-sm-10">
                                <button class="btn btn-sm btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
<script type="text/javascript"> 
    
</script>
@endsection
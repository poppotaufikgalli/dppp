@extends('layouts.master-admin')

@section('title', "Formulir Menu")

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{route('menu')}}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-chevron-left"></i>
                    </a>    
                    Menu
                </div>
            </div>
            <div class="card-body">
                <form class="row" method="post" action="{{route($next, ['method' => $method])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="hidden" name="id" class="form-control form-control-sm" value="{{isset($data->id) ? $data->id : null}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ref" class="col-sm-2 col-form-label col-form-label-sm">Referensi</label>
                        <div class="col-sm-10">
                            <input type="text" id="referensi" value="{{isset($ref_menu->judul) ? $ref_menu->judul : 'Top Menu'}}" class="form-control form-control-sm" disabled>
                            <input type="hidden" id="ref" name="ref" value="{{isset($ref_menu->id) ? $ref_menu->id : 0}}" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label col-form-label-sm">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="judul" name="judul" value="{{isset($data->judul) ? $data->judul : old('judul')}}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ref" class="col-sm-2 col-form-label col-form-label-sm">Jenis</label>
                        <div class="col-sm-10 d-flex align-items-center gap-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio0" value="0" {{isset($data->jns) && $data->jns == 0 ? 'checked' : ''}} required>
                                <label class="form-check-label col-form-label-sm" for="inlineRadio0"># (Non-link)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio1" value="1" {{isset($data->jns) && $data->jns == 1 ? 'checked' : ''}}>
                                <label class="form-check-label col-form-label-sm" for="inlineRadio1">Posting</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio2" value="2" {{isset($data->jns) && $data->jns == 2 ? 'checked' : ''}}>
                                <label class="form-check-label col-form-label-sm" for="inlineRadio2">Link</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio3" value="3" {{isset($data->jns) && $data->jns == 3 ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineRadio3">List Konten</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="target" class="col-sm-2 col-form-label col-form-label-sm">Target</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="target" name="target" class="form-control form-control-sm" value="{{isset($data->target) ? $data->target : old('target')}}" required>
                            <select id="starget1" name="starget1" class="form-select form-select-sm d-none">
                                @if(isset($halaman))
                                    <option selected disabled>Pilih Halaman</option>
                                    @foreach($halaman as $key => $value)
                                        @if(isset($data->target) && ($value->id == $data->target) && ($data->jns == 1))
                                            <option value="{{$value->id}}" selected>{{$value->judul}}</option>
                                        @else
                                            <option value="{{$value->id}}">{{$value->judul}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                            <select id="starget2" name="starget2" class="form-select form-select-sm d-none">
                                @if(isset($kontens))
                                    <option selected disabled>Pilih List Konten</option>
                                    @foreach($kontens as $key => $value)
                                        @if(isset($data->target) && ($value == $data->target) && ($data->jns == 5))
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
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
    <!-- /.container-fluid -->
@endsection

@push('scripts')
<script type="text/javascript">
    var editorTextarea;
    var ckeditorDiv;
    var curTarget = '{{isset($data->target) ? $data->target : "#"}}';
    var curJns = '{{isset($data->jns) ? $data->jns : 0}}';

    window.onload = (event)=> {
        var target = document.getElementById("target")
        if(inlineRadio1.checked){
            target.type = "hidden";
        }else if(inlineRadio2.checked){
            //var target = document.getElementById("target")
            //target.type = "hidden";

            //var tsWrapper1 = document.getElementById('starget1').nextElementSibling
            //tsWrapper1.classList.add('d-none')
        }else if(inlineRadio3.checked){
            var target = document.getElementById("target")
            target.type = "hidden";

            var tsWrapper1 = document.getElementById('starget1').nextElementSibling
            tsWrapper1.classList.add('d-none')
        }else{
            target.type = "text";
            //var starget1 = document.getElementById('starget1')
            //starget1.classList.add('d-none')

            //var starget2 = document.getElementById('starget2')
            //starget2.classList.add('d-none')
        }
    }

    let chAll = document.querySelectorAll('.seljns')

    chAll.forEach((el) => {
        el.addEventListener('change', (e) => {
            console.log(e.target.value)
            var target = document.getElementById("target")
            var starget1 = document.getElementById('starget1')
            var starget2 = document.getElementById('starget2')

            target.value = ""
            target.type = "text";

            if(e.target.value == 3){
                starget1.classList.add('d-none')
                starget2.classList.remove('d-none')

                target.type = "hidden";
            }else if(e.target.value == 2){
                starget1.classList.add('d-none')
                starget2.classList.add('d-none')

                target.type = "url";
                target.value = "https://";
            }else if(e.target.value == 1){
                starget2.classList.add('d-none')
                starget1.classList.remove('d-none')

                target.type = "hidden";
            }else if(e.target.value == 0){
                starget1.classList.add('d-none')
                starget2.classList.add('d-none')

                target.value = "#"
                target.type = "text";
            }

            if(curJns == e.target.value){
                target.value = curTarget
            }
        })  
    })

    document.getElementById('starget1').addEventListener('change', function(e){
        console.log(e.target.value)
        document.getElementById('target').value = e.target.value
    })

    document.getElementById('starget2').addEventListener('change', function(e){
        console.log(e.target.value)
        document.getElementById('target').value = e.target.value
    })
</script>
@endpush
@extends('layouts.master-admin')

@section('title', "Formulir ".$kontens[$jns] ?? 'Konten')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{route($jns, ['publish' => 'A'])}}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-chevron-left"></i>
                    </a>    
                    @yield('title')
                </div>
            </div>
            <div class="card-body">
                <form class="row" method="post" action="{{route($next)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="hidden" name="id" class="form-control form-control-sm" value="{{$data->id ?? null}}">
                            <input type="hidden" name="jns" id="jns" class="form-control form-control-sm" value="{{$jns}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label col-form-label-sm">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="judul" name="judul" value="{{$data->judul ?? old('judul')}}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="content_at" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Konten</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control form-control-sm" id="content_at" name="content_at" value="{{isset($data) ? $data->content_at?->format('Y-m-d H:i:s') : (old('content_at') ?? date('Y-m-d H:i:s'))}}" required>
                        </div>
                    </div>
                    @if(!in_array($jns, ['ag']))
                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <div class="form-check form-switch form-switch-sm">
                                <input class="form-check-input form-check-input-sm" type="checkbox" role="switch" id="chGambar" name="chGambar" value="guid" {{isset($data->guid) ? 'checked' : ''}}>
                                <label class="form-check-label form-check-label small" for="chGambar">{{$jns == 'l' ? 'Icon' : 'Gambar Utama'}}</label>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <input type="file" name="guid" id="guid" class="form-control form-control-sm" value="{{$data->guid ?? null}}" accept="image/jpg,image/png" />
                            @if(isset($data->guid))
                                <img id="img-guid" src="{{asset('storage/'.$data->guid)}}" class="img-fluid mt-2" style="cursor: pointer;" />
                            @endif
                        </div>
                    </div>
                    @endif
                    @if(in_array($jns, ['l']))
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label col-form-label-sm">Jenis Link</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="kategori" name="kategori">
                                    <option selected disabled> - Pilih Jenis Link- </option>
                                    <option value="1" {{isset($data->kategori) && ($data->kategori == 1) ? 'selected' : old('kategori')}}>Daerah</option>
                                    <option value="2" {{isset($data->kategori) && ($data->kategori == 2) ? 'selected' : old('kategori')}}>Nasional</option>
                                    <option value="3" {{isset($data->kategori) && ($data->kategori == 3) ? 'selected' : old('kategori')}}>Internasional</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label col-form-label-sm">{{in_array($jns, ['l', 'sm']) ? 'Alamat Url' : 'Isi'}}</label>
                        <div class="col-sm-10">
                            @if(in_array($jns, ['l', 'sm']))
                                <input type="url" name="alamat" id="alamat" class="form-control form-control-sm" value="{{isset($data->isi) ? $data->isi : old('isi')}}" required>
                            @else
                                <textarea name="editor" id="editor">{{isset($data->isi) ? $data->isi : old('isi')}}</textarea>
                            @endif                          
                        </div>
                    </div>
                    @if(in_array($jns, ['b', 'h', 'k']))
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label col-form-label-sm">Popup Halaman Depan</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <div class="form-check form-switch form-switch-sm">
                                    <input class="form-check-input form-check-input-sm" type="checkbox" role="switch" id="depan" name="popup" value="1" {{isset($data->popup) && $data->popup == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label form-check-label-sm" for="depan">Ya</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(in_array($jns, ['b', 'h', 'g', 'k']))
                    <div class="mb-3 row">
                        <label for="album_id" class="col-sm-2 col-form-label col-form-label-sm">Album Gambar</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="hidden" class="form-control form-control-sm" id="album_id" name="album_id" value="{{isset($data) ? $data->album_id : old('album_id') }}">
                                <input type="text" class="form-control form-control-sm" id="album_name" name="album_name" value="{{isset($data) ? $data->album->judul : old('album_name') }}" disabled>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAlbum">Cari Album</button>
                            </div>
                        </div>
                    </div>
                    @endif
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
    @include('partials.modalAlbum')
    <!-- /.container-fluid -->
@endsection

@push('scripts')
<script type="text/javascript">
    window.onload = (event)=> {
        initCkEditor();

        var chGambar = document.getElementById('chGambar');
        if(chGambar){
            checkChange(document.getElementById('guid'), document.getElementById('chGambar').checked)

            document.getElementById('chGambar').addEventListener('change', function(e) {
                checkChange(document.getElementById('guid'), e.target.checked)
            })  
        }
        
        var selKategori_pb = document.querySelector('#kategori.pembelajaran_online');
        if(selKategori_pb){
            selKategori_pb.addEventListener('change', addEventListener('change', function(e){
                if(e.target.value == 1){
                    destroyCkEditor()
                    initCkEditor()
                    //console.log("selKategori_pb")
                }else if(e.target.value == 2){
                    destroyCkEditor()
                    initCkEditor('video')
                    //console.log("selKategori_pb video")
                }
            }))
        }

        var selKategori_kd = document.querySelector('#kategori.konten_digital');
        if(selKategori_kd){
            selKategori_kd.addEventListener('change', addEventListener('change', function(e){
                if(e.target.value == 1){
                    destroyCkEditor()
                    initCkEditor('gambar')
                    //console.log("konten_digital gambar")
                }else if(e.target.value == 2){
                    destroyCkEditor()
                    initCkEditor('video')
                    //console.log("konten_digital video")
                }
            }))
        }
    }

    let editor0;

    function checkChange(el, val){
        el.disabled = !val
    }

    function initCkEditor(type) {
        var jns = document.getElementById('jns').value;
        var elCkEditor = document.querySelector( '#editor' );
        var basicToolbar = ['heading','|','bold','italic','link','bulletedList','numberedList','|', 'outdent', 'indent','|','insertTable','blockQuote','imageUpload','|','undo','redo', '|', 'mediaEmbed'];
        const config = {
            toolbar: [ 'bold', 'italic', '|', 'undo', 'redo' ]
        };

        if((['vt','vj']).includes(jns)){
            basicToolbar = ['mediaEmbed']
        }
        
        if((['id']).includes(jns)){
            basicToolbar = ['imageUpload','mediaEmbed']
        }

        if((['pb']).includes(jns)){
            basicToolbar = ['heading','|','bold','italic','link','bulletedList','numberedList','|', 'outdent', 'indent','|','insertTable','blockQuote','imageUpload','|','undo','redo',];
        }
        
        if((['ph']).includes(jns)){
            basicToolbar = ['heading','|','bold','italic','link','bulletedList','numberedList','|', 'outdent', 'indent','|','insertTable','blockQuote','|','undo','redo',];
        }

        if((['bh','br','g']).includes(jns)){
            basicToolbar = ['bold','italic','link','bulletedList','numberedList','|','insertTable','|','undo','redo'];
        }
        
        if(type == 'video'){
            basicToolbar = ['mediaEmbed']   
        }

        if(type == 'gambar'){
            basicToolbar = ['imageUpload']  
        }
        
        if(elCkEditor){
            const {ClassicEditor, Essentials, Bold, Italic, Font, Link, Paragraph, Heading, List, Indent, Table, BlockQuote, Image, MediaEmbed, ImageUpload, CKFinderUploadAdapter, CKFinder} = Ckeditor;
            ckeditorDiv = ClassicEditor.create( elCkEditor, {
                licenseKey: 'GPL', // Or 'GPL'.
                plugins: [ Essentials, Bold, Italic, Font, Link, Paragraph, Heading, List, Indent, Table, BlockQuote, Image, MediaEmbed, ImageUpload, CKFinderUploadAdapter, CKFinder],
                toolbar: {
                    items: basicToolbar,
                    image: {
                        toolbar: [
                          'imageStyle:full',
                          'imageStyle:side',
                          '|',
                          'imageTextAlternative',
                        ]
                    },
                    link: {
                        defaultProtocol: 'http://',
                    },
                    mediaEmbed: {
                        previewsInData: true,
                    },
                    table: {
                        contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                    }
                },
                ckfinder: {
                    uploadUrl: "{{route('api.uploadCK', ['folder' => 'extra'])}}",
                    options:{
                        resourceType: 'Images'
                    }
                }
            }).then (editor => {
                editorTextarea = editor;
                editor.editing.view.document.on('clipboardInput', (evt, data) => {
                    const plainText = data.dataTransfer.getData('text/plain');
                    
                    // Prevent the default behavior
                    evt.stop();

                    // Insert plain text into the editor
                    editor.model.change(writer => {
                        const insertPosition = editor.model.document.selection.getFirstPosition();
                        writer.insertText(plainText, insertPosition);
                    });
                });
            }).catch( error => {
                console.error( error );
            }); 
        }
    }

    function destroyCkEditor() {
        if(editorTextarea){
            editorTextarea.destroy().catch( error => {
                console.log( error );
            }); 
        }
    }

    function submitForm(event){
        if(editorTextarea){
            event.preventDefault();
            
            const dirty = editorTextarea.getData()
            const regex = /<oembed.+?url="https?:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})"><\/oembed>/g;
            const clean = dirty.replace(regex, '<div data-oembed-url="https://www.youtube.com/embed/$1"></div>');
            //const clean = DOMPurify.sanitize(dirty, {ALLOWED_TAGS: ['figure'], ADD_TAGS: ['oEmbed']});
            //console.log(dirty)
            console.log(clean)
            //editorTextarea.setData(clean);
            
            //event.currentTarget.submit();
        }
    }
</script>
@endpush
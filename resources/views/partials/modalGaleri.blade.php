<div class="modal fade" id="modalGaleri" tabindex="-1" aria-labelledby="modalGaleriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-accent">
                <h5 class="modal-title" id="modalGaleriLabel">Tambah Item Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" method="post" action="{{route($data->jns.'.galeri.store', ['id' => $data->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="hidden" name="album_id" class="form-control form-control-sm" value="{{$data->id ?? null}}">
                            <input type="hidden" name="jns" id="jns" class="form-control form-control-sm" value="g">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label col-form-label-sm">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="judul" name="judul" value="" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="guid" class="col-sm-2 col-form-label col-form-label-sm">Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" name="guid" id="guid" class="form-control form-control-sm" accept="image/jpg,image/png" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="isi" class="col-sm-2 col-form-label col-form-label-sm">Keterangan Gambar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="isi" name="isi" value="" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button class="btn btn-sm btn-primary">Simpan</button>
                            <button class="btn btn-sm btn-dark" type="reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    
@endpush
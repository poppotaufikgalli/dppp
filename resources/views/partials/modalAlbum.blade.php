<div class="modal fade" id="modalAlbum" tabindex="-1" aria-labelledby="modalGaleriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-accent">
                <h5 class="modal-title" id="modalGaleriLabel">Cari Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm small" id="tbListData" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>                                
                                <th width="30%">Judul</th>
                                <th>Jumlah Item</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($lsalbum) > 0)
                                @foreach($lsalbum as $key => $value)
                                    <tr class="">
                                        <td class="text-center">{{$key +1}}</td>
                                        <td>{{$value->judul}}</td>
                                        <td>{{$value->gambar->count() ?? 0}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-dismiss="modal" onclick="selectAlbum({{$value->id}}, '{{$value->judul}}')"><i class="bi bi-check-circle"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="fst-italic text-center">Data belum ada</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <p>
                        {{$lsalbum->links()}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function selectAlbum(id, judul)
        {
            document.getElementById('album_id').value = id
            document.getElementById('album_name').value = judul
            //document.getElementById('modalAlbum').
        }
    </script>
@endpush
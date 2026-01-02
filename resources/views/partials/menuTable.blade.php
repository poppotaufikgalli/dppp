@php($lvl = $mlvl)
@foreach($data as $key => $value)
    <tr>
        <td class="text-center">{{$lvl == 0 ? $key +1 : ''}}</td>
        <td>
            <div class="d-flex justify-content-start">
                @for($l = 0; $l < $lvl; $l++)
                    &nbsp;&nbsp;&nbsp;
                @endfor
                @for($l = 0; $l < $lvl; $l++)
                    -
                @endfor
                &nbsp;
                <span>
                    {{ $value->judul }}
                    @if($value->keterangan != '')
                        <br><span class="text-muted fst-italic">{{$value->keterangan}}</span>
                    @endif
                </span>
            </div>
        </td>
        <td class="text-center">
            {{ $value->jns == 0 ? '#' : ($value->jns == 1 ? 'Posting' : ($value->jns == 2 ? 'Link' :  'List Konten' )) }}
        </td>
        <td class="text-center">
            {{ $value->jns == 0 ? $value->target : ($value->jns == 1 ? $value->halaman_target->judul : ($value->jns == 2 ? $value->target :  $kontens[$value->target])) }}
        </td>
        <td class="text-center">
            <a href="{{route('menu.create',['ref' => $value->id])}}" class="btn btn-xs btn-success">
                <i class="bi bi-arrow-down-square-fill"></i>
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{route('menu.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                <a href="{{route('menu.destroy', ['id' => $value->id])}}" class="btn btn-xs {{count($value->sub) > 0 ? 'btn-outline-danger disabled' : 'btn-danger'}}" data-confirm-delete="true"><i class="bi bi-trash"></i></a>
            </div>
        </td>                    
    </tr>
    @if(isset($value->sub))
        @php($id_ref = $value->id)
        @include('partials.menuTable', ['data' => $value->sub, 'mlvl' => $lvl +1])
    @endif
@endforeach
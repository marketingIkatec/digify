@props([
    'block' => null,
    'item' => null
])
@if(!empty($block) && !empty($item))
    <div class="page-block-card" id="row-{{ $block->id }}" draggable="true" data-id="{{ $block->id }}">
        <div class="page-preview">
            <iframe src="{{route('admin.site.page.block.show', $block->id)}}"></iframe>
        </div>

        {{-- Overlay --}}
        <div class="card-overlay">
            <h4>
                {!! str_replace('<p>', '', str_replace('</p>', '', $block->titulo)) !!}
                {!! str_replace('<p>', '', str_replace('</p>', '', $block->subtitulo2)) !!}
            
            </h4>

            <div class="img-action">
                <a href="{{route('admin.site.page.block.show', $block->id)}}" target="_blank" class="btn btn-sm">
                    <img src="{{asset('build/images/admin/globe.png') }}" title="ver dobra">
                </a>
            
                <a href="javascript:;"
                    onclick="editarBlocoColorbox('{{$item->id}}', '{{$block->id}}');"
                    class="btn btn-sm edit colorbox">
                    <img src="{{asset('build/images/admin/edit.png')}}" title="Editar dobra">
                </a>

                <livewire:admin-delete-model
                        :item="$block"
                        :wire:key="'delete-'.$block->id"
                    />

                <livewire:admin-status-model
                    :item="$block"
                    field="status"
                    :wire:key="'status-'.$block->id"
                />

                <span class="btn btn-sm move" title="Mover posição">⠿</span>
            </div>
        </div>

    </div>
@endif

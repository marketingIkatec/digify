@extends('app')

@section('content')
@if(!empty($item->blocks))  
    @foreach($item->blocks as $block)    
        @if($block->status)
            @include('layouts.blocks.' . $block->tipo_bloco, [
                'block' => $block
            ])
        @endif
    @endforeach
@endif
@endsection

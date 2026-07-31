@extends('app')

@section('content')  
    @if($block)    
        @include('layouts.blocks.' . $block->tipo_bloco, [
            'block' => $block
        ])
    @endif
@endsection


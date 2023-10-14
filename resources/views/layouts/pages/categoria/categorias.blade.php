@extends('layouts.app')
@section('contenido')
    @livewire('web-categoria',[
        'categoria'=>   $categoria,
    ])
@endsection
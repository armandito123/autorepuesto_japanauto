@extends('layouts.app')
@section('contenido')
    @livewire('web-tipo-repuesto',[
        'tipo'=>   $tipo,
    ])
@endsection
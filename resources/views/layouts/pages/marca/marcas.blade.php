@extends('layouts.app')
@section('contenido')
    @livewire('web-marca',[
        'marca'=>   $marca,
    ])
@endsection
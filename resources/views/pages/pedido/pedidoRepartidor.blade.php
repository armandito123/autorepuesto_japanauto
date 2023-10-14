@extends('index')
@section('contenido')
    @livewire('repartidor-pedidos',[ 
        "idUser" => Auth::user()->id])
@endsection
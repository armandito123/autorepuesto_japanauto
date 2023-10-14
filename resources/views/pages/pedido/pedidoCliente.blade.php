@extends('index')
@section('contenido')
    @livewire('cliente-pedidos',[ 'idUser' => Auth::user()->id])
@endsection


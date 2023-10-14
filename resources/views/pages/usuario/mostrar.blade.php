@extends('index')
@section('contenido')
    @livewire('usuario',['idAuth'=>Auth::user()->id])
@endsection

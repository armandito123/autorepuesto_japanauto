@extends('layouts.app')
@section('contenido')
  @livewire('repuesto-detalle', ['repuesto' => $repuesto->id])
@endsection
<style>
  .box img{
  width: 100%;
  height: auto;
}
@supports(object-fit ; cover){
    .box img{
      height: 100%;
      object-fit: cover;
      object-position: center center;
    }
}
</style>
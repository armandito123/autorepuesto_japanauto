@extends('layouts.app')
@section('contenido')
  @auth
    @include('layouts.pages.auth')
  @else
    @include('layouts.pages.guest')
  @endauth
@endsection
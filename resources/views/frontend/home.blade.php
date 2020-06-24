@extends('frontend/layout.default')

@section('title')
Prakerja
@endsection

@section('content')

@if ($user = Sentinel::check())
  @include('frontend.home-default')
@else
  @include('frontend.home-prelogin')
@endif

@endsection
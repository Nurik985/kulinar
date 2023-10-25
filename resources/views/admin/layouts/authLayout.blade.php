@extends('admin/layouts/mainLayout')

@section('layoutContent')
@include('admin/layouts/sections/header')
@include('admin/layouts/sections/sidebar')
@yield('content')
@endsection
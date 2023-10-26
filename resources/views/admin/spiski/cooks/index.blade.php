@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Что готовим']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Что готовим')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
    </div>
@endsection
@section('page-script')
    @livewireScripts
@endsection

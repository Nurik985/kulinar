@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Разделы']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Разделы')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:sections.sections/>
    </div>
@endsection

@section('page-script')
    @livewireScripts
@endsection

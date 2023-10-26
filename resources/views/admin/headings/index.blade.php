@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Рубрики']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Рубрики')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:headings.headings/>
    </div>
@endsection

@section('page-script')
    @livewireScripts
@endsection

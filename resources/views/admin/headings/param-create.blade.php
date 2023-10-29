@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Рубрики', 'link' => route('rubrica.index')], ['name' => 'Добавление рубрики по параметрам']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Добавление рубрики по параметрам')

@section('page-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:headings.headings-create-param/>
    </div>
@endsection

@section('page-script')
    @vite('resources/js/headings.js')
    @livewireScripts
    @stack('scripts')
@endsection

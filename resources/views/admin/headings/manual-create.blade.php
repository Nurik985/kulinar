@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Рубрики', 'link' => route('rubrica.index')], ['name' => 'Добавление ручной рубрики']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Добавление ручной рубрики')

@section('page-style')
    @vite(['resources/scss/editor.css'])
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:headings.headings-create-manual/>
    </div>
@endsection

@section('page-script')
    @livewireScripts
    @stack('scripts')
@endsection

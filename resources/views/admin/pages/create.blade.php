@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Страницы', 'link' => route('pages.index')], ['name' => 'Добавление страницы']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Добавление страницы')

@section('page-style')
    @vite(['resources/scss/editor.css'])
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:pages.pages-create />
    </div>
@endsection

@section('page-script')
    @livewireScripts
    @stack('scripts')
@endsection

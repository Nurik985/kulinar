@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Страницы', 'link' => route('pages.index')], ['name' => 'Изменение страницы']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Изменение страницы')

@section('page-style')
    @vite(['resources/scss/editor.css'])
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:pages.pages-edit pageId="{{ $page->id }}"/>
    </div>
@endsection

@section('page-script')
    @livewireScripts
    @stack('scripts')
@endsection

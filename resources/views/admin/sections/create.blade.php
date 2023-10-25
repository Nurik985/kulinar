@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Разделы', 'link' => route('razdel.index')], ['name' => 'Добавление раздела']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Добавление раздела')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:sections.create-section />
    </div>
@endsection

@section('page-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    @livewireScripts
    @stack('scripts')
@endsection

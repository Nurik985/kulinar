@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Рубрики', 'link' => route('rubrica.index')], ['name' => 'Изменение рубрики']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Изменение рубрики')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @if($heading->type == 1)
            <livewire:headings.headings-edit-param headingId="{{ $heading->id }}" />
        @elseif($heading->type == 2)
            <livewire:headings.headings-edit-manul headingId="{{ $heading->id }}" />
        @else
            <h1 class="text-center text-red-600 text-[24px]">Не известный тип <br> Для рубрики такого типа шаблон еще не создан</h1>
        @endif
    </div>
@endsection

@section('page-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    @livewireScripts

    @stack('scripts')
@endsection

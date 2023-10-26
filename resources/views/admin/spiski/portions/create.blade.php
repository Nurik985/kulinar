@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Порции', 'link' => route('spisok.portions.index')], ['name' => 'Добавить порцию']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Добавить порцию')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.portions.create-portions />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

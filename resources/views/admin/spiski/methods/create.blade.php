@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Способы приготовления', 'link' => route('spisok.method.index')], ['name' => 'Добавить способ']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Добавить способ')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.methods.create-methods />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

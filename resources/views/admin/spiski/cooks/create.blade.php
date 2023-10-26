@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Что готовим', 'link' => route('spisok.cook.index')], ['name' => 'Добавить что готовим']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Добавить что готовим')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.cooks.create-cooks />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

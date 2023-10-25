@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Кухни', 'link' => route('spisok.kitchen.index')], ['name' => 'Добавить кухню']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Добавить кухню')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.kitchens.create-kitchen />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

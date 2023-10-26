@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Единица измерения', 'link' => route('spisok.units.index')], ['name' => 'Добавить единицу измерения']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Добавить единицу измерения')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.units.create-units />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

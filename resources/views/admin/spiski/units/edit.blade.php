@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Единицы измерения', 'link' => route('spisok.units.index')], ['name' => 'Изменить единицу измерения']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Изменить единицу измерения')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.units.edit-units unitId="{{ $unit->id }}" />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

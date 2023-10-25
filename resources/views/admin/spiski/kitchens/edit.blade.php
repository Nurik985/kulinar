@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Кухни', 'link' => route('spisok.kitchen.index')], ['name' => 'Изменить кухню']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Изменить кухню')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.kitchens.edit-kitchen kitId="{{ $kitchen->id }}" />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Что готовим', 'link' => route('spisok.cook.index')], ['name' => 'Изменить что готовим']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Изменить что готовим')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.cooks.edit-cooks cookId="{{ $cook->id }}" />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

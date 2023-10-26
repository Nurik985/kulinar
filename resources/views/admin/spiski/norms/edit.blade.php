@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Дневная норма', 'link' => route('spisok.norms.index')], ['name' => 'Изменить дневную норму']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Изменить дневную норму')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.norms.edit-norms normId="{{ $norm->id }}" />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

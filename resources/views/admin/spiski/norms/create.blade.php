@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Дневная норма', 'link' => route('spisok.norms.index')], ['name' => 'Добавить дневную норму']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Добавить дневную норму')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.norms.create-norms />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

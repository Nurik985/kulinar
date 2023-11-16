@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Страницы']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Страницы')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:pages.pages />
    </div>
@endsection

@section('page-script')
    @livewireScripts
    @stack('scripts')
@endsection

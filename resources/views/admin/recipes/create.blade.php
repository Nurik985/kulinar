@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Рецепты', 'link' => route('recipe.index')], ['name' => 'Добавление рецепта']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Добавление рецепта')

@section('page-style')
    @vite(['resources/scss/editor.css'])
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:recipes.create-recipes />
    </div>
@endsection

@section('page-script')
    @livewireScripts
    @stack('scripts')
@endsection

@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Ингредиенты', 'link' => route('spisok.ings.index')], ['name' => 'Новый ингредиент']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Новый ингредиент')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.ingredients.create-ingredients />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

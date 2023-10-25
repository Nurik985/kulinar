@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Ингредиенты', 'link' => route('spisok.ings.index')], ['name' => 'Изменить ингридиет']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Изменить ингридиет')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        <livewire:spiski.ingredients.edit-ingredients ingId="{{ $ing->id }}" />
    </div>

@endsection
@section('page-script')
    @livewireScripts
@endsection

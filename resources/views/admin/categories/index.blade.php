@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Рубрикатор']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Рубрикатор')

@section('page-style')
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:rubricator.rubricator/>
    </div>
@endsection
@section('page-script')
@endsection

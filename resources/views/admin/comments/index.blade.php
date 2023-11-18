@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Комментарий']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Комментарий')

@section('page-style')
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:comments.comments/>
    </div>
@endsection
@section('page-script')
@endsection

@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Реклама']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Реклама')

@section('page-style')
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:reklama.reklama />
    </div>
@endsection
@section('page-script')
@endsection

@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Списки'], ['name' => 'Минералы/Витамины']];
@endphp

@extends('admin/layouts/authLayout')

@section('title', 'Минералы/Витамины')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="min-h-screen p-4 lg:ml-64">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:spiski.minerals.minerals />
    </div>
@endsection
@section('page-script')
    @livewireScripts
@endsection

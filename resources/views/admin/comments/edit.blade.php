@php
    $data = [['name' => 'Домой', 'link' => route('admin')], ['name' => 'Комментарий', 'link' => route('comments.index')], ['name' => 'Изменение комментарий']];
@endphp
@extends('admin/layouts/authLayout')

@section('title', 'Изменение комментарий')

@section('page-style')
    @livewireStyles
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        @include('admin.layouts.sections.breadcrumb', $data)
        @include('admin.layouts.sections.successAlert')
        <livewire:comments.edit-comments commentId="{{ $comment->id }}"/>
    </div>
@endsection

@section('page-script')
    @livewireScripts
    @stack('scripts')
@endsection

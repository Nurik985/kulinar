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

        <section class="bg-white dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl">
                <div class="bg-white dark:bg-gray-800 relative border rounded-[4px] overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        Меню в шапке
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('page-script')
@endsection

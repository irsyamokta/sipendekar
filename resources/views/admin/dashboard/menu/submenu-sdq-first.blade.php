@extends('admin.index')
@section('content')
    <section x-data="{page: 'sdq', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
        @include('admin.dashboard.partials.navigations.preloader')
        <div class="flex h-screen overflow-hidden">
            @include('admin.dashboard.partials.navigations.sidebar')
            <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
                @include('admin.dashboard.partials.navigations.header')
                <main>
                    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                        @include('admin.dashboard.partials.toast.toast')
                        @include('admin.dashboard.partials.form.store.instrument-sdq-first')
                    </div>
                </main>
            </div>
        </div>
    </section>
@endsection

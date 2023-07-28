<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>{{ env("APP_NAME") }} - @yield("title_content")</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('admin.layouts.css')

    @yield("component_css")
</head>
    
    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center"  
        transition: all 0.5s; z-index: 997;height: 60px;box-shadow: 0px 2px 20px rgb(0 26 71 / 60%);padding-left: 20px;">
            @include('admin.layouts.header')
        </header><!-- End Header -->
        
        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            @include('admin.layouts.sidebar')
        </aside><!-- End Sidebar-->
        
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>
                    @yield("page_title")
                </h1>
                <nav>
                    @yield("breadcrumb")
                </nav>
            </div><!-- End Page Title -->
            @yield('content')
        </main><!-- End #main -->
        <br><br><br>
        
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        @include('admin.layouts.js')

        @yield("component_js")
    </body>
</html>
</x-app-layout>

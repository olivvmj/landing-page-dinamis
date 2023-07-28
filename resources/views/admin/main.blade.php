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
        <!-- ======= Footer ======= -->
        {{-- <footer id="footer" class="footer">
            @include('admin.layouts.footer')
        </footer><!-- End Footer --> --}}
        
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        @include('admin.layouts.js')

        @yield("component_js")
    </body>
</html>
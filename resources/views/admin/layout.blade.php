<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Asmani.pk a full featured news website for Karachi and other cities of pakistan!">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="author" content="Sabieh Ahmed, Danial Waseem">
    <link rel="shortcut icon" href="{{ asset('/backend/assets/images/favicon_1.ico')}}">

  <title>{{ config('blog.title') }} Admin</title>

    @yield('styles')
    
    <link href="{{ asset('/backend/assets/css/admin.min.css')}}" rel="stylesheet" type="text/css">
  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
           @yield('topbar')
        </div>
        <!-- Top Bar End -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
           @yield('sidebar')
        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                
                @yield('content')
                <!-- container -->
            </div>
            <!-- content -->
                @yield('footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
       
    
    </div>
    <!-- END wrapper -->
    <script>
    var resizefunc = [];
    </script>

   
    <script src="{{ asset('/backend/assets/js/admin.min.js')}}"></script>
   
     @yield('scripts')

</body>
</html>
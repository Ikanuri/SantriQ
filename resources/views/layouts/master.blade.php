<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | SantriQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">
    <!-- include head css -->
    @include('layouts.head-css')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- topbar -->
        @include('layouts.topbar')

        <!-- sidebar components -->
        @include('layouts.sidebar')
        @include('layouts.horizontal')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- footer -->
            @include('layouts.footer')

        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- vendor-scripts -->
    @include('layouts.vendor-scripts')

    {{-- alert --}}
    <script>
        alertify.set('notifier', 'position', 'top-right');
        @if (session('success'))
            alertify.success('{{ session('success') }}');
        @elseif (session('error'))
            alertify.error('{{ session('error') }}');
        @elseif (session('info'))
            alertify.message('{{ session('info') }}');
        @elseif (session('warning'))
            alertify.warning('{{ session('warning') }}');
        @endif
        // alertify.prompt("This is a prompt dialog.", "Default value",
        //     function(evt, value) {
        //         alertify.success(value);
        //     },
        //     function() {
        //         alertify.error('Cancel');
        //     });
    </script>
</body>

</html>

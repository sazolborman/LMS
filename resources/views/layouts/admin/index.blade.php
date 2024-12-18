<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{ config(['app.name' => get_settings('system_title')]) }}
    <title>@stack('title') | {{ config('app.name') }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta content="{{ csrf_token() }}" name="csrf_token" />
    <meta name="app-url" content="{{ config('app.url') }}">
    <meta name="referrer" content="no-referrer-when-downgrade">

    <link rel="shortcut icon" href="{{ asset('assets/backend/images/favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/icon-picker/fontawesome-iconpicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/fontawesome/css/fontaswesome.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/nice-select/nice-select.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/select2/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.min.css') }}"> --}}
    <!-- Tagify  -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/tagify/tagify.css') }}">
    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/dist/summernote-lite.min.css') }}">

    <!-- datepicker-autoclose -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/datepicker/bootstrap-datepicker.min.css') }}">
    <!-- datepicker range jquery plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/datepicker-plugin/daterangepicker.css') }}">

    <!-- fullcalendar css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/fullcalendar/packages/core/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/fullcalendar/packages/daygrid/main.css') }}" />

    <!-- boostrap icon -->
    <link rel="stylesheet"
        href="{{ asset('assets/backend/vendors/uicons-regular-rounded/css/uicons-regular-rounded.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/backend/vendors/bootstrap-icons-1.8.1/bootstrap-icons.css') }}" />

    <!-- ui dropdown search  -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/ui-dropdown-search/semantic.min.css') }}" />

    <!-- FlatIcons Css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/icons/css/all/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/icons/css/bold/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/icons/css/brands/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/icons/css/regular/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/icons/css/solid/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/icons/css/thin/rounded.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/icons/css/thin/straight.css') }}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/sweet_alerts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/modal.css') }}">




    @stack('css')
    <script src="{{ asset('assets/backend/js/jquery-3.7.1.min.js') }}"></script>

</head>


<body>


    <!-- Admin Main Top Area Start -->
    <main>
        <!-- Sidebar -->
        @include('admin::sidebar')
        <div class="body-wrapper">
            <!-- Header -->
            @include('admin::navbar')
            <!-- Content -->
            @yield('content')
        </div>
    </main>
    <!-- Admin Main Top Area End -->



    <script src="{{ asset('assets/backend/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- select js -->
    <script src="{{ asset('assets/backend/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/select2/select2.min.js') }}"></script>


    <!-- tagify js -->
    <script src="{{ asset('assets/backend/vendors/tagify/tagify.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/backend/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- chart-js -->
    <script src="{{ asset('assets/backend/vendors/chart-js/chart.js') }}"></script>
    <!-- iconpicker -->
    <script src="{{ asset('assets/backend/vendors/icon-picker/fontawesome-iconpicker.min.js') }}"></script>
    <!-- clipboard -->
    <script src="{{ asset('assets/backend/vendors/clipboard-js/clipboard.min.js') }}"></script>
    <!-- summernote js -->
    <script src="{{ asset('assets/backend/vendors/dist/summernote-lite.min.js') }}"></script>
    <!-- datepicker-autoclose js-->
    <script src="{{ asset('assets/backend/vendors/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- datepicker range plugin -->
    <script src="{{ asset('assets/backend/vendors/datepicker-plugin/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/datepicker-plugin/daterangepicker.js') }}"></script>

    <!-- full calender js -->
    <script src="{{ asset('assets/backend/vendors/fullcalendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/fullcalendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/fullcalendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/fullcalendar/packages/timegrid/main.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/fullcalendar/packages/list/main.js') }}"></script>

    <!-- ui dropdown search  -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/ui-dropdown-search/semantic.min.js') }}" />

    <!-- jquery form -->
    <script src="{{ asset('assets/backend/vendors/jquery-form/jquery.form.min.js') }}"></script>

    <!-- html to pdf  -->
    <script src="{{ asset('assets/backend/vendors/html2pdf/html2pdf.bundle.min.js') }}"></script>




    <script src="{{ asset('assets/backend/js/script.js') }}"></script>

    @include('admin::modal')
    @include('admin.inited')
    @include('admin::toastr')
    @include('admin::custom_js')
    @include('admin::common_script')
    @stack('js')
</body>

</html>

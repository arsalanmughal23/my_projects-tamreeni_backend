<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="icon" type="image/png" href="{{asset('public/favicon.ico')}}">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Ion Icon -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.css"
          integrity="sha512-EzrsULyNzUc4xnMaqTrB4EpGvudqpetxG/WNjCpG6ZyyAGxeB6OBF9o246+mwx3l/9Cn838iLIcrxpPHTiygAA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"
          integrity="sha512-mxrUXSjrxl8vm5GwafxcqTrEwO1/oBNU25l20GODsysHReZo4uhVISzAKzaABH6/tTfAxZrY2FprmeAP5UZY8A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
          integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
          crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <style>
        label.required:after {
            color: #cc0000;
            content: "*";
            font-weight: bold;
            margin-left: 3px;
        }
    </style>
    {{--<link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">--}}
    @stack('third_party_stylesheets')

    @stack('page_css')
    <style>
        [class*=sidebar-dark-] {
            background-color: #33bba2;
        }

        [class*=sidebar-dark-] .sidebar a {
            color: #fff;
        }

        [class*=sidebar-dark] .brand-link, [class*=sidebar-dark] .brand-link .pushmenu {
            color: #fff;
        }

        /*[input="file"].form-control {*/
        /*padding: 3px;*/
        /*}*/

        input[type="file"] {
            padding: 3px;
        }

        .sidebar {
            padding-left: 0.3rem;
            scrollbar-width: none;
            scrollbar-color: #fff;
        }

        [class*=sidebar-dark] .brand-link {
            border-bottom: 1px solid #f4f6f94a;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
            background-color: #fff;
            color: #33bba2;
        }

        .btn-primary {
            background-color: #33bba2;
            border-color: #33bba2;
            color: #fff;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary:visited {
            background-color: #33bba2;
            border-color: #33bba2;
            color: #fff;
        }

        .bg-primary {
            background-color: #33bba2 !important;
            color: #fff;
        }

        a {
            color: #33bba2;
        }

        a:hover, a:active, a:focus, a:visited {
            color: #33bba2;
        }

        .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show > .btn-primary.dropdown-toggle {
            background-color: #33bba2;
            border-color: #33bba2;
        }

        a.btn-default, a.btn-default:hover, a.btn-default:focus, a.btn-default:visited {
            color: #444;
        }

        #dataTableBuilder_filter {
            position: relative;
            float: right;
        }

        #dataTableBuilder_info {
            position: relative;
            float: left;
        }

        .icheck-primary > input:first-child:checked + input[type=hidden] + label::before, .icheck-primary > input:first-child:checked + label::before {
            background-color: #33bba2;
            border-color: #33bba2;
        }

        .icheck-primary > input:first-child:not(:checked):not(:disabled):hover + input[type=hidden] + label::before, .icheck-primary > input:first-child:not(:checked):not(:disabled):hover + label::before {
            border-color: #33bba2;
        }

        .brand-link .brand-image {
            margin-top: -5px;
            max-height: 40px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #33bba28c;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #33bba2;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[aria-selected]:hover {
            background-color: #33bba2;

        }

        .page-item.active .page-link {
            background-color: #33bba2;
            border-color: #33bba2;
        }

        .page-link {
            color: #33bba2;
        }

        .page-link:hover {
            color: #33bba2;
        }

        .form-control:focus {
            border-color: #33bba2;
        }

        .btn-outline-secondary {
            color: #33bba2;
            border-color: #33bba2;
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #33bba2;
            border-color: #33bba2;
        }

        .btn-outline-secondary:not(:disabled):not(.disabled).active, .btn-outline-secondary:not(:disabled):not(.disabled):active, .show > .btn-outline-secondary.dropdown-toggle {
            color: #fff;
            background-color: #33bba2;
            border-color: #33bba2;
        }

        .btn-primary.disabled, .btn-primary:disabled {
            color: #fff;
            background-color: #33bba2;
            border-color: #33bba2;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 23px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }

        .select2-container--default .select2-selection--single {
            height: 38px;
            padding-top: 10px;
        }

        .label-success {
            background-color: #5cb85c;
        }

        .label-danger {
            background-color: #d9534f;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #33bba2;
            border: 1px solid #33bba2;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fffdfd;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            margin-right: 5px;
        }

        .nav {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: #000; /* Adjust color as needed */
            text-decoration: none;
        }

        .nav-link.active {
            font-weight: bold;
            /* Add any other styles for active link */
        }

        .nav-link i {
            margin-right: 10px; /* Adjust spacing between icon and text */
        }

        /* Additional styling for icons if needed */
        .fa {
            width: 20px; /* Adjust icon size as needed */
        }

        .container-fluid .small-box>.icon>.fa{
            direction: rtl;
        }


        @media (min-width: 576px) {
            .navbar-nav > .user-menu .user-image {
                margin-right: 0;
            }
        }
    </style>
    <script>
        function brokenImageHandler(img) {
            img.src = "https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=";
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        {{--<ul class="navbar-nav">--}}
        {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>--}}
        {{--</li>--}}
        {{--</ul>--}}

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ isset(auth()->user()?->details)? auth()->user()?->details->image : asset('public/image/user.png') }}"
                         class="user-image img-circle imag-placeholder" alt="User Image "
                         onerror="brokenImageHandler(this);">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ isset(auth()->user()?->details)? auth()->user()?->details->image : asset('public/image/user.png') }}"
                             class="img-circle" alt="User Image"
                             onerror="brokenImageHandler(this);">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('users.edit', auth()->user()->id) }}"
                           class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        </div>
        <strong>
            Copyright &copy; {{date('Y')}} <a href="https://tekrevol.com">TekRevol</a>.
        </strong>
        All rights reserved.
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"
        integrity="sha512-AJUWwfMxFuQLv1iPZOTZX0N/jTCIrLxyZjTRKQostNU71MzZTEPHjajSK20Kj1TwJELpP7gl+ShXw5brpnKwEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
        integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.3/bootstrapSwitch.min.js"
    integrity="sha512-DAc/LqVY2liDbikmJwUS1MSE3pIH0DFprKHZKPcJC7e3TtAOzT55gEMTleegwyuIWgCfOPOM8eLbbvFaG9F/cA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('public/js/custom.js') }}" type="text/javascript"></script>

<script>
    $(function () {
        bsCustomFileInput.init();

        $('.card-footer>a').on('click', function(){
            $('.card-footer>input[type=submit]').attr('disabled', true);
        })
        const form = $('.card-footer').closest('form');
        form.on('submit', function (e) {
            $('.card-footer>input[type=submit]').attr('disabled', true);
            $('.card-footer>a').addClass('d-none');
        });

        setTimeout(()=>{
            $('.alert').addClass('d-none')
        },5000);

        setTimeout(()=>{
            // Clear the search input
            $('input[type=search]').val('');

            // Get the DataTable instance and clear the search
            var table = $('#dataTableBuilder').DataTable();
            table.search('').draw();  // Clear search and redraw the table
        })
    });

    function iformat(icon) {
        var originalOption = icon.element;
        return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
    }

    $(".select2").select2({
        placeholder: "Select",
        allowClear: true
    })
    // $(".select2").select2({
    // width: "100%",
    // // templateSelection: iformat,
    // // templateResult: iformat,
    // allowHtml: true
    // });

    // $("input[data-bootstrap-switch]").each(function () {
    //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
    // });
</script>

@stack('third_party_scripts')

@stack('page_scripts')

</body>

</html>

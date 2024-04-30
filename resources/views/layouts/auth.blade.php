<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('public/favicon.ico')}}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"
          integrity="sha512-mxrUXSjrxl8vm5GwafxcqTrEwO1/oBNU25l20GODsysHReZo4uhVISzAKzaABH6/tTfAxZrY2FprmeAP5UZY8A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
          integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
          crossorigin="anonymous"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">--}}
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

        @media (min-width: 576px) {
            .navbar-nav > .user-menu .user-image {
                margin-right: 0;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">

@yield('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"
        integrity="sha512-AJUWwfMxFuQLv1iPZOTZX0N/jTCIrLxyZjTRKQostNU71MzZTEPHjajSK20Kj1TwJELpP7gl+ShXw5brpnKwEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>

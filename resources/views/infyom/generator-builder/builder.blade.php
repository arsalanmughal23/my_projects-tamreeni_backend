<?php
$databaseName = \DB::connection()->getDatabaseName();
$tables       = DB::select('SHOW TABLES');
$db           = 'Tables_in_' . $databaseName;
?>
@extends('layouts.app')

@push('third_party_stylesheets')
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}

    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 15px;
        }

        .chk-align {
            padding-right: 10px;
        }

        .chk-label-margin {
            margin-left: 5px;
        }

        .required {
            color: red;
            padding-left: 5px;
        }

        .btn-green {
            background-color: #00A65A !important;
        }

        .btn-blue {
            background-color: #2489C5 !important;
        }

        .fa-select {
            font-family: sans-serif, 'FontAwesome';
        }
    </style>
@endpush
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crud Generator From Table</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3 mb-5">
        <div class="card">
            <div class="card-body row">
                <div class="box box-primary col-lg-12">
                    <div class="box-body">
                        <form method="POST" action="{{ route('dbtables.generate_crud_from_table') }}">
                            <input type="hidden" name="_token" id="rbToken" value="{!! csrf_token() !!}"/>

                            <div class="form-group col-md-4">
                                <label>Tables</label>
                                <select name="db_tables" class="form-control select2" style="width: 100%" required>
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->{$db} }}">{{ $table->{$db} }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('menu_icon', 'Icon*') }}
                                <select class="form-control select2" name="menu_icon" style="width: 100%;" required>
                                    @foreach (getIcons() as $item)
                                        <option data-icon="fa-{{ $item }}" value="{{ $item }}">
                                            {{ ucwords($item) }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group col-md-12">
                                <label>
                                    <input type="checkbox" class="flat-red" id="customModel"><span
                                            class="chk-label-margin"> Custom Model Name </span>
                                </label>
                            </div>
                            <div class="form-group col-md-4 show_model hide">
                                <label>Model Name</label>
                                <input type="text" name="model_name" class="form-control"
                                       placeholder="Enter Model Name">
                            </div>
                            <div class="form-inline col-md-12" style="padding:10px 10px;text-align: right">
                                <div class="form-group" style="border-color: transparent;">
                                    <button type="submit" class="btn btn-flat btn-primary">Generate Crud
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- <section class="content-header">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1">
                            <section class="content">
                                <div id="schemaInfo" style="display: none"></div>
                                <div class="box box-primary col-lg-12">
                                    <div class="box-header" style="margin-top: 10px">
                                        <h1 class="box-title" style="font-size: 30px">Generate CRUD From Schema</h1>
                                    </div>
                                    <div class="box-body">
                                        <form method="post" id="schemaForm" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" id="smToken" value="{!! csrf_token() !!}"/>
                                            <div class="form-group col-md-4">
                                                <label for="txtSmModelName">Model Name<span class="required">*</span></label>
                                                <input type="text" name="modelName" class="form-control" id="txtSmModelName" placeholder="Enter Model Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="schemaFile">Schema File<span class="required">*</span></label>
                                                <input type="file" name="schemaFile" class="form-control" required id="schemaFile">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="drdSmCommandType">Command Type</label>
                                                <select name="commandType" id="drdSmCommandType" class="form-control" style="width: 100%">
                                                    <option value="infyom:api_scaffold">API Scaffold Generator</option>
                                                    <option value="infyom:api">API Generator</option>
                                                    <option value="infyom:scaffold">Scaffold Generator</option>
                                                </select>
                                            </div>
                                            <div class="form-inline col-md-12" style="padding:15px 15px;text-align: right">
                                                <div class="form-group" style="border-color: transparent;padding-left: 10px">
                                                    <button type="submit" class="btn btn-flat btn-primary btn-blue" id="btnSmGenerate">Generate
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
@push('third_party_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

    <script>
        $("#customModel").on("ifChanged", function () {
            if ($(this).prop('checked') == true) {
                $('.show_model').removeClass('hide');
            } else {
                $('.show_model').addClass('hide');
            }
        });

        var fieldIdArr = [];
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

            $("#drdCommandType").on("change", function () {
                if ($(this).val() == "infyom:scaffold") {
                    $('#chSwag').hide();
                    $('#chTest').hide();
                } else {
                    $('#chSwag').show();
                    $('#chTest').show();
                }
            });

            $("#chkForceMigrate").on("ifChanged", function () {
                if ($(this).prop('checked') == true) {
                    $('#chkMigration').iCheck("check", true);
                    $('#chkMigration').iCheck("disable", true);
                } else {
                    $('#chkMigration').iCheck("enable", true);
                }
            });

            $(document).ready(function () {
                var htmlStr = '<tr class="item" style="display: table-row;"></tr>';
                var commonComponent = $(htmlStr).filter("tr").load('{{ route('io_field_template') }}');
                var relationStr = '<tr class="relationItem" style="display: table-row;"></tr>';
                var relationComponent = $(relationStr).filter("tr").load(
                    '{{ route('io_relation_field_template') }}');

                $("#btnAdd").on("click", function () {
                    var item = $(commonComponent).clone();
                    initializeCheckbox(item);
                    $("#container").append(item);
                });

                $("#btnTimeStamps").on("click", function () {
                    var item_created_at = $(commonComponent).clone();
                    $(item_created_at).find('.txtFieldName').val("created_at");
                    renderTimeStampData(item_created_at);
                    initializeCheckbox(item_created_at);
                    $("#container").append(item_created_at);


                    var item_updated_at = $(commonComponent).clone();
                    $(item_updated_at).find('.txtFieldName').val("updated_at");
                    renderTimeStampData(item_updated_at);
                    initializeCheckbox(item_updated_at);
                    $("#container").append(item_updated_at);
                });

                $("#btnPrimary").on("click", function () {
                    var item = $(commonComponent).clone();
                    renderPrimaryData(item);
                    initializeCheckbox(item);
                    $("#container").append(item);
                });

                $("#btnRelationShip").on("click", function () {
                    $("#relationShip").show();
                    var item = $(relationComponent).clone();

                    $(item).find("select").select2({
                        width: '100%'
                    });

                    var relationType = $(item).find('.drdRelationType');

                    $(relationType).select2().on('change', function () {
                        if ($(relationType).val() == "mtm")
                            $(item).find('.foreignTable').show();
                        else
                            $(item).find('.foreignTable').hide();
                    });

                    $("#rsContainer").append(item);
                });

                $("#btnModelReset").on("click", function () {
                    $("#container").html("");
                    $('input:text').val("");
                    $('input:checkbox').iCheck('uncheck');

                });

                $("#form").on("submit", function () {
                    var fieldArr = [];
                    var relationFieldArr = [];
                    $('.item').each(function () {

                        var htmlType = $(this).find('.drdHtmlType');
                        var htmlValue = "";
                        if ($(htmlType).val() == "select" || $(htmlType).val() == "radio") {
                            htmlValue = $(this).find('.drdHtmlType').val() + ',' + $(this)
                                .find('.txtHtmlValue').val();
                        } else {
                            htmlValue = $(this).find('.drdHtmlType').val();
                        }

                        fieldArr.push({
                            name: $(this).find('.txtFieldName').val(),
                            dbType: $(this).find('.txtdbType').val(),
                            htmlType: htmlValue,
                            validations: $(this).find('.txtValidation').val(),
                            foreignTable: $(this).find('.txtForeignTable').val(),
                            isForeign: $(this).find('.chkForeign').prop('checked'),
                            searchable: $(this).find('.chkSearchable').prop(
                                'checked'),
                            fillable: $(this).find('.chkFillable').prop('checked'),
                            primary: $(this).find('.chkPrimary').prop('checked'),
                            inForm: $(this).find('.chkInForm').prop('checked'),
                            inIndex: $(this).find('.chkInIndex').prop('checked')
                        });
                    });

                    $('.relationItem').each(function () {
                        relationFieldArr.push({
                            relationType: $(this).find('.drdRelationType').val(),
                            foreignModel: $(this).find('.txtForeignModel').val(),
                            foreignTable: $(this).find('.txtForeignTable').val(),
                            foreignKey: $(this).find('.txtForeignKey').val(),
                            localKey: $(this).find('.txtLocalKey').val(),
                        });
                    });

                    var data = {
                        modelName: $('#txtModelName').val(),
                        commandType: $('#drdCommandType').val(),
                        tableName: $('#txtCustomTblName').val(),
                        migrate: $('#chkMigration').prop('checked'),
                        options: {
                            softDelete: $('#chkDelete').prop('checked'),
                            save: $('#chkSave').prop('checked'),
                            prefix: $('#txtPrefix').val(),
                            paginate: $('#txtPaginate').val(),
                            forceMigrate: $('#chkForceMigrate').prop('checked'),
                        },
                        addOns: {
                            swagger: $('#chkSwagger').prop('checked'),
                            tests: $('#chkTestCases').prop('checked'),
                            datatables: $('#chkDataTable').prop('checked')
                        },
                        fields: fieldArr,
                        relations: relationFieldArr
                    };

                    data['_token'] = $('#token').val();

                    $.ajax({
                        url: '{{ route('io_generator_builder_generate') }}',
                        method: "POST",
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        success: function (result) {

                            $.ajax({
                                url: '{{ route('dbtables.create_menus') }}',
                                data: {
                                    model_name: $('#txtModelName').val(),
                                    db_tables: $('#txtCustomTblName').val(),
                                    menu_icon: $('#txtIconName').val()
                                },
                                success: function (html) {
                                    console.log(html);
                                }
                            });

                            $.ajax({
                                url: "{{ url('run_artisan_command/optimize') }}",
                                success: function (html) {
                                    $.ajax({
                                        url: "{{ url('create_permissions') }}/" +
                                            $('#txtModelName')
                                                .val(),
                                        success: function (html) {
                                            $("#info").html("");
                                            $("#info").append(
                                                '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>' +
                                                result +
                                                '</strong></div>'
                                            );
                                            $("#info").show();
                                            var $container = $(
                                                "html,body");
                                            var $scrollTo = $(
                                                '#info');
                                            $container.animate({
                                                    scrollTop: $scrollTo
                                                            .offset()
                                                            .top -
                                                        $container
                                                            .offset()
                                                            .top,
                                                    scrollLeft: 0
                                                },
                                                300);
                                            setTimeout(
                                                function () {
                                                    $('#info')
                                                        .fadeOut(
                                                            'fast'
                                                        );
                                                }, 3000);
                                            location.reload();
                                        }
                                    });
                                }
                            });
                        },
                        error: function (result) {
                            var result = JSON.parse(JSON.stringify(result));
                            var errorMessage = '';
                            if (result.hasOwnProperty('responseJSON') && result
                                .responseJSON.hasOwnProperty('message')) {
                                errorMessage = result.responseJSON.message;
                            }

                            $("#info").html("");
                            $("#info").append(
                                '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fail! </strong>' +
                                errorMessage + '</div>');
                            $("#info").show();
                            var $container = $("html,body");
                            var $scrollTo = $('#info');
                            $container.animate({
                                scrollTop: $scrollTo.offset().top
                            }, 300);
                            setTimeout(function () {
                                $('#info').fadeOut('fast');
                            }, 3000);
                        }
                    });

                    return false;
                });

                $('#rollbackForm').on("submit", function (e) {
                    e.preventDefault();

                    var data = {
                        modelName: $('#txtRBModelName').val(),
                        commandType: $('#drdRBCommandType').val(),
                        prefix: $('#txtRBPrefix').val(),
                        _token: $('#rbToken').val()
                    };

                    $.ajax({
                        url: '{{ route('io_generator_builder_rollback') }}',
                        method: "POST",
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        success: function (result) {
                            var result = JSON.parse(JSON.stringify(result));

                            $("#rollbackInfo").html("");
                            $("#rollbackInfo").append(
                                '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>' +
                                result.message + '</strong></div>');
                            $("#rollbackInfo").show();

                            var $container = $("html,body");
                            var $scrollTo = $('#rollbackInfo');
                            $container.animate({
                                scrollTop: $scrollTo.offset().top - $container
                                    .offset().top,
                                scrollLeft: 0
                            }, 300);
                            setTimeout(function () {
                                $('#rollbackInfo').fadeOut('fast');
                            }, 3000);
                            $.ajax({
                                url: "{{ route('dbtables.generated_crud_delete_permissions') }}",
                                data: {
                                    model: $('#txtRBModelName').val()
                                },
                                success: function (html) {
                                    $("#results").append(html);

                                    $.ajax({
                                        url: '{{ route('dbtables.delete_menus') }}',
                                        data: {
                                            model_name: $(
                                                '#txtRBModelName'
                                            ).val(),
                                        },
                                        success: function (html) {
                                            location.reload();
                                        }
                                    });


                                }
                            });
                        },
                        error: function (result) {
                            var result = JSON.parse(JSON.stringify(result));
                            var errorMessage = '';
                            if (result.hasOwnProperty('responseJSON') && result
                                .responseJSON.hasOwnProperty('message')) {
                                errorMessage = result.responseJSON.message;
                            }

                            $("#rollbackInfo").html("");
                            $("#rollbackInfo").append(
                                '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fail! </strong>' +
                                errorMessage + '</div>');
                            $("#rollbackInfo").show();
                            setTimeout(function () {
                                $('#rollbackInfo').fadeOut('fast');
                            }, 3000);
                        }
                    });
                });


                $('#schemaFile').change(function () {
                    var ext = $(this).val().split('.').pop().toLowerCase();
                    if (ext != 'json') {
                        $("#schemaInfo").html("");
                        $("#schemaInfo").append(
                            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Schema file must be json</strong></div>'
                        );
                        $("#schemaInfo").show();
                        $(this).replaceWith($(this).val('').clone(true));
                        setTimeout(function () {
                            $('div.alert').fadeOut('fast');
                        }, 3000);
                    }
                });

                $('#schemaForm').on("submit", function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '{{ route('io_generator_builder_generate_from_file') }}',
                        type: 'POST',
                        data: new FormData($(this)[0]),
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            var result = JSON.parse(JSON.stringify(result));

                            $("#schemaInfo").html("");
                            $("#schemaInfo").append(
                                '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>' +
                                result.message + '</strong></div>');
                            $("#schemaInfo").show();
                            var $container = $("html,body");
                            var $scrollTo = $('#schemaInfo');
                            $container.animate({
                                scrollTop: $scrollTo.offset().top - $container
                                    .offset().top,
                                scrollLeft: 0
                            }, 300);
                            setTimeout(function () {
                                $('#schemaInfo').fadeOut('fast');
                            }, 3000);
                            location.reload();
                        },
                        error: function (result) {
                            var result = JSON.parse(JSON.stringify(result));
                            var errorMessage = '';
                            if (result.hasOwnProperty('responseJSON') && result
                                .responseJSON.hasOwnProperty('message')) {
                                errorMessage = result.responseJSON.message;
                            }

                            $("#schemaInfo").html("");
                            $("#schemaInfo").append(
                                '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fail! </strong>' +
                                errorMessage + '</div>');
                            $("#schemaInfo").show();
                            setTimeout(function () {
                                $('#schemaInfo').fadeOut('fast');
                            }, 3000);
                        }
                    });
                });

                function renderPrimaryData(el) {

                    $('.chkPrimary').iCheck(getiCheckSelection(false));

                    $(el).find('.txtFieldName').val("id");
                    $(el).find('.txtdbType').val("increments");
                    $(el).find('.chkSearchable').attr('checked', false);
                    $(el).find('.chkFillable').attr('checked', false);
                    $(el).find('.chkPrimary').attr('checked', true);
                    $(el).find('.chkInForm').attr('checked', false);
                    $(el).find('.chkInIndex').attr('checked', false);
                    $(el).find('.drdHtmlType').val('number').trigger('change');
                }

                function renderTimeStampData(el) {
                    $(el).find('.txtdbType').val("timestamp");
                    $(el).find('.chkSearchable').attr('checked', false);
                    $(el).find('.chkFillable').attr('checked', false);
                    $(el).find('.chkPrimary').attr('checked', false);
                    $(el).find('.chkInForm').attr('checked', false);
                    $(el).find('.chkInIndex').attr('checked', false);
                    $(el).find('.drdHtmlType').val('date').trigger('change');
                }

            });

            function initializeCheckbox(el) {
                $(el).find('input:checkbox').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue'
                });
                $(el).find("select").select2({
                    width: '100%'
                });

                $(el).find(".chkPrimary").on("ifClicked", function () {
                    $('.chkPrimary').each(function () {
                        $(this).iCheck('uncheck');
                    });
                });

                $(el).find(".chkForeign").on("ifChanged", function () {
                    if ($(this).prop('checked') == true) {
                        $(el).find('.foreignTable').show();
                    } else {
                        $(el).find('.foreignTable').hide();
                    }
                });

                $(el).find(".chkPrimary").on("ifChanged", function () {
                    if ($(this).prop('checked') == true) {
                        $(el).find(".chkSearchable").iCheck('uncheck');
                        $(el).find(".chkFillable").iCheck('uncheck');
                        $(el).find(".chkInForm").iCheck('uncheck');
                    }
                });

                var htmlType = $(el).find('.drdHtmlType');

                $(htmlType).select2().on('change', function () {
                    if ($(htmlType).val() == "select" || $(htmlType).val() == "radio")
                        $(el).find('.htmlValue').show();
                    else
                        $(el).find('.htmlValue').hide();
                });

            }

        });

        function getiCheckSelection(value) {
            if (value == true)
                return 'checked';
            else
                return 'uncheck';
        }

        function removeItem(e) {
            e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
        }
    </script>
@endpush

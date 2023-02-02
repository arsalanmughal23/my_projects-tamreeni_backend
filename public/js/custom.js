// Form Submit using S3 Token

// $(document).on("submit", "form", function (e) {

//     event.preventDefault();

//     let awsBucketToken = "";
//     let formData = new FormData(this);
//     // formData.append('file', full_number);

//     ajaxGet("{{route('api.get_aws_bucket_token')}}", {}, (status, data) => {
//         if(status){
//             awsBucketToken = getURL(data.url);
//         }
//     });

//     uploadToS3(awsBucketToken, formData);
// });

function uploadToS3(awsBucketToken, formData) {
    let response;
    $.ajax({
        type: 'POST',
        url: awsBucketToken.url,
        headers: awsBucketToken.headers,
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        async: false,
        success: function (data) {
            response = data;
        },
        error: function (data) {
            response = data;
        }
    });

    if (response.status == 200 || response.status == 204) {
        return true;
    }

    return false;
}

function getURL(url) {
    let awsURL = new URL(url).origin + new URL(url).pathname;
    let params = {};

	new URL(url).searchParams.forEach(function (val, key) {
		params[key] = val;
	});

    return {url: awsURL, headers: params};
}

function ajaxPost(url, data, callback, formdata = true) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (formdata) {
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (rdata) {
                callback(true, rdata)
            }, error: function (edata) {
                callback(false, edata)
            }
        });
    } else {
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            cache: false,
            dataType: 'json',
            success: function (rdata) {
                callback(true, rdata)
            }, error: function (edata) {
                callback(false, edata)

            }
        });
    }

}

function ajaxGet(url, queryParam, callback) {
    $.ajax({
        method: "GET",
        url: url,
        data: queryParam,
        dataType: 'json',
        async: false,
        success: function (rdata) {
            callback(true, rdata)
        }, error: function (edata) {

            callback(false, edata)
        }
    });
}

function toast(msg, reload = false, url = null) {
    var x = document.getElementById("snackbar");
    x.className = "show";
    x.innerText = msg;
    if (reload) {
        if (url != null) {
            window.location.href = url;
        } else {
            location.reload();
        }
    } else {
        setTimeout(function () {
            x.className = x.className.replace("show", "");
            x.innerText = "";
        }, 3000);
    }

}

function confirmDelete(form) {
    console.log(form);
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            $(form).submit();
        }
    });
}

function formatFaIcon(state) {
    if (!state.id) return state.text; // optgroup
    return "<i class='fa fa-" + state.id + "'></i> " + state.text;
}

function defaultFormat(state) {
    return state.text;
}

function swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token, cb) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + token
        }
    });
    $.ajax({
        method: "PUT",
        url: url,
        type: "JSON",
        async: false,
        data: {
            rowId: rowId,
            rowPosition: rowPos,
            prevRowId: prevRowId,
            prevRowPosition: prevRowPos
        },
        success: cb
    });

}

$.fn.customLoad = function () {
    //Timepicker
    // $('.timepicker').timepicker({
    //     showInputs: false,
    //     containerClass: 'bootstrap-timepicker',
    //     timeFormat: 'HH:mm:ss p'
    // });

    $('.select2').each(function () {
        var format = $(this).data('format') ? $(this).data('format') : "defaultFormat";
        var thisSelectElement = this;
        var options = {
            placeholder: "Please Select",
            theme: "bootstrap",
            templateResult: window[format],
            templateSelection: window[format],
            escapeMarkup: function (m) {
                return m;
            }
        };

        if ($(thisSelectElement).data('url')) {
            var depends;
            if ($(thisSelectElement).data('depends')) {
                depends = $('[name=' + $(thisSelectElement).data('depends') + ']');
                depends.on('change', function () {
                    $(thisSelectElement).val(null).trigger('change')
                    // $(thisSelectElement).trigger('change');
                });
            }
            var url = $(thisSelectElement).data('url');

            options.ajax = {
                url: url,
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term,
                        locale: 'en',
                        depends: $('option:selected', depends).val()
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (obj, id) {
                            return {id: obj.id, text: obj.name};
                        })
                    };
                }

            }
        }

        var tabindex = $(thisSelectElement).attr('tabindex');

        $(thisSelectElement).select2(options);

        $(thisSelectElement).attr('tabindex', tabindex);
        $(thisSelectElement).on(
            'select2:select', (
                function () {
                    $(this).focus();
                }
            )
        );
    });
};


$(document).ready(function () {
    $("form").attr('autocomplete', 'off');

    // $(document).customLoad();

    $('.summernote').summernote();

    $(document).on('click', '.btn-up-ajax', function () {

        var url = $(this).data('url');
        var token = $(this).data('token');
        var tr = $(this).parents('tr');
        var trPrev = tr.prev('tr');

        if (trPrev.length != 0) {
            var prevRowPos = $('input.inputSort', trPrev).val();
            var prevRowId = $('input.inputSort', trPrev).data('id');
            var rowPos = $('input.inputSort', tr).val();
            var rowId = $('input.inputSort', tr).data('id');

            // Handle UI
            trPrev.before(tr.clone());
            tr.remove();

            // Init Ajax to send sort values.
            var result = swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token);

            if (result) {
                // Update chanel position - UI
                $('input.inputSort', tr).val('');
                $('input.inputSort', tr).val(prevRowPos);

                $('input.inputSort', trPrev).val('');
                $('input.inputSort', trPrev).val(RowPos);
            }
        }
    });

    $(document).on('click', '.btn-down-ajax', function () {

        var url = $(this).data('url');
        var token = $(this).data('token');
        var tr = $(this).parents('tr');
        var trPrev = tr.next('tr');
        if (trPrev.length != 0) {
            var prevRowPos = $('input.inputSort', trPrev).val();
            var prevRowId = $('input.inputSort', trPrev).data('id');
            var rowPos = $('input.inputSort', tr).val();
            var rowId = $('input.inputSort', tr).data('id');


            // Init Ajax to send sort values.
            swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token, function (response) {
                var result = response.data.msg;
                if (result) {
                    // Update chanel position - UI
                    $('input.inputSort', tr).val(prevRowPos);
                    $('input.inputSort', trPrev).val(rowPos);

                    // Handle UI
                    tr.next('tr').after(tr.clone());
                    tr.remove();
                }
            });

        }
    });

    $("#togglePassword").click(function () {
        $(this).toggleClass("glyphicon-eye-close");
        var input = $("#id_password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

    });

    $("#togglePasswordConfirm").click(function () {
        $(this).toggleClass("glyphicon-eye-close");
        var input = $("#id_confirm_password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

    });

    $('.valid-phone').on('keydown', function () {
        var value = parseInt($(this).val());
        var reg = '/^\d+$/';
        $('#phoneErrorMessage').html((value.toString() && value.toString().length) < 11 ? 'Minimum length of phone number is 11' : '');
        $('.submit-button').prop('disabled', value.toString().length < 11);
        if (value.toString().length >= 15 && event.keyCode != 8) {
            return false;
        }
    });


    // $('input:checkbox, input:radio').iCheck({
    //     checkboxClass: 'icheckbox_square-blue',
    //     radioClass: 'iradio_square-blue',
    //     increaseArea: '20%' // optional
    // });

    // $('input:checkbox.checkall').on('ifToggled', function (event) {
    //     var newState = $(this).is(":checked") ? 'check' : 'uncheck';
    //     var css = $(this).data('check');
    //     $('input:checkbox.' + css).iCheck(newState);
    // });
});


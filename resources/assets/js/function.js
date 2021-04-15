
var active_modal = "";
var modal_delay = 300;
var baseURL = "";
var fnPositiveButton, fnNegativeButton;
var csrfParam = '_token';

function initDatatable(el) {
    $(el).DataTable();
}

function initDatetime(el) {
    $(el).datetimepicker({
        useCurrent: false,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        },
    }).on('dp.show', function () {
        if ($(this).data("DateTimePicker").date() === null)
            $(this).data("DateTimePicker").date(moment());
    });
}

function initDateRangePicker(el) {
    /* Daterange picker Init*/
	$(el).daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-info',
        cancelClass: 'btn-default'
    });
}

function initTime(el) {
    $(el).datetimepicker({
        format: 'LT',
        useCurrent: false,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        },
    });
}

function initCalender(el) {
    $(el).fullCalendar();
}

function swal_success(title, text) {
    //Success Message
    swal({
        title: title,
        type: "success",
        text: text,
        confirmButtonColor: "#09a275",
    });
    return false;
}

function swal(text) {
    swal({
        title: text,
        confirmButtonColor: "#0f4fa8",
    });
    return false;
}

function swal_desc(title, text) {
    swal({
        title: title,
        text: text,
        confirmButtonColor: "#0f4fa8",
    });
    return false;
}

function secureDelete(url, tr_callback) {
    swal({
        title: "Anda yakin ingin menghapus data?",
        text: "Data yang dihapus tidak bisa dikembalikan lagi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f2b701",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        deleteExec(url, tr_callback);
    });
}

function deleteExec(url, tr_callback) {
    $.ajax({
        url: url,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            swal_success('Berhasil', 'data berhasil dihapus');
            if (tr_callback) {
                $(tr_callback).fadeOut();
            }
        },
        error: function (result) {
            swal("Failed something went wrong");
        }
    });
}

function showDetail(url) {
    $.ajax({
        url: url,
        success: function (result) {
            $("#modal-detail").html(result);
        }, error: function (result) {
            swal("Failed something went wrong");
        }
    });
}

function initItemSelect2(el, url) {
    $(el).select2({
        placeholder: 'Cari berdasarkan nama item ...',
        width: '350px',
        allowClear: true,
        ajax: {
            url: url,
            dataType: 'json',
            cache: true,
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }

                return query;
            },
        }
    });
}

function initVendorSelect2(el, url) {
    $(el).select2({
        placeholder: 'Cari berdasarkan nama vendor ...',
        width: '350px',
        allowClear: true,
        ajax: {
            url: url,
            dataType: 'json',
            cache: true,
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }

                return query;
            },
        }
    });
}

function confirmation(url) {
    swal({
        title: "Anda yakin ingin menyetujui data?",
        text: "Data yang sudah disetujui tidak bisa dibatalkan lagi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f2b701",
        confirmButtonText: "Ya, saya setuju!",
        closeOnConfirm: false
    }, function () {
        location.href=url;
    });
}

function swalConfirm(url,title, text) {
    swal({
        title: title,
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f2b701",
        confirmButtonText: "Ya, saya setuju!",
        closeOnConfirm: false
    }, function () {
        location.href=url;
    });
}

function requestApproval(url) {
    swal({
        title: "Anda yakin ingin mengirim permintaan approval ke atasan?",
        text: "",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#f2b701",
        confirmButtonText: "Ya, kirimkan!",
        closeOnConfirm: false
    }, function () {
        location.href = url;
    });
}

/**
 * Form Reject
 * @param {string} url 
 * @param {string} model
 * @param {integer} id
 * @param {integer} approval_to_field 
 * @param {string} status_approval_field
 * @param {string} notes_approval_field
 */
function reject(url, model, id, approval_to_field, status_approval_field, notes_approval_field, approval_at, url_callback) {
    $.ajax({
        url: url,
        data: {
            model: model,
            id: id,
            approval_to_field: approval_to_field,
            status_approval_field: status_approval_field,
            notes_approval_field: notes_approval_field,
            approval_at: approval_at,
            url_callback: url_callback,
        },
        success: function (result) {
            $("#modal-detail").html(result);
        }, error: function (result) {
            swal("Failed something went wrong");
        }
    });
}

function doAjaxGet(url, callback) {
    $.ajax({
        url: url,
        success: function (result) {
            $(callback).html(result);
        }, error: function (result) {
            swal("Failed something went wrong");
        }
    });
}

moment.locale('tr'); /* datepicker dil ayarlamasi */

$('.single-datepicker').daterangepicker({
    singleDatePicker: true,
    autoApply: true,
    //showDropdowns: true,
});

/* InputMask ayarlari */
$(".money-format-mask").inputmask({
    alias: "currency",
    //prefix: '₺ ',
    autoUnmask: true,
    digits: 2,
    allowMinus: false,
    numericInput: true,
    removeMaskOnSubmit: true,
});

/* Select2 Ayarlari */
$('.select2').select2();

/* Datatable Ayarlari */
$.extend($.fn.dataTable.defaults, {
    language: {
        url: "languages/datatables/tr.json"
    }
});

/* SweetAlert Toast Ayarlari */
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

function sendAjaxJson(params) {
    $.ajax({
        url: params.url,
        dataType: "json",
        type: params.type,
        data: params.data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
        },
        success: function (data, status, xhr) {
            params.success(data, status, xhr)
        },
        error: function (xhr, status, error) {
            params.error(xhr, status, error);
        }
    });
}

function swalQuestionDeleteFire(params) {
    Swal.fire({
        title: 'Silmek istediğinize emin misiniz ?',
        icon: 'question',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sil',
        cancelButtonText: `İptal`,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        params.then(result);
    })
}

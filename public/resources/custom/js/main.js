moment.locale('tr'); /* datepicker dil ayarlamasi */

$('.single-datepicker').daterangepicker({
    singleDatePicker: true,
    autoApply: true,
    //showDropdowns: true,
});

/* InputMask ayarlari */
$(".money-format-mask").inputmask({ alias : "currency",
    prefix: '₺ ',
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

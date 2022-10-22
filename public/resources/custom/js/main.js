moment.locale('tr');
$(".money-format-mask").inputmask({ alias : "currency", prefix: '₺ ' });
$('.select2').select2();

$('.single-datepicker').daterangepicker({
    singleDatePicker: true,
    autoApply: true,
    //showDropdowns: true,
});

$.extend($.fn.dataTable.defaults, {
    language: {
        url: "languages/datatables/tr.json"
    }
});

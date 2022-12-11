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
        url: window.location.origin+"/languages/datatables/tr.json"
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
        beforeSend: function () {
            openSpinner();
        },
        success: function (data, status, xhr) {
            params.success(data, status, xhr)
        },
        error: function (xhr, status, error) {
            params.error(xhr, status, error);
        },
        complete: function () {
            closeSpinner();
        },
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

function openSpinner() {
    $('#spinner').css('display', 'block');
}

function closeSpinner() {
    $('#spinner').css('display', 'none');
}

const DROPZONE_MAX_FILE_SIZE = 1048576000;
Dropzone.autoDiscover = false; //dropzone class ı yada form ile yapılan otomatik keşfetme kapalı yapar.
function singleDropzone(url, acceptedFiles) {
    $(".custom-dropzone").dropzone({
        url: '',
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
        },
        method: 'POST',
        maxFiles: null,
        uploadMultiple: false,
        parallelUploads: 1,
        timeout: null,
        maxFilesize: DROPZONE_MAX_FILE_SIZE,
        createImageThumbnails: false,
        acceptedFiles: acceptedFiles,
        autoProcessQueue: true, /*yuklemeyi otomatik baslatir*/
        previewTemplate: $('#custom-html-dropzone-template1').html(),
        //previewsContainer: $('#custom-html-dropzone-template1').html(),
        clickable: ".custom-dropzone-button",
        /*init: function() { //listen event
            this.on("error", (file, message) => {
            });
        },*/
        uploadprogress: (file, progress, bytesSent) => { //Upload Progress Event i override edilerek innerHtml eklendi.
            if (file.previewElement) {
                for (let node of file.previewElement.querySelectorAll(
                    "[data-dz-uploadprogress]"
                )) {
                    node.nodeName === "PROGRESS"
                        ? (node.value = progress)
                        : (node.style.width = `${progress}%`);
                    node.innerHTML = `${progress}%`;
                }
            }
        },
        error: (file, message) => { //Error Event i override edilerek customize edildi.
            if (file.previewElement) {
                file.previewElement.classList.add("dz-error");

                if (typeof message !== "string" && message.data.errorMessages) {
                    for (const errorMessage of message.data.errorMessages) {
                        message += errorMessage + '<br/>';
                    }
                }

                if (typeof message !== "string" && message.error) {
                    message = message.error;
                }

                for (let node of file.previewElement.querySelectorAll(
                    "[data-dz-errormessage]"
                )) {
                    node.innerHTML = message;
                }
            }
        }
    });
}

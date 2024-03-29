@extends('layouts.admin')

@section('title', $bank->name.' Çekler')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item active">{{ $bank->name }} Çekler</li>
@endsection

@section('content')
    <a href="{{ route('bank_checks.create', ['bankId' => $bank->id]) }}" class="button-floating"><i
            class="fa fa-plus"></i></a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <a style="float:right;" class="btn btn-danger"
                               href="{{ route('bank_checks.trashed', ['bankId' => $bank->id]) }}"
                               role="button"><i class="fa-solid fa-trash"></i> Çöp Kutusu</a>
                            <a style="float:right;margin-right: 10px;" class="btn btn-success" data-toggle="modal"
                               data-target="#dropzoneUpload"
                               role="button"><i class="fa-regular fa-file-excel"></i> Çekleri İçe Aktar</a>
                        </div>
                    </div>
                    <table id="main-table" class="table table-bordered table-hover" style="width: 100%!important;">
                        <thead>
                        <tr>
                            <th>Sıra</th>
                            <th>Çek Adı</th>
                            <th>Para Birimi</th>
                            <th>Tutar</th>
                            <th>Vade</th>
                            <th>Açıklama</th>
                            <th>O.Tarihi</th>
                            <th style="text-align: center;">Düzenle</th>
                            <th style="text-align: center;">Sil</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dropzoneUpload" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Çek İçeri Aktar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-file-upload/>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#main-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('bank_checks.datatables', ['bankId' => $bank->id]) }}',
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'name'},
                    {data: 'currency_type_name'},
                    {data: 'total'},
                    {data: 'expires_at'},
                    {data: 'description'},
                    {data: 'created_at', className: "text-center", width: "5%"},
                    {
                        data: 'edit',
                        orderable: false,
                        searchable: false,
                        width: "5%",
                        align: "center",
                        className: "text-center"
                    },
                    {
                        data: 'trashed',
                        orderable: false,
                        searchable: false,
                        width: "5%",
                        align: "center",
                        className: "text-center"
                    },
                ],
                lengthMenu: [
                    [100, 300, 500, -1],
                    [100, 300, 500, 'Hepsi'],
                ]
            });

            customDropzone('{{ route('bank_checks.upload_bank_checks', ['bankId' => $bank->id]) }}', {
                acceptedFiles: 'application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv'
            });
        });

        function trashed(el) {
            let url = $(el).data('url');
            let row = $(el).closest('tr')

            swalQuestionDeleteFire({
                then: function (result) {
                    if (result.isConfirmed) {
                        sendAjaxJson({
                            url: url,
                            type: 'DELETE',
                            data: null,
                            success: function (data) {
                                row.remove();
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Başarılı',
                                    html: data.message,
                                });
                            },
                            error: function (xhr) {
                                let data = xhr.responseJSON;
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Hata',
                                    html: data.message
                                });
                            }
                        });
                    }
                }
            });
        }
    </script>
@endsection

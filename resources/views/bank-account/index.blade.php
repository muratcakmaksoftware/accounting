@extends('layouts.admin')

@section('title', $bank->name.' Hesaplar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item active">{{ $bank->name }} Hesaplar</li>
@endsection

@section('content')
    <a href="{{ route('bank_accounts.create', ['bankId' => $bank->id]) }}" class="button-floating"><i
            class="fa fa-plus"></i></a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <a style="float:right;" class="btn btn-danger"
                               href="{{ route('bank_accounts.trashed', ['bankId' => $bank->id]) }}"
                               role="button"><i class="fa-solid fa-trash"></i> Çöp Kutusu</a>
                        </div>
                    </div>
                    <table id="main-table" class="table table-bordered table-hover" style="width: 100%!important;">
                        <thead>
                        <tr>
                            <th>Sıra</th>
                            <th>Hesap Adı</th>
                            <th>IBAN</th>
                            <th>Para Birimi</th>
                            <th>Bakiye</th>
                            <th>O.Tarihi</th>
                            <th>Ekstre</th>
                            <th style="text-align: center;">Düzenle</th>
                            <th style="text-align: center;">Sil</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#main-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('bank_accounts.datatables', ['bankId' => $bank->id]) }}',
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'name'},
                    {data: 'iban'},
                    {data: 'currency_type_name'},
                    {data: 'balance'},
                    {data: 'created_at', className: "text-center", width: "5%"},
                    {
                        data: 'extract',
                        orderable: false,
                        searchable: false,
                        width: "5%",
                        align: "center",
                        className: "text-center"
                    },
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

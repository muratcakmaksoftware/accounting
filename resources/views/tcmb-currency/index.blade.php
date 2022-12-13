@extends('layouts.admin')

@section('title', 'TCBM Kurlar')

@section('breadcrumb')
    <li class="breadcrumb-item active">TCBM Kurlar</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="main-table" class="table table-bordered table-hover" style="width: 100%!important;">
                        <thead>
                        <tr>
                            <th>Sıra</th>
                            <th>Adı</th>
                            <th>Kodu</th>
                            <th>Birim</th>
                            <th>Döviz Alış</th>
                            <th>Döviz Satış</th>
                            <th>Efektif Alış</th>
                            <th>Efektif Satış</th>
                            <th>O.Tarihi</th>
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
                ajax: '{{ route('tcmb_currenies.datatables') }}',
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'name'},
                    {data: 'code'},
                    {data: 'unit'},
                    {data: 'forex_buy'},
                    {data: 'forex_sell'},
                    {data: 'banknote_buy'},
                    {data: 'banknote_sell'},
                    {data: 'created_at', className: "text-center", width: "5%"},
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
                ],
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

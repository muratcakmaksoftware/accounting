@extends('layouts.admin')

@section('title', 'Para Birimleri Çöp Kutusu')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('currency_types.index') }}">Para Birimleri</a></li>
    <li class="breadcrumb-item active">Para Birimleri Çöp Kutusu</li>
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
                            <th>İsim</th>
                            <th>Kodu</th>
                            <th>Sembol</th>
                            <th>O.Tarihi</th>
                            <th>D.Tarihi</th>
                            <th style="text-align: center;">Geri Al</th>
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
                ajax: '{{ route('currency_types.trashed_datatables') }}',
                columns: [
                    {data: 'DT_RowIndex', width: "5%",},
                    {data: 'name'},
                    {data: 'code'},
                    {data: 'sembol'},
                    {data: 'created_at', className: "text-center", width: "5%"},
                    {data: 'deleted_at', className: "text-center", width: "5%"},
                    {
                        data: 'restore',
                        orderable: false,
                        searchable: false,
                        width: "5%",
                        align: "center",
                        className: "text-center"
                    },
                    {
                        data: 'force_delete',
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

        function restore(el) {
            let url = $(el).data('url');
            let row = $(el).closest('tr')

            sendAjaxJson({
                url: url,
                type: 'POST',
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

        function forceDelete(el) {
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

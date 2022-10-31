@extends('layouts.admin')

@section('title', 'Ödemelerim')

@section('breadcrumb')
    <li class="breadcrumb-item active">Ödemelerim</li>
@endsection

@section('content')
    <a href="{{ route('payables.create') }}" class="button-floating"><i class="fa fa-plus"></i></a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="payable-table" class="table table-bordered table-hover" style="width: 100%!important;">
                        <thead>
                        <th>Sıra</th>
                        <th>Şirket Adı</th>
                        <th>Para Birimi</th>
                        <th>Ödeme Yönetimi</th>
                        <th>Fiyat</th>
                        <th>Vade</th>
                        <th>Açıklama</th>
                        <th>O.Tarihi</th>
                        <th style="text-align: center;">Düzenle</th>
                        <th style="text-align: center;">Sil</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#payable-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('payables.datatables') }}',
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'company_name'},
                    {data: 'currency_type'},
                    {data: 'payment_method_type'},
                    {data: 'price'},
                    {data: 'expires_at', className: "text-center", width: "5%"},
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
                        data: 'delete',
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

        function deletePayable(el) {
            let url = $(el).data('url');
            let rowId = '#' + $(el).closest("tr").attr('id')

            swalQuestionDeleteFire({
                then: function (result) {
                    if (result.isConfirmed) {
                        sendAjaxJson({
                            url: url,
                            type: 'DELETE',
                            data: null,
                            success: function (data) {
                                $(rowId).remove();
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

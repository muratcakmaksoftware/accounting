@extends('layouts.admin')

@section('title', 'Ödemelerim')

@section('content')
    <div class="row">
        <table id="payable-table" class="table table-bordered table-hover">
            <thead>
                <th>Sıra</th>
                <th>Şirket Adı</th>
                <th>Para Birimi</th>
                <th>Ödeme Yönetimi</th>
                <th>Fiyat</th>
                <th>Vade</th>
                <th>Açıklama</th>
                <th>O.Tarihi</th>
                <th width="10%">Düzenle</th>
                <th>Sil</th>
            </thead>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#payable-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('payables.datatables') }}',
                columns: [
                    {data: 'DT_RowIndex', orderable: true, searchable: false },
                    {data: 'company_name'},
                    {data: 'currency_type'},
                    {data: 'payment_method_type'},
                    {data: 'price'},
                    {data: 'expires_at'},
                    {data: 'description'},
                    {data: 'created_at'},
                    {data: 'edit', orderable: false, searchable: false, width: "5%"},
                    {data: 'delete', orderable: false, searchable: false, width: "5%"},
                ],
                lengthMenu: [
                    [100, 300, 500, -1],
                    [100, 300, 500, 'Hepsi'],
                ],
            });
        });
    </script>
@endsection

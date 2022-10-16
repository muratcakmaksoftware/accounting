@extends('layouts.admin')

@section('title', 'Ödemelerim')

@section('content')
    <a href="{{ route('payables.create') }}" class="button-floating"><i class="fa fa-plus"></i></a>
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
                <th style="text-align: center;">Düzenle</th>
                <th style="text-align: center;">Sil</th>
            </thead>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#payable-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('payables.datatables') }}',
                columns: [
                    {data: 'DT_RowIndex', orderable: true, searchable: false },
                    {data: 'company_name'},
                    {data: 'currency_type'},
                    {data: 'payment_method_type'},
                    {data: 'price'},
                    {data: 'expires_at', className: "text-center", width: "5%"},
                    {data: 'description'},
                    {data: 'created_at', className: "text-center", width: "5%"},
                    {data: 'edit', orderable: false, searchable: false, width: "5%", align: "center", className: "text-center"},
                    {data: 'delete', orderable: false, searchable: false, width: "5%", align: "center", className: "text-center"},
                ],
                lengthMenu: [
                    [100, 300, 500, -1],
                    [100, 300, 500, 'Hepsi'],
                ],
            });
        });
    </script>
@endsection

@section('javascript-footer')
    @vite(['resources/js/datatables.js'])
@endsection
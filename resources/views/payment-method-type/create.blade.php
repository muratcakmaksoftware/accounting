@extends('layouts.admin')

@section('title', 'Ödeme Metodu Ekle')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('payment_method_types.index') }}">Ödeme Metotları</a></li>
    <li class="breadcrumb-item active">Ödeme Metodu Ekle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('payment_method_types.store') }}" method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>İsmi</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('title', 'Ödeme Metodu Düzenle '.'#'.$paymentMethodType->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('payment_method_types.index') }}">Ödeme Metotları</a></li>
    <li class="breadcrumb-item active">Ödeme Metodu Düzenle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('payment_method_types.update', ['id' => $paymentMethodType->id]) }}"
                      method="POST">
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>İsmi</label>
                            <input type="text" class="form-control" name="name" value="{{ $paymentMethodType->name }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('title', $bankAccount->name.' Hesabına Ödeme Ekle')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bank_accounts.index', ['bankId' => $bank->id]) }}">{{$bank->name}}
            Hesaplar</a></li>
    <li class="breadcrumb-item"><a
            href="{{ route('bank_account_history.index', ['bankId' => $bank->id, 'bankAccountId' => $bankAccount->id]) }}">{{$bankAccount->name}}
            Hesap Ekstresi</a></li>
    <li class="breadcrumb-item active">{{$bankAccount->name}} Hesabına Ödeme Ekle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form
                    action="{{ route('bank_account_history.store', ['bankId' => $bank->id, 'bankAccountId' => $bankAccount->id]) }}"
                    method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>İşlem</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label>Toplam</label>
                            <input type="text" class="form-control money-format-mask" name="total"
                                   value="{{ old('total') }}">
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea class="form-control" name="description" rows="4" placeholder=""
                                      maxlength="2500">{{ old('description') }}</textarea>
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

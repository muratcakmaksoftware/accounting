@extends('layouts.admin')

@section('title', $bankAccountHistory->title.' Ödeme Düzenle '.'#'.$bankAccountHistory->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bank_accounts.index', ['bankId' => $bank->id]) }}">{{$bank->name}}
            Hesaplar</a></li>
    <li class="breadcrumb-item"><a
            href="{{ route('bank_account_history.index', ['bankId' => $bank->id, 'bankAccountId' => $bankAccount->id]) }}">{{$bankAccount->name}}
            Hesap Ekstresi</a></li>
    <li class="breadcrumb-item active">{{ $bankAccountHistory->title }} Ödeme Düzenle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form
                    action="{{ route('bank_account_history.update', ['bankId' => $bank->id, 'bankAccountId' => $bankAccount->id, 'id' => $bankAccountHistory->id]) }}"
                    method="POST">
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>İşlem</label>
                            <input type="text" class="form-control" name="title"
                                   value="{{ $bankAccountHistory->title }}">
                        </div>

                        <div class="form-group">
                            <label>Toplam</label>
                            <input type="text" class="form-control money-format-mask" name="total"
                                   value="{{ $bankAccountHistory->total }}">
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea class="form-control" name="description" rows="4" placeholder=""
                                      maxlength="2500">{{ $bankAccountHistory->description }}</textarea>
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

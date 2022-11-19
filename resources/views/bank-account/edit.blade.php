@extends('layouts.admin')

@section('title', $bank->name.' Hesap Düzenle '.'#'.$bankAccount->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bank_accounts.index', ['bankId' => $bank->id]) }}">{{$bank->name}}
            Hesaplar</a></li>
    <li class="breadcrumb-item active">{{$bank->name}} Hesap Düzenle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('bank_accounts.update', ['bankId' => $bank->id, 'id' => $bankAccount->id]) }}"
                      method="POST">
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Hesap Adı</label>
                            <input type="text" class="form-control" name="name" value="{{ $bankAccount->name }}">
                        </div>

                        <div class="form-group">
                            <label>IBAN</label>
                            <input type="text" class="form-control" name="iban" value="{{ $bankAccount->name }}"
                                   maxlength="34">
                        </div>

                        <div class="form-group">
                            <label>Para Birimi</label>
                            <select class="form-control select2" name="currency_type_id">
                                @foreach($currencyTypes as $currencyType)
                                    <option value="{{ $currencyType->id }}"
                                            @if(old('currency_type_id') == $currencyType->id) selected @endif>{{ $currencyType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Bakiye</label>
                            <input type="text" class="form-control money-format-mask" name="balance"
                                   value="{{ $bankAccount->balance }}">
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea class="form-control" name="description" rows="4" placeholder=""
                                      maxlength="2500">{{ $bankAccount->description }}</textarea>
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

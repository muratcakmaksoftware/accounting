@extends('layouts.admin')

@section('title', $bank->name.' Hesap Ekle')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bank_accounts.index', ['bankId' => $bank->id]) }}">{{$bank->name}}
            Hesaplar</a></li>
    <li class="breadcrumb-item active">{{$bank->name}} Hesap Ekle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('bank_accounts.store', ['bankId' => $bank->id]) }}" method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Hesap Adı</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>IBAN</label>
                            <input type="text" class="form-control" name="iban" value="{{ old('iban') }}"
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
                            <label>Fiyat</label>
                            <input type="text" class="form-control money-format-mask" name="balance"
                                   value="{{ old('balance') }}">
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

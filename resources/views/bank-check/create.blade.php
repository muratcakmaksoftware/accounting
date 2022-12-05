@extends('layouts.admin')

@section('title', $bank->name.' Çek Ekle')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bank_checks.index', ['bankId' => $bank->id]) }}">{{$bank->name}}
            Çekler</a></li>
    <li class="breadcrumb-item active">{{$bank->name}} Çek Ekle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('bank_checks.store', ['bankId' => $bank->id]) }}" method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Çek Adı</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
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
                            <label>Tutar</label>
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

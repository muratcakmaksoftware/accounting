@extends('layouts.admin')

@section('title', $bank->name.' Çek Düzenle '.'#'.$bankCheck->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bank_checks.index', ['bankId' => $bank->id]) }}">{{$bank->name}}
            Çekler</a></li>
    <li class="breadcrumb-item active">{{$bank->name}} Çek Düzenle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('bank_checks.update', ['bankId' => $bank->id, 'id' => $bankCheck->id]) }}"
                      method="POST">
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Çek Adı</label>
                            <input type="text" class="form-control" name="name" value="{{ $bankCheck->name }}">
                        </div>

                        <div class="form-group">
                            <label>Para Birimi</label>
                            <select class="form-control select2" name="currency_type_id">
                                @foreach($currencyTypes as $currencyType)
                                    <option value="{{ $currencyType->id }}"
                                            @if($bankCheck->currency_type_id == $currencyType->id) selected @endif>{{ $currencyType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tutar</label>
                            <input type="text" class="form-control money-format-mask" name="total"
                                   value="{{ $bankCheck->total }}">
                        </div>

                        <div class="form-group">
                            <label>Vade Tarihi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" name="expires_at" class="form-control single-datepicker"
                                       value="{{ $bankCheck->expires_at_format }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea class="form-control" name="description" rows="4" placeholder=""
                                      maxlength="2500">{{ $bankCheck->description }}</textarea>
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

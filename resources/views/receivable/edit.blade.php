@extends('layouts.admin')

@section('title', 'Alacak Düzenle '.'#'.$receivable->id)

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('receivables.update', ['id' => $receivable->id]) }}" method="POST">
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Şirket</label>
                            <select class="form-control select2" name="company_id">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @if($receivable->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ödeme Yöntemi</label>
                            <select class="form-control select2" name="payment_method_type_id">
                                @foreach($paymentMethodTypes as $paymentMethodType)
                                    <option value="{{ $paymentMethodType->id }}" @if($receivable->payment_method_type_id == $paymentMethodType->id) selected @endif>{{ $paymentMethodType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Para Birimi</label>
                            <select class="form-control select2" name="currency_type_id">
                                @foreach($currencyTypes as $currencyType)
                                    <option value="{{ $currencyType->id }}" @if($receivable->currency_type_id == $currencyType->id) selected @endif>{{ $currencyType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fiyat</label>
                            <input type="text" class="form-control money-format-mask" name="price" value="{{ $receivable->price }}">
                        </div>

                        <div class="form-group">
                            <label>Vade Tarihi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" name="expires_at" class="form-control single-datepicker" value="{{ $receivable->expires_at_format }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="" maxlength="2500">{{ $receivable->description }}</textarea>
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

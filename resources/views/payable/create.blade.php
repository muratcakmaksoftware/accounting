@extends('layouts.admin')

@section('title', 'Ödeme Ekle')

@section('content')
    <form action="{{ route('payables.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Şirket</label>
                <select class="form-control select2" name="company_id">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" @if(old('company_id') == $company->id) selected @endif>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Para Birimi</label>
                <select class="form-control select2" name="currency_type_id">
                    @foreach($currencyTypes as $currencyType)
                        <option value="{{ $currencyType->id }}" @if(old('currency_type_id') == $currencyType->id) selected @endif>{{ $currencyType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Ödeme Yöntemi</label>
                <select class="form-control select2" name="payment_method_type_id">
                    @foreach($paymentMethodTypes as $paymentMethodType)
                        <option value="{{ $paymentMethodType->id }}" @if(old('payment_method_type_id') == $paymentMethodType->id) selected @endif>{{ $paymentMethodType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Fiyat</label>
                <input type="text" class="form-control money-format-mask" placeholder="Fiyat" name="price" value="{{ old('price') }}">
            </div>

            <div class="form-group">
                <label>Vade Tarihi</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="expires_at" class="form-control single-datepicker" value="{{ old('expires_at') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Açıklama</label>
                <textarea class="form-control" name="description" rows="4" placeholder="" maxlength="2500">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right">Kaydet</button>
        </div>
    </form>

    <script>

        $(document).ready(function() {
            /*$('.select2').select2({
                ajax: {
                    url: '{{ route('companies.select2Ajax') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            name: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.data
                        };
                    },
                    placeholder: 'Lütfen bir şeyler yazın',
                    minimumInputLength: 1,
                    delay: 250
                }
            });*/
        });
    </script>
@endsection

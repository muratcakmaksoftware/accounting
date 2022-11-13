@extends('layouts.admin')

@section('title', 'Para Birimi Ekle')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('currency_types.index') }}">Para Birimleri</a></li>
    <li class="breadcrumb-item active">Para Birimi Ekle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('currency_types.store') }}" method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>İsmi</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>Kodu</label>
                            <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                        </div>

                        <div class="form-group">
                            <label>Sembol</label>
                            <input type="text" class="form-control" name="sembol" value="{{ old('sembol') }}"
                                   minlength="1" maxlength="1">
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

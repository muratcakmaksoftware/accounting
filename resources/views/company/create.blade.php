@extends('layouts.admin')

@section('title', 'Firma Ekle')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Firmalar</a></li>
    <li class="breadcrumb-item active">Firma Ekle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('companies.store') }}" method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Şirket Adı</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
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
            </div>
        </div>
    </div>

@endsection

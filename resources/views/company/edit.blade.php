@extends('layouts.admin')

@section('title', 'Şirket Düzenle '.'#'.$company->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Şirketler</a></li>
    <li class="breadcrumb-item active">Şirket Düzenle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('companies.update', ['id' => $company->id]) }}" method="POST">
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Şirket Adı</label>
                            <input type="text" class="form-control" name="name" value="{{ $company->name }}">
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="" maxlength="2500">{{ $company->description }}</textarea>
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

@extends('layouts.admin')

@section('title', 'Banka Düzenle '.'#'.$bank->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bankalar</a></li>
    <li class="breadcrumb-item active">Banka Düzenle</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('banks.update', ['id' => $bank->id]) }}" method="POST">
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Banka Adı</label>
                            <input type="text" class="form-control" name="name" value="{{ $bank->name }}">
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea class="form-control" name="description" rows="4" placeholder=""
                                      maxlength="2500">{{ $bank->description }}</textarea>
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

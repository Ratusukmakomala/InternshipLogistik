@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('transaction.deliveries.tracking') }}">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-search"></i>
                        </span>
                        <input name="search" type="text" class="form-control @error('search') is-invalid @enderror" placeholder="Masukan Invoice">

                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                    </div>
                    @error('search')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

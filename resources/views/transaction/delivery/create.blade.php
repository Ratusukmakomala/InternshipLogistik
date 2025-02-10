@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Delivery Transaction</div>
    </div>
    <div class="card-body">
        <form action="{{ route('transaction.deliveries.store') }}" method="POST">
            @csrf
            @include('transaction.delivery._form')
        </form>
    </div>
</div>
@endsection

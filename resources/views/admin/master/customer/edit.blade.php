@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit customer</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.master.customer._form')
        </form>
    </div>
</div>
@endsection

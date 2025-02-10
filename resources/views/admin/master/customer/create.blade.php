@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Customer</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.customers.store') }}" method="POST">
            @csrf
            @include('admin.master.customer._form')
        </form>
    </div>
</div>
@endsection

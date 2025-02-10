@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Employee</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.employees.store') }}" method="POST">
            @csrf
            @include('admin.master.employee._form')
        </form>
    </div>
</div>
@endsection

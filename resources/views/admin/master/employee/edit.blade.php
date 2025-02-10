@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Employee</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.master.employee._form')
        </form>
    </div>
</div>
@endsection

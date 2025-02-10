@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create User</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            @include('admin.user._form')
        </form>
    </div>
</div>
@endsection

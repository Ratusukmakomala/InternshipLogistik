@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Office</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.offices.store') }}" method="POST">
            @csrf
            @include('admin.master.office._form')
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Sla</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.slas.store') }}" method="POST">
            @csrf
            @include('admin.master.sla._form')
        </form>
    </div>
</div>
@endsection

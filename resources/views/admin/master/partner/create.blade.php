@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Partner</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.partners.store') }}" method="POST">
            @csrf
            @include('admin.master.partner._form')
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Office</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.offices.update', $office->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.master.office._form')
        </form>
    </div>
</div>
@endsection

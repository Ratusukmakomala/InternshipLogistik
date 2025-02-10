@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Sla</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.slas.update', $sla->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.master.sla._form')
        </form>
    </div>
</div>
@endsection

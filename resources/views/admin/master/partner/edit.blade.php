@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Partner</div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.master.partners.update', $partner->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.master.partner._form')
        </form>
    </div>
</div>
@endsection

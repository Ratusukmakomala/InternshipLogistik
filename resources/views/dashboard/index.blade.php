@extends('layouts.admin')

@section('content')
<section class="section">
    @role('admin')
        @include('dashboard._admin')
    @endrole
    @role('mitra')
        @include('dashboard._mitra')
    @endrole
</section>
@endsection

@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('transaction.deliveries.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        @foreach ($delivery->histories as $key => $dh)
            <x-timeline.item
                :date="\Carbon\Carbon::parse($dh->change_status_date)->format('d-m-Y H:i:s')"
                :title="ucfirst($dh->status)"
                :content="($dh->status == 'success') ? 'Paket telah diterima' : 'Masih Dalam Perjalanan'"
                :details="null"
                :index="$key"
                />
        @endforeach
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Transaction History Report</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Change Date</th>
                            <th>Sender Office</th>
                            <th>Receive Office</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $history)
                            <tr>
                                <td>{{ $history->change_status_date }}</td>
                                <td>{{ $history->senderOffice->name }}</td>
                                <td>{{ $history->receiverOffice->name }}</td>
                                <td>{{ $history->status }}</td>
                            </tr>
                        @empty
                            <x-table.empty-data colspan="4" />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $histories->links() }}
        </div>
    </div>
@endsection

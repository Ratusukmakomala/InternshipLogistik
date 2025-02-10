@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="row">
                <div class="col-md-6">Customer Management</div>
                <div class="col-md-6">
                    <a href="{{ route('admin.master.customers.create') }}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Zip Code</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->code }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->zip_code }}</td>
                        <td>{{ $customer->type }}</td>
                        <td class="d-flex gap-3">
                            <a href="{{ route('admin.master.customers.edit', $customer->id) }}" class="btn btn-warning text-white">Edit</a>
                            <a href="{{ route('admin.master.customers.destroy', $customer->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <x-table.empty-data colspan="5" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $customers->links() }}
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="row">
                <div class="col-md-6">Office Management</div>
                <div class="col-md-6">
                    <a href="{{ route('admin.master.offices.create') }}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Parent</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Region</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>Zip Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offices as $office)
                    <tr>
                        <td>{{ $office->parent->code ?? '' }}</td>
                        <td>{{ $office->code }}</td>
                        <td>{{ $office->name }}</td>
                        <td>{{ $office->region }}</td>
                        <td>{{ $office->type }}</td>
                        <td>{{ $office->address }}</td>
                        <td>{{ $office->zip_code }}</td>
                        <td class="d-flex gap-3">
                            <a href="{{ route('admin.master.offices.edit', $office->id) }}" class="btn btn-warning text-white">Edit</a>
                            <a href="{{ route('admin.master.offices.destroy', $office->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <x-table.empty-data colspan="8" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $offices->links() }}
    </div>
</div>
@endsection

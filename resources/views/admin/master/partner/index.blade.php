@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="row">
                <div class="col-md-6">partner Management</div>
                <div class="col-md-6">
                    <a href="{{ route('admin.master.partners.create') }}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $partner)
                    <tr>
                        <td>{{ $partner->type }}</td>
                        <td>{{ $partner->code }}</td>
                        <td>{{ $partner->name }}</td>
                        <td class="d-flex gap-3">
                            <a href="{{ route('admin.master.partners.edit', $partner->id) }}" class="btn btn-warning text-white">Edit</a>
                            <a href="{{ route('admin.master.partners.destroy', $partner->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <x-table.empty-data colspan="4" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $partners->links() }}
    </div>
</div>
@endsection

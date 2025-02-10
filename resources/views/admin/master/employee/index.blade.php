@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="row">
                <div class="col-md-6">Employee Management</div>
                <div class="col-md-6">
                    <a href="{{ route('admin.master.employees.create') }}" class="btn btn-primary float-end">Create</a>
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
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->code }}</td>
                        <td>{{ $employee->user->name }}</td>
                        <td>{{ $employee->user->email }}</td>
                        <td>{{ $employee->user->role->name }}</td>
                        <td class="d-flex gap-3">
                            <a href="{{ route('admin.master.employees.edit', $employee->id) }}" class="btn btn-warning text-white">Edit</a>
                            <a href="{{ route('admin.master.employees.destroy', $employee->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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
        {{ $employees->links() }}
    </div>
</div>
@endsection

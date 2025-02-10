@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="row">
                <div class="col-md-6">User Management</div>
                <div class="col-md-6">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td class="d-flex gap-3">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning text-white">Edit</a>
                            <a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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
        {{ $users->links() }}
    </div>
</div>
@endsection

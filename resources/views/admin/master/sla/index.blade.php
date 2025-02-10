@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="row">
                <div class="col-md-6">Sla Management</div>
                <div class="col-md-6">
                    <a href="{{ route('admin.master.slas.create') }}" class="btn btn-primary float-end">Create</a>
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
                        <th>Desc</th>
                        <th>Target</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slas as $sla)
                    <tr>
                        <td>{{ $sla->name }}</td>
                        <td>{{ $sla->description }}</td>
                        <td>{{ $sla->target }}</td>
                        <td class="d-flex gap-3">
                            <a href="{{ route('admin.master.slas.edit', $sla->id) }}" class="btn btn-warning text-white">Edit</a>
                            <a href="{{ route('admin.master.slas.destroy', $sla->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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
        {{ $slas->links() }}
    </div>
</div>
@endsection

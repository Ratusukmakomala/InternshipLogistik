@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">K-Mean Algorithm</div>
    </div>
    <div class="card-body">
        <form action="{{ route('kmean.result') }}">
            <div class="row">
                <div class="col-md-12">
                    <x-form.input
                        name="clustering_number"
                        type="number"
                        label="K Number"
                        placeholder="Enter Clustering Number"
                        icon="bi bi-braces"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-form.input
                        name="max_iterations"
                        type="number"
                        label="Max Iteration"
                        placeholder="Enter Max Iteration"
                        icon="bi bi-braces"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary float-end">Calculate</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Search Report</div>
    </div>
    <div class="card-body">
        <form action="{{ route('transaction.report.search.result') }}">
            <div class="row">
                <div class="col-md-6">
                    <x-form.input
                        name="transaction_from"
                        type="date"
                        label="Transaction From"
                        placeholder="Enter Date"
                        icon="bi bi-braces"
                    />
                </div>
                <div class="col-md-6">
                    <x-form.input
                        name="transaction_to"
                        type="date"
                        label="Transaction To"
                        placeholder="Enter Date"
                        icon="bi bi-braces"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-form.select
                        name="transaction_type"
                        label="Select Type"
                        :options="$transactionTypes"
                    />
                </div>
                <div class="col-md-6">
                    <x-form.select
                        name="delivery_type"
                        label="Select Type"
                        :options="$deliveryTypes"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-form.select
                        name="transaction_status"
                        label="Select Status"
                        :options="$transactionStatuses"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-form.input
                        name="sender_name"
                        type="text"
                        label="Sender Name"
                        placeholder="Enter Sender Name"
                        icon="bi bi-braces"
                    />
                </div>
                <div class="col-md-6">
                    <x-form.input
                        name="receiver_name"
                        type="text"
                        label="Receiver Name"
                        placeholder="Enter Receiver Name"
                        icon="bi bi-braces"
                    />
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn btn-primary float-end">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


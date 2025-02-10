<div class="row">
    <div class="col-md-3">
        <div class="card border border-info">
            <div class="card-header text-center border border-info">Total Transaction</div>
            <div class="card-body">
                <h5 class="card-title text-center mt-3">{{ $totalTransactionAllTime }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border border-danger">
            <div class="card-header text-center border border-danger">Total Transaction Yesteday</div>
            <div class="card-body">
                <h5 class="card-title text-center mt-3">{{ $totalTransactionYesterday }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border border-warning">
            <div class="card-header text-center border border-warning">Total Transaction Last Month</div>
            <div class="card-body">
                <h5 class="card-title text-center mt-3">{{ $totalTransactionLastMonth }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border border-success">
            <div class="card-header text-center border border-success">Total Transaction Last Year</div>
            <div class="card-body">
                <h5 class="card-title text-center mt-3">{{ $totalTransactionLastYear }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Transaction By Shipping Form</div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Shipping Form</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shippingFormTransactions as $key => $value)
                        <tr>
                            <td>{{ $value->shipping_form }}</td>
                            <td>{{ $value->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Transaction By Kind of Delivery</div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kind Delivery</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kindDeliveryTransactions as $key => $value)
                        <tr>
                            <td>{{ $value->kind_delivery }}</td>
                            <td>{{ $value->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Transaction By Delivery Type</div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Delivery Type</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveryTypeTransactions as $key => $value)
                        <tr>
                            <td>{{ $value->delivery_type }}</td>
                            <td>{{ $value->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

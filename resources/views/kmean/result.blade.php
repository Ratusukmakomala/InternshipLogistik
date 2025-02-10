@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Cluster Result</div>
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach ($clusters as $key => $cluster)
                    <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseExample-{{ $key }}">
                        Cluster {{ $key + 1 }} <span class="badge text-bg-primary rounded-pill">{{ count($cluster) }}</span>
                    </button>
                    <div class="collapse" id="collapseExample-{{ $key }}">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cod / Non Code</th>
                                        <th>Sla Status</th>
                                        <th>Shipping Form</th>
                                        <th>Weight</th>
                                        <th>Volume</th>
                                        <th>Base Price</th>
                                        <th>Sla Id</th>
                                        <th>Kind Of Delivery</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cluster as $point)
                                        <tr>
                                            <td>{{ $point[0] }}</td>
                                            <td>{{ $point[1] }}</td>
                                            <td>{{ $point[2] }}</td>
                                            <td>{{ $point[3] }}</td>
                                            <td>{{ $point[4] }}</td>
                                            <td>{{ $point[5] }}</td>
                                            <td>{{ $point[6] }}</td>
                                            <td>{{ $point[7] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Result of K-mean Algoritm Chart</div>
        </div>
        <div class="card-body">
            <div style="width: 80%; margin: auto;">
                <canvas id="kmeansChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('js-vendor')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('js')
<script>
    const clusters = @json($clusters);
    const centroids = @json($centroids);

    // Generate random colors for each cluster
    const colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

    // Prepare datasets for each cluster
    const clusterDatasets = Object.keys(clusters).map((clusterIndex, i) => {
        const points = clusters[clusterIndex].map(point => ({ x: point[0], y: point[1] }));
        return {
            label: `Cluster ${parseInt(clusterIndex) + 1}`,
            data: points,
            backgroundColor: colors[i],
            borderColor: colors[i],
            borderWidth: 1,
            pointRadius: 5,
        };
    });

    // Prepare dataset for centroids
    const centroidDataset = {
        label: 'Centroids',
        data: centroids.map(centroid => ({ x: centroid[0], y: centroid[1] })),
        backgroundColor: '#6a329f',
        borderColor: '#6a329f',
        borderWidth: 1,
        pointRadius: 8,
        pointStyle: 'rect',
    };

    // Configure the Chart.js chart
    new Chart(document.getElementById('kmeansChart'), {
        type: 'scatter',
        data: {
            datasets: [...clusterDatasets, centroidDataset],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tipe kiriman',
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'SLA Status',
                    },
                },
            },
        },
    });
</script>
@endpush

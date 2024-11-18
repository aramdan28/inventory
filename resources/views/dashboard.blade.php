@extends('template.master_admin')

@section('content')


<!-- Page Heading -->
<h2 class="  text-gray-900 mb-4 ">Welcome To Inventory Systems!</h2>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<!-- Charts Row -->
<div class="row">
    <!-- Asset Value Overview -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Asset Value Overview</h6>
            </div>
            <div class="card-body">
                <canvas id="assetValueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Depreciation of Assets -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Depreciation of Assets</h6>
            </div>
            <div class="card-body">
                <canvas id="depreciationChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Asset Categories -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Asset Categories</h6>
            </div>
            <div class="card-body">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

<script>
    // Asset Value Overview (Line Chart)
    const assetValueCtx = document.getElementById('assetValueChart').getContext('2d');
    const assetValueChart = new Chart(assetValueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Asset Value',
                data: [50000, 48000, 47000, 46000, 45000, 44000, 43000, 42000, 41000, 40000, 39000, 38000],
                borderColor: 'rgba(78, 115, 223, 1)',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

    // Depreciation of Assets (Bar Chart)
    const depreciationCtx = document.getElementById('depreciationChart').getContext('2d');
    const depreciationChart = new Chart(depreciationCtx, {
        type: 'bar',
        data: {
            labels: ['Equipment', 'Vehicles', 'Buildings', 'Furniture', 'Software'],
            datasets: [{
                label: 'Depreciation (USD)',
                data: [15000, 12000, 10000, 7000, 3000],
                backgroundColor: [
                    'rgba(78, 115, 223, 0.8)',
                    'rgba(28, 200, 138, 0.8)',
                    'rgba(54, 185, 204, 0.8)',
                    'rgba(246, 194, 62, 0.8)',
                    'rgba(231, 74, 59, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });

    // Asset Categories (Pie Chart)
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: ['Equipment', 'Vehicles', 'Buildings', 'Furniture', 'Software'],
            datasets: [{
                data: [30, 20, 25, 15, 10],
                backgroundColor: [
                    'rgba(78, 115, 223, 0.8)',
                    'rgba(28, 200, 138, 0.8)',
                    'rgba(54, 185, 204, 0.8)',
                    'rgba(246, 194, 62, 0.8)',
                    'rgba(231, 74, 59, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });
</script>


@endsection
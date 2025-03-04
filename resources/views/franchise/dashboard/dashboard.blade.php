@extends('layouts.franchise')
@section('title', 'Dashboard')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('franchise.includes.flash-message')


      <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="page-title">Avilable Orders</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($orders && count($orders))
                            @foreach ($orders as $order)
                            <div class="col-sm-3 mt-2 d-flex">
                                <a href="{{ route('franchise.orders.show', $order->id) }}" 
                                    class="btn btn-{{ $order->product->sold_color ?? 'success' }} rounded-pill w-100 d-flex align-items-center justify-content-center">
                                    {{ $order->product->name }}
                                    <br/>
                                    Avilable : {{ $order->stock }}
                                </a>
                            </div>
                            @endforeach
                            @else
                            <p>No item avilable to sell...</p>
                            @endif

                     
                        </div>
                    </div>
                </div>

            </div>
        </div>



    <div class="row">
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center btn btn-primary">
                    <h5 class="mt-0">Total Orders</h5>
                    <h2 class="my-2" id="active-users-count">{{ $total_orders }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.orders.index') }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center btn btn-secondary">
                    <h5 class="mt-0">Total Sales</h5>
                    <h2 class="my-2" id="active-users-count">{{ $totalSales }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.sales.index', ['status' => 'PO Generated']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center btn btn-success">
                    <h5 class="mt-0">This Month Sales</h5>
                    <h2 class="my-2" id="active-users-count">{{ $monthlySales }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.sales.index', ['status' => 'PO Generated']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center btn btn-danger">
                    <h5 class="mt-0">Pending</h5>
                    <h2 class="my-2" id="active-users-count">{{ $in_progress }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.orders.index', ['status' => 'In Progress']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center btn btn-warning">
                    <h5 class="mt-0">Completed</h5>
                    <h2 class="my-2" id="active-users-count">{{ $completed }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.orders.index', ['status' => 'Completed']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center btn btn-info">
                    <h5 class="mt-0">Delivered</h5>
                    <h2 class="my-2" id="active-users-count">{{ $delivered }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.orders.index', ['status' => 'Delivered']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sales Performance</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        

                        <canvas id="salesChart"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div> 
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($sales->pluck('name')), // Product names
            datasets: [{
                label: 'Total Sales (in Rs)',
                data: @json($sales->pluck('sales')), // Total sales for each product
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Quantity Sold',
                data: @json($sales->pluck('quantity')), // Quantity sold for each product
                backgroundColor: 'rgba(153, 102, 255, 0.2)', // Different color for quantity
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>

@endpush

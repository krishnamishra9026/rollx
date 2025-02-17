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

    <div class="row">
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">
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
                <div class="card-body text-center">
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
                <div class="card-body text-center">
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
                <div class="card-body text-center">
                    <h5 class="mt-0">In Progress</h5>
                    <h2 class="my-2" id="active-users-count">{{ $in_progress }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.orders.index', ['status' => 'In Progress']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">
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
                <div class="card-body text-center">
                    <h5 class="mt-0">Delivered</h5>
                    <h2 class="my-2" id="active-users-count">{{ $delivered }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('franchise.orders.index', ['status' => 'Delivered']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>



    </div>

</div> <!-- container -->
@endsection

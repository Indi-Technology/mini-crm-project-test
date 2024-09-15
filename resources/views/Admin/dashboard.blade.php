@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Heading Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-center">Ticket Status Overview</h3>
                <p class="text-center text-muted">Summary of the current status of tickets</p>
            </div>
        </div>

        <!-- Total Status Section (At the top) -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card text-white bg-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Tickets</h5>
                        <hr>
                        <h2>{{ $status }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Open and Closed Status Section (Side by side) -->
        <div class="row">
            <!-- Status: Open -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Status: Open</h5>
                        <hr>
                        <h2>{{ $statusOpen }}</h2>
                    </div>
                </div>
            </div>

            <!-- Status: Closed -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card text-white bg-danger">
                    <div class="card-body text-center">
                        <h5 class="card-title">Status: Closed</h5>
                        <hr>
                        <h2>{{ $statusClosed }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

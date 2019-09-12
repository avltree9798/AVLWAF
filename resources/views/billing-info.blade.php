@extends('template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Billing</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">AVL WAF</a></li>
                            <li class="breadcrumb-item">My Profile</li>
                            <li class="breadcrumb-item active">Billing</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card-body">
                    @if($amount !== 0)
                        <h2>Amount : IDR {{ number_format($amount) }}</h2>
                        <h2>Period : {{ $startDate }} to {{ $endDate }}</h2>
                        <button type="buttom" class="btn btn-primary">Pay Now</button>
                    @endif
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop
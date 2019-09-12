@extends('template')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">My Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">AVL WAF</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-8">
                        <div class="col-md-13">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="{{ route('profile.update') }}">
                                    {!! csrf_field() !!}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password (Leave it empty if you won't change this)</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirm Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" name="confirm_password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Client Key</label>
                                            {{ Auth::user()->client_key }}
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Client Secret</label>
                                            {{ Auth::user()->client_secret }}
                                        </div>
                                        <div class="form-group">
                                            <label>Download WAF client</label>
                                            <a href="{{ url('avlwaf-client.zip') }}">here</a>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                            <button type="button" onclick="window.location.href='{{ route('billing') }}'" class="btn btn-primary">Billing</button>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@stop
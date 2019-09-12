@extends('template')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Custom Rules</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">AVL WAF</a></li>
                            <li class="breadcrumb-item active">Custom Rules</li>
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
                        <a href="{{ route('rules.create') }}" class="btn btn-primary">Add new</a>
                        <div class="table">
                            <table class="table table-bordered">
                                <thead>
                                <td>No</td>
                                <td>Description</td>
                                <td>Action</td>
                                </thead>
                                <tbody>
                                @php($i=0)
                                @foreach($rules as $rule)
                                    @php($i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $rule->description }}</td>
                                        <td><a href="{{ route('rules.edit', [$rule->id]) }}" class="btn btn-primary">Edit</a> <a href="{{ route('rules.delete', [$rule->id]) }}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@stop
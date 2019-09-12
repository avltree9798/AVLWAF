@extends('template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Custom Rule</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">AVL WAF</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('rules') }}">Custom Rules</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                        <form method="POST" action="{{ route('rules.update', [$rule->id]) }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="rule">Regex Rule:</label>
                                <input type="text" class="form-control" id="rule" name="rule" value="{{ $rule->rule }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ $rule->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="impact">Impact:</label>
                                <input type="number" class="form-control" id="impact" name="impact" value="{{$rule->impact}}">
                            </div>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@stop
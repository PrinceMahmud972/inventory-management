@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">User Create</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <h5 class="card-title">Create User</h5><br>
                <div>
                    <!-- form start -->
              <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name <span class="text-danger">*</span></label>
                    <input name="name" type="text" class="form-control" placeholder="Enter Name">
                    @if ($errors->has('name'))
                    <span class="error text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                    <input name="email" type="email" class="form-control" placeholder="Enter Email">
                    @if ($errors->has('email'))
                    <span class="error text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password <span class="text-danger">*</span></label>
                    <input name="password" type="password" class="form-control" placeholder="Enter password">
                    @if ($errors->has('password'))
                    <span class="error text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password <span class="text-danger">*</span></label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Confrim Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit</button>
                </div>
              </form>
                </div>
            </div>
          </div><!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

@endsection
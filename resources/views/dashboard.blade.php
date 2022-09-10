@extends('layouts.master')


@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $usersCount ?? 0 }}</h3>

                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $productsCount ?? 0 }}</h3>

                  <p>Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>{{ $stocksInCount ?? 0 }}</h3>

                  <p>Stocks In</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('stockHistory') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $returnsCount ?? 0 }}</h3>

                  <p>Return Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('returnProductHistory') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($recentProducts)
                        @foreach ($recentProducts as $key => $product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-center">
                                  <img class="img-fluid table-img" src="{{ asset('storage/product_images/'. $product->image) }}" alt="">
                                </td>
                                <td>{{ $product->name ?? '' }}</td>
                                <td>{{ $product->sku ?? '' }}</td>
                                <td>{{ $product->category->name ?? '' }}</td>
                                <td>{{ $product->brand->name ?? '' }}</td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-success mr-2">
                                      <i class="fa fa-desktop"></i> Show
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info mr-2">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    {{-- <a href="javascript:" class="btn btn-danger btn-sm sa-delete" data-form-id="product-delete-{{ $product->id }}">
                                        <i class="fa fa-trash"> Delete</i>
                                    </a> --}}
                                    <form class="d-inline" action="{{ route('products.destroy', $product->id) }}" method="post">
                                      @csrf
                                      @method('delete')
                                      <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                      </button>
                                    </form>


                                    {{-- <form id="product-delete-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
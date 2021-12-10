@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Products</h3>
              </div>

              @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{Session::get('status')}}
                    </div>
              @endif

              @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
              @endif

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Num.</th>
                        <th>Picture</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Product Price</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($allData as $key => $data)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>
                              <img src="{{!empty($data->image)? url('/shoppingcart/public/upload/product_image/'.$data->image):url('/shoppingcart/public/upload/noImage.jpg')}}" style="height: 50px; width:50px;" class="img-circle elevation-2" alt="Prduct Image">
                          </td>
                          <td>{{$data->product_name}}</td>
                          <td>{{$data->product_category}}</td>
                          <td>{{'$ '.$data->product_price}}</td>
                          <td>
                              @if ($data->status == 1)
                                <a href="{{route('products.unactivate',$data->id)}}" class="btn btn-success">Unactivate</a>
                              @else
                                <a href="{{route('products.activate',$data->id)}}" class="btn btn-warning">Activate</a>
                              @endif
                              <a title="Edit" href="{{route('products.edit',$data->id)}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                              <a title="Delete" href="{{route('categories.destroy',$data->id)}}" class="btn btn-danger" id="delete"><i class="nav-icon fas fa-trash"></i></a>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Edit Slider</h3>
              </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('sliders.update',$editData->id)}}" method="POST" class="form-horizontal" id="quickForm"   enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Description 1</label>
                            <input type="text" name="description1" value="{{$editData->description1}}" placeholder="Description 1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description 2</label>
                            <input type="text" name="description2" value="{{$editData->description2}}" placeholder="Description 2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Slider Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" value="{{$editData->image}}" class="custom-file-label" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose File</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <input type="submit" value="Update Slider" class="btn btn-primary">
                    </div>

                </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
    $(function () {

    $('#quickForm').validate({
        rules: {
        product_name: {
            required: true,
        },
        product_price: {
            required: true,
        },
        product_category: {
            required: true
        },
        },
        messages: {
        product_name: {
            required: "Please enter a product name"
        },
        product_price: {
            required: "Please enter price"
        },
        product_category: {
            required: "Please select category of product"
        },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        }
    });
    });
</script>
@endsection


@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->

@if (Session::has('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <i class="fa fa-times"></i>
    </button>
    {!! \Session::get('success') !!}
  </div>
@endif 

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Product Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('setting.product.category.index') }}">Product Category</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form action=" {{ url('/settings/product_category/update/'.$product_category->id) }}" method="POST">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$product_category->name}}">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" name="description" placeholder="Enter description">{{$product_category->description}}</textarea>
                    </div>
                  </div>
                  <div class="float-sm-right">
                    <button type="submit" class="btn btn-block btn-info">Submit</button>
                  </div>
                </form>

                <br><br>
                <hr/>

                <form action=" {{ url('/settings/product_subcategory/store') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="subcategory_name">Sub Category Name</label>
                      <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="Enter sub category name">
                    </div>

                    <div class="float-sm-right">
                      <label for="subcategory_name">&nbsp;</label>
                      <button type="submit" class="btn btn-block btn-info">Submit</button>
                    </div>
                  </div>

                  <input type="hidden" class="form-control" id="category_id" name="category_id" value="{{$product_category->id}}">

                  
                </form>

                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product_subcategories as $key => $product_subcategory)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{$product_subcategory->name}}</td>
                          <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-modal">Edit</button>
                            <a href="{{ url('/settings/product_subcategory/delete/'.$product_subcategory->id) }}" class="btn btn-danger btn-sm">Delete</a>
                          </td>
                      </tr>

                      <!-- edit modal -->
                      <div class="modal fade" id="edit-modal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" align="center">Edit Sub Category</h4>
                            </div>
                            <div class="modal-body">
                              <form action=" {{ url('/settings/product_subcategory/update/'.$product_subcategory->id) }}" method="POST">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="box-body">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label> 
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $product_subcategory->name }}">
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-info">Save changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div>
    </section>
    <!-- /.content -->
@endsection
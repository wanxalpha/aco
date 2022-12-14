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
            <h1 class="m-0 text-dark">{{ __('setting.product_category') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('setting.product.category.index') }}">{{ __('setting.product_category') }}</a></li>
              <li class="breadcrumb-item active">{{ __('common.edit') }}</li>
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
                      <label for="name">{{ __('common.name') }}</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$product_category->name}}">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="description">{{ __('common.description') }}</label>
                      <textarea class="form-control" id="description" name="description" placeholder="Enter description">{{$product_category->description}}</textarea>
                    </div>
                  </div>
                  <div class="float-sm-right">
                    <button type="submit" class="btn btn-block btn-info">{{ __('common.submit') }}</button>
                  </div>
                </form>

                <br><br>
                <hr/>

                <form action=" {{ url('/settings/product_subcategory/store') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="subcategory_name">{{ __('common.sub_category') }}</label>
                      <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="{{ __('common.enter_sub_category') }}">
                    </div>

                    <div class="float-sm-right">
                      <label for="subcategory_name">&nbsp;</label>
                      <button type="submit" class="btn btn-block btn-info">{{ __('common.add') }}</button>
                    </div>
                  </div>

                  <input type="hidden" class="form-control" id="category_id" name="category_id" value="{{$product_category->id}}">

                  
                </form>

                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{ __('common.no') }}</th>
                      <th>{{ __('common.name') }}</th>
                      <th>{{ __('common.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product_subcategories as $key => $product_subcategory)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{$product_subcategory->name}}</td>
                          <td>
                            <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-modal">Edit</button> -->
                            <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ModalEdit{{$product_subcategory->id}}">{{ __('common.edit') }}</a>
                            <a href="{{ url('/settings/product_subcategory/delete/'.$product_subcategory->id) }}" class="btn btn-danger btn-sm">{{ __('common.delete') }}</a>
                          </td>
                          @include('product_category.modal.edit')
                      </tr>                      
                    @endforeach
                  </tbody>
                  {{ $product_subcategories->links() }}
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

@push('script')
<script>

$(document).ready(function () {

  $('body').on('click', '#editCompany', function (event) {

event.preventDefault();
var id = $(this).data('id');
console.log(id)
$.get('color/' + id + '/edit', function (data) {
     $('#userCrudModal').html("Edit category");
     $('#submit').val("Edit category");
     $('#practice_modal').modal('show');
     $('#color_id').val(data.data.id);
     $('#name').val(data.data.name);
 })
});

}); 
</script>
@endpush 
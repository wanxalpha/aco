@extends('layouts.master')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/monokai.css') }}">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="{{ asset('plugins/simplemde/simplemde.min.css') }}">
  
<!-- Content Header (Page header) -->
@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('merchant.merchant_product') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('merchant.product.index') }}">{{ __('merchant.merchant_product') }}</a></li>
              <li class="breadcrumb-item active">Create</li>
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
                <form class="repeater" action=" {{ route('merchant.product.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">{{__('common.name')}}</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="type_id">{{__('common.type')}}</label>
                      <select class="form-control select2" id="type_id" name="type_id">
                        <option hidden value="">Select Type</option>
                        <option value='1'>Voucher</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="category_id">{{__('common.category')}}</label>
                      <select class="form-control select2" id="category_id" name="category_id">
                        <option hidden value="">Select Category</option>
                        @foreach($product_categories as $product_category)
                          <option value='{{ $product_category->id }}'>{{ $product_category->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="category">{{__('common.sub_category')}}</label>
                      <select id="sub_category_id" name="sub_category_id" class="form-control col-md-12 select2" required>
                      <option hidden value="">Select Subcategory</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="available_quantity">{{__('merchant.available_quantity')}}</label>
                      <input type="text" class="form-control" id="available_quantity" name="available_quantity" placeholder="Enter available quantity">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="status">{{__('common.status')}}</label>
                      <select class="form-control select2" id="status" name="status">
                        <option hidden value="">Select Status</option>
                        <option value='1'>Active</option>
                        <option value='2'>Non-active</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="member_price">{{__('merchant.member_price')}}</label>
                      <input type="text" class="form-control" id="member_price" name="member_price" placeholder="Enter member price">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="non_member_price">{{__('merchant.non_member_price')}}</label>
                      <input type="text" class="form-control" id="non_member_price" name="non_member_price" placeholder="Enter non member price">
                    </div>

                    <div class="col-md-12">
                      <label for="description">Description</label>
                      <textarea id="description" name="description"></textarea>
                    </div>

                  <div class="row col-md-12">
                    <div class="col-md-6">
                      <label for="name" class="form-label">{{__('common.attachment')}}</label>
                    </div>
                    <div class="col-md-6">
                      <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0 float-right" value="Add" />
                    </div>
                  </div>

                  <div class="mb-3 col-md-12">
                    <div data-repeater-list="attachment_list">
                      <div data-repeater-item class="row">
                        <div class="mb-9 col-lg-9">
                            <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>

                        <div class="mb-2 col-lg-2">
                          <input data-repeater-delete type="button" class="btn btn-primary form-control" value="Delete" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="float-sm-right">
                    <button type="submit" class="btn btn-block btn-info">{{ __('common.submit') }}</button>
                  </div>

                </form>
              </div>
            </div>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div>
    </section>
    <!-- /.content -->
@endsection

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
  $(function () {
    // Summernote
    $('#description').summernote()

    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });
  })
</script>

<script>
    $(document).ready(function () {
        "use strict";
        $(".repeater").repeater({
            defaultValues: {
                "textarea-input": "foo",
                "text-input": "bar",
                "select-input": "B",
                "checkbox-input": ["A", "B"],
                "radio-input": "B"
            },
            show: function () {
                $(this).slideDown()
            },
            hide: function (e) {
                confirm("Are you sure you want to delete this record?") && $(this).slideUp(e)
            },
            ready: function (e) {}
        }), window.outerRepeater = $(".outer-repeater").repeater({
            defaultValues: {
                "text-input": "outer-default"
            },
            show: function () {
                console.log("outer show"), $(this).slideDown()
            },
            hide: function (e) {
                console.log("outer delete"), $(this).slideUp(e)
            },
            repeaters: [{
                selector: ".inner-repeater",
                defaultValues: {
                    "inner-text-input": "inner-default"
                },
                show: function () {
                    console.log("inner show"), $(this).slideDown()
                },
                hide: function (e) {
                    console.log("inner delete"), $(this).slideUp(e)
                }
            }]
        })

        $(document).on('change', '#category_id', function() {
          console.log('asd');
            var category_id =  $(this).val();

            var a = $(this).parent();
            var op = "";
            
            $.ajax({
                type: 'get',
                url: '{{ route('get.subcategory') }}',
                data: { 'id': category_id },
                dataType: 'json',      //return data will be json
                success: function(data) {
                    console.log(data);
 
                    for (var i = 0; i < data.length; i++){
                      op += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }
                    $('#sub_category_id').html(" ");
                    $("#sub_category_id").append(op);
                },
                error:function(){

                }
            });
        });
    });
</script>
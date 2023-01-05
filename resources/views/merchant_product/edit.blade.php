@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Merchant Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('merchant.product.index') }}">Merchant Product</a></li>
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
                <form class="repeater" action="{{ url('/merchant_product/update/'.$merchant_product->id) }}) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$merchant_product->name}}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="type">Type</label>
                      <select class="custom-select rounded-0" id="type_id" name="type_id">
                        <option hidden value="">Select Type</option>
                        <option value='1' {{ $merchant_product->type_id == '1' ? 'selected' : ''  }}>Voucher</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="category">Category</label>
                      <select class="custom-select rounded-0" id="category_id" name="category_id">
                        <option hidden value="">Select Category</option>
                        @foreach($product_categories as $product_category)
                          <option value='{{ $product_category->id }}' {{ $merchant_product->category_id == $product_category->id ? 'selected' : ''  }}>{{ $product_category->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="category">Sub Category</label>
                      <select id="sub_category_id" name="sub_category_id" class="form-control col-md-12" required>
                      <option hidden value="{{ $merchant_product->sub_category_id }}">{{ $merchant_product->subcategory->name }}</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="available_quantity">Available Quantity</label>
                      <input type="text" class="form-control" id="available_quantity" name="available_quantity" placeholder="Enter available quantity" value="{{$merchant_product->available_quantity}}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="status">Status</label>
                      <select class="custom-select rounded-0" id="status" name="status">
                        <option hidden value="">Select Status</option>
                        <option value='1' {{ $merchant_product->status == 1 ? 'selected' : ''  }}>Active</option>
                        <option value='2' {{ $merchant_product->status == 2 ? 'selected' : ''  }}>Non-active</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="member_price">Member Price</label>
                      <input type="text" class="form-control" id="member_price" name="member_price" placeholder="Enter member price" value="{{$merchant_product->member_price}}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="non_member_price">Non-Member Price</label>
                      <input type="text" class="form-control" id="non_member_price" name="non_member_price" placeholder="Enter non member price" value="{{$merchant_product->non_member_price}}">
                    </div>
                    
                    <div class="col-md-12">
                      <label for="description">Description</label>
                      <textarea id="description" name="description">
                        {{$merchant_product->description}}
                      </textarea>
                    </div>

                    <div class="row col-md-12">
                      <div class="col-md-6">
                        <label for="name" class="form-label">{{__('common.attachment')}}</label>
                      </div>
                      <div class="col-md-6">
                        <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0 float-right" value="Add" />
                      </div>
                    </div>
                  </div>
              
                  <div class="mb-3 col-md-12">
                    <div data-repeater-list="attachment_list">
                      <div data-repeater-item class="row">
                        <div class="mb-9 col-lg-9">
                            <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>

                        <div class="mb-2 col-lg-2">
                          <input data-repeater-delete type="button" class="btn btn-danger form-control" value="Delete" />
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3 col-md-12">
                    <table width='100%' class="table table-hover">
                      <thead>
                        <tr>
                          <td>{{__('common.no')}}</td>
                          <td>{{__('common.attachment')}}</td>
                          <td>{{__('common.action')}}</td>
                        </tr>
                      </thead> 
                      <tbody>
                        @foreach($product_atachments as $key => $product_atachment)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                              <a href="{{ asset('storage/products/' .$product_atachment->hashname) }}" target="_blank">{{ $product_atachment->filename }}</a>
                            </td>
                            <td>
                              <a href="{{ url('/merchant_product/delete_attachment/'.$product_atachment->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                  </div>

                  <div class="float-sm-right">
                        <button type="submit" class="btn btn-block btn-info">Submit</button>
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
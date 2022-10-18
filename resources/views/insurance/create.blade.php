@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Insurance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('insurance.index') }}">Insurance</a></li>
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
                <form action=" {{ route('insurance.store') }}" method="POST">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="status">Status</label>
                      <select class="custom-select rounded-0" id="status" name="status">
                        <option hidden value="">Select Status</option>
                        <option value='1'>Active</option>
                        <option value='2'>Non-active</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="member_price">Member Price</label>
                      <input type="text" class="form-control" id="member_price" name="member_price" placeholder="Enter member price">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="non_member_price">Non-Member Price</label>
                      <input type="text" class="form-control" id="non_member_price" name="non_member_price" placeholder="Enter non member price">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- <script type="text/javascript" src="{{ URL::asset('js/merchant_product.js') }}"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
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
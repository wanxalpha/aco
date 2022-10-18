@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Partner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('partner.index') }}">Partner</a></li>
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
                <form action="{{ url('/partner/update/'.$partner->id) }}" method="POST" id="quickForm">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$partner->name}}">
                      @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-md-3">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{$partner->email}}" readonly='true' disabled='true'>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="mobile_number">Mobile Number</label>
                      <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter mobile number" value="{{$partner->mobile_number}}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" value="{{$partner->phone_number}}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="category">Category</label>
                      <select class="custom-select rounded-0" id="category_id" name="category_id">
                        <option hidden value="">Select Category</option>
                        <option value='1' {{ $partner->partnerDetails->category_id == 1 ? 'selected' : ''  }}>Insurance Company</option>
                        <option value='2' {{ $partner->partnerDetails->category_id == 2 ? 'selected' : ''  }}>Money Lender</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="business_registation_number">Business Registration Number</label>
                      <input type="text" class="form-control" id="business_registration_no" name="business_registration_no" placeholder="Enter mobile number" value="{{$partner->partnerDetails->business_registration_no}}">
                      @error('business_registration_no')
                          <code>{{ $message }}</code>
                      @enderror
                    </div>

                    <div class="form-group col-md-6">
                      <label for="address">Address</label>
                      <textarea class="form-control" id="address" name="address" placeholder="Enter address">{{$partner->address}}</textarea>
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

<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
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
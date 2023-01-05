@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('merchant.merchant') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('merchant.index') }}">{{ __('merchant.merchant') }}</a></li>
              <li class="breadcrumb-item active">{{ __('common.create') }}</li>
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
                <form action=" {{ route('merchant.store') }}" method="POST" id="quickForm">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">{{ __('common.name') }}</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('common.enter_name') }}" value="{{old('name')}}">
                      @error('name')
                          <code>{{ $message }}</code>
                      @enderror
                    </div>

                    <div class="form-group col-md-3">
                      <label for="email"><th>{{ __('common.email') }}</th></label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('common.email') }}" value="{{old('email')}}">
                      @error('email')
                          <code>{{ $message }}</code>
                      @enderror
                    </div>

                    <div class="form-group col-md-3">
                      <label for="mobile_number">Mobile Number</label>
                      <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('common.enter_mobile_no') }}" value="{{old('mobile_number')}}">
                      @error('mobile_number')
                          <code>{{ $message }}</code>
                      @enderror
                    </div>

                    <div class="form-group col-md-3">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="{{ __('common.enter_phone_no') }}" value="{{old('phone_number')}}">
                      @error('phone_number')
                          <code>{{ $message }}</code>
                      @enderror
                    </div>

                    <div class="form-group col-md-6">
                      <label for="address">Address</label>
                      <textarea class="form-control" id="address" name="address" placeholder="Enter address">{{old('address') }}</textarea>
                      @error('address')
                          <code>{{ $message }}</code>
                      @enderror
                    </div>
                  </div>
                  <div class="float-sm-right">
              
                        <button type="submit" class="btn btn-block btn-info">{{ __('common.create') }}</button>
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
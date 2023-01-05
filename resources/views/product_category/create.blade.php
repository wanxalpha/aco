@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
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
                <form action=" {{ route('setting.product.category.store') }}" method="POST">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">{{ __('common.name') }}</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('common.enter_name') }}">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="description">{{ __('common.description') }}</label>
                      <textarea class="form-control" id="description" name="description" placeholder="{{ __('common.enter_description') }}"></textarea>
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
@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<head>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

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
            <h1 class="m-0 text-dark">{{ __('partner.insurance') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('partner.insurance') }}</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{ route('insurance.create') }}" class="btn-block btn-info"><button type="button" class="btn btn-block btn-info">{{ __('common.create') }}</button></a>
              </li>
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
                <table id="example2" class="table table-hover">
                  <thead>
                    <tr>
                      <th>{{ __('common.no') }}</th>
                      <th>{{ __('common.name') }}</th>
                      <th>{{ __('common.created_date') }}</th>
                      <th>{{ __('common.status') }}</th>
                      <th>{{ __('common.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($insurances as $key => $insurance)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{$insurance->name}}</td>
                          <td>{{$insurance->created_at}}</td>
                          <td>
                            @if($insurance->status == 1)
                              Active
                            @elseif($insurance->status == 2)
                              Non-Active
                            @endif
                          </td>
                          <td>
                            <a href="{{ url('/insurance/edit/'.$insurance->id) }}" class="btn btn-info btn-sm">{{ __('common.edit') }}</a>
                            <a href="{{ url('/insurance/delete/'.$insurance->id) }}" class="btn btn-danger btn-sm">{{ __('common.delete') }}</a>
                          </td>
                      </tr>
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
<script src="{{ asset('../../plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('../../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- SweetAlert2 -->
<!-- Toastr -->
<script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('../../dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('../../dist/js/demo.js') }}"></script>
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    if((\Session::has('success'))){
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    }

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
</script>
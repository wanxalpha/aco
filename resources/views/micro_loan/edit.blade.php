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
            <h1 class="m-0 text-dark">{{ __('partner.microloan') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('microloan.index') }}">{{ __('partner.microloan') }}</a></li>
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
                <form  action="{{ url('/microloan/update/'.$micro_loan->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="package_name">{{ __('partner.package_name') }}</label>
                      <input type="text" class="form-control" id="package_name" name="package_name" placeholder="{{ __('partner.package_name_ph') }}" value="{{ $micro_loan->package_name }}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="amount">{{ __('partner.amount') }}</label>
                      <input type="text" class="form-control" id="amount" name="amount" placeholder="{{ __('partner.amount') }}" value="{{ $micro_loan->amount }}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="processing_fee">{{ __('partner.processing_fee') }}</label>
                      <input type="text" class="form-control" id="processing_fee" name="processing_fee" placeholder="{{ __('partner.processing_fee_ph') }}" value="{{ $micro_loan->processing_fee }}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="admin_fee">{{ __('partner.admin_fee') }}</label>
                      <input type="text" class="form-control" id="admin_fee" name="admin_fee" placeholder="{{ __('partner.admin_fee_ph') }}" value="{{ $micro_loan->admin_fee }}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="status">{{ __('common.status') }}</label>
                      <select class="custom-select rounded-0" id="status" name="status">
                        <option hidden value="">{{ __('common.select_status') }}</option>
                        <option value='1' {{ $micro_loan->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value='2' {{ $micro_loan->status == 2 ? 'selected' : '' }}>Non-active</option>
                      </select>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="money_lender_license">{{ __('partner.money_lender_license') }}</label>
                      <input type="file" name="money_lender_license" id="money_lender_license" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                      <a href="{{ asset('storage/money_lender/' .$micro_loan->money_lender_license) }}"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="advertising_license">{{ __('partner.advertising_license') }}</label>
                      <input type="file" name="advertising_license" id="advertising_license" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                      <a href="{{ asset('storage/money_lender/' .$micro_loan->advertising_license) }}"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="loan_agreement">{{ __('partner.loan_agreement') }}</label>
                      <input type="file" name="loan_agreement" id="loan_agreement" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                      <a href="{{ asset('storage/money_lender/' .$micro_loan->loan_agreement) }}"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>

                    <div class="col-md-12">
                      <label for="description">{{ __('common.description') }}</label>
                      <textarea id="description" name="description">{{ $micro_loan->description }}
                      </textarea>
                    </div>
                  </div>

                  <div class="float-sm-right">
                    <button type="submit" class="btn btn-block btn-info">{{ __('common.submit') }}</button>
                  </div>
                </form>
                <br>
                <br>
                <div class="mb-3 col-md-12">
                  <label for="name" class="form-label">{{ __('partner.loan_tenure') }}</label>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#yourModal">Add</button>
                </div>

                <div class="mb-3 col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <td>{{ __('partner.repayment_month') }}</td>
                      <td>{{ __('partner.member_interest_rate') }}</td>
                      <td>{{ __('partner.member_first_month_payment') }}</td>
                      <td>{{ __('partner.member_monthly_payment') }}</td>
                      <td>{{ __('partner.non_member_interest_rate') }}</td>
                      <td>{{ __('partner.non_member_first_month_payment') }}</td>
                      <td>{{ __('partner.non_member_monthly_payment') }}</td>
                      <td>{{ __('common.action') }}</td>
                    </thead>
                    <tbody>
                      @foreach($micro_loan_details as $key => $micro_loan_detail)
                        <tr>
                          <td>{{ $micro_loan_detail->tenure_month }}</td>
                          <td>{{ $micro_loan_detail->member_rate }}</td>
                          <td>{{ $micro_loan_detail->member_first_month_payment }}</td>
                          <td>{{ $micro_loan_detail->member_monthly_payment }}</td>
                          <td>{{ $micro_loan_detail->non_member_rate }}</td>
                          <td>{{ $micro_loan_detail->non_member_first_month_payment }}</td>
                          <td>{{ $micro_loan_detail->non_member_monthly_payment }}</td>
                          <td>
                            <!-- <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ModalEditDetails{{$micro_loan_detail->id}}"><i class="fa fa-pen"></i></a> -->
                            <a class="btn btn-danger btn-sm" href="{{ url('/microloan/delete_detail/'.$micro_loan_detail->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                

                <!-- modal create -->
                <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-dialog-centered mw-900px" style="max-width: 800px!important;" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create Loan Tenure</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <form  class="repeater" action=" {{ route('microloan.store_detail') }}" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input name="micro_loan_id" type="hidden" value="{{ $micro_loan->id }}">
                          <div class="row">
                            <div class="form-group col-md-3">
                              <label>{{ __('partner.repayment_month') }}</label>
                              <select class="custom-select rounded-0 tenure_month" id="tenure_month" name="tenure_month">
                              <option hidden value="">{{ __('partner.select_month') }}</option>
                                  @foreach( (new \App\Helpers\AppHelper)->getMonthNo() as $month)
                                      <option value='{{ $month }}'>{{ $month }}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label>Member</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label for="amount">{{ __('partner.interest_rate') }}</label>
                              <input type="text" class="form-control member_rate" id="member_rate" name="member_rate" placeholder="{{ __('partner.interest_rate_ph') }}">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="member_monthly_payment">{{ __('partner.monthly_payment') }}</label>
                              <input type="text" class="form-control member_monthly_payment" id="member_monthly_payment" name="member_monthly_payment" readonly=true>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="member_first_month_payment">{{ __('partner.first_month_payment') }}</label>
                              <input type="text" class="form-control member_first_month_payment" id="member_first_month_payment" name="member_first_month_payment" readonly=true>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label>Non Member</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label for="amount">{{ __('partner.interest_rate') }}</label>
                              <input type="text" class="form-control non_member_rate" id="non_member_rate" name="non_member_rate" placeholder="{{ __('partner.interest_rate_ph') }}">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="non_member_monthly_payment">{{ __('partner.monthly_payment') }}</label>
                              <input type="text" class="form-control non_member_monthly_payment" id="non_member_monthly_payment" name="non_member_monthly_payment" readonly=true>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="non_member_first_month_payment">{{ __('partner.first_month_payment') }}</label>
                              <input type="text" class="form-control non_member_first_month_payment" id="non_member_first_month_payment" name="non_member_first_month_payment" readonly=true>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
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

  })
</script>

<script>
  $(document).ready(function(){   

    $('.tenure_month').change(function(){
      var test = $(this).val();
      // test = 'yu';
      console.log(test);

    });

    $(".member_rate").on('change', function(){
      var amount = parseFloat($('#amount').val());
      var processing_fee = parseFloat($('#processing_fee').val());
      var admin_fee = parseFloat($('#admin_fee').val());
      var tenure_month = parseFloat($('.tenure_month').val());
      var member_rate = parseFloat($('.member_rate').val());

      var rate = amount * (member_rate / 100);
      var monthly_payment = ((amount + rate) / tenure_month);
      var first_month_payment = monthly_payment + processing_fee + admin_fee;

      $('.member_monthly_payment').val(monthly_payment.toFixed(2));
      $('.member_first_month_payment').val(first_month_payment.toFixed(2));
    });

    $(".non_member_rate").on('change', function(){
      var amount = parseFloat($('#amount').val());
      var processing_fee = parseFloat($('#processing_fee').val());
      var admin_fee = parseFloat($('#admin_fee').val());
      var tenure_month = parseFloat($('.tenure_month').val());
      var non_member_rate = parseFloat($('.non_member_rate').val());

      var rate = amount * (non_member_rate / 100);
      var monthly_payment = ((amount + rate) / tenure_month);
      var first_month_payment = monthly_payment + processing_fee + admin_fee;

      $('.non_member_monthly_payment').val(monthly_payment.toFixed(2));
      $('.non_member_first_month_payment').val(first_month_payment.toFixed(2));
    });

    var i=1;  


    $('#add').click(function(){  
     i++;  
     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="col-lg-2 numbering"></td><td class="col-lg-8"><input type="text" name="value[]" placeholder="" class="form-control checklist"/></td><td class="col-lg-2"><i name="remove" id="'+i+'"class="fa fa-times"></i></td></tr>');
     dynamicNumber();
   });  

    $(document).on('click', 'i', function(){  
     var button_id = $(this).attr("id");   
     $('#row'+button_id+'').remove();
     dynamicNumber();
   });  


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function dynamicNumber() {
      $(".numbering").each(function(i, v){
        $(this).html((i+1)+" )");
      });
    }

    function printErrorMsg (msg) {
     $(".print-error-msg").find("ul").html('');
     $(".print-error-msg").css('display','block');
     $(".print-success-msg").css('display','none');
     $.each( msg, function( key, value ) {
      $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
   }
 });  
</script>
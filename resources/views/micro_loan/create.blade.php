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
                <form  class="repeater" action=" {{ route('microloan.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="package_name">{{ __('partner.package_name') }}</label>
                      <input type="text" class="form-control" id="package_name" name="package_name" placeholder="{{ __('partner.package_name_ph') }}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="amount">{{ __('partner.amount') }}</label>
                      <input type="text" class="form-control" id="amount" name="amount" placeholder="{{ __('partner.amount') }}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="processing_fee">{{ __('partner.processing_fee') }}</label>
                      <input type="text" class="form-control" id="processing_fee" name="processing_fee" placeholder="{{ __('partner.processing_fee_ph') }}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="admin_fee">{{ __('partner.admin_fee') }}</label>
                      <input type="text" class="form-control" id="admin_fee" name="admin_fee" placeholder="{{ __('partner.admin_fee_ph') }}">
                  </div>

                    <div class="form-group col-md-3">
                      <label for="status">{{ __('common.status') }}</label>
                      <select class="custom-select rounded-0" id="status" name="status">
                        <option hidden value="">{{ __('common.select_status') }}</option>
                        <option value='1'>Active</option>
                        <option value='2'>Non-active</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="money_lender_license">{{ __('partner.money_lender_license') }}</label>
                      <input type="file" name="money_lender_license" id="money_lender_license" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="advertising_license">{{ __('partner.advertising_license') }}</label>
                      <input type="file" name="advertising_license" id="advertising_license" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="loan_agreement">{{ __('partner.loan_agreement') }}</label>
                      <input type="file" name="loan_agreement" id="loan_agreement" class="form-control">
                    </div>

                    <div class="col-md-12">
                      <label for="description">{{ __('common.description') }}</label>
                      <textarea id="description" name="description">
                      </textarea>
                    </div>
                  </div>

                  <!-- <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">{{ __('partner.loan_tenure') }}</label>
                  </div> -->

                  <!-- <div class="table-responsive col-lg-12">  
                    <input name="checklist_id" type="hidden">
                    <table class="col-lg-12" id="dynamic_field">   
                      <tr id="row_old1" class="dynamic-added">
                        <td class="col-lg-12 numbering">
                          <table class="col-lg-12" id="dynamic_field">   
                            <tr id="row_old1" class="dynamic-added">
                              <td class="col-lg-4 numbering" colspan=3>
                                <div class="form-group col-md-3">
                                  <label for="tenure_month">{{ __('partner.repayment_month') }}</label>
                                  <select class="custom-select rounded-0" id="tenure_month" name="tenure_month">
                                    <option hidden value="">{{ __('partner.select_month') }}</option>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                    <option value='6'>6</option>
                                    <option value='7'>7</option>
                                    <option value='8'>8</option>
                                    <option value='9'>9</option>
                                    <option value='10'>10</option>
                                    <option value='11'>11</option>
                                    <option value='12'>12</option>
                                  </select>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-group col-md-12">
                                  Member
                                </div>
                              </td>
                              <td>
                                <div class="form-group col-md-6">
                                  <label for="amount">{{ __('partner.interest_rate') }}</label>
                                  <input type="text" class="form-control" id="member_rate" name="member_rate" placeholder="{{ __('partner.interest_rate_ph') }}">
                                </div>
                              </td>
                              <td>
                                <div class="form-group col-md-6">
                                  <label for="member_payment">{{ __('partner.monthly_payment') }}</label>
                                  <input type="text" class="form-control" id="member_payment" name="member_payment" readonly=true>
                                </div>
                              </td>
                            </tr>  
                            <tr>
                              <td>
                                <div class="form-group col-md-12">
                                  Non Member
                                </div>
                              </td>
                              <td>
                                <div class="form-group col-md-6">
                                  <label for="nonmember_rate">{{ __('partner.interest_rate') }}</label>
                                  <input type="text" class="form-control" id="nonmember_rate" name="nonmember_rate" placeholder="{{ __('partner.interest_rate_ph') }}">
                                </div>
                              </td>
                              <td>
                                <div class="form-group col-md-6">
                                  <label for="nonmember_payment">{{ __('partner.monthly_payment') }}</label>
                                  <input type="text" class="form-control" id="nonmember_payment" name="nonmember_payment" disabled=true>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>  
                    </table>

                  </div> -->
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

  })
</script>

<script>
  $(document).ready(function(){   

    $("#member_rate").on('change', function(){
      var amount = parseFloat($('#amount').val());
      var processing_fee = parseFloat($('#processing_fee').val());
      var tenure_month = parseFloat($('#tenure_month').val());
      var member_rate = parseFloat($('#member_rate').val());

      var amount = amount + processing_fee; 
      var rate = amount * (member_rate / 100);
      var total_amount = ((amount + rate) / tenure_month).toFixed(2);

      $('#member_payment').val(total_amount)
    })

    $("#nonmember_rate").on('change', function(){
      var amount = parseFloat($('#amount').val());
      var processing_fee = parseFloat($('#processing_fee').val());
      var tenure_month = parseFloat($('#tenure_month').val());
      var nonmember_rate = parseFloat($('#nonmember_rate').val());

      var amount = amount + processing_fee; 
      var rate = amount * (nonmember_rate / 100);
      var total_amount = ((amount + rate) / tenure_month).toFixed(2);

      $('#nonmember_payment').val(total_amount)
    })

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
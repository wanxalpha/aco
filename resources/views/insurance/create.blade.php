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
            <h1 class="m-0 text-dark">{{ __('partner.insurance') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('insurance.index') }}">{{ __('partner.insurance') }}</a></li>
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
                <form  class="repeater" action=" {{ route('insurance.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">{{ __('common.name') }}</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('common.enter_name') }}">
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
                      <label for="epolicy">{{ __('partner.epolicy') }}</label>
                      <input type="file" name="epolicy" id="epolicy" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="ecertificate">{{ __('partner.ecertificate') }}</label>
                      <input type="file" name="ecertificate" id="ecertificate" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="important_notice">{{ __('partner.important_notice') }}</label>
                      <input type="file" name="important_notice" id="important_notice" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-3">
                      <label for="insurance_plan">{{ __('partner.insurance_plan') }}</label>
                      <input type="file" name="insurance_plan" id="insurance_plan" class="form-control">
                    </div>

                    <div class="col-md-12">
                      <label for="description">{{ __('common.description') }}</label>
                      <textarea id="description" name="description">
                      </textarea>
                    </div>
                  </div>

                  <div class="mt-4">
                      <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0  float-right" value="Add" />
                  </div>

                  <div class="row">
                    <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Questionaire</label>
                      <div data-repeater-list="questionaire_list">
                        <div data-repeater-item class="row">
                            <div class="mb-9 col-lg-9">
                                <input class="form-control" type="text" name="questionaire" id="questionaire"/>
                            </div>

                            <div class="mb-2 col-lg-2">
                                    <input data-repeater-delete type="button" class="btn btn-primary form-control" 
                                        value="Delete" />
                            </div>
                        </div>
                      </div>
                  </div>

                  <div class="mb-3 col-md-12">
                  <label for="name" class="form-label">{{ __('partner.questionaire') }}</label>
                    <button type="button" class="btn btn-s-md btn-danger float-right" name="add" id="add">{{ __('common.add_more') }}</button>
                  </div>

                  <div class="table-responsive col-lg-12">  
                    <input name="checklist_id" type="hidden" value="43">
                    <table class="col-lg-7" id="dynamic_field">   
                      <tr id="row_old1" class="dynamic-added">
                          <td class="col-lg-2 numbering"> 1 )</td>
                          <td class="col-lg-8">
                              <input type="text" name="value[]" style="margin-top:5px" placeholder="" class="form-control checklist"/>
                          </td>
                          <td class="col-lg-2"><i name="remove" id="1"class="fa fa-times"></i></td>
                      </tr>  
                    </table>
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
    });
</script>

<script>
  $(document).ready(function(){   

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
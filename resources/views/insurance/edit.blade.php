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
                <form action=" {{ url('/insurance/update/'.$insurance->id) }}" method="POST">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$insurance->name}}">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="status">Status</label>
                      <select class="custom-select rounded-0" id="status" name="status">
                        <option hidden value="">Select Status</option>
                        <option value='1' {{ $insurance->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value='2' {{ $insurance->status == 2 ? 'selected' : '' }}>Non-active</option>
                      </select>
                    </div>
                    
                    <div class="form-group col-md-2">
                      <label for="epolicy">E-policy</label>
                      <input type="file" name="epolicy" id="epolicy" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                      <label for="epolicy">&nbsp;</label>
                      <a href="{{ asset('storage/insurance/' . $insurance->epolicy) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="ecertificate">E-certificate</label>
                      <input type="file" name="ecertificate" id="ecertificate" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                      <label for="ecertificate">&nbsp;</label>
                      <a href="{{ asset('storage/insurance/' . $insurance->ecertificate) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="important_notice">Important Notice</label>
                      <input type="file" name="important_notice" id="important_notice" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                      <label for="important_notice">&nbsp;</label>
                      <a href="{{ asset('storage/insurance/' . $insurance->important_notice) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="insurance_plan">Insurance Plan</label>
                      <input type="file" name="insurance_plan" id="insurance_plan" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                      <label for="insurance_plan">&nbsp;</label>
                      <a href="{{ asset('storage/insurance/' . $insurance->insurance_plan) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>

                    <div class="col-md-12">
                      <label for="description">Description</label>
                      <textarea id="description" name="description">
                        {{ $insurance->description }}
                      </textarea>
                    </div>
                  </div>
              
                  <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">{{ __('partner.questionaire') }}</label>
                    <button type="button" class="btn btn-s-md btn-danger float-right" name="add" id="add">{{ __('common.add_more') }}</button>
                  </div>

                  <div class="table-responsive col-lg-12">  
                    <table class="col-lg-7" id="dynamic_field">   
                      <?php $no = 1 ?> 
                      @foreach($insurance_questionaire as $key => $question)
                        <tr id="row_old{{ $key }}" class="dynamic-added">
                            <td class="col-lg-2 numbering">{{ $no++ }} )</td>
                            <td class="col-lg-8">
                                <input type="text" name="question[{{$question->id}}]" style="margin-top:5px" placeholder="" class="form-control checklist" value="{{ $question->question }}"/>
                            </td>
                            <td class="col-lg-2"><i name="remove" id="{{ $no }}"class="fa fa-times"></i></td>
                        </tr>
                      @endforeach  
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#description').summernote()

  })
</script>
<script>


  $(document).ready(function(){   

    var i=1;  


    $('#add').click(function(){  
     i++;  
     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="col-lg-2 numbering"></td><td class="col-lg-8"><input type="text" name="new[]" placeholder="" class="form-control checklist"/></td><td class="col-lg-2"><i name="remove" id="'+i+'"class="fa fa-times"></i></td></tr>');
     dynamicNumber();
   });  

    $(document).on('click', 'i', function(){  
     var button_id = $(this).attr("id");   
     $('#row'+button_id+'').remove();
     dynamicNumber();
   });  

   $(document).on('click', 'i', function(){  
           var button_id = $(this).attr("id");   
           $(this).closest("tr").remove();
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
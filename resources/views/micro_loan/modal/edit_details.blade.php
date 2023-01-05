<form action="{{ route('microloan.update_detail') }}" method="post" enctype="multipart/form-data">
    {{ method_field('post') }}
    {{ csrf_field() }}
    <input type='hidden' name='detail_id' value='{{ $micro_loan_detail->id }}'>
    <div class="modal fade text-left" id="ModalEditDetails{{$micro_loan_detail->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Tenure') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  class="repeater" action=" {{ route('microloan.store_detail') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="form-group col-md-3">
                            <label>{{ __('partner.repayment_month') }}</label>
                            <select class="custom-select rounded-0 tenure_month" id="tenure_month" name="tenure_month">
                            <option hidden value="">{{ __('partner.select_month') }}</option>
                                @foreach( (new \App\Helpers\AppHelper)->getMonthNo() as $month)
                                    <option value="{{ $month }}" {{ $micro_loan_detail->tenure_month == $month ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label>Member</label>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="amount">{{ __('partner.interest_rate') }}</label>
                            <input type="text" class="form-control member_rate" id="member_rate" name="member_rate" placeholder="{{ __('partner.interest_rate_ph') }}" value="{{ $micro_loan_detail->member_rate }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="member_monthly_payment">{{ __('partner.monthly_payment') }}</label>
                            <input type="text" class="form-control member_monthly_payment" id="member_monthly_payment" name="member_monthly_payment" readonly=true value="{{ $micro_loan_detail->member_monthly_payment }}">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label>Non Member</label>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="amount">{{ __('partner.interest_rate') }}</label>
                            <input type="text" class="form-control non_member_rate" id="non_member_rate" name="non_member_rate" placeholder="{{ __('partner.interest_rate_ph') }}" value="{{ $micro_loan_detail->non_member_rate }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="non_member_monthly_payment">{{ __('partner.monthly_payment') }}</label>
                            <input type="text" class="form-control non_member_monthly_payment" id="non_member_monthly_payment" name="non_member_monthly_payment" readonly=true value="{{ $micro_loan_detail->non_member_monthly_payment }}">
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
</form>
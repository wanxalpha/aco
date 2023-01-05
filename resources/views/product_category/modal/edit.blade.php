<form action="{{ route('setting.product.subcategory.update', $product_subcategory->id) }}" method="post" enctype="multipart/form-data">
    {{ method_field('patch') }}
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalEdit{{$product_subcategory->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('setting.edit_sub_category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __('common.name') }}</strong>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $product_subcategory->name }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('common.close') }}</button>
                        <button type="submit" class="btn btn-info">{{ __('common.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
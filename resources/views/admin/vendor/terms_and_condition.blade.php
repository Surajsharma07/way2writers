@extends('admin.layouts.app')
@section('head_scripts')
    <title>@lang('page_title.Admin.vendor_title')</title>
@endsection
@section('content')
    <div class="tp_main_content_wrappo">
        <div class="tp_tab_wrappo">
            <h4 class="tp_heading">Vendor's Terms & Conditions</h4>
        </div>
        <div class="tp_tab_content">
            <form id="vendor-form" action="{{ route('admin.setting.storelongtext') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="tp_catset_box">
                            <div class="alert alert-info">
                                <strong>Info!</strong> Separate each terms by pressing Enter key.
                            </div>

                            <div class="tp_form_wrapper">
                                <label class="mb-2">Show Terms & Conditions</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" name="is_active_tndc" value="0">
                                        <input class="form-control" type="checkbox" value="1"
                                            name="is_active_tndc"@if (@$solo_active_tndc->long_value == 1) checked @endif>
                                        <i class="input-helper"></i>Click to Show Terms & Conditions.
                                    </label>
                                </div>
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Terms & Conditions Text</label>
                                <textarea class="form-control" rows="4" cols="50" spellcheck="false" placeholder="Enter Terms & Conditions Text" name="vendor_tnctext" id="theme-editor">         
                                {{ @$solo_tnctext->long_value }}
                                </textarea>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="tp_btn" id="vendor-form-btn">update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin-theme/my_assets/js/form-validate.js') }}"></script>
@endsection

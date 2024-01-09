@php  $ASSET_URL = asset('admin-theme/assets').'/'; @endphp
@extends('admin.layouts.app')
@section('head_scripts')
    <title>@lang('page_title.Admin.plan_setting_title')</title>
@endsection
@section('content')
    <div class="tp_main_content_wrappo">
        <div class="tp_tab_wrappo">
            <h4 class="tp_heading">Portal Revenue</h4>
        </div>
        <div class="tp_tab_content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="tp_catset_box">
                        <form id="revenue-form" action="{{ route('admin.setting.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="tp_form_wrapper">
                                        <label class="mb-2">Currency</label>
                                        <div class="tp_custom_select">
                                            <select class="form-control" name="default_currency">
                                                @foreach ($currency as $val)
                                                    <option value="{{ $val->currency_code }}"
                                                        @if (@$data->default_currency == $val->currency_code) selected="selected" @endif>
                                                        {{ $val->currency_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="tp_inputnote">Transactions with any gateway, use specific
                                            currency.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="tp_form_wrapper">
                                        <label class="mb-2">Currency Symbol</label>
                                        <div class="tp_custom_select">
                                            <select class="form-control" name="default_symbol">

                                                @foreach ($symbol as $val)
                                                    <option value="{{ $val->symbol }}"
                                                        @if (@$data->default_symbol == $val->symbol) selected="selected" @endif>
                                                        {{ $val->symbol }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="tp_inputnote">This will be displayed with the product price.</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="tp_btn" id="revenue-form-btn"
                                onclick="revenueformValidate('revenue-form')">update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin-theme/my_assets/js/setting.js') }}"></script>
@endsection

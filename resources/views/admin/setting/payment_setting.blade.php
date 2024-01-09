@php  $ASSET_URL = asset('admin-theme/assets').'/'; @endphp
@extends('admin.layouts.app')
@section('head_scripts')
    <title>@lang('page_title.Admin.setting_title')</title>
@endsection
@section('content')
    <div class="tp_main_content_wrappo">
        <div class="tp_tab_wrappo">
            <ul>
                @foreach ($payment_gateways as $key => $val)
                    <li class="@if ($loop->first) active @endif">

                        <a href="#" class="setting-tab" data-target="{{ @$val }}"><img
                                src="{{ $ASSET_URL }}images/{{ $val }}.png" alt="">
                            {{ @$val }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tp_tab_content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="setting-tab-tar active" id="PayPal">
                        <form id="paypal-form" action="{{ route('admin.setting.store') }}" method="POST">
                            @csrf
                            <div class="tp_catset_box">
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Show paypal option to users</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" class="form-control" name="is_checked_paypal"
                                                value="0">
                                            <input type="checkbox" class="form-control" name="is_checked_paypal"
                                                value="1" @if (@$data->is_checked_paypal) checked @endif>
                                            <i class="input-helper"></i>Check / Uncheck to Show paypal option to users
                                        </label>
                                    </div>
                                </div>
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Is PayPal Live Credentails</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" class="form-control" name="is_live_paypal" value="0">
                                            <input type="checkbox" class="form-control" name="is_live_paypal" value="1"
                                                @if (@$data->is_live_paypal) checked @endif>
                                            <i class="input-helper"></i>Check / Uncheck to Live by default sandbox.
                                        </label>
                                    </div>
                                </div>

                                <div class="tp_form_wrapper">
                                    <label class="mb-2">App ID</label>
                                    <input type="text"class="form-control" name="paypal_app_id" placeholder="Enter App ID"
                                        value="{{ @$data->paypal_app_id }}">
                                </div>
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Paypal Client Id</label>
                                    <input type="text"class="form-control" name="paypal_client_id"
                                        placeholder="Enter Client ID" value="{{ @$data->paypal_client_id }}">
                                </div>
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Paypal Client Secret</label>
                                    <input type="text"class="form-control" name="paypal_client_secret"
                                        placeholder="Enter Client Secret" value="{{ @$data->paypal_client_secret }}">
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="tp_btn" id="paypal-form-btn"
                                        onclick="PaymentformValidate('paypal-form')">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="setting-tab-tar" id="Stripe">
                        <form id="stripe-form" action="{{ route('admin.setting.store') }}" method="POST">
                            @csrf
                            <div class="tp_catset_box">
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Show Stripe option to users</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" class="form-control" name="is_checked_stripe"
                                                value="0">
                                            <input type="checkbox" class="form-control" name="is_checked_stripe"
                                                value="1" @if (@$data->is_checked_stripe) checked @endif>
                                            <i class="input-helper"></i>Check / Uncheck to Show Stripe option to
                                            users</label>
                                    </div>
                                </div>
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Live Stripe Key</label>
                                    <input type="text" class="form-control" name="stripe_key"
                                        placeholder="Enter Stripe Key" value="{{ @$data->stripe_key }}">
                                </div>
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Live Stripe Secret</label>
                                    <input type="text" class="form-control" name="stripe_secret_key"
                                        placeholder="Enter Stripe Scvret" value="{{ @$data->stripe_secret_key }}">
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="tp_btn" id="stripe-form-btn"
                                        onclick="PaymentformValidate('stripe-form')">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="setting-tab-tar" id="Razorpay">
                        <form id="razorpay-form" action="{{ route('admin.setting.store') }}" method="POST">
                            @csrf
                            <div class="tp_catset_box">
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Show Razorpay option to users</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" class="form-control" name="is_checked_razorpay"
                                                value="0">
                                            <input type="checkbox" class="form-control" name="is_checked_razorpay"
                                                value="1" @if (@$data->is_checked_razorpay) checked @endif>
                                            <i class="input-helper"></i>Check / Uncheck to Show razorpay option to
                                            users</label>
                                    </div>
                                </div>
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">Razorpay Key</label>
                                    <input type="text" class="form-control" name="razorpay_key"
                                        placeholder="Enter razorpay Key" value="{{ @$data->razorpay_key }}">
                                </div>
                                <div class="tp_form_wrapper">
                                    <label class="mb-2">razorpay Secret</label>
                                    <input type="text" class="form-control" name="razorpay_secret_key"
                                        placeholder="Enter razorpay Scvret" value="{{ @$data->razorpay_secret_key }}">
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="tp_btn" id="razorpay-form-btn"
                                        onclick="PaymentformValidate('razorpay-form')">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script src="{{ asset('admin-theme/my_assets/js/setting.js') }}"></script>
    @endsection

@php
    $ASSET_URL = asset('user-theme') . '/';
    $setting = getSetting();
    $price_symbol = $setting->default_symbol ?? '$';
@endphp
@extends('frontend.layout.master')
@section('head_scripts')
    <title>@lang('page_title.Frontend.user_profile_title')</title>
@endsection
@section('head_css')
    <link rel="stylesheet" href="{{ $ASSET_URL }}assets/css/rating.css" />
@endsection
@section('content')
    <!--===User Profile Section Start===-->
    <div class="tp_propage_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp_propage_head">
                        <h2>@lang('master.user_profile.welcome_back')</h2>
                        <p>@lang('master.user_profile.profile_heading')</p>
                    </div>
                </div>
            </div>
            <div class="row tp_propage_text">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link @if (empty(request('tab'))) active @endif" id="v-pills-profile-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="true"><i class="fa fa-user"
                                aria-hidden="true"></i>@lang('master.user_profile.my_profile')
                        </button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-change_password" type="button" role="tab"
                            aria-controls="v-pills-change_password" aria-selected="true"><i class="fa fa-lock"
                                aria-hidden="true"></i>@lang('master.user_profile.change_password')
                        </button>
                        <button class="nav-link @if (request('tab') == 'my-orders') active @endif" id="v-pills-invoice-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-invoice" type="button" role="tab"
                            aria-controls="v-pills-invoice" aria-selected="false"><i class="fa fa-file-text"
                                aria-hidden="true"></i>@lang('master.user_profile.my_order')
                        </button>
                        <button href="#v-pills-download" class="nav-link @if (request('tab') == 'my-downloads') active @endif"
                            id="v-pills-download-tab" data-bs-toggle="pill" data-bs-target="#v-pills-download"
                            role="tab" aria-controls="v-pills-download" aria-selected="false"><i class="fa fa-download"
                                aria-hidden="true"></i>@lang('master.user_profile.my_download')
                        </button>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  @if (empty(request('tab'))) show active @endif"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead">
                                    <h3>@lang('master.user_profile.personal_details')</h3>
                                </div>
                                <form action="{{ route('frontend.update_profile') }}" method="Post"
                                    id="update_user_details">
                                    @csrf
                                    <div class="tp_propage_profile_form">
                                        <div class="tp_input_main">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card-body text-center">
                                                        <div class="tp_user_img">
                                                            <img src="@if (!empty($user->avatar)) {{ $user->avatar }} @else {{ $ASSET_URL . 'assets/images/user-profile.png' }} @endif"
                                                                alt="avatar" title="avatar" class="rounded-circle"
                                                                width="150px" height="150px" id="Imagepreview" />
                                                            <div class="tp_user_edit">
                                                                <i id="OpenImgUpload"
                                                                    class="text-left fa fa-cloud-upload d-block"></i>
                                                            </div>
                                                            <input type="file" name="image" id="imgupload"
                                                                onchange="uploadImage('imgupload')" style="display:none" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.contact_email')</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your Email" name="email"
                                                            value="{{ @$user->email }}" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.full_name')</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter full Name" name="full_name"
                                                            value="{{ @$user->full_name }}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.user_name')</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter User Name" name="username"
                                                            value="{{ @$user->username }}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.mobile_number')</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Enter Mobile Number" name="mobile"
                                                            value="{{ @$user->mobile }}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.country')</label>
                                                        <select class="form-control form-control-lg input-font"
                                                            name="country_id">
                                                            <option value="">@lang('master.user_profile.select_country')</option>
                                                            @foreach ($country as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if (@$user->country_id == $item->id) selected @endif>
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.state')</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your state" name="state"
                                                            value="{{ @$user->state }}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.city')</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your City" name="city"
                                                            value="{{ @$user->city }}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="tp_input_text">
                                                        <label class="form-label">@lang('master.user_profile.address')</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your Address" name="address"
                                                            value="{{ @$user->address }}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <button class="btn btn-color btn-lg px-5 py-2 btn-font tp_btn"
                                                        type="submit"
                                                        id="update_user_details_btn">@lang('master.user_profile.update')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-change_password" role="tabpanel"
                            aria-labelledby="v-pills-change_password-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead">
                                    <h3>@lang('master.user_profile.change_password')</h3>
                                </div>
                                <form action="{{ route('frontend.change-password') }}" method="Post"
                                    id="change_password_form_id">
                                    @csrf
                                    <div class="tp_propage_profile_form">
                                        <div class="tp_input_main">
                                            <div class="tp_input_text">
                                                <label class="form-label">@lang('master.user_profile.old_password')</label>
                                                <input type="password" name="old_password" class="form-control"
                                                    placeholder="Enter Your Old Password" />

                                            </div>
                                            <div class="tp_input_text">
                                                <label class="form-label">@lang('master.user_profile.new_password')</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Enter Your Password" />
                                            </div>
                                            <div class="tp_input_text">
                                                <label class="form-label">@lang('master.user_profile.confirm_password')</label>
                                                <input type="password" name="confirm_password" class="form-control"
                                                    placeholder="Enter Your confirm password" />

                                            </div>
                                            <button class="btn btn-color btn-lg px-5 py-2 btn-font tp_btn" type="submit"
                                                id="change_password_form_id_btn">@lang('master.user_profile.update')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade @if (request('tab') == 'my-orders') active @endif" id="v-pills-invoice"
                            role="tabpanel" aria-labelledby="v-pills-invoice-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead tp_propage_invoice">

                                    <h3>@lang('master.billing_details.orders')</h3>
                                </div>
                                <div class="tp_table_box tp_propage_table">
                                    <div class="table-responsive">
                                        <table id="example" class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('master.billing_details.tnx_number')</th>
                                                    <th>@lang('master.billing_details.amount')</th>
                                                    <th>@lang('master.billing_details.payment_date')</th>
                                                    <th>@lang('master.billing_details.status')</th>
                                                    <th>@lang('master.billing_details.invoice')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($user->getOrders[0]))
                                                    @foreach ($user->getOrders as $key => $items)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $items->tnx_id }}</td>
                                                            <td>{{ $price_symbol }}{{ @$items->billing_total }}</td>
                                                            <td>{{ set_date_format($items->created_at) }}</td>
                                                            <td>
                                                                {{ $items->status }}

                                                            </td>
                                                            <td>
                                                                <ul>
<li><a href="{{ route('frontend.download-invoice', ['tnx_id' => $items->tnx_id]) }}"
                                                                            class="tp_edit" title="Edit"><i
                                                                                class="fa fa-eye"
                                                                                aria-hidden="true"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="text-center">
                                                        <td colspan="5">@lang('master.billing_details.not_found')</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if (request('tab') == 'my-downloads') show active @endif"
                            id="v-pills-download" role="tabpanel" aria-labelledby="v-pills-download-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead tp_propage_pay">
                                    <h3>@lang('master.billing_details.download')</h3>
                                </div>
<div class="tp_propage_download">
    <div class="row">
        @if (isset($user->getOrders[0]))
            @foreach ($user->getOrders as $key => $items1)
                @foreach ($items1->getOrderProduct as $key2 => $items2)
                    @foreach ($items2->getProduct as $key3 => $items)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tp_pro_downbox">
                                <div class="tp_download_text">
                                    <div class="tp_download_text_head">
                                         
                                    <h4>Order Id: {{ $items2->order_id }}</h4>
                                     @php
                    $orderStatus = $items1->status; // Replace 'status' with the actual attribute for order status
                @endphp

                <div class="progress mt-3">
                    @if ($orderStatus == 'Fail')
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Order Failed</div>
                    @elseif ($orderStatus == 'Order Received')
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Order Received</div>
                    @elseif ($orderStatus == 'proccessing')
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Processing</div>
                    @elseif ($orderStatus == 'Complete')
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Delivered</div>
                    @else
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Unknown Status</div>
                    @endif
                </div>
                                     <h5>{{ $items->name }}</h5>
                                    <p>Delivery: {{ $items2->delivery_option_name }}</p>
                                    @if ($items2->include_cover_letter)
                                        @if ($items2->cover_letter_path)
                                            <p>Include Cover Letter: Yes</p>
                                        @else
                                            <p>Include Cover Letter: Yes</p>
                                        @endif
                                    @else
                                    @endif
                                </div>
                                    
                                    <div class="tp-dwld-toggle">

                                        <div class="dropdown">
                                         @if ($orderStatus == 'Complete')
                                            <button class="btn tp_btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Download
                                            </button>
                                         
@php $fileArr = $items->getdownlaodfilelink($items2->order_id); @endphp
@if (count($fileArr) > 0)
    <ul class="dropdown-menu">
        @foreach ($fileArr as $key => $value)
            <li>
                <a class="dropdown-item" href="{{ asset($value['file_path']) }}" download>
                    <i class="fa fa-download" aria-hidden="true"></i>
                    {{ $value['file_name'] }}
                </a>
            </li>
            
        @endforeach
    </ul>
       @endif
@endif
                                        </div>
 @if ($orderStatus == 'Complete')
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#reviewmodal" class="btn tp_btn tp_rev_btn"
                                            onclick="setReview('{{ $items->thumb }}', '{{ $items->slug }}', '{{ @$items1->tnx_id }}', '{{ @$items->getUserProductReview->id }}', '{{ @$items->getUserProductReview->rating }}')">
                                            Review
                                        </button>
                                        @endif
                                    </div>
                                    <input type="hidden" id="r_comment_{{ @$items->getUserProductReview->id }}" value="{{ @$items->getUserProductReview->comment }}">
                               
                                </div>
                                
                            </div>
                        </div>
                        
                    @endforeach
                @endforeach
            @endforeach
        @else
            <p>No Download Found.</p>
        @endif
        
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=== Section Start===-->
    {{-- Review model --}}
    <div class="modal fade" id="reviewmodal" tabindex="-1" aria-labelledby="reviewmodallabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bdr-radius rounded-4 overflow-hidden">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card bg-white text-dark shadow-none tp_review_model_wrapper">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="card-body">
                                <form method="post" class="tp_review_form" id="user_set_review"
                                    action="{{ route('admin.rating.store') }}">
                                    <div class="tp_review_box">
                                        <img id="md-review-img" src="" class="tp-review-img" alt="review-img">
                                        <div class="tp_review_box_data">
                                            <h3>@lang('master.review_model.product')</h3>
                                            <div class="tp_review_star">
                                                <p>@lang('master.review_model.star_rate')</p>

                                                <div class="col">
                                                    <div class="rate">
                                                        <input type="radio" id="star5" class="rate"
                                                            name="rating" value="5" />
                                                        <label for="star5" title="text">@lang('master.review_model.5_stars')</label>
                                                        <input type="radio" checked id="star4" class="rate"
                                                            name="rating" value="4" />
                                                        <label for="star4" title="text">@lang('master.review_model.4_stars')</label>
                                                        <input type="radio" id="star3" class="rate"
                                                            name="rating" value="3" />
                                                        <label for="star3" title="text">@lang('master.review_model.3_stars')</label>
                                                        <input type="radio" id="star2" class="rate"
                                                            name="rating" value="2">
                                                        <label for="star2" title="text">@lang('master.review_model.2_stars')</label>
                                                        <input type="radio" id="star1" class="rate"
                                                            name="rating" value="1" />
                                                        <label for="star1" title="text">@lang('master.review_model.1_stars')</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tp_reviewform_box">
                                        <div class="tp_input_text">
                                            <textarea placeholder="Write a review here... " class="form-control" id="rt_comment" name="comment" rows="3"
                                                cols="50"></textarea>
                                        </div>
                                        <button id="user_set_review_btn"
                                            class="btn btn-color btn-lg px-5 py-2 btn-font tp_btn" type="submit">post
                                            Review</button>
                                    </div>
                                    <input type="hidden" name="pid" id="_pid" value="">
                                    <input type="hidden" name="txid" id="_txid" value="">
                                    <input type="hidden" name="rid" id="_rate_id" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('user-theme/my_assets/js/validation.js') }}"></script>
@endsection

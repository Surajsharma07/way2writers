@php $price_symbol = getSetting()->default_symbol ?? '$'; @endphp
@php $ASSET_URL = asset('admin-theme').'/'; @endphp
@extends('admin.layouts.app')
@section('content')
    <div class="tp_main_content_wrappo">
        <div class="tp_tab_wrappo">
            <ul>
                <li><a href="{{ route('admin.order.index') }}">Order List</a> </li>
            </ul>
        </div>
        <div class="tp_tab_content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                    <div class="tp_catset_box tp_catset_singleuser">
                    
                        <div role="tabpanel" class="tab-pane active" id="info">
                        <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp_prohead_heading">
                                        <h4 class="tp_heading">Order Details</h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp_prohead_btn">
                                        <a href="{{ route('admin.order.edit', $data->id) }}" class="tp_btn">Update Order status</a>
                                    </div>
                                </div>
                            </div>
                            <div class="th_content_section">
                                <div class="th_product_detail">
                                    <div class="theme_label">Order Id :</div>
                                    <div class="product_info product_name">{{ @$data->id }}</div>
                                </div>
                                <div class="th_product_detail">
                                    <div class="theme_label">Transaction Id :</div>
                                    <div class="product_info product_name">{{ @$data->tnx_id }}</div>
                                </div>
                                <div class="th_product_detail">
                                    <div class="theme_label">Customer :</div>
                                    <div class="product_info product_name">{{ @$data->getUser->full_name }}</div>
                                </div>

                                <div class="th_product_detail">
                                    <div class="theme_label">Payment Id :</div>
                                    <div class="product_info product_name">{{ @$data->payment_id ?? 'NA' }}</div>
                                </div>
                                <div class="th_product_detail">
                                    <div class="theme_label">Payer Id :</div>
                                    <div class="product_info product_name">{{ @$data->payer_id ?? 'NA' }}</div>
                                </div>
                                <div class="th_product_detail">
                                    <div class="theme_label">Billing email :</div>
                                    <div class="product_info product_name">{{ @$data->getUser->email }}</div>
                                </div>
                                <div class="th_product_detail">
                                    <div class="theme_label">Billing Discount :</div>
                                    <div class="product_info product_name">{{ @$data->billing_discount ?? 0 }}</div>
                                </div>
                                <div class="th_product_detail">
                                    <div class="theme_label">Billing Discount Code :</div>
                                    <div class="product_info product_name">{{ @$data->billing_discount_code ?? 'NA' }}</div>
                                </div>

                                <div class="th_product_detail">
                                    <div class="theme_label">Billing tax :</div>
                                    <div class="product_info product_name">{{ @$data->billing_tax }}</div>
                                </div>

                                <div class="th_product_detail">
                                    <div class="theme_label">Gateway :</div>
                                    <div class="product_info status">{{ @$data->payment_gateway }}</div>
                                </div>

                                <div class="th_product_detail">
                                    <div class="theme_label">Date : </div>
                                    <div class="product_info">{{ @$data->created_at }}</div>
                                </div>

                                <div class="th_product_detail">
                                    <div class="theme_label">Status : </div>
                                    <div class="product_info">{{ @$data->status }}</div>
                                </div>
                                 <li><a href="#" class="tp_delete tp_tooltip" title="Delete"
                                                                onclick="delete_single_details('{{ route('admin.order.destroy', $data->id) }}',{{ $data->id }})"><i
                                                                    class="fa fa-trash" aria-hidden="true"></i>
                                                                    <span class="tp_tooltiptext">
                                                                    <p>Delete</p>
                                                                </span>
                                                            </a>
                                                        </li>

                                <div class="th_product_detail">
                                    <div class="theme_label">Billing Subtotal :</div>
                                    <div class="product_info product_name">{{ @$price_symbol . @$data->billing_subtotal }}
                                    </div>
                                </div>
                                <div class="th_product_detail">
                                    <div class="theme_label">Total : </div>
                                    <div class="product_info">{{ @$price_symbol . @$data->billing_total }}</div>
                                </div>
                            </div>
                            <h3>Order Details</h3>
                            <hr>
                            <div class="table-responsive">
                                <table id="example" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                              <th>Delivery option</th>
                                              
                                        </tr>
                                    </thead>
                                    <tbody>
    @if (@$data->getOrderProduct)
        @php $productCounter = 0; @endphp
        @foreach ($data->getOrderProduct as $key => $items2)
            @foreach ($items2->getProduct as $key3 => $item3)
                @php
                    $variants = !empty($items2->variants) ? unserialize($items2->variants) : null;
                    $hasVariants = !empty($variants);
                    $variantCounter = 0; // Reset variant counter for each product
                @endphp

                @if ($hasVariants)
                    @foreach ($variants as $v_items)
                        <tr>
                            <td>{{ ++$variantCounter }}</td>
                            <td>{{ $item3->name . ' ' . $v_items['option_name'] }}</td>
                            <td>{{ @$price_symbol . @$v_items['price'] }}</td>
                            <td>{{ $items2->delivery_option_name ?? __('Regular Delivery') }} ({{ @$price_symbol. $items2->delivery_option_price ?? __('Regular Delivery') }})</td>
                        </tr>

                        <!-- Display the cover letter in a separate row -->
                        @if ($items2->include_cover_letter)
                            <tr>
                                <td>{{ ++$variantCounter }}</td>
                                <td>Cover Letter</td>
                                <td>{{ @$price_symbol . $items2->cover_letter_price }}</td>
                                <td>{{ $items2->delivery_option_name ?? __('Regular Delivery') }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td>{{ ++$productCounter }}</td>
                        <td>{{ $item3->name }}</td>
                        <td>{{ @$price_symbol . @$item3->price }}</td>
                        <td>{{ $items2->delivery_option_name ?? __('Regular Delivery') }}</td>
                    </tr>

                    <!-- Display the cover letter in a separate row -->
                    @if ($items2->include_cover_letter)
                        <tr>
                            <td>{{ ++$productCounter }}</td>
                            <td>Cover Letter</td>
                            <td>{{ @$price_symbol . $items2->cover_letter_price }}</td>
                            <td>{{ $items2->delivery_option_name ?? __('Regular Delivery') }}</td>
                        </tr>
                    @endif
                @endif
            @endforeach
        @endforeach
    @else
        <tr>
            <td colspan="4" class="text-center">No Record Found.</td>
        </tr>
    @endif
</tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

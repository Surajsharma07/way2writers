@php 
$ASSET_URL = asset('user-theme').'/';
$setting = getsetting(); 
@endphp
@extends('frontend.layout.master')
@section('content')
    <!--===Header Section Start===-->
    <div>
    <div style="height: 300px; background-image: url('{{ $ASSET_URL }}assets/images/my_images/images/contact-banner.jpg'); background-position: center;">
        <div style="display: block; padding: 50px; color: #fff; border-radius: 10px; position: relative; width: 100%;">
<h3 style="line-height:20px;text-transform:uppercase;margin-bottom:20px;font-size:28px;font-weight:500;font-family:Poppins;color:rgb(255, 255, 255);margin-top:0px;box-sizing:border-box;">TALK TO A HUMAN</h3><p style="font-size:16px;font-weight:600;margin-top:0px;margin-bottom:16px;box-sizing:border-box;">You are not going to wait on a ridiculously long phone menu when you call us.<br> Your email isn't going to the inbox abyss, never to be read or seen.
    <span style="margin-top:40px;font-size:16px;display:block;font-weight:300;box-sizing:border-box;">At Way2writers.com, we offer exceptional service we'd want to experience ourselves!</span>
</p>
            <h3 class="mt-3 mb-3 text-center">  </h3>
        </div>
    </div>
</div>
    <div class="tp_banner_section tp_single_section">
        <div class="container">
            <div class="tp_banner_heading">
                <h2 style="
    margin: 15px 0 10px;
">@lang('master.header.Contact_Us')</h2>
                <p>
                    @lang('master.contact_us.heading')
                </p>
            </div>
        </div>
    </div>
    <!--===Header Section End===-->
    <!--===Contactus Section Start===-->
    <div class="tp_singlepage_section tp_contact_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-5 align-self-center">
                     <div class="tp_banner_heading">
<h2 class="tp_single_section" style="
    text-align: center;
">Contact Information</h2>            
</div><div class="tp_contact_box">
                        
                        <div class="tp_contact_detail">
                            <p>@lang('master.contact_us.email_address')</p>
                            <span>{{@$setting->company_email}}</span>
                            <span style="display:block;color:rgb(254, 190, 190);font-size:12px;margin-bottom:3px;box-sizing:border-box;">(Please write us in case of any feedback / grievances)</span>
                        </div>
                        <div class="tp_contact_detail">
                            <p>@lang('master.contact_us.number')</p>
                            <span>{{@$setting->company_phone}}</span>
                                                        <span style="display:block;color:rgb(254, 190, 190);font-size:12px;margin-bottom:3px;box-sizing:border-box;"> Call 10 AM - 6 PM
(Except Sat-Sun, State & National Holidays)</span>
                        </div>
                        <div class="tp_contact_detail">
                                                       <div align="center" style="transform:matrix(1, 0, 0, 1, 0, 0);font-size:22px;font-weight:500;box-sizing:border-box;">REACH US</div> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.6886452336707!2d77.11194431508409!3d28.6989589823916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x37b610f2ddb9fba4!2sway2writers.com!5e0!3m2!1sen!2sin!4v1523523688196" width="100%" height="300px" frameborder="0" style="border:0box-sizing:border-box;box-sizing:border-box;" allowfullscreen=""></iframe>

                        </div>

                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-7 align-self-center">
                    <div class="tp_leave_section">
                        <div class="tp_reply_form">
                            <h4>@lang('master.contact_us.here_to_help')</h4>
<form id="update_user_details" action="{{ route('frontend.post-contact-us') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                                    <div class="col-lg-6">
                                        <div class="tp_input_box">
                                            <label>@lang('master.contact_us.name')*</label>
                                            <div class="tp_input">
                                                <input type="text" placeholder="Enter Name" name="name"
                                                class="form-control" id="name" placeholder="Your Name" />
                                            </div>
                                        </div>
                                    </div>
                              <div class="col-lg-6">
                                        <div class="tp_input_box">
                                            <label>@lang('master.contact_us.email')*</label>
                                            <div class="tp_input">
                                                <input type="email" name="email" id="email" placeholder="Your Email"
                                                placeholder="Enter Email" />
                                            </div>
                                        </div>
                                    </div>
                             <div class="col-lg-6">
                                        <div class="tp_input_box">
                                            <label>@lang('Mobile No. *')</label>
                                            <div class="tp_input">
                                                <input type="text" placeholder="Enter Mobile Number" name="mobile"
                                                class="form-control" id="name" placeholder="Your Name" />
                                            </div>
                                        </div>
                                    </div>
                             <div class="col-lg-6">
                                        <label class="mb-2">Upload  your resume<sup></sup></label>
                                        <input type="file" class="form-control" name="file" id='file'
                                          placeholder="Upload image">
                                           <p>PDF,DOCX,PPT,XLS/X only. Max file size could be 2MB. </p>
                                            <div class="tp_form_wrapper mt-2">
                                            </div>
                                    </div>
                                </div>
                        
                             <div class="col-lg-12">
                                        <div class="tp_input_box">
                                            <label>@lang('master.contact_us.message')</label>
                                            <div class="tp_input">
                                                <textarea name="message" rows="5" placeholder="Message" placeholder="Enter Message"></textarea>
                                            </div>
                                        </div>
                            <div class="tp_addpages_btn">
                                <button type="submit" class="tp_btn" id="pages-post-form-btn">Send</button>
                            </div>
                        </div>
                         <p>We normally respond within 24 working hours.</p>
                    </form>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    <!--===Contactus Section End===-->
@endsection
@section('scripts')
    <script src="{{asset('user-theme/my_assets/js/validation.js')}}"></script>
@endsection

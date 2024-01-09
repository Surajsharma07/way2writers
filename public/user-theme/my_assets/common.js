/**
* set csrf token in header
*/
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    "use strict";
    //Remove toaster message
    $(document).on('click', '.tp_close_icon', function () {
        $(document).find('#msg-toast').html("");
    })

    $(document).on('click', '.watchlist_btn', function () {
        if ($(this).find('.fa-heart').hasClass('active'))
            $(this).find('.fa-heart').removeClass('active');
        else
            $(this).find('.fa-heart').addClass('active');
    });

    //Submit newsletter ajax function
    $("#newsletter_form").submit(function(e){
        e.preventDefault();
        var postData = $('#newsletter_form').serializeArray();
        add_update_details('newsletter_form', postData, 0);
    });

    //show hide password
    $(".toggle-password").click(function () {
        var eyeslash = ASSET_URL + 'assets/images/auth/password.svg';
        var eye = ASSET_URL + 'assets/images/auth/eye.svg';
        var input = $(this).siblings('input');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).attr('src', eye);
        } else {
            input.attr("type", "password");
            $(this).attr('src', eyeslash);
        }
    });
    
});

//Error Message toster
function error_message(msg) {
    var html = `<div class="tp_error_msg toster_open">
    <div class="tp_close_icon">
        <span>×</span>
    </div>
    <div class="tp_success_flex">
        <div class="tp_happy_img">
            <img src="`+ SAD_STRIKER +`" alt="Sad Striker" />
        </div>
        <div class="tp_yeah">
            <h5>Ooops,</h5>
            <p>`+ msg + `</p>
        </div>
    </div>
</div>`;
    $(document).find('#msg-toast').html(html);

    setTimeout(() => {
        $(document).find('#msg-toast').html("");
    }, 2000);
}

//Success Message toster
function success_message(msg = "", url = "", reload = "") {
    var html = `<div class="tp_success_msg toster_open">
        <div class="tp_close_icon">
            <span>×</span>
        </div>
        <div class="tp_success_flex">
            <div class="tp_happy_img">
                <img src="`+ HAPPY_STRIKER + `" alt="Happy striker" />
            </div>
            <div class="tp_yeah">
                <h5>Great Success!</h5>
                <p>`+ msg + `</p>
            </div>
        </div>
    </div>`;
    $(document).find('#msg-toast').html(html);

    if (url != "") {
        setTimeout(() => {
            window.location.href = url;
        }, 1000);
    }
    else if (reload == 1) {
        setTimeout(() => {
            location.reload();
        }, 1000);
    } else {
        setTimeout(() => {
            $(document).find('#msg-toast').html("");
        }, 2000);
    }

}

function addToCart(slug = "", buy_now = "") {
    // Create an empty postData object
    var postData = {};

    // Get the value of the slug input field
    postData.slug = $('#add-to-card-form input[name="slug"]').val();

    // Add additional data (delivery option and include cover letter) to postData
    postData.include_cover_letter = $('#add-to-card-form input[name="include_cover_letter"]').is(':checked') ? 1 : 0;

    // Retrieve the selected delivery option value
    postData.delivery_option = $('input[name="delivery_option"]:checked').val();

    // Get the values of the checked checkboxes with name price_id[]
    postData.price_id = $('input[name="price_id[]"]:checked').map(function(){
        return $(this).val();
    }).get();

    // If buy_now is specified, add it to postData
    if (buy_now != "") {
        postData.buy_now = 1;
    }
    // Check if at least one price_id is selected
    if (postData.price_id.length === 0) {
        console.error("Please select at least one price.");
        return; // Stop the function execution
    }
    
    // Make the AJAX request
    $.ajax({
        url: BASE_URL + "cart",
       
        type: 'POST',
        dataType: 'JSON',
        data: postData,
        success: function (response) {
            var responseJSON = response;
            if (responseJSON.status == true) {
                success_message(responseJSON.msg, responseJSON.url);
            } else {
                error_message(responseJSON.msg);
            }
        },
        error: function (response) {
            var responseJSON = response.responseJSON;
            error_message(responseJSON.msg);
        }
    });
}



//Common add update function 
function add_update_details(form_id, postData = "", refresh_status = 1) {
    var url = $('#' + form_id).attr('action');
    let form_btn_id = form_id + '_btn';
    $(document).find('#' + form_btn_id).buttonLoader('start');
    $(document).find('#' + form_btn_id).prop('disabled', true);

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'JSON',
        data: postData,
        cache: false,
        success: function (response) {
            $('#' + form_btn_id).prop('disabled', false);
            $('#' + form_btn_id).buttonLoader('stop');
            var responseJSON = response;
            
            if(refresh_status == 0){
                $('#' + form_id).find("input").val("");
                $('#' + form_id).find("textarea").val("");
            }
            
            if (responseJSON.status == true) {
                success_message(responseJSON.msg, responseJSON.url ?? '', refresh_status);
            }
            else {
                error_message(responseJSON.msg);
            }

        },
        error: function (response) {
            $('#' + form_btn_id).prop('disabled', false);
            $('#' + form_btn_id).buttonLoader('stop');
            var responseJSON = response.responseJSON;
            if (responseJSON.status == true) {
                success_message(responseJSON.msg);
            }
            else {
                error_message(responseJSON.msg);
            }
        }
    });
}
//Coupon Submit 
function couponCodeApply(form_id) {
    $(document).find('#' + form_id).validate({
        rules: {
            coupon_code: {
                required: true,
            },
        },
        messages: {
            coupon_code: {
                required: 'Please Enter Discount Code.',
            },
        },
        submitHandler: function (form) {
            var postData = $('#' + form_id).serializeArray();
            add_update_details(form_id, postData, 1);
        }
    });
}

//validate checkout 
function validatecheckout(form_id) {
    $(document).find('#' + form_id).validate({
        rules: {
            gateway: {
                required: true,
            },
        },
        messages: {
            gateway: {
                required: 'Please select any gateway.',
            },
        },
        submitHandler: function (form) {
            $(document).find('#' + form_id + '_btn').buttonLoader('start');
            $(document).find('#' + form_id + '_btn').prop('disabled', true);
            $('#' + form_id + '_btn').attr('disabled', 'disabled');
            form.submit();
        }
    });
}

/**
* add to wishlist common function
*/
function addtoWishlist(slug) {
    var _url = BASE_URL + "cart/add-to-wishlist";
    $.ajax({
        url: _url,
        type: 'POST',
        dataType: 'JSON',
        data: { 'slug': slug },
        success: function (response) {
            var responseJSON = response;
            if (responseJSON.status == true) {
                success_message(responseJSON.msg, responseJSON.url, 0);

            } else {
                error_message(responseJSON.msg);
            }
        },
        error: function (response) {
            var responseJSON = response.responseJSON;
            error_message(responseJSON.msg);
        }
    });

}




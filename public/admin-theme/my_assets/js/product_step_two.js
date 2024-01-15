
$(document).ready(function () {
    "use strict";

    var priceCount = parseInt($('#price-count').val());  //price count
    var fileCount = parseInt($('#file-count').val()); //file count
   

    $(document).find('#product-sec-step-form').validate({
        rules: {
        },
        messages: {
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            add_update_details_with_img("product-sec-step-form", formData);
        }
    });

    $('#is_enable_multi_price').click(function() {
        var html = "";
        if ($(this).is(":checked")) {
            $('.price-option').removeClass('d-none');
            $('#single_price_card').addClass('d-none');
            $('#multi_price_card').removeClass('d-none');
            set_product_offer();
            add_price_in_file();
            $('select').select2();
        } else {
            $('.price-option').addClass('d-none');
            $('#single_price_card').removeClass('d-none');
            $('#multi_price_card').addClass('d-none');
            set_product_offer();
        }
    })

    $(document).on('click', '#add_more_price', function() {
        var html = $('#product-fields').clone().find("input").val("").end();
        html.find('input[type=radio]').prop("checked", false);
        html.find('input[type=radio]').removeAttr('checked');
        html.find('input[type=hidden]').val('0');
        html.find('input[type=radio]').val('1');
        $('#price-body').append(html);
        priceCount++;
    });

    $(document).on('click', '#add_new_file', function() {
        var html = $('#file-fields').clone().find("input").val("").end();
        html.find('.file-url-fu').text('');
        html.find('.select2').remove();
        $('#file-body').append(html);
        fileCount++;
        $('select').select2();
    });

    $(document).on('click', '#remove_price', function() {
        if (priceCount == 1)
            $('#product-fields').find("input").val("");
        else {
            $(this).parent().parent().remove();
            add_price_in_file();
            priceCount--;
        }
    });

    $(document).on('click', '#remove_file', function() {
        if (fileCount == 1) {
            $('#file-fields').find("input").val("");
            $('#file-fields').find('.file-url-fu').text('');
        } else {
            $(this).parent().remove();
            fileCount--;
        }
    });

    $(document).on('change', '#file_type', function() {
        if ($(this).val() == 1) {
            $('#bundle-card').removeClass('d-none');
            $('#single-card').addClass('d-none');
        } else {
            $('#bundle-card').addClass('d-none');
            $('#single-card').removeClass('d-none');

        }
    });

    $('#product_image').change(function() {
        var file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                var html = '<img src ="' + event.target.result +
                    '" alt="prouduct image" class="product-step2img">';
                $('#product_image_prev').html(html);
                $('#product_image_prev').removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    $(document).ready(function() {
        $("#product_multi_images").on("change", function(e) {
            $('#product_multi_images_prev').html("");
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    var html = `<div class="col-md-2 ">
                                    <div class="tp_proimg_multisel">
                                        <img src="` + e.target.result + `">
                                    </div>
                                </div>`;
                    $('#product_multi_images_prev').append(html);
                    $('.tp_proimg2_multi').removeClass('d-none');

                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });

    });

})

function set_product_offer() {
    if ($('#is_offer').val() != "") {
        $('#prod-offer-div').removeClass('d-none');
        $('.offer-price-op').removeClass('d-none');
    } else {
        $('.offer-price-op').addClass('d-none');
        $('#prod-offer-div').addClass('d-none');
    }
 

    if ($('#is_offer').val() == 1) {
        if ($('#is_enable_multi_price').is(":checked")) {
            $('.offer-price-op').removeClass('d-none');
            $('.p-of-p').hide();
            $('.s-sale').hide();
        } else {
            $('.s-sale').hide();
            $('.p-of-p').show();
        }
    } else if ($('#is_offer').val() == 2) {
        if ($('#is_enable_multi_price').is(":checked")) {
            $('.offer-price-op').removeClass('d-none');
            $('.s-sale').removeClass('d-none');
            $('.s-sale').show();
            $('.p-of-p').hide();
        } else {
            $('.s-sale').removeClass('d-none');
            $('.s-sale').show();
        }
    }
}

function add_price_in_file() {
    $('.file_price_append').html('');
    $('input[name="option_name[]"]').map(function(idx, ele) {
        if (idx == 0) {
            $('.file_price_append').append(`<option value="ALL">ALL</option>`)
        }
        if ($(ele).val() != "") {
            optionText = $(ele).val();
            optionValue = (idx + 1);
            $('.file_price_append').append(`<option value="${optionValue}">
                    ${optionText}
                </option>`)
        }
    }).get();
}



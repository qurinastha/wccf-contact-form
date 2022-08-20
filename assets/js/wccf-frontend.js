jQuery(document).ready(function ($) {
    $('body').on('submit', '.wccf-form', function (e) {
        var selector = $(this);
        e.preventDefault();
        var name_field = selector.find('.wccf-name-field').val();
        var email_field = selector.find('.wccf-email-field').val();
        var message_field = selector.find('.wccf-message-field').val();
        $.ajax({
            type: 'post',
            url: wccf_js_obj.ajax_url,
            data: {
                action: 'wccf_ajax_action',
                name_field: name_field,
                email_field: email_field,
                message_field: message_field,
                _wpnonce: wccf_js_obj.ajax_nonce
            },
            beforeSend: function (xhr) {
                selector.find('.wccf-ajax-loader').show();
            },
            success: function (res) {
                selector.find('.wccf-ajax-loader').hide();
                res = $.parseJSON(res);
                selector.find('.wccf-message-wrap').last().html(res.message).show();
                if (res.status == 200) {
                    selector[0].reset();
                }

            }
        });

    });
});
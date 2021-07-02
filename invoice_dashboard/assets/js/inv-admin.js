$(document).ready(function() {

    $('li.nav-item a').click(function() {
        let status = $(this).data('invstatus');
        let formData = { action: 'get_invdash', status: status };
        ajaxLoad(formData);

    }).eq(0).click();

    function ajaxLoad(formData) {
        jQuery.ajax({
            type: "post",
            dataType: "html",
            url: invdash_ajax.ajax_url,
            data: formData,
            beforeSend: function() {
                $(".image-overlayload").show();
            },
            success: function(response) {
                $(".image-overlayload").hide();
                $('.inv-contentTable').html(response);
            }
        });
    }

    $('image.downloadinvoice').click(function() {
        alert('This feature is coming soon.');
    });
});
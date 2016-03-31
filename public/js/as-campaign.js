$(document).ready(function() {
    var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
    $('.campaign-thanks').click(function(e) {
        e.preventDefault();
        $("body").append(appendthis);
        $(".modal-overlay").fadeTo(500, 0.7);
        //$(".js-modalbox").fadeIn(500);
        /*var modalBox = $(this).attr('data-modal-id');
        alert(modalbox);*/
        $('#mutual-funds').fadeIn($(this).data());
    });
    //$('.campaign-thanks').trigger('click');
    $(".js-modal-close, .modal-overlay").click(function() {
        $(".modal-box, .modal-overlay").fadeOut(500, function() {
            $(".modal-overlay").remove();
        });
    });
});

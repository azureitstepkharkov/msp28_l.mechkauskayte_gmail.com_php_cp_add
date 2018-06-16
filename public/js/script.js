
$(function ($) {
    $('[data-toggle=confirmation]').click(
        function (e) {
            e.preventDefault();
            let $form = $(this).closest("form");
            //$form.submit();
            alertify.submitForm = $form;
            alertify.confirm($(this).data("title"), $(this).data("content"),
                function () {

                    alertify.submitForm.submit();
                    alertify.success('Ok')

                }
                , function () {
                }
            );

        });

    setBodyMinHeight();


});

function setBodyMinHeight() {
    let bodyHeight = $('body').height();
    let windowHeight = $(window).height();
    if (bodyHeight < windowHeight)
    {
        $('body').height(windowHeight);
        $('footer.main_footer').css("position", "absolute");
        $('footer.main_footer1').css({position: "absolute", marginBottom : "62px"});
    }

}
$(document).ready(function () {
    $('td.actions a.jq-delete').click(function (event) {
        var $that = $(this);
        event.preventDefault();
        $('body').append('<div class="jq-modal_confirm">' + i18n.modal.delete.text + '</div>');
        $(".jq-modal_confirm").dialog({
            resizable:false,
            modal:true,
            buttons:{
                Confirm:function () {
                    $(this).dialog("close");
                    $(this).remove();
                    window.location.replace($that.attr('href'));
                },
                Cancel:function () {
                    $(this).dialog("close");
                    $(this).remove();
                }
            }
        });
    });
});

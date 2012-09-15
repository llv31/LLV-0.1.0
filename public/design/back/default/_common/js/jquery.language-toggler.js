$(document).ready(function () {
    $('form select#language')
        .change(function () {
            togglerLanguage($('form.i18ned'), $(this).val());
        })
        .change();
});

function togglerLanguage($targetForm, locale) {
    $targetForm.find('.jq-lang').parents('p').hide();
    $('.jq-lang').each(function (index, that) {
        var $that = $(that);
        if ($that.data('language') == locale) {
            $that.parents('p').show();
            /** Hotfix nice-edit */
            $('p.textarea_element > div').css('width','894px');
            $('.nicEdit-main').css('width','894px').css('min-height','351px');
        }
    });
}
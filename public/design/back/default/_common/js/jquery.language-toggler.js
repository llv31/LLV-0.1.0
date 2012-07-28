$(document).ready(function () {
    $('form select#language')
        .change(function () {
            togglerLanguage($('form#cms_page'), $(this).val());
        })
        .change();
});

function togglerLanguage($targetForm, locale) {
    $targetForm.find('p:not(.submit_element)').hide();
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
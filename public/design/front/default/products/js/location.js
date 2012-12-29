$(document).ready(function () {
    $('table tr.jq-semaine').hover(function () {
        var $that = $(this);
        $('body').append('<span class="prix_location">' + $that.data('infobulle') + '</span>');
    },function () {
        $('span.prix_location').remove();
    }).mousemove(function (e) {
            var $infobulle = $('span.prix_location');
            $infobulle.css('left', (e.pageX + 10)).css('top', (e.pageY + 10));
        });

});
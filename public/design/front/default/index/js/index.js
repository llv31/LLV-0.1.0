$(document).ready(function () {
    $('.jq-carrousel').slides({
        preload:true,
        preloadImage:'../../_plugin/carrousel/img/loading.gif',
        play:5000,
        pause:2500,
        hoverPause:true,
        animationStart:function (current) {
            $('.caption').animate({
                bottom:-35
            }, 100);
        },
        animationComplete:function (current) {
            $('.caption').animate({
                bottom:0
            }, 200);
        },
        slidesLoaded:function () {
            $('.caption').animate({
                bottom:0
            }, 200);
        }
    })
});
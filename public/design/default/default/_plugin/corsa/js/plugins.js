$(document).ready(function () {
    "use strict";
//    $.magnificPopup && ($(".w-gallery-tnails-h").magnificPopup(
//        {
//            type:"image",
//            delegate:"a",
//            gallery:{
//                enabled:1,
//                navigateByImgClick:1,
//                preload:[0, 1]
//            },
//            removalDelay:300,
//            fixedBgPos:1,
//            fixedContentPos:0,
//            mainClass:"mfp-fade",
//            disableOn:400
//        }
//    ),
//        $("a[ref=magnificPopup][class!=direct-link]").magnificPopup(
//            {
//                type:"image"
//            }
//        )
//        ),
//        $().carousello && $(".w-clients.type_carousel").carousello({use3d:!1, resizeDelay:100}), $(".contacts_form").each(function () {
//        $(this).find(".g-form").submit(function () {
//            var e = $(this), t, n, r, i = e.find("input[name=name]"), s = e.find("input[name=email]"), o = e.find("input[name=phone]"), u = e.find("textarea[name=message]").val(), a = 0;
//            return i.length && (t = i.val()), s.length && (n = s.val()), o.length && (r = o.val()), a === 0 && $.ajax(
//                {type:"POST",
//                    url:"send_contact.php",
//                    dataType:"json",
//                    data:{
//                        action:"sendContact",
//                        name:t,
//                        email:n,
//                        phone:r,
//                        message:u
//                    },
//                    success:function (t) {
//                t.success ? ($.jGrowl("Message Sent!"), i.length && i.val(""), s.length && s.val(""), o.length && o.val(""), e.find("textarea[name=message]").val("")) : (t.errors.name !== "" && t.errors.name !== undefined && $.jGrowl(t.errors.name), t.errors.email !== "" && t.errors.email !== undefined && $.jGrowl(t.errors.email), t.errors.phone !== "" && t.errors.phone !== undefined && $.jGrowl(t.errors.phone), t.errors.message !== "" && t.errors.message !== undefined && $.jGrowl(t.errors.message), t.errors.sending !== "" && t.errors.sending !== undefined && $.jGrowl(t.errors.sending))
//            }, error:function () {
//            }}), !1
//        })
//    }),
    $().waypoint && $(".w-counter").waypoint(function () {
        var e = $(this).find(".w-counter-number"), t = parseInt(e.text(), 10), n = 0, r = Math.ceil(t / 25), i = setInterval(function () {
            n += r, e.text(n), n >= t && (e.text(t), window.clearInterval(i))
        }, 40)
    }, {offset:"85%", triggerOnce:!0}), $(".l-preloader").length && ($("body").queryLoader2({percentage:!0}), $(window).load(function () {
        $(".l-preloader-counter").text("100%"), $(".l-preloader-bar").stop().animate({height:"100%"}, 200), window.setTimeout(function () {
            $(".l-preloader").animate({height:0}, 300, function () {
                $(".l-preloader").remove(), $("#qLimageContainer").remove()
            })
        }, 200)
    })), $(window).load(function () {
        $(".no-touch .l-subsection.with_parallax").each(function () {
            $(this).parallax("50%", "0.3")
        })
    }), $(".flexslider").each(function () {
        var e = $(this);
        if (e.closest(".w-portfolio-item-details-h").length) {
            console.log(1);
            return
        }
        e.flexslider({directionalNav:!0, controlNav:!1, smoothHeight:!0, start:function () {
            e.removeClass("flex-loading")
        }})
    })
});
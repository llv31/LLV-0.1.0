/*
 * QueryLoader v2 - A simple script to create a preloader for images
 *
 * For instructions read the original post:
 * http://www.gayadesign.com/diy/queryloader2-preload-your-images-with-ease/
 *
 * Copyright (c) 2011 - Gaya Kessler
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Version:  2.5
 * Last update: 15-09-2013
 *
 */
(function (e) {
    e.queryLoader2 = function (t, n) {
        var r = this;
        r.$el = e(t), r.el = t, r.$el.data("queryLoader2", r), r.qLimageContainer = "", r.qLoverlay = "", r.qLbar = "", r.qLpercentage = "", r.qLimages = [], r.qLbgimages = [], r.qLimageCounter = 0, r.qLdone = 0, r.qLdestroyed = !1, r.init = function () {
            r.options = e.extend({}, e.queryLoader2.defaultOptions, n), r.findImageInElement(r.el), r.options.deepSearch == 1 && r.$el.find("*:not(script)").each(function () {
                r.findImageInElement(this)
            }), r.createPreloadContainer(), r.createOverlayLoader()
        }, r.createPreloadContainer = function () {
            r.qLimageContainer = e("<div id='qLimageContainer'></div>").appendTo("body").css({display:"none", width:0, height:0, overflow:"hidden"});
            for (var t = 0; r.qLbgimages.length > t; t++)e.ajax({url:r.qLbgimages[t], type:"HEAD", complete:function (e) {
                r.qLdestroyed || r.addImageForPreload(this.url)
            }})
        }, r.addImageForPreload = function (t) {
            var n = e("<img />").attr("src", t);
            r.bindLoadEvent(n), n.appendTo(r.qLimageContainer)
        }, r.createOverlayLoader = function () {
            r.qLoverlay = e(".l-preloader"), r.qLbar = e("<div class='l-preloader-bar'><span class='disclamer'>Le chargement peut être long la première fois</span></div>").appendTo(r.qLoverlay), r.options.percentage == 1 && (r.qLpercentage = e("<div class='l-preloader-counter'></div>").text("0%").appendTo(r.qLoverlay)), r.qLimages.length || r.destroyContainers()
        }, r.destroyContainers = function () {
            r.qLdestroyed = !0, r.qLimageContainer.remove(), r.qLoverlay.remove()
        }, r.findImageInElement = function (t) {
            var n = "", i = e(t), s = "normal";
            i.css("background-image") != "none" ? (n = i.css("background-image"), s = "background") : typeof i.attr("src") != "undefined" && t.nodeName.toLowerCase() == "img" && (n = i.attr("src"));
            if (n.indexOf("gradient") == -1) {
                n = n.replace(/url\(\"/g, ""), n = n.replace(/url\(/g, ""), n = n.replace(/\"\)/g, ""), n = n.replace(/\)/g, "");
                var o = n.split(", ");
                for (var u = 0; u < o.length; u++)if (o[u].length > 0 && r.qLimages.indexOf(o[u]) == -1 && !o[u].match(/^(data:)/i)) {
                    var a = "";
                    r.isIE() || r.isOpera() ? (a = "?rand=" + Math.random(), r.qLbgimages.push(o[u] + a)) : s == "background" ? r.qLbgimages.push(o[u]) : r.bindLoadEvent(i), r.qLimages.push(o[u])
                }
            }
        }, r.isIE = function () {
            return navigator.userAgent.match(/msie/i)
        }, r.isOpera = function () {
            return navigator.userAgent.match(/Opera/i)
        }, r.bindLoadEvent = function (e) {
            r.qLimageCounter++, e.bind("load error", function () {
                r.completeImageLoading(this)
            })
        }, r.completeImageLoading = function (e) {
            r.qLdone++;
            var t = r.qLdone / r.qLimageCounter * 100;
            r.qLbar.stop().animate({height:t + "%"}, 200), r.options.percentage == 1 && r.qLpercentage.text(Math.ceil(t) + "%"), r.qLdone >= r.qLimageCounter && r.endLoader()
        }, r.endLoader = function () {
            r.qLdestroyed = !0, r.onLoadComplete()
        }, r.onLoadComplete = function () {
            if (r.options.completeAnimation == "grow") {
                var t = 500;
                r.qLbar.stop().animate({height:"100%"}, t, function () {
                    e(this).animate({top:"0%", width:"100%", height:"100%"}, 500, function () {
                        e("#" + r.options.overlayId).fadeOut(500, function () {
                            e(this).remove(), r.destroyContainers(), r.options.onComplete()
                        })
                    })
                })
            } else window.setTimeout(function () {
                e(".l-preloader").animate({height:0}, 300, function () {
                    e("#" + r.options.overlayId).remove(), r.destroyContainers(), r.options.onComplete()
                })
            }, 200)
        }, r.init()
    }, e.queryLoader2.defaultOptions = {onComplete:function () {
    }, backgroundColor:"#000", barColor:"#fff", overlayId:"qLoverlay", barHeight:1, percentage:!1, deepSearch:!0, completeAnimation:"fade", minimumTime:500}, e.fn.queryLoader2 = function (t) {
        return this.each(function () {
            new e.queryLoader2(this, t)
        })
    }
})(jQuery), Array.prototype.indexOf || (Array.prototype.indexOf = function (e) {
    var t = this.length >>> 0, n = Number(arguments[1]) || 0;
    n = n < 0 ? Math.ceil(n) : Math.floor(n), n < 0 && (n += t);
    for (; n < t; n++)if (n in this && this[n] === e)return n;
    return-1
});
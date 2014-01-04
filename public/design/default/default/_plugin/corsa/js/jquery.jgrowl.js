/**
 * jGrowl 1.2.12
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Written by Stan Lemon <stosh1985@gmail.com>
 * Last updated: 2013.02.14
 *
 * jGrowl is a jQuery plugin implementing unobtrusive userland notifications.  These
 * notifications function similarly to the Growl Framework available for
 * Mac OS X (http://growl.info).
 *
 * To Do:
 * - Move library settings to containers and allow them to be changed per container
 *
 * Changes in 1.2.13
 * - Fixed clearing interval when the container shuts down
 *
 * Changes in 1.2.12
 * - Added compressed versions using UglifyJS and Sqwish
 * - Improved README with configuration options explanation
 * - Added a source map
 *
 * Changes in 1.2.11
 * - Fix artifacts left behind by the shutdown method and text-cleanup
 *
 * Changes in 1.2.10
 * - Fix beforeClose to be called in click event
 *
 * Changes in 1.2.9
 * - Fixed BC break in jQuery 2.0 beta
 *
 * Changes in 1.2.8
 * - Fixes for jQuery 1.9 and the MSIE6 check, note that with jQuery 2.0 support
 *   jGrowl intends to drop support for IE6 altogether
 *
 * Changes in 1.2.6
 * - Fixed js error when a notification is opening and closing at the same time
 *
 * Changes in 1.2.5
 * - Changed wrapper jGrowl's options usage to "o" instead of $.jGrowl.defaults
 * - Added themeState option to control 'highlight' or 'error' for jQuery UI
 * - Ammended some CSS to provide default positioning for nested usage.
 * - Changed some CSS to be prefixed with jGrowl- to prevent namespacing issues
 * - Added two new options - openDuration and closeDuration to allow
 *   better control of notification open and close speeds, respectively
 *   Patch contributed by Jesse Vincet.
 * - Added afterOpen callback.  Patch contributed by Russel Branca.
 *
 * Changes in 1.2.4
 * - Fixed IE bug with the close-all button
 * - Fixed IE bug with the filter CSS attribute (special thanks to gotwic)
 * - Update IE opacity CSS
 * - Changed font sizes to use "em", and only set the base style
 *
 * Changes in 1.2.3
 * - The callbacks no longer use the container as context, instead they use the actual notification
 * - The callbacks now receive the container as a parameter after the options parameter
 * - beforeOpen and beforeClose now check the return value, if it's false - the notification does
 *   not continue.  The open callback will also halt execution if it returns false.
 * - Fixed bug where containers would get confused
 * - Expanded the pause functionality to pause an entire container.
 *
 * Changes in 1.2.2
 * - Notification can now be theme rolled for jQuery UI, special thanks to Jeff Chan!
 *
 * Changes in 1.2.1
 * - Fixed instance where the interval would fire the close method multiple times.
 * - Added CSS to hide from print media
 * - Fixed issue with closer button when div { position: relative } is set
 * - Fixed leaking issue with multiple containers.  Special thanks to Matthew Hanlon!
 *
 * Changes in 1.2.0
 * - Added message pooling to limit the number of messages appearing at a given time.
 * - Closing a notification is now bound to the notification object and triggered by the close button.
 *
 * Changes in 1.1.2
 * - Added iPhone styled example
 * - Fixed possible IE7 bug when determining if the ie6 class shoudl be applied.
 * - Added template for the close button, so that it's content could be customized.
 *
 * Changes in 1.1.1
 * - Fixed CSS styling bug for ie6 caused by a mispelling
 * - Changes height restriction on default notifications to min-height
 * - Added skinned examples using a variety of images
 * - Added the ability to customize the content of the [close all] box
 * - Added jTweet, an example of using jGrowl + Twitter
 *
 * Changes in 1.1.0
 * - Multiple container and instances.
 * - Standard $.jGrowl() now wraps $.fn.jGrowl() by first establishing a generic jGrowl container.
 * - Instance methods of a jGrowl container can be called by $.fn.jGrowl(methodName)
 * - Added glue preferenced, which allows notifications to be inserted before or after nodes in the container
 * - Added new log callback which is called before anything is done for the notification
 * - Corner's attribute are now applied on an individual notification basis.
 *
 * Changes in 1.0.4
 * - Various CSS fixes so that jGrowl renders correctly in IE6.
 *
 * Changes in 1.0.3
 * - Fixed bug with options persisting across notifications
 * - Fixed theme application bug
 * - Simplified some selectors and manipulations.
 * - Added beforeOpen and beforeClose callbacks
 * - Reorganized some lines of code to be more readable
 * - Removed unnecessary this.defaults context
 * - If corners plugin is present, it's now customizable.
 * - Customizable open animation.
 * - Customizable close animation.
 * - Customizable animation easing.
 * - Added customizable positioning (top-left, top-right, bottom-left, bottom-right, center)
 *
 * Changes in 1.0.2
 * - All CSS styling is now external.
 * - Added a theme parameter which specifies a secondary class for styling, such
 *   that notifications can be customized in appearance on a per message basis.
 * - Notification life span is now customizable on a per message basis.
 * - Added the ability to disable the global closer, enabled by default.
 * - Added callbacks for when a notification is opened or closed.
 * - Added callback for the global closer.
 * - Customizable animation speed.
 * - jGrowl now set itself up and tears itself down.
 *
 * Changes in 1.0.1:
 * - Removed dependency on metadata plugin in favor of .data()
 * - Namespaced all events
 */(function(e){var t=function(){return!1===e.support.boxModel&&e.support.objectAll&&e.support.leadingWhitespace}();e.jGrowl=function(t,n){e("#jGrowl").size()==0&&e('<div id="jGrowl"></div>').addClass(n&&n.position?n.position:e.jGrowl.defaults.position).appendTo("body"),e("#jGrowl").jGrowl(t,n)},e.fn.jGrowl=function(t,n){if(e.isFunction(this.each)){var r=arguments;return this.each(function(){e(this).data("jGrowl.instance")==undefined&&(e(this).data("jGrowl.instance",e.extend(new e.fn.jGrowl,{notifications:[],element:null,interval:null})),e(this).data("jGrowl.instance").startup(this)),e.isFunction(e(this).data("jGrowl.instance")[t])?e(this).data("jGrowl.instance")[t].apply(e(this).data("jGrowl.instance"),e.makeArray(r).slice(1)):e(this).data("jGrowl.instance").create(t,n)})}},e.extend(e.fn.jGrowl.prototype,{defaults:{pool:0,header:"",group:"",sticky:!1,position:"center",glue:"after",theme:"default",themeState:"highlight",corners:"10px",check:250,life:3e3,closeDuration:"normal",openDuration:"normal",easing:"swing",closer:!1,closeTemplate:"&#10005;",closerTemplate:"<div>[ close all ]</div>",log:function(){},beforeOpen:function(){},afterOpen:function(){},open:function(){},beforeClose:function(){},close:function(){},animateOpen:{opacity:"show"},animateClose:{opacity:"hide"}},notifications:[],element:null,interval:null,create:function(t,n){var n=e.extend({},this.defaults,n);typeof n.speed!="undefined"&&(n.openDuration=n.speed,n.closeDuration=n.speed),this.notifications.push({message:t,options:n}),n.log.apply(this.element,[this.element,t,n])},render:function(t){var n=this,r=t.message,i=t.options;i.themeState=i.themeState==""?"":"ui-state-"+i.themeState;var t=e("<div/>").addClass("jGrowl-notification "+i.themeState+" ui-corner-all"+(i.group!=undefined&&i.group!=""?" "+i.group:"")).append(e("<div/>").addClass("jGrowl-close").html(i.closeTemplate)).append(e("<div/>").addClass("jGrowl-header").html(i.header)).append(e("<div/>").addClass("jGrowl-message").html(r)).data("jGrowl",i).addClass(i.theme).children("div.jGrowl-close").bind("click.jGrowl",function(){e(this).parent().trigger("jGrowl.beforeClose")}).parent();e(t).bind("mouseover.jGrowl",function(){e("div.jGrowl-notification",n.element).data("jGrowl.pause",!0)}).bind("mouseout.jGrowl",function(){e("div.jGrowl-notification",n.element).data("jGrowl.pause",!1)}).bind("jGrowl.beforeOpen",function(){i.beforeOpen.apply(t,[t,r,i,n.element])!==!1&&e(this).trigger("jGrowl.open")}).bind("jGrowl.open",function(){i.open.apply(t,[t,r,i,n.element])!==!1&&(i.glue=="after"?e("div.jGrowl-notification:last",n.element).after(t):e("div.jGrowl-notification:first",n.element).before(t),e(this).animate(i.animateOpen,i.openDuration,i.easing,function(){e.support.opacity===!1&&this.style.removeAttribute("filter"),e(this).data("jGrowl")!==null&&(e(this).data("jGrowl").created=new Date),e(this).trigger("jGrowl.afterOpen")}))}).bind("jGrowl.afterOpen",function(){i.afterOpen.apply(t,[t,r,i,n.element])}).bind("jGrowl.beforeClose",function(){i.beforeClose.apply(t,[t,r,i,n.element])!==!1&&e(this).trigger("jGrowl.close")}).bind("jGrowl.close",function(){e(this).data("jGrowl.pause",!0),e(this).animate(i.animateClose,i.closeDuration,i.easing,function(){e.isFunction(i.close)?i.close.apply(t,[t,r,i,n.element])!==!1&&e(this).remove():e(this).remove()})}).trigger("jGrowl.beforeOpen"),i.corners!=""&&e.fn.corner!=undefined&&e(t).corner(i.corners),e("div.jGrowl-notification:parent",n.element).size()>1&&e("div.jGrowl-closer",n.element).size()==0&&this.defaults.closer!==!1&&e(this.defaults.closerTemplate).addClass("jGrowl-closer "+this.defaults.themeState+" ui-corner-all").addClass(this.defaults.theme).appendTo(n.element).animate(this.defaults.animateOpen,this.defaults.speed,this.defaults.easing).bind("click.jGrowl",function(){e(this).siblings().trigger("jGrowl.beforeClose"),e.isFunction(n.defaults.closer)&&n.defaults.closer.apply(e(this).parent()[0],[e(this).parent()[0]])})},update:function(){e(this.element).find("div.jGrowl-notification:parent").each(function(){e(this).data("jGrowl")!=undefined&&e(this).data("jGrowl").created!==undefined&&e(this).data("jGrowl").created.getTime()+parseInt(e(this).data("jGrowl").life)<(new Date).getTime()&&e(this).data("jGrowl").sticky!==!0&&(e(this).data("jGrowl.pause")==undefined||e(this).data("jGrowl.pause")!==!0)&&e(this).trigger("jGrowl.beforeClose")}),this.notifications.length>0&&(this.defaults.pool==0||e(this.element).find("div.jGrowl-notification:parent").size()<this.defaults.pool)&&this.render(this.notifications.shift()),e(this.element).find("div.jGrowl-notification:parent").size()<2&&e(this.element).find("div.jGrowl-closer").animate(this.defaults.animateClose,this.defaults.speed,this.defaults.easing,function(){e(this).remove()})},startup:function(n){this.element=e(n).addClass("jGrowl").append('<div class="jGrowl-notification"></div>'),this.interval=setInterval(function(){e(n).data("jGrowl.instance").update()},parseInt(this.defaults.check)),t&&e(this.element).addClass("ie6")},shutdown:function(){e(this.element).removeClass("jGrowl").find("div.jGrowl-notification").trigger("jGrowl.close").parent().empty(),clearInterval(this.interval)},close:function(){e(this.element).find("div.jGrowl-notification").each(function(){e(this).trigger("jGrowl.beforeClose")})}}),e.jGrowl.defaults=e.fn.jGrowl.prototype.defaults})(jQuery);
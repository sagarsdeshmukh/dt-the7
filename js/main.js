// @codekit-append "atoms/plugins/easing.js";
// @codekit-append "atoms/plugins/velocity.min.js";
// @codekit-append "atoms/plugins/ripple.js";
// @codekit-append "atoms/plugins/waves.js";

// @codekit-append "atoms/plugins/pixastic.js";
// @codekit-append "atoms/plugins/mfp.js";
// @codekit-append "atoms/plugins/before-after.js";
// @codekit-append "atoms/plugins/jquery.royal-slider.js";
// @codekit-append "atoms/plugins/parallax.js";
// @codekit-append "atoms/plugins/collagePlus.js";
// @codekit-append "atoms/plugins/hoverdir.js";
// @codekit-append "atoms/plugins/tooltip.js";
// @codekit-append "atoms/plugins/custom-scrollbar.js";
// @codekit-append "atoms/plugins/custom-select.js";
// @codekit-append "atoms/plugins/3d-slideshow.js";
// @codekit-append "atoms/plugins/isotope.js";


// @codekit-append "atoms/retinizer.js";
// @codekit-append "atoms/custom-touch-events.js";
// @codekit-append "atoms/jquery.event.move.js";
// @codekit-append "atoms/in-viewport.js";
// @codekit-append "atoms/element-exists.js";
// @codekit-append "atoms/soc-icons.js";
// @codekit-append "atoms/photo-scroller.js";
// @codekit-append "atoms/photo-slider.js";
// @codekit-append "atoms/shortcode-scroller.js";
// @codekit-append "atoms/header.js";
// @codekit-append "atoms/mobile-header.js";
// @codekit-append "atoms/main-navigation.js";
// @codekit-append "atoms/custom-menu.js";
// @codekit-append "atoms/floating-menu.js";
// @codekit-append "atoms/filter.js";
// @codekit-append "atoms/onepage.js";
// @codekit-append "atoms/royal-slider-initialisation.js";

// @codekit-append "atoms/hovers.js";
// @codekit-append "atoms/forms.js";
// @codekit-append "atoms/fullwidth-row.js";
// @codekit-append "atoms/misc.js";
// @codekit-append "atoms/masonry-initialisation.js";
// @codekit-append "atoms/custom-resize.js";
// @codekit-append "atoms/ajax.js";
// @codekit-append "atoms/dtPostsJQueryFilter.js";




/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
/*if(typeof jQuery.easing["jswing"] === typeof undefined){*/
	jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,t,n,r,i){return jQuery.easing[jQuery.easing.def](e,t,n,r,i)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(e,t,n,r,i){return r-jQuery.easing.easeOutBounce(e,i-t,0,r,i)+n},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(e,t,n,r,i){if(t<i/2)return jQuery.easing.easeInBounce(e,t*2,0,r,i)*.5+n;return jQuery.easing.easeOutBounce(e,t*2-i,0,r,i)*.5+r*.5+n}})/*}*/

/*! VelocityJS.org (1.2.3). (C) 2014 Julian Shapiro. MIT @license: en.wikipedia.org/wiki/MIT_License */
/*! VelocityJS.org jQuery Shim (1.0.1). (C) 2014 The jQuery Foundation. MIT @license: en.wikipedia.org/wiki/MIT_License. */
!function(a){function b(a){var b=a.length,d=c.type(a);return"function"===d||c.isWindow(a)?!1:1===a.nodeType&&b?!0:"array"===d||0===b||"number"==typeof b&&b>0&&b-1 in a}if(!a.jQuery){var c=function(a,b){return new c.fn.init(a,b)};c.isWindow=function(a){return null!=a&&a==a.window},c.type=function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?e[g.call(a)]||"object":typeof a},c.isArray=Array.isArray||function(a){return"array"===c.type(a)},c.isPlainObject=function(a){var b;if(!a||"object"!==c.type(a)||a.nodeType||c.isWindow(a))return!1;try{if(a.constructor&&!f.call(a,"constructor")&&!f.call(a.constructor.prototype,"isPrototypeOf"))return!1}catch(d){return!1}for(b in a);return void 0===b||f.call(a,b)},c.each=function(a,c,d){var e,f=0,g=a.length,h=b(a);if(d){if(h)for(;g>f&&(e=c.apply(a[f],d),e!==!1);f++);else for(f in a)if(e=c.apply(a[f],d),e===!1)break}else if(h)for(;g>f&&(e=c.call(a[f],f,a[f]),e!==!1);f++);else for(f in a)if(e=c.call(a[f],f,a[f]),e===!1)break;return a},c.data=function(a,b,e){if(void 0===e){var f=a[c.expando],g=f&&d[f];if(void 0===b)return g;if(g&&b in g)return g[b]}else if(void 0!==b){var f=a[c.expando]||(a[c.expando]=++c.uuid);return d[f]=d[f]||{},d[f][b]=e,e}},c.removeData=function(a,b){var e=a[c.expando],f=e&&d[e];f&&c.each(b,function(a,b){delete f[b]})},c.extend=function(){var a,b,d,e,f,g,h=arguments[0]||{},i=1,j=arguments.length,k=!1;for("boolean"==typeof h&&(k=h,h=arguments[i]||{},i++),"object"!=typeof h&&"function"!==c.type(h)&&(h={}),i===j&&(h=this,i--);j>i;i++)if(null!=(f=arguments[i]))for(e in f)a=h[e],d=f[e],h!==d&&(k&&d&&(c.isPlainObject(d)||(b=c.isArray(d)))?(b?(b=!1,g=a&&c.isArray(a)?a:[]):g=a&&c.isPlainObject(a)?a:{},h[e]=c.extend(k,g,d)):void 0!==d&&(h[e]=d));return h},c.queue=function(a,d,e){function f(a,c){var d=c||[];return null!=a&&(b(Object(a))?!function(a,b){for(var c=+b.length,d=0,e=a.length;c>d;)a[e++]=b[d++];if(c!==c)for(;void 0!==b[d];)a[e++]=b[d++];return a.length=e,a}(d,"string"==typeof a?[a]:a):[].push.call(d,a)),d}if(a){d=(d||"fx")+"queue";var g=c.data(a,d);return e?(!g||c.isArray(e)?g=c.data(a,d,f(e)):g.push(e),g):g||[]}},c.dequeue=function(a,b){c.each(a.nodeType?[a]:a,function(a,d){b=b||"fx";var e=c.queue(d,b),f=e.shift();"inprogress"===f&&(f=e.shift()),f&&("fx"===b&&e.unshift("inprogress"),f.call(d,function(){c.dequeue(d,b)}))})},c.fn=c.prototype={init:function(a){if(a.nodeType)return this[0]=a,this;throw new Error("Not a DOM node.")},offset:function(){var b=this[0].getBoundingClientRect?this[0].getBoundingClientRect():{top:0,left:0};return{top:b.top+(a.pageYOffset||document.scrollTop||0)-(document.clientTop||0),left:b.left+(a.pageXOffset||document.scrollLeft||0)-(document.clientLeft||0)}},position:function(){function a(){for(var a=this.offsetParent||document;a&&"html"===!a.nodeType.toLowerCase&&"static"===a.style.position;)a=a.offsetParent;return a||document}var b=this[0],a=a.apply(b),d=this.offset(),e=/^(?:body|html)$/i.test(a.nodeName)?{top:0,left:0}:c(a).offset();return d.top-=parseFloat(b.style.marginTop)||0,d.left-=parseFloat(b.style.marginLeft)||0,a.style&&(e.top+=parseFloat(a.style.borderTopWidth)||0,e.left+=parseFloat(a.style.borderLeftWidth)||0),{top:d.top-e.top,left:d.left-e.left}}};var d={};c.expando="velocity"+(new Date).getTime(),c.uuid=0;for(var e={},f=e.hasOwnProperty,g=e.toString,h="Boolean Number String Function Array Date RegExp Object Error".split(" "),i=0;i<h.length;i++)e["[object "+h[i]+"]"]=h[i].toLowerCase();c.fn.init.prototype=c.fn,a.Velocity={Utilities:c}}}(window),function(a){"object"==typeof module&&"object"==typeof module.exports?module.exports=a():"function"==typeof define&&define.amd?define(a):a()}(function(){return function(a,b,c,d){function e(a){for(var b=-1,c=a?a.length:0,d=[];++b<c;){var e=a[b];e&&d.push(e)}return d}function f(a){return p.isWrapped(a)?a=[].slice.call(a):p.isNode(a)&&(a=[a]),a}function g(a){var b=m.data(a,"velocity");return null===b?d:b}function h(a){return function(b){return Math.round(b*a)*(1/a)}}function i(a,c,d,e){function f(a,b){return 1-3*b+3*a}function g(a,b){return 3*b-6*a}function h(a){return 3*a}function i(a,b,c){return((f(b,c)*a+g(b,c))*a+h(b))*a}function j(a,b,c){return 3*f(b,c)*a*a+2*g(b,c)*a+h(b)}function k(b,c){for(var e=0;p>e;++e){var f=j(c,a,d);if(0===f)return c;var g=i(c,a,d)-b;c-=g/f}return c}function l(){for(var b=0;t>b;++b)x[b]=i(b*u,a,d)}function m(b,c,e){var f,g,h=0;do g=c+(e-c)/2,f=i(g,a,d)-b,f>0?e=g:c=g;while(Math.abs(f)>r&&++h<s);return g}function n(b){for(var c=0,e=1,f=t-1;e!=f&&x[e]<=b;++e)c+=u;--e;var g=(b-x[e])/(x[e+1]-x[e]),h=c+g*u,i=j(h,a,d);return i>=q?k(b,h):0==i?h:m(b,c,c+u)}function o(){y=!0,(a!=c||d!=e)&&l()}var p=4,q=.001,r=1e-7,s=10,t=11,u=1/(t-1),v="Float32Array"in b;if(4!==arguments.length)return!1;for(var w=0;4>w;++w)if("number"!=typeof arguments[w]||isNaN(arguments[w])||!isFinite(arguments[w]))return!1;a=Math.min(a,1),d=Math.min(d,1),a=Math.max(a,0),d=Math.max(d,0);var x=v?new Float32Array(t):new Array(t),y=!1,z=function(b){return y||o(),a===c&&d===e?b:0===b?0:1===b?1:i(n(b),c,e)};z.getControlPoints=function(){return[{x:a,y:c},{x:d,y:e}]};var A="generateBezier("+[a,c,d,e]+")";return z.toString=function(){return A},z}function j(a,b){var c=a;return p.isString(a)?t.Easings[a]||(c=!1):c=p.isArray(a)&&1===a.length?h.apply(null,a):p.isArray(a)&&2===a.length?u.apply(null,a.concat([b])):p.isArray(a)&&4===a.length?i.apply(null,a):!1,c===!1&&(c=t.Easings[t.defaults.easing]?t.defaults.easing:s),c}function k(a){if(a){var b=(new Date).getTime(),c=t.State.calls.length;c>1e4&&(t.State.calls=e(t.State.calls));for(var f=0;c>f;f++)if(t.State.calls[f]){var h=t.State.calls[f],i=h[0],j=h[2],n=h[3],o=!!n,q=null;n||(n=t.State.calls[f][3]=b-16);for(var r=Math.min((b-n)/j.duration,1),s=0,u=i.length;u>s;s++){var w=i[s],y=w.element;if(g(y)){var z=!1;if(j.display!==d&&null!==j.display&&"none"!==j.display){if("flex"===j.display){var A=["-webkit-box","-moz-box","-ms-flexbox","-webkit-flex"];m.each(A,function(a,b){v.setPropertyValue(y,"display",b)})}v.setPropertyValue(y,"display",j.display)}j.visibility!==d&&"hidden"!==j.visibility&&v.setPropertyValue(y,"visibility",j.visibility);for(var B in w)if("element"!==B){var C,D=w[B],E=p.isString(D.easing)?t.Easings[D.easing]:D.easing;if(1===r)C=D.endValue;else{var F=D.endValue-D.startValue;if(C=D.startValue+F*E(r,j,F),!o&&C===D.currentValue)continue}if(D.currentValue=C,"tween"===B)q=C;else{if(v.Hooks.registered[B]){var G=v.Hooks.getRoot(B),H=g(y).rootPropertyValueCache[G];H&&(D.rootPropertyValue=H)}var I=v.setPropertyValue(y,B,D.currentValue+(0===parseFloat(C)?"":D.unitType),D.rootPropertyValue,D.scrollData);v.Hooks.registered[B]&&(g(y).rootPropertyValueCache[G]=v.Normalizations.registered[G]?v.Normalizations.registered[G]("extract",null,I[1]):I[1]),"transform"===I[0]&&(z=!0)}}j.mobileHA&&g(y).transformCache.translate3d===d&&(g(y).transformCache.translate3d="(0px, 0px, 0px)",z=!0),z&&v.flushTransformCache(y)}}j.display!==d&&"none"!==j.display&&(t.State.calls[f][2].display=!1),j.visibility!==d&&"hidden"!==j.visibility&&(t.State.calls[f][2].visibility=!1),j.progress&&j.progress.call(h[1],h[1],r,Math.max(0,n+j.duration-b),n,q),1===r&&l(f)}}t.State.isTicking&&x(k)}function l(a,b){if(!t.State.calls[a])return!1;for(var c=t.State.calls[a][0],e=t.State.calls[a][1],f=t.State.calls[a][2],h=t.State.calls[a][4],i=!1,j=0,k=c.length;k>j;j++){var l=c[j].element;if(b||f.loop||("none"===f.display&&v.setPropertyValue(l,"display",f.display),"hidden"===f.visibility&&v.setPropertyValue(l,"visibility",f.visibility)),f.loop!==!0&&(m.queue(l)[1]===d||!/\.velocityQueueEntryFlag/i.test(m.queue(l)[1]))&&g(l)){g(l).isAnimating=!1,g(l).rootPropertyValueCache={};var n=!1;m.each(v.Lists.transforms3D,function(a,b){var c=/^scale/.test(b)?1:0,e=g(l).transformCache[b];g(l).transformCache[b]!==d&&new RegExp("^\\("+c+"[^.]").test(e)&&(n=!0,delete g(l).transformCache[b])}),f.mobileHA&&(n=!0,delete g(l).transformCache.translate3d),n&&v.flushTransformCache(l),v.Values.removeClass(l,"velocity-animating")}if(!b&&f.complete&&!f.loop&&j===k-1)try{f.complete.call(e,e)}catch(o){setTimeout(function(){throw o},1)}h&&f.loop!==!0&&h(e),g(l)&&f.loop===!0&&!b&&(m.each(g(l).tweensContainer,function(a,b){/^rotate/.test(a)&&360===parseFloat(b.endValue)&&(b.endValue=0,b.startValue=360),/^backgroundPosition/.test(a)&&100===parseFloat(b.endValue)&&"%"===b.unitType&&(b.endValue=0,b.startValue=100)}),t(l,"reverse",{loop:!0,delay:f.delay})),f.queue!==!1&&m.dequeue(l,f.queue)}t.State.calls[a]=!1;for(var p=0,q=t.State.calls.length;q>p;p++)if(t.State.calls[p]!==!1){i=!0;break}i===!1&&(t.State.isTicking=!1,delete t.State.calls,t.State.calls=[])}var m,n=function(){if(c.documentMode)return c.documentMode;for(var a=7;a>4;a--){var b=c.createElement("div");if(b.innerHTML="<!--[if IE "+a+"]><span></span><![endif]-->",b.getElementsByTagName("span").length)return b=null,a}return d}(),o=function(){var a=0;return b.webkitRequestAnimationFrame||b.mozRequestAnimationFrame||function(b){var c,d=(new Date).getTime();return c=Math.max(0,16-(d-a)),a=d+c,setTimeout(function(){b(d+c)},c)}}(),p={isString:function(a){return"string"==typeof a},isArray:Array.isArray||function(a){return"[object Array]"===Object.prototype.toString.call(a)},isFunction:function(a){return"[object Function]"===Object.prototype.toString.call(a)},isNode:function(a){return a&&a.nodeType},isNodeList:function(a){return"object"==typeof a&&/^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(a))&&a.length!==d&&(0===a.length||"object"==typeof a[0]&&a[0].nodeType>0)},isWrapped:function(a){return a&&(a.jquery||b.Zepto&&b.Zepto.zepto.isZ(a))},isSVG:function(a){return b.SVGElement&&a instanceof b.SVGElement},isEmptyObject:function(a){for(var b in a)return!1;return!0}},q=!1;if(a.fn&&a.fn.jquery?(m=a,q=!0):m=b.Velocity.Utilities,8>=n&&!q)throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");if(7>=n)return void(jQuery.fn.velocity=jQuery.fn.animate);var r=400,s="swing",t={State:{isMobile:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),isAndroid:/Android/i.test(navigator.userAgent),isGingerbread:/Android 2\.3\.[3-7]/i.test(navigator.userAgent),isChrome:b.chrome,isFirefox:/Firefox/i.test(navigator.userAgent),prefixElement:c.createElement("div"),prefixMatches:{},scrollAnchor:null,scrollPropertyLeft:null,scrollPropertyTop:null,isTicking:!1,calls:[]},CSS:{},Utilities:m,Redirects:{},Easings:{},Promise:b.Promise,defaults:{queue:"",duration:r,easing:s,begin:d,complete:d,progress:d,display:d,visibility:d,loop:!1,delay:!1,mobileHA:!0,_cacheValues:!0},init:function(a){m.data(a,"velocity",{isSVG:p.isSVG(a),isAnimating:!1,computedStyle:null,tweensContainer:null,rootPropertyValueCache:{},transformCache:{}})},hook:null,mock:!1,version:{major:1,minor:2,patch:2},debug:!1};b.pageYOffset!==d?(t.State.scrollAnchor=b,t.State.scrollPropertyLeft="pageXOffset",t.State.scrollPropertyTop="pageYOffset"):(t.State.scrollAnchor=c.documentElement||c.body.parentNode||c.body,t.State.scrollPropertyLeft="scrollLeft",t.State.scrollPropertyTop="scrollTop");var u=function(){function a(a){return-a.tension*a.x-a.friction*a.v}function b(b,c,d){var e={x:b.x+d.dx*c,v:b.v+d.dv*c,tension:b.tension,friction:b.friction};return{dx:e.v,dv:a(e)}}function c(c,d){var e={dx:c.v,dv:a(c)},f=b(c,.5*d,e),g=b(c,.5*d,f),h=b(c,d,g),i=1/6*(e.dx+2*(f.dx+g.dx)+h.dx),j=1/6*(e.dv+2*(f.dv+g.dv)+h.dv);return c.x=c.x+i*d,c.v=c.v+j*d,c}return function d(a,b,e){var f,g,h,i={x:-1,v:0,tension:null,friction:null},j=[0],k=0,l=1e-4,m=.016;for(a=parseFloat(a)||500,b=parseFloat(b)||20,e=e||null,i.tension=a,i.friction=b,f=null!==e,f?(k=d(a,b),g=k/e*m):g=m;;)if(h=c(h||i,g),j.push(1+h.x),k+=16,!(Math.abs(h.x)>l&&Math.abs(h.v)>l))break;return f?function(a){return j[a*(j.length-1)|0]}:k}}();t.Easings={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2},spring:function(a){return 1-Math.cos(4.5*a*Math.PI)*Math.exp(6*-a)}},m.each([["ease",[.25,.1,.25,1]],["ease-in",[.42,0,1,1]],["ease-out",[0,0,.58,1]],["ease-in-out",[.42,0,.58,1]],["easeInSine",[.47,0,.745,.715]],["easeOutSine",[.39,.575,.565,1]],["easeInOutSine",[.445,.05,.55,.95]],["easeInQuad",[.55,.085,.68,.53]],["easeOutQuad",[.25,.46,.45,.94]],["easeInOutQuad",[.455,.03,.515,.955]],["easeInCubic",[.55,.055,.675,.19]],["easeOutCubic",[.215,.61,.355,1]],["easeInOutCubic",[.645,.045,.355,1]],["easeInQuart",[.895,.03,.685,.22]],["easeOutQuart",[.165,.84,.44,1]],["easeInOutQuart",[.77,0,.175,1]],["easeInQuint",[.755,.05,.855,.06]],["easeOutQuint",[.23,1,.32,1]],["easeInOutQuint",[.86,0,.07,1]],["easeInExpo",[.95,.05,.795,.035]],["easeOutExpo",[.19,1,.22,1]],["easeInOutExpo",[1,0,0,1]],["easeInCirc",[.6,.04,.98,.335]],["easeOutCirc",[.075,.82,.165,1]],["easeInOutCirc",[.785,.135,.15,.86]]],function(a,b){t.Easings[b[0]]=i.apply(null,b[1])});var v=t.CSS={RegEx:{isHex:/^#([A-f\d]{3}){1,2}$/i,valueUnwrap:/^[A-z]+\((.*)\)$/i,wrappedValueAlreadyExtracted:/[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,valueSplit:/([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi},Lists:{colors:["fill","stroke","stopColor","color","backgroundColor","borderColor","borderTopColor","borderRightColor","borderBottomColor","borderLeftColor","outlineColor"],transformsBase:["translateX","translateY","scale","scaleX","scaleY","skewX","skewY","rotateZ"],transforms3D:["transformPerspective","translateZ","scaleZ","rotateX","rotateY"]},Hooks:{templates:{textShadow:["Color X Y Blur","black 0px 0px 0px"],boxShadow:["Color X Y Blur Spread","black 0px 0px 0px 0px"],clip:["Top Right Bottom Left","0px 0px 0px 0px"],backgroundPosition:["X Y","0% 0%"],transformOrigin:["X Y Z","50% 50% 0px"],perspectiveOrigin:["X Y","50% 50%"]},registered:{},register:function(){for(var a=0;a<v.Lists.colors.length;a++){var b="color"===v.Lists.colors[a]?"0 0 0 1":"255 255 255 1";v.Hooks.templates[v.Lists.colors[a]]=["Red Green Blue Alpha",b]}var c,d,e;if(n)for(c in v.Hooks.templates){d=v.Hooks.templates[c],e=d[0].split(" ");var f=d[1].match(v.RegEx.valueSplit);"Color"===e[0]&&(e.push(e.shift()),f.push(f.shift()),v.Hooks.templates[c]=[e.join(" "),f.join(" ")])}for(c in v.Hooks.templates){d=v.Hooks.templates[c],e=d[0].split(" ");for(var a in e){var g=c+e[a],h=a;v.Hooks.registered[g]=[c,h]}}},getRoot:function(a){var b=v.Hooks.registered[a];return b?b[0]:a},cleanRootPropertyValue:function(a,b){return v.RegEx.valueUnwrap.test(b)&&(b=b.match(v.RegEx.valueUnwrap)[1]),v.Values.isCSSNullValue(b)&&(b=v.Hooks.templates[a][1]),b},extractValue:function(a,b){var c=v.Hooks.registered[a];if(c){var d=c[0],e=c[1];return b=v.Hooks.cleanRootPropertyValue(d,b),b.toString().match(v.RegEx.valueSplit)[e]}return b},injectValue:function(a,b,c){var d=v.Hooks.registered[a];if(d){var e,f,g=d[0],h=d[1];return c=v.Hooks.cleanRootPropertyValue(g,c),e=c.toString().match(v.RegEx.valueSplit),e[h]=b,f=e.join(" ")}return c}},Normalizations:{registered:{clip:function(a,b,c){switch(a){case"name":return"clip";case"extract":var d;return v.RegEx.wrappedValueAlreadyExtracted.test(c)?d=c:(d=c.toString().match(v.RegEx.valueUnwrap),d=d?d[1].replace(/,(\s+)?/g," "):c),d;case"inject":return"rect("+c+")"}},blur:function(a,b,c){switch(a){case"name":return t.State.isFirefox?"filter":"-webkit-filter";case"extract":var d=parseFloat(c);if(!d&&0!==d){var e=c.toString().match(/blur\(([0-9]+[A-z]+)\)/i);d=e?e[1]:0}return d;case"inject":return parseFloat(c)?"blur("+c+")":"none"}},opacity:function(a,b,c){if(8>=n)switch(a){case"name":return"filter";case"extract":var d=c.toString().match(/alpha\(opacity=(.*)\)/i);return c=d?d[1]/100:1;case"inject":return b.style.zoom=1,parseFloat(c)>=1?"":"alpha(opacity="+parseInt(100*parseFloat(c),10)+")"}else switch(a){case"name":return"opacity";case"extract":return c;case"inject":return c}}},register:function(){9>=n||t.State.isGingerbread||(v.Lists.transformsBase=v.Lists.transformsBase.concat(v.Lists.transforms3D));for(var a=0;a<v.Lists.transformsBase.length;a++)!function(){var b=v.Lists.transformsBase[a];v.Normalizations.registered[b]=function(a,c,e){switch(a){case"name":return"transform";case"extract":return g(c)===d||g(c).transformCache[b]===d?/^scale/i.test(b)?1:0:g(c).transformCache[b].replace(/[()]/g,"");case"inject":var f=!1;switch(b.substr(0,b.length-1)){case"translate":f=!/(%|px|em|rem|vw|vh|\d)$/i.test(e);break;case"scal":case"scale":t.State.isAndroid&&g(c).transformCache[b]===d&&1>e&&(e=1),f=!/(\d)$/i.test(e);break;case"skew":f=!/(deg|\d)$/i.test(e);break;case"rotate":f=!/(deg|\d)$/i.test(e)}return f||(g(c).transformCache[b]="("+e+")"),g(c).transformCache[b]}}}();for(var a=0;a<v.Lists.colors.length;a++)!function(){var b=v.Lists.colors[a];v.Normalizations.registered[b]=function(a,c,e){switch(a){case"name":return b;case"extract":var f;if(v.RegEx.wrappedValueAlreadyExtracted.test(e))f=e;else{var g,h={black:"rgb(0, 0, 0)",blue:"rgb(0, 0, 255)",gray:"rgb(128, 128, 128)",green:"rgb(0, 128, 0)",red:"rgb(255, 0, 0)",white:"rgb(255, 255, 255)"};/^[A-z]+$/i.test(e)?g=h[e]!==d?h[e]:h.black:v.RegEx.isHex.test(e)?g="rgb("+v.Values.hexToRgb(e).join(" ")+")":/^rgba?\(/i.test(e)||(g=h.black),f=(g||e).toString().match(v.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g," ")}return 8>=n||3!==f.split(" ").length||(f+=" 1"),f;case"inject":return 8>=n?4===e.split(" ").length&&(e=e.split(/\s+/).slice(0,3).join(" ")):3===e.split(" ").length&&(e+=" 1"),(8>=n?"rgb":"rgba")+"("+e.replace(/\s+/g,",").replace(/\.(\d)+(?=,)/g,"")+")"}}}()}},Names:{camelCase:function(a){return a.replace(/-(\w)/g,function(a,b){return b.toUpperCase()})},SVGAttribute:function(a){var b="width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";return(n||t.State.isAndroid&&!t.State.isChrome)&&(b+="|transform"),new RegExp("^("+b+")$","i").test(a)},prefixCheck:function(a){if(t.State.prefixMatches[a])return[t.State.prefixMatches[a],!0];for(var b=["","Webkit","Moz","ms","O"],c=0,d=b.length;d>c;c++){var e;if(e=0===c?a:b[c]+a.replace(/^\w/,function(a){return a.toUpperCase()}),p.isString(t.State.prefixElement.style[e]))return t.State.prefixMatches[a]=e,[e,!0]}return[a,!1]}},Values:{hexToRgb:function(a){var b,c=/^#?([a-f\d])([a-f\d])([a-f\d])$/i,d=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;return a=a.replace(c,function(a,b,c,d){return b+b+c+c+d+d}),b=d.exec(a),b?[parseInt(b[1],16),parseInt(b[2],16),parseInt(b[3],16)]:[0,0,0]},isCSSNullValue:function(a){return 0==a||/^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(a)},getUnitType:function(a){return/^(rotate|skew)/i.test(a)?"deg":/(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(a)?"":"px"},getDisplayType:function(a){var b=a&&a.tagName.toString().toLowerCase();return/^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(b)?"inline":/^(li)$/i.test(b)?"list-item":/^(tr)$/i.test(b)?"table-row":/^(table)$/i.test(b)?"table":/^(tbody)$/i.test(b)?"table-row-group":"block"},addClass:function(a,b){a.classList?a.classList.add(b):a.className+=(a.className.length?" ":"")+b},removeClass:function(a,b){a.classList?a.classList.remove(b):a.className=a.className.toString().replace(new RegExp("(^|\\s)"+b.split(" ").join("|")+"(\\s|$)","gi")," ")}},getPropertyValue:function(a,c,e,f){function h(a,c){function e(){j&&v.setPropertyValue(a,"display","none")}var i=0;if(8>=n)i=m.css(a,c);else{var j=!1;if(/^(width|height)$/.test(c)&&0===v.getPropertyValue(a,"display")&&(j=!0,v.setPropertyValue(a,"display",v.Values.getDisplayType(a))),!f){if("height"===c&&"border-box"!==v.getPropertyValue(a,"boxSizing").toString().toLowerCase()){var k=a.offsetHeight-(parseFloat(v.getPropertyValue(a,"borderTopWidth"))||0)-(parseFloat(v.getPropertyValue(a,"borderBottomWidth"))||0)-(parseFloat(v.getPropertyValue(a,"paddingTop"))||0)-(parseFloat(v.getPropertyValue(a,"paddingBottom"))||0);return e(),k}if("width"===c&&"border-box"!==v.getPropertyValue(a,"boxSizing").toString().toLowerCase()){var l=a.offsetWidth-(parseFloat(v.getPropertyValue(a,"borderLeftWidth"))||0)-(parseFloat(v.getPropertyValue(a,"borderRightWidth"))||0)-(parseFloat(v.getPropertyValue(a,"paddingLeft"))||0)-(parseFloat(v.getPropertyValue(a,"paddingRight"))||0);return e(),l}}var o;o=g(a)===d?b.getComputedStyle(a,null):g(a).computedStyle?g(a).computedStyle:g(a).computedStyle=b.getComputedStyle(a,null),"borderColor"===c&&(c="borderTopColor"),i=9===n&&"filter"===c?o.getPropertyValue(c):o[c],(""===i||null===i)&&(i=a.style[c]),e()}if("auto"===i&&/^(top|right|bottom|left)$/i.test(c)){var p=h(a,"position");("fixed"===p||"absolute"===p&&/top|left/i.test(c))&&(i=m(a).position()[c]+"px")}return i}var i;if(v.Hooks.registered[c]){var j=c,k=v.Hooks.getRoot(j);e===d&&(e=v.getPropertyValue(a,v.Names.prefixCheck(k)[0])),v.Normalizations.registered[k]&&(e=v.Normalizations.registered[k]("extract",a,e)),i=v.Hooks.extractValue(j,e)}else if(v.Normalizations.registered[c]){var l,o;l=v.Normalizations.registered[c]("name",a),"transform"!==l&&(o=h(a,v.Names.prefixCheck(l)[0]),v.Values.isCSSNullValue(o)&&v.Hooks.templates[c]&&(o=v.Hooks.templates[c][1])),i=v.Normalizations.registered[c]("extract",a,o)}if(!/^[\d-]/.test(i))if(g(a)&&g(a).isSVG&&v.Names.SVGAttribute(c))if(/^(height|width)$/i.test(c))try{i=a.getBBox()[c]}catch(p){i=0}else i=a.getAttribute(c);else i=h(a,v.Names.prefixCheck(c)[0]);return v.Values.isCSSNullValue(i)&&(i=0),t.debug>=2&&console.log("Get "+c+": "+i),i},setPropertyValue:function(a,c,d,e,f){var h=c;if("scroll"===c)f.container?f.container["scroll"+f.direction]=d:"Left"===f.direction?b.scrollTo(d,f.alternateValue):b.scrollTo(f.alternateValue,d);else if(v.Normalizations.registered[c]&&"transform"===v.Normalizations.registered[c]("name",a))v.Normalizations.registered[c]("inject",a,d),h="transform",d=g(a).transformCache[c];else{if(v.Hooks.registered[c]){var i=c,j=v.Hooks.getRoot(c);e=e||v.getPropertyValue(a,j),d=v.Hooks.injectValue(i,d,e),c=j}if(v.Normalizations.registered[c]&&(d=v.Normalizations.registered[c]("inject",a,d),c=v.Normalizations.registered[c]("name",a)),h=v.Names.prefixCheck(c)[0],8>=n)try{a.style[h]=d}catch(k){t.debug&&console.log("Browser does not support ["+d+"] for ["+h+"]")}else g(a)&&g(a).isSVG&&v.Names.SVGAttribute(c)?a.setAttribute(c,d):a.style[h]=d;t.debug>=2&&console.log("Set "+c+" ("+h+"): "+d)}return[h,d]},flushTransformCache:function(a){function b(b){return parseFloat(v.getPropertyValue(a,b))}var c="";if((n||t.State.isAndroid&&!t.State.isChrome)&&g(a).isSVG){var d={translate:[b("translateX"),b("translateY")],skewX:[b("skewX")],skewY:[b("skewY")],scale:1!==b("scale")?[b("scale"),b("scale")]:[b("scaleX"),b("scaleY")],rotate:[b("rotateZ"),0,0]};m.each(g(a).transformCache,function(a){/^translate/i.test(a)?a="translate":/^scale/i.test(a)?a="scale":/^rotate/i.test(a)&&(a="rotate"),d[a]&&(c+=a+"("+d[a].join(" ")+") ",delete d[a])})}else{var e,f;m.each(g(a).transformCache,function(b){return e=g(a).transformCache[b],"transformPerspective"===b?(f=e,!0):(9===n&&"rotateZ"===b&&(b="rotate"),void(c+=b+e+" "))}),f&&(c="perspective"+f+" "+c)}v.setPropertyValue(a,"transform",c)}};v.Hooks.register(),v.Normalizations.register(),t.hook=function(a,b,c){var e=d;return a=f(a),m.each(a,function(a,f){if(g(f)===d&&t.init(f),c===d)e===d&&(e=t.CSS.getPropertyValue(f,b));else{var h=t.CSS.setPropertyValue(f,b,c);"transform"===h[0]&&t.CSS.flushTransformCache(f),e=h}}),e};var w=function(){function a(){return h?B.promise||null:i}function e(){function a(){function a(a,b){var c=d,e=d,g=d;return p.isArray(a)?(c=a[0],!p.isArray(a[1])&&/^[\d-]/.test(a[1])||p.isFunction(a[1])||v.RegEx.isHex.test(a[1])?g=a[1]:(p.isString(a[1])&&!v.RegEx.isHex.test(a[1])||p.isArray(a[1]))&&(e=b?a[1]:j(a[1],h.duration),a[2]!==d&&(g=a[2]))):c=a,b||(e=e||h.easing),p.isFunction(c)&&(c=c.call(f,y,x)),p.isFunction(g)&&(g=g.call(f,y,x)),[c||0,e,g]}function l(a,b){var c,d;return d=(b||"0").toString().toLowerCase().replace(/[%A-z]+$/,function(a){return c=a,""}),c||(c=v.Values.getUnitType(a)),[d,c]}function n(){var a={myParent:f.parentNode||c.body,position:v.getPropertyValue(f,"position"),fontSize:v.getPropertyValue(f,"fontSize")},d=a.position===I.lastPosition&&a.myParent===I.lastParent,e=a.fontSize===I.lastFontSize;I.lastParent=a.myParent,I.lastPosition=a.position,I.lastFontSize=a.fontSize;var h=100,i={};if(e&&d)i.emToPx=I.lastEmToPx,i.percentToPxWidth=I.lastPercentToPxWidth,i.percentToPxHeight=I.lastPercentToPxHeight;else{var j=g(f).isSVG?c.createElementNS("http://www.w3.org/2000/svg","rect"):c.createElement("div");t.init(j),a.myParent.appendChild(j),m.each(["overflow","overflowX","overflowY"],function(a,b){t.CSS.setPropertyValue(j,b,"hidden")}),t.CSS.setPropertyValue(j,"position",a.position),t.CSS.setPropertyValue(j,"fontSize",a.fontSize),t.CSS.setPropertyValue(j,"boxSizing","content-box"),m.each(["minWidth","maxWidth","width","minHeight","maxHeight","height"],function(a,b){t.CSS.setPropertyValue(j,b,h+"%")}),t.CSS.setPropertyValue(j,"paddingLeft",h+"em"),i.percentToPxWidth=I.lastPercentToPxWidth=(parseFloat(v.getPropertyValue(j,"width",null,!0))||1)/h,i.percentToPxHeight=I.lastPercentToPxHeight=(parseFloat(v.getPropertyValue(j,"height",null,!0))||1)/h,i.emToPx=I.lastEmToPx=(parseFloat(v.getPropertyValue(j,"paddingLeft"))||1)/h,a.myParent.removeChild(j)}return null===I.remToPx&&(I.remToPx=parseFloat(v.getPropertyValue(c.body,"fontSize"))||16),null===I.vwToPx&&(I.vwToPx=parseFloat(b.innerWidth)/100,I.vhToPx=parseFloat(b.innerHeight)/100),i.remToPx=I.remToPx,i.vwToPx=I.vwToPx,i.vhToPx=I.vhToPx,t.debug>=1&&console.log("Unit ratios: "+JSON.stringify(i),f),i}if(h.begin&&0===y)try{h.begin.call(o,o)}catch(r){setTimeout(function(){throw r},1)}if("scroll"===C){var u,w,z,A=/^x$/i.test(h.axis)?"Left":"Top",D=parseFloat(h.offset)||0;h.container?p.isWrapped(h.container)||p.isNode(h.container)?(h.container=h.container[0]||h.container,u=h.container["scroll"+A],z=u+m(f).position()[A.toLowerCase()]+D):h.container=null:(u=t.State.scrollAnchor[t.State["scrollProperty"+A]],w=t.State.scrollAnchor[t.State["scrollProperty"+("Left"===A?"Top":"Left")]],z=m(f).offset()[A.toLowerCase()]+D),i={scroll:{rootPropertyValue:!1,startValue:u,currentValue:u,endValue:z,unitType:"",easing:h.easing,scrollData:{container:h.container,direction:A,alternateValue:w}},element:f},t.debug&&console.log("tweensContainer (scroll): ",i.scroll,f)}else if("reverse"===C){if(!g(f).tweensContainer)return void m.dequeue(f,h.queue);"none"===g(f).opts.display&&(g(f).opts.display="auto"),"hidden"===g(f).opts.visibility&&(g(f).opts.visibility="visible"),g(f).opts.loop=!1,g(f).opts.begin=null,g(f).opts.complete=null,s.easing||delete h.easing,s.duration||delete h.duration,h=m.extend({},g(f).opts,h);var E=m.extend(!0,{},g(f).tweensContainer);for(var F in E)if("element"!==F){var G=E[F].startValue;E[F].startValue=E[F].currentValue=E[F].endValue,E[F].endValue=G,p.isEmptyObject(s)||(E[F].easing=h.easing),t.debug&&console.log("reverse tweensContainer ("+F+"): "+JSON.stringify(E[F]),f)}i=E}else if("start"===C){var E;g(f).tweensContainer&&g(f).isAnimating===!0&&(E=g(f).tweensContainer),m.each(q,function(b,c){if(RegExp("^"+v.Lists.colors.join("$|^")+"$").test(b)){var e=a(c,!0),f=e[0],g=e[1],h=e[2];if(v.RegEx.isHex.test(f)){for(var i=["Red","Green","Blue"],j=v.Values.hexToRgb(f),k=h?v.Values.hexToRgb(h):d,l=0;l<i.length;l++){var m=[j[l]];g&&m.push(g),k!==d&&m.push(k[l]),q[b+i[l]]=m}delete q[b]}}});for(var H in q){var K=a(q[H]),L=K[0],M=K[1],N=K[2];H=v.Names.camelCase(H);var O=v.Hooks.getRoot(H),P=!1;if(g(f).isSVG||"tween"===O||v.Names.prefixCheck(O)[1]!==!1||v.Normalizations.registered[O]!==d){(h.display!==d&&null!==h.display&&"none"!==h.display||h.visibility!==d&&"hidden"!==h.visibility)&&/opacity|filter/.test(H)&&!N&&0!==L&&(N=0),h._cacheValues&&E&&E[H]?(N===d&&(N=E[H].endValue+E[H].unitType),P=g(f).rootPropertyValueCache[O]):v.Hooks.registered[H]?N===d?(P=v.getPropertyValue(f,O),N=v.getPropertyValue(f,H,P)):P=v.Hooks.templates[O][1]:N===d&&(N=v.getPropertyValue(f,H));var Q,R,S,T=!1;if(Q=l(H,N),N=Q[0],S=Q[1],Q=l(H,L),L=Q[0].replace(/^([+-\/*])=/,function(a,b){return T=b,""}),R=Q[1],N=parseFloat(N)||0,L=parseFloat(L)||0,"%"===R&&(/^(fontSize|lineHeight)$/.test(H)?(L/=100,R="em"):/^scale/.test(H)?(L/=100,R=""):/(Red|Green|Blue)$/i.test(H)&&(L=L/100*255,R="")),/[\/*]/.test(T))R=S;else if(S!==R&&0!==N)if(0===L)R=S;else{e=e||n();var U=/margin|padding|left|right|width|text|word|letter/i.test(H)||/X$/.test(H)||"x"===H?"x":"y";switch(S){case"%":N*="x"===U?e.percentToPxWidth:e.percentToPxHeight;break;case"px":break;default:N*=e[S+"ToPx"]}switch(R){case"%":N*=1/("x"===U?e.percentToPxWidth:e.percentToPxHeight);break;case"px":break;default:N*=1/e[R+"ToPx"]}}switch(T){case"+":L=N+L;break;case"-":L=N-L;break;case"*":L=N*L;break;case"/":L=N/L}i[H]={rootPropertyValue:P,startValue:N,currentValue:N,endValue:L,unitType:R,easing:M},t.debug&&console.log("tweensContainer ("+H+"): "+JSON.stringify(i[H]),f)}else t.debug&&console.log("Skipping ["+O+"] due to a lack of browser support.")}i.element=f}i.element&&(v.Values.addClass(f,"velocity-animating"),J.push(i),""===h.queue&&(g(f).tweensContainer=i,g(f).opts=h),g(f).isAnimating=!0,y===x-1?(t.State.calls.push([J,o,h,null,B.resolver]),t.State.isTicking===!1&&(t.State.isTicking=!0,k())):y++)}var e,f=this,h=m.extend({},t.defaults,s),i={};switch(g(f)===d&&t.init(f),parseFloat(h.delay)&&h.queue!==!1&&m.queue(f,h.queue,function(a){t.velocityQueueEntryFlag=!0,g(f).delayTimer={setTimeout:setTimeout(a,parseFloat(h.delay)),next:a}}),h.duration.toString().toLowerCase()){case"fast":h.duration=200;break;case"normal":h.duration=r;break;case"slow":h.duration=600;break;default:h.duration=parseFloat(h.duration)||1}t.mock!==!1&&(t.mock===!0?h.duration=h.delay=1:(h.duration*=parseFloat(t.mock)||1,h.delay*=parseFloat(t.mock)||1)),h.easing=j(h.easing,h.duration),h.begin&&!p.isFunction(h.begin)&&(h.begin=null),h.progress&&!p.isFunction(h.progress)&&(h.progress=null),h.complete&&!p.isFunction(h.complete)&&(h.complete=null),h.display!==d&&null!==h.display&&(h.display=h.display.toString().toLowerCase(),"auto"===h.display&&(h.display=t.CSS.Values.getDisplayType(f))),h.visibility!==d&&null!==h.visibility&&(h.visibility=h.visibility.toString().toLowerCase()),h.mobileHA=h.mobileHA&&t.State.isMobile&&!t.State.isGingerbread,h.queue===!1?h.delay?setTimeout(a,h.delay):a():m.queue(f,h.queue,function(b,c){return c===!0?(B.promise&&B.resolver(o),!0):(t.velocityQueueEntryFlag=!0,void a(b))}),""!==h.queue&&"fx"!==h.queue||"inprogress"===m.queue(f)[0]||m.dequeue(f)}var h,i,n,o,q,s,u=arguments[0]&&(arguments[0].p||m.isPlainObject(arguments[0].properties)&&!arguments[0].properties.names||p.isString(arguments[0].properties));if(p.isWrapped(this)?(h=!1,n=0,o=this,i=this):(h=!0,n=1,o=u?arguments[0].elements||arguments[0].e:arguments[0]),o=f(o)){u?(q=arguments[0].properties||arguments[0].p,s=arguments[0].options||arguments[0].o):(q=arguments[n],s=arguments[n+1]);var x=o.length,y=0;if(!/^(stop|finish|finishAll)$/i.test(q)&&!m.isPlainObject(s)){var z=n+1;s={};for(var A=z;A<arguments.length;A++)p.isArray(arguments[A])||!/^(fast|normal|slow)$/i.test(arguments[A])&&!/^\d/.test(arguments[A])?p.isString(arguments[A])||p.isArray(arguments[A])?s.easing=arguments[A]:p.isFunction(arguments[A])&&(s.complete=arguments[A]):s.duration=arguments[A]}var B={promise:null,resolver:null,rejecter:null};h&&t.Promise&&(B.promise=new t.Promise(function(a,b){B.resolver=a,B.rejecter=b}));var C;switch(q){case"scroll":C="scroll";break;case"reverse":C="reverse";break;case"finish":case"finishAll":case"stop":m.each(o,function(a,b){g(b)&&g(b).delayTimer&&(clearTimeout(g(b).delayTimer.setTimeout),g(b).delayTimer.next&&g(b).delayTimer.next(),delete g(b).delayTimer),"finishAll"!==q||s!==!0&&!p.isString(s)||(m.each(m.queue(b,p.isString(s)?s:""),function(a,b){p.isFunction(b)&&b()}),m.queue(b,p.isString(s)?s:"",[]))});var D=[];return m.each(t.State.calls,function(a,b){b&&m.each(b[1],function(c,e){var f=s===d?"":s;return f===!0||b[2].queue===f||s===d&&b[2].queue===!1?void m.each(o,function(c,d){d===e&&((s===!0||p.isString(s))&&(m.each(m.queue(d,p.isString(s)?s:""),function(a,b){p.isFunction(b)&&b(null,!0)
}),m.queue(d,p.isString(s)?s:"",[])),"stop"===q?(g(d)&&g(d).tweensContainer&&f!==!1&&m.each(g(d).tweensContainer,function(a,b){b.endValue=b.currentValue}),D.push(a)):("finish"===q||"finishAll"===q)&&(b[2].duration=1))}):!0})}),"stop"===q&&(m.each(D,function(a,b){l(b,!0)}),B.promise&&B.resolver(o)),a();default:if(!m.isPlainObject(q)||p.isEmptyObject(q)){if(p.isString(q)&&t.Redirects[q]){var E=m.extend({},s),F=E.duration,G=E.delay||0;return E.backwards===!0&&(o=m.extend(!0,[],o).reverse()),m.each(o,function(a,b){parseFloat(E.stagger)?E.delay=G+parseFloat(E.stagger)*a:p.isFunction(E.stagger)&&(E.delay=G+E.stagger.call(b,a,x)),E.drag&&(E.duration=parseFloat(F)||(/^(callout|transition)/.test(q)?1e3:r),E.duration=Math.max(E.duration*(E.backwards?1-a/x:(a+1)/x),.75*E.duration,200)),t.Redirects[q].call(b,b,E||{},a,x,o,B.promise?B:d)}),a()}var H="Velocity: First argument ("+q+") was not a property map, a known action, or a registered redirect. Aborting.";return B.promise?B.rejecter(new Error(H)):console.log(H),a()}C="start"}var I={lastParent:null,lastPosition:null,lastFontSize:null,lastPercentToPxWidth:null,lastPercentToPxHeight:null,lastEmToPx:null,remToPx:null,vwToPx:null,vhToPx:null},J=[];m.each(o,function(a,b){p.isNode(b)&&e.call(b)});var K,E=m.extend({},t.defaults,s);if(E.loop=parseInt(E.loop),K=2*E.loop-1,E.loop)for(var L=0;K>L;L++){var M={delay:E.delay,progress:E.progress};L===K-1&&(M.display=E.display,M.visibility=E.visibility,M.complete=E.complete),w(o,"reverse",M)}return a()}};t=m.extend(w,t),t.animate=w;var x=b.requestAnimationFrame||o;return t.State.isMobile||c.hidden===d||c.addEventListener("visibilitychange",function(){c.hidden?(x=function(a){return setTimeout(function(){a(!0)},16)},k()):x=b.requestAnimationFrame||o}),a.Velocity=t,a!==b&&(a.fn.velocity=w,a.fn.velocity.defaults=t.defaults),m.each(["Down","Up"],function(a,b){t.Redirects["slide"+b]=function(a,c,e,f,g,h){var i=m.extend({},c),j=i.begin,k=i.complete,l={height:"",marginTop:"",marginBottom:"",paddingTop:"",paddingBottom:""},n={};i.display===d&&(i.display="Down"===b?"inline"===t.CSS.Values.getDisplayType(a)?"inline-block":"block":"none"),i.begin=function(){j&&j.call(g,g);for(var c in l){n[c]=a.style[c];var d=t.CSS.getPropertyValue(a,c);l[c]="Down"===b?[d,0]:[0,d]}n.overflow=a.style.overflow,a.style.overflow="hidden"},i.complete=function(){for(var b in n)a.style[b]=n[b];k&&k.call(g,g),h&&h.resolver(g)},t(a,l,i)}}),m.each(["In","Out"],function(a,b){t.Redirects["fade"+b]=function(a,c,e,f,g,h){var i=m.extend({},c),j={opacity:"In"===b?1:0},k=i.complete;i.complete=e!==f-1?i.begin=null:function(){k&&k.call(g,g),h&&h.resolver(g)},i.display===d&&(i.display="In"===b?"auto":"none"),t(this,j,i)}}),t}(window.jQuery||window.Zepto||window,window,document)});


/**
 * jquery.ripple.js
 * 
 * @version 0.0.1
 * @author SUSH <sush@sus-happy.ner>
 * https://github.com/sus-happy/jquery.ripple.js
 */

( function( $, U ) {
    // use border-radius
    $.support.borderRadius = false;
    // use transition
    $.support.transition = false;
    $( function() {
        $.each( [ 'borderRadius', 'BorderRadius', 'MozBorderRadius', 'WebkitBorderRadius', 'OBorderRadius', 'KhtmlBorderRadius' ], function( i, v ) {
            if( document.body.style[v] !== undefined ) $.support.borderRadius = true;
            return (! $.support.borderRadius );
        } );

        var el = $("<div>");
        $.support.transition = typeof el.css("transitionProperty") === "string";
    } );

    $.extend( {
        // jquery.ripple用の関数
        ripple: {
            // アニメーションの裏に隠れないようにするDOM
            $textSpan: $('<span class="text-wrap">').css( { position: 'relative', 'z-index': 2 } ),
            // アニメーション用のDOM
            $rippleWrap: $('<span>', { 'class': 'rippleWrap' } ).css( { position: 'absolute', 'z-index': 1, 'left': 0, 'top': 0, 'overflow': 'hidden' } ).append(
                            $('<span>', { 'class': 'rippleAnimate' } ).css( { position: 'absolute', 'left': 0, 'top': 0, 'width': 0, 'height': 0, 'border-radius': '50%' } )
                         ),
            // jquery.rippleが利用できるか？
            is: function() {
                return $.support.borderRadius && $.support.transition;
            },
            // coreクラス
            core: function( target, param ) {
                this.$target   = target;
                this._v_duration = 400;
                this._h_duration = 400;
                this._timer      = null;

                // paramに値があれば設定変更
                if( param !== U && Object.prototype.hasOwnProperty.call( param, 'v_duration' ) ) {
                    this.set_view_duration( param.v_duration );
                }
                if( param !== U && Object.prototype.hasOwnProperty.call( param, 'h_duration' ) ) {
                    this.set_hide_duration( param.h_duration );
                }

                // イベント初期設定
                this.init();
            }
        }
    } );

    // coreクラスを拡張しておく
    $.ripple.core.prototype = {
        // 設定変更
        set_view_duration: function( v_duration ) {
            this._v_duration = v_duration;
        },
        set_hide_duration: function( h_duration ) {
            this._h_duration = h_duration;
        },

        // イベント初期設定
        init: function() {
            var that = this;

            // position staticだったらrelativeにしておく
            if( this.$target.css( 'position' ) === 'static' ) {
                this.$target.css( 'position', 'relative' );
            }
            // スマホ端末のハイライトを切る
            this.$target.css( '-webkit-tap-highlight-color', 'rgba( 0, 0, 0, 0 )' );

            // 必要DOMを追加
           if(!this.$target.hasClass("rollover") && !this.$target.hasClass("rollover-video") && !this.$target.hasClass("post-rollover") && !this.$target.hasClass(("benefits-grid-ico"))){
            
           		this.$target.wrapInner( $.ripple.$textSpan );
           	}
            	this.$target.append( $.ripple.$rippleWrap.clone() );

            // 必要DOMを変数に入れておく
            this.$rippleWrap    = this.$target.find( '.rippleWrap' );
            this.$rippleAnimate = this.$target.find( '.rippleAnimate' );

            // マスクに関係するスタイルを反映する
            // border-radius
            this.$rippleWrap.css( 'border-radius', this.$target.css( 'border-radius' ) );

            // 色を指定
            this.$target.find( '.rippleAnimate' ).css( 'background-color', this.$target.attr( 'data-color' ) );

            // イベントを登録
            if( ('ontouchstart' in window) ) {
                this.$target.bind( 'touchstart.ripple', function( e ) {
                    that.view( e.originalEvent.touches[0] );
                } );
                this.$target.bind( 'touchend.ripple', function( e ) {
                    that.hidden( e.originalEvent.touches[0] );
                } );
                this.$target.bind( 'mouseleave.ripple', function( e ) {
                    that.hidden( e );
                } );
            } else {
                this.$target.bind( 'mousedown.ripple', function( e ) {
                    that.view( e );
                } );
                this.$target.bind( 'mouseup.ripple mouseleave.ripple', function( e ) {
                    that.hidden( e );
                } );
            }
        },

        // イベント廃止
        remove: function() {
        },

        // アニメーション開始
        view: function( e ) {
            // タイマーは切っておく
            clearTimeout( this._timer );

            // マスク要素のサイズを再取得（変わる可能性も考慮して）
            var width  = this.$target.outerWidth();
            var height = this.$target.outerHeight();
            this.$rippleWrap.stop( true, false ).width( width ).height( height ).css( { 'opacity': 1, 'transition': 'none' } );

            // サイズを指定（縦横の大きい値）
            var circleRatio      = 2.8;
            var size = Math.max( width, height );

            // マウスボタンの位置を取得
            // offsetX, offsetYがおかしいのでpageX, pageYから計算する
            var offsetX = e.pageX - this.$target.offset().left;
            var offsetY = e.pageY - this.$target.offset().top;
            this.$rippleAnimate.css( { 'width': size, 'height': size, 'transform': 'scale3d( 0, 0, 1 )', 'left': offsetX-size/2, 'top': offsetY-size/2, 'transition': 'none' } );

            var animateTo        = {};
            animateTo.transform  = 'scale3d( ' + circleRatio + ', ' + circleRatio + ', 1 )';
            animateTo.transition = ( this._v_duration/1000 )+'s ease-out';

            // アニメーション開始
            this.$rippleAnimate.show()
                .css( animateTo );
        },

        // アニメーション終了
        hidden: function( e ) {
            var that = this;
            // Wrapの透明度を下げて隠していく
            this.$rippleWrap.stop( true, false ).css( { 'opacity': 0, 'transition': 'opacity '+( this._h_duration/1000 )+'s ease-out' } );

            // アニメーション終了タイミングでサイズ変更
            clearTimeout( this._timer );
            this._timer = setTimeout( function() {
                that.$rippleWrap.css( { 'opacity': 1, 'transition': 'none' } );
                that.$rippleAnimate.css( { 'transform': 'scale3d( 0, 0, 1 )', 'transition': 'none' } );
            }, this._v_duration );
        }
    };

    $.fn.extend( {
        // jquery.ripple
        ripple: function( opt ) {
            // 必要条件に満たさなければ終了
            // border-radiusとtransitionが使えればたぶん動く
            if(! $.ripple.is() ) {
                return $(this);
            }

            // 対象DOMに対してイベントを登録する
            $(this).each( function() {
                new $.ripple.core( $(this), opt );
            } );

            return $(this);
        }
    } );
} )( jQuery );

/*!
 * Waves v0.6.0
 * http://fian.my.id/Waves 
 * 
 * Copyright 2014 Alfiana E. Sibuea and other contributors 
 * Released under the MIT license 
 * https://github.com/fians/Waves/blob/master/LICENSE 
 */

;(function(window) {
    //'use strict';

    if (!jQuery("html").hasClass("old-ie")){
        var Waves = Waves || {};
        var $$ = document.querySelectorAll.bind(document);

        // Find exact position of element
        function isWindow(obj) {
            return obj !== null && obj === obj.window;
        }

        function getWindow(elem) {
            return isWindow(elem) ? elem : elem.nodeType === 9 && elem.defaultView;
        }

        function offset(elem) {
            var docElem, win,
                box = {top: 0, left: 0},
                doc = elem && elem.ownerDocument;

            docElem = doc.documentElement;

            if (typeof elem.getBoundingClientRect !== typeof undefined) {
                box = elem.getBoundingClientRect();
            }
            win = getWindow(doc);
            return {
                top: box.top + win.pageYOffset - docElem.clientTop,
                left: box.left + win.pageXOffset - docElem.clientLeft
            };
        }

        function convertStyle(obj) {
            var style = '';

            for (var a in obj) {
                if (obj.hasOwnProperty(a)) {
                    style += (a + ':' + obj[a] + ';');
                }
            }

            return style;
        }

        var Effect = {

            // Effect delay
            duration: 300,

            show: function(e, element) {

                // Disable right click
                if (e.button === 2) {
                    return false;
                }

                var el = element || this;

                // Create ripple
                var ripple = document.createElement('div');
                ripple.className = 'waves-ripple';
                el.appendChild(ripple);

                // Get click coordinate and element witdh
                var pos         = offset(el);
                var relativeY   = (e.pageY - pos.top);
                var relativeX   = (e.pageX - pos.left);
              /*  var scale       = 'scale('+((el.clientWidth / 100) * 3)+')';*/
                var scale       = 'scale(1)';
                
                // Support for touch devices
                if ('touches' in e) {
                  relativeY   = (e.touches[0].pageY - pos.top);
                  relativeX   = (e.touches[0].pageX - pos.left);
                }

                // Attach data to element
                ripple.setAttribute('data-hold', Date.now());
                ripple.setAttribute('data-scale', scale);
                ripple.setAttribute('data-x', relativeX);
                ripple.setAttribute('data-y', relativeY);

                // Set ripple position
                var rippleStyle = {
                    'top': relativeY+'px',
                    'left': relativeX+'px'
                };
                
                ripple.className = ripple.className + ' waves-notransition';
                ripple.setAttribute('style', convertStyle(rippleStyle));
                ripple.className = ripple.className.replace('waves-notransition', '');

                // Scale the ripple
                rippleStyle['-webkit-transform'] = scale;
                rippleStyle['-moz-transform'] = scale;
                rippleStyle['-ms-transform'] = scale;
                rippleStyle['-o-transform'] = scale;
                rippleStyle.transform = scale;
                rippleStyle.opacity   = '1';

                rippleStyle['-webkit-transition-duration'] = Effect.duration + 'ms';
                rippleStyle['-moz-transition-duration']    = Effect.duration + 'ms';
                rippleStyle['-o-transition-duration']      = Effect.duration + 'ms';
                rippleStyle['transition-duration']         = Effect.duration + 'ms';

                ripple.setAttribute('style', convertStyle(rippleStyle));
            },

            hide: function(e) {
                TouchHandler.touchup(e);

                var el = this;
                var width = el.clientWidth * 1.4;
                
                // Get first ripple
                var ripple = null;
                var ripples = el.getElementsByClassName('waves-ripple');
                if (ripples.length > 0) {
                    ripple = ripples[ripples.length - 1];
                } else {
                    return false;
                }

                var relativeX   = ripple.getAttribute('data-x');
                var relativeY   = ripple.getAttribute('data-y');
                var scale       = ripple.getAttribute('data-scale');

                // Get delay beetween mousedown and mouse leave
                var diff = Date.now() - Number(ripple.getAttribute('data-hold'));
                var delay = 350 - diff;

                if (delay < 0) {
                    delay = 0;
                }

                // Fade out ripple after delay
                setTimeout(function() {
                    var style = {
                        'top': relativeY+'px',
                        'left': relativeX+'px',
                        'opacity': '0',

                        // Duration
                        '-webkit-transition-duration': Effect.duration + 'ms',
                        '-moz-transition-duration': Effect.duration + 'ms',
                        '-o-transition-duration': Effect.duration + 'ms',
                        'transition-duration': Effect.duration + 'ms',
                        '-webkit-transform': scale,
                        '-moz-transform': scale,
                        '-ms-transform': scale,
                        '-o-transform': scale,
                        'transform': scale,
                    };

                    ripple.setAttribute('style', convertStyle(style));

                    setTimeout(function() {
                        try {
                            el.removeChild(ripple);
                        } catch(e) {
                            return false;
                        }
                    }, Effect.duration);
                }, delay);
            },

            // Little hack to make <input> can perform waves effect
            wrapInput: function(elements) {
                for (var a = 0; a < elements.length; a++) {
                    var el = elements[a];
                    
                    if (el.tagName.toLowerCase() === 'input') {
                        var parent = el.parentNode;

                        // If input already have parent just pass through
                        if (parent.tagName.toLowerCase() === 'i' && parent.className.indexOf('waves-effect') !== -1) {
                            continue;
                        }

                        // Put element class and style to the specified parent
                        var wrapper = document.createElement('i');
                        wrapper.className = el.className + ' waves-input-wrapper';

                        var elementStyle = el.getAttribute('style');

                        if (!elementStyle) {
                            elementStyle = '';
                        }

                        wrapper.setAttribute('style', elementStyle);
                        
                        el.className = 'waves-button-input';
                        el.removeAttribute('style');

                        // Put element as child
                        parent.replaceChild(wrapper, el);
                        wrapper.appendChild(el);
                    }
                }
            }
        };


        /**
         * Disable mousedown event for 500ms during and after touch
         */
        var TouchHandler = {
            /* uses an integer rather than bool so there's no issues with
             * needing to clear timeouts if another touch event occurred
             * within the 500ms. Cannot mouseup between touchstart and
             * touchend, nor in the 500ms after touchend. */
            touches: 0,
            allowEvent: function(e) {
                var allow = true;

                if (e.type === 'touchstart') {
                    TouchHandler.touches += 1; //push
                } else if (e.type === 'touchend' || e.type === 'touchcancel') {
                    setTimeout(function() {
                        if (TouchHandler.touches > 0) {
                            TouchHandler.touches -= 1; //pop after 500ms
                        }
                    }, 500);
                } else if (e.type === 'mousedown' && TouchHandler.touches > 0) {
                    allow = false;
                }

                return allow;
            },
            touchup: function(e) {
                TouchHandler.allowEvent(e);
            }
        };


        /**
         * Delegated click handler for .waves-effect element.
         * returns null when .waves-effect element not in "click tree"
         */
        function getWavesEffectElement(e) {
            if (TouchHandler.allowEvent(e) === false) {
                return null;
            }

            var element = null;
            var target = e.target || e.srcElement;

            while (target.parentElement !== null) {
                if (!(target instanceof SVGElement) && target.className.indexOf('waves-effect') !== -1) {
                    element = target;
                    break;
                } else if (target.classList.contains('waves-effect')) {
                    element = target;
                    break;
                }
                target = target.parentElement;
            }

            return element;
        }

        /**
         * Bubble the click and show effect if .waves-effect elem was found
         */
        function showEffect(e) {
            var element = getWavesEffectElement(e);

            if (element !== null) {
                Effect.show(e, element);

                if ('ontouchstart' in window) {
                    element.addEventListener('touchend', Effect.hide, false);
                    element.addEventListener('touchcancel', Effect.hide, false);
                }

                element.addEventListener('mouseup', Effect.hide, false);
                element.addEventListener('mouseleave', Effect.hide, false);
            }
        }

        Waves.displayEffect = function(options) {
            options = options || {};

            if ('duration' in options) {
                Effect.duration = options.duration;
            }
            
            //Wrap input inside <i> tag
            Effect.wrapInput($$('.waves-effect'));
            
            if ('ontouchstart' in window) {
                document.body.addEventListener('touchstart', showEffect, false);
            }
            
            document.body.addEventListener('mousedown', showEffect, false);
        };

        /**
         * Attach Waves to an input element (or any element which doesn't
         * bubble mouseup/mousedown events).
         *   Intended to be used with dynamically loaded forms/inputs, or
         * where the user doesn't want a delegated click handler.
         */
        Waves.attach = function(element) {
            //FUTURE: automatically add waves classes and allow users
            // to specify them with an options param? Eg. light/classic/button
            if (element.tagName.toLowerCase() === 'input') {
                Effect.wrapInput([element]);
                element = element.parentElement;
            }

            if ('ontouchstart' in window) {
                element.addEventListener('touchstart', showEffect, false);
            }

            element.addEventListener('mousedown', showEffect, false);
        };

        window.Waves = Waves;
    }
})(window);

/*
 * Pixastic - JavaScript Image Processing Library
 * Copyright (c) 2008 Jacob Seidelin, jseidelin@nihilogic.dk, http://blog.nihilogic.dk/
 * MIT License [http://www.pixastic.com/lib/license.txt]
 */


var Pixastic=(function(){function addEvent(el,event,handler){if(el.addEventListener)
el.addEventListener(event,handler,false);else if(el.attachEvent)
el.attachEvent("on"+event,handler);}
function onready(handler){var handlerDone=false;var execHandler=function(){if(!handlerDone){handlerDone=true;handler();}}
document.write("<"+"script defer src=\"//:\" id=\"__onload_ie_pixastic__\"></"+"script>");var script=document.getElementById("__onload_ie_pixastic__");script.onreadystatechange=function(){if(script.readyState=="complete"){script.parentNode.removeChild(script);execHandler();}}
if(document.addEventListener)
document.addEventListener("DOMContentLoaded",execHandler,false);addEvent(window,"load",execHandler);}
function init(){var imgEls=getElementsByClass("pixastic",null,"img");var canvasEls=getElementsByClass("pixastic",null,"canvas");var elements=imgEls.concat(canvasEls);for(var i=0;i<elements.length;i++){(function(){var el=elements[i];var actions=[];var classes=el.className.split(" ");for(var c=0;c<classes.length;c++){var cls=classes[c];if(cls.substring(0,9)=="pixastic-"){var actionName=cls.substring(9);if(actionName!="")
actions.push(actionName);}}
if(actions.length){if(el.tagName.toLowerCase()=="img"){var dataImg=new Image();dataImg.src=el.src;if(dataImg.complete){for(var a=0;a<actions.length;a++){var res=Pixastic.applyAction(el,el,actions[a],null);if(res)
el=res;}}else{dataImg.onload=function(){for(var a=0;a<actions.length;a++){var res=Pixastic.applyAction(el,el,actions[a],null)
if(res)
el=res;}}}}else{setTimeout(function(){for(var a=0;a<actions.length;a++){var res=Pixastic.applyAction(el,el,actions[a],null);if(res)
el=res;}},1);}}})();}}
if(typeof pixastic_parseonload!="undefined"&&pixastic_parseonload)
onready(init);function getElementsByClass(searchClass,node,tag){var classElements=new Array();if(node==null)
node=document;if(tag==null)
tag='*';var els=node.getElementsByTagName(tag);var elsLen=els.length;var pattern=new RegExp("(^|\\s)"+searchClass+"(\\s|$)");for(i=0,j=0;i<elsLen;i++){if(pattern.test(els[i].className)){classElements[j]=els[i];j++;}}
return classElements;}
var debugElement;function writeDebug(text,level){if(!Pixastic.debug)return;try{switch(level){case"warn":console.warn("Pixastic:",text);break;case"error":console.error("Pixastic:",text);break;default:console.log("Pixastic:",text);}}catch(e){}
if(!debugElement){}}
var hasCanvas=(function(){var c=document.createElement("canvas");var val=false;try{val=!!((typeof c.getContext=="function")&&c.getContext("2d"));}catch(e){}
return function(){return val;}})();var hasCanvasImageData=(function(){var c=document.createElement("canvas");var val=false;var ctx;try{if(typeof c.getContext=="function"&&(ctx=c.getContext("2d"))){val=(typeof ctx.getImageData=="function");}}catch(e){}
return function(){return val;}})();var hasGlobalAlpha=(function(){var hasAlpha=false;var red=document.createElement("canvas");if(hasCanvas()&&hasCanvasImageData()){red.width=red.height=1;var redctx=red.getContext("2d");redctx.fillStyle="rgb(255,0,0)";redctx.fillRect(0,0,1,1);var blue=document.createElement("canvas");blue.width=blue.height=1;var bluectx=blue.getContext("2d");bluectx.fillStyle="rgb(0,0,255)";bluectx.fillRect(0,0,1,1);redctx.globalAlpha=0.5;redctx.drawImage(blue,0,0);var reddata=redctx.getImageData(0,0,1,1).data;hasAlpha=(reddata[2]!=255);}
return function(){return hasAlpha;}})();return{parseOnLoad:false,debug:false,applyAction:function(img,dataImg,actionName,options){options=options||{};var imageIsCanvas=(img.tagName.toLowerCase()=="canvas");if(imageIsCanvas&&Pixastic.Client.isIE()){if(Pixastic.debug)writeDebug("Tried to process a canvas element but browser is IE.");return false;}
var canvas,ctx;var hasOutputCanvas=false;if(Pixastic.Client.hasCanvas()){hasOutputCanvas=!!options.resultCanvas;canvas=options.resultCanvas||document.createElement("canvas");ctx=canvas.getContext("2d");}
var w=img.offsetWidth;var h=img.offsetHeight;if(imageIsCanvas){w=img.width;h=img.height;}
if(w==0||h==0){if(img.parentNode==null){var oldpos=img.style.position;var oldleft=img.style.left;img.style.position="absolute";img.style.left="-9999px";document.body.appendChild(img);w=img.offsetWidth;h=img.offsetHeight;document.body.removeChild(img);img.style.position=oldpos;img.style.left=oldleft;}else{if(Pixastic.debug)writeDebug("Image has 0 width and/or height.");return;}}
if(actionName.indexOf("(")>-1){var tmp=actionName;actionName=tmp.substr(0,tmp.indexOf("("));var arg=tmp.match(/\((.*?)\)/);if(arg[1]){arg=arg[1].split(";");for(var a=0;a<arg.length;a++){thisArg=arg[a].split("=");if(thisArg.length==2){if(thisArg[0]=="rect"){var rectVal=thisArg[1].split(",");options[thisArg[0]]={left:parseInt(rectVal[0],10)||0,top:parseInt(rectVal[1],10)||0,width:parseInt(rectVal[2],10)||0,height:parseInt(rectVal[3],10)||0}}else{options[thisArg[0]]=thisArg[1];}}}}}
if(!options.rect){options.rect={left:0,top:0,width:w,height:h};}else{options.rect.left=Math.round(options.rect.left);options.rect.top=Math.round(options.rect.top);options.rect.width=Math.round(options.rect.width);options.rect.height=Math.round(options.rect.height);}
var validAction=false;if(Pixastic.Actions[actionName]&&typeof Pixastic.Actions[actionName].process=="function"){validAction=true;}
if(!validAction){if(Pixastic.debug)writeDebug("Invalid action \""+actionName+"\". Maybe file not included?");return false;}
if(!Pixastic.Actions[actionName].checkSupport()){if(Pixastic.debug)writeDebug("Action \""+actionName+"\" not supported by this browser.");return false;}
if(Pixastic.Client.hasCanvas()){if(canvas!==img){canvas.width=w;canvas.height=h;}
if(!hasOutputCanvas){canvas.style.width=w+"px";canvas.style.height=h+"px";}
ctx.drawImage(dataImg,0,0,w,h);if(!img.__pixastic_org_image){canvas.__pixastic_org_image=img;canvas.__pixastic_org_width=w;canvas.__pixastic_org_height=h;}else{canvas.__pixastic_org_image=img.__pixastic_org_image;canvas.__pixastic_org_width=img.__pixastic_org_width;canvas.__pixastic_org_height=img.__pixastic_org_height;}}else if(Pixastic.Client.isIE()&&typeof img.__pixastic_org_style=="undefined"){img.__pixastic_org_style=img.style.cssText;}
var params={image:img,canvas:canvas,width:w,height:h,useData:true,options:options}
var res=Pixastic.Actions[actionName].process(params);if(!res){return false;}
if(Pixastic.Client.hasCanvas()){if(params.useData){if(Pixastic.Client.hasCanvasImageData()){canvas.getContext("2d").putImageData(params.canvasData,options.rect.left,options.rect.top);canvas.getContext("2d").fillRect(0,0,0,0);}}
if(!options.leaveDOM){canvas.title=img.title;canvas.imgsrc=img.imgsrc;if(!imageIsCanvas)canvas.alt=img.alt;if(!imageIsCanvas)canvas.imgsrc=img.src;canvas.className=img.className;canvas.style.cssText=img.style.cssText;canvas.name=img.name;canvas.tabIndex=img.tabIndex;canvas.id=img.id;if(img.parentNode&&img.parentNode.replaceChild){img.parentNode.replaceChild(canvas,img);}}
options.resultCanvas=canvas;return canvas;}
return img;},prepareData:function(params,getCopy){var ctx=params.canvas.getContext("2d");var rect=params.options.rect;var dataDesc=ctx.getImageData(rect.left,rect.top,rect.width,rect.height);var data=dataDesc.data;if(!getCopy)params.canvasData=dataDesc;return data;},process:function(img,actionName,options,callback){if(img.tagName.toLowerCase()=="img"){var dataImg=new Image();dataImg.src=img.src;if(dataImg.complete){var res=Pixastic.applyAction(img,dataImg,actionName,options);if(callback)callback(res);return res;}else{dataImg.onload=function(){var res=Pixastic.applyAction(img,dataImg,actionName,options)
if(callback)callback(res);}}}
if(img.tagName.toLowerCase()=="canvas"){var res=Pixastic.applyAction(img,img,actionName,options);if(callback)callback(res);return res;}},revert:function(img){if(Pixastic.Client.hasCanvas()){if(img.tagName.toLowerCase()=="canvas"&&img.__pixastic_org_image){img.width=img.__pixastic_org_width;img.height=img.__pixastic_org_height;img.getContext("2d").drawImage(img.__pixastic_org_image,0,0);if(img.parentNode&&img.parentNode.replaceChild){img.parentNode.replaceChild(img.__pixastic_org_image,img);}
return img;}}else if(Pixastic.Client.isIE()){if(typeof img.__pixastic_org_style!="undefined")
img.style.cssText=img.__pixastic_org_style;}},Client:{hasCanvas:hasCanvas,hasCanvasImageData:hasCanvasImageData,hasGlobalAlpha:hasGlobalAlpha,isIE:function(){return!!document.all&&!!window.attachEvent&&!window.opera;}},Actions:{}}})();Pixastic.Actions.blurfast={process:function(params){var amount=parseFloat(params.options.amount)||0;var clear=!!(params.options.clear&&params.options.clear!="false");amount=Math.max(0,Math.min(5,amount));if(Pixastic.Client.hasCanvas()){var rect=params.options.rect;var ctx=params.canvas.getContext("2d");ctx.save();ctx.beginPath();ctx.rect(rect.left,rect.top,rect.width,rect.height);ctx.clip();var scale=2;var smallWidth=Math.round(params.width/scale);var smallHeight=Math.round(params.height/scale);var copy=document.createElement("canvas");copy.width=smallWidth;copy.height=smallHeight;var clear=false;var steps=Math.round(amount*20);var copyCtx=copy.getContext("2d");for(var i=0;i<steps;i++){var scaledWidth=Math.max(1,Math.round(smallWidth-i));var scaledHeight=Math.max(1,Math.round(smallHeight-i));copyCtx.clearRect(0,0,smallWidth,smallHeight);copyCtx.drawImage(params.canvas,0,0,params.width,params.height,0,0,scaledWidth,scaledHeight);if(clear)
ctx.clearRect(rect.left,rect.top,rect.width,rect.height);ctx.drawImage(copy,0,0,scaledWidth,scaledHeight,0,0,params.width,params.height);}
ctx.restore();params.useData=false;return true;}else if(Pixastic.Client.isIE()){var radius=10*amount;params.image.style.filter+=" progid:DXImageTransform.Microsoft.Blur(pixelradius="+radius+")";if(params.options.fixMargin||1){params.image.style.marginLeft=(parseInt(params.image.style.marginLeft,10)||0)-Math.round(radius)+"px";params.image.style.marginTop=(parseInt(params.image.style.marginTop,10)||0)-Math.round(radius)+"px";}
return true;}},checkSupport:function(){return(Pixastic.Client.hasCanvas()||Pixastic.Client.isIE());}}

/*! Magnific Popup - v0.9.9 - 2014-09-06
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2014 Dmitry Semenov; */
;(function($) {

	/*>>core*/
	/**
	 * 
	 * Magnific Popup Core JS file
	 * 
	 */

	/**
	 * Private static constants
	 */
	var CLOSE_EVENT = 'Close',
		BEFORE_CLOSE_EVENT = 'BeforeClose',
		AFTER_CLOSE_EVENT = 'AfterClose',
		BEFORE_APPEND_EVENT = 'BeforeAppend',
		MARKUP_PARSE_EVENT = 'MarkupParse',
		OPEN_EVENT = 'Open',
		CHANGE_EVENT = 'Change',
		NS = 'mfp',
		EVENT_NS = '.' + NS,
		READY_CLASS = 'mfp-ready',
		REMOVING_CLASS = 'mfp-removing',
		PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


	/**
	 * Private vars 
	 */
	var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
		MagnificPopup = function(){},
		_isJQ = !!(window.jQuery),
		_prevStatus,
		_window = $(window),
		_body,
		_document,
		_prevContentType,
		_wrapClasses,
		_currPopupType;


	/**
	 * Private functions
	 */
	var _mfpOn = function(name, f) {
			mfp.ev.on(NS + name + EVENT_NS, f);
		},
		_getEl = function(className, appendTo, html, raw) {
			var el = document.createElement('div');
			el.className = 'mfp-'+className;
			if(html) {
				el.innerHTML = html;
			}
			if(!raw) {
				el = $(el);
				if(appendTo) {
					el.appendTo(appendTo);
				}
			} else if(appendTo) {
				appendTo.appendChild(el);
			}
			return el;
		},
		_mfpTrigger = function(e, data) {
			mfp.ev.triggerHandler(NS + e, data);

			if(mfp.st.callbacks) {
				// converts "mfpEventName" to "eventName" callback and triggers it if it's present
				e = e.charAt(0).toLowerCase() + e.slice(1);
				if(mfp.st.callbacks[e]) {
					mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
				}
			}
		},
		_getCloseBtn = function(type) {
			if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
				mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
				_currPopupType = type;
			}
			return mfp.currTemplate.closeBtn;
		},
		// Initialize Magnific Popup only when called at least once
		_checkInstance = function() {
			if(!$.magnificPopup.instance) {
				mfp = new MagnificPopup();
				mfp.init();
				$.magnificPopup.instance = mfp;
			}
		},
		// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
		supportsTransitions = function() {
			var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
				v = ['ms','O','Moz','Webkit']; // 'v' for vendor

			if( s['transition'] !== undefined ) {
				return true; 
			}
				
			while( v.length ) {
				if( v.pop() + 'Transition' in s ) {
					return true;
				}
			}
					
			return false;
		};



	/**
	 * Public functions
	 */
	MagnificPopup.prototype = {

		constructor: MagnificPopup,

		/**
		 * Initializes Magnific Popup plugin. 
		 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
		 */
		init: function() {
			var appVersion = navigator.appVersion;
			mfp.isIE7 = appVersion.indexOf("MSIE 7.") !== -1; 
			mfp.isIE8 = appVersion.indexOf("MSIE 8.") !== -1;
			mfp.isLowIE = mfp.isIE7 || mfp.isIE8;
			mfp.isAndroid = (/android/gi).test(appVersion);
			mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
			mfp.supportsTransition = supportsTransitions();

			// We disable fixed positioned lightbox on devices that don't handle it nicely.
			// If you know a better way of detecting this - let me know.
			mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
			_document = $(document);

			mfp.popupsCache = {};
		},

		/**
		 * Opens popup
		 * @param  data [description]
		 */
		open: function(data) {

			if(!_body) {
				_body = $(document.body);
			}

			var i;

			if(data.isObj === false) { 
				// convert jQuery collection to array to avoid conflicts later
				mfp.items = data.items.toArray();

				mfp.index = 0;
				var items = data.items,
					item;
				for(i = 0; i < items.length; i++) {
					item = items[i];
					if(item.parsed) {
						item = item.el[0];
					}
					if(item === data.el[0]) {
						mfp.index = i;
						break;
					}
				}
			} else {
				mfp.items = $.isArray(data.items) ? data.items : [data.items];
				mfp.index = data.index || 0;
			}

			// if popup is already opened - we just update the content
			if(mfp.isOpen) {
				mfp.updateItemHTML();
				return;
			}
			
			mfp.types = []; 
			_wrapClasses = '';
			if(data.mainEl && data.mainEl.length) {
				mfp.ev = data.mainEl.eq(0);
			} else {
				mfp.ev = _document;
			}

			if(data.key) {
				if(!mfp.popupsCache[data.key]) {
					mfp.popupsCache[data.key] = {};
				}
				mfp.currTemplate = mfp.popupsCache[data.key];
			} else {
				mfp.currTemplate = {};
			}



			mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
			mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

			if(mfp.st.modal) {
				mfp.st.closeOnContentClick = false;
				mfp.st.closeOnBgClick = false;
				mfp.st.showCloseBtn = false;
				mfp.st.enableEscapeKey = false;
			}
			

			// Building markup
			// main containers are created only once
			if(!mfp.bgOverlay) {

				// Dark overlay
				mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
					mfp.close();
				});

				mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
					if(mfp._checkIfClose(e.target)) {
						mfp.close();
					}
				});

				mfp.container = _getEl('container', mfp.wrap);
			}

			mfp.contentContainer = _getEl('content');
			if(mfp.st.preloader) {
				mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
			}


			// Initializing modules
			var modules = $.magnificPopup.modules;
			for(i = 0; i < modules.length; i++) {
				var n = modules[i];
				n = n.charAt(0).toUpperCase() + n.slice(1);
				mfp['init'+n].call(mfp);
			}
			_mfpTrigger('BeforeOpen');


			if(mfp.st.showCloseBtn) {
				// Close button
				if(!mfp.st.closeBtnInside) {
					mfp.wrap.append( _getCloseBtn() );
				} else {
					_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
						values.close_replaceWith = _getCloseBtn(item.type);
					});
					_wrapClasses += ' mfp-close-btn-in';
				}
			}

			if(mfp.st.alignTop) {
				_wrapClasses += ' mfp-align-top';
			}

		

			if(mfp.fixedContentPos) {
				mfp.wrap.css({
					overflow: mfp.st.overflowY,
					overflowX: 'hidden',
					overflowY: mfp.st.overflowY
				});
			} else {
				mfp.wrap.css({ 
					top: _window.scrollTop(),
					position: 'absolute'
				});
			}
			if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
				mfp.bgOverlay.css({
					height: _document.height(),
					position: 'absolute'
				});
			}

			

			if(mfp.st.enableEscapeKey) {
				// Close on ESC key
				_document.on('keyup' + EVENT_NS, function(e) {
					if(e.keyCode === 27) {
						mfp.close();
					}
				});
			}

			_window.on('resize' + EVENT_NS, function() {
				mfp.updateSize();
			});


			if(!mfp.st.closeOnContentClick) {
				_wrapClasses += ' mfp-auto-cursor';
			}
			
			if(_wrapClasses)
				mfp.wrap.addClass(_wrapClasses);


			// this triggers recalculation of layout, so we get it once to not to trigger twice
			var windowHeight = mfp.wH = _window.height();

			
			var windowStyles = {};

			if( mfp.fixedContentPos ) {
	            if(mfp._hasScrollBar(windowHeight)){
	                var s = mfp._getScrollbarSize();
	                if(s) {
	                    windowStyles.marginRight = s;
	                }
	            }
	        }

			if(mfp.fixedContentPos) {
				if(!mfp.isIE7) {
					windowStyles.overflow = 'hidden';
				} else {
					// ie7 double-scroll bug
					$('body, html').css('overflow', 'hidden');
				}
			}

			
			
			var classesToadd = mfp.st.mainClass;
			if(mfp.isIE7) {
				classesToadd += ' mfp-ie7';
			}
			if(classesToadd) {
				mfp._addClassToMFP( classesToadd );
			}

			// add content
			mfp.updateItemHTML();

			_mfpTrigger('BuildControls');

			// remove scrollbar, add margin e.t.c
			$('html').css(windowStyles);
			
			// add everything to DOM
			mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || _body );

			// Save last focused element
			mfp._lastFocusedEl = document.activeElement;
			
			// Wait for next cycle to allow CSS transition
			setTimeout(function() {
				
				if(mfp.content) {
					mfp._addClassToMFP(READY_CLASS);
					mfp._setFocus();
				} else {
					// if content is not defined (not loaded e.t.c) we add class only for BG
					mfp.bgOverlay.addClass(READY_CLASS);
				}
				
				// Trap the focus in popup
				_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

			}, 16);

			mfp.isOpen = true;
			mfp.updateSize(windowHeight);
			_mfpTrigger(OPEN_EVENT);

			return data;
		},

		/**
		 * Closes the popup
		 */
		close: function() {
			if(!mfp.isOpen) return;
			_mfpTrigger(BEFORE_CLOSE_EVENT);

			mfp.isOpen = false;
			// for CSS3 animation
			if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
				mfp._addClassToMFP(REMOVING_CLASS);
				setTimeout(function() {
					mfp._close();
				}, mfp.st.removalDelay);
			} else {
				mfp._close();
			}
		},

		/**
		 * Helper for close() function
		 */
		_close: function() {
			_mfpTrigger(CLOSE_EVENT);

			var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

			mfp.bgOverlay.detach();
			mfp.wrap.detach();
			mfp.container.empty();

			if(mfp.st.mainClass) {
				classesToRemove += mfp.st.mainClass + ' ';
			}

			mfp._removeClassFromMFP(classesToRemove);

			if(mfp.fixedContentPos) {
				var windowStyles = {marginRight: ''};
				if(mfp.isIE7) {
					$('body, html').css('overflow', '');
				} else {
					windowStyles.overflow = '';
				}
				$('html').css(windowStyles);
			}
			
			_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
			mfp.ev.off(EVENT_NS);

			// clean up DOM elements that aren't removed
			mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
			mfp.bgOverlay.attr('class', 'mfp-bg');
			mfp.container.attr('class', 'mfp-container');

			// remove close button from target element
			if(mfp.st.showCloseBtn &&
			(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
				if(mfp.currTemplate.closeBtn)
					mfp.currTemplate.closeBtn.detach();
			}


			if(mfp._lastFocusedEl) {
				$(mfp._lastFocusedEl).focus(); // put tab focus back
			}
			mfp.currItem = null;	
			mfp.content = null;
			mfp.currTemplate = null;
			mfp.prevHeight = 0;

			_mfpTrigger(AFTER_CLOSE_EVENT);
		},
		
		updateSize: function(winHeight) {

			if(mfp.isIOS) {
				// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
				var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
				var height = window.innerHeight * zoomLevel;
				mfp.wrap.css('height', height);
				mfp.wH = height;
			} else {
				mfp.wH = winHeight || _window.height();
			}
			// Fixes #84: popup incorrectly positioned with position:relative on body
			if(!mfp.fixedContentPos) {
				mfp.wrap.css('height', mfp.wH);
			}

			_mfpTrigger('Resize');

		},

		/**
		 * Set content of popup based on current index
		 */
		updateItemHTML: function() {
			var item = mfp.items[mfp.index];

			// Detach and perform modifications
			mfp.contentContainer.detach();

			if(mfp.content)
				mfp.content.detach();

			if(!item.parsed) {
				item = mfp.parseEl( mfp.index );
			}

			var type = item.type;	

			_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
			// BeforeChange event works like so:
			// _mfpOn('BeforeChange', function(e, prevType, newType) { });
			
			mfp.currItem = item;

			if(!mfp.currTemplate[type]) {
				var markup = mfp.st[type] ? mfp.st[type].markup : false;

				// allows to modify markup
				_mfpTrigger('FirstMarkupParse', markup);

				if(markup) {
					mfp.currTemplate[type] = $(markup);
				} else {
					// if there is no markup found we just define that template is parsed
					mfp.currTemplate[type] = true;
				}
			}

			if(_prevContentType && _prevContentType !== item.type) {
				mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
			}
			
			var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
			mfp.appendContent(newContent, type);

			item.preloaded = true;

			_mfpTrigger(CHANGE_EVENT, item);
			_prevContentType = item.type;
			
			// Append container back after its content changed
			mfp.container.prepend(mfp.contentContainer);

			_mfpTrigger('AfterChange');
		},


		/**
		 * Set HTML content of popup
		 */
		appendContent: function(newContent, type) {
			mfp.content = newContent;
			
			if(newContent) {
				if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
					mfp.currTemplate[type] === true) {
					// if there is no markup, we just append close button element inside
					if(!mfp.content.find('.mfp-close').length) {
						mfp.content.append(_getCloseBtn());
					}
				} else {
					mfp.content = newContent;
				}
			} else {
				mfp.content = '';
			}

			_mfpTrigger(BEFORE_APPEND_EVENT);
			mfp.container.addClass('mfp-'+type+'-holder');

			mfp.contentContainer.append(mfp.content);
		},
		/**
		 * Creates Magnific Popup data object based on given data
		 * @param  {int} index Index of item to parse
		 */
		parseEl: function(index) {
			var item = mfp.items[index],
				type;

			if(item.tagName) {
				item = { el: $(item) };
			} else {
				type = item.type;
				item = { data: item, src: item.src };
			}

			if(item.el) {
				var types = mfp.types;

				// check for 'mfp-TYPE' class
				for(var i = 0; i < types.length; i++) {
					if( item.el.hasClass('mfp-'+types[i]) ) {
						type = types[i];
						break;
					}
				}

				item.src = item.el.attr('data-mfp-src');
				if(!item.src) {
					item.src = item.el.attr('href');
				}
			}

			item.type = type || mfp.st.type || 'inline';
			item.index = index;
			item.parsed = true;
			mfp.items[index] = item;
			_mfpTrigger('ElementParse', item);

			return mfp.items[index];
		},


		/**
		 * Initializes single popup or a group of popups
		 */
		addGroup: function(el, options) {
			var eHandler = function(e) {
				e.mfpEl = this;
				mfp._openClick(e, el, options);
			};

			if(!options) {
				options = {};
			} 

			var eName = 'click.magnificPopup';
			options.mainEl = el;
			
			if(options.items) {
				options.isObj = true;
				el.off(eName).on(eName, eHandler);
			} else {
				options.isObj = false;
				if(options.delegate) {
					el.off(eName).on(eName, options.delegate , eHandler);
				} else {
					options.items = el;
					el.off(eName).on(eName, eHandler);
				}
			}
		},
		_openClick: function(e, el, options) {
			var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


			if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey ) ) {
				return;
			}

			var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

			if(disableOn) {
				if($.isFunction(disableOn)) {
					if( !disableOn.call(mfp) ) {
						return true;
					}
				} else { // else it's number
					if( _window.width() < disableOn ) {
						return true;
					}
				}
			}
			
			if(e.type) {
				e.preventDefault();

				// This will prevent popup from closing if element is inside and popup is already opened
				if(mfp.isOpen) {
					e.stopPropagation();
				}
			}
				

			options.el = $(e.mfpEl);
			if(options.delegate) {
				options.items = el.find(options.delegate);
			}
			mfp.open(options);
		},


		/**
		 * Updates text on preloader
		 */
		updateStatus: function(status, text) {

			if(mfp.preloader) {
				if(_prevStatus !== status) {
					mfp.container.removeClass('mfp-s-'+_prevStatus);
				}

				if(!text && status === 'loading') {
					text = mfp.st.tLoading;
				}

				var data = {
					status: status,
					text: text
				};
				// allows to modify status
				_mfpTrigger('UpdateStatus', data);

				status = data.status;
				text = data.text;

				mfp.preloader.html(text);

				mfp.preloader.find('a').on('click', function(e) {
					e.stopImmediatePropagation();
				});

				mfp.container.addClass('mfp-s-'+status);
				_prevStatus = status;
			}
		},


		/*
			"Private" helpers that aren't private at all
		 */
		// Check to close popup or not
		// "target" is an element that was clicked
		_checkIfClose: function(target) {

			if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
				return;
			}

			var closeOnContent = mfp.st.closeOnContentClick;
			var closeOnBg = mfp.st.closeOnBgClick;

			if(closeOnContent && closeOnBg) {
				return true;
			} else {

				// We close the popup if click is on close button or on preloader. Or if there is no content.
				if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
					return true;
				}

				// if click is outside the content
				if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
					if(closeOnBg) {
						// last check, if the clicked element is in DOM, (in case it's removed onclick)
						if( $.contains(document, target) ) {
							return true;
						}
					}
				} else if(closeOnContent) {
					return true;
				}

			}
			return false;
		},
		_addClassToMFP: function(cName) {
			mfp.bgOverlay.addClass(cName);
			mfp.wrap.addClass(cName);
		},
		_removeClassFromMFP: function(cName) {
			this.bgOverlay.removeClass(cName);
			mfp.wrap.removeClass(cName);
		},
		_hasScrollBar: function(winHeight) {
			return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
		},
		_setFocus: function() {
			(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
		},
		_onFocusIn: function(e) {
			if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
				mfp._setFocus();
				return false;
			}
		},
		_parseMarkup: function(template, values, item) {
			var arr;
			if(item.data) {
				values = $.extend(item.data, values);
			}
			_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

			$.each(values, function(key, value) {
				if(value === undefined || value === false) {
					return true;
				}
				arr = key.split('_');
				if(arr.length > 1) {
					var el = template.find(EVENT_NS + '-'+arr[0]);

					if(el.length > 0) {
						var attr = arr[1];
						if(attr === 'replaceWith') {
							if(el[0] !== value[0]) {
								el.replaceWith(value);
							}
						} else if(attr === 'img') {
							if(el.is('img')) {
								el.attr('src', value);
							} else {
								el.replaceWith( '<img src="'+value+'" class="' + el.attr('class') + '" />' );
							}
						} else {
							el.attr(arr[1], value);
						}
					}

				} else {
					template.find(EVENT_NS + '-'+key).html(value);
				}
			});
		},

		_getScrollbarSize: function() {
			// thx David
			if(mfp.scrollbarSize === undefined) {
				var scrollDiv = document.createElement("div");
				scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
				document.body.appendChild(scrollDiv);
				mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
				document.body.removeChild(scrollDiv);
			}
			return mfp.scrollbarSize;
		}

	}; /* MagnificPopup core prototype end */




	/**
	 * Public static functions
	 */
	$.magnificPopup = {
		instance: null,
		proto: MagnificPopup.prototype,
		modules: [],

		open: function(options, index) {
			_checkInstance();	

			if(!options) {
				options = {};
			} else {
				options = $.extend(true, {}, options);
			}
				

			options.isObj = true;
			options.index = index || 0;
			return this.instance.open(options);
		},

		close: function() {
			return $.magnificPopup.instance && $.magnificPopup.instance.close();
		},

		registerModule: function(name, module) {
			if(module.options) {
				$.magnificPopup.defaults[name] = module.options;
			}
			$.extend(this.proto, module.proto);			
			this.modules.push(name);
		},

		defaults: {   

			// Info about options is in docs:
			// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options
			
			disableOn: 0,	

			key: null,

			midClick: false,

			mainClass: '',

			preloader: true,

			focus: '', // CSS selector of input to focus after popup is opened
			
			closeOnContentClick: false,

			closeOnBgClick: true,

			closeBtnInside: true, 

			showCloseBtn: true,

			enableEscapeKey: true,

			modal: false,

			alignTop: false,
		
			removalDelay: 0,

			prependTo: null,
			
			fixedContentPos: 'auto', 
		
			fixedBgPos: 'auto',

			overflowY: 'auto',

			closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>',

			tClose: 'Close (Esc)',

			tLoading: 'Loading...'

		}
	};



	$.fn.magnificPopup = function(options) {
		_checkInstance();

		var jqEl = $(this);

		// We call some API method of first param is a string
		if (typeof options === "string" ) {

			if(options === 'open') {
				var items,
					itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
					index = parseInt(arguments[1], 10) || 0;

				if(itemOpts.items) {
					items = itemOpts.items[index];
				} else {
					items = jqEl;
					if(itemOpts.delegate) {
						items = items.find(itemOpts.delegate);
					}
					items = items.eq( index );
				}
				mfp._openClick({mfpEl:items}, jqEl, itemOpts);
			} else {
				if(mfp.isOpen)
					mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
			}

		} else {
			// clone options obj
			options = $.extend(true, {}, options);
			
			/*
			 * As Zepto doesn't support .data() method for objects 
			 * and it works only in normal browsers
			 * we assign "options" object directly to the DOM element. FTW!
			 */
			if(_isJQ) {
				jqEl.data('magnificPopup', options);
			} else {
				jqEl[0].magnificPopup = options;
			}

			mfp.addGroup(jqEl, options);

		}
		return jqEl;
	};


	//Quick benchmark
	/*
	var start = performance.now(),
		i,
		rounds = 1000;

	for(i = 0; i < rounds; i++) {

	}
	console.log('Test #1:', performance.now() - start);

	start = performance.now();
	for(i = 0; i < rounds; i++) {

	}
	console.log('Test #2:', performance.now() - start);
	*/


	/*>>core*/

	/*>>inline*/

	var INLINE_NS = 'inline',
		_hiddenClass,
		_inlinePlaceholder, 
		_lastInlineElement,
		_putInlineElementsBack = function() {
			if(_lastInlineElement) {
				_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
				_lastInlineElement = null;
			}
		};

	$.magnificPopup.registerModule(INLINE_NS, {
		options: {
			hiddenClass: 'hide', // will be appended with `mfp-` prefix
			markup: '',
			tNotFound: 'Content not found'
		},
		proto: {

			initInline: function() {
				mfp.types.push(INLINE_NS);

				_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
					_putInlineElementsBack();
				});
			},

			getInline: function(item, template) {

				_putInlineElementsBack();

				if(item.src) {
					var inlineSt = mfp.st.inline,
						el = $(item.src);

					if(el.length) {

						// If target element has parent - we replace it with placeholder and put it back after popup is closed
						var parent = el[0].parentNode;
						if(parent && parent.tagName) {
							if(!_inlinePlaceholder) {
								_hiddenClass = inlineSt.hiddenClass;
								_inlinePlaceholder = _getEl(_hiddenClass);
								_hiddenClass = 'mfp-'+_hiddenClass;
							}
							// replace target inline element with placeholder
							_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
						}

						mfp.updateStatus('ready');
					} else {
						mfp.updateStatus('error', inlineSt.tNotFound);
						el = $('<div>');
					}

					item.inlineElement = el;
					return el;
				}

				mfp.updateStatus('ready');
				mfp._parseMarkup(template, {}, item);
				return template;
			}
		}
	});

	/*>>inline*/

	/*>>ajax*/
	var AJAX_NS = 'ajax',
		_ajaxCur,
		_removeAjaxCursor = function() {
			if(_ajaxCur) {
				_body.removeClass(_ajaxCur);
			}
		},
		_destroyAjaxRequest = function() {
			_removeAjaxCursor();
			if(mfp.req) {
				mfp.req.abort();
			}
		};

	$.magnificPopup.registerModule(AJAX_NS, {

		options: {
			settings: null,
			cursor: 'mfp-ajax-cur',
			tError: '<a href="%url%">The content</a> could not be loaded.'
		},

		proto: {
			initAjax: function() {
				mfp.types.push(AJAX_NS);
				_ajaxCur = mfp.st.ajax.cursor;

				_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
				_mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
			},
			getAjax: function(item) {

				if(_ajaxCur)
					_body.addClass(_ajaxCur);

				mfp.updateStatus('loading');

				var opts = $.extend({
					url: item.src,
					success: function(data, textStatus, jqXHR) {
						var temp = {
							data:data,
							xhr:jqXHR
						};

						_mfpTrigger('ParseAjax', temp);

						mfp.appendContent( $(temp.data), AJAX_NS );

						item.finished = true;

						_removeAjaxCursor();

						mfp._setFocus();

						setTimeout(function() {
							mfp.wrap.addClass(READY_CLASS);
						}, 16);

						mfp.updateStatus('ready');

						_mfpTrigger('AjaxContentAdded');
					},
					error: function() {
						_removeAjaxCursor();
						item.finished = item.loadError = true;
						mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
					}
				}, mfp.st.ajax.settings);

				mfp.req = $.ajax(opts);

				return '';
			}
		}
	});


	/*>>ajax*/

	/*>>image*/
	var _imgInterval,
		_getTitle = function(item) {
			if(item.data && item.data.title !== undefined) 
				return item.data.title;

			var src = mfp.st.image.titleSrc;

			if(src) {
				if($.isFunction(src)) {
					return src.call(mfp, item);
				} else if(item.el) {
					return item.el.attr(src) || '';
				}
			}
			return '';
		};

	$.magnificPopup.registerModule('image', {

		options: {
			markup: '<div class="mfp-figure">'+
						'<div class="mfp-close"></div>'+
						'<figure>'+
							'<div class="mfp-img"></div>'+
							'<figcaption>'+
								'<div class="mfp-bottom-bar">'+
									'<div class="mfp-title"></div>'+
									'<div class="mfp-counter"></div>'+
								'</div>'+
							'</figcaption>'+
						'</figure>'+
					'</div>',
			cursor: 'mfp-zoom-out-cur',
			titleSrc: 'title', 
			verticalFit: true,
			tError: '<a href="%url%">The image</a> could not be loaded.'
		},

		proto: {
			initImage: function() {
				var imgSt = mfp.st.image,
					ns = '.image';

				mfp.types.push('image');

				_mfpOn(OPEN_EVENT+ns, function() {
					if(mfp.currItem.type === 'image' && imgSt.cursor) {
						_body.addClass(imgSt.cursor);
					}
				});

				_mfpOn(CLOSE_EVENT+ns, function() {
					if(imgSt.cursor) {
						_body.removeClass(imgSt.cursor);
					}
					_window.off('resize' + EVENT_NS);
				});

				_mfpOn('Resize'+ns, mfp.resizeImage);
				if(mfp.isLowIE) {
					_mfpOn('AfterChange', mfp.resizeImage);
				}
			},
			resizeImage: function() {
				var item = mfp.currItem;
				if(!item || !item.img) return;

				if(mfp.st.image.verticalFit) {
					var decr = 0;
					// fix box-sizing in ie7/8
					if(mfp.isLowIE) {
						decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
					}
					item.img.css('max-height', mfp.wH-decr);
				}
			},
			_onImageHasSize: function(item) {
				if(item.img) {
					
					item.hasSize = true;

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					
					item.isCheckingImgSize = false;

					_mfpTrigger('ImageHasSize', item);

					if(item.imgHidden) {
						if(mfp.content)
							mfp.content.removeClass('mfp-loading');
						
						item.imgHidden = false;
					}

				}
			},

			/**
			 * Function that loops until the image has size to display elements that rely on it asap
			 */
			findImageSize: function(item) {

				var counter = 0,
					img = item.img[0],
					mfpSetInterval = function(delay) {

						if(_imgInterval) {
							clearInterval(_imgInterval);
						}
						// decelerating interval that checks for size of an image
						_imgInterval = setInterval(function() {
							if(img.naturalWidth > 0) {
								mfp._onImageHasSize(item);
								return;
							}

							if(counter > 200) {
								clearInterval(_imgInterval);
							}

							counter++;
							if(counter === 3) {
								mfpSetInterval(10);
							} else if(counter === 40) {
								mfpSetInterval(50);
							} else if(counter === 100) {
								mfpSetInterval(500);
							}
						}, delay);
					};

				mfpSetInterval(1);
			},

			getImage: function(item, template) {

				var guard = 0,

					// image load complete handler
					onLoadComplete = function() {
						if(item) {
							if (item.img[0].complete) {
								item.img.off('.mfploader');
								
								if(item === mfp.currItem){
									mfp._onImageHasSize(item);

									mfp.updateStatus('ready');
								}

								item.hasSize = true;
								item.loaded = true;

								_mfpTrigger('ImageLoadComplete');
								
							}
							else {
								// if image complete check fails 200 times (20 sec), we assume that there was an error.
								guard++;
								if(guard < 200) {
									setTimeout(onLoadComplete,100);
								} else {
									onLoadError();
								}
							}
						}
					},

					// image error handler
					onLoadError = function() {
						if(item) {
							item.img.off('.mfploader');
							if(item === mfp.currItem){
								mfp._onImageHasSize(item);
								mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
							}

							item.hasSize = true;
							item.loaded = true;
							item.loadError = true;
						}
					},
					imgSt = mfp.st.image;


				var el = template.find('.mfp-img');
				if(el.length) {
					var img = document.createElement('img');
					img.className = 'mfp-img';
					item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
					img.src = item.src;

					// without clone() "error" event is not firing when IMG is replaced by new IMG
					// TODO: find a way to avoid such cloning
					if(el.is('img')) {
						item.img = item.img.clone();
					}

					img = item.img[0];
					if(img.naturalWidth > 0) {
						item.hasSize = true;
					} else if(!img.width) {										
						item.hasSize = false;
					}
				}

				mfp._parseMarkup(template, {
					title: _getTitle(item),
					img_replaceWith: item.img
				}, item);

				mfp.resizeImage();

				if(item.hasSize) {
					if(_imgInterval) clearInterval(_imgInterval);

					if(item.loadError) {
						template.addClass('mfp-loading');
						mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
					} else {
						template.removeClass('mfp-loading');
						mfp.updateStatus('ready');
					}
					return template;
				}

				mfp.updateStatus('loading');
				item.loading = true;

				if(!item.hasSize) {
					item.imgHidden = true;
					template.addClass('mfp-loading');
					mfp.findImageSize(item);
				} 

				return template;
			}
		}
	});



	/*>>image*/

	/*>>zoom*/
	var hasMozTransform,
		getHasMozTransform = function() {
			if(hasMozTransform === undefined) {
				hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
			}
			return hasMozTransform;		
		};

	$.magnificPopup.registerModule('zoom', {

		options: {
			enabled: false,
			easing: 'ease-in-out',
			duration: 300,
			opener: function(element) {
				return element.is('img') ? element : element.find('img');
			}
		},

		proto: {

			initZoom: function() {
				var zoomSt = mfp.st.zoom,
					ns = '.zoom',
					image;
					
				if(!zoomSt.enabled || !mfp.supportsTransition) {
					return;
				}

				var duration = zoomSt.duration,
					getElToAnimate = function(image) {
						var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
							transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
							cssObj = {
								position: 'fixed',
								zIndex: 9999,
								left: 0,
								top: 0,
								'-webkit-backface-visibility': 'hidden'
							},
							t = 'transition';

						cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

						newImg.css(cssObj);
						return newImg;
					},
					showMainContent = function() {
						mfp.content.css('visibility', 'visible');
					},
					openTimeout,
					animatedImg;

				_mfpOn('BuildControls'+ns, function() {
					if(mfp._allowZoom()) {

						clearTimeout(openTimeout);
						mfp.content.css('visibility', 'hidden');

						// Basically, all code below does is clones existing image, puts in on top of the current one and animated it
						
						image = mfp._getItemToZoom();

						if(!image) {
							showMainContent();
							return;
						}

						animatedImg = getElToAnimate(image); 
						
						animatedImg.css( mfp._getOffset() );

						mfp.wrap.append(animatedImg);

						openTimeout = setTimeout(function() {
							animatedImg.css( mfp._getOffset( true ) );
							openTimeout = setTimeout(function() {

								showMainContent();

								setTimeout(function() {
									animatedImg.remove();
									image = animatedImg = null;
									_mfpTrigger('ZoomAnimationEnded');
								}, 16); // avoid blink when switching images 

							}, duration); // this timeout equals animation duration

						}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


						// Lots of timeouts...
					}
				});
				_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
					if(mfp._allowZoom()) {

						clearTimeout(openTimeout);

						mfp.st.removalDelay = duration;

						if(!image) {
							image = mfp._getItemToZoom();
							if(!image) {
								return;
							}
							animatedImg = getElToAnimate(image);
						}
						
						
						animatedImg.css( mfp._getOffset(true) );
						mfp.wrap.append(animatedImg);
						mfp.content.css('visibility', 'hidden');
						
						setTimeout(function() {
							animatedImg.css( mfp._getOffset() );
						}, 16);
					}

				});

				_mfpOn(CLOSE_EVENT+ns, function() {
					if(mfp._allowZoom()) {
						showMainContent();
						if(animatedImg) {
							animatedImg.remove();
						}
						image = null;
					}	
				});
			},

			_allowZoom: function() {
				return mfp.currItem.type === 'image';
			},

			_getItemToZoom: function() {
				if(mfp.currItem.hasSize) {
					return mfp.currItem.img;
				} else {
					return false;
				}
			},

			// Get element postion relative to viewport
			_getOffset: function(isLarge) {
				var el;
				if(isLarge) {
					el = mfp.currItem.img;
				} else {
					el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
				}

				var offset = el.offset();
				var paddingTop = parseInt(el.css('padding-top'),10);
				var paddingBottom = parseInt(el.css('padding-bottom'),10);
				offset.top -= ( $(window).scrollTop() - paddingTop );


				/*
				
				Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

				 */
				var obj = {
					width: el.width(),
					// fix Zepto height+padding issue
					height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
				};

				// I hate to do this, but there is no another option
				if( getHasMozTransform() ) {
					obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
				} else {
					obj.left = offset.left;
					obj.top = offset.top;
				}
				return obj;
			}

		}
	});



	/*>>zoom*/

	/*>>iframe*/

	var IFRAME_NS = 'iframe',
		_emptyPage = '//about:blank',
		
		_fixIframeBugs = function(isShowing) {
			if(mfp.currTemplate[IFRAME_NS]) {
				var el = mfp.currTemplate[IFRAME_NS].find('iframe');
				if(el.length) { 
					// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
					if(!isShowing) {
						el[0].src = _emptyPage;
					}

					// IE8 black screen bug fix
					if(mfp.isIE8) {
						el.css('display', isShowing ? 'block' : 'none');
					}
				}
			}
		};

	$.magnificPopup.registerModule(IFRAME_NS, {

		options: {
			markup: '<div class="mfp-iframe-scaler">'+
						'<div class="mfp-close"></div>'+
						'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
					'</div>',

			srcAction: 'iframe_src',

			// we don't care and support only one default type of URL by default
			patterns: {
				youtube: {
					index: 'youtube.com', 
					id: 'v=', 
					src: '//www.youtube.com/embed/%id%?autoplay=1'
				},
				vimeo: {
					index: 'vimeo.com/',
					id: '/',
					src: '//player.vimeo.com/video/%id%?autoplay=1'
				},
				gmaps: {
					index: '//maps.google.',
					src: '%id%&output=embed'
				}
			}
		},

		proto: {
			initIframe: function() {
				mfp.types.push(IFRAME_NS);

				_mfpOn('BeforeChange', function(e, prevType, newType) {
					if(prevType !== newType) {
						if(prevType === IFRAME_NS) {
							_fixIframeBugs(); // iframe if removed
						} else if(newType === IFRAME_NS) {
							_fixIframeBugs(true); // iframe is showing
						} 
					}// else {
						// iframe source is switched, don't do anything
					//}
				});

				_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
					_fixIframeBugs();
				});
			},

			getIframe: function(item, template) {
				var embedSrc = item.src;
				var iframeSt = mfp.st.iframe;
					
				$.each(iframeSt.patterns, function() {
					if(embedSrc.indexOf( this.index ) > -1) {
						if(this.id) {
							if(typeof this.id === 'string') {
								embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
							} else {
								embedSrc = this.id.call( this, embedSrc );
							}
						}
						embedSrc = this.src.replace('%id%', embedSrc );
						return false; // break;
					}
				});
				
				var dataObj = {};
				if(iframeSt.srcAction) {
					dataObj[iframeSt.srcAction] = embedSrc;
				}
				mfp._parseMarkup(template, dataObj, item);

				mfp.updateStatus('ready');

				return template;
			}
		}
	});



	/*>>iframe*/

	/*>>gallery*/
	/**
	 * Get looped index depending on number of slides
	 */
	var _getLoopedId = function(index) {
			var numSlides = mfp.items.length;
			if(index > numSlides - 1) {
				return index - numSlides;
			} else  if(index < 0) {
				return numSlides + index;
			}
			return index;
		},
		_replaceCurrTotal = function(text, curr, total) {
			return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
		};

	$.magnificPopup.registerModule('gallery', {

		options: {
			enabled: false,
			arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
			preload: [0,2],
			navigateByImgClick: true,
			arrows: true,

			tPrev: 'Previous (Left arrow key)',
			tNext: 'Next (Right arrow key)',
			tCounter: '%curr% of %total%'
		},

		proto: {
			initGallery: function() {

				var gSt = mfp.st.gallery,
					ns = '.mfp-gallery',
					supportsFastClick = Boolean($.fn.mfpFastClick);

				mfp.direction = true; // true - next, false - prev
				
				if(!gSt || !gSt.enabled ) return false;

				_wrapClasses += ' mfp-gallery';

				_mfpOn(OPEN_EVENT+ns, function() {

					if(gSt.navigateByImgClick) {
						mfp.wrap.on('click'+ns, '.mfp-img', function() {
							if(mfp.items.length > 1) {
								mfp.next();
								return false;
							}
						});
					}

					_document.on('keydown'+ns, function(e) {
						if (e.keyCode === 37) {
							mfp.prev();
						} else if (e.keyCode === 39) {
							mfp.next();
						}
					});
				});

				_mfpOn('UpdateStatus'+ns, function(e, data) {
					if(data.text) {
						data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
					}
				});

				_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
					var l = mfp.items.length;
					values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
				});

				_mfpOn('BuildControls' + ns, function() {
					if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
						var markup = gSt.arrowMarkup,
							arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),			
							arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

						var eName = supportsFastClick ? 'mfpFastClick' : 'click';
						arrowLeft[eName](function() {
							mfp.prev();
						});			
						arrowRight[eName](function() {
							mfp.next();
						});	

						// Polyfill for :before and :after (adds elements with classes mfp-a and mfp-b)
						if(mfp.isIE7) {
							_getEl('b', arrowLeft[0], false, true);
							_getEl('a', arrowLeft[0], false, true);
							_getEl('b', arrowRight[0], false, true);
							_getEl('a', arrowRight[0], false, true);
						}

						mfp.container.append(arrowLeft.add(arrowRight));
					}
				});

				_mfpOn(CHANGE_EVENT+ns, function() {
					if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

					mfp._preloadTimeout = setTimeout(function() {
						mfp.preloadNearbyImages();
						mfp._preloadTimeout = null;
					}, 16);
				});


				_mfpOn(CLOSE_EVENT+ns, function() {
					_document.off(ns);
					mfp.wrap.off('click'+ns);
				
					if(mfp.arrowLeft && supportsFastClick) {
						mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick();
					}
					mfp.arrowRight = mfp.arrowLeft = null;
				});

			}, 
			next: function() {
				mfp.direction = true;
				mfp.index = _getLoopedId(mfp.index + 1);
				mfp.updateItemHTML();
			},
			prev: function() {
				mfp.direction = false;
				mfp.index = _getLoopedId(mfp.index - 1);
				mfp.updateItemHTML();
			},
			goTo: function(newIndex) {
				mfp.direction = (newIndex >= mfp.index);
				mfp.index = newIndex;
				mfp.updateItemHTML();
			},
			preloadNearbyImages: function() {
				var p = mfp.st.gallery.preload,
					preloadBefore = Math.min(p[0], mfp.items.length),
					preloadAfter = Math.min(p[1], mfp.items.length),
					i;

				for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
					mfp._preloadItem(mfp.index+i);
				}
				for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
					mfp._preloadItem(mfp.index-i);
				}
			},
			_preloadItem: function(index) {
				index = _getLoopedId(index);

				if(mfp.items[index].preloaded) {
					return;
				}

				var item = mfp.items[index];
				if(!item.parsed) {
					item = mfp.parseEl( index );
				}

				_mfpTrigger('LazyLoad', item);

				if(item.type === 'image') {
					item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
						item.hasSize = true;
					}).on('error.mfploader', function() {
						item.hasSize = true;
						item.loadError = true;
						_mfpTrigger('LazyLoadError', item);
					}).attr('src', item.src);
				}


				item.preloaded = true;
			}
		}
	});

	/*
	Touch Support that might be implemented some day

	addSwipeGesture: function() {
		var startX,
			moved,
			multipleTouches;

			return;

		var namespace = '.mfp',
			addEventNames = function(pref, down, move, up, cancel) {
				mfp._tStart = pref + down + namespace;
				mfp._tMove = pref + move + namespace;
				mfp._tEnd = pref + up + namespace;
				mfp._tCancel = pref + cancel + namespace;
			};

		if(window.navigator.msPointerEnabled) {
			addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
		} else if('ontouchstart' in window) {
			addEventNames('touch', 'start', 'move', 'end', 'cancel');
		} else {
			return;
		}
		_window.on(mfp._tStart, function(e) {
			var oE = e.originalEvent;
			multipleTouches = moved = false;
			startX = oE.pageX || oE.changedTouches[0].pageX;
		}).on(mfp._tMove, function(e) {
			if(e.originalEvent.touches.length > 1) {
				multipleTouches = e.originalEvent.touches.length;
			} else {
				//e.preventDefault();
				moved = true;
			}
		}).on(mfp._tEnd + ' ' + mfp._tCancel, function(e) {
			if(moved && !multipleTouches) {
				var oE = e.originalEvent,
					diff = startX - (oE.pageX || oE.changedTouches[0].pageX);

				if(diff > 20) {
					mfp.next();
				} else if(diff < -20) {
					mfp.prev();
				}
			}
		});
	},
	*/


	/*>>gallery*/

	/*>>retina*/

	var RETINA_NS = 'retina';

	$.magnificPopup.registerModule(RETINA_NS, {
		options: {
			replaceSrc: function(item) {
				return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
			},
			ratio: 1 // Function or number.  Set to 1 to disable.
		},
		proto: {
			initRetina: function() {
				if(window.devicePixelRatio > 1) {

					var st = mfp.st.retina,
						ratio = st.ratio;

					ratio = !isNaN(ratio) ? ratio : ratio();

					if(ratio > 1) {
						_mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
							item.img.css({
								'max-width': item.img[0].naturalWidth / ratio,
								'width': '100%'
							});
						});
						_mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
							item.src = st.replaceSrc(item, ratio);
						});
					}
				}

			}
		}
	});

	/*>>retina*/

	/*>>fastclick*/
	/**
	 * FastClick event implementation. (removes 300ms delay on touch devices)
	 * Based on https://developers.google.com/mobile/articles/fast_buttons
	 *
	 * You may use it outside the Magnific Popup by calling just:
	 *
	 * $('.your-el').mfpFastClick(function() {
	 *     console.log('Clicked!');
	 * });
	 *
	 * To unbind:
	 * $('.your-el').destroyMfpFastClick();
	 * 
	 * 
	 * Note that it's a very basic and simple implementation, it blocks ghost click on the same element where it was bound.
	 * If you need something more advanced, use plugin by FT Labs https://github.com/ftlabs/fastclick
	 * 
	 */

	(function() {
		var ghostClickDelay = 1000,
			supportsTouch = 'ontouchstart' in window,
			unbindTouchMove = function() {
				_window.off('touchmove'+ns+' touchend'+ns);
			},
			eName = 'mfpFastClick',
			ns = '.'+eName;


		// As Zepto.js doesn't have an easy way to add custom events (like jQuery), so we implement it in this way
		$.fn.mfpFastClick = function(callback) {

			return $(this).each(function() {

				var elem = $(this),
					lock;

				if( supportsTouch ) {

					var timeout,
						startX,
						startY,
						pointerMoved,
						point,
						numPointers;

					elem.on('touchstart' + ns, function(e) {
						pointerMoved = false;
						numPointers = 1;

						point = e.originalEvent ? e.originalEvent.touches[0] : e.touches[0];
						startX = point.clientX;
						startY = point.clientY;

						_window.on('touchmove'+ns, function(e) {
							point = e.originalEvent ? e.originalEvent.touches : e.touches;
							numPointers = point.length;
							point = point[0];
							if (Math.abs(point.clientX - startX) > 10 ||
								Math.abs(point.clientY - startY) > 10) {
								pointerMoved = true;
								unbindTouchMove();
							}
						}).on('touchend'+ns, function(e) {
							unbindTouchMove();
							if(pointerMoved || numPointers > 1) {
								return;
							}
							lock = true;
							e.preventDefault();
							clearTimeout(timeout);
							timeout = setTimeout(function() {
								lock = false;
							}, ghostClickDelay);
							callback();
						});
					});

				}

				elem.on('click' + ns, function() {
					if(!lock) {
						callback();
					}
				});
			});
		};

		$.fn.destroyMfpFastClick = function() {
			$(this).off('touchstart' + ns + ' click' + ns);
			if(supportsTouch) _window.off('touchmove'+ns+' touchend'+ns);
		};
})();

/*>>fastclick*/
 _checkInstance(); })(window.jQuery || window.Zepto);

jQuery(document).ready(function($) {
	dtGlobals.magnificPopupBaseConfig = {
	type: 'image',
	tLoading: 'Loading image ...',
	mainClass: 'mfp-img-mobile',
	removalDelay: 300,
	image: {
		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		titleSrc: function(item) {
			return this.st.dt.getItemTitle(item);
		}
	},
	iframe: {
		markup: '<div class="mfp-iframe-scaler">'+
				'<div class="mfp-close"></div>'+
				'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
				'<div class="mfp-bottom-bar">'+
				'<div class="mfp-title"></div>'+
				'<div class="mfp-counter"></div>'+
				'</div>'+
				'</div>'
	},
	callbacks: {
		markupParse: function(template, values, item) {
			if ( 'iframe' == item.type ) {
				template.find('.mfp-title').html( this.st.dt.getItemTitle(item) );
			}

			if ( !this.ev.attr('data-pretty-share') ) {
				template.addClass("no-share-buttons");
			}
		},
		change: function() {
			if (this.isOpen) {
				/*transition between the images in the gallery*/
				this.wrap.addClass('mfp-open');
			}
		},
		beforeClose: function() {
			$('body, html').css('overflow','');
			this.wrap.removeClass('mfp-open');
			this.content.addClass('mfp-removing');
		},
		close: function() {
			this.content.removeClass('mfp-removing'); 
		},
		beforeOpen: function() {

			var magnificPopup = this;
			// create settings container
			if ( typeof this.st.dt == 'undefined' ) {
				this.st.dt = {};
			}

			// save share buttons array
			this.st.dt.shareButtonsList = this.ev.attr('data-pretty-share') ? this.ev.attr('data-pretty-share').split(',') : new Array();

			// share buttons template
			this.st.dt.shareButtonsTemplates = {
				twitter : '<a href="//twitter.com/home?status={location_href}%20{share_title}" class="share-button twitter" target="_blank" title="twitter"><svg class="icon" viewBox="0 0 22 22"><path d="M17.614,5.604c-0.556,0.325-1.171,0.56-1.822,0.688c-0.526-0.551-1.271-0.895-2.099-0.895c-1.586,0-2.873,1.268-2.873,2.83c0,0.221,0.025,0.438,0.074,0.645C8.508,8.753,6.393,7.625,4.977,5.913C4.729,6.33,4.588,6.816,4.588,7.336c0,0.982,0.508,1.85,1.276,2.354c-0.47-0.014-0.912-0.141-1.3-0.354c0,0.013,0,0.024,0,0.035c0,1.372,0.991,2.514,2.304,2.775c-0.241,0.062-0.495,0.101-0.756,0.101c-0.186,0-0.365-0.019-0.541-0.054c0.365,1.127,1.427,1.945,2.682,1.97c-0.982,0.756-2.222,1.208-3.567,1.208c-0.232,0-0.461-0.016-0.686-0.04c1.271,0.804,2.78,1.272,4.402,1.272c5.286,0,8.171-4.312,8.171-8.053c0-0.123-0.003-0.246-0.009-0.367c0.563-0.397,1.05-0.895,1.436-1.463c-0.516,0.225-1.068,0.378-1.648,0.446C16.943,6.817,17.398,6.262,17.614,5.604z"/></svg></a>',
				facebook : '<a href="//www.facebook.com/sharer.php?s=100&amp;p[url]={location_href}&amp;p[title]={share_title}&amp;p[images][0]={image_src}" class="share-button facebook" target="_blank" title="facebook"><svg class="icon" viewBox="0 0 22 22" ><path d="M13.537,10.513l-1.74,0.001l0.051,6.648H9.395l0.014-6.648H7.816V8.413l1.592-0.001L9.407,7.177c0-1.713,0.485-2.755,2.593-2.755h1.758v2.101H12.66c-0.824,0-0.863,0.292-0.863,0.84l-0.004,1.049h1.975L13.537,10.513z"/></svg></a>',
				google : '<a href="////plus.google.com/share?url={location_href}&amp;title={share_title}" class="share-button google" target="_blank" title="google+"><svg class="icon" viewBox="0 0 22 22" ><path d="M18.02,9.145h-1.953l0.021,1.958h-1.344l-0.022-1.937l-1.854-0.019l-0.024-1.258l1.896-0.008V5.864h1.343V7.86l1.936,0.042L18.02,9.145L18.02,9.145z M12.254,14.303c0,1.217-1.108,2.698-3.9,2.698c-2.043,0-3.748-0.884-3.748-2.364c0-1.146,0.725-2.625,4.107-2.625c-0.5-0.412-0.625-0.984-0.318-1.604c-1.98,0-2.995-1.166-2.995-2.645c0-1.447,1.076-2.762,3.271-2.762c0.557,0,3.54,0,3.54,0l-0.809,0.823h-0.923C11.13,6.241,11.52,6.97,11.52,7.813c0,0.778-0.427,1.407-1.036,1.874c-1.085,0.838-0.807,1.354,0.312,2.133c1.091,0.845,1.464,1.47,1.464,2.482H12.254z M9.863,7.771C9.712,6.847,8.967,6.09,8.095,6.068c-0.872-0.021-1.457,0.687-1.307,1.61C6.939,8.615,7.726,9.24,8.663,9.24c0.848,0.093,1.305-0.531,1.201-1.458L9.863,7.771z M10.544,14.486c0-0.707-0.78-1.379-2.087-1.379c-1.178-0.015-2.179,0.615-2.179,1.354c0,0.729,0.833,1.354,1.978,1.359c1.56-0.031,2.338-0.553,2.338-1.334H10.544z"/></svg></a>',
				pinterest : '<a href="//pinterest.com/pin/create/button/?url={location_href}&amp;description={share_title}&amp;media={image_src}" class="share-button pinterest" target="_blank" title="pin it"><svg class="icon" viewBox="0 0 22 22"><path d="M7.318,12.361c0.703-1.242-0.227-1.515-0.372-2.415c-0.596-3.68,4.244-6.193,6.779-3.622c1.754,1.781,0.599,7.257-2.229,6.688C8.786,12.467,12.82,8.11,10.66,7.255c-1.757-0.696-2.689,2.126-1.856,3.528c-0.489,2.412-1.541,4.683-1.114,7.708c1.381-1.002,1.847-2.923,2.228-4.923c0.695,0.422,1.065,0.859,1.951,0.929c3.264,0.253,5.089-3.258,4.641-6.5c-0.396-2.872-3.259-4.335-6.313-3.992c-2.415,0.27-4.822,2.222-4.922,5.014C5.212,10.723,5.697,12.002,7.318,12.361z"/></svg></a>',
				linkedin : '<a href="//www.linkedin.com/shareArticle?mini=true&url={location_href}&title={share_title}" class="share-button linkedin" target="_blank" ><svg class="icon" viewBox="0 0 22 22"><path d="M9.269 7.02c0 0.714-0.586 1.293-1.307 1.293c-0.722 0-1.307-0.579-1.307-1.293 c0-0.712 0.585-1.291 1.307-1.291C8.683 5.7 9.3 6.3 9.3 7.02H9.269z M9.061 9.279H6.873v7.392h2.188V9.279z M12.91 9.3 h-1.795l-0.027 7.392h2.044c0 0 0-2.742 0-3.879c0-1.04 0.775-1.79 1.7-1.665c0.824 0.1 1.1 0.6 1.1 1.7 c0 1.028-0.021 3.915-0.021 3.89h2.025c0 0 0.025-2.729 0.025-4.708c0-1.981-1.006-2.78-2.604-2.78 c-1.599 0-2.248 1.096-2.248 1.096v-1H12.91z"/></svg></a>'
			};

			// share buttons
			this.st.dt.getShareButtons = function ( itemData ) {

				var shareButtons = magnificPopup.st.dt.shareButtonsList,
					pinterestIndex = -1,
					shareButtonsLemgth = shareButtons.length,
					html = '';

				for( var i = 0; i < shareButtons.length; i++ ) {

					if ( 'pinterest' == shareButtons[i] ) {
						pinterestIndex = i;
						break;
					}
				}

				if ( shareButtonsLemgth <= 0 ) {
					return '';
				}

				for ( var i = 0; i < shareButtonsLemgth; i++ ) {

					// exclude pinterest button for iframes
					if ( 'iframe' == itemData['type'] && pinterestIndex == i ) {
						continue;
					}

					var	itemTitle = itemData['title'],
						itemSrc = itemData['src'],
						itemLocation = itemData['location'];

					if ( 'google' == shareButtons[i] ) {
						itemTitle = itemTitle.replace(' ', '+');
					}

					html += magnificPopup.st.dt.shareButtonsTemplates[ shareButtons[i] ].replace('{location_href}', encodeURIComponent(itemLocation)).replace('{share_title}', encodeURIComponent(itemTitle)).replace('{image_src}', encodeURIComponent(itemSrc));
				}

				return '<div class="entry-share"><div class="soc-ico">' + html + '<div></div>';
			}

			// item title
			this.st.dt.getItemTitle = function(item) {
				var imgTitle = item.el.attr('title') || '',
					imgSrc = item.el.attr('href'),
					imgDesc = item.el.attr('data-dt-img-description') || '',
					imgLocation = item.el.attr('data-dt-location') || location.href,
					shareButtons = magnificPopup.st.dt.getShareButtons( { 'title': imgDesc, 'src': imgSrc, 'type': item.type, 'location': imgLocation } );

				return imgTitle + '<small>' + imgDesc + '</small>' + shareButtons;
			}
		}
	}
	};

	// trigger click on first anchor in the gallery container
	// work only for posts list
	$('.dt-gallery-mfp-popup').addClass('mfp-ready').on('click', function(){
		var $this = $(this),
			$container = $this.parents('article.post');
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
		if ( $container.length > 0 ) {
			var $target = $container.find('.dt-gallery-container a.dt-mfp-item');

			if ( $target.length > 0 ) {
				$target.first().trigger('click');
			}
		};

		return false;
	});

	// trigger click on first a.dt-mfp-item in the container
	$('.dt-trigger-first-mfp').addClass('mfp-ready').on('click', function(){
		var $this = $(this),
			$container = $this.parents('article.post');
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

		if ( $container.length > 0 ) {
			var $target = $container.find('a.dt-mfp-item');

			if ( $target.length > 0 ) {
				$target.first().trigger('click');
			}
		};

		return false;
		});

		// single opup
		$('.dt-single-image').addClass('mfp-ready').magnificPopup({
		type: 'image'
		});

		$('.dt-single-video').addClass('mfp-ready').magnificPopup({
		type: 'iframe'
		});
		$('.dt-single-mfp-popup').on("click", function(e){
		var $this = $(this);
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) {
			e.preventDefault();
			e.stopImmediatePropagation();
		};
		if($this.parents(".photo-scroller").length > 0){
			var parScroller = $this.parents(".photo-scroller"),
			parAutoPlay = parScroller.find(".auto-play-btn");

			if( parAutoPlay.hasClass("paused") ){
				parScroller.addClass("mfp-opened");
				parScroller.find(".auto-play-btn.paused").trigger("click");
			};
		};
		if($this.parents(".slider-wrapper").length > 0){
			var parScrollerShor = $this.parents(".slider-wrapper"),
				parAutoPlayShor = parScrollerShor.find(".auto-play-btn");

			if( parAutoPlayShor.hasClass("paused") ){
				parScrollerShor.addClass("mfp-opened");
				parScrollerShor.find(".auto-play-btn.paused").trigger("click");
			};
		}

	});

	$('.dt-single-mfp-popup').addClass('mfp-ready').magnificPopup($.extend( true, dtGlobals.magnificPopupBaseConfig, {
		callbacks: {
			close: function() {
				$(".photo-scroller.mfp-opened").find(".auto-play-btn").trigger("click");
				$(".photo-scroller").removeClass("mfp-opened");
				$(".slider-wrapper.mfp-opened").find(".auto-play-btn").trigger("click");
				$(".slider-wrapper").removeClass("mfp-opened");
			}
		}
		}));


		$(".dt-gallery-container").each(function(){
		if($(this).parents(".slider-wrapper").length > 0){
			var $this = $(this).parents(".slider-wrapper");
		}else{
			var $this = $(this);
		}
		var $thisPlay = $this.find(".auto-play-btn");
		$(this).addClass('mfp-ready').magnificPopup( $.extend( true, dtGlobals.magnificPopupBaseConfig, {
			delegate: 'a.dt-mfp-item',
			tLoading: 'Loading image #%curr%...',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			callbacks: {
				open: function() {
					var stopAutoPlay = ( 'true' === $this.attr("data-autoslide") ) ? true : false;
					if(stopAutoPlay){
						if( $thisPlay.hasClass("paused") ){
							$this.addClass("mfp-opened");
							$this.find(".auto-play-btn.paused").trigger("click");
						};
					}
				},
				close: function() {
					if( $this.hasClass("mfp-opened") ){
						$this.find(".auto-play-btn").trigger("click");
						$this.removeClass("mfp-opened");
					}
				}
			}

		} ) );
	});
})

/*!-Before After*/
jQuery(document).ready(function($) {
	if($(".twentytwenty-container").length > 0){
		$.fn.twentytwenty = function(options) {
			var options = $.extend({
				default_offset_pct: 0.5,
				orientation: 'horizontal',
				navigation_follow: false
			}, options);
			return this.each(function() {

				var sliderPct = options.default_offset_pct;
				var container = $(this);
				var sliderOrientation = options.orientation;
				var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
				var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';
				var slideOnHover = options.navigation_follow;

				container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
				var beforeImg = container.find("img:first"),
					afterImg = container.find("img:last"),
					beforeImgAlt = beforeImg.attr("title"),
					afterImgAlt = afterImg.attr("title");
				container.append("<div class='twentytwenty-handle'></div>");
				var slider = container.find(".twentytwenty-handle");
				slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
				slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
				container.addClass("twentytwenty-container");
				beforeImg.addClass("twentytwenty-before");
				afterImg.addClass("twentytwenty-after");
				if(typeof beforeImgAlt != 'undefined' && beforeImgAlt && beforeImgAlt.length > 0) {
					container.append("<div class='twentytwenty-before-label'>" + beforeImgAlt + "</div>");
				};
				if(typeof afterImgAlt != 'undefined' && afterImgAlt && afterImgAlt.length > 0) {
					container.append("<div class='twentytwenty-after-label'>" + afterImgAlt + "</div>");
				}

				var calcOffset = function(dimensionPct) {
					var w = beforeImg.width();
					var h = beforeImg.height();
					return {
						w: w+"px",
						h: h+"px",
						cw: (dimensionPct*w)+"px",
						ch: (dimensionPct*h)+"px"
					};
				};

				var adjustContainer = function(offset) {
					if (sliderOrientation === 'vertical') {
						beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
					}
					else {
						beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
					}
					container.css("height", offset.h);
				};

				var adjustSlider = function(pct) {
					var offset = calcOffset(pct);
					slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
					adjustContainer(offset);
				};

				$(window).on("resize.twentytwenty", function(e) {
					adjustSlider(sliderPct);
				});

				var offsetX = 0;
				var imgWidth = 0;
				slider.on("movestart", function(e) {
					if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
						e.preventDefault();
					}
					else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
						e.preventDefault();
					}
					container.addClass("active");
					container.removeClass("active-click");
					offsetX = container.offset().left;
					offsetY = container.offset().top;
					imgWidth = beforeImg.width(); 
					imgHeight = beforeImg.height();
				});

				slider.on("moveend", function(e) {
					container.removeClass("active");
				});

				slider.on("move", function(e) {
					if (container.hasClass("active")) {
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					}
				});
				if (!slideOnHover && !container.hasClass("active")) {
					container.on("mouseup", function(e) {
						container.removeClass("active-click");
					});
					container.on("mousedown", function(e) {
						//container.addClass("active");
						container.addClass("active-click");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width(); 
						imgHeight = beforeImg.height();
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					});
				};

				container.find("img").on("mousedown", function(event) {
					event.preventDefault();
				});

				if (slideOnHover) {
					container.on("mouseenter", function (e) {
						container.addClass("active");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width();
						imgHeight = beforeImg.height()
					});
					container.on("mouseleave", function (e) {
						container.removeClass("active")
					});
					container.on("mousemove", function (e) {
						if (container.hasClass("active")) {
							sliderPct = sliderOrientation === "vertical" ? (e.pageY - offsetY) / imgHeight : (e.pageX - offsetX) / imgWidth;
							if (sliderPct < 0) {
								sliderPct = 0
							}
							if (sliderPct > 1) {
								sliderPct = 1
							}
							adjustSlider(sliderPct)
						}
					});
				};

				$(window).trigger("resize.twentytwenty");
			});
		};
	}
})

/*
 * RoyalSlider
 *
 * @version 9.4.8:
 *
 * Copyright 2011-2012, Dmitry Semenov
 *
 */

jQuery(document).ready(function($) {
	if(!$.rsModules) {
		$.rsModules = {uid:0};
	}


	function RoyalSlider(element, options) {
		var i,
			self = this,
			ua = navigator.userAgent.toLowerCase();

		self.uid = $.rsModules.uid++;
		self.ns = '.rs' + self.uid; // unique namespace for events
		// feature detection, some ideas taken from Modernizr
		var tempStyle = document.createElement('div').style,
			vendors = ['webkit','Moz','ms','O'],
			vendor = '',
			lastTime = 0,
			tempV;

		for (i = 0; i < vendors.length; i++ ) {
			tempV = vendors[i];
			if (!vendor && (tempV + 'Transform') in tempStyle ) {
				vendor = tempV;
			}
			tempV = tempV.toLowerCase();
			
			if(!window.requestAnimationFrame) {
				window.requestAnimationFrame = window[tempV+'RequestAnimationFrame'];
						window.cancelAnimationFrame = window[tempV+'CancelAnimationFrame'] 
																	 || window[tempV+'CancelRequestAnimationFrame'];
			}
		}

		// requestAnimationFrame polyfill by Erik Möller
		// fixes from Paul Irish and Tino Zijdel
			if (!window.requestAnimationFrame) {
					window.requestAnimationFrame = function(callback, element) {
							var currTime = new Date().getTime(),
								timeToCall = Math.max(0, 16 - (currTime - lastTime)),
								id = window.setTimeout(function() { callback(currTime + timeToCall); }, timeToCall);
							lastTime = currTime + timeToCall;
							return id;
					};
			}
			if (!window.cancelAnimationFrame) 
				window.cancelAnimationFrame = function(id) { clearTimeout(id); };

			self.isIPAD = ua.match(/(ipad)/);


			// browser UA sniffing, sadly still required
			var uaMatch = function( ua ) {
				var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
						/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
						/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
						/(msie) ([\w.]+)/.exec( ua ) ||
						ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
						[];

				return {
						browser: match[ 1 ] || "",
						version: match[ 2 ] || "0"
				};
		};
		var matched = uaMatch( ua );
		var br = {};
		if ( matched.browser ) {
				br[ matched.browser ] = true;
				br.version = matched.version;
		}
		if(br.chrome) { br.webkit = true; };
		self._browser = br;
		self.isAndroid = ua.indexOf("android") > -1;



			self.slider = $(element); // DOM reference
		self.ev = $(self); // event object
		self._doc = $(document);
		self.st = $.extend({}, $.fn.royalSlider.defaults, options); 
		self._currAnimSpeed = self.st.transitionSpeed;
		self._minPosOffset = 0;
		if(self.st.allowCSS3) {
			if((!br.webkit || self.st.allowCSS3OnWebkit) ) {
					var bT = vendor + (vendor ? 'T' : 't' );
					self._useCSS3Transitions = ( (bT + 'ransform') in tempStyle ) && ( (bT + 'ransition') in tempStyle );
					if(self._useCSS3Transitions) {
						self._use3dTransform = (vendor + (vendor ? 'P' : 'p'  ) + 'erspective') in tempStyle;
					}
				}
		}
			
			vendor = vendor.toLowerCase();
			self._vendorPref = '-'+vendor+'-';
		
		self._slidesHorizontal = (self.st.slidesOrientation === 'vertical') ? false : true;
		self._reorderProp = self._slidesHorizontal ? 'left' : 'top';
		self._sizeProp = self._slidesHorizontal ? 'width' : 'height';
		self._prevNavItemId = -1;
		self._isMove = (self.st.transitionType === 'fade') ? false : true;
		if(!self._isMove) {
			self.st.sliderDrag = false;
			self._fadeZIndex = 10;
		}
		self._opacityCSS = 'z-index:0; display:none; opacity:0;';

		self._newSlideId = 0;
		self._sPosition = 0;
		self._nextSlidePos = 0;

		// init modules
		$.each($.rsModules, function (helper, opts) {
			if(helper !== 'uid')
				opts.call(self);
		});

		// parse all slides
		self.slides = [];
		self._idCount = 0;
		var returnVal;
		var ts = self.st.slides ? $(self.st.slides) : self.slider.children().detach();
		
		ts.each(function() {
			self._parseNode(this, true);
		});

		if(self.st.randomizeSlides) {
				self.slides.sort(function() { return 0.5 - Math.random() });
			}
		self.numSlides = self.slides.length;
		self._refreshNumPreloadImages();

		if(!self.st.startSlideId) {
			self.st.startSlideId = 0;
		} else if(self.st.startSlideId > self.numSlides - 1) {
			self.st.startSlideId = self.numSlides - 1;
		}

		self._newSlideId = self.staticSlideId = self.currSlideId = self._realId =  self.st.startSlideId;
		self.currSlide = self.slides[self.currSlideId];

		self._accelerationPos = 0;
		self.msTouch = false;
		self.slider.addClass( (self._slidesHorizontal ? 'rsHor' : 'rsVer') + (self._isMove ? '' : ' rsFade') );

		var sliderHTML = '<div class="rsOverflow"><div class="rsContainer">';
		self.slidesSpacing = self.st.slidesSpacing;
		self._slideSize = ( self._slidesHorizontal ? self.slider.width() : self.slider.height() ) + self.st.slidesSpacing;

		self._preload = Boolean(self._numPreloadImages > 0);
		
		if(self.numSlides <= 1) {
			self._loop = false;
		}
		var loopHelpers = (self._loop && self._isMove) ? ( self.numSlides === 2 ? 1 : 2) : 0;
		self._loopHelpers = loopHelpers;

		self._maxImages = self.numSlides < 6 ? self.numSlides : 6;
		self._currBlockIndex = 0;


		self._idOffset = 0;
		self.slidesJQ = [];
		
		for(i =0; i < self.numSlides; i++) {
			self.slidesJQ.push( $(createItemHTML(i)) );
		}
		self._sliderOverflow = sliderHTML = $(sliderHTML + '</div></div>');


		var addCursors = function() {
			if(self.st.sliderDrag) {
				self._hasDrag = true;
				if (br.msie || br.opera) {
					self._grabCursor = self._grabbingCursor = "move";
				} else if(br.mozilla) {
					self._grabCursor = "-moz-grab";
					self._grabbingCursor = "-moz-grabbing";
				} else if(br.webkit && (navigator.platform.indexOf("Mac")!=-1)) {
					self._grabCursor = "-webkit-grab";
					self._grabbingCursor = "-webkit-grabbing";
				}
				self._setGrabCursor();
			}
		};
		var rsNS = self.ns;
		var addEventNames = function(pref, down, move, up, cancel) {
			self._downEvent = pref + down + rsNS;
			self._moveEvent = pref + move + rsNS;
			self._upEvent = pref + up + rsNS;
			if(cancel)
				self._cancelEvent = pref + cancel + rsNS;
		};


		// Pointer events support
		var nPointerEnabled = navigator.pointerEnabled;
		self.pointerEnabled = nPointerEnabled || navigator.msPointerEnabled;

		if(self.pointerEnabled) {
			self.hasTouch = false;
			self._lastItemFriction = 0.2;
			// Hardware supports multitouch
			self.pointerMultitouch = Boolean(navigator[ (nPointerEnabled ? 'm' : 'msM') + 'axTouchPoints' ] > 1);
			if(nPointerEnabled) {
				// >= IE11 & other devices that support pointer events
				addEventNames('pointer', 'down', 'move', 'up', 'cancel');
			} else {
				// IE10
				addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
			}
		} else {

			// IOS can't handle both touch and mouse events at once
			if(!self.isIOS) {
				addEventNames('mouse', 'down', 'move', 'up');
			} else {
				self._downEvent = self._moveEvent = self._upEvent = self._cancelEvent = '';
			}

			if('ontouchstart' in window || 'createTouch' in document) {
				self.hasTouch = true;
				self._downEvent += ' touchstart' + rsNS;
				self._moveEvent += ' touchmove' + rsNS;
				self._upEvent += ' touchend' + rsNS;
				self._cancelEvent += ' touchcancel' + rsNS;
				self._lastItemFriction = 0.5;
				if(self.st.sliderTouch) {
					self._hasDrag = true;
				}
			} else {
				self.hasTouch = false;
				self._lastItemFriction = 0.2;
			}
		}
		addCursors();
	
		self.slider.html(sliderHTML);

		
		self._controlsContainer = self.st.controlsInside ? self._sliderOverflow : self.slider;
		
		self._slidesContainer = self._sliderOverflow.children('.rsContainer');
		if(self.msEnabled) {
			self._slidesContainer.css('-ms-touch-action', self._slidesHorizontal ? 'pan-y' : 'pan-x');
		}
		self._preloader = $('<div class="rsPreloader"><div class="pace pace-active"><div class="pace-activity"></div></div></div>');
		var slides = self._slidesContainer.children('.rsSlide');

		self._currHolder = self.slidesJQ[self.currSlideId]
		self._selectedSlideHolder = 0;

		function createItemHTML(i, className) {
			return '<div style="'+ (self._isMove ? '' : (i !== self.currSlideId  ? self._opacityCSS : 'z-index:0;') ) +'" class="rsSlide '+ (className || '')+'"></div>';
		}
		
		if(self._useCSS3Transitions) {

			// some constants for CSS3
			self._TP = 'transition-property';
			self._TD = 'transition-duration';
			self._TTF = 'transition-timing-function';

			self._yProp = self._xProp = self._vendorPref +'transform';

			if(self._use3dTransform) {
				if(br.webkit && !br.chrome) {
					self.slider.addClass('rsWebkit3d');
				}

				self._tPref1 = 'translate3d(';
				self._tPref2 = 'px, ';
				self._tPref3 = 'px, 0px)';
			} else {
				self._tPref1 = 'translate(';
				self._tPref2 = 'px, ';
				self._tPref3 = 'px)';
			}
			if(!self._isMove) {
				var animObj = {};
				animObj[(self._vendorPref + self._TP)] = 'opacity';
				animObj[(self._vendorPref + self._TD)] = self.st.transitionSpeed + 'ms';
				animObj[(self._vendorPref + self._TTF)] = self.st.css3easeInOut;
				slides.css(animObj);
			} else {
				self._slidesContainer[(self._vendorPref + self._TP)] = (self._vendorPref + 'transform');
			}
			

		} else {
			self._xProp = 'left';
			self._yProp = 'top';
		}

		// !Responsiveness (on window resize)
		
		if (!self.st.disableResponsiveness) {
			var resizeTimer;
			$(window).on('resize'+self.ns, function() { 
				if(resizeTimer) {
					clearTimeout(resizeTimer);      
				}
				resizeTimer = setTimeout(function() { self.updateSliderSize(); }, 50);      
			});
		}

		self.ev.trigger('rsAfterPropsSetup'); // navigation (bullets, thumbs...) are created here

		self.updateSliderSize();


		// keyboard nav
		if(self.st.keyboardNavEnabled) {
			self._bindKeyboardNav();
		}

		if(self.st.arrowsNavHideOnTouch && (self.hasTouch || self.msTouch) ) {
			self.st.arrowsNav = false;
		}

		

		//Direction navigation (arrows)
		if(self.st.arrowsNav) {
			var rArr = 'rsArrow',
				container = self._controlsContainer;
			$('<div class="'+rArr+' '+rArr+'Left"><div class="'+rArr+'Icn"></div></div><div class="'+rArr+' '+rArr+'Right"><div class="'+rArr+'Icn"></div></div>').appendTo(container);

			self._arrowLeft = container.children('.'+rArr+'Left').click(function(e) {
				e.preventDefault();
				self.prev();
			});
			self._arrowRight = container.children('.'+rArr+'Right').click(function(e) {
				e.preventDefault();
				self.next();
			});

			if(self.st.arrowsNavAutoHide && !self.hasTouch) {
				self._arrowLeft.addClass('rsHidden');
				self._arrowRight.addClass('rsHidden');

				var hoverEl = container;
				hoverEl.one("mousemove.arrowshover",function() {
					self._arrowLeft.removeClass('rsHidden');
					self._arrowRight.removeClass('rsHidden');     
				});


				hoverEl.hover(
					function() {
						if(!self._arrowsAutoHideLocked) {
							self._arrowLeft.removeClass('rsHidden');
							self._arrowRight.removeClass('rsHidden');
						}
					},
					function() {
						if(!self._arrowsAutoHideLocked) {
							self._arrowLeft.addClass('rsHidden');
							self._arrowRight.addClass('rsHidden');
						}
					}
				);  
			} 
			self.ev.on('rsOnUpdateNav', function() {
				self._updateArrowsNav();
			});
			self._updateArrowsNav();
		}

		/*Append play btn*/
		// if(self.st.arrowsAutoplay) {
		// 	var rPlay = 'rsPlay',
		// 		container = self._controlsContainer;
		// 	$('<div class="'+rPlay+' '+rPlay+'Play"></div>').appendTo(container);
		// }

		if (self.st.autoPlay.enabled) {
				// self._thumbsContainer.after('<div class="progress-wrapper"><div class="progress-controls"></div></div>');
				// self.progressWrap = self._thumbsContainer.next();
				// self.progressHtml = '<div class="progress-mask"><div class="progress-spinner-left" style="'+self._vendorPref+'animation-duration: '+self.st.autoPlay.delay+'ms;"></div></div><div class="progress-mask"><div class="progress-spinner-right" style="'+self._vendorPref+'animation-duration: '+self.st.autoPlay.delay+'ms;"></div></div>';

				var container = self._controlsContainer;
				$('<div class="rsPlay"></div>').appendTo(container);
				var rPlay = container.find('.rsPlay');
				container.addClass("autoplay-on");
				self.ev.on("autoPlayPlay", function() {
					rPlay.removeClass("paused");
				});

				self.ev.on("autoPlayPause", function() {
					if (!self._autoPlayEnabled) {
						rPlay.addClass("paused");
					}
				});


				// self.ev.on('rsVideoPlay', function() {
				// 	$("body").addClass("hide-thumbnails");
				// 	if (!self.slider.parent().hasClass("fixed")) $("body").addClass("video-playing");
				// });
				// self.ev.on('rsVideoStop', function() {
				// 	$("body").removeClass("video-playing").removeClass("hide-thumbnails");
				// });

				rPlay.on("click", function() {
					self.toggleAutoPlay();
				});
		
		}

		if( self._hasDrag ) {
			self._slidesContainer.on(self._downEvent, function(e) { self._onDragStart(e); }); 
		} else {
			self.dragSuccess = false;
		}
		var videoClasses = ['rsPlayBtnIcon', 'rsPlayBtn', 'rsCloseVideoBtn', 'rsCloseVideoIcn'];
		self._slidesContainer.click(function(e) {
			if(!self.dragSuccess) {
				var t = $(e.target);
				var tClass = t.attr('class');
				if( $.inArray(tClass, videoClasses) !== -1) {
							if( self.toggleVideo() ) {
						return false;
					}
					}
				if(self.st.navigateByClick && !self._blockActions) {
					if($(e.target).closest('.rsNoDrag', self._currHolder).length) {
						 return true;
					}
					self._mouseNext(e);
				} 
				self.ev.trigger('rsSlideClick');
			} 
		}).on('click.rs', 'a', function(e) {  
			if(self.dragSuccess) {            
				return false;
			} else {
				self._blockActions = true;
				setTimeout(function() {
					self._blockActions = false;
				}, 3);
			}
		});
		self.ev.trigger('rsAfterInit');
	} /* RoyalSlider Constructor End */

	/**
	 *
	 * RoyalSlider Core Prototype
	 * 
	 */
	RoyalSlider.prototype = {
		constructor: RoyalSlider,
		_mouseNext: function(e) {
			var self = this,
				relativePos = e[self._slidesHorizontal ? 'pageX' : 'pageY'] - self._sliderOffset;

				if(relativePos >= self._nextSlidePos) {
					self.next();
				} else if(relativePos < 0) {
					self.prev();
				}
		},
		_refreshNumPreloadImages: function() {
			var self = this,
				n;
			n = self.st.numImagesToPreload;
			self._loop = self.st.loop;

			if(self._loop) {
				if(self.numSlides === 2) {
					self._loop = false;
					self.st.loopRewind = true;
				} else if(self.numSlides < 2) {
					self.st.loopRewind = self._loop = false;
				}
				
			}
			if(self._loop && n > 0) {
				if(self.numSlides <= 4) {
					n = 1;
				} else {
					if(self.st.numImagesToPreload > (self.numSlides - 1) / 2 ) {
						n = Math.floor( (self.numSlides - 1) / 2 );
					}
				} 
			}
			self._numPreloadImages = n;
		},
		_parseNode: function(content, pushToSlides) {
			var self = this,
				hasImg,
				isRoot,
				hasCover,
				obj = {},
				tempEl,
				first = true;
			content = $(content);
			self._currContent = content;
			self.ev.trigger('rsBeforeParseNode', [content, obj]);
			if(obj.stopParsing) {
				return;
			}
			content = self._currContent;
			obj.id = self._idCount;
			obj.contentAdded = false;
			self._idCount++;
			obj.images = [];
			obj.isBig = false;

			if(!obj.hasCover) {
				if(content.hasClass('rsImg')) {
					tempEl = content;
					hasImg = true;
				} else {
					tempEl = content.find('.rsImg');
					if(tempEl.length) {
						hasImg = true;
					}
				}

				if(hasImg) {
					obj.bigImage = tempEl.eq(0).attr('data-rsBigImg');
					tempEl.each(function() {
						var item = $(this);
						if(item.is('a')) {
							parseEl(item, 'href');
						} else if(item.is('img')) {
							parseEl(item, 'src');
						} else {
							parseEl(item);
						}
					});
				} else if(content.is('img')) {
					content.addClass('rsImg rsMainSlideImage');
					parseEl(content, 'src');
				}
			}
			tempEl = content.find('.rsCaption');
			if(tempEl.length) {
				obj.caption = tempEl.remove();
			}
			obj.content = content;

			self.ev.trigger('rsAfterParseNode', [content, obj]);
			function parseEl(el, s) {
				if(s) {
					obj.images.push( el.attr(s) );
				} else {
					obj.images.push( el.text() );
				}
				if(first) {
					first = false;
					obj.caption = (s === 'src') ? el.attr('alt') : el.contents();
					obj.image = obj.images[0];
					obj.videoURL = el.attr('data-rsVideo');
					
					
					var wAtt = el.attr('data-rsw'),
						hAtt = el.attr('data-rsh');
					if (typeof wAtt !== 'undefined' && wAtt !== false && typeof hAtt !== 'undefined' && hAtt !== false ) {
							 obj.iW = parseInt(wAtt);
							 obj.iH = parseInt(hAtt);
					} else if(self.st.imgWidth && self.st.imgHeight ) {
						obj.iW = self.st.imgWidth;
						obj.iH = self.st.imgHeight;
					}
				}
			}
			if(pushToSlides) {
				self.slides.push(obj);
			}
			if(obj.images.length === 0) {
				obj.isLoaded = true;
				obj.isRendered = false;
				obj.isLoading = false;
				obj.images = null;
			}
			return obj;
		},
		_bindKeyboardNav: function() {
			var self = this,
				interval,
				keyCode,
				onKeyboardAction = function (keyCode) {
						if (keyCode === 37) {
						self.prev();
					} else if (keyCode === 39) {
						self.next();
					}
				};

			self._doc.on('keydown' + self.ns, function(e) {
				if(!self._isDragging) {
					keyCode = e.keyCode;
					if(keyCode === 37 || keyCode === 39) {
						if(!interval) {
									onKeyboardAction(keyCode);
									interval = setInterval(function() {
											onKeyboardAction(keyCode);
									}, 700);
							}
					}
				}
			}).on('keyup' + self.ns, function(e) {
				if(interval) {
					clearInterval(interval); 
							interval = null;
				}
			});

		},

		goTo: function(id, notUserAction) {
			var self = this;
			if(id !== self.currSlideId) {
				self._moveTo(id,self.st.transitionSpeed, true, !notUserAction);
			}
		},
		destroy: function(remove) {
			var self = this;
			self.ev.trigger('rsBeforeDestroy');
			self._doc.off('keydown' +self.ns+ ' keyup' + self.ns + ' ' + self._moveEvent +' '+ self._upEvent );
			self._slidesContainer.off(self._downEvent + ' click');  
			self.slider.data('royalSlider', null);
			$.removeData(self.slider, 'royalSlider');
			$(window).off('resize' + self.ns);
			if(remove) {
				self.slider.remove();
			}
			self.slides = null;
			self.slider = null;
			self.ev = null;
		},
		_updateBlocksContent: function(beforeTransition, getId) {
			var self = this,
				item,
				i,
				n,
				pref,
				group,
				groupId,
				slideCode,
				loop = self._loop,
				numSlides = self.numSlides;
			if(!isNaN(getId) ) {
				return getCorrectLoopedId(getId);
			}


			var id = self.currSlideId;
			var groupOffset;
			
			var itemsOnSide = beforeTransition ? (Math.abs(self._prevSlideId - self.currSlideId) >= self.numSlides - 1 ? 0 : 1) : self._numPreloadImages;
			var itemsToCheck = Math.min(2, itemsOnSide); 
			
			var updateAfter = false;
			var updateBefore = false;
			var tempId;

			for(i = id; i < id + 1 + itemsToCheck; i++) {
				tempId = getCorrectLoopedId(i);
				item = self.slides[tempId];
				if(item && (!item.isAdded || !item.positionSet) ) {
					updateAfter = true;
					break;
				}
			}
			for(i = id - 1; i > id - 1 - itemsToCheck; i--) {
				tempId = getCorrectLoopedId(i);
				item = self.slides[tempId];
				if(item && (!item.isAdded || !item.positionSet) ) {
					updateBefore = true;
					break;
				}
			}
			if(updateAfter) {
				for(i = id; i < id + itemsOnSide + 1; i++) {
					tempId = getCorrectLoopedId(i);
					groupOffset = Math.floor( (self._realId - (id - i)) / self.numSlides) * self.numSlides;
					item = self.slides[tempId];
					if(item) {
						updateItem(item, tempId); 
					}
				}
			}
			if(updateBefore) {
				for(i = id - 1; i > id - 1 - itemsOnSide; i--) {
					tempId = getCorrectLoopedId(i);
					groupOffset = Math.floor( (self._realId - (id - i) ) / numSlides) * numSlides;
					item = self.slides[tempId];
					if(item) {
						updateItem(item, tempId);
					}
				}
			}
			if(!beforeTransition) {
				var start = id;
				var distance = itemsOnSide;
				var min = getCorrectLoopedId(id - itemsOnSide);
				var max = getCorrectLoopedId(id + itemsOnSide);
				
				var nmin = min > max ? 0 : min;
				
				for (i = 0; i < numSlides; i++) { 
					if(min > max) {
						if(i > min - 1) {
							continue;
						}
					}
					if(i < nmin || i > max) {
						 item = self.slides[i];
						if(item && item.holder) {
							
							//slideCode = self.slidesJQ[i];
							//if(typeof slideCode !== "string") { 
								item.holder.detach();
								item.isAdded = false;
							//}
						}     
					}                               
					}   
			}

			function updateItem(item , i, slideCode) {

				if(!item.isAdded) {
					if(!slideCode)
						slideCode = self.slidesJQ[i];

					if(!item.holder) {
						slideCode = self.slidesJQ[i] = $(slideCode);
						item.holder = slideCode;
					} else {
						slideCode = item.holder;
					}

					item.appendOnLoaded = false;

					
					updatePos(i, item, slideCode);
					addContent(i, item);
					self._addBlockToContainer(item, slideCode, beforeTransition);
					item.isAdded = true;
					appended = true;
				} else {
					addContent(i, item);
					updatePos(i, item);
				}
			}
			function addContent(i, item) {
				if(!item.contentAdded) {
					self.setItemHtml(item, beforeTransition);
					if(!beforeTransition) {
						item.contentAdded = true;
					}
					
				}
			}
			function updatePos(i, item, slideCode) {
				if(self._isMove) {
					if(!slideCode) {
						slideCode = self.slidesJQ[i];
					}

					slideCode.css(self._reorderProp, (i + self._idOffset + groupOffset) * self._slideSize);
				}
			}
			function getCorrectLoopedId(index) {
				var changed = false;
				if(loop) {
					if(index > numSlides - 1) {
						return getCorrectLoopedId(index - numSlides);
					} else  if(index < 0) {
						return getCorrectLoopedId(numSlides + index);
					}
				}
				return index;
			}
			
		},

		/**
		 * Sets or loads HTML for specified slide
		 * @param {Object} currSlideObject  holds data about curr slide (read about rsAfterParseNode for more info)
		 * @param {Boolean} beforeTransition determines if setItemHTML method is called before or after transition
		 */
		setItemHtml: function(currSlideObject, beforeTransition) {

			var self = this;

			if(currSlideObject.isLoaded) {
				appendContent();
				return;
			} else {
				if(beforeTransition) {
					waitForTransition();
				} else {
					parseDataAndLoad();
				}
			}

			function parseDataAndLoad() {
				if(!currSlideObject.images) {
					currSlideObject.isRendered = true;
						currSlideObject.isLoaded = true;
					currSlideObject.isLoading = false;
					appendContent(true);
					return;
				}
				if(currSlideObject.isLoading) {
					return;
				}
				
				var el,
					isRoot;
				if(currSlideObject.content.hasClass('rsImg') ) {
					el = currSlideObject.content;
					isRoot = true;
				} else {
					el = currSlideObject.content.find('.rsImg:not(img)')
				}
				if(el && !el.is('img')) {
					el.each(function() {
						var item = $(this),
							newEl = '<img class="rsImg" src="'+ ( item.is('a') ? item.attr('href') : item.text() ) +'" />';

						if(!isRoot) {
							item.replaceWith( newEl );
						} else {
							currSlideObject.content = $(newEl);
						}
					});
				}
				
				el = isRoot ? currSlideObject.content : currSlideObject.content.find('img.rsImg');
				setPreloader();
				
				el.eq(0).addClass('rsMainSlideImage');
				if(currSlideObject.iW && currSlideObject.iH) {
					if(!currSlideObject.isLoaded) {
						self._resizeImage( currSlideObject );
					}
					appendContent();
				}

				currSlideObject.isLoading = true;
				var newEl;

				if(currSlideObject.isBig) {
					$('<img />').on('load.rs error.rs', function(e){
						onLoad( [this], true );
					}).attr('src', currSlideObject.image);
				} else {
					currSlideObject.loaded = [];
					currSlideObject.imgLoaders = [];
					for(var i = 0; i < currSlideObject.images.length; i++) {
						var image = $('<img />');

						currSlideObject.imgLoaders.push( this );
						image.on('load.rs error.rs', function(e){
							currSlideObject.loaded.push( this );
							if(currSlideObject.loaded.length === currSlideObject.imgLoaders.length) {
								onLoad( currSlideObject.loaded, false );
							}
						}).attr('src', currSlideObject.images[i]);
					}
				}

				// old images loading
				// el.imagesLoaded( function( $images, $proper, $broken ) {
				//  if($broken.length) {
				//    currSlideObject.isLoading = false;
				//    var img =  $images[0],
				//        src = img.src;
				//    if(src && src.indexOf(currSlideObject.image) === -1 ) {
				//        return;
				//      }
				//    if(!currSlideObject.tryAgainCount) { currSlideObject.tryAgainCount = 0; }
				//    if(currSlideObject.tryAgainCount < 3) {
				//      currSlideObject.tryAgainCount++;
				//      self.setItemHtml(currSlideObject, beforeTransition);
				//      return;
				//    }
				//  }
				//     onLoad($images);
				// });
			}
			function onLoad($images, isBig) {
				if($images.length) {
						var img = $images[0],
							src = img.src;
						
						if(isBig !== currSlideObject.isBig) {
							var c = currSlideObject.holder.children();
							if(c && c.length > 1) {
								removePreloader();
							}
							return;
						}
						
						if(currSlideObject.iW && currSlideObject.iH) {
							imageLoadingComplete();
							return;
						}
						currSlideObject.iW = img.width;
						currSlideObject.iH = img.height;
						if(currSlideObject.iW && currSlideObject.iH) {
							imageLoadingComplete();
							return;
						} else {
							// if no size, try again
							var loader = new Image();
							loader.onload = function() {
								if(loader.width) {
									currSlideObject.iW = loader.width;
									currSlideObject.iH = loader.height;
									imageLoadingComplete();
								} else {
									setTimeout(function() {
										if(loader.width) {
											currSlideObject.iW = loader.width;
											currSlideObject.iH = loader.height;
										}

										// failed to get size on last tier, just output image
										imageLoadingComplete();
									}, 1000);
								}
						};
							loader.src = img.src;
						}
					} else {
						imageLoadingComplete();
					}
			}
			function imageLoadingComplete() {
				currSlideObject.isLoaded = true;
				currSlideObject.isLoading = false;

					appendContent();
					removePreloader();
					triggerLoaded();
			}
			function waitForTransition() {
				if(!self._isMove && currSlideObject.images && currSlideObject.iW && currSlideObject.iH) {
					parseDataAndLoad();
					return;
				}
				currSlideObject.holder.isWaiting = true;
				setPreloader();
				currSlideObject.holder.slideId = -99;
			}
			
			function appendContent() {
				if(!currSlideObject.isAppended) {

					var visibleNearby = self.st.visibleNearby,
					bId = currSlideObject.id - self._newSlideId;
					if(!beforeTransition && !currSlideObject.appendOnLoaded && self.st.fadeinLoadedSlide  && ( bId === 0 || ( (visibleNearby || self._isAnimating || self._isDragging) && (bId === -1 || bId === 1) ) ) ) {
						var css = {
							visibility: 'visible', 
							opacity: 0
						};
						css[self._vendorPref + 'transition'] = 'opacity 400ms ease-in-out';
						currSlideObject.content.css(css);

						setTimeout(function() {
							currSlideObject.content.css('opacity', 1);
						}, 16);
					}

					if(currSlideObject.holder.find('.rsPreloader').length) {
						currSlideObject.holder.append( currSlideObject.content );
					} else {
						currSlideObject.holder.html( currSlideObject.content );
					}
					

					currSlideObject.isAppended = true;
					if(currSlideObject.isLoaded) {
						self._resizeImage(currSlideObject);
						triggerLoaded();
					}
					if(!currSlideObject.sizeReady) {
						currSlideObject.sizeReady = true;
						setTimeout(function() {
							// triggers after content is added, usually is true when page is refreshed from cache
							self.ev.trigger('rsMaybeSizeReady', currSlideObject);
						}, 100);
					}
					
				}
			}
			function triggerLoaded() {
				if(!currSlideObject.loadedTriggered) {
					currSlideObject.isLoaded = currSlideObject.loadedTriggered = true;
					currSlideObject.holder.trigger('rsAfterContentSet');
					self.ev.trigger('rsAfterContentSet', currSlideObject);
				}
			}
			function setPreloader() {
				if(self.st.usePreloader)
					currSlideObject.holder.html(self._preloader.clone());
			}
			function removePreloader(now) {
				if(self.st.usePreloader) {
					var preloader = currSlideObject.holder.find('.rsPreloader');
					if(preloader.length) {
						preloader.remove();
					}
				}
			}

		},
		_addBlockToContainer: function(slideObject, content, dontFade) {
			var self = this;
			var holder = slideObject.holder;
			var bId = slideObject.id - self._newSlideId;
			
			var visibleNearby = false;
			// if(self._isMove && !dontFade && self.st.fadeinLoadedSlide  && ( bId === 0 || ( (visibleNearby || self._isAnimating || self._isDragging) && (bId === -1 || bId === 1) ) ) ) {
			//  var content = slideObject.content;
			//  content.css(self._vendorPref + 'transition', 'opacity 400ms ease-in-out').css({visibility: 'visible', opacity: 0});
			//  //holder.css('opacity', 0);
			//  self._slidesContainer.append(holder);
			//  setTimeout(function() {
			//    content.css('opacity', 1);
			//    //self.ev.trigger('rsAfterContentSet', holder);
			//  }, 6);
			// } else {
				self._slidesContainer.append(holder);
			//}
			slideObject.appendOnLoaded = false;
		},
	
		_onDragStart:function(e, isThumbs) {
			var self = this,
				point,
				wasAnimating,
				isTouch = (e.type === 'touchstart');

			self._isTouchGesture = isTouch; 

			self.ev.trigger('rsDragStart');
			if($(e.target).closest('.rsNoDrag', self._currHolder).length) {
				 self.dragSuccess = false;
				 return true;
			}

			

			if(!isThumbs) {
				if(self._isAnimating) {
					self._wasAnimating = true;

					self._stopAnimation();
				}
			}
			self.dragSuccess = false;
			if(self._isDragging) {
				if(isTouch) {
					self._multipleTouches = true;
				}
				return;
			} else {
				if(isTouch) {
					self._multipleTouches = false;
				}
			}

			self._setGrabbingCursor();
			
			if(isTouch) {
				//parsing touch event
				var touches = e.originalEvent.touches;
				if(touches && touches.length > 0) {
					point = touches[0];
					if(touches.length > 1) {
						self._multipleTouches = true;
					}
				}         
				else {  
					return;           
				}
			} else {
				e.preventDefault();       
				point = e;
				if(self.msEnabled) point = point.originalEvent;   
			}

			self._isDragging = true;
			self._doc.on(self._moveEvent, function(e) { self._onDragMove(e, isThumbs); })
						.on(self._upEvent, function(e) { self._onDragRelease(e, isThumbs); });
			
			self._currMoveAxis = '';
			self._hasMoved = false;
			self._pageX = point.pageX;
			self._pageY = point.pageY;
			self._startPagePos = self._accelerationPos = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal) ? point.pageX : point.pageY;
			
			self._horDir = 0;
			self._verDir = 0;


			self._currRenderPosition = !isThumbs ? self._sPosition : self._thumbsPosition;

			self._startTime = new Date().getTime();
			if(isTouch) {
				self._sliderOverflow.on(self._cancelEvent, function(e) { self._onDragRelease(e, isThumbs); });  
			}
		},
		_renderMovement:function(point, isThumbs) {
			var self = this;
			if(self._checkedAxis) {

				var timeStamp = self._renderMoveTime,
					deltaX = point.pageX - self._pageX,
					deltaY = point.pageY - self._pageY,
					newX = self._currRenderPosition + deltaX,
					newY = self._currRenderPosition + deltaY,
					isHorizontal = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal),
					newPos = isHorizontal ? newX : newY,
					mAxis = self._currMoveAxis;

				self._hasMoved = true;
				self._pageX = point.pageX;
				self._pageY = point.pageY;

				if(mAxis === 'x' && deltaX !== 0) {
					self._horDir = deltaX > 0 ? 1 : -1;
				} else if(mAxis === 'y' && deltaY !== 0) {
					self._verDir = deltaY > 0 ? 1 : -1;
				}

				var pointPos = isHorizontal ? self._pageX : self._pageY,
					deltaPos = isHorizontal ? deltaX : deltaY;
				if(!isThumbs) {
					if(!self._loop) {
						if(self.currSlideId <= 0) {
							if(pointPos - self._startPagePos > 0) {
								newPos = self._currRenderPosition + deltaPos * self._lastItemFriction;
							}
						}
						if(self.currSlideId >= self.numSlides - 1) {
							if(pointPos - self._startPagePos < 0) {
								newPos = self._currRenderPosition + deltaPos * self._lastItemFriction ;
							}
						}
					}
				} else {
					if(newPos > self._thumbsMinPosition) {
						newPos = self._currRenderPosition + deltaPos * self._lastItemFriction;
					} else if(newPos < self._thumbsMaxPosition) {
						newPos = self._currRenderPosition + deltaPos * self._lastItemFriction ;
					}
				}

				self._currRenderPosition = newPos;
				
				if (timeStamp - self._startTime > 200) {
					self._startTime = timeStamp;
					self._accelerationPos = pointPos;           
				}

				if(!isThumbs) {
					if(self._isMove) {
						self._setPosition(self._currRenderPosition);
					}
				} else {
					self._setThumbsPosition(self._currRenderPosition);
				}
			}
			
		},
		_onDragMove:function(e, isThumbs) {
			var self = this,
				point,
				isTouch = (e.type === 'touchmove');

			if(self._isTouchGesture && !isTouch) {
				return;
			}

			if(isTouch) {
				if(self._lockAxis) {
					return;
				} 
				var touches = e.originalEvent.touches;
				if(touches) {
					if(touches.length > 1) {
						return;
					} else {
						point = touches[0]; 
					}
				} else {
					return;
				}
			} else {
				point = e;
				if(self.msEnabled) point = point.originalEvent; 
			}
			

			if(!self._hasMoved) {
				if(self._useCSS3Transitions) {
					(!isThumbs ? self._slidesContainer : self._thumbsContainer).css((self._vendorPref + self._TD), '0s');
				}
				(function animloop(){
					if(self._isDragging) {
						self._animFrame = requestAnimationFrame(animloop);
						if(self._renderMoveEvent)
							self._renderMovement(self._renderMoveEvent, isThumbs);
					}
					
					})();
			}
				
			if(!self._checkedAxis) {
				
				var dir = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal),
					diff = (Math.abs(point.pageX - self._pageX) - Math.abs(point.pageY - self._pageY) ) - (dir ? -7 : 7);

				if(diff > 7) {
					// hor movement
					if(dir) {
						e.preventDefault();
						self._currMoveAxis = 'x';
					} else if(isTouch) {
						self._completeGesture();
						return;
					} 
					self._checkedAxis = true;
				} else if(diff < -7) {
					// ver movement
					if(!dir) {
						e.preventDefault();
						self._currMoveAxis = 'y';
					} else if(isTouch) {
						self._completeGesture();
						return;
					} 
					self._checkedAxis = true;
				}
				return;
			}
			
			e.preventDefault(); 
			self._renderMoveTime = new Date().getTime();
			self._renderMoveEvent = point;
		},
		_completeGesture: function() {
			var self = this;
			self._lockAxis = true;
			self._hasMoved = self._isDragging = false;
			self._onDragRelease();
		},
		_onDragRelease:function(e, isThumbs) {
			var self = this,
				totalMoveDist,
				accDist,
				duration,
				v0,
				newPos,
				newDist,
				newDuration,
				blockLink,
				isTouch = (e.type === 'touchend' || e.type === 'touchcancel');


			if(self._isTouchGesture && !isTouch) {
				return;
			}
			self._isTouchGesture = false;
			self.ev.trigger('rsDragRelease');

			self._renderMoveEvent = null;
			self._isDragging = false;
			self._lockAxis = false;
			self._checkedAxis = false;
			self._renderMoveTime = 0;
			cancelAnimationFrame(self._animFrame);
			if(self._hasMoved) {
				if(!isThumbs) {
					if(self._isMove) {
						self._setPosition(self._currRenderPosition);
					}
				} else {
					self._setThumbsPosition(self._currRenderPosition);
				}
			}


			self._doc.off(self._moveEvent).off(self._upEvent);

			if(isTouch) {
				self._sliderOverflow.off(self._cancelEvent);  
			}

			
			self._setGrabCursor();
			if (!self._hasMoved && !self._multipleTouches) {
				if(isThumbs && self._thumbsEnabled) {
					var item = $(e.target).closest('.rsNavItem');
					if(item.length) {
						self.goTo(item.index());
					} 
					return;
				}
			}
			var orient = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal);
			if(!self._hasMoved || (self._currMoveAxis === 'y' && orient) || (self._currMoveAxis === 'x' && !orient) ) {
				if(!isThumbs && self._wasAnimating) {
					self._wasAnimating = false;
					if(!self.st.navigateByClick) {
						self.dragSuccess = true;
					} else {
						self._mouseNext( (self.msEnabled ? e.originalEvent : e) );
						self.dragSuccess = true;
						return;
					}
				} else {
					self._wasAnimating = false;
					self.dragSuccess = false;
					return;
				}
				
			} else {
				self.dragSuccess = true;
			}

			self._wasAnimating = false;
			
			
			self._currMoveAxis = '';

			
			function getCorrectSpeed(newSpeed) {
				if(newSpeed < 100) {
					return 100;
				} else if(newSpeed > 500) {
					return 500;
				} 
				return newSpeed;
			}
			function returnToCurrent(isSlow, v0) {
				if(self._isMove || isThumbs) {

					newPos = (-self._realId - self._idOffset) * self._slideSize;
					newDist = Math.abs(self._sPosition  - newPos);
					self._currAnimSpeed = newDist / v0;
					if(isSlow) {
						self._currAnimSpeed += 250; 
					}
					self._currAnimSpeed = getCorrectSpeed(self._currAnimSpeed);

					self._animateTo(newPos, false);
				}
			}

			var snapDist = self.st.minSlideOffset,
				point = isTouch ? e.originalEvent.changedTouches[0] : (self.msEnabled ? e.originalEvent : e),
				pPos = orient ? point.pageX : point.pageY,
				sPos = self._startPagePos,
				axPos = self._accelerationPos,
				axCurrItem = self.currSlideId,
				axNumItems = self.numSlides,
				dir = orient ? self._horDir : self._verDir,
				loop = self._loop,
				changeHash = false,
				distOffset = 0;
			
			totalMoveDist = Math.abs(pPos - sPos);
			accDist = pPos - axPos;


			duration = (new Date().getTime()) - self._startTime;
			v0 = Math.abs(accDist) / duration;  

			if(dir === 0 || axNumItems <= 1) {
				returnToCurrent(true, v0);
				return;
			}

			if(!loop && !isThumbs) {
				if(axCurrItem <= 0) {
					if(dir > 0) {
						returnToCurrent(true, v0);
						return;
					}
				} else if(axCurrItem >= axNumItems - 1) {
					if(dir < 0) {
						returnToCurrent(true, v0);
						return;
					}
				}
			}

			if(!isThumbs) {
				if(sPos + snapDist < pPos) {
					if(dir < 0) {   
						returnToCurrent(false, v0);
						return;         
					}
					self._moveTo('prev', getCorrectSpeed(Math.abs(self._sPosition  - (-self._realId - self._idOffset + 1) * self._slideSize) / v0), changeHash, true, true);
				} else if(sPos - snapDist > pPos) {
					if(dir > 0) {   
						returnToCurrent(false, v0);
						return;         
					}
					self._moveTo('next', getCorrectSpeed(Math.abs(self._sPosition  - (-self._realId - self._idOffset - 1) * self._slideSize) / v0), changeHash, true, true);
				} else {
					returnToCurrent(false, v0);
				}
			} else {
				var newPos = self._thumbsPosition;
				var transitionSpeed;
				
				if(newPos > self._thumbsMinPosition) {
					newPos = self._thumbsMinPosition;
				} else if(newPos < self._thumbsMaxPosition) {
					newPos = self._thumbsMaxPosition;
				} else {
					var friction = 0.003,
						S = (v0 * v0) / (friction * 2),
						minXDist = -self._thumbsPosition,
						maxXDist = self._thumbsContainerSize - self._thumbsViewportSize + self._thumbsPosition;

					if (accDist > 0 && S > minXDist) {
						minXDist = minXDist + self._thumbsViewportSize / (15 / (S / v0 * friction));
						v0 = v0 * minXDist / S;
						S = minXDist;
					} else if (accDist < 0 && S > maxXDist) {
						maxXDist = maxXDist + self._thumbsViewportSize / (15 / (S / v0 * friction));
						v0 = v0 * maxXDist / S;
						S = maxXDist;
					}




					transitionSpeed =  Math.max(Math.round(v0 / friction), 50);
					newPos = newPos + S * (accDist < 0 ? -1 : 1);


					if(newPos > self._thumbsMinPosition) {
						self._animateThumbsTo(newPos, transitionSpeed, true, self._thumbsMinPosition, 200);
						return;
					 } else if(newPos < self._thumbsMaxPosition) {
						self._animateThumbsTo( newPos, transitionSpeed, true, self._thumbsMaxPosition, 200);
						return;
					}
				}

				self._animateThumbsTo(newPos, transitionSpeed, true);

			}
		},
		_setPosition: function(pos) {
			var self = this;
			pos = self._sPosition = pos;
			if(self._useCSS3Transitions) {
				self._slidesContainer.css(self._xProp, self._tPref1 + ( self._slidesHorizontal ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 );    
			} else {
				self._slidesContainer.css(self._slidesHorizontal ? self._xProp : self._yProp, pos);
			}
		},
		
		
		updateSliderSize: function(force) {
			var self = this,
				newWidth,
				newHeight;

			if(self.st.autoScaleSlider) {
				var asw = self.st.autoScaleSliderWidth,
					ash = self.st.autoScaleSliderHeight;

				if(self.st.autoScaleHeight) {
					newWidth = self.slider.width();
					if(newWidth != self.width) {
						self.slider.css("height", newWidth * (ash / asw) );
						newWidth = self.slider.width();
					} 
					newHeight = self.slider.height();
				} else {
					newHeight = self.slider.height();
					if(newHeight != self.height) {
						self.slider.css("width", newHeight * (asw / ash));
						newHeight = self.slider.height();
					}   
					newWidth = self.slider.width();
				}
			
			} else {
				newWidth = self.slider.width();
				newHeight = self.slider.height();
			}
			


			if(force || newWidth != self.width || newHeight != self.height) {
				self.width = newWidth;
				self.height = newHeight;

				self._wrapWidth = newWidth;
				self._wrapHeight = newHeight;

				self.ev.trigger('rsBeforeSizeSet');
				self.ev.trigger('rsAfterSizePropSet');

				self._sliderOverflow.css({
					width: self._wrapWidth,
					height: self._wrapHeight
				});


				self._slideSize = (self._slidesHorizontal ? self._wrapWidth : self._wrapHeight) + self.st.slidesSpacing;
				

				self._imagePadding = self.st.imageScalePadding;
				var item,
					slideItem,
					i,
					img;
				for(i = 0; i < self.slides.length; i++) {
					item = self.slides[i];
					item.positionSet = false;

					if(item && item.images && item.isLoaded) {
						item.isRendered = false;
						self._resizeImage(item);
					} 
				}
				if(self._cloneHolders) {
					for(i = 0; i < self._cloneHolders.length; i++) {
						item = self._cloneHolders[i];
						item.holder.css(self._reorderProp, (item.id + self._idOffset) * self._slideSize);
					}
				}
				
				self._updateBlocksContent();

				if(self._isMove) {
					if(self._useCSS3Transitions) {
						self._slidesContainer.css(self._vendorPref + 'transition-duration', '0s');
					}
					self._setPosition( (-self._realId - self._idOffset) * self._slideSize);
				}
				self.ev.trigger('rsOnUpdateNav');
			}
			self._sliderOffset = self._sliderOverflow.offset();
			self._sliderOffset = self._sliderOffset[self._reorderProp];


		},
		//setSlidesOrientation: function(orient) {
			// TODO
			// var self = this,
			//  newHor = Boolean(orient === 'horizontal');
			// if(self._slidesHorizontal !== newHor) {
			//  self._setPosition(0);
			//  if(self._isMove) {
			//    for(var i = 0; i < self._slideHolders.length; i++) {
			//      self._slideHolders[i].block.css(self._reorderProp, '');
			//    }
			//  }
			//  self.slider.removeClass(self._slidesHorizontal ? 'rsHor' : 'rsVer').addClass(newHor ? 'rsHor' : 'rsVer');
			//  self._slidesHorizontal = newHor;
			//  self._reorderProp = newHor ? 'left' : 'top';
			//  self.updateSliderSize(true);
			// }
		//},
		/**
		 * Adds slide
		 * @param  {jQuery object or raw HTML} htmltext 
		 * @param  {int} index    (optional) Index where item should be added (last item is removed of not specified)
		 */
		appendSlide: function(htmltext, index) {
			var self = this,
				parsedSlide = self._parseNode(htmltext);

			if(isNaN(index) || index > self.numSlides) {
				index = self.numSlides;
			}
			self.slides.splice(index, 0, parsedSlide);
			self.slidesJQ.splice(index, 0, '<div style="'+ (self._isMove ? 'position:absolute;' : self._opacityCSS ) +'" class="rsSlide"></div>');

			if(index < self.currSlideId) {
				self.currSlideId++;
			}
			self.ev.trigger('rsOnAppendSlide', [parsedSlide, index]);
			
			self._refreshSlides(index);

			if(index === self.currSlideId) {
				self.ev.trigger('rsAfterSlideChange');
			}
		},

		/**
		 * Removes slide
		 * @param  {int} Index of item that should be removed
		 */
		removeSlide: function(index) {
			var self = this,
				slideToRemove = self.slides[index];

			if(slideToRemove) {
				if(slideToRemove.holder) {
					slideToRemove.holder.remove();
				}
				if(index < self.currSlideId) {
					self.currSlideId--;
				}
				self.slides.splice(index, 1);
				self.slidesJQ.splice(index, 1);

				self.ev.trigger('rsOnRemoveSlide', [index]);
				self._refreshSlides(index);

				if(index === self.currSlideId) {
					self.ev.trigger('rsAfterSlideChange');
				}
			}
		},
		_refreshSlides: function(refreshIndex) {

			// todo: optimize this stuff
			var self = this;

			var oldNumSlides = self.numSlides;
			var numLoops = self._realId <= 0 ? 0 : Math.floor(self._realId / oldNumSlides);

			self.numSlides = self.slides.length;
			if(self.numSlides === 0) {
				self.currSlideId = self._idOffset = self._realId = 0;
				self.currSlide = self._oldHolder = null;
			} else {
				self._realId = numLoops * self.numSlides + self.currSlideId;
			}

			for(var i = 0; i < self.numSlides; i++) {
				self.slides[i].id = i;
			}

			self.currSlide = self.slides[self.currSlideId];
			self._currHolder = self.slidesJQ[self.currSlideId];

			if(self.currSlideId >= self.numSlides) {
				self.goTo(self.numSlides - 1);
			} else if(self.currSlideId < 0) {
				self.goTo(0);
			}

			self._refreshNumPreloadImages();

			if(self._isMove && self._loop) {
				self._slidesContainer.css((self._vendorPref + self._TD), '0ms');
			}
			if(self._refreshSlidesTimeout) {
				clearTimeout(self._refreshSlidesTimeout);
			}


			self._refreshSlidesTimeout = setTimeout(function() {
				if(self._isMove) {
					self._setPosition( (-self._realId - self._idOffset) * self._slideSize); 
				}
				self._updateBlocksContent();
				if(!self._isMove) {
					self._currHolder.css({
						display: 'block',
						opacity: 1
					});
				}
				
			}, 14);
			self.ev.trigger('rsOnUpdateNav');
		},
		_setGrabCursor:function() { 
			var self = this;
			if(self._hasDrag && self._isMove) {
				if(self._grabCursor) {
					self._sliderOverflow.css('cursor', self._grabCursor);
				} else {
					self._sliderOverflow.removeClass('grabbing-cursor');
					self._sliderOverflow.addClass('grab-cursor'); 
				}
			}
		},
		_setGrabbingCursor:function() {   
			var self = this;
			if(self._hasDrag && self._isMove) {
				if(self._grabbingCursor) {
					self._sliderOverflow.css('cursor', self._grabbingCursor);
				} else {
					self._sliderOverflow.removeClass('grab-cursor');
					self._sliderOverflow.addClass('grabbing-cursor'); 
				} 
			}
		},
		next: function(notUserAction) {
			var self = this;
			self._moveTo('next',  self.st.transitionSpeed, true, !notUserAction);
		},
		prev: function(notUserAction) {
			var self = this;
			self._moveTo('prev', self.st.transitionSpeed, true, !notUserAction);
		},
		_moveTo:function(type,  speed, inOutEasing, userAction, fromSwipe) {
			var self = this,
				newPos,
				difference,
				i;
			
			
			self.ev.trigger('rsBeforeMove', [type, userAction]);
			if(type === 'next') {
				newItemId = self.currSlideId+1;
			} else if(type === 'prev') {
				newItemId = self.currSlideId-1;
			} else {
				newItemId = type = parseInt(type, 10);
			}

			if(!self._loop) {
				if(newItemId < 0) {
					self._doBackAndForthAnim('left', !userAction);
					return;
				} else if(newItemId >= self.numSlides ) {
					self._doBackAndForthAnim('right', !userAction);
					return;
				}
			}
			
			if(self._isAnimating) {
				self._stopAnimation(true);
				inOutEasing = false;
			}

			difference = newItemId - self.currSlideId;



			self._prevSlideId = self.currSlideId;
			var prevId = self.currSlideId;
			var id = self.currSlideId + difference;
			var realId = self._realId;
			var temp;
			var delayed;
			if(self._loop) {
				id = self._updateBlocksContent(false, id);
				realId += difference;
			} else {
				realId = id;
			}
			self._newSlideId = id;

			self._oldHolder = self.slidesJQ[self.currSlideId];

			
			self._realId = realId;
			self.currSlideId = self._newSlideId;

			self.currSlide = self.slides[self.currSlideId];
			self._currHolder = self.slidesJQ[self.currSlideId];

			
			var checkDist = self.st.slidesDiff;
			var next = Boolean(difference > 0);
			var absDiff = Math.abs(difference);
			var g1 = Math.floor( prevId / self._numPreloadImages);
			var g2 = Math.floor( ( prevId + (next ? checkDist : -checkDist  ) ) / self._numPreloadImages);
			var biggest = next ? Math.max(g1,g2) : Math.min(g1,g2);
			var biggestId = biggest * self._numPreloadImages +  ( next ? (self._numPreloadImages - 1) : 0 );
			if(biggestId > self.numSlides - 1) {
				biggestId = self.numSlides - 1;
			} else if(biggestId < 0) {
				biggestId = 0;
			}
			var toLast =  next ? (biggestId - prevId) :  (prevId - biggestId);
			if(toLast > self._numPreloadImages) {
				toLast = self._numPreloadImages;
			}
			if(absDiff > toLast + checkDist) {
				self._idOffset +=  ( absDiff - (toLast + checkDist) ) * ( next ? -1 : 1 );
				speed = speed * 1.4;
				for(i = 0; i < self.numSlides; i++) {
					self.slides[i].positionSet = false;
				}
			}
			self._currAnimSpeed = speed;

			self._updateBlocksContent(true);
			if(!fromSwipe) {
				delayed = true;
			}


			newPos = (-realId - self._idOffset) * self._slideSize;


			if(delayed) {
				setTimeout(function() {
					self._isWorking = false;
					self._animateTo(newPos, type, false, inOutEasing);
					self.ev.trigger('rsOnUpdateNav');
				}, 0);
			} else {
				self._animateTo(newPos, type, false, inOutEasing);
				self.ev.trigger('rsOnUpdateNav');
			}
			
			
			function isSetToCurrent(testId) {
				if(testId < 0) {
					testId = self.numSlides + testId;
				} else if(testId > self.numSlides - 1) {
					testId = testId - self.numSlides;
				}
				if(testId !== self.currSlideId) {
					return false;
				}
				return true;
			}
			
		},
		_updateArrowsNav: function() {
			var self = this,
				arrDisClass = 'rsArrowDisabled';
			if(self.st.arrowsNav) {
				if(self.numSlides <= 1) {
					self._arrowLeft.css('display', 'none');
					self._arrowRight.css('display', 'none');
					return;
				} else {
					self._arrowLeft.css('display', 'block');
					self._arrowRight.css('display', 'block');
				}
				if(!self._loop && !self.st.loopRewind) {
					if(self.currSlideId === 0) {
						self._arrowLeft.addClass(arrDisClass);
					} else {
						self._arrowLeft.removeClass(arrDisClass);
					}
					if(self.currSlideId === self.numSlides - 1) {
						self._arrowRight.addClass(arrDisClass);
					} else {
						self._arrowRight.removeClass(arrDisClass);
					}
				}
			}
		},
		_animateTo:function(pos, dir,  loadAll, inOutEasing, customComplete) {
			var self = this,
				moveProp,
				oldBlock,
				animBlock;

			var animObj = {};
			if(isNaN(self._currAnimSpeed)) {
				self._currAnimSpeed = 400;
			} 
			


			self._sPosition = self._currRenderPosition = pos;

			self.ev.trigger('rsBeforeAnimStart');

			if(!self._useCSS3Transitions) {
				if(self._isMove) {
					animObj[self._slidesHorizontal ? self._xProp : self._yProp] = pos + 'px';


					self._slidesContainer.animate(animObj, self._currAnimSpeed, /*'easeOutQuart'*/ inOutEasing ? self.st.easeInOut : self.st.easeOut);
				} else {
					oldBlock = self._oldHolder;
					animBlock = self._currHolder;         

					animBlock.stop(true, true).css({
						opacity: 0,
						display: 'block',
						zIndex: self._fadeZIndex
					});
					self._currAnimSpeed = self.st.transitionSpeed;
					animBlock.animate({opacity: 1}, self._currAnimSpeed, self.st.easeInOut);

					
					clearTimeouts();
					if(oldBlock) {
						oldBlock.data('rsTimeout', setTimeout(function() {
							oldBlock.stop(true, true).css({
								opacity: 0,
								display: 'none',
								zIndex: 0
							});
						}, self._currAnimSpeed + 60) );
					}
				}
				
			} else {
				if(self._isMove) {
					
					

						self._currAnimSpeed = parseInt(self._currAnimSpeed);
						var td = self._vendorPref + self._TD;
						var ttf = self._vendorPref + self._TTF;

						animObj[td] = self._currAnimSpeed+'ms';
						animObj[ttf] = inOutEasing ? $.rsCSS3Easing[self.st.easeInOut] : $.rsCSS3Easing[self.st.easeOut];
						
						self._slidesContainer.css(animObj);
					if(inOutEasing || !self.hasTouch) {
						setTimeout(function() {
							self._setPosition(pos);
						}, 5);
					} else {
						self._setPosition(pos);
					} 
					
					

				} else {
					//self._currAnimSpeed = 10
					self._currAnimSpeed = self.st.transitionSpeed;
					oldBlock = self._oldHolder;
					animBlock = self._currHolder;   
					if(animBlock.data('rsTimeout')) {
						animBlock.css('opacity', 0);
					}
					clearTimeouts();
					if(oldBlock) {
						//if(oldBlock)
						oldBlock.data('rsTimeout', setTimeout(function() {
							animObj[self._vendorPref + self._TD] = '0ms';
							animObj.zIndex = 0;
							animObj.display = 'none';
							oldBlock.data('rsTimeout', '');
							oldBlock.css(animObj);
							setTimeout(function() {
								oldBlock.css('opacity', 0);
							}, 16);
						}, self._currAnimSpeed + 60) );
					}

					animObj.display = 'block';
					animObj.zIndex = self._fadeZIndex;
					animObj.opacity = 0;
					animObj[self._vendorPref + self._TD] = '0ms';
					animObj[self._vendorPref + self._TTF] = $.rsCSS3Easing[self.st.easeInOut];
					animBlock.css(animObj);
					animBlock.data('rsTimeout', setTimeout(function() {
						//animBlock.css('opacity', 0);
						animBlock.css(self._vendorPref + self._TD,  self._currAnimSpeed+'ms');

						//oldBlock.css(self._vendorPref + self._TD,  '0ms');
						animBlock.data('rsTimeout', setTimeout(function() {
							animBlock.css('opacity', 1);
							animBlock.data('rsTimeout', '');
						}, 20) );
					}, 20) );
				}
			}
			self._isAnimating = true;
			if(self.loadingTimeout) {
				clearTimeout(self.loadingTimeout);
			}
			if(customComplete) {
				self.loadingTimeout = setTimeout(function() {
					self.loadingTimeout = null;
					customComplete.call();

				}, self._currAnimSpeed + 60);
			} else {
				self.loadingTimeout = setTimeout(function() {
					self.loadingTimeout = null;
					self._animationComplete(dir);
				}, self._currAnimSpeed + 60);
			}

			function clearTimeouts() {
				var t;
				if(oldBlock) {
					t = oldBlock.data('rsTimeout');
					if(t) {
						if(oldBlock !== animBlock) {
							oldBlock.css({
									opacity: 0,
									display: 'none',
									zIndex: 0
								});
						}
						clearTimeout(t);
						oldBlock.data('rsTimeout', '');
					}
				}
				
				t = animBlock.data('rsTimeout');
				if(t) {
					clearTimeout(t);
					animBlock.data('rsTimeout', '');
				}
			}
		},
		_stopAnimation: function(noCSS3) {
			var self = this;
			self._isAnimating = false;
			clearTimeout(self.loadingTimeout);
			if(self._isMove) {

				if(!self._useCSS3Transitions) {
					self._slidesContainer.stop(true);
					self._sPosition = parseInt(self._slidesContainer.css(self._xProp), 10);
				} else if (!noCSS3) {
					var oldPos = self._sPosition;
					var newPos =  self._currRenderPosition = self._getTransformProp();
					self._slidesContainer.css((self._vendorPref + self._TD), '0ms');
					if(oldPos !==newPos) {
						self._setPosition(newPos);
					}
				}
			} else {
				// kung fu
				if(self._fadeZIndex > 20) {
					self._fadeZIndex = 10;
				} else {
					self._fadeZIndex++;
				}
			}
			
			
		},
		// Thanks to @benpbarnett
		_getTransformProp:function(){
			var self = this,
				transform = window.getComputedStyle(self._slidesContainer.get(0), null).getPropertyValue(self._vendorPref + 'transform'),     
				explodedMatrix = transform.replace(/^matrix\(/i, '').split(/, |\)$/g),
				isMatrix3d = (explodedMatrix[0].indexOf('matrix3d') === 0);
			return parseInt(explodedMatrix[(self._slidesHorizontal ? (isMatrix3d ? 12 : 4) : (isMatrix3d ? 13 : 5) )], 10);
		},
		_getCSS3Prop: function(pos, hor) {
			var self = this;
			return self._useCSS3Transitions ? self._tPref1 + ( hor ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 : pos;
		},
		_animationComplete: function(dir) {
			var self = this;
			if(!self._isMove) {
				self._currHolder.css('z-index', 0);
				self._fadeZIndex = 10;
			}
			self._isAnimating = false;
			
			self.staticSlideId = self.currSlideId;
			self._updateBlocksContent();


			self._slidesMoved = false;
			
			self.ev.trigger('rsAfterSlideChange');
		},
		_doBackAndForthAnim:function(type, userAction) {
			var self = this,
				newPos = (-self._realId - self._idOffset) * self._slideSize;

			if(self.numSlides === 0 || self._isAnimating) {
				return;
			} 
			if(self.st.loopRewind) {
				self.goTo(type === 'left' ? self.numSlides - 1 : 0, userAction);
				return;
			}

			if(self._isMove) {
				self._currAnimSpeed = 200;

				function allAnimComplete() {
					self._isAnimating = false;
				}
				function firstAnimComplete() {
					self._isAnimating = false;
					self._animateTo(newPos, '', false, true, allAnimComplete);
				}
				self._animateTo(newPos + (type === 'left' ? 30 : -30),'', false, true, firstAnimComplete);
			}
			
		},
		_resizeImage:function(slideObject, useClone) {

			var isRoot = true;
			if(slideObject.isRendered) {
				return;
			}
			var img = slideObject.content;
			var classToFind = 'rsMainSlideImage';
			var isVideo;
			var self = this,
				imgAlignCenter = self.st.imageAlignCenter,
				imgScaleMode = self.st.imageScaleMode,
				tempEl;

			if(slideObject.videoURL) {
				classToFind = 'rsVideoContainer';
				if(imgScaleMode !== 'fill') {
					isVideo = true;
				} else {
					tempEl = img;
					if(!tempEl.hasClass(classToFind)) {
						tempEl = tempEl.find('.'+classToFind);
					}
					tempEl.css({width:'100%',height: '100%'});
					classToFind = 'rsMainSlideImage';
				}
			}
			if(!img.hasClass(classToFind)) {
				isRoot = false;
				img = img.find('.'+classToFind);
			}
			if(!img) {
				return;
			}

			var baseImageWidth = slideObject.iW,
				baseImageHeight = slideObject.iH;

			slideObject.isRendered = true;
			if(imgScaleMode === 'none' && !imgAlignCenter) {
				return;
			}
			if(imgScaleMode !== 'fill') {
				bMargin = self._imagePadding;
			} else {
				bMargin = 0;
			}
			//var block = img.parent('.block-inside').css('margin', bMargin);
			var containerWidth = self._wrapWidth - bMargin * 2,
				containerHeight = self._wrapHeight - bMargin * 2,
				hRatio,
				vRatio,
				ratio,
				nWidth,
				nHeight,
				cssObj = {};

			if(imgScaleMode === 'fit-if-smaller') {
				if(baseImageWidth > containerWidth || baseImageHeight > containerHeight) {
					imgScaleMode = 'fit';
				}
			}
			if(imgScaleMode === 'fill' || imgScaleMode === 'fit') {   
				hRatio = containerWidth / baseImageWidth;
				vRatio = containerHeight / baseImageHeight;

				if (imgScaleMode  == "fill") {
					ratio = hRatio > vRatio ? hRatio : vRatio;                          
				} else if (imgScaleMode  == "fit") {
					ratio = hRatio < vRatio ? hRatio : vRatio;                    
				} else {
					ratio = 1;
				}

				nWidth = Math.ceil(baseImageWidth * ratio, 10);
				nHeight = Math.ceil(baseImageHeight * ratio, 10);
			} else {                
				nWidth = baseImageWidth;
				nHeight = baseImageHeight;    
			}
			if(imgScaleMode !== 'none') {
				cssObj.width = nWidth;
				cssObj.height = nHeight;
				if(isVideo) {
					img.find('.rsImg').css({width: '100%', height:'100%'});
				}
			}
			if (imgAlignCenter) { 
				cssObj.marginLeft = Math.floor((containerWidth - nWidth) / 2) +  bMargin;
				cssObj.marginTop = Math.floor((containerHeight - nHeight) / 2) +  bMargin;
			}
			img.css(cssObj);
		}
	}; /* RoyalSlider core prototype end */
	$.rsProto = RoyalSlider.prototype;

	$.fn.royalSlider = function(options) {      
		var args = arguments;
		return this.each(function(){
			var self = $(this);
			if (typeof options === "object" ||  !options) {
				if( !self.data('royalSlider') ) {
					self.data('royalSlider', new RoyalSlider(self, options));
				}
			} else {
				var royalSlider = self.data('royalSlider');
				if (royalSlider && royalSlider[options]) {
					return royalSlider[options].apply(royalSlider, Array.prototype.slice.call(args, 1));
				}
			}
		});
	};

	$.fn.royalSlider.defaults = {    
		slidesSpacing: 8,
		startSlideId: 0,
		loop: false,
		loopRewind: false,
		numImagesToPreload: 4,
		fadeinLoadedSlide: true,
		slidesOrientation: 'horizontal', 
		transitionType: 'move', 
		transitionSpeed: 600,
		controlNavigation: 'bullets',
		controlsInside: true, 
		arrowsNav: true,
		arrowsAutoplay: true,
		arrowsNavAutoHide: false,
		navigateByClick: true,
		randomizeSlides: false,
		sliderDrag: true, 
		sliderTouch: true,
		keyboardNavEnabled: false,
		fadeInAfterLoaded: true,

		allowCSS3: true,
		allowCSS3OnWebkit: true,

		
		addActiveClass: false,
		autoHeight: false,

		easeOut: 'easeOutSine',
		easeInOut: 'easeInOutSine',

		minSlideOffset: 10,

		imageScaleMode:"fit-if-smaller",                 
		imageAlignCenter:true,        
		imageScalePadding: 4,
		usePreloader: true,

		autoScaleSlider: false,               
						
			autoScaleSliderWidth: 800,       
			autoScaleSliderHeight: 400,   

			autoScaleHeight: true,      

			arrowsNavHideOnTouch: false,
			globalCaption: false,

			slidesDiff: 2,
			
			disableResponsiveness: false // !disable responsiveness option
	}; /* default options end */

	$.rsCSS3Easing = {
		easeOutSine: 'cubic-bezier(0.390, 0.575, 0.565, 1.000)',
		easeInOutSine: 'cubic-bezier(0.445, 0.050, 0.550, 0.950)'
	};

	$.extend(jQuery.easing, {
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		}
	});

	/****************************************************************************************************************/
	/**
	 *
	 * RoyalSlider fullscreen module
	 * @version 1.0.5:
	 *
	 * 1.0.1:
	 * - Added rsEnterFullscreen and rsExitFullscreen events
	 *
	 * 1.0.2
	 * - Added window scroll detection
	 *
	 * 1.0.3
	 * - Fullscreen button now is added to _controlsContainer element
	 *
	 * 1.0.4
	 * - Fixed issue that could cause small image be loaded in fullscreen
	 *
	 * 1.0.5
	 * - Fix "false" native fullscreen on Android
	 * 
	 */
	$.extend($.rsProto, {
		_initFullscreen: function() {
			var self = this;

			self._fullscreenDefaults = {
				enabled: false,
				keyboardNav: true,
				buttonFS: true,
				nativeFS: false,
				doubleTap: true
			};
			self.st.fullscreen = $.extend({}, self._fullscreenDefaults, self.st.fullscreen);

			if(self.st.fullscreen.enabled) {
				self.ev.one('rsBeforeSizeSet', function() {
					self._setupFullscreen();
				});
			}
		},
		_setupFullscreen: function() {
			var self = this;
			self._fsKeyboard = (!self.st.keyboardNavEnabled && self.st.fullscreen.keyboardNav);

			if(self.st.fullscreen.nativeFS) {
				// Thanks to John Dyer http://j.hn/
					self._fullScreenApi = {
									supportsFullScreen: false,
									isFullScreen: function() { return false; },
									requestFullScreen: function() {},
									cancelFullScreen: function() {},
									fullScreenEventName: '',
									prefix: ''
							};
					var browserPrefixes = 'webkit moz o ms khtml'.split(' ');
					// check for native support
					if(!self.isAndroid) {
					
						if (typeof document.cancelFullScreen != 'undefined') {
								 self._fullScreenApi.supportsFullScreen = true;
						} else {
								// check for fullscreen support by vendor prefix
								for (var i = 0; i < browserPrefixes.length; i++ ) {
										 self._fullScreenApi.prefix = browserPrefixes[i];
				 
										if (typeof document[ self._fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ) {
												 self._fullScreenApi.supportsFullScreen = true;
				 
												break;
										}
								}
						}

					}
			 
					// update methods to do something useful
					if ( self._fullScreenApi.supportsFullScreen) {
						self.nativeFS = true;
							 self._fullScreenApi.fullScreenEventName =  self._fullScreenApi.prefix + 'fullscreenchange' + self.ns;
				
							 self._fullScreenApi.isFullScreen = function() {
									switch (this.prefix) {
											case '':
													return document.fullScreen;
											case 'webkit':
													return document.webkitIsFullScreen;
											default:
													return document[this.prefix + 'FullScreen'];
									}
							};
							 self._fullScreenApi.requestFullScreen = function(el) {
									return (this.prefix === '') ? el.requestFullScreen() : el[this.prefix + 'RequestFullScreen']();
							};
							 self._fullScreenApi.cancelFullScreen = function(el) {
									return (this.prefix === '') ? document.cancelFullScreen() : document[this.prefix + 'CancelFullScreen']();
							};
					} else {
						self._fullScreenApi = false;
					}
			}


			if(self.st.fullscreen.buttonFS) {
				self._fsBtn = $('<div class="rsFullscreenBtn"><div class="rsFullscreenIcn"></div></div>')
					.appendTo(self._controlsContainer)
					.on('click.rs', function() {
						if(self.isFullscreen) {
							self.exitFullscreen();
						} else {

							self.enterFullscreen();
						}
					});
			}
		},
		enterFullscreen: function(preventNative) {
			var self = this;
			if( self._fullScreenApi ) {
				if(!preventNative) {
					self._doc.on( self._fullScreenApi.fullScreenEventName, function(e) {
						if(!self._fullScreenApi.isFullScreen()) {
							self.exitFullscreen(true);
						} else {
							self.enterFullscreen(true);
						}
					});
					self._fullScreenApi.requestFullScreen($('html')[0]);
					return;
				} else {
					self._fullScreenApi.requestFullScreen($('html')[0]);
				}
			}

			if(self._isFullscreenUpdating) {
				return;
			}
			self._isFullscreenUpdating = true;

			self._doc.on('keyup' + self.ns + 'fullscreen', function(e) {
				if(e.keyCode === 27) {
					self.exitFullscreen();
				}
			});
			if(self._fsKeyboard) {
				self._bindKeyboardNav();
			}

			var win = $(window);
			self._fsScrollTopOnEnter = win.scrollTop();
			self._fsScrollLeftOnEnter = win.scrollLeft();

			self._htmlStyle = $('html').attr('style');
			self._bodyStyle = $('body').attr('style');
			self._sliderStyle = self.slider.attr('style');

			$('body, html').css({
				overflow: 'hidden',
				height: '100%',
				width: '100%',
				margin: '0',
				padding: '0'
			});

			self.slider.addClass('rsFullscreen');
			
		
			var item,
				i;
			for(i = 0; i < self.numSlides; i++) {
				item = self.slides[i];
				
				item.isRendered = false;
				if(item.bigImage) {
					item.isBig = true;
					item.isMedLoaded = item.isLoaded;
					item.isMedLoading = item.isLoading;
					item.medImage = item.image;
					item.medIW = item.iW;
					item.medIH = item.iH;
					item.slideId = -99;

					if(item.bigImage !== item.medImage) {
						item.sizeType = 'big';
					}

					item.isLoaded = item.isBigLoaded;
					item.isLoading = false;
					item.image = item.bigImage;
					item.images[0] = item.bigImage;
					item.iW = item.bigIW;
					item.iH = item.bigIH;

					item.isAppended = item.contentAdded = false;
					self._updateItemSrc(item);
				}
				
			}

			
			self.isFullscreen = true;
			
			self._isFullscreenUpdating = false;
			self.updateSliderSize();
			self.ev.trigger('rsEnterFullscreen');
			
		},
		exitFullscreen: function(preventNative) {
			var self = this;

			if( self._fullScreenApi ) {
				if(!preventNative) {
					self._fullScreenApi.cancelFullScreen($('html')[0]);
					return;
				}
				self._doc.off( self._fullScreenApi.fullScreenEventName );
			}
			if(self._isFullscreenUpdating) {
				return;
			}
			self._isFullscreenUpdating = true;

			self._doc.off('keyup'  + self.ns + 'fullscreen');
			if(self._fsKeyboard) {
				self._doc.off('keydown' + self.ns);
			}

			$('html').attr('style', self._htmlStyle || '');
			$('body').attr('style', self._bodyStyle || '');
			

			
			var item,
				i;
			for(i = 0; i < self.numSlides; i++) {
				item = self.slides[i];
				
				
				item.isRendered = false;
				if(item.bigImage) {
					item.isBig = false;
					item.slideId = -99;
					item.isBigLoaded = item.isLoaded;
					item.isBigLoading = item.isLoading;
					item.bigImage = item.image;
					item.bigIW = item.iW;
					item.bigIH = item.iH;
					item.isLoaded = item.isMedLoaded;
					item.isLoading = false;
					item.image = item.medImage;
					item.images[0] = item.medImage;
					item.iW = item.medIW;
					item.iH = item.medIH;

					item.isAppended = item.contentAdded = false;

					self._updateItemSrc(item, true);
					
					
					if(item.bigImage !== item.medImage) {
						item.sizeType = 'med';
					}
				}
			}
			
			self.isFullscreen = false;

			var win = $(window);
			win.scrollTop( self._fsScrollTopOnEnter );
			win.scrollLeft( self._fsScrollLeftOnEnter );
			
			self._isFullscreenUpdating = false;
			self.slider.removeClass('rsFullscreen');

			self.updateSliderSize();
			// fix overflow bug
			setTimeout(function() {
				self.updateSliderSize();
			},1);
			self.ev.trigger('rsExitFullscreen');
		},
		_updateItemSrc: function(item, exit) {
			var newHTML = (!item.isLoaded && !item.isLoading) ? '<a class="rsImg rsMainSlideImage" href="'+item.image+'"></a>' : '<img class="rsImg rsMainSlideImage" src="'+item.image+'"/>';
			
			if(item.content.hasClass('rsImg')) {
				item.content = $(newHTML);
			} else {
				item.content.find('.rsImg').eq(0).replaceWith(newHTML);
			}
			if(!item.isLoaded && !item.isLoading && item.holder) {
				item.holder.html(item.content);
			}
		}
	});
	$.rsModules.fullscreen = $.rsProto._initFullscreen;

	/****************************************************************************************************************/

		/**
	 *
	 * RoyalSlider bullets module
	 * @version 1.0.1:
	 *
	 * 1.0.1
	 * - Minor optimizations
	 * 
	 */ 
	$.extend($.rsProto, {
		_initBullets: function() {
			var self = this;
			if(self.st.controlNavigation === 'bullets') {
				var itemHTML = '<div class="rsNavItem rsBullet"><span></span></div>';
				self.ev.one('rsAfterPropsSetup', function() {

					self._controlNavEnabled = true;
					self.slider.addClass('rsWithBullets');
					var out = '<div class="rsNav rsBullets">';
					for(var i = 0; i < self.numSlides; i++) {
						out += itemHTML;
					}
					self._controlNav = out = $(out + '</div>');
					self._controlNavItems = out.appendTo(self.slider).children();

					self._controlNav.on('click.rs','.rsNavItem',function(e) {
						if(!self._thumbsDrag ) {
							self.goTo( $(this).index() );
						}
					});
				});

				self.ev.on('rsOnAppendSlide', function(e, parsedSlide, index) {
					if(index >= self.numSlides) {
						self._controlNav.append(itemHTML);
					} else {
						self._controlNavItems.eq(index).before(itemHTML);
					}
					self._controlNavItems = self._controlNav.children();
				});
				self.ev.on('rsOnRemoveSlide', function(e, index) {
					var itemToRemove = self._controlNavItems.eq(index);
					if(itemToRemove && itemToRemove.length) {
						itemToRemove.remove();
						self._controlNavItems = self._controlNav.children();
					}
					
				}); 

				self.ev.on('rsOnUpdateNav', function() {
					var id = self.currSlideId,
						currItem,
						prevItem;
					if(self._prevNavItem) {
						self._prevNavItem.removeClass('rsNavSelected');
					}
					currItem = self._controlNavItems.eq(id);

					currItem.addClass('rsNavSelected');
					self._prevNavItem = currItem;
				});
			}
		}
	});
	$.rsModules.bullets = $.rsProto._initBullets;

	/****************************************************************************************************************/
	/**
	 *
	 * RoyalSlider auto height module
	 * @version 1.0.2:
	 *
	 * 1.0.2
	 * - Changed "on" to "one" in afterInit event listener
	 * - Removed id="clear"
	 */ 
	$.extend($.rsProto, {
		_initAutoHeight: function() {
			var self = this;
			if(self.st.autoHeight) {
				var holder,
					tH,
					currSlide,
					currHeight,
					updHeight = function(animate) {
						currSlide = self.slides[self.currSlideId];
						holder = currSlide.holder;

						if(holder) {
							tH = holder.height();
							if(tH && tH !== currHeight) {
								self._wrapHeight = tH;
								if(self._useCSS3Transitions || !animate) {
									self._sliderOverflow.css('height', tH);
								} else {
									self._sliderOverflow.stop(true,true).animate({height: tH}, self.st.transitionSpeed);
								}
							}
						}
					};

				self.ev.on('rsMaybeSizeReady.rsAutoHeight', function(e, slideObject) {
					if(currSlide === slideObject) {
						updHeight();
					}
				});

				self.ev.on('rsAfterContentSet.rsAutoHeight', function(e, slideObject) {
					if(currSlide === slideObject) {
						updHeight();
					}
				});
				


				self.slider.addClass('rsAutoHeight');
				self.ev.one('rsAfterInit', function() {
					setTimeout(function() {
						updHeight(false);
						setTimeout(function() {
							self.slider.append('<div style="clear:both; float: none;"></div>');
							if(self._useCSS3Transitions) {
								self._sliderOverflow.css(self._vendorPref + 'transition', 'height ' + self.st.transitionSpeed + 'ms ease-in-out');
							}
						}, 16);
					}, 16);
				});
				self.ev.on('rsBeforeAnimStart', function() {
					updHeight(true);
				});
				self.ev.on('rsBeforeSizeSet' , function() {
					setTimeout(function() {
						updHeight(false);
					}, 16);
				});
			}
			
		}
	});
	$.rsModules.autoHeight = $.rsProto._initAutoHeight;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider video module
	 * @version 1.1.0:
	 *
	 * 1.0.3:
	 * - Added rsOnDestroyVideoElement event
	 *
	 * 1.0.4:
	 * - Added wmode=transparent to default YouTube video embed code
	 *
	 * 1.0.5
	 * - Fixed bug: HTMl5 YouTube player sometimes keeps playing in ie9 after closing
	 *
	 * 1.0.6
	 * - A bit lightened Vimeo and YouTube regex 
	 *
	 * 1.0.7
	 * - Minor optimizations
	 * - Added autoHideCaption option
	 *
	 * 1.0.9
	 * - Fixed error that could appear if updateSliderSize method is called directly after video close
	 *
	 * 1.1.0
	 * - Video is now removed in rsAfterSlideChange event to avoid transition lag
	 * - Fixed bug that could cause appearing of arrows with auto-hide
	 */
	$.extend($.rsProto, {
		_initVideo: function() {
			var self = this;
			self._videoDefaults = {
				autoHideArrows: true,
				autoHideControlNav: false,
				autoHideBlocks: false,
				autoHideCaption: false,
				youTubeCode: '<iframe src="http://www.youtube.com/embed/%id%?rel=1&autoplay=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="no"></iframe>',
				vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?byline=0&amp;portrait=0&amp;autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
			};

			self.st.video = $.extend({}, self._videoDefaults, self.st.video);

			self.ev.on('rsBeforeSizeSet', function() {
				if(self._isVideoPlaying) {
					setTimeout(function() {
						var content = self._currHolder;
						content = content.hasClass('rsVideoContainer') ? content : content.find('.rsVideoContainer');
						if(self._videoFrameHolder) {
							self._videoFrameHolder.css({
								width: content.width(),
								height: content.height()
							});
						}
					}, 32);
				}
			});
			var isFF = self._browser.mozilla;
			self.ev.on('rsAfterParseNode', function(e, content, obj) {
				var jqcontent = $(content),
					tempEl,
					hasVideo;

				if(obj.videoURL) {
					if(!hasVideo && isFF) {
						hasVideo = true;
						self._useCSS3Transitions = self._use3dTransform = false;
					}
					var wrap = $('<div class="rsVideoContainer"></div>'),
						playBtn = $('<div class="rsBtnCenterer"><div class="rsPlayBtn"><div class="rsPlayBtnIcon"></div></div></div>');
					if(jqcontent.hasClass('rsImg')) {
						obj.content = wrap.append(jqcontent).append(playBtn);
					} else {
						obj.content.find('.rsImg').wrap(wrap).after(playBtn);
						if(obj.content.find('.rsCLink').length > 0){
							obj.content.find('.rsCLink').appendTo(playBtn);
							playBtn.addClass("with-link");
						}
					}
				}
			});

			self.ev.on('rsAfterSlideChange', function() {
				self.stopVideo();
			});

		},
		toggleVideo: function() {
			var self = this;
			if(!self._isVideoPlaying) {
				return self.playVideo();
			} else {
				return self.stopVideo();
			}
		},
		playVideo: function() {
			var self = this;
			if(!self._isVideoPlaying) {
				var currSlide = self.currSlide;
				if(!currSlide.videoURL) {
					return false;
				}

				
				var content = self._currVideoContent = currSlide.content;
				var url = currSlide.videoURL,
					videoId,
					regExp,
					match;

				if( url.match(/youtu\.be/i) || url.match(/youtube\.com/i) ) {

					regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;


						match = url.match(regExp);
						if (match && match[7].length==11){
								videoId = match[7];
						}

					if(videoId !== undefined) {
						self._videoFrameHolder = self.st.video.youTubeCode.replace("%id%", videoId);
					}
				} else if(url.match(/vimeo\.com/i)) {
					regExp = /(www\.)?vimeo.com\/(\d+)($|\/)/;
					match = url.match(regExp);
					if(match) {
						videoId = match[2];
					}
					if(videoId !== undefined) {
						self._videoFrameHolder = self.st.video.vimeoCode.replace("%id%", videoId);
					}
				}
				self.videoObj = $(self._videoFrameHolder);

				self.ev.trigger('rsOnCreateVideoElement', [url]);


				if(self.videoObj.length) {
					self._videoFrameHolder = $('<div class="rsVideoFrameHolder"><div class="rsPreloader"></div><div class="rsCloseVideoBtn"><div class="rsCloseVideoIcn"></div></div></div>');
					self._videoFrameHolder.find('.rsPreloader').after(self.videoObj);
					content = content.hasClass('rsVideoContainer') ? content : content.find('.rsVideoContainer');
					self._videoFrameHolder.css({
						width: content.width(),
						height: content.height()
					}).find('.rsCloseVideoBtn').off('click.rsv').on('click.rsv', function(e) {
						self.stopVideo();
						e.preventDefault();
						e.stopPropagation();
						return false;
					});
					content.append(self._videoFrameHolder);
					if(self.isIPAD) {
						content.addClass('rsIOSVideo');
					}

					self._toggleHiddenClass(false);

					setTimeout(function() {
						self._videoFrameHolder.addClass('rsVideoActive');
					}, 10);
					self.ev.trigger('rsVideoPlay');
					self._isVideoPlaying = true;
				}
				return true;
			}
			return false;
		},
		stopVideo: function() {
			var self = this;
			if(self._isVideoPlaying) {
				if(self.isIPAD) {
					self.slider.find('.rsCloseVideoBtn').remove();
				}
				
				self._toggleHiddenClass(true);

				setTimeout(function() {
					self.ev.trigger('rsOnDestroyVideoElement', [self.videoObj]);
					var ifr = self._videoFrameHolder.find('iframe');
					if(ifr.length) {
						try {
							ifr.attr('src', "");
						} catch(ex) { }
					}
					self._videoFrameHolder.remove();
					self._videoFrameHolder = null;
				}, 16);
				self.ev.trigger('rsVideoStop');
				self._isVideoPlaying = false;
				return true;
			} 
			return false;
		},
		_toggleHiddenClass: function(remove) {
			var arr = [],
				self = this,
				vst = self.st.video;
			if(vst.autoHideArrows) {
				if(self._arrowLeft) {
					arr.push(self._arrowLeft, self._arrowRight);
					self._arrowsAutoHideLocked = !remove;
				}
				if(self._fsBtn) {
					arr.push(self._fsBtn);
				}
			}
			if(vst.autoHideControlNav && self._controlNav) {
				arr.push(self._controlNav);
			}
			if(vst.autoHideBlocks && self.currSlide.animBlocks) {
				arr.push(self.currSlide.animBlocks);
			}
			if(vst.autoHideCaption && self.globalCaption) {
				arr.push(self.globalCaption);
			}

			if(arr.length) {
				for(var i = 0; i < arr.length; i++) {
					if(!remove) {
						arr[i].addClass('rsHidden');
					} else {
						arr[i].removeClass('rsHidden');
					}
				}
			}
		}
	});
	$.rsModules.video = $.rsProto._initVideo;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider auto play module
	 * @version 1.0.5:
	 *
	 * 1.0.3:
	 * - added support for 'autoplay' property name. 
	 *
	 * 1.0.4
	 * - added toggleAutoPlay public method
	 *
	 * 1.0.5
	 * - Fixed issue when autoPlay may not pause when switching browser tabs
	 */
	$.extend($.rsProto, {
		_initAutoplay: function() {
			var self = this,
				del;

			self._autoPlayDefaults = {
				enabled: false,
					stopAtAction: true,
					pauseOnHover: true,
					delay: 2000
			};

			// fix deprecated name
			if(!self.st.autoPlay && self.st.autoplay) {
				self.st.autoPlay = self.st.autoplay;
			}
			self.st.autoPlay = $.extend({}, self._autoPlayDefaults, self.st.autoPlay);

			if(self.st.autoPlay.enabled) {
				self.ev.on('rsBeforeParseNode', function(e, content, obj) {
					content = $(content);
					del = content.attr('data-rsDelay');
					if(del) {
						obj.customDelay = parseInt(del, 10);
					}
				});
				self.ev.one('rsAfterInit', function() {
					self._setupAutoPlay();
				});
				self.ev.on('rsBeforeDestroy', function() {
					self.stopAutoPlay();
					$(window).off('blur'+self.ns + ' focus' + self.ns);
				});
				
			}
		},
		_setupAutoPlay: function() {
			var self = this;
				
			self.startAutoPlay();

			self.ev.on('rsAfterContentSet', function(e, slideObject) {
				if(!self._isDragging && !self._isAnimating && self._autoPlayEnabled && slideObject === self.currSlide ) {
					self._play();
				}
			});
			self.ev.on('rsDragRelease', function() {
				if(self._autoPlayEnabled && self._autoPlayPaused) {
					self._autoPlayPaused = false;
					self._play();
				}
			});
			self.ev.on('rsAfterSlideChange', function() {
				if(self._autoPlayEnabled) {
					if(self._autoPlayPaused) {
						self._autoPlayPaused = false; 

						if(self.currSlide.isLoaded) {
							self._play();
						}
					}
				}
			});
			self.ev.on('rsDragStart', function() {
				if(self._autoPlayEnabled) {
					if(self.st.autoPlay.stopAtAction) {
						self.stopAutoPlay();
					} else {
						self._autoPlayPaused = true;
						self._pause();
					}
				}
			});
			self.ev.on('rsBeforeMove', function(e, type, userAction) {
				if(self._autoPlayEnabled) {
					if(userAction && self.st.autoPlay.stopAtAction) {
						self.stopAutoPlay();
					} else {
						self._autoPlayPaused = true;
						self._pause();
					}
				}
			});

			self._pausedByVideo = false;
			self.ev.on('rsVideoStop', function() {
				if(self._autoPlayEnabled) {
					self._pausedByVideo = false;
					self._play();
				}
			});
			self.ev.on('rsVideoPlay', function() {
				if(self._autoPlayEnabled) {
					self._autoPlayPaused = false;
					self._pause();
					self._pausedByVideo = true;
				} 
			});

			$(window).on('blur'+self.ns, function(){
				if(self._autoPlayEnabled) {
					self._autoPlayPaused = true;
					self._pause();
				}
			}).on('focus'+self.ns, function(){
					if(self._autoPlayEnabled && self._autoPlayPaused) {
					self._autoPlayPaused = false;
					self._play();
				}
			});

			if(self.st.autoPlay.pauseOnHover) {
				self._pausedByHover = false;
				self.slider.hover(
					function() {
						if(self._autoPlayEnabled) {
							self._autoPlayPaused = false;
							self._pause();
							self._pausedByHover = true;
						} 
					},
					function() {
						if(self._autoPlayEnabled) {
							self._pausedByHover = false;
							self._play();
						}
					}
				);  
			}
			
		},
		toggleAutoPlay: function() {
			var self = this;
			if(self._autoPlayEnabled) {
				self.stopAutoPlay();
			} else {
				self.startAutoPlay();
			}
		},
		startAutoPlay: function() {
			var self = this;
			self._autoPlayEnabled = true;
			if(self.currSlide.isLoaded) {
				self._play();
			}
		},
		stopAutoPlay: function() {
			var self = this;
			self._pausedByVideo = self._pausedByHover = self._autoPlayPaused = self._autoPlayEnabled = false;
			self._pause();
		},
		_play: function() {
			var self = this;
			self.ev.trigger('autoPlayPlay');

			if(!self._pausedByHover && !self._pausedByVideo) {
				self._autoPlayRunning = true;
				if(self._autoPlayTimeout) {
					clearTimeout(self._autoPlayTimeout);
				}
				self._autoPlayTimeout = setTimeout(function() {
					var changed;
					if(!self._loop && !self.st.loopRewind) {
						changed = true;
						self.st.loopRewind = true;
					}
					self.next(true);
					if(changed) {
						changed = false;
						self.st.loopRewind = false;
					}
				}, !self.currSlide.customDelay ? self.st.autoPlay.delay : self.currSlide.customDelay);
			}
			
		},
		_pause: function() {
			var self = this;
			self.ev.trigger('autoPlayPause');

			if(!self._pausedByHover && !self._pausedByVideo) {
				self._autoPlayRunning = false;
				if(self._autoPlayTimeout) {
					clearTimeout(self._autoPlayTimeout);
					self._autoPlayTimeout = null;
				}
			}
		}
	});
	$.rsModules.autoplay = $.rsProto._initAutoplay;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider animated blocks module
	 * @version 1.0.6:
	 *
	 * 1.0.2:
	 * - Fixed mistake from prev fix :/
	 * 
	 * 1.0.3:
	 * - Fixed animated block appearing in Firefox
	 *
	 * 1.0.4
	 * - Fixed bug that could cause incorrect block when randomizeSlides is enabled
	 *
	 * 1.0.5
	 * - moveEffect:none' bug
	 *
	 * 1.0.6
	 * - Fixed issue that could cause incorrect position of blocks in IE
	 */ 
	$.extend($.rsProto, {
		_initAnimatedBlocks: function() {
			var self = this,
				i;

			self._blockDefaults = {
				fadeEffect: true,
				moveEffect: 'top', 
				moveOffset:20,               
				speed:400,               
				easing:'easeOutSine',      
				delay:200                 
			};
			self.st.block = $.extend({}, self._blockDefaults, self.st.block);

			self._blockAnimProps = [];
			self._animatedBlockTimeouts = [];

			self.ev.on('rsAfterInit', function() {
				runBlocks();
			});

			self.ev.on('rsBeforeParseNode', function(e, content, obj) {
				content = $(content);

				obj.animBlocks = content.find('.rsABlock').css('display', 'none');
				if(!obj.animBlocks.length) {
					if(content.hasClass('rsABlock')) {
						obj.animBlocks = content.css('display', 'none');
					} else {
						obj.animBlocks = false;
					}
				}
			});
			self.ev.on('rsAfterContentSet', function(e, slideObject) {
				var currId = self.slides[self.currSlideId].id; 
				if(slideObject.id === currId) {
					setTimeout(function() {
						runBlocks();
					}, self.st.fadeinLoadedSlide ? 300 : 0);
				}
			});
		
			self.ev.on('rsAfterSlideChange', function() {
				runBlocks();
			});
			function runBlocks() {
				var slide = self.currSlide;
				if(!self.currSlide || !self.currSlide.isLoaded) {
					return;
				}

				// clear previous animations
				if(self._slideWithBlocks !== slide) {
					if(self._animatedBlockTimeouts.length > 0) {
						for(i = 0; i < self._animatedBlockTimeouts.length; i++) { 
							clearTimeout(self._animatedBlockTimeouts[i]);
						}
						self._animatedBlockTimeouts = [];
					}
					
					if(self._blockAnimProps.length > 0) {           
						var cItemTemp;
						for(i = 0; i < self._blockAnimProps.length; i++) {  
							cItemTemp = self._blockAnimProps[i];              
							if(cItemTemp) {               
								if(!self._useCSS3Transitions) {
									// if(cItemTemp.running) {
									//  cItemTemp.block.stop(true, true);
									// } else {
										cItemTemp.block.stop(true).css(cItemTemp.css);
									//}
								} else {
									cItemTemp.block.css(self._vendorPref + self._TD, '0s');
									cItemTemp.block.css(cItemTemp.css);
								}
								self._slideWithBlocks = null;
								slide.animBlocksDisplayed = false;
							}
						}
						self._blockAnimProps = [];
					}
					if(slide.animBlocks) {
						slide.animBlocksDisplayed = true;
						self._slideWithBlocks = slide;
						self._animateBlocks(slide.animBlocks);
					}
				}
			}
		},
		_updateAnimBlockProps: function(obj, props) {
			setTimeout(function() {
				obj.css(props);
			}, 6);
		},
		_animateBlocks: function(animBlocks) {
			var self = this,
				item,
				animObj,
				newPropObj,
				transitionData;

			var currItem,
				fadeEnabled,
				moveEnabled,        
				effectName, 
				effectsObject,
				moveEffectProperty,
				currEffects,
				newEffectObj, 
				moveOffset,
				delay,
				speed,
				easing,
				moveProp,
				i;

			self._animatedBlockTimeouts = [];

			animBlocks.each(function(index) {

				item = $(this);
				

				animObj = {};
				newPropObj = {};
				transitionData = null;

					var moveOffset = item.data('move-offset');
					if(isNaN(moveOffset)) {
						moveOffset = self.st.block.moveOffset;
					}

					if(moveOffset > 0) {
						var moveEffect = item.data('move-effect');
						if(moveEffect) {
							moveEffect = moveEffect.toLowerCase();
							if(moveEffect === 'none') {
								moveEffect = false;
							} else if(moveEffect !== 'left' && moveEffect !== 'top' && moveEffect !== 'bottom' && moveEffect !== 'right') {
								moveEffect = self.st.block.moveEffect;
								if(moveEffect === 'none') {
									moveEffect = false;
								}
							}
						} else {
							moveEffect = self.st.block.moveEffect;
						}
						if(moveEffect && moveEffect !== 'none') {
							var moveHorizontal;
							if(moveEffect === 'right' || moveEffect === 'left') {
								moveHorizontal = true;
							} else {
								moveHorizontal = false;
							}
							var currPos,
								moveProp,
								startPos;
							
							isOppositeProp = false;
							
							if(self._useCSS3Transitions) {
								currPos = 0;
								moveProp = self._xProp;
							} else {
								if(moveHorizontal) {
									if( !isNaN( parseInt(item.css('right'), 10) ) ) {
										moveProp = 'right';
										isOppositeProp = true;
									} else {
										moveProp = 'left';
									}
								} else {

									if( !isNaN( parseInt(item.css('bottom'), 10) ) ) {
										moveProp = 'bottom';
										isOppositeProp = true;
									} else {
										moveProp = 'top';
									}
								}
								moveProp = 'margin-'+moveProp;
								if(isOppositeProp) {
									moveOffset = -moveOffset;
								}

								if(!self._useCSS3Transitions) {
									currPos = item.data('rs-start-move-prop');
									if( currPos === undefined ) {
										currPos = parseInt(item.css(moveProp), 10); 
										item.data('rs-start-move-prop', currPos);
									}
								} else {
									currPos = parseInt(item.css(moveProp), 10); 
								}
								
								
							}

							if(moveEffect === 'top' || moveEffect === 'left') {
								startPos = currPos - moveOffset;
							} else {
								startPos = currPos + moveOffset;
							}
							
							newPropObj[moveProp] = self._getCSS3Prop(startPos, moveHorizontal);
							animObj[moveProp] = self._getCSS3Prop(currPos, moveHorizontal);
							
						}
					}
					

					var fadeEffect = item.attr('data-fade-effect');
					if(!fadeEffect) {
						fadeEffect = self.st.block.fadeEffect;
					} else if(fadeEffect.toLowerCase() === 'none' || fadeEffect.toLowerCase() === 'false') {
						fadeEffect = false;
					}
					if(fadeEffect) {
						newPropObj.opacity = 0;
						animObj.opacity = 1;
					}

					if(fadeEffect || moveEffect) {
						transitionData = {};
						transitionData.hasFade = Boolean(fadeEffect);
						if(Boolean(moveEffect)) {
							transitionData.moveProp = moveProp;
							transitionData.hasMove = true;
						}

						transitionData.speed = item.data('speed');
						if(isNaN(transitionData.speed)) {
							transitionData.speed = self.st.block.speed;
						}
						transitionData.easing = item.data('easing');
						if(!transitionData.easing) {
							transitionData.easing = self.st.block.easing;
						}
						transitionData.css3Easing = $.rsCSS3Easing[transitionData.easing];

						transitionData.delay =  item.data('delay');
						if(isNaN(transitionData.delay)) {
							transitionData.delay = self.st.block.delay * index;
						}

					}

					var blockPropsObj = {};
					if(self._useCSS3Transitions) {
						blockPropsObj[(self._vendorPref + self._TD)] =  '0ms';
					}
					blockPropsObj.moveProp = animObj.moveProp;
					blockPropsObj.opacity = animObj.opacity;
					blockPropsObj.display = 'none';


					self._blockAnimProps.push({block:item, css:blockPropsObj});
					
					self._updateAnimBlockProps(item, newPropObj);

					// animate caption
					self._animatedBlockTimeouts.push(setTimeout((function (cItem, animateData, transitionData, index) { 
						return function() { 
							cItem.css('display', 'block');
							if(transitionData) {
								var animObj = {};
								if(!self._useCSS3Transitions) {
									setTimeout(function() {
										cItem.animate(animateData, transitionData.speed, transitionData.easing);
									}, 16);
								} else {
									var prop = '';
									if(transitionData.hasMove) {
										prop += transitionData.moveProp;
									} 
									if(transitionData.hasFade) {
										if(transitionData.hasMove) {
											prop += ', ';
										}
										prop += 'opacity';
									}
									animObj[(self._vendorPref + self._TP)] = prop;
									animObj[(self._vendorPref + self._TD)] =  transitionData.speed + 'ms';
									animObj[(self._vendorPref + self._TTF)] = transitionData.css3Easing;
									cItem.css(animObj);
									setTimeout(function() {
										cItem.css(animateData);
									}, 24);
								}
							}
					
							delete self._animatedBlockTimeouts[index];
						};
					})(item, animObj, transitionData, index), transitionData.delay <= 6 ? 12 : transitionData.delay));        
				//} 



			});
		}
	});
	$.rsModules.animatedBlocks = $.rsProto._initAnimatedBlocks;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider porthole-thumbnails module by Miroslav Varsky (from Dream-Theme.com)
	 * @version 1.0.b:
	 *
	 */ 
	$.extend($.rsProto, {
		_initThumbs: function() {
			var self = this;
			if(self.st.controlNavigation === 'porthole') {

				self._thumbsDefaults = {
					drag: false,
					touch: false,
					orientation: 'vertical',
					navigation: true,
					spacing: 10,
					appendSpan: false,
					transitionSpeed:600,
					autoCenter: true,
					fitInViewport: true, 
					firstMargin: true,
					paddingTop: 0,
					paddingBottom: 0
				};

				self.st.thumbs = $.extend({}, self._thumbsDefaults, self.st.thumbs);
				self._firstThumbMoved = true;
				if(self.st.thumbs.firstMargin === false) { self.st.thumbs.firstMargin = 0; }
				else if(self.st.thumbs.firstMargin === true) { self.st.thumbs.firstMargin = self.st.thumbs.spacing; }

				self.ev.on('rsBeforeParseNode', function(e, content, obj) {
					content = $(content);
					obj.thumbnail = content.find('.rsTmb').remove();
					if(!obj.thumbnail.length) {
						obj.thumbnail = content.attr('data-rsTmb');
						if(!obj.thumbnail) {
							obj.thumbnail = content.find('.rsImg').attr('data-rsTmb');
						}
						if(!obj.thumbnail) {
							obj.thumbnail = '';
						} else {
							obj.thumbnail = '<img src="'+obj.thumbnail+'" width="150" height="150" />';
						}
					} else {
						obj.thumbnail = $(document.createElement('div')).append(obj.thumbnail).html();
					}
				});

				self.ev.one('rsAfterPropsSetup', function() {
					self._createThumbs();
				});

				self._prevNavItem = null;

				self.ev.on('rsOnUpdateNav', function() {

					//self._controlNavItems.attr('class', 'rsNavItem rsThumb');

					var currItem = $(self._controlNavItems[self.currSlideId]);
					if(currItem === self._prevNavItem) {
						return;
					}
					if(self._prevNavItem) {
						self._prevNavItem = null;
					}
					if(self._thumbsNavigation) {          
						self._setCurrentThumb(self.currSlideId);
					}

					self._prevNavItem = currItem;

					self._controlNavItems.each(function() {
						if (self._prevNavItem[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavSelected');
						}
						else if (self._prevNavItem.prev().prev()[0]===this || self._prevNavItem.next().next()[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavVis');
						}
						else if (self._prevNavItem.prev()[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavPrev');
						}
						else if (self._prevNavItem.next()[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavNext');
						}
						else {
							$(this).attr('class', 'rsNavItem rsThumb');
						}
					});


				});

				self.ev.on('rsOnAppendSlide', function(e, parsedSlide, index) {
					var html = '<div'+self._thumbsMargin+' class="rsNavItem rsThumb">'+self._addThumbHTML+parsedSlide.thumbnail+'</div>';
					if(index >= self.numSlides) {
						self._thumbsContainer.append(html);
					} else {
						self._controlNavItems.eq(index).before(html);
					}
					self._controlNavItems = self._thumbsContainer.children();
					self.updateThumbsSize();
				});
				self.ev.on('rsOnRemoveSlide', function(e, index) {
					var itemToRemove = self._controlNavItems.eq(index);
					if(itemToRemove) {
						itemToRemove.remove();
						self._controlNavItems = self._thumbsContainer.children();
						self.updateThumbsSize();
					}
				}); 
				

			} 
		},
		_createThumbs: function() {
			var self = this, 
				tText = 'rsThumbs',
				thumbSt = self.st.thumbs,
				out = '',
				style,
				item,
				spacing = thumbSt.spacing;
			
			self._controlNavEnabled = true;
			self._thumbsHorizontal = (thumbSt.orientation === 'vertical') ? false : true;
			
			self._thumbsMargin = style = spacing ? ' style="margin-' + (self._thumbsHorizontal ? 'right' : 'bottom') + ':'+ spacing+'px;"' : ''; 
			
			self._thumbsPosition = 0;
			self._isThumbsAnimating = false;
			self._thumbsDrag = false;
			self._thumbsNavigation = false;

			var pl = (self._thumbsHorizontal ? 'Hor' : 'Ver');
			self.slider.addClass('rsWithThumbs' + ' rsWithThumbs'+ pl );
			
			out += '<div class="rsNav rsThumbs rsThumbs'+pl +'"><div class="'+tText+'Container">';
			self._addThumbHTML = thumbSt.appendSpan ? '<span class="thumbIco"></span>' : '';
			for(var i = 0; i < self.numSlides; i++) {
				item = self.slides[i];
				out += '<div'+style+' class="rsNavItem rsThumb">'+item.thumbnail+self._addThumbHTML+'</div>';
			}
			out = $(out +'</div></div>');

			var o = {};
			if(thumbSt.paddingTop) {
				o[self._thumbsHorizontal ? 'paddingTop' : 'paddingLeft'] = thumbSt.paddingTop;
			} 
			if(thumbSt.paddingBottom) {
				o[self._thumbsHorizontal ? 'paddingBottom' : 'paddingRight'] = thumbSt.paddingBottom;
			} 
			out.css(o);

			self._thumbsContainer = $(out).find('.' + tText + 'Container');



			self._controlNav = out;
			self._controlNavItems = self._thumbsContainer.children();
			

			if(self.msEnabled && self.st.thumbs.navigation) {
				self._thumbsContainer.css('-ms-touch-action', self._thumbsHorizontal ? 'pan-y' : 'pan-x');
			}

			self.slider.append(out);
			
			self._thumbsEnabled = true;
			self._thumbsSpacing = spacing;

			
			if(thumbSt.navigation) {
				if(self._useCSS3Transitions) {
					self._thumbsContainer.css(self._vendorPref + 'transition-property', self._vendorPref + 'transform');
				}
			}
			
			self._controlNav.on('click.rs','.rsNavItem',function(e) {
				if(!self._thumbsDrag ) {
					self.goTo( $(this).index() );
				}
			});

			self.ev.off('rsBeforeSizeSet.thumbs').on('rsBeforeSizeSet.thumbs', function() {
				self._realWrapSize = self._thumbsHorizontal ? self._wrapHeight : self._wrapWidth;
				self.updateThumbsSize(true);

			});


			// fix deprecated name
			if(!self.st.autoPlay && self.st.autoplay) {
				self.st.autoPlay = self.st.autoplay;
			}

			if (self.st.autoPlay.enabled) {
				self._thumbsContainer.after('<div class="progress-wrapper"><div class="progress-controls"></div></div>');
				self.progressWrap = self._thumbsContainer.next();
				self.progressHtml = '<div class="progress-mask"><div class="progress-spinner-left" style="'+self._vendorPref+'animation-duration: '+self.st.autoPlay.delay+'ms;"></div></div><div class="progress-mask"><div class="progress-spinner-right" style="'+self._vendorPref+'animation-duration: '+self.st.autoPlay.delay+'ms;"></div></div>';

				self.ev.on("autoPlayPlay", function() {
					if (self.progressWrap.find(".progress-mask").length < 1) {
						self.progressWrap.prepend(self.progressHtml);
					}
					self.progressWrap.removeClass("paused");
				});

				self.ev.on("autoPlayPause", function() {
					self.progressWrap.find(".progress-mask").remove();
					if (!self._autoPlayEnabled) {
						self.progressWrap.addClass("paused");
					}
				});

				self.ev.on('rsAfterSlideChange', function() {
					self.progressWrap.removeClass("blurred");
				});

				self.ev.on('rsBeforeAnimStart', function() {
					self.progressWrap.addClass("blurred");
				});

				self.ev.on('rsVideoPlay', function() {
					$("body").addClass("hide-thumbnails");
					if (!self.slider.parent().hasClass("fixed")) $("body").addClass("video-playing");
				});
				self.ev.on('rsVideoStop', function() {
					$("body").removeClass("video-playing").removeClass("hide-thumbnails");
				});

				self.progressWrap.on("click", function() {
					self.toggleAutoPlay();
				});
			}
		},
		updateThumbsSize: function(isResize) {
			var self = this,
				firstThumb = self._controlNavItems.first(),
				cssObj = {};

			var numItems = self._controlNavItems.length;
			self._thumbSize = ( self._thumbsHorizontal ? firstThumb.outerWidth() : firstThumb.outerHeight() ) + self._thumbsSpacing;
			self._thumbsContainerSize = self._thumbsContainer.outerHeight(); // numItems * self._thumbSize - self._thumbsSpacing;
			//cssObj[self._thumbsHorizontal ? 'width' : 'height'] = self._thumbsContainerSize + self._thumbsSpacing;
			self._thumbsViewportSize = self._thumbsHorizontal ? self._controlNav.width() : self._controlNav.height();
			self._thumbsMaxPosition = -(self._thumbsContainerSize - self._thumbsViewportSize) - (self.st.thumbs.firstMargin);
			self._thumbsMinPosition = self.st.thumbs.firstMargin;
			self._visibleThumbsPerView = Math.floor(self._thumbsViewportSize / self._thumbSize); // 1;

			if(self.st.thumbs.navigation && !self._thumbsNavigation) {
				self._thumbsNavigation = true;
				if( (!self.hasTouch && self.st.thumbs.drag) ||  (self.hasTouch && self.st.thumbs.touch)) {
					self._thumbsDrag = true;
					self._controlNav.on(self._downEvent, function(e) { self._onDragStart(e, true); });  
				}
			}

			if(self._useCSS3Transitions) {
				cssObj[(self._vendorPref + 'transition-duration')] = '0ms';
			}

			self._thumbsContainer.css(cssObj);
		},
		setThumbsOrientation: function(newPlacement, dontUpdateSize) {
			var self = this;
			if(self._thumbsEnabled) {
				self.st.thumbs.orientation = newPlacement;
				self._controlNav.remove();
				self.slider.removeClass('rsWithThumbsHor rsWithThumbsVer');
				self._createThumbs();
				self._controlNav.off(self._downEvent);  
				if(!dontUpdateSize) {
					self.updateSliderSize(true);
				}
			}
		},
		_setThumbsPosition: function(pos) {
			var self = this;
			self._thumbsPosition = pos;
			if(self._useCSS3Transitions) {
				self._thumbsContainer.css(self._xProp, self._tPref1 + ( self._thumbsHorizontal ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 );
			} else {
				self._thumbsContainer.css(self._thumbsHorizontal ? self._xProp : self._yProp, pos);
			}
		},
		_animateThumbsTo: function(pos, speed, outEasing, bounceAnimPosition, bounceAnimSpeed) {

			var self = this;
			if(!self._thumbsNavigation) {
				return;
			}
			if(!speed) {
				speed = self.st.thumbs.transitionSpeed;
			}
			self._thumbsPosition = pos;
			if(self._thumbsAnimTimeout) {
				clearTimeout(self._thumbsAnimTimeout);
			}
			if(self._isThumbsAnimating) {
				if(!self._useCSS3Transitions) {
					self._thumbsContainer.stop();
				}
				outEasing = true;
			}
			var animObj = {};
			self._isThumbsAnimating = true;
			if(!self._useCSS3Transitions) {
				animObj[self._thumbsHorizontal ? self._xProp : self._yProp] = pos + 'px';
				self._thumbsContainer.animate(animObj, speed, outEasing ? 'easeOutCubic' : self.st.easeInOut);
			} else { 
				animObj[(self._vendorPref + 'transition-duration')] = speed+'ms';
				animObj[(self._vendorPref + 'transition-timing-function')] = outEasing ? $.rsCSS3Easing[self.st.easeOut] : $.rsCSS3Easing[self.st.easeInOut];
				self._thumbsContainer.css(animObj);
				self._setThumbsPosition(pos);
			}
			if(bounceAnimPosition) {
				self._thumbsPosition = bounceAnimPosition;
			}
			
			self._thumbsAnimTimeout = setTimeout(function() {
				self._isThumbsAnimating = false;
				if(bounceAnimSpeed) {
					self._animateThumbsTo(bounceAnimPosition, bounceAnimSpeed, true);
					bounceAnimSpeed = null;dech
				}
			}, speed);
		},
		_setCurrentThumb: function(id, justSet) {
			var self = this,
				newPos = -id * 40;

			if (newPos == 0) {
				newPos = 20;
			}

			if(!self._thumbsNavigation) {
				return;
			}

			if(self._firstThumbMoved) {
				justSet = true;
				self._firstThumbMoved = false;
			}

			if(newPos !== self._thumbsPosition) {
				if(!justSet) {
					self._animateThumbsTo(newPos);
				} else {
					self._setThumbsPosition(newPos);
				}
			}

		}
	});
	$.rsModules.thumbnails = $.rsProto._initThumbs;
})

jQuery(document).ready(function ($) {
	if (!('ontouchstart' in window) && (dtLocal.themeSettings.smoothScroll == "on" || dtLocal.themeSettings.smoothScroll == "on_parallax" && $(".stripe-parallax-bg").length > 0)) {
		$("body").css({"scroll-behavior" : "smooth"});
	}

});


/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

jQuery(document).ready(function ($) {
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		var fixTimeout;
		
		//get the starting position of each element to have parallax applied to it    
		$this.each(function(){
				firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();        

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((top - pos) * speedFactor) + "px");
			});
		}   

		$window.bind('scroll', update).resize(function() {
			update();
		}).bind("debouncedresize", function() {
			clearTimeout(fixTimeout);
			fixTimeout = setTimeout(function() {
				update();
			}, 20);
		});
		update();

		setTimeout(function() {
			if (!window.bgGlitchFixed && $.browser.webkit) {
				$window.scrollTop($window.scrollTop() + 1);
				window.bgGlitchFixed = true;
			}
		}, 20);

	};
});

/*!
 *
 * jQuery collagePlus Plugin v0.3.2
 * https://github.com/ed-lea/jquery-collagePlus
 *
 * Copyright 2012, Ed Lea twitter.com/ed_lea
 *
 * built for http://qiip.me
 *
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 *
 *
 * Heavily modified by Dream-Theme.com
 */


;(function( $ ) {


	$.fn.collagePlus = function( options ) {

		var defaults = {
			// the ideal height you want your images to be
			'targetHeight'			: 400,
			// width of the area the collage will be in
			'albumWidth'			: this.width(),
			// padding between the images
			'padding'				: parseFloat( this.css('padding-left') ),
			// object that contains the images to collage
			'images'				: this.children(),
			// how quickly you want images to fade in once ready can be in ms, "slow" or "fast"
			'fadeSpeed'				: "fast",
			// how the resized block should be displayed. inline-block by default so that it doesn't break the row
			'display'				: "inline-block",
			// which effect you want to use for revealing the images (note CSS3 browsers only),
			'effect'				: 'default',
			// effect delays can either be applied per row to give the impression of descending appearance
			// or horizontally, so more like a flock of birds changing direction
			'direction'				: 'vertical',
			// Sometimes there is just one image on the last row and it gets blown up to a huge size to fit the
			// parent div width. To stop this behaviour, set this to true
			'allowPartialLastRow'	: false
		};

		var settings = $.extend({}, defaults, options);

		return this.each(function() {

			/*
			 *
			 * set up vars
			 *
			 */

				// track row width by adding images, padding and css borders etc
			var row			= 0,
				// collect elements to be re-sized in current row
				elements	= [],
				// track the number of rows generated
				rownum = 1;


			settings.images.each(
				function(index){
					/*
					 *
					 * Cache selector
					 * Even if first child is not an image the whole sizing is based on images
					 * so where we take measurements, we take them on the images
					 *
					 */
					var $this = $(this),
						$img  = ($this.is("img")) ? $this : $(this).find("img").not(".blur-effect").first();

					/*
					 *
					 * get the current image size. Get image size in this order
					 *
					 * 1. from <img> tag
					 * 2. from data set from initial calculation
					 * 3. after loading the image and checking it's actual size
					 *
					 */
					if ($img.attr("width") != 'undefined' && $img.attr("height") != 'undefined') {
						var w = (typeof $img.data("width") != 'undefined') ? $img.data("width") : $img.attr("width"),
							h = (typeof $img.data("height") != 'undefined') ? $img.data("height") : $img.attr("height");
						
					}
					else {
						var w = (typeof $img.data("width") != 'undefined') ? $img.data("width") : $img.width(),
							h = (typeof $img.data("height") != 'undefined') ? $img.data("height") : $img.height();
					}



					/*
					 *
					 * Get any current additional properties that may affect the width or height
					 * like css borders for example
					 *
					 */
					var imgParams = getImgProperty($img);


					/*
					 *
					 * store the original size for resize events
					 *
					 */
					$img.data("width", w);
					$img.data("height", h);



					/*
					 *
					 * calculate the w/h based on target height
					 * this is our ideal size, but later we'll resize to make it fit
					 *
					 */
					var nw = Math.ceil(w/h*settings.targetHeight),
						nh = Math.ceil(settings.targetHeight);

					/*
					 *
					 * Keep track of which images are in our row so far
					 *
					 */
					elements.push([this, nw, nh, imgParams['w'], imgParams['h']]);

					/*
					 *
					 * calculate the width of the element including extra properties
					 * like css borders
					 *
					 */
					row += nw + imgParams['w'] + settings.padding;

					/*
					 *
					 * if the current row width is wider than the parent container
					 * it's time to make a row out of our images
					 *
					 */
					if( row > settings.albumWidth && elements.length != 0 ){

						// call the method that calculates the final image sizes
						// remove one set of padding as it's not needed for the last image in the row
						resizeRow(elements, row, settings, rownum);

						// reset our row
						delete row;
						delete elements;
						row			= 0;
						elements	= [];
						rownum		+= 1;
					}


					/*
					 *
					 * if the images left are not enough to make a row
					 * then we'll force them to make one anyway
					 *
					 */
					if ( settings.images.length-1 == index && elements.length != 0){
						resizeRow(elements, row, settings, rownum);

						// reset our row
						delete row;
						delete elements;
						row			= 0;
						elements	= [];
						rownum		+= 1;
					}
				}
			);

			// trigger "jgDone" event when all is ready
			$(this).trigger("jgDone");
		});

		function resizeRow(obj, row, settings, rownum) {
			/*
			 *
			 * How much bigger is this row than the available space?
			 * At this point we have adjusted the images height to fit our target height
			 * so the image size will already be different from the original.
			 * The resizing we're doing here is to adjust it to the album width.
			 *
			 * We also need to change the album width (basically available space) by
			 * the amount of padding and css borders for the images otherwise
			 * this will skew the result.
			 *
			 * This is because padding and borders remain at a fixed size and we only
			 * need to scale the images.
			 *
			 */
			var imageExtras			= (settings.padding * obj.length) + (obj.length * obj[0][3]),
				albumWidthAdjusted	= settings.albumWidth - imageExtras,
				overPercent			= albumWidthAdjusted / (row - imageExtras),
				// start tracking our width with know values that will make up the total width
				// like borders and padding
				trackWidth			= imageExtras,
				// guess whether this is the last row in a set by checking if the width is less
				// than the parent width.
				lastRow				= (row < settings.albumWidth  ? true : false);



			/*
			 * Resize the images by the above % so that they'll fit in the album space
			 */
			for (var i = 0; i < obj.length; i++) {



				var $obj		= $(obj[i][0]),
					fw			= Math.floor(obj[i][1] * overPercent),
					fh			= Math.floor(obj[i][2] * overPercent),
				// if the element is the last in the row,
				// don't apply right hand padding (this is our flag for later)
					isNotLast	= !!(( i < obj.length - 1 ));

				/*
				 * Checking if the user wants to not stretch the images of the last row to fit the
				 * parent element size
				 */
				if(settings.allowPartialLastRow === true && lastRow === true){
					 fw = obj[i][1];
					 fh = obj[i][2];
				}


				/*
				 *
				 * Because we use % to calculate the widths, it's possible that they are
				 * a few pixels out in which case we need to track this and adjust the
				 * last image accordingly
				 *
				 */
				trackWidth += fw;


				/*
				 *
				 * here we check if the combined images are exactly the width
				 * of the parent. If not then we add a few pixels on to make
				 * up the difference.
				 *
				 * This will alter the aspect ratio of the image slightly, but
				 * by a noticable amount.
				 *
				 * If the user doesn't want full width last row, we check for that here
				 *
				 */
	/*
				if(!isNotLast && trackWidth < settings.albumWidth){
					if(settings.allowPartialLastRow === true && lastRow === true){
						fw = fw;
					}else{
						fw = fw + (settings.albumWidth - trackWidth);
					}
				}
	*/

				/*
				 *
				 * We'll be doing a few things to the image so here we cache the image selector
				 *
				 *
				 */
				var $img = ( $obj.is("img") ) ? $obj : $obj.find("img").not(".blur-effect").first();

				/*
				 *
				 * Set the width of the image and parent element
				 * if the resized element is not an image, we apply it to the child image also
				 *
				 * We need to check if it's an image as the css borders are only measured on
				 * images. If the parent is a div, we need make the contained image smaller
				 * to accommodate the css image borders.
				 *
				 */
				$img.width(fw);
				if( !$obj.is("img") ){
					$obj.width(fw + obj[i][3]);
				}


				/*
				 *
				 * Set the height of the image
				 * if the resized element is not an image, we apply it to the child image also
				 *
				 */
				$img.height(fh);
				if( !$obj.is("img") ){
					$obj.height(fh + obj[i][4]);
				}


				/*
				 *
				 * Apply the css extras like padding
				 *
				 */
				if (settings.allowPartialLastRow === false &&  lastRow === true) {
					applyModifications($obj, isNotLast, "none");
				}
				else {
					applyModifications($obj, isNotLast, settings.display);
				};


				/*
				 *
				 * Assign the effect to show the image
				 * Default effect is using jquery and not CSS3 to support more browsers
				 * Wait until the image is loaded to do this
				 *
				 */
	/*
				$img
					.load(function(target) {
					return function(){
						if( settings.effect == 'default'){
							target.animate({opacity: '1'},{duration: settings.fadeSpeed});
						} else {
							if(settings.direction == 'vertical'){
								var sequence = (rownum <= 10  ? rownum : 10);
							} else {
								var sequence = (i <= 9	? i+1 : 10);
							}

							target.addClass(settings.effect);
							target.addClass("effect-duration-" + sequence);
						}
					}
					}($obj))
	*/
					/*
					 * fix for cached or loaded images
					 * For example if images are loaded in a "window.load" call we need to trigger
					 * the load call again
					 */
	/*
					.each(function() {
							if(this.complete) $(this).trigger('load');
					});
	*/

			}
		}

		/*
		 *
		 * This private function applies the required css to space the image gallery
		 * It applies it to the parent element so if an image is wrapped in a <div> then
		 * the css is applied to the <div>
		 *
		 */
		function applyModifications($obj, isNotLast, settingsDisplay) {
			var css = {
	/*
					// Applying padding to element for the grid gap effect
					'margin-bottom'		: settings.padding + "px",
					'margin-right'		: (isNotLast) ? settings.padding + "px" : "0px",
	*/
					// Set it to an inline-block by default so that it doesn't break the row
					'display'			: settingsDisplay,
					// Set vertical alignment otherwise you get 4px extra padding
					'vertical-align'	: "bottom",
					// Hide the overflow to hide the caption
					'overflow'			: "hidden"
				};

			return $obj.css(css);
		}


		/*
		 *
		 * This private function calculates any extras like padding, border associated
		 * with the image that will impact on the width calculations
		 *
		 */
		function getImgProperty(img) {
			$img = $(img);
			var params =  new Array();
			params["w"] = (parseFloat($img.css("border-left-width")) + parseFloat($img.css("border-right-width")));
			params["h"] = (parseFloat($img.css("border-top-width")) + parseFloat($img.css("border-bottom-width")));
			return params;
		}

	};

})( jQuery );

/* !- Justified Gallery Initialisation */
jQuery(document).ready(function($) {

	var jgCounter = 0;
	$(".jg-container").each(function() {
		jgCounter++;
		var $jgContainer = $(this),
			$jgItemsPadding = $jgContainer.attr("data-padding"),
			$jgItems = $jgContainer.find(".wf-cell");
		// .iso-item elements are hidden by default, so we show them.

		$jgContainer.attr("id", "jg-container-" + jgCounter + "");

		$("<style type='text/css'>" + ' .content #jg-container-' + jgCounter + ' .wf-cell'  + '{padding:'  + $jgItemsPadding + ';}' + ' .content #jg-container-' + jgCounter + '.wf-container'  + '{'+ 'margin:'  + '-'+ $jgItemsPadding + ';}' + ' .content .full-width-wrap #jg-container-' + jgCounter + '.wf-container'  + '{'+ 'margin-left:'  + $jgItemsPadding + '; '+ 'margin-right:'  + $jgItemsPadding + '; '+ 'margin-top:' + '-' + $jgItemsPadding + '; '+ 'margin-bottom:' + '-' + $jgItemsPadding + ';}' +"</style>").insertAfter($jgContainer);

		$jgContainer.on("jgDone", function() {});
	});

	$.fn.collage = function(args) {
		return this.each(function() {
			var $this = $(this);
			var $jgContainer = $(this),
				$jgItemsPadding = $jgContainer.attr("data-padding"),
				$jgItems = $jgContainer.find(".wf-cell");
			var jgPadding = parseFloat($jgItems.first().css('padding-left')) + parseFloat($jgItems.first().css('padding-right')),
				jgTargetHeight = parseInt($jgContainer.attr("data-target-height")),
				jdPartRow = true;

			if ($jgContainer.attr("data-part-row") == "false") {
				jdPartRow = false;
			};


			if($jgContainer.parent(".full-width-wrap").length){
				var jgAlbumWidth = $jgContainer.parents(".full-width-wrap").width() - parseInt($jgItemsPadding)*2;
			}else{
				var jgAlbumWidth = $jgContainer.parent().width() + parseInt($jgItemsPadding)*2;
			}
			
			var $jgCont = {
				'albumWidth'			: jgAlbumWidth,
				'targetHeight'			: jgTargetHeight,
				'padding'				: jgPadding,
				'allowPartialLastRow'	: jdPartRow,
				'fadeSpeed'				: 2000,
				'effect'				: 'effect-1',
				'direction'				: 'vertical'
			};
			$.extend($jgCont, args);

			dtGlobals.jGrid = $jgCont;
			$jgContainer.collagePlus($jgCont);
			$jgContainer.css({
				'width': jgAlbumWidth
			});
		});
	};
	$(window).on("debouncedresize", function() {
		$(".jg-container").not('.jgrid-shortcode').collage();
		$(".jgrid-shortcode").each(function() {
			var $this = $(this);
			var $visibleItems = $this.data('visibleItems');
			if ( $visibleItems ) {
				$this.collage({ 'images': $visibleItems });
			} else {
				$this.collage();
			}
		});
	});
});

/**
 * jquery.hoverdir.js v1.1.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2012, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {
	
	'use strict';

	$.HoverDir = function( options, element ) {
		
		this.$el = $( element );
		this._init( options );

	};

	// the options
	$.HoverDir.defaults = {
		speed : 300,
		easing : 'ease',
		hoverDelay : 0,
		inverse : false
	};

	$.HoverDir.prototype = {

		_init : function( options ) {
			
			// options
			this.options = $.extend( true, {}, $.HoverDir.defaults, options );
			// transition properties
			this.transitionProp = 'all ' + this.options.speed + 'ms ' + this.options.easing;
			// support for CSS transitions
			this.support = Modernizr.csstransitions;
			// load the events
			this._loadEvents();

		},
		
		_loadEvents : function() {

			var self = this;
			
			this.$el.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {
				
				var $el = $( this ),
					$hoverElem = $el.find( '.rollover-content' ),
					direction = self._getDir( $el, { x : event.pageX, y : event.pageY } ),
					styleCSS = self._getStyle( direction );
				
				if( event.type === 'mouseenter' ) {
					
					$hoverElem.hide().css( styleCSS.from );
					clearTimeout( self.tmhover );

					self.tmhover = setTimeout( function() {
						
						$hoverElem.show( 0, function() {
							
							var $el = $( this );
							if( self.support ) {
								$el.css( 'transition', self.transitionProp );
							}
							self._applyAnimation( $el, styleCSS.to, self.options.speed );

						} );
						
					
					}, self.options.hoverDelay );
					
				}
				else {
				
					if( self.support ) {
						$hoverElem.css( 'transition', self.transitionProp );
					}
					clearTimeout( self.tmhover );
					self._applyAnimation( $hoverElem, styleCSS.from, self.options.speed );
					
				}
					
			} );

		},
		// credits : http://stackoverflow.com/a/3647634
		_getDir : function( $el, coordinates ) {
			
			// the width and height of the current div
			var w = $el.width(),
				h = $el.height(),

				// calculate the x and y to get an angle to the center of the div from that x and y.
				// gets the x value relative to the center of the DIV and "normalize" it
				x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
				y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
			
				// the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);
				// first calculate the angle of the point,
				// add 180 deg to get rid of the negative values
				// divide by 90 to get the quadrant
				// add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
				direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;
			
			return direction;
			
		},
		_getStyle : function( direction ) {
			
			var fromStyle, toStyle,
				slideFromTop = { left : '0px', top : '-100%' },
				slideFromBottom = { left : '0px', top : '100%' },
				slideFromLeft = { left : '-100%', top : '0px' },
				slideFromRight = { left : '100%', top : '0px' },
				slideTop = { top : '0px' },
				slideLeft = { left : '0px' };
			
			switch( direction ) {
				case 0:
					// from top
					fromStyle = !this.options.inverse ? slideFromTop : slideFromBottom;
					toStyle = slideTop;
					break;
				case 1:
					// from right
					fromStyle = !this.options.inverse ? slideFromRight : slideFromLeft;
					toStyle = slideLeft;
					break;
				case 2:
					// from bottom
					fromStyle = !this.options.inverse ? slideFromBottom : slideFromTop;
					toStyle = slideTop;
					break;
				case 3:
					// from left
					fromStyle = !this.options.inverse ? slideFromLeft : slideFromRight;
					toStyle = slideLeft;
					break;
			};
			
			return { from : fromStyle, to : toStyle };
					
		},
		// apply a transition or fallback to jquery animate based on Modernizr.csstransitions support
		_applyAnimation : function( el, styleCSS, speed ) {

			$.fn.applyStyle = this.support ? $.fn.css : $.fn.animate;
			el.stop().applyStyle( styleCSS, $.extend( true, [], { duration : speed + 'ms' } ) );

		},

	};
	
	var logError = function( message ) {

		if ( window.console ) {

			window.console.error( message );
		
		}

	};
	
	$.fn.hoverdir = function( options ) {

		var instance = $.data( this, 'hoverdir' );
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			
			this.each(function() {
			
				if ( !instance ) {

					logError( "cannot call methods on hoverdir prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {

					logError( "no such method '" + options + "' for hoverdir instance" );
					return;
				
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
				
				if ( instance ) {

					instance._init();
				
				}
				else {

					instance = $.data( this, 'hoverdir', new $.HoverDir( options, this ) );
				
				}

			});
		
		}
		
		return instance;
		
	};
	
} )( jQuery, window );


 /* !- Tooltip*/  
 function simple_tooltip(e,t){jQuery(e).each(function(e){jQuery("body").append("<div class='"+t+"' id='"+t+e+"'>"+jQuery(this).find("span.tooltip-c").html()+"</div>");var n=jQuery("#"+t+e);jQuery(this).removeAttr("title").mouseover(function(){n.css({opacity:1,display:"none"}).fadeIn(400)}).mousemove(function(e){var t=jQuery(window).scrollTop();var r=jQuery(window).width();var i;var s;var o=15;if(r-o*2>=n.width()+e.pageX){i=e.pageX+o}else{i=r-n.width()-o}if(t+o*2>=e.pageY-n.height()){s=t+o}else{s=e.pageY-n.height()-2.2*o}n.css({left:i,top:s})}).mouseout(function(){n.css({left:"-9999px"})})})}
 

/*
== malihu jquery custom scrollbar plugin == 
Version: 3.0.9 
Plugin URI: http://manos.malihu.gr/jquery-custom-content-scroller 
Author: malihu
Author URI: http://manos.malihu.gr
License: MIT License (MIT)
*/

/*
Copyright 2010 Manos Malihutsakis (email: manos@malihu.gr)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

/*
The code below is fairly long, fully commented and should be normally used in development. 
For production, use either the minified jquery.mCustomScrollbar.min.js script or 
the production-ready jquery.mCustomScrollbar.concat.min.js which contains the plugin 
and dependencies (minified). 
*/

(function(factory){
	if(typeof module!=="undefined" && module.exports){
		module.exports=factory;
	}else{
		factory(jQuery,window,document);
	}
}(function($){
(function(init){
	var _rjs=typeof define==="function" && define.amd, /* RequireJS */
		_njs=typeof module !== "undefined" && module.exports, /* NodeJS */
		_dlp=("https:"==document.location.protocol) ? "https:" : "http:", /* location protocol */
		_url="cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.12/jquery.mousewheel.min.js";
	if(!_rjs){
		if(_njs){
			require("jquery-mousewheel")($);
		}else{
			/* load jquery-mousewheel plugin (via CDN) if it's not present or not loaded via RequireJS 
			(works when mCustomScrollbar fn is called on window load) */
			$.event.special.mousewheel || $("head").append(decodeURI("%3Cscript src="+_dlp+"//"+_url+"%3E%3C/script%3E"));
		}
	}
	init();
}(function(){
	
	/* 
	----------------------------------------
	PLUGIN NAMESPACE, PREFIX, DEFAULT SELECTOR(S) 
	----------------------------------------
	*/
	
	var pluginNS="mCustomScrollbar",
		pluginPfx="mCS",
		defaultSelector=".mCustomScrollbar",
	
	
		
	
	
	/* 
	----------------------------------------
	DEFAULT OPTIONS 
	----------------------------------------
	*/
	
		defaults={
			/*
			set element/content width/height programmatically 
			values: boolean, pixels, percentage 
				option						default
				-------------------------------------
				setWidth					false
				setHeight					false
			*/
			/*
			set the initial css top property of content  
			values: string (e.g. "-100px", "10%" etc.)
			*/
			setTop:0,
			/*
			set the initial css left property of content  
			values: string (e.g. "-100px", "10%" etc.)
			*/
			setLeft:0,
			/* 
			scrollbar axis (vertical and/or horizontal scrollbars) 
			values (string): "y", "x", "yx"
			*/
			axis:"y",
			/*
			position of scrollbar relative to content  
			values (string): "inside", "outside" ("outside" requires elements with position:relative)
			*/
			scrollbarPosition:"inside",
			/*
			scrolling inertia
			values: integer (milliseconds)
			*/
			scrollInertia:950,
			/* 
			auto-adjust scrollbar dragger length
			values: boolean
			*/
			autoDraggerLength:true,
			/*
			auto-hide scrollbar when idle 
			values: boolean
				option						default
				-------------------------------------
				autoHideScrollbar			false
			*/
			/*
			auto-expands scrollbar on mouse-over and dragging
			values: boolean
				option						default
				-------------------------------------
				autoExpandScrollbar			false
			*/
			/*
			always show scrollbar, even when there's nothing to scroll 
			values: integer (0=disable, 1=always show dragger rail and buttons, 2=always show dragger rail, dragger and buttons), boolean
			*/
			alwaysShowScrollbar:0,
			/*
			scrolling always snaps to a multiple of this number in pixels
			values: integer
				option						default
				-------------------------------------
				snapAmount					null
			*/
			/*
			when snapping, snap with this number in pixels as an offset 
			values: integer
			*/
			snapOffset:0,
			/* 
			mouse-wheel scrolling
			*/
			mouseWheel:{
				/* 
				enable mouse-wheel scrolling
				values: boolean
				*/
				enable:true,
				/* 
				scrolling amount in pixels
				values: "auto", integer 
				*/
				scrollAmount:"auto",
				/* 
				mouse-wheel scrolling axis 
				the default scrolling direction when both vertical and horizontal scrollbars are present 
				values (string): "y", "x" 
				*/
				axis:"y",
				/* 
				prevent the default behaviour which automatically scrolls the parent element(s) when end of scrolling is reached 
				values: boolean
					option						default
					-------------------------------------
					preventDefault				null
				*/
				/*
				the reported mouse-wheel delta value. The number of lines (translated to pixels) one wheel notch scrolls.  
				values: "auto", integer 
				"auto" uses the default OS/browser value 
				*/
				deltaFactor:"auto",
				/*
				normalize mouse-wheel delta to -1 or 1 (disables mouse-wheel acceleration) 
				values: boolean
					option						default
					-------------------------------------
					normalizeDelta				null
				*/
				/*
				invert mouse-wheel scrolling direction 
				values: boolean
					option						default
					-------------------------------------
					invert						null
				*/
				/*
				the tags that disable mouse-wheel when cursor is over them
				*/
				disableOver:["select","option","keygen","datalist","textarea"]
			},
			/* 
			scrollbar buttons
			*/
			scrollButtons:{ 
				/*
				enable scrollbar buttons
				values: boolean
					option						default
					-------------------------------------
					enable						null
				*/
				/*
				scrollbar buttons scrolling type 
				values (string): "stepless", "stepped"
				*/
				scrollType:"stepless",
				/*
				scrolling amount in pixels
				values: "auto", integer 
				*/
				scrollAmount:"auto"
				/*
				tabindex of the scrollbar buttons
				values: false, integer
					option						default
					-------------------------------------
					tabindex					null
				*/
			},
			/* 
			keyboard scrolling
			*/
			keyboard:{ 
				/*
				enable scrolling via keyboard
				values: boolean
				*/
				enable:true,
				/*
				keyboard scrolling type 
				values (string): "stepless", "stepped"
				*/
				scrollType:"stepless",
				/*
				scrolling amount in pixels
				values: "auto", integer 
				*/
				scrollAmount:"auto"
			},
			/*
			enable content touch-swipe scrolling 
			values: boolean, integer, string (number)
			integer values define the axis-specific minimum amount required for scrolling momentum
			*/
			contentTouchScroll:25,
			/*
			advanced option parameters
			*/
			advanced:{
				/*
				auto-expand content horizontally (for "x" or "yx" axis) 
				values: boolean
					option						default
					-------------------------------------
					autoExpandHorizontalScroll	null
				*/
				/*
				auto-scroll to elements with focus
				*/
				autoScrollOnFocus:"input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
				/*
				auto-update scrollbars on content, element or viewport resize 
				should be true for fluid layouts/elements, adding/removing content dynamically, hiding/showing elements, content with images etc. 
				values: boolean
				*/
				updateOnContentResize:true,
				/*
				auto-update scrollbars each time each image inside the element is fully loaded 
				values: boolean
				*/
				updateOnImageLoad:true,
				/*
				auto-update scrollbars based on the amount and size changes of specific selectors 
				useful when you need to update the scrollbar(s) automatically, each time a type of element is added, removed or changes its size 
				values: boolean, string (e.g. "ul li" will auto-update scrollbars each time list-items inside the element are changed) 
				a value of true (boolean) will auto-update scrollbars each time any element is changed
					option						default
					-------------------------------------
					updateOnSelectorChange		null
				*/
				/*
				extra selectors that'll release scrollbar dragging upon mouseup, pointerup, touchend etc. (e.g. "selector-1, selector-2")
					option						default
					-------------------------------------
					releaseDraggableSelectors	null
				*/
				/*
				auto-update timeout 
				values: integer (milliseconds)
				*/
				autoUpdateTimeout:60
			},
			/* 
			scrollbar theme 
			values: string (see CSS/plugin URI for a list of ready-to-use themes)
			*/
			theme:"light",
			/*
			user defined callback functions
			*/
			callbacks:{
				/*
				Available callbacks: 
					callback					default
					-------------------------------------
					onInit						null
					onScrollStart				null
					onScroll					null
					onTotalScroll				null
					onTotalScrollBack			null
					whileScrolling				null
					onOverflowY					null
					onOverflowX					null
					onOverflowYNone				null
					onOverflowXNone				null
					onImageLoad					null
					onSelectorChange			null
					onUpdate					null
				*/
				onTotalScrollOffset:0,
				onTotalScrollBackOffset:0,
				alwaysTriggerOffsets:true
			}
			/*
			add scrollbar(s) on all elements matching the current selector, now and in the future 
			values: boolean, string 
			string values: "on" (enable), "once" (disable after first invocation), "off" (disable)
			liveSelector values: string (selector)
				option						default
				-------------------------------------
				live						false
				liveSelector				null
			*/
		},
	
	
	
	
	
	/* 
	----------------------------------------
	VARS, CONSTANTS 
	----------------------------------------
	*/
	
		totalInstances=0, /* plugin instances amount */
		liveTimers={}, /* live option timers */
		oldIE=(window.attachEvent && !window.addEventListener) ? 1 : 0, /* detect IE < 9 */
		touchActive=false,touchable, /* global touch vars (for touch and pointer events) */
		/* general plugin classes */
		classes=[
			"mCSB_dragger_onDrag","mCSB_scrollTools_onDrag","mCS_img_loaded","mCS_disabled","mCS_destroyed","mCS_no_scrollbar",
			"mCS-autoHide","mCS-dir-rtl","mCS_no_scrollbar_y","mCS_no_scrollbar_x","mCS_y_hidden","mCS_x_hidden","mCSB_draggerContainer",
			"mCSB_buttonUp","mCSB_buttonDown","mCSB_buttonLeft","mCSB_buttonRight"
		],
		
	
	
	
	
	/* 
	----------------------------------------
	METHODS 
	----------------------------------------
	*/
	
		methods={
			
			/* 
			plugin initialization method 
			creates the scrollbar(s), plugin data object and options
			----------------------------------------
			*/
			
			init:function(options){
				
				var options=$.extend(true,{},defaults,options),
					selector=_selector.call(this); /* validate selector */
				
				/* 
				if live option is enabled, monitor for elements matching the current selector and 
				apply scrollbar(s) when found (now and in the future) 
				*/
				if(options.live){
					var liveSelector=options.liveSelector || this.selector || defaultSelector, /* live selector(s) */
						$liveSelector=$(liveSelector); /* live selector(s) as jquery object */
					if(options.live==="off"){
						/* 
						disable live if requested 
						usage: $(selector).mCustomScrollbar({live:"off"}); 
						*/
						removeLiveTimers(liveSelector);
						return;
					}
					liveTimers[liveSelector]=setTimeout(function(){
						/* call mCustomScrollbar fn on live selector(s) every half-second */
						$liveSelector.mCustomScrollbar(options);
						if(options.live==="once" && $liveSelector.length){
							/* disable live after first invocation */
							removeLiveTimers(liveSelector);
						}
					},500);
				}else{
					removeLiveTimers(liveSelector);
				}
				
				/* options backward compatibility (for versions < 3.0.0) and normalization */
				options.setWidth=(options.set_width) ? options.set_width : options.setWidth;
				options.setHeight=(options.set_height) ? options.set_height : options.setHeight;
				options.axis=(options.horizontalScroll) ? "x" : _findAxis(options.axis);
				options.scrollInertia=options.scrollInertia>0 && options.scrollInertia<17 ? 17 : options.scrollInertia;
				if(typeof options.mouseWheel!=="object" &&  options.mouseWheel==true){ /* old school mouseWheel option (non-object) */
					options.mouseWheel={enable:true,scrollAmount:"auto",axis:"y",preventDefault:false,deltaFactor:"auto",normalizeDelta:false,invert:false}
				}
				options.mouseWheel.scrollAmount=!options.mouseWheelPixels ? options.mouseWheel.scrollAmount : options.mouseWheelPixels;
				options.mouseWheel.normalizeDelta=!options.advanced.normalizeMouseWheelDelta ? options.mouseWheel.normalizeDelta : options.advanced.normalizeMouseWheelDelta;
				options.scrollButtons.scrollType=_findScrollButtonsType(options.scrollButtons.scrollType); 
				
				_theme(options); /* theme-specific options */
				
				/* plugin constructor */
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if(!$this.data(pluginPfx)){ /* prevent multiple instantiations */
					
						/* store options and create objects in jquery data */
						$this.data(pluginPfx,{
							idx:++totalInstances, /* instance index */
							opt:options, /* options */
							scrollRatio:{y:null,x:null}, /* scrollbar to content ratio */
							overflowed:null, /* overflowed axis */
							contentReset:{y:null,x:null}, /* object to check when content resets */
							bindEvents:false, /* object to check if events are bound */
							tweenRunning:false, /* object to check if tween is running */
							sequential:{}, /* sequential scrolling object */
							langDir:$this.css("direction"), /* detect/store direction (ltr or rtl) */
							cbOffsets:null, /* object to check whether callback offsets always trigger */
							/* 
							object to check how scrolling events where last triggered 
							"internal" (default - triggered by this script), "external" (triggered by other scripts, e.g. via scrollTo method) 
							usage: object.data("mCS").trigger
							*/
							trigger:null
						});
						
						var d=$this.data(pluginPfx),o=d.opt,
							/* HTML data attributes */
							htmlDataAxis=$this.data("mcs-axis"),htmlDataSbPos=$this.data("mcs-scrollbar-position"),htmlDataTheme=$this.data("mcs-theme");
						 
						if(htmlDataAxis){o.axis=htmlDataAxis;} /* usage example: data-mcs-axis="y" */
						if(htmlDataSbPos){o.scrollbarPosition=htmlDataSbPos;} /* usage example: data-mcs-scrollbar-position="outside" */
						if(htmlDataTheme){ /* usage example: data-mcs-theme="minimal" */
							o.theme=htmlDataTheme;
							_theme(o); /* theme-specific options */
						}
						
						_pluginMarkup.call(this); /* add plugin markup */
						
						$("#mCSB_"+d.idx+"_container img:not(."+classes[2]+")").addClass(classes[2]); /* flag loaded images */
						
						methods.update.call(null,$this); /* call the update method */
					
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/* 
			plugin update method 
			updates content and scrollbar(s) values, events and status 
			----------------------------------------
			usage: $(selector).mCustomScrollbar("update");
			*/
			
			update:function(el,cb){
				
				var selector=el || _selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
						
						var d=$this.data(pluginPfx),o=d.opt,
							mCSB_container=$("#mCSB_"+d.idx+"_container"),
							mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
						
						if(!mCSB_container.length){return;}
						
						if(d.tweenRunning){_stop($this);} /* stop any running tweens while updating */
						
						/* if element was disabled or destroyed, remove class(es) */
						if($this.hasClass(classes[3])){$this.removeClass(classes[3]);}
						if($this.hasClass(classes[4])){$this.removeClass(classes[4]);}
						
						_maxHeight.call(this); /* detect/set css max-height value */
						
						_expandContentHorizontally.call(this); /* expand content horizontally */
						
						if(o.axis!=="y" && !o.advanced.autoExpandHorizontalScroll){
							mCSB_container.css("width",_contentWidth(mCSB_container.children()));
						}
						
						d.overflowed=_overflowed.call(this); /* determine if scrolling is required */
						
						_scrollbarVisibility.call(this); /* show/hide scrollbar(s) */
						
						/* auto-adjust scrollbar dragger length analogous to content */
						if(o.autoDraggerLength){_setDraggerLength.call(this);}
						
						_scrollRatio.call(this); /* calculate and store scrollbar to content ratio */
						
						_bindEvents.call(this); /* bind scrollbar events */
						
						/* reset scrolling position and/or events */
						var to=[Math.abs(mCSB_container[0].offsetTop),Math.abs(mCSB_container[0].offsetLeft)];
						if(o.axis!=="x"){ /* y/yx axis */
							if(!d.overflowed[0]){ /* y scrolling is not required */
								_resetContentPosition.call(this); /* reset content position */
								if(o.axis==="y"){
									_unbindEvents.call(this);
								}else if(o.axis==="yx" && d.overflowed[1]){
									_scrollTo($this,to[1].toString(),{dir:"x",dur:0,overwrite:"none"});
								}
							}else if(mCSB_dragger[0].height()>mCSB_dragger[0].parent().height()){
								_resetContentPosition.call(this); /* reset content position */
							}else{ /* y scrolling is required */
								_scrollTo($this,to[0].toString(),{dir:"y",dur:0,overwrite:"none"});
								d.contentReset.y=null;
							}
						}
						if(o.axis!=="y"){ /* x/yx axis */
							if(!d.overflowed[1]){ /* x scrolling is not required */
								_resetContentPosition.call(this); /* reset content position */
								if(o.axis==="x"){
									_unbindEvents.call(this);
								}else if(o.axis==="yx" && d.overflowed[0]){
									_scrollTo($this,to[0].toString(),{dir:"y",dur:0,overwrite:"none"});
								}
							}else if(mCSB_dragger[1].width()>mCSB_dragger[1].parent().width()){
								_resetContentPosition.call(this); /* reset content position */
							}else{ /* x scrolling is required */
								_scrollTo($this,to[1].toString(),{dir:"x",dur:0,overwrite:"none"});
								d.contentReset.x=null;
							}
						}
						
						/* callbacks: onImageLoad, onSelectorChange, onUpdate */
						if(cb && d){
							if(cb===2 && o.callbacks.onImageLoad && typeof o.callbacks.onImageLoad==="function"){
								o.callbacks.onImageLoad.call(this);
							}else if(cb===3 && o.callbacks.onSelectorChange && typeof o.callbacks.onSelectorChange==="function"){
								o.callbacks.onSelectorChange.call(this);
							}else if(o.callbacks.onUpdate && typeof o.callbacks.onUpdate==="function"){
								o.callbacks.onUpdate.call(this);
							}
						}
						
						_autoUpdate.call(this); /* initialize automatic updating (for dynamic content, fluid layouts etc.) */
						
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/* 
			plugin scrollTo method 
			triggers a scrolling event to a specific value
			----------------------------------------
			usage: $(selector).mCustomScrollbar("scrollTo",value,options);
			*/
		
			scrollTo:function(val,options){
				
				/* prevent silly things like $(selector).mCustomScrollbar("scrollTo",undefined); */
				if(typeof val=="undefined" || val==null){return;}
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
					
						var d=$this.data(pluginPfx),o=d.opt,
							/* method default options */
							methodDefaults={
								trigger:"external", /* method is by default triggered externally (e.g. from other scripts) */
								scrollInertia:o.scrollInertia, /* scrolling inertia (animation duration) */
								scrollEasing:"mcsEaseInOut", /* animation easing */
								moveDragger:false, /* move dragger instead of content */
								timeout:60, /* scroll-to delay */
								callbacks:true, /* enable/disable callbacks */
								onStart:true,
								onUpdate:true,
								onComplete:true
							},
							methodOptions=$.extend(true,{},methodDefaults,options),
							to=_arr.call(this,val),dur=methodOptions.scrollInertia>0 && methodOptions.scrollInertia<17 ? 17 : methodOptions.scrollInertia;
						
						/* translate yx values to actual scroll-to positions */
						to[0]=_to.call(this,to[0],"y");
						to[1]=_to.call(this,to[1],"x");
						
						/* 
						check if scroll-to value moves the dragger instead of content. 
						Only pixel values apply on dragger (e.g. 100, "100px", "-=100" etc.) 
						*/
						if(methodOptions.moveDragger){
							to[0]*=d.scrollRatio.y;
							to[1]*=d.scrollRatio.x;
						}
						
						methodOptions.dur=dur;
						
						setTimeout(function(){ 
							/* do the scrolling */
							if(to[0]!==null && typeof to[0]!=="undefined" && o.axis!=="x" && d.overflowed[0]){ /* scroll y */
								methodOptions.dir="y";
								methodOptions.overwrite="all";
								_scrollTo($this,to[0].toString(),methodOptions);
							}
							if(to[1]!==null && typeof to[1]!=="undefined" && o.axis!=="y" && d.overflowed[1]){ /* scroll x */
								methodOptions.dir="x";
								methodOptions.overwrite="none";
								_scrollTo($this,to[1].toString(),methodOptions);
							}
						},methodOptions.timeout);
						
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/*
			plugin stop method 
			stops scrolling animation
			----------------------------------------
			usage: $(selector).mCustomScrollbar("stop");
			*/
			stop:function(){
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
										
						_stop($this);
					
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/*
			plugin disable method 
			temporarily disables the scrollbar(s) 
			----------------------------------------
			usage: $(selector).mCustomScrollbar("disable",reset); 
			reset (boolean): resets content position to 0 
			*/
			disable:function(r){
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
						
						var d=$this.data(pluginPfx);
						
						_autoUpdate.call(this,"remove"); /* remove automatic updating */
						
						_unbindEvents.call(this); /* unbind events */
						
						if(r){_resetContentPosition.call(this);} /* reset content position */
						
						_scrollbarVisibility.call(this,true); /* show/hide scrollbar(s) */
						
						$this.addClass(classes[3]); /* add disable class */
					
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/*
			plugin destroy method 
			completely removes the scrollbar(s) and returns the element to its original state
			----------------------------------------
			usage: $(selector).mCustomScrollbar("destroy"); 
			*/
			destroy:function(){
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
					
						var d=$this.data(pluginPfx),o=d.opt,
							mCustomScrollBox=$("#mCSB_"+d.idx),
							mCSB_container=$("#mCSB_"+d.idx+"_container"),
							scrollbar=$(".mCSB_"+d.idx+"_scrollbar");
					
						if(o.live){removeLiveTimers(o.liveSelector || $(selector).selector);} /* remove live timers */
						
						_autoUpdate.call(this,"remove"); /* remove automatic updating */
						
						_unbindEvents.call(this); /* unbind events */
						
						_resetContentPosition.call(this); /* reset content position */
						
						$this.removeData(pluginPfx); /* remove plugin data object */
						
						_delete(this,"mcs"); /* delete callbacks object */
						
						/* remove plugin markup */
						scrollbar.remove(); /* remove scrollbar(s) first (those can be either inside or outside plugin's inner wrapper) */
						mCSB_container.find("img."+classes[2]).removeClass(classes[2]); /* remove loaded images flag */
						mCustomScrollBox.replaceWith(mCSB_container.contents()); /* replace plugin's inner wrapper with the original content */
						/* remove plugin classes from the element and add destroy class */
						$this.removeClass(pluginNS+" _"+pluginPfx+"_"+d.idx+" "+classes[6]+" "+classes[7]+" "+classes[5]+" "+classes[3]).addClass(classes[4]);
					
					}
					
				});
				
			}
			/* ---------------------------------------- */
			
		},
	
	
	
	
		
	/* 
	----------------------------------------
	FUNCTIONS
	----------------------------------------
	*/
	
		/* validates selector (if selector is invalid or undefined uses the default one) */
		_selector=function(){
			return (typeof $(this)!=="object" || $(this).length<1) ? defaultSelector : this;
		},
		/* -------------------- */
		
		
		/* changes options according to theme */
		_theme=function(obj){
			var fixedSizeScrollbarThemes=["rounded","rounded-dark","rounded-dots","rounded-dots-dark"],
				nonExpandedScrollbarThemes=["rounded-dots","rounded-dots-dark","3d","3d-dark","3d-thick","3d-thick-dark","inset","inset-dark","inset-2","inset-2-dark","inset-3","inset-3-dark"],
				disabledScrollButtonsThemes=["minimal","minimal-dark"],
				enabledAutoHideScrollbarThemes=["minimal","minimal-dark"],
				scrollbarPositionOutsideThemes=["minimal","minimal-dark"];
			obj.autoDraggerLength=$.inArray(obj.theme,fixedSizeScrollbarThemes) > -1 ? false : obj.autoDraggerLength;
			obj.autoExpandScrollbar=$.inArray(obj.theme,nonExpandedScrollbarThemes) > -1 ? false : obj.autoExpandScrollbar;
			obj.scrollButtons.enable=$.inArray(obj.theme,disabledScrollButtonsThemes) > -1 ? false : obj.scrollButtons.enable;
			obj.autoHideScrollbar=$.inArray(obj.theme,enabledAutoHideScrollbarThemes) > -1 ? true : obj.autoHideScrollbar;
			obj.scrollbarPosition=$.inArray(obj.theme,scrollbarPositionOutsideThemes) > -1 ? "outside" : obj.scrollbarPosition;
		},
		/* -------------------- */
		
		
		/* live option timers removal */
		removeLiveTimers=function(selector){
			if(liveTimers[selector]){
				clearTimeout(liveTimers[selector]);
				_delete(liveTimers,selector);
			}
		},
		/* -------------------- */
		
		
		/* normalizes axis option to valid values: "y", "x", "yx" */
		_findAxis=function(val){
			return (val==="yx" || val==="xy" || val==="auto") ? "yx" : (val==="x" || val==="horizontal") ? "x" : "y";
		},
		/* -------------------- */
		
		
		/* normalizes scrollButtons.scrollType option to valid values: "stepless", "stepped" */
		_findScrollButtonsType=function(val){
			return (val==="stepped" || val==="pixels" || val==="step" || val==="click") ? "stepped" : "stepless";
		},
		/* -------------------- */
		
		
		/* generates plugin markup */
		_pluginMarkup=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				expandClass=o.autoExpandScrollbar ? " "+classes[1]+"_expand" : "",
				scrollbar=["<div id='mCSB_"+d.idx+"_scrollbar_vertical' class='mCSB_scrollTools mCSB_"+d.idx+"_scrollbar mCS-"+o.theme+" mCSB_scrollTools_vertical"+expandClass+"'><div class='"+classes[12]+"'><div id='mCSB_"+d.idx+"_dragger_vertical' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>","<div id='mCSB_"+d.idx+"_scrollbar_horizontal' class='mCSB_scrollTools mCSB_"+d.idx+"_scrollbar mCS-"+o.theme+" mCSB_scrollTools_horizontal"+expandClass+"'><div class='"+classes[12]+"'><div id='mCSB_"+d.idx+"_dragger_horizontal' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>"],
				wrapperClass=o.axis==="yx" ? "mCSB_vertical_horizontal" : o.axis==="x" ? "mCSB_horizontal" : "mCSB_vertical",
				scrollbars=o.axis==="yx" ? scrollbar[0]+scrollbar[1] : o.axis==="x" ? scrollbar[1] : scrollbar[0],
				contentWrapper=o.axis==="yx" ? "<div id='mCSB_"+d.idx+"_container_wrapper' class='mCSB_container_wrapper' />" : "",
				autoHideClass=o.autoHideScrollbar ? " "+classes[6] : "",
				scrollbarDirClass=(o.axis!=="x" && d.langDir==="rtl") ? " "+classes[7] : "";
			if(o.setWidth){$this.css("width",o.setWidth);} /* set element width */
			if(o.setHeight){$this.css("height",o.setHeight);} /* set element height */
			o.setLeft=(o.axis!=="y" && d.langDir==="rtl") ? "989999px" : o.setLeft; /* adjust left position for rtl direction */
			$this.addClass(pluginNS+" _"+pluginPfx+"_"+d.idx+autoHideClass+scrollbarDirClass).wrapInner("<div id='mCSB_"+d.idx+"' class='mCustomScrollBox mCS-"+o.theme+" "+wrapperClass+"'><div id='mCSB_"+d.idx+"_container' class='mCSB_container' style='position:relative; top:"+o.setTop+"; left:"+o.setLeft+";' dir="+d.langDir+" /></div>");
			var mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(o.axis!=="y" && !o.advanced.autoExpandHorizontalScroll){
				mCSB_container.css("width",_contentWidth(mCSB_container.children()));
			}
			if(o.scrollbarPosition==="outside"){
				if($this.css("position")==="static"){ /* requires elements with non-static position */
					$this.css("position","relative");
				}
				$this.css("overflow","visible");
				mCustomScrollBox.addClass("mCSB_outside").after(scrollbars);
			}else{
				mCustomScrollBox.addClass("mCSB_inside").append(scrollbars);
				mCSB_container.wrap(contentWrapper);
			}
			_scrollButtons.call(this); /* add scrollbar buttons */
			/* minimum dragger length */
			var mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
			mCSB_dragger[0].css("min-height",mCSB_dragger[0].height());
			mCSB_dragger[1].css("min-width",mCSB_dragger[1].width());
		},
		/* -------------------- */
		
		
		/* calculates content width */
		_contentWidth=function(el){
			return Math.max.apply(Math,el.map(function(){return $(this).outerWidth(true);}).get());
		},
		/* -------------------- */
		
		
		/* expands content horizontally */
		_expandContentHorizontally=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(o.advanced.autoExpandHorizontalScroll && o.axis!=="y"){
				/* 
				wrap content with an infinite width div and set its position to absolute and width to auto. 
				Setting width to auto before calculating the actual width is important! 
				We must let the browser set the width as browser zoom values are impossible to calculate.
				*/
				mCSB_container.css({"position":"absolute","width":"auto"})
					.wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />")
					.css({ /* set actual width, original position and un-wrap */
						/* 
						get the exact width (with decimals) and then round-up. 
						Using jquery outerWidth() will round the width value which will mess up with inner elements that have non-integer width
						*/
						"width":(Math.ceil(mCSB_container[0].getBoundingClientRect().right+0.4)-Math.floor(mCSB_container[0].getBoundingClientRect().left)),
						"position":"relative"
					}).unwrap();
			}
		},
		/* -------------------- */
		
		
		/* adds scrollbar buttons */
		_scrollButtons=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_scrollTools=$(".mCSB_"+d.idx+"_scrollbar:first"),
				tabindex=!_isNumeric(o.scrollButtons.tabindex) ? "" : "tabindex='"+o.scrollButtons.tabindex+"'",
				btnHTML=[
					"<a href='#' class='"+classes[13]+"' oncontextmenu='return false;' "+tabindex+" />",
					"<a href='#' class='"+classes[14]+"' oncontextmenu='return false;' "+tabindex+" />",
					"<a href='#' class='"+classes[15]+"' oncontextmenu='return false;' "+tabindex+" />",
					"<a href='#' class='"+classes[16]+"' oncontextmenu='return false;' "+tabindex+" />"
				],
				btn=[(o.axis==="x" ? btnHTML[2] : btnHTML[0]),(o.axis==="x" ? btnHTML[3] : btnHTML[1]),btnHTML[2],btnHTML[3]];
			if(o.scrollButtons.enable){
				mCSB_scrollTools.prepend(btn[0]).append(btn[1]).next(".mCSB_scrollTools").prepend(btn[2]).append(btn[3]);
			}
		},
		/* -------------------- */
		
		
		/* detects/sets css max-height value */
		_maxHeight=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mh=$this.css("max-height") || "none",pct=mh.indexOf("%")!==-1,
				bs=$this.css("box-sizing");
			if(mh!=="none"){
				var val=pct ? $this.parent().height()*parseInt(mh)/100 : parseInt(mh);
				/* if element's css box-sizing is "border-box", subtract any paddings and/or borders from max-height value */
				if(bs==="border-box"){val-=(($this.innerHeight()-$this.height())+($this.outerHeight()-$this.innerHeight()));}
				mCustomScrollBox.css("max-height",Math.round(val));
			}
		},
		/* -------------------- */
		
		
		/* auto-adjusts scrollbar dragger length */
		_setDraggerLength=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				ratio=[mCustomScrollBox.height()/mCSB_container.outerHeight(false),mCustomScrollBox.width()/mCSB_container.outerWidth(false)],
				l=[
					parseInt(mCSB_dragger[0].css("min-height")),Math.round(ratio[0]*mCSB_dragger[0].parent().height()),
					parseInt(mCSB_dragger[1].css("min-width")),Math.round(ratio[1]*mCSB_dragger[1].parent().width())
				],
				h=oldIE && (l[1]<l[0]) ? l[0] : l[1],w=oldIE && (l[3]<l[2]) ? l[2] : l[3];
			mCSB_dragger[0].css({
				"height":h,"max-height":(mCSB_dragger[0].parent().height()-10)
			}).find(".mCSB_dragger_bar").css({"line-height":l[0]+"px"});
			mCSB_dragger[1].css({
				"width":w,"max-width":(mCSB_dragger[1].parent().width()-10)
			});
		},
		/* -------------------- */
		
		
		/* calculates scrollbar to content ratio */
		_scrollRatio=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				scrollAmount=[mCSB_container.outerHeight(false)-mCustomScrollBox.height(),mCSB_container.outerWidth(false)-mCustomScrollBox.width()],
				ratio=[
					scrollAmount[0]/(mCSB_dragger[0].parent().height()-mCSB_dragger[0].height()),
					scrollAmount[1]/(mCSB_dragger[1].parent().width()-mCSB_dragger[1].width())
				];
			d.scrollRatio={y:ratio[0],x:ratio[1]};
		},
		/* -------------------- */
		
		
		/* toggles scrolling classes */
		_onDragClasses=function(el,action,xpnd){
			var expandClass=xpnd ? classes[0]+"_expanded" : "",
				scrollbar=el.closest(".mCSB_scrollTools");
			if(action==="active"){
				el.toggleClass(classes[0]+" "+expandClass); scrollbar.toggleClass(classes[1]); 
				el[0]._draggable=el[0]._draggable ? 0 : 1;
			}else{
				if(!el[0]._draggable){
					if(action==="hide"){
						el.removeClass(classes[0]); scrollbar.removeClass(classes[1]);
					}else{
						el.addClass(classes[0]); scrollbar.addClass(classes[1]);
					}
				}
			}
		},
		/* -------------------- */
		
		
		/* checks if content overflows its container to determine if scrolling is required */
		_overflowed=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				contentHeight=d.overflowed==null ? mCSB_container.height() : mCSB_container.outerHeight(false),
				contentWidth=d.overflowed==null ? mCSB_container.width() : mCSB_container.outerWidth(false);
			return [contentHeight>mCustomScrollBox.height(),contentWidth>mCustomScrollBox.width()];
		},
		/* -------------------- */
		
		
		/* resets content position to 0 */
		_resetContentPosition=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
			_stop($this); /* stop any current scrolling before resetting */
			if((o.axis!=="x" && !d.overflowed[0]) || (o.axis==="y" && d.overflowed[0])){ /* reset y */
				mCSB_dragger[0].add(mCSB_container).css("top",0);
				_scrollTo($this,"_resetY");
			}
			if((o.axis!=="y" && !d.overflowed[1]) || (o.axis==="x" && d.overflowed[1])){ /* reset x */
				var cx=dx=0;
				if(d.langDir==="rtl"){ /* adjust left position for rtl direction */
					cx=mCustomScrollBox.width()-mCSB_container.outerWidth(false);
					dx=Math.abs(cx/d.scrollRatio.x);
				}
				mCSB_container.css("left",cx);
				mCSB_dragger[1].css("left",dx);
				_scrollTo($this,"_resetX");
			}
		},
		/* -------------------- */
		
		
		/* binds scrollbar events */
		_bindEvents=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt;
			if(!d.bindEvents){ /* check if events are already bound */
				_draggable.call(this);
				if(o.contentTouchScroll){_contentDraggable.call(this);}
				_selectable.call(this);
				if(o.mouseWheel.enable){ /* bind mousewheel fn when plugin is available */
					function _mwt(){
						mousewheelTimeout=setTimeout(function(){
							if(!$.event.special.mousewheel){
								_mwt();
							}else{
								clearTimeout(mousewheelTimeout);
								_mousewheel.call($this[0]);
							}
						},100);
					}
					var mousewheelTimeout;
					_mwt();
				}
				_draggerRail.call(this);
				_wrapperScroll.call(this);
				if(o.advanced.autoScrollOnFocus){_focus.call(this);}
				if(o.scrollButtons.enable){_buttons.call(this);}
				if(o.keyboard.enable){_keyboard.call(this);}
				d.bindEvents=true;
			}
		},
		/* -------------------- */
		
		
		/* unbinds scrollbar events */
		_unbindEvents=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				sb=".mCSB_"+d.idx+"_scrollbar",
				sel=$("#mCSB_"+d.idx+",#mCSB_"+d.idx+"_container,#mCSB_"+d.idx+"_container_wrapper,"+sb+" ."+classes[12]+",#mCSB_"+d.idx+"_dragger_vertical,#mCSB_"+d.idx+"_dragger_horizontal,"+sb+">a"),
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(o.advanced.releaseDraggableSelectors){sel.add($(o.advanced.releaseDraggableSelectors));}
			if(d.bindEvents){ /* check if events are bound */
				/* unbind namespaced events from document/selectors */
				$(document).unbind("."+namespace);
				sel.each(function(){
					$(this).unbind("."+namespace);
				});
				/* clear and delete timeouts/objects */
				clearTimeout($this[0]._focusTimeout); _delete($this[0],"_focusTimeout");
				clearTimeout(d.sequential.step); _delete(d.sequential,"step");
				clearTimeout(mCSB_container[0].onCompleteTimeout); _delete(mCSB_container[0],"onCompleteTimeout");
				d.bindEvents=false;
			}
		},
		/* -------------------- */
		
		
		/* toggles scrollbar visibility */
		_scrollbarVisibility=function(disabled){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				contentWrapper=$("#mCSB_"+d.idx+"_container_wrapper"),
				content=contentWrapper.length ? contentWrapper : $("#mCSB_"+d.idx+"_container"),
				scrollbar=[$("#mCSB_"+d.idx+"_scrollbar_vertical"),$("#mCSB_"+d.idx+"_scrollbar_horizontal")],
				mCSB_dragger=[scrollbar[0].find(".mCSB_dragger"),scrollbar[1].find(".mCSB_dragger")];
			if(o.axis!=="x"){
				if(d.overflowed[0] && !disabled){
					scrollbar[0].add(mCSB_dragger[0]).add(scrollbar[0].children("a")).css("display","block");
					content.removeClass(classes[8]+" "+classes[10]);
				}else{
					if(o.alwaysShowScrollbar){
						if(o.alwaysShowScrollbar!==2){mCSB_dragger[0].css("display","none");}
						content.removeClass(classes[10]);
					}else{
						scrollbar[0].css("display","none");
						content.addClass(classes[10]);
					}
					content.addClass(classes[8]);
				}
			}
			if(o.axis!=="y"){
				if(d.overflowed[1] && !disabled){
					scrollbar[1].add(mCSB_dragger[1]).add(scrollbar[1].children("a")).css("display","block");
					content.removeClass(classes[9]+" "+classes[11]);
				}else{
					if(o.alwaysShowScrollbar){
						if(o.alwaysShowScrollbar!==2){mCSB_dragger[1].css("display","none");}
						content.removeClass(classes[11]);
					}else{
						scrollbar[1].css("display","none");
						content.addClass(classes[11]);
					}
					content.addClass(classes[9]);
				}
			}
			if(!d.overflowed[0] && !d.overflowed[1]){
				$this.addClass(classes[5]);
			}else{
				$this.removeClass(classes[5]);
			}
		},
		/* -------------------- */
		
		
		/* returns input coordinates of pointer, touch and mouse events (relative to document) */
		_coordinates=function(e){
			var t=e.type;
			switch(t){
				case "pointerdown": case "MSPointerDown": case "pointermove": case "MSPointerMove": case "pointerup": case "MSPointerUp":
					return e.target.ownerDocument!==document ? [e.originalEvent.screenY,e.originalEvent.screenX,false] : [e.originalEvent.pageY,e.originalEvent.pageX,false];
					break;
				case "touchstart": case "touchmove": case "touchend":
					var touch=e.originalEvent.touches[0] || e.originalEvent.changedTouches[0],
						touches=e.originalEvent.touches.length || e.originalEvent.changedTouches.length;
					return e.target.ownerDocument!==document ? [touch.screenY,touch.screenX,touches>1] : [touch.pageY,touch.pageX,touches>1];
					break;
				default:
					return [e.pageY,e.pageX,false];
			}
		},
		/* -------------------- */
		
		
		/* 
		SCROLLBAR DRAG EVENTS
		scrolls content via scrollbar dragging 
		*/
		_draggable=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				draggerId=["mCSB_"+d.idx+"_dragger_vertical","mCSB_"+d.idx+"_dragger_horizontal"],
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=$("#"+draggerId[0]+",#"+draggerId[1]),
				draggable,dragY,dragX,
				rds=o.advanced.releaseDraggableSelectors ? mCSB_dragger.add($(o.advanced.releaseDraggableSelectors)) : mCSB_dragger;
			mCSB_dragger.bind("mousedown."+namespace+" touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace,function(e){
				e.stopImmediatePropagation();
				e.preventDefault();
				if(!_mouseBtnLeft(e)){return;} /* left mouse button only */
				touchActive=true;
				if(oldIE){document.onselectstart=function(){return false;}} /* disable text selection for IE < 9 */
				_iframe(false); /* enable scrollbar dragging over iframes by disabling their events */
				_stop($this);
				draggable=$(this);
				var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left,
					h=draggable.height()+offset.top,w=draggable.width()+offset.left;
				if(y<h && y>0 && x<w && x>0){
					dragY=y; 
					dragX=x;
				}
				_onDragClasses(draggable,"active",o.autoExpandScrollbar); 
			}).bind("touchmove."+namespace,function(e){
				e.stopImmediatePropagation();
				e.preventDefault();
				var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
				_drag(dragY,dragX,y,x);
			});
			$(document).bind("mousemove."+namespace+" pointermove."+namespace+" MSPointerMove."+namespace,function(e){
				if(draggable){
					var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
					if(dragY===y){return;} /* has it really moved? */
					_drag(dragY,dragX,y,x);
				}
			}).add(rds).bind("mouseup."+namespace+" touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace,function(e){
				if(draggable){
					_onDragClasses(draggable,"active",o.autoExpandScrollbar); 
					draggable=null;
				}
				touchActive=false;
				if(oldIE){document.onselectstart=null;} /* enable text selection for IE < 9 */
				_iframe(true); /* enable iframes events */
			});
			function _iframe(evt){
				var el=mCSB_container.find("iframe");
				if(!el.length){return;} /* check if content contains iframes */
				var val=!evt ? "none" : "auto";
				el.css("pointer-events",val); /* for IE11, iframe's display property should not be "block" */
			}
			function _drag(dragY,dragX,y,x){
				mCSB_container[0].idleTimer=o.scrollInertia<233 ? 250 : 0;
				if(draggable.attr("id")===draggerId[1]){
					var dir="x",to=((draggable[0].offsetLeft-dragX)+x)*d.scrollRatio.x;
				}else{
					var dir="y",to=((draggable[0].offsetTop-dragY)+y)*d.scrollRatio.y;
				}
				_scrollTo($this,to.toString(),{dir:dir,drag:true});
			}
		},
		/* -------------------- */
		
		
		/* 
		TOUCH SWIPE EVENTS
		scrolls content via touch swipe 
		Emulates the native touch-swipe scrolling with momentum found in iOS, Android and WP devices 
		*/
		_contentDraggable=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				dragY,dragX,touchStartY,touchStartX,touchMoveY=[],touchMoveX=[],startTime,runningTime,endTime,distance,speed,amount,
				durA=0,durB,overwrite=o.axis==="yx" ? "none" : "all",touchIntent=[],touchDrag,docDrag,
				iframe=mCSB_container.find("iframe"),
				events=[
					"touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace, //start
					"touchmove."+namespace+" pointermove."+namespace+" MSPointerMove."+namespace, //move
					"touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace //end
				];
			mCSB_container.bind(events[0],function(e){
				_onTouchstart(e);
			}).bind(events[1],function(e){
				_onTouchmove(e);
			});
			mCustomScrollBox.bind(events[0],function(e){
				_onTouchstart2(e);
			}).bind(events[2],function(e){
				_onTouchend(e);
			});
			if(iframe.length){
				iframe.each(function(){
					$(this).load(function(){
						/* bind events on accessible iframes */
						if(_canAccessIFrame(this)){
							$(this.contentDocument || this.contentWindow.document).bind(events[0],function(e){
								_onTouchstart(e);
								_onTouchstart2(e);
							}).bind(events[1],function(e){
								_onTouchmove(e);
							}).bind(events[2],function(e){
								_onTouchend(e);
							});
						}
					});
				});
			}
			function _onTouchstart(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){touchable=0; return;}
				touchable=1; touchDrag=0; docDrag=0;
				$this.removeClass("mCS_touch_action");
				var offset=mCSB_container.offset();
				dragY=_coordinates(e)[0]-offset.top;
				dragX=_coordinates(e)[1]-offset.left;
				touchIntent=[_coordinates(e)[0],_coordinates(e)[1]];
			}
			function _onTouchmove(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){return;}
				e.stopImmediatePropagation();
				if(docDrag && !touchDrag){return;}
				runningTime=_getTime();
				var offset=mCustomScrollBox.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left,
					easing="mcsLinearOut";
				touchMoveY.push(y);
				touchMoveX.push(x);
				touchIntent[2]=Math.abs(_coordinates(e)[0]-touchIntent[0]); touchIntent[3]=Math.abs(_coordinates(e)[1]-touchIntent[1]);
				if(d.overflowed[0]){
					var limit=mCSB_dragger[0].parent().height()-mCSB_dragger[0].height(),
						prevent=((dragY-y)>0 && (y-dragY)>-(limit*d.scrollRatio.y) && (touchIntent[3]*2<touchIntent[2] || o.axis==="yx"));
				}
				if(d.overflowed[1]){
					var limitX=mCSB_dragger[1].parent().width()-mCSB_dragger[1].width(),
						preventX=((dragX-x)>0 && (x-dragX)>-(limitX*d.scrollRatio.x) && (touchIntent[2]*2<touchIntent[3] || o.axis==="yx"));
				}
				if(prevent || preventX){ /* prevent native document scrolling */
					e.preventDefault(); 
					touchDrag=1;
				}else{
					docDrag=1;
					$this.addClass("mCS_touch_action");
				}
				amount=o.axis==="yx" ? [(dragY-y),(dragX-x)] : o.axis==="x" ? [null,(dragX-x)] : [(dragY-y),null];
				mCSB_container[0].idleTimer=250;
				if(d.overflowed[0]){_drag(amount[0],durA,easing,"y","all",true);}
				if(d.overflowed[1]){_drag(amount[1],durA,easing,"x",overwrite,true);}
			}
			function _onTouchstart2(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){touchable=0; return;}
				touchable=1;
				e.stopImmediatePropagation();
				_stop($this);
				startTime=_getTime();
				var offset=mCustomScrollBox.offset();
				touchStartY=_coordinates(e)[0]-offset.top;
				touchStartX=_coordinates(e)[1]-offset.left;
				touchMoveY=[]; touchMoveX=[];
			}
			function _onTouchend(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){return;}
				e.stopImmediatePropagation();
				touchDrag=0; docDrag=0;
				endTime=_getTime();
				var offset=mCustomScrollBox.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
				if((endTime-runningTime)>30){return;}
				speed=1000/(endTime-startTime);
				var easing="mcsEaseOut",slow=speed<2.5,
					diff=slow ? [touchMoveY[touchMoveY.length-2],touchMoveX[touchMoveX.length-2]] : [0,0];
				distance=slow ? [(y-diff[0]),(x-diff[1])] : [y-touchStartY,x-touchStartX];
				var absDistance=[Math.abs(distance[0]),Math.abs(distance[1])];
				speed=slow ? [Math.abs(distance[0]/4),Math.abs(distance[1]/4)] : [speed,speed];
				var a=[
					Math.abs(mCSB_container[0].offsetTop)-(distance[0]*_m((absDistance[0]/speed[0]),speed[0])),
					Math.abs(mCSB_container[0].offsetLeft)-(distance[1]*_m((absDistance[1]/speed[1]),speed[1]))
				];
				amount=o.axis==="yx" ? [a[0],a[1]] : o.axis==="x" ? [null,a[1]] : [a[0],null];
				durB=[(absDistance[0]*4)+o.scrollInertia,(absDistance[1]*4)+o.scrollInertia];
				var md=parseInt(o.contentTouchScroll) || 0; /* absolute minimum distance required */
				amount[0]=absDistance[0]>md ? amount[0] : 0;
				amount[1]=absDistance[1]>md ? amount[1] : 0;
				if(d.overflowed[0]){_drag(amount[0],durB[0],easing,"y",overwrite,false);}
				if(d.overflowed[1]){_drag(amount[1],durB[1],easing,"x",overwrite,false);}
			}
			function _m(ds,s){
				var r=[s*1.5,s*2,s/1.5,s/2];
				if(ds>90){
					return s>4 ? r[0] : r[3];
				}else if(ds>60){
					return s>3 ? r[3] : r[2];
				}else if(ds>30){
					return s>8 ? r[1] : s>6 ? r[0] : s>4 ? s : r[2];
				}else{
					return s>8 ? s : r[3];
				}
			}
			function _drag(amount,dur,easing,dir,overwrite,drag){
				if(!amount){return;}
				_scrollTo($this,amount.toString(),{dur:dur,scrollEasing:easing,dir:dir,overwrite:overwrite,drag:drag});
			}
		},
		/* -------------------- */
		
		
		/* 
		SELECT TEXT EVENTS 
		scrolls content when text is selected 
		*/
		_selectable=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
				namespace=pluginPfx+"_"+d.idx,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				action;
			mCSB_container.bind("mousedown."+namespace,function(e){
				if(touchable){return;}
				if(!action){action=1; touchActive=true;}
			}).add(document).bind("mousemove."+namespace,function(e){
				if(!touchable && action && _sel()){
					var offset=mCSB_container.offset(),
						y=_coordinates(e)[0]-offset.top+mCSB_container[0].offsetTop,x=_coordinates(e)[1]-offset.left+mCSB_container[0].offsetLeft;
					if(y>0 && y<wrapper.height() && x>0 && x<wrapper.width()){
						if(seq.step){_seq("off",null,"stepped");}
					}else{
						if(o.axis!=="x" && d.overflowed[0]){
							if(y<0){
								_seq("on",38);
							}else if(y>wrapper.height()){
								_seq("on",40);
							}
						}
						if(o.axis!=="y" && d.overflowed[1]){
							if(x<0){
								_seq("on",37);
							}else if(x>wrapper.width()){
								_seq("on",39);
							}
						}
					}
				}
			}).bind("mouseup."+namespace,function(e){
				if(touchable){return;}
				if(action){action=0; _seq("off",null);}
				touchActive=false;
			});
			function _sel(){
				return 	window.getSelection ? window.getSelection().toString() : 
						document.selection && document.selection.type!="Control" ? document.selection.createRange().text : 0;
			}
			function _seq(a,c,s){
				seq.type=s && action ? "stepped" : "stepless";
				seq.scrollAmount=10;
				_sequentialScroll($this,a,c,"mcsLinearOut",s ? 60 : null);
			}
		},
		/* -------------------- */
		
		
		/* 
		MOUSE WHEEL EVENT
		scrolls content via mouse-wheel 
		via mouse-wheel plugin (https://github.com/brandonaaron/jquery-mousewheel)
		*/
		_mousewheel=function(){
			if(!$(this).data(pluginPfx)){return;} /* Check if the scrollbar is ready to use mousewheel events (issue: #185) */
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				iframe=$("#mCSB_"+d.idx+"_container").find("iframe");
			if(iframe.length){
				iframe.each(function(){
					$(this).load(function(){
						/* bind events on accessible iframes */
						if(_canAccessIFrame(this)){
							$(this.contentDocument || this.contentWindow.document).bind("mousewheel."+namespace,function(e,delta){
								_onMousewheel(e,delta);
							});
						}
					});
				});
			}
			mCustomScrollBox.bind("mousewheel."+namespace,function(e,delta){
				_onMousewheel(e,delta);
			});
			function _onMousewheel(e,delta){
				_stop($this);
				if(_disableMousewheel($this,e.target)){return;} /* disables mouse-wheel when hovering specific elements */
				var deltaFactor=o.mouseWheel.deltaFactor!=="auto" ? parseInt(o.mouseWheel.deltaFactor) : (oldIE && e.deltaFactor<100) ? 100 : e.deltaFactor || 100;
				if(o.axis==="x" || o.mouseWheel.axis==="x"){
					var dir="x",
						px=[Math.round(deltaFactor*d.scrollRatio.x),parseInt(o.mouseWheel.scrollAmount)],
						amount=o.mouseWheel.scrollAmount!=="auto" ? px[1] : px[0]>=mCustomScrollBox.width() ? mCustomScrollBox.width()*0.9 : px[0],
						contentPos=Math.abs($("#mCSB_"+d.idx+"_container")[0].offsetLeft),
						draggerPos=mCSB_dragger[1][0].offsetLeft,
						limit=mCSB_dragger[1].parent().width()-mCSB_dragger[1].width(),
						dlt=e.deltaX || e.deltaY || delta;
				}else{
					var dir="y",
						px=[Math.round(deltaFactor*d.scrollRatio.y),parseInt(o.mouseWheel.scrollAmount)],
						amount=o.mouseWheel.scrollAmount!=="auto" ? px[1] : px[0]>=mCustomScrollBox.height() ? mCustomScrollBox.height()*0.9 : px[0],
						contentPos=Math.abs($("#mCSB_"+d.idx+"_container")[0].offsetTop),
						draggerPos=mCSB_dragger[0][0].offsetTop,
						limit=mCSB_dragger[0].parent().height()-mCSB_dragger[0].height(),
						dlt=e.deltaY || delta;
				}
				if((dir==="y" && !d.overflowed[0]) || (dir==="x" && !d.overflowed[1])){return;}
				if(o.mouseWheel.invert || e.webkitDirectionInvertedFromDevice){dlt=-dlt;}
				if(o.mouseWheel.normalizeDelta){dlt=dlt<0 ? -1 : 1;}
				if((dlt>0 && draggerPos!==0) || (dlt<0 && draggerPos!==limit) || o.mouseWheel.preventDefault){
					e.stopImmediatePropagation();
					e.preventDefault();
				}
				_scrollTo($this,(contentPos-(dlt*amount)).toString(),{dir:dir});
			}
		},
		/* -------------------- */
		
		
		/* checks if iframe can be accessed */
		_canAccessIFrame=function(iframe){
			var html=null;
			try{
				var doc=iframe.contentDocument || iframe.contentWindow.document;
				html=doc.body.innerHTML;
			}catch(err){/* do nothing */}
			return(html!==null);
		},
		/* -------------------- */
		
		
		/* disables mouse-wheel when hovering specific elements like select, datalist etc. */
		_disableMousewheel=function(el,target){
			var tag=target.nodeName.toLowerCase(),
				tags=el.data(pluginPfx).opt.mouseWheel.disableOver,
				/* elements that require focus */
				focusTags=["select","textarea"];
			return $.inArray(tag,tags) > -1 && !($.inArray(tag,focusTags) > -1 && !$(target).is(":focus"));
		},
		/* -------------------- */
		
		
		/* 
		DRAGGER RAIL CLICK EVENT
		scrolls content via dragger rail 
		*/
		_draggerRail=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				namespace=pluginPfx+"_"+d.idx,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				mCSB_draggerContainer=$(".mCSB_"+d.idx+"_scrollbar ."+classes[12]);
			mCSB_draggerContainer.bind("touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace,function(e){
				touchActive=true;
			}).bind("touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace,function(e){
				touchActive=false;
			}).bind("click."+namespace,function(e){
				if($(e.target).hasClass(classes[12]) || $(e.target).hasClass("mCSB_draggerRail")){
					_stop($this);
					var el=$(this),mCSB_dragger=el.find(".mCSB_dragger");
					if(el.parent(".mCSB_scrollTools_horizontal").length>0){
						if(!d.overflowed[1]){return;}
						var dir="x",
							clickDir=e.pageX>mCSB_dragger.offset().left ? -1 : 1,
							to=Math.abs(mCSB_container[0].offsetLeft)-(clickDir*(wrapper.width()*0.9));
					}else{
						if(!d.overflowed[0]){return;}
						var dir="y",
							clickDir=e.pageY>mCSB_dragger.offset().top ? -1 : 1,
							to=Math.abs(mCSB_container[0].offsetTop)-(clickDir*(wrapper.height()*0.9));
					}
					_scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
				}
			});
		},
		/* -------------------- */
		
		
		/* 
		FOCUS EVENT
		scrolls content via element focus (e.g. clicking an input, pressing TAB key etc.)
		*/
		_focus=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent();
			mCSB_container.bind("focusin."+namespace,function(e){
				var el=$(document.activeElement),
					nested=mCSB_container.find(".mCustomScrollBox").length,
					dur=0;
				if(!el.is(o.advanced.autoScrollOnFocus)){return;}
				_stop($this);
				clearTimeout($this[0]._focusTimeout);
				$this[0]._focusTimer=nested ? (dur+17)*nested : 0;
				$this[0]._focusTimeout=setTimeout(function(){
					var	to=[_childPos(el)[0],_childPos(el)[1]],
						contentPos=[mCSB_container[0].offsetTop,mCSB_container[0].offsetLeft],
						isVisible=[
							(contentPos[0]+to[0]>=0 && contentPos[0]+to[0]<wrapper.height()-el.outerHeight(false)),
							(contentPos[1]+to[1]>=0 && contentPos[0]+to[1]<wrapper.width()-el.outerWidth(false))
						],
						overwrite=(o.axis==="yx" && !isVisible[0] && !isVisible[1]) ? "none" : "all";
					if(o.axis!=="x" && !isVisible[0]){
						_scrollTo($this,to[0].toString(),{dir:"y",scrollEasing:"mcsEaseInOut",overwrite:overwrite,dur:dur});
					}
					if(o.axis!=="y" && !isVisible[1]){
						_scrollTo($this,to[1].toString(),{dir:"x",scrollEasing:"mcsEaseInOut",overwrite:overwrite,dur:dur});
					}
				},$this[0]._focusTimer);
			});
		},
		/* -------------------- */
		
		
		/* sets content wrapper scrollTop/scrollLeft always to 0 */
		_wrapperScroll=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				namespace=pluginPfx+"_"+d.idx,
				wrapper=$("#mCSB_"+d.idx+"_container").parent();
			wrapper.bind("scroll."+namespace,function(e){
				if(wrapper.scrollTop()!==0 || wrapper.scrollLeft()!==0){
					$(".mCSB_"+d.idx+"_scrollbar").css("visibility","hidden"); /* hide scrollbar(s) */
				}
			});
		},
		/* -------------------- */
		
		
		/* 
		BUTTONS EVENTS
		scrolls content via up, down, left and right buttons 
		*/
		_buttons=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
				namespace=pluginPfx+"_"+d.idx,
				sel=".mCSB_"+d.idx+"_scrollbar",
				btn=$(sel+">a");
			btn.bind("mousedown."+namespace+" touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace+" mouseup."+namespace+" touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace+" mouseout."+namespace+" pointerout."+namespace+" MSPointerOut."+namespace+" click."+namespace,function(e){
				e.preventDefault();
				if(!_mouseBtnLeft(e)){return;} /* left mouse button only */
				var btnClass=$(this).attr("class");
				seq.type=o.scrollButtons.scrollType;
				switch(e.type){
					case "mousedown": case "touchstart": case "pointerdown": case "MSPointerDown":
						if(seq.type==="stepped"){return;}
						touchActive=true;
						d.tweenRunning=false;
						_seq("on",btnClass);
						break;
					case "mouseup": case "touchend": case "pointerup": case "MSPointerUp":
					case "mouseout": case "pointerout": case "MSPointerOut":
						if(seq.type==="stepped"){return;}
						touchActive=false;
						if(seq.dir){_seq("off",btnClass);}
						break;
					case "click":
						if(seq.type!=="stepped" || d.tweenRunning){return;}
						_seq("on",btnClass);
						break;
				}
				function _seq(a,c){
					seq.scrollAmount=o.snapAmount || o.scrollButtons.scrollAmount;
					_sequentialScroll($this,a,c);
				}
			});
		},
		/* -------------------- */
		
		
		/* 
		KEYBOARD EVENTS
		scrolls content via keyboard 
		Keys: up arrow, down arrow, left arrow, right arrow, PgUp, PgDn, Home, End
		*/
		_keyboard=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
				namespace=pluginPfx+"_"+d.idx,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				editables="input,textarea,select,datalist,keygen,[contenteditable='true']",
				iframe=mCSB_container.find("iframe"),
				events=["blur."+namespace+" keydown."+namespace+" keyup."+namespace];
			if(iframe.length){
				iframe.each(function(){
					$(this).load(function(){
						/* bind events on accessible iframes */
						if(_canAccessIFrame(this)){
							$(this.contentDocument || this.contentWindow.document).bind(events[0],function(e){
								_onKeyboard(e);
							});
						}
					});
				});
			}
			mCustomScrollBox.attr("tabindex","0").bind(events[0],function(e){
				_onKeyboard(e);
			});
			function _onKeyboard(e){
				switch(e.type){
					case "blur":
						if(d.tweenRunning && seq.dir){_seq("off",null);}
						break;
					case "keydown": case "keyup":
						var code=e.keyCode ? e.keyCode : e.which,action="on";
						if((o.axis!=="x" && (code===38 || code===40)) || (o.axis!=="y" && (code===37 || code===39))){
							/* up (38), down (40), left (37), right (39) arrows */
							if(((code===38 || code===40) && !d.overflowed[0]) || ((code===37 || code===39) && !d.overflowed[1])){return;}
							if(e.type==="keyup"){action="off";}
							if(!$(document.activeElement).is(editables)){
								e.preventDefault();
								e.stopImmediatePropagation();
								_seq(action,code);
							}
						}else if(code===33 || code===34){
							/* PgUp (33), PgDn (34) */
							if(d.overflowed[0] || d.overflowed[1]){
								e.preventDefault();
								e.stopImmediatePropagation();
							}
							if(e.type==="keyup"){
								_stop($this);
								var keyboardDir=code===34 ? -1 : 1;
								if(o.axis==="x" || (o.axis==="yx" && d.overflowed[1] && !d.overflowed[0])){
									var dir="x",to=Math.abs(mCSB_container[0].offsetLeft)-(keyboardDir*(wrapper.width()*0.9));
								}else{
									var dir="y",to=Math.abs(mCSB_container[0].offsetTop)-(keyboardDir*(wrapper.height()*0.9));
								}
								_scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
							}
						}else if(code===35 || code===36){
							/* End (35), Home (36) */
							if(!$(document.activeElement).is(editables)){
								if(d.overflowed[0] || d.overflowed[1]){
									e.preventDefault();
									e.stopImmediatePropagation();
								}
								if(e.type==="keyup"){
									if(o.axis==="x" || (o.axis==="yx" && d.overflowed[1] && !d.overflowed[0])){
										var dir="x",to=code===35 ? Math.abs(wrapper.width()-mCSB_container.outerWidth(false)) : 0;
									}else{
										var dir="y",to=code===35 ? Math.abs(wrapper.height()-mCSB_container.outerHeight(false)) : 0;
									}
									_scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
								}
							}
						}
						break;
				}
				function _seq(a,c){
					seq.type=o.keyboard.scrollType;
					seq.scrollAmount=o.snapAmount || o.keyboard.scrollAmount;
					if(seq.type==="stepped" && d.tweenRunning){return;}
					_sequentialScroll($this,a,c);
				}
			}
		},
		/* -------------------- */
		
		
		/* scrolls content sequentially (used when scrolling via buttons, keyboard arrows etc.) */
		_sequentialScroll=function(el,action,trigger,e,s){
			var d=el.data(pluginPfx),o=d.opt,seq=d.sequential,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				once=seq.type==="stepped" ? true : false,
				steplessSpeed=o.scrollInertia < 26 ? 26 : o.scrollInertia, /* 26/1.5=17 */
				steppedSpeed=o.scrollInertia < 1 ? 17 : o.scrollInertia;
			switch(action){
				case "on":
					seq.dir=[
						(trigger===classes[16] || trigger===classes[15] || trigger===39 || trigger===37 ? "x" : "y"),
						(trigger===classes[13] || trigger===classes[15] || trigger===38 || trigger===37 ? -1 : 1)
					];
					_stop(el);
					if(_isNumeric(trigger) && seq.type==="stepped"){return;}
					_on(once);
					break;
				case "off":
					_off();
					if(once || (d.tweenRunning && seq.dir)){
						_on(true);
					}
					break;
			}
			/* starts sequence */
			function _on(once){
				var c=seq.type!=="stepped", /* continuous scrolling */
					t=s ? s : !once ? 1000/60 : c ? steplessSpeed/1.5 : steppedSpeed, /* timer */
					m=!once ? 2.5 : c ? 7.5 : 40, /* multiplier */
					contentPos=[Math.abs(mCSB_container[0].offsetTop),Math.abs(mCSB_container[0].offsetLeft)],
					ratio=[d.scrollRatio.y>10 ? 10 : d.scrollRatio.y,d.scrollRatio.x>10 ? 10 : d.scrollRatio.x],
					amount=seq.dir[0]==="x" ? contentPos[1]+(seq.dir[1]*(ratio[1]*m)) : contentPos[0]+(seq.dir[1]*(ratio[0]*m)),
					px=seq.dir[0]==="x" ? contentPos[1]+(seq.dir[1]*parseInt(seq.scrollAmount)) : contentPos[0]+(seq.dir[1]*parseInt(seq.scrollAmount)),
					to=seq.scrollAmount!=="auto" ? px : amount,
					easing=e ? e : !once ? "mcsLinear" : c ? "mcsLinearOut" : "mcsEaseInOut",
					onComplete=!once ? false : true;
				if(once && t<17){
					to=seq.dir[0]==="x" ? contentPos[1] : contentPos[0];
				}
				_scrollTo(el,to.toString(),{dir:seq.dir[0],scrollEasing:easing,dur:t,onComplete:onComplete});
				if(once){
					seq.dir=false;
					return;
				}
				clearTimeout(seq.step);
				seq.step=setTimeout(function(){
					_on();
				},t);
			}
			/* stops sequence */
			function _off(){
				clearTimeout(seq.step);
				_delete(seq,"step");
				_stop(el);
			}
		},
		/* -------------------- */
		
		
		/* returns a yx array from value */
		_arr=function(val){
			var o=$(this).data(pluginPfx).opt,vals=[];
			if(typeof val==="function"){val=val();} /* check if the value is a single anonymous function */
			/* check if value is object or array, its length and create an array with yx values */
			if(!(val instanceof Array)){ /* object value (e.g. {y:"100",x:"100"}, 100 etc.) */
				vals[0]=val.y ? val.y : val.x || o.axis==="x" ? null : val;
				vals[1]=val.x ? val.x : val.y || o.axis==="y" ? null : val;
			}else{ /* array value (e.g. [100,100]) */
				vals=val.length>1 ? [val[0],val[1]] : o.axis==="x" ? [null,val[0]] : [val[0],null];
			}
			/* check if array values are anonymous functions */
			if(typeof vals[0]==="function"){vals[0]=vals[0]();}
			if(typeof vals[1]==="function"){vals[1]=vals[1]();}
			return vals;
		},
		/* -------------------- */
		
		
		/* translates values (e.g. "top", 100, "100px", "#id") to actual scroll-to positions */
		_to=function(val,dir){
			if(val==null || typeof val=="undefined"){return;}
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				t=typeof val;
			if(!dir){dir=o.axis==="x" ? "x" : "y";}
			var contentLength=dir==="x" ? mCSB_container.outerWidth(false) : mCSB_container.outerHeight(false),
				contentPos=dir==="x" ? mCSB_container[0].offsetLeft : mCSB_container[0].offsetTop,
				cssProp=dir==="x" ? "left" : "top";
			switch(t){
				case "function": /* this currently is not used. Consider removing it */
					return val();
					break;
				case "object": /* js/jquery object */
					var obj=val.jquery ? val : $(val);
					if(!obj.length){return;}
					return dir==="x" ? _childPos(obj)[1] : _childPos(obj)[0];
					break;
				case "string": case "number":
					if(_isNumeric(val)){ /* numeric value */
						return Math.abs(val);
					}else if(val.indexOf("%")!==-1){ /* percentage value */
						return Math.abs(contentLength*parseInt(val)/100);
					}else if(val.indexOf("-=")!==-1){ /* decrease value */
						return Math.abs(contentPos-parseInt(val.split("-=")[1]));
					}else if(val.indexOf("+=")!==-1){ /* inrease value */
						var p=(contentPos+parseInt(val.split("+=")[1]));
						return p>=0 ? 0 : Math.abs(p);
					}else if(val.indexOf("px")!==-1 && _isNumeric(val.split("px")[0])){ /* pixels string value (e.g. "100px") */
						return Math.abs(val.split("px")[0]);
					}else{
						if(val==="top" || val==="left"){ /* special strings */
							return 0;
						}else if(val==="bottom"){
							return Math.abs(wrapper.height()-mCSB_container.outerHeight(false));
						}else if(val==="right"){
							return Math.abs(wrapper.width()-mCSB_container.outerWidth(false));
						}else if(val==="first" || val==="last"){
							var obj=mCSB_container.find(":"+val);
							return dir==="x" ? _childPos(obj)[1] : _childPos(obj)[0];
						}else{
							if($(val).length){ /* jquery selector */
								return dir==="x" ? _childPos($(val))[1] : _childPos($(val))[0];
							}else{ /* other values (e.g. "100em") */
								mCSB_container.css(cssProp,val);
								methods.update.call(null,$this[0]);
								return;
							}
						}
					}
					break;
			}
		},
		/* -------------------- */
		
		
		/* calls the update method automatically */
		_autoUpdate=function(rem){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(rem){
				/* 
				removes autoUpdate timer 
				usage: _autoUpdate.call(this,"remove");
				*/
				clearTimeout(mCSB_container[0].autoUpdate);
				_delete(mCSB_container[0],"autoUpdate");
				return;
			}
			var	wrapper=mCSB_container.parent(),
				scrollbar=[$("#mCSB_"+d.idx+"_scrollbar_vertical"),$("#mCSB_"+d.idx+"_scrollbar_horizontal")],
				scrollbarSize=function(){return [
					scrollbar[0].is(":visible") ? scrollbar[0].outerHeight(true) : 0, /* returns y-scrollbar height */
					scrollbar[1].is(":visible") ? scrollbar[1].outerWidth(true) : 0 /* returns x-scrollbar width */
				]},
				oldSelSize=sizesSum(),newSelSize,
				os=[mCSB_container.outerHeight(false),mCSB_container.outerWidth(false),wrapper.height(),wrapper.width(),scrollbarSize()[0],scrollbarSize()[1]],ns,
				oldImgsLen=imgSum(),newImgsLen;
			upd();
			function upd(){
				clearTimeout(mCSB_container[0].autoUpdate);
				if($this.parents("html").length===0){
					/* check element in dom tree */
					$this=null;
					return;
				}
				mCSB_container[0].autoUpdate=setTimeout(function(){
					/* update on specific selector(s) length and size change */
					if(o.advanced.updateOnSelectorChange){
						newSelSize=sizesSum();
						if(newSelSize!==oldSelSize){
							doUpd(3);
							oldSelSize=newSelSize;
							return;
						}
					}
					/* update on main element and scrollbar size changes */
					if(o.advanced.updateOnContentResize){
						ns=[mCSB_container.outerHeight(false),mCSB_container.outerWidth(false),wrapper.height(),wrapper.width(),scrollbarSize()[0],scrollbarSize()[1]];
						if(ns[0]!==os[0] || ns[1]!==os[1] || ns[2]!==os[2] || ns[3]!==os[3] || ns[4]!==os[4] || ns[5]!==os[5]){
							doUpd(ns[0]!==os[0] || ns[1]!==os[1]);
							os=ns;
						}
					}
					/* update on image load */
					if(o.advanced.updateOnImageLoad){
						newImgsLen=imgSum();
						if(newImgsLen!==oldImgsLen){
							mCSB_container.find("img").each(function(){
								imgLoader(this);
							});
							oldImgsLen=newImgsLen;
						}
					}
					if(o.advanced.updateOnSelectorChange || o.advanced.updateOnContentResize || o.advanced.updateOnImageLoad){upd();}
				},o.advanced.autoUpdateTimeout);
			}
			/* returns images amount */
			function imgSum(){
				var total=0
				if(o.advanced.updateOnImageLoad){total=mCSB_container.find("img").length;}
				return total;
			}
			/* a tiny image loader */
			function imgLoader(el){
				if($(el).hasClass(classes[2])){doUpd(); return;}
				var img=new Image();
				function createDelegate(contextObject,delegateMethod){
					return function(){return delegateMethod.apply(contextObject,arguments);}
				}
				function imgOnLoad(){
					this.onload=null;
					$(el).addClass(classes[2]);
					doUpd(2);
				}
				img.onload=createDelegate(img,imgOnLoad);
				img.src=el.src;
			}
			/* returns the total height and width sum of all elements matching the selector */
			function sizesSum(){
				if(o.advanced.updateOnSelectorChange===true){o.advanced.updateOnSelectorChange="*";}
				var total=0,sel=mCSB_container.find(o.advanced.updateOnSelectorChange);
				if(o.advanced.updateOnSelectorChange && sel.length>0){sel.each(function(){total+=$(this).height()+$(this).width();});}
				return total;
			}
			/* calls the update method */
			function doUpd(cb){
				clearTimeout(mCSB_container[0].autoUpdate); 
				methods.update.call(null,$this[0],cb);
			}
		},
		/* -------------------- */
		
		
		/* snaps scrolling to a multiple of a pixels number */
		_snapAmount=function(to,amount,offset){
			return (Math.round(to/amount)*amount-offset); 
		},
		/* -------------------- */
		
		
		/* stops content and scrollbar animations */
		_stop=function(el){
			var d=el.data(pluginPfx),
				sel=$("#mCSB_"+d.idx+"_container,#mCSB_"+d.idx+"_container_wrapper,#mCSB_"+d.idx+"_dragger_vertical,#mCSB_"+d.idx+"_dragger_horizontal");
			sel.each(function(){
				_stopTween.call(this);
			});
		},
		/* -------------------- */
		
		
		/* 
		ANIMATES CONTENT 
		This is where the actual scrolling happens
		*/
		_scrollTo=function(el,to,options){
			var d=el.data(pluginPfx),o=d.opt,
				defaults={
					trigger:"internal",
					dir:"y",
					scrollEasing:"mcsEaseOut",
					drag:false,
					dur:o.scrollInertia,
					overwrite:"all",
					callbacks:true,
					onStart:true,
					onUpdate:true,
					onComplete:true
				},
				options=$.extend(defaults,options),
				dur=[options.dur,(options.drag ? 0 : options.dur)],
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				totalScrollOffsets=o.callbacks.onTotalScrollOffset ? _arr.call(el,o.callbacks.onTotalScrollOffset) : [0,0],
				totalScrollBackOffsets=o.callbacks.onTotalScrollBackOffset ? _arr.call(el,o.callbacks.onTotalScrollBackOffset) : [0,0];
			d.trigger=options.trigger;
			if(wrapper.scrollTop()!==0 || wrapper.scrollLeft()!==0){ /* always reset scrollTop/Left */
				$(".mCSB_"+d.idx+"_scrollbar").css("visibility","visible");
				wrapper.scrollTop(0).scrollLeft(0);
			}
			if(to==="_resetY" && !d.contentReset.y){
				/* callbacks: onOverflowYNone */
				if(_cb("onOverflowYNone")){o.callbacks.onOverflowYNone.call(el[0]);}
				d.contentReset.y=1;
			}
			if(to==="_resetX" && !d.contentReset.x){
				/* callbacks: onOverflowXNone */
				if(_cb("onOverflowXNone")){o.callbacks.onOverflowXNone.call(el[0]);}
				d.contentReset.x=1;
			}
			if(to==="_resetY" || to==="_resetX"){return;}
			if((d.contentReset.y || !el[0].mcs) && d.overflowed[0]){
				/* callbacks: onOverflowY */
				if(_cb("onOverflowY")){o.callbacks.onOverflowY.call(el[0]);}
				d.contentReset.x=null;
			}
			if((d.contentReset.x || !el[0].mcs) && d.overflowed[1]){
				/* callbacks: onOverflowX */
				if(_cb("onOverflowX")){o.callbacks.onOverflowX.call(el[0]);}
				d.contentReset.x=null;
			}
			if(o.snapAmount){to=_snapAmount(to,o.snapAmount,o.snapOffset);} /* scrolling snapping */
			switch(options.dir){
				case "x":
					var mCSB_dragger=$("#mCSB_"+d.idx+"_dragger_horizontal"),
						property="left",
						contentPos=mCSB_container[0].offsetLeft,
						limit=[
							mCustomScrollBox.width()-mCSB_container.outerWidth(false),
							mCSB_dragger.parent().width()-mCSB_dragger.width()
						],
						scrollTo=[to,to===0 ? 0 : (to/d.scrollRatio.x)],
						tso=totalScrollOffsets[1],
						tsbo=totalScrollBackOffsets[1],
						totalScrollOffset=tso>0 ? tso/d.scrollRatio.x : 0,
						totalScrollBackOffset=tsbo>0 ? tsbo/d.scrollRatio.x : 0;
					break;
				case "y":
					var mCSB_dragger=$("#mCSB_"+d.idx+"_dragger_vertical"),
						property="top",
						contentPos=mCSB_container[0].offsetTop,
						limit=[
							mCustomScrollBox.height()-mCSB_container.outerHeight(false),
							mCSB_dragger.parent().height()-mCSB_dragger.height()
						],
						scrollTo=[to,to===0 ? 0 : (to/d.scrollRatio.y)],
						tso=totalScrollOffsets[0],
						tsbo=totalScrollBackOffsets[0],
						totalScrollOffset=tso>0 ? tso/d.scrollRatio.y : 0,
						totalScrollBackOffset=tsbo>0 ? tsbo/d.scrollRatio.y : 0;
					break;
			}
			if(scrollTo[1]<0 || (scrollTo[0]===0 && scrollTo[1]===0)){
				scrollTo=[0,0];
			}else if(scrollTo[1]>=limit[1]){
				scrollTo=[limit[0],limit[1]];
			}else{
				scrollTo[0]=-scrollTo[0];
			}
			if(!el[0].mcs){
				_mcs();  /* init mcs object (once) to make it available before callbacks */
				if(_cb("onInit")){o.callbacks.onInit.call(el[0]);} /* callbacks: onInit */
			}
			clearTimeout(mCSB_container[0].onCompleteTimeout);
			if(!d.tweenRunning && ((contentPos===0 && scrollTo[0]>=0) || (contentPos===limit[0] && scrollTo[0]<=limit[0]))){return;}
			_tweenTo(mCSB_dragger[0],property,Math.round(scrollTo[1]),dur[1],options.scrollEasing);
			_tweenTo(mCSB_container[0],property,Math.round(scrollTo[0]),dur[0],options.scrollEasing,options.overwrite,{
				onStart:function(){
					if(options.callbacks && options.onStart && !d.tweenRunning){
						/* callbacks: onScrollStart */
						if(_cb("onScrollStart")){_mcs(); o.callbacks.onScrollStart.call(el[0]);}
						d.tweenRunning=true;
						_onDragClasses(mCSB_dragger);
						d.cbOffsets=_cbOffsets();
					}
				},onUpdate:function(){
					if(options.callbacks && options.onUpdate){
						/* callbacks: whileScrolling */
						if(_cb("whileScrolling")){_mcs(); o.callbacks.whileScrolling.call(el[0]);}
					}
				},onComplete:function(){
					if(options.callbacks && options.onComplete){
						if(o.axis==="yx"){clearTimeout(mCSB_container[0].onCompleteTimeout);}
						var t=mCSB_container[0].idleTimer || 0;
						mCSB_container[0].onCompleteTimeout=setTimeout(function(){
							/* callbacks: onScroll, onTotalScroll, onTotalScrollBack */
							if(_cb("onScroll")){_mcs(); o.callbacks.onScroll.call(el[0]);}
							if(_cb("onTotalScroll") && scrollTo[1]>=limit[1]-totalScrollOffset && d.cbOffsets[0]){_mcs(); o.callbacks.onTotalScroll.call(el[0]);}
							if(_cb("onTotalScrollBack") && scrollTo[1]<=totalScrollBackOffset && d.cbOffsets[1]){_mcs(); o.callbacks.onTotalScrollBack.call(el[0]);}
							d.tweenRunning=false;
							mCSB_container[0].idleTimer=0;
							_onDragClasses(mCSB_dragger,"hide");
						},t);
					}
				}
			});
			/* checks if callback function exists */
			function _cb(cb){
				return d && o.callbacks[cb] && typeof o.callbacks[cb]==="function";
			}
			/* checks whether callback offsets always trigger */
			function _cbOffsets(){
				return [o.callbacks.alwaysTriggerOffsets || contentPos>=limit[0]+tso,o.callbacks.alwaysTriggerOffsets || contentPos<=-tsbo];
			}
			/* 
			populates object with useful values for the user 
			values: 
				content: this.mcs.content
				content top position: this.mcs.top 
				content left position: this.mcs.left 
				dragger top position: this.mcs.draggerTop 
				dragger left position: this.mcs.draggerLeft 
				scrolling y percentage: this.mcs.topPct 
				scrolling x percentage: this.mcs.leftPct 
				scrolling direction: this.mcs.direction
			*/
			function _mcs(){
				var cp=[mCSB_container[0].offsetTop,mCSB_container[0].offsetLeft], /* content position */
					dp=[mCSB_dragger[0].offsetTop,mCSB_dragger[0].offsetLeft], /* dragger position */
					cl=[mCSB_container.outerHeight(false),mCSB_container.outerWidth(false)], /* content length */
					pl=[mCustomScrollBox.height(),mCustomScrollBox.width()]; /* content parent length */
				el[0].mcs={
					content:mCSB_container, /* original content wrapper as jquery object */
					top:cp[0],left:cp[1],draggerTop:dp[0],draggerLeft:dp[1],
					topPct:Math.round((100*Math.abs(cp[0]))/(Math.abs(cl[0])-pl[0])),leftPct:Math.round((100*Math.abs(cp[1]))/(Math.abs(cl[1])-pl[1])),
					direction:options.dir
				};
				/* 
				this refers to the original element containing the scrollbar(s)
				usage: this.mcs.top, this.mcs.leftPct etc. 
				*/
			}
		},
		/* -------------------- */
		
		
		/* 
		CUSTOM JAVASCRIPT ANIMATION TWEEN 
		Lighter and faster than jquery animate() and css transitions 
		Animates top/left properties and includes easings 
		*/
		_tweenTo=function(el,prop,to,duration,easing,overwrite,callbacks){
			if(!el._mTween){el._mTween={top:{},left:{}};}
			var callbacks=callbacks || {},
				onStart=callbacks.onStart || function(){},onUpdate=callbacks.onUpdate || function(){},onComplete=callbacks.onComplete || function(){},
				startTime=_getTime(),_delay,progress=0,from=el.offsetTop,elStyle=el.style,_request,tobj=el._mTween[prop];
			if(prop==="left"){from=el.offsetLeft;}
			var diff=to-from;
			tobj.stop=0;
			if(overwrite!=="none"){_cancelTween();}
			_startTween();
			function _step(){
				if(tobj.stop){return;}
				if(!progress){onStart.call();}
				progress=_getTime()-startTime;
				_tween();
				if(progress>=tobj.time){
					tobj.time=(progress>tobj.time) ? progress+_delay-(progress-tobj.time) : progress+_delay-1;
					if(tobj.time<progress+1){tobj.time=progress+1;}
				}
				if(tobj.time<duration){tobj.id=_request(_step);}else{onComplete.call();}
			}
			function _tween(){
				if(duration>0){
					tobj.currVal=_ease(tobj.time,from,diff,duration,easing);
					elStyle[prop]=Math.round(tobj.currVal)+"px";
				}else{
					elStyle[prop]=to+"px";
				}
				onUpdate.call();
			}
			function _startTween(){
				_delay=1000/60;
				tobj.time=progress+_delay;
				_request=(!window.requestAnimationFrame) ? function(f){_tween(); return setTimeout(f,0.01);} : window.requestAnimationFrame;
				tobj.id=_request(_step);
			}
			function _cancelTween(){
				if(tobj.id==null){return;}
				if(!window.requestAnimationFrame){clearTimeout(tobj.id);
				}else{window.cancelAnimationFrame(tobj.id);}
				tobj.id=null;
			}
			function _ease(t,b,c,d,type){
				switch(type){
					case "linear": case "mcsLinear":
						return c*t/d + b;
						break;
					case "mcsLinearOut":
						t/=d; t--; return c * Math.sqrt(1 - t*t) + b;
						break;
					case "easeInOutSmooth":
						t/=d/2;
						if(t<1) return c/2*t*t + b;
						t--;
						return -c/2 * (t*(t-2) - 1) + b;
						break;
					case "easeInOutStrong":
						t/=d/2;
						if(t<1) return c/2 * Math.pow( 2, 10 * (t - 1) ) + b;
						t--;
						return c/2 * ( -Math.pow( 2, -10 * t) + 2 ) + b;
						break;
					case "easeInOut": case "mcsEaseInOut":
						t/=d/2;
						if(t<1) return c/2*t*t*t + b;
						t-=2;
						return c/2*(t*t*t + 2) + b;
						break;
					case "easeOutSmooth":
						t/=d; t--;
						return -c * (t*t*t*t - 1) + b;
						break;
					case "easeOutStrong":
						return c * ( -Math.pow( 2, -10 * t/d ) + 1 ) + b;
						break;
					case "easeOut": case "mcsEaseOut": default:
						var ts=(t/=d)*t,tc=ts*t;
						return b+c*(0.499999999999997*tc*ts + -2.5*ts*ts + 5.5*tc + -6.5*ts + 4*t);
				}
			}
		},
		/* -------------------- */
		
		
		/* returns current time */
		_getTime=function(){
			if(window.performance && window.performance.now){
				return window.performance.now();
			}else{
				if(window.performance && window.performance.webkitNow){
					return window.performance.webkitNow();
				}else{
					if(Date.now){return Date.now();}else{return new Date().getTime();}
				}
			}
		},
		/* -------------------- */
		
		
		/* stops a tween */
		_stopTween=function(){
			var el=this;
			if(!el._mTween){el._mTween={top:{},left:{}};}
			var props=["top","left"];
			for(var i=0; i<props.length; i++){
				var prop=props[i];
				if(el._mTween[prop].id){
					if(!window.requestAnimationFrame){clearTimeout(el._mTween[prop].id);
					}else{window.cancelAnimationFrame(el._mTween[prop].id);}
					el._mTween[prop].id=null;
					el._mTween[prop].stop=1;
				}
			}
		},
		/* -------------------- */
		
		
		/* deletes a property (avoiding the exception thrown by IE) */
		_delete=function(c,m){
			try{delete c[m];}catch(e){c[m]=null;}
		},
		/* -------------------- */
		
		
		/* detects left mouse button */
		_mouseBtnLeft=function(e){
			return !(e.which && e.which!==1);
		},
		/* -------------------- */
		
		
		/* detects if pointer type event is touch */
		_pointerTouch=function(e){
			var t=e.originalEvent.pointerType;
			return !(t && t!=="touch" && t!==2);
		},
		/* -------------------- */
		
		
		/* checks if value is numeric */
		_isNumeric=function(val){
			return !isNaN(parseFloat(val)) && isFinite(val);
		},
		/* -------------------- */
		
		
		/* returns element position according to content */
		_childPos=function(el){
			var p=el.parents(".mCSB_container");
			return [el.offset().top-p.offset().top,el.offset().left-p.offset().left];
		};
		/* -------------------- */
		
	
	
	
	
	/* 
	----------------------------------------
	PLUGIN SETUP 
	----------------------------------------
	*/
	
	/* plugin constructor functions */
	$.fn[pluginNS]=function(method){ /* usage: $(selector).mCustomScrollbar(); */
		if(methods[method]){
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
		}else if(typeof method==="object" || !method){
			return methods.init.apply(this,arguments);
		}else{
			$.error("Method "+method+" does not exist");
		}
	};
	$[pluginNS]=function(method){ /* usage: $.mCustomScrollbar(); */
		if(methods[method]){
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
		}else if(typeof method==="object" || !method){
			return methods.init.apply(this,arguments);
		}else{
			$.error("Method "+method+" does not exist");
		}
	};
	
	/* 
	allow setting plugin default options. 
	usage: $.mCustomScrollbar.defaults.scrollInertia=500; 
	to apply any changed default options on default selectors (below), use inside document ready fn 
	e.g.: $(document).ready(function(){ $.mCustomScrollbar.defaults.scrollInertia=500; });
	*/
	$[pluginNS].defaults=defaults;
	
	/* 
	add window object (window.mCustomScrollbar) 
	usage: if(window.mCustomScrollbar){console.log("custom scrollbar plugin loaded");}
	*/
	window[pluginNS]=true;
	
	$(window).load(function(){
		
		$(defaultSelector)[pluginNS](); /* add scrollbars automatically on default selector */
		
		/* extend jQuery expressions */
		$.extend($.expr[":"],{
			/* checks if element is within scrollable viewport */
			mcsInView:$.expr[":"].mcsInView || function(el){
				var $el=$(el),content=$el.parents(".mCSB_container"),wrapper,cPos;
				if(!content.length){return;}
				wrapper=content.parent();
				cPos=[content[0].offsetTop,content[0].offsetLeft];
				return 	cPos[0]+_childPos($el)[0]>=0 && cPos[0]+_childPos($el)[0]<wrapper.height()-$el.outerHeight(false) && 
						cPos[1]+_childPos($el)[1]>=0 && cPos[1]+_childPos($el)[1]<wrapper.width()-$el.outerWidth(false);
			},
			/* checks if element is overflowed having visible scrollbar(s) */
			mcsOverflow:$.expr[":"].mcsOverflow || function(el){
				var d=$(el).data(pluginPfx);
				if(!d){return;}
				return d.overflowed[0] || d.overflowed[1];
			}
		});
	
	});

}))}));

/*!
 * jquery.customSelect() - v0.4.1
 * http://adam.co/lab/jquery/customselect/
 * 2013-05-13
 *
 * Copyright 2013 Adam Coulombe
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @license http://www.gnu.org/licenses/gpl.html GPL2 License
 */
jQuery(document).ready(function(a) {a.fn.extend({customSelect:function(c){if(typeof document.body.style.maxHeight==="undefined"){return this}var e={customClass:"customSelect",mapClass:true,mapStyle:true},c=a.extend(e,c),d=c.customClass,f=function(h,k){var g=h.find(":selected"),j=k.children(":first"),i=g.html()||"&nbsp;";j.html(i);if(g.attr("disabled")){k.addClass(b("DisabledOption"))}else{k.removeClass(b("DisabledOption"))}setTimeout(function(){k.removeClass(b("Open"));a(document).off("mouseup."+b("Open"))},60)},b=function(g){return d+g};return this.each(function(){var g=a(this),i=a("<span />").addClass(b("Inner")),h=a("<span />");g.after(h.append(i));h.addClass(d);if(c.mapClass){h.addClass(g.attr("class"))}if(c.mapStyle){h.attr("style",g.attr("style"))}g.addClass("hasCustomSelect").on("update",function(){f(g,h);var k=parseInt(g.outerWidth(),10)-(parseInt(h.outerWidth(),10)-parseInt(h.width(),10));h.css({display:"inline-block"});var j=h.outerHeight();if(g.attr("disabled")){h.addClass(b("Disabled"))}else{h.removeClass(b("Disabled"))}i.css({width:k,display:"inline-block"});g.css({"-webkit-appearance":"menulist-button",width:h.outerWidth(),position:"absolute",opacity:0,height:j,fontSize:h.css("font-size")})}).on("change",function(){h.addClass(b("Changed"));f(g,h)}).on("keyup",function(j){if(!h.hasClass(b("Open"))){g.blur();g.focus()}else{if(j.which==13||j.which==27){f(g,h)}}}).on("mousedown",function(j){h.removeClass(b("Changed"))}).on("mouseup",function(j){if(!h.hasClass(b("Open"))){if(a("."+b("Open")).not(h).length>0&&typeof InstallTrigger!=="undefined"){g.focus()}else{h.addClass(b("Open"));j.stopPropagation();a(document).one("mouseup."+b("Open"),function(k){if(k.target!=g.get(0)&&a.inArray(k.target,g.find("*").get())<0){g.blur()}else{f(g,h)}})}}}).focus(function(){h.removeClass(b("Changed")).addClass(b("Focus"))}).blur(function(){h.removeClass(b("Focus")+" "+b("Open"))}).hover(function(){h.addClass(b("Hover"))},function(){h.removeClass(b("Hover"))}).trigger("update")})}})});


/*3D slideshow*/
 jQuery(document).ready(function($){
	 
	 /* #Check if element exists
================================================== */
	$.fn.exists = function() {
		if ($(this).length > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* !- Check if element is loaded */
	$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len	= this.length;
		if (len > 0) {
			return this.each(function() {
				var	el		= this,
					$el		= $(el),
					blank	= "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};
	
	var $body = $("body"),
		$mainSlider = $('#main-slideshow'),
		$3DSlider = $('.three-d-slider'),
		adminH = $('#wpadminbar').height(),
		header = $('.masthead:not(.side-header):not(.side-header-v-stroke)').height();
		
	if($body.hasClass("transparent")){
		var headerH = 0;
	}else if($body.hasClass("overlap")){
		var headerH = ($('.masthead:not(.side-header):not(.side-header-v-stroke)').height() + (parseInt($mainSlider.css("marginTop")) + parseInt($mainSlider.css("marginBottom")) ));
	}else{
		var headerH = $('.masthead:not(.side-header):not(.side-header-v-stroke)').height();
	}
	
    if ( $3DSlider.length > 0){
        if( $mainSlider.hasClass('fixed') ){
            var ratioFix = $3DSlider.attr('data-height')/$3DSlider.attr('data-width');
            var thisH = $3DSlider.css('height'),
                main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
                //$('.three-d-slider-content').css("height", $3DSlider.width() * (ratioFix) );
            var fixW = $3DSlider.width();
        }else if( $mainSlider.hasClass('fixed-height') ){
            var ratioFix = $3DSlider.attr('data-height')/$3DSlider.attr('data-width');
            var thisH = $3DSlider.css('height'),
                main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
            var fixW = $3DSlider.width();
        }else{
            if($('.boxed').length > 0){
                var boxedM = parseInt($('#page.boxed').css('margin-bottom'));
            }else{
                var boxedM = 0;
            }
            var main = $3DSlider.css({'height': $(window).height() - headerH - boxedM - adminH - boxedM }).addClass('slide-me');    
        }
         
         
        var settings = {  
                useJS : 1, //use JS to prevent mobile Safari crash (if a lot of images are displayed)           
                cellSize : 300, //defines amount of empty space between images. The bigger cellSize, the more space 
                images : [$('#level1 img'),$('#level2 img'),$('#level3 img')], //defines where to get images for each layer
                scale : [0.14, 0.23, 0.35], //image scale-down for each layer
                corner_w : 3, //image corner roll-over width
                corner_l : 30, //image corner roll-over side length
                corner_color : "#ffffff", //image corner roll-over color
                hover_color : "rgba(0, 0, 0, .35)" //entire image roll-over color and opacity
        };
         
        /*------ Control over correct source image feed ------*/       
        var Plane = [], //image layers collection
            $all_images = $([]), //images collection
            real_length = 0; //length of images[] array after dropping out layers with no images
             
        function checkOptions() { //make sure images[] array is set up correctly
            var source = settings.images.slice();
            for (var i = 0; i < source.length; i++) {
                if (source[i] && source[i].length) { //drop out empty and incorrect enties of images[]
                    Plane[real_length] = source[i].slice(0); //create collection of image layers
                    $all_images = $.merge($all_images, source[i]);
                    source[i].parent().addClass('erase-source'); //identify source layers, which need to be removed in the future
                    real_length++;
                }
            }
        }
        checkOptions();
        /*------ Control over correct source image feed END ------*/
        var loaded_imgs = 0, //number of images, which are already loaded
            total = $all_images.length, //total number of images in the collection
            $loading = main.children('#loading'), //image loading progress counter
            windowH = main.height(), //viewport height
            windowW = main.width(), //viewport width
            ratio = windowW/windowH, //viewport aspect ratio
            length = 3,
            indexZ = [3, 6, 9], //z-index for each layer.  Also should be set-up in jquery.magnetize.css
            IEsc = [1, 1, 1], //consider scale if browser is IE
            $hovered, //determines a hovered image
            lightbox_sc = Math.round(100 / settings.scale[length - 1])/100,
            time = {//defines timeouts for layers reordering animation
                layer : 700, //layer moves from one plane to another  
                invis : 850, //layer is invisible
                scrn : 500, //layer moves from  minus infinity to the first plane
                delay : 100, //delay between layers animation
            },
            timer1, timer2, timer3, timer4, timer5, timer6, timer7, timer8, //timers
            n = [], //number of "cells" per layer height
            m = [], //number of "cells" per layer width
            Container = [],  // array of canvas containers
            flags = {// auxiliary variables for appropriate algorithm switching
                allowParallax : length, //parallax animation is initially allowed
                useNavig : 0, //0 - if navigating with a click on an image, 1 - if navigation a click on navigation buttons
                antiStumble : 0, // -> 1 after layers reordering, and is required for more smooth parallax animation
                isLightbox : 0, // -> 1 when a single image is being viewed in a lightbox
                isMobile :(/(Android|BlackBerry|iPhone|iPod|iPad|Palm|Symbian)/.test(navigator.userAgent)), //if a visitor uses a mobile browser
                scrolling : false, // define whether you scroll or simply touch a display  
                noImagesWarning : "There are no slides to display. Please upload images."// is displayed if the plugin is set up incorrectly
            };
         
        if( $mainSlider.hasClass('fixed') ){
                 
                var newWidth,
                    newHeight;
                var fixedW = fixW;
                             
                $(window).on('resize', function(){
                    var asw = $3DSlider.attr('data-width'),
                        ash = $3DSlider.attr('data-height');
                        newWidth = $3DSlider.width();
                         
                        if(newWidth != fixedW) {
                            var main = $3DSlider.css("height", newWidth * (ash / asw) ).addClass('slide-me');
                            newWidth = $3DSlider.width();
                        }else{
                            main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
                        }
                     
                });
            }else if( $mainSlider.hasClass('fixed-height') ){
                var newWidth,
                    newHeight;
                var fixedW = fixW;
                         
                $(window).on('resize', function(){
                    var asw = $3DSlider.attr('data-width'),
                        ash = $3DSlider.attr('data-height');
 
                        newWidth = $3DSlider.width();
                         
                        if(newWidth != fixedW) {
                            var main = $3DSlider.css("height", newWidth * (ash / asw) ).addClass('slide-me');
                            newWidth = $3DSlider.width();
                        }else{
                            main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
                        }
                     
                });
            }else{
                $(window).on('resize', function(){  
                    if($('.boxed').length > 0){
                        var boxedM = parseInt($('#page.boxed').css('margin-bottom'));
                    }else{
                        var boxedM = 0;
                    }       
                    var main = $3DSlider.css({'height': $(window).height() - headerH - boxedM - adminH - boxedM}).addClass('slide-me');    
                });
            }
         
        var main_left = main.offset().left,
            main_top = main.offset().top;
             
        function synthesizePlanes(){
            var imgPerPlane = Math.floor(total/length);
            for (var k = 0; k < length; k++) {
                Plane[k] = [];
                for (var r = 0; r < imgPerPlane+Math.floor((k+1)/length)*(total-3*imgPerPlane); r++) {
                    Plane[k][r] = $all_images[r+k*imgPerPlane];
                }
            }
        }
             
        function start() {
            var dfdStart = $.Deferred();
            if (real_length != length) synthesizePlanes();
            main.addClass('slide-me');
            if (total != 0) {//make sure there are any images to display
                main.append($loading);
                $all_images.loaded(function() {
                    ++loaded_imgs; 
                });
                $.when(showLoadProgress()).done(function(){dfdStart.resolve(); }); //the function is not complete until until all images are loaded
                return main;
                //return dfdStart.promise(); /*Synchronization*/
            } else {    
                main.addClass('lightbox').append('<div class="img-caption"><p>'+flags.noImagesWarning+'</p></div>'); //show warning if there are no images to display
                return main;
            }
        }
         
        function showLoadProgress(){ //image load counter
            var dfdLoad = $.Deferred(); 
            timer7  = setTimeout(function(){
                if (loaded_imgs > 0.5 * total) { //if images are loaded too fast and progress bar does not show up
                    var fakeimgs = 0; //create simulator of images loading
                    timer8 = setInterval(function() {
                        if (fakeimgs < total) { //if not all images are loaded yet
                            $loading.html((++fakeimgs)+'/'+total); //display loading progress
                        } else {
                            $loading.html((total)+'/'+total); //all images are loaded
                            if (loaded_imgs == total) {
                                clearInterval(timer8);
                                $.when( launchSlideshow() ).done( function() {
                                    dfdLoad.resolve(); // IMPORTANT: launch the main script
                                }); 
                            }
                        }
                    },50);
                } else { //if images are loaded with normal speed
                    timer8 = setInterval(function() {
                        $loading.html((loaded_imgs)+'/'+total); //display loading progress
                        if (loaded_imgs == total) { //all images are loaded
                            clearInterval(timer8);
                            $.when( launchSlideshow() ).done( function() {
                                dfdLoad.resolve(); // IMPORTANT: launch the main script
                            });                     
                        }
                    },100);
                }
                clearTimeout(timer7);
            },150);
            return dfdLoad.promise();
        }               
         
        //CSS3 transition depending on browser
            var vP = ""; // What browser is being used
            var transSupport =''; //To check whether CSS3 transitions are supported
        if (/webkit/.test(navigator.userAgent.toLowerCase())) { // Find the transition prefix depending on browser 
            vP = "-webkit-";
            transSupport = 'Webkit';
        } else if (/msie/.test(navigator.userAgent.toLowerCase()) || (!!(navigator.userAgent.match(/Trident/) && !navigator.userAgent.match(/MSIE/)))) {
            vP = "-ms-";
            transSupport = 'ms';
        } else if (/mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase())) {
            vP = "-moz-";
            transSupport = 'Moz';
        } else if (/opera/.test(navigator.userAgent.toLowerCase())) {
            vP = "-o-";
            transSupport = 'O';
        }
 
        //CSS3 transition detection
        function supportsTransforms() {
            var b = document.body || document.documentElement;
            var s = b.style;
            var pp = 'transform';
            if(typeof s[pp] == 'string') return true;
            pp = pp.charAt(0).toUpperCase() + pp.substr(1);
              if(typeof s[transSupport + pp] == 'string') return true;
            return false;
        }
        function supportsTransitions() {
            var b = document.body || document.documentElement;
            var s = b.style;
            var pp = 'transition';
            if(typeof s[pp] == 'string') return true;
            pp = pp.charAt(0).toUpperCase() + pp.substr(1);
              if(typeof s[transSupport + pp] == 'string') return true;
            return false;
        }
         
        //create strings with the appropriate CSS3 attributes in accordance with visitors's browser
        var smart = supportsTransitions() * supportsTransforms(),
            trasitDur = vP+"transition-duration",
            trasitDel = vP+"transition-delay",
            transform = vP+"transform"; 
         
        //normalization of touch events
        function coordinates(event) { 
            if (event.originalEvent.touches !== undefined && event.originalEvent.touches[0]) {
                event.pageX = event.originalEvent.touches[0].pageX;
                event.pageY = event.originalEvent.touches[0].pageY;
            }
            return event;
        }
         
        //reposition if window resize. Only image containers move.
        function makeEasyReposition(){ 
            windowH = main.height();
            windowW = main.width();
            animateLayersBunch(0.5 * windowW, 0.5 * windowH);
        }
         
        //reposition if window resize. Both image containers and images move.
        function makeTotalReposition(){ 
            windowH = main.height();
            windowW = main.width();
            resizePlanes(windowW / windowH);
        }
         
        //create slider HTML
        function createContainers(planes) {
            var CanvasArray = '<div class="close"></div><div class="dark-layer l2"></div><div class="dark-layer l1"></div><div class="img-caption"><p></p></div><div class="navig"><div class="act">1</div><div>2</div><div>3</div></div>',
                corner;
            for (var k=0; k < length; k++) {
                //dealing with a single plane
                CanvasArray += '<div class="container-'+(k + 1)+' container" >';
                var plane_lngth = planes[k].length;
                for (var i = 0; i < plane_lngth; i++) {
                    if ($('<canvas></canvas>')[0].getContext) { //if browser supports Canvas
                        var newImg = '<canvas class="photo"></canvas>';//create canvas
                    } else {
                        var newImg = '<img class="photo" />';//otherwise create images
                    }
                    CanvasArray += newImg;
                }
                CanvasArray += '<div class="dark-layer"></div>';//add black overlay between planes
                if (!flags.isMobile) {//create "corners" roll-over for hovered image. No need in roll-over for mobile browsers
                    if (smart) { //create roll-over with help of Canvas in smart browsers
                        corner = '<canvas class="corners"></canvas>';
                    } else { //create roll-over with help of common HTML in IE
                        corner = '<span class="top-l"></span><span class="top-r"></span><span class="bottom-l"></span><span class="bottom-r"></span>';
                    } 
                    CanvasArray += corner;
                }
                CanvasArray += '</div>';  
            }
            main.append(CanvasArray); //add slideshow HTML to DOM
             
            findInterfaceElems(); //determine navigation, image caption, etc. elements
             
            $(window).resize(function() {
                var wWidth = $(window).width();
                main_left = main.offset().left;
                main_top = main.offset().top;
                if (settings.layout) {
                    if (settings.layout == 1) {
                        main.css({"max-width":wWidth, "height": wWidth/ settings.fixed_ratio});
                    } else if (settings.fixed_width > wWidth ) { 
                        main.css({"max-width":wWidth, "height": wWidth/ settings.fixed_ratio});
                    } else  {
                        main.css({"max-width":settings.fixed_width, "height": settings.fixed_height});
                    }
                } else {
                    main.css("height",$(window).height()-main_top);
                }
 
                if(!flags.isLightbox) {
                    if (settings.img_reposition && smart && !settings.useJS){
                        $navig.css("top" , Math.round(0.5 * (windowH - $navig.height())));
                        makeTotalReposition();
                        return true; 
                    }
                    makeEasyReposition();
                    $navig.css("top" , Math.round(0.5 * (windowH - $navig.height()))); //run after reposition for mobiles to ensure correct landscape-portrait switching
                }
 
            });
            $(document).on("scroll", function() { //consider document scroll when determining coordinates of a click
                $this = $(document);
                scrollTop = $this.scrollTop();
                scrollLeft = $this.scrollLeft();
            });     
            return $('div.container'); 
        }           
         
        //determine main static elements of slideshow layout
        function findInterfaceElems() {
            $closeX = main.children('.close'); //close button (image lightbox)
            $dark_layer1 = main.children('.l1');//1st dark overlay between planes
            $dark_layer2 = main.children('.l2');//2nd dark overlay between planes
            $caption = main.children('.img-caption');//image caption
            $caption_text = $caption.children('p');
            $navig = main.children('.navig');//navigation buttons
            $navig.css("top" , Math.round(0.5 * (windowH - $navig.height())));
            $darkLayers = main.find('div.dark-layer');//gather all dark layers into a single array
            scrollTop = $(document).scrollTop();
            scrollLeft = $(document).scrollLeft();
        }   
         
        //draw canvas images
        function drawCanvas(planes) {  
            for (var k = 0; k < length; k++) {
                var readyImgs = readyCanvas(k), 
                    readyImgsLngth = readyImgs.length;
                for (var i = 0; i < readyImgsLngth; i++) {
                    var real_img = planes[k][i],
                        img_width = $(real_img).width(),
                        img_height = $(real_img).height(),
                        $descr = $(real_img).next();
                    readyImgs[i].width = img_width;
                    readyImgs[i].height = img_height;
                    if ($('<canvas></canvas>')[0].getContext) { //if browser supports Canvas
                        var context = readyImgs[i].getContext("2d");
                        context.drawImage(real_img, 0, 0, img_width, img_height); //redraw images into canvas
                    } else { //if browser does not support canvas
                        $(readyImgs[i]).attr("src" , $(real_img).attr("src")); //leave images as <img>
                    }
                    if (!$descr.is('img')) $(readyImgs[i]).data("descr" , $descr.html());//display image caption
                    getCanvasSize(readyImgs[i]);//determine width and height of each picture
                }
            }
        }
         
        // get all images from i-th Container
        function readyCanvas(i) { 
            return $(Container[i]).children('.photo');
        }   
             
        // get number of cells across picture width and height  
        function getCanvasSize(canva) { 
            var $self = $(canva),
            w = Math.ceil($self.width() / settings.cellSize),
            h = Math.ceil($self.height() / settings.cellSize);
            $self.data({
                "wCanvas" : w,
                "hCanvas" : h,
                "deviationX" : Math.floor((w * settings.cellSize - $self.width()) * Math.random()), // devialtion of left position
                "deviationY" : Math.floor((h * settings.cellSize - $self.height()) * Math.random()) // deviation of top position
            });
        }   
         
        //resize layers in order to make sure all pictures are able to fit them 
        function resizePlanes(ratio) {
            for (var i = 0; i < length; i++) {
                var readyImgs = readyCanvas(i),
                    side = planeSide(readyImgs, ratio);
                    n[i] = side.n;// 1st itteration. Get number of cells across layer height    
                    m[i] = side.m;// 2nd itteration. Get number of cells across layer width 
                var newNM = positionImage(readyImgs, createMatrix(0,m[i],0,n[i]), 0, 0, n[i], m[i]); //position pictures inside of a layer
                    m[i] = newNM[0]; //correction of previously gotten values
                    n[i] = newNM[1];
                 
                Container[i].ind = i; // set initial order of layers
                 
                var vertical = addPaddings(n[i], windowH),
                    horizontal = addPaddings(m[i], windowW),
                    readyImgsLng = readyImgs.length;
                    Container[i].Wo = horizontal[0];//update layer width
                    Container[i].Ho = vertical[0];//update layer height
                for (var index = 0; index < readyImgsLng; index++) {
                    var $img = $(readyImgs[index]), 
                        top = parseFloat($img.css("top")),
                        left = parseFloat($img.css("left"));
                    $img.css({"top" : top + vertical[1], "left" : left + horizontal[1]}); //2nd itteration. Correction of pictures positions
                }
                Container[i].Scale = 1; 
                $(Container[i]).css({"width" : Container[i].Wo, "height" : Container[i].Ho});
                if (!smart || settings.useJS) {//consider scale if browser is IE
                    IEsc[i] = settings.scale[i]; 
                    Container[i] = scaleIE(settings.scale[i], Container[i], 0);
                }
            }
            animateLayersBunch(0.5 * windowW+main_left, 0.5 * windowH+main_top);//center image containers
            flags.allowParallax = length;
            return main;
        }   
         
        //calculate number of cells across image plane width and height
        function planeSide(realImages, proportion) {
            var totalImgArea = 0,
                img_numb = realImages.length,
                max_w = 0, 
                max_h = 0
                giveMoreSpace = 1.3;
            //Calculate the summ of images areas
            for (var i = 0; i < img_numb; i++){
                var imw = realImages[i].width,
                    imh = realImages[i].height;
                max_w = Math.max(max_w, imw); //search for the biggest image width
                max_h = Math.max(max_h, imh); //search for the biggest image height
                totalImgArea += giveMoreSpace * imw * imh + 2 * settings.cellSize * settings.cellSize; // calculate required containner area
            }
            max_w = Math.ceil(max_w / settings.cellSize);
            max_h = Math.ceil(max_h / settings.cellSize);           
            //approx container size when images are not scaled
            var W0 = Math.ceil(Math.sqrt(proportion * totalImgArea) / settings.cellSize), 
                H0;
            if (!(W0 > max_w)) W0 = max_w + 1; //make sure that container is wider than the widest image
            H0 = Math.ceil(giveMoreSpace * W0 / proportion);
            if (!(H0 > max_h)) H0 = max_h + 1; //make sure that container is higher than the highest image
            return {"n" : H0,"m" : W0};
        }
         
        //create a matrix [Mo...M; No...N]
        function createMatrix(Mo, M, No, N) { 
            var Matrix = [];
            for (var j = No; j < N; j++){
                var row = [];
                for (var i = Mo; i < M; i++){
                    row[i] = true; //the cell is ready for usage
                }
                Matrix[j] = row;
            }
            return Matrix;
        }   
         
        //position pictures inside of a layer   
        function positionImage(imagesArray, uMatrix, Jo, Io, matrixN, matrixM){//canvas positioning... God bless you
            /* imagesArray - array of images to place 
            Jo, Io - where to start the search
            matrixN, matrixM - number of cells in vertical and horizontal directions*/
            var maxM = 0,
                maxN = 0,
                Ioo=Io;
            var imgArrLng = imagesArray.length;
            for (var index = 0; index < imgArrLng; index++){ 
                Io=Ioo;
                var $img = $(imagesArray[index]);
                    widthCanvas = $img.data("wCanvas"),
                    heightCanvas = $img.data("hCanvas");
                IamDone :
                for (var j = Jo; j < (matrixN-heightCanvas); j++) {//find empty cells inside of a layer 
                    MoveToNextCellinRow : 
                    for (var i = Io; i < (matrixM - widthCanvas); i++) {
                        for (var r = j; r < (j + heightCanvas); r++) { 
                            for (var s = i; s < (i + widthCanvas); s++) {
                                if (uMatrix[r][s] == false) {
                                    if (j == (matrixN - heightCanvas - 1) && i == (matrixM - widthCanvas - 1)) { //the image is too large and does not fit the container
                                        for (var q = 0; q < matrixN; q++) { //add new column to container and try to position image again
                                            uMatrix[q].push(true);
                                        }
                                        i = Io;
                                        matrixM++; //adding new column
                                        j = 0;
                                    } 
                                    continue MoveToNextCellinRow; //move to the next cell in row
                                }
                            }
                        } 
                        //if an image has already found its place inside of a layer, mark the appropriate cells as "occupied"
                        for (var r = j; r < (j + heightCanvas + 1); r++) { 
                            for (var s = i; s < (i + widthCanvas + 1); s++) {
                                uMatrix[r][s] = false;
                            }   
                        }
                        if ((i + widthCanvas) > maxM) maxM = i + widthCanvas; //cut empty space on the right and in the bottom
                        if ((j + heightCanvas) > maxN) maxN = j + heightCanvas;
                        $img.css({"top" : Math.floor(j*settings.cellSize + $img.data("deviationY")), "left" : Math.floor(i*settings.cellSize + $img.data("deviationX"))});
                        break IamDone;
                    }
                }
            }
            return [maxM, maxN];     
        }
 
        function addPaddings(n_m, H_W) { //add paddings between around image containers
            if(settings.cellSize * n_m * settings.scale[length - 1] < H_W) {
                    var newH_W = Math.round((H_W + 0.5 * settings.cellSize) / settings.scale[length - 1]),
                    newPadding = Math.round(0.5 * (newH_W - settings.cellSize * n_m));
                } else {
                    var newH_W = Math.round(settings.cellSize * n_m + 0.5 * settings.cellSize / settings.scale[length - 1]),
                    newPadding = Math.round(0.25 * settings.cellSize / settings.scale[length - 1]);
                }
            return [newH_W, newPadding];
        }
         
        //image container scroll animation. Very important  
        function animateLayersBunch(epageX, epageY) {
            if (flags.allowParallax != length)  return false;//do not animate layers parallax while BringToTheFront is working
            epageX -= main_left;
            epageY -= main_top;
            var ratioX = epageX/windowW,
                ratioY = epageY/windowH,
                k = length - 1,
                Left = (ratioX - 0.5) * (1 - settings.scale[k] / IEsc[k]) * Container[k].Wo - ratioX * (Container[k].Wo - windowW),
                Top = (ratioY - 0.5) * (1 - settings.scale[k]/IEsc[k]) * Container[k].Ho - ratioY * (Container[k].Ho - windowH);
            for (var s = 0; s < k; s++) {  //animate background image containers 
                var L = settings.scale[s] / IEsc[k] * (Left + 0.5 * (IEsc[s] * Container[s].Wo - windowW)) - 0.5 * (IEsc[s] * Container[s].Wo - windowW)    ,
                    T = settings.scale[s] / IEsc[k] * (Top + 0.5 * (IEsc[s] * Container[s].Ho - windowH)) - 0.5 * (IEsc[s] * Container[s].Ho - windowH);
                if (!flags.antiStumble) {
                    $(Container[s]).css({"left" : Math.round(L), "top" : Math.round(T)});
                } else {
                    flags.allowParallax = 0;
                    $(Container[s]).animate({"left" : Math.round(L), "top" : Math.round(T)}, 120, 'linear');
                }
            }   // animate top image container
                if (!flags.antiStumble) {
                    $(Container[k]).css({"left" : Math.floor(Left), "top" : Math.floor(Top)});
                } else {                    
                    $(Container[k]).animate({"left" : Math.floor(Left), "top" : Math.floor(Top)}, 120, "linear" , function() {flags.antiStumble = false; flags.allowParallax = length});
                }
        }
         
        //image container scroll animation for mobile browsers.
        function animateLayersMobile(){
            var prevX = 0, prevY = 0,
                startX = 0, endX = 0,
                startY = 0, endY = 0,
                d_X = 0, d_Y = 0, //where the previous touch stopped. Initially eq. zero
                _delX, _delY,
                is_move; // prevent touchend bubbling
            main[0].ontouchmove = function(evdef){
                evdef.preventDefault();
            }
             
            main.on('touchstart', function(evstart){
                var start = coordinates(evstart);
                flags.scrolling = false;
                startX = start.pageX - main_left;
                startY = start.pageY - main_top;
                d_X = prevX + (startX - 0.5 * windowW);
                d_Y = prevY + (startY - 0.5 * windowH);
            });
         
            main.on('touchmove', function(evmove){
                var move = coordinates(evmove),
                    moveX = move.pageX - main_left,
                    moveY = move.pageY - main_top,
                    X = moveX - d_X,
                    Y = moveY - d_Y,
                    desktopX, desktopY; // mobile coordinates -> argumets for desktop container scroll animation
                 
                    _delX = moveX; // is required for detecting touchend coordinates
                    _delY = moveY;
                    //it is necessary to disallow scrolling out of the main:
                    desktopX  = ((X > windowW) * (windowW + 0.1) + (X < 0) * 0.1); // will return windowW or 0 if scroll to the boundary (0.1 is added since (X<0)*0 always = false)
                    desktopY  = ((Y > windowH) * (windowH + 0.1) + (Y < 0) * 0.1);
                 
                    if (!desktopX) { // if one scrolls inside of the main
                        desktopX = X;
                    } else { // if one attempts to scroll out of the main. Boundary conditions:
                        desktopX = desktopX - 0.1; //remove the previously added 0.1
                        startX = windowW - desktopX - prevX; // amendment for correct boundary move animation
                    }
                     
                    if (!desktopY) {
                        desktopY = Y;
                    } else {
                        desktopY = desktopY - 0.1; 
                        startY = windowH - desktopY - prevY;
                    }
                flags.scrolling = true;
                animateLayersBunch(windowW - desktopX + main_left , windowH - desktopY + main_top);//transfer event coordinates of touch-screen into coordinates for a desktop browser
                is_move = true; 
            });
         
            main.on('touchend', function(ed){
                if (is_move) {
                    prevX += startX - _delX; //calculate total distance
                    prevY += startY - _delY;
                }
                is_move = 0;
            });
        }           
         
        //draw roll-over ("4 corners")
        function drawCorners(actimg) {
            if (smart) { //roll-over size calculation
                var c_w = actimg.width() + 2 * settings.corner_w,//width
                    c_h = actimg.height() + 2 * settings.corner_w,//height
                    c_l = parseFloat(actimg.css("left")) - settings.corner_w,//"corner" side length
                    c_t = parseFloat(actimg.css("top")) - settings.corner_w,//"corner" side width
                    corners = actimg.siblings(".corners").css({"left" : c_l, "top" : c_t});
                     
                //draw "corners" with help of canvas for smart browsers
                corners[0].width = c_w;
                corners[0].height = c_h;
                var ctx=corners[0].getContext("2d");
                ctx.clearRect(0, 0, c_w, c_h);
                ctx.fillStyle = settings.hover_color;
                ctx.fillRect(
                            settings.corner_w, settings.corner_w, 
                            c_w - 2*settings.corner_w, c_h - 2 * settings.corner_w
                );
                ctx.beginPath();
                ctx.strokeStyle = settings.corner_color;
                ctx.lineWidth = settings.corner_w;
                ctx.lineCap = "square";
                 
                newCorner(
                        ctx, 
                        0.5 * settings.corner_w,settings.corner_l, 
                        0.5 * settings.corner_w,0.5 * settings.corner_w, 
                        settings.corner_l,0.5 * settings.corner_w
                );
                newCorner(
                        ctx, 
                        c_w - settings.corner_l,0.5 * settings.corner_w, 
                        c_w - 0.5 * settings.corner_w,0.5 * settings.corner_w, 
                        c_w - 0.5 * settings.corner_w,settings.corner_l
                );
                newCorner(
                        ctx, 
                        c_w - 0.5 * settings.corner_w,c_h - settings.corner_l, 
                        c_w - 0.5 * settings.corner_w,c_h - 0.5 * settings.corner_w, 
                        c_w - settings.corner_l,c_h - 0.5 * settings.corner_w
                );
                ctx.stroke(); 
                newCorner(
                        ctx, 
                        settings.corner_l,c_h - 0.5 * settings.corner_w, 
                        0.5 * settings.corner_w,c_h - 0.5 * settings.corner_w, 
                        0.5 * settings.corner_w,c_h - settings.corner_l
                );
                ctx.stroke();
                     
                return false;
            } else { //draw "corners" with help of spans for IE
                var $span_t_l = actimg.siblings('span.top-l'),
                $span_b_l = actimg.siblings('span.bottom-l'),
                $span_t_r = actimg.siblings('span.top-r'),
                $span_b_r = actimg.siblings('span.bottom-r'),
                l = parseFloat(actimg.css("left")),
                t = parseFloat(actimg.css("top")),
                w = actimg.width(),
                h = actimg.height();                
                span_side = settings.corner_l - settings.corner_w;
                $span_t_l.css({"opacity" : 0.7,"left" : l,"top" : t});
                $span_b_l.css({"opacity" : 0.7,"left" : l,"top" : t + h - span_side});
                $span_t_r.css({"opacity" : 0.7,"left" : l + w - span_side,"top" : t});
                $span_b_r.css({"opacity" : 0.7,"left" : l + w - span_side,"top" : t + h - span_side});
             
                actimg.on('mouseleave', function() {
                    $span_t_l.css("opacity" , 0);
                    $span_b_l.css("opacity" , 0);
                    $span_t_r.css("opacity" , 0);
                    $span_b_r.css("opacity" , 0);
                });
            }
        }   
         
        //draw a line for the roll-over corner      
        function newCorner(brush, startX,startY, angleX,angleY, endX,endY) {
            brush.moveTo(startX, startY);
            brush.lineTo(angleX, angleY);
            brush.lineTo(endX, endY);
        }           
         
        //determine whether a click is made on a picture    
        function findOnClickImage(planes, ev) {
            var count = planes.length - 1,
            el_below = ev.target;
            switchDarkLayers();//make dark overlays invisible while searching for a target picture
            while (!$(el_below).hasClass("photo") && (count != 0)){//if no images from the 1st layer were clicked, proceed to the rest of layers
                var e = new jQuery.Event("click");
                e.pageX = ev.pageX - scrollLeft; //calculate click coordinates considering document scroll correction
                e.pageY = ev.pageY - scrollTop;
                $(planes[count]).addClass("toBG");//hide upper layers -> make images below clickable
                el_below = document.elementFromPoint(e.pageX, e.pageY);
                count--;
            }   
            var planes_length = planes.length;
            for (var pp = 0; pp < planes_length; pp++) {
                $(planes[pp]).removeClass("toBG"); //bring upper layers back
            } 
            switchDarkLayers(); //make dark layers visible again
            if (!$(el_below).hasClass("photo")) el_below = false //if no imagess has been clicked, return flase
            return el_below; //return the target image
        }       
             
        function switchDarkLayers(){ // switch on/off dark layers when searching for an onclick target image
            for (var i = 0; i < $darkLayers.length; i++){    
                $($darkLayers[i]).toggleClass('toBG');//reduce layer z-index
            }
            return $darkLayers;
        }   
         
        //bring chosen image container to the top
        function bringToTheFront(img) { 
            if (!flags.useNavig) { //if layers reordering started after a click on an image 
                var $this = $(img),
                    $self = $this.parent('div.container');
                    $navig.children('div.act').removeClass('act');          
                    $navig.children(':nth-child('+(length - $self.index('div.container'))+')').addClass('act');//highlight the appropriate navigation button
                    viewImg($this); //display the selected image in a lighbox
            } else { //if layers reordering statred after a click on a navigation button
                var $self = $(img);
                animateLayersBunch(0.5 * windowW+main_left, 0.5 * windowH+main_top); //correction of layers position in a center of a screen
            }
                flags.allowParallax = 0;
                var current = $self[0].ind,
                    dif = length - 1 - current,
                    reOrderCont = [];               
                main.addClass('scale-me').removeClass('slide-me');//disallow "right-left" and "top-buttom" animation
                for (var i = 0; i < current+1; i++) { //determine new order of layers, which only moves forward
                    var ind = (i + dif) % length,
                    duration = (ind - i) * time.layer;
                    reOrderCont[ind] = bringOnlyToFront(Container[i], settings.scale[ind], indexZ[ind], duration);  
                    reOrderCont[ind].ind = ind;
                    if (flags.useNavig) {   
                        timer2 = setTimeout(function() { 
                            flags.allowParallax++;
                            flags.useNavig--;
                        }, 1.25 * (duration - time.layer));
                    }
                }
                 
                for (var ii = current+1; ii < length; ii++) { //determine new order of layers, which moves forward-back-forward
                    var ind = (ii + dif) % length,
                    durBefore = (length - 1 - ii) * time.layer,
                    durAfter = (ind) * time.layer;
                    reOrderCont[ind] = bringToFrontAndBack(Container[ii], settings.scale[ind], indexZ[ind], durBefore, durAfter);                   
                    reOrderCont[ind].ind = ind;
                    if (flags.useNavig) {   
                        timer3 = setTimeout(function() { 
                            flags.allowParallax++;
                            flags.useNavig--;
                            Math.floor(flags.allowParallax/length) * main.removeClass('scale-me').addClass('slide-me');
                        }, durBefore + time.scrn + time.delay + 300 + durAfter + time.invis);
                    }
                }
            return reOrderCont;
        }   
             
        function bringOnlyToFront(el, scaling, Zindex, duration0){ // animate image container, which moves forward only
            $dark_layer1.removeClass('l1'); // disable dark layers when an image is coming to the front
            $dark_layer2.removeClass('l2');                         
            if (smart && !settings.useJS) {
                $(el).css(trasitDur,time.layer+"ms").css(trasitDel,"0ms")
                    .css(transform, "scale("+scaling+","+scaling+")");
                } else {
                    el = scaleIE(scaling, el, duration0);
                }                   
                timer4 = setTimeout(function() { 
                    $(el).css({"zIndex" : Zindex});
                    $dark_layer1.addClass('l1');
                    $dark_layer2.addClass('l2');
                }, 1.25 * (duration0 - time.layer));
                 
                return el;
        }
     
        function bringToFrontAndBack(el, scaling, Zindex, duration1, duration2) { // animate image container, which moves forward -> back -> target position
            var ttt1 = duration1 + time.scrn; ttt2 = 0.5 * duration1;
            $(el).css("zIndex" , 90 * scaling); //the bigger is scale, the more z-index should be
            if (smart && !settings.useJS) {
                $(el).css(trasitDur,ttt1+"ms, "+time.scrn+"ms").css(trasitDel," 0ms, "+ttt2+"ms") //layer moves to the front
                    .css(transform, "scale(1,1)").css({"opacity" : 0});
            } else {
                el = scaleIE(1, el, ttt1);
                if (flags.isMobile) $(el).css({"opacity" :0}).css(trasitDur,time.scrn+"ms").css(trasitDel,ttt2+"ms");
            }
             
            timer5 = setTimeout(function() {
                $(el).css({"zIndex" : Zindex}); //layer disappears and moves back
                if (smart && !settings.useJS) {
                    $(el).css(trasitDur,"0ms").css(trasitDel,"0ms").css(transform, "scale(0.1,0.1)");
                } else {
                    el = scaleIE(0.1, el, 0);
                    if (!flags.isMobile) $(el).css("visibility" , "hidden");
                }
            }, duration1 + time.scrn + time.delay);
            var ttt3 = duration2 + time.invis; ttt4 = 0.5 * time.invis;
                 
            timer6 = setTimeout(function() { //layer is visible again and moves to its target position  
                if (smart && !settings.useJS) {
                    $(el).css(trasitDur,ttt3+"ms, "+ttt4+"ms").css(trasitDel," 0ms")
                    .css(transform, "scale("+scaling+","+scaling+")").css({"opacity" : 1});
                } else {
                    $(el).css("visibility" , "visible");
                    el = scaleIE(scaling, el, ttt3);
                    if (flags.isMobile) {
                        $(el).css({"opacity" : 1}).css(trasitDur,ttt4+"ms").css(trasitDel," 0ms");
                    } else {$(el).css("visibility" , "visible");}
                }
            }, duration1 + time.scrn + time.delay + 300);   
            return el;  
        }           
         
        //scale planes for old IE with help of JS, since it does not undertsand CSS3
        function scaleIE(scale, plane, time){ 
            var newscale = scale/plane.Scale;
            plane.Scale = scale;
            var inContW = plane.Wo,
                inContH = plane.Ho,
                inContT = parseFloat($(plane).css("top")),
                inContL = parseFloat($(plane).css("left")),
                images = $(plane).children('.photo'),
                ieW = Math.round(newscale * inContW),
                ieH = Math.round(newscale * inContH);
                 
            $(plane).animate({
                "width" : ieW,
                "height" : ieH,
                "top" : Math.round(inContT + 0.5 * (1 - newscale) * inContH),
                "left" : Math.round(inContL + 0.5 * (1 - newscale) * inContW)
            }, time);
             
            //for correct animateLayersBunch functioning
            plane.Wo = ieW;
            plane.Ho = ieH;
            var images_length = images.length;
            for (var j = 0; j < images_length; j++){
                 
                var inImW = parseFloat($(images[j]).css("width")), //.css('width') instead of .width() - to satisfy both IE8 and IE9
                    inImH = parseFloat($(images[j]).css("height")),
                    inImT = parseFloat($(images[j]).css("top")),
                    inImL = parseFloat($(images[j]).css("left"));
             
                if (!$(images[j]).hasClass('show')) {   
                    $(images[j]).animate({
                        "width" : Math.round(newscale * inImW),
                        "height" : Math.round(newscale * inImH),
                        "top" : Math.round(newscale * inImT),
                        "left" : Math.round(newscale * inImL)
                    }, time); 
                } 
            }
            return plane;
        }
         
        function scaleContainers(i) { //apply scaling to containers and lightbox black background
            var l3_scale = Math.round((100 / settings.scale[0])) / 100;
            $(Container[i]).css(transform, "scale("+settings.scale[i]+","+settings.scale[i]+")")
                            .children('div.dark-layer').css(transform, "scale("+l3_scale+","+l3_scale+")");
        }   
                     
        // launch slider script 
        function launchSlideshow() { 
            clearInterval(timer7); // clear the timer of image preloader
            $loading.css("display" , "none");
            Container = createContainers(Plane);
            if (settings.useJS *= flags.isMobile) main.addClass('useJS'); //use JS for mobile only
            if (smart && !settings.useJS) for (var k = 0; k < length; k++){
                scaleContainers(k);
            }
            drawCanvas(Plane);
            $('.erase-source').remove();
             
            resizePlanes(windowW/windowH);//calculate size and scale for all planes 
             
            if (!smart) {
                $closeX.css("display" , "none"); //hide static slideshow elements, until they are not required
                $caption.css("display" , "none")
            } else {
                settings.corner_w = Math.round(settings.corner_w / settings.scale[length - 1]); //image roll-over width considering css3 scale();
                settings.corner_l = Math.round(settings.corner_l / settings.scale[length - 1]);//image roll-over height considering css3 scale();
            }   
             
            //start animation only in case all containers are positioned
            if ($(Container[length - 1]).width()) { 
                /*animate the top container and position the rest of layers according to its position*/
                main.on('click',function(ev){
                    if ((flags.allowParallax == length)&& (!$(ev.target).hasClass("act"))) {
                        var targ = findOnClickImage(Container, ev);
                        if (targ) {
                            Container = bringToTheFront(targ); //bring container with the target image to the front
                        }                       
                    }
                });
            }   
             
            // launch container scroll animation for desktop
            if (!flags.isMobile){
                main.on('mousemove',function(ex){ 
                    animateLayersBunch(ex.pageX, ex.pageY);
                });
     
                main.children('div.container').children('.photo').on('click', function() {
                    if ($(this).parent(".container")[0] == Container[length - 1])  // necessary for IE: it has all layers clickable
                        viewImg($(this));
                });
                 
                main.children('div.container').children('canvas.corners').on('click touchend',function(){
                    viewImg($hovered);
                });
                main.children('div.container').children('.photo').not('.top-slice').on('mouseenter', function(evnt) { // image "corners" roll-over
                    $hovered = $(evnt.target);
                    if(($hovered.parent(".container")[0] == Container[length - 1]) && (!$hovered.hasClass('top-slice'))) { // necessary for IE: it has all layers clickable
                        drawCorners($hovered);
                    }
                });
                 
            // launch container scroll animation for mobile 
            } else {
                animateLayersMobile();
                main.children('div.container').children('.photo').on('touchend', function() {
                    if (!flags.scrolling)  // prevent click if touchmove, or if previous lightbox image animation is not finished yet
                        viewImg($(this));
                });
            }
          
            $navig.children('div').on('click touchend',function(){ //reorder layers in accordance with navigation button that had been clicked
              layersNavig($(this));
            });
            return main;    
        }
             
        // view a single image in a lightbox
        function viewImg($IMG) {
            if (!$IMG.hasClass('show') && (flags.allowParallax == length)) { //first click - to open lightbox
                flags.isLightbox = true; 
                flags.allowParallax = 0;
                inImW = $IMG.width(); //determine image width, height, top and left position
                inImH = $IMG.height();
                inImT = parseFloat($IMG.css("top"));
                inImL = parseFloat($IMG.css("left"));
                $parent = $IMG.parent(); //determine layer which contains the target image
                sc = settings.scale[length-1];
                inScale = settings.scale[$parent[0].ind];
                $dark_bg = $IMG.siblings('.dark-layer').addClass('l3'); //display black lightbox background
     
                main[0].ontouchstart = function(evdef){
                    evdef.preventDefault();//prevent bouncing on touch devices
                }
                             
                var parentT = parseFloat($parent.css("top")), //determine image parent layer width, height, top and left position
                    parentL = parseFloat($parent.css("left")),
                    parentW = $parent[0].Wo,
                    parentH = $parent[0].Ho;
                    main.addClass('lightbox');
                 
                if ($IMG.data('descr')) {$caption_text.html($IMG.data('descr'));}
                $IMG.addClass('show top-slice');
                imgFitScreen($IMG, inImW, inImH, sc, inScale, parentW, parentH, parentL, parentT, $dark_bg); //display the image in lightbox. If the image is too large, downscale  
                if (smart && !settings.useJS) {
                    $IMG.css(transform, "scale("+lightbox_sc+","+lightbox_sc+")");
                    $dark_bg.css({"width" : windowW, "height" : windowH, //set the appropriate size and position of lightbox black background
                                "left" : Math.round((0.5 * (parentW - windowW) * (inScale - 1) - parentL) / inScale), 
                                "top" : Math.round((0.5 * (parentH - windowH) * (inScale - 1) - parentT) / inScale)
                    });
                } else {
                    $IMG.siblings('span').css("opacity" , 0);
                    $dark_bg.css({"width" : windowW, "height" : windowH, 
                        "left" :    Math.round(-parentL - 0.5 * (1 - sc / inScale) * parentW), 
                        "top" : Math.round(-parentT - 0.5 * (1 - sc / inScale) * parentH),
                        "display" : "none"
                    });
                }
                $(window).resize(function() {
                    if (flags.isLightbox && smart) {
                        main_left = main.offset().left;
                        main_top = main.offset().top;
                        makeEasyReposition();
                        parentT = parseFloat($parent.css("top"));   
                        parentL = parseFloat($parent.css("left"));
                        imgFitScreen(main.children('div.container').children('.show.top-slice'), inImW, inImH, sc, inScale, parentW, parentH, parentL, parentT, $dark_bg);  //otherwise, it caches all IMGs
                    }
                });
                $closeX.on('mouseover', function(){
                    $closeX.addClass('hovered'); //remove delay of opacity animation
                })
                $closeX.on('click touchend', function() { // 'close' button is pressed
                    viewImg($IMG)
                }); 
                $(document).keyup(function(e) {
                    if (e.keyCode == 27) viewImg($IMG);   // ESC is pressed
                });
                return true;
                     
            } else if ($IMG.hasClass('show') && (Container.length == length) && ($closeX[0].offsetWidth)) { //second click - to close lightbox
                main[0].ontouchstart = function(evdef){
                    return true;
                }
                 
                main.removeClass("lightbox"); 
                $closeX.removeClass('hovered'); // add delay of opacity animation
                $IMG.siblings(".dark-layer").removeClass('l3'); 
                $caption_text.empty();
                /*put the image back to its initial position*/
                if (smart && !settings.useJS) {
                    $IMG.removeClass('show').css({"left" : Math.round(inImL), "top" : Math.round(inImT), "maxWidth" : "none", "maxHeight" : "none"}).css(transform, "none");
                } else { 
                    $IMG.removeClass('show').animate({
                        "left" : Math.round(sc * inImL / inScale), "top" : Math.round(sc * inImT / inScale), 
                        "width" : Math.round(sc * inImW / inScale), "height" : Math.round(sc * inImH / inScale)}, 400)
                        .css({"maxWidth" : "none", "maxHeight" : "none"});
                    $closeX.fadeOut();
                    $dark_bg.fadeOut();
                    $caption.fadeOut();
                }
                    timer1 = setTimeout(function() { 
                        $IMG.removeClass('top-slice');
                        flags.allowParallax = length; // important. It is possible to unclick an image while container still are being reordered 
                        flags.isLightbox = false;
                        flags.antiStumble = true;
                        main.removeClass('scale-me').addClass('slide-me');
                         
                    }, 400);
                return true;    
            }
        }           
     
        //display the image in lightbox. If the image is too large, downscale
        function imgFitScreen($Img, inImgW, inImgH, sc, inScle, parntW, parntH, parntL, parntT, $darkbg) {
            var w, h, 
                $closeX_left = 20,
                ifsmart = (smart * !settings.useJS) + (!smart + settings.useJS) * inScle;
            if ((inImgW/ifsmart > windowW)||(inImgH/ifsmart > (windowH - 110))) { //if image does not fit the viewport
                if ((inImgW/inImgH) > (windowW/windowH)) { //if the image is wider than the window
                    var maxW = windowW - 2 * $closeX.width(),//calculate image max-width, max-height
                        maxH = Math.round((windowW - 2 * $closeX.width()) * inImgH / inImgW);
                    $closeX_left = 0.5 * $closeX.width();
                } else {//if the image is higher than the window
                    var maxW = Math.round((windowH - 110) * inImgW / inImgH), //calculate image max-width, max-height
                        maxH = windowH - 110;
                }
                $Img.css({"maxHeight" : maxH, "maxWidth" : maxW});//do not use "auto" because of Opera
                w = maxW * ifsmart;
                h = maxH * ifsmart;
            } else {//if image fits the viewport, do nothing with its width and height
                w = inImgW;
                h = inImgH;
            }
             
            //finally, display the image in the lightbox, with image real size or as large as possible 
            if (smart && !settings.useJS) { 
                $Img.css({
                  "left" : Math.round(0.5 * (windowW - w * sc - 2 * parntL - parntW * (1 - sc)) / sc), 
                  "top" : Math.round(0.5 * (windowH - h * sc - 2 * parntT - parntH * (1 - sc)) / sc)
                });
            } else {
                $Img.animate({
                    "left" :    Math.round(-parntL - 0.5 * (1 - sc / inScle) * parntW + 0.5 * (windowW - w / inScle)), 
                    "top" : Math.round(-parntT - 0.5 * (1 - sc/inScle) * parntH + 0.5 * (windowH - h / inScle)),
                    "width" : Math.round((w / inScle)),
                    "height" : Math.round((h / inScle))
                }, 850,function(){$closeX.delay(700).fadeIn(400);
                    $darkbg.delay(700).fadeIn(400);
                    $caption.delay(700).fadeIn(400);
                });      
            }   
             
            //display "close" button and text caption
            $caption.css("top" , Math.round(0.5 * (windowH + h / ((smart * !settings.useJS) + (!smart + settings.useJS) * inScle))));       
            $closeX.css({"top" : Math.round(0.5 * (windowH - h / ((smart * !settings.useJS) + (!smart + settings.useJS) * inScle))), 
                        "left" : Math.round(0.5 * w / ((smart * !settings.useJS) + (!smart + settings.useJS) * inScle) + $closeX_left)
            });
            return $Img;
        }           
         
        // navigation buttons functioning
        function layersNavig($ths) { 
            if ((flags.allowParallax >= length) && (!$ths.hasClass('act'))) { //if it allowed to reorder layers
                animateLayersMobile();
                flags.useNavig = length;
                var actind = length - $navig.children('.act').index(), //determine new order of layers
                    curind = length - $ths.index(),
                    difr = length - 1 - actind;
                $navig.children('.act').removeClass('act');
                $ths.addClass('act'); //highlight new target navigation button
                Container = bringToTheFront($(Container[(curind + difr) % length]));//bring the appropriate layer to teh front
            }
        }   
         
        //destroy the slideshow
        function totalDestroy () {
            clearTimeout(timer1);
            clearTimeout(timer2);
            clearTimeout(timer3);
            clearTimeout(timer4);
            clearTimeout(timer5);
            clearTimeout(timer6);
            clearTimeout(timer7);
            clearInterval(timer8);
            main.children('div.container').children('.photo').off("click");
            $closeX.off("click");
            main.off("click");
            main.off("mousemove");
            main.children('div.container').children('.photo').off('mouseenter');
            main.children('div.container').children('.photo').off('mouseleave');
            !flags.isMobile * main.children('div.container').children('canvas.corners').off('click');
            $dark_layer1.remove();
            $dark_layer2.remove();
            $closeX.remove();
            $caption.remove();
            Container.remove();
        }   
        return start(); //run the slideshow script and return "main" - slideshow viewport element       
    }
 
    /* external sub-plugin for image loading */
    $.fn.loaded = function(callback, jointCallback, ensureCallback){
        var len = this.length;
        if (len > 0) {
            return this.each(function() {
                var el      = this,
                    $el     = $(el),
                    blank   = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                 
                $el.on("load.dt", function(event) {
                    $(this).off("load.dt");
                    if (typeof callback == "function") {
                        callback.call(this);
                    }
                    if (--len <= 0 && (typeof jointCallback == "function")){
                         
                        jointCallback.call(this);
                    }
                });
     
                if (!el.complete || el.complete === undefined) {
                    el.src = el.src;
                } else {
                    $el.trigger("load.dt")
                }
            });
        } else if (ensureCallback) {
            if (typeof jointCallback == "function") {
                jointCallback.call(this);
            }
            return this;
        }
    };
 
 
 
});

//jQuery(document).ready(function($) {

	/*!
	 * Isotope PACKAGED v2.1.0
	 * Filter & sort magical layouts
	 * http://isotope.metafizzy.co
	 */

	/**
	 * Bridget makes jQuery widgets
	 * v1.1.0
	 * MIT license
	 */

	;( function( window ) {



		// -------------------------- utils -------------------------- //

		var slice = Array.prototype.slice;

		function noop() {}

		// -------------------------- definition -------------------------- //

		function defineBridget( $ ) {

			// bail if no jQuery
			if ( !$ ) {
			  return;
			}

			// -------------------------- addOptionMethod -------------------------- //

			/**
			 * adds option method -> $().plugin('option', {...})
			 * @param {Function} PluginClass - constructor class
			 */
			function addOptionMethod( PluginClass ) {
			  // don't overwrite original option method
			  if ( PluginClass.prototype.option ) {
			    return;
			  }

			  // option setter
			  PluginClass.prototype.option = function( opts ) {
			    // bail out if not an object
			    if ( !$.isPlainObject( opts ) ){
			      return;
			    }
			    this.options = $.extend( true, this.options, opts );
			  };
			}

			// -------------------------- plugin bridge -------------------------- //

			// helper function for logging errors
			// $.error breaks jQuery chaining
			var logError = typeof console === 'undefined' ? noop :
			  function( message ) {
			    console.error( message );
			  };

			/**
			 * jQuery plugin bridge, access methods like $elem.plugin('method')
			 * @param {String} namespace - plugin name
			 * @param {Function} PluginClass - constructor class
			 */
			function bridge( namespace, PluginClass ) {
			  // add to jQuery fn namespace
			  $.fn[ namespace ] = function( options ) {
			    if ( typeof options === 'string' ) {
			      // call plugin method when first argument is a string
			      // get arguments for method
			      var args = slice.call( arguments, 1 );

			      for ( var i=0, len = this.length; i < len; i++ ) {
			        var elem = this[i];
			        var instance = $.data( elem, namespace );
			        if ( !instance ) {
			          logError( "cannot call methods on " + namespace + " prior to initialization; " +
			            "attempted to call '" + options + "'" );
			          continue;
			        }
			        if ( !$.isFunction( instance[options] ) || options.charAt(0) === '_' ) {
			          logError( "no such method '" + options + "' for " + namespace + " instance" );
			          continue;
			        }

			        // trigger method with arguments
			        var returnValue = instance[ options ].apply( instance, args );

			        // break look and return first value if provided
			        if ( returnValue !== undefined ) {
			          return returnValue;
			        }
			      }
			      // return this if no return value
			      return this;
			    } else {
			      return this.each( function() {
			        var instance = $.data( this, namespace );
			        if ( instance ) {
			          // apply options & init
			          instance.option( options );
			          instance._init();
			        } else {
			          // initialize new instance
			          instance = new PluginClass( this, options );
			          $.data( this, namespace, instance );
			        }
			      });
			    }
			  };

			}

			// -------------------------- bridget -------------------------- //

			/**
			 * converts a Prototypical class into a proper jQuery plugin
			 *   the class must have a ._init method
			 * @param {String} namespace - plugin name, used in $().pluginName
			 * @param {Function} PluginClass - constructor class
			 */
			$.bridget = function( namespace, PluginClass ) {
			  addOptionMethod( PluginClass );
			  bridge( namespace, PluginClass );
			};

			return $.bridget;

		}

		// transport
		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'jquery-bridget/jquery.bridget',[ 'jquery' ], defineBridget );
		} else if ( typeof exports === 'object' ) {
		  defineBridget( require('jquery') );
		} else {
		  // get jquery from browser global
		  defineBridget( window.jQuery );
		}

		})( window );

		/*!
		 * eventie v1.0.5
		 * event binding helper
		 *   eventie.bind( elem, 'click', myFn )
		 *   eventie.unbind( elem, 'click', myFn )
		 * MIT license
		 */

		/*jshint browser: true, undef: true, unused: true */
		/*global define: false, module: false */

		( function( window ) {



		var docElem = document.documentElement;

		var bind = function() {};

		function getIEEvent( obj ) {
		  var event = window.event;
		  // add event.target
		  event.target = event.target || event.srcElement || obj;
		  return event;
		}

		if ( docElem.addEventListener ) {
		  bind = function( obj, type, fn ) {
		    obj.addEventListener( type, fn, false );
		  };
		} else if ( docElem.attachEvent ) {
		  bind = function( obj, type, fn ) {
		    obj[ type + fn ] = fn.handleEvent ?
		      function() {
		        var event = getIEEvent( obj );
		        fn.handleEvent.call( fn, event );
		      } :
		      function() {
		        var event = getIEEvent( obj );
		        fn.call( obj, event );
		      };
		    obj.attachEvent( "on" + type, obj[ type + fn ] );
		  };
		}

		var unbind = function() {};

		if ( docElem.removeEventListener ) {
		  unbind = function( obj, type, fn ) {
		    obj.removeEventListener( type, fn, false );
		  };
		} else if ( docElem.detachEvent ) {
		  unbind = function( obj, type, fn ) {
		    obj.detachEvent( "on" + type, obj[ type + fn ] );
		    try {
		      delete obj[ type + fn ];
		    } catch ( err ) {
		      // can't delete window object properties
		      obj[ type + fn ] = undefined;
		    }
		  };
		}

		var eventie = {
		  bind: bind,
		  unbind: unbind
		};

		// ----- module definition ----- //

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'eventie/eventie',eventie );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = eventie;
		} else {
		  // browser global
		  window.eventie = eventie;
		}

		})( this );

		/*!
		 * docReady v1.0.4
		 * Cross browser DOMContentLoaded event emitter
		 * MIT license
		 */

		/*jshint browser: true, strict: true, undef: true, unused: true*/
		/*global define: false, require: false, module: false */

		( function( window ) {



		var document = window.document;
		// collection of functions to be triggered on ready
		var queue = [];

		function docReady( fn ) {
		  // throw out non-functions
		  if ( typeof fn !== 'function' ) {
		    return;
		  }

		  if ( docReady.isReady ) {
		    // ready now, hit it
		    fn();
		  } else {
		    // queue function when ready
		    queue.push( fn );
		  }
		}

		docReady.isReady = false;

		// triggered on various doc ready events
		function onReady( event ) {
		  // bail if already triggered or IE8 document is not ready just yet
		  var isIE8NotReady = event.type === 'readystatechange' && document.readyState !== 'complete';
		  if ( docReady.isReady || isIE8NotReady ) {
		    return;
		  }

		  trigger();
		}

		function trigger() {
		  docReady.isReady = true;
		  // process queue
		  for ( var i=0, len = queue.length; i < len; i++ ) {
		    var fn = queue[i];
		    fn();
		  }
		}

		function defineDocReady( eventie ) {
		  // trigger ready if page is ready
		  if ( document.readyState === 'complete' ) {
		    trigger();
		  } else {
		    // listen for events
		    eventie.bind( document, 'DOMContentLoaded', onReady );
		    eventie.bind( document, 'readystatechange', onReady );
		    eventie.bind( window, 'load', onReady );
		  }

		  return docReady;
		}

		// transport
		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'doc-ready/doc-ready',[ 'eventie/eventie' ], defineDocReady );
		} else if ( typeof exports === 'object' ) {
		  module.exports = defineDocReady( require('eventie') );
		} else {
		  // browser global
		  window.docReady = defineDocReady( window.eventie );
		}

		})( window );

		/*!
		 * EventEmitter v4.2.9 - git.io/ee
		 * Oliver Caldwell
		 * MIT license
		 * @preserve
		 */

		(function () {
		    

		    /**
		     * Class for managing events.
		     * Can be extended to provide event functionality in other classes.
		     *
		     * @class EventEmitter Manages event registering and emitting.
		     */
		    function EventEmitter() {}

		    // Shortcuts to improve speed and size
		    var proto = EventEmitter.prototype;
		    var exports = this;
		    var originalGlobalValue = exports.EventEmitter;

		    /**
		     * Finds the index of the listener for the event in its storage array.
		     *
		     * @param {Function[]} listeners Array of listeners to search through.
		     * @param {Function} listener Method to look for.
		     * @return {Number} Index of the specified listener, -1 if not found
		     * @api private
		     */
		    function indexOfListener(listeners, listener) {
		        var i = listeners.length;
		        while (i--) {
		            if (listeners[i].listener === listener) {
		                return i;
		            }
		        }

		        return -1;
		    }

		    /**
		     * Alias a method while keeping the context correct, to allow for overwriting of target method.
		     *
		     * @param {String} name The name of the target method.
		     * @return {Function} The aliased method
		     * @api private
		     */
		    function alias(name) {
		        return function aliasClosure() {
		            return this[name].apply(this, arguments);
		        };
		    }

		    /**
		     * Returns the listener array for the specified event.
		     * Will initialise the event object and listener arrays if required.
		     * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
		     * Each property in the object response is an array of listener functions.
		     *
		     * @param {String|RegExp} evt Name of the event to return the listeners from.
		     * @return {Function[]|Object} All listener functions for the event.
		     */
		    proto.getListeners = function getListeners(evt) {
		        var events = this._getEvents();
		        var response;
		        var key;

		        // Return a concatenated array of all matching events if
		        // the selector is a regular expression.
		        if (evt instanceof RegExp) {
		            response = {};
		            for (key in events) {
		                if (events.hasOwnProperty(key) && evt.test(key)) {
		                    response[key] = events[key];
		                }
		            }
		        }
		        else {
		            response = events[evt] || (events[evt] = []);
		        }

		        return response;
		    };

		    /**
		     * Takes a list of listener objects and flattens it into a list of listener functions.
		     *
		     * @param {Object[]} listeners Raw listener objects.
		     * @return {Function[]} Just the listener functions.
		     */
		    proto.flattenListeners = function flattenListeners(listeners) {
		        var flatListeners = [];
		        var i;

		        for (i = 0; i < listeners.length; i += 1) {
		            flatListeners.push(listeners[i].listener);
		        }

		        return flatListeners;
		    };

		    /**
		     * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
		     *
		     * @param {String|RegExp} evt Name of the event to return the listeners from.
		     * @return {Object} All listener functions for an event in an object.
		     */
		    proto.getListenersAsObject = function getListenersAsObject(evt) {
		        var listeners = this.getListeners(evt);
		        var response;

		        if (listeners instanceof Array) {
		            response = {};
		            response[evt] = listeners;
		        }

		        return response || listeners;
		    };

		    /**
		     * Adds a listener function to the specified event.
		     * The listener will not be added if it is a duplicate.
		     * If the listener returns true then it will be removed after it is called.
		     * If you pass a regular expression as the event name then the listener will be added to all events that match it.
		     *
		     * @param {String|RegExp} evt Name of the event to attach the listener to.
		     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.addListener = function addListener(evt, listener) {
		        var listeners = this.getListenersAsObject(evt);
		        var listenerIsWrapped = typeof listener === 'object';
		        var key;

		        for (key in listeners) {
		            if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
		                listeners[key].push(listenerIsWrapped ? listener : {
		                    listener: listener,
		                    once: false
		                });
		            }
		        }

		        return this;
		    };

		    /**
		     * Alias of addListener
		     */
		    proto.on = alias('addListener');

		    /**
		     * Semi-alias of addListener. It will add a listener that will be
		     * automatically removed after its first execution.
		     *
		     * @param {String|RegExp} evt Name of the event to attach the listener to.
		     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.addOnceListener = function addOnceListener(evt, listener) {
		        return this.addListener(evt, {
		            listener: listener,
		            once: true
		        });
		    };

		    /**
		     * Alias of addOnceListener.
		     */
		    proto.once = alias('addOnceListener');

		    /**
		     * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
		     * You need to tell it what event names should be matched by a regex.
		     *
		     * @param {String} evt Name of the event to create.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.defineEvent = function defineEvent(evt) {
		        this.getListeners(evt);
		        return this;
		    };

		    /**
		     * Uses defineEvent to define multiple events.
		     *
		     * @param {String[]} evts An array of event names to define.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.defineEvents = function defineEvents(evts) {
		        for (var i = 0; i < evts.length; i += 1) {
		            this.defineEvent(evts[i]);
		        }
		        return this;
		    };

		    /**
		     * Removes a listener function from the specified event.
		     * When passed a regular expression as the event name, it will remove the listener from all events that match it.
		     *
		     * @param {String|RegExp} evt Name of the event to remove the listener from.
		     * @param {Function} listener Method to remove from the event.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.removeListener = function removeListener(evt, listener) {
		        var listeners = this.getListenersAsObject(evt);
		        var index;
		        var key;

		        for (key in listeners) {
		            if (listeners.hasOwnProperty(key)) {
		                index = indexOfListener(listeners[key], listener);

		                if (index !== -1) {
		                    listeners[key].splice(index, 1);
		                }
		            }
		        }

		        return this;
		    };

		    /**
		     * Alias of removeListener
		     */
		    proto.off = alias('removeListener');

		    /**
		     * Adds listeners in bulk using the manipulateListeners method.
		     * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
		     * You can also pass it a regular expression to add the array of listeners to all events that match it.
		     * Yeah, this function does quite a bit. That's probably a bad thing.
		     *
		     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
		     * @param {Function[]} [listeners] An optional array of listener functions to add.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.addListeners = function addListeners(evt, listeners) {
		        // Pass through to manipulateListeners
		        return this.manipulateListeners(false, evt, listeners);
		    };

		    /**
		     * Removes listeners in bulk using the manipulateListeners method.
		     * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
		     * You can also pass it an event name and an array of listeners to be removed.
		     * You can also pass it a regular expression to remove the listeners from all events that match it.
		     *
		     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
		     * @param {Function[]} [listeners] An optional array of listener functions to remove.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.removeListeners = function removeListeners(evt, listeners) {
		        // Pass through to manipulateListeners
		        return this.manipulateListeners(true, evt, listeners);
		    };

		    /**
		     * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
		     * The first argument will determine if the listeners are removed (true) or added (false).
		     * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
		     * You can also pass it an event name and an array of listeners to be added/removed.
		     * You can also pass it a regular expression to manipulate the listeners of all events that match it.
		     *
		     * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
		     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
		     * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
		        var i;
		        var value;
		        var single = remove ? this.removeListener : this.addListener;
		        var multiple = remove ? this.removeListeners : this.addListeners;

		        // If evt is an object then pass each of its properties to this method
		        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
		            for (i in evt) {
		                if (evt.hasOwnProperty(i) && (value = evt[i])) {
		                    // Pass the single listener straight through to the singular method
		                    if (typeof value === 'function') {
		                        single.call(this, i, value);
		                    }
		                    else {
		                        // Otherwise pass back to the multiple function
		                        multiple.call(this, i, value);
		                    }
		                }
		            }
		        }
		        else {
		            // So evt must be a string
		            // And listeners must be an array of listeners
		            // Loop over it and pass each one to the multiple method
		            i = listeners.length;
		            while (i--) {
		                single.call(this, evt, listeners[i]);
		            }
		        }

		        return this;
		    };

		    /**
		     * Removes all listeners from a specified event.
		     * If you do not specify an event then all listeners will be removed.
		     * That means every event will be emptied.
		     * You can also pass a regex to remove all events that match it.
		     *
		     * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.removeEvent = function removeEvent(evt) {
		        var type = typeof evt;
		        var events = this._getEvents();
		        var key;

		        // Remove different things depending on the state of evt
		        if (type === 'string') {
		            // Remove all listeners for the specified event
		            delete events[evt];
		        }
		        else if (evt instanceof RegExp) {
		            // Remove all events matching the regex.
		            for (key in events) {
		                if (events.hasOwnProperty(key) && evt.test(key)) {
		                    delete events[key];
		                }
		            }
		        }
		        else {
		            // Remove all listeners in all events
		            delete this._events;
		        }

		        return this;
		    };

		    /**
		     * Alias of removeEvent.
		     *
		     * Added to mirror the node API.
		     */
		    proto.removeAllListeners = alias('removeEvent');

		    /**
		     * Emits an event of your choice.
		     * When emitted, every listener attached to that event will be executed.
		     * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
		     * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
		     * So they will not arrive within the array on the other side, they will be separate.
		     * You can also pass a regular expression to emit to all events that match it.
		     *
		     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
		     * @param {Array} [args] Optional array of arguments to be passed to each listener.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.emitEvent = function emitEvent(evt, args) {
		        var listeners = this.getListenersAsObject(evt);
		        var listener;
		        var i;
		        var key;
		        var response;

		        for (key in listeners) {
		            if (listeners.hasOwnProperty(key)) {
		                i = listeners[key].length;

		                while (i--) {
		                    // If the listener returns true then it shall be removed from the event
		                    // The function is executed either with a basic call or an apply if there is an args array
		                    listener = listeners[key][i];

		                    if (listener.once === true) {
		                        this.removeListener(evt, listener.listener);
		                    }

		                    response = listener.listener.apply(this, args || []);

		                    if (response === this._getOnceReturnValue()) {
		                        this.removeListener(evt, listener.listener);
		                    }
		                }
		            }
		        }

		        return this;
		    };

		    /**
		     * Alias of emitEvent
		     */
		    proto.trigger = alias('emitEvent');

		    /**
		     * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
		     * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
		     *
		     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
		     * @param {...*} Optional additional arguments to be passed to each listener.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.emit = function emit(evt) {
		        var args = Array.prototype.slice.call(arguments, 1);
		        return this.emitEvent(evt, args);
		    };

		    /**
		     * Sets the current value to check against when executing listeners. If a
		     * listeners return value matches the one set here then it will be removed
		     * after execution. This value defaults to true.
		     *
		     * @param {*} value The new value to check for when executing listeners.
		     * @return {Object} Current instance of EventEmitter for chaining.
		     */
		    proto.setOnceReturnValue = function setOnceReturnValue(value) {
		        this._onceReturnValue = value;
		        return this;
		    };

		    /**
		     * Fetches the current value to check against when executing listeners. If
		     * the listeners return value matches this one then it should be removed
		     * automatically. It will return true by default.
		     *
		     * @return {*|Boolean} The current value to check for or the default, true.
		     * @api private
		     */
		    proto._getOnceReturnValue = function _getOnceReturnValue() {
		        if (this.hasOwnProperty('_onceReturnValue')) {
		            return this._onceReturnValue;
		        }
		        else {
		            return true;
		        }
		    };

		    /**
		     * Fetches the events object and creates one if required.
		     *
		     * @return {Object} The events storage object.
		     * @api private
		     */
		    proto._getEvents = function _getEvents() {
		        return this._events || (this._events = {});
		    };

		    /**
		     * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
		     *
		     * @return {Function} Non conflicting EventEmitter class.
		     */
		    EventEmitter.noConflict = function noConflict() {
		        exports.EventEmitter = originalGlobalValue;
		        return EventEmitter;
		    };

		    // Expose the class either via AMD, CommonJS or the global object
		    if (typeof define === 'function' && define.amd) {
		        define('eventEmitter/EventEmitter',[],function () {
		            return EventEmitter;
		        });
		    }
		    else if (typeof module === 'object' && module.exports){
		        module.exports = EventEmitter;
		    }
		    else {
		        exports.EventEmitter = EventEmitter;
		    }
		}.call(this));

		/*!
		 * getStyleProperty v1.0.4
		 * original by kangax
		 * http://perfectionkills.com/feature-testing-css-properties/
		 * MIT license
		 */

		/*jshint browser: true, strict: true, undef: true */
		/*global define: false, exports: false, module: false */

		( function( window ) {



		var prefixes = 'Webkit Moz ms Ms O'.split(' ');
		var docElemStyle = document.documentElement.style;

		function getStyleProperty( propName ) {
		  if ( !propName ) {
		    return;
		  }

		  // test standard property first
		  if ( typeof docElemStyle[ propName ] === 'string' ) {
		    return propName;
		  }

		  // capitalize
		  propName = propName.charAt(0).toUpperCase() + propName.slice(1);

		  // test vendor specific properties
		  var prefixed;
		  for ( var i=0, len = prefixes.length; i < len; i++ ) {
		    prefixed = prefixes[i] + propName;
		    if ( typeof docElemStyle[ prefixed ] === 'string' ) {
		      return prefixed;
		    }
		  }
		}

		// transport
		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'get-style-property/get-style-property',[],function() {
		    return getStyleProperty;
		  });
		} else if ( typeof exports === 'object' ) {
		  // CommonJS for Component
		  module.exports = getStyleProperty;
		} else {
		  // browser global
		  window.getStyleProperty = getStyleProperty;
		}

		})( window );

		/*!
		 * getSize v1.2.2
		 * measure size of elements
		 * MIT license
		 */

		/*jshint browser: true, strict: true, undef: true, unused: true */
		/*global define: false, exports: false, require: false, module: false, console: false */

		( function( window, undefined ) {



		// -------------------------- helpers -------------------------- //

		// get a number from a string, not a percentage
		function getStyleSize( value ) {
		  var num = parseFloat( value );
		  // not a percent like '100%', and a number
		  var isValid = value.indexOf('%') === -1 && !isNaN( num );
		  return isValid && num;
		}

		function noop() {}

		var logError = typeof console === 'undefined' ? noop :
		  function( message ) {
		    console.error( message );
		  };

		// -------------------------- measurements -------------------------- //

		var measurements = [
		  'paddingLeft',
		  'paddingRight',
		  'paddingTop',
		  'paddingBottom',
		  'marginLeft',
		  'marginRight',
		  'marginTop',
		  'marginBottom',
		  'borderLeftWidth',
		  'borderRightWidth',
		  'borderTopWidth',
		  'borderBottomWidth'
		];

		function getZeroSize() {
		  var size = {
		    width: 0,
		    height: 0,
		    innerWidth: 0,
		    innerHeight: 0,
		    outerWidth: 0,
		    outerHeight: 0
		  };
		  for ( var i=0, len = measurements.length; i < len; i++ ) {
		    var measurement = measurements[i];
		    size[ measurement ] = 0;
		  }
		  return size;
		}



		function defineGetSize( getStyleProperty ) {

		// -------------------------- setup -------------------------- //

		var isSetup = false;

		var getStyle, boxSizingProp, isBoxSizeOuter;

		/**
		 * setup vars and functions
		 * do it on initial getSize(), rather than on script load
		 * For Firefox bug https://bugzilla.mozilla.org/show_bug.cgi?id=548397
		 */
		function setup() {
		  // setup once
		  if ( isSetup ) {
		    return;
		  }
		  isSetup = true;

		  var getComputedStyle = window.getComputedStyle;
		  getStyle = ( function() {
		    var getStyleFn = getComputedStyle ?
		      function( elem ) {
		        return getComputedStyle( elem, null );
		      } :
		      function( elem ) {
		        return elem.currentStyle;
		      };

		      return function getStyle( elem ) {
		        var style = getStyleFn( elem );
		        if ( !style ) {
		          logError( 'Style returned ' + style +
		            '. Are you running this code in a hidden iframe on Firefox? ' +
		            'See http://bit.ly/getsizebug1' );
		        }
		        return style;
		      };
		  })();

		  // -------------------------- box sizing -------------------------- //

		  boxSizingProp = getStyleProperty('boxSizing');

		  /**
		   * WebKit measures the outer-width on style.width on border-box elems
		   * IE & Firefox measures the inner-width
		   */
		  if ( boxSizingProp ) {
		    var div = document.createElement('div');
		    div.style.width = '200px';
		    div.style.padding = '1px 2px 3px 4px';
		    div.style.borderStyle = 'solid';
		    div.style.borderWidth = '1px 2px 3px 4px';
		    div.style[ boxSizingProp ] = 'border-box';

		    var body = document.body || document.documentElement;
		    body.appendChild( div );
		    var style = getStyle( div );

		    isBoxSizeOuter = getStyleSize( style.width ) === 200;
		    body.removeChild( div );
		  }

		}

		// -------------------------- getSize -------------------------- //

		function getSize( elem ) {
		  setup();

		  // use querySeletor if elem is string
		  if ( typeof elem === 'string' ) {
		    elem = document.querySelector( elem );
		  }

		  // do not proceed on non-objects
		  if ( !elem || typeof elem !== 'object' || !elem.nodeType ) {
		    return;
		  }

		  var style = getStyle( elem );

		  // if hidden, everything is 0
		  if ( style.display === 'none' ) {
		    return getZeroSize();
		  }

		  var size = {};
		  size.width = elem.offsetWidth;
		  size.height = elem.offsetHeight;

		  var isBorderBox = size.isBorderBox = !!( boxSizingProp &&
		    style[ boxSizingProp ] && style[ boxSizingProp ] === 'border-box' );

		  // get all measurements
		  for ( var i=0, len = measurements.length; i < len; i++ ) {
		    var measurement = measurements[i];
		    var value = style[ measurement ];
		    value = mungeNonPixel( elem, value );
		    var num = parseFloat( value );
		    // any 'auto', 'medium' value will be 0
		    size[ measurement ] = !isNaN( num ) ? num : 0;
		  }

		  var paddingWidth = size.paddingLeft + size.paddingRight;
		  var paddingHeight = size.paddingTop + size.paddingBottom;
		  var marginWidth = size.marginLeft + size.marginRight;
		  var marginHeight = size.marginTop + size.marginBottom;
		  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
		  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

		  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

		  // overwrite width and height if we can get it from style
		  var styleWidth = getStyleSize( style.width );
		  if ( styleWidth !== false ) {
		    size.width = styleWidth +
		      // add padding and border unless it's already including it
		      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
		  }

		  var styleHeight = getStyleSize( style.height );
		  if ( styleHeight !== false ) {
		    size.height = styleHeight +
		      // add padding and border unless it's already including it
		      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
		  }

		  size.innerWidth = size.width - ( paddingWidth + borderWidth );
		  size.innerHeight = size.height - ( paddingHeight + borderHeight );

		  size.outerWidth = size.width + marginWidth;
		  size.outerHeight = size.height + marginHeight;

		  return size;
		}

		// IE8 returns percent values, not pixels
		// taken from jQuery's curCSS
		function mungeNonPixel( elem, value ) {
		  // IE8 and has percent value
		  if ( window.getComputedStyle || value.indexOf('%') === -1 ) {
		    return value;
		  }
		  var style = elem.style;
		  // Remember the original values
		  var left = style.left;
		  var rs = elem.runtimeStyle;
		  var rsLeft = rs && rs.left;

		  // Put in the new values to get a computed value out
		  if ( rsLeft ) {
		    rs.left = elem.currentStyle.left;
		  }
		  style.left = value;
		  value = style.pixelLeft;

		  // Revert the changed values
		  style.left = left;
		  if ( rsLeft ) {
		    rs.left = rsLeft;
		  }

		  return value;
		}

		return getSize;

		}

		// transport
		if ( typeof define === 'function' && define.amd ) {
		  // AMD for RequireJS
		  define( 'get-size/get-size',[ 'get-style-property/get-style-property' ], defineGetSize );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS for Component
		  module.exports = defineGetSize( require('desandro-get-style-property') );
		} else {
		  // browser global
		  window.getSize = defineGetSize( window.getStyleProperty );
		}

		})( window );

		/**
		 * matchesSelector v1.0.2
		 * matchesSelector( element, '.selector' )
		 * MIT license
		 */

		/*jshint browser: true, strict: true, undef: true, unused: true */
		/*global define: false, module: false */

		( function( ElemProto ) {

		  

		  var matchesMethod = ( function() {
		    // check un-prefixed
		    if ( ElemProto.matchesSelector ) {
		      return 'matchesSelector';
		    }
		    // check vendor prefixes
		    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

		    for ( var i=0, len = prefixes.length; i < len; i++ ) {
		      var prefix = prefixes[i];
		      var method = prefix + 'MatchesSelector';
		      if ( ElemProto[ method ] ) {
		        return method;
		      }
		    }
		  })();

		  // ----- match ----- //

		  function match( elem, selector ) {
		    return elem[ matchesMethod ]( selector );
		  }

		  // ----- appendToFragment ----- //

		  function checkParent( elem ) {
		    // not needed if already has parent
		    if ( elem.parentNode ) {
		      return;
		    }
		    var fragment = document.createDocumentFragment();
		    fragment.appendChild( elem );
		  }

		  // ----- query ----- //

		  // fall back to using QSA
		  // thx @jonathantneal https://gist.github.com/3062955
		  function query( elem, selector ) {
		    // append to fragment if no parent
		    checkParent( elem );

		    // match elem with all selected elems of parent
		    var elems = elem.parentNode.querySelectorAll( selector );
		    for ( var i=0, len = elems.length; i < len; i++ ) {
		      // return true if match
		      if ( elems[i] === elem ) {
		        return true;
		      }
		    }
		    // otherwise return false
		    return false;
		  }

		  // ----- matchChild ----- //

		  function matchChild( elem, selector ) {
		    checkParent( elem );
		    return match( elem, selector );
		  }

		  // ----- matchesSelector ----- //

		  var matchesSelector;

		  if ( matchesMethod ) {
		    // IE9 supports matchesSelector, but doesn't work on orphaned elems
		    // check for that
		    var div = document.createElement('div');
		    var supportsOrphans = match( div, 'div' );
		    matchesSelector = supportsOrphans ? match : matchChild;
		  } else {
		    matchesSelector = query;
		  }

		  // transport
		  if ( typeof define === 'function' && define.amd ) {
		    // AMD
		    define( 'matches-selector/matches-selector',[],function() {
		      return matchesSelector;
		    });
		  } else if ( typeof exports === 'object' ) {
		    module.exports = matchesSelector;
		  }
		  else {
		    // browser global
		    window.matchesSelector = matchesSelector;
		  }

		})( Element.prototype );

		/**
		 * Outlayer Item
		 */

		( function( window ) {



		// ----- get style ----- //

		var getComputedStyle = window.getComputedStyle;
		var getStyle = getComputedStyle ?
		  function( elem ) {
		    return getComputedStyle( elem, null );
		  } :
		  function( elem ) {
		    return elem.currentStyle;
		  };


		// extend objects
		function extend( a, b ) {
		  for ( var prop in b ) {
		    a[ prop ] = b[ prop ];
		  }
		  return a;
		}

		function isEmptyObj( obj ) {
		  for ( var prop in obj ) {
		    return false;
		  }
		  prop = null;
		  return true;
		}

		// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
		function toDash( str ) {
		  return str.replace( /([A-Z])/g, function( $1 ){
		    return '-' + $1.toLowerCase();
		  });
		}

		// -------------------------- Outlayer definition -------------------------- //

		function outlayerItemDefinition( EventEmitter, getSize, getStyleProperty ) {

		// -------------------------- CSS3 support -------------------------- //

		var transitionProperty = getStyleProperty('transition');
		var transformProperty = getStyleProperty('transform');
		var supportsCSS3 = transitionProperty && transformProperty;
		var is3d = !!getStyleProperty('perspective');

		var transitionEndEvent = {
		  WebkitTransition: 'webkitTransitionEnd',
		  MozTransition: 'transitionend',
		  OTransition: 'otransitionend',
		  transition: 'transitionend'
		}[ transitionProperty ];

		// properties that could have vendor prefix
		var prefixableProperties = [
		  'transform',
		  'transition',
		  'transitionDuration',
		  'transitionProperty'
		];

		// cache all vendor properties
		var vendorProperties = ( function() {
		  var cache = {};
		  for ( var i=0, len = prefixableProperties.length; i < len; i++ ) {
		    var prop = prefixableProperties[i];
		    var supportedProp = getStyleProperty( prop );
		    if ( supportedProp && supportedProp !== prop ) {
		      cache[ prop ] = supportedProp;
		    }
		  }
		  return cache;
		})();

		// -------------------------- Item -------------------------- //

		function Item( element, layout ) {
		  if ( !element ) {
		    return;
		  }

		  this.element = element;
		  // parent layout class, i.e. Masonry, Isotope, or Packery
		  this.layout = layout;
		  this.position = {
		    x: 0,
		    y: 0
		  };

		  this._create();
		}

		// inherit EventEmitter
		extend( Item.prototype, EventEmitter.prototype );

		Item.prototype._create = function() {
		  // transition objects
		  this._transn = {
		    ingProperties: {},
		    clean: {},
		    onEnd: {}
		  };

		  this.css({
		    position: 'absolute'
		  });
		};

		// trigger specified handler for event type
		Item.prototype.handleEvent = function( event ) {
		  var method = 'on' + event.type;
		  if ( this[ method ] ) {
		    this[ method ]( event );
		  }
		};

		Item.prototype.getSize = function() {
		  this.size = getSize( this.element );
		};

		/**
		 * apply CSS styles to element
		 * @param {Object} style
		 */
		Item.prototype.css = function( style ) {
		  var elemStyle = this.element.style;

		  for ( var prop in style ) {
		    // use vendor property if available
		    var supportedProp = vendorProperties[ prop ] || prop;
		    elemStyle[ supportedProp ] = style[ prop ];
		  }
		};

		 // measure position, and sets it
		Item.prototype.getPosition = function() {
		  var style = getStyle( this.element );
		  var layoutOptions = this.layout.options;
		  var isOriginLeft = layoutOptions.isOriginLeft;
		  var isOriginTop = layoutOptions.isOriginTop;
		  var x = parseInt( style[ isOriginLeft ? 'left' : 'right' ], 10 );
		  var y = parseInt( style[ isOriginTop ? 'top' : 'bottom' ], 10 );

		  // clean up 'auto' or other non-integer values
		  x = isNaN( x ) ? 0 : x;
		  y = isNaN( y ) ? 0 : y;
		  // remove padding from measurement
		  var layoutSize = this.layout.size;
		  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
		  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

		  this.position.x = x;
		  this.position.y = y;
		};

		// set settled position, apply padding
		Item.prototype.layoutPosition = function() {
		  var layoutSize = this.layout.size;
		  var layoutOptions = this.layout.options;
		  var style = {};

		  if ( layoutOptions.isOriginLeft ) {
		    style.left = ( this.position.x + layoutSize.paddingLeft ) + 'px';
		    // reset other property
		    style.right = '';
		  } else {
		    style.right = ( this.position.x + layoutSize.paddingRight ) + 'px';
		    style.left = '';
		  }

		  if ( layoutOptions.isOriginTop ) {
		    style.top = ( this.position.y + layoutSize.paddingTop ) + 'px';
		    style.bottom = '';
		  } else {
		    style.bottom = ( this.position.y + layoutSize.paddingBottom ) + 'px';
		    style.top = '';
		  }

		  this.css( style );
		  this.emitEvent( 'layout', [ this ] );
		};


		// transform translate function
		var translate = is3d ?
		  function( x, y ) {
		    return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
		  } :
		  function( x, y ) {
		    return 'translate(' + x + 'px, ' + y + 'px)';
		  };


		Item.prototype._transitionTo = function( x, y ) {
		  this.getPosition();
		  // get current x & y from top/left
		  var curX = this.position.x;
		  var curY = this.position.y;

		  var compareX = parseInt( x, 10 );
		  var compareY = parseInt( y, 10 );
		  var didNotMove = compareX === this.position.x && compareY === this.position.y;

		  // save end position
		  this.setPosition( x, y );

		  // if did not move and not transitioning, just go to layout
		  if ( didNotMove && !this.isTransitioning ) {
		    this.layoutPosition();
		    return;
		  }

		  var transX = x - curX;
		  var transY = y - curY;
		  var transitionStyle = {};
		  // flip cooridinates if origin on right or bottom
		  var layoutOptions = this.layout.options;
		  transX = layoutOptions.isOriginLeft ? transX : -transX;
		  transY = layoutOptions.isOriginTop ? transY : -transY;
		  transitionStyle.transform = translate( transX, transY );

		  this.transition({
		    to: transitionStyle,
		    onTransitionEnd: {
		      transform: this.layoutPosition
		    },
		    isCleaning: true
		  });
		};

		// non transition + transform support
		Item.prototype.goTo = function( x, y ) {
		  this.setPosition( x, y );
		  this.layoutPosition();
		};

		// use transition and transforms if supported
		Item.prototype.moveTo = supportsCSS3 ?
		  Item.prototype._transitionTo : Item.prototype.goTo;

		Item.prototype.setPosition = function( x, y ) {
		  this.position.x = parseInt( x, 10 );
		  this.position.y = parseInt( y, 10 );
		};

		// ----- transition ----- //

		/**
		 * @param {Object} style - CSS
		 * @param {Function} onTransitionEnd
		 */

		// non transition, just trigger callback
		Item.prototype._nonTransition = function( args ) {
		  this.css( args.to );
		  if ( args.isCleaning ) {
		    this._removeStyles( args.to );
		  }
		  for ( var prop in args.onTransitionEnd ) {
		    args.onTransitionEnd[ prop ].call( this );
		  }
		};

		/**
		 * proper transition
		 * @param {Object} args - arguments
		 *   @param {Object} to - style to transition to
		 *   @param {Object} from - style to start transition from
		 *   @param {Boolean} isCleaning - removes transition styles after transition
		 *   @param {Function} onTransitionEnd - callback
		 */
		Item.prototype._transition = function( args ) {
		  // redirect to nonTransition if no transition duration
		  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
		    this._nonTransition( args );
		    return;
		  }

		  var _transition = this._transn;
		  // keep track of onTransitionEnd callback by css property
		  for ( var prop in args.onTransitionEnd ) {
		    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
		  }
		  // keep track of properties that are transitioning
		  for ( prop in args.to ) {
		    _transition.ingProperties[ prop ] = true;
		    // keep track of properties to clean up when transition is done
		    if ( args.isCleaning ) {
		      _transition.clean[ prop ] = true;
		    }
		  }

		  // set from styles
		  if ( args.from ) {
		    this.css( args.from );
		    // force redraw. http://blog.alexmaccaw.com/css-transitions
		    var h = this.element.offsetHeight;
		    // hack for JSHint to hush about unused var
		    h = null;
		  }
		  // enable transition
		  this.enableTransition( args.to );
		  // set styles that are transitioning
		  this.css( args.to );

		  this.isTransitioning = true;

		};

		var itemTransitionProperties = transformProperty && ( toDash( transformProperty ) +
		  ',opacity' );

		Item.prototype.enableTransition = function(/* style */) {
		  // only enable if not already transitioning
		  // bug in IE10 were re-setting transition style will prevent
		  // transitionend event from triggering
		  if ( this.isTransitioning ) {
		    return;
		  }

		  // make transition: foo, bar, baz from style object
		  // TODO uncomment this bit when IE10 bug is resolved
		  // var transitionValue = [];
		  // for ( var prop in style ) {
		  //   // dash-ify camelCased properties like WebkitTransition
		  //   transitionValue.push( toDash( prop ) );
		  // }
		  // enable transition styles
		  // HACK always enable transform,opacity for IE10
		  this.css({
		    transitionProperty: itemTransitionProperties,
		    transitionDuration: this.layout.options.transitionDuration
		  });
		  // listen for transition end event
		  this.element.addEventListener( transitionEndEvent, this, false );
		};

		Item.prototype.transition = Item.prototype[ transitionProperty ? '_transition' : '_nonTransition' ];

		// ----- events ----- //

		Item.prototype.onwebkitTransitionEnd = function( event ) {
		  this.ontransitionend( event );
		};

		Item.prototype.onotransitionend = function( event ) {
		  this.ontransitionend( event );
		};

		// properties that I munge to make my life easier
		var dashedVendorProperties = {
		  '-webkit-transform': 'transform',
		  '-moz-transform': 'transform',
		  '-o-transform': 'transform'
		};

		Item.prototype.ontransitionend = function( event ) {
		  // disregard bubbled events from children
		  if ( event.target !== this.element ) {
		    return;
		  }
		  var _transition = this._transn;
		  // get property name of transitioned property, convert to prefix-free
		  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

		  // remove property that has completed transitioning
		  delete _transition.ingProperties[ propertyName ];
		  // check if any properties are still transitioning
		  if ( isEmptyObj( _transition.ingProperties ) ) {
		    // all properties have completed transitioning
		    this.disableTransition();
		  }
		  // clean style
		  if ( propertyName in _transition.clean ) {
		    // clean up style
		    this.element.style[ event.propertyName ] = '';
		    delete _transition.clean[ propertyName ];
		  }
		  // trigger onTransitionEnd callback
		  if ( propertyName in _transition.onEnd ) {
		    var onTransitionEnd = _transition.onEnd[ propertyName ];
		    onTransitionEnd.call( this );
		    delete _transition.onEnd[ propertyName ];
		  }

		  this.emitEvent( 'transitionEnd', [ this ] );
		};

		Item.prototype.disableTransition = function() {
		  this.removeTransitionStyles();
		  this.element.removeEventListener( transitionEndEvent, this, false );
		  this.isTransitioning = false;
		};

		/**
		 * removes style property from element
		 * @param {Object} style
		**/
		Item.prototype._removeStyles = function( style ) {
		  // clean up transition styles
		  var cleanStyle = {};
		  for ( var prop in style ) {
		    cleanStyle[ prop ] = '';
		  }
		  this.css( cleanStyle );
		};

		var cleanTransitionStyle = {
		  transitionProperty: '',
		  transitionDuration: ''
		};

		Item.prototype.removeTransitionStyles = function() {
		  // remove transition
		  this.css( cleanTransitionStyle );
		};

		// ----- show/hide/remove ----- //

		// remove element from DOM
		Item.prototype.removeElem = function() {
		  this.element.parentNode.removeChild( this.element );
		  this.emitEvent( 'remove', [ this ] );
		};

		Item.prototype.remove = function() {
		  // just remove element if no transition support or no transition
		  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
		    this.removeElem();
		    return;
		  }

		  // start transition
		  var _this = this;
		  this.on( 'transitionEnd', function() {
		    _this.removeElem();
		    return true; // bind once
		  });
		  this.hide();
		};

		Item.prototype.reveal = function() {
		  delete this.isHidden;
		  // remove display: none
		  this.css({ display: '' });

		  var options = this.layout.options;
		  this.transition({
		    from: options.hiddenStyle,
		    to: options.visibleStyle,
		    isCleaning: true
		  });
		};

		Item.prototype.hide = function() {
		  // set flag
		  this.isHidden = true;
		  // remove display: none
		  this.css({ display: '' });

		  var options = this.layout.options;
		  this.transition({
		    from: options.visibleStyle,
		    to: options.hiddenStyle,
		    // keep hidden stuff hidden
		    isCleaning: true,
		    onTransitionEnd: {
		      opacity: function() {
		        // check if still hidden
		        // during transition, item may have been un-hidden
		        if ( this.isHidden ) {
		          this.css({ display: 'none' });
		        }
		      }
		    }
		  });
		};

		Item.prototype.destroy = function() {
		  this.css({
		    position: '',
		    left: '',
		    right: '',
		    top: '',
		    bottom: '',
		    transition: '',
		    transform: ''
		  });
		};

		return Item;

		}

		// -------------------------- transport -------------------------- //

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'outlayer/item',[
		      'eventEmitter/EventEmitter',
		      'get-size/get-size',
		      'get-style-property/get-style-property'
		    ],
		    outlayerItemDefinition );
		} else if (typeof exports === 'object') {
		  // CommonJS
		  module.exports = outlayerItemDefinition(
		    require('wolfy87-eventemitter'),
		    require('get-size'),
		    require('desandro-get-style-property')
		  );
		} else {
		  // browser global
		  window.Outlayer = {};
		  window.Outlayer.Item = outlayerItemDefinition(
		    window.EventEmitter,
		    window.getSize,
		    window.getStyleProperty
		  );
		}

		})( window );

		/*!
		 * Outlayer v1.3.0
		 * the brains and guts of a layout library
		 * MIT license
		 */

		( function( window ) {



		// ----- vars ----- //

		var document = window.document;
		var console = window.console;
		var jQuery = window.jQuery;
		var noop = function() {};

		// -------------------------- helpers -------------------------- //

		// extend objects
		function extend( a, b ) {
		  for ( var prop in b ) {
		    a[ prop ] = b[ prop ];
		  }
		  return a;
		}


		var objToString = Object.prototype.toString;
		function isArray( obj ) {
		  return objToString.call( obj ) === '[object Array]';
		}

		// turn element or nodeList into an array
		function makeArray( obj ) {
		  var ary = [];
		  if ( isArray( obj ) ) {
		    // use object if already an array
		    ary = obj;
		  } else if ( obj && typeof obj.length === 'number' ) {
		    // convert nodeList to array
		    for ( var i=0, len = obj.length; i < len; i++ ) {
		      ary.push( obj[i] );
		    }
		  } else {
		    // array of single index
		    ary.push( obj );
		  }
		  return ary;
		}

		// http://stackoverflow.com/a/384380/182183
		var isElement = ( typeof HTMLElement === 'function' || typeof HTMLElement === 'object' ) ?
		  function isElementDOM2( obj ) {
		    return obj instanceof HTMLElement;
		  } :
		  function isElementQuirky( obj ) {
		    return obj && typeof obj === 'object' &&
		      obj.nodeType === 1 && typeof obj.nodeName === 'string';
		  };

		// index of helper cause IE8
		var indexOf = Array.prototype.indexOf ? function( ary, obj ) {
		    return ary.indexOf( obj );
		  } : function( ary, obj ) {
		    for ( var i=0, len = ary.length; i < len; i++ ) {
		      if ( ary[i] === obj ) {
		        return i;
		      }
		    }
		    return -1;
		  };

		function removeFrom( obj, ary ) {
		  var index = indexOf( ary, obj );
		  if ( index !== -1 ) {
		    ary.splice( index, 1 );
		  }
		}

		// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
		function toDashed( str ) {
		  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
		    return $1 + '-' + $2;
		  }).toLowerCase();
		}


		function outlayerDefinition( eventie, docReady, EventEmitter, getSize, matchesSelector, Item ) {

		// -------------------------- Outlayer -------------------------- //

		// globally unique identifiers
		var GUID = 0;
		// internal store of all Outlayer intances
		var instances = {};


		/**
		 * @param {Element, String} element
		 * @param {Object} options
		 * @constructor
		 */
		function Outlayer( element, options ) {
		  // use element as selector string
		  if ( typeof element === 'string' ) {
		    element = document.querySelector( element );
		  }

		  // bail out if not proper element
		  if ( !element || !isElement( element ) ) {
		    if ( console ) {
		      console.error( 'Bad ' + this.constructor.namespace + ' element: ' + element );
		    }
		    return;
		  }

		  this.element = element;

		  // options
		  this.options = extend( {}, this.constructor.defaults );
		  this.option( options );

		  // add id for Outlayer.getFromElement
		  var id = ++GUID;
		  this.element.outlayerGUID = id; // expando
		  instances[ id ] = this; // associate via id

		  // kick it off
		  this._create();

		  if ( this.options.isInitLayout ) {
		    this.layout();
		  }
		}

		// settings are for internal use only
		Outlayer.namespace = 'outlayer';
		Outlayer.Item = Item;

		// default options
		Outlayer.defaults = {
		  containerStyle: {
		    position: 'relative'
		  },
		  isInitLayout: true,
		  isOriginLeft: true,
		  isOriginTop: true,
		  isResizeBound: true,
		  isResizingContainer: true,
		  // item options
		  transitionDuration: '0.4s',
		  hiddenStyle: {
		    opacity: 0,
		    transform: 'scale(0.001)'
		  },
		  visibleStyle: {
		    opacity: 1,
		    transform: 'scale(1)'
		  }
		};

		// inherit EventEmitter
		extend( Outlayer.prototype, EventEmitter.prototype );

		/**
		 * set options
		 * @param {Object} opts
		 */
		Outlayer.prototype.option = function( opts ) {
		  extend( this.options, opts );
		};

		Outlayer.prototype._create = function() {
		  // get items from children
		  this.reloadItems();
		  // elements that affect layout, but are not laid out
		  this.stamps = [];
		  this.stamp( this.options.stamp );
		  // set container style
		  extend( this.element.style, this.options.containerStyle );

		  // bind resize method
		  if ( this.options.isResizeBound ) {
		    this.bindResize();
		  }
		};

		// goes through all children again and gets bricks in proper order
		Outlayer.prototype.reloadItems = function() {
		  // collection of item elements
		  this.items = this._itemize( this.element.children );
		};


		/**
		 * turn elements into Outlayer.Items to be used in layout
		 * @param {Array or NodeList or HTMLElement} elems
		 * @returns {Array} items - collection of new Outlayer Items
		 */
		Outlayer.prototype._itemize = function( elems ) {

		  var itemElems = this._filterFindItemElements( elems );
		  var Item = this.constructor.Item;

		  // create new Outlayer Items for collection
		  var items = [];
		  for ( var i=0, len = itemElems.length; i < len; i++ ) {
		    var elem = itemElems[i];
		    var item = new Item( elem, this );
		    items.push( item );
		  }

		  return items;
		};

		/**
		 * get item elements to be used in layout
		 * @param {Array or NodeList or HTMLElement} elems
		 * @returns {Array} items - item elements
		 */
		Outlayer.prototype._filterFindItemElements = function( elems ) {
		  // make array of elems
		  elems = makeArray( elems );
		  var itemSelector = this.options.itemSelector;
		  var itemElems = [];

		  for ( var i=0, len = elems.length; i < len; i++ ) {
		    var elem = elems[i];
		    // check that elem is an actual element
		    if ( !isElement( elem ) ) {
		      continue;
		    }
		    // filter & find items if we have an item selector
		    if ( itemSelector ) {
		      // filter siblings
		      if ( matchesSelector( elem, itemSelector ) ) {
		        itemElems.push( elem );
		      }
		      // find children
		      var childElems = elem.querySelectorAll( itemSelector );
		      // concat childElems to filterFound array
		      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
		        itemElems.push( childElems[j] );
		      }
		    } else {
		      itemElems.push( elem );
		    }
		  }

		  return itemElems;
		};

		/**
		 * getter method for getting item elements
		 * @returns {Array} elems - collection of item elements
		 */
		Outlayer.prototype.getItemElements = function() {
		  var elems = [];
		  for ( var i=0, len = this.items.length; i < len; i++ ) {
		    elems.push( this.items[i].element );
		  }
		  return elems;
		};

		// ----- init & layout ----- //

		/**
		 * lays out all items
		 */
		Outlayer.prototype.layout = function() {
		  this._resetLayout();
		  this._manageStamps();

		  // don't animate first layout
		  var isInstant = this.options.isLayoutInstant !== undefined ?
		    this.options.isLayoutInstant : !this._isLayoutInited;
		  this.layoutItems( this.items, isInstant );

		  // flag for initalized
		  this._isLayoutInited = true;
		};

		// _init is alias for layout
		Outlayer.prototype._init = Outlayer.prototype.layout;

		/**
		 * logic before any new layout
		 */
		Outlayer.prototype._resetLayout = function() {
		  this.getSize();
		};


		Outlayer.prototype.getSize = function() {
		  this.size = getSize( this.element );
		};

		/**
		 * get measurement from option, for columnWidth, rowHeight, gutter
		 * if option is String -> get element from selector string, & get size of element
		 * if option is Element -> get size of element
		 * else use option as a number
		 *
		 * @param {String} measurement
		 * @param {String} size - width or height
		 * @private
		 */
		Outlayer.prototype._getMeasurement = function( measurement, size ) {
		  var option = this.options[ measurement ];
		  var elem;
		  if ( !option ) {
		    // default to 0
		    this[ measurement ] = 0;
		  } else {
		    // use option as an element
		    if ( typeof option === 'string' ) {
		      elem = this.element.querySelector( option );
		    } else if ( isElement( option ) ) {
		      elem = option;
		    }
		    // use size of element, if element
		    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
		  }
		};

		/**
		 * layout a collection of item elements
		 * @api public
		 */
		Outlayer.prototype.layoutItems = function( items, isInstant ) {
		  items = this._getItemsForLayout( items );

		  this._layoutItems( items, isInstant );

		  this._postLayout();
		};

		/**
		 * get the items to be laid out
		 * you may want to skip over some items
		 * @param {Array} items
		 * @returns {Array} items
		 */
		Outlayer.prototype._getItemsForLayout = function( items ) {
		  var layoutItems = [];
		  for ( var i=0, len = items.length; i < len; i++ ) {
		    var item = items[i];
		    if ( !item.isIgnored ) {
		      layoutItems.push( item );
		    }
		  }
		  return layoutItems;
		};

		/**
		 * layout items
		 * @param {Array} items
		 * @param {Boolean} isInstant
		 */
		Outlayer.prototype._layoutItems = function( items, isInstant ) {
		  var _this = this;
		  function onItemsLayout() {
		    _this.emitEvent( 'layoutComplete', [ _this, items ] );
		  }

		  if ( !items || !items.length ) {
		    // no items, emit event with empty array
		    onItemsLayout();
		    return;
		  }

		  // emit layoutComplete when done
		  this._itemsOn( items, 'layout', onItemsLayout );

		  var queue = [];

		  for ( var i=0, len = items.length; i < len; i++ ) {
		    var item = items[i];
		    // get x/y object from method
		    var position = this._getItemLayoutPosition( item );
		    // enqueue
		    position.item = item;
		    position.isInstant = isInstant || item.isLayoutInstant;
		    queue.push( position );
		  }

		  this._processLayoutQueue( queue );
		};

		/**
		 * get item layout position
		 * @param {Outlayer.Item} item
		 * @returns {Object} x and y position
		 */
		Outlayer.prototype._getItemLayoutPosition = function( /* item */ ) {
		  return {
		    x: 0,
		    y: 0
		  };
		};

		/**
		 * iterate over array and position each item
		 * Reason being - separating this logic prevents 'layout invalidation'
		 * thx @paul_irish
		 * @param {Array} queue
		 */
		Outlayer.prototype._processLayoutQueue = function( queue ) {
		  for ( var i=0, len = queue.length; i < len; i++ ) {
		    var obj = queue[i];
		    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant );
		  }
		};

		/**
		 * Sets position of item in DOM
		 * @param {Outlayer.Item} item
		 * @param {Number} x - horizontal position
		 * @param {Number} y - vertical position
		 * @param {Boolean} isInstant - disables transitions
		 */
		Outlayer.prototype._positionItem = function( item, x, y, isInstant ) {
		  if ( isInstant ) {
		    // if not transition, just set CSS
		    item.goTo( x, y );
		  } else {
		    item.moveTo( x, y );
		  }
		};

		/**
		 * Any logic you want to do after each layout,
		 * i.e. size the container
		 */
		Outlayer.prototype._postLayout = function() {
		  this.resizeContainer();
		};

		Outlayer.prototype.resizeContainer = function() {
		  if ( !this.options.isResizingContainer ) {
		    return;
		  }
		  var size = this._getContainerSize();
		  if ( size ) {
		    this._setContainerMeasure( size.width, true );
		    this._setContainerMeasure( size.height, false );
		  }
		};

		/**
		 * Sets width or height of container if returned
		 * @returns {Object} size
		 *   @param {Number} width
		 *   @param {Number} height
		 */
		Outlayer.prototype._getContainerSize = noop;

		/**
		 * @param {Number} measure - size of width or height
		 * @param {Boolean} isWidth
		 */
		Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
		  if ( measure === undefined ) {
		    return;
		  }

		  var elemSize = this.size;
		  // add padding and border width if border box
		  if ( elemSize.isBorderBox ) {
		    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
		      elemSize.borderLeftWidth + elemSize.borderRightWidth :
		      elemSize.paddingBottom + elemSize.paddingTop +
		      elemSize.borderTopWidth + elemSize.borderBottomWidth;
		  }

		  measure = Math.max( measure, 0 );
		  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
		};

		/**
		 * trigger a callback for a collection of items events
		 * @param {Array} items - Outlayer.Items
		 * @param {String} eventName
		 * @param {Function} callback
		 */
		Outlayer.prototype._itemsOn = function( items, eventName, callback ) {
		  var doneCount = 0;
		  var count = items.length;
		  // event callback
		  var _this = this;
		  function tick() {
		    doneCount++;
		    if ( doneCount === count ) {
		      callback.call( _this );
		    }
		    return true; // bind once
		  }
		  // bind callback
		  for ( var i=0, len = items.length; i < len; i++ ) {
		    var item = items[i];
		    item.on( eventName, tick );
		  }
		};

		// -------------------------- ignore & stamps -------------------------- //


		/**
		 * keep item in collection, but do not lay it out
		 * ignored items do not get skipped in layout
		 * @param {Element} elem
		 */
		Outlayer.prototype.ignore = function( elem ) {
		  var item = this.getItem( elem );
		  if ( item ) {
		    item.isIgnored = true;
		  }
		};

		/**
		 * return item to layout collection
		 * @param {Element} elem
		 */
		Outlayer.prototype.unignore = function( elem ) {
		  var item = this.getItem( elem );
		  if ( item ) {
		    delete item.isIgnored;
		  }
		};

		/**
		 * adds elements to stamps
		 * @param {NodeList, Array, Element, or String} elems
		 */
		Outlayer.prototype.stamp = function( elems ) {
		  elems = this._find( elems );
		  if ( !elems ) {
		    return;
		  }

		  this.stamps = this.stamps.concat( elems );
		  // ignore
		  for ( var i=0, len = elems.length; i < len; i++ ) {
		    var elem = elems[i];
		    this.ignore( elem );
		  }
		};

		/**
		 * removes elements to stamps
		 * @param {NodeList, Array, or Element} elems
		 */
		Outlayer.prototype.unstamp = function( elems ) {
		  elems = this._find( elems );
		  if ( !elems ){
		    return;
		  }

		  for ( var i=0, len = elems.length; i < len; i++ ) {
		    var elem = elems[i];
		    // filter out removed stamp elements
		    removeFrom( elem, this.stamps );
		    this.unignore( elem );
		  }

		};

		/**
		 * finds child elements
		 * @param {NodeList, Array, Element, or String} elems
		 * @returns {Array} elems
		 */
		Outlayer.prototype._find = function( elems ) {
		  if ( !elems ) {
		    return;
		  }
		  // if string, use argument as selector string
		  if ( typeof elems === 'string' ) {
		    elems = this.element.querySelectorAll( elems );
		  }
		  elems = makeArray( elems );
		  return elems;
		};

		Outlayer.prototype._manageStamps = function() {
		  if ( !this.stamps || !this.stamps.length ) {
		    return;
		  }

		  this._getBoundingRect();

		  for ( var i=0, len = this.stamps.length; i < len; i++ ) {
		    var stamp = this.stamps[i];
		    this._manageStamp( stamp );
		  }
		};

		// update boundingLeft / Top
		Outlayer.prototype._getBoundingRect = function() {
		  // get bounding rect for container element
		  var boundingRect = this.element.getBoundingClientRect();
		  var size = this.size;
		  this._boundingRect = {
		    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
		    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
		    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
		    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
		  };
		};

		/**
		 * @param {Element} stamp
		**/
		Outlayer.prototype._manageStamp = noop;

		/**
		 * get x/y position of element relative to container element
		 * @param {Element} elem
		 * @returns {Object} offset - has left, top, right, bottom
		 */
		Outlayer.prototype._getElementOffset = function( elem ) {
		  var boundingRect = elem.getBoundingClientRect();
		  var thisRect = this._boundingRect;
		  var size = getSize( elem );
		  var offset = {
		    left: boundingRect.left - thisRect.left - size.marginLeft,
		    top: boundingRect.top - thisRect.top - size.marginTop,
		    right: thisRect.right - boundingRect.right - size.marginRight,
		    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
		  };
		  return offset;
		};

		// -------------------------- resize -------------------------- //

		// enable event handlers for listeners
		// i.e. resize -> onresize
		Outlayer.prototype.handleEvent = function( event ) {
		  var method = 'on' + event.type;
		  if ( this[ method ] ) {
		    this[ method ]( event );
		  }
		};

		/**
		 * Bind layout to window resizing
		 */
		Outlayer.prototype.bindResize = function() {
		  // bind just one listener
		  if ( this.isResizeBound ) {
		    return;
		  }
		  eventie.bind( window, 'resize', this );
		  this.isResizeBound = true;
		};

		/**
		 * Unbind layout to window resizing
		 */
		Outlayer.prototype.unbindResize = function() {
		  if ( this.isResizeBound ) {
		    eventie.unbind( window, 'resize', this );
		  }
		  this.isResizeBound = false;
		};

		// original debounce by John Hann
		// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

		// this fires every resize
		Outlayer.prototype.onresize = function() {
		  if ( this.resizeTimeout ) {
		    clearTimeout( this.resizeTimeout );
		  }

		  var _this = this;
		  function delayed() {
		    _this.resize();
		    delete _this.resizeTimeout;
		  }

		  this.resizeTimeout = setTimeout( delayed, 100 );
		};

		// debounced, layout on resize
		Outlayer.prototype.resize = function() {
		  // don't trigger if size did not change
		  // or if resize was unbound. See #9
		  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
		    return;
		  }

		  this.layout();
		};

		/**
		 * check if layout is needed post layout
		 * @returns Boolean
		 */
		Outlayer.prototype.needsResizeLayout = function() {
		  var size = getSize( this.element );
		  // check that this.size and size are there
		  // IE8 triggers resize on body size change, so they might not be
		  var hasSizes = this.size && size;
		  return hasSizes && size.innerWidth !== this.size.innerWidth;
		};

		// -------------------------- methods -------------------------- //

		/**
		 * add items to Outlayer instance
		 * @param {Array or NodeList or Element} elems
		 * @returns {Array} items - Outlayer.Items
		**/
		Outlayer.prototype.addItems = function( elems ) {
		  var items = this._itemize( elems );
		  // add items to collection
		  if ( items.length ) {
		    this.items = this.items.concat( items );
		  }
		  return items;
		};

		/**
		 * Layout newly-appended item elements
		 * @param {Array or NodeList or Element} elems
		 */
		Outlayer.prototype.appended = function( elems ) {
		  var items = this.addItems( elems );
		  if ( !items.length ) {
		    return;
		  }
		  // layout and reveal just the new items
		  this.layoutItems( items, true );
		  this.reveal( items );
		};

		/**
		 * Layout prepended elements
		 * @param {Array or NodeList or Element} elems
		 */
		Outlayer.prototype.prepended = function( elems ) {
		  var items = this._itemize( elems );
		  if ( !items.length ) {
		    return;
		  }
		  // add items to beginning of collection
		  var previousItems = this.items.slice(0);
		  this.items = items.concat( previousItems );
		  // start new layout
		  this._resetLayout();
		  this._manageStamps();
		  // layout new stuff without transition
		  this.layoutItems( items, true );
		  this.reveal( items );
		  // layout previous items
		  this.layoutItems( previousItems );
		};

		/**
		 * reveal a collection of items
		 * @param {Array of Outlayer.Items} items
		 */
		Outlayer.prototype.reveal = function( items ) {
		  var len = items && items.length;
		  if ( !len ) {
		    return;
		  }
		  for ( var i=0; i < len; i++ ) {
		    var item = items[i];
		    item.reveal();
		  }
		};

		/**
		 * hide a collection of items
		 * @param {Array of Outlayer.Items} items
		 */
		Outlayer.prototype.hide = function( items ) {
		  var len = items && items.length;
		  if ( !len ) {
		    return;
		  }
		  for ( var i=0; i < len; i++ ) {
		    var item = items[i];
		    item.hide();
		  }
		};

		/**
		 * get Outlayer.Item, given an Element
		 * @param {Element} elem
		 * @param {Function} callback
		 * @returns {Outlayer.Item} item
		 */
		Outlayer.prototype.getItem = function( elem ) {
		  // loop through items to get the one that matches
		  for ( var i=0, len = this.items.length; i < len; i++ ) {
		    var item = this.items[i];
		    if ( item.element === elem ) {
		      // return item
		      return item;
		    }
		  }
		};

		/**
		 * get collection of Outlayer.Items, given Elements
		 * @param {Array} elems
		 * @returns {Array} items - Outlayer.Items
		 */
		Outlayer.prototype.getItems = function( elems ) {
		  if ( !elems || !elems.length ) {
		    return;
		  }
		  var items = [];
		  for ( var i=0, len = elems.length; i < len; i++ ) {
		    var elem = elems[i];
		    var item = this.getItem( elem );
		    if ( item ) {
		      items.push( item );
		    }
		  }

		  return items;
		};

		/**
		 * remove element(s) from instance and DOM
		 * @param {Array or NodeList or Element} elems
		 */
		Outlayer.prototype.remove = function( elems ) {
		  elems = makeArray( elems );

		  var removeItems = this.getItems( elems );
		  // bail if no items to remove
		  if ( !removeItems || !removeItems.length ) {
		    return;
		  }

		  this._itemsOn( removeItems, 'remove', function() {
		    this.emitEvent( 'removeComplete', [ this, removeItems ] );
		  });

		  for ( var i=0, len = removeItems.length; i < len; i++ ) {
		    var item = removeItems[i];
		    item.remove();
		    // remove item from collection
		    removeFrom( item, this.items );
		  }
		};

		// ----- destroy ----- //

		// remove and disable Outlayer instance
		Outlayer.prototype.destroy = function() {
		  // clean up dynamic styles
		  var style = this.element.style;
		  style.height = '';
		  style.position = '';
		  style.width = '';
		  // destroy items
		  for ( var i=0, len = this.items.length; i < len; i++ ) {
		    var item = this.items[i];
		    item.destroy();
		  }

		  this.unbindResize();

		  var id = this.element.outlayerGUID;
		  delete instances[ id ]; // remove reference to instance by id
		  delete this.element.outlayerGUID;
		  // remove data for jQuery
		  if ( jQuery ) {
		    jQuery.removeData( this.element, this.constructor.namespace );
		  }

		};

		// -------------------------- data -------------------------- //

		/**
		 * get Outlayer instance from element
		 * @param {Element} elem
		 * @returns {Outlayer}
		 */
		Outlayer.data = function( elem ) {
		  var id = elem && elem.outlayerGUID;
		  return id && instances[ id ];
		};


		// -------------------------- create Outlayer class -------------------------- //

		/**
		 * create a layout class
		 * @param {String} namespace
		 */
		Outlayer.create = function( namespace, options ) {
		  // sub-class Outlayer
		  function Layout() {
		    Outlayer.apply( this, arguments );
		  }
		  // inherit Outlayer prototype, use Object.create if there
		  if ( Object.create ) {
		    Layout.prototype = Object.create( Outlayer.prototype );
		  } else {
		    extend( Layout.prototype, Outlayer.prototype );
		  }
		  // set contructor, used for namespace and Item
		  Layout.prototype.constructor = Layout;

		  Layout.defaults = extend( {}, Outlayer.defaults );
		  // apply new options
		  extend( Layout.defaults, options );
		  // keep prototype.settings for backwards compatibility (Packery v1.2.0)
		  Layout.prototype.settings = {};

		  Layout.namespace = namespace;

		  Layout.data = Outlayer.data;

		  // sub-class Item
		  Layout.Item = function LayoutItem() {
		    Item.apply( this, arguments );
		  };

		  Layout.Item.prototype = new Item();

		  // -------------------------- declarative -------------------------- //

		  /**
		   * allow user to initialize Outlayer via .js-namespace class
		   * options are parsed from data-namespace-option attribute
		   */
		  docReady( function() {
		    var dashedNamespace = toDashed( namespace );
		    var elems = document.querySelectorAll( '.js-' + dashedNamespace );
		    var dataAttr = 'data-' + dashedNamespace + '-options';

		    for ( var i=0, len = elems.length; i < len; i++ ) {
		      var elem = elems[i];
		      var attr = elem.getAttribute( dataAttr );
		      var options;
		      try {
		        options = attr && JSON.parse( attr );
		      } catch ( error ) {
		        // log error, do not initialize
		        if ( console ) {
		          console.error( 'Error parsing ' + dataAttr + ' on ' +
		            elem.nodeName.toLowerCase() + ( elem.id ? '#' + elem.id : '' ) + ': ' +
		            error );
		        }
		        continue;
		      }
		      // initialize
		      var instance = new Layout( elem, options );
		      // make available via $().data('layoutname')
		      if ( jQuery ) {
		        jQuery.data( elem, namespace, instance );
		      }
		    }
		  });

		  // -------------------------- jQuery bridge -------------------------- //

		  // make into jQuery plugin
		  if ( jQuery && jQuery.bridget ) {
		    jQuery.bridget( namespace, Layout );
		  }

		  return Layout;
		};

		// ----- fin ----- //

		// back in global
		Outlayer.Item = Item;

		return Outlayer;

		}

		// -------------------------- transport -------------------------- //

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'outlayer/outlayer',[
		      'eventie/eventie',
		      'doc-ready/doc-ready',
		      'eventEmitter/EventEmitter',
		      'get-size/get-size',
		      'matches-selector/matches-selector',
		      './item'
		    ],
		    outlayerDefinition );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = outlayerDefinition(
		    require('eventie'),
		    require('doc-ready'),
		    require('wolfy87-eventemitter'),
		    require('get-size'),
		    require('desandro-matches-selector'),
		    require('./item')
		  );
		} else {
		  // browser global
		  window.Outlayer = outlayerDefinition(
		    window.eventie,
		    window.docReady,
		    window.EventEmitter,
		    window.getSize,
		    window.matchesSelector,
		    window.Outlayer.Item
		  );
		}

		})( window );

		/**
		 * Isotope Item
		**/

		( function( window ) {



		// -------------------------- Item -------------------------- //

		function itemDefinition( Outlayer ) {

		// sub-class Outlayer Item
		function Item() {
		  Outlayer.Item.apply( this, arguments );
		}

		Item.prototype = new Outlayer.Item();

		Item.prototype._create = function() {
		  // assign id, used for original-order sorting
		  this.id = this.layout.itemGUID++;
		  Outlayer.Item.prototype._create.call( this );
		  this.sortData = {};
		};

		Item.prototype.updateSortData = function() {
		  if ( this.isIgnored ) {
		    return;
		  }
		  // default sorters
		  this.sortData.id = this.id;
		  // for backward compatibility
		  this.sortData['original-order'] = this.id;
		  this.sortData.random = Math.random();
		  // go thru getSortData obj and apply the sorters
		  var getSortData = this.layout.options.getSortData;
		  var sorters = this.layout._sorters;
		  for ( var key in getSortData ) {
		    var sorter = sorters[ key ];
		    this.sortData[ key ] = sorter( this.element, this );
		  }
		};

		var _destroy = Item.prototype.destroy;
		Item.prototype.destroy = function() {
		  // call super
		  _destroy.apply( this, arguments );
		  // reset display, #741
		  this.css({
		    display: ''
		  });
		};

		return Item;

		}

		// -------------------------- transport -------------------------- //

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'isotope/js/item',[
		      'outlayer/outlayer'
		    ],
		    itemDefinition );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = itemDefinition(
		    require('outlayer')
		  );
		} else {
		  // browser global
		  window.Isotope = window.Isotope || {};
		  window.Isotope.Item = itemDefinition(
		    window.Outlayer
		  );
		}

		})( window );

		( function( window ) {



		// --------------------------  -------------------------- //

		function layoutModeDefinition( getSize, Outlayer ) {

		  // layout mode class
		  function LayoutMode( isotope ) {
		    this.isotope = isotope;
		    // link properties
		    if ( isotope ) {
		      this.options = isotope.options[ this.namespace ];
		      this.element = isotope.element;
		      this.items = isotope.filteredItems;
		      this.size = isotope.size;
		    }
		  }

		  /**
		   * some methods should just defer to default Outlayer method
		   * and reference the Isotope instance as `this`
		  **/
		  ( function() {
		    var facadeMethods = [
		      '_resetLayout',
		      '_getItemLayoutPosition',
		      '_manageStamp',
		      '_getContainerSize',
		      '_getElementOffset',
		      'needsResizeLayout'
		    ];

		    for ( var i=0, len = facadeMethods.length; i < len; i++ ) {
		      var methodName = facadeMethods[i];
		      LayoutMode.prototype[ methodName ] = getOutlayerMethod( methodName );
		    }

		    function getOutlayerMethod( methodName ) {
		      return function() {
		        return Outlayer.prototype[ methodName ].apply( this.isotope, arguments );
		      };
		    }
		  })();

		  // -----  ----- //

		  // for horizontal layout modes, check vertical size
		  LayoutMode.prototype.needsVerticalResizeLayout = function() {
		    // don't trigger if size did not change
		    var size = getSize( this.isotope.element );
		    // check that this.size and size are there
		    // IE8 triggers resize on body size change, so they might not be
		    var hasSizes = this.isotope.size && size;
		    return hasSizes && size.innerHeight !== this.isotope.size.innerHeight;
		  };

		  // ----- measurements ----- //

		  LayoutMode.prototype._getMeasurement = function() {
		    this.isotope._getMeasurement.apply( this, arguments );
		  };

		  LayoutMode.prototype.getColumnWidth = function() {
		    this.getSegmentSize( 'column', 'Width' );
		  };

		  LayoutMode.prototype.getRowHeight = function() {
		    this.getSegmentSize( 'row', 'Height' );
		  };

		  /**
		   * get columnWidth or rowHeight
		   * segment: 'column' or 'row'
		   * size 'Width' or 'Height'
		  **/
		  LayoutMode.prototype.getSegmentSize = function( segment, size ) {
		    var segmentName = segment + size;
		    var outerSize = 'outer' + size;
		    // columnWidth / outerWidth // rowHeight / outerHeight
		    this._getMeasurement( segmentName, outerSize );
		    // got rowHeight or columnWidth, we can chill
		    if ( this[ segmentName ] ) {
		      return;
		    }
		    // fall back to item of first element
		    var firstItemSize = this.getFirstItemSize();
		    this[ segmentName ] = firstItemSize && firstItemSize[ outerSize ] ||
		      // or size of container
		      this.isotope.size[ 'inner' + size ];
		  };

		  LayoutMode.prototype.getFirstItemSize = function() {
		    var firstItem = this.isotope.filteredItems[0];
		    return firstItem && firstItem.element && getSize( firstItem.element );
		  };

		  // ----- methods that should reference isotope ----- //

		  LayoutMode.prototype.layout = function() {
		    this.isotope.layout.apply( this.isotope, arguments );
		  };

		  LayoutMode.prototype.getSize = function() {
		    this.isotope.getSize();
		    this.size = this.isotope.size;
		  };

		  // -------------------------- create -------------------------- //

		  LayoutMode.modes = {};

		  LayoutMode.create = function( namespace, options ) {

		    function Mode() {
		      LayoutMode.apply( this, arguments );
		    }

		    Mode.prototype = new LayoutMode();

		    // default options
		    if ( options ) {
		      Mode.options = options;
		    }

		    Mode.prototype.namespace = namespace;
		    // register in Isotope
		    LayoutMode.modes[ namespace ] = Mode;

		    return Mode;
		  };


		  return LayoutMode;

		}

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'isotope/js/layout-mode',[
		      'get-size/get-size',
		      'outlayer/outlayer'
		    ],
		    layoutModeDefinition );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = layoutModeDefinition(
		    require('get-size'),
		    require('outlayer')
		  );
		} else {
		  // browser global
		  window.Isotope = window.Isotope || {};
		  window.Isotope.LayoutMode = layoutModeDefinition(
		    window.getSize,
		    window.Outlayer
		  );
		}


		})( window );

		/*!
		 * Masonry v3.2.1
		 * Cascading grid layout library
		 * http://masonry.desandro.com
		 * MIT License
		 * by David DeSandro
		 */

		( function( window ) {



		// -------------------------- helpers -------------------------- //

		var indexOf = Array.prototype.indexOf ?
		  function( items, value ) {
		    return items.indexOf( value );
		  } :
		  function ( items, value ) {
		    for ( var i=0, len = items.length; i < len; i++ ) {
		      var item = items[i];
		      if ( item === value ) {
		        return i;
		      }
		    }
		    return -1;
		  };

		// -------------------------- masonryDefinition -------------------------- //

		// used for AMD definition and requires
		function masonryDefinition( Outlayer, getSize ) {
		  // create an Outlayer layout class
		  var Masonry = Outlayer.create('masonry');

		  Masonry.prototype._resetLayout = function() {
		    this.getSize();
		    this._getMeasurement( 'columnWidth', 'outerWidth' );
		    this._getMeasurement( 'gutter', 'outerWidth' );
		    this.measureColumns();

		    // reset column Y
		    var i = this.cols;
		    this.colYs = [];
		    while (i--) {
		      this.colYs.push( 0 );
		    }

		    this.maxY = 0;
		  };

		  Masonry.prototype.measureColumns = function() {
		    this.getContainerWidth();
		    // if columnWidth is 0, default to outerWidth of first item
		    if ( !this.columnWidth ) {
		      var firstItem = this.items[0];
		      var firstItemElem = firstItem && firstItem.element;
		      // columnWidth fall back to item of first element
		      this.columnWidth = firstItemElem && getSize( firstItemElem ).outerWidth ||
		        // if first elem has no width, default to size of container
		        this.containerWidth;
		    }

		    this.columnWidth += this.gutter;

		    this.cols = Math.floor( ( this.containerWidth + this.gutter ) / this.columnWidth );
		    this.cols = Math.max( this.cols, 1 );
		  };

		  Masonry.prototype.getContainerWidth = function() {
		    // container is parent if fit width
		    var container = this.options.isFitWidth ? this.element.parentNode : this.element;
		    // check that this.size and size are there
		    // IE8 triggers resize on body size change, so they might not be
		    var size = getSize( container );
		    this.containerWidth = size && size.innerWidth;
		  };

		  Masonry.prototype._getItemLayoutPosition = function( item ) {
		    item.getSize();
		    // how many columns does this brick span
		    var remainder = item.size.outerWidth % this.columnWidth;
		    var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
		    // round if off by 1 pixel, otherwise use ceil
		    var colSpan = Math[ mathMethod ]( item.size.outerWidth / this.columnWidth );
		    colSpan = Math.min( colSpan, this.cols );

		    var colGroup = this._getColGroup( colSpan );
		    // get the minimum Y value from the columns
		    var minimumY = Math.min.apply( Math, colGroup );
		    var shortColIndex = indexOf( colGroup, minimumY );

		    // position the brick
		    var position = {
		      x: this.columnWidth * shortColIndex,
		      y: minimumY
		    };

		    // apply setHeight to necessary columns
		    var setHeight = minimumY + item.size.outerHeight;
		    var setSpan = this.cols + 1 - colGroup.length;
		    for ( var i = 0; i < setSpan; i++ ) {
		      this.colYs[ shortColIndex + i ] = setHeight;
		    }

		    return position;
		  };

		  /**
		   * @param {Number} colSpan - number of columns the element spans
		   * @returns {Array} colGroup
		   */
		  Masonry.prototype._getColGroup = function( colSpan ) {
		    if ( colSpan < 2 ) {
		      // if brick spans only one column, use all the column Ys
		      return this.colYs;
		    }

		    var colGroup = [];
		    // how many different places could this brick fit horizontally
		    var groupCount = this.cols + 1 - colSpan;
		    // for each group potential horizontal position
		    for ( var i = 0; i < groupCount; i++ ) {
		      // make an array of colY values for that one group
		      var groupColYs = this.colYs.slice( i, i + colSpan );
		      // and get the max value of the array
		      colGroup[i] = Math.max.apply( Math, groupColYs );
		    }
		    return colGroup;
		  };

		  Masonry.prototype._manageStamp = function( stamp ) {
		    var stampSize = getSize( stamp );
		    var offset = this._getElementOffset( stamp );
		    // get the columns that this stamp affects
		    var firstX = this.options.isOriginLeft ? offset.left : offset.right;
		    var lastX = firstX + stampSize.outerWidth;
		    var firstCol = Math.floor( firstX / this.columnWidth );
		    firstCol = Math.max( 0, firstCol );
		    var lastCol = Math.floor( lastX / this.columnWidth );
		    // lastCol should not go over if multiple of columnWidth #425
		    lastCol -= lastX % this.columnWidth ? 0 : 1;
		    lastCol = Math.min( this.cols - 1, lastCol );
		    // set colYs to bottom of the stamp
		    var stampMaxY = ( this.options.isOriginTop ? offset.top : offset.bottom ) +
		      stampSize.outerHeight;
		    for ( var i = firstCol; i <= lastCol; i++ ) {
		      this.colYs[i] = Math.max( stampMaxY, this.colYs[i] );
		    }
		  };

		  Masonry.prototype._getContainerSize = function() {
		    this.maxY = Math.max.apply( Math, this.colYs );
		    var size = {
		      height: this.maxY
		    };

		    if ( this.options.isFitWidth ) {
		      size.width = this._getContainerFitWidth();
		    }

		    return size;
		  };

		  Masonry.prototype._getContainerFitWidth = function() {
		    var unusedCols = 0;
		    // count unused columns
		    var i = this.cols;
		    while ( --i ) {
		      if ( this.colYs[i] !== 0 ) {
		        break;
		      }
		      unusedCols++;
		    }
		    // fit container to columns that have been used
		    return ( this.cols - unusedCols ) * this.columnWidth - this.gutter;
		  };

		  Masonry.prototype.needsResizeLayout = function() {
		    var previousWidth = this.containerWidth;
		    this.getContainerWidth();
		    return previousWidth !== this.containerWidth;
		  };

		  return Masonry;
		}

		// -------------------------- transport -------------------------- //

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'masonry/masonry',[
		      'outlayer/outlayer',
		      'get-size/get-size'
		    ],
		    masonryDefinition );
		} else if (typeof exports === 'object') {
		  module.exports = masonryDefinition(
		    require('outlayer'),
		    require('get-size')
		  );
		} else {
		  // browser global
		  window.Masonry = masonryDefinition(
		    window.Outlayer,
		    window.getSize
		  );
		}

		})( window );

		/*!
		 * Masonry layout mode
		 * sub-classes Masonry
		 * http://masonry.desandro.com
		 */

		( function( window ) {



		// -------------------------- helpers -------------------------- //

		// extend objects
		function extend( a, b ) {
		  for ( var prop in b ) {
		    a[ prop ] = b[ prop ];
		  }
		  return a;
		}

		// -------------------------- masonryDefinition -------------------------- //

		// used for AMD definition and requires
		function masonryDefinition( LayoutMode, Masonry ) {
		  // create an Outlayer layout class
		  var MasonryMode = LayoutMode.create('masonry');

		  // save on to these methods
		  var _getElementOffset = MasonryMode.prototype._getElementOffset;
		  var layout = MasonryMode.prototype.layout;
		  var _getMeasurement = MasonryMode.prototype._getMeasurement;

		  // sub-class Masonry
		  extend( MasonryMode.prototype, Masonry.prototype );

		  // set back, as it was overwritten by Masonry
		  MasonryMode.prototype._getElementOffset = _getElementOffset;
		  MasonryMode.prototype.layout = layout;
		  MasonryMode.prototype._getMeasurement = _getMeasurement;

		  var measureColumns = MasonryMode.prototype.measureColumns;
		  MasonryMode.prototype.measureColumns = function() {
		    // set items, used if measuring first item
		    this.items = this.isotope.filteredItems;
		    measureColumns.call( this );
		  };

		  // HACK copy over isOriginLeft/Top options
		  var _manageStamp = MasonryMode.prototype._manageStamp;
		  MasonryMode.prototype._manageStamp = function() {
		    this.options.isOriginLeft = this.isotope.options.isOriginLeft;
		    this.options.isOriginTop = this.isotope.options.isOriginTop;
		    _manageStamp.apply( this, arguments );
		  };

		  return MasonryMode;
		}

		// -------------------------- transport -------------------------- //

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'isotope/js/layout-modes/masonry',[
		      '../layout-mode',
		      'masonry/masonry'
		    ],
		    masonryDefinition );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = masonryDefinition(
		    require('../layout-mode'),
		    require('masonry-layout')
		  );
		} else {
		  // browser global
		  masonryDefinition(
		    window.Isotope.LayoutMode,
		    window.Masonry
		  );
		}

		})( window );

		( function( window ) {



		function fitRowsDefinition( LayoutMode ) {

		var FitRows = LayoutMode.create('fitRows');

		FitRows.prototype._resetLayout = function() {
		  this.x = 0;
		  this.y = 0;
		  this.maxY = 0;
		  this._getMeasurement( 'gutter', 'outerWidth' );
		};

		FitRows.prototype._getItemLayoutPosition = function( item ) {
		  item.getSize();

		  var itemWidth = item.size.outerWidth + this.gutter;
		  // if this element cannot fit in the current row
		  var containerWidth = this.isotope.size.innerWidth + this.gutter;
		  if ( this.x !== 0 && itemWidth + this.x > containerWidth ) {
		    this.x = 0;
		    this.y = this.maxY;
		  }

		  var position = {
		    x: this.x,
		    y: this.y
		  };

		  this.maxY = Math.max( this.maxY, this.y + item.size.outerHeight );
		  this.x += itemWidth;

		  return position;
		};

		FitRows.prototype._getContainerSize = function() {
		  return { height: this.maxY };
		};

		return FitRows;

		}

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'isotope/js/layout-modes/fit-rows',[
		      '../layout-mode'
		    ],
		    fitRowsDefinition );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = fitRowsDefinition(
		    require('../layout-mode')
		  );
		} else {
		  // browser global
		  fitRowsDefinition(
		    window.Isotope.LayoutMode
		  );
		}

		})( window );

		( function( window ) {



		function verticalDefinition( LayoutMode ) {

		var Vertical = LayoutMode.create( 'vertical', {
		  horizontalAlignment: 0
		});

		Vertical.prototype._resetLayout = function() {
		  this.y = 0;
		};

		Vertical.prototype._getItemLayoutPosition = function( item ) {
		  item.getSize();
		  var x = ( this.isotope.size.innerWidth - item.size.outerWidth ) *
		    this.options.horizontalAlignment;
		  var y = this.y;
		  this.y += item.size.outerHeight;
		  return { x: x, y: y };
		};

		Vertical.prototype._getContainerSize = function() {
		  return { height: this.y };
		};

		return Vertical;

		}

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( 'isotope/js/layout-modes/vertical',[
		      '../layout-mode'
		    ],
		    verticalDefinition );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = verticalDefinition(
		    require('../layout-mode')
		  );
		} else {
		  // browser global
		  verticalDefinition(
		    window.Isotope.LayoutMode
		  );
		}

		})( window );

		/*!
		 * Isotope v2.1.0
		 * Filter & sort magical layouts
		 * http://isotope.metafizzy.co
		 */

		( function( window ) {



		// -------------------------- vars -------------------------- //

		var jQuery = window.jQuery;

		// -------------------------- helpers -------------------------- //

		// extend objects
		function extend( a, b ) {
		  for ( var prop in b ) {
		    a[ prop ] = b[ prop ];
		  }
		  return a;
		}

		var trim = String.prototype.trim ?
		  function( str ) {
		    return str.trim();
		  } :
		  function( str ) {
		    return str.replace( /^\s+|\s+$/g, '' );
		  };

		var docElem = document.documentElement;

		var getText = docElem.textContent ?
		  function( elem ) {
		    return elem.textContent;
		  } :
		  function( elem ) {
		    return elem.innerText;
		  };

		var objToString = Object.prototype.toString;
		function isArray( obj ) {
		  return objToString.call( obj ) === '[object Array]';
		}

		// index of helper cause IE8
		var indexOf = Array.prototype.indexOf ? function( ary, obj ) {
		    return ary.indexOf( obj );
		  } : function( ary, obj ) {
		    for ( var i=0, len = ary.length; i < len; i++ ) {
		      if ( ary[i] === obj ) {
		        return i;
		      }
		    }
		    return -1;
		  };

		// turn element or nodeList into an array
		function makeArray( obj ) {
		  var ary = [];
		  if ( isArray( obj ) ) {
		    // use object if already an array
		    ary = obj;
		  } else if ( obj && typeof obj.length === 'number' ) {
		    // convert nodeList to array
		    for ( var i=0, len = obj.length; i < len; i++ ) {
		      ary.push( obj[i] );
		    }
		  } else {
		    // array of single index
		    ary.push( obj );
		  }
		  return ary;
		}

		function removeFrom( obj, ary ) {
		  var index = indexOf( ary, obj );
		  if ( index !== -1 ) {
		    ary.splice( index, 1 );
		  }
		}

		// -------------------------- isotopeDefinition -------------------------- //

		// used for AMD definition and requires
		function isotopeDefinition( Outlayer, getSize, matchesSelector, Item, LayoutMode ) {
		  // create an Outlayer layout class
		  var Isotope = Outlayer.create( 'isotope', {
		    layoutMode: "masonry",
		    isJQueryFiltering: true,
		    sortAscending: true
		  });

		  Isotope.Item = Item;
		  Isotope.LayoutMode = LayoutMode;

		  Isotope.prototype._create = function() {
		    this.itemGUID = 0;
		    // functions that sort items
		    this._sorters = {};
		    this._getSorters();
		    // call super
		    Outlayer.prototype._create.call( this );

		    // create layout modes
		    this.modes = {};
		    // start filteredItems with all items
		    this.filteredItems = this.items;
		    // keep of track of sortBys
		    this.sortHistory = [ 'original-order' ];
		    // create from registered layout modes
		    for ( var name in LayoutMode.modes ) {
		      this._initLayoutMode( name );
		    }
		  };

		  Isotope.prototype.reloadItems = function() {
		    // reset item ID counter
		    this.itemGUID = 0;
		    // call super
		    Outlayer.prototype.reloadItems.call( this );
		  };

		  Isotope.prototype._itemize = function() {
		    var items = Outlayer.prototype._itemize.apply( this, arguments );
		    // assign ID for original-order
		    for ( var i=0, len = items.length; i < len; i++ ) {
		      var item = items[i];
		      item.id = this.itemGUID++;
		    }
		    this._updateItemsSortData( items );
		    return items;
		  };


		  // -------------------------- layout -------------------------- //

		  Isotope.prototype._initLayoutMode = function( name ) {
		    var Mode = LayoutMode.modes[ name ];
		    // set mode options
		    // HACK extend initial options, back-fill in default options
		    var initialOpts = this.options[ name ] || {};
		    this.options[ name ] = Mode.options ?
		      extend( Mode.options, initialOpts ) : initialOpts;
		    // init layout mode instance
		    this.modes[ name ] = new Mode( this );
		  };


		  Isotope.prototype.layout = function() {
		    // if first time doing layout, do all magic
		    if ( !this._isLayoutInited && this.options.isInitLayout ) {
		      this.arrange();
		      return;
		    }
		    this._layout();
		  };

		  // private method to be used in layout() & magic()
		  Isotope.prototype._layout = function() {
		    // don't animate first layout
		    var isInstant = this._getIsInstant();
		    // layout flow
		    this._resetLayout();
		    this._manageStamps();
		    this.layoutItems( this.filteredItems, isInstant );

		    // flag for initalized
		    this._isLayoutInited = true;
		  };

		  // filter + sort + layout
		  Isotope.prototype.arrange = function( opts ) {
		    // set any options pass
		    this.option( opts );
		    this._getIsInstant();
		    // filter, sort, and layout
		    this.filteredItems = this._filter( this.items );
		    this._sort();
		    this._layout();
		  };
		  // alias to _init for main plugin method
		  Isotope.prototype._init = Isotope.prototype.arrange;

		  // HACK
		  // Don't animate/transition first layout
		  // Or don't animate/transition other layouts
		  Isotope.prototype._getIsInstant = function() {
		    var isInstant = this.options.isLayoutInstant !== undefined ?
		      this.options.isLayoutInstant : !this._isLayoutInited;
		    this._isInstant = isInstant;
		    return isInstant;
		  };

		  // -------------------------- filter -------------------------- //

		  Isotope.prototype._filter = function( items ) {
		    var filter = this.options.filter;
		    filter = filter || '*';
		    var matches = [];
		    var hiddenMatched = [];
		    var visibleUnmatched = [];

		    var test = this._getFilterTest( filter );

		    // test each item
		    for ( var i=0, len = items.length; i < len; i++ ) {
		      var item = items[i];
		      if ( item.isIgnored ) {
		        continue;
		      }
		      // add item to either matched or unmatched group
		      var isMatched = test( item );
		      // item.isFilterMatched = isMatched;
		      // add to matches if its a match
		      if ( isMatched ) {
		        matches.push( item );
		      }
		      // add to additional group if item needs to be hidden or revealed
		      if ( isMatched && item.isHidden ) {
		        hiddenMatched.push( item );
		      } else if ( !isMatched && !item.isHidden ) {
		        visibleUnmatched.push( item );
		      }
		    }

		    var _this = this;
		    function hideReveal() {
		      _this.reveal( hiddenMatched );
		      _this.hide( visibleUnmatched );
		    }

		    if ( this._isInstant ) {
		      this._noTransition( hideReveal );
		    } else {
		      hideReveal();
		    }

		    return matches;
		  };

		  // get a jQuery, function, or a matchesSelector test given the filter
		  Isotope.prototype._getFilterTest = function( filter ) {
		    if ( jQuery && this.options.isJQueryFiltering ) {
		      // use jQuery
		      return function( item ) {
		        return jQuery( item.element ).is( filter );
		      };
		    }
		    if ( typeof filter === 'function' ) {
		      // use filter as function
		      return function( item ) {
		        return filter( item.element );
		      };
		    }
		    // default, use filter as selector string
		    return function( item ) {
		      return matchesSelector( item.element, filter );
		    };
		  };

		  // -------------------------- sorting -------------------------- //

		  /**
		   * @params {Array} elems
		   * @public
		   */
		  Isotope.prototype.updateSortData = function( elems ) {
		    // get items
		    var items;
		    if ( elems ) {
		      elems = makeArray( elems );
		      items = this.getItems( elems );
		    } else {
		      // update all items if no elems provided
		      items = this.items;
		    }

		    this._getSorters();
		    this._updateItemsSortData( items );
		  };

		  Isotope.prototype._getSorters = function() {
		    var getSortData = this.options.getSortData;
		    for ( var key in getSortData ) {
		      var sorter = getSortData[ key ];
		      this._sorters[ key ] = mungeSorter( sorter );
		    }
		  };

		  /**
		   * @params {Array} items - of Isotope.Items
		   * @private
		   */
		  Isotope.prototype._updateItemsSortData = function( items ) {
		    // do not update if no items
		    var len = items && items.length;

		    for ( var i=0; len && i < len; i++ ) {
		      var item = items[i];
		      item.updateSortData();
		    }
		  };

		  // ----- munge sorter ----- //

		  // encapsulate this, as we just need mungeSorter
		  // other functions in here are just for munging
		  var mungeSorter = ( function() {
		    // add a magic layer to sorters for convienent shorthands
		    // `.foo-bar` will use the text of .foo-bar querySelector
		    // `[foo-bar]` will use attribute
		    // you can also add parser
		    // `.foo-bar parseInt` will parse that as a number
		    function mungeSorter( sorter ) {
		      // if not a string, return function or whatever it is
		      if ( typeof sorter !== 'string' ) {
		        return sorter;
		      }
		      // parse the sorter string
		      var args = trim( sorter ).split(' ');
		      var query = args[0];
		      // check if query looks like [an-attribute]
		      var attrMatch = query.match( /^\[(.+)\]$/ );
		      var attr = attrMatch && attrMatch[1];
		      var getValue = getValueGetter( attr, query );
		      // use second argument as a parser
		      var parser = Isotope.sortDataParsers[ args[1] ];
		      // parse the value, if there was a parser
		      sorter = parser ? function( elem ) {
		        return elem && parser( getValue( elem ) );
		      } :
		      // otherwise just return value
		      function( elem ) {
		        return elem && getValue( elem );
		      };

		      return sorter;
		    }

		    // get an attribute getter, or get text of the querySelector
		    function getValueGetter( attr, query ) {
		      var getValue;
		      // if query looks like [foo-bar], get attribute
		      if ( attr ) {
		        getValue = function( elem ) {
		          return elem.getAttribute( attr );
		        };
		      } else {
		        // otherwise, assume its a querySelector, and get its text
		        getValue = function( elem ) {
		          var child = elem.querySelector( query );
		          return child && getText( child );
		        };
		      }
		      return getValue;
		    }

		    return mungeSorter;
		  })();

		  // parsers used in getSortData shortcut strings
		  Isotope.sortDataParsers = {
		    'parseInt': function( val ) {
		      return parseInt( val, 10 );
		    },
		    'parseFloat': function( val ) {
		      return parseFloat( val );
		    }
		  };

		  // ----- sort method ----- //

		  // sort filteredItem order
		  Isotope.prototype._sort = function() {
		    var sortByOpt = this.options.sortBy;
		    if ( !sortByOpt ) {
		      return;
		    }
		    // concat all sortBy and sortHistory
		    var sortBys = [].concat.apply( sortByOpt, this.sortHistory );
		    // sort magic
		    var itemSorter = getItemSorter( sortBys, this.options.sortAscending );
		    this.filteredItems.sort( itemSorter );
		    // keep track of sortBy History
		    if ( sortByOpt !== this.sortHistory[0] ) {
		      // add to front, oldest goes in last
		      this.sortHistory.unshift( sortByOpt );
		    }
		  };

		  // returns a function used for sorting
		  function getItemSorter( sortBys, sortAsc ) {
		    return function sorter( itemA, itemB ) {
		      // cycle through all sortKeys
		      for ( var i = 0, len = sortBys.length; i < len; i++ ) {
		        var sortBy = sortBys[i];
		        var a = itemA.sortData[ sortBy ];
		        var b = itemB.sortData[ sortBy ];
		        if ( a > b || a < b ) {
		          // if sortAsc is an object, use the value given the sortBy key
		          var isAscending = sortAsc[ sortBy ] !== undefined ? sortAsc[ sortBy ] : sortAsc;
		          var direction = isAscending ? 1 : -1;
		          return ( a > b ? 1 : -1 ) * direction;
		        }
		      }
		      return 0;
		    };
		  }

		  // -------------------------- methods -------------------------- //

		  // get layout mode
		  Isotope.prototype._mode = function() {
		    var layoutMode = this.options.layoutMode;
		    var mode = this.modes[ layoutMode ];
		    if ( !mode ) {
		      // TODO console.error
		      throw new Error( 'No layout mode: ' + layoutMode );
		    }
		    // HACK sync mode's options
		    // any options set after init for layout mode need to be synced
		    mode.options = this.options[ layoutMode ];
		    return mode;
		  };

		  Isotope.prototype._resetLayout = function() {
		    // trigger original reset layout
		    Outlayer.prototype._resetLayout.call( this );
		    this._mode()._resetLayout();
		  };

		  Isotope.prototype._getItemLayoutPosition = function( item  ) {
		    return this._mode()._getItemLayoutPosition( item );
		  };

		  Isotope.prototype._manageStamp = function( stamp ) {
		    this._mode()._manageStamp( stamp );
		  };

		  Isotope.prototype._getContainerSize = function() {
		    return this._mode()._getContainerSize();
		  };

		  Isotope.prototype.needsResizeLayout = function() {
		    return this._mode().needsResizeLayout();
		  };

		  // -------------------------- adding & removing -------------------------- //

		  // HEADS UP overwrites default Outlayer appended
		  Isotope.prototype.appended = function( elems ) {
		    var items = this.addItems( elems );
		    if ( !items.length ) {
		      return;
		    }
		    var filteredItems = this._filterRevealAdded( items );
		    // add to filteredItems
		    this.filteredItems = this.filteredItems.concat( filteredItems );
		  };

		  // HEADS UP overwrites default Outlayer prepended
		  Isotope.prototype.prepended = function( elems ) {
		    var items = this._itemize( elems );
		    if ( !items.length ) {
		      return;
		    }
		    // add items to beginning of collection
		    var previousItems = this.items.slice(0);
		    this.items = items.concat( previousItems );
		    // start new layout
		    this._resetLayout();
		    this._manageStamps();
		    // layout new stuff without transition
		    var filteredItems = this._filterRevealAdded( items );
		    // layout previous items
		    this.layoutItems( previousItems );
		    // add to filteredItems
		    this.filteredItems = filteredItems.concat( this.filteredItems );
		  };

		  Isotope.prototype._filterRevealAdded = function( items ) {
		    var filteredItems = this._noTransition( function() {
		      return this._filter( items );
		    });
		    // layout and reveal just the new items
		    this.layoutItems( filteredItems, true );
		    this.reveal( filteredItems );
		    return items;
		  };

		  /**
		   * Filter, sort, and layout newly-appended item elements
		   * @param {Array or NodeList or Element} elems
		   */
		  Isotope.prototype.insert = function( elems ) {
		    var items = this.addItems( elems );
		    if ( !items.length ) {
		      return;
		    }
		    // append item elements
		    var i, item;
		    var len = items.length;
		    for ( i=0; i < len; i++ ) {
		      item = items[i];
		      this.element.appendChild( item.element );
		    }
		    // filter new stuff
		    /*
		    // this way adds hides new filtered items with NO transition
		    // so user can't see if new hidden items have been inserted
		    var filteredInsertItems;
		    this._noTransition( function() {
		      filteredInsertItems = this._filter( items );
		      // hide all new items
		      this.hide( filteredInsertItems );
		    });
		    // */
		    // this way hides new filtered items with transition
		    // so user at least sees that something has been added
		    var filteredInsertItems = this._filter( items );
		    // hide all newitems
		    this._noTransition( function() {
		      this.hide( filteredInsertItems );
		    });
		    // */
		    // set flag
		    for ( i=0; i < len; i++ ) {
		      items[i].isLayoutInstant = true;
		    }
		    this.arrange();
		    // reset flag
		    for ( i=0; i < len; i++ ) {
		      delete items[i].isLayoutInstant;
		    }
		    this.reveal( filteredInsertItems );
		  };

		  var _remove = Isotope.prototype.remove;
		  Isotope.prototype.remove = function( elems ) {
		    elems = makeArray( elems );
		    var removeItems = this.getItems( elems );
		    // do regular thing
		    _remove.call( this, elems );
		    // bail if no items to remove
		    if ( !removeItems || !removeItems.length ) {
		      return;
		    }
		    // remove elems from filteredItems
		    for ( var i=0, len = removeItems.length; i < len; i++ ) {
		      var item = removeItems[i];
		      // remove item from collection
		      removeFrom( item, this.filteredItems );
		    }
		  };

		  Isotope.prototype.shuffle = function() {
		    // update random sortData
		    for ( var i=0, len = this.items.length; i < len; i++ ) {
		      var item = this.items[i];
		      item.sortData.random = Math.random();
		    }
		    this.options.sortBy = 'random';
		    this._sort();
		    this._layout();
		  };

		  /**
		   * trigger fn without transition
		   * kind of hacky to have this in the first place
		   * @param {Function} fn
		   * @returns ret
		   * @private
		   */
		  Isotope.prototype._noTransition = function( fn ) {
		    // save transitionDuration before disabling
		    var transitionDuration = this.options.transitionDuration;
		    // disable transition
		    this.options.transitionDuration = 0;
		    // do it
		    var returnValue = fn.call( this );
		    // re-enable transition for reveal
		    this.options.transitionDuration = transitionDuration;
		    return returnValue;
		  };

		  // ----- helper methods ----- //

		  /**
		   * getter method for getting filtered item elements
		   * @returns {Array} elems - collection of item elements
		   */
		  Isotope.prototype.getFilteredItemElements = function() {
		    var elems = [];
		    for ( var i=0, len = this.filteredItems.length; i < len; i++ ) {
		      elems.push( this.filteredItems[i].element );
		    }
		    return elems;
		  };

		  // -----  ----- //

		  return Isotope;
		}

		// -------------------------- transport -------------------------- //

		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( [
		      'outlayer/outlayer',
		      'get-size/get-size',
		      'matches-selector/matches-selector',
		      'isotope/js/item',
		      'isotope/js/layout-mode',
		      // include default layout modes
		      'isotope/js/layout-modes/masonry',
		      'isotope/js/layout-modes/fit-rows',
		      'isotope/js/layout-modes/vertical'
		    ],
		    isotopeDefinition );
		} else if ( typeof exports === 'object' ) {
		  // CommonJS
		  module.exports = isotopeDefinition(
		    require('outlayer'),
		    require('get-size'),
		    require('desandro-matches-selector'),
		    require('./item'),
		    require('./layout-mode'),
		    // include default layout modes
		    require('./layout-modes/masonry'),
		    require('./layout-modes/fit-rows'),
		    require('./layout-modes/vertical')
		  );
		} else {
		  // browser global
		  window.Isotope = isotopeDefinition(
		    window.Outlayer,
		    window.getSize,
		    window.matchesSelector,
		    window.Isotope.Item,
		    window.Isotope.LayoutMode
		  );
		}
		// Add hidden class if item hidden
		var itemReveal = Isotope.Item.prototype.reveal;
		Isotope.Item.prototype.reveal = function() {
			itemReveal.apply( this, arguments );
			jQuery( this.element ).removeClass('isotope-hidden');
		};
		var itemHide = Isotope.Item.prototype.hide;
		Isotope.Item.prototype.hide = function() {
			itemHide.apply( this, arguments );
			jQuery( this.element ).addClass('isotope-hidden');
		};
	})( window );



jQuery(document).ready(function($) {
	
	var $document = $(document),
		$window = $(window),
		$html = $("html"),
		$body = $("body"),
		$page = $("#page");
	/* #Retina images using srcset polyfill
================================================== */
	
		window.retinizer = function() {
			if ($body.hasClass("srcset-enabled")) {
				var $coll = $("img:not(.retinized)").filter("[srcset]"),
					ratio = window.devicePixelRatio ? window.devicePixelRatio : 1;
		
				$coll.each(function() {
					var $this = $(this),
						srcArray = $this.attr("srcset").split(","),
						srcMap = [],
						src = "";
					srcArray.forEach(function(el, i) {
						var temp = $.trim(el).split(" ");
						srcMap[temp[1]] = temp[0];
					});
				
		
					if (ratio >= 1.5) {
						if (!(typeof srcMap["2x"] == "undefined")) src = srcMap["2x"];
						else src = srcMap["1x"];
					}
					else {
						if (!(typeof srcMap["1x"] == "undefined")) src = srcMap["1x"];
						else src = srcMap["2x"];
					};
		
					$this.attr("src", src).addClass("retinized");
				});
		
				// Retina logo in floating menu
				
				if (! (typeof dtGlobals.logoURL == "undefined")) {
					var logoArray = dtGlobals.logoURL.split(","),
						logoMap = [];
			
					logoArray.forEach(function(el, i) {
						var temp = $.trim(el).split(" ");
						logoMap[temp[1]] = temp[0];
					});
				
			
					if (ratio >= 1.5) {
						if (!(typeof logoMap["2x"] == "undefined")) dtGlobals.logoURL = logoMap["2x"];
						else dtGlobals.logoURL = logoMap["1x"];
					}
					else {
						if (!(typeof logoMap["1x"] == "undefined")) dtGlobals.logoURL = logoMap["1x"];
						else dtGlobals.logoURL = logoMap["2x"];
					};
				};
			};
		};
		retinizer();



/* #Custom touch events
================================================== */

	/* !(we need to add swipe events here) */

	dtGlobals.touches = {};
	dtGlobals.touches.touching = false;
	dtGlobals.touches.touch = false;
	dtGlobals.touches.currX = 0;
	dtGlobals.touches.currY = 0;
	dtGlobals.touches.cachedX = 0;
	dtGlobals.touches.cachedY = 0;
	dtGlobals.touches.count = 0;
	dtGlobals.resizeCounter = 0;

	$document.on("touchstart",function(e) {
		if (e.originalEvent.touches.length == 1) {
			dtGlobals.touches.touch = e.originalEvent.touches[0];

			// caching the current x
			dtGlobals.touches.cachedX = dtGlobals.touches.touch.pageX;
			// caching the current y
			dtGlobals.touches.cachedY = dtGlobals.touches.touch.pageY;
			// a touch event is detected      
			dtGlobals.touches.touching = true;

			// detecting if after 200ms the finger is still in the same position
			setTimeout(function() {

				dtGlobals.touches.currX = dtGlobals.touches.touch.pageX;
				dtGlobals.touches.currY = dtGlobals.touches.touch.pageY;

				if ((dtGlobals.touches.cachedX === dtGlobals.touches.currX) && !dtGlobals.touches.touching && (dtGlobals.touches.cachedY === dtGlobals.touches.currY)) {
					// Here you get the Tap event
					dtGlobals.touches.count++;
					//console.log(dtGlobals.touches.count)
					$(e.target).trigger("tap");
				}
			},200);
		}
	});

	$document.on("touchend touchcancel",function (e){
		// here we can consider finished the touch event
		dtGlobals.touches.touching = false;
	});

	$document.on("touchmove",function (e){
		dtGlobals.touches.touch = e.originalEvent.touches[0];

		if(dtGlobals.touches.touching) {
			// here you are swiping
		}
	});

	$document.on("tap", function(e) {
		$(".dt-hovered").trigger("mouseout");
	});


// jquery.event.move
//
// 1.3.6
//
// Stephen Band
//
// Triggers 'movestart', 'move' and 'moveend' events after
// mousemoves following a mousedown cross a distance threshold,
// similar to the native 'dragstart', 'drag' and 'dragend' events.
// Move events are throttled to animation frames. Move event objects
// have the properties:
//
// pageX:
// pageY:   Page coordinates of pointer.
// startX:
// startY:  Page coordinates of pointer at movestart.
// distX:
// distY:  Distance the pointer has moved since movestart.
// deltaX:
// deltaY:  Distance the finger has moved since last event.
// velocityX:
// velocityY:  Average velocity over last few events.


(function (module) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as an anonymous module.
		define(['jquery'], module);
	} else {
		// Browser globals
		module(jQuery);
	}
})(function(jQuery, undefined){

	var // Number of pixels a pressed pointer travels before movestart
			// event is fired.
			threshold = 6,
	
			add = jQuery.event.add,
	
			remove = jQuery.event.remove,

			// Just sugar, so we can have arguments in the same order as
			// add and remove.
			trigger = function(node, type, data) {
				jQuery.event.trigger(type, data, node);
			},

			// Shim for requestAnimationFrame, falling back to timer. See:
			// see http://paulirish.com/2011/requestanimationframe-for-smart-animating/
			requestFrame = (function(){
				return (
					window.requestAnimationFrame ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame ||
					window.oRequestAnimationFrame ||
					window.msRequestAnimationFrame ||
					function(fn, element){
						return window.setTimeout(function(){
							fn();
						}, 25);
					}
				);
			})(),
			
			ignoreTags = {
				textarea: true,
				input: true,
				select: true,
				button: true
			},
			
			mouseevents = {
				move: 'mousemove',
				cancel: 'mouseup dragstart',
				end: 'mouseup'
			},
			
			touchevents = {
				move: 'touchmove',
				cancel: 'touchend',
				end: 'touchend'
			};


	// Constructors
	
	function Timer(fn){
		var callback = fn,
				active = false,
				running = false;
		
		function trigger(time) {
			if (active){
				callback();
				requestFrame(trigger);
				running = true;
				active = false;
			}
			else {
				running = false;
			}
		}
		
		this.kick = function(fn) {
			active = true;
			if (!running) { trigger(); }
		};
		
		this.end = function(fn) {
			var cb = callback;
			
			if (!fn) { return; }
			
			// If the timer is not running, simply call the end callback.
			if (!running) {
				fn();
			}
			// If the timer is running, and has been kicked lately, then
			// queue up the current callback and the end callback, otherwise
			// just the end callback.
			else {
				callback = active ?
					function(){ cb(); fn(); } : 
					fn ;
				
				active = true;
			}
		};
	}


	// Functions
	
	function returnTrue() {
		return true;
	}
	
	function returnFalse() {
		return false;
	}
	
	function preventDefault(e) {
		e.preventDefault();
	}
	
	function preventIgnoreTags(e) {
		// Don't prevent interaction with form elements.
		if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }
		
		e.preventDefault();
	}

	function isLeftButton(e) {
		// Ignore mousedowns on any button other than the left (or primary)
		// mouse button, or when a modifier key is pressed.
		return (e.which === 1 && !e.ctrlKey && !e.altKey);
	}

	function identifiedTouch(touchList, id) {
		var i, l;

		if (touchList.identifiedTouch) {
			return touchList.identifiedTouch(id);
		}
		
		// touchList.identifiedTouch() does not exist in
		// webkit yet… we must do the search ourselves...
		
		i = -1;
		l = touchList.length;
		
		while (++i < l) {
			if (touchList[i].identifier === id) {
				return touchList[i];
			}
		}
	}

	function changedTouch(e, event) {
		var touch = identifiedTouch(e.changedTouches, event.identifier);

		// This isn't the touch you're looking for.
		if (!touch) { return; }

		// Chrome Android (at least) includes touches that have not
		// changed in e.changedTouches. That's a bit annoying. Check
		// that this touch has changed.
		if (touch.pageX === event.pageX && touch.pageY === event.pageY) { return; }

		return touch;
	}


	// Handlers that decide when the first movestart is triggered
	
	function mousedown(e){
		var data;

		if (!isLeftButton(e)) { return; }

		data = {
			target: e.target,
			startX: e.pageX,
			startY: e.pageY,
			timeStamp: e.timeStamp
		};

		add(document, mouseevents.move, mousemove, data);
		add(document, mouseevents.cancel, mouseend, data);
	}

	function mousemove(e){
		var data = e.data;

		checkThreshold(e, data, e, removeMouse);
	}

	function mouseend(e) {
		removeMouse();
	}

	function removeMouse() {
		remove(document, mouseevents.move, mousemove);
		remove(document, mouseevents.cancel, mouseend);
	}

	function touchstart(e) {
		var touch, template;

		// Don't get in the way of interaction with form elements.
		if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }

		touch = e.changedTouches[0];
		
		// iOS live updates the touch objects whereas Android gives us copies.
		// That means we can't trust the touchstart object to stay the same,
		// so we must copy the data. This object acts as a template for
		// movestart, move and moveend event objects.
		template = {
			target: touch.target,
			startX: touch.pageX,
			startY: touch.pageY,
			timeStamp: e.timeStamp,
			identifier: touch.identifier
		};

		// Use the touch identifier as a namespace, so that we can later
		// remove handlers pertaining only to this touch.
		add(document, touchevents.move + '.' + touch.identifier, touchmove, template);
		add(document, touchevents.cancel + '.' + touch.identifier, touchend, template);
	}

	function touchmove(e){
		var data = e.data,
				touch = changedTouch(e, data);

		if (!touch) { return; }

		checkThreshold(e, data, touch, removeTouch);
	}

	function touchend(e) {
		var template = e.data,
				touch = identifiedTouch(e.changedTouches, template.identifier);

		if (!touch) { return; }

		removeTouch(template.identifier);
	}

	function removeTouch(identifier) {
		remove(document, '.' + identifier, touchmove);
		remove(document, '.' + identifier, touchend);
	}


	// Logic for deciding when to trigger a movestart.

	function checkThreshold(e, template, touch, fn) {
		var distX = touch.pageX - template.startX,
				distY = touch.pageY - template.startY;

		// Do nothing if the threshold has not been crossed.
		if ((distX * distX) + (distY * distY) < (threshold * threshold)) { return; }

		triggerStart(e, template, touch, distX, distY, fn);
	}

	function handled() {
		// this._handled should return false once, and after return true.
		this._handled = returnTrue;
		return false;
	}

	function flagAsHandled(e) {
		e._handled();
	}

	function triggerStart(e, template, touch, distX, distY, fn) {
		var node = template.target,
				touches, time;

		touches = e.targetTouches;
		time = e.timeStamp - template.timeStamp;

		// Create a movestart object with some special properties that
		// are passed only to the movestart handlers.
		template.type = 'movestart';
		template.distX = distX;
		template.distY = distY;
		template.deltaX = distX;
		template.deltaY = distY;
		template.pageX = touch.pageX;
		template.pageY = touch.pageY;
		template.velocityX = distX / time;
		template.velocityY = distY / time;
		template.targetTouches = touches;
		template.finger = touches ?
			touches.length :
			1 ;

		// The _handled method is fired to tell the default movestart
		// handler that one of the move events is bound.
		template._handled = handled;
			
		// Pass the touchmove event so it can be prevented if or when
		// movestart is handled.
		template._preventTouchmoveDefault = function() {
			e.preventDefault();
		};

		// Trigger the movestart event.
		trigger(template.target, template);

		// Unbind handlers that tracked the touch or mouse up till now.
		fn(template.identifier);
	}


	// Handlers that control what happens following a movestart

	function activeMousemove(e) {
		var timer = e.data.timer;

		e.data.touch = e;
		e.data.timeStamp = e.timeStamp;
		timer.kick();
	}

	function activeMouseend(e) {
		var event = e.data.event,
				timer = e.data.timer;
		
		removeActiveMouse();

		endEvent(event, timer, function() {
			// Unbind the click suppressor, waiting until after mouseup
			// has been handled.
			setTimeout(function(){
				remove(event.target, 'click', returnFalse);
			}, 0);
		});
	}

	function removeActiveMouse(event) {
		remove(document, mouseevents.move, activeMousemove);
		remove(document, mouseevents.end, activeMouseend);
	}

	function activeTouchmove(e) {
		var event = e.data.event,
				timer = e.data.timer,
				touch = changedTouch(e, event);

		if (!touch) { return; }

		// Stop the interface from gesturing
		e.preventDefault();

		event.targetTouches = e.targetTouches;
		e.data.touch = touch;
		e.data.timeStamp = e.timeStamp;
		timer.kick();
	}

	function activeTouchend(e) {
		var event = e.data.event,
				timer = e.data.timer,
				touch = identifiedTouch(e.changedTouches, event.identifier);

		// This isn't the touch you're looking for.
		if (!touch) { return; }

		removeActiveTouch(event);
		endEvent(event, timer);
	}

	function removeActiveTouch(event) {
		remove(document, '.' + event.identifier, activeTouchmove);
		remove(document, '.' + event.identifier, activeTouchend);
	}


	// Logic for triggering move and moveend events

	function updateEvent(event, touch, timeStamp, timer) {
		var time = timeStamp - event.timeStamp;

		event.type = 'move';
		event.distX =  touch.pageX - event.startX;
		event.distY =  touch.pageY - event.startY;
		event.deltaX = touch.pageX - event.pageX;
		event.deltaY = touch.pageY - event.pageY;
		
		// Average the velocity of the last few events using a decay
		// curve to even out spurious jumps in values.
		event.velocityX = 0.3 * event.velocityX + 0.7 * event.deltaX / time;
		event.velocityY = 0.3 * event.velocityY + 0.7 * event.deltaY / time;
		event.pageX =  touch.pageX;
		event.pageY =  touch.pageY;
	}

	function endEvent(event, timer, fn) {
		timer.end(function(){
			event.type = 'moveend';

			trigger(event.target, event);
			
			return fn && fn();
		});
	}


	// jQuery special event definition

	function setup(data, namespaces, eventHandle) {
		// Stop the node from being dragged
		//add(this, 'dragstart.move drag.move', preventDefault);
		
		// Prevent text selection and touch interface scrolling
		//add(this, 'mousedown.move', preventIgnoreTags);
		
		// Tell movestart default handler that we've handled this
		add(this, 'movestart.move', flagAsHandled);

		// Don't bind to the DOM. For speed.
		return true;
	}
	
	function teardown(namespaces) {
		remove(this, 'dragstart drag', preventDefault);
		remove(this, 'mousedown touchstart', preventIgnoreTags);
		remove(this, 'movestart', flagAsHandled);
		
		// Don't bind to the DOM. For speed.
		return true;
	}
	
	function addMethod(handleObj) {
		// We're not interested in preventing defaults for handlers that
		// come from internal move or moveend bindings
		if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
			return;
		}
		
		// Stop the node from being dragged
		add(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid, preventDefault, undefined, handleObj.selector);
		
		// Prevent text selection and touch interface scrolling
		add(this, 'mousedown.' + handleObj.guid, preventIgnoreTags, undefined, handleObj.selector);
	}
	
	function removeMethod(handleObj) {
		if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
			return;
		}
		
		remove(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid);
		remove(this, 'mousedown.' + handleObj.guid);
	}
	
	jQuery.event.special.movestart = {
		setup: setup,
		teardown: teardown,
		add: addMethod,
		remove: removeMethod,

		_default: function(e) {
			var event, data;
			
			// If no move events were bound to any ancestors of this
			// target, high tail it out of here.
			if (!e._handled()) { return; }

			function update(time) {
				updateEvent(event, data.touch, data.timeStamp);
				trigger(e.target, event);
			}

			event = {
				target: e.target,
				startX: e.startX,
				startY: e.startY,
				pageX: e.pageX,
				pageY: e.pageY,
				distX: e.distX,
				distY: e.distY,
				deltaX: e.deltaX,
				deltaY: e.deltaY,
				velocityX: e.velocityX,
				velocityY: e.velocityY,
				timeStamp: e.timeStamp,
				identifier: e.identifier,
				targetTouches: e.targetTouches,
				finger: e.finger
			};

			data = {
				event: event,
				timer: new Timer(update),
				touch: undefined,
				timeStamp: undefined
			};
			
			if (e.identifier === undefined) {
				// We're dealing with a mouse
				// Stop clicks from propagating during a move
				add(e.target, 'click', returnFalse);
				add(document, mouseevents.move, activeMousemove, data);
				add(document, mouseevents.end, activeMouseend, data);
			}
			else {
				// We're dealing with a touch. Stop touchmove doing
				// anything defaulty.
				e._preventTouchmoveDefault();
				add(document, touchevents.move + '.' + e.identifier, activeTouchmove, data);
				add(document, touchevents.end + '.' + e.identifier, activeTouchend, data);
			}
		}
	};

	jQuery.event.special.move = {
		setup: function() {
			// Bind a noop to movestart. Why? It's the movestart
			// setup that decides whether other move events are fired.
			add(this, 'movestart.move', jQuery.noop);
		},
		
		teardown: function() {
			remove(this, 'movestart.move', jQuery.noop);
		}
	};
	
	jQuery.event.special.moveend = {
		setup: function() {
			// Bind a noop to movestart. Why? It's the movestart
			// setup that decides whether other move events are fired.
			add(this, 'movestart.moveend', jQuery.noop);
		},
		
		teardown: function() {
			remove(this, 'movestart.moveend', jQuery.noop);
		}
	};

	add(document, 'mousedown.move', mousedown);
	add(document, 'touchstart.move', touchstart);

	// Make jQuery copy touch event properties over to the jQuery event
	// object, if they are not already listed. But only do the ones we
	// really need. IE7/8 do not have Array#indexOf(), but nor do they
	// have touch events, so let's assume we can ignore them.
	if (typeof Array.prototype.indexOf === 'function') {
		(function(jQuery, undefined){
			var props = ["changedTouches", "targetTouches"],
					l = props.length;
			
			while (l--) {
				if (jQuery.event.props.indexOf(props[l]) === -1) {
					jQuery.event.props.push(props[l]);
				}
			}
		})(jQuery);
	};
});

/* !Animation Core */

/*
 * Viewport - jQuery selectors for finding elements in viewport
 *
 * Copyright (c) 2008-2009 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://www.appelsiini.net/projects/viewport
 *
 */

	$.belowthefold = function(element, settings) {
		var fold = $window.height() + $window.scrollTop();
		return fold <= $(element).offset().top - settings.threshold;
	};
	$.abovethetop = function(element, settings) {
		var top = $window.scrollTop();
		return top >= $(element).offset().top + $(element).height() - settings.threshold;
	};
	$.rightofscreen = function(element, settings) {
		var fold = $window.width() + $window.scrollLeft();
		return fold <= $(element).offset().left - settings.threshold;
	};
	$.leftofscreen = function(element, settings) {
		var left = $window.scrollLeft();
		return left >= $(element).offset().left + $(element).width() - settings.threshold;
	};
	$.inviewport = function(element, settings) {
		return !$.rightofscreen(element, settings) && !$.leftofscreen(element, settings) && !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
	};

	$.extend($.expr[':'], {
		"below-the-fold": function(a, i, m) {
			return $.belowthefold(a, {threshold : 0});
		},
		"above-the-top": function(a, i, m) {
			return $.abovethetop(a, {threshold : 0});
		},
		"left-of-screen": function(a, i, m) {
			return $.leftofscreen(a, {threshold : 0});
		},
		"right-of-screen": function(a, i, m) {
			return $.rightofscreen(a, {threshold : 0});
		},
		"in-viewport": function(a, i, m) {
			return $.inviewport(a, {threshold : -30});
		}
	});


	// !- Animation "onScroll" loop
	function doAnimation() {
		if(!dtGlobals.isMobile){
			if($(".animation-at-the-same-time").length > 0 || $(".animate-element").length > 0){
				var j = -1;
				$(".animation-at-the-same-time:in-viewport").each(function () {
					var $this = $(this),
						$thisElem = $this.find(".animate-element");
					//if (!$thisElem.hasClass("start-animation") && !$thisElem.hasClass("animation-triggered")) {
						$thisElem.addClass("animation-triggered");
						$this.find(".animate-element:not(.start-animation)").addClass("start-animation");
					//};
				});
				$(".animate-element:not(.start-animation):in-viewport").each(function () {
					var $this = $(this);
					if (!$this.parents(".animation-at-the-same-time").length > 0) {

						if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
							$this.addClass("animation-triggered");
							j++;
							setTimeout(function () {
								$this.addClass("start-animation");
								if($this.hasClass("skills")){
									$this.animateSkills();
								};
							}, 200 * j);
						};
					};
				});
			}
		}
		else {
			$(".skills").animateSkills();
		};
	};


	// !- Fire animation
	setTimeout(function() {
		doAnimation();
	}, 50);

	if (!dtGlobals.isMobile ){
		$window.on("scroll", function () {
			doAnimation();
		});
	};


/* #Check if element exists
================================================== */
	$.fn.exists = function() {
		if ($(this).length > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* !- Check if element is loaded */
	$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len	= this.length;
		if (len > 0) {
			return this.each(function() {
				var	el		= this,
					$el		= $(el),
					blank	= "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};



/* #Social icons svg
================================================== */
	/*!-svg icons array*/
	var icons = [
		'<g id="social-500px"><path d="M11.969 13.544c1.137 1.3 2.5 2.5 4.3 2.467c2.364 0 3.775-1.795 3.775-4.08 c0-2.279-1.438-3.973-3.756-3.973c-1.848 0-3.059 1.202-4.232 2.621c-1.201-1.44-2.393-2.621-4.279-2.621 C5.477 8 4 9.7 4 12.005c0 2.3 1.6 4 3.8 4.037c1.93-0.08 2.977-1.325 4.117-2.498H11.969z M5.715 12 c0-1.011 0.656-2.114 1.865-2.114c1.233 0 2.5 1.3 3.4 2.137c-0.82 0.957-2.015 1.99-3.265 2 c-1.285-0.021-1.974-0.842-1.974-2.013H5.715z M13.146 12.099c0.867-0.94 1.941-2.123 3.219-2.123c1.246 0 2 0.9 2 2.1 c0 1.104-0.645 2.025-1.876 1.973c-1.333 0.049-2.469-0.879-3.282-1.898L13.146 12.099z"/></g>',
		'<g id="vk"><path d="M12.235 16.191c0.372 0 0.524-0.248 0.516-0.56c-0.017-1.17 0.438-1.797 1.258-0.978 c0.908 0.9 1.1 1.5 2.1 1.502c0.418 0 1.5 0 1.9 0c1.528 0 0.166-1.54-0.916-2.54c-1.024-0.952-1.071-0.979-0.189-2.123 c1.102-1.425 2.535-3.26 1.266-3.26c-0.246 0-0.072 0-2.428 0c-0.471 0-0.501 0.277-0.672 0.7 c-0.604 1.429-1.758 3.28-2.195 3.001c-0.46-0.295-0.248-1.3-0.213-3.038c0.014-0.459 0.01-0.774-0.694-0.94 c-1.92-0.447-3.578 0.431-2.9 0.537c0.954 0.2 0.9 2 0.6 2.98c-0.387 1.558-1.851-1.235-2.457-2.623 C7.25 8.5 7.2 8.3 6.7 8.277c-0.29 0-1.558 0-1.986 0c-0.382 0-0.569 0.177-0.434 0.531c0.133 0.3 1.7 3.8 3.4 5.8 c1.718 1.7 3.4 1.6 4.6 1.597H12.235L12.235 16.191z"/></g>',
		'<g id="tripedvisor"><path fill="none" d="M15.825 9.215c-1.584 0-2.873 1.291-2.873 2.874c0 1.6 1.3 2.9 2.9 2.876s2.873-1.292 2.873-2.876 C18.698 10.5 17.4 9.2 15.8 9.215z M15.879 13.729c-0.423 0-0.82-0.164-1.118-0.464c-0.299-0.301-0.465-0.697-0.465-1.121 c0-0.421 0.166-0.818 0.465-1.119c0.298-0.298 0.695-0.461 1.118-0.461c0.873 0 1.6 0.7 1.6 1.6 C17.464 13 16.8 13.7 15.9 13.729z"/><path fill="none" d="M8.26 9.251c-1.592 0-2.887 1.296-2.887 2.888c0 1.6 1.3 2.9 2.9 2.9 c1.591 0 2.886-1.299 2.886-2.887C11.146 10.5 9.9 9.3 8.3 9.251z M8.253 13.706c-0.421 0-0.816-0.163-1.113-0.461 c-0.3-0.296-0.462-0.691-0.462-1.114c0-0.419 0.164-0.814 0.462-1.113c0.297-0.296 0.693-0.457 1.113-0.462 c0.87 0 1.6 0.7 1.6 1.574S9.123 13.7 8.3 13.706z"/><path d="M8.253 10.556c-0.42 0.005-0.816 0.166-1.113 0.463c-0.299 0.299-0.462 0.694-0.462 1.113c0 0.4 0.2 0.8 0.5 1.1 c0.297 0.3 0.7 0.5 1.1 0.461c0.87 0 1.576-0.708 1.576-1.577S9.123 10.6 8.3 10.556z"/><path d="M15.879 10.563c-0.423 0-0.82 0.163-1.118 0.461c-0.299 0.301-0.465 0.698-0.465 1.119c0 0.4 0.2 0.8 0.5 1.1 c0.298 0.3 0.7 0.5 1.1 0.464c0.873 0 1.585-0.708 1.585-1.582S16.752 10.6 15.9 10.563z"/><path d="M20.172 8.047l-3.177 0.365c-0.042-0.013-0.085-0.021-0.127-0.034c-0.138-0.216-1.087-1.44-4.881-1.44 c-4.164 0-4.9 1.475-4.9 1.475l-3.165-0.35c0.339 0.3 1 1.3 1.1 1.733c-0.49 0.649-0.867 1.475-0.859 2.4 c0.016 1.8 0.7 3.9 3.7 4.338c1.375-0.019 2.048-0.344 3.064-1.133l1.109 2.461l1.169-2.439 c0.776 0.6 1.2 1 2.6 1.096c3.047-0.125 3.981-2.578 4.029-4.321c0.002-0.933-0.238-1.729-0.781-2.396 C19.256 9.3 19.9 8.4 20.2 8.047z M8.26 15.025c-1.592 0-2.887-1.299-2.887-2.887c0-1.592 1.295-2.888 2.887-2.888 c1.591 0 2.9 1.3 2.9 2.888C11.146 13.7 9.9 15 8.3 15.025z M15.825 14.965c-1.584 0-2.873-1.29-2.873-2.876 c0-1.583 1.289-2.874 2.873-2.874c1.586 0 2.9 1.3 2.9 2.874C18.698 13.7 17.4 15 15.8 14.965z"/></g>',
		'<g id="foursquare"><path d="M18.511 13.164l-5.351 5.353c-0.643 0.641-1.688 0.641-2.326 0L5.48 13.164c-0.639-0.645-0.639-1.688 0-2.329l5.354-5.354 c0.638-0.638 1.685-0.638 2.3 0l2.417 2.418l-3.631 3.631l-1.707-1.712c-0.239-0.24-0.57-0.377-0.907-0.377 c-0.339 0-0.667 0.137-0.907 0.375l-1.096 1.094c-0.243 0.243-0.378 0.565-0.378 0.909c0 0.3 0.1 0.7 0.4 0.906l3.707 3.7 c0.167 0.2 0.4 0.3 0.6 0.34l0.053 0.035l0.25 0.002c0.341 0 0.666-0.134 0.905-0.376l5.636-5.635h0.023 c0.689 0.7 0.7 1.6 0.1 2.333L18.511 13.164L18.511 13.164z"/><path d="M18.571 9.409l-6.367 6.373c-0.085 0.079-0.196 0.129-0.315 0.129l0 0c-0.002 0-0.002 0-0.004 0 c-0.017 0-0.034-0.002-0.048-0.005c-0.101-0.012-0.192-0.057-0.262-0.124l-3.547-3.558c-0.173-0.171-0.171-0.452 0-0.622 l1.049-1.048c0.083-0.081 0.195-0.128 0.311-0.129c0.117 0 0.2 0.1 0.3 0.131l2.191 2.195l5.009-5.009 c0.083-0.084 0.193-0.13 0.312-0.13c0.117 0 0.2 0 0.3 0.13l1.045 1.049c0.221 0.1 0.2 0.4 0.1 0.619L18.571 9.4 L18.571 9.409z"/></g>',
		'<g id="website"><path d="M8.639 10.095c0.251-0.252 0.53-0.46 0.827-0.625c1.654-0.912 3.778-0.425 4.8 1.187l-1.287 1.3 c-0.371-0.844-1.288-1.323-2.198-1.118c-0.342 0.077-0.67 0.249-0.936 0.512l-2.468 2.467c-0.75 0.748-0.75 2 0 2.7 c0.75 0.8 2 0.8 2.7 0l0.762-0.76c0.689 0.2 1.4 0.3 2.2 0.324l-1.679 1.682c-1.439 1.438-3.771 1.438-5.211 0 c-1.439-1.438-1.439-3.771 0-5.211L8.639 10.095z M12.557 6.177l-1.681 1.677c0.732-0.054 1.4 0.1 2.2 0.331l0.764-0.761 c0.75-0.749 1.97-0.749 2.7 0c0.75 0.8 0.8 2 0 2.717l-2.465 2.466c-0.753 0.752-1.974 0.744-2.719 0 c-0.173-0.174-0.323-0.393-0.417-0.604l-1.287 1.284c0.136 0.2 0.3 0.4 0.4 0.562c0.465 0.4 1.1 0.8 1.8 1 c0.882 0.2 1.9 0.1 2.644-0.354c0.298-0.16 0.577-0.369 0.828-0.621l2.47-2.465c1.437-1.439 1.437-3.773 0-5.21 c-1.479-1.438-3.761-1.438-5.292-0.008L12.557 6.177L12.557 6.177z"/></g>',
		'<g id="mail"><path d="M5 6.984v10.031h0.012h13.954H19V6.984H5z M17.414 8.134l-5.416 4.012L6.586 8.134H17.414 z M6.188 9.289l2.902 2.151L6.188 14.25V9.289z M6.2 15.864l3.842-3.719l1.957 1.45l1.946-1.442l3.834 3.712L6.2 15.864L6.2 15.864z M17.812 14.271l-2.916-2.824l2.916-2.159V14.271z"/></g>',
		'<g id="behance"><path d="M11.429 8.664c0.27 0.4 0.4 0.8 0.4 1.385c0 0.554-0.138 0.999-0.407 1.3 c-0.152 0.188-0.374 0.36-0.671 0.499c0.45 0.2 0.8 0.4 1 0.804c0.229 0.4 0.3 0.8 0.3 1.3 c0 0.535-0.133 1.021-0.39 1.397c-0.164 0.282-0.374 0.522-0.62 0.722c-0.282 0.217-0.61 0.363-0.992 0.5 c-0.381 0.076-0.794 0.128-1.236 0.128H4.836V7.694H9.07c1.156-0.03 1.9 0.4 2.4 0.97H11.429z M6.686 9.345v2.015h2.145 c0.382 0 0.694-0.078 0.931-0.227c0.241-0.149 0.36-0.417 0.36-0.804c0-0.422-0.159-0.707-0.475-0.841 C9.374 9.4 9 9.3 8.6 9.345l-1.92 0.017V9.345z M6.686 12.874v2.438h2.142c0.385 0 0.682-0.055 0.894-0.164 c0.387-0.201 0.581-0.573 0.581-1.137c0-0.479-0.188-0.812-0.563-0.984c-0.209-0.098-0.501-0.146-0.883-0.152L6.686 12.9 L6.686 12.874z M17.494 10.061c0.445 0.2 0.8 0.5 1.1 0.979c0.262 0.4 0.4 0.9 0.5 1.4 c0.041 0.3 0.1 0.7 0.1 1.312h-4.637c0.023 0.7 0.3 1.1 0.7 1.396c0.248 0.2 0.6 0.2 0.9 0.2 c0.383 0 0.688-0.104 0.924-0.309c0.133-0.104 0.188-0.164 0.289-0.354h1.734c-0.041 0.396-0.232 0.688-0.598 1.1 c-0.568 0.646-1.363 0.97-2.396 0.999c-0.848 0-1.596-0.271-2.236-0.812c-0.652-0.543-0.835-1.439-0.835-2.659 c0-1.144 0.147-2.012 0.735-2.621c0.584-0.611 1.344-0.916 2.275-0.916c0.559-0.023 1.1 0.1 1.5 0.293L17.494 10.061z M14.811 11.632c-0.232 0.256-0.328 0.775-0.391 1.198l3.064 0.034c-0.033-0.468-0.074-0.964-0.412-1.413 c-0.271-0.244-0.752-0.295-1.156-0.295c-0.438 0.003-0.818 0.203-1.113 0.477L14.811 11.632L14.811 11.632z M18.586 7.207h-4.707 v1.584h4.707V7.207z"/></g>',
		'<g id="stumbleupon"><path d="M12.719 10.35l0.917 0.499l1.456-0.477v-0.96c0-1.656-1.422-2.944-3.11-2.944 c-1.687 0-3.116 1.205-3.116 2.949c0 1.7 0 4.4 0 4.384c0 0.401-0.332 0.723-0.738 0.723c-0.409 0-0.74-0.318-0.74-0.723v-1.855 H5v1.896c0 1.7 1.4 3.1 3.2 3.034c1.71 0 3.096-1.336 3.121-2.991V9.517c0-0.396 0.331-0.718 0.74-0.718 c0.407 0 0.7 0.3 0.7 0.718v0.833H12.719z M16.573 11.918v1.943c0 0.396-0.33 0.719-0.738 0.7 c-0.41 0-0.737-0.32-0.737-0.723v-1.906l-1.459 0.478l-0.916-0.499v1.891c0.02 1.7 1.4 3.1 3.2 3.1 c1.719 0 3.117-1.362 3.117-3.032c0-0.025 0-1.887 0-1.887L16.573 11.918L16.573 11.918z"/></g>',
		'<g id="instagram"><rect x="3" y="3" display="none" opacity="0.7" fill="#27AAE1" enable-background="new    " width="16" height="16"/><path d="M15.121 11.582l3.023-0.032v4.181c0 1.334-1.095 2.42-2.437 2.42H8.283c-1.344 0-2.434-1.086-2.434-2.42v-4.173h3.097 c-0.08 0.677-0.096 0.745-0.056 1.052c0.233 1.8 1.8 2.6 3.2 2.652c1.672 0.1 2.703-0.996 3.123-2.927 c-0.045-0.729-0.017 0.085-0.017-0.752L15.121 11.582L15.121 11.582z M8.226 5.851C8.246 5.8 8.3 5.8 8.3 5.85h0.393 M8.279 5.85h7.431c1.343 0 2.4 1.1 2.4 2.421l0.002 2.33h-3.375c-0.527-0.672-1.499-1.71-2.784-1.674 c-1.755 0.048-2.28 1.089-2.663 1.727L5.85 10.56V8.271c0-0.816 0.317-2.02 1.821-2.419 M16.739 7.5 c0-0.191-0.155-0.342-0.345-0.342h-1.166c-0.19 0-0.34 0.15-0.34 0.342v1.181c0 0.2 0.1 0.3 0.3 0.343h1.164 c0.188 0 0.345-0.155 0.345-0.343V7.5l0.037 0.039V7.5z M10.207 12.054c0 1 0.8 1.8 1.8 1.9 c0.986 0 1.788-0.891 1.788-1.88c0-0.983-0.802-1.779-1.789-1.779c-1.029 0.011-1.867 0.823-1.867 1.779H10.207z"/></g>',
		'<g id="github"><path d="M15.604 5.666c-0.662 0.286-1.369 0.442-2.124 0.472C13 5.9 12.4 5.7 11.8 5.666c-1.562 0-3.112 1.052-3.177 2.8 c-0.047 1.3 0.5 2.2 1.6 2.788c-0.475 0.219-0.664 0.723-0.664 1.217c0 0.5 0.3 1 0.6 1.2 C9.041 14.2 8.4 14.9 8.4 15.889c0 3.2 7 3.3 7.004-0.136c0-1.271-0.875-2.188-3.03-2.538 c-0.852-0.118-1.304-1.413-0.046-1.647c1.803-0.296 3.015-1.998 2.38-3.867c0.269-0.04 0.537-0.105 0.801-0.196l0.097-1.818V5.666 H15.604z M12.002 14.818c0.982-0.02 1.6 0.3 1.6 0.951c0.014 0.674-0.539 0.979-1.482 0.9 c-1.049-0.003-1.643-0.292-1.664-0.986c0.004-0.549 0.484-0.861 1.631-0.902H12.002L12.002 14.818z M11.856 10 c-0.831 0.012-1.212-0.445-1.213-1.329c0-0.806 0.369-1.309 1.194-1.314c0.738-0.003 1.1 0.5 1.1 1.4 C13.041 9.5 12.6 10 11.8 9.98L11.856 9.96z"/></g>',
		'<g id="skype"><path d="M18.412 12.034c0-3.541-2.889-6.412-6.447-6.412c-0.353 0-0.7 0.028-1.038 0.083c-0.604-0.394-1.323-0.623-2.101-0.623 c-2.124 0-3.846 1.723-3.846 3.847c0 0.8 0.2 1.5 0.6 2.094c-0.053 0.33-0.079 0.667-0.079 1 c0 3.5 2.9 6.4 6.4 6.414c0.402 0 0.795-0.041 1.176-0.107c0.589 0.4 1.3 0.6 2 0.6 c2.126 0 3.849-1.725 3.849-3.848c0-0.803-0.246-1.551-0.668-2.167C18.391 12.6 18.4 12.3 18.4 12.034z M12.568 16.8 c-2.049 0.105-3.007-0.348-3.886-1.172c-0.98-0.918-0.587-1.969 0.213-2.021c0.798-0.053 1.3 0.9 1.7 1.2 c0.427 0.3 2 0.9 2.901-0.104c0.933-1.062-0.621-1.614-1.758-1.782C10.121 12.6 8.1 11.7 8.2 10 c0.159-1.729 1.468-2.617 2.847-2.742c1.757-0.159 2.9 0.3 3.8 1.037c1.046 0.9 0.5 1.89-0.187 2 c-0.664 0.079-1.411-1.468-2.874-1.49c-1.509-0.022-2.528 1.571-0.665 2.024c1.861 0.5 3.9 0.6 4.6 2.3 C16.455 14.8 14.6 16.7 12.6 16.76z"/></g>',
		'<g id="devian"><path d="M11.747 10.649c2.892-0.069 5.2 1.4 5.6 3.778l-2.893 0.058l-0.02-1.923c-0.629-0.337-0.83-0.45-1.492-0.523 l-0.035 3.913H20c-0.374-3.838-3.814-6.841-8.001-6.841c-0.073 0-0.146 0-0.216 0.001L11.8 7.1 c-0.66-0.056-1.126 0.276-1.757 0.629l-0.012 1.624C6.868 10.1 4.3 12.8 4 15.95h7.785v-5.301H11.747z M10.072 14.4 l-3.359 0.086c0.262-1.62 1.974-3.136 3.333-3.597L10.072 14.37z"/></g>',
		'<g id="pinterest"><path d="M8.317 13.361c0.703-1.242-0.227-1.515-0.372-2.416c-0.596-3.68 4.244-6.193 6.779-3.622 c1.754 1.8 0.6 7.256-2.229 6.687c-2.71-0.545 1.325-4.901-0.836-5.756c-1.757-0.696-2.689 2.126-1.856 3.5 c-0.489 2.411-1.541 4.682-1.114 7.708c1.381-1.002 1.847-2.924 2.228-4.924c0.695 0.4 1.1 0.9 2 0.9 c3.264 0.3 5.089-3.258 4.641-6.5c-0.396-2.872-3.259-4.335-6.313-3.992c-2.415 0.27-4.822 2.222-4.922 5 C6.211 11.7 6.7 13 8.3 13.361z"/></g>',
		'<g id="tumbler"><path d="M10.493 5.792c-0.073 0.618-0.211 1.126-0.41 1.526C9.884 7.7 9.6 8.1 9.3 8.35c-0.328 0.289-0.72 0.507-1.18 0.7 v1.71h1.285v4.198c0 0.5 0.1 0.9 0.2 1.252c0.111 0.3 0.3 0.5 0.6 0.828c0.289 0.2 0.6 0.4 1 0.6 c0.412 0.1 0.9 0.2 1.4 0.205c0.47 0 0.911-0.049 1.313-0.146c0.401-0.097 0.858-0.266 1.358-0.508v-1.896 c-0.586 0.396-1.176 0.589-1.771 0.589c-0.335 0-0.63-0.078-0.89-0.235c-0.195-0.117-0.331-0.281-0.405-0.479 c-0.068-0.196-0.106-0.641-0.106-1.336v-3.073h2.784V8.824H12.21V5.792H10.493z"/></g>',
		'<g id="vimeo"><path d="M17.732 9.417c-0.051 1.179-0.83 2.796-2.342 4.85c-1.561 2.144-2.878 3.215-3.959 3.258c-0.668 0-1.235-0.65-1.697-1.959 c-0.306-1.195-0.617-2.396-0.925-3.587c-0.34-1.373-0.678-1.984-1.085-1.984c-0.086 0-0.386 0.192-0.899 0.571L6.268 9.8 c0.565-0.526 1.15-1.036 1.66-1.576c0.754-0.688 1.321-1.053 1.7-1.088c0.893-0.091 1.4 0.5 1.6 1.9 c0.225 1.5 0.4 2.4 0.5 2.779c0.256 1.2 0.5 1.8 0.8 1.834c0.24 0 0.601-0.402 1.082-1.206 c0.481-0.802 0.739-1.413 0.772-1.834c0.066-0.689-0.188-1.037-0.772-1.037c-0.276 0-0.561 0.065-0.85 0.2 c0.565-1.953 1.645-2.901 3.232-2.846c1.198 0.1 1.8 0.9 1.7 2.447H17.732z"/></g>',
		'<g id="linkedin"><path d="M9.269 7.02c0 0.714-0.586 1.293-1.307 1.293c-0.722 0-1.307-0.579-1.307-1.293 c0-0.712 0.585-1.291 1.307-1.291C8.683 5.7 9.3 6.3 9.3 7.02H9.269z M9.061 9.279H6.873v7.392h2.188V9.279z M12.91 9.3 h-1.795l-0.027 7.392h2.044c0 0 0-2.742 0-3.879c0-1.04 0.775-1.79 1.7-1.665c0.824 0.1 1.1 0.6 1.1 1.7 c0 1.028-0.021 3.915-0.021 3.89h2.025c0 0 0.025-2.729 0.025-4.708c0-1.981-1.006-2.78-2.604-2.78 c-1.599 0-2.248 1.096-2.248 1.096v-1H12.91z"/></g>',
		'<g id="lastfm"><path d="M11.217 15.157l-0.538-1.458c0 0-0.87 0.972-2.177 0.972c-1.159 0-1.979-1.009-1.979-2.621c0-2.064 1.04-2.807 2.063-2.807 c1.475 0 1.9 1 2.3 2.185l0.538 1.678c0.535 1.6 1.5 2.9 4.4 2.938c2.082 0 3.488-0.638 3.488-2.318 c0-1.357-0.771-2.063-2.216-2.4l-1.071-0.233c-0.739-0.17-0.953-0.472-0.953-0.973c0-0.572 0.453-0.907 1.188-0.907 c0.808 0 1.2 0.3 1.3 1.023l1.681-0.201c-0.088-1.521-1.174-2.125-2.884-2.135c-1.512 0-2.987 0.571-2.987 2.4 c0 1.1 0.5 1.9 1.9 2.203l1.141 0.27c0.854 0.2 1.1 0.6 1.1 1.042c0 0.624-0.603 0.877-1.739 0.9 c-1.697 0-2.399-0.893-2.802-2.116l-0.555-1.677c-0.702-2.184-1.826-2.99-4.058-2.99c-2.467 0-3.771 1.562-3.771 4.2 c0 2.5 1.3 3.9 3.6 3.93c2.041-0.041 2.903-0.947 2.903-0.94h0.042V15.157z"/></g>',
		'<g id="forrst"><polygon points="11.404,15.574 9.438,13.961 10.031,13.381 11.404,14.055 11.404,10.815 12.492,10.815 12.492,12.521 14.07,12.043 14.365,12.904 12.596,13.67 12.596,14.715 15.158,13.766 15.548,14.625 12.596,16.053 12.596,17.771 17.913,17.771 12,4.229 6.087,17.771 11.404,17.771 "/></g>',
		'<g id="flickr"><circle cx="8.3" cy="12" r="2.8"/><circle cx="15.7" cy="12" r="2.8"/></g>',
		'<g id="delicious"><path d="M16.553 6H7.457C6.652 6 6 6.7 6 7.454v9.089c0 0.9 0.6 1.5 1.4 1.455h9.095c0.806 0 1.458-0.651 1.458-1.455 V7.454C18.014 6.7 17.4 6 16.6 6H16.553z M16.906 16.327c0 0.252-0.344 0.605-0.594 0.582H12V12H7.219L7.188 7.8 c0-0.251 0.407-0.646 0.656-0.646H12v4.844h4.938L16.906 16.327L16.906 16.327z"/></g>',
		'<g id="rss"><path d="M9.258 16.374c0 0.894-0.728 1.62-1.625 1.62s-1.625-0.729-1.625-1.62c0-0.896 0.729-1.618 1.625-1.618 c0.898-0.027 1.7 0.7 1.7 1.618H9.258z M6.007 10.099v2.4c3.026 0 5.4 2.5 5.6 5.496h2.408 c-0.075-4.356-3.594-7.841-7.949-7.896H6.007z M6.007 8.419c2.556 0 5 1 6.8 2.812c1.812 1.9 2.8 4.2 2.8 6.751H18 C17.982 11.4 12.6 6 6 6.005L6.007 8.419L6.007 8.419z"/></g>',
		'<g id="you-tube"><path d="M18.877 9.35c-0.22-1.924-0.96-2.189-2.438-2.292c-2.101-0.147-6.781-0.147-8.88 0C6.084 7.2 5.3 7.4 5.1 9.3 c-0.163 1.429-0.164 3.9 0 5.298c0.22 1.9 1 2.2 2.4 2.294c2.099 0.1 6.8 0.1 8.9 0 c1.477-0.104 2.217-0.369 2.437-2.294C19.041 13.2 19 10.8 18.9 9.35z M9.69 15.335v-6.65l5.623 3.324L9.69 15.335z"/></g>',
		'<g id="dribbble"><path d="M12.012 5C8.139 5 5 8.1 5 12c0 3.8 3.1 7 7 7C15.861 19 19 15.9 19 12c0.025-3.857-3.075-7-7.012-7H12.012 z M17.787 11.674c-1.506-0.246-2.889-0.259-4.15-0.043c-0.145-0.329-0.291-0.656-0.447-0.979c1.352-0.583 2.438-1.376 3.244-2.378 c0.787 1 1.3 2.1 1.4 3.401L17.787 11.674L17.787 11.674z M15.54 7.456c-0.701 0.907-1.671 1.624-2.91 2.1 c-0.595-1.086-1.273-2.143-2.038-3.173c0.455-0.115 0.928-0.185 1.42-0.185c1.331-0.066 2.5 0.4 3.5 1.18L15.54 7.456z M9.398 6.847c0.779 1 1.5 2.1 2.1 3.138c-1.419 0.418-3.115 0.631-5.073 0.688c0.405-1.743 1.56-3.118 3.037-3.826H9.398 z M6.217 12c0-0.052 0.007-0.1 0.01-0.151c2.247-0.004 4.187-0.263 5.812-0.771c0.136 0.3 0.3 0.6 0.4 0.8 c-1.975 0.615-3.603 1.877-4.868 3.781C6.725 14.7 6.2 13.4 6.2 12H6.217z M8.458 16.6 c1.15-1.799 2.619-2.971 4.437-3.512c0.543 1.4 1 2.8 1.2 4.354c-0.646 0.246-1.348 0.39-2.077 0.4 c-1.329-0.055-2.571-0.546-3.555-1.273L8.458 16.593z M15.229 16.807c-0.258-1.371-0.636-2.716-1.121-4.021 c1.094-0.157 2.305-0.112 3.6 0.112c-0.273 1.634-1.23 3.009-2.516 3.908H15.229L15.229 16.807z"/></g>',
		'<g id="google"><path d="M19.02 10.145h-1.953l0.021 1.958h-1.344l-0.021-1.937l-1.854-0.019l-0.023-1.258l1.896-0.008V6.864h1.343V8.86 l1.938 0.042v1.243H19.02z M13.254 15.303c0 1.217-1.107 2.698-3.899 2.698c-2.043 0-3.748-0.884-3.748-2.364 c0-1.146 0.725-2.624 4.107-2.624c-0.5-0.412-0.625-0.985-0.318-1.604c-1.98 0-2.995-1.166-2.995-2.645 c0-1.447 1.076-2.762 3.271-2.762c0.557 0 3.5 0 3.5 0l-0.809 0.823h-0.923c0.651 0.4 1 1.1 1 2 c0 0.778-0.427 1.407-1.036 1.874c-1.085 0.838-0.807 1.4 0.3 2.133c1.091 0.8 1.5 1.5 1.5 2.48L13.254 15.3 L13.254 15.303z M10.863 8.771C10.712 7.8 10 7.1 9.1 7.068c-0.872-0.021-1.457 0.687-1.307 1.6 c0.151 0.9 0.9 1.6 1.9 1.562c0.848 0.1 1.305-0.531 1.201-1.458L10.863 8.771z M11.544 15.5 c0-0.707-0.78-1.379-2.087-1.379c-1.178-0.017-2.179 0.615-2.179 1.354c0 0.7 0.8 1.4 2 1.4 c1.56-0.031 2.338-0.553 2.338-1.334H11.544z"/></g>',
		'<g id="twitter"><path d="M18.614 6.604c-0.556 0.325-1.171 0.561-1.822 0.688c-0.526-0.551-1.271-0.896-2.099-0.896 c-1.586 0-2.875 1.269-2.875 2.83c0 0.2 0 0.4 0.1 0.646c-2.385-0.119-4.5-1.247-5.916-2.959 C5.729 7.3 5.6 7.8 5.6 8.336c0 1 0.5 1.9 1.3 2.354c-0.47-0.014-0.912-0.141-1.3-0.354c0 0 0 0 0 0 c0 1.4 1 2.5 2.3 2.774c-0.241 0.062-0.495 0.102-0.756 0.102c-0.186 0-0.365-0.02-0.541-0.055 c0.365 1.1 1.4 1.9 2.7 1.971c-0.982 0.756-2.222 1.208-3.567 1.208c-0.232 0-0.461-0.016-0.686-0.04 c1.271 0.8 2.8 1.3 4.4 1.272c5.286 0 8.171-4.312 8.171-8.055c0-0.123-0.003-0.246-0.009-0.367 C18.127 8.8 18.6 8.3 19 7.72c-0.516 0.225-1.068 0.378-1.648 0.446C17.943 7.8 18.4 7.3 18.6 6.604z"/></g>',
		'<g id="facebook"><path d="M14.545 11.521l-1.74 0.002l0.052 6.648h-2.453l0.014-6.648H8.824V9.421h1.592l-0.001-1.236 c0-1.713 0.485-2.756 2.592-2.756h1.758V7.53h-1.098c-0.824 0-0.863 0.293-0.863 0.84l-0.004 1.051h1.975L14.545 11.521z"/></g>',
		'<g id="xing"><polygon points="18.2,5 15.3,5 10.6,13.4 13.7,19 16.6,19 13.4,13.4"/><polygon points="9.5,7.6 6.6,7.6 8.2,10.3 5.8,14.6 8.7,14.6 11.2,10.3"/></g>',
		'<g id="odnoklassniki"><path d="M12.001 12.212c1.819 0 3.299-1.542 3.299-3.442c0-1.897-1.479-3.442-3.299-3.442c-1.822 0-3.302 1.544-3.302 3.4 C8.699 10.7 10.2 12.2 12 12.212z M12.001 7.346c0.753 0 1.4 0.6 1.4 1.424c0 0.788-0.612 1.426-1.365 1.4 s-1.367-0.638-1.367-1.426C10.634 8 11.2 7.3 12 7.346z"/><path d="M15.557 12.802c-0.285-0.47-0.883-0.613-1.334-0.315c-1.353 0.888-3.094 0.886-4.444 0 c-0.454-0.298-1.049-0.155-1.333 0.315c-0.286 0.473-0.149 1.1 0.3 1.393c0.597 0.4 1.2 0.7 1.9 0.826l-1.847 1.9 c-0.376 0.393-0.376 1 0 1.426c0.19 0.2 0.4 0.3 0.7 0.295c0.25 0 0.498-0.101 0.685-0.295l1.815-1.894l1.812 1.9 c0.377 0.4 1 0.4 1.4 0c0.379-0.396 0.379-1.033 0-1.426l-1.849-1.929c0.675-0.156 1.319-0.437 1.918-0.826 C15.704 13.9 15.8 13.3 15.6 12.802z"/></g>',
		'<g id="weibo"><path fill="none" d="M10.852 10.982c-0.188 0.001-0.379 0.012-0.571 0.03c-2.466 0.231-4.341 1.763-4.188 3.4 c0.153 1.7 2.3 2.8 4.7 2.582c2.469-0.23 4.344-1.766 4.188-3.42C14.884 12.1 13.1 11 10.9 10.982z M11.108 16.211c-1.224 0.528-2.753 0.096-3.123-0.938c-0.37-1.034 0.026-2.414 1.641-2.95c0.216-0.071 0.472-0.111 0.736-0.112 c0.795 0 1.7 0.3 2.1 1.232C12.883 14.4 12.3 15.7 11.1 16.211z"/><path fill="none" d="M10.749 13.609c-0.063 0-0.129 0.016-0.192 0.048c-0.169 0.091-0.25 0.274-0.181 0.4 c0.067 0.1 0.3 0.2 0.4 0.086c0.169-0.092 0.251-0.274 0.182-0.41C10.943 13.7 10.9 13.6 10.7 13.609z"/><path fill="none" d="M9.57 13.982c-0.158 0-0.328 0.043-0.494 0.14c-0.443 0.257-0.518 0.696-0.329 1.1 c0.133 0.3 0.7 0.4 1.1 0.14c0.443-0.258 0.483-0.799 0.309-1.08C10.059 14.1 9.8 14 9.6 13.982z"/><path d="M16.672 10.558c0.605 0.2 0.823-0.293 0.791-1.008c-0.023-0.497-0.229-0.817-0.35-1.026 c-0.319-0.541-0.963-0.885-1.555-0.893c-0.109-0.001-0.218 0.008-0.32 0.031c-0.283 0.061-0.624 0.182-0.494 0.7 c0.143 0.5 0.9 0.2 1.3 0.427s0.374 0.4 0.4 0.714C16.499 9.9 16.2 10.4 16.7 10.558z"/><path d="M19.473 9.129c-0.088-1.024-0.719-2.061-1.505-2.708c-0.653-0.54-1.608-0.859-2.464-0.864 c-0.122 0-0.242 0.006-0.359 0.019c-0.463 0.049-0.938 0.153-0.945 0.692c-0.012 0.5 0.4 0.6 0.6 0.6 c0.859-0.037 1.621-0.222 2.6 0.649c0.574 0.5 1 1.5 0.9 2.076c-0.168 1.098-0.326 1.5 0.2 1.7 C19.574 11.6 19.5 9.9 19.5 9.129z"/><path d="M10.362 12.211c-0.266 0.001-0.52 0.04-0.736 0.112c-1.615 0.536-2.011 1.916-1.641 3 c0.37 1 1.9 1.5 3.1 0.938c1.223-0.529 1.774-1.787 1.344-2.768C12.063 12.6 11.2 12.2 10.4 12.211z M9.858 15.354c-0.442 0.256-0.979 0.144-1.111-0.14c-0.189-0.396-0.112-0.835 0.329-1.092c0.165-0.097 0.336-0.14 0.493-0.14 c0.263 0 0.5 0.1 0.6 0.291C10.34 14.6 10.3 15.1 9.9 15.354z"/><path d="M15.493 11.402c-0.163-0.054 0.651-1.638-0.241-2.087c-1.504-0.756-3.555 0.668-3.464 0.3 c0.168-0.719 0.526-2.196-0.743-2.264c-0.087-0.009-0.176-0.013-0.265-0.012c-2.777 0.022-6.688 4.516-6.246 6.9 c0.479 2.6 3.6 3.8 6.7 3.658c2.804 0 6.714-2.161 6.292-4.678C17.516 12.4 16.6 11.8 15.5 11.402z M10.837 17.016c-2.466 0.23-4.589-0.927-4.743-2.582c-0.153-1.657 1.72-3.188 4.188-3.419c0.193-0.019 0.383-0.029 0.571-0.03 c2.212-0.018 4 1.1 4.2 2.615C15.18 15.3 13.3 16.8 10.8 17.016z"/></g>',
		'<g id="research-gate"><path d="M11.338,16.022c-0.048-0.261-0.078-0.633-0.087-1.129c-0.007-0.49-0.033-0.906-0.07-1.242c-0.039-0.34-0.111-0.614-0.216-0.842c-0.104-0.221-0.252-0.387-0.44-0.501c-0.194-0.119-0.45-0.196-0.772-0.239v-0.027c0.531-0.114,0.922-0.365,1.174-0.758c0.252-0.394,0.377-0.901,0.377-1.522c0-0.808-0.215-1.404-0.651-1.8c-0.435-0.396-1.039-0.591-1.825-0.591H5.358v9.262h1.879v-3.916h0.994c0.384,0,0.66,0.101,0.821,0.312c0.165,0.209,0.253,0.494,0.271,0.856l0.053,1.774c0.007,0.188,0.024,0.357,0.051,0.523c0.024,0.17,0.089,0.318,0.185,0.449h2.057V16.56C11.495,16.463,11.386,16.28,11.338,16.022z M9.062,11.142c-0.244,0.214-0.592,0.317-1.041,0.317H7.237V8.787h0.887c0.869,0,1.302,0.428,1.302,1.285C9.426,10.574,9.306,10.932,9.062,11.142z"/><path d="M15.606,11.641v1.374h1.235v0.947c0,0.247-0.036,0.467-0.114,0.654c-0.08,0.188-0.177,0.338-0.295,0.458c-0.115,0.125-0.242,0.214-0.38,0.271c-0.131,0.066-0.256,0.096-0.368,0.096c-0.269,0-0.486-0.09-0.656-0.25c-0.174-0.17-0.299-0.414-0.396-0.73c-0.092-0.314-0.155-0.693-0.188-1.141c-0.033-0.446-0.051-0.95-0.051-1.509c0-1.162,0.1-1.991,0.305-2.491c0.193-0.502,0.521-0.753,0.973-0.753c0.193,0,0.357,0.05,0.49,0.147c0.133,0.102,0.246,0.225,0.332,0.376c0.088,0.152,0.148,0.319,0.189,0.506s0.057,0.361,0.057,0.525h1.801c0-0.943-0.225-1.666-0.678-2.172c-0.451-0.507-1.189-0.761-2.217-0.761c-0.601,0-1.103,0.101-1.5,0.302c-0.398,0.196-0.724,0.494-0.965,0.887c-0.242,0.394-0.416,0.885-0.513,1.473c-0.104,0.588-0.151,1.271-0.151,2.047c0,0.808,0.032,1.512,0.104,2.122c0.065,0.606,0.205,1.123,0.409,1.537c0.199,0.413,0.486,0.729,0.847,0.938c0.358,0.214,0.834,0.317,1.403,0.317c0.439,0,0.822-0.078,1.142-0.244c0.313-0.162,0.588-0.426,0.812-0.791h0.029v0.855h1.379v-4.991H15.606z"/></g>',
		'<g id="yelp"><path d="M8.378,5.342c0.739-0.581,2.159-0.747,2.743-0.633c0.586,0.112,0.891,0.439,0.895,0.838l0.034,5.08c0.003,0.399-0.205,0.767-0.461,0.815c-0.258,0.049-0.637-0.188-0.845-0.528L8.079,6.558C7.873,6.218,7.455,6.068,8.378,5.342 M7.493,15.003l2.684-0.949c0.373-0.134,0.708-0.504,0.746-0.823c0.036-0.32-0.235-0.701-0.604-0.847l-2.834-1.125c-0.369-0.146-0.795,0.2-0.907,0.767c0,0-0.068,1.972,0,2.379C6.645,14.812,7.119,15.135,7.493,15.003 M12.174,15.477c0.008-0.4-0.206-0.745-0.475-0.77c-0.27-0.025-0.696,0.205-0.951,0.51l-1.872,2.244c-0.256,0.305-0.129,1.021,0.243,1.157l1.957,0.68c0.373,0.137,1.028-0.266,1.036-0.664L12.174,15.477z M16.826,14.955l-2.347-0.676c-0.381-0.108-0.813-0.099-0.96,0.025c-0.146,0.122-0.108,0.51,0.082,0.857l1.481,2.712c0.192,0.349,0.958,0.289,1.169-0.05c0,0,0.893-1.317,1.057-1.811C17.473,15.519,17.207,15.063,16.826,14.955 M17.398,11.142c-0.105-0.343-0.841-1.354-1.237-1.698c-0.397-0.346-0.852-0.303-1.107,0.001l-1.514,1.802c-0.256,0.304-0.324,0.784-0.152,1.067c0.17,0.282,0.627,0.442,1.013,0.356l2.617-0.485C17.489,12.071,17.506,11.484,17.398,11.142"/></g>',
		'<g id="blogger"><path d="M6.031,14.114c0,2.131,1.739,3.854,3.882,3.854h4.179c2.145,0,3.877-1.724,3.877-3.854v-2.732c0-0.425-0.342-0.77-0.771-0.77h-0.654c-0.426,0-0.76-0.318-0.787-0.717c-0.004-2.14-1.742-3.865-3.886-3.865H9.913c-2.144,0-3.88,1.725-3.882,3.855V14.114z M13.086,10c0,0.62-0.345,1.125-0.77,1.125h-2.261c-0.423,0-0.768-0.505-0.768-1.125c0-0.623,0.345-1.125,0.768-1.125h2.261C12.741,8.875,13.086,9.376,13.086,10z M15.256,14.078c0,0.597-0.326,1.089-0.725,1.089h-4.523c-0.399,0-0.721-0.492-0.721-1.089S9.608,13,10.008,13h4.523C14.93,13,15.256,13.481,15.256,14.078z"/></g>'
		];


		var icons = $('<svg id="svg-source" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" style="position:absolute; margin-left: -100%" xmlns:xlink="http://www.w3.org/1999/xlink">'+icons+'</svg>');
		
		$(document.body).prepend($(icons));

		$(".soc-ico a").not(".entry-share .soc-ico a").html('<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#social-500px"></use></svg>');
		$(".entry-share .soc-ico a").append('<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#social-500px"></use></svg>')
		var svg_icon = $(".soc-ico a svg use");

		$(".px-500").find(svg_icon).attr("xlink:href", "#social-500px");
		$(".tripedvisor").find(svg_icon).attr("xlink:href", "#tripedvisor");
		$(".vk").find(svg_icon).attr("xlink:href", "#vk");
		$(".foursquare").find(svg_icon).attr("xlink:href", "#foursquare");
		$(".website").find(svg_icon).attr("xlink:href", "#website");
		$(".mail").find(svg_icon).attr("xlink:href", "#mail");
		$(".behance").find(svg_icon).attr("xlink:href", "#behance");
		$(".stumbleupon").find(svg_icon).attr("xlink:href", "#stumbleupon");
		$(".instagram").find(svg_icon).attr("xlink:href", "#instagram");
		$(".github").find(svg_icon).attr("xlink:href", "#github");
		$(".skype").find(svg_icon).attr("xlink:href", "#skype");
		$(".devian").find(svg_icon).attr("xlink:href", "#devian");
		$(".pinterest").find(svg_icon).attr("xlink:href", "#pinterest");
		$(".tumbler").find(svg_icon).attr("xlink:href", "#tumbler");
		$(".vimeo").find(svg_icon).attr("xlink:href", "#vimeo");
		$(".linkedin").find(svg_icon).attr("xlink:href", "#linkedin");
		$(".lastfm").find(svg_icon).attr("xlink:href", "#lastfm");
		$(".forrst").find(svg_icon).attr("xlink:href", "#forrst");
		$(".flickr").find(svg_icon).attr("xlink:href", "#flickr");
		$(".delicious").find(svg_icon).attr("xlink:href", "#delicious");
		$(".rss").find(svg_icon).attr("xlink:href", "#rss");
		$(".you-tube").find(svg_icon).attr("xlink:href", "#you-tube");
		$(".dribbble").find(svg_icon).attr("xlink:href", "#dribbble");
		$(".google").find(svg_icon).attr("xlink:href", "#google");
		$(".twitter").find(svg_icon).attr("xlink:href", "#twitter");
		$(".facebook").find(svg_icon).attr("xlink:href", "#facebook");
		$(".xing").find(svg_icon).attr("xlink:href", "#xing");
		$(".odnoklassniki").find(svg_icon).attr("xlink:href", "#odnoklassniki");
		$(".weibo").find(svg_icon).attr("xlink:href", "#weibo");
		$(".research-gate").find(svg_icon).attr("xlink:href", "#research-gate");
		$(".yelp").find(svg_icon).attr("xlink:href", "#yelp");
		$(".blogger").find(svg_icon).attr("xlink:href", "#blogger");
	
	/*Show soc icons*/
	$(".soc-ico a").css("visibility", "visible");



/* #Photo slider core
================================================== */
// ;(function($){
	$.fn.exists = function() {
		if ($(this).length > 0) {
			return true;
		} else {
			return false;
		}
	}

	$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len = this.length;
		if (len > 0) {
			return this.each(function() {
				var el    = this,
					$el  = $(el),
					blank = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};

	$.rsCSS3Easing = {
		easeOutSine: 'cubic-bezier(0.390, 0.575, 0.565, 1.000)',
		easeInOutSine: 'cubic-bezier(0.445, 0.050, 0.550, 0.950)'
	};

	$.extend(jQuery.easing, {
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		}
	});

	$.thePhotoSlider = function(element, settings) {
		var self = $(element).data("thePhotoSlider");

		if (!self) {
			this._init(element, settings);
		}
		else {
			self.update();
		};
	};

	$.thePhotoSlider.defaults = {
		mode: {
			type: "slider"
		},
		responsive: true,
		height: false,
		width: false,
		sidePaddings: 0,
		storeHTML: false,
		autoPlay: false,
		threshold: 20,
		collapsePoint: 700
	};

	$.thePhotoSlider.prototype = {
		_init: function(element, settings) {
			var self = this;
			self.st = $.extend({}, $.thePhotoSlider.defaults, settings);
			self.ev = $(self);

			self.autoPlay = {
				enabled: false,
				delay: 2000,
				loop: true
			};

			self.currSlide = 0;
			self.noSlide = true;
			self.lockLeft = true;
			self.lockRight = true;

			self.sliderLock = false;
			self.lockTimeout = false;

			self.wrap = {};
			self.wrap.$el = $(element);
			self.wrap.width = 0;
			self.wrap.height = false;
			self.wrap.$el.data("thePhotoSlider", self);

			self.viewport = self.wrap.$el.find(".ts-viewport");

			self.cont = {};
			self.cont.$el = self.viewport.find(".ts-cont");
			self.cont.width = 0;
			self.cont.startX = 0;
			self.cont.instantX = 0;
	 
			self.slides = {};
			self.slides.$items = self.cont.$el.children();
			self.slides.number = self.slides.$items.length;
			self.slides.position = [];
			self.slides.width = [];
			self.slides.isLoaded = [];

			self.drag = {};
			self.drag.isMoving = false;
			self.drag.startX = 0;
			self.drag.startY = 0;
			self.drag.offsetX = 0;
			self.drag.offsetY = 0;
			self.drag.lockX = false;
			self.drag.lockY = false;

			self.features = {};
			self._featureDetection();

			if (self.st.storeHTML) self.origHTML = self.wrap.$el.html();
			self._buildHTML();

			self._calcSliderSize();
			if (!self.wrap.height) self.wrap.$el.addClass("ts-autoHeight");

			self._setSliderWidth();
			self._adjustSlides();
			self._setSliderHeight();

			/* if (self.st.mode.type === "centered") */ self.slideTo(0, true);

			if (!self.noSlide) self._bindEvents();

			setTimeout(function() {
				self.wrap.$el.addClass("ts-ready");
				self.ev.trigger("sliderReady");
			}, 20);

			if (self.st.responsive) {
				if (!("onorientationchange" in window)) {
					var dtResizeTimeout;

					$(window).on("resize", function(e) {
						clearTimeout(dtResizeTimeout);
						dtResizeTimeout = setTimeout(function() {
							self.update();
						}, 200);
					});
				}
				else {
					var scrOrientation = window.orientation;

					$(window).on("orientationchange", function(e) {
						var tempOrientation = window.orientation;

						if (tempOrientation !== scrOrientation) {
							scrOrientation = tempOrientation;
							self.update();
						};
					});
				};
			};

			if(self.st.autoPlay.enabled) {
				self.play();
			};
		},

		_featureDetection: function() {
			var self = this,
				tempStyle = document.createElement('div').style,
				vendors = ['webkit','Moz','ms','O'],
				tempV;
				self.features.vendor = '';


			for (i = 0; i < vendors.length; i++ ) {
				tempV = vendors[i];
				if (!self.features.vendor && (tempV + 'Transform') in tempStyle ) {
					self.features.vendor = "-"+tempV.toLowerCase()+"-";
				}
			}

			if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 && !('ontouchstart' in window)) {
				self.features.css3d = Modernizr.csstransforms3d;
				//self.features.css3d = false;
			}
			else if (typeof Modernizr != "undefined") {
				self.features.css3d = Modernizr.csstransforms3d;
				//self.features.css3d = false;
			}
		},

		_buildHTML: function() {
			var self = this;

			if (self.st.mode.type === "centered") {
				self.wrap.$el.addClass("ts-centered");
			};

			if (self.st.mode.type === "slider") {
				self.slides.$items.addClass("ts-slide");
			}
			else if (self.st.mode.type === "scroller" || self.st.mode.type === "centered" || self.st.mode.type === "carousel") {
				self.slides.$items.addClass("ts-cell");
			};
		},

		_calcSliderSize: function() {
			var self = this,
				typeofWidth = typeof self.st.width,
				typeofHeight = typeof self.st.height,
				tempWidth = false,
				tempHeight = false;

			self.wrap.width = self.wrap.$el.width();

			if (typeofWidth === "function") {
				tempWidth = self.st.width(this);
			}
			else if (typeofWidth === "number") {
				tempWidth = self.st.width;
			};

			if (typeofHeight === "function") {
				tempHeight = self.st.height(this);
			}
			else if (typeofHeight === "number") {
				tempHeight = self.st.height;
			};

			if (tempHeight && !tempWidth) { 
				// Calculate once or on resize (if typeofHeight === "function")
				self.wrap.height = tempHeight;
			}
			else if (tempHeight && tempWidth) {
				// Calculate on resize
				self.wrap.height = ( tempHeight * self.wrap.width ) / tempWidth;
			}
			else {
				// Calculate on every slide change and resize
				self.wrap.height = false;
			};
		},

		_setSliderWidth: function() {
			var self = this;

			if (self.st.mode.type !== "centered") {
				self.viewport.css({
					width: self.wrap.width
				});
			}
			else if (self.wrap.width > self.st.collapsePoint) {
				self.wrap.$el.removeClass("ts-collapsed");
			}
			else {
				self.wrap.$el.addClass("ts-collapsed");
			};
		},

		_setSliderHeight: function() {
			var self = this;

			if (typeof self.wrap.height === "number") {
				// Fixed & proportional height
				self.viewport.css({
					height: self.wrap.height
				});
			}
			else if (self.st.mode.type === "scroller" || self.st.mode.type === "centered" || self.st.mode.type === "carousel") {
				// Auto height; scroller and centered only
				if (self.viewport.css("height") === "0px" || self.viewport.css("height") == 0 || !self.viewport.css("height")) {
					self.viewport.css({
						height: Math.max.apply(null, self.slides.height)
					});
				};
			}
			else if (self.slides.isLoaded[self.currSlide]) {
				// Auto height; current slide is loaded
				var jsHeight = $(self.slides.$items[self.currSlide]).height();

				if (jsHeight > 0) {
					self.viewport.css({
						height: jsHeight
					});
				}
				else {
					// !This will cause "collapsed" slider
					self.viewport.css({
						height: auto
					});
				};
			}
			else {
				// Auto height; current slide is NOT loaded
				var jsHeight = $(self.slides.$items[self.currSlide]).height();

				if (jsHeight > 0) {
					self.viewport.css({
						height: jsHeight
					});
				}
				else {
					// !This will cause "collapsed" slider
					self.viewport.css({
						height: auto
					});
				};

				// !What this doing here (instead of _adjustSlides)
	/*
				self.slides.$items[self.currSlide].find("img").loaded(false, function() {
					$(self.slides.$items[self.currSlide]).addClass("ts-loaded");
					self._setSliderHeight();
				}, true);
	*/
			};
		},

		_adjustSlides: function() {
			var self = this;

			if (self.st.mode.type === "slider") {
				self.cont.width = 0;

				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};
					
					self.slides.position[i] = - self.cont.width - self.st.sidePaddings/2;
					self.cont.width = self.cont.width + self.wrap.width + self.st.sidePaddings;
					//if (self.wrap.height) tempCSS.height = self.wrap.height;
					tempCSS.left = -self.slides.position[i];

					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					} else {
					};

					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "centered") {
					self.cont.width = 0;
					self.slides.contRatio = [];
					self.slides.ratio = [];

				if (self.st.mode.lsMinW || self.st.mode.lsMaxW) {
					var lsMinW = self.wrap.width/100 * self.st.mode.lsMinW,
						lsMaxW = self.wrap.width/100 * self.st.mode.lsMaxW;
				};

				if (self.st.mode.ptMinW || self.st.mode.ptMaxW) {
					var ptMinW = self.wrap.width/100 * self.st.mode.ptMinW,
						ptMaxW = self.wrap.width/100 * self.st.mode.ptMaxW;
				};

				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					var dataWidth = $slide.attr("data-width") ? parseFloat($slide.attr("data-width")) : $slide.width(),
						dataHeight = $slide.attr("data-height") ? parseFloat($slide.attr("data-height")) : $slide.height();

					if (!self.slides.contRatio[i]) {
						self.slides.contRatio[i] =  dataWidth / dataHeight;

						if (self.slides.contRatio[i] > 1) {
							$slide.addClass("ts-ls");
						}
						else {
							$slide.addClass("ts-pt");
						};
					};

					if (self.wrap.width > self.st.collapsePoint) {
						dataHeight = self.wrap.height;
						dataWidth = self.wrap.height * self.slides.contRatio[i];
	
						if ((lsMinW || lsMaxW) && (dataWidth > dataHeight)) {
							if (lsMinW === lsMaxW || dataWidth > lsMaxW) {
								dataWidth = lsMaxW;
							}
							else if (dataWidth < lsMinW) {
								dataWidth = lsMinW;
							};
						}
						else if ((ptMinW || ptMaxW) && (dataWidth <= dataHeight)) {
							if (ptMinW === ptMaxW || dataWidth > ptMaxW) {
								dataWidth = ptMaxW;
							}
							else if (dataWidth < ptMinW) {
								dataWidth = ptMinW;
							};            
						};
	
						self.slides.ratio[i] = dataWidth / dataHeight;

						tempCSS.height = self.wrap.height;
						tempCSS.width = self.slides.width[i] = dataWidth;
	
						self.slides.position[i] = - self.cont.width;
						self.cont.width = self.cont.width + self.slides.width[i] + self.st.sidePaddings;
						tempCSS.left = -self.slides.position[i];
					}
					else {
						dataHeight = tempCSS.height = self.wrap.height;
						dataWidth = self.slides.width[i] = tempCSS.width = self.wrap.width;
						self.slides.ratio[i] = dataWidth / dataHeight;

						self.slides.position[i] = - self.cont.width;
						self.cont.width = self.cont.width + self.slides.width[i];

						tempCSS.left = -self.slides.position[i];
					};

					// Adjust position to slide center
					self.slides.position[i] = self.slides.position[i] - (self.slides.width[i]/2);


					if (self.slides.ratio[i] > self.slides.contRatio[i]) {
						$slide.removeClass("ts-narrow");
						$slide.addClass("ts-wide");
					}
					else {
						$slide.removeClass("ts-wide");
						$slide.addClass("ts-narrow");
					};

					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					} 
					else {
					};

					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "scroller") {
				self.cont.width = 0;
				self.slides.ratio = [];
				if (!(typeof self.wrap.height === "number")) {
					self.slides.height = [];
				}
	
				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					var dataWidth = $slide.attr("data-width") ? parseFloat($slide.attr("data-width")) : $slide.width(),
						dataHeight = $slide.attr("data-height") ? parseFloat($slide.attr("data-height")) : $slide.height();
	
					if (dataWidth > 0 && dataHeight > 0) {
						self.slides.ratio[i] =  dataWidth / dataHeight;
					}
					else {
						self.slides.ratio[i] = 1;
					};
	
					if (typeof self.wrap.height === "number") {
						// Fixed & proportional height
						self.slides.width[i] = self.wrap.height * self.slides.ratio[i];
	
						tempCSS.width = self.slides.width[i];
						tempCSS.height = self.slides.width[i] / self.slides.ratio[i]; 
					}
					else if (dataWidth > 0 && dataHeight > 0) {
						// Auto height;
						if (!self.slides.width[i]) tempCSS.width = self.slides.width[i] = dataWidth;
						if (!self.slides.height[i]) { 
							tempCSS.height = "100%";
						};
						self.slides.height[i] = dataHeight;
					}
					else {
						// Auto height;
						$slide.css("height", "auto");

						self.slides.width[i] = $slide.width();
						self.slides.height[i] = $slide.height();

						tempCSS.height = "100%";
					};

					self.slides.position[i] = - self.cont.width;
					self.cont.width = self.cont.width + self.slides.width[i];
					if (i < self.slides.number - 1) self.cont.width += self.st.sidePaddings
					tempCSS.left = -self.slides.position[i]// + self.st.sidePaddings/2;
	
					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					}
					else {
					};
	
					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "carousel") {
				self.cont.width = 0;

				var perView =  self.st.mode.perView,
					minWidth = self.st.mode.minWidth,
					cellWidth = self.wrap.width/perView;
		
				while (cellWidth < minWidth && perView > 0.31) {
					perView--;
					if (perView < 1) perView = 1;
					cellWidth = self.wrap.width/perView;
				};

				self.perView = perView;
				//self.st.sidePaddings = 0;
		
				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					self.slides.position[i] = - self.cont.width;
					self.cont.width = self.cont.width + cellWidth;
					tempCSS.width = cellWidth - self.st.sidePaddings;
					tempCSS.left = -self.slides.position[i] + self.st.sidePaddings/2;

					$slide.css(tempCSS);
				});
			};

			// Adjusting slides conteiner position and updating navigation
			if ( (self.st.mode.type !== "centered") && (self.cont.width <= self.wrap.width) ) {
				self.noSlide = true;
				self._transitionStart(0, 0, "easeInOutSine", true);
				self.cont.$el.css( "left", (self.wrap.width - self.cont.width) / 2 );

				self.lockLeft = true;
				self.lockRight = true;
				self.ev.trigger("updateNav");
			}
			else if ( (self.st.mode.type === "centered") && (self.slides.number < 2) /* && (self.cont.width <= self.wrap.width / 2) */ ) {
				self.noSlide = true;
				self._transitionStart(0, 0, "easeInOutSine", true);
				self.cont.$el.css( "left", -(self.cont.width) / 2 );

				self.lockLeft = true;
				self.lockRight = true;
				self.ev.trigger("updateNav");
			}
			else {
				self.noSlide = false;
				self.cont.$el.css( "left", "" );

				if (self.lockRight) {
					self.lockLeft = false;
					self.lockRight = true;
					self.ev.trigger("lockRight").trigger("updateNav");
				}
				else if ( self.currSlide <= 0 ) {
					self.lockLeft = true;
					self.lockRight = false;
					self.ev.trigger("lockLeft").trigger("updateNav");
				}
				else if ( self.currSlide > 0 ) {
					self.lockLeft = false;
					self.lockRight = false;
					self.ev.trigger("updateNav");
				};
			};
		},

		_unifiedEvent: function(event) {
			if (event.originalEvent.touches !== undefined && event.originalEvent.touches[0]) {
				event.pageX = event.originalEvent.touches[0].pageX;
				event.pageY = event.originalEvent.touches[0].pageY;
			}
			return event;
		},

		_unifiedX: function() {
			var self = this,
				coord = 0,
				css3dTransform = self.cont.$el.css("transform");

			if (css3dTransform) {
				var css3dArray = css3dTransform.split(", ");
			}

			if (self.features.css3d && css3dTransform !== "none" && css3dArray[0] === "matrix(1") {
				coord = parseFloat(css3dArray[4]);
			}
			else if (self.features.css3d && css3dTransform !== "none" && css3dArray[0] === "matrix3d(1") {
				coord = parseFloat(css3dArray[12]);
			}
			else {
				//coord = self.cont.$el.position().left;
				coord = parseFloat(self.cont.$el.css("left"));
			};

			return coord;
		},

		_bindEvents: function() {
			var self = this;

			self.wrap.$el.on("mousedown.theSlider touchstart.theSlider", function(event) {
				if (event.type != "touchstart") event.preventDefault();

				self._onStart( self._unifiedEvent(event) );

				$(document).on("mousemove.theSlider touchmove.theSlider", function(event) {
					self._onMove( self._unifiedEvent(event) );
				});
				$(document).on("mouseup.theSlider mouseleave.theSlider touchend.theSlider touchcancel.theSlider", function(event) {
					$(document).off("mousemove.theSlider mouseup.theSlider mouseleave.theSlider touchmove.theSlider touchend.theSlider touchcancel.theSlider");
					self._onStop( self._unifiedEvent(event) );
				});
			});
		},

		_unbindEvents: function() {
			var self = this;

			self.wrap.$el.off("mousedown.theSlider touchstart.theSlider");
			$(document).off("mousemove.theSlider mouseup.theSlider mouseleave.theSlider touchmove.theSlider touchend.theSlider touchcancel.theSlider");
		},

		_onStart: function(event) {
			var self = this;

			if (!self.drag.isMoving && !self.sliderLock) {
				//self._transitionEnd();

				self.drag.isMoving = true;
				self.drag.startX = event.pageX;
				self.drag.startY = event.pageY;
				self.cont.startX = self._unifiedX();

				self.drag.offsetX = 0;
				self.drag.offsetY = 0;
				self.drag.lockX = false;
				self.drag.lockY = false;
			}
			else {
				//self._transitionCancel();
			};
		},

		_onMove: function(event) {
			var self = this,
				coord = 0;

			if (self.drag.isMoving) {
				self.drag.offsetX = event.pageX - self.drag.startX;
				self.drag.offsetY = event.pageY - self.drag.startY;

				if ( (Math.abs(self.drag.offsetX) >= self.st.threshold-1) && (Math.abs(self.drag.offsetX) > Math.abs(self.drag.offsetY)) && !self.drag.lockX ) {
					self.drag.lockX = false;
					self.drag.lockY = true;
					if (event.type == "touchmove") self.drag.offsetY = 0;
				} 
				else if( (Math.abs(self.drag.offsetY) >= self.st.threshold-1) && (Math.abs(self.drag.offsetX) < Math.abs(self.drag.offsetY)) && !self.drag.lockY ) {
					self.drag.lockX = true;
					self.drag.lockY = false;
					if (event.type == "touchmove") self.drag.offsetX = 0;
				};

				if (self.drag.lockX && event.type == "touchmove") self.drag.offsetX = 0;
				else if (self.drag.lockY && event.type == "touchmove") self.drag.offsetY = 0;

				if (self.drag.lockY) event.preventDefault();

				self.cont.instantX = self.cont.startX + self.drag.offsetX;

				if ( self.cont.instantX < 0 && self.cont.instantX > -self.cont.width + self.viewport.width()) {
					coord = self.cont.instantX;
				}
				else if (self.cont.instantX >= 0) {
					coord = self.cont.instantX/4;
				}
				else {
					coord = (-self.cont.width + self.viewport.width()) + ((self.cont.width - self.viewport.width() + self.cont.instantX) / 4);
				};

				self._doDrag(coord);
			};

			if (self.st.autoPlay.enabled) {
				self.pause();
			};
		},

		_onStop: function(event) {
			var self = this;

			if (self.drag.isMoving) {
				self.cont.instantX = self.cont.startX + self.drag.offsetX;

				if (Math.abs(self.drag.offsetX) > self.st.threshold) {
					self.wrap.$el.addClass("ts-interceptClicks");
					self.wrap.$el.one("click.preventClick", function(e) {
						e.preventDefault();
						e.stopImmediatePropagation();
						e.stopPropagation();
					}); 
					window.setTimeout(function() {
						self.wrap.$el.off('click.preventClick');
						self.wrap.$el.removeClass("ts-interceptClicks");
					}, 301);
				};

				self._autoAdjust();
				self._setSliderHeight();

				self.cont.startX = 0;
				self.cont.instantX = 0;
		
				self.drag.isMoving = false;
				self.drag.startX = 0;
				self.drag.startY = 0;
				self.drag.offsetX = 0;
				self.drag.offsetY = 0;
				self.drag.lockX = false;
				self.drag.lockY = false;
			};

			if(self.st.autoPlay.enabled) {
				self.play();
			}

			return false;
		},

		_doDrag: function(coord) {
			var self = this;

			if (self.features.css3d) {
				var tempCSS = {};

				tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS[self.vendor+"transition"] = "";
				tempCSS["transition"] = "";

				self.cont.$el.css(tempCSS);
			}
			else {
				self.cont.$el.css({
					"left": coord
				});
			};
		},

		_calcCurrSlide: function(coord) {
			var self = this,
				tempCurrSlide = self.slides.number - 1;

			self.slides.$items.each(function(i) {
				if ( coord > self.slides.position[i] ) {
					tempCurrSlide = i-1;
					return false;
				};
			});
			if (tempCurrSlide < 0) tempCurrSlide = 0;

			return tempCurrSlide;
		},

		_isRightExceed: function(coord) {
			var self = this,
				edge = 0;

			if (self.st.mode.type === "centered") {
				edge = self.slides.position[self.slides.number - 1];
			}
			else {
				edge = -self.cont.width + self.viewport.width();
			};

			if (coord < edge) {
				return true;
			}
			else {
				return false;
			};
		},

		_autoAdjust: function() {
			var self = this,
				adjustTo = 0,
				duration = 0,
				tempCurrSlide = self.slides.number - 1;

			/*
			if (self.drag.offsetX == 0) {
				console.log("No movement. Canceling _autoAdjust.");
				return false;
			}
			*/

			if (self.cont.instantX >= 0) {
				// leftmost edge reached
				adjustTo = self.slides.position[0];
				self.currSlide = 0;

				self.lockLeft = true;
				self.lockRight = false;
				self.ev.trigger("lockLeft").trigger("updateNav");
			}
			else if ( self._isRightExceed(self.cont.instantX) ) {
				// rightmost edge reached
				if (self.st.mode.type === "centered") {
					adjustTo = self.slides.position[self.slides.number-1];
				}
				else {
					adjustTo = -self.cont.width + self.viewport.width();
				};

				self.currSlide = self._calcCurrSlide(adjustTo);

				self.lockLeft = false;
				self.lockRight = true;
				self.ev.trigger("lockRight").trigger("updateNav");
			}
			else {
				// autoadjust to closest slide
				if (self.drag.offsetX < -self.st.threshold) {
					// flick from right to left
					tempCurrSlide = self._calcCurrSlide(self.cont.instantX) + 1;

					if (self._isRightExceed(self.slides.position[tempCurrSlide])) {
						adjustTo = -self.cont.width + self.viewport.width();

						for ( i = tempCurrSlide; i >= 0; i-- ) {
							if (!self._isRightExceed(self.slides.position[i])) {
								tempCurrSlide = i;
								break;
							}
						}

						self.lockLeft = false;
						self.lockRight = true;
						self.ev.trigger("lockRight").trigger("updateNav");
					}
					else {
						adjustTo = self.slides.position[tempCurrSlide];

						if  ( tempCurrSlide < self.slides.number - 1 ) {
							self.lockLeft = false;
							self.lockRight = false;
							self.ev.trigger("updateNav");
						}
						else {
							self.lockLeft = false;
							self.lockRight = true;
							self.ev.trigger("lockRight").trigger("updateNav");
						};
					};

					self.currSlide = tempCurrSlide;
				}
				else if (self.drag.offsetX > self.st.threshold) {
					// flick from left to right
					self.currSlide = self._calcCurrSlide(self.cont.instantX);
					adjustTo = self.slides.position[self.currSlide];

					if ( self.currSlide > 0 ) {
						self.lockLeft = false;
						self.lockRight = false;
						self.ev.trigger("updateNav");
					}
					else {
						self.lockLeft = true;
						self.lockRight = false;
						self.ev.trigger("lockLeft").trigger("updateNav");
					};
				}
				else {
					// flick cenceled, since it's to short
					adjustTo = self.cont.startX;
				};

			};


			//duration = Math.sqrt(Math.abs(self.cont.instantX - adjustTo)) * 15 + 50;
			// duration = Math.abs(self.cont.instantX - adjustTo)/2 + 100;
			duration = Math.sqrt(Math.abs(self.cont.instantX - adjustTo)) * 10 + 100;
			self._transitionStart(adjustTo, duration, "easeOutSine");
		},

		_transitionStart: function(coord, duration, easing, justSet) {
			var self = this,
				tempCSS = {},
				cssEasing = $.rsCSS3Easing[easing];

			self._transitionEnd();
			self.ev.trigger("beforeTransition");

			if (justSet) {
				if (self.features.css3d) {
					tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
					tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
				}
				else {
					//console.log("and, here's the issue");
					tempCSS.left = coord;
				};

				self.cont.$el.css(tempCSS);
				return false;
			}

			self.ev.trigger("beforeTransition");

			self.sliderLock = true;
			clearTimeout(self.lockTimeout);
			self.lockTimeout = setTimeout(function() {
				self.sliderLock = false;
				self.ev.trigger("afterTransition");
			}, duration);

			if (self.features.css3d) {
				tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS[self.features.vendor+"transition"] = "all "+duration+"ms "+cssEasing;
				tempCSS["transition"] = "all "+duration+"ms "+cssEasing;

				self.cont.$el.css(tempCSS);

				self.cont.$el.one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function() {
					//self.sliderLock = false;
					//console.log("Release slider. sliderLock: "+self.sliderLock);

					//self._transitionEnd();
				});
			}
			else {
				//self.sliderLock = false;
				//console.log("Release slider. sliderLock: "+self.sliderLock);
				self.cont.$el.animate({
					"left": coord
				}, duration, easing);
			};
		},

		_transitionEnd: function() {
			var self = this;

			if (self.features.css3d) {
				var tempCSS = {};
					tempCSS[self.vendor+"transition"] = "";
					tempCSS["transition"] = "";

				self.cont.$el.css(tempCSS);
			}
			else {
				self.cont.$el.stop();
			};
		},

		_transitionCancel: function() {
			var self = this,
				coord = self.cont.$el.position().left,
				tempCSS = {};

			tempCSS[self.vendor+"transition"] = "";
			tempCSS["transition"] = "";

			self.cont.$el.off("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend");

			if (self.features.css3d) {
				var str = self.cont.$el.css("transform"),
					result = str.split(", ");

				coord = result[4];

				tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS["transform"] = "translate3d("+coord+"px,0,0)";

				self.cont.$el.css(tempCSS);
			}
			else {
				self.cont.$el.stop();
				self.cont.$el.animate({
					"left": coord
				}, duration, easing);
			};
		},

		pause: function() {
			var self = this;
			self._autoPlayRunning = false;
			if( self._autoPlayTimeout) {
				clearTimeout(self._autoPlayTimeout);
				self._autoPlayTimeout = null;
			}
			
		},

		slideTo: function(slideID, justSet) {
			var self = this,
				slideToX = self.slides.position[slideID],
				duration = 0,
				oldID = self.currSlide;
			self.pause();

			if (self.noSlide) return false;

			self._transitionEnd();

			if (slideToX >= self.slides.position[0]) {
				// leftmost edge reached
				self.currSlide = 0;

				self.lockLeft = true;
				self.lockRight = false;
				self.ev.trigger("lockLeft").trigger("updateNav");
			}
			else if ( self._isRightExceed(slideToX) || slideID >= self.slides.number - 1 ) {
				// rightmost edge reached
				if (self.st.mode.type === "centered") {
					slideToX = self.slides.position[slideID];
					self.currSlide = slideID;
				}
				else {
					slideToX = -self.cont.width + self.viewport.width();
					self.currSlide = self._calcCurrSlide(slideToX);
				};

				self.lockLeft = false;
				self.lockRight = true;
				self.ev.trigger("lockRight").trigger("updateNav");
			}
			else {
				self.currSlide = slideID;

				self.lockLeft = false;
				self.lockRight = false;
				self.ev.trigger("updateNav");
			};

			//duration = Math.abs(self.slides.position[oldID] - slideToX)/2 + 100;
			duration = Math.sqrt(Math.abs(self.slides.position[oldID] - slideToX)) * 10 + 100;
			self._transitionStart(slideToX, duration, "easeInOutSine", justSet);

			if ( /*$(".auto-play-btn").hasClass('paused')*/self.st.autoPlay.enabled) {
				self.play();
			}
		},

		startPlay: function() {
			var self = this;

			if (self.currSlide + 1 <= self.slides.number - 1 && !self.lockRight) {
				self.slideTo(self.currSlide + 1);
			}
			else if (self.currSlide >= self.slides.number-1 && self.st.autoPlay.loop) {
				self.slideTo(0);
			}
			else if (self.lockRight && self.st.autoPlay.loop) {
				self.slideTo(0);
			}

			/*
			if (self.st.mode.type === "centered") {
				slideToX = self.slides.position[slideID];
				self.currSlide = slideID;
			}
			else {
				slideToX = -self.cont.width + self.viewport.width();
				self.currSlide = self._calcCurrSlide(slideToX);
			};
			*/
		},

		play: function() {
			var self = this;
			self._autoPlayRunning = true;
			if(self._autoPlayTimeout) {
				clearTimeout(self._autoPlayTimeout);
			}
			self._autoPlayTimeout = setTimeout( function() {
				self.startPlay();
			}, self.st.autoPlay.delay );
		},

		slideNext: function() {
			var self = this;

			if (self.currSlide + 1 <= self.slides.number - 1) {
				self.slideTo(self.currSlide + 1);
			}
			else {
				return false;
			};
		},

		slidePrev: function() {
			var self = this;

			if (self.currSlide - 1 >= 0) {
				self.slideTo(self.currSlide - 1);
			}
			else if (self.currSlide == 0 && self.lockLeft == false) {
				self.slideTo(self.currSlide);
			}
			else {
				return false;
			};
		},

		update: function() {
			var self = this;

			self._calcSliderSize();
			self._setSliderWidth();
			self._adjustSlides();
			self._setSliderHeight();
			self._doDrag();

			if (self.noSlide) {
				self.slideTo(0, true);
				self._unbindEvents();
			}
			else {
				self.slideTo(self.currSlide, true);
				self._bindEvents();
			}
		}
	};

	$.fn.thePhotoSlider = function(settings) {
		return this.each(function() {
			new $.thePhotoSlider(this, settings);
		});
	};

// })(jQuery);


/* #Photo slider initialisation
================================================== */
// jQuery(document).ready(function($) {
	var $photoScroller = $(".photo-scroller");
	if($photoScroller.length > 0){
		/* !Set slider */
		$.fn.photoSlider = function() {
			var $el = $(this),
				slides = {},
				thumbs = "";
				$elParent = $el.parents(".photo-scroller");

				slides.$items = $el.children("figure");
				slides.count = slides.$items.length;

			slides.$items.each(function(i) {
				var $this = $(this),
					$slide = $this.children().first().remove(),
					src = $slide.attr("href"),
					$thumbImg = $slide.children("img"),
					thumbSrc = $thumbImg.attr("src");

				// !Captions copying
				$this.find("figcaption").addClass("caption-" + (i+1) + "");
				var $thisCaptionClone = $(this).find("figcaption").clone(true);
				$(".slide-caption").append($thisCaptionClone);
				if (parseInt($elParent.attr("data-thumb-width")) > 0) {
					var thisWidth = parseInt($elParent.attr("data-thumb-width")),
						thisHeight = parseInt($elParent.attr("data-thumb-height"));

					$elParent.removeClass("proportional-thumbs");
				}
				else {
					var thisWidth = parseInt($thumbImg.attr("width")),
						thisHeight = parseInt($thumbImg.attr("height"));

					$elParent.addClass("proportional-thumbs");
				};

				thumbs = thumbs + '<div class="ts-cell" data-width="'+(thisWidth+5)+'" data-height="'+(thisHeight+10)+'"><div class="ts-thumb-img"><img src="'+thumbSrc+'" width="'+thisWidth+'" height="'+thisHeight+'"></div></div>'; 

				$this.prepend('<div class="ts-slide-img"><img src="'+src+'" width="'+$this.attr("data-width")+'" height="'+$this.attr("data-height")+'"></div>');
			});
			$elParent.append('<div class="scroller-arrow prev"><i></i><i></i></div><div class="scroller-arrow next"><i></i><i></i></div>')

			$el.addClass("ts-cont");
			$el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

			var $slider = $el.parents(".ts-wrap"),
				windowW = $window.width(),
				$sliderPar = $elParent,
				$sliderAutoslide = ($sliderPar.attr("data-autoslide") == "true") ? true : false,
				$sliderAutoslideDelay = ($sliderPar.attr("data-delay") && parseInt($sliderPar.attr("data-delay")) > 999) ? parseInt($sliderPar.attr("data-delay")) : 5000,
				$sliderLoop = ($sliderPar.attr("data-loop") === "true") ? true : false,
				$thumbHeight = $sliderPar.attr("data-thumb-height") ? parseInt($sliderPar.attr("data-thumb-height"))+10 : 80+10,
				$slideOpacity = $sliderPar.attr("data-transparency") ? $sliderPar.attr("data-transparency") : 0.5,
				$adminBarH = $("#wpadminbar").length > 0? $("#wpadminbar").height() : 0;

			// !New settings for cells;
			var dataLsMin = $sliderPar.attr("data-ls-min") ? parseInt($sliderPar.attr("data-ls-min")) : 0,
				dataLsMax = $sliderPar.attr("data-ls-max") ? parseInt($sliderPar.attr("data-ls-max")) : 100,
				dataLsFillDt = $sliderPar.attr("data-ls-fill-dt") ? $sliderPar.attr("data-ls-fill-dt") : "fill",
				dataLsFillMob = $sliderPar.attr("data-ls-fill-mob") ? $sliderPar.attr("data-ls-fill-mob") : "fit",
				dataPtMin = $sliderPar.attr("data-pt-min") ? parseInt($sliderPar.attr("data-pt-min")) : 0,
				dataPtMax = $sliderPar.attr("data-pt-max") ? parseInt($sliderPar.attr("data-pt-max")) : 100,
				dataPtFillDt = $sliderPar.attr("data-pt-fill-dt") ? $sliderPar.attr("data-pt-fill-dt") : "fill",
				dataPtFillMob = $sliderPar.attr("data-pt-fill-mob") ? $sliderPar.attr("data-pt-fill-mob") : "fit",
				dataSidePaddings  = $sliderPar.attr("data-padding-side") ? parseInt($sliderPar.attr("data-padding-side")) : 0;

			// !Normalize new settings for cells;
			if (dataLsMax <= 0) dataLsMax = 100;
			if (dataPtMax <= 0) dataPtMax = 100;
			if (dataLsMax < dataLsMax) dataLsMax = dataLsMax;
			if (dataPtMax < dataPtMax) dataPtMax = dataPtMax;

			$slider.addClass("ts-ls-"+dataLsFillDt).addClass("ts-ls-mob-"+dataLsFillMob);
			$slider.addClass("ts-pt-"+dataPtFillDt).addClass("ts-pt-mob-"+dataPtFillMob);

			$slider.find(".ts-slide-img").css({
				"opacity": $slideOpacity
			});
			$slider.find(".video-icon").css({
				"opacity": $slideOpacity
			});


			var	$slideTopPadding = ($sliderPar.attr("data-padding-top") && windowW > 760) ? $sliderPar.attr("data-padding-top") : 0,
				$slideBottomPadding = ($sliderPar.attr("data-padding-bottom") && windowW > 760) ? $sliderPar.attr("data-padding-bottom") : 0;

			var $sliderVP = $slider.find(".ts-viewport");
			$sliderVP.css({
				"margin-top": $slideTopPadding+"px",
				"margin-bottom": $slideBottomPadding+"px"
			});
			
			$window.on("debouncedresize", function() {
				if ($sliderPar.attr("data-padding-top") && $window.width() > 760) {
					$slideTopPadding = $sliderPar.attr("data-padding-top");
				}
				else {
					$slideTopPadding = 0;
				};

				if ($sliderPar.attr("data-padding-bottom") && $window.width() > 760) {
					$slideBottomPadding = $sliderPar.attr("data-padding-bottom");
				}
				else {
					$slideBottomPadding = 0;
				};

				if ($window.width() > 760) {
					$sliderVP.css({
						"margin-top": $slideTopPadding+"px",
						"margin-bottom": $slideBottomPadding+"px"
					});
				}
				else {
					$sliderVP.css({
						"margin-top": 0+"px",
						"margin-bottom": 0+"px"
					});
				};
			});

			/* !Initializinig the main slider */
			var $sliderData = $slider.thePhotoSlider({
				mode: {
					type: "centered",
					lsMinW: dataLsMin,
					lsMaxW: dataLsMax,
					ptMinW: dataPtMin,
					ptMaxW: dataPtMax,
				},
				height: function() {
					// if ($(window).width() < 760) {
					// 	return (window.innerHeight);
					// }else 
					var $windowH = $window.height(),
						$adminBarH = $("#wpadminbar").height();
					if ($(".mixed-header").length > 0){
						var $headerH = $(".mixed-header").height();
					}else{						
						var $headerH = $(".masthead").height();
					}
					if ($body.hasClass("transparent") || $slider.parents(".photo-scroller").hasClass("full-screen")) {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.secondSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
						}else {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);							
						};

					}else if ($(".mixed-header").length > 0 || $slider.parents(".photo-scroller").hasClass("full-screen")) {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);					
						}else {
							if($(".side-header-h-stroke").length > 0){
								return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
							}else{
								return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);
							}
						};

					}else if ($(".side-header").length > 0 || $slider.parents(".photo-scroller").hasClass("full-screen")) {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
						}else {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);							
						};

					}else {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);						
						}else {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
						};

					};
				},
				sidePaddings: dataSidePaddings,
				autoPlay: {
					enabled: $sliderAutoslide,
					delay: $sliderAutoslideDelay,
					loop: $sliderLoop
				}
			}).data("thePhotoSlider");


			var $thumbsScroller = $('<div class="ts-wrap"><div class="ts-viewport"><div class="ts-cont ts-thumbs">'+thumbs+'</div></div></div>');
			$slider.after($thumbsScroller);

			/* !Initializinig the thumbnail stripe */
			var $thumbsScrollerData = $thumbsScroller.thePhotoSlider({
				mode: {
					type: "scroller"
				},
				height: $thumbHeight
			}).data("thePhotoSlider");


			$(".prev", $this_par).click(function() {
				if (!$sliderData.noSlide) $sliderData.slidePrev();
			});
			$(".next", $this_par).click(function() {
				if (!$sliderData.noSlide) $sliderData.slideNext();
			});

			$sliderData.ev.on("updateNav sliderReady", function() {
				if ($sliderData.lockRight) {
					$(".next", $elParent).addClass("disabled");
				} else {
					$(".next", $elParent).removeClass("disabled");
				};

				if ($sliderData.lockLeft) {
					$(".prev", $elParent).addClass("disabled");
				} else {
					$(".prev", $elParent).removeClass("disabled");
				};
			});
			/*keyboard navigation*/
			window.addEventListener("keydown", checkKeyPressed, false); 
			function checkKeyPressed(e) {
				if (e.keyCode == "37") {
					if (!$sliderData.noSlide) $sliderData.slidePrev();
				} else if (e.keyCode == "39") { 
					if (!$sliderData.noSlide) $sliderData.slideNext();
				} 
			}


			// !Active slide indication and thumbnail mechanics: begin */
			$sliderData.ev.on("sliderReady beforeTransition", function() {
				$sliderData.slides.$items.removeClass("act");
				$sliderData.slides.$items.eq($sliderData.currSlide).addClass("act");

				$thumbsScrollerData.slides.$items.removeClass("act");
				$thumbsScrollerData.slides.$items.eq($sliderData.currSlide).addClass("act");

				if($sliderData.slides.$items.eq($sliderData.currSlide).hasClass("ts-video")){
					$sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-slider-overlay");
				}else if($sliderData.slides.$items.eq($sliderData.currSlide).find(".ps-link").length > 0){
					$sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-slider-overlay");
				}else{
					$sliderData.slides.$items.parents(".ts-wrap ").removeClass("hide-slider-overlay");
				};


				var actCaption = $sliderData.slides.$items.eq($sliderData.currSlide).find("figcaption").attr("class");

				$('.slide-caption > figcaption').removeClass("actCaption");
				$('.slide-caption > .'+actCaption).addClass("actCaption");
			});

			$sliderData.ev.on("afterTransition", function() {
				var viewportLeft	= -($thumbsScrollerData._unifiedX()),
					viewportRight	= viewportLeft + $thumbsScrollerData.wrap.width,
					targetLeft		= -$thumbsScrollerData.slides.position[$sliderData.currSlide],
					targetRight		= targetLeft + $thumbsScrollerData.slides.width[$sliderData.currSlide];

				targetLeft = targetLeft - 50;
				targetRight = targetRight + 50;

				if (targetLeft < viewportLeft) {

					for (i = $thumbsScrollerData.currSlide; i >= 0; i--) {
						targetLeft = targetLeft + 50;
						targetRight = targetRight - 50;

						var tempViewportLeft	= -$thumbsScrollerData.slides.position[i],
							tempViewportRight	= tempViewportLeft + $thumbsScrollerData.wrap.width;

						if (targetRight > tempViewportRight) {
							$thumbsScrollerData.slideTo(i+1);
							break;
						} 
						else if (i === 0) {
							$thumbsScrollerData.slideTo(0);
						}
					}
				}
				else if (targetRight > viewportRight) {
					$thumbsScrollerData.slideTo($sliderData.currSlide);
				};
			});

			$thumbsScroller.addClass("scroller-thumbnails");
			$thumbsScrollerData.slides.$items.each(function(i) {
				$(this).on("click", function(event) {
					var $this = $(this);

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
					$sliderData.slideTo(i);
				});
			});
			$sliderData.slides.$items.each(function(i) {
				$(this).on("click", function(event) {
					var $this = $(this);

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
					$sliderData.slideTo(i);
				});
			});
			// !Active slide indication and thumbnail mechanics: end */

			var $this_par = $slider.parents(".photo-scroller");

			/* !- Autoplay */
			if( $sliderData.st.autoPlay.enabled ){
				$(".auto-play-btn", $this_par).addClass("paused");
			}
			
			$(".auto-play-btn", $this_par).on("click", function(e){
				e.preventDefault();
				var $this = $(this);
				if( $this.hasClass("paused")){
					$this.removeClass("paused");
					if (!$sliderData.noSlide) $sliderData.pause();
					$sliderData.st.autoPlay.enabled = false;
				}else{
					$this.addClass("paused");
					if (!$sliderData.noSlide) $sliderData.play();
					$sliderData.st.autoPlay.enabled = true;
				}
			});

		};

		/* !- Initialize slider */
		$(".photoSlider").photoSlider();
		
		/* !- Show slider*/

		$(".photoSlider").parents(".photo-scroller").css("visibility", "visible");

		
		function launchFullscreen(element) {
			if(element.requestFullscreen) {
				element.requestFullscreen();
			} else if(element.mozRequestFullScreen) {
				element.mozRequestFullScreen();
			} else if(element.webkitRequestFullscreen) {
				element.webkitRequestFullscreen();
			} else if(element.msRequestFullscreen) {
				element.msRequestFullscreen();
			}
		}
		function exitFullscreen() {
			if(document.exitFullscreen) {
				document.exitFullscreen();
			} else if(document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if(document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			}
		};

		/* !- Fullscreen button */
		if(!dtGlobals.isWindowsPhone){
			$(".full-screen-btn").each(function(){
				var $this = $(this),
					$thisParent = $this.parents(".photo-scroller");
				document.addEventListener("fullscreenchange", function () {
					if(!document.fullscreen){
						$this.removeClass("act");
						$thisParent.removeClass("full-screen");
						$("body, html").css("overflow", "");
					}
				}, false);
				document.addEventListener("mozfullscreenchange", function () {
					if(!document.mozFullScreen){
						$this.removeClass("act");
						$thisParent.removeClass("full-screen");
						$("body, html").css("overflow", "");
					}
				}, false);
				document.addEventListener("webkitfullscreenchange", function () {
					if(!document.webkitIsFullScreen){
						$this.removeClass("act");
						$thisParent.removeClass("full-screen");
						$("body, html").css("overflow", "");
						var scroller = $frame.data("thePhotoSlider");
						if(typeof scroller!= "undefined"){
							scroller.update();
						};
					}
				}, false);
			})

			$(".full-screen-btn").on("click", function(e){
				e.preventDefault();
				var $this = $(this),
					$thisParent = $this.parents(".photo-scroller"),
					$frame = $thisParent.find(".ts-wrap"),
					$thumbs = $thisParent.find(".scroller-thumbnails").data("thePhotoSlider"),
					$scroller = $frame.data("thePhotoSlider");
				$this.parents(".photo-scroller").find("figure").animate({"opacity": 0},150);
				if( $this.hasClass("act")){
				
					$this.removeClass("act");
					exitFullscreen();
					$thisParent.removeClass("full-screen");

					setTimeout(function(){
						$this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
					}, 300);
				}else{
					 $this.addClass("act");
					$thisParent.addClass("full-screen");
					launchFullscreen(document.documentElement);
					$("body, html").css("overflow", "hidden");
					setTimeout(function(){
						$this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
					}, 300)
				}
				var scroller = $frame.data("thePhotoSlider");
				if(typeof scroller!= "undefined"){
					scroller.update();
				};
			});
		}

		/* !- Show/hide thumbs */
		$photoScroller.each(function(){
			var $this = $(this);
			
			$(".btn-cntr, .slide-caption", $this).css({
				"bottom": parseInt($this.attr("data-thumb-height")) + 15
			});

			if( $this.hasClass("hide-thumbs")){
				$this.find(".hide-thumb-btn").addClass("act");
				$(".scroller-thumbnails", $this).css({
					"bottom": -(parseInt($this.attr("data-thumb-height")) +20)
				});
				$(".btn-cntr, .slide-caption", $this).css({
					"bottom": 5 + "px"
				});
			}
		});
		$(".hide-thumb-btn").on("click", function(e){
			e.preventDefault();
			var $this = $(this),
				$thisParent = $this.parents(".photo-scroller");
			if( $this.hasClass("act")){
				 $this.removeClass("act");
				$thisParent.removeClass("hide-thumbs");
				$(".scroller-thumbnails", $thisParent).css({
					"bottom": 0
				});
				$(".btn-cntr, .slide-caption", $thisParent).css({
					"bottom": parseInt($thisParent.attr("data-thumb-height")) + 15
				});

			}else{
				 $this.addClass("act");
				$thisParent.addClass("hide-thumbs");
				$(".scroller-thumbnails", $thisParent).css({
					"bottom": -(parseInt($thisParent.attr("data-thumb-height")) +20)
				});
				$(".btn-cntr, .slide-caption", $thisParent).css({
					"bottom": 5 + "px"
				});
			}
		});
	};
// })


/* #Shortcodes scroller
================================================== */
// jQuery(document).ready(function($) {

	$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").each(function(i) {
		var $this = $(this),
			$img = $this.find("img").eq(0),
			imgW = parseInt($img.attr("width")),
			imgH = parseInt($img.attr("height"));

		if (!$img.exists()) imgW = 280;

		var leftPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingLeft")),
			rightPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingRight")),
			addedW = 0;

		if (leftPadding > 0 && rightPadding > 0) addedW = leftPadding + rightPadding;

		$this.attr("data-width", imgW + addedW).css({
			width: imgW + addedW,
			opacity: 1
		});

		var $imgPar = $img.parent("a"),
			imgParW = $imgPar.width(),
			imgParH = (imgH * imgParW) / imgW;

		$img.parent("a").css({
			height: imgParH
		});

		$(".fs-entry-content:not(.buttons-on-img)", $this).css("opacity", "1");
	}).find("article").css("height", "100%");

	$(".text-on-img .fullwidth-slider .fs-entry, .description-on-hover .fs-entry, .dt-photos-shortcode .fs-entry").each(function() {
		var $this = $(this);

		$(".rollover-project", $this).css({
			"width": $this.attr("data-width"),
			"height": $this.attr("data-height")
		});
	});


	$.fn.shortcodesScroller = function() {
		var $el = $(this),
			slides = {},
			thumbs = "";

			slides.$items = $el.children(".fs-entry"),
			slides.count = slides.$items.length;

		$el.addClass("ts-cont");
		$el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

		var scroller = $el.parents(".ts-wrap"),
			$this_par = $el.parents(".slider-wrapper"),
			windowW = $window.width(),
			paddings = $this_par.attr("data-padding-side") ? parseInt($this_par.attr("data-padding-side")) : 0,
			$sliderAutoslide = ( 'true' === $this_par.attr("data-autoslide") ) ? true : false,
			$sliderAutoslideDelay = $this_par.attr("data-delay") && parseInt($this_par.attr("data-delay")) > 999 ? parseInt($this_par.attr("data-delay")) : 5000,
			$sliderLoop = ( 'true' === $this_par.attr("data-loop") ) ? true : false;

		var $sliderData = scroller.thePhotoSlider({
			mode: {
				type: "scroller"
			},
			sidePaddings: paddings,
			autoPlay: {
				enabled: $sliderAutoslide,
				delay: $sliderAutoslideDelay,
				loop: $sliderLoop
			}
		}).data("thePhotoSlider");

		$(".prev", $this_par).click(function() {
			if (!$sliderData.noSlide) $sliderData.slidePrev();
		});
		$(".next", $this_par).click(function() {
			if (!$sliderData.noSlide) $sliderData.slideNext();
		});

		$sliderData.ev.on("updateNav sliderReady", function() {
			if ($sliderData.lockRight) {
				$(".next", $this_par).addClass("disabled");
			} else {
				$(".next", $this_par).removeClass("disabled");
			};

			if ($sliderData.lockLeft) {
				$(".prev", $this_par).addClass("disabled");
			} else {
				$(".prev", $this_par).removeClass("disabled");
			};
			if ($sliderData.lockRight && $sliderData.lockLeft) {
				$this_par.addClass("hide-arrows");
			};
		});

		scroller.hover(
			function() {
				if($sliderAutoslide) {
					$sliderData._autoPlayPaused = false;
					$sliderData.pause();
					$sliderData._pausedByHover = true;
				}
			},
			function() {
				if($sliderAutoslide) {
					$sliderData._pausedByHover = false;
					if(!$sliderData._pausedByClick){
						$sliderData.play();
					}
				}
			}
		);
	};

	$(".slider-wrapper .blog-media").css({
		"height": ""
	});

	$(".fullwidth-slider ul.clearfix").each(function(){
		$(this).shortcodesScroller();
	});

	var $sliderWrapper = $(".slider-wrapper");

	$sliderWrapper.css("visibility", "visible");

	$sliderWrapper.each(function(){
		var $this = $(this),
			$thisUl = $this.find(".ts-wrap").data("thePhotoSlider");

		$this.append('<a href="#" class="auto-play-btn"></a>');

		$this.on("mouseenter", function(e) {
			$this.addClass("show-arrows");
		});
		$this.on("mouseleave", function(e) {
			//setTimeout(function(){
				$this.removeClass("show-arrows");
			//}, 200);
		});


		if( $thisUl.st.autoPlay.enabled ){
			$(".auto-play-btn", $this).addClass("paused");
		}
		$(".auto-play-btn", $this).on("click", function(e){
			e.preventDefault();
			var $this = $(this);
			if( $this.hasClass("paused")){
				$this.removeClass("paused");
				$thisUl._pausedByClick = true;
				if (!$thisUl.noSlide) $thisUl.pause();
				$thisUl.st.autoPlay.enabled = false;
			}else{
				$this.addClass("paused");
				$thisUl._pausedByClick = false;
				if (!$thisUl.noSlide) $thisUl.play();
				$thisUl.st.autoPlay.enabled = true;
			}
		});

	});
// })


/* #Header
================================================== */

	// var $document = $(document),
	// 	$window = $(window),
	// 	$html = $("html"),
	// 	$body = $("body"),
	var $overlayHeader = $(".overlay-navigation"),
		$stickyHeader = $(".sticky-header"),
		$mainSlider = $("#main-slideshow, .photo-scroller"),
		$leftHeader = $(".header-side-left").length > 0,
		$rightHeader = $(".header-side-right").length > 0,
		$main = $("#main, #main-slideshow, .photo-scroller, .page-title, .fancy-header, .footer"),
		$topHeader = $(".floating-logo.side-header-menu-icon .branding, .side-header-h-stroke, #phantom"),
		$sideHeader = $(".side-header"),
		$movesideHeader = $(".move-header-animation").length > 0,
		$onePage = $(".page-template-template-microsite").length > 0,
		dtScrollTimeout;
		if($(".side-header-v-stroke").length > 0){			
			var $sideHeaderW = $sideHeader.width() - $(".side-header-v-stroke").width(),
				$delay = 200;
		}else{
			var $sideHeaderW = $sideHeader.width(),
				$delay = 0;
		}

	/* !-overlap header for webkit*/
		$overlapContent = $(".overlap #content");
	if ( !$.browser.webkit || dtGlobals.isMobile ){
	}else{
		$overlapContent.find(">:first-child").css({
			position: "relative",
			"z-index": "4"
		});
		if( $overlapContent.find(">:first-child").height() < 36 ){
			$overlapContent.find("> :nth-child(2)").css({
				position: "relative",
				"z-index": "4"
			})
		};
	};
	$.closeSideHeader = function(){
		$page.removeClass("show-mobile-header show-header");
		$page.addClass("closed-mobile-header closed-header");
		$body.removeClass("show-sticky-mobile-header show-sticky-header show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
		$(".mobile-sticky-header-overlay, .dt-mobile-menu-icon, .menu-toggle").removeClass("active");
		$(".sticky-header-overlay").removeClass("active");
		if($movesideHeader){
			if($leftHeader){
				$sideHeader.velocity({
					translateX : -100 + "%"
				}, 400);
			}else{
				$sideHeader.velocity({
					translateX : 100 + "%"
				}, 400);
			}
				$main.velocity({
					translateX : ""
				}, 400, function() {
					$main.css({
						"transform": "none"
					});
				});
				$topHeader.velocity({
					translateX : ""
				}, 400);
			
		};
	}


	/*!-Show Hide side header*/
	if($stickyHeader.length > 0 || $overlayHeader.length > 0 ) {
		$('<div class="lines-button x"><span class="lines"></span></div>').appendTo(".menu-toggle");
		if($stickyHeader.length > 0) {
			$body.append('<div class="sticky-header-overlay"></div>');
			if(!$(".side-header-h-stroke").length > 0 && !$(".header-under-side-line").length > 0 && $(".mixed-header").length > 0){
				var mixedMenuToggle = $(".mixed-header").find(".menu-toggle").position().top;
				$(".mixed-header").find(".menu-toggle").clone(true).prependTo(".side-header").css({
					top: mixedMenuToggle
				});
			}
		};
		/*hiding side header*/
		if($movesideHeader){
			if($leftHeader){
				$sideHeader.velocity({
					translateX : -100 + "%"
				}, 0);
			}else if($rightHeader){
				$sideHeader.velocity({
					translateX : 100 + "%"
				}, 0);
			}
		};

		if( $overlayHeader.length > 0 ) {
			$($sideHeader).append('<div class="hide-overlay"></div>');
			$('<div class="lines-button x"><span class="lines"></span></div>').appendTo(".hide-overlay");
			
		}

		var $hamburger = $(".menu-toggle .lines-button"),
			$menuToggle = $(".menu-toggle"),
			$overlay = $(".sticky-header-overlay");

		$hamburger.on("click", function (){
			if(!$(".header-under-side-line").length > 0){
				var $this = $(".side-header .menu-toggle");
			}else{
				var $this = $(".menu-toggle");
			}
			if ($this.hasClass("active")){
				$this.removeClass("active");
				$page.removeClass("show-header").addClass("closed-header");
				$this.parents("body").removeClass("show-sticky-header");
				$overlay.removeClass("active");
				$(".hide-overlay").removeClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : -100 + "%"
						},
						{
							 duration: 400,
							 delay: $delay
						});
					}else{
						$sideHeader.velocity({
							translateX : 100 + "%"
						},
						{
							 duration: 400,
							 delay: $delay
						} );
					}
					if(!$page.hasClass("boxed")){
						$main.velocity({
							translateX : ""
						}, 400, function() {
							$main.css({
								"transform": "none"
							});
						});
						$topHeader.velocity({
							translateX : ""
						}, 400);
					}
				};
	
			}else{
				$menuToggle.removeClass("active");
				$this.addClass('active');
				$page.addClass("show-header").removeClass("closed-header");
				$this.parents("body").addClass("show-sticky-header");
				
				$overlay.addClass("active");
				$(".hide-overlay").addClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : ""
						}, 400);
						if(!$page.hasClass("boxed")){
							$main.velocity({
								translateX : $sideHeaderW
							}, {
								 duration: 400,
								 delay: $delay
							});
							$topHeader.velocity({
								translateX : $sideHeaderW
							}, 
							{
								duration: 400,
								 delay: $delay
							});
						}
					}else {
						$sideHeader.velocity({
							translateX : ""
						}, 400);
						if(!$page.hasClass("boxed")){
							$main.velocity({
								translateX : -$sideHeaderW
							},
							{
								duration: 400,
								 delay: $delay
							});
							$topHeader.velocity({
								translateX : -$sideHeaderW
							},
							{
								 duration: 400,
								 delay: $delay
							} );
						}
					}
				}
				
			};
		});
		$overlay.on("click", function (){
			if($(this).hasClass("active")){
				$menuToggle.removeClass("active");
				$page.removeClass("show-header").addClass("closed-header");
				$body.removeClass("show-sticky-header");
				$overlay.removeClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : -100 + "%"
						}, 
						{
							 duration: 400,
							 delay: $delay
						});
					}else{
						$sideHeader.velocity({
							translateX : 100 + "%"
						}, 
						{
							 duration: 400,
							 delay: $delay
						});
					}
					$main.velocity({
						translateX : ""
					}, 400, function() {
						$main.css({
							"transform": "none"
						});
					});
					$topHeader.velocity({
						translateX : ""
					}, 400);
				}
			}
		});
		$(".hide-overlay").on("click", function (){
			if($(this).hasClass("active")){
				$menuToggle.removeClass("active");
				$page.removeClass("show-header");
				$page.addClass("closed-header");
				$body.removeClass("show-sticky-header");
				$overlay.removeClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : -100 + "%"
						},
						{
							 duration: 400,
							 delay: $delay
						} );
					}else{
						$sideHeader.velocity({
							translateX : 100 + "%"
						}, 
						{
							 duration: 400,
							 delay: $delay
						});
					}
					$main.velocity({
						translateX : ""
					}, 400, function() {
						$main.css({
							"transform": "none"
						});
					});
					$topHeader.velocity({
						translateX : ""
					}, 400);
				}
			}
		});
	};

	/* !- Right-side header + boxed layout */
	function ofX() {

		var $windowW = $window.width(),
			$boxedHeaderPos = ($windowW - $page.innerWidth())/2,
			$sideHeaderToggleExist = $(".side-header-menu-icon").length > 0;

		if ($body.hasClass("header-side-right") && $page.hasClass("boxed")) {
			if(!$stickyHeader.length > 0){
				$sideHeader.css({
					right: $boxedHeaderPos
				});
			};
			if($sideHeaderToggleExist){
				$menuToggle.css({
					right: $boxedHeaderPos
				});
				$(".branding").css({
					left: $boxedHeaderPos
				});
			}
		};
		if ($body.hasClass("header-side-left") && $page.hasClass("boxed")) {
			
			if($sideHeaderToggleExist){
				
				$(".floating-logo .branding").css({
					right: $boxedHeaderPos
				});
				$menuToggle.css({
					left: $boxedHeaderPos
				});
			}
		};
		if($overlayHeader.length > 0 && $sideHeaderToggleExist  && $page.hasClass("boxed")){
			$menuToggle.css({
				right: $boxedHeaderPos
			});
			$(".floating-logo .branding").css({
				left: $boxedHeaderPos
			});

		}
	};

	ofX();
	$window.on("resize", function() {
		ofX();
	});


	/*Default scroll for mobile*/

	var position = 0;
	window.clickMenuToggle = function( $el, e ) {
	//$hamburger.on("click", function(e) {
		if($(".show-mobile-header").length > 0){
			var $menu = $(".dt-mobile-header");	
		}else{
			var $menu = $sideHeader;		
		}
		if(!$onePage) {
			if(!$html.hasClass("menu-open")) {
				position = dtGlobals.winScrollTop;
				$html.addClass("menu-open");

				if (!dtGlobals.isiOS) {
					$body.css("margin-top", -position);
				}
				else {
					$window.on("touchstart.dt", function(e) {
						$window.off("touchmove.dt");

						if ($menu[0].offsetHeight >= $menu[0].scrollHeight) {
							$window.on("touchmove.dt", function(e) {
								e.preventDefault();
							});
						}
						else if ($menu[0].scrollTop <= 0) {
							$menu[0].scrollTop += 1;
						}
						else if ($menu[0].scrollTop + $menu[0].offsetHeight >= $menu[0].scrollHeight) {
							$menu[0].scrollTop -= 1;
						};
					});
				};
			}
			else {
				$html.removeClass("menu-open");

				if (!dtGlobals.isiOS) {
					$body.css("margin-top", 0);
					$window.scrollTop(position);
				} 
				else {
					$window.off("touchstart.dt");
					$window.off("touchmove.dt");	
				}
			};
		};
	};
	$body.on( 'click', '.menu-toggle .lines-button, .sticky-header-overlay, .hide-overlay, .dt-mobile-menu-icon, .dt-close-mobile-menu-icon span, .mobile-sticky-header-overlay, .floating-btn', function( e ) {
		clickMenuToggle( $( this ), e );
	});

	/*Side header scrollbar for desctop*/
	$(".side-header .header-bar").wrap("<div class='header-scrollbar-wrap'></div>");
	if($sideHeader.length > 0 && !dtGlobals.isMobile){
		$(".header-scrollbar-wrap").mCustomScrollbar({
			scrollInertia:150
		});
	};

		dtGlobals.desktopProcessed = false;
		dtGlobals.mobileProcessed = false;
	var headerBelowSliderExists = $(".floating-navigation-below-slider").exists(),
		bodyTransparent = $body.hasClass("transparent");

	$.headerBelowSlider = function(){
		if (headerBelowSliderExists) {
			var $header = $(".masthead:not(.side-header):not(#phantom)");

			if (window.innerWidth > dtLocal.themeSettings.mobileHeader.secondSwitchPoint && !dtGlobals.desktopProcessed) {
				dtGlobals.desktopProcessed = true;
				dtGlobals.mobileProcessed = false;

				if (bodyTransparent) {
					$header.insertAfter("#main-slideshow, .photo-scroller").velocity({
						translateY : -100 + '%'
					}, 0, function() {
						
					});
					$header.css({
						"visibility": "visible",
						"opacity": 1,
						"top" : "auto",
						// "transform" : "translateY(-100%)",
						// "-webkit-transform" : "translateY(-100%)"
					});
				}
				else {
					$header.insertAfter("#main-slideshow, .photo-scroller").css({
						"visibility": "visible",
						"opacity": 1
					});
				};
			}
			else if (window.innerWidth <= dtLocal.themeSettings.mobileHeader.secondSwitchPoint && !dtGlobals.mobileProcessed) {
				dtGlobals.desktopProcessed = false;
				dtGlobals.mobileProcessed = true;

				$header.insertBefore("#main-slideshow, .photo-scroller").css({
					"visibility": "visible",
					"opacity": 1,
					"transform": "",
					"-webkit-transform" : ""
				});

				if(!$(".mobile-header-space").length > 0){
					$("<div class='mobile-header-space'></div>").insertBefore($header);
					$(".mobile-header-space").css({
						height: $header.height()
					});
				};
			};
		};
	};
	$.headerBelowSlider();


	var stickyMobileHeaderExists = $(".sticky-mobile-header").exists();
	
	$window.scroll(function () {
		if(headerBelowSliderExists && stickyMobileHeaderExists){
			if($body.hasClass("transparent")){
				var fixedHeadMobAfter = dtGlobals.winScrollTop > ($mainSlider.height() - $(".masthead:not(.side-header)").height());
			}else{
				var fixedHeadMobAfter = dtGlobals.winScrollTop > ($mainSlider.height());
			}
			if(fixedHeadMobAfter){
				$body.addClass("fixed-mobile-header");
			}else{
				$body.removeClass("fixed-mobile-header");
			}
		}
	})





/* #Mobile header
================================================== */
// jQuery(document).ready(function($) {
	// function mobileHeader(){
		// var	$mobileNav = $(".main-nav > *").clone();
		// var $document = $(document),
		// 	$window = $(window),
		// 	$html = $("html"),
		// 	$body = $("body"),
		var $mixedHeader = $(".mixed-header"),
			$mobileWidgets = $(".masthead:not(.side-header) .header-bar .mini-widgets > * ").clone(true),
			$mobileSideWidgets = $(".side-header .header-bar .mini-widgets ").clone(true),
			$mobileWidgetsInMenu = $(".masthead .in-menu-on-mobile").clone(true),
			$mobileWidgetsNearLogo = $(".masthead .near-logo-on-mobile ").clone(true).addClass("show-on-second-switch");

		if($mixedHeader.length > 0){
			var $mobileLogo = $mixedHeader.find(".branding > a, .branding > img").clone(true),
				$activeHeader = $mixedHeader
		}else{
			var $mobileLogo = $(".masthead:not(.mixed-header)").find(".branding > a, .branding > img").clone(true),
				$activeHeader = $(".masthead");
		}

		/*Append mobile header-bar to masthead*/
		$("<div class='mobile-header-bar'><div class='mobile-navigation'></div><div class='mobile-mini-widgets'></div><div class='mobile-branding'></div></div>").appendTo(".masthead");
		/*Mobile menu toggle icon*/
		$(".mobile-header-bar .mobile-navigation").append("<a href='#' class='dt-mobile-menu-icon'><span class='lines'></span></a>");
		/*Append mini widgets to mobile header-bar*/
		$(".mobile-header-bar .mobile-mini-widgets").append($mobileWidgets);
		/*Append logo to mobile header-bar*/
		$(".mobile-header-bar .mobile-branding").append($mobileLogo);

		var $mobileMenu = $(".dt-mobile-header");
		if($mobileMenu.siblings().hasClass("dt-parent-menu-clickable")){
			$mobileMenu.addClass("dt-parent-menu-clickable");
		}

		/*Mobile widgets*/
		$($mobileWidgetsInMenu).appendTo(".mobile-mini-widgets-in-menu");
		$($mobileWidgetsNearLogo).appendTo(".mobile-mini-widgets");
		$mobileMenu.append($mobileSideWidgets);
		

		/*Remove mega menu settings from mobile*/
		$(".mobile-main-nav ").find("li").each(function(){
			var $this = $(this),
				$this_sub = $this.find(" > .dt-mega-menu-wrap > .sub-nav");
			if($this.hasClass("new-column")){
				var $thisPrev = $this.prev().find(" > .sub-nav");
				$(" > .sub-nav > *", $this).appendTo($thisPrev)
			}
			$this_sub.unwrap();		
		}).removeClass('dt-mega-menu dt-mega-parent hide-mega-title').find(" > .sub-nav").removeClass("hover-style-click-bg hover-style-bg");


		/*!-Show Hide mobile header*/
		if($mobileMenu.length > 0 ) {
			dtGlobals.mobileMenuPoint = 50;
			var $menu = $(".dt-mobile-header"),
				$Mobilehamburger = $(".dt-mobile-menu-icon");


			/*Mobile floating menu toggle*/
			if(!$(".floating-btn").length > 0 && $(".floating-mobile-menu-icon").length > 0){
				var $hamburgerFloat = $Mobilehamburger.first().clone(true);
				$hamburgerFloat.insertBefore($Mobilehamburger).addClass("floating-btn");
			}
			var $floatMobBtn = $(".floating-btn");

			$window.scroll(function () {
				dtGlobals.mobileMenuPoint = $activeHeader.offset().top + $activeHeader.height() + 50;

				if(dtGlobals.winScrollTop > dtGlobals.mobileMenuPoint){
					//console.log("show float")
					$floatMobBtn.parents(".masthead").addClass("show-floating-icon");
				}
				else {
					$floatMobBtn.parents(".masthead").removeClass("show-floating-icon");
				}
			});
			var $Mobilehamburger = $(".dt-mobile-menu-icon");

			/*Append overlay for mobile menu*/
			if(!$(".mobile-sticky-header-overlay").length > 0){
				$body.append('<div class="mobile-sticky-header-overlay"></div>');
			}
					
			 var $mobileOverlay = $(".mobile-sticky-header-overlay");

			/*Click on mobile menu toggle*/
			$Mobilehamburger.on("click", function (e){
				e.preventDefault();
				
				var $this = $(this);
				
				if ($this.hasClass("active")){
					$this.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-mobile-overlay-header").addClass("closed-overlay-mobile-header");
					$this.parents("body").removeClass("show-sticky-mobile-header");
					$mobileOverlay.removeClass("active");
				}else{
					$Mobilehamburger.removeClass("active");
					$this.addClass('active');
					$page.addClass("show-mobile-header").removeClass("closed-mobile-header");
					$body.removeClass("closed-overlay-mobile-header").addClass("show-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					$this.parents("body").addClass("show-sticky-mobile-header");
					
					$mobileOverlay.addClass("active");
				};

			
			});
			$mobileOverlay.on("click", function (){
				if($(this).hasClass("active")){
					$Mobilehamburger.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-sticky-mobile-header").removeClass("show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					
				}
			});
			$(".dt-close-mobile-menu-icon span").on("click", function (){
				
				$page.removeClass("show-mobile-header");
				$page.addClass("closed-mobile-header");
				$body.removeClass("show-sticky-mobile-header");
				$body.removeClass("show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
				$mobileOverlay.removeClass("active");
				$Mobilehamburger.removeClass("active");
								
			});
			$(".dt-mobile-header").wrapInner("<div class='mobile-header-scrollbar-wrap'></div>");
			if(!dtGlobals.isMobile){
				$(".mobile-header-scrollbar-wrap").mCustomScrollbar({
					scrollInertia:150
				});
			}
		};

		$.mobileHeader = function() {
			if($(".sticky-mobile-header ").length > 0){
				if($(".mixed-header").length > 0){
					var headerH = $(".mixed-header").height();
				}else{
					var headerH = $(".masthead").height();
				}
				var stickyMobileHeader = $('.masthead').first();
				if(!$(".mobile-header-space").length > 0 && !$(".floating-navigation-below-slider").length > 0){
					$("<div class='mobile-header-space'></div>").insertBefore(stickyMobileHeader);
				}
				$(".mobile-header-space").css({
					height: headerH
				});
			}
		}
		$.mobileHeader();
	
// })


/* #Main menu
================================================== */
// jQuery(document).ready(function($) {
	/* We need to fine-tune timings and do something about the usage of jQuery "animate" function */ 
	//$("#mobile-menu").wrap("<div id='dl-menu' class='dl-menuwrapper wf-mobile-visible' />");
	$(".l-to-r-line > li:not(.menu-item-language) > a > span").not(".l-to-r-line > li > a > span.mega-icon").append("<i class='underline'></i>");
	$(".btn-material .dt-btn, .btn-material a.button, .masthead:not(.sub-downwards) .animate-click-decoration > .menu-item > a:not(.not-clickable-item), .masthead:not(.sub-downwards) .main-nav .hover-style-click-bg > li > a:not(.not-clickable-item)").each(function(){
		var $this = $(this),
			rippleTimer;
		$this.addClass("ripple");
		$this.ripple();
		var $thisRipple = $(".rippleWrap", $this)
		$this
		.on("click", function(e){
			if(!$thisRipple.parent('a[href^="#"]').length > 0){
				e.preventDefault();
			}
		})
		.on("mousedown", function(e){
			//clearTimeout( rippleTimer );
			if (e.which == 3) {
			}else{
				e.preventDefault();
				var $thisTarget = $this.attr("target") ? $this.attr("target") : "_self";
				clearTimeout( rippleTimer );
          	 	rippleTimer = setTimeout( function() {
				//$(".rippleWrap", $this).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
					if(!$thisRipple.parent('a[href^="#"]').length > 0){
						
						window.open($this.attr("href"), $thisTarget);
						return false;
					}else{
						$(this).parent("a").trigger("click");
						return false;
					}
				//});
          	 	}, 200)
			}
			
		});
	});
	$(".not-clickable-item").on("click", function(e){
		e.preventDefault();
		e.stopPropagation();
	})

	if($(".active-line-decoration").length > 0 || $(".hover-line-decoration").length > 0){
		$(".main-nav > .menu-item > a").append("<span class='decoration-line'></span>");
	};


	var $mainNav = $(".main-nav, .mini-nav"),
		$mainMenu = $(".masthead:not(.sub-downwards) .main-nav, .mini-nav"),
		$mainNavMob = $(".main-nav"),
		isDemo = $(".demo-panel").exists();

	if (isDemo) {
		$mainNav.find(".page-item-112").removeClass("has-children").find("> .sub-nav").remove();
		$mainNav.find(".page-item-112 > ").attr("onclick", "");
		$mainNav.find(".page-item-112 > a").css("cursor", "pointer").click(function(e) {

			e.preventDefault();
			window.location.href = $(this).attr("href");
		})
	}
	/*Wpml menu item*/
	$(".menu-item-language").each(function(){
		var $this = $(this);
		if($this.children('.submenu-languages').length > 0){
			$this.addClass("has-children");
		}
	});
	$(".act", $mainNav).parents("li").addClass("act");

	var	$mobileNav = $mainNavMob.clone();
	var	$mobileTopNav = $(".mini-nav").clone();
	

	$(".mini-nav select").change(function() {
		window.location.href = $(this).val();
	});

	dtGlobals.isHovering = false;
	$(".side-header .main-nav li").each(function(){
		var $this = $(this);
		if($this.hasClass("new-column")){
			var $thisPrev = $this.prev().find(" > .sub-nav");
			$(" > .sub-nav > *", $this).appendTo($thisPrev)
		}
	})
	$(".sub-downwards .main-nav > li").each(function(){
		var $this = $(this),
			$this_sub = $this.find(" > .dt-mega-menu-wrap > .sub-nav");
			$this_sub.unwrap();
	})

	/*Sub menu first level*/
	$("> li.has-children ", $mainMenu).each(function() {
		var $this = $(this);

		if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
			$this.find("> a").on("click", function(e) {
				if (!$(this).hasClass("dt-clicked")) {
					e.preventDefault();
					$mainNav.find(".dt-clicked").removeClass("dt-clicked");
					$(this).addClass("dt-clicked");
				} else {
					e.stopPropagation();
				}
			});
		};
		var menuTimeoutShow,
			menuTimeoutHide;

		/*Mega sub menu*/
		if($this.hasClass("dt-mega-menu")){
			$this.find("> a").on("mouseenter tap", function(e) {
				if(e.type == "tap") e.stopPropagation();

				var $this = $(this).parent(),
					$this_of_l = $this.offset().left,
					$this_a = $this.find("> a").offset().left;
				$this.addClass("dt-hovered");
				$this.addClass("show-mega-menu");
				dtGlobals.isHovering = true;	
				if($(".masthead").hasClass("sub-downwards")){
					var subMenu = $this.find("  > .sub-nav");
				}else{
					var subMenu = $this.find("  > .dt-mega-menu-wrap");
				}		


				if ($window.height() - (subMenu.offset().top - dtGlobals.winScrollTop) - subMenu.innerHeight() < 0) {
					subMenu.addClass("bottom-overflow");
				};
				if(!$(".side-header").length > 0){
					subMenu.css({
						left: $this_a - $this_of_l
					});
				}
				/*Mega menu */
				if($this.hasClass("mega-auto-width")){
					var //$_this = $(this),
						$_this_par_width = $this.parent().width(),
						$_this_par_of_l = $this.parents(".masthead").offset().left,
						$_this_of_l = $this.offset().left;
						$_this_parents_ofs = $this.offset().left - $this.parents(".masthead").offset().left;
					if(!$(".side-header").length){
						var $pageW = $("#page").width();				
						
						if(subMenu.width()  > ($pageW - $this.offset().left)){
							subMenu.css({
								left: -( subMenu.width()  - ($pageW - $this.offset().left) )
							});
						}
						if(subMenu.width() > $pageW){
							if($(".boxed").length > 0){
								subMenu.css({
									width: $this.parents(".masthead").width(),
									left: -($this.position().left)
								});
							}else{
								subMenu.css({
									width: $this.parents(".masthead").width(),
									left: -($_this_of_l - $_this_par_of_l)
								});
							}
						}
					}
				}
				
				/*Mega menu -> full width*/
				if($this.hasClass("mega-full-width")){
						$_this_of_l = $this.offset().left;
					if($this.parents(".header-bar").length > 0){
						var $_this_par_w = $this.parents(".header-bar").innerWidth(),
							$_this_par_of_l = $this.parents(".header-bar").offset().left;
					}else{
						var $_this_par_w = $this.parents(".ph-wrap").innerWidth(),
							$_this_par_of_l = $this.parents(".ph-wrap").offset().left;
						
					}
					if(!$(".side-header").length){
						subMenu.css({
							width: $_this_par_w,
							left: -($_this_of_l - $_this_par_of_l)
						})
					}
				}
				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutShow = setTimeout(function() {
					if($this.hasClass("dt-hovered")){
						subMenu.stop().css("visibility", "visible").animate({
							"opacity": 1
						}, 150);
					}
				}, 100);
			});

			$this.on("mouseleave", function(e) {
				var $this = $(this);		
				//var subMenu = $this.find(" > .sub-nav");
				if($(".masthead").hasClass("sub-downwards")){
					var subMenu = $this.find("  > .sub-nav");
				}else{
					var subMenu = $this.find("  > .dt-mega-menu-wrap");
				}	
				
				$this.removeClass("dt-hovered");

				dtGlobals.isHovering = false;
				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutHide = setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						// if(!$this.parents().hasClass("dt-mega-menu")){
							subMenu.stop().animate({
								"opacity": 0
							}, 150, function() {
								$(this).css("visibility", "hidden");
							});
						// }

						$this.removeClass("show-mega-menu");
						
						setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								subMenu.removeClass("right-overflow");
								subMenu.removeClass("bottom-overflow");
								if($this.hasClass("mega-auto-width")){
									subMenu.css({
										width: "",
										left: ""
									});
								}
							}
						}, 400);
						
					}
				}, 150);

				$this.find("> a").removeClass("dt-clicked");
			});
		
		}else{
			/*standard sub menu first level*/
			$this.find("> a").on("mouseenter tap", function(e) {
				if(e.type == "tap") e.stopPropagation();

				var $this = $(this).parent(),
					$this_of_l = $this.offset().left,
					$this_a = $this.find("> a").offset().left;
				$this.addClass("dt-hovered");
				dtGlobals.isHovering = true;
				var subMenu = $this.find(" > .sub-nav, > .sub-menu");
				/*Right overflow menu*/
				if ($page.width() - (subMenu.offset().left - $page.offset().left) - subMenu.width() < 0) {
					subMenu.addClass("right-overflow");
				}				
				/*Bottom overflow menu*/
				if ($window.height() - (subMenu.offset().top - dtGlobals.winScrollTop) - subMenu.innerHeight() < 0) {
					subMenu.addClass("bottom-overflow");
				};

				if(!$(".side-header").length > 0){
					subMenu.not(".right-overflow").css({
						left: $this_a - $this_of_l
					});
				}
				
				
				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutShow = setTimeout(function() {
					if($this.hasClass("dt-hovered")){
						subMenu.stop().css("visibility", "visible").animate({
							"opacity": 1
						}, 150);
					}
				}, 100);
			});

			$this.on("mouseleave", function(e) {
				var $this = $(this);					
				var subMenu = $this.find(" > .sub-nav, > .sub-menu");
				
				$this.removeClass("dt-hovered");

				dtGlobals.isHovering = false;
				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutHide = setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						subMenu.stop().animate({
							"opacity": 0
						}, 150, function() {
							$(this).css("visibility", "hidden");
						});

						
						setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								subMenu.removeClass("right-overflow");
								subMenu.removeClass("bottom-overflow");
							}
						}, 400);
					}
				}, 150);

				$this.find("> a").removeClass("dt-clicked");
			});
		}

		

	});

	$(".sub-nav .sub-nav", $mainMenu).parent().not(".dt-mega-parent").each(function() {
		var $this = $(this);
		if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
			$this.find("> a").on("click", function(e) {
				if (!$(this).hasClass("dt-clicked")) {
					e.preventDefault();
					$mainNav.find(".dt-clicked").removeClass("dt-clicked");
					$(this).addClass("dt-clicked");
				} else {
					e.stopPropagation();
				}
			});
		};

		var menuTimeoutShow,
			menuTimeoutHide;

		$this.on("mouseenter tap", function(e) {
			if(e.type == "tap") e.stopPropagation();

			var $this = $(this),
				//$this_of_l = $this.offset().left,
				$this_a = $this.find("> a").offset().left;
			$this.addClass("dt-hovered");

			if ($page.width() - ($this.children(".sub-nav").offset().left - $page.offset().left) - $this.find(" > .sub-nav").width() < 0) {
				$this.children(".sub-nav").addClass("right-overflow");
			}

			if ($window.height() - ($this.children(".sub-nav").offset().top - dtGlobals.winScrollTop) - $this.children(".sub-nav").height() < 0) {
				$this.children(".sub-nav").addClass("bottom-overflow");
			};

			dtGlobals.isHovering = true;
			clearTimeout(menuTimeoutShow);
			clearTimeout(menuTimeoutHide);

			menuTimeoutShow = setTimeout(function() {
				if($this.hasClass("dt-hovered")){
					$this.children('.sub-nav').stop().css("visibility", "visible").animate({
						"opacity": 1
					}, 150);
				}
			}, 100);
		});

		$this.on("mouseleave", function(e) {
			var $this = $(this);
			$this.removeClass("dt-hovered");

			dtGlobals.isHovering = false;
			clearTimeout(menuTimeoutShow);
			clearTimeout(menuTimeoutHide);

			menuTimeoutHide = setTimeout(function() {
				if(!$this.hasClass("dt-hovered")){
					if(!$this.parents().hasClass("dt-mega-menu")){
						$this.children(".sub-nav").stop().animate({
							"opacity": 0
						}, 150, function() {
							$(this).css("visibility", "hidden");
						});
					}
					
					setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							$this.children(".sub-nav").removeClass("right-overflow");
							$this.children(".sub-nav").removeClass("bottom-overflow");
						}
					}, 400);
				}
			}, 150);

			$this.find("> a").removeClass("dt-clicked");
		});
	});


		/*Top & bottom bar sub menu*/
		var $miniNav = $(".mini-nav");
		$(".sub-nav", $miniNav).parent().each(function() {
			var $this = $(this);
			if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
				$this.find("> a").on("click", function(e) {
					if (!$(this).hasClass("dt-clicked")) {
						e.preventDefault();
						$mainNav.find(".dt-clicked").removeClass("dt-clicked");
						$(this).addClass("dt-clicked");
					} else {
						e.stopPropagation();
					}
				});
			};

			var menuTimeoutShow,
				menuTimeoutHide;
			$this.on("mouseenter tap", function(e) {
				if(e.type == "tap") e.stopPropagation();

				var $this = $(this),
					$this_of_l = $this.offset().left,
					$this_a = $this.find("> a").offset().left;
				$this.addClass("dt-hovered");

				if ($page.width() - ($this.children(".sub-nav").offset().left - $page.offset().left) - $this.find(" > .sub-nav").width() < 0) {
					$this.children(".sub-nav").addClass("right-overflow");
				}

				if ($window.height() - ($this.children(".sub-nav").offset().top - dtGlobals.winScrollTop) - $this.children(".sub-nav").height() < 0) {
					$this.children(".sub-nav").addClass("bottom-overflow");
				};
	
				dtGlobals.isHovering = true;
				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutShow = setTimeout(function() {
					if($this.hasClass("dt-hovered")){
						$this.children('.sub-nav').stop().css("visibility", "visible").animate({
							"opacity": 1
						}, 150);
					}
				}, 100);
			});

			$this.on("mouseleave", function(e) {
				var $this = $(this);
				$this.removeClass("dt-hovered");

				dtGlobals.isHovering = false;
				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutHide = setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						if(!$this.parents().hasClass("dt-mega-menu")){
							$this.children(".sub-nav").stop().animate({
								"opacity": 0
							}, 150, function() {
								$(this).css("visibility", "hidden");
							});
						}
						
						setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								$this.children(".sub-nav").removeClass("right-overflow");
								$this.children(".sub-nav").removeClass("bottom-overflow");
							}
						}, 400);
					}
				}, 150);

				$this.find("> a").removeClass("dt-clicked");
			});
		});
	
// })


/* #Custom menu
================================================== */
// jQuery(document).ready(function($) {
	var customTimeoutShow;

	if($(".dt-parent-menu-clickable").length > 0){

		var item = $('.main-nav li.has-children > a, .mobile-main-nav li.has-children > a');
		$("<i class='next-level-button'></i>").insertAfter(item);

		$(".sub-downwards .main-nav li.has-children, .mobile-main-nav li.has-children").each(function(){
			var $this = $(this);
			// if($this.hasClass("dt-mega-menu")){
			// 	var subMenu = $this.find(" > .sub-nav, .sub-menu");
			// }else{
				var subMenu = $this.find(" > .sub-nav, .sub-menu");
		//	}
			if($this.find(".sub-nav li, .sub-menu li").hasClass("act")){
				$this.addClass('active');
			};

			if($this.find(".sub-nav li.act, .sub-menu li.act").hasClass("act")){
				$this.addClass('open-sub');
				subMenu.stop(true, true).slideDown(100);
			};
			$this.find(" > .next-level-button").on("click", function(e){
				var $this = $(this).parent();
				if ($this.hasClass("active")){
					subMenu.stop(true, true).slideUp(500);
					$this.removeClass("active");
					$this.removeClass('open-sub');
				}else{
					$this.siblings().find(" .sub-nav, .dt-mega-menu-wrap, .sub-menu").stop(true, true).slideUp(400);
					subMenu.stop(true, true).slideDown(500);
					$this.siblings().removeClass("active");
					$this.addClass('active');
					$this.siblings().removeClass('open-sub');
					$this.addClass('open-sub');
				};

				//$(".header-bar").mCustomScrollbar("update");
			})
		});

	}else{
		$(".sub-downwards .main-nav li > a, .mobile-main-nav li.has-children > a").each(function(){
			var $this = $(this);
			if($this.parent("li").find(".sub-nav li, .sub-menu li").hasClass("act")){
				$this.addClass('act');
			};
			if($this.parent("li").find(".sub-nav li.act, .sub-menu li.act").hasClass("act")){
				$this.parent("li").addClass('open-sub');
				$this.next().stop(true, true).slideDown(100);
			};
			$this.on("click", function(e){
				$menuItem = $this.parent();
				if ($menuItem.hasClass("has-children menu-item-language")) e.preventDefault();
				
				if ($this.hasClass("act")){
					$this.next().stop(true, true).slideUp(500);
					$this.removeClass("act");
					$this.parent("li").removeClass('open-sub');
				}else{
					$this.parent().siblings().find(".sub-nav, .dt-mega-menu-wrap, .sub-menu").stop(true, true).slideUp(400);
					$this.next().stop(true, true).slideDown(500);
					$this.parent().siblings().find("> a").removeClass("act");
					$this.addClass('act');
					$this.parent("li").siblings().removeClass('open-sub');
					$this.parent("li").addClass('open-sub');
				};
				$(".header-bar").mCustomScrollbar("update");
			});
		});

	};


	$(".custom-nav > li > a").click(function(e){
		$menuItem = $(this).parent();
		if ($menuItem.hasClass("has-children")) e.preventDefault();
		
		
			if ($(this).attr("class") != "active"){
					$(".custom-nav > li > ul").stop(true, true).slideUp(400);
					$(this).next().stop(true, true).slideDown(500);
					$(".custom-nav > li > a").removeClass("active");
					$(this).addClass('active');
			}else{
					$(this).next().stop(true, true).slideUp(500);
					$(this).removeClass("active");
			}

			$menuItem.siblings().removeClass("act");
			$menuItem.addClass("act");
	});

	$(".custom-nav > li > ul").each(function(){
		clearTimeout(customTimeoutShow);
		$this = $(this);
		$thisChildren = $this.find("li");
		if($thisChildren.hasClass("act")){
			$this.prev().addClass("active");
			$this.parent().siblings().removeClass("act");
			$this.parent().addClass("act");
			$(this).slideDown(500);
		}
	});
// })


/* #Floating menu
================================================== */
// jQuery(document).ready(function($) {
	
	/*--Set variable for floating menu*/
	if (dtGlobals.isMobile && !dtGlobals.isiPad) smartMenu = false;
	
	// var $body = $("body"),
	// 	$html  = $("html"),
	var bodyTransparent = $body.hasClass("transparent"),
		phantomStickyExists = $(".phantom-sticky").exists(),
		sideHeaderExists = $(".side-header").exists(),
		sideHeaderHStrokeExists = $(".side-header-h-stroke").exists(),
		floatingNavigationBelowSliderExists = $(".floating-navigation-below-slider").exists();


	/* Floating navigation -> Style -> Sticky */

	if(dtLocal.themeSettings.floatingHeader.showMenu) {
		if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists)){


			var $topBar = $(".top-bar"),
				topBarH = 0,
				stickyHeaderH = $(".masthead").height(),
				logoURL = $(".masthead:not(.side-header) .branding a").attr("href"),
				$stickyHeader = $(".masthead:not(.side-header)"),
				$stickyMenu = $stickyHeader.find(".header-bar"),
				$stickyLogo = $stickyHeader.find(".branding"),
				$topLine = $(".side-header-h-stroke"),
				topLineExists = $topLine.exists(),
				$headerSpace = $(".header-space"),
				$mainSlideshow = $("#main-slideshow, .photo-scroller"),
				$classHeaderExists = $(".classic-header").length > 0;
			if(!floatingNavigationBelowSliderExists) {
				if(!$classHeaderExists){
					$("<div class='animate-sticky'></div>").prependTo($stickyMenu);
				}
			}
			var $animatedLine = $(".animate-sticky");

			if (topLineExists) {
				// No real header - only a top line
				stickyHeaderH = $topLine.height(),
				$stickyHeader = $topLine;
			}

			// Append empty div for fixed header
			if (!$headerSpace.exists()) {
				$("<div class='header-space'></div>").insertBefore($stickyHeader);
				$headerSpace = $(".header-space");
			};

			if (topLineExists) {
				$headerSpace.addClass("top-line-space");
			};

			$headerSpace.css({
				height: stickyHeaderH
			});
			$animatedLine.css({
				height: $stickyMenu.height()
			});

			$body.addClass('sticky-off fixed-masthead');

			// Logo for sticky floating
			if(!$(".sticky-logo").length > 0) {
				if (dtGlobals.logoURL && dtGlobals.logoEnabled) {
					if (logoURL == undefined) {
						$('<img class="sticky-logo" src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'">').prependTo($stickyLogo);
					}
					else {
						$('<a class="sticky-logo" href="'+logoURL+'"><img src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'"></a>').prependTo($stickyLogo);
					};
				};
			};
			var $stickyLogo = $(".phantom-custom-logo-on .sticky-logo"),
				$logo = $(".phantom-custom-logo-on").find(".branding > a:not(.sticky-logo), .branding > img:not(.sticky-logo)", $stickyHeader);


			var phantomAnimate = false,
				adminBarExists = $(".admin-bar").exists();

			if (adminBarExists) {
				var adminBarH = 32;
			}
			else {
				var adminBarH = 0;
			};

			if ($topBar.exists() && !$topBar.is( ":hidden" ) && !floatingNavigationBelowSliderExists) {
				topBarH = $topBar.innerHeight();
			};

			var stickyHeaderStartHeight = $stickyHeader.height();

			$window.on("scroll", function() {

				/*When sticky navigation should be shown*/
				var posScrollTop = dtGlobals.winScrollTop, //window scroll top position
					sliderH,
					showFloatingAfter;

				if (floatingNavigationBelowSliderExists && !bodyTransparent) {
					sliderH = $mainSlideshow.height();
					showFloatingAfter = posScrollTop > sliderH;
				}
				else if (floatingNavigationBelowSliderExists && bodyTransparent) {
					sliderH = $mainSlideshow.height() - adminBarH - stickyHeaderStartHeight;// + dtLocal.themeSettings.floatingHeader.height;
					showFloatingAfter = posScrollTop > sliderH;
				}
				else {
					showFloatingAfter = posScrollTop > dtLocal.themeSettings.floatingHeader.showAfter;
				};

				if (showFloatingAfter && !phantomAnimate && !dtGlobals.mobileProcessed) {
					phantomAnimate = true;

					if (!floatingNavigationBelowSliderExists) {
						$stickyHeader
							.stop(true, true)
							.velocity({
								translateY : -topBarH,
							}, 300);

						$animatedLine.stop()
							.velocity({
								height : dtLocal.themeSettings.floatingHeader.height,
							}, 300);
						

						if (!bodyTransparent) {	
							$headerSpace.css({
								height: stickyHeaderH// - topBarH
							});
						} 
						else {
							$headerSpace.css({
								display: "none",
							});
						};
					}
					else {
						if (!bodyTransparent) {
							$stickyHeader
								.stop(true, true)
								.velocity({
									translateY : -topBarH,
								}, 300);
							$animatedLine.stop()
								.velocity({
									height : dtLocal.themeSettings.floatingHeader.height,
								}, 300);
	
							$headerSpace.css({
								height: stickyHeaderH// - topBarH
							});
						} 
						else {
							$stickyHeader
							.velocity({
								translateY : ""
							}, 0, function() {
								$stickyHeader.css({
									top: adminBarH,
									"transform": "",
									"-webkit-transform" : "",
								});
							});
							$animatedLine.stop()
								.velocity({
									height : dtLocal.themeSettings.floatingHeader.height,
								}, 300);
							$headerSpace.css({
								display: "none",
							});
						};
					}
					$body.removeClass('sticky-off').addClass('sticky-on');
				}
				else if (!showFloatingAfter && phantomAnimate && !dtGlobals.mobileProcessed) {
					phantomAnimate = false;

					if (!floatingNavigationBelowSliderExists) {
						console.log("Y: 0")
						$stickyHeader
						//	.stop(true, true)
							.velocity({
								translateY : 0,
							}, 0);
						if(!$html.hasClass("menu-open")){
							$animatedLine.stop()
								.velocity({
									height : stickyHeaderH,
								}, 0);
						}
					
						if (!bodyTransparent) {
							$headerSpace.css({
								height: stickyHeaderH
							});
						}
						else {
							$headerSpace.css({
								display: "none",
							});
						};
					}
					else {
						if (!bodyTransparent) {
							$stickyHeader
								.stop(true, true)
								.velocity({
									translateY : -topBarH,
								}, 0);
							if(!$html.hasClass("menu-open")){
								$animatedLine.stop()
									.velocity({
										height : stickyHeaderH,
									}, 0);
							}
														
							$headerSpace.css({
								height: stickyHeaderH// - topBarH
							});
						} 
						else {

							if(!$html.hasClass("menu-open")){		
								$stickyHeader
									.css({
										bottom : "auto",
										top: "auto",
										"transform": "translateY(-100%)",
										"-webkit-transform" : "translateY(-100%)",
									});
								$headerSpace.css({
									display: "none",
								});

							}
						};
					};
					if(!$html.hasClass("menu-open")){									
						$body.removeClass('sticky-on').addClass('sticky-off');
						$animatedLine.stop()
							.velocity({
								height : $stickyMenu.height(),
							}, 0);
					}
				}
				else if (dtGlobals.mobileProcessed) {
					$stickyHeader
						.css({
							bottom : "auto",
							top: "auto",
							"transform": "",
							"-webkit-transform" : "",
						});
					$headerSpace.css({
						display: "none",
					});
					$body.removeClass('sticky-on').addClass('sticky-off');
				};
			});

		};
	};


	/* Floating navigation -> Style -> fade, Slide */

	if(dtLocal.themeSettings.floatingHeader.showMenu) {

		if ((smartMenu && !(sideHeaderExists && !phantomStickyExists)) || (smartMenu && (sideHeaderHStrokeExists && !phantomStickyExists ))) {

			var phantomFadeExists = $(".phantom-fade").exists(),
				phantomSlideExists = $(".phantom-slide").exists(),
				splitHeaderExists = $(".split-header").exists(),
				$mainSlideshow = $("#main-slideshow, .photo-scroller"),
				$mainHeader = $(".masthead:not(.side-header)");

			if( phantomFadeExists || phantomSlideExists) {

				var $headerMenu = $(".masthead:not(#phantom) .main-nav"),
					logoURL = $(".masthead:not(.side-header) .branding a").attr("href"),
					isMoved = false;

				if (sideHeaderHStrokeExists) {
					var $headerTopLine = $(".side-header-h-stroke"),
						headerClass = $headerTopLine.attr("class"),
						$headerMenu = $(".side-header-h-stroke .header-bar"),
						$parent = $headerMenu.parent(),
						$phantom = $('<div id="phantom" class="'+headerClass+'"><div class="ph-wrap"></div></div>').appendTo("body"),
						$menuBox = $phantom.find(".ph-wrap"),
						$widgetBox = $phantom.find(".widget-box"),
						$widget = $(".side-header-h-stroke .header-bar .mini-widgets"),
						$phantomLogo = $headerTopLine.find(".branding");

					/*Phantom logo*/
					if($(".phantom-custom-logo-on").length > 0){
						if (dtGlobals.logoURL && dtGlobals.logoEnabled) {
							if (logoURL == undefined){
								$('<img class="phantom-top-line-logo" src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'">').prependTo($phantomLogo);
							}
							else {
								$('<a class="phantom-top-line-logo" href="'+logoURL+'"><img src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'"></a>').prependTo($phantomLogo);
							};
						};
					};
				}
				else {
					var headerClass = $(".masthead").attr("class"),
						$parent = $headerMenu.parent(),
						$phantom = $('<div id="phantom" class="'+headerClass+'"><div class="ph-wrap"><div class="logo-box"></div><div class="menu-box"></div><div class="widget-box"></div></div></div>').appendTo("body"),
						$menuBox = $phantom.find(".menu-box"),
						$widgetBox = $phantom.find(".widget-box");

					if ($(".classic-header").length > 0) {
						var $widget = $(".header-bar .navigation .mini-widgets");
					}
					else if (splitHeaderExists) {
						var headerNavigation = $(".header-bar .navigation"),
							$widget = headerNavigation.first().find(".mini-widgets"),
							$headerMenu = headerNavigation.first().find(".main-nav"),
							$widgetRight = headerNavigation.last().find(".mini-widgets > *"),
							$headerRight = headerNavigation.last().find(".main-nav > *"),
							$parent = headerNavigation.first(),
							$parentMenuRight = headerNavigation.last().find(".main-nav"),
							$parentWidgetRight = headerNavigation.last().find(".mini-widgets");
					}
					else {
						var $widget = $(".header-bar .mini-widgets");
					};

					/*Phantom logo*/
					if (dtGlobals.logoURL && dtGlobals.logoEnabled) {
						$phantom.find(".ph-wrap").addClass("with-logo");

						if(logoURL == undefined){
							$phantom.find(".logo-box").html('<img src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'">');
						}
						else {
							$phantom.find(".logo-box").html('<a href="'+logoURL+'"><img src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'"></a>');
						};
					};
				};
				
				if ($page.hasClass("boxed")) {
					$phantom.addClass("boxed").velocity({ translateX : "-50%" }, 0).find(".ph-wrap").addClass("boxed");
				}

				/* Hide floating on load */
				$body.removeClass('phantom-on').addClass('phantom-off');


				var phantomAnimate = false;

				var phantomTimeoutShow,
					phantomTimeoutHide;	

				if (phantomSlideExists) {
					$phantom.velocity({
						translateY : -$phantom.height(),
					}, 0);
				};

				$window.on("scroll", function() {
					
					var tempScrTop = dtGlobals.winScrollTop,
						sliderH = $mainSlideshow.height(),
						headerH = $mainHeader.height();

					if (floatingNavigationBelowSliderExists && bodyTransparent) {
						var showFloatingAfter = tempScrTop > sliderH && isMoved === false,
							hideFloatingAfter = tempScrTop <= sliderH && isMoved === true;

					}
					else if (floatingNavigationBelowSliderExists) {
						var showFloatingAfter = tempScrTop > (sliderH + headerH) && isMoved === false,
							hideFloatingAfter = tempScrTop <= (sliderH + headerH) && isMoved === true;
					}
					else {
						var showFloatingAfter = tempScrTop > dtLocal.themeSettings.floatingHeader.showAfter && isMoved === false,
							hideFloatingAfter = tempScrTop <= dtLocal.themeSettings.floatingHeader.showAfter && isMoved === true;
					};

					if (showFloatingAfter) {
						// clearTimeout(phantomTimeoutShow);
						// clearTimeout(phantomTimeoutHide);

						// phantomTimeoutShow = setTimeout(function() {
						if(!$html.hasClass("menu-open")){	

							if( !dtGlobals.isHovering && !phantomAnimate ) {
								phantomAnimate = true;

								if (sideHeaderHStrokeExists) {
									$headerMenu.appendTo($menuBox);
								}
								else {
									if (splitHeaderExists) {
										$headerMenu.appendTo($menuBox);
										$widget.appendTo($widgetBox);
										$menuBox.find(".main-nav").append($headerRight);
										$widgetBox.find(".mini-widgets").append($widgetRight);
									}
									else {
										$headerMenu.appendTo($menuBox);
										$widget.appendTo($widgetBox);
									};
								};

								if (phantomFadeExists) {
									$phantom
									.stop()
									.css({
										"visibility" : "visible"
									})
									.velocity({
										"opacity" : 1
									}, 350);
								}
								else if (phantomSlideExists) {
									$phantom
									.stop(true, true)
									.css({
										"visibility" : "visible"
									})
									// .velocity("stop")
									.velocity({
										translateY : 0,
										opacity : 1
									}, {
										duration: 400,
										//delay: 100
									});
								};

								$body.removeClass('phantom-off').addClass('phantom-on');

								isMoved = true;
							};
						// }, 100);
						}


					}
					else if (hideFloatingAfter) {

						if(phantomAnimate) {
							// clearTimeout(phantomTimeoutShow);
							// clearTimeout(phantomTimeoutHide);

							// phantomTimeoutHide = setTimeout(function() {
							if(!$html.hasClass("menu-open")){	
								phantomAnimate = false;

								if(sideHeaderHStrokeExists) {
									$headerMenu.appendTo($parent);
								}
								else {
									if (splitHeaderExists) {
										$headerMenu.appendTo($parent);
										$widget.appendTo($parent);
										$headerRight.appendTo($parentMenuRight);
										$widgetRight.appendTo($parentWidgetRight);
									}
									else {
										$headerMenu.appendTo($parent);
										$widget.appendTo($parent);
									};
								};

								$body.removeClass('phantom-on').addClass('phantom-off');


								if (phantomFadeExists) {
									$phantom.stop().velocity({
										"opacity" : 0
									}, 120, function() {
										$phantom.css({
											"visibility": ""
										});
									});
								}
								else if (phantomSlideExists) {
									$phantom.velocity({
										opacity : 0
									}, 0, function() {
										$phantom
									//.stop(true, true)
											.css({
												"visibility": ""
											})
											.velocity({
												translateY : -$phantom.height(),
											}, 0);
									});
									// $phantom.css({
									// 	"opacity" : 0,
									// 	"visibility": "",
									// 	"transform": "translateY (" + "-"+ $phantom.height() + "px)",
									// 	"-webkit-transform ": "translateY ("  + "-"+$phantom.height() + "px)"
										
									// })
								}
				
								isMoved = false;
							// }, 100);
							}
						}

					};
					
				});
			};
		};
	};

// });


/* #Filter
================================================== */
// jQuery(document).ready(function($) {

	/*!-categories filter*/
	$(".filter-categories > a").on("click", function(e) {
		var $this = $(this);
		
		if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
			var $filter = $this.parents(".filter").first();

			if ( $filter.hasClass("without-isotope") ) {
				arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
			} else {
				arguments.callee.dtPreventD = true;
			};
		};

		e.preventDefault();

		$this.trigger("mouseleave");
		
		if ($this.hasClass("act") && !$this.hasClass("show-all")) {
			e.stopImmediatePropagation();
			$this.removeClass("act");
			$this.siblings("a.show-all").trigger("click");//.addClass("act");
		} else {
			$this.siblings().removeClass("act");
			$this.addClass("act");

			if ( !arguments.callee.dtPreventD ) {
				window.location.href = $this.attr("href");
			}
		};
	});

	/*!- ordering*/
	$(".filter-extras .filter-switch").each(function(){
		var $_this = $(this);
		if($_this.prev('.act').length > 0){
			$_this.addClass('left-act');
		}else if($_this.next('.act').length > 0){
			$_this.addClass('right-act');
		}else{
			$_this.removeClass('right-act');
			$_this.removeClass('left-act');
		};
	});

	$(".filter-extras a").on("click", function(e) {
		var $this = $(this);
		
		if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
			var $filter = $this.parents(".filter").first();

			if ( $filter.hasClass("without-isotope") ) {
				arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
			} else {
				arguments.callee.dtPreventD = true;
			}
		};

		if ( arguments.callee.dtPreventD ) {
			e.preventDefault();
		};

		$this.siblings().removeClass("act");
		$this.addClass("act");

		$(".filter-extras .filter-switch").each(function(){
			var $_this = $(this);
			if($_this.prev($this).hasClass('act')){
				$_this.addClass('left-act');
				$_this.removeClass('right-act');
			}else if($_this.next($this).hasClass('act')){
				$_this.addClass('right-act');
				$_this.removeClass('left-act');
			}else{
				$_this.removeClass('right-act');
				$_this.removeClass('left-act');
			};
		});
	});

	$(".filter-extras .filter-switch").each(function(){
		var $this = $(this);
		var $filter = $this.parents(".filter").first();
		$this.on("click", function(){
			if ( $filter.hasClass("without-isotope") ) {
				if($this.hasClass("right-act")){
					$this.prev("a")[0].click();
				}else if ($this.hasClass("left-act")){
					
					$this.next("a")[0].click();
				};
			}else{
				if($this.hasClass("right-act")){
					$this.prev("a").trigger("click");
				}else if ($this.hasClass("left-act")){
					$this.next("a").trigger("click");
				};
			};
		});
	});


	/*!Change filter appearance when too much categories*/
	// $.fn.changeFilter = function() {
	// 	return this.each(function() {

	// 		var width = 0;
	// 		var $_this = $(this),
	// 			$this_par = $_this.parents(".filter-categories");
	// 		if($(".filter-style-ios").length > 0){
	// 			width += ($_this.innerWidth()-1);
	// 		}else{
	// 			width += $_this.innerWidth();
	// 		}
	// 		if( width > $(this).width() ){
	// 			$this_par.addClass("new-style")
	// 		}else{
	// 			$this_par.removeClass("new-style")
	// 		}
	// 	});
	// };

	// $(".filter-categories a").changeFilter();

// });


/* #One-page
================================================== */



// jQuery(document).ready(function($) {
	var $moveBody = $("html");

	/*Detect floating header*/
	if($(".phantom-sticky").length > 0){
		var $phantom = $(".masthead:not(.side-header):not(.side-header-v-stroke)"),
			$phantomVisibility = 1;
	}else{
		var $phantom = $("#phantom"),
			$phantomVisibility = $phantom.css("display")=="block";
	}


	// One page scrolling effect
	var phantomStickyExists = $(".phantom-sticky").exists(),
		sideHeaderExists = $(".side-header").exists(),
		sideHeaderHStrokeExists = $(".side-header-h-stroke").exists(),
		floatMenuH = 0;

	/*Floating header height*/
	function set_sticky_header_height() {
		if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
			if($(".sticky-mobile-header").length > 0){
				floatMenuH = $phantom.height();
			}else{
				floatMenuH = 0;
			}
		}else{
			if($phantom.css("display")=="block" || (phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists)){			
				floatMenuH = $phantom.height();
			}else{
				floatMenuH = 0;
			}
		}
	}
	set_sticky_header_height();

	/*Set cuurent item on load*/
	jQuery(window).load(function(){
		var urlHash = window.location.hash.substring(3);
		if( typeof urlHash != 'undefined' && urlHash.length > 0 ) {
			if(urlHash == "up") {
				$moveBody.stop().velocity("scroll", { 
					offset: 0,
					duration: 600,
					mobileHA: false,
					complete: function(elements) { $.closeSideHeader(); }
				});

			}else{
				setTimeout(function(){
					$moveBody.stop().velocity("scroll", { 
						offset: $("#" + urlHash).offset().top - floatMenuH,
						duration: 600,
						mobileHA: false,
						complete: function(elements) { 
						//	$.closeSideHeader();

							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
								
									$moveBody.stop().velocity("scroll", { 
										offset: $("#" + urlHash).offset().top - $phantom.height(),
										duration: 650,
										mobileHA: false 
									});
								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
								
									$moveBody.stop().velocity("scroll", { 
										offset: $("#" + urlHash).offset().top - $phantom.height(),
										duration: 650,
										mobileHA: false 
									});
								}
							}
						}
					});
				},300)
			}
		}else {
			if(urlHash.length == 0 && $( '.menu-item > a[href="#!/up"]' ).length > 0) {
				$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
			}
		}
	});


	jQuery( window ).on('resize', function() {
		set_sticky_header_height();
	});

	
	var $anchors = $( '.stripe' ),
		$menus = $( '.menu-item > a[href^="#!"]' );

	/*!-scroll to anchor*/
	window.clickAnchorLink = function( $a, e ) {
		var url = $a.attr( 'href' ),
			hash = url,
			$target = url.substring(3),
			base_speed  = 600,
			speed       = base_speed;
		
		set_sticky_header_height();

		if ( typeof $target != 'undefined' && $target && $target.length > 0 ) {
			location.hash = url;
			if($("#" + $target).length > 0) {
				var top = $("#" + $target).offset().top + 1,
					this_offset = $a.offset(),
					that_offset = $("#" + $target).offset(),
					offset_diff = Math.abs(that_offset.top - this_offset.top),
					speed = 3400 * Math.log(offset_diff/8253 + 1.02);

					$newScrollPosition = top - floatMenuH;


					// targetPos = Math.abs( dtGlobals.winScrollTop + that_offset.top - this_offset.top );

				 //    distance = Math.abs( dtGlobals.winScrollTop - targetPos );
				 //    speed = ( distance / 1000 ) * 1000;
			};


			if($target == "up") {
				if($body.hasClass("overlay-navigation")){
					$.closeSideHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH,
						duration: speed,
						mobileHA: false 
					});
				}else{
					$moveBody.stop().velocity("scroll", { 
						offset: 0,
						duration: speed,
						mobileHA: false,
						complete: function(elements) { $.closeSideHeader(); }
					});
				}
			}else {
				if($body.hasClass("overlay-navigation")){
					$.closeSideHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH ,
						duration: speed,
						mobileHA: false,
						complete: function(elements) { 
							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});

								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								
								}
							}
						}
					});
				}else{
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH ,
						duration: speed,
						mobileHA: false,
						complete: function(elements) {
							$.closeSideHeader();

							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								
								}
							}

						
						}
					});
				}
			};

			$('.menu-item a').parent("li").removeClass('act');
			$a.parent("li").addClass('act');
			e.preventDefault();
			return false;
		};

	};

	$body.on( 'click', '.anchor-link[href^="#!"], .logo-box a[href^="#!"], .branding a[href^="#!"], #branding-bottom a[href^="#!"]', function( e ) {
		clickAnchorLink( $( this ), e );
	});

	$menus.on( 'click', function( e ) {
		clickAnchorLink( $( this ), e );
	});

	/*!-set active menu item on scroll*/
	if($('.one-page-row div[data-anchor^="#"]').length > 0 && $(".one-page-row").length > 0){
		$window.scroll(function (e) {
			var currentNode = null;
			if(!$body.hasClass("is-scroll")){
				$('.one-page-row div[data-anchor^="#"]').each(function(){
					var $_this = $(this)
						activeSection = $_this,
						currentId = $_this.attr('data-anchor');
					if(dtGlobals.winScrollTop >= ($(".one-page-row div[data-anchor='" + currentId + "']").offset().top - $phantom.height())){
						currentNode = "#!/" + currentId.substring(1);
					};
				});
				$('.menu-item a[href^="#!"]').parent("li").removeClass('act');
				if(dtGlobals.winScrollTop < ($(".one-page-row div[data-anchor^='#']").first().offset().top - $phantom.height())&& $( '.menu-item > a[href="#!/up"]' ).length > 0) {
					$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
				};
				$('.menu-item a[href="'+currentNode+'"]').parent("li").addClass('act');
				if($('.menu-item a[href="#"]').length && currentNode == null){
					$('.menu-item a[href="#"]').parent("li").addClass('act');
				}
			};
		});
	};
// })


/* #Royal Slider initialisation
================================================== */

// jQuery(document).ready(function($) {

	if ($(".rsHomePorthole").exists()) {
		var portholeSlider = {};
			portholeSlider.container = $("#main-slideshow");
			portholeSlider.width = portholeSlider.container.attr("data-width") ? parseInt(portholeSlider.container.attr("data-width")) : 1280;
			portholeSlider.height = portholeSlider.container.attr("data-height") ? parseInt(portholeSlider.container.attr("data-height")) : 720;
			portholeSlider.autoslide = portholeSlider.container.attr("data-autoslide") && parseInt(portholeSlider.container.attr("data-autoslide")) > 999 ? parseInt(portholeSlider.container.attr("data-autoslide")) : 5000;
			portholeSlider.scale = portholeSlider.container.attr("data-scale") ? portholeSlider.container.attr("data-scale") : "fill";
			portholeSlider.paused = portholeSlider.container.attr("data-paused") ? portholeSlider.container.attr("data-paused") : true;
			portholeSlider.hendheld = $window.width() < 740 && dtGlobals.isMobile ? true : false;
		
		$("#main-slideshow-content").appendTo(portholeSlider.container);

		portholeSlider.api = $(".rsHomePorthole").royalSlider({
			autoScaleSlider: true,
			autoScaleSliderWidth: portholeSlider.width,
			autoScaleSliderHeight: portholeSlider.height,
			autoPlay: {
				enabled: !portholeSlider.hendheld,
				stopAtAction: false,
				pauseOnHover: false,
				delay: portholeSlider.autoslide
			},
			imageScaleMode: portholeSlider.scale,
			imageScalePadding: 0,
			numImagesToPreload: 999,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			loopRewind: true,
			arrowsNav: false,
			globalCaption: true,
			controlNavigation: !portholeSlider.hendheld ? 'porthole' : 'none',
			thumbs: {
				orientation: 'vertical',
				drag: false,
				touch: false,
				spacing: 10,
				firstMargin: false,
				appendSpan: false
			},
			block: {
				fadeEffect: true,
				moveEffect: 'bottom',
				moveOffset: 5
			}
		}).data("royalSlider");
		var $_this = portholeSlider.container,
			$_this_childs = $_this.find(".rsSlide").size();
		if ($_this_childs < 2) {
			$(".rsThumbs", $_this).hide();
			portholeSlider.api._isMove = false;
			$_this.find(".rsOverflow").css("cursor", "auto")
		};

		if (portholeSlider.paused == "true") {
			$(".rsHomePorthole").royalSlider("stopAutoPlay");
		}
	};

	$(".slider-post").each(function(){
		$(this).royalSlider({
			autoScaleSlider: true,
			imageScaleMode: "fit",
			autoScaleSliderWidth: $(this).attr("data-width"),
			autoScaleSliderHeight: $(this).attr("data-height"),
			imageScalePadding: 0,
			numImagesToPreload: 6,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			globalCaption:true
		});
	});

	$(".slider-simple").not(".shortcode-royal-slider").each(function(){
		$(this).royalSlider({
			autoScaleSlider: true,
			imageScaleMode: "fit",
			autoScaleSliderWidth: $(this).attr("data-width"),
			autoScaleSliderHeight: $(this).attr("data-height"),
			imageScalePadding: 0,
			numImagesToPreload: 6,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			globalCaption:true
		});
	});

	$(".shortcode-royal-slider").each(function(){
		var shortcodeSlider = {};
		shortcodeSlider.container = $(this);
		shortcodeSlider.container.paused = shortcodeSlider.container.attr("data-paused") ? shortcodeSlider.container.attr("data-paused") : true;
			shortcodeSlider.container.hendheld = $window.width() < 740 && dtGlobals.isMobile ? true : false;
		$(this).royalSlider({
			autoScaleSlider: true,
			imageScaleMode: "fit",
			autoScaleSliderWidth: $(this).attr("data-width"),
			autoScaleSliderHeight: $(this).attr("data-height"),
			autoPlay: {
				enabled: !shortcodeSlider.container.hendheld,
				stopAtAction: false,
				pauseOnHover: false,
				delay: parseInt( $(this).attr("data-autoslide") )
			},
			imageScalePadding: 0,
			numImagesToPreload: 6,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			globalCaption:true
		});
		if (shortcodeSlider.container.paused == "true") {
			shortcodeSlider.container.royalSlider("stopAutoPlay");
		}
	});

	$(".slider-content .preload-me").loaded(null, function() {
		$(".slider-content").each(function(){
			var $this = $(this),
				autoslide = $this.attr("data-autoslide") && parseInt($this.attr("data-autoslide")) > 999 ? parseInt($this.attr("data-autoslide")) : 5000;		
				hendheld = !($window.width() < 740 && dtGlobals.isMobile) && $this.attr("data-autoslide") ? true : false;

			$this.royalSlider({
				autoPlay: {
					enabled: hendheld,
					stopAtAction: false,
					pauseOnHover: false,
					delay: autoslide
				},
				autoHeight: true,
				controlsInside: false,
				fadeinLoadedSlide: false,
				controlNavigationSpacing: 0,
				controlNavigation: 'bullets',
				imageScaleMode: 'none',
				imageAlignCenter:false,
				loop: false,
				loopRewind: true,
				numImagesToPreload: 6,
				keyboardNavEnabled: true

			}).data("royalSlider");
		});
	}, true);
// })

/* #Images Styling & Hovers
================================================== */
// jQuery(document).ready(function($) {

	/* !Append tag </i> to rolovers*/
	$.fn.addRollover = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			$this.append("<i></i>");
			if($this.find(".rollover-thumbnails").length){
				$this.addClass("rollover-thumbnails-on");
			}
			if($this.parent().find(".links-container").length){
				$this.addClass("rollover-buttons-on");
			}

			$this.addClass("this-ready");
		});
	};
	$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content, .vc-item .vc-inner > a").addRollover();

	/* !- Grayscale */
	$(".filter-grayscale .slider-masonry").on("mouseenter tap", function(e) {
		if(e.type == "tap") {
			e.stopPropagation();
		};
		$(this).addClass("dt-hovered");
	});

	$(".filter-grayscale .slider-masonry").on("mouseleave", function(e) {
		$(this).removeClass("dt-hovered");
	});

	/* !-Blur */
	$window.load(function() {
		if(!dtGlobals.isMobile){
			$.fn.blurImage = function() {
				return this.each(function() {
					var $_this = $(this);

					if ($_this.hasClass("blur-ready")) {
						return;
					}

					var img = $_this.find("> img");

					$_this.addClass('blur-this');
					img.clone().addClass("blur-effect").css('opacity', '').prependTo(this);
							
					var blur_this = $(".blur-effect", this);
						blur_this.each(function(index, element){
							if (img[index].complete == true) {
								Pixastic.process(blur_this[index], "blurfast", {amount:0.3});
							}
							else {
								blur_this.load(function () {
									Pixastic.process(blur_this[index], "blurfast", {amount:0.3});
								});
							}
						});

					$_this.addClass("blur-ready");
				});
			};

			var total_images = $("body img").length;
			var images_loaded = 0;
			$("img").loaded(null, function() {
				$(".image-blur .fs-entry-img:not(.shortcode-instagram .fs-entry-img), .image-blur .shortcode-instagram a, .image-blur .rollover-project a:not(.hover-style-three .rollover-project a), .image-blur .rollover, .image-blur .rollover > div, .image-blur .post-rollover, .image-blur .rollover-video").blurImage();
			}, true);
			
		};
	});


	/* #Hover layouts
	================================================== */

	/*!-Scale in hover*/
	$.fn.scaleInHover = function() {
		return this.each(function() {

			var $this = $(this);
			if ($this.hasClass("scale-ready")) {
				return;
			}
			var $img = $this.find("img.preload-me"),
				imgWidth = parseInt($img.attr('width')),
				imgHeight = parseInt($img.attr('height')),
				imgRatio = imgWidth/imgHeight;
			if(imgRatio < 2 && imgRatio >= 1.5){
				$this.addClass("ratio_3-2");
			}else if(imgRatio < 1.5 && imgRatio >= 1){
				$this.addClass("ratio_4-3");
			}else if(imgRatio < 1 && imgRatio >= 0.75){
				$this.addClass("ratio_3-4");
			}else if(imgRatio < 0.75 && imgRatio >= 0.6){
				$this.addClass("ratio_2-3");
			}else{
				$this.removeClass("ratio_2-3").removeClass("ratio_3-2").removeClass("ratio-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};
			if(imgRatio >= 2){
				$this.addClass("ratio-2");
			};
			if(imgRatio == 1){
				$this.removeClass("ratio_2-3").removeClass("ratio-2").removeClass("ratio_3-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};

			$this.addClass("scale-ready");
		});
	};
	$(".hover-scale .rollover-project").scaleInHover();

	/*!-Hover Direction aware*/
	$('.no-touch .hover-grid .rollover-project').each( function() { $(this).hoverdir(); } );
	$('.no-touch .hover-grid-reverse .rollover-project ').each( function() { $(this).hoverdir({
		inverse : true
	}); } );

	/*!Append tag </span> for round links*/
	$.fn.hoverLinks = function() {
		if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("height-ready")) {
					return;
				}
				$("<span/>").appendTo($(this));

				$img.on({
					mouseenter: function () {
						if (0 === $(this).children("span").length) {
							var a = $("<span/>").appendTo($(this));
							setTimeout(function () {
								a.addClass("icon-hover")
							}, 20)
						} else $(this).children("span").addClass("icon-hover")
					},
					mouseleave: function () {
						$(this).children("span").removeClass("icon-hover")
					}
				});

				$img.addClass("height-ready");
			});
		}
	};
	$(".links-container a").hoverLinks();

	/*!Trigger click single link by click on image */
	$.fn.forwardToPost = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			};
			$this.on("click", function(){
				if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
				window.location.href = $this.find("a").first().attr("href");
				return false;
			});
			$this.addClass("this-ready");
		});
	};
	$(".no-touch .rollover-project.forward-post").forwardToPost();

	$.fn.touchforwardToPost = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("touch-hover-ready")) {
				return;
			}

			$body.on("touchend", function(e) {
				$(".touch .rollover-content").removeClass("is-clicked");
				$(".touch .rollover-project").removeClass("is-clicked");
			});
			var $this = $(this).find(".rollover-content");
			$this.on("touchstart", function(e) { 
				origY = e.originalEvent.touches[0].pageY;
				origX = e.originalEvent.touches[0].pageX;
			});
			$this.on("touchend", function(e) {
				var touchEX = e.originalEvent.changedTouches[0].pageX,
					touchEY = e.originalEvent.changedTouches[0].pageY;
				if( origY == touchEY || origX == touchEX ){
					if ($this.hasClass("is-clicked")) {
							window.location.href = $this.prev("a").first().attr("href");
					} else {
						e.preventDefault();
						$(".touch .rollover-content").removeClass("is-clicked");
						$(".touch .rollover-project").removeClass("is-clicked");
						$this.addClass("is-clicked");
						$this.parent(".rollover-project").addClass("is-clicked");
						return false;
					};
				};
			});

			$this.addClass("touch-hover-ready");
		});
	};
	$(".touch .rollover-project.forward-post").touchforwardToPost();

	/*!Trigger click on round links */
	$.fn.followCurentLink = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			var $thisSingleLink = $this.find(".links-container > a"),
				$thisCategory = $this.find(".portfolio-categories a");
				

			
			$this.on("click", function(){

				$thisSingleLink.each(function(){
					$thisTarget = $(this).attr("target") ? $(this).attr("target") : "_self";
				});

				if($thisSingleLink.hasClass("project-details") || $thisSingleLink.hasClass("link") || $thisSingleLink.hasClass("project-link")){
					window.open($thisSingleLink.attr("href"), $thisTarget);
					return false;

				}else{
					$thisSingleLink.trigger("click");
					return false;
				}
			});

			$this.find($thisCategory).click(function(e) {
				 e.stopPropagation();
				window.location.href = $thisCategory.attr('href');
			});
			$this.addClass("this-ready");
		});
	};
	$(".no-touch .rollover-project.rollover-active, .no-touch .buttons-on-img.rollover-active").followCurentLink();

	/*TOUCH DEVICE*/
	/*!Description on hover show content on click(albums projects touch device)*/

			$.fn.touchNewHover = function() {
				return this.each(function() {
					var $this = $(this);
					if ($this.hasClass("this-ready")) {
						return;
					}

					if( $(".rollover-content", this).length > 0 || $(".woocom-rollover-content", this).length > 0){
						$body.on("touchend", function(e) {
							$(".touch .rollover-content, .touch .rollover-project, .touch .woocom-rollover-content, .touch .woocom-project").removeClass("is-clicked");
						});
						
						$this.on("touchstart", function(e) {
							origY = e.originalEvent.touches[0].pageY;
							origX = e.originalEvent.touches[0].pageX;
						});
						$this.on("touchend", function(e) {
							var touchEX = e.originalEvent.changedTouches[0].pageX,
								touchEY = e.originalEvent.changedTouches[0].pageY;
							if( origY == touchEY || origX == touchEX ){
					
								if ($this.hasClass("is-clicked")) {
									if($this.find(".dt-gallery-container").length > 0){
										$this.find(".rollover-content").on("click.dtAlbums", function(e){
											$this.find(".rollover-content").off("click.dtAlbums");
											$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-single-mfp-popup, .dt-mfp-item").first().trigger('click');
										});
									}
									if($(this).find(".rollover-click-target.go-to").length > 0){
										window.location.href = $(this).find(".rollover-click-target.go-to").attr('href');
									}
								} else {

									$('.links-container > a', $this).on('touchend', function(e) {
										e.stopPropagation();
										$this.addClass("is-clicked");
									});
									e.preventDefault();
									$(".touch .rollover-content, .touch .rollover-project, .touch .woocom-rollover-content, .touch .woocom-project").removeClass("is-clicked");
									$this.addClass("is-clicked");
									$this.find(".rollover-content").addClass("is-clicked");
									$this.find(".woocom-rollover-content").addClass("is-clicked");
									return false;
								};
							};
						});
					};

					$this.addClass("this-ready");
				});
			};
			$(".touch .rollover-project, .touch .woocom-project").touchNewHover();

		/*Description on hover show content on click(albums projects touch device):end*/

		$(".touch .rollover-project a.link.show-content, .hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .touch .cart-btn-on-img .buttons-on-img > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
			e.preventDefault();
		});
		$(".no-touch .albums .rollover-content a:not(.portfolio-categories a), .no-touch .media .rollover-content, .no-touch .dt-gallery-container .rollover-content").on("click", function(e){
			if ( $(e.target).is("a") ) {return true};
			$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
		});

		$.fn.touchHoverImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				$body.on("touchend", function(e) {
					$(".touch .rollover-content").removeClass("is-clicked");
				});
				var $this = $(this).find(".rollover-content"),
					thisPar = $this.parents(".wf-cell");
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
						} else {

							$('.links-container > a', $this).on('touchend', function(e) {
								e.stopPropagation();
								$this.addClass("is-clicked");
							});
							e.preventDefault();
							$(".touch .buttons-on-img .rollover-content").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .buttons-on-img").touchHoverImage();

		$.fn.touchWooHoverImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("woo-ready")) {
					return;
				}

				$body.on("touchend", function(e) {
					$(".touch .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
				});
				var $this = $(this);
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
							if($(e.target).parent().hasClass("woo-buttons")){								
								$(e.target).trigger('click');
							}else{
								window.location.href = $this.find("a").first().attr("href");
							}
						} else {

							// console.log($(e.target))
							e.preventDefault();
							$(".touch .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("woo-ready");
			});
		};
		$(".touch .cart-btn-on-img .buttons-on-img").touchWooHoverImage();

		$.fn.touchScrollerImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				$body.on("touchend", function(e) {
					$(".touch .fs-entry").removeClass("is-clicked");
				});
				var $this = $(this),
					$thisSingleLink = $this.find("a.rollover-click-target").first(),
					$thisButtonLink = $this.find(".links-container");
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
								
						} else {
							if($thisSingleLink.length > 0){
								$thisSingleLink.on("click", function(event) {
									event.stopPropagation();

									if ( $(this).hasClass('go-to') ) {
										window.location.href = $(this).attr('href');
									}
								});
								$thisSingleLink.trigger("click");
							};
							if($thisButtonLink.length > 0){
								$thisButtonLink.find(" > a ").each(function(){
									$(this).on("touchend", function(event) {
										event.stopPropagation();
										$(this).trigger("click");
									});
								});
							}
							e.preventDefault();
							$(".touch .fs-entry").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .fs-entry").touchScrollerImage();

		$.fn.touchHoverLinks = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				var $this = $(this);
				$this.on("touchend", function(e) {
					if ($this.hasClass("is-clicked")) {
						return;
					} else {

						if( $this.hasClass("project-zoom") ) {
							$this.trigger("click");
						}else {
							window.location.href = $this.attr("href");
							return false;
						};

						$(".touch .links-container > a").removeClass("is-clicked");
						$this.addClass("is-clicked");
						return false;
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .fs-entry .links-container > a").touchHoverLinks();


	/*!Trigger albums click */
	$.fn.triggerAlbumsClick = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			var $thisSingleLink = $this.find("a.rollover-click-target").first(),
				$thisCategory = $this.find(".portfolio-categories a");

			if( $thisSingleLink.length > 0 ){
				$thisSingleLink.on("click", function(event) {
					event.stopPropagation();

					if ( $(this).hasClass('go-to') ) {
						window.location.href = $(this).attr('href');
					}
				});

				var alreadyTriggered = false;

				$this.on("click", function(){

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

					if ( !alreadyTriggered ) {
						alreadyTriggered = true;
						$thisSingleLink.trigger("click");
						
						alreadyTriggered = false;
					}
					return false;
				})
				$this.find($thisCategory).click(function(e) {
					 e.stopPropagation();
					window.location.href = $thisCategory.attr('href');
				});
			}
			$this.addClass("this-ready");
		});
	};
	$(".albums .rollover-project, .dt-albums-shortcode .rollover-project, .albums .buttons-on-img, .dt-albums-shortcode .buttons-on-img").triggerAlbumsClick();

	

	/*!Trigger rollover click*/
	
	$.fn.triggerHoverClick = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("click-ready")) {
				return;
			}

			var $thisSingleLink = $this.prev("a").first(),
				$thisCategory = $this.find(".portfolio-categories a"),
				$thisLink = $this.find(".project-link"),
				$thisTarget = $thisLink.attr("target") ? $thisLink.attr("target") : "_self",
				$targetClick;
				

			if( $thisSingleLink.length > 0 ){
			

				var alreadyTriggered = false;

				$this.on("click", function(e){

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

					if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
						$targetClick = $(e.target).parent();
					}else{
						$targetClick = $(e.target);
					}
					if($targetClick.hasClass("project-zoom")){

						//console.log(( "clicked: " + $(e.target).parent().attr("class") )
						$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-single-mfp-popup, .dt-mfp-item").first().trigger('click');
					}else{
						if ( !alreadyTriggered ) {
							alreadyTriggered = true;
							$thisSingleLink.trigger("click");
							window.location.href = $thisSingleLink.attr('href');
							
							alreadyTriggered = false;
						}
					}
					return false;
				})
				$this.find($thisLink).click(function(e) {
					 e.stopPropagation();
					 e.preventDefault();
					window.open($thisLink.attr("href"), $thisTarget);
				});

				$this.find($thisCategory).click(function(e) {
					 e.stopPropagation();
					window.location.href = $thisCategory.attr('href');
				});
			}
			$this.addClass("click-ready");
		});
	};
	$(".no-touch .rollover-project:not(.rollover-active) .rollover-content, .no-touch .buttons-on-img:not(.rollover-active) .rollover-content").triggerHoverClick();
// });


/* #Comment form
================================================== */
// jQuery(document).ready(function($) {
	var $commentForm = $('#commentform');

	$commentForm.on('click', 'a.clear-form', function (e) {
		e.preventDefault();
		$commentForm.find('input[type="text"], textarea').val('');
		if($(".contact-form-material").length > 0){
			$commentForm.find('input[type="text"], textarea').parent().removeClass("is-focused");
		};
		return false;
	});

	$commentForm.on('click', ' a.dt-btn.dt-btn-m', function(e) {
		e.preventDefault();
		$commentForm.find('#submit').trigger('click');
		return false;
	});

	if ($.browser.msie) {
		$('input[type="text"][placeholder], textarea[placeholder]').each(function () {
			var obj = $(this);

			if (obj.attr('placeholder') != '') {
				obj.addClass('IePlaceHolder');

				if ($.trim(obj.val()) == '' && obj.attr('type') != 'password') {
					obj.val(obj.attr('placeholder'));
				}
			}
		});

		$('.IePlaceHolder').focus(function () {
			var obj = $(this);
			if (obj.val() == obj.attr('placeholder')) {
				obj.val('');
			}
		});

		$('.IePlaceHolder').blur(function () {
			var obj = $(this);
			if ($.trim(obj.val()) == '') {
				obj.val(obj.attr('placeholder'));
			}
		});
	}

	if($(".contact-form-material").length > 0){
		/*!- Material design form*/

		$(".form-fields input, textarea, .comment-form-author input, .comment-form-email input").each(function(c){
			var $this = $(this),
				$parent = $this.parent("span, p"),
				$bigParent = $this.parents(".dt-form");
			
			$bigParent.find( '.clear-form' ).on( 'click' ,function( ) {
				$parent.removeClass("is-focused").removeClass("active");
			} );
			$this.focus(function() {
				$parent.addClass("is-focused").addClass("active");
				$this.attr('placeholder','');
			});
			
			$this.change(function() {
				if(0 !== $this.val().length){
					$parent.addClass("is-focused").removeClass("active");
					$this.attr('placeholder','');
				}
			});

			$this.blur(function() {
				$parent.removeClass("active");
				if('' === $this.val()){
					$parent.removeClass("is-focused").removeClass("active");
				}
			});
		});
	}
// });


/* #Fullwidth row for shortcodes & templates
================================================== */
// jQuery(document).ready(function($) {
	function fullWidthWrap(){
		if( $(".full-width-wrap").length > 0 ){
			$(".full-width-wrap").each(function(){
				var $_this = $(this),
					windowInnerW = window.innerWidth,
					windowW = $window.width(),
					contentW = $('.content').width();

					var $offset_fs,
						$width_fs;
				 
					if ($('.boxed').length > 0) {
						$offset_fs = ((parseInt($('#main').width()) - parseInt(contentW)) / 2);
					}
					else if ($('.side-header-v-stroke').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header-v-stroke').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else if ($('.sticky-header .side-header').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					}
					else if (($('.header-side-left').length && windowInnerW || $('.header-side-right').length && windowInnerW ) > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else {
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					};

					if($('.sidebar-left').length > 0 || $('.sidebar-right').length > 0){
						$width_fs = $(".content").width();
						$offset_fs = 0;
					}else{
						$width_fs = $("#main").innerWidth();
					}

					$_this.css({
						width: $width_fs,
						"margin-left": -$offset_fs,
						"opacity": 1
					});
					var scroller = $_this.find(".ts-wrap").data("thePhotoSlider");
					if(typeof scroller!= "undefined"){
						scroller.update();
					};
			});
		};
	};

	if( $(".full-width-wrap").length > 0 ){
		if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
			$window.bind("orientationchange", function() {
				fullWidthWrap();
			}).trigger( "orientationchange" );
		}
		else {
			$window.on("resize", function(){
				fullWidthWrap();
			});
			fullWidthWrap();
		};
	};
// })


/* #Misc
================================================== */
jQuery( window ).load(function($) {
	//moved here bacause the last file
	// !! Here we can hide the beautifull loading screen already 
	if(jQuery("#load").length){
		jQuery("#load").velocity("fadeOut", { duration: 300 });
	};
})


	/*--Prevent default dragstart event on images*/
	$("img").on("dragstart", function(event) { event.preventDefault(); });

	/*!-Revolution slider*/
	if ($(".rev_slider_wrapper").length > 0){
		$("#main-slideshow").each(function(){
			var $this = $(this);
			if( $this.find("> .rev_slider_wrapper")){
				$this.addClass("fix rv-slider");
			};
			if ($(".rev_slider_wrapper").hasClass("fullscreen-container") || $(".rev_slider_wrapper").hasClass("fullwidthbanner-container")){
				$this.removeClass("fix");
			};
		});
	};

	/* #Header elements
	================================================== */

		/*!Shopping cart top bar*/
		var cartTimeoutShow,
			cartTimeoutHide;

		$(".shopping-cart.show-sub-cart").each(function(){
			var $this = $(this);

			if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
				$this.find("> a").on("click", function(e) {
					if (!$(this).hasClass("dt-clicked")) {
						e.preventDefault();
						$(".shopping-cart").find(".dt-clicked").removeClass("dt-clicked");
						$(this).addClass("dt-clicked");
					} else {
						e.stopPropagation();
					}

				});
			};
			$this.on("mouseenter tap", function(e) {
				if(e.type == "tap") e.stopPropagation();

				$this.addClass("dt-hovered");
				if ($page.width() - ($this.children('.shopping-cart-wrap').offset().left - $page.offset().left) - $this.children('.shopping-cart-wrap').width() < 0) {
					$this.children('.shopping-cart-wrap').addClass("right-overflow");
				};
				/*Bottom overflow menu*/
				if ($window.height() - ($this.children('.shopping-cart-wrap').offset().top - dtGlobals.winScrollTop) - $this.children('.shopping-cart-wrap').innerHeight() < 0) {
					$this.children('.shopping-cart-wrap').addClass("bottom-overflow");
				};
				if($this.parents(".dt-mobile-header").length > 0) {
					$this.children('.shopping-cart-wrap').css({
						top: $this.position().top - 13 - $this.children('.shopping-cart-wrap').height()
					});
				}

				/*hide search*/
				$(".searchform .submit", $header).removeClass("act");
				$(".mini-search").removeClass("act");
				//$(".mini-search .field", $header).fadeOut(100);
				$(".mini-search .field", $header).stop().animate({
					"opacity": 0
				}, 150, function() {
					$(this).css("visibility", "hidden");
				});

				clearTimeout(cartTimeoutShow);
				clearTimeout(cartTimeoutHide);

				cartTimeoutShow = setTimeout(function() {
					if($this.hasClass("dt-hovered")){
						$this.children('.shopping-cart-wrap').stop().css("visibility", "visible").animate({
							"opacity": 1
						}, 150);
					}
				}, 100);
			});

			$this.on("mouseleave", function(e) {
				var $this = $(this);
				$this.removeClass("dt-hovered");

				clearTimeout(cartTimeoutShow);
				clearTimeout(cartTimeoutHide);

				cartTimeoutHide = setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						$this.children('.shopping-cart-wrap').stop().animate({
							"opacity": 0
						}, 150, function() {
							$(this).css("visibility", "hidden");
						});
						setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								$this.children('.shopping-cart-wrap').removeClass("right-overflow");
								$this.children('.shopping-cart-wrap').removeClass("bottom-overflow");
							}
						}, 400);
					}
				}, 150);

			});
		});


		/*!-Search*/
		if($(".mini-search").length > 0){
			var $header = $(".masthead, .dt-mobile-header");

			$body.on("click", function(e){
				var target = $(e.target);
				if(!target.is(".mini-search .field", $header)) {
					$(".searchform .submit", $header).removeClass("act");
					$(".mini-search", $header).removeClass("act");
					//$(".mini-search .field", $header).fadeOut(100);
					$(".mini-search .field", $header).stop().animate({
						"opacity": 0
					}, 150, function() {
						$(this).css("visibility", "hidden");
					});
					setTimeout(function() {
						$(".mini-search .field", $header).removeClass("right-overflow");
						$(".mini-search .field", $header).removeClass("bottom-overflow");
					}, 400);
				}
			})
			$(".searchform .submit", $header).on("click", function(e){
				e.preventDefault();
				e.stopPropagation();
				var $_this = $(this);
				if($_this.hasClass("act")){
					$_this.removeClass("act");
					$_this.parents(".mini-search").removeClass("act");
					//$_this.siblings(".searchform-s").fadeOut(200);
					$_this.siblings(".searchform-s").stop().animate({
						"opacity": 0
					}, 150, function() {
						$(this).css("visibility", "hidden");
					});
					setTimeout(function() {						
						$_this.siblings(".searchform-s").removeClass("right-overflow");	
						$_this.siblings(".searchform-s").removeClass("bottom-overflow");						
					}, 400);
				}else{
					$_this.addClass("act");
					$_this.parents(".mini-search").addClass("act");
					if($_this.parents(".dt-mobile-header").length > 0) {
						$_this.siblings(".searchform-s").css({
							top: $_this.parents(".mini-search").position().top  - $_this.siblings(".searchform-s").height() - 18
						});

					}
					if ($page.width() - ($_this.siblings(".searchform-s").offset().left - $page.offset().left) - $_this.siblings(".searchform-s").width() < 0) {
						$_this.siblings(".searchform-s").addClass("right-overflow");
					};
					
					/*Bottom overflow menu*/
					if ($window.height() - ($_this.siblings(".searchform-s").offset().top - dtGlobals.winScrollTop) - $_this.siblings(".searchform-s").innerHeight() < 0) {
						$_this.siblings(".searchform-s").addClass("bottom-overflow");
					};
					$_this.siblings(".searchform-s").stop().css("visibility", "visible").animate({
						"opacity": 1
					}, 150).focus();
					
					//$_this.siblings(".searchform-s").fadeIn(250);
				}
			});
		};


	/* #Shortcodes
	================================================== */

		/* !-Smart benefits & logos resize */
		$.fn.smartGrid = function() {
			return this.each(function() {
				var $this = $(this),
					colNum = parseInt($this.attr("data-columns")),
					colMinWidth = parseInt($this.attr("data-width")),
					contWidth = $this.width();

				for ( ; Math.floor(contWidth/colNum) < colMinWidth; ) {
					colNum--;
					if (colNum <= 1) break;
				}

				$("> .wf-cell", $this).css({
					width: (100/colNum).toFixed(6) + "%",
					display: "inline-block"
				});
			});
		};

		var $benLogColl = $(".benefits-grid, .logos-grid");
		$benLogColl.smartGrid();
		$window.on("debouncedresize", function () {
			$benLogColl.smartGrid();
		});

		/*!-Before After*/
		$(".twentytwenty-container .preload-me").loaded(null, function() {
			$(".twentytwenty-container").each(function(){
				var $this = $(this),
					$thisOrient = $this.attr("data-orientation").length > 0 ? $this.attr("data-orientation") : 'horizontal',
					$pctOffset = (typeof $this.attr("data-offset") != 'undefined' && $this.attr("data-offset").length > 0) ? $this.attr("data-offset") : 0.5,
					$navigationType = $this.attr("data-navigation") ? true : false;
				$this.twentytwenty({
					default_offset_pct: $pctOffset,
					orientation: $thisOrient,
					navigation_follow: $navigationType
				});
			});
		}, true);

		/*!-Isotope fix for tabs*/
		if($('.wpb_tabs .iso-container').length > 0){
			var tabResizeTimeout;
			$('.wpb_tour_tabs_wrapper').each(function(){
				var $this = $(this),
					isoInside = $this.parents(".wpb_tabs").find(".iso-container");
				$this.tabs( {
					activate: function( event, ui ) {
						isoInside.isotope("layout");
					}
				});
				$this.find("li").each(function(){
					$(this).on("click", function(){
						clearTimeout(tabResizeTimeout);
						$window.trigger( "debouncedresize" );
						$(this).parents(".wpb_tabs").find(".iso-container").isotope("layout");
					});
				});
			});
		}
		/*!-tabs style four: click effect*/
		$(".tab-style-four .wpb_tabs_nav a").each(function(){
			var $this = $(this);
			$this.addClass("ripple");
			$this.ripple();
		});


	/* #Widgets
	================================================== */


		/*!Instagram style photos*/

		$.fn.calcPics = function() {
				var $collection = $(".instagram-photos");
				if ($collection.length < 1) return false;

				return this.each(function() {
					var maxitemwidth = maxitemwidth ? maxitemwidth : parseInt($(this).attr("data-image-max-width")),
						itemmarg = parseInt($(this).find("> a").css("margin-left"));
					$(this).find(" > a").css({
						"max-width": maxitemwidth,
						"opacity": 1
					});

					// Cahce everything
					var $container = $(this),
						containerwidth = $container.width(),
						itemperc = (100/(Math.ceil(containerwidth/maxitemwidth)));
				
					$container.find("a").css({ "width": itemperc+'%' });
			});
		};
		$(".instagram-photos").calcPics();

		/* !- Accordion Tooltip */
		// $(".st-accordion").dtAccordion({
		// 	open: 0,
		// 	oneOpenedItem: true
		// });

		$('.st-accordion').each(function(){
			var accordion = $(this);
			accordion.find('ul > li > a').on("click", function(e){
				e.preventDefault();
				var $this = $(this),
					$thisNext = $this.next();
				$(".st-content", accordion).not($thisNext).slideUp('fast');
				$thisNext.slideToggle('fast');
			});
		});
		simple_tooltip(".shortcode-tooltip","shortcode-tooltip-content");

		/*!-search widget*/
		$('.widget .searchform .submit').on('click', function(e) {
			e.preventDefault();
			$(this).siblings('input.searchsubmit').click();
			return false;
		});

		// !- Skills
		$.fn.animateSkills = function() {
			$(".skill-value", this).each(function () {
				var $this = $(this),
					$this_data = $this.data("width");

				$this.css({
					width: $this_data + '%'
				});
			});
		};
		$.fn.animateSkills = function() {
			$(".skill-value", this).each(function () {
				var $this = $(this),
					$this_data = $this.data("width");

				$this.css({
					width: $this_data + '%'
				});
			});
		};

		// !- Animation "onScroll" loop
		function doSkillsAnimation() {
			
			if(dtGlobals.isMobile){
				$(".skills").animateSkills();
			}
		};
		// !- Fire animation
		doSkillsAnimation();


	/* #Posts
	================================================== */
		var socTimeoutShow,
			socTimeoutHide;

		/*!-Show share buttons*/
		setTimeout(function() {
			$(".album-share-overlay, .project-share-overlay:not(.allways-visible-icons)").each(function(){
				var $this = $(this);
					$this.find(".share-button").on("click", function(e){
						e.preventDefault();
					});
					$this.on("mouseenter tap", function(e) {
						if(e.type == "tap") e.stopPropagation();

						var $this = $(this);
						$this.addClass("dt-hovered");

						clearTimeout(socTimeoutShow);
						clearTimeout(socTimeoutHide);

						socTimeoutShow = setTimeout(function() {
							if($this.hasClass("dt-hovered")){
								$this.find('.soc-ico a').css("display", "inline-block");
								$this.find('.soc-ico').stop().css("visibility", "visible").animate({
									"opacity": 1
								}, 200);
							}
						}, 100);
					});

				$this.on("mouseleave ", function(e) {
					var $this = $(this);
					$this.removeClass("dt-hovered");

					clearTimeout(socTimeoutShow);
					clearTimeout(socTimeoutHide);

					socTimeoutHide = setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							$this.find('.soc-ico').stop().animate({
								"opacity": 0
							}, 150, function() {
								$this.find('.soc-ico a').css("display", "none");
								$(this).css("visibility", "hidden");
							});
						}
					}, 50);

				});
			});
		}, 150);

		/*!-Project floating content*/
		var $floatContent = $(".floating-content"),
			projectPost = $(".project-post");
		var $parentHeight,
			$floatContentHeight,
			phantomHeight = 0;

	//var $scrollHeight;

	function setFloatinProjectContent() {
		$(".project-slider .preload-me").loaded(null, function() {
			var $sidebar = $(".floating-content");
			if ($(".floating-content").length > 0) {
				var offset = $sidebar.offset();
				if($(".top-bar").length > 0 && $(".phantom-sticky").length > 0){
					var topBarH = $(".top-bar").height();
				}else{
					var topBarH = 0;
				}
					//$scrollHeight = $(".project-post").height();
				var $scrollOffset = $(".project-post").offset();
				//var $headerHeight = $phantom.height();
				$window.on("scroll", function () {
					if (window.innerWidth > 1050) {
						if (dtGlobals.winScrollTop + $phantom.height() > offset.top) {
							if (dtGlobals.winScrollTop + $phantom.height() + $floatContentHeight + 40 < $scrollOffset.top + $parentHeight) {
								$sidebar.stop().velocity({
									translateY : dtGlobals.winScrollTop - offset.top + $phantom.height() - topBarH
								}, 300);
							} else {
								$sidebar.stop().velocity({
									translateY: $parentHeight - $floatContentHeight - 40 - topBarH
								}, 300)
							}
						} else {
							$sidebar.stop().velocity({
								translateY: 0
							}, 300)
						}
					} else {
						$sidebar
							.css({
								"transform": "translateY(0)",
								"-webkit-transform" : "translateY(0)",
							});
					}
				})
			}
		}, true);
	}
	setFloatinProjectContent();
	/* !Fancy header*/
	var fancyFeaderOverlap = $(".transparent #fancy-header").exists(),
		titleOverlap = $(".transparent .page-title").exists();


	$.fancyFeaderCalc = function() {
		$(".branding .preload-me").loaded(null, function() {
			if (fancyFeaderOverlap) {
				$(".transparent #fancy-header > .wf-wrap").css({
					"padding-top" : $(".masthead:not(.side-header)").height()
				});
			};
			if (titleOverlap) {
				$(".transparent .page-title > .wf-wrap").css({
					"padding-top" : $(".masthead:not(.side-header)").height()
				});
				$(".transparent .page-title").css("visibility", "visible");
			};
		}, true);
	};


	/*!-Paginator*/
	var $paginator = $('.paginator[role="navigation"]'),
		$dots = $paginator.find('a.dots');
	$dots.on('click', function() {
		$paginator.find('div:hidden').show().find('a').unwrap();
		$dots.remove();
	});

	// pin it
	$(".soc-ico a.pinit-marklet").click(function(event){
		event.preventDefault();
		$("#pinmarklet").remove();
		var e = document.createElement('script');
		e.setAttribute('type','text/javascript');
		e.setAttribute('charset','UTF-8');
		e.setAttribute('id','pinmarklet');
		e.setAttribute('async','async');
		e.setAttribute('defer','defer');
		e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e);
	});

	/*!-Scroll to Top*/
	$window.on("debouncedresize", function() {
		if(window.innerWidth  > dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
			if($(".masthead:not(.side-header):not(.mixed-header)").length > 0){
				dtGlobals.showTopBtn = $(".masthead:not(.side-header):not(.mixed-header)").height() + 150;
			}else if($(".masthead.side-header-h-stroke").length > 0){
				dtGlobals.showTopBtn = $(".side-header-h-stroke").height() + 150;
			}else{
				dtGlobals.showTopBtn = 500;
			}
		}else{
			if($(".masthead:not(.mixed-header)").length > 0){
				dtGlobals.showTopBtn = $(".masthead:not(.mixed-header)").height() + 150;
			}else if($(".masthead.mixed-header").length > 0){
				dtGlobals.showTopBtn = $(".mixed-header").height() + 150;
			}else{
				dtGlobals.showTopBtn = 500;
			}
		}
	});
	$window.scroll(function () {
		
		if (dtGlobals.winScrollTop > dtGlobals.showTopBtn) {
			$('.scroll-top').removeClass('off').addClass('on');
		}
		else {
			$('.scroll-top').removeClass('on').addClass('off');
		}
	});
	$(".scroll-top").click(function(e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});

	

	/*!-Custom select*/

	// Create the dropdown base
	$("<select />").prependTo(".mini-nav .menu-select");

	// Create default option "Select"
	$("<option />", {
		"selected"  :  "selected",
		"value"     :  "",
		"text"      :  "———"
	}).appendTo(".mini-nav .menu-select select");

	// Populate dropdown with menu items
	$(".mini-nav").each(function() {
		var elPar = $(this),
			thisSelect = elPar.find("select");
		$("a", elPar).each(function() {
			var el = $(this);
			$("<option />", {
				"value"   : el.attr("href"),
				"text"    : el.text(),
				"data-level": el.attr("data-level")
			}).appendTo(thisSelect);
		});
	});

	$(".mini-nav select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
	$(".mini-nav select option").each(function(){
		var $this = $(this),
			winHref = window.location.href;
		 if($this.attr('value') == winHref){
			$this.attr('selected','selected');
		};
	})
	/*!-Appearance for custom select*/
	$('.woocommerce.widget_layered_nav select, .woocommerce-ordering-div select, .mini-nav select, .widget_product_categories select').each(function(){
		$(this).customSelect();
	});
	$(".menu-select select, .mini-nav .customSelect1, .vc_pie_chart .vc_pie_wrapper").css("visibility", "visible");

	$(".mini-nav option").each(function(){
		var $this	= $(this),
			text	= $this.text(),



			prefix	= "";

		switch ( parseInt($this.attr("data-level"))) {
			case 1:
				prefix = "";
			break;
			case 2:
				prefix = "— ";
			break;
			case 3:
				prefix = "—— ";
			break;
			case 4:
				prefix = "——— ";
			break;
			case 5:
				prefix = "———— ";
			break;
		}
		$this.text(prefix+text);
	});

	/*!-Material click for menu and buttons*/
	var ua = navigator.userAgent,
		event = (ua.match(/iPhone/i)) ? "touchstart" : "click";

	$(".project-navigation a, .mobile-sticky-header-overlay").bind(event, function(e) {});
	$(".menu-material-style > li > a, .menu-material-style .sub-nav > ul > li > a, .menu-material-underline-style > li > a, .menu-material-underline-style .sub-nav > ul > li > a").each(function(){
		var $this = $(this);
		$this.addClass("ripple");
		$this.ripple();
	});
	// $(".rollover, .post-rollover, .rollover-video").each(function(){
	// 	$this = $(this);
	// 	if($(".click-effect-on-img").length > 0){
	// 		$this.addClass("material-click-effect");
	// 	}
	// });

	$.fn.clickEffectPics = function() {

		return this.each(function() {
			$this = $(this);
			if($(".click-effect-on-img").length > 0){
				$this.addClass("material-click-effect");
			}
		});
	};
	$(".rollover, .post-rollover, .rollover-video").clickEffectPics();

	

	$(function(){
		$.fn.clickMaterialEffect = function() {
			return this.each(function() {
				var ink, d, x, y;
				var $this = $(this),
			        $this_timer = null,
			         $link_timer = null;
				if($this.find(".ink").length === 0){
					$this.prepend("<span class='ink'></span>");
				}
				
				$this.addClass("ripplelink");

				ink = $this.find(".ink");
				ink.removeClass("animate");

				if(!ink.height() && !ink.width()){
					d = Math.max($(this).outerWidth(), $this.outerHeight());
					ink.css({height: d, width: d});
				}
				
				$this.bind( 'mousedown', function( e ) {
					clearTimeout( $this_timer );
					x = e.pageX - $this.offset().left - ink.width()/2;
					y = e.pageY - $this.offset().top - ink.height()/2;

						ink.css({top: y+'px', left: x+'px'}).addClass("animate");

					// if (e.which == 3) {
					// }else{
					// 	if($this.hasClass("dt-btn") || $this.hasClass("button")){
					// 		e.preventDefault();
					// 		e.stopPropagation();
					// 		var $thisTarget = $this.attr("target") ? $this.attr("target") : "_self";
					// 	//	ink.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
					// 		clearTimeout( $link_timer );
					// 		$link_timer  = setTimeout( function(){
					// 			if(!$(this).parent('a[href^="#"]').length > 0){
					// 				window.open($this.attr("href"), $thisTarget);
					// 				return false;
					// 			}else{
					// 				$(this).parent("a").trigger("click");
					// 			}
					// 		}, 200 );
					// 	//	});
					// 	}
					// }
				} );
				$this.bind( 'mouseup mouseleave', function( e ) {
					clearTimeout( $link_timer );
					clearTimeout( $this_timer );
					$this._timer = setTimeout( function() {
						ink.removeClass("animate");
					},400)
				} );
				
			});
		};

		$(".rollover.material-click-effect, .post-rollover.material-click-effect, .rollover-video.material-click-effect").clickMaterialEffect();

		
		/*$(".rollover, .post-rollover, .rollover-video").click(function(e){
			if($(this).find(".ink").length === 0){
				$(this).prepend("<span class='ink'></span>");
			}

			ink = $(this).find(".ink");
			ink.removeClass("animate");

			if(!ink.height() && !ink.width()){
				d = Math.max($(this).outerWidth(), $(this).outerHeight());
				ink.css({height: d, width: d});
			}

			x = e.pageX - $(this).offset().left - ink.width()/2;
			y = e.pageY - $(this).offset().top - ink.height()/2;

			ink.css({top: y+'px', left: x+'px'}).addClass("animate");
			setTimeout(function(){
				ink.removeClass("animate");
			}, 500)
		});*/
	});
	/*!-Material design clickeffect*/
	if($(".small-portfolio-icons").length > 0){

		$('.links-container a').each(function(){
			var $this = $(this);
			$this.addClass("waves-effect");
		});
		Waves.displayEffect();
	}
	
	if($(".filter-style-material").length > 0){

		$(".filter-categories a, .paginator .page-links a").each(function(){
			var $this = $(this);
			$this.addClass("ripple");
			$this.ripple();
		});
		$(".filter-switch").append("<span class='filter-switch-toggle'></span>");

		$('.paginator .page-nav a').each(function(){
			var $this = $(this);
			$this.addClass("waves-effect");
		});
		Waves.displayEffect();

		//$(".filter-switch").append('<input class="tgl" type="checkbox">');
		if (Modernizr.touch) {
			$('.filter-switch').on('touchstart',function(e) {
				$('.filter-switch').removeClass("pressed")
				$(this).addClass('pressed');
			});
		} else {
			$('.filter-switch').on('mousedown',function(e) {
				$('.filter-switch').removeClass("pressed")
				$(this).addClass('pressed');
				setTimeout(function(){
					$(this).removeClass('pressed');
				},600);
			});
		}
		$('.filter-switch .filter-switch-toggle').on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', function(e) {
			$(this).parent().removeClass('pressed');
		});
		if (Modernizr.touch) {
			$('.filter-extras a').on('touchstart',function(e) {
				$('.filter-extras').removeClass("pressed")
				$(this).parent(".filter-extras").addClass('pressed');
			});
		} else {
			$('.filter-extras a').each(function(){
				$(this).on('mousedown',function(e) {
					$('.filter-extras').removeClass("pressed")
					$(this).addClass('pressed');
					setTimeout(function(){
						$(this).removeClass('pressed');
					},600);
				});
			});
		}
		$('.filter-extras a').on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', function(e) {
			$(this).removeClass('pressed');
		});
		

	};

	// Prevent a backgroung rendering glitch in Webkit.
	if (!window.bgGlitchFixed && $.browser.webkit) {
		setTimeout(function(){
			$window.scrollTop(dtGlobals.winScrollTop + 1);
			window.bgGlitchFixed = true;
		},10)
	}

	var waitForFinalEvent = (function () {
		var timers = {};
		return function (callback, ms, uniqueId) {
			if (!uniqueId) {
				uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
				clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		};
	})();


	/* #Misc(desctop only)
	================================================== */
	if(!dtGlobals.isMobile){
		setTimeout(function(){
			/*!-parallax initialisation*/
			$('.stripe-parallax-bg, .fancy-parallax-bg, .page-title-parallax-bg').each(function(){
				var $_this = $(this),
					speed_prl = $_this.data("prlx-speed");
				$(this).parallax("50%", speed_prl);
				$_this.addClass("parallax-bg-done");
				$_this.css("opacity", "1")
			});
		}, 1000)

		/*!-Animate fancy header elements*/
		var j = -1;
		$("#fancy-header .fancy-title:not(.start-animation), #fancy-header .fancy-subtitle:not(.start-animation), #fancy-header .breadcrumbs:not(.start-animation)").each(function () {
			var $this = $(this);
			var animateTimeout;
			if (!$this.hasClass("start-animation") && !$this.hasClass("start-animation-done")) {
				$this.addClass("start-animation-done");
				j++;
				setTimeout(function () {
					$this.addClass("start-animation");
					
				}, 300 * j);
			};
		});

		/*!-Animate element on scroll*/
		// function doAnimation() {
		// 	if(!dtGlobals.isMobile){
		// 		var j = -1;
		// 		$(".animate-element:not(.start-animation):in-viewport").each(function () {
		// 			var $this = $(this);
		
		// 			if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
		// 				$this.addClass("animation-triggered");
		// 				j++;
		// 				setTimeout(function () {
		// 					$this.addClass("start-animation");
		// 					if($this.hasClass("skills")){
		// 						$this.animateSkills();
		// 					};
		// 				}, 200 * j);
		// 			};
		// 		});
		// 	}
		// };
		// // !- Fire animation
		// doAnimation();
		// if (!$("html").hasClass("old-ie")){
		// 	$(window).on("scroll", function () {
		// 		doAnimation();
		// 	});
		// };

		/*!-Video background*/
		$(".stripe-video-bg > video").each(function(){
			var $_this = $(this),
				$this_h = $_this.height();
			$_this.css({
				"marginTop": -$this_h/2
			})
		});

		$(".stripe-video-bg:in-viewport").each(function() {
			var $video = $(this).find('video');

			if ( $video.length > 0 ) {
				$video.get(0).play();
			}
		});
		$window.on("scroll", function () {
			if($(".stripe-video-bg").length > 0){
				var stripeVideo = $(".stripe-video-bg");
				stripeVideo.each(function() {
					var $this = $(this),
						video = $this.find('video');

					if ( video.length > 0 ) {

						if ( $this.is(':in-viewport') ) {

							video.get(0).play();
						} else {

							video.get(0).pause();
						}
					}
				});
			}
		});

	};

	/* #Footer
	================================================== */

		/*!-Overlap Footer*/
		$(".footer-overlap .footer").css({
			'opacity': 1
		});

		/*Move side header out of page-inner (bug with sticky footer)*/
		if($(".page-inner").length > 0 && $(".side-header").length > 0 || $(".page-inner").length > 0 && $(".dt-mobile-header").length > 0){
			$(".side-header, .mixed-header, .dt-mobile-header, .dt-close-mobile-menu-icon").insertBefore(".page-inner");
			// $(".mixed-header").insertBefore(".page-inner");
			// $(".dt-mobile-header").insertBefore(".page-inner");
			// $(".dt-close-mobile-menu-icon").insertBefore(".page-inner");
		};

		/*Adding class if footer is empty*/
		if(!$(".footer .widget").length > 0) {
			$(".footer").addClass("empty-footer");
		};
	
// });
		// function countCSSRules() {





/* #Masonry
================================================== */
// jQuery(document).ready(function($) {
	// var $html = $("html"),
	// 	$body = $("body");
	// !- Calculate columns size
	$.fn.calculateColumns = function(minWidth, colNum, padding, mode) {
		return this.each(function() {
			var $container = $(this),
				containerWidth = $container.width() - 1,
				containerPadding = (padding !== false) ? padding : 20,
				containerID = $container.attr("data-cont-id"),
				tempCSS = "",
				first = false;

			if(typeof(minWidth)==='undefined') minWidth = 200;
			if(typeof(colNum)==='undefined') colNum = 6;


			for ( ; Math.floor(containerWidth/colNum) < minWidth; ) {
				colNum--;
				if (colNum <= 1) break;
			}

			if (!$("#col-style-id-"+containerID).exists()) {

				if(!$html.hasClass("old-ie")){// IE
						var jsStyle = document.createElement("style");
						jsStyle.id = "col-style-id-"+containerID;
						jsStyle.appendChild(document.createTextNode(""));
						document.head.appendChild(jsStyle);
					
				}
			} else {
				var jsStyle = document.getElementById("col-style-id-"+containerID);
			}


			var $style = $("#col-style-id-"+containerID);

			var singleWidth,
				doubleWidth,
				normalizedPadding,
				normalizedMargin,
				normalizedPaddingTop;

			if (containerPadding < 10) {
				normalizedPadding = 0;
				normalizedPaddingTop = 0;
			}
			else {
				normalizedPaddingTop = containerPadding - 5;
				normalizedPadding = containerPadding - 10;
			};
			if (containerPadding == 0) {
				normalizedMargin = 0;
			}
			else {
				normalizedMargin = -containerPadding;
			};

			if (mode == "px") {
				singleWidth = Math.floor(containerWidth / colNum)+"px";
				doubleWidth = Math.floor(containerWidth  / colNum)*2+"px";
			}
			else {
				singleWidth = Math.floor(100000 / colNum)/1000+"%";
				doubleWidth = Math.floor(100000 / colNum)*2/1000+"%";
			};
			if ( $(".cont-id-"+containerID+"").not(".bg-under-post").hasClass("description-under-image") ) {
				if (colNum > 1) {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+containerPadding+"px -"+normalizedPadding+"px ; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+containerPadding+"px "+normalizedPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": -containerPadding + "px",
							"margin-left": -containerPadding + "px",
							"margin-bottom": -normalizedPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": -normalizedPadding + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth,
							"padding-top": normalizedPaddingTop + "px",
							"padding-right": containerPadding + "px",
							"padding-left": containerPadding + "px",
							"padding-bottom": normalizedPadding + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell.double-width").css({
							"width": doubleWidth
						});
					}
				}
				else {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+normalizedPadding+"px -"+containerPadding+"px ; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+normalizedPadding+"px "+containerPadding+"px; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": -normalizedPadding + "px",
							"margin-left": -normalizedPadding + "px",
							"margin-bottom": -containerPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": -normalizedPadding + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth,
							"padding-top": normalizedPaddingTop + "px",
							"padding-right": normalizedPadding + "px",
							"padding-left": normalizedPadding + "px",
							"padding-bottom": containerPadding + "px"
						});
					}
				};
			}else {
				if (colNum > 1) {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px  "+containerPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+";  padding: "+containerPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin": -containerPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": normalizedMargin + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": normalizedMargin + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth +"px",
							"padding": containerPadding +"px"
						});
						$(".cont-id-"+containerID+" > .wf-cell.double-width").css({
							"width": doubleWidth +"px"
						});
					}
				}
				else {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px "+containerPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+containerPadding+"px; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin": -containerPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": normalizedMargin + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": normalizedMargin + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth,
							"padding": containerPadding + "px"
						});
					}
				};
			};
			if(!$html.hasClass("old-ie") ){
					$style.html(tempCSS);
					var newRuleID = jsStyle.sheet.cssRules.length;
					jsStyle.sheet.insertRule(".webkit-hack { }", newRuleID);
					jsStyle.sheet.deleteRule(newRuleID);
				
			}

			$container.trigger("columnsReady");

		});
	};

	// !- Initialise slider
	$.fn.initSlider = function() {
		return this.each(function() {
			var $_this = $(this),
				attrW = $_this.data('width'),
				attrH = $_this.data('height'); 

			$_this.royalSlider({
				autoScaleSlider: true,
				autoScaleSliderWidth: attrW,
				autoScaleSliderHeight: attrH,
				imageScaleMode: "fit",
				imageScalePadding: 0,
				slidesOrientation: "horizontal",
				disableResponsiveness: true
			});
		});
	};

	/* !Containers of masonry and grid content */
	var	$isoCollection = $(".iso-container"),
		$gridCollection = $(".iso-grid:not(.jg-container, .iso-container), .blog.layout-grid .wf-container.description-under-image:not(.jg-container, .iso-container), .grid-masonry:not(.iso-container), .shortcode-blog-posts.iso-grid"),
		$combinedCollection = $isoCollection.add($gridCollection),
		$isoPreloader = dtGlobals.isoPreloader = $('<div class="iso-preloader pace pace-active"><div class="pace-activity"></div></div>').appendTo("body").hide();
		$combinedCollection.addClass("dt-isotope");

	/* !Smart responsive columns */
	if ($combinedCollection.exists()) {
		$combinedCollection.each(function(i) {
			var $container = $(this),
				contWidth = parseInt($container.attr("data-width")),
				contNum = parseInt($container.attr("data-columns"));
			var contPadding = parseInt($container.attr("data-padding"));
			
			$container.addClass("cont-id-"+i).attr("data-cont-id", i);
			$container.calculateColumns(contWidth, contNum, contPadding, "px");
			if(contPadding > 10){
				$container.addClass("mobile-paddings");
			}

			$window.on("debouncedresize", function () {
				$container.calculateColumns(contWidth, contNum, contPadding, "px");

				if(contPadding > 10){
					$container.addClass("mobile-paddings");
				}
			});
		});
	}

	if(!dtGlobals.isPhone){
		// !- Responsive height hack
		$.fn.heightHack = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("height-ready") || $img.parents(".post-rollover").exists()) {
					return;
				}

				var	imgWidth = parseInt($img.attr('width')),
					imgHeight = parseInt($img.attr('height')),
					imgRatio = imgWidth/imgHeight;

				if($img.parents(".testimonial-vcard, .dt-format-gallery, .shortcode-blog-posts.iso-grid ").exists()) {
					$img.wrap("<div />");
				};

				$img.parent().css({
					"padding-bottom" : 100/imgRatio+"%",
					"height" : 0,
					"display" : "block"
				});

				$img.attr("data-ratio", imgRatio).addClass("height-ready");
			});
		};

		// !- Show items
		$.fn.showItems = function() {
			return this.each(function() {
				var $item = $(this),
					$img = $item.find(".preload-me").first();
			});
		};
		/* !Masonry and grid layout */

		/* !Filter: */
		var $container = $('.iso-container, .portfolio-grid');

		$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-categories a').on('click.presscorFilterCategories', function(e) {
			var selector = $(this).attr('data-filter');

			$container.isotope({ filter: selector });
			return false;
		});

		// !- filtering
		$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-extras .filter-by a').on('click', function(e) {
			var sorting = $(this).attr('data-by'),
				sort = $(this).parents('.filter-extras').find('.filter-sorting > a.act').first().attr('data-sort');

			$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
			return false;
		});

		// !- sorting
		$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-extras .filter-sorting a').on('click', function(e) {
			var sort = $(this).attr('data-sort'),
				sorting = $(this).parents('.filter-extras').find('.filter-by > a.act').first().attr('data-by');

			$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
			return false;
		});

		/* !Masonry layout */
		if ($isoCollection.exists() || $gridCollection.exists() ) {

			// Show preloader
			$isoPreloader.fadeIn(50);

			// Collection of masonry instances 
			$isoCollection.each(function(i) {
				var $isoContainer = $(this);

				// Hack to make sure that masonry will correctly calculate columns with responsive images height. 
				$(".preload-me", $isoContainer).heightHack();

				// Slider initialization
				$(".slider-masonry", $isoContainer).initSlider();

				// Masonry initialization

				$isoContainer.one("columnsReady", function() {

					$isoContainer.isotope({
						itemSelector : '.iso-item',
						 transformsEnabled: false,
						isResizeBound: false,
						layoutMode : 'masonry',
						transitionDuration: 0,
						/*animationEngine: typeOfAnimation,*/
						masonry: { columnWidth: 1 },
						getSortData : {
							date : function( $elem ) {
								return $($elem).attr('data-date');
							},
							name : function( $elem ) {
								return $($elem).attr('data-name');
							}
						}
					});

					// Recalculate everything on window resize
					$window.on("columnsReady", function () {
						$(".royalSlider", $isoContainer).each(function() {
							$(this).data("royalSlider").updateSliderSize();
						});
						$isoContainer.isotope("layout");
						
					});
				});

				// Show item(s) when image inside is loaded
				$("> .iso-item", $isoContainer).showItems();
				
			});

			$gridCollection.each(function(i) {
				var $isoContainer = $(this);

				// Hack to make sure that masonry will correctly calculate columns with responsive images height. 
				$(".preload-me", $isoContainer).heightHack();

				// Slider initialization
				$(".slider-simple", $isoContainer).initSlider();

				// Masonry initialization

				$isoContainer.one("columnsReady", function() {

					$isoContainer.isotope({
						itemSelector : '.wf-cell',
						transformsEnabled: false,
						isResizeBound: false,
						layoutMode : 'fitRows',
						transitionDuration: 0,

						/*animationEngine: typeOfAnimation,*/
						masonry: { columnWidth: 1 },
						getSortData : {
							date : function( $elem ) {
								return $($elem).attr('data-date');
							},
							name : function( $elem ) {
								return $($elem).attr('data-name');
							}
						}
					});

					// Recalculate everything on window resize
					$isoContainer.on("columnsReady", function () {
						$(".royalSlider", $isoContainer).each(function() {
							$(this).data("royalSlider").updateSliderSize();
						});
						$isoContainer.isotope("layout");
					});

				});

				// Show item(s) when image inside is loaded
				$("> .wf-cell", $isoContainer).showItems();
			});

			// Hide preloader
			$isoPreloader.stop().fadeOut(300);

		};
	};

	/*!- Phone only*/
	if(dtGlobals.isPhone){
		$(".slider-masonry").initSlider();
		$window.on("columnsReady", function () {
			$(".royalSlider").each(function() {
				$(this).data("royalSlider").updateSliderSize();
			});

		});

		$(".filter-extras").css("display", "none");

		var $container = $(".filter").next('.iso-container, .portfolio-grid'),
			$items = $(".iso-item, .wf-cell", $container),
			selector = null;

		$(".filter-categories:not(.iso-filter) a").each(function(){
			$(this).on('click', function(e) {
				e.preventDefault();
				selector = $(this).attr('data-filter');
				$items.css("display", "none");
				$items.filter(selector).css("display", "block");
			});
		});

	};
// })

// jQuery(document).ready(function($) {
	/* !Debounced resize event */
	

	/*!- Custom resize function*/
	var dtResizeTimeout;
	if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
		$window.bind("orientationchange", function(event) {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$window.trigger( "debouncedresize" );
			}, 200);
		});
	}else{
		$window.on("resize", function() {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$window.trigger( "debouncedresize" );
			}, 200);
		});
	}

	/*!Change filter appearance when too much categories*/

		function changeFilter(){
			$(".filter-categories").each(function(){
				var width = 0;
				$(".filter-categories a").each(function(){
					var $_this = $(this);
					if($(".style-ios").length > 0){
						width += ($_this.innerWidth()-1);
					}else{
						width += $_this.innerWidth();
					}
				});
				if( width > $(this).width() ){
					$(this).addClass("new-style")
				}else{
					$(this).removeClass("new-style")
				}
			});
		};
		changeFilter();

	$window.on("debouncedresize", function( event ) {
		dtGlobals.resizeCounter++;
		$(".instagram-photos").calcPics();
		changeFilter();
		$.mobileHeader();
		$.headerBelowSlider();

		/*Mobile header*/
		if(window.innerWidth >= dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
			$page.removeClass("show-mobile-header");
			$page.addClass("closed-mobile-header");
			$body.removeClass("show-sticky-mobile-header");
			$body.removeClass("show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
			$(".mobile-sticky-header-overlay").removeClass("active");
			$(".dt-mobile-menu-icon").removeClass("active");
			$html.removeClass("menu-open");
		}
		if(window.innerWidth <= dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
			$('.masthead:not(.mixed-header):not(#phantom)').addClass("masthead-mobile");
		}else{
			$('.masthead:not(.mixed-header):not(#phantom)').removeClass("masthead-mobile");
		}
		
		$('.mini-nav select').trigger('render');
		
		$.fancyFeaderCalc();

		// if($('.masthead.side-header').length > 0 || window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
		// 	phantomHeight = 0;
		// }else if($('.logo-classic').length > 0 || $('.logo-center').length > 0){
		// 	phantomHeight = $('#phantom').height() + 68;
		// }else{
		// 	phantomHeight = $('#phantom').height() + 40;
		// };

	
		$(".stripe-video-bg > video").each(function(){
			var $_this = $(this),
				$this_h = $_this.height();
			$_this.css({
				"marginTop": -$this_h/2
			});
		});

		if($.browser.webkit){
			$(".wf-cell .blur-this").each(function(){
				var $_this = $(this);
				if($('canvas', $_this).length){
					var context = $('.blur-effect', $_this)[0].getContext('2d');
					context.beginPath();
					context.moveTo(0,0);
					context.lineTo(0,0);
					context.lineTo(0,0);
					context.strokeStyle="red";
					context.stroke();
				}
			});
		};
		$(".stripe, .wpb_row").each(function(){
			var $_this = $(this),
				$_this_min_height = $_this.attr("data-min-height");
			if($.isNumeric($_this_min_height)){
				$_this.css({
					"minHeight": $_this_min_height + "px"
				});
			}else if(!$_this_min_height){
				$_this.css({
					"minHeight": 0
				});
			}else if($_this_min_height.search( '%' ) > 0){
				$_this.css({
					"minHeight": $window.height() * (parseInt($_this_min_height)/100) + "px"
				});
			}else{
				$_this.css({
					"minHeight": $_this_min_height
				});
			};
		});

		/*Floating content*/
		
		$(".project-slider .preload-me").loaded(null, function() {

			$parentHeight = projectPost.height();
			$floatContentHeight = $floatContent.height();
		}, true);
		
		if ( $floatContent.length > 0 && window.innerWidth > 1050 ){
			$(".project-slider .preload-me").loaded(null, function() {
				if ( (dtGlobals.winScrollTop + $phantom.height() + $floatContentHeight + 40) > (projectPost.offset().top + $parentHeight)) {
					$floatContent.css({
						top: $parentHeight - $floatContentHeight - 40
					});
				};
			}, true);
		};

		/* Sticky footer */

		$(".mobile-false .footer-overlap .page-inner").css({
			'min-height': window.innerHeight - $(".footer").innerHeight(),
			'margin-bottom': $(".footer").innerHeight()
		});

	}).trigger( "debouncedresize" );

/*Custom resize function:end*/
// })


/* #AJAX
================================================== */
// jQuery(document).ready(function($) {

	$.fn.inView = function(){
		//Window Object
		var win = $(window);
		//Object to Check
		obj = $(this);
		//the top Scroll Position in the page
		var scrollPosition = win.scrollTop();
		//the end of the visible area in the page, starting from the scroll position
		var visibleArea = win.scrollTop() + win.height();
		//the end of the object to check
		var objEndPos = (obj.offset().top + 20);
		return(visibleArea >= objEndPos && scrollPosition <= objEndPos ? true : false);
	};

	// 4 Alla & Danil: we need to unify all ajax and masonry and other stuff in this manner:
	function loadingEffects() {
		//if(dtGlobals.isiPhone) return;

		var $isotope = $(".dt-isotope"),
			$grid = $(".iso-grid .wf-cell:not(.shown)");

		if ($grid.exists()) {
			precessEffects($grid);
		}

		if (!$isotope.exists()) {
			var $isoFallback = $(".iso-item:not(.shown)");

			if (!$isoFallback.exists()) return;
			precessEffects($isoFallback);
		}
		else {
			$isotope.each(function() {
				//console.log( $(this).data("isotope").items(element))
				/*var $atoms = $(this).data("isotope").$allAtoms;*/
				var $atoms = $(this).find(".wf-cell");
				if (!$atoms.exists()) return;
				/*if (typeof $atoms == 'undefined') return;*/
				precessEffects($atoms);
			});
		};
	};

	function precessEffects($atoms) {
		var k = 0;

		$atoms.each(function () {
			var $this = $(this);
			if($(".mobile-true").length > 0 || $this.parents(".loading-effect-none").length > 0){
				if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered")) {
					$this.addClass("animation-triggered");
					setTimeout(function () {
						if ($this.hasClass("animation-triggered")) { 
							$this.removeClass("animation-triggered").addClass("shown");
						};
					}, 200);
				};
			}else{
				if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered") && $this.inView()) {
					$this.addClass("animation-triggered");
					k++;
					setTimeout(function () {
						if ($this.hasClass("animation-triggered")) { 
							$this.removeClass("animation-triggered").addClass("shown");
						};
					}, 100 * k);
				};
			}
		});
	};

	function resetEffects() {
		$(".iso-item.shown, .iso-grid .wf-cell.shown").removeClass("start-animation").removeClass("animation-triggered").removeClass("shown");
	};

	var dtAjaxing = {
		xhr: false,
		settings: false,
		lunch: function( settings ) {

			var ajaxObj = this;

			if ( settings ) {
				this.settings = settings;
			}

			if ( this.xhr ) {
				this.xhr.abort();
			}

			var action = 'presscore_template_ajax';

			this.xhr = $.post(
				settings.ajaxurl,
				{
					action : action,
					postID : settings.postID,
					paged : settings.paged,
					targetPage : settings.targetPage,
					term : settings.term,
					orderby : settings.orderBy,
					order : settings.order,
					nonce : settings.nonce,
					visibleItems : settings.visibleItems,
					contentType : settings.contentType,
					pageData : settings.pageData,
					sender : settings.sender
				},
				function( responce ) {

					if ( responce.success ) {

						var $responceItems = jQuery(responce.html),
							$isoContainer = settings.targetContainer,

							contWidth = parseInt($isoContainer.attr("data-width")),
							contMaxWidth = parseInt($isoContainer.attr("data-max-width")),
							contPadding = parseInt($isoContainer.attr("data-padding"));
							isIsotope = 'grid' == settings.layout || 'masonry' == settings.layout,
							itemsToDeleteLength = 0,
							trashItems = new Array(),
							sortBy = responce.orderby.replace('title', 'name'),
							sortAscending = ('asc' == responce.order.toString());

						if ( dtGlobals.isPhone ) {
							isIsotope = false;
						}

						if ( responce.newNonce ) {
							dtLocal.ajaxNonce = responce.newNonce;
						}

						if ( typeof responce.itemsToDelete != 'undefined' ) {
							itemsToDeleteLength = responce.itemsToDelete.length;
						}

						// if not mobile isotope with spare parts
						if ( isIsotope && itemsToDeleteLength > 0 ) {

							for( var i = 0; i < responce.itemsToDelete.length; i++ ) {
								trashItems.push('.wf-cell[data-post-id="' + responce.itemsToDelete[i] + '"]');
							}

							$isoContainer.isotope('remove', $isoContainer.find(trashItems.join(',')));

						// if mobile or not isotope and sender is filter or paginator
						} else if ( !isIsotope && ('filter' == settings.sender || 'paginator' == settings.sender) ) {

							$isoContainer.find('.wf-cell, article').remove();
						}

						if ( $responceItems.length > 0 ) {

							// append new items
							$isoContainer.append($responceItems);
							dtGlobals.ajaxContainerItems = $isoContainer.find('div.wf-cell').not('.animation-triggered');

							// for isotope - insert new elements
							if ( isIsotope ) {

								$(".preload-me", $isoContainer).heightHack();
								$(".slider-masonry, .slider-simple", $isoContainer).initSlider();

								$isoContainer.isotope('addItems', $responceItems);

								if ( 'media' != settings.contentType ) {
									$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
								} else {
									$isoContainer.isotope({ sortBy: 'original-order' });
								}

								$isoContainer.isotope("layout");

								if ( 'masonry' == settings.layout ) {
									$("> .iso-item", $isoContainer).showItems();
								} else if ( 'grid' == settings.layout ) {
									$("> .wf-cell", $isoContainer).showItems();
								}

								ajaxObj.init();

							// all other cases - append new elements
							} else {

								// mobile isotope filtering emulation
								if ( dtGlobals.isPhone && ('masonry' == settings.layout || 'grid' == settings.layout) ) {}

								$(".slider-masonry, .slider-simple", $isoContainer).initSlider();

								if ( 'jgrid' == settings.layout ) {
									$isoContainer.collagePlus(dtGlobals.jGrid);
								}

								ajaxObj.init();

							}

							if ( typeof settings.afterSuccessInit != 'undefined' ) {
								settings.afterSuccessInit( responce );
							}

							$window.trigger('dt.ajax.content.appended');

						} else if ( isIsotope ) {

							// if no responce items - reorder isotope
							$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
						}

					}

					if ( typeof settings.afterResponce != 'undefined' ) {
						settings.afterResponce( responce );
					}

					loadingEffects();
				}
			);
		},
		init : function() {
			switch ( this.settings.contentType ) {
				case 'portfolio' :
					this.initPortfolio();
					break;

				case 'albums' :
					this.initAlbums();
					break;

				case 'media' :
					this.initMedia();
					break;

				case 'blog':
					this.basicInit();
					break;
				 case 'testimonials':
					this.basicInit();
					break;
			}
		},
		initPortfolio : function() {
			this.basicInit();
		},
		initAlbums : function() {
			this.basicInit();
		},
		initMedia : function() {
			this.basicInit();

			$(".no-touch .albums .rollover-content, .no-touch .media .rollover-content").on("click", function(e){
				if ( $(e.target).is("a") ) {
					return true;
				}
				$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
			});

		},
		basicInit : function() {
			retinizer();

			var $container = this.settings.targetContainer;

			$('.dt-gallery-mfp-popup', $container).not('.mfp-ready').on('click', function(){
				var $this = $(this),
					$container = $this.parents('article.post');

				if ( $container.length > 0 ) {
					var $target = $container.find('.dt-gallery-container a.dt-mfp-item');

					if ( $target.length > 0 ) {
						$target.first().trigger('click');
					}
				}

				return false;
			}).addClass('mfp-ready');

			// trigger click on first a.dt-mfp-item in the container
			$('.dt-trigger-first-mfp', $container).not('.mfp-ready').on('click', function(){
				var $this = $(this),
					$container = $this.parents('article.post');

				if ( $container.length > 0 ) {
					var $target = $container.find('a.dt-mfp-item');

					if ( $target.length > 0 ) {
						$target.first().trigger('click');
					}
				}

				return false;
			}).addClass('mfp-ready');

			// single opup
			$('.dt-single-image', $container).not('.mfp-ready').magnificPopup({
				type: 'image'
			}).addClass('mfp-ready');

			$('.dt-single-video', $container).not('.mfp-ready').magnificPopup({
				type: 'iframe'
			}).addClass('mfp-ready');

			$('.dt-single-mfp-popup', $container).not('.mfp-ready').magnificPopup({
				type: 'image'
			}).addClass('mfp-ready');


			$(".dt-gallery-container", $container).not('.mfp-ready').each(function(){
				$(this).addClass('mfp-ready').magnificPopup( $.extend( {}, dtGlobals.magnificPopupBaseConfig, {
					delegate: 'a.dt-mfp-item',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					}
				}));
			});

			$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content", $container).addRollover();

			$('.no-touch .hover-grid .rollover-project').each( function() { $(this).hoverdir(); } );
			$('.no-touch .hover-grid-reverse .rollover-project ').each( function() { $(this).hoverdir({
				inverse : true
			}); } );
			$(".touch .rollover-project a.link.show-content, .hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
				e.preventDefault();
			});
			$(".rollover, .post-rollover, .rollover-video").clickEffectPics();
			$(".rollover.material-click-effect, .post-rollover.material-click-effect, .rollover-video.material-click-effect").clickMaterialEffect();

			if($(".small-portfolio-icons").length > 0){

				$('.links-container a').each(function(){
					var $this = $(this);
					$this.addClass("waves-effect");
				});
				Waves.displayEffect();
			}

			 $(".touch .rollover-project").touchNewHover();

			// $(".touch .links-container > a").touchHoverLinks();
			$(".no-touch .rollover-project:not(.rollover-active) .rollover-content, .no-touch .buttons-on-img:not(.rollover-active) .rollover-content").triggerHoverClick();

			$(".no-touch .rollover-project.forward-post").forwardToPost();

			$(".no-touch .rollover-project.rollover-active, .no-touch .buttons-on-img.rollover-active").followCurentLink();

			$(".albums .rollover-project, .albums .buttons-on-img").triggerAlbumsClick();
			$(".touch .rollover-project.forward-post").touchforwardToPost();

			 $(".touch .buttons-on-img").touchHoverImage();

			$(".hover-scale .rollover-project").scaleInHover();

			 $(".links-container a").hoverLinks();
			if($(".style-material-design").length > 0) {
				$('.links-container a, .paginator .page-nav a').each(function(){
					var $this = $(this);
					$this.addClass("waves-effect");
				});
				Waves.displayEffect();
			}

			if ( !dtGlobals.isMobile){
				$("img").loaded(null, function() {		
					$(".image-blur .rollover-project a:not(.hover-style-three .rollover-project a), .image-blur .rollover, .image-blur .rollover > div, .image-blur .post-rollover, .image-blur .rollover-video").blurImage();
				}, true);
			}
		}
	};

	// get ajax data
	function dtGetAjaxData( $parentContainer ) {
		var	$filtersContainer = $parentContainer.find('.filter.with-ajax').first(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax, .articles-list.with-ajax').first(),
			$currentCategory = $filtersContainer.find('.filter-categories a.act'),
			$currentOrderBy = $filtersContainer.find('.filter-by a.act'),
			$currentOrder = $filtersContainer.find('.filter-sorting a.act'),
			paged = parseInt($itemsContainer.attr('data-cur-page')),
			nonce = null,
			visibleItems = new Array(),
			term = ( $currentCategory.length > 0 ) ? $currentCategory.attr('data-filter').replace('.category-', '').replace('*', '') : '';

		if ( '0' == term ) {
			term = 'none';
		}

		if ( $itemsContainer.hasClass('dt-isotope') ) {

			$('.wf-cell', $itemsContainer).each( function(){
				visibleItems.push( $(this).attr('data-post-id') );
			});
		}

		return {
			visibleItems : visibleItems,
			postID : dtLocal.postID,
			paged : paged,
			term : term,
			orderBy : ( $currentOrderBy.length > 0 ) ? $currentOrderBy.attr('data-by') : '',
			order : ( $currentOrder.length > 0 ) ? $currentOrder.attr('data-sort') : '',
			ajaxurl : dtLocal.ajaxurl,
			nonce : dtLocal.ajaxNonce,
			pageData : dtLocal.pageData,
			layout : dtLocal.pageData.layout,
			targetContainer : $itemsContainer,
			isPhone : dtGlobals.isPhone
		}
	}

	// paginator
	$('#content').on('click', '.paginator.with-ajax a', function(e){
		e.preventDefault();

		//resetEffects();

		if ( $(e.target).hasClass('dots') || $(e.target).hasClass('disabled') ) {
			return;
		}

		var $this = $(this),
			$paginatorContainer = $this.closest('.paginator'),
			$parentContainer = $paginatorContainer.parent(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax, .articles-list.with-ajax').first(),

			$loadMoreButton = $(".button-load-more"),
			loadMoreButtonCaption = $loadMoreButton.find('.button-caption').text(),

			paginatorType = $paginatorContainer.hasClass('paginator-more-button') ? 'more' : 'paginator',
			isMore = ('more' == paginatorType),

			ajaxData = dtGetAjaxData($parentContainer),
			targetPage = isMore ? ajaxData.paged + 1 : $this.attr('data-page-num'),
			isoPreloaderExists = dtGlobals.isoPreloader;

		$loadMoreButton.addClass("animate-load").find('.button-caption').text(dtLocal.moreButtonText.loading);

		// show preloader
		if ( isoPreloaderExists && !$(".paginator-more-button").length ) {
			dtGlobals.isoPreloader.fadeIn(50);
		}

		if ( !isMore ) {
			var $scrollTo = $parentContainer.find('.filter.with-ajax').first(),
				paddingTop = 44;

			if (!$scrollTo.exists()) {
				$scrollTo = $itemsContainer;
				paddingTop = 50;
			}

			// scroll to top
			$("html, body").animate({
				scrollTop: $scrollTo.offset().top - $("#phantom").height() - paddingTop
			}, 400);
		}

		// lunch ajax
		dtAjaxing.lunch($.extend({}, ajaxData, {
			contentType : ajaxData.pageData.template,
			targetPage : targetPage,
			sender : paginatorType,
			visibleItems : isMore ? new Array() : ajaxData.visibleItems,
			afterResponce : function( responce ) {

				// we have paginator
				if ( $paginatorContainer.length > 0 ) {

					if ( responce.paginationHtml ) {

						// update paginator with responce content
						$paginatorContainer.html($(responce.paginationHtml).html()).show();
						if($(".filter-style-material").length > 0){
							$(".paginator .page-links a").each(function(){
								var $this = $(this);
								$this.addClass("ripple");
							});
							$( '.page-links a.ripple' ).ripple();

							$('.paginator .page-nav a').each(function(){
								var $this = $(this);
								$this.addClass("waves-effect");
							});
							Waves.displayEffect();
						}

					} else {

						if ( false && isMore ) {
							$paginatorContainer.html('<span class="loading-ready">' + dtLocal.moreButtonAllLoadedText + '</span>');
						} else {
							// clear paginator and hide it
							$paginatorContainer.html('').hide();
						}
					}
					setTimeout (function(){
						$(".button-load-more").removeClass("animate-load").find('.button-caption').text(loadMoreButtonCaption);
					}, 200);

				} else if ( responce.paginationHtml ) {

					// if there are no paginator on page but ajax responce have it
					$itemsContainer.parent().append($(responce.paginationHtml));
				}

				// add dots onclick event handler
				$paginatorContainer.find('.dots').on('click', function() {
					$paginatorContainer.find('div:hidden').show().find('a').unwrap();
					$(this).remove();
				});

				// update current page field
				$itemsContainer.attr('data-cur-page', responce.currentPage);

				// hide preloader
				dtGlobals.isoPreloader.stop().fadeOut(300);

				// update load more button
				dtGlobals.loadMoreButton = $(".button-load-more");
			}
		}));
	});

	// filter
	$('.filter.with-ajax .filter-categories a, .filter.with-ajax .filter-extras a').on('click', function(e){
		e.preventDefault();

		resetEffects();

		var $this = $(this),
			$filterContainer = $this.closest('.filter'),
			$parentContainer = $filterContainer.parent(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax').first(),
			$paginatorContainer = $parentContainer.find('.paginator').first(),

			ajaxData = dtGetAjaxData($parentContainer),
			isoPreloaderExists = dtGlobals.isoPreloader;

		// show preloader
		if ( isoPreloaderExists ) {
			dtGlobals.isoPreloader.fadeIn(50);
		}
		// lunch ajax
		dtAjaxing.lunch($.extend({}, ajaxData, {
			contentType : ajaxData.pageData.template,
			targetPage : 1,
			paged : 1,
			sender : 'filter',
			afterResponce : function( responce ) {

				// we have paginator
				if ( $paginatorContainer.length > 0 ) {

					if ( responce.paginationHtml ) {

						// update paginator with responce content
						$paginatorContainer.html($(responce.paginationHtml).html()).show();
					} else {

						// clear paginator and hide it
						$paginatorContainer.html('').hide();
					}

				} else if ( responce.paginationHtml ) {

					// if there are no paginator on page but ajax responce have it
					$itemsContainer.parent().append($(responce.paginationHtml));
				}

				// add dots onclick event handler
				$paginatorContainer.find('.dots').on('click', function() {
					$paginatorContainer.find('div:hidden').show().find('a').unwrap();
					$(this).remove();
				});

				// update current page field
				$itemsContainer.attr('data-cur-page', responce.currentPage);

				// hide preloader
				dtGlobals.isoPreloader.stop().fadeOut(300);

				// update load more button
				dtGlobals.loadMoreButton = $(".button-load-more");
			}
		}));
	});

	function lazyLoading() {
		if ( dtGlobals.loadMoreButton && dtGlobals.loadMoreButton.exists() ) {

			var buttonOffset = dtGlobals.loadMoreButton.offset();

			if ( buttonOffset && $window.scrollTop() > (buttonOffset.top - $window.height()) / 2 && !dtGlobals.loadMoreButton.hasClass('animate-load') ) {
				dtGlobals.loadMoreButton.trigger('click');
			}

		}
	}

	// lazy loading
	if ( typeof dtLocal.themeSettings.lazyLoading != 'undefined' && dtLocal.themeSettings.lazyLoading ) {

		dtGlobals.loadMoreButton = $(".button-load-more");
		var timer = null;
		$window.on('scroll', function () {
			lazyLoading();
		});
		lazyLoading();
	}

	// Prevent a backgroung rendering glitch in Webkit.
	if (!window.bgGlitchFixed && $.browser.webkit) {
		setTimeout(function(){
			$window.scrollTop($window.scrollTop() + 1);
			window.bgGlitchFixed = true;
		},10)
	}

	var waitForFinalEvent = (function () {
		var timers = {};
		return function (callback, ms, uniqueId) {
			if (!uniqueId) {
				uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
				clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		};
	})();
	
	// Usage
	$window.resize(function () {

		/*Animate iso-items on resize*/
		$(".iso-item, .iso-grid .wf-cell").addClass("animate-position");
		waitForFinalEvent(function(){
			$(".iso-item, .iso-grid .wf-cell").removeClass("animate-position");
		}, 2500, "");
	});

	var $isotope = $(".dt-isotope"),
		$isoFallback = $(".iso-item:not(.shown)"),
		$grid = $(".iso-grid .wf-cell:not(.shown)");

	if ($isotope.exists() || $isoFallback.exists() || $grid.exists()) {
		setTimeout(function () {
			loadingEffects();
		}, 100);

		$window.on("scroll", function() {
			loadingEffects();
		});
	};
// })


/* #Filter for posts shortcode
================================================== */
// jQuery(document).ready(function($) {
	var dtPostsJQueryFilter = {
		timeouts: {},

		init: function(settings) {
			this.config = {
				postsContainer: null,
				categoryContainer: null,
				paginatorContainer: null,
				curPage: 1,
				curCategory: '*',
				postsPerPage: -1,
				items: []
			};

			$.extend( this.config, settings );

			this._setPostsPerPage();
			this._setCategory();
			this._setCurPage();
			this._setItems();

			this.setup();
		},

		setup: function() {
			$('a', this.config.paginatorContainer).on('click.dtPostsPaginationFilter', {self: this}, this.paginationFilter);
			$('a', this.config.categoryContainer).on('click.dtPostsCategoryFilter', {self: this}, this.categoryFilter);

			this._getActiveElement(this.config.paginatorContainer).trigger('click.dtPostsPaginationFilter', { onSetup: true });
		},

		paginationFilter: function(event, onSetup) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setCurPage();

			if ( ! onSetup ) {
				self._scrollToTopOfContainer( self._filterPosts );
			} else {
				self._filterPosts();
			}
		},

		categoryFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setCategory();
			self._setAsActive(self.config.paginatorContainer.find('a').first());
			self._setCurPage();

			self._showPagination();
			self._filterPosts();
		},

		_showPagination: function() {
			if ( this.config.curCategory && '*' != this.config.curCategory ) {
				var itemsCount = this.config.postsContainer.find(this.config.curCategory).length;
				var maxPage = Math.ceil( itemsCount / this.config.postsPerPage );
				if ( maxPage == 1 ) {
					this.config.paginatorContainer.find('a').hide();
				} else {
					this.config.paginatorContainer.find('a').each(function(index) {
						var $this = $(this);
						if ( (index + 1) > maxPage ) {
							$this.hide();
						} else {
							$this.show();
						}
					});
				}
			} else {
				this.config.paginatorContainer.find('a').show();
			}
		},

		_filterPosts: function() {
			var self = this;

			// category filter emulation
			self.config.items.css("display", "none");

			var itemsCount = 0;
			self.config.items.filter(self.config.curCategory).each(function() {
				if ( self._showOnCurPage(++itemsCount) ) {
					$(this).css("display", "block");
				}
			});
		},

		_setPostsPerPage: function() {
			this.config.postsPerPage = parseInt( this.config.postsContainer.attr('data-posts-per-page') );
		},

		_setCategory: function() {
			this.config.curCategory = this._getActiveElement(this.config.categoryContainer).attr('data-filter') || this.config.curCategory;
		},

		_setCurPage: function(page) {
			this.config.curPage = page ? page : this._getActiveElement(this.config.paginatorContainer).attr('data-page-num');
		},

		_setItems: function() {
			this.config.items = $(".wf-cell", this.config.postsContainer);
		},

		_showOnCurPage: function(index) {
			return this.config.postsPerPage <= 0 || ( this.config.postsPerPage*(this.config.curPage - 1) < index && index <= this.config.postsPerPage*this.config.curPage );
		},

		_setAsActive: function(item) {
			item.addClass('act').siblings().removeClass('act');
		},

		_getActiveElement: function(items) {
			return items.find('a.act').first();
		},

		_isActive: function(item) {
			return item.hasClass('act');
		},

		_scrollToTopOfContainer: function(onComplite) {
			var scrollTo = this.config.postsContainer.parent();

			$("html, body").animate({
				scrollTop: scrollTo.offset().top - $("#phantom").height() - 50
			}, 400, onComplite ? onComplite.bind(this) : undefined);
		},

		_setTimeout: function(id, handler, time) {
			var self = this;

			if ( ! id ) {
				handler.bind(self);
			}

			if ( this.timeouts[id] ) {
				window.clearTimeout( this.timeouts[id] );
			}

			this.timeouts[id] = window.setTimeout(handler.bind(self), time);
		}
	};

	var dtPostsIsotopeFilter = $.extend({}, dtPostsJQueryFilter, {
		init: function(settings) {
			this.config = {
				postsContainer: null,
				categoryContainer: null,
				orderByContainer: null,
				orderContainer: null,
				paginatorContainer: null,
				curPage: 1,
				curCategory: '*',
				initialOrder: '',
				order: '',
				orderBy: '',
				postsPerPage: -1,
				items: [],
				isPhone: false
			};

			$.extend( this.config, settings );

			this._setPostsPerPage();
			this._setCategory();
			this._setOrderBy();
			this._setOrder();
			this._setCurPage();
			this._setItems();

			this.config.initialOrder = this.config.order;

			this.setup();
		},

		setup: function() {
			$('a', this.config.paginatorContainer).on('click.dtPostsPaginationFilter', {self: this}, this.paginationFilter);
			$('a', this.config.categoryContainer).on('click.dtPostsCategoryFilter', {self: this}, this.categoryFilter);
			$('a', this.config.orderContainer).on('click.dtPostsOrderFilter', {self: this}, this.orderFilter);
			$('a', this.config.orderByContainer).on('click.dtPostsOrderByFilter', {self: this}, this.orderByFilter);

			this._getActiveElement(this.config.paginatorContainer).trigger('click.dtPostsPaginationFilter', { onSetup: true });
		},

		orderFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setOrder();
			self._filterPosts();
		},

		orderByFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setOrderBy();
			self._filterPosts();
		},

		_filterPosts: function() {
			var self = this;

			if ( self.config.isPhone ) {

				// category filter emulation
				self.config.items.css("display", "none");

				var itemsCount = 0;
				self.config.items.filter(self.config.curCategory).each(function() {
					if ( self._showOnCurPage(++itemsCount) ) {
						$(this).css("display", "block");
					}
				});

			} else {
				self.config.postsContainer.isotope({ filter: self.config.curCategory, sortAscending: 'asc' == self.config.order, sortBy: self.config.orderBy });

				if ( self.config.curPage ) {
					self._filterByCurPage();
				}
			}
		},

		_filterByCurPage: function() {
			var items = this.config.items.slice(0);
			if ( this.config.initialOrder && this.config.initialOrder != this.config.order ) {
				items.reverse();
			}

			var itemsCount = 0;
			items.map(function(item) {
				if ( ! item.isHidden && ! this._showOnCurPage(++itemsCount) ) {
					item.hide();
				}
			}, this);

			this.config.postsContainer.isotope('layout');
		},

		_setOrderBy: function() {
			this.config.orderBy = this._getActiveElement(this.config.orderByContainer).attr('data-by');
		},

		_setOrder: function() {
			this.config.order = this._getActiveElement(this.config.orderContainer).attr('data-sort');
		},

		_setItems: function() {
			if ( this.config.isPhone ) {
				this.config.items = $(".iso-item, .wf-cell", this.config.postsContainer);
			} else {
				this.config.items = this.config.postsContainer.isotope('getItemElements').map(function(item) { return this.config.postsContainer.isotope('getItem', item); }, this);
			}
		}
	});

	var dtPostsJGridFilter = $.extend({}, dtPostsJQueryFilter, {
		_filterPosts: function() {
			var self = this;

			// category filter emulation
			self.config.items.css("display", "none");

			var itemsCount = 0;
			var visibleItems = [];
			self.config.items.filter(self.config.curCategory).each(function() {
				if ( self._showOnCurPage( ++itemsCount ) ) {
					$(this).css("display", "block");
					visibleItems.push( this );
				}
			});

			visibleItems = $(visibleItems);
			self.config.postsContainer.data('visibleItems', visibleItems);
			self.config.postsContainer.collage({ images: visibleItems });
		},

		_setItems: function() {
			this.config.items = $(".wf-cell", this.config.postsContainer);
		}
	});

	$('.dt-shortcode.with-isotope').each(function() {
		var $this = $(this);
		var $container = $this.find('.wf-container');
		var filterConfig = {
			postsContainer: $container,
			categoryContainer: $this.find('.filter-categories'),
			paginatorContainer: $this.find('.iso-paginator')
		};

		if ( $container.hasClass('dt-isotope') ) {
			var postsFilter = Object.create(dtPostsIsotopeFilter);
			$.extend(filterConfig, {
				orderByContainer: $this.find('.filter-extras .filter-by'),
				orderContainer: $this.find('.filter-extras .filter-sorting'),
				isPhone: dtGlobals.isPhone
			});
		} else {
			var postsFilter = Object.create(dtPostsJGridFilter);
		}

		postsFilter.init(filterConfig);
	});
})



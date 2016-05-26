/*! modernizr 3.3.1 (Custom Build) | MIT *
 * http://modernizr.com/download/?-cssanimations-cssfilters-csstransforms-csstransforms3d-csstransitions-forcetouch-touchevents-domprefixes-mq-prefixed-prefixes-setclasses-shiv-testallprops-testprop-teststyles !*/
!function(e,t,n){function r(e,t){return typeof e===t}function o(){var e,t,n,o,i,a,s;for(var u in C)if(C.hasOwnProperty(u)){if(e=[],t=C[u],t.name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(n=0;n<t.options.aliases.length;n++)e.push(t.options.aliases[n].toLowerCase());for(o=r(t.fn,"function")?t.fn():t.fn,i=0;i<e.length;i++)a=e[i],s=a.split("."),1===s.length?Modernizr[s[0]]=o:(!Modernizr[s[0]]||Modernizr[s[0]]instanceof Boolean||(Modernizr[s[0]]=new Boolean(Modernizr[s[0]])),Modernizr[s[0]][s[1]]=o),y.push((o?"":"no-")+s.join("-"))}}function i(e){var t=b.className,n=Modernizr._config.classPrefix||"";if(x&&(t=t.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");t=t.replace(r,"$1"+n+"js$2")}Modernizr._config.enableClasses&&(t+=" "+n+e.join(" "+n),x?b.className.baseVal=t:b.className=t)}function a(e){return e.replace(/([a-z])-([a-z])/g,function(e,t,n){return t+n.toUpperCase()}).replace(/^-/,"")}function s(){return"function"!=typeof t.createElement?t.createElement(arguments[0]):x?t.createElementNS.call(t,"http://www.w3.org/2000/svg",arguments[0]):t.createElement.apply(t,arguments)}function u(){var e=t.body;return e||(e=s(x?"svg":"body"),e.fake=!0),e}function l(e,n,r,o){var i,a,l,c,f="modernizr",d=s("div"),p=u();if(parseInt(r,10))for(;r--;)l=s("div"),l.id=o?o[r]:f+(r+1),d.appendChild(l);return i=s("style"),i.type="text/css",i.id="s"+f,(p.fake?p:d).appendChild(i),p.appendChild(d),i.styleSheet?i.styleSheet.cssText=e:i.appendChild(t.createTextNode(e)),d.id=f,p.fake&&(p.style.background="",p.style.overflow="hidden",c=b.style.overflow,b.style.overflow="hidden",b.appendChild(p)),a=n(d,e),p.fake?(p.parentNode.removeChild(p),b.style.overflow=c,b.offsetHeight):d.parentNode.removeChild(d),!!a}function c(e,t){return!!~(""+e).indexOf(t)}function f(e,t){return function(){return e.apply(t,arguments)}}function d(e,t,n){var o;for(var i in e)if(e[i]in t)return n===!1?e[i]:(o=t[e[i]],r(o,"function")?f(o,n||t):o);return!1}function p(e){return e.replace(/([A-Z])/g,function(e,t){return"-"+t.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(t,r){var o=t.length;if("CSS"in e&&"supports"in e.CSS){for(;o--;)if(e.CSS.supports(p(t[o]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var i=[];o--;)i.push("("+p(t[o])+":"+r+")");return i=i.join(" or "),l("@supports ("+i+") { #modernizr { position: absolute; } }",function(e){return"absolute"==getComputedStyle(e,null).position})}return n}function h(e,t,o,i){function u(){f&&(delete P.style,delete P.modElem)}if(i=r(i,"undefined")?!1:i,!r(o,"undefined")){var l=m(e,o);if(!r(l,"undefined"))return l}for(var f,d,p,h,v,g=["modernizr","tspan"];!P.style;)f=!0,P.modElem=s(g.shift()),P.style=P.modElem.style;for(p=e.length,d=0;p>d;d++)if(h=e[d],v=P.style[h],c(h,"-")&&(h=a(h)),P.style[h]!==n){if(i||r(o,"undefined"))return u(),"pfx"==t?h:!0;try{P.style[h]=o}catch(y){}if(P.style[h]!=v)return u(),"pfx"==t?h:!0}return u(),!1}function v(e,t,n,o,i){var a=e.charAt(0).toUpperCase()+e.slice(1),s=(e+" "+k.join(a+" ")+a).split(" ");return r(t,"string")||r(t,"undefined")?h(s,t,o,i):(s=(e+" "+w.join(a+" ")+a).split(" "),d(s,t,n))}function g(e,t,r){return v(e,n,n,t,r)}var y=[],C=[],E={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout(function(){t(n[e])},0)},addTest:function(e,t,n){C.push({name:e,fn:t,options:n})},addAsyncTest:function(e){C.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=E,Modernizr=new Modernizr;var S=E._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];E._prefixes=S;var b=t.documentElement,x="svg"===b.nodeName.toLowerCase();x||!function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=C.elements;return"string"==typeof e?e.split(" "):e}function o(e,t){var n=C.elements;"string"!=typeof n&&(n=n.join(" ")),"string"!=typeof e&&(e=e.join(" ")),C.elements=n+" "+e,l(t)}function i(e){var t=y[e[v]];return t||(t={},g++,e[v]=g,y[g]=t),t}function a(e,n,r){if(n||(n=t),f)return n.createElement(e);r||(r=i(n));var o;return o=r.cache[e]?r.cache[e].cloneNode():h.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!o.canHaveChildren||m.test(e)||o.tagUrn?o:r.frag.appendChild(o)}function s(e,n){if(e||(e=t),f)return e.createDocumentFragment();n=n||i(e);for(var o=n.frag.cloneNode(),a=0,s=r(),u=s.length;u>a;a++)o.createElement(s[a]);return o}function u(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return C.shivMethods?a(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/[\w\-:]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(C,t.frag)}function l(e){e||(e=t);var r=i(e);return!C.shivCSS||c||r.hasCSS||(r.hasCSS=!!n(e,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),f||u(e,r),e}var c,f,d="3.7.3",p=e.html5||{},m=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,h=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,v="_html5shiv",g=0,y={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",c="hidden"in e,f=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){c=!0,f=!0}}();var C={elements:p.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:d,shivCSS:p.shivCSS!==!1,supportsUnknownElements:f,shivMethods:p.shivMethods!==!1,type:"default",shivDocument:l,createElement:a,createDocumentFragment:s,addElements:o};e.html5=C,l(t),"object"==typeof module&&module.exports&&(module.exports=C)}("undefined"!=typeof e?e:this,t);var _="Moz O ms Webkit",w=E._config.usePrefixes?_.toLowerCase().split(" "):[];E._domPrefixes=w;var T=function(){function e(e,t){var o;return e?(t&&"string"!=typeof t||(t=s(t||"div")),e="on"+e,o=e in t,!o&&r&&(t.setAttribute||(t=s("div")),t.setAttribute(e,""),o="function"==typeof t[e],t[e]!==n&&(t[e]=n),t.removeAttribute(e)),o):!1}var r=!("onblur"in t.documentElement);return e}();E.hasEvent=T;var N="CSS"in e&&"supports"in e.CSS,z="supportsCSS"in e;Modernizr.addTest("supports",N||z);var M=function(){var t=e.matchMedia||e.msMatchMedia;return t?function(e){var n=t(e);return n&&n.matches||!1}:function(t){var n=!1;return l("@media "+t+" { #modernizr { position: absolute; } }",function(t){n="absolute"==(e.getComputedStyle?e.getComputedStyle(t,null):t.currentStyle).position}),n}}();E.mq=M;var j=E.testStyles=l,k=E._config.usePrefixes?_.split(" "):[];E._cssomPrefixes=k;var F=function(t){var r,o=S.length,i=e.CSSRule;if("undefined"==typeof i)return n;if(!t)return!1;if(t=t.replace(/^@/,""),r=t.replace(/-/g,"_").toUpperCase()+"_RULE",r in i)return"@"+t;for(var a=0;o>a;a++){var s=S[a],u=s.toUpperCase()+"_"+r;if(u in i)return"@-"+s.toLowerCase()+"-"+t}return!1};E.atRule=F;var O={elem:s("modernizr")};Modernizr._q.push(function(){delete O.elem});var P={style:O.elem.style};Modernizr._q.unshift(function(){delete P.style});E.testProp=function(e,t,r){return h([e],n,t,r)};E.testAllProps=v;var A=E.prefixed=function(e,t,n){return 0===e.indexOf("@")?F(e):(-1!=e.indexOf("-")&&(e=a(e)),t?v(e,t,n):v(e,"pfx"))};Modernizr.addTest("forcetouch",function(){return T(A("mouseforcewillbegin",e,!1),e)?MouseEvent.WEBKIT_FORCE_AT_MOUSE_DOWN&&MouseEvent.WEBKIT_FORCE_AT_FORCE_MOUSE_DOWN:!1}),E.testAllProps=g,Modernizr.addTest("cssanimations",g("animationName","a",!0)),Modernizr.addTest("cssfilters",function(){if(Modernizr.supports)return g("filter","blur(2px)");var e=s("a");return e.style.cssText=S.join("filter:blur(2px); "),!!e.style.length&&(t.documentMode===n||t.documentMode>9)}),Modernizr.addTest("csstransforms",function(){return-1===navigator.userAgent.indexOf("Android 2.")&&g("transform","scale(1)",!0)}),Modernizr.addTest("csstransforms3d",function(){var e=!!g("perspective","1px",!0),t=Modernizr._config.usePrefixes;if(e&&(!t||"webkitPerspective"in b.style)){var n,r="#modernizr{width:0;height:0}";Modernizr.supports?n="@supports (perspective: 1px)":(n="@media (transform-3d)",t&&(n+=",(-webkit-transform-3d)")),n+="{#modernizr{width:7px;height:18px;margin:0;padding:0;border:0}}",j(r+n,function(t){e=7===t.offsetWidth&&18===t.offsetHeight})}return e}),Modernizr.addTest("csstransitions",g("transition","all",!0)),Modernizr.addTest("touchevents",function(){var n;if("ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch)n=!0;else{var r=["@media (",S.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");j(r,function(e){n=9===e.offsetTop})}return n}),o(),i(y),delete E.addTest,delete E.addAsyncTest;for(var D=0;D<Modernizr._q.length;D++)Modernizr._q[D]();e.Modernizr=Modernizr}(window,document);


var dtGlobals = {};

dtGlobals.isMobile	= (/(Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|windows phone)/.test(navigator.userAgent));
dtGlobals.isAndroid	= (/(Android)/.test(navigator.userAgent));
dtGlobals.isiOS		= (/(iPhone|iPod|iPad)/.test(navigator.userAgent));
dtGlobals.isiPhone	= (/(iPhone|iPod)/.test(navigator.userAgent));
dtGlobals.isiPad	= (/(iPad)/.test(navigator.userAgent));
dtGlobals.isBuggy	= (navigator.userAgent.match(/AppleWebKit/) && typeof window.ontouchstart === 'undefined' && ! navigator.userAgent.match(/Chrome/));
dtGlobals.winScrollTop = 0;
window.onscroll = function() {
	dtGlobals.winScrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
};

dtGlobals.isWindowsPhone = navigator.userAgent.match(/IEMobile/i);

dtGlobals.customColor = 'red';
if (dtGlobals.isMobile) { 
	document.documentElement.className += " mobile-true";
} else {
	document.documentElement.className += " mobile-false";
};

dtGlobals.logoURL = false;
dtGlobals.logoH = false;
dtGlobals.logoW = false;

jQuery(document).ready(function($) {

	var $document = $(document),
		$window = $(window),
		$html = $("html"),
		$body = $("body");

	// iOS sniffing.
	if (dtGlobals.isiOS) {
		$html.addClass("is-iOS");
	}
	else {
		$html.addClass("not-iOS");
	};

	// Detect webkit browser
	if ( !$.browser.webkit || dtGlobals.isMobile ){
		$body.addClass("not-webkit").removeClass("is-webkit");
	}else{
		$body.removeClass("not-webkit").addClass("is-webkit");
	};
	//Detect ms = 10 browser
	if (jQuery.browser.msie && jQuery.browser.version == 10) {
	    $body.addClass("ie-10");
	}
	  
	/*--Detect safari browser*/
	$.browser.safari = ($.browser.webkit && !(/chrome/.test(navigator.userAgent.toLowerCase())));
	if ($.browser.safari) {
		$body.addClass("is-safari");
	};

	// windows-phone sniffing
	if (dtGlobals.isWindowsPhone){
		$body.addClass("ie-mobile").addClass("windows-phone");
	};
	// if not mobile device
	if(!dtGlobals.isMobile){
		$body.addClass("no-mobile");
	};
	// iphone
	if(dtGlobals.isiPhone){
		$body.addClass("is-iphone");
	};


	if(!$("html").hasClass("old-ie")){
		dtGlobals.isPhone = false;
		dtGlobals.isTablet = false;
		dtGlobals.isDesktop = false;

		var size = window.getComputedStyle(document.body,":after").getPropertyValue("content");

		if (size.indexOf("phone") !=-1 && dtGlobals.isMobile) {
			dtGlobals.isPhone = true;
		} 
		else if (size.indexOf("tablet") !=-1 && dtGlobals.isMobile) {
			dtGlobals.isTablet = true;
		}
		else {
			dtGlobals.isDesktop = true;
		};

	};

	/*--old ie remove csstransforms3d*/
	if ($.browser.msie) $("html").removeClass("csstransforms3d");

	var dtResizeTimeout;
	if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
		$(window).bind("orientationchange", function(event) {
			/*$(window).on("resize", function() {*/
				clearTimeout(dtResizeTimeout);
				dtResizeTimeout = setTimeout(function() {
					$(window).trigger( "debouncedresize" );
				}, 200);
			/*});*/
		});
	}else{
		$(window).on("resize", function() {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$(window).trigger( "debouncedresize" );
			}, 200);
		});
	}
});
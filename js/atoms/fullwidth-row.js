
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
					$_this.find(".full-width-wrap").css({
						width: "",
						"margin-left": "",
						"opacity": 1,
						"padding-left": $offset_fs
					});
					$_this.find(".ts-wrap").each(function(){
						var scroller = $(this).data("thePhotoSlider");
						if(typeof scroller!= "undefined"){
							scroller.update();
						};
					});
					
			});
		};
	};

	if( $(".full-width-wrap").length > 0 ){
		if(dtGlobals.isiOS){
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
	//Rewrite vc functions for row behavior (fix issue with vc full-with row and box layout/side header)
	window.vc_rowBehaviour = function() {
	    function fullWidthRow() {
	        var $elements = $('[data-vc-full-width="true"]');
	        $.each($elements, function(key, item) {
	            var $el = $(this);
	            $el.addClass("vc_hidden");
	            var $el_full = $el.next(".vc_row-full-width");
	            $el_full.length || ($el_full = $el.parent().next(".vc_row-full-width"));
	            var el_margin_left = parseInt($el.css("margin-left"), 10)
	              , el_margin_right = parseInt($el.css("margin-right"), 10)
	              , offset = 0 - $el_full.offset().left - el_margin_left
	              , width = $(window).width();


	             var 
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
					var offset = 0 - $offset_fs - el_margin_left


	            if ($el.css({
	                position: "relative",
	                left: offset,
	                "box-sizing": "border-box",
	                width: $width_fs
	            }),
	            !$el.data("vcStretchContent")) {
	                var padding = -1 * offset;
	                0 > padding && (padding = 0);
	                var paddingRight = $width_fs - padding - $el_full.width() + el_margin_left + el_margin_right;
	                0 > paddingRight && (paddingRight = 0),
	                $el.css({
	                    "padding-left": padding + "px",
	                    "padding-right": paddingRight + "px"
	                })
	            }
	            $el.attr("data-vc-full-width-init", "true"),
	            $el.removeClass("vc_hidden")
	        })
	    }
	   
	    function parallaxRow() {
	        var vcSkrollrOptions, callSkrollInit = !1;
	        return window.vcParallaxSkroll && window.vcParallaxSkroll.destroy(),
	        $(".vc_parallax-inner").remove(),
	        $("[data-5p-top-bottom]").removeAttr("data-5p-top-bottom data-30p-top-bottom"),
	        $("[data-vc-parallax]").each(function() {
	            var skrollrSpeed, skrollrSize, skrollrStart, skrollrEnd, $parallaxElement, parallaxImage, youtubeId;
	            callSkrollInit = !0,
	            "on" === $(this).data("vcParallaxOFade") && $(this).children().attr("data-5p-top-bottom", "opacity:0;").attr("data-30p-top-bottom", "opacity:1;"),
	            skrollrSize = 100 * $(this).data("vcParallax"),
	            $parallaxElement = $("<div />").addClass("vc_parallax-inner").appendTo($(this)),
	            $parallaxElement.height(skrollrSize + "%"),
	            parallaxImage = $(this).data("vcParallaxImage"),
	            youtubeId = vcExtractYoutubeId(parallaxImage),
	            youtubeId ? insertYoutubeVideoAsBackground($parallaxElement, youtubeId) : "undefined" != typeof parallaxImage && $parallaxElement.css("background-image", "url(" + parallaxImage + ")"),
	            skrollrSpeed = skrollrSize - 100,
	            skrollrStart = -skrollrSpeed,
	            skrollrEnd = 0,
	            $parallaxElement.attr("data-bottom-top", "top: " + skrollrStart + "%;").attr("data-top-bottom", "top: " + skrollrEnd + "%;")
	        }),
	        callSkrollInit && window.skrollr ? (vcSkrollrOptions = {
	            forceHeight: !1,
	            smoothScrolling: !1,
	            mobileCheck: function() {
	                return !1
	            }
	        },
	        window.vcParallaxSkroll = skrollr.init(vcSkrollrOptions),
	        window.vcParallaxSkroll) : !1
	    }
	    function fullHeightRow() {
	        $(".vc_row-o-full-height:first").each(function() {
	            var $window, windowHeight, offsetTop, fullHeight;
	            $window = $(window),
	            windowHeight = $window.height(),
	            offsetTop = $(this).offset().top,
	            windowHeight > offsetTop && (fullHeight = 100 - offsetTop / (windowHeight / 100),
	            $(this).css("min-height", fullHeight + "vh"))
	        })
	    }
	    function fixIeFlexbox() {
	        var ua = window.navigator.userAgent
	          , msie = ua.indexOf("MSIE ");
	        (msie > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) && $(".vc_row-o-full-height").each(function() {
	            "flex" === $(this).css("display") && $(this).wrap('<div class="vc_ie-flexbox-fixer"></div>')
	        })
	    }
	    var $ = window.jQuery;
	    $(window).off("resize.vcRowBehaviour").on("resize.vcRowBehaviour", fullWidthRow).on("resize.vcRowBehaviour", fullHeightRow),
	    fullWidthRow(),
	    fullHeightRow(),
	    fixIeFlexbox(),
	    vc_initVideoBackgrounds(),
	    parallaxRow()

	}
	 // vc_rowBehaviour()
// })
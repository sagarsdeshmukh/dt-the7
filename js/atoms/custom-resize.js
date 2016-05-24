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

$window.trigger("dt.removeLoading");
/* #Misc
================================================== */

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
		$(".shopping-cart.show-sub-cart").find(".buttons").first().clone(true).addClass("top-position").insertBefore(".shopping-cart-inner .cart_list");
		$(".shopping-cart.show-sub-cart").each(function(){
			var $this = $(this),
				$dropCart = $this.children('.shopping-cart-wrap');

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
				if ($page.width() - ($dropCart.offset().left - $page.offset().left) - $dropCart.width() < 0) {
					$dropCart.addClass("right-overflow");
				};
				/*Bottom overflow menu*/
				if ($window.height() - ($dropCart.offset().top - dtGlobals.winScrollTop) - $dropCart.innerHeight() < 0) {
					$dropCart.addClass("bottom-overflow");
				};
				if($this.parents(".dt-mobile-header").length > 0) {
					$dropCart.css({
						top: $this.position().top - 13 - $dropCart.height()
					});
				};
				/*move button to top if cart height is bigger then window*/
				if ($dropCart.height()  > ($window.height() - $dropCart.position().top)) {
					$dropCart.addClass("show-top-buttons");
				};

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
						$dropCart.stop().css("visibility", "visible").animate({
							"opacity": 1
						}, 150);
					}
				}, 100);
			});

			$this.on("mouseleave", function(e) {
				var $this = $(this),
				$dropCart = $this.children('.shopping-cart-wrap');
				$this.removeClass("dt-hovered");

				clearTimeout(cartTimeoutShow);
				clearTimeout(cartTimeoutHide);

				cartTimeoutHide = setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						$dropCart.stop().animate({
							"opacity": 0
						}, 150, function() {
							$(this).css("visibility", "hidden");
						});
						setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								$dropCart.removeClass("right-overflow");
								$dropCart.removeClass("bottom-overflow");
								/*move button to top if cart height is bigger then window*/
								
								$dropCart.removeClass("show-top-buttons");
								
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

		// /* !-Smart benefits & logos resize */
		// $.fn.smartGrid = function() {
		// 	return this.each(function() {
		// 		var $this = $(this),
		// 			colNum = parseInt($this.attr("data-columns")),
		// 			colMinWidth = parseInt($this.attr("data-width")),
		// 			contWidth = $this.width();

		// 		for ( ; Math.floor(contWidth/colNum) < colMinWidth; ) {
		// 			colNum--;
		// 			if (colNum <= 1) break;
		// 		}

		// 		$("> .wf-cell", $this).css({
		// 			width: (100/colNum).toFixed(6) + "%",
		// 			display: "inline-block"
		// 		});
		// 	});
		// };

		// var $benLogColl = $(".benefits-grid, .logos-grid");
		// $benLogColl.smartGrid();
		// $window.on("debouncedresize", function () {
		// 	$benLogColl.smartGrid();
		// });

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


		// /*!Instagram style photos*/

		// $.fn.calcPics = function() {
		// 		var $collection = $(".instagram-photos");
		// 		if ($collection.length < 1) return false;

		// 		return this.each(function() {
		// 			var maxitemwidth = maxitemwidth ? maxitemwidth : parseInt($(this).attr("data-image-max-width")),
		// 				itemmarg = parseInt($(this).find("> a").css("margin-left"));
		// 			$(this).find(" > a").css({
		// 				"max-width": maxitemwidth,
		// 				"opacity": 1
		// 			});

		// 			// Cahce everything
		// 			var $container = $(this),
		// 				containerwidth = $container.width(),
		// 				itemperc = (100/(Math.ceil(containerwidth/maxitemwidth)));
				
		// 			$container.find("a").css({ "width": itemperc+'%' });
		// 	});
		// };
		// $(".instagram-photos").calcPics();

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
		$(".project-share-overlay.allways-visible-icons .share-button").on("click", function(e){
			e.preventDefault();
		});
		//Solve multiple window.onload conflict
		function addOnloadEvent(fnc){
		  if ( typeof window.addEventListener != "undefined" )
		    window.addEventListener( "load", fnc, false );
		  else if ( typeof window.attachEvent != "undefined" ) {
		    window.attachEvent( "onload", fnc );
		  }
		  else {
		    if ( window.onload != null ) {
		      var oldOnload = window.onload;
		      window.onload = function ( e ) {
		        oldOnload( e );
		        window[fnc]();
		      };
		    }
		    else 
		      window.onload = fnc;
		  }
		}
		function showShareBut() {
			$(".album-share-overlay, .project-share-overlay:not(.allways-visible-icons)").each(function(){
				var $this = $(this);
				$this.find(".share-button").on("click", function(e){
					e.preventDefault();
				});

				$this.on("mouseover tap", function(e) {
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
		};
		addOnloadEvent(function(){ showShareBut() });

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
									translateY : dtGlobals.winScrollTop - offset.top + $phantom.height() + 5 - topBarH
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
	$("<select />").prependTo("#bottom-bar .mini-nav .menu-select");

	// Create default option "Select"
	$("<option />", {
		"selected"  :  "selected",
		"value"     :  "",
		"text"      :  "———"
	}).appendTo(".mini-nav .menu-select select");

	// Populate dropdown with menu items
	$("#bottom-bar .mini-nav").each(function() {
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
	$('.woocommerce.widget_layered_nav select, .woocommerce-ordering-div select, #bottom-bar .mini-nav select, .widget_product_categories select').each(function(){
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
	// if (!window.bgGlitchFixed && $.browser.webkit) {
	// 	setTimeout(function(){
	// 		$window.scrollTop(dtGlobals.winScrollTop + 1);
	// 		window.bgGlitchFixed = true;
	// 	},10)
	// }

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
		//setTimeout(function(){
			/*!-parallax initialisation*/
			$('.stripe-parallax-bg, .fancy-parallax-bg, .page-title-parallax-bg').each(function(){
				var $_this = $(this),
					speed_prl = $_this.data("prlx-speed");
				$_this.parallax("50%", speed_prl);
				$_this.addClass("parallax-bg-done");
				$_this.css("opacity", "1")
			});
		//}, 600)
	
		// $('.fancy-parallax-bg, .page-title-parallax-bg, .stripe-parallax-bg').each(function(){
		// 		var $_this = $(this),
		// 			speed_prl = $_this.data("prlx-speed");
		// 	$_this.jarallax({
		// 	  // parallax effect speed. 0.0 - 1.0

		// 	  speed             : speed_prl,

		// 	  // path to your parallax image
		// 	  imgSrc            : null,

		// 	  // width & height of your parallax image
		// 	  imgWidth          : null,
		// 	  imgHeight         : null,

		// 	  // enable transformations for effect if supported. 
		// 	  enableTransform   : true,

		// 	  // z-index of parallax container.
		// 	  zIndex            : 0
		// 	});
		// 	setTimeout(function(){
		// 		$_this.css("opacity", "1")
		// 	}, 300)
		// })
	
		


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

		$("video.stripe-video-bg:in-viewport").each(function() {
			var $thisPar = $(this).parent(".stripe"),
				$video = $thisPar.find("video");

			if ( $video.length > 0 ) {
				$video.get(0).play();
			}
		});
		$window.on("scroll", function () {
			if($("video.stripe-video-bg").length > 0){
				$("video.stripe-video-bg").each(function(){
					//var stripeVideo = $("video.stripe-video-bg");
					// stripeVideo.each(function() {
						var $video = $(this);

						//if ( $video.length > 0 ) {

						if ( $video.is(':in-viewport') ) {

							$video.get(0).play();
						} else {

							$video.get(0).pause();
						}
						//}
					//});
				})
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
		};

		/*Adding class if footer is empty*/
		if(!$(".footer .widget").length > 0) {
			$(".footer").addClass("empty-footer");
		};





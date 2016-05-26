
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
		$page.removeClass("show-header");
		$page.addClass("closed-header");
		$body.removeClass("show-sticky-header");
		//$(".mobile-sticky-header-overlay, .dt-mobile-menu-icon, .menu-toggle").removeClass("active");
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
	$.closeMobileHeader = function(){
		$page.removeClass("show-mobile-header");
		$page.addClass("closed-mobile-header");
		$body.removeClass("show-sticky-mobile-header show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
		$(".mobile-sticky-header-overlay, .dt-mobile-menu-icon, .menu-toggle").removeClass("active");
		//$(".sticky-header-overlay").removeClass("active");
		
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
	if($sideHeader.length > 0){
		if(!$(".mCSB_container").length > 0){
			$(".side-header .header-scrollbar-wrap .header-bar").wrap("<div class='mCSB_container'></div>");
		}
	}

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



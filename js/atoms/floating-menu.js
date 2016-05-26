
/* #Floating menu
================================================== */
// jQuery(document).ready(function($) {
	
	/*--Set variable for floating menu*/
	if (dtGlobals.isMobile && !dtGlobals.isiPad) dtLocal.themeSettings.floatingHeader.showMenu = false;
	
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
				if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
					if (logoURL == undefined) {

						//$('<img class="sticky-logo" src="'+dtLocal.themeSettings.floatingHeader.logo.src+'" height="'+dtLocal.themeSettings.floatingHeader.logo.h+'" width="'+dtLocal.themeSettings.floatingHeader.logo.w+'">').prependTo($stickyLogo);
						$(dtLocal.themeSettings.floatingHeader.logo.html).addClass("sticky-logo").prependTo($stickyLogo)
					}
					else {
						//$('<a class="sticky-logo" href="'+logoURL+'"><img src="'+dtLocal.themeSettings.floatingHeader.logo.src+'" height="'+dtLocal.themeSettings.floatingHeader.logo.h+'" width="'+dtLocal.themeSettings.floatingHeader.logo.w+'"></a>').prependTo($stickyLogo);
						$('<a class="sticky-logo" href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>').prependTo($stickyLogo);
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

		if ((dtLocal.themeSettings.floatingHeader.showMenu && !(sideHeaderExists && !phantomStickyExists)) || (dtLocal.themeSettings.floatingHeader.showMenu && (sideHeaderHStrokeExists && !phantomStickyExists ))) {

			var phantomFadeExists = $(".phantom-fade").exists(),
				phantomSlideExists = $(".phantom-slide").exists(),
				splitHeaderExists = $(".split-header").exists(),
				$mainSlideshow = $("#main-slideshow, .photo-scroller"),
				$mainHeader = $(".masthead:not(.side-header)");

			if( phantomFadeExists || phantomSlideExists) {

				var $headerMenu = $(".masthead:not(#phantom) .main-nav"),
					logoURL = $(".masthead:not(.side-header) .branding a").attr("href"),
					isMoved = false;

				if (sideHeaderHStrokeExists || splitHeaderExists) {
					var $headerTopLine = $(".side-header-h-stroke, .split-header"),
						headerClass = $headerTopLine.attr("class"),
						$headerMenu = $(".side-header-h-stroke .header-bar, .split-header .header-bar"),
						$parent = $headerMenu.parent(),
						$phantom = $('<div id="phantom" class="'+headerClass+'"><div class="ph-wrap"></div></div>').appendTo("body"),
						$menuBox = $phantom.find(".ph-wrap"),
						$widgetBox = $phantom.find(".widget-box"),
						$widget = $headerMenu.find(".mini-widgets"),
						$phantomLogo = $headerTopLine.find(".branding");

					/*Phantom logo*/

					if($(".phantom-custom-logo-on").length > 0){

						if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
							if (logoURL == undefined){
								//$('<img class="phantom-top-line-logo" src="'+dtLocal.themeSettings.floatingHeader.logo.src+'" height="'+dtLocal.themeSettings.floatingHeader.logo.h+'" width="'+dtLocal.themeSettings.floatingHeader.logo.w+'">').prependTo($phantomLogo);
								$(dtLocal.themeSettings.floatingHeader.logo.html).prependTo($phantomLogo)
							}
							else {
								//$('<a class="phantom-top-line-logo" href="'+logoURL+'"><img src="'+dtLocal.themeSettings.floatingHeader.logo.src+'" height="'+dtLocal.themeSettings.floatingHeader.logo.h+'" width="'+dtLocal.themeSettings.floatingHeader.logo.w+'"></a>').prependTo($phantomLogo);
								$('<a class="phantom-top-line-logo" href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>').prependTo($phantomLogo);
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
						// var headerNavigation = $(".header-bar .navigation"),
						// 	$widget = headerNavigation.first().find(".mini-widgets"),
						// 	$headerMenu = headerNavigation.first().find(".main-nav"),
						// 	$widgetRight = headerNavigation.last().find(".mini-widgets > *"),
						// 	$headerRight = headerNavigation.last().find(".main-nav > *"),
						// 	$parent = headerNavigation.first(),
						// 	$parentMenuRight = headerNavigation.last().find(".main-nav"),
						// 	$parentWidgetRight = headerNavigation.last().find(".mini-widgets");
					}
					else {
						var $widget = $(".header-bar .mini-widgets");
					};

					/*Phantom logo*/
					if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
						$phantom.find(".ph-wrap").addClass("with-logo");

						if(logoURL == undefined){
							$phantom.find(".logo-box").html(dtLocal.themeSettings.floatingHeader.logo.html);
						}
						else {
							$phantom.find(".logo-box").html('<a href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>');
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

								if (sideHeaderHStrokeExists || splitHeaderExists) {
									$headerMenu.appendTo($menuBox);
								}
								else {
									if (splitHeaderExists) {
										// $headerMenu.appendTo($menuBox);
										// $widget.appendTo($widgetBox);
										// $menuBox.find(".main-nav").append($headerRight);
										// $widgetBox.find(".mini-widgets").append($widgetRight);
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

								if(sideHeaderHStrokeExists || splitHeaderExists) {
									$headerMenu.appendTo($parent);
								}
								else {
									if (splitHeaderExists) {
									// 	$headerMenu.appendTo($parent);
									// 	$widget.appendTo($parent);
									// 	$headerRight.appendTo($parentMenuRight);
									// 	$widgetRight.appendTo($parentWidgetRight);
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
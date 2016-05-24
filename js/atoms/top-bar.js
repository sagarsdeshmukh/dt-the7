
/* #Mobile top bar
================================================== */
jQuery(document).ready(function($) {
	// function mobileHeader(){
		// var	$mobileNav = $(".main-nav > *").clone();
		var $document = $(document),
			$window = $(window),
			$html = $("html"),//$mobileLogo = $(".masthead").first().find(".branding > a, .branding > img").clone(true),
			$body = $("body"),
			$page = $("#page"),
			$mixedHeader = $(".mixed-header"),
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
		$(".mobile-main-nav li").each(function(){
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

			$(window).scroll(function () {
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
	
})
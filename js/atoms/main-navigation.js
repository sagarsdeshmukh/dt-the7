
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
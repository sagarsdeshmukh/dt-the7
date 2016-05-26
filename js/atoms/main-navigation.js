
/* #Main menu
================================================== */
// jQuery(document).ready(function($) {
	/* We need to fine-tune timings and do something about the usage of jQuery "animate" function */ 

	//Menu decoration Underline > Left to right

	$(".l-to-r-line > li:not(.menu-item-language) > a > span").not(".l-to-r-line > li > a > span.mega-icon").append("<i class='underline'></i>");

	//Menu/Buttons decoration Animation on click
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
			if (e.which == 3) {
			}else if(e.shiftKey || e.ctrlKey || e.metaKey){
				  window.open($this.attr("href"), '_blank');
			}else{
				e.preventDefault();
				var $thisTarget = $this.attr("target") ? $this.attr("target") : "_self";
				clearTimeout( rippleTimer );
          	 	rippleTimer = setTimeout( function() {
					if(!$thisRipple.parent('a[href^="#"]').length > 0){
						
						window.open($this.attr("href"), $thisTarget);
						return false;
					}else{
						$(this).parent("a").trigger("click");
						return false;
					}
          	 	}, 200)
			}
			
		});
	});
	$(".not-clickable-item").on("click", function(e){
		e.preventDefault();
		e.stopPropagation();
	});

	//Menu decoration Background / outline / line > Hover/Active line
	if($(".active-line-decoration").length > 0 || $(".hover-line-decoration").length > 0){
		$(".main-nav > .menu-item > a").append("<span class='decoration-line'></span>");
	};

	//declare vars
	var $mainNav = $(".main-nav, .mini-nav"),
		$mainMenu = $(".masthead:not(.sub-downwards) .main-nav, .mini-nav"),
		$mainNavMob = $(".main-nav"),
		$sideHeader = $(".side-header");

	/*Wpml menu item*/
	$(".menu-item-language").each(function(){
		var $this = $(this);
		if($this.children('.submenu-languages').length > 0){
			$this.addClass("has-children");
		}
	});

	//
	$(".act", $mainNav).parents("li").addClass("act");

	var	$mobileNav = $mainNavMob.clone();
	var	$mobileTopNav = $(".mini-nav").clone();
	

	$(".mini-nav select").change(function() {
		window.location.href = $(this).val();
	});

	dtGlobals.isHovering = false;
	$(".main-nav li", $sideHeader).each(function(){
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
	});

	/*Top bar select type menu menu*/
	var droupdownCustomMenu = $(".select-type-menu");
	if($(".masthead").find(".sub-nav").length > 0){
		var subMenuClassList = $(".masthead").find(".sub-nav").attr("class");
	}else{
		var subMenuClassList = "sub-nav";
	}
	droupdownCustomMenu.find("> ul").addClass(subMenuClassList );

	/*Sub menu*/
	$(" li.has-children ", $mainMenu).each(function() {
		var $this = $(this);
		if($this.parent().hasClass("main-nav")){
			var $thisHover = $this.find("> a");
		}else if($this.parent().hasClass("sub-nav") || $this.parents().hasClass("mini-nav")){
			var $thisHover = $this;
		};

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


		$thisHover.on("mouseenter tap", function(e) {
			var $this = $(this);
			if(e.type == "tap") e.stopPropagation();
			if($this.parent("li").length > 0){
				var $thisPar = $this.parent(),
					$subMenu = $this.siblings("div, ul");
			}else{
				var $thisPar = $this,
					$this_a = $this.find("> a"),
					$subMenu = $this_a.siblings("div, ul");
					//$this_of_l = $this.offset().left,
					//$this_a = $this.find("> a").offset().left;
			}
			var $this_of_l = $this.offset().left,
				$this_a = $this.offset().left,
				$masthead = $this.parents(".masthead");
			

			$thisPar.addClass("dt-hovered");
			if($thisPar.hasClass("dt-mega-menu")) $thisPar.addClass("show-mega-menu");

			dtGlobals.isHovering = true;

			/*Right overflow menu*/
			if ($page.width() - ($subMenu.offset().left - $page.offset().left) - $subMenu.width() < 0) {
				$subMenu.addClass("right-overflow");
			}				
			/*Bottom overflow menu*/
			if ($window.height() - ($subMenu.offset().top - dtGlobals.winScrollTop) - $subMenu.innerHeight() < 0) {
				$subMenu.addClass("bottom-overflow");
			};

			/*Left position*/
			if(!$sideHeader.length > 0){
				$subMenu.not(".right-overflow").css({
					left: $this_a - $this_of_l
				});
			};

			/*Mega menu auto width */
			if($thisPar.hasClass("mega-auto-width")){
				var $_this_par_width = $thisPar.width(),
					$_this_par_of_l = $masthead.offset().left,
					$_this_of_l = $thisPar.offset().left;
					$_this_parents_ofs = $thisPar.offset().left - $_this_par_of_l;

				if(!$sideHeader.length){
					var $pageW = $page.width();
					if($(".boxed").length > 0){
						var $_this_of_l = $thisPar.position().left;
					}else{
						var $_this_of_l = $thisPar.offset().left;
					}	
					
					if($subMenu.width()  > ($pageW - $thisPar.position().left)){
						$subMenu.css({
							left: -( $subMenu.innerWidth()  - ($pageW - $_this_of_l) )
						});
					}
					if($subMenu.width() > $pageW){
						if($(".boxed").length > 0){
							$subMenu.css({
								width: $masthead.width(),
								left: -($thisPar.position().left)
							});
						}else{
							$subMenu.css({
								width: $masthead.width(),
								left: -($_this_of_l - $_this_par_of_l)
							});
						}
					}
				}
			};

			/*Mega menu -> full width*/
			if($thisPar.hasClass("mega-full-width")){
				var $_this_of_l = $thisPar.offset().left;
				if($this.parents(".header-bar").length > 0){
					var $_this_par_w = $this.parents(".header-bar").innerWidth(),
						$_this_par_of_l = $this.parents(".header-bar").offset().left;
				}else{
					var $_this_par_w = $this.parents(".ph-wrap").innerWidth(),
						$_this_par_of_l = $this.parents(".ph-wrap").offset().left;
					
				}
				if(!$sideHeader.length > 0){
					$subMenu.css({
						width: $_this_par_w,
						left: -($_this_of_l - $_this_par_of_l)
					})
				}
			}

			clearTimeout(menuTimeoutShow);
			clearTimeout(menuTimeoutHide);

			menuTimeoutShow = setTimeout(function() {
				if($thisPar.hasClass("dt-hovered")){
					$subMenu.stop().css("visibility", "visible").animate({
						"opacity": 1
					}, 150);
				}
			}, 100);


		});

		$this.on("mouseleave", function(e) {
			var $this = $(this),
				$thisLink = $this.find("> a"),
				$subMenu = $thisLink.siblings("div, ul");

			$this.removeClass("dt-hovered");
			dtGlobals.isHovering = false;
			clearTimeout(menuTimeoutShow);
			clearTimeout(menuTimeoutHide);

			menuTimeoutHide = setTimeout(function() {
				if(!$this.hasClass("dt-hovered")){
					$subMenu.stop().animate({
						"opacity": 0
					}, 150, function() {
						$(this).css("visibility", "hidden");
					});

					$this.removeClass("show-mega-menu");
					
					setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							$subMenu.removeClass("right-overflow");
							$subMenu.removeClass("bottom-overflow");
							if($this.hasClass("mega-auto-width")){
								$subMenu.css({
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

	});


	var menuTimeoutShow,
		menuTimeoutHide;
	droupdownCustomMenu.on("mouseenter tap", function(e) {
		if(e.type == "tap") e.stopPropagation();

		var $this = $(this);
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

	droupdownCustomMenu.on("mouseleave", function(e) {
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

	//	$this.find("> a").removeClass("dt-clicked");
	});
// });
	
// })
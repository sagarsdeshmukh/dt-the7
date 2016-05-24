
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
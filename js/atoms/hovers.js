/* #Images Styling & Hovers
================================================== */
// jQuery(document).ready(function($) {

	/* !Append tag </i> to rolovers*/
	$.fn.addRollover = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			$this.append("<i></i>");
			if($this.find(".rollover-thumbnails").length){
				$this.addClass("rollover-thumbnails-on");
			}
			if($this.parent().find(".links-container").length){
				$this.addClass("rollover-buttons-on");
			}

			$this.addClass("this-ready");
		});
	};
	$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content, .vc-item .vc-inner > a").addRollover();

	/* !- Grayscale */
	$(".filter-grayscale .slider-masonry").on("mouseenter tap", function(e) {
		if(e.type == "tap") {
			e.stopPropagation();
		};
		$(this).addClass("dt-hovered");
	});

	$(".filter-grayscale .slider-masonry").on("mouseleave", function(e) {
		$(this).removeClass("dt-hovered");
	});


	/* #Hover layouts
	================================================== */

	/*!-Scale in hover*/
	$.fn.scaleInHover = function() {
		return this.each(function() {

			var $this = $(this);
			if ($this.hasClass("scale-ready")) {
				return;
			}
			var $img = $this.find("img.preload-me"),
				imgWidth = parseInt($img.attr('width')),
				imgHeight = parseInt($img.attr('height')),
				imgRatio = imgWidth/imgHeight;
			if(imgRatio < 2 && imgRatio >= 1.5){
				$this.addClass("ratio_3-2");
			}else if(imgRatio < 1.5 && imgRatio >= 1){
				$this.addClass("ratio_4-3");
			}else if(imgRatio < 1 && imgRatio >= 0.75){
				$this.addClass("ratio_3-4");
			}else if(imgRatio < 0.75 && imgRatio >= 0.6){
				$this.addClass("ratio_2-3");
			}else{
				$this.removeClass("ratio_2-3").removeClass("ratio_3-2").removeClass("ratio-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};
			if(imgRatio >= 2){
				$this.addClass("ratio-2");
			};
			if(imgRatio == 1){
				$this.removeClass("ratio_2-3").removeClass("ratio-2").removeClass("ratio_3-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};

			$this.addClass("scale-ready");
		});
	};
	$(".hover-scale .rollover-project").scaleInHover();

	// /*!-Hover Direction aware*/
	// $('.mobile-false .hover-grid .rollover-project').each( function() { $(this).hoverdir(); } );
	// $('.mobile-false .hover-grid-reverse .rollover-project ').each( function() { $(this).hoverdir({
	// 	inverse : true
	// }); } );

	// /*!Append tag </span> for portfolio round links button*/
	// $.fn.hoverLinks = function() {
	// 	if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
	// 		return this.each(function() {
	// 			var $img = $(this);
	// 			if ($img.hasClass("height-ready")) {
	// 				return;
	// 			}
	// 			$("<span/>").appendTo($(this));

	// 			$img.on({
	// 				mouseenter: function () {
	// 					if (0 === $(this).children("span").length) {
	// 						var a = $("<span/>").appendTo($(this));
	// 						setTimeout(function () {
	// 							a.addClass("icon-hover")
	// 						}, 20)
	// 					} else $(this).children("span").addClass("icon-hover")
	// 				},
	// 				mouseleave: function () {
	// 					$(this).children("span").removeClass("icon-hover")
	// 				}
	// 			});

	// 			$img.addClass("height-ready");
	// 		});
	// 	}
	// };
	// $(".links-container a").hoverLinks();

	// /*!Trigger click (direct to post) */
	// $.fn.forwardToPost = function() {
	// 	return this.each(function() {
	// 		var $this = $(this);
	// 		if ($this.hasClass("this-ready")) {
	// 			return;
	// 		};
	// 		$this.on("click", function(){
	// 			if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
	// 			window.location.href = $this.find("a").first().attr("href");
	// 			return false;
	// 		});
	// 		$this.addClass("this-ready");
	// 	});
	// };
	// $(".mobile-false .rollover-project.forward-post").forwardToPost();

	// $.fn.touchforwardToPost = function() {
	// 	return this.each(function() {
	// 		var $this = $(this);
	// 		if ($this.hasClass("touch-hover-ready")) {
	// 			return;
	// 		}

	// 		$body.on("touchend", function(e) {
	// 			$(".mobile-true .rollover-content").removeClass("is-clicked");
	// 			$(".mobile-true .rollover-project").removeClass("is-clicked");
	// 		});
	// 		var $this = $(this).find(".rollover-content");
	// 		$this.on("touchstart", function(e) { 
	// 			origY = e.originalEvent.touches[0].pageY;
	// 			origX = e.originalEvent.touches[0].pageX;
	// 		});
	// 		$this.on("touchend", function(e) {
	// 			var touchEX = e.originalEvent.changedTouches[0].pageX,
	// 				touchEY = e.originalEvent.changedTouches[0].pageY;
	// 			if( origY == touchEY || origX == touchEX ){
	// 				if ($this.hasClass("is-clicked")) {
	// 						window.location.href = $this.prev("a").first().attr("href");
	// 				} else {
	// 					e.preventDefault();
	// 					$(".mobile-ture .rollover-content").removeClass("is-clicked");
	// 					$(".mobile-true .rollover-project").removeClass("is-clicked");
	// 					$this.addClass("is-clicked");
	// 					$this.parent(".rollover-project").addClass("is-clicked");
	// 					return false;
	// 				};
	// 			};
	// 		});

	// 		$this.addClass("touch-hover-ready");
	// 	});
	// };
	// $(".mobile-true .rollover-project.forward-post").touchforwardToPost();

	// /*!Trigger click on portfolio hover buttons */
	// $.fn.followCurentLink = function() {
	// 	return this.each(function() {
	// 		var $this = $(this);
	// 		if ($this.hasClass("this-ready")) {
	// 			return;
	// 		}

	// 		var $thisSingleLink = $this.find(".links-container > a"),
	// 			$thisCategory = $this.find(".portfolio-categories a");
				
	// 		$this.on("click", function(){

	// 			$thisSingleLink.each(function(){
	// 				$thisTarget = $(this).attr("target") ? $(this).attr("target") : "_self";
	// 			});

	// 			if($thisSingleLink.hasClass("project-details") || $thisSingleLink.hasClass("link") || $thisSingleLink.hasClass("project-link")){
	// 				window.open($thisSingleLink.attr("href"), $thisTarget);
	// 				return false;

	// 			}else{
	// 				$thisSingleLink.trigger("click");
	// 				return false;
	// 			}
	// 		});

	// 		$this.find($thisCategory).click(function(e) {
	// 			 e.stopPropagation();
	// 			window.location.href = $thisCategory.attr('href');
	// 		});
	// 		$this.addClass("this-ready");
	// 	});
	// };
	// $(".mobile-false .rollover-project.rollover-active, .mobile-false .buttons-on-img.rollover-active").followCurentLink();

	/*TOUCH DEVICE*/
	/*!Description on hover show content on click(albums projects touch device)*/

	$.fn.touchNewHover = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			if( $(".rollover-content", this).length > 0 || $(".woocom-rollover-content", this).length > 0){
				$body.on("touchend", function(e) {
					$(".mobile-true .rollover-content, .mobile-true .rollover-project, .mobile-true .woocom-rollover-content, .mobile-true .woocom-project").removeClass("is-clicked");
				});
				
				$this.on("touchstart", function(e) {
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
			
						if ($this.hasClass("is-clicked")) {
							if($this.find(".dt-gallery-container").length > 0){
								$this.find(".rollover-content").on("click.dtAlbums", function(e){
									$this.find(".rollover-content").off("click.dtAlbums");
									$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-mfp-item").first().trigger('click');
								});
							}
							if($(this).find(".rollover-click-target.go-to").length > 0){
								window.location.href = $(this).find(".rollover-click-target.go-to").attr('href');
							}else if($(this).hasClass("woocom-project")){
								if ( $(e.target).is(".add_to_cart_button") ) {
									return true
								}else{
									window.location.href = $(this).find(" > a").attr('href');
								}
							}
						} else {

							$('.links-container > a', $this).on('touchend', function(e) {
								e.stopPropagation();
								$this.addClass("is-clicked");
							});
							e.preventDefault();
							$(".mobile-true .rollover-content, .mobile-true .rollover-project, .mobile-true .woocom-rollover-content, .mobile-true .woocom-project").removeClass("is-clicked");
							$this.addClass("is-clicked");
							$this.find(".rollover-content").addClass("is-clicked");
							$this.find(".woocom-rollover-content").addClass("is-clicked");
							return false;
						};
					};
				});
			};

			$this.addClass("this-ready");
		});
	};
	$(".mobile-true .rollover-project, .mobile-true .woocom-project").touchNewHover();

	/*Description on hover show content on click(albums projects touch device):end*/

	$(".hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .mobile-true .cart-btn-on-img .buttons-on-img > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
		e.preventDefault();
	});
	$(".mobile-false .albums .rollover-content a:not(.portfolio-categories a), .mobile-false .media .rollover-content, .mobile-false .dt-gallery-container .rollover-content").on("click", function(e){
		if ( $(e.target).is("a") ) {return true};
		$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
	});
		


	// $.fn.touchHoverImage = function() {
	// 	return this.each(function() {
	// 		var $img = $(this);
	// 		if ($img.hasClass("hover-ready")) {
	// 			return;
	// 		}

	// 		$body.on("touchend", function(e) {
	// 			$(".mobile-true .rollover-content").removeClass("is-clicked");
	// 		});
	// 		var $this = $(this).find(".rollover-content"),
	// 			thisPar = $this.parents(".wf-cell");
	// 		$this.on("touchstart", function(e) { 
	// 			origY = e.originalEvent.touches[0].pageY;
	// 			origX = e.originalEvent.touches[0].pageX;
	// 		});
	// 		$this.on("touchend", function(e) {
	// 			var touchEX = e.originalEvent.changedTouches[0].pageX,
	// 				touchEY = e.originalEvent.changedTouches[0].pageY;
	// 			if( origY == touchEY || origX == touchEX ){
	// 				if ($this.hasClass("is-clicked")) {
	// 				} else {

	// 					$('.links-container > a', $this).on('touchend', function(e) {
	// 						e.stopPropagation();
	// 						$this.addClass("is-clicked");
	// 					});
	// 					e.preventDefault();
	// 					$(".mobile-true .buttons-on-img .rollover-content").removeClass("is-clicked");
	// 					$this.addClass("is-clicked");
	// 					return false;
	// 				};
	// 			};
	// 		});

	// 		$img.addClass("hover-ready");
	// 	});
	// };
	// $(".mobile-true .buttons-on-img").touchHoverImage();

	$.fn.touchWooHoverImage = function() {
		return this.each(function() {
			var $img = $(this);
			if ($img.hasClass("woo-ready")) {
				return;
			}

			$body.on("touchend", function(e) {
				$(".mobile-true .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
			});
			var $this = $(this);
			$this.on("touchstart", function(e) { 
				origY = e.originalEvent.touches[0].pageY;
				origX = e.originalEvent.touches[0].pageX;
			});
			$this.on("touchend", function(e) {
				var touchEX = e.originalEvent.changedTouches[0].pageX,
					touchEY = e.originalEvent.changedTouches[0].pageY;
				if( origY == touchEY || origX == touchEX ){
					if ($this.hasClass("is-clicked")) {
						if($(e.target).parent().hasClass("woo-buttons")){								
							$(e.target).trigger('click');
						}else{
							window.location.href = $this.find("a").first().attr("href");
						}
					} else {

						// console.log($(e.target))
						e.preventDefault();
						$(".mobile-true .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
						$this.addClass("is-clicked");
						return false;
					};
				};
			});

			$img.addClass("woo-ready");
		});
	};
	$(".mobile-true .cart-btn-on-img .buttons-on-img").touchWooHoverImage();

	// $.fn.touchScrollerImage = function() {
	// 	return this.each(function() {
	// 		var $img = $(this);
	// 		if ($img.hasClass("hover-ready")) {
	// 			return;
	// 		}

	// 		$body.on("touchend", function(e) {
	// 			$(".mobile-true .project-list-media").removeClass("is-clicked");
	// 		});
	// 		var $this = $(this),
	// 			$thisSingleLink = $this.find("a.rollover-click-target").first(),
	// 			$thisButtonLink = $this.find(".links-container");
	// 		$this.on("touchstart", function(e) { 
	// 			origY = e.originalEvent.touches[0].pageY;
	// 			origX = e.originalEvent.touches[0].pageX;
	// 		});
	// 		$this.on("touchend", function(e) {
	// 			var touchEX = e.originalEvent.changedTouches[0].pageX,
	// 				touchEY = e.originalEvent.changedTouches[0].pageY;
	// 			if( origY == touchEY || origX == touchEX ){
	// 				if ($this.hasClass("is-clicked")) {
							
	// 				} else {
	// 					if($thisSingleLink.length > 0){
	// 						$thisSingleLink.on("click", function(event) {
	// 							event.stopPropagation();

	// 							if ( $(this).hasClass('go-to') ) {
	// 								window.location.href = $(this).attr('href');
	// 							}
	// 						});
	// 						$thisSingleLink.trigger("click");
	// 					};
	// 					if($thisButtonLink.length > 0){
	// 						$thisButtonLink.find(" > a ").each(function(){
	// 							$(this).on("touchend", function(event) {
	// 								event.stopPropagation();
	// 								$(this).trigger("click");
	// 							});
	// 						});
	// 					}
	// 					e.preventDefault();
	// 					$(".mobile-true .fs-entry").removeClass("is-clicked");
	// 					$this.addClass("is-clicked");
	// 					return false;
	// 				};
	// 			};
	// 		});

	// 		$img.addClass("hover-ready");
	// 	});
	// };
	// $(".mobile-true .project-list-media").touchScrollerImage();

	// $.fn.touchHoverLinks = function() {
	// 	return this.each(function() {
	// 		var $img = $(this);
	// 		if ($img.hasClass("hover-ready")) {
	// 			return;
	// 		}

	// 		var $this = $(this);
	// 		$this.on("touchend", function(e) {
	// 			if ($this.hasClass("is-clicked")) {
	// 				return;
	// 			} else {

	// 				if( $this.hasClass("project-zoom") ) {
	// 					$this.trigger("click");
	// 				}else {
	// 					window.location.href = $this.attr("href");
	// 					return false;
	// 				};

	// 				$(".mobile-true .links-container > a").removeClass("is-clicked");
	// 				$this.addClass("is-clicked");
	// 				return false;
	// 			};
	// 		});

	// 		$img.addClass("hover-ready");
	// 	});
	// };
	// $(".mobile-true .fs-entry .links-container > a").touchHoverLinks();


	// /*!Trigger albums click */
	// $.fn.triggerAlbumsClick = function() {
	// 	return this.each(function() {
	// 		var $this = $(this);
	// 		if ($this.hasClass("this-ready")) {
	// 			return;
	// 		}

	// 		var $thisSingleLink = $this.find("a.rollover-click-target, .dt-mfp-item").first(),
	// 			$thisCategory = $this.find(".portfolio-categories a");

	// 		if( $thisSingleLink.length > 0 ){
	// 			$thisSingleLink.on("click", function(event) {
	// 				event.stopPropagation();

	// 				if ( $(this).hasClass('go-to') ) {
	// 					window.location.href = $(this).attr('href');
	// 				}
	// 			});

	// 			var alreadyTriggered = false;

	// 			$this.on("click", function(){

	// 				if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

	// 				if ( !alreadyTriggered ) {
	// 					alreadyTriggered = true;
	// 					$thisSingleLink.trigger("click");
						
	// 					alreadyTriggered = false;
	// 				}
	// 				return false;
	// 			})
	// 			$this.find($thisCategory).click(function(e) {
	// 				 e.stopPropagation();
	// 				window.location.href = $thisCategory.attr('href');
	// 			});
	// 		}
	// 		$this.addClass("this-ready");
	// 	});
	// };
	// $(".dt-albums-template .rollover-project, .dt-albums-shortcode .rollover-project, .dt-albums-template .buttons-on-img, .dt-albums-shortcode .buttons-on-img, .archive .type-dt_gallery .buttons-on-img").triggerAlbumsClick();

	

	// /*!Trigger rollover click*/
	
	// $.fn.triggerHoverClick = function() {
	// 	return this.each(function() {
	// 		var $this = $(this);
	// 		if ($this.hasClass("click-ready")) {
	// 			return;
	// 		}

	// 		var $thisSingleLink = $this.prev("a:not(.dt-single-mfp-popup):not(.dt-mfp-item)").first(),
	// 			$thisCategory = $this.find(".portfolio-categories a"),
	// 			$thisLink = $this.find(".project-link"),
	// 			$thisTarget = $thisLink.attr("target") ? $thisLink.attr("target") : "_self",
	// 			$targetClick;
				

	// 		if( $thisSingleLink.length > 0 ){
			

	// 			var alreadyTriggered = false;

	// 			$this.on("click", function(e){

	// 				if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

	// 				if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
	// 					$targetClick = $(e.target).parent();
	// 				}else{
	// 					$targetClick = $(e.target);
	// 				}
	// 				if($targetClick.hasClass("project-zoom")){

	// 					//console.log(( "clicked: " + $(e.target).parent().attr("class") )
	// 					$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-single-mfp-popup, .dt-mfp-item").first().trigger('click');
	// 				}else{
	// 					if ( !alreadyTriggered ) {
	// 						alreadyTriggered = true;
	// 						$thisSingleLink.trigger("click");
	// 						window.location.href = $thisSingleLink.attr('href');
							
	// 						alreadyTriggered = false;
	// 					}
	// 				}
	// 				return false;
	// 			})
	// 			$this.find($thisLink).click(function(e) {
	// 				 e.stopPropagation();
	// 				 e.preventDefault();
	// 				window.open($thisLink.attr("href"), $thisTarget);
	// 			});

	// 			$this.find($thisCategory).click(function(e) {
	// 				 e.stopPropagation();
	// 				window.location.href = $thisCategory.attr('href');
	// 			});
	// 		}
	// 		$this.addClass("click-ready");
	// 	});
	// };
	// $(".mobile-false .rollover-project:not(.rollover-active) .rollover-content, .buttons-on-img:not(.rollover-active) .rollover-content").triggerHoverClick();
// });
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

	/* !-Blur */
	$window.load(function() {
		if(!dtGlobals.isMobile){
			$.fn.blurImage = function() {
				return this.each(function() {
					var $_this = $(this);

					if ($_this.hasClass("blur-ready")) {
						return;
					}

					var img = $_this.find("> img");

					$_this.addClass('blur-this');
					img.clone().addClass("blur-effect").css('opacity', '').prependTo(this);
							
					var blur_this = $(".blur-effect", this);
						blur_this.each(function(index, element){
							if (img[index].complete == true) {
								Pixastic.process(blur_this[index], "blurfast", {amount:0.3});
							}
							else {
								blur_this.load(function () {
									Pixastic.process(blur_this[index], "blurfast", {amount:0.3});
								});
							}
						});

					$_this.addClass("blur-ready");
				});
			};

			var total_images = $("body img").length;
			var images_loaded = 0;
			$("img").loaded(null, function() {
				$(".image-blur .fs-entry-img:not(.shortcode-instagram .fs-entry-img), .image-blur .shortcode-instagram a, .image-blur .rollover-project a:not(.hover-style-three .rollover-project a), .image-blur .rollover, .image-blur .rollover > div, .image-blur .post-rollover, .image-blur .rollover-video").blurImage();
			}, true);
			
		};
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

	/*!-Hover Direction aware*/
	$('.no-touch .hover-grid .rollover-project').each( function() { $(this).hoverdir(); } );
	$('.no-touch .hover-grid-reverse .rollover-project ').each( function() { $(this).hoverdir({
		inverse : true
	}); } );

	/*!Append tag </span> for round links*/
	$.fn.hoverLinks = function() {
		if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("height-ready")) {
					return;
				}
				$("<span/>").appendTo($(this));

				$img.on({
					mouseenter: function () {
						if (0 === $(this).children("span").length) {
							var a = $("<span/>").appendTo($(this));
							setTimeout(function () {
								a.addClass("icon-hover")
							}, 20)
						} else $(this).children("span").addClass("icon-hover")
					},
					mouseleave: function () {
						$(this).children("span").removeClass("icon-hover")
					}
				});

				$img.addClass("height-ready");
			});
		}
	};
	$(".links-container a").hoverLinks();

	/*!Trigger click single link by click on image */
	$.fn.forwardToPost = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			};
			$this.on("click", function(){
				if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
				window.location.href = $this.find("a").first().attr("href");
				return false;
			});
			$this.addClass("this-ready");
		});
	};
	$(".no-touch .rollover-project.forward-post").forwardToPost();

	$.fn.touchforwardToPost = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("touch-hover-ready")) {
				return;
			}

			$body.on("touchend", function(e) {
				$(".touch .rollover-content").removeClass("is-clicked");
				$(".touch .rollover-project").removeClass("is-clicked");
			});
			var $this = $(this).find(".rollover-content");
			$this.on("touchstart", function(e) { 
				origY = e.originalEvent.touches[0].pageY;
				origX = e.originalEvent.touches[0].pageX;
			});
			$this.on("touchend", function(e) {
				var touchEX = e.originalEvent.changedTouches[0].pageX,
					touchEY = e.originalEvent.changedTouches[0].pageY;
				if( origY == touchEY || origX == touchEX ){
					if ($this.hasClass("is-clicked")) {
							window.location.href = $this.prev("a").first().attr("href");
					} else {
						e.preventDefault();
						$(".touch .rollover-content").removeClass("is-clicked");
						$(".touch .rollover-project").removeClass("is-clicked");
						$this.addClass("is-clicked");
						$this.parent(".rollover-project").addClass("is-clicked");
						return false;
					};
				};
			});

			$this.addClass("touch-hover-ready");
		});
	};
	$(".touch .rollover-project.forward-post").touchforwardToPost();

	/*!Trigger click on round links */
	$.fn.followCurentLink = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			var $thisSingleLink = $this.find(".links-container > a"),
				$thisCategory = $this.find(".portfolio-categories a");
				

			
			$this.on("click", function(){

				$thisSingleLink.each(function(){
					$thisTarget = $(this).attr("target") ? $(this).attr("target") : "_self";
				});

				if($thisSingleLink.hasClass("project-details") || $thisSingleLink.hasClass("link") || $thisSingleLink.hasClass("project-link")){
					window.open($thisSingleLink.attr("href"), $thisTarget);
					return false;

				}else{
					$thisSingleLink.trigger("click");
					return false;
				}
			});

			$this.find($thisCategory).click(function(e) {
				 e.stopPropagation();
				window.location.href = $thisCategory.attr('href');
			});
			$this.addClass("this-ready");
		});
	};
	$(".no-touch .rollover-project.rollover-active, .no-touch .buttons-on-img.rollover-active").followCurentLink();

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
							$(".touch .rollover-content, .touch .rollover-project, .touch .woocom-rollover-content, .touch .woocom-project").removeClass("is-clicked");
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
											$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-single-mfp-popup, .dt-mfp-item").first().trigger('click');
										});
									}
									if($(this).find(".rollover-click-target.go-to").length > 0){
										window.location.href = $(this).find(".rollover-click-target.go-to").attr('href');
									}
								} else {

									$('.links-container > a', $this).on('touchend', function(e) {
										e.stopPropagation();
										$this.addClass("is-clicked");
									});
									e.preventDefault();
									$(".touch .rollover-content, .touch .rollover-project, .touch .woocom-rollover-content, .touch .woocom-project").removeClass("is-clicked");
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
			$(".touch .rollover-project, .touch .woocom-project").touchNewHover();

		/*Description on hover show content on click(albums projects touch device):end*/

		$(".touch .rollover-project a.link.show-content, .hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .touch .cart-btn-on-img .buttons-on-img > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
			e.preventDefault();
		});
		$(".no-touch .albums .rollover-content a:not(.portfolio-categories a), .no-touch .media .rollover-content, .no-touch .dt-gallery-container .rollover-content").on("click", function(e){
			if ( $(e.target).is("a") ) {return true};
			$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
		});

		$.fn.touchHoverImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				$body.on("touchend", function(e) {
					$(".touch .rollover-content").removeClass("is-clicked");
				});
				var $this = $(this).find(".rollover-content"),
					thisPar = $this.parents(".wf-cell");
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
						} else {

							$('.links-container > a', $this).on('touchend', function(e) {
								e.stopPropagation();
								$this.addClass("is-clicked");
							});
							e.preventDefault();
							$(".touch .buttons-on-img .rollover-content").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .buttons-on-img").touchHoverImage();

		$.fn.touchWooHoverImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("woo-ready")) {
					return;
				}

				$body.on("touchend", function(e) {
					$(".touch .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
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
							$(".touch .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("woo-ready");
			});
		};
		$(".touch .cart-btn-on-img .buttons-on-img").touchWooHoverImage();

		$.fn.touchScrollerImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				$body.on("touchend", function(e) {
					$(".touch .fs-entry").removeClass("is-clicked");
				});
				var $this = $(this),
					$thisSingleLink = $this.find("a.rollover-click-target").first(),
					$thisButtonLink = $this.find(".links-container");
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
								
						} else {
							if($thisSingleLink.length > 0){
								$thisSingleLink.on("click", function(event) {
									event.stopPropagation();

									if ( $(this).hasClass('go-to') ) {
										window.location.href = $(this).attr('href');
									}
								});
								$thisSingleLink.trigger("click");
							};
							if($thisButtonLink.length > 0){
								$thisButtonLink.find(" > a ").each(function(){
									$(this).on("touchend", function(event) {
										event.stopPropagation();
										$(this).trigger("click");
									});
								});
							}
							e.preventDefault();
							$(".touch .fs-entry").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .fs-entry").touchScrollerImage();

		$.fn.touchHoverLinks = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				var $this = $(this);
				$this.on("touchend", function(e) {
					if ($this.hasClass("is-clicked")) {
						return;
					} else {

						if( $this.hasClass("project-zoom") ) {
							$this.trigger("click");
						}else {
							window.location.href = $this.attr("href");
							return false;
						};

						$(".touch .links-container > a").removeClass("is-clicked");
						$this.addClass("is-clicked");
						return false;
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .fs-entry .links-container > a").touchHoverLinks();


	/*!Trigger albums click */
	$.fn.triggerAlbumsClick = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			var $thisSingleLink = $this.find("a.rollover-click-target").first(),
				$thisCategory = $this.find(".portfolio-categories a");

			if( $thisSingleLink.length > 0 ){
				$thisSingleLink.on("click", function(event) {
					event.stopPropagation();

					if ( $(this).hasClass('go-to') ) {
						window.location.href = $(this).attr('href');
					}
				});

				var alreadyTriggered = false;

				$this.on("click", function(){

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

					if ( !alreadyTriggered ) {
						alreadyTriggered = true;
						$thisSingleLink.trigger("click");
						
						alreadyTriggered = false;
					}
					return false;
				})
				$this.find($thisCategory).click(function(e) {
					 e.stopPropagation();
					window.location.href = $thisCategory.attr('href');
				});
			}
			$this.addClass("this-ready");
		});
	};
	$(".albums .rollover-project, .dt-albums-shortcode .rollover-project, .albums .buttons-on-img, .dt-albums-shortcode .buttons-on-img").triggerAlbumsClick();

	

	/*!Trigger rollover click*/
	
	$.fn.triggerHoverClick = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("click-ready")) {
				return;
			}

			var $thisSingleLink = $this.prev("a").first(),
				$thisCategory = $this.find(".portfolio-categories a"),
				$thisLink = $this.find(".project-link"),
				$thisTarget = $thisLink.attr("target") ? $thisLink.attr("target") : "_self",
				$targetClick;
				

			if( $thisSingleLink.length > 0 ){
			

				var alreadyTriggered = false;

				$this.on("click", function(e){

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

					if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
						$targetClick = $(e.target).parent();
					}else{
						$targetClick = $(e.target);
					}
					if($targetClick.hasClass("project-zoom")){

						//console.log(( "clicked: " + $(e.target).parent().attr("class") )
						$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-single-mfp-popup, .dt-mfp-item").first().trigger('click');
					}else{
						if ( !alreadyTriggered ) {
							alreadyTriggered = true;
							$thisSingleLink.trigger("click");
							window.location.href = $thisSingleLink.attr('href');
							
							alreadyTriggered = false;
						}
					}
					return false;
				})
				$this.find($thisLink).click(function(e) {
					 e.stopPropagation();
					 e.preventDefault();
					window.open($thisLink.attr("href"), $thisTarget);
				});

				$this.find($thisCategory).click(function(e) {
					 e.stopPropagation();
					window.location.href = $thisCategory.attr('href');
				});
			}
			$this.addClass("click-ready");
		});
	};
	$(".no-touch .rollover-project:not(.rollover-active) .rollover-content, .no-touch .buttons-on-img:not(.rollover-active) .rollover-content").triggerHoverClick();
// });
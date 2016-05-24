
/* #Photo slider initialisation
================================================== */
// jQuery(document).ready(function($) {
	var $photoScroller = $(".photo-scroller");
	if($photoScroller.length > 0){
		/* !Set slider */
		$.fn.photoSlider = function() {
			var $el = $(this),
				slides = {},
				thumbs = "";
				$elParent = $el.parents(".photo-scroller");

				slides.$items = $el.children("figure");
				slides.count = slides.$items.length;

			slides.$items.each(function(i) {
				var $this = $(this),
					$slide = $this.children().first().remove(),
					src = $slide.attr("href"),
					$thumbImg = $slide.children("img"),
					thumbSrc = $thumbImg.attr("src");

				// !Captions copying
				$this.find("figcaption").addClass("caption-" + (i+1) + "");
				var $thisCaptionClone = $(this).find("figcaption").clone(true);
				$(".slide-caption").append($thisCaptionClone);
				if (parseInt($elParent.attr("data-thumb-width")) > 0) {
					var thisWidth = parseInt($elParent.attr("data-thumb-width")),
						thisHeight = parseInt($elParent.attr("data-thumb-height"));

					$elParent.removeClass("proportional-thumbs");
				}
				else {
					var thisWidth = parseInt($thumbImg.attr("width")),
						thisHeight = parseInt($thumbImg.attr("height"));

					$elParent.addClass("proportional-thumbs");
				};

				thumbs = thumbs + '<div class="ts-cell" data-width="'+(thisWidth+5)+'" data-height="'+(thisHeight+10)+'"><div class="ts-thumb-img"><img src="'+thumbSrc+'" width="'+thisWidth+'" height="'+thisHeight+'"></div></div>'; 

				$this.prepend('<div class="ts-slide-img"><img src="'+src+'" width="'+$this.attr("data-width")+'" height="'+$this.attr("data-height")+'"></div>');
			});
			$elParent.append('<div class="scroller-arrow prev"><i></i><i></i></div><div class="scroller-arrow next"><i></i><i></i></div>')

			$el.addClass("ts-cont");
			$el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

			var $slider = $el.parents(".ts-wrap"),
				windowW = $window.width(),
				$sliderPar = $elParent,
				$sliderAutoslide = ($sliderPar.attr("data-autoslide") == "true") ? true : false,
				$sliderAutoslideDelay = ($sliderPar.attr("data-delay") && parseInt($sliderPar.attr("data-delay")) > 999) ? parseInt($sliderPar.attr("data-delay")) : 5000,
				$sliderLoop = ($sliderPar.attr("data-loop") === "true") ? true : false,
				$thumbHeight = $sliderPar.attr("data-thumb-height") ? parseInt($sliderPar.attr("data-thumb-height"))+10 : 80+10,
				$slideOpacity = $sliderPar.attr("data-transparency") ? $sliderPar.attr("data-transparency") : 0.5,
				$adminBarH = $("#wpadminbar").length > 0? $("#wpadminbar").height() : 0;

			// !New settings for cells;
			var dataLsMin = $sliderPar.attr("data-ls-min") ? parseInt($sliderPar.attr("data-ls-min")) : 0,
				dataLsMax = $sliderPar.attr("data-ls-max") ? parseInt($sliderPar.attr("data-ls-max")) : 100,
				dataLsFillDt = $sliderPar.attr("data-ls-fill-dt") ? $sliderPar.attr("data-ls-fill-dt") : "fill",
				dataLsFillMob = $sliderPar.attr("data-ls-fill-mob") ? $sliderPar.attr("data-ls-fill-mob") : "fit",
				dataPtMin = $sliderPar.attr("data-pt-min") ? parseInt($sliderPar.attr("data-pt-min")) : 0,
				dataPtMax = $sliderPar.attr("data-pt-max") ? parseInt($sliderPar.attr("data-pt-max")) : 100,
				dataPtFillDt = $sliderPar.attr("data-pt-fill-dt") ? $sliderPar.attr("data-pt-fill-dt") : "fill",
				dataPtFillMob = $sliderPar.attr("data-pt-fill-mob") ? $sliderPar.attr("data-pt-fill-mob") : "fit",
				dataSidePaddings  = $sliderPar.attr("data-padding-side") ? parseInt($sliderPar.attr("data-padding-side")) : 0;

			// !Normalize new settings for cells;
			if (dataLsMax <= 0) dataLsMax = 100;
			if (dataPtMax <= 0) dataPtMax = 100;
			if (dataLsMax < dataLsMax) dataLsMax = dataLsMax;
			if (dataPtMax < dataPtMax) dataPtMax = dataPtMax;

			$slider.addClass("ts-ls-"+dataLsFillDt).addClass("ts-ls-mob-"+dataLsFillMob);
			$slider.addClass("ts-pt-"+dataPtFillDt).addClass("ts-pt-mob-"+dataPtFillMob);

			$slider.find(".ts-slide-img").css({
				"opacity": $slideOpacity
			});
			$slider.find(".video-icon").css({
				"opacity": $slideOpacity
			});


			var	$slideTopPadding = ($sliderPar.attr("data-padding-top") && windowW > 760) ? $sliderPar.attr("data-padding-top") : 0,
				$slideBottomPadding = ($sliderPar.attr("data-padding-bottom") && windowW > 760) ? $sliderPar.attr("data-padding-bottom") : 0;

			var $sliderVP = $slider.find(".ts-viewport");
			$sliderVP.css({
				"margin-top": $slideTopPadding+"px",
				"margin-bottom": $slideBottomPadding+"px"
			});
			
			$window.on("debouncedresize", function() {
				if ($sliderPar.attr("data-padding-top") && $window.width() > 760) {
					$slideTopPadding = $sliderPar.attr("data-padding-top");
				}
				else {
					$slideTopPadding = 0;
				};

				if ($sliderPar.attr("data-padding-bottom") && $window.width() > 760) {
					$slideBottomPadding = $sliderPar.attr("data-padding-bottom");
				}
				else {
					$slideBottomPadding = 0;
				};

				if ($window.width() > 760) {
					$sliderVP.css({
						"margin-top": $slideTopPadding+"px",
						"margin-bottom": $slideBottomPadding+"px"
					});
				}
				else {
					$sliderVP.css({
						"margin-top": 0+"px",
						"margin-bottom": 0+"px"
					});
				};
			});

			/* !Initializinig the main slider */
			var $sliderData = $slider.thePhotoSlider({
				mode: {
					type: "centered",
					lsMinW: dataLsMin,
					lsMaxW: dataLsMax,
					ptMinW: dataPtMin,
					ptMaxW: dataPtMax,
				},
				height: function() {
					// if ($(window).width() < 760) {
					// 	return (window.innerHeight);
					// }else 
					var $windowH = $window.height(),
						$adminBarH = $("#wpadminbar").height();
					if ($(".mixed-header").length > 0){
						var $headerH = $(".mixed-header").height();
					}else{						
						var $headerH = $(".masthead").height();
					}
					if ($body.hasClass("transparent") || $slider.parents(".photo-scroller").hasClass("full-screen")) {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.secondSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
						}else {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);							
						};

					}else if ($(".mixed-header").length > 0 || $slider.parents(".photo-scroller").hasClass("full-screen")) {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);					
						}else {
							if($(".side-header-h-stroke").length > 0){
								return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
							}else{
								return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);
							}
						};

					}else if ($(".side-header").length > 0 || $slider.parents(".photo-scroller").hasClass("full-screen")) {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
						}else {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);							
						};

					}else {

						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);						
						}else {
							return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
						};

					};
				},
				sidePaddings: dataSidePaddings,
				autoPlay: {
					enabled: $sliderAutoslide,
					delay: $sliderAutoslideDelay,
					loop: $sliderLoop
				}
			}).data("thePhotoSlider");


			var $thumbsScroller = $('<div class="ts-wrap"><div class="ts-viewport"><div class="ts-cont ts-thumbs">'+thumbs+'</div></div></div>');
			$slider.after($thumbsScroller);

			/* !Initializinig the thumbnail stripe */
			var $thumbsScrollerData = $thumbsScroller.thePhotoSlider({
				mode: {
					type: "scroller"
				},
				height: $thumbHeight
			}).data("thePhotoSlider");


			$(".prev", $this_par).click(function() {
				if (!$sliderData.noSlide) $sliderData.slidePrev();
			});
			$(".next", $this_par).click(function() {
				if (!$sliderData.noSlide) $sliderData.slideNext();
			});

			$sliderData.ev.on("updateNav sliderReady", function() {
				if ($sliderData.lockRight) {
					$(".next", $elParent).addClass("disabled");
				} else {
					$(".next", $elParent).removeClass("disabled");
				};

				if ($sliderData.lockLeft) {
					$(".prev", $elParent).addClass("disabled");
				} else {
					$(".prev", $elParent).removeClass("disabled");
				};
			});
			/*keyboard navigation*/
			window.addEventListener("keydown", checkKeyPressed, false); 
			function checkKeyPressed(e) {
				if (e.keyCode == "37") {
					if (!$sliderData.noSlide) $sliderData.slidePrev();
				} else if (e.keyCode == "39") { 
					if (!$sliderData.noSlide) $sliderData.slideNext();
				} 
			}


			// !Active slide indication and thumbnail mechanics: begin */
			$sliderData.ev.on("sliderReady beforeTransition", function() {
				$sliderData.slides.$items.removeClass("act");
				$sliderData.slides.$items.eq($sliderData.currSlide).addClass("act");

				$thumbsScrollerData.slides.$items.removeClass("act");
				$thumbsScrollerData.slides.$items.eq($sliderData.currSlide).addClass("act");

				if($sliderData.slides.$items.eq($sliderData.currSlide).hasClass("ts-video")){
					$sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-slider-overlay");
				}else if($sliderData.slides.$items.eq($sliderData.currSlide).find(".ps-link").length > 0){
					$sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-slider-overlay");
				}else{
					$sliderData.slides.$items.parents(".ts-wrap ").removeClass("hide-slider-overlay");
				};


				var actCaption = $sliderData.slides.$items.eq($sliderData.currSlide).find("figcaption").attr("class");

				$('.slide-caption > figcaption').removeClass("actCaption");
				$('.slide-caption > .'+actCaption).addClass("actCaption");
			});

			$sliderData.ev.on("afterTransition", function() {
				var viewportLeft	= -($thumbsScrollerData._unifiedX()),
					viewportRight	= viewportLeft + $thumbsScrollerData.wrap.width,
					targetLeft		= -$thumbsScrollerData.slides.position[$sliderData.currSlide],
					targetRight		= targetLeft + $thumbsScrollerData.slides.width[$sliderData.currSlide];

				targetLeft = targetLeft - 50;
				targetRight = targetRight + 50;

				if (targetLeft < viewportLeft) {

					for (i = $thumbsScrollerData.currSlide; i >= 0; i--) {
						targetLeft = targetLeft + 50;
						targetRight = targetRight - 50;

						var tempViewportLeft	= -$thumbsScrollerData.slides.position[i],
							tempViewportRight	= tempViewportLeft + $thumbsScrollerData.wrap.width;

						if (targetRight > tempViewportRight) {
							$thumbsScrollerData.slideTo(i+1);
							break;
						} 
						else if (i === 0) {
							$thumbsScrollerData.slideTo(0);
						}
					}
				}
				else if (targetRight > viewportRight) {
					$thumbsScrollerData.slideTo($sliderData.currSlide);
				};
			});

			$thumbsScroller.addClass("scroller-thumbnails");
			$thumbsScrollerData.slides.$items.each(function(i) {
				$(this).on("click", function(event) {
					var $this = $(this);

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
					$sliderData.slideTo(i);
				});
			});
			$sliderData.slides.$items.each(function(i) {
				$(this).on("click", function(event) {
					var $this = $(this);

					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
					$sliderData.slideTo(i);
				});
			});
			// !Active slide indication and thumbnail mechanics: end */

			var $this_par = $slider.parents(".photo-scroller");

			/* !- Autoplay */
			if( $sliderData.st.autoPlay.enabled ){
				$(".auto-play-btn", $this_par).addClass("paused");
			}
			
			$(".auto-play-btn", $this_par).on("click", function(e){
				e.preventDefault();
				var $this = $(this);
				if( $this.hasClass("paused")){
					$this.removeClass("paused");
					if (!$sliderData.noSlide) $sliderData.pause();
					$sliderData.st.autoPlay.enabled = false;
				}else{
					$this.addClass("paused");
					if (!$sliderData.noSlide) $sliderData.play();
					$sliderData.st.autoPlay.enabled = true;
				}
			});

		};

		/* !- Initialize slider */
		$(".photoSlider").photoSlider();
		
		/* !- Show slider*/

		$(".photoSlider").parents(".photo-scroller").css("visibility", "visible");

		
		function launchFullscreen(element) {
			if(element.requestFullscreen) {
				element.requestFullscreen();
			} else if(element.mozRequestFullScreen) {
				element.mozRequestFullScreen();
			} else if(element.webkitRequestFullscreen) {
				element.webkitRequestFullscreen();
			} else if(element.msRequestFullscreen) {
				element.msRequestFullscreen();
			}
		}
		function exitFullscreen() {
			if(document.exitFullscreen) {
				document.exitFullscreen();
			} else if(document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if(document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			}
		};

		/* !- Fullscreen button */
		if(!dtGlobals.isWindowsPhone){
			$(".full-screen-btn").each(function(){
				var $this = $(this),
					$thisParent = $this.parents(".photo-scroller");
				document.addEventListener("fullscreenchange", function () {
					if(!document.fullscreen){
						$this.removeClass("act");
						$thisParent.removeClass("full-screen");
						$("body, html").css("overflow", "");
					}
				}, false);
				document.addEventListener("mozfullscreenchange", function () {
					if(!document.mozFullScreen){
						$this.removeClass("act");
						$thisParent.removeClass("full-screen");
						$("body, html").css("overflow", "");
					}
				}, false);
				document.addEventListener("webkitfullscreenchange", function () {
					if(!document.webkitIsFullScreen){
						$this.removeClass("act");
						$thisParent.removeClass("full-screen");
						$("body, html").css("overflow", "");
						var scroller = $frame.data("thePhotoSlider");
						if(typeof scroller!= "undefined"){
							scroller.update();
						};
					}
				}, false);
			})

			$(".full-screen-btn").on("click", function(e){
				e.preventDefault();
				var $this = $(this),
					$thisParent = $this.parents(".photo-scroller"),
					$frame = $thisParent.find(".ts-wrap"),
					$thumbs = $thisParent.find(".scroller-thumbnails").data("thePhotoSlider"),
					$scroller = $frame.data("thePhotoSlider");
				$this.parents(".photo-scroller").find("figure").animate({"opacity": 0},150);
				if( $this.hasClass("act")){
				
					$this.removeClass("act");
					exitFullscreen();
					$thisParent.removeClass("full-screen");

					setTimeout(function(){
						$this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
					}, 300);
				}else{
					 $this.addClass("act");
					$thisParent.addClass("full-screen");
					launchFullscreen(document.documentElement);
					$("body, html").css("overflow", "hidden");
					setTimeout(function(){
						$this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
					}, 300)
				}
				var scroller = $frame.data("thePhotoSlider");
				if(typeof scroller!= "undefined"){
					scroller.update();
				};
			});
		}

		/* !- Show/hide thumbs */
		$photoScroller.each(function(){
			var $this = $(this);
			
			$(".btn-cntr, .slide-caption", $this).css({
				"bottom": parseInt($this.attr("data-thumb-height")) + 15
			});

			if( $this.hasClass("hide-thumbs")){
				$this.find(".hide-thumb-btn").addClass("act");
				$(".scroller-thumbnails", $this).css({
					"bottom": -(parseInt($this.attr("data-thumb-height")) +20)
				});
				$(".btn-cntr, .slide-caption", $this).css({
					"bottom": 5 + "px"
				});
			}
		});
		$(".hide-thumb-btn").on("click", function(e){
			e.preventDefault();
			var $this = $(this),
				$thisParent = $this.parents(".photo-scroller");
			if( $this.hasClass("act")){
				 $this.removeClass("act");
				$thisParent.removeClass("hide-thumbs");
				$(".scroller-thumbnails", $thisParent).css({
					"bottom": 0
				});
				$(".btn-cntr, .slide-caption", $thisParent).css({
					"bottom": parseInt($thisParent.attr("data-thumb-height")) + 15
				});

			}else{
				 $this.addClass("act");
				$thisParent.addClass("hide-thumbs");
				$(".scroller-thumbnails", $thisParent).css({
					"bottom": -(parseInt($thisParent.attr("data-thumb-height")) +20)
				});
				$(".btn-cntr, .slide-caption", $thisParent).css({
					"bottom": 5 + "px"
				});
			}
		});
	};
// })
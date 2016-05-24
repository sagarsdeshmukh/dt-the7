
/* #Shortcodes scroller
================================================== */
// jQuery(document).ready(function($) {

	$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").each(function(i) {
		var $this = $(this),
			$img = $this.find("img").eq(0),
			imgW = parseInt($img.attr("width")),
			imgH = parseInt($img.attr("height"));

		if (!$img.exists()) imgW = 280;

		var leftPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingLeft")),
			rightPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingRight")),
			addedW = 0;

		if (leftPadding > 0 && rightPadding > 0) addedW = leftPadding + rightPadding;

		$this.attr("data-width", imgW + addedW).css({
			width: imgW + addedW,
			opacity: 1
		});

		var $imgPar = $img.parent("a"),
			imgParW = $imgPar.width(),
			imgParH = (imgH * imgParW) / imgW;

		$img.parent("a").css({
			height: imgParH
		});

		$(".fs-entry-content:not(.buttons-on-img)", $this).css("opacity", "1");
	}).find("article").css("height", "100%");

	$(".text-on-img .fullwidth-slider .fs-entry, .description-on-hover .fs-entry, .dt-photos-shortcode .fs-entry").each(function() {
		var $this = $(this);

		$(".rollover-project", $this).css({
			"width": $this.attr("data-width"),
			"height": $this.attr("data-height")
		});
	});


	$.fn.shortcodesScroller = function() {
		var $el = $(this),
			slides = {},
			thumbs = "";

			slides.$items = $el.children(".fs-entry"),
			slides.count = slides.$items.length;

		$el.addClass("ts-cont");
		$el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

		var scroller = $el.parents(".ts-wrap"),
			$this_par = $el.parents(".slider-wrapper"),
			windowW = $window.width(),
			paddings = $this_par.attr("data-padding-side") ? parseInt($this_par.attr("data-padding-side")) : 0,
			$sliderAutoslide = ( 'true' === $this_par.attr("data-autoslide") ) ? true : false,
			$sliderAutoslideDelay = $this_par.attr("data-delay") && parseInt($this_par.attr("data-delay")) > 999 ? parseInt($this_par.attr("data-delay")) : 5000,
			$sliderLoop = ( 'true' === $this_par.attr("data-loop") ) ? true : false;

		var $sliderData = scroller.thePhotoSlider({
			mode: {
				type: "scroller"
			},
			sidePaddings: paddings,
			autoPlay: {
				enabled: $sliderAutoslide,
				delay: $sliderAutoslideDelay,
				loop: $sliderLoop
			}
		}).data("thePhotoSlider");

		$(".prev", $this_par).click(function() {
			if (!$sliderData.noSlide) $sliderData.slidePrev();
		});
		$(".next", $this_par).click(function() {
			if (!$sliderData.noSlide) $sliderData.slideNext();
		});

		$sliderData.ev.on("updateNav sliderReady", function() {
			if ($sliderData.lockRight) {
				$(".next", $this_par).addClass("disabled");
			} else {
				$(".next", $this_par).removeClass("disabled");
			};

			if ($sliderData.lockLeft) {
				$(".prev", $this_par).addClass("disabled");
			} else {
				$(".prev", $this_par).removeClass("disabled");
			};
			if ($sliderData.lockRight && $sliderData.lockLeft) {
				$this_par.addClass("hide-arrows");
			};
		});

		scroller.hover(
			function() {
				if($sliderAutoslide) {
					$sliderData._autoPlayPaused = false;
					$sliderData.pause();
					$sliderData._pausedByHover = true;
				}
			},
			function() {
				if($sliderAutoslide) {
					$sliderData._pausedByHover = false;
					if(!$sliderData._pausedByClick){
						$sliderData.play();
					}
				}
			}
		);
	};

	$(".slider-wrapper .blog-media").css({
		"height": ""
	});

	$(".fullwidth-slider ul.clearfix").each(function(){
		$(this).shortcodesScroller();
	});

	var $sliderWrapper = $(".slider-wrapper");

	$sliderWrapper.css("visibility", "visible");

	$sliderWrapper.each(function(){
		var $this = $(this),
			$thisUl = $this.find(".ts-wrap").data("thePhotoSlider");

		$this.append('<a href="#" class="auto-play-btn"></a>');

		$this.on("mouseenter", function(e) {
			$this.addClass("show-arrows");
		});
		$this.on("mouseleave", function(e) {
			//setTimeout(function(){
				$this.removeClass("show-arrows");
			//}, 200);
		});


		if( $thisUl.st.autoPlay.enabled ){
			$(".auto-play-btn", $this).addClass("paused");
		}
		$(".auto-play-btn", $this).on("click", function(e){
			e.preventDefault();
			var $this = $(this);
			if( $this.hasClass("paused")){
				$this.removeClass("paused");
				$thisUl._pausedByClick = true;
				if (!$thisUl.noSlide) $thisUl.pause();
				$thisUl.st.autoPlay.enabled = false;
			}else{
				$this.addClass("paused");
				$thisUl._pausedByClick = false;
				if (!$thisUl.noSlide) $thisUl.play();
				$thisUl.st.autoPlay.enabled = true;
			}
		});

	});
// })
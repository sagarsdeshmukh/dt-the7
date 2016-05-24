
/* #Royal Slider initialisation
================================================== */

// jQuery(document).ready(function($) {

	if ($(".rsHomePorthole").exists()) {
		var portholeSlider = {};
			portholeSlider.container = $("#main-slideshow");
			portholeSlider.width = portholeSlider.container.attr("data-width") ? parseInt(portholeSlider.container.attr("data-width")) : 1280;
			portholeSlider.height = portholeSlider.container.attr("data-height") ? parseInt(portholeSlider.container.attr("data-height")) : 720;
			portholeSlider.autoslide = portholeSlider.container.attr("data-autoslide") && parseInt(portholeSlider.container.attr("data-autoslide")) > 999 ? parseInt(portholeSlider.container.attr("data-autoslide")) : 5000;
			portholeSlider.scale = portholeSlider.container.attr("data-scale") ? portholeSlider.container.attr("data-scale") : "fill";
			portholeSlider.paused = portholeSlider.container.attr("data-paused") ? portholeSlider.container.attr("data-paused") : true;
			portholeSlider.hendheld = $window.width() < 740 && dtGlobals.isMobile ? true : false;
		
		$("#main-slideshow-content").appendTo(portholeSlider.container);

		portholeSlider.api = $(".rsHomePorthole").royalSlider({
			autoScaleSlider: true,
			autoScaleSliderWidth: portholeSlider.width,
			autoScaleSliderHeight: portholeSlider.height,
			autoPlay: {
				enabled: !portholeSlider.hendheld,
				stopAtAction: false,
				pauseOnHover: false,
				delay: portholeSlider.autoslide
			},
			imageScaleMode: portholeSlider.scale,
			imageScalePadding: 0,
			numImagesToPreload: 999,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			loopRewind: true,
			arrowsNav: false,
			globalCaption: true,
			controlNavigation: !portholeSlider.hendheld ? 'porthole' : 'none',
			thumbs: {
				orientation: 'vertical',
				drag: false,
				touch: false,
				spacing: 10,
				firstMargin: false,
				appendSpan: false
			},
			block: {
				fadeEffect: true,
				moveEffect: 'bottom',
				moveOffset: 5
			}
		}).data("royalSlider");
		var $_this = portholeSlider.container,
			$_this_childs = $_this.find(".rsSlide").size();
		if ($_this_childs < 2) {
			$(".rsThumbs", $_this).hide();
			portholeSlider.api._isMove = false;
			$_this.find(".rsOverflow").css("cursor", "auto")
		};

		if (portholeSlider.paused == "true") {
			$(".rsHomePorthole").royalSlider("stopAutoPlay");
		}
	};

	$(".slider-post").each(function(){
		$(this).royalSlider({
			autoScaleSlider: true,
			imageScaleMode: "fit",
			autoScaleSliderWidth: $(this).attr("data-width"),
			autoScaleSliderHeight: $(this).attr("data-height"),
			imageScalePadding: 0,
			numImagesToPreload: 6,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			globalCaption:true
		});
	});

	$(".slider-simple").not(".shortcode-royal-slider").each(function(){
		$(this).royalSlider({
			autoScaleSlider: true,
			imageScaleMode: "fit",
			autoScaleSliderWidth: $(this).attr("data-width"),
			autoScaleSliderHeight: $(this).attr("data-height"),
			imageScalePadding: 0,
			numImagesToPreload: 6,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			globalCaption:true
		});
	});

	$(".shortcode-royal-slider").each(function(){
		var shortcodeSlider = {};
		shortcodeSlider.container = $(this);
		shortcodeSlider.container.paused = shortcodeSlider.container.attr("data-paused") ? shortcodeSlider.container.attr("data-paused") : true;
			shortcodeSlider.container.hendheld = $window.width() < 740 && dtGlobals.isMobile ? true : false;
		$(this).royalSlider({
			autoScaleSlider: true,
			imageScaleMode: "fit",
			autoScaleSliderWidth: $(this).attr("data-width"),
			autoScaleSliderHeight: $(this).attr("data-height"),
			autoPlay: {
				enabled: !shortcodeSlider.container.hendheld,
				stopAtAction: false,
				pauseOnHover: false,
				delay: parseInt( $(this).attr("data-autoslide") )
			},
			imageScalePadding: 0,
			numImagesToPreload: 6,
			slidesOrientation: "horizontal",
			disableResponsiveness: false,
			globalCaption:true
		});
		if (shortcodeSlider.container.paused == "true") {
			shortcodeSlider.container.royalSlider("stopAutoPlay");
		}
	});

	$(".slider-content .preload-me").loaded(null, function() {
		$(".slider-content").each(function(){
			var $this = $(this),
				autoslide = $this.attr("data-autoslide") && parseInt($this.attr("data-autoslide")) > 999 ? parseInt($this.attr("data-autoslide")) : 5000;		
				hendheld = !($window.width() < 740 && dtGlobals.isMobile) && $this.attr("data-autoslide") ? true : false;

			$this.royalSlider({
				autoPlay: {
					enabled: hendheld,
					stopAtAction: false,
					pauseOnHover: false,
					delay: autoslide
				},
				autoHeight: true,
				controlsInside: false,
				fadeinLoadedSlide: false,
				controlNavigationSpacing: 0,
				controlNavigation: 'bullets',
				imageScaleMode: 'none',
				imageAlignCenter:false,
				loop: false,
				loopRewind: true,
				numImagesToPreload: 6,
				keyboardNavEnabled: true

			}).data("royalSlider");
		});
	}, true);
// })
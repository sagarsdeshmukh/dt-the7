/* !Animation Core */

/*
 * Viewport - jQuery selectors for finding elements in viewport
 *
 * Copyright (c) 2008-2009 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://www.appelsiini.net/projects/viewport
 *
 */

	$.belowthefold = function(element, settings) {
		var fold = $window.height() + $window.scrollTop();
		return fold <= $(element).offset().top - settings.threshold;
	};
	$.abovethetop = function(element, settings) {
		var top = $window.scrollTop();
		return top >= $(element).offset().top + $(element).height() - settings.threshold;
	};
	$.rightofscreen = function(element, settings) {
		var fold = $window.width() + $window.scrollLeft();
		return fold <= $(element).offset().left - settings.threshold;
	};
	$.leftofscreen = function(element, settings) {
		var left = $window.scrollLeft();
		return left >= $(element).offset().left + $(element).width() - settings.threshold;
	};
	$.inviewport = function(element, settings) {
		return !$.rightofscreen(element, settings) && !$.leftofscreen(element, settings) && !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
	};

	$.extend($.expr[':'], {
		"below-the-fold": function(a, i, m) {
			return $.belowthefold(a, {threshold : 0});
		},
		"above-the-top": function(a, i, m) {
			return $.abovethetop(a, {threshold : 0});
		},
		"left-of-screen": function(a, i, m) {
			return $.leftofscreen(a, {threshold : 0});
		},
		"right-of-screen": function(a, i, m) {
			return $.rightofscreen(a, {threshold : 0});
		},
		"in-viewport": function(a, i, m) {
			return $.inviewport(a, {threshold : -30});
		}
	});


	// !- Animation "onScroll" loop
	function doAnimation() {
		if(!dtGlobals.isMobile){
			if($(".animation-at-the-same-time").length > 0 || $(".animate-element").length > 0){
				var j = -1;
				$(".animation-at-the-same-time:in-viewport").each(function () {
					var $this = $(this),
						$thisElem = $this.find(".animate-element");
					//if (!$thisElem.hasClass("start-animation") && !$thisElem.hasClass("animation-triggered")) {
						$thisElem.addClass("animation-triggered");
						$this.find(".animate-element:not(.start-animation)").addClass("start-animation");
					//};
				});
				$(".animate-element:not(.start-animation):in-viewport").each(function () {
					var $this = $(this);
					if (!$this.parents(".animation-at-the-same-time").length > 0) {

						if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
							$this.addClass("animation-triggered");
							j++;
							setTimeout(function () {
								$this.addClass("start-animation");
								if($this.hasClass("skills")){
									$this.animateSkills();
								};
							}, 200 * j);
						};
					};
				});
			}
		}
		else {
			$(".skills").animateSkills();
		};
	};


	// !- Fire animation
	setTimeout(function() {
		doAnimation();
	}, 50);

	if (!dtGlobals.isMobile ){
		$window.on("scroll", function () {
			doAnimation();
		});
	};
/*!-Before After*/
jQuery(document).ready(function($) {
	if($(".twentytwenty-container").length > 0){
		$.fn.twentytwenty = function(options) {
			var options = $.extend({
				default_offset_pct: 0.5,
				orientation: 'horizontal',
				navigation_follow: false
			}, options);
			return this.each(function() {

				var sliderPct = options.default_offset_pct;
				var container = $(this);
				var sliderOrientation = options.orientation;
				var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
				var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';
				var slideOnHover = options.navigation_follow;

				container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
				var beforeImg = container.find("img:first"),
					afterImg = container.find("img:last"),
					beforeImgAlt = beforeImg.attr("title"),
					afterImgAlt = afterImg.attr("title");
				container.append("<div class='twentytwenty-handle'></div>");
				var slider = container.find(".twentytwenty-handle");
				slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
				slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
				container.addClass("twentytwenty-container");
				beforeImg.addClass("twentytwenty-before");
				afterImg.addClass("twentytwenty-after");
				if(typeof beforeImgAlt != 'undefined' && beforeImgAlt && beforeImgAlt.length > 0) {
					container.append("<div class='twentytwenty-before-label'>" + beforeImgAlt + "</div>");
				};
				if(typeof afterImgAlt != 'undefined' && afterImgAlt && afterImgAlt.length > 0) {
					container.append("<div class='twentytwenty-after-label'>" + afterImgAlt + "</div>");
				}

				var calcOffset = function(dimensionPct) {
					var w = beforeImg.width();
					var h = beforeImg.height();
					return {
						w: w+"px",
						h: h+"px",
						cw: (dimensionPct*w)+"px",
						ch: (dimensionPct*h)+"px"
					};
				};

				var adjustContainer = function(offset) {
					if (sliderOrientation === 'vertical') {
						beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
					}
					else {
						beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
					}
					container.css("height", offset.h);
				};

				var adjustSlider = function(pct) {
					var offset = calcOffset(pct);
					slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
					adjustContainer(offset);
				};

				$(window).on("resize.twentytwenty", function(e) {
					adjustSlider(sliderPct);
				});

				var offsetX = 0;
				var imgWidth = 0;
				slider.on("movestart", function(e) {
					if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
						e.preventDefault();
					}
					else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
						e.preventDefault();
					}
					container.addClass("active");
					container.removeClass("active-click");
					offsetX = container.offset().left;
					offsetY = container.offset().top;
					imgWidth = beforeImg.width(); 
					imgHeight = beforeImg.height();
				});

				slider.on("moveend", function(e) {
					container.removeClass("active");
				});

				slider.on("move", function(e) {
					if (container.hasClass("active")) {
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					}
				});
				if (!slideOnHover && !container.hasClass("active")) {
					container.on("mouseup", function(e) {
						container.removeClass("active-click");
					});
					container.on("mousedown", function(e) {
						//container.addClass("active");
						container.addClass("active-click");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width(); 
						imgHeight = beforeImg.height();
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					});
				};

				container.find("img").on("mousedown", function(event) {
					event.preventDefault();
				});

				if (slideOnHover) {
					container.on("mouseenter", function (e) {
						container.addClass("active");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width();
						imgHeight = beforeImg.height()
					});
					container.on("mouseleave", function (e) {
						container.removeClass("active")
					});
					container.on("mousemove", function (e) {
						if (container.hasClass("active")) {
							sliderPct = sliderOrientation === "vertical" ? (e.pageY - offsetY) / imgHeight : (e.pageX - offsetX) / imgWidth;
							if (sliderPct < 0) {
								sliderPct = 0
							}
							if (sliderPct > 1) {
								sliderPct = 1
							}
							adjustSlider(sliderPct)
						}
					});
				};

				$(window).trigger("resize.twentytwenty");
			});
		};
	}
})
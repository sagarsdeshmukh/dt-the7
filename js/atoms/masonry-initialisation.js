
/* #Masonry
================================================== */
// jQuery(document).ready(function($) {
	// var $html = $("html"),
	// 	$body = $("body");
	// !- Calculate columns size
	$.fn.calculateColumns = function(minWidth, colNum, padding, mode) {
		return this.each(function() {
			var $container = $(this),
				containerWidth = $container.width() - 1,
				containerPadding = (padding !== false) ? padding : 20,
				containerID = $container.attr("data-cont-id"),
				tempCSS = "",
				first = false;

			if(typeof(minWidth)==='undefined') minWidth = 200;
			if(typeof(colNum)==='undefined') colNum = 6;


			for ( ; Math.floor(containerWidth/colNum) < minWidth; ) {
				colNum--;
				if (colNum <= 1) break;
			}

			if (!$("#col-style-id-"+containerID).exists()) {

				if(!$html.hasClass("old-ie")){// IE
						var jsStyle = document.createElement("style");
						jsStyle.id = "col-style-id-"+containerID;
						jsStyle.appendChild(document.createTextNode(""));
						document.head.appendChild(jsStyle);
					
				}
			} else {
				var jsStyle = document.getElementById("col-style-id-"+containerID);
			}


			var $style = $("#col-style-id-"+containerID);

			var singleWidth,
				doubleWidth,
				normalizedPadding,
				normalizedMargin,
				normalizedPaddingTop;

			if (containerPadding < 10) {
				normalizedPadding = 0;
				normalizedPaddingTop = 0;
			}
			else {
				normalizedPaddingTop = containerPadding - 5;
				normalizedPadding = containerPadding - 10;
			};
			if (containerPadding == 0) {
				normalizedMargin = 0;
			}
			else {
				normalizedMargin = -containerPadding;
			};

			if (mode == "px") {
				singleWidth = Math.floor(containerWidth / colNum)+"px";
				doubleWidth = Math.floor(containerWidth  / colNum)*2+"px";
			}
			else {
				singleWidth = Math.floor(100000 / colNum)/1000+"%";
				doubleWidth = Math.floor(100000 / colNum)*2/1000+"%";
			};
			if ( $(".cont-id-"+containerID+"").not(".bg-under-post").hasClass("description-under-image") ) {
				if (colNum > 1) {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+containerPadding+"px -"+normalizedPadding+"px ; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+containerPadding+"px "+normalizedPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": -containerPadding + "px",
							"margin-left": -containerPadding + "px",
							"margin-bottom": -normalizedPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": -normalizedPadding + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth,
							"padding-top": normalizedPaddingTop + "px",
							"padding-right": containerPadding + "px",
							"padding-left": containerPadding + "px",
							"padding-bottom": normalizedPadding + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell.double-width").css({
							"width": doubleWidth
						});
					}
				}
				else {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+normalizedPadding+"px -"+containerPadding+"px ; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+normalizedPadding+"px "+containerPadding+"px; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": -normalizedPadding + "px",
							"margin-left": -normalizedPadding + "px",
							"margin-bottom": -containerPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": -normalizedPaddingTop + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": -normalizedPadding + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth,
							"padding-top": normalizedPaddingTop + "px",
							"padding-right": normalizedPadding + "px",
							"padding-left": normalizedPadding + "px",
							"padding-bottom": containerPadding + "px"
						});
					}
				};
			}else {
				if (colNum > 1) {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px  "+containerPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+";  padding: "+containerPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin": -containerPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": normalizedMargin + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": normalizedMargin + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth +"px",
							"padding": containerPadding +"px"
						});
						$(".cont-id-"+containerID+" > .wf-cell.double-width").css({
							"width": doubleWidth +"px"
						});
					}
				}
				else {
					tempCSS = " \
						.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
						.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px "+containerPadding+"px; } \
						.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+containerPadding+"px; } \
					";
					if($html.hasClass("old-ie")){
						$(".cont-id-"+containerID+"").css({
							"margin": -containerPadding + "px"
						});
						$(".full-width-wrap .cont-id-"+containerID+"").css({
							"margin-top": normalizedMargin + "px",
							"margin-right": containerPadding + "px",
							"margin-left": containerPadding + "px",
							"margin-bottom": normalizedMargin + "px"
						});
						$(".cont-id-"+containerID+" > .wf-cell").css({
							"width": singleWidth,
							"padding": containerPadding + "px"
						});
					}
				};
			};
			if(!$html.hasClass("old-ie") ){
					$style.html(tempCSS);
					var newRuleID = jsStyle.sheet.cssRules.length;
					jsStyle.sheet.insertRule(".webkit-hack { }", newRuleID);
					jsStyle.sheet.deleteRule(newRuleID);
				
			}

			$container.trigger("columnsReady");

		});
	};

	// !- Initialise slider
	$.fn.initSlider = function() {
		return this.each(function() {
		
			var $_this = $(this),
				attrW = $_this.data('width'),
				attrH = $_this.data('height');

			if ($_this.hasClass("royalReady")) {
				return;
			}

			$_this.postTypeScroller();

			$_this.addClass("royalReady");
			
		});
	};
	$.fn.IsoLayzrInitialisation = function(container) {

		return this.each(function() {
			var $this = $(this);

			var layzrMsnr = new Layzr({
				container: container,
				selector: '.iso-lazy-load',
				attr: 'data-src',
				attrSrcSet: 'data-srcset',
				retinaAttr: 'data-src-retina',
				threshold: 30,
				before: function() {

					// For fixed-size images with srcset; or have to be updated on window resize.
					this.setAttribute("sizes", this.width+"px");
				},
				callback: function() {
					this.classList.add("iso-layzr-loaded");
					var $this =  $(this);
		         	$this.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
						setTimeout(function(){
							$this.parent().removeClass("layzr-bg");
						}, 200)
					});
				}
			});
		});
		
	};

	/* !Containers of masonry and grid content */
	var	$isoCollection = $(".iso-container"),
		$gridCollection = $(".iso-grid:not(.jg-container, .iso-container), .blog.layout-grid .wf-container.description-under-image:not(.jg-container, .iso-container), .grid-masonry:not(.iso-container), .shortcode-blog-posts.iso-grid"),
		$combinedCollection = $isoCollection.add($gridCollection),
		$isoPreloader = dtGlobals.isoPreloader = $('<div class="iso-preloader pace pace-active"><div class="pace-activity"></div></div>').appendTo("body").hide();
		$combinedCollection.addClass("dt-isotope");

	/* !Smart responsive columns */
	if ($combinedCollection.exists()) {
		$combinedCollection.each(function(i) {
			var $container = $(this),
				contWidth = parseInt($container.attr("data-width")),
				contNum = parseInt($container.attr("data-columns"));
			var contPadding = parseInt($container.attr("data-padding"));
			
			$container.addClass("cont-id-"+i).attr("data-cont-id", i);
			$container.calculateColumns(contWidth, contNum, contPadding, "px");
			if(contPadding > 10){
				$container.addClass("mobile-paddings");
			}

			$window.on("debouncedresize", function () {
				$container.calculateColumns(contWidth, contNum, contPadding, "px");

				if(contPadding > 10){
					$container.addClass("mobile-paddings");
				}
			});
		});
	}

	if(!dtGlobals.isPhone){
		// !- Responsive height hack
		$.fn.heightHack = function() {
			//if(!$(".layzr-loading-on").length > 0){

				return this.each(function() {
					var $img = $(this);
					if ($img.hasClass("height-ready") || $img.parents(".post-rollover").exists()) {
						return;
					}

					var	imgWidth = parseInt($img.attr('width')),
						imgHeight = parseInt($img.attr('height')),
						imgRatio = imgWidth/imgHeight;

					if($img.parents(".testimonial-vcard, .dt-format-gallery, .shortcode-blog-posts.iso-grid ").exists()) {
						$img.wrap("<div />");
					};

					$img.parent().css({
						"padding-bottom" : 100/imgRatio+"%",
						"height" : 0,
						"display" : "block"
					});

					$img.attr("data-ratio", imgRatio).addClass("height-ready");
					
				});
			//}
		};

		/* !colums size hack for layzr */
		// $.fn.layzrHack = function() {
		// 	//if($(".layzr-loading-on").length > 0){

		// 		return this.each(function() {
		// 			var $img = $(this);
		// 			if ($img.hasClass("layzr-ready")) {
		// 				return;
		// 			}

		// 			// var	imgWidth = parseInt($img.attr('width')),
		// 			// 	imgHeight = parseInt($img.attr('height')),
		// 			var imgRatio = parseInt($img.attr('width'))/parseInt($img.attr('height')),
		// 				imgWidth = $img.width(),
		// 				imgHeight = imgWidth/imgRatio;
					
		// 			$img.css({
		// 				"height": imgHeight,
		// 				"width": imgWidth
		// 			});
		// 			if($img.parents().hasClass("effect-sarah") || $img.parents().hasClass("effect-layla") || $img.parents().hasClass("effect-bubba")){
		// 				$img.parent().css({
		// 					"padding-bottom" : (100/imgRatio) +"%",
		// 					"height" : 0,
		// 					"display" : "block"
		// 				});
		// 			}
		// 			$img.addClass("layzr-ready");

		// 		});
		// 	//}
		// };

		// $.fn.deleteLayzrHack = function() {
		// 	if($(".layzr-loading-on").length > 0){

		// 		return this.each(function() {
		// 			var $img = $(this);
		// 			if ($img.hasClass("layzr-off-ready")) {
		// 				return;
		// 			}
					
		// 			$img.css({
		// 				"height": "",
		// 				"width": ""
		// 			});

		// 			$img.addClass("layzr-off-ready");

		// 		});
		// 	}
		// };
			

		/* !Isotope initialization */
		$.fn.IsoInitialisation = function(item, mode) {

			return this.each(function() {
				var $this = $(this);
				if ($this.hasClass("iso-item-ready")) {
					return;
				}
				$this.isotope({
					itemSelector : item,
					transformsEnabled: false,
					isResizeBound: false,
					layoutMode : mode,
					transitionDuration: 0,
					isInitLayout: false,
					/*animationEngine: typeOfAnimation,*/
					masonry: { columnWidth: 1 },
					getSortData : {
						date : function( $elem ) {
							return $($elem).attr('data-date');
						},
						name : function( $elem ) {
							return $($elem).attr('data-name');
						}
					}
				});
				$this.addClass("iso-item-ready");

			});
			
		};
		

		
		/* !Masonry and grid layout */

		/* !Filter: */
		//var $container = $('.iso-container, .portfolio-grid');
		$('.iso-container, .portfolio-grid').each(function(){
			var $container = $(this);
			$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-categories a').on('click.presscorFilterCategories', function(e) {
				var selector = $(this).attr('data-filter');

				$container.isotope({ filter: selector });
				return false;
			});

			// !- filtering
			$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-extras .filter-by a').on('click', function(e) {
				var sorting = $(this).attr('data-by'),
					sort = $(this).parents('.filter-extras').find('.filter-sorting > a.act').first().attr('data-sort');

				$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
				return false;
			});

			// !- sorting
			$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-extras .filter-sorting a').on('click', function(e) {
				var sort = $(this).attr('data-sort'),
					sorting = $(this).parents('.filter-extras').find('.filter-by > a.act').first().attr('data-by');

				$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
				return false;
			});
		});


		/* !Masonry layout */
		if ($isoCollection.exists() || $gridCollection.exists() ) {

			// Show preloader
			$isoPreloader.fadeIn(50);

			$combinedCollection.each(function() {
				var $isoContainer = $(this);

				// Hack to make sure that masonry will correctly calculate columns with responsive images height. 
				$(".preload-me", $isoContainer).heightHack();
				//$(".iso-lazy-load", $isoContainer).layzrHack();
				// Slider initialization
				$(".slider-masonry", $isoContainer).initSlider();
				$isoContainer.one("columnsReady", function() {

					//Call isotope
					if($isoContainer.hasClass("iso-container")){
						$isoContainer.IsoInitialisation('.iso-item', 'masonry');
					}else{
						$isoContainer.IsoInitialisation('.wf-cell', 'fitRows');
					}

					$isoContainer.isotope('on', 'layoutComplete', function (objArray){
					    //callback isotope on load ...
					    for(var i = 0; i < objArray.length; i++){
					        var obj = objArray[i];
					        var  $container = $(this);
					       $isoContainer.trigger("IsoReady");
					    }
					});
					/* !Call layzr on isotope layoutComplete */
					$isoContainer.one("IsoReady", function() {
					
						//$(".iso-lazy-load", $isoContainer).deleteLayzrHack();
						$isoContainer.isotope("layout");

						/*Init layzr*/
						$isoContainer.IsoLayzrInitialisation();

					});

					// Recalculate everything on window resize
					$window.on("columnsReady", function () {
						if($(".slider-masonry", $isoContainer).hasClass("royalReady")){
							var scroller = $(".slider-masonry", $isoContainer).parents(".ts-wrap").data("thePhotoSlider");
							if(typeof scroller!= "undefined"){
								scroller.update();
							};
						
							// $(".royalSlider", $isoContainer).each(function() {
							// 	//$(this).data("royalSlider").updateSliderSize();
							// });
						}

						$isoContainer.isotope("layout");
						
					});
				});
			});

			// Hide preloader
			$isoPreloader.stop().fadeOut(300);

		};
	};

	/*!- Phone only*/
	if(dtGlobals.isPhone){
		$(".slider-masonry").initSlider();
		$window.on("columnsReady", function () {
			$(".royalSlider").each(function() {
				//$(this).data("royalSlider").updateSliderSize();
			});

			var scroller = $(".slider-masonry").parents(".ts-wrap").data("thePhotoSlider");
			if(typeof scroller!= "undefined"){
				scroller.update();
			};


		});

		$(".filter-extras").css("display", "none");

		var $container = $(".filter").next('.iso-container, .portfolio-grid'),
			$items = $(".iso-item, .wf-cell", $container),
			selector = null;
			$(".mobile-true .iso-container, .mobile-true .iso-grid").IsoLayzrInitialisation();


		// if($(".slider-masonry").length > 0){
		// 	$(".slider-masonry").data("royalSlider").ev.on('rsAfterContentSet', function() {

		// 		$(".mobile-true .slider-masonry").IsoLayzrInitialisation();

		// 	});
		// }
	
		$(".filter-categories:not(.iso-filter) a").each(function(){
			$(this).on('click', function(e) {
				e.preventDefault();
				selector = $(this).attr('data-filter');
				$items.css("display", "none");
				$items.filter(selector).css("display", "block");
				$(".mobile-true .slider-masonry").IsoLayzrInitialisation();
			});
		});

	};
// })
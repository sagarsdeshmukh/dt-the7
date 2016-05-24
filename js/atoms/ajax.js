
/* #AJAX
================================================== */
// jQuery(document).ready(function($) {

	$.fn.inView = function(){
		//Window Object
		var win = $(window);
		//Object to Check
		obj = $(this);
		//the top Scroll Position in the page
		var scrollPosition = win.scrollTop();
		//the end of the visible area in the page, starting from the scroll position
		var visibleArea = win.scrollTop() + win.height();
		//the end of the object to check
		var objEndPos = (obj.offset().top + 20);
		return(visibleArea >= objEndPos && scrollPosition <= objEndPos ? true : false);
	};

	// 4 Alla & Danil: we need to unify all ajax and masonry and other stuff in this manner:
	function loadingEffects() {
		//if(dtGlobals.isiPhone) return;

		var $isotope = $(".dt-isotope"),
			$grid = $(".iso-grid .wf-cell:not(.shown)");

		if ($grid.exists()) {
			precessEffects($grid);
		}

		if (!$isotope.exists()) {
			var $isoFallback = $(".iso-item:not(.shown)");

			if (!$isoFallback.exists()) return;
			precessEffects($isoFallback);
		}
		else {
			$isotope.each(function() {
				//console.log( $(this).data("isotope").items(element))
				/*var $atoms = $(this).data("isotope").$allAtoms;*/
				var $atoms = $(this).find(".wf-cell");
				if (!$atoms.exists()) return;
				/*if (typeof $atoms == 'undefined') return;*/
				precessEffects($atoms);
			});
		};
	};

	function precessEffects($atoms) {
		var k = 0;

		$atoms.each(function () {
			var $this = $(this);
			if($(".mobile-true").length > 0 || $this.parents(".loading-effect-none").length > 0){
				if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered")) {
					$this.addClass("animation-triggered");
					setTimeout(function () {
						if ($this.hasClass("animation-triggered")) { 
							$this.removeClass("animation-triggered").addClass("shown");
						};
					}, 200);
				};
			}else{
				if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered") && $this.inView()) {
					$this.addClass("animation-triggered");
					k++;
					setTimeout(function () {
						if ($this.hasClass("animation-triggered")) { 
							$this.removeClass("animation-triggered").addClass("shown");
						};
					}, 100 * k);
				};
			}
		});
	};

	function resetEffects() {
		$(".iso-item.shown, .iso-grid .wf-cell.shown").removeClass("start-animation").removeClass("animation-triggered").removeClass("shown");
	};

	var dtAjaxing = {
		xhr: false,
		settings: false,
		lunch: function( settings ) {

			var ajaxObj = this;

			if ( settings ) {
				this.settings = settings;
			}

			if ( this.xhr ) {
				this.xhr.abort();
			}

			var action = 'presscore_template_ajax';

			this.xhr = $.post(
				settings.ajaxurl,
				{
					action : action,
					postID : settings.postID,
					paged : settings.paged,
					targetPage : settings.targetPage,
					term : settings.term,
					orderby : settings.orderBy,
					order : settings.order,
					nonce : settings.nonce,
					visibleItems : settings.visibleItems,
					contentType : settings.contentType,
					pageData : settings.pageData,
					sender : settings.sender
				},
				function( responce ) {

					if ( responce.success ) {

						var $responceItems = jQuery(responce.html),
							$isoContainer = settings.targetContainer,

							contWidth = parseInt($isoContainer.attr("data-width")),
							contMaxWidth = parseInt($isoContainer.attr("data-max-width")),
							contPadding = parseInt($isoContainer.attr("data-padding"));
							isIsotope = 'grid' == settings.layout || 'masonry' == settings.layout,
							itemsToDeleteLength = 0,
							trashItems = new Array(),
							sortBy = responce.orderby.replace('title', 'name'),
							sortAscending = ('asc' == responce.order.toString());

						if ( dtGlobals.isPhone ) {
							isIsotope = false;
						}

						if ( responce.newNonce ) {
							dtLocal.ajaxNonce = responce.newNonce;
						}

						if ( typeof responce.itemsToDelete != 'undefined' ) {
							itemsToDeleteLength = responce.itemsToDelete.length;
						}

						// if not mobile isotope with spare parts
						if ( isIsotope && itemsToDeleteLength > 0 ) {

							for( var i = 0; i < responce.itemsToDelete.length; i++ ) {
								trashItems.push('.wf-cell[data-post-id="' + responce.itemsToDelete[i] + '"]');
							}

							$isoContainer.isotope('remove', $isoContainer.find(trashItems.join(',')));

						// if mobile or not isotope and sender is filter or paginator
						} else if ( !isIsotope && ('filter' == settings.sender || 'paginator' == settings.sender) ) {

							$isoContainer.find('.wf-cell, article').remove();
						}

						if ( $responceItems.length > 0 ) {

							// append new items
							$isoContainer.append($responceItems);
							dtGlobals.ajaxContainerItems = $isoContainer.find('div.wf-cell').not('.animation-triggered');

							// for isotope - insert new elements
							if ( isIsotope ) {

								$(".preload-me", $isoContainer).heightHack();
								$(".slider-masonry, .slider-simple", $isoContainer).initSlider();

								$isoContainer.isotope('addItems', $responceItems);

								if ( 'media' != settings.contentType ) {
									$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
								} else {
									$isoContainer.isotope({ sortBy: 'original-order' });
								}

								$isoContainer.isotope("layout");

								if ( 'masonry' == settings.layout ) {
									$("> .iso-item", $isoContainer).showItems();
								} else if ( 'grid' == settings.layout ) {
									$("> .wf-cell", $isoContainer).showItems();
								}

								ajaxObj.init();

							// all other cases - append new elements
							} else {

								// mobile isotope filtering emulation
								if ( dtGlobals.isPhone && ('masonry' == settings.layout || 'grid' == settings.layout) ) {}

								$(".slider-masonry, .slider-simple", $isoContainer).initSlider();

								if ( 'jgrid' == settings.layout ) {
									$isoContainer.collagePlus(dtGlobals.jGrid);
								}

								ajaxObj.init();

							}

							if ( typeof settings.afterSuccessInit != 'undefined' ) {
								settings.afterSuccessInit( responce );
							}

							$window.trigger('dt.ajax.content.appended');

						} else if ( isIsotope ) {

							// if no responce items - reorder isotope
							$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
						}

					}

					if ( typeof settings.afterResponce != 'undefined' ) {
						settings.afterResponce( responce );
					}

					loadingEffects();
				}
			);
		},
		init : function() {
			switch ( this.settings.contentType ) {
				case 'portfolio' :
					this.initPortfolio();
					break;

				case 'albums' :
					this.initAlbums();
					break;

				case 'media' :
					this.initMedia();
					break;

				case 'blog':
					this.basicInit();
					break;
				 case 'testimonials':
					this.basicInit();
					break;
			}
		},
		initPortfolio : function() {
			this.basicInit();
		},
		initAlbums : function() {
			this.basicInit();
		},
		initMedia : function() {
			this.basicInit();

			$(".no-touch .albums .rollover-content, .no-touch .media .rollover-content").on("click", function(e){
				if ( $(e.target).is("a") ) {
					return true;
				}
				$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
			});

		},
		basicInit : function() {
			retinizer();

			var $container = this.settings.targetContainer;

			$('.dt-gallery-mfp-popup', $container).not('.mfp-ready').on('click', function(){
				var $this = $(this),
					$container = $this.parents('article.post');

				if ( $container.length > 0 ) {
					var $target = $container.find('.dt-gallery-container a.dt-mfp-item');

					if ( $target.length > 0 ) {
						$target.first().trigger('click');
					}
				}

				return false;
			}).addClass('mfp-ready');

			// trigger click on first a.dt-mfp-item in the container
			$('.dt-trigger-first-mfp', $container).not('.mfp-ready').on('click', function(){
				var $this = $(this),
					$container = $this.parents('article.post');

				if ( $container.length > 0 ) {
					var $target = $container.find('a.dt-mfp-item');

					if ( $target.length > 0 ) {
						$target.first().trigger('click');
					}
				}

				return false;
			}).addClass('mfp-ready');

			// single opup
			$('.dt-single-image', $container).not('.mfp-ready').magnificPopup({
				type: 'image'
			}).addClass('mfp-ready');

			$('.dt-single-video', $container).not('.mfp-ready').magnificPopup({
				type: 'iframe'
			}).addClass('mfp-ready');

			$('.dt-single-mfp-popup', $container).not('.mfp-ready').magnificPopup({
				type: 'image'
			}).addClass('mfp-ready');


			$(".dt-gallery-container", $container).not('.mfp-ready').each(function(){
				$(this).addClass('mfp-ready').magnificPopup( $.extend( {}, dtGlobals.magnificPopupBaseConfig, {
					delegate: 'a.dt-mfp-item',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					}
				}));
			});

			$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content", $container).addRollover();

			$('.no-touch .hover-grid .rollover-project').each( function() { $(this).hoverdir(); } );
			$('.no-touch .hover-grid-reverse .rollover-project ').each( function() { $(this).hoverdir({
				inverse : true
			}); } );
			$(".touch .rollover-project a.link.show-content, .hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
				e.preventDefault();
			});
			$(".rollover, .post-rollover, .rollover-video").clickEffectPics();
			$(".rollover.material-click-effect, .post-rollover.material-click-effect, .rollover-video.material-click-effect").clickMaterialEffect();

			if($(".small-portfolio-icons").length > 0){

				$('.links-container a').each(function(){
					var $this = $(this);
					$this.addClass("waves-effect");
				});
				Waves.displayEffect();
			}

			 $(".touch .rollover-project").touchNewHover();

			// $(".touch .links-container > a").touchHoverLinks();
			$(".no-touch .rollover-project:not(.rollover-active) .rollover-content, .no-touch .buttons-on-img:not(.rollover-active) .rollover-content").triggerHoverClick();

			$(".no-touch .rollover-project.forward-post").forwardToPost();

			$(".no-touch .rollover-project.rollover-active, .no-touch .buttons-on-img.rollover-active").followCurentLink();

			$(".albums .rollover-project, .albums .buttons-on-img").triggerAlbumsClick();
			$(".touch .rollover-project.forward-post").touchforwardToPost();

			 $(".touch .buttons-on-img").touchHoverImage();

			$(".hover-scale .rollover-project").scaleInHover();

			 $(".links-container a").hoverLinks();
			if($(".style-material-design").length > 0) {
				$('.links-container a, .paginator .page-nav a').each(function(){
					var $this = $(this);
					$this.addClass("waves-effect");
				});
				Waves.displayEffect();
			}

			if ( !dtGlobals.isMobile){
				$("img").loaded(null, function() {		
					$(".image-blur .rollover-project a:not(.hover-style-three .rollover-project a), .image-blur .rollover, .image-blur .rollover > div, .image-blur .post-rollover, .image-blur .rollover-video").blurImage();
				}, true);
			}
		}
	};

	// get ajax data
	function dtGetAjaxData( $parentContainer ) {
		var	$filtersContainer = $parentContainer.find('.filter.with-ajax').first(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax, .articles-list.with-ajax').first(),
			$currentCategory = $filtersContainer.find('.filter-categories a.act'),
			$currentOrderBy = $filtersContainer.find('.filter-by a.act'),
			$currentOrder = $filtersContainer.find('.filter-sorting a.act'),
			paged = parseInt($itemsContainer.attr('data-cur-page')),
			nonce = null,
			visibleItems = new Array(),
			term = ( $currentCategory.length > 0 ) ? $currentCategory.attr('data-filter').replace('.category-', '').replace('*', '') : '';

		if ( '0' == term ) {
			term = 'none';
		}

		if ( $itemsContainer.hasClass('dt-isotope') ) {

			$('.wf-cell', $itemsContainer).each( function(){
				visibleItems.push( $(this).attr('data-post-id') );
			});
		}

		return {
			visibleItems : visibleItems,
			postID : dtLocal.postID,
			paged : paged,
			term : term,
			orderBy : ( $currentOrderBy.length > 0 ) ? $currentOrderBy.attr('data-by') : '',
			order : ( $currentOrder.length > 0 ) ? $currentOrder.attr('data-sort') : '',
			ajaxurl : dtLocal.ajaxurl,
			nonce : dtLocal.ajaxNonce,
			pageData : dtLocal.pageData,
			layout : dtLocal.pageData.layout,
			targetContainer : $itemsContainer,
			isPhone : dtGlobals.isPhone
		}
	}

	// paginator
	$('#content').on('click', '.paginator.with-ajax a', function(e){
		e.preventDefault();

		//resetEffects();

		if ( $(e.target).hasClass('dots') || $(e.target).hasClass('disabled') ) {
			return;
		}

		var $this = $(this),
			$paginatorContainer = $this.closest('.paginator'),
			$parentContainer = $paginatorContainer.parent(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax, .articles-list.with-ajax').first(),

			$loadMoreButton = $(".button-load-more"),
			loadMoreButtonCaption = $loadMoreButton.find('.button-caption').text(),

			paginatorType = $paginatorContainer.hasClass('paginator-more-button') ? 'more' : 'paginator',
			isMore = ('more' == paginatorType),

			ajaxData = dtGetAjaxData($parentContainer),
			targetPage = isMore ? ajaxData.paged + 1 : $this.attr('data-page-num'),
			isoPreloaderExists = dtGlobals.isoPreloader;

		$loadMoreButton.addClass("animate-load").find('.button-caption').text(dtLocal.moreButtonText.loading);

		// show preloader
		if ( isoPreloaderExists && !$(".paginator-more-button").length ) {
			dtGlobals.isoPreloader.fadeIn(50);
		}

		if ( !isMore ) {
			var $scrollTo = $parentContainer.find('.filter.with-ajax').first(),
				paddingTop = 44;

			if (!$scrollTo.exists()) {
				$scrollTo = $itemsContainer;
				paddingTop = 50;
			}

			// scroll to top
			$("html, body").animate({
				scrollTop: $scrollTo.offset().top - $("#phantom").height() - paddingTop
			}, 400);
		}

		// lunch ajax
		dtAjaxing.lunch($.extend({}, ajaxData, {
			contentType : ajaxData.pageData.template,
			targetPage : targetPage,
			sender : paginatorType,
			visibleItems : isMore ? new Array() : ajaxData.visibleItems,
			afterResponce : function( responce ) {

				// we have paginator
				if ( $paginatorContainer.length > 0 ) {

					if ( responce.paginationHtml ) {

						// update paginator with responce content
						$paginatorContainer.html($(responce.paginationHtml).html()).show();
						if($(".filter-style-material").length > 0){
							$(".paginator .page-links a").each(function(){
								var $this = $(this);
								$this.addClass("ripple");
							});
							$( '.page-links a.ripple' ).ripple();

							$('.paginator .page-nav a').each(function(){
								var $this = $(this);
								$this.addClass("waves-effect");
							});
							Waves.displayEffect();
						}

					} else {

						if ( false && isMore ) {
							$paginatorContainer.html('<span class="loading-ready">' + dtLocal.moreButtonAllLoadedText + '</span>');
						} else {
							// clear paginator and hide it
							$paginatorContainer.html('').hide();
						}
					}
					setTimeout (function(){
						$(".button-load-more").removeClass("animate-load").find('.button-caption').text(loadMoreButtonCaption);
					}, 200);

				} else if ( responce.paginationHtml ) {

					// if there are no paginator on page but ajax responce have it
					$itemsContainer.parent().append($(responce.paginationHtml));
				}

				// add dots onclick event handler
				$paginatorContainer.find('.dots').on('click', function() {
					$paginatorContainer.find('div:hidden').show().find('a').unwrap();
					$(this).remove();
				});

				// update current page field
				$itemsContainer.attr('data-cur-page', responce.currentPage);

				// hide preloader
				dtGlobals.isoPreloader.stop().fadeOut(300);

				// update load more button
				dtGlobals.loadMoreButton = $(".button-load-more");
			}
		}));
	});

	// filter
	$('.filter.with-ajax .filter-categories a, .filter.with-ajax .filter-extras a').on('click', function(e){
		e.preventDefault();

		resetEffects();

		var $this = $(this),
			$filterContainer = $this.closest('.filter'),
			$parentContainer = $filterContainer.parent(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax').first(),
			$paginatorContainer = $parentContainer.find('.paginator').first(),

			ajaxData = dtGetAjaxData($parentContainer),
			isoPreloaderExists = dtGlobals.isoPreloader;

		// show preloader
		if ( isoPreloaderExists ) {
			dtGlobals.isoPreloader.fadeIn(50);
		}
		// lunch ajax
		dtAjaxing.lunch($.extend({}, ajaxData, {
			contentType : ajaxData.pageData.template,
			targetPage : 1,
			paged : 1,
			sender : 'filter',
			afterResponce : function( responce ) {

				// we have paginator
				if ( $paginatorContainer.length > 0 ) {

					if ( responce.paginationHtml ) {

						// update paginator with responce content
						$paginatorContainer.html($(responce.paginationHtml).html()).show();
					} else {

						// clear paginator and hide it
						$paginatorContainer.html('').hide();
					}

				} else if ( responce.paginationHtml ) {

					// if there are no paginator on page but ajax responce have it
					$itemsContainer.parent().append($(responce.paginationHtml));
				}

				// add dots onclick event handler
				$paginatorContainer.find('.dots').on('click', function() {
					$paginatorContainer.find('div:hidden').show().find('a').unwrap();
					$(this).remove();
				});

				// update current page field
				$itemsContainer.attr('data-cur-page', responce.currentPage);

				// hide preloader
				dtGlobals.isoPreloader.stop().fadeOut(300);

				// update load more button
				dtGlobals.loadMoreButton = $(".button-load-more");
			}
		}));
	});

	function lazyLoading() {
		if ( dtGlobals.loadMoreButton && dtGlobals.loadMoreButton.exists() ) {

			var buttonOffset = dtGlobals.loadMoreButton.offset();

			if ( buttonOffset && $window.scrollTop() > (buttonOffset.top - $window.height()) / 2 && !dtGlobals.loadMoreButton.hasClass('animate-load') ) {
				dtGlobals.loadMoreButton.trigger('click');
			}

		}
	}

	// lazy loading
	if ( typeof dtLocal.themeSettings.lazyLoading != 'undefined' && dtLocal.themeSettings.lazyLoading ) {

		dtGlobals.loadMoreButton = $(".button-load-more");
		var timer = null;
		$window.on('scroll', function () {
			lazyLoading();
		});
		lazyLoading();
	}

	// Prevent a backgroung rendering glitch in Webkit.
	if (!window.bgGlitchFixed && $.browser.webkit) {
		setTimeout(function(){
			$window.scrollTop($window.scrollTop() + 1);
			window.bgGlitchFixed = true;
		},10)
	}

	var waitForFinalEvent = (function () {
		var timers = {};
		return function (callback, ms, uniqueId) {
			if (!uniqueId) {
				uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
				clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		};
	})();
	
	// Usage
	$window.resize(function () {

		/*Animate iso-items on resize*/
		$(".iso-item, .iso-grid .wf-cell").addClass("animate-position");
		waitForFinalEvent(function(){
			$(".iso-item, .iso-grid .wf-cell").removeClass("animate-position");
		}, 2500, "");
	});

	var $isotope = $(".dt-isotope"),
		$isoFallback = $(".iso-item:not(.shown)"),
		$grid = $(".iso-grid .wf-cell:not(.shown)");

	if ($isotope.exists() || $isoFallback.exists() || $grid.exists()) {
		setTimeout(function () {
			loadingEffects();
		}, 100);

		$window.on("scroll", function() {
			loadingEffects();
		});
	};
// })
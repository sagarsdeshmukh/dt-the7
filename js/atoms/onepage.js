
/* #One-page
================================================== */



// jQuery(document).ready(function($) {
	var $moveBody = $("html");

	/*Detect floating header*/
	if($(".phantom-sticky").length > 0){
		var $phantom = $(".masthead:not(.side-header):not(.side-header-v-stroke)"),
			$phantomVisibility = 1;
	}else{
		var $phantom = $("#phantom"),
			$phantomVisibility = $phantom.css("display")=="block";
	}


	// One page scrolling effect
	var phantomStickyExists = $(".phantom-sticky").exists(),
		sideHeaderExists = $(".side-header").exists(),
		sideHeaderHStrokeExists = $(".side-header-h-stroke").exists(),
		floatMenuH = 0;
	if ($(".mobile-header-bar").css('display') !== 'none') {
		var $headerBar = $(".mobile-header-bar");
		if($(".phantom-sticky").length > 0){
			if($(".sticky-header .masthead.side-header").length > 0 || $(".overlay-navigation .masthead.side-header").length > 0){
				var $phantom = $(".mobile-header-bar").parent(".masthead:not(.side-header)");
			}else{
				var $phantom = $(".mobile-header-bar").parent();
			}
		}
	}else{
		var $headerBar = $(".masthead:not(.side-header):not(.side-header-v-stroke) .header-bar");
	}

	/*Floating header height*/
	function set_sticky_header_height() {
		if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
			if($(".sticky-mobile-header").length > 0){
				floatMenuH = $phantom.height();
			}else{
				floatMenuH = 0;
			}
		}else{
			if($phantom.css("display")=="block" || (phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists)){			
				floatMenuH = $phantom.height();
			}else{
				floatMenuH = 0;
			}
		}
	}
	set_sticky_header_height();



	/*Set cuurent item on load*/
	jQuery(window).load(function(){
		var locHash = window.location.hash;
		if(locHash.match("^#!")){
			var urlHash = locHash.substring(3);
		}
		// else if(locHash.match("^#")){
		// 	var urlHash = locHash.substring(1);
		// }else{
		// 	var urlHash = undefined;
		// }
		if( typeof urlHash != 'undefined' && urlHash.length > 0 ) {
			if(urlHash == "up") {
				$.closeMobileHeader();
				$moveBody.stop().velocity("scroll", { 
					offset: 0,
					duration: 600,
					mobileHA: false,
					complete: function(elements) { $.closeSideHeader(); }
				});

			}else{
				setTimeout(function(){
					$moveBody.stop().velocity("scroll", { 
						offset: $("#" + urlHash).offset().top - floatMenuH,
						duration: 600,
						mobileHA: false,
						complete: function(elements) { 
						//	$.closeSideHeader();

							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
								
									$moveBody.stop().velocity("scroll", { 
										offset: $("#" + urlHash).offset().top - $phantom.height(),
										duration: 650,
										mobileHA: false 
									});
								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
								
									$moveBody.stop().velocity("scroll", { 
										offset: $("#" + urlHash).offset().top - $($headerBar, $phantom).height(),
										duration: 650,
										mobileHA: false 
									});

								}
							}
						}
					});
				},300)
			}
		}else {
			if(urlHash == 'undefined' && $( '.menu-item > a[href="#!/up"]' ).length > 0) {
				$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
			}
		}
	});


	jQuery( window ).on('resize', function() {
		set_sticky_header_height();
	});

	
	var $anchors = $( '.stripe' ),
		$menus = $( '.menu-item > a[href^="#!"]' );

	/*!-scroll to anchor*/
	window.clickAnchorLink = function( $a, e ) {
		var url = $a.attr( 'href' ),
			hash = url,
			$target = url.substring(3),
			base_speed  = 600,
			speed       = base_speed;
		
		set_sticky_header_height();

		if ( typeof $target != 'undefined' && $target && $target.length > 0 ) {
			location.hash = url;
			if($("#" + $target).length > 0) {
				var top = $("#" + $target).offset().top + 1,
					this_offset = $a.offset(),
					that_offset = $("#" + $target).offset(),
					offset_diff = Math.abs(that_offset.top - this_offset.top),
					speed = 150 * Math.log(offset_diff^2/1000 + 1.02);
				//	speed = 3400 * Math.log(offset_diff/8253 + 1.02);


					$newScrollPosition = top - floatMenuH;


					// targetPos = Math.abs( dtGlobals.winScrollTop + that_offset.top - this_offset.top );

				 //    distance = Math.abs( dtGlobals.winScrollTop - targetPos );
				 //    speed = ( distance / 1000 ) * 1000;
			};



			if($target == "up") {
				if($body.hasClass("overlay-navigation")){
					$.closeMobileHeader();
					$.closeSideHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH,
						duration: speed,
						mobileHA: false 
					});
				}else{
					$.closeMobileHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: 0,
						duration: speed,
						mobileHA: false,
						complete: function(elements) { $.closeSideHeader(); }
					});
				}
			}else {
				if($body.hasClass("overlay-navigation")){
					$.closeMobileHeader();
					$.closeSideHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH ,
						duration: speed,
						mobileHA: false,
						complete: function(elements) { 
							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});

								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
									$newScrollPosition = ( top - $($headerBar, $phantom).height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								
								}
							}
						}
					});
				}else{
					$.closeMobileHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH ,
						duration: speed,
						mobileHA: false,
						complete: function(elements) {
							$.closeSideHeader();

							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
									$newScrollPosition = ( top - $($headerBar, $phantom).height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								
								}
							}

						
						}
					});
				}
			};

			$('.menu-item a').parent("li").removeClass('act');
			$a.parent("li").addClass('act');
			e.preventDefault();
			return false;
		};

	};

	$body.on( 'click', '.anchor-link[href^="#!"], .logo-box a[href^="#!"], .branding a[href^="#!"], #branding-bottom a[href^="#!"]', function( e ) {
		clickAnchorLink( $( this ), e );
	});

	$menus.on( 'click', function( e ) {
		clickAnchorLink( $( this ), e );
	});
	// $( 'a[href^="#"]:not(a[href^="#!"])' ).on( 'click', function( e ) {
	// 	e.preventDefault();

 //        var target = this.hash;
 //        var $target = $(target);
 //        var scroll;
 //        if($target.hasClass("vc_row")){
 //        console.log($target)

	//         if($(window).scrollTop()==0){
	//             scroll =  ($target.offset().top) - 0
	//         }else{
	//             scroll =  ($target.offset().top) - floatMenuH
	//         }
	//         $('html, body').stop().animate({
	//             'scrollTop': scroll
	//         }, 600, 'swing', function () {
	//             //window.location.hash = target;
	//         });
	//     }
	// })


	/*!-set active menu item on scroll*/
	//console.log($('.vc_row').attr('id').length)
	if(($('.one-page-row div[data-anchor^="#"]').length > 0 || $('.vc_row[id]').length > 0) && $(".one-page-row").length > 0){
		$window.scroll(function (e) {
			var currentNode = null;
			if(!$body.hasClass("is-scroll")){

				//for vc row id
				$('.one-page-row .vc_row[id]').each(function(){
					var $_this = $(this)
						activeSection = $_this,
						currentId = $_this.attr('id');
					if(dtGlobals.winScrollTop >= ($(".one-page-row .vc_row[id='" + currentId + "']").offset().top - $phantom.height())){
						currentNode = "#!/" + currentId;
					};
				});

				$('.one-page-row div[data-anchor^="#"]').each(function(){
					var $_this = $(this)
						activeSection = $_this,
						currentId = $_this.attr('data-anchor');
					if(dtGlobals.winScrollTop >= ($(".one-page-row div[data-anchor='" + currentId + "']").offset().top - $phantom.height())){
						currentNode = "#!/" + currentId.substring(1);
					};
				});


				$('.menu-item a[href^="#!"]').parent("li").removeClass('act');

				if($(".one-page-row div[data-anchor^='#']").length > 0){
					if(dtGlobals.winScrollTop < ($(".one-page-row div[data-anchor^='#']").first().offset().top - $phantom.height())&& $( '.menu-item > a[href="#!/up"]' ).length > 0) {
						$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
					};
				}else if( $('.vc_row[id]').length > 0){
					//for vc row id
					if(dtGlobals.winScrollTop < ($('.one-page-row .vc_row[id]').first().offset().top - $phantom.height())&& $( '.menu-item > a[href="#!/up"]' ).length > 0) {
						$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
					};
				}
				
				$('.menu-item a[href="'+currentNode+'"]').parent("li").addClass('act');
				if($('.menu-item a[href="#"]').length && currentNode == null){
					$('.menu-item a[href="#"]').parent("li").addClass('act');
				}
			};
		});
	};
// })
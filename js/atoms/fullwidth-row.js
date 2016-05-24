
/* #Fullwidth row for shortcodes & templates
================================================== */
// jQuery(document).ready(function($) {
	function fullWidthWrap(){
		if( $(".full-width-wrap").length > 0 ){
			$(".full-width-wrap").each(function(){
				var $_this = $(this),
					windowInnerW = window.innerWidth,
					windowW = $window.width(),
					contentW = $('.content').width();

					var $offset_fs,
						$width_fs;
				 
					if ($('.boxed').length > 0) {
						$offset_fs = ((parseInt($('#main').width()) - parseInt(contentW)) / 2);
					}
					else if ($('.side-header-v-stroke').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header-v-stroke').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else if ($('.sticky-header .side-header').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					}
					else if (($('.header-side-left').length && windowInnerW || $('.header-side-right').length && windowInnerW ) > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else {
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					};

					if($('.sidebar-left').length > 0 || $('.sidebar-right').length > 0){
						$width_fs = $(".content").width();
						$offset_fs = 0;
					}else{
						$width_fs = $("#main").innerWidth();
					}

					$_this.css({
						width: $width_fs,
						"margin-left": -$offset_fs,
						"opacity": 1
					});
					var scroller = $_this.find(".ts-wrap").data("thePhotoSlider");
					if(typeof scroller!= "undefined"){
						scroller.update();
					};
			});
		};
	};

	if( $(".full-width-wrap").length > 0 ){
		if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
			$window.bind("orientationchange", function() {
				fullWidthWrap();
			}).trigger( "orientationchange" );
		}
		else {
			$window.on("resize", function(){
				fullWidthWrap();
			});
			fullWidthWrap();
		};
	};
// })
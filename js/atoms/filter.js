
/* #Filter
================================================== */
// jQuery(document).ready(function($) {

	/*!-categories filter*/
	$(".filter-categories > a").on("click", function(e) {
		var $this = $(this);
		
		if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
			var $filter = $this.parents(".filter").first();

			if ( $filter.hasClass("without-isotope") ) {
				arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
			} else {
				arguments.callee.dtPreventD = true;
			};
		};

		e.preventDefault();

		$this.trigger("mouseleave");
		
		if ($this.hasClass("act") && !$this.hasClass("show-all")) {
			e.stopImmediatePropagation();
			$this.removeClass("act");
			$this.siblings("a.show-all").trigger("click");//.addClass("act");
		} else {
			$this.siblings().removeClass("act");
			$this.addClass("act");

			if ( !arguments.callee.dtPreventD ) {
				window.location.href = $this.attr("href");
			}
		};
	});

	/*!- ordering*/
	$(".filter-extras .filter-switch").each(function(){
		var $_this = $(this);
		if($_this.prev('.act').length > 0){
			$_this.addClass('left-act');
		}else if($_this.next('.act').length > 0){
			$_this.addClass('right-act');
		}else{
			$_this.removeClass('right-act');
			$_this.removeClass('left-act');
		};
	});

	$(".filter-extras a").on("click", function(e) {
		var $this = $(this);
		
		if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
			var $filter = $this.parents(".filter").first();

			if ( $filter.hasClass("without-isotope") ) {
				arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
			} else {
				arguments.callee.dtPreventD = true;
			}
		};

		if ( arguments.callee.dtPreventD ) {
			e.preventDefault();
		};

		$this.siblings().removeClass("act");
		$this.addClass("act");

		$(".filter-extras .filter-switch").each(function(){
			var $_this = $(this);
			if($_this.prev($this).hasClass('act')){
				$_this.addClass('left-act');
				$_this.removeClass('right-act');
			}else if($_this.next($this).hasClass('act')){
				$_this.addClass('right-act');
				$_this.removeClass('left-act');
			}else{
				$_this.removeClass('right-act');
				$_this.removeClass('left-act');
			};
		});
	});

	$(".filter-extras .filter-switch").each(function(){
		var $this = $(this);
		var $filter = $this.parents(".filter").first();
		$this.on("click", function(){
			if ( $filter.hasClass("without-isotope") ) {
				if($this.hasClass("right-act")){
					$this.prev("a")[0].click();
				}else if ($this.hasClass("left-act")){
					
					$this.next("a")[0].click();
				};
			}else{
				if($this.hasClass("right-act")){
					$this.prev("a").trigger("click");
				}else if ($this.hasClass("left-act")){
					$this.next("a").trigger("click");
				};
			};
		});
	});


	/*!Change filter appearance when too much categories*/
	// $.fn.changeFilter = function() {
	// 	return this.each(function() {

	// 		var width = 0;
	// 		var $_this = $(this),
	// 			$this_par = $_this.parents(".filter-categories");
	// 		if($(".filter-style-ios").length > 0){
	// 			width += ($_this.innerWidth()-1);
	// 		}else{
	// 			width += $_this.innerWidth();
	// 		}
	// 		if( width > $(this).width() ){
	// 			$this_par.addClass("new-style")
	// 		}else{
	// 			$this_par.removeClass("new-style")
	// 		}
	// 	});
	// };

	// $(".filter-categories a").changeFilter();

// });
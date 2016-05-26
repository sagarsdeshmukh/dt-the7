

jQuery(document).ready(function($) {
	//Cache variables
	var $document = $(document),
		$window = $(window),
		$html = $("html"),
		$body = $("body"),
		$page = $("#page");
	/* #Retina images using srcset polyfill
	================================================== */
	//Layzy img loading
	$.fn.layzrInitialisation = function(container) {
	  return this.each(function() {
	      var $this = $(this);

	      var layzr = new Layzr({
	        container: container,
	        selector: '.lazy-load',
	        attr: 'data-src',
	        attrSrcSet: 'data-srcset',
	        retinaAttr: 'data-src-retina',
	        hiddenAttr: 'data-src-hidden',
	        threshold: 30,
	        before: function() {
	          // For fixed-size images with srcset; or have to be updated on window resize.
	          this.setAttribute("sizes", this.width+"px");
	        },
	        callback: function() {

	          	this.classList.add("is-loaded");
	         	var $this =  $(this);
	         	// $this.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
					setTimeout(function(){
						$this.parent().removeClass("layzr-bg");
					}, 350)
				//});
	        }
	      });
	    });
	};
	$(".layzr-loading-on, .vc_single_image-img").layzrInitialisation();

	/*Call visual composer function for preventing full-width row conflict */
	if($('div[data-vc-stretch-content="true"]').length > 0 && $('div[data-vc-full-width-init="false"]').length > 0){
		vc_rowBehaviour();

	}

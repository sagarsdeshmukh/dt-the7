jQuery(document).ready(function($) {
	
	var $document = $(document),
		$window = $(window),
		$html = $("html"),
		$body = $("body"),
		$page = $("#page");
	/* #Retina images using srcset polyfill
================================================== */
	
		window.retinizer = function() {
			if ($body.hasClass("srcset-enabled")) {
				var $coll = $("img:not(.retinized)").filter("[srcset]"),
					ratio = window.devicePixelRatio ? window.devicePixelRatio : 1;
		
				$coll.each(function() {
					var $this = $(this),
						srcArray = $this.attr("srcset").split(","),
						srcMap = [],
						src = "";
					srcArray.forEach(function(el, i) {
						var temp = $.trim(el).split(" ");
						srcMap[temp[1]] = temp[0];
					});
				
		
					if (ratio >= 1.5) {
						if (!(typeof srcMap["2x"] == "undefined")) src = srcMap["2x"];
						else src = srcMap["1x"];
					}
					else {
						if (!(typeof srcMap["1x"] == "undefined")) src = srcMap["1x"];
						else src = srcMap["2x"];
					};
		
					$this.attr("src", src).addClass("retinized");
				});
		
				// Retina logo in floating menu
				
				if (! (typeof dtGlobals.logoURL == "undefined")) {
					var logoArray = dtGlobals.logoURL.split(","),
						logoMap = [];
			
					logoArray.forEach(function(el, i) {
						var temp = $.trim(el).split(" ");
						logoMap[temp[1]] = temp[0];
					});
				
			
					if (ratio >= 1.5) {
						if (!(typeof logoMap["2x"] == "undefined")) dtGlobals.logoURL = logoMap["2x"];
						else dtGlobals.logoURL = logoMap["1x"];
					}
					else {
						if (!(typeof logoMap["1x"] == "undefined")) dtGlobals.logoURL = logoMap["1x"];
						else dtGlobals.logoURL = logoMap["2x"];
					};
				};
			};
		};
		retinizer();

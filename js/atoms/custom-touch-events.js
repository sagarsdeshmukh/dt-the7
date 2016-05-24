
/* #Custom touch events
================================================== */

	/* !(we need to add swipe events here) */

	dtGlobals.touches = {};
	dtGlobals.touches.touching = false;
	dtGlobals.touches.touch = false;
	dtGlobals.touches.currX = 0;
	dtGlobals.touches.currY = 0;
	dtGlobals.touches.cachedX = 0;
	dtGlobals.touches.cachedY = 0;
	dtGlobals.touches.count = 0;
	dtGlobals.resizeCounter = 0;

	$document.on("touchstart",function(e) {
		if (e.originalEvent.touches.length == 1) {
			dtGlobals.touches.touch = e.originalEvent.touches[0];

			// caching the current x
			dtGlobals.touches.cachedX = dtGlobals.touches.touch.pageX;
			// caching the current y
			dtGlobals.touches.cachedY = dtGlobals.touches.touch.pageY;
			// a touch event is detected      
			dtGlobals.touches.touching = true;

			// detecting if after 200ms the finger is still in the same position
			setTimeout(function() {

				dtGlobals.touches.currX = dtGlobals.touches.touch.pageX;
				dtGlobals.touches.currY = dtGlobals.touches.touch.pageY;

				if ((dtGlobals.touches.cachedX === dtGlobals.touches.currX) && !dtGlobals.touches.touching && (dtGlobals.touches.cachedY === dtGlobals.touches.currY)) {
					// Here you get the Tap event
					dtGlobals.touches.count++;
					//console.log(dtGlobals.touches.count)
					$(e.target).trigger("tap");
				}
			},200);
		}
	});

	$document.on("touchend touchcancel",function (e){
		// here we can consider finished the touch event
		dtGlobals.touches.touching = false;
	});

	$document.on("touchmove",function (e){
		dtGlobals.touches.touch = e.originalEvent.touches[0];

		if(dtGlobals.touches.touching) {
			// here you are swiping
		}
	});

	$document.on("tap", function(e) {
		$(".dt-hovered").trigger("mouseout");
	});

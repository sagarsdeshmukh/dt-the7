jQuery(document).ready(function($) {

	$('.show-debug-info.button').on('click', function() {
		$('.section .debug').toggle();
	}).detach().insertBefore('.nav-tab-wrapper').show();

});
(function($) {

	$(function() {

		var showInfoBlock = true;

		if ( typeof(localStorage) != 'undefined' && window.location.href === localStorage.getItem('dt_cut_page') ) {
			showInfoBlock = false;
		}

		if ( dtWizard.showModeSelector ) {
			var $infoBlock = $('.of-info-block');

			$infoBlock.show();

			var $options = $('#optionsframework-metabox, .nav-tab-wrapper');

			$options.hide();

			$('.button-primary', $infoBlock).on('click', function() {
				$infoBlock.hide();
				$options.fadeIn();

				// Floating controls fix.
				$(window).trigger("resize");
				$("#optionsframework").css({
					"padding-bottom" : $("#submit-wrap").height()
				});
			});
		}
	});
})(jQuery);
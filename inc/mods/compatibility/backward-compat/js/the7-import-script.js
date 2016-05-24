(function($) {

	$(function() {

		$('#setting-error-presscore-import-the7-options .dt-skins-list').on('change', function() {
			var selectedSkin = $(this).val();
			the7Adapter.importPostData.defaultPreset = selectedSkin;
		});

		$('#setting-error-presscore-import-the7-options .dt-import-options').on('click', function(event) {
			event.preventDefault();

			var $button = $(this);
			var $spinner = $button.siblings('.spinner');

			$spinner.addClass('is-active');

			$.post(
				'options.php',
				the7Adapter.importPostData
			).success( function() {
				$spinner.removeClass('is-active');
				location.assign( $button.attr('href') );
			} );

			return false;
		});

		$('#setting-error-presscore-import-the7-options .notice-dismiss').on('click', function() {
			$.post(
				ajaxurl,
				the7Adapter.dismissNotice
			);
		});

	});

})(jQuery);
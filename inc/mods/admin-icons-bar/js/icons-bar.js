(function($) {

	$(document).ready(function() {
		var tb_content_exists = false;
		var tb_icon_bar_open = false;
		var tb_unload_binded = false;

		var origin_tb_position = tb_position;
		tb_position = function() {

			if ( ! tb_icon_bar_open ) {

				origin_tb_position();

			} else {

				var tbWindow = $('#TB_window'),
					H = $(window).height(),
					W = $(window).width(),
					titleHeight = $('#TB_ajaxContent .presscore-modal-header', tbWindow).height(),
					adminbar_height = 0;

				if ( ! tbWindow.hasClass('presscore-icons-bar-modal') ) {
					tbWindow.addClass('presscore-icons-bar-modal');
				}

				if ( $('#wpadminbar').length ) {
					adminbar_height = parseInt( $('#wpadminbar').css('height'), 10 );
				}

				if ( tbWindow.size() ) {
					tbWindow.width( W - 50 ).height( H - 45 - adminbar_height );
					$('#TB_overlay').css({'z-index': '10101'});
					$('#TB_ajaxContent').removeAttr('style');
					tbWindow.css({'margin-left': '-' + parseInt( ( ( W - 50 ) / 2 ), 10 ) + 'px'});
					if ( typeof document.body.style.maxWidth !== 'undefined' )
						tbWindow.css({'top': 20 + adminbar_height + 'px', 'margin-top': '0'});

					$('#TB_ajaxContent .presscore-modal-content', tbWindow).height( tbWindow.height() - 27 - titleHeight );
				}

				if ( ! tb_unload_binded ) {
					tb_unload_binded = true;
					jQuery("#TB_window").bind('tb_unload', function () {
						tb_icon_bar_open = false;
						tb_unload_binded = false;
					});
				}
			}
		}

		$('#wp-admin-bar-presscore-icons-bar .ab-item').on('click', function(event) {
			event.preventDefault();

			if ( ! tb_content_exists ) {
				var self = $(this);

				$.post(
					ajaxurl,
					{
						action: 'icons_bar'
					},
					function( response ) {
						if ( response ) {
							$('body').append('<div id="presscore-icons-bar" style="display: none;">' + response + '</div>');
							tb_content_exists = true;
							tb_icon_bar_open = true;
							tb_show( '', '#TB_inline?width=1024&height=768&inlineId=presscore-icons-bar' );
						} else {
							alert('Icons Bar Ajax Response Error');
							tb_content_exists = false;
							tb_icon_bar_open = false;
						}
					}
				);

			} else {
				tb_icon_bar_open = true;
				tb_show( '', '#TB_inline?width=1024&height=768&inlineId=presscore-icons-bar' );
			}

		});

		$(document.body).on('click', '.presscore-icons li', function() {
			$(this).find('.presscore-icon-code').select();
		});

		$(document.body).on('keyup', '#presscore-icon-search', function() {
			var iconsFilter = $(this).val();

			$(".presscore-icons li").each(function(){
				if ( $(this).find(".presscore-icon-code").val().search(new RegExp(iconsFilter, "i")) < 0 ) {
					$(this).fadeOut();
				} else {
					$(this).show();
				}
			});
		});
	});

})(jQuery);
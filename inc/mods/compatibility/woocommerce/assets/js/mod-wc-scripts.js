jQuery(function($) {

	function dt_update_cart_dropdown(event, parts, hash) {

		function get_quantity( $content ) {
			var quantity = 0;

			$content.find('li .quantity').each(function() {
				var q = parseInt( $(this).text().split(' ')[0] );

				if ( q ) {
					quantity += q;
				}
			});

			return quantity;
		}

		if ( parts['div.widget_shopping_cart_content'] ) {

			var $miniCart = $('.shopping-cart');
			var $cartContent = $(parts['div.widget_shopping_cart_content']);
			var $itemsList = $cartContent.find('.cart_list');
			var $total = $cartContent.find('.total');
			var quantity = get_quantity( $cartContent );

			$miniCart.each( function() {
				var $self = $(this);
				var $buttons = $self.find('.buttons');
				$self.find('.shopping-cart-inner').html('').append($itemsList.clone(true), $total.clone(true), $buttons.clone(true));

				$self.find('.wc-ico-cart .amount').html($total.find('.amount').html());
				var $counter = $self.find('.wc-ico-cart .counter');
				$counter.html( quantity );
				if ( $counter.hasClass('hide-if-empty') ) {

					if ( quantity > 0 ) {
						$counter.removeClass('hidden');
					} else {
						$counter.addClass('hidden');
					}

				}
			} );
		}

	}

	$('body').bind('added_to_cart', dt_update_cart_dropdown);
});
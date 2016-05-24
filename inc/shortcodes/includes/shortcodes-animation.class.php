<?php
class Presscore_Shortcodes_Animation {
	static $animation_options = array(
		'none' => '',
		'bounce' => 'bounce',
		'flash' => 'flash',
		'pulse' => 'pulse',
		'rubberBand' => 'rubberBand',
		'shake' => 'shake',
		'swing' => 'swing',
		'tada' => 'tada',
		'wobble' => 'wobble',
		'bounceIn' => 'bounceIn',
		'bounceInDown' => 'bounceInDown',
		'bounceInLeft' => 'bounceInLeft',
		'bounceInRight' => 'bounceInRight',
		'bounceInUp' => 'bounceInUp',
		'fadeIn' => 'fadeIn',
		'fadeInDown' => 'fadeInDown',
		'fadeInDownBig' => 'fadeInDownBig',
		'fadeInLeft' => 'fadeInLeft',
		'fadeInLeftBig' => 'fadeInLeftBig',
		'fadeInRight' => 'fadeInRight',
		'fadeInRightBig' => 'fadeInRightBig',
		'fadeInUp' => 'fadeInUp',
		'fadeInUpBig' => 'fadeInUpBig',
		'flipInX' => 'flipInX',
		'flipInY' => 'flipInY',
		'lightspeedIn' => 'lightspeedIn',
		'rotateIn' => 'rotateIn',
		'rotateInDownLeft' => 'rotateInDownLeft',
		'rotateInDownRight' => 'rotateInDownRight',
		'rotateInUpLeft' => 'rotateInUpLeft',
		'rotateInUpRight' => 'rotateInUpRight',
		'rollIn' => 'rollIn',
		'zoomIn' => 'zoomIn',
		'zoomInDown' => 'zoomInDown',
		'zoomInLeft' => 'zoomInLeft',
		'zoomInRight' => 'zoomInRight',
		'zoomInUp' => 'zoomInUp'
	);

	static public function get_animation_options() {
		return apply_filters( 'prescore_shortcodes_animation', self::$animation_options );
	}

	static public function is_animation_on( $animation ) {
		return ! in_array( $animation, array( '', 'none' ) );
	}

	static public function get_html_class( $animation ) {
		$class = '';

		if ( array_key_exists( $animation, self::$animation_options ) ) {
			$class = self::$animation_options[ $animation ] . ' animate-element';
		}

		$compat_class = self::get_compat_html_class( $animation );
		if ( $compat_class ) {
			$class = $compat_class;
		}

		return $class;
	}

	static public function get_compat_html_class( $animation ) {
		$class = '';
		switch ( $animation ) {
			case 'scale':
				$class = 'scale-up';
				break;
			case 'fade':
				$class = 'fade-in';
				break;
			case 'left':
				$class = 'right-to-left';
				break;
			case 'right':
				$class = 'left-to-right';
				break;
			case 'bottom':
				$class = 'top-to-bottom';
				break;
			case 'top':
				$class = 'bottom-to-top';
				break;
		}
		return $class;
	}

}

<?php
/**
 * Less related functions.
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Set presscore_less_css_is_writable option to 0.
 */
function presscore_stylesheet_is_not_writable() {
	update_option( 'presscore_less_css_is_writable', 0 );
}
add_action( 'wp-less_save_stylesheet_error', 'presscore_stylesheet_is_not_writable' );

/**
 * Set presscore_less_css_is_writable option to 1.
 */
function presscore_stylesheet_is_writable() {
	update_option( 'presscore_less_css_is_writable', 1 );
}
add_action( 'wp-less_stylesheet_save_post', 'presscore_stylesheet_is_writable' );

/**
 * This function returns less vars array to use with phpless.
 * @return array
 */
function presscore_compile_less_vars() {
	$less_vars = new Presscore_Lib_LessVars_Manager( new Presscore_Lib_SimpleBag(), new Presscore_Lib_LessVars_Factory() );

	do_action( 'presscore_setup_less_vars', $less_vars );

	return apply_filters( 'presscore_compiled_less_vars', $less_vars->get_vars() );
}

if ( ! function_exists( 'presscore_less_get_accent_colors' ) ) :

	/**
	 * Helper that returns array of accent less vars.
	 *
	 * @since 3.0.0
	 * 
	 * @param  Presscore_Lib_LessVars_Manager $less_vars
	 * @return array Returns array like array( 'first-color', 'seconf-color' )
	 */
	function presscore_less_get_accent_colors( Presscore_Lib_LessVars_Manager $less_vars ) {
		// less vars
		$_color_vars = array( 'accent-bg-color', 'accent-bg-color-2' );
		// options ids
		$_test_id = 'general-accent_color_mode';
		$_color_id = 'general-accent_bg_color';
		$_gradient_id = 'general-accent_bg_color_gradient';
		// options defaults
		$_color_def = '#D73B37';
		$_gradient_def = array( '#ffffff', '#000000' );

		$accent_colors = $less_vars->get_var( $_color_vars );
		if ( ! array_product( $accent_colors ) ) {
			switch ( of_get_option( $_test_id ) ) {
				case 'gradient':
					$colors = of_get_option( $_gradient_id, $_gradient_def );
					break;
				case 'color':
				default:
					$colors = array( of_get_option( $_color_id, $_color_def ), null );
			}
			$less_vars->add_hex_color( $_color_vars, $colors );
			$accent_colors = $less_vars->get_var( $_color_vars );
		}

		return $accent_colors;
	}

endif;

if ( ! function_exists( 'presscore_less_get_conditional_colors' ) ) :

	/**
	 * Function returns $color|$gradient|$accent based on $test value.
	 * @since 3.0.0
	 * @param  string $test
	 * @param  string $color
	 * @param  array $gradient
	 * @param  array|string $accent
	 * @return array|string
	 */
	function presscore_less_get_conditional_colors( $test, $color, $gradient, $accent ) {
		switch ( call_user_func_array( 'of_get_option', $test ) ) {
			case 'outline':
			case 'color':
				$_color = array(
					call_user_func_array( 'of_get_option', $color ),
					null
				);
				break;
			case 'gradient':
				$_color = call_user_func_array( 'of_get_option', $gradient );
				break;
			case 'accent':
			default:
				$_color = $accent;
		}

		return $_color;
	}

endif;

/**
 * Escape color for svg objects.
 * @todo delete this
 */
function presscore_less_escape_color( $color = '' ) {
	return '~"' . implode( ',%20', array_map( 'urlencode', explode( ',', $color ) ) ) . '"';
}

/**
 * Escape function for lessphp.
 * @var array
 */
function presscore_lessphp_escape( $value ) {
	$v = &$value[2][1][1];
	$v = rawurlencode( $v );

	return $value;
}

/**
 * Register escape function in lessphp.
 */
function presscore_register_escape_function_for_lessphp() {
	if ( !class_exists('WPLessPlugin') || !function_exists('presscore_lessphp_escape') ) {
		return;
	}

	$less = WPLessPlugin::getInstance();
	$less->registerFunction('escape', 'presscore_lessphp_escape');
}
add_action( 'presscore_setup_less_vars', 'presscore_register_escape_function_for_lessphp', 0 );

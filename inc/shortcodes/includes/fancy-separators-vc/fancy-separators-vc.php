<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class DT_Shortcode_Fancy_Separator extends DT_Shortcode {

	static protected $instance;
	static protected $num = 0;

	protected $plugin_name = 'dt_mce_plugin_dt_fancy_separator';

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new DT_Shortcode_Fancy_Separator();
		}
		return self::$instance;
	}

	protected function __construct() {

		add_shortcode( 'dt_fancy_separator', array($this, 'shortcode') );
	}

	public function shortcode( $atts, $content = null ) {

		// shortcode instances counter
		self::$num++;

		$default_atts = array(
			'separator_style' => 'line',
			'separator_color' => 'default',
			'custom_separator_color' => '',
			'alignment' => 'center',
			'line_thickness' => '',
			'el_width' => '100%',
		);

		extract(shortcode_atts($default_atts, $atts));

		/////////////////////
		// sanitize atts //
		/////////////////////

		$separator_color = in_array($separator_color, array("default", "accent", "custom")) ? $separator_color : $default_atts['separator_color'];
		$custom_separator_color = esc_attr( $custom_separator_color );

		if ( '' === $el_width ) {
			$el_width = $default_atts['el_width'];
		} else if ( ! preg_match( '/^\d*(%|px)$/', $el_width ) ) {
			$el_width = absint( $el_width ) . '%';
		}

		$separator_style = in_array($separator_style, array("line", "dashed", "dotted", "double", "thick")) ? $separator_style : $default_atts['separator_style'];

		if ( '' === $line_thickness ) {
			// Compatibility issue.
			switch ( $separator_style ) {
				case 'thick':
					$line_thickness = 5;
					$separator_style = 'line';
					break;
				case 'double':
					$line_thickness = 3;
					break;
				default:
					$line_thickness = 1;
			}
		} else {
			$line_thickness = absint( $line_thickness );
			if ( 0 == $line_thickness ) {
				$line_thickness = 1;
			}
		}

		//////////////////
		// inline css //
		//////////////////


		$fancy_text_inline_style = '';
		if ( $el_width ) {

			$fancy_text_inline_style .= "width: {$el_width};";
		}

		if ( "custom" == $separator_color && $custom_separator_color ) {
			$fancy_text_inline_style .= "border-color: {$custom_separator_color};";
		}

		$fancy_text_inline_style .= "border-top-width: {$line_thickness}px;";

		///////////////
		// classes //
		///////////////

		$separator_class = array();

		if ( $separator_style ) {
			$separator_class[] = 'hr-thin';
			$separator_class[] = 'style-' . $separator_style;
		}

		if ( 'accent' == $separator_color ) {
			$separator_class[] = 'accent-border-color';
		}

		switch ( $alignment ) {
			case 'left':
				$separator_class[] = 'hr-left';
				break;
			case 'right':
				$separator_class[] = 'hr-right';
				break;
		}

		//////////////
		// output //
		//////////////

		if ( $fancy_text_inline_style ) {
			$fancy_text_inline_style = ' style="' . esc_attr($fancy_text_inline_style) . '"';
		}

		$output = '<div class="' . ( esc_attr( join( ' ', $separator_class ) ) ) . '"' . $fancy_text_inline_style . '></div>';

		return $output;
	}

}

// create shortcode
DT_Shortcode_Fancy_Separator::get_instance();

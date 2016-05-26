<?php
/**
 * Highlight shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode highlight class.
 *
 */
class DT_Shortcode_Highlight extends DT_Shortcode {

    static protected $instance;

    protected $plugin_name = 'dt_mce_plugin_shortcode_highlight';

    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new DT_Shortcode_Highlight();
        }
        return self::$instance;
    }

    protected function __construct() {

        add_shortcode( 'dt_highlight', array($this, 'shortcode') );

        // add shortcode button
        $tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false );
    }

    public function shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'color'         => '',
            'text_color'    => '',
            'bg_color'      => ''
        ), $atts ) );

        $button_colors = array(
            'white',
            'red',
            'berry',
            'orange',
            'yellow',
            'pink',
            'green',
            'dark_green',
            'blue',
            'dark_blue',
            'violet',
            'black',
            'gray',
            'grey'
        );
        $color = in_array($color, $button_colors) ? $color : '';
        $text_color = ( $text_color ? of_sanitize_color( $text_color ) : '' );
        $bg_color = ( $bg_color ? of_sanitize_color( $bg_color ) : '' );

        $classes = array('dt-highlight');

        if ( $color ) {
            $color = ('grey' == $color) ? 'gray' : $color;
            $classes[] = 'highlight-' . str_replace('_', '-', $color );
        }

        $classes = implode( ' ', $classes );

        $style = '';
        $style_parts = array();
        if ( $text_color ) {
            $style_parts[] = "color: {$text_color};";
        }

        if ( $bg_color ) {
            $style_parts[] = "background: {$bg_color} !important;";
        }

        if ( $style_parts ) {
            $style = 'style="' . esc_attr( implode( ' ', $style_parts ) ) . '"';
        }

        $output = sprintf( '<span class="%s" %s>%s</span>',
            esc_attr( $classes ),
            $style,
            $content
        );

        return $output; 
    }

}

// create shortcode
DT_Shortcode_Highlight::get_instance();

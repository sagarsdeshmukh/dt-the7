<?php
/**
 * BBPress compatibility class.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_BBPress', false ) ) :

	class Presscore_Modules_Compatibility_BBPress {

		public static function execute() {
			if ( ! class_exists( 'bbPress', false ) ) {
				return;
			}

			add_action( 'presscore_get_dynamic_stylesheets_list', array( __CLASS__, 'add_dynamic_stylesheets_action' ) );
			add_filter( 'presscore_get_page_title', array( __CLASS__, 'fix_page_title_filter' ), 20 );
			add_filter( 'presscore_hide_share_buttons', array( __CLASS__, 'hide_share_buttons_filter' ) );
			add_filter( 'presscore_get_breadcrumbs-html', array( __CLASS__, 'fix_breadcrumbs_filter'), 10, 2 );
			add_filter( 'bbp_no_breadcrumb', '__return_true', 20 );
		}

		public static function add_dynamic_stylesheets_action( $dynamic_stylesheets ) {
			return array_merge(
				$dynamic_stylesheets,
				array(
					'bb-press.less' => array(
						'path' => PRESSCORE_THEME_DIR . '/css/compatibility/bb-press.less',
						'src' => PRESSCORE_THEME_URI . '/css/compatibility/bb-press.less',
						'fallback_src' => '',
						'deps' => array(),
						'ver' => wp_get_theme()->get( 'Version' ),
						'media' => 'all'
					)
				)
			);
		}

		public static function fix_page_title_filter( $title ) {
			$new_title = $title;

			if ( function_exists( 'is_bbpress' ) ) {
				$new_title = is_bbpress() ? get_the_title() : $new_title;
			}
			return $new_title;
		}

		public static function hide_share_buttons_filter( $hide ) {
			if ( function_exists( 'is_bbpress' ) ) {
				return is_bbpress() ? true : $hide;
			}
			return $hide;
		}

		public static function fix_breadcrumbs_filter( $html = '', $args = array() ) {
			if ( function_exists( 'is_bbpress' ) && is_bbpress() && function_exists( 'bbp_get_breadcrumb' ) ) {

				remove_filter( 'bbp_no_breadcrumb', '__return_true', 20 );

				$html = bbp_get_breadcrumb( array(
					'before' => $args['beforeBreadcrumbs'] . '<ol' . $args['listAttr'] . ' xmlns:v="http://rdf.data-vocabulary.org/#">',
					'after' => '</ol>' . $args['afterBreadcrumbs'],
					'sep' => $args['delimiter'] ? $args['delimiter'] : ' ',
					'pad_sep' => false,
					'sep_before' => '',
					'sep_after' => '',
					'crumb_before' => $args['linkBefore'],
					'crumb_after' => $args['linkAfter'],
					'current_before' => $args['before'],
					'current_after' => $args['after'],
				) );

				$html = str_replace( '<a ' , '<a' . $args['linkAttr'], $html );
				if ( $args['linkBefore'] && $args['before'] ) {
					$html = str_replace( $args['linkBefore'] . $args['before'] , $args['before'], $html );
				}

				if ( $args['linkAfter'] && $args['after'] ) {
					$html = str_replace( $args['linkAfter'] . $args['after'] , $args['after'], $html );
				}

				add_filter( 'bbp_no_breadcrumb', '__return_true', 20 );
			}
			return $html;
		}

	}

	Presscore_Modules_Compatibility_BBPress::execute();

endif;

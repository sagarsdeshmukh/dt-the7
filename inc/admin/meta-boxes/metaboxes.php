<?php
/**
 * Theme metaboxes.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Load meta box fields templates
require_once PRESSCORE_ADMIN_DIR . '/meta-boxes/metabox-fields-templates.php';

/**
 * Get advanced settings open block.
 *
 * @return string.
 */
function presscore_meta_boxes_advanced_settings_tpl( $id = 'dt-advanced' ) {
	return sprintf(
		'<div class="hide-if-no-js"><div class="dt_hr"></div><p><a href="#advanced-options" class="dt_advanced">
				<input type="hidden" name="%1$s" data-name="%1$s" value="hide" />
				<span class="dt_advanced-show">%2$s</span>
				<span class="dt_advanced-hide">%3$s</span> 
				%4$s
			</a></p></div><div class="%1$s dt_container hide-if-js"><div class="dt_hr"></div>',
		esc_attr(''.$id),
		_x('+ Show', 'backend metabox', 'the7mk2'),
		_x('- Hide', 'backend metabox', 'the7mk2'),
		_x('advanced settings', 'backend metabox', 'the7mk2')
	);
}

// define global metaboxes array
global $DT_META_BOXES;
$DT_META_BOXES = array();

// Get widgetareas
$widgetareas_list = presscore_get_widgetareas_options();
if ( !$widgetareas_list ) {
	$widgetareas_list = array('none' => _x('None', 'backend metabox', 'the7mk2'));
}

// Ordering settings
$order_options = array(
	'ASC'	=> _x('ascending', 'backend', 'the7mk2'),
	'DESC'	=> _x('descending', 'backend', 'the7mk2'),
);

$orderby_options = array(
	'ID'			=> _x('ID', 'backend', 'the7mk2'),
	'author'		=> _x('author', 'backend', 'the7mk2'),
	'title'			=> _x('title', 'backend', 'the7mk2'),
	'date'			=> _x('date', 'backend', 'the7mk2'),
	'name'			=> _x('name', 'backend', 'the7mk2'),
	'modified'		=> _x('modified', 'backend', 'the7mk2'),
	'parent'		=> _x('parent', 'backend', 'the7mk2'),
	'rand'			=> _x('rand', 'backend', 'the7mk2'),
	'comment_count'	=> _x('comment_count', 'backend', 'the7mk2'),
	'menu_order'	=> _x('menu_order', 'backend', 'the7mk2'),
);

$yes_no_options = array(
	'1'	=> _x('Yes', 'backend metabox', 'the7mk2'),
	'0' => _x('No', 'backend metabox', 'the7mk2'),
);

$enabled_disabled = array(
	'1'	=> _x('Enabled', 'backend metabox', 'the7mk2'),
	'0' => _x('Disabled', 'backend metabox', 'the7mk2'),
);

// Image settings
$repeat_options = array(
	'repeat'	=> _x('repeat', 'backend', 'the7mk2'),
	'repeat-x'	=> _x('repeat-x', 'backend', 'the7mk2'),
	'repeat-y'	=> _x('repeat-y', 'backend', 'the7mk2'),
	'no-repeat'	=> _x('no-repeat', 'backend', 'the7mk2'),
);

$position_x_options = array(
	'center'	=> _x('center', 'backend', 'the7mk2'),
	'left'		=> _x('left', 'backend', 'the7mk2'),
	'right'		=> _x('right', 'backend', 'the7mk2'),
);

$position_y_options = array(
	'center'	=> _x('center', 'backend', 'the7mk2'),
	'top'		=> _x('top', 'backend', 'the7mk2'),
	'bottom'	=> _x('bottom', 'backend', 'the7mk2'),
);

$load_style_options = array(
	'ajax_pagination'	=> _x('Pagination & filter with AJAX', 'backend metabox', 'the7mk2'),
	'ajax_more'			=> _x('"Load more" button & filter with AJAX', 'backend metabox', 'the7mk2'),
	'lazy_loading'		=> _x('Lazy loading', 'backend metabox', 'the7mk2'),
	'default'			=> _x('Standard (no AJAX)', 'backend metabox', 'the7mk2')
);

$font_size = array(
	'h1'		=> _x('h1', 'backend metabox', 'the7mk2'),
	'h2'		=> _x('h2', 'backend metabox', 'the7mk2'),
	'h3'		=> _x('h3', 'backend metabox', 'the7mk2'),
	'h4'		=> _x('h4', 'backend metabox', 'the7mk2'),
	'h5'		=> _x('h5', 'backend metabox', 'the7mk2'),
	'h6'		=> _x('h6', 'backend metabox', 'the7mk2'),
	'small'		=> _x('small', 'backend metabox', 'the7mk2'),
	'normal'	=> _x('medium', 'backend metabox', 'the7mk2'),
	'big'		=> _x('large', 'backend metabox', 'the7mk2')
);

$accent_custom_color = array(
	'accent'	=> _x('Accent', 'backend metabox', 'the7mk2'),
	'color'		=> _x('Custom color', 'backend metabox', 'the7mk2')
);

$proportions = presscore_meta_boxes_get_images_proportions();
$proportions_max = count($proportions);
$proportions_maybe_1x1 = array_search( 1, wp_list_pluck( $proportions, 'ratio' ) );

$rev_sliders = $layer_sliders = array( 'none' => _x('none', 'backend metabox', 'the7mk2') );

if ( class_exists('RevSlider') ) {

	$rev = new RevSlider();

	$arrSliders = $rev->getArrSliders();
	foreach ( (array) $arrSliders as $revSlider ) { 
		$rev_sliders[ $revSlider->getAlias() ] = $revSlider->getTitle();
	}
}

if ( function_exists('lsSliders') ) {

	$layerSliders = lsSliders();

	foreach ( $layerSliders as $lSlide ) {

		$layer_sliders[ $lSlide['id'] ] = $lSlide['name'];
	}
}

$slideshow_posts = array();

if ( post_type_exists( 'dt_slideshow' ) ) {

	$slideshow_query = new WP_Query( array(
		'no_found_rows'		=> true,
		'cache_results'		=> false,
		'posts_per_page'	=> -1,
		'post_type'			=> 'dt_slideshow',
		'post_status'		=> 'publish',
	) );

	if ( $slideshow_query->have_posts() ) {

		foreach ( $slideshow_query->posts as $slidehsow_post ) {

			$slideshow_posts[ $slidehsow_post->ID ] = esc_html( $slidehsow_post->post_title );
		}
	}

}

$pages_with_basic_meta_boxes = apply_filters( 'presscore_pages_with_basic_meta_boxes', array( 'page', 'post' ) );

/***********************************************************/
// Sidebar options
/***********************************************************/

$prefix = '_dt_sidebar_';

$DT_META_BOXES['dt_page_box-sidebar'] = array(
	'id'		=> 'dt_page_box-sidebar',
	'title' 	=> _x('Sidebar Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> $pages_with_basic_meta_boxes,
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'fields' 	=> array(

		// Sidebar option
		array(
			'name'    	=> _x('Sidebar position:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}position",
			'type'    	=> 'radio',
			'std'		=> 'right',
			'options'	=> array(
				'left' 		=> array( _x('Left', 'backend metabox', 'the7mk2'), array('sidebar-left.gif', 75, 50) ),
				'right' 	=> array( _x('Right', 'backend metabox', 'the7mk2'), array('sidebar-right.gif', 75, 50) ),
				'disabled'	=> array( _x('Disabled', 'backend metabox', 'the7mk2'), array('sidebar-disabled.gif', 75, 50) ),
			),
			'hide_fields'	=> array(
				'disabled'	=> array("{$prefix}widgetarea_id", "{$prefix}hide_on_mobile" ),
			)
		),

		// Sidebar widget area
		array(
			'name'     		=> _x('Sidebar widget area:', 'backend metabox', 'the7mk2'),
			'id'       		=> "{$prefix}widgetarea_id",
			'type'     		=> 'select',
			'options'  		=> $widgetareas_list,
			'std'			=> 'sidebar_1',
			'top_divider'	=> true
		),

		// Hide on mobile
		array(
			'name'    		=> _x('Hide on mobile layout:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}hide_on_mobile",
			'type'    		=> 'checkbox',
			'std'			=> 0
		),
	)
);

/***********************************************************/
// Footer options
/***********************************************************/

$prefix = '_dt_footer_';

$DT_META_BOXES['dt_page_box-footer'] = array(
	'id'		=> 'dt_page_box-footer',
	'title' 	=> _x('Footer Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> $pages_with_basic_meta_boxes,
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'fields' 	=> array(

		// Footer option
		array(
			'name'    		=> _x('Show widgetized footer:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}show",
			'type'    		=> 'checkbox',
			'std'			=> 1,
			'hide_fields'	=> array( "{$prefix}widgetarea_id", "{$prefix}hide_on_mobile" ),
		),

		// Sidebar widgetized area
		array(
			'name'     		=> _x('Footer widget area:', 'backend metabox', 'the7mk2'),
			'id'       		=> "{$prefix}widgetarea_id",
			'type'     		=> 'select',
			'options'  		=> $widgetareas_list,
			'std'			=> 'sidebar_2',
			'top_divider'	=> true
		),

		// Hide on mobile
		array(
			'name'    		=> _x('Hide on mobile layout:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}hide_on_mobile",
			'type'    		=> 'checkbox',
			'std'			=> 0
		),
	)
);

/***********************************************************/
// Header options
/***********************************************************/

$prefix = '_dt_header_';

$DT_META_BOXES['dt_page_box-header_options'] = array(
	'id'		=> 'dt_page_box-header_options',
	'title' 	=> _x('Page Header Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> $pages_with_basic_meta_boxes,
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Header options
		array(
			'id'      	=> "{$prefix}title",
			'type'    	=> 'radio',
			'std'		=> 'enabled',
			'options'	=> array(
				'enabled'	=> array( _x('Show page title', 'backend metabox', 'the7mk2'), array('regular-title.gif', 100, 60) ),
				'disabled'	=> array( _x('Hide page title', 'backend metabox', 'the7mk2'), array('no-title.gif', 100, 60) ),
				'fancy'		=> array( _x('Fancy title', 'backend metabox', 'the7mk2'), array('fancy-title.gif', 100, 60) ),
				'slideshow'	=> array( _x('Slideshow', 'backend metabox', 'the7mk2'), array('slider.gif', 100, 60) ),
			),
			'hide_fields'	=> array(
				'enabled'	=> array( "{$prefix}background_settings" ),
				'disabled'	=> array( "{$prefix}background_settings" ),
			),
			'class'     => 'wide',
		),

		// Header overlapping
		array(
			// container begin !!!
			'before'      => '<div class="rwmb-flickering-field ' . "rwmb-input-{$prefix}background_settings" . '">',

			'name'        => '',
			'id'          => "{$prefix}background",
			'type'        => 'radio',
			'std'         => 'normal',
			'top_divider' => true,
			'options'     => array(
				'normal'          => array( _x( 'Default', 'backend metabox', 'the7mk2' ), array( 'regular.gif', 75, 50 ) ),
				'overlap'         => array( _x( "Overlapping", 'backend metabox', 'the7mk2' ), array( 'overl.gif', 75, 50 ) ),
				'transparent'     => array( _x( "Transparent", 'backend metabox', 'the7mk2' ), array( 'transp.gif', 75, 50 ) ),
			),
			'hide_fields' => array(
				'normal'          => array( "{$prefix}transparent_settings" ),
				'overlap'         => array( "{$prefix}transparent_settings" ),
			),
		),

		array(
			// container begin !!!
			'before'      => "<div class=\"rwmb-flickering-field rwmb-input-{$prefix}header-below-slideshow\">",

			"type"        => "radio",
			"id"          => "{$prefix}background_below_slideshow",
			"name"        => _x( "Header below slideshow:", "theme-options", 'the7mk2' ),
			"std"         => "disabled",
			"options"     => array(
				'enabled'  => _x( "Enabled", "theme-options", 'the7mk2' ),
				'disabled' => _x( "Disabled", "theme-options", 'the7mk2' )
			),
			'top_divider' => true,

			'after'       => '</div>',
		),

		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-flickering-field ' . "rwmb-input-{$prefix}transparent_settings" . '">',

			'name'    		=> _x('Transparent background color:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}transparent_bg_color",
			'type'    		=> 'color',
			'std'			=> '#000000',
			'top_divider'   => true,
		),

		array(
			'name'	=> _x('Transparent background opacity:', 'backend metabox', 'the7mk2'),
			'id'	=> "{$prefix}transparent_bg_opacity",
			'type'	=> 'slider',
			'std'	=> 50,
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),

		array(
			"type"    => "radio",
			"id"      => "{$prefix}transparent_bg_color_scheme",
			"name"    => _x( "Color scheme:", "theme-options", 'the7mk2' ),
			"std"     => "light",
			"options" => array(
				'from_options' => _x( "From Theme Options", "theme-options", 'the7mk2' ),
				'light'        => _x( "Light", "theme-options", 'the7mk2' ),
			),

			'after'  => '</div></div>',
		),

	)
);

/***********************************************************/
// Slideshow Options
/***********************************************************/

$prefix = '_dt_slideshow_';

$DT_META_BOXES['dt_page_box-slideshow_options'] = array(
	'id'		=> 'dt_page_box-slideshow_options',
	'title' 	=> _x('Slideshow Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> $pages_with_basic_meta_boxes,
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Slideshow mode
		array(
			'id'      	=> "{$prefix}mode",
			'type'    	=> 'radio',
			'std'		=> 'porthole',
			'options'	=> array(
				'porthole' => array( _x('Porthole slider', 'backend metabox', 'the7mk2'), array('portholeslider.gif', 75, 50) ),
				'photo_scroller' => array( _x('Photo scroller', 'backend metabox', 'the7mk2'), array('photoscroller.gif', 75, 50) ),
				'3d' => array( _x('3D slideshow', 'backend metabox', 'the7mk2'), array('3dslider.gif', 75, 50) ),
				'revolution' => array( _x('Slider Revolution', 'backend metabox', 'the7mk2'), array('sliderrevolution.gif', 75, 50) ),
				'layer' => array( _x('LayerSlider', 'backend metabox', 'the7mk2'), array('layerslider.gif', 75, 50) ),
			),
			'hide_fields'	=> array(
				'porthole' => array( "{$prefix}photo_scroller_container", "{$prefix}revolution_slider", "{$prefix}layer_container", "{$prefix}3d_layout_container" ),
				'photo_scroller' => array( "{$prefix}3d_layout_container", "{$prefix}porthole_container", "{$prefix}revolution_slider", "{$prefix}layer_container" ),
				'3d' => array( "{$prefix}porthole_container", "{$prefix}revolution_slider", "{$prefix}layer_container", "{$prefix}photo_scroller_container" ),
				'revolution' => array( "{$prefix}porthole_container", "{$prefix}3d_layout_container", "{$prefix}sliders", "{$prefix}layer_container", "{$prefix}photo_scroller_container" ),
				'layer' => array( "{$prefix}porthole_container", "{$prefix}3d_layout_container", "{$prefix}sliders", "{$prefix}revolution_slider", "{$prefix}photo_scroller_container" ),
			)
		),

		// Sldeshows
		array(
			'name'    		=> _x('Slideshow(s):', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}sliders",
			'type'    		=> 'checkbox_list',
			'desc'  		=> $slideshow_posts ? _x('if non selected, all slideshows will be displayed.', 'backend metabox', 'the7mk2') . ' ' . presscore_get_post_type_edit_link( 'dt_slideshow', _x( 'Edit slideshows', 'backend metabox', 'the7mk2' ) ) : _x( 'none', 'backend metabox', 'the7mk2' ),
			'options'		=> $slideshow_posts,
			'top_divider'	=> true,
		),

		// Slideshow layout
		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-input-' . $prefix . '3d_layout_container rwmb-flickering-field">',

			'name'		=> _x('Layout:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}3d_layout",
			'type'    	=> 'radio',
			'std'		=> 'fullscreen-content',
			'options'	=> array(
				'fullscreen-content'	=> _x('full-screen', 'backend metabox', 'the7mk2'),
				'fullscreen+content'	=> _x('full-screen with content', 'backend metabox', 'the7mk2'),
				'prop-fullwidth'		=> _x('proportional, full-width', 'backend metabox', 'the7mk2'),
				'prop-content-width'	=> _x('proportional, content-width', 'backend metabox', 'the7mk2'),
			),
			'hide_fields'	=> array(
				'fullscreen-content'	=> array( "{$prefix}3d_slider_proportions" ),
				'fullscreen+content'	=> array( "{$prefix}3d_slider_proportions" ),
			),
			'top_divider'	=> true,
		),

		// Slider proportions
		array(
			'name'			=> _x('Slider proportions:', 'backend metabox', 'the7mk2'),
			'id'    		=> "{$prefix}3d_slider_proportions",
			'type'  		=> 'simple_proportions',
			'std'   		=> array('width' => 500, 'height' => 500),
			'top_divider'	=> true,

			// container end !!!
			'after'			=> '</div>'
		),

		// Slideshow layout
		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-input-' . $prefix . 'porthole_container rwmb-flickering-field">',

			'name'			=> _x('Slider layout:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}layout",
			'type'    	=> 'radio',
			'std'		=> 'fullwidth',
			'options'	=> array(
				'fullwidth'		=> _x('full-width', 'backend metabox', 'the7mk2'),
				'fixed'			=> _x('content-width', 'backend metabox', 'the7mk2'),
			),
			'top_divider'	=> true,
		),

		// Slider proportions
		array(
			'name'			=> _x('Slider proportions:', 'backend metabox', 'the7mk2'),
			'id'    		=> "{$prefix}slider_proportions",
			'type'  		=> 'simple_proportions',
			'std'   		=> array('width' => 1200, 'height' => 500),
		),

		// Scaling
		array(
			'name'			=> _x('Images sizing: ', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}scaling",
			'type'    		=> 'radio',
			'std'			=> 'fill',
			'options'	=> array(
				'fit'		=> _x('fit (preserve proportions)', 'backend metabox', 'the7mk2'),
				'fill'		=> _x('fill the viewport (crop)', 'backend metabox', 'the7mk2'),
			),
			'top_divider'	=> true,
		),

		// Autoplay
		array(
			'name'			=> _x('On page load slideshow is: ', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}autoplay",
			'type'    		=> 'radio',
			'std'			=> 'paused',
			'options'	=> array(
				'play'		=> _x('playing', 'backend metabox', 'the7mk2'),
				'paused'	=> _x('paused', 'backend metabox', 'the7mk2'),
			),
			'top_divider'	=> true,
		),

		// Autoslide interval
		array(
			'name'			=> _x('Autoslide interval (in milliseconds):', 'backend metabox', 'the7mk2'),
			'id'    		=> "{$prefix}autoslide_interval",
			'type'  		=> 'text',
			'std'   		=> '5000'
		),

		// Hide captions
		array(
			'name'    		=> _x('Hide captions:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}hide_captions",
			'type'    		=> 'checkbox',
			'std'			=> 0,

			// container end
			'after'			=> '</div>'
		),

		//////////////////////
		// Photo scroller //
		//////////////////////

		array(
			// container begin !!!
			'before'	=> '<div class="rwmb-input-' . $prefix . 'photo_scroller_container rwmb-flickering-field">',

			'name'		=> _x( 'Layout:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_layout",
			'type'		=> 'radio',
			'std'		=> 'fullscreen',
			'options'	=> array(
				'fullscreen'	=> _x( 'Fullscreen slideshow', 'backend metabox', 'the7mk2' ),
				'with_content'	=> _x( 'Fullscreen slideshow + text area', 'backend metabox', 'the7mk2' )
			),
			'divider'	=> 'top'
		),

		array(
			'name'     		=> _x( 'Background under slideshow:', 'backend metabox', 'the7mk2' ),
			'id'       		=> "{$prefix}photo_scroller_bg_color",
			'type'     		=> 'color',
			'std'			=> '#000000',
			'divider'		=> 'top'
		),

		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array(
			'id'		=> "{$prefix}photo_scroller_overlay",
			'name'		=> _x( 'Show pixel overlay:', 'backend metabox', 'the7mk2' ),
			'divider'	=> 'top'
		) ),

		array(
			'name'			=> _x('Top padding:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}photo_scroller_top_padding",
			'type'			=> 'text',
			'std'			=> '0',
			'divider'		=> 'top'
		),

		array(
			'name'			=> _x('Bottom padding:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}photo_scroller_bottom_padding",
			'type'			=> 'text',
			'std'			=> '0',
			'divider'		=> 'top'
		),

		array(
			'name'			=> _x('Side paddings:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}photo_scroller_side_paddings",
			'type'			=> 'text',
			'std'			=> '0',
			'divider'		=> 'top'
		),

		Presscore_Meta_Box_Field_Template::get_as_array( 'opacity slider', array(
			'name'		=> _x( 'Inactive image transparency (%):', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_inactive_opacity",
			'std' => 15,
			'divider'	=> 'top'
		) ),

		array(
			'name'     	=> _x( 'Thumbnails:', 'backend metabox', 'the7mk2' ),
			'id'       	=> "{$prefix}photo_scroller_thumbnails_visibility",
			'type'     	=> 'radio',
			'std'		=> 'show',
			'options'  	=> array(
				'show'		=> _x( 'Show by default', 'backend metabox', 'the7mk2' ),
				'hide'		=> _x( 'Hide by default', 'backend metabox', 'the7mk2' ),
				'disabled'	=> _x( 'Disable', 'backend metabox', 'the7mk2' )
			),
			'divider'	=> 'top'
		),

		array(
			'name'		=> _x( 'Thumbnails width:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_thumbnails_width",
			'type'		=> 'text',
			'std'		=> '',
			'divider'	=> 'top'
		),

		array(
			'name'		=> _x( 'Thumbnails height:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_thumbnails_height",
			'type'		=> 'text',
			'std'		=> 85,
			'divider'	=> 'top'
		),

		array(
			'name'     	=> _x( 'Autoplay:', 'backend metabox', 'the7mk2' ),
			'id'       	=> "{$prefix}photo_scroller_autoplay",
			'type'     	=> 'radio',
			'std'		=> 'play',
			'options'  	=> array(
				'play'		=> _x( 'Play', 'backend metabox', 'the7mk2' ),
				'paused'	=> _x( 'Paused', 'backend metabox', 'the7mk2' ),
			),
			'divider'	=> 'top'
		),

		array(
			'name'		=> _x( 'Autoplay speed:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_autoplay_speed",
			'type'		=> 'text',
			'std'		=> '4000',
			'divider'	=> 'top'
		),

		array(
			'type' => 'heading',
			'name' => _x( 'Landscape images', 'backend metabox', 'the7mk2' ),
			'id' => 'fake_id',
		),

		// Landscape images settings

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller max width', array(
			'id' => "{$prefix}photo_scroller_ls_max_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller min width', array(
			'id' => "{$prefix}photo_scroller_ls_min_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode desktop', array(
			'id' => "{$prefix}photo_scroller_ls_fill_dt",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode mobile', array(
			'id' => "{$prefix}photo_scroller_ls_fill_mob",
		) ),

		// Portrait iamges settings

		array(
			'type' => 'heading',
			'name' => _x( 'Portrait images', 'backend metabox', 'the7mk2' ),
			'id' => 'fake_id',
		),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller max width', array(
			'id' => "{$prefix}photo_scroller_pt_max_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller min width', array(
			'id' => "{$prefix}photo_scroller_pt_min_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode desktop', array(
			'id' => "{$prefix}photo_scroller_pt_fill_dt",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode mobile', array(
			'id' => "{$prefix}photo_scroller_pt_fill_mob",

			// container end !!!
			'after' => '</div>',
		) ),

		// Revolution slider
		array(
			'name'     		=> _x('Choose slider: ', 'backend metabox', 'the7mk2'),
			'id'       		=> "{$prefix}revolution_slider",
			'type'     		=> 'select',
			'std'			=>'none',
			'options'  		=> $rev_sliders,
			'multiple' 		=> false,
			'top_divider'	=> true
		),

		// LayerSlider
		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-input-' . $prefix . 'layer_container rwmb-flickering-field">',

			'name'     		=> _x('Choose slider:', 'backend metabox', 'the7mk2'),
			'id'       		=> "{$prefix}layer_slider",
			'type'     		=> 'select',
			'std'			=>'none',
			'options'  		=> $layer_sliders,
			'multiple' 		=> false,
			'top_divider'	=> true
		),

		// Fixed background
		array(
			// container end !!!
			'after'			=> '</div>',

			'name'    		=> _x('Enable slideshow background and paddings:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}layer_show_bg_and_paddings",
			'type'    		=> 'checkbox',
			'std'			=> 0
		),

	)
);

/***********************************************************/
// Fancy title options
/***********************************************************/

$prefix = '_dt_fancy_header_';

$DT_META_BOXES['dt_page_box-fancy_header_options'] = array(
	'id'		=> 'dt_page_box-fancy_header_options',
	'title' 	=> _x('Fancy Title Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> $pages_with_basic_meta_boxes,
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		///////////////////////
		// Title alignment //
		///////////////////////

		array(
			'name'    	=> _x('Fancy title layout:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}title_aligment",
			'type'    	=> 'radio',
			'std'		=> 'center',
			'options'	=> array(
				'left'		=> array( _x('Left title + right breadcrumbs', 'backend metabox', 'the7mk2'), array('l-r-page.gif', 75, 50) ),
				'right'		=> array( _x('Right title + left breadcrumbs', 'backend metabox', 'the7mk2'), array('r-l-page.gif', 75, 50) ),
				'all_left'	=> array( _x('Left title + left breadcrumbs', 'backend metabox', 'the7mk2'), array('l-l-page.gif', 75, 50) ),
				'all_right'	=> array( _x('Right title + right breadcrumbs', 'backend metabox', 'the7mk2'), array('r-r-page.gif', 75, 50) ),
				'center'	=> array( _x('Centred title + centred breadcrumbs', 'backend metabox', 'the7mk2'), array('centre-page.gif', 75, 50) )
			)
		),

		///////////////////
		// Breadcrumbs //
		///////////////////

		array(
			'name'			=> _x('Breadcrumbs:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}breadcrumbs",
			'type'	 		=> 'radio',
			'std'			=> 'enabled',
			'top_divider'	=> true,
			'hide_fields'	=> array('disabled'	=> array( "{$prefix}breadcrumbs_settings" ) ),
			'options'		=> array(
				'enabled'	=> _x('Enabled', 'backend metabox', 'the7mk2'),
				'disabled'	=> _x('Disabled', 'backend metabox', 'the7mk2'),
			)
		),

		// Breadcrumbs text color
		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-flickering-field ' . "rwmb-input-{$prefix}breadcrumbs_settings" . '">',

			'name'    		=> _x('Breadcrumbs text color:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}breadcrumbs_text_color",
			'type'    		=> 'color',
			'std'			=> '#ffffff'
		),

		// Breadcrumbs background color
		array(
			'name'			=> _x('Breadcrumbs background color:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}breadcrumbs_bg_color",
			'type'	 		=> 'radio',
			'std'			=> 'disabled',
			'options'		=> array(
				'disabled'	=> _x('Disabled', 'backend metabox', 'the7mk2'),
				'black'		=> _x('Black', 'backend metabox', 'the7mk2'),
				'white'		=> _x('White', 'backend metabox', 'the7mk2'),
			),

			// container end
			'after'	=> '</div>'
		),

		//////////////////////
		// Title settings //
		//////////////////////

		// Title
		array(
			'name'			=> _x('Title:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}title_mode",
			'type'	 		=> 'radio',
			'std'			=> 'custom',
			'top_divider'	=> true,
			'hide_fields'	=> array('generic'	=> array( "{$prefix}title" ) ),
			'options'		=> array(
				'generic'	=> _x('Generic title', 'backend metabox', 'the7mk2'),
				'custom'	=> _x('Custom title', 'backend metabox', 'the7mk2'),
			)
		),

		// Custom Title
		array(
			'name'			=> _x('Custom title:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}title",
			'type'			=> 'text',
			'std'			=> ''
		),

		// Title font size
		array(
			'name'     	=> _x('Title font size:', 'backend metabox', 'the7mk2'),
			'id'       	=> "{$prefix}title_size",
			'type'     	=> 'select',
			'options'  	=> $font_size,
			'std'		=> 'h1'
		),

		// Title font color
		array(
			'name'			=> _x('Title font color:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}title_color_mode",
			'type'	 		=> 'radio',
			'std'			=> 'color',
			'hide_fields'	=> array( 'accent' => array( "{$prefix}title_color_settings" ) ),
			'options'		=> $accent_custom_color
		),

		// Title color
		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-flickering-field ' . "rwmb-input-{$prefix}title_color_settings" . '">',

			'name'    		=> '&nbsp;',
			'id'      		=> "{$prefix}title_color",
			'type'    		=> 'color',
			'std'			=> '#ffffff',

			// container end
			'after'			=> '</div>'
		),

		/////////////////////////
		// Subtitle settings //
		/////////////////////////

		// Subtitle
		array(
			'name'    	=> _x('Subtitle:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}subtitle",
			'type'    	=> 'text',
			'std'		=> '',
			'top_divider'	=> true,
		),

		// Subtitle font size
		array(
			'name'     	=> _x('Subtitle font size:', 'backend metabox', 'the7mk2'),
			'id'       	=> "{$prefix}subtitle_size",
			'type'     	=> 'select',
			'options'  	=> $font_size,
			'std'		=> 'h3'
		),

		// Subtitle font color
		array(
			'name'			=> _x('Subtitle font color:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}subtitle_color_mode",
			'type'	 		=> 'radio',
			'std'			=> 'color',
			'hide_fields'	=> array( 'accent' => array( "{$prefix}subtitle_color_settings" ) ),
			'options'		=> $accent_custom_color
		),

		// Subtitle color
		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-flickering-field ' . "rwmb-input-{$prefix}subtitle_color_settings" . '">',

			'name'    		=> '&nbsp;',
			'id'      		=> "{$prefix}subtitle_color",
			'type'    		=> 'color',
			'std'			=> '#ffffff',

			// container end
			'after'			=> '</div>'
		),

		///////////////////////////
		// Background settings //
		///////////////////////////

		// Background color
		array(
			'name'    		=> _x('Background color:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}bg_color",
			'type'    		=> 'color',
			'std'			=> '#222222',
			'top_divider'	=> true,
		),

		// Background image
		array(
			'name'             	=> _x('Background image:', 'backend metabox', 'the7mk2'),
			'id'               	=> "{$prefix}bg_image",
			'type'             	=> 'image_advanced_mk2',
			'max_file_uploads'	=> 1,
		),

		// Repeat options
		array(
			'name'     	=> _x('Repeat options:', 'backend metabox', 'the7mk2'),
			'id'       	=> "{$prefix}bg_repeat",
			'type'     	=> 'select',
			'options'  	=> $repeat_options,
			'std'		=> 'no-repeat'
		),

		// Position x
		array(
			'name'     	=> _x('Position x:', 'backend metabox', 'the7mk2'),
			'id'       	=> "{$prefix}bg_position_x",
			'type'     	=> 'select',
			'options'  	=> $position_x_options,
			'std'		=> 'center'
		),

		// Position y
		array(
			'name'     	=> _x('Position y:', 'backend metabox', 'the7mk2'),
			'id'       	=> "{$prefix}bg_position_y",
			'type'     	=> 'select',
			'options'  	=> $position_y_options,
			'std'		=> 'center'
		),

		// Fullscreen
		array(
			'name'    		=> _x('Fullscreen:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}bg_fullscreen",
			'type'    		=> 'checkbox',
			'std'			=> 1,
		),

		// Fixed background
		array(
			'name'    		=> _x('Fixed background:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}bg_fixed",
			'type'    		=> 'checkbox',
			'std'			=> 0
		),

		// Enable parallax & Parallax speed
		array(
			'name'    	=> _x('Parallax speed:', 'backend metabox', 'the7mk2'),
			'desc'  	=> _x('if field is empty, parallax disabled', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}parallax_speed",
			'type'    	=> 'text',
			'std'		=> '0',
		),

		// Height
		array(
			'name'    	=> _x('Height (px):', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}height",
			'type'    	=> 'text',
			'std'		=> '300'
		),

	)
);

/***********************************************************/
// Content area options
/***********************************************************/

$prefix = '_dt_content_';

$DT_META_BOXES['dt_page_box-page_content'] = array(
	'id'		=> 'dt_page_box-page_content',
	'title' 	=> _x('Content Area Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Display content area
		array(
			'name'    	=> _x('Display content area:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}display",
			'type'    	=> 'radio',
			'std'		=> 'no',
			'options'	=> array(
				'no' 			=> _x('no', 'backend metabox', 'the7mk2'),
				'on_first_page'	=> _x('first page', 'backend metabox', 'the7mk2'),
				'on_all_pages'	=> _x('all pages', 'backend metabox', 'the7mk2'),
			),
			'hide_fields'	=> array('no'	=> "{$prefix}position")
		),

		// Content area position
		array(
			'name'    	=> _x('Content area position', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}position",
			'type'    	=> 'radio',
			'std'		=> 'before_items',
			'options'	=> array(
				'before_items'	=> array( _x('Before items', 'backend metabox', 'the7mk2'), array( 'before-posts.gif', 60, 67 ) ),
				'after_items'	=> array( _x('After items', 'backend metabox', 'the7mk2'), array( 'under-posts.gif', 60, 67 ) ),
			),
		),

	),
	'only_on'	=> array( 'template' => array(
		'template-portfolio-list.php',
		'template-portfolio-masonry.php',
		'template-portfolio-jgrid.php',
		'template-blog-list.php',
		'template-blog-masonry.php',
		'template-albums.php',
		'template-albums-jgrid.php',
		'template-media.php',
		'template-media-jgrid.php',
		'template-team.php',
		'template-testimonials.php',
	) ),
);

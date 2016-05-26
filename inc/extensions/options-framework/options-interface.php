<?php

/**
 * Generates the tabs that are used in the options menu
 */

function optionsframework_tabs() {
	$counter = 0;
	$menu = '';

	$cur_page_id = optionsframework_get_cur_page_id();
	$options = optionsframework_get_page_options( $cur_page_id );

	foreach ( $options as $value ) {
		// Heading for Navigation
		if ( isset( $value['type'] ) && $value['type'] == "heading" ) {
			$counter++;
			$class = '';
			$class = ! empty( $value['id'] ) ? $value['id'] : $value['name'];
			$class = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower($class) ) . '-tab';
			$menu .= '<a id="options-group-'.  $counter . '-tab" class="nav-tab ' . $class .'" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#options-group-'.  $counter ) . '">' . esc_html( $value['name'] ) . '</a>';
		}
	}

	return $menu;
}

/**
 * Generates the options fields that are used in the form.
 */

function optionsframework_fields() {
	$cur_page_id = optionsframework_get_cur_page_id();
	$options = optionsframework_get_page_options( $cur_page_id );

	optionsframework_interface( $options, $cur_page_id );
}

function optionsframework_interface( $options, $cur_page_id ) {
	$optionsframework_settings = get_option( 'optionsframework' );

	// Gets the unique option id
	if ( isset( $optionsframework_settings['id'] ) ) {
		$option_name = $optionsframework_settings['id'];
	}
	else {
		$option_name = 'optionsframework';
	};
	$settings = apply_filters( "optionsframework_fields_saved_settings-{$cur_page_id}", get_option( $option_name ) );

	$optionsframework_debug = presscore_options_debug();
	$do_not_export = apply_filters( 'optionsframework_fields_black_list', array() );
	$preserved_options = apply_filters( 'optionsframework_validate_preserve_fields', array() );

	$in_block = false;
	$counter = 0;
	$menu = '';
	$elements_without_wrap = array(
		'block_begin',
		'block_end',
		'block',
		'heading',
		'info',
		'page',
		'js_hide_begin',
		'js_hide_end',
		'title',
		'divider'
	);

	foreach ( $options as $value ) {

		if ( ! is_array( $value ) || ! array_key_exists( 'type', $value ) ) {
			continue;
		}

		$val = '';
		$select_value = '';
		$checked = '';
		$output = '';

		// Set default value to $val
		if ( isset( $value['std'] ) ) {
			$val = $value['std'];
		}

		// If the option is already saved, ovveride $val
		if ( !in_array( $value['type'], array( 'page', 'info', 'heading' ) ) ) {
			if ( isset( $value['id'], $settings[($value['id'])] ) ) {
				$val = $settings[($value['id'])];
				// Striping slashes of non-array options
				if ( !is_array($val) && ! in_array( $value['type'], array( 'textarea' ) ) ) {
					$val = stripslashes( $val );
				}
			}
		}

		if ( !empty($value['before']) ) {
			$output .= $value['before'];
		}

		// Wrap all options
		if ( !in_array( $value['type'], $elements_without_wrap ) ) {

			$data_attr = '';
			if ( in_array( $value['type'], array( 'radio', 'checkbox', 'select', 'slider', 'images' ) ) ) {
				$data_attr .= ' data-value="' . esc_attr( $val ) . '"';
			}

			// Keep all ids lowercase with no spaces
			$value['id'] = preg_replace('/(\W!-)/', '', strtolower($value['id']) );

			$id = 'section-' . $value['id'];

			$class = 'section';
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '"' . $data_attr . '>'."\n";

			if ( isset( $value['divider'] ) && in_array( $value['divider'], array( 'top', 'surround' ) ) ) {
				$output .= '<div class="divider"></div>' . "\n";
			}

			$output .= '<div class="option">' . "\n";

			if ( !empty( $value['name'] ) ) {

				$output .= '<div class="name">' . ( !empty( $value['name'] ) ? esc_html( $value['name'] ): '' ) . "\n";

				if ( isset( $value['desc'] ) ) {
					$explain_value = $value['desc'];
					$output .= '<div class="explain"><small>' . esc_html( $explain_value ) . '</small></div>'."\n";
				}

				$output .= '</div>' . "\n";
			}

			if ( $value['type'] != 'editor' ) {

				if ( empty( $value['name'] ) ) {
					$output .= '<div class="controls controls-fullwidth">' . "\n";
				} else {
					$output .= '<div class="controls">' . "\n";
				}
			}
			else {
				$output .= '<div>' . "\n";
			}
		}

		if ( isset( $value['dependency'] ) ) {
			optionsframework_fields_dependency()->set( $value['id'], $value['dependency'] );
		}

		switch ( $value['type'] ) {

		// Basic text input
		case 'text':
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

		// Password input
		case 'password':
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="password" value="' . esc_attr( $val ) . '" />';
			break;

		// Textarea
		case 'textarea':
			$rows = '8';

			if ( isset( $value['settings']['rows'] ) ) {
				$custom_rows = $value['settings']['rows'];
				if ( is_numeric( $custom_rows ) ) {
					$rows = $custom_rows;
				}
			}

			if ( empty( $value['sanitize'] ) || 'without_sanitize' != $value['sanitize'] ) {
				$val = stripslashes( $val );
			}

			$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '">' . esc_textarea( $val ) . '</textarea>';
			break;

		// Select Box
		case 'select':
			$output .= '<select class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '">';

			foreach ($value['options'] as $key => $option ) {
				$selected = '';
				if ( $val != '' ) {
					if ( $val == $key) { $selected = ' selected="selected"';}
				}
				$output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			}
			$output .= '</select>';
			break;


		// Radio Box
		case "radio":
			$name = $option_name .'['. $value['id'] .']';

			$wrap_class = 'controls-input-wrap';
			if ( empty( $value['style'] ) || 'horizontal' == $value['style'] ) {
				$wrap_class .= ' inline-input-wrap';
			} else if ( 'vertical' == $value['style'] ) {
				$wrap_class .= ' block-input-wrap';
			}

			$show_hide = empty($value['show_hide']) ? array() : (array) $value['show_hide'];
			$classes = array( 'of-input', 'of-radio' );

			if ( !empty($show_hide) ) {
				$classes[] = 'of-js-hider';
			}

			foreach ($value['options'] as $key => $option) {
				$id = $option_name . '-' . $value['id'] .'-'. $key;
				$input_classes = $classes;
				$attr = '';

				if ( !empty($show_hide[ $key ]) ) {
					$input_classes[] = 'js-hider-show';

					if ( true !== $show_hide[ $key ] ) {

						if ( is_array( $show_hide[ $key ] ) ) {
							$data_js_atregt = implode( ', .', $show_hide[ $key ] );
						} else {
							$data_js_atregt = $show_hide[ $key ];
						}

						$attr = ' data-js-target="' . $data_js_atregt . '"';
					}
				}

				$output .= '<div class="' . $wrap_class . '">' 
					. '<input class="' . esc_attr(implode(' ', $input_classes)) . '"' . $attr . ' type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' />' 
					. '<label for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label>' 
					. '</div>';
			}
			break;

		// Image Selectors
		case "images":
			$name = $option_name .'['. $value['id'] .']';
			$show_hide = empty($value['show_hide']) ? array() : (array) $value['show_hide'];
			$classes = array('of-radio-img-radio');

			if ( !empty($show_hide) ) {
				$classes[] = 'of-js-hider';
			}

			if ( empty($value['base_dir']) ) {
				$dir = get_template_directory_uri();
			} else {
				$dir = $value['base_dir'];
			}

			foreach ( $value['options'] as $key => $option ) {
				$input_classes = $classes;
				$selected = '';
				$checked = '';
				$attr = '';

				if ( $val == $key ) {
					$selected = ' of-radio-img-selected';
					$checked = ' checked="checked"';
				}

				if ( !empty($show_hide[ $key ]) ) {
					$input_classes[] = 'js-hider-show';

					if ( true !== $show_hide[ $key ] ) {

						if ( is_array( $show_hide[ $key ] ) ) {
							$data_js_atregt = implode( ', .', $show_hide[ $key ] );
						} else {
							$data_js_atregt = $show_hide[ $key ];
						}

						$attr = ' data-js-target="' . $data_js_atregt . '"';
					}
				}

				$output .= '<div class="of-radio-img-inner-container">';

				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="' . esc_attr(implode(' ', $input_classes)) . '"' . $attr . ' value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';

				$img_info = '';
				if ( is_array( $option ) && isset( $option['src'], $option['title'] ) ) {
					$img = $dir . $option['src'];
					$title = $option['title'];

					if ( $title ) {

						$img_title_style = '';
						if ( isset( $option['title_width'] ) ) {
							$img_title_style = ' style="width: ' . absint( $option['title_width'] ) . 'px;"';
						}

						$img_info = '<div class="of-radio-img-label"' . $img_title_style . '>' . esc_html($title) . '</div>';
					}
				} else if ( $option !== $key ) {
					$img = $dir . $option;
					$title = $option;
				} else {
					$img = presscore_get_default_small_image();
					$img = $img[0];
					$title = $option;
					$img_title_style = '';
					if ( isset( $option['title_width'] ) ) {
						$img_title_style = ' style="width: ' . absint( $option['title_width'] ) . 'px;"';
					}

					$img_info = '<div class="of-radio-img-label"' . $img_title_style . '>' . esc_html($title) . '</div>';
				}
				
				$output .= '<img src="' . esc_url( $img ) . '" alt="' . esc_attr($title) .'" class="of-radio-img-img' . $selected .'" onclick="dtRadioImagesSetCheckbox(\''. esc_attr($value['id'] .'_'. $key) .'\');" />';

				$output .= $img_info;

				$output .= '</div>';
			}
			break;

		// Checkbox
		case "checkbox":
			
			$classes = array();
			$classes[] = 'checkbox';
			$classes[] = 'of-input';
			if( isset($value['options']['java_hide']) && $value['options']['java_hide'] ) {
				$classes[] = 'of-js-hider';
			}else if( isset($value['options']['java_hide_global']) && $value['options']['java_hide_global'] ) {
				$classes[] = 'of-js-hider-global';
			}
			$classes = implode(' ', $classes);
			
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="' . $classes . '" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked( $val, 1, false) .' />';
			break;

		// Multicheck
		case "multicheck":
			foreach ($value['options'] as $key => $option) {
				$checked = '';
				$label = $option;
				$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));

				$id = $option_name . '-' . $value['id'] . '-'. $option;
				$name = $option_name . '[' . $value['id'] . '][' . $option .']';

				if ( isset($val[$option]) ) {
					$checked = checked($val[$option], 1, false);
				}

				$output .= '<input id="' . esc_attr( $id ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $name ) . '" ' . $checked . ' /><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
			}
			break;

		// Color picker
		case "color":
			$default_color = '';
			if ( isset($value['std']) ) {
				if ( $val !=  $value['std'] )
					$default_color = ' data-default-color="' .$value['std'] . '" ';
			}
			$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" class="of-color"  type="text" value="' . esc_attr( $val ) . '"' . $default_color .' />';
	
			break;

		// Uploader
		case "upload":
			$mode = isset( $value['mode'] ) ? $value['mode'] : 'uri_only';
			$output .= optionsframework_uploader( $value['id'], $val, $mode, null );
			
			break;

		// Typography
		case 'typography':
		
			unset( $font_size, $font_style, $font_face, $font_color );
		
			$typography_defaults = array(
				'size' => '',
				'face' => '',
				'style' => '',
				'color' => ''
			);
			
			$typography_stored = wp_parse_args( $val, $typography_defaults );
			
			$typography_options = array(
				'sizes' => of_recognized_font_sizes(),
				'faces' => of_recognized_font_faces(),
				'styles' => of_recognized_font_styles(),
				'color' => true
			);
			
			if ( isset( $value['options'] ) ) {
				$typography_options = wp_parse_args( $value['options'], $typography_options );
			}

			// Font Size
			if ( $typography_options['sizes'] ) {
				$font_size = '<select class="of-typography of-typography-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" id="' . esc_attr( $value['id'] . '_size' ) . '">';
				$sizes = $typography_options['sizes'];
				foreach ( $sizes as $i ) {
					$size = $i . 'px';
					$font_size .= '<option value="' . esc_attr( $size ) . '" ' . selected( $typography_stored['size'], $size, false ) . '>' . esc_html( $size ) . '</option>';
				}
				$font_size .= '</select>';
			}

			// Font Face
			if ( $typography_options['faces'] ) {
				$font_face = '<select class="of-typography of-typography-face" name="' . esc_attr( $option_name . '[' . $value['id'] . '][face]' ) . '" id="' . esc_attr( $value['id'] . '_face' ) . '">';
				$faces = $typography_options['faces'];
				foreach ( $faces as $key => $face ) {
					$font_face .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['face'], $key, false ) . '>' . esc_html( $face ) . '</option>';
				}
				$font_face .= '</select>';
			}

			// Font Styles
			if ( $typography_options['styles'] ) {
				$font_style = '<select class="of-typography of-typography-style" name="'.$option_name.'['.$value['id'].'][style]" id="'. $value['id'].'_style">';
				$styles = $typography_options['styles'];
				foreach ( $styles as $key => $style ) {
					$font_style .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['style'], $key, false ) . '>'. $style .'</option>';
				}
				$font_style .= '</select>';
			}

			// Font Color
			if ( $typography_options['color'] ) {
				$default_color = '';
				if ( isset($value['std']['color']) ) {
					if ( $val !=  $value['std']['color'] )
						$default_color = ' data-default-color="' .$value['std']['color'] . '" ';
				}
				$font_color = '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" class="of-color of-typography-color  type="text" value="' . esc_attr( $typography_stored['color'] ) . '"' . $default_color .' />';
			}
	
			// Allow modification/injection of typography fields
			$typography_fields = compact( 'font_size', 'font_face', 'font_style', 'font_color' );
			$typography_fields = apply_filters( 'of_typography_fields', $typography_fields, $typography_stored, $option_name, $value );
			$output .= implode( '', $typography_fields );
			
			break;

		// Background
		case 'background':

			$background = $val;

			// Background Color
			$default_color = '';
			if ( isset( $value['std']['color'] ) ) {
				if ( $val !=  $value['std']['color'] )
					$default_color = ' data-default-color="' .$value['std']['color'] . '" ';
			}
			$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" class="of-color of-background-color"  type="text" value="' . esc_attr( $background['color'] ) . '"' . $default_color .' />';

			// Background Image
			if ( !isset($background['image']) ) {
				$background['image'] = '';
			}
			
			$output .= optionsframework_uploader( $value['id'], $background['image'], null, esc_attr( $option_name . '[' . $value['id'] . '][image]' ) );
			
			$class = 'of-background-properties';
			if ( '' == $background['image'] ) {
				$class .= ' hide';
			}
			$output .= '<div class="' . esc_attr( $class ) . '">';

			// Background Repeat
			$output .= '<select class="of-background of-background-repeat" name="' . esc_attr( $option_name . '[' . $value['id'] . '][repeat]'  ) . '" id="' . esc_attr( $value['id'] . '_repeat' ) . '">';
			$repeats = of_recognized_background_repeat();

			foreach ($repeats as $key => $repeat) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['repeat'], $key, false ) . '>'. esc_html( $repeat ) . '</option>';
			}
			$output .= '</select>';

			// Background Position
			$output .= '<select class="of-background of-background-position" name="' . esc_attr( $option_name . '[' . $value['id'] . '][position]' ) . '" id="' . esc_attr( $value['id'] . '_position' ) . '">';
			$positions = of_recognized_background_position();

			foreach ($positions as $key=>$position) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position'], $key, false ) . '>'. esc_html( $position ) . '</option>';
			}
			$output .= '</select>';

			// Background Attachment
			$output .= '<select class="of-background of-background-attachment" name="' . esc_attr( $option_name . '[' . $value['id'] . '][attachment]' ) . '" id="' . esc_attr( $value['id'] . '_attachment' ) . '">';
			$attachments = of_recognized_background_attachment();

			foreach ($attachments as $key => $attachment) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['attachment'], $key, false ) . '>' . esc_html( $attachment ) . '</option>';
			}
			$output .= '</select>';
			$output .= '</div>';

			break;
			
		// Editor
		case 'editor':
			$output .= '<div class="explain">' . wp_kses( $explain_value, $allowedtags) . '</div>'."\n";
			echo $output;
			$textarea_name = esc_attr( $option_name . '[' . $value['id'] . ']' );
			$default_editor_settings = array(
				'textarea_name' => $textarea_name,
				'media_buttons' => false,
				'tinymce' => array( 'plugins' => 'wordpress' )
			);
			$editor_settings = array();
			if ( isset( $value['settings'] ) ) {
				$editor_settings = $value['settings'];
			}
			$editor_settings = array_merge($editor_settings, $default_editor_settings);
			wp_editor( $val, $value['id'], $editor_settings );
			$output = '';
			break;

		// Info
		case "info":
			$id = '';
			$class = 'section';
			if ( isset( $value['id'] ) ) {
				$id = 'id="' . esc_attr( $value['id'] ) . '" ';
			}
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div ' . $id . 'class="' . esc_attr( $class ) . '"><div class="info-block">';

			if ( isset($value['name']) ) {
				$output .= '<h4 class="heading">' . esc_html( $value['name'] ) . '</h4>';
			}

			if ( $value['desc'] ) {
				$output .= '<div class="info-description">' . apply_filters('of_sanitize_info', $value['desc'] ) . '</div>';
			}

			if ( !empty($value['image']) ) {
				$output .= '<div class="info-image-holder"><img src="' . esc_url( $value['image'] ) . '" /></div>';
			}

			$output .= '</div></div>';
			break;

		// Heading for Navigation
		case "heading":
			if ( $in_block ) {
				$in_block = false;
				$output .= '</div>'."\n".'<!-- block_end -->';
			}

			$counter++;
			if ( $counter >= 2 ) {
				$output .= '</div>'."\n";
			}

			$class = '';
			$class = ! empty( $value['id'] ) ? $value['id'] : $value['name'];
			$class = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($class) );
			$output .= '<div id="options-group-' . $counter . '" class="group ' . $class . '">';
			break;

		/* Custom fields */

		// Background
		case 'background_img':

			$preset_images = empty( $value['preset_images'] ) ? presscore_opts_get_bg_images( $value['id'] ) : $value['preset_images'];

			$img_preview = false;

			if ( $preset_images ) {

				$output .= '<div class="of-background-preset-images">';

				if ( empty( $value['images_base_dir'] ) ) {
					$dir = get_template_directory_uri();

				} else {
					$dir = $value['images_base_dir'];

				}

				foreach ( $preset_images as $full_src=>$thumb_src ) {
					$selected = '';
					$img = $dir . $thumb_src;
					$data_img = $dir . $full_src;

					if ( strpos($val['image'], $full_src) !== false ) {
						$selected = ' of-radio-img-selected';
						$img_preview = $img;
					}
					
					$output .= '<img data-full-src="' . esc_attr($data_img) . '" src="' . esc_url( $img ) . '" alt="" class="of-radio-img-img' . $selected .'" width="47" height="47" />';
				}

				$output .= '</div>';

			}

			$background = $val;

			// Background Image
			if ( !isset($background['image']) ) {
				$background['image'] = '';
			}

			$output .= optionsframework_uploader( $value['id'], $background['image'], null, null, esc_attr( $option_name . '[' . $value['id'] . '][image]' ) );
			
			$class = 'of-background-properties';
			
			if ( '' == $background['image'] ) {
				$class .= ' hide';
			}
			
			$output .= '<div class="' . esc_attr( $class ) . '">';

			if ( !isset($value['fields']) || in_array('repeat', (array) $value['fields']) ) {

				// Background Repeat
				$output .= '<select class="of-background of-background-repeat" name="' . esc_attr( $option_name . '[' . $value['id'] . '][repeat]'  ) . '" id="' . esc_attr( $value['id'] . '_repeat' ) . '">';
				$repeats = of_recognized_background_repeat();

				foreach ($repeats as $key => $repeat) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['repeat'], $key, false ) . '>'. esc_html( $repeat ) . '</option>';
				}
				$output .= '</select>';

			}

			if ( !isset($value['fields']) || in_array('position_x', (array) $value['fields']) ) {

				// Background Position x
				$output .= '<select class="of-background of-background-position" name="' . esc_attr( $option_name . '[' . $value['id'] . '][position_x]' ) . '" id="' . esc_attr( $value['id'] . '_position_x' ) . '">';
				$positions = of_recognized_background_horizontal_position();

				foreach ($positions as $key=>$position) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position_x'], $key, false ) . '>'. esc_html( $position ) . '</option>';
				}
				$output .= '</select>';

			}

			if ( !isset($value['fields']) || in_array('position_y', (array) $value['fields']) ) {

				// Background Position y
				$output .= '<select class="of-background of-background-position" name="' . esc_attr( $option_name . '[' . $value['id'] . '][position_y]' ) . '" id="' . esc_attr( $value['id'] . '_position_y' ) . '">';
				$positions = of_recognized_background_vertical_position();

				foreach ($positions as $key=>$position) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position_y'], $key, false ) . '>'. esc_html( $position ) . '</option>';
				}
				$output .= '</select>';

			}

			// Background Attachment

			$output .= '</div>';

			break;

		// Block
		case "block":
		case "block_begin":
			if ( $in_block ) {
				$in_block = false;
				$output .= '</div>'."\n".'<!-- block_end -->';
			}

			$in_block = true;
			$class = 'section';
			$id = '';
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}
			if( isset( $value['id'] ) ){
				$id .= ' id="' . esc_attr($value['id']) . '"'; 
			}
			$output .= '<div' .$id. ' class="postbox ' . esc_attr( $class ) . '">'."\n";
			if( isset($value['name']) && !empty($value['name']) ){
				$output .= '<h3>' . esc_html( $value['name'] ) . '</h3>' . "\n";
			}
		break;

		// Page
		case "page": break;

		// fields generator
		case "fields_generator":

			if ( ! isset( $value['options']['fields'] ) || ! is_array( $value['options']['fields'] ) ) {
				break;
			}

			$del_link = '<div class="submitbox"><a href="#" class="of_fields_gen_del submitdelete">'. _x('Delete', 'backend fields', 'the7mk2'). '</a></div>';
			
			$output .= '<ul class="of_fields_gen_list">';

			// saved elements
			if ( is_array( $val ) ) {

				$i = 0;
				// create elements
				foreach ( $val as $index=>$field ) {

					$block = $b_title = '';
					// use patterns
					foreach ( $value['options']['fields'] as $name => $data ) {

						// if only_for list isset and current index not in the list - skip this element
						if ( isset( $data['only_for'] ) && is_array( $data['only_for'] ) && ! in_array( $index, $data['only_for'] ) ) {
							continue;
						}

						// checked если поле присутствует в записи, если нет поля value в шаблоне
						// или если оно есть и равно значению поля в записи
						$checked = false;
						if ( isset( $field[$name] ) &&
							( ! isset( $data['value'] ) || 
							( isset( $data['value'] ) && $data['value'] == $field[$name] ) ) ) {
							$checked = true;
						}

						// get the title
						if ( isset( $data['class'] ) && 'of_fields_gen_title' == $data['class'] ) {
							$b_title = $field[$name];
						}

						$el_args = array(
							'name'          => sprintf('%s[%s][%d][%s]',
								$option_name,
								$value['id'],
								$index,
								$name
							),
							'description'   => isset($data['description']) ? $data['description'] : '',
							'class'         => isset($data['class']) ? $data['class'] : '',
							'value'         => ('checkbox' == $data['type']) ? '' : $field[$name],
							'checked'       => $checked
						);

						if ( 'select' == $data['type'] ) {
							$el_args['options'] = isset($data['options']) ? $data['options'] : array();
							$el_args['selected'] = $el_args['value'];
						}

						if( isset($data['desc_wrap']) ) {
							$el_args['desc_wrap'] = $data['desc_wrap'];
						}

						if( isset($data['wrap']) ) {
							$el_args['wrap'] = $data['wrap'];
						}

						if( isset($data['style']) ) {
							$el_args['style'] = $data['style'];
						}

						// create form elements
						$element = dt_create_tag( $data['type'], $el_args);

						$block .= $element;
					}
					unset($data);

					$output .= '<li class="nav-menus-php nav-menu-index-' . $index . '">';

					$output .= '<div class="of_fields_gen_title menu-item-handle" data-index="' . $index . '"><span class="dt-menu-item-title">' . esc_attr($b_title). '</span>';
					$output .= '<span class="item-controls"><a class="item-edit"></a></span></div>';
					$output .= '<div class="of_fields_gen_data menu-item-settings description" style="display: none;">' . $block;

					// if ( isset($value['std'][ $index ], $value['std'][ $index ]['permanent']) && $value['std'][ $index ]['permanent'] ) {
					// } else {
						$output .= $del_link;
					// }

					$output .= '</div>';
					$output .= '</li>';

					$i++;
				}
				unset($field);

			}

			$output .= '</ul>';

			// control panel
			$output .= '<div class="of_fields_gen_controls">';

			if ( ! empty( $value['options']['title'] ) ) {
				$output .= '<div class="name">' . esc_html( $value['options']['title'] ) . '</div>';
			}

			// use pattern
			foreach( $value['options']['fields'] as $name => $data ) {
				if( isset($data['only_for']) ) continue;

				$el_args = array(
					'name'          => sprintf('%s[%s][%s]',
						$option_name,
						$value['id'],
						$name
					),
					'description'   => isset($data['description']) ? $data['description'] : '',
					'class'         => isset($data['class']) ? $data['class'] : '',
					'checked'       => isset($data['checked']) ? $data['checked'] : false
				);

				if ( 'select' == $data['type'] ) {
					$el_args['options'] = isset($data['options']) ? $data['options'] : array();
					$el_args['selected'] = isset($data['selected']) ? $data['selected'] : false;
				}

				if( isset($data['desc_wrap']) ) {
					$el_args['desc_wrap'] = $data['desc_wrap'];
				}

				if( isset($data['wrap']) ) {
					$el_args['wrap'] = $data['wrap'];
				}

				if( isset($data['style']) ) {
					$el_args['style'] = $data['style'];
				}

				if( isset($data['value']) ) {
					$el_args['value'] = $data['value'];
				}

				// create form
				$element = dt_create_tag( $data['type'], $el_args);

				$output .= $element;
			}
			unset($data);

			// add button
			$button = dt_create_tag( 'button', array(
				'name'  => $option_name. '[' . $value['id'] . '][add]',
				'title' => isset($value['options']['button']['title'])?$value['options']['button']['title']:_x('Add', 'backend fields button', 'the7mk2'),
				'class' => 'of_fields_gen_add button-secondary'
			));

			$output .= $button;

			$output .= '</div>';

		break;

		// Social icons
		case 'social_icons':

			if ( !isset($value['options']) || !is_array($value['options']) ) {
				continue;
			}

			foreach( $value['options'] as $class=>$desc ) {
				$name = sprintf( '%s[%s][%s]', $option_name, $value['id'], $class );
				$link = isset($val[ $class ]) ? $val[ $class ] : '';

				$maxlength = isset( $value['maxlength'] )?' maxlength="' .$value['maxlength']. '"':'';
				$output .= '<label>' . esc_html( $desc ) . '<input class="of-input" name="' . esc_attr( $name ) . '" type="text" value="' . esc_url( $link ) . '"' .$maxlength. '/></label>';
			}

		break;

		// fields generator alpha
		case "fields_generator_alpha":
			
			if ( !empty($value['options']['interface_filter']) && function_exists($value['options']['interface_filter']) ) {
				add_filter('optionsframework_interface_fields_generator', $value['options']['interface_filter'], 10, 2);
			}

			$del_link = '<div class="submitbox"><a href="#" class="of_fields_gen_del submitdelete">'. _x('Delete', 'backend fields', 'the7mk2'). '</a></div>';
			
			$name = sprintf( '%s[%s]', $option_name, $value['id'] );


			$output .= '<ul class="of_fields_gen_list">';

			// saved elements
			if ( is_array( $val ) ) {
				$next_id = isset($val['next_id']) ? $val['next_id'] : max(array_keys($val));
				$output .= '<input id="of-wa-nextid" type="hidden" name="' . $name . '[next_id]" value="' . $next_id . '" />';

				$i = 0;
				// create elements
				foreach ( $val as $field_id=>$field_data ) {
				   

					$title = empty($field_data['title']) ? _x('no title', 'theme-options', 'the7mk2') : $field_data['title'];

					$output .= '<li class="nav-menus-php">';
					
					foreach ( $field_data as $f_name=>$f_val ) {

						$output .= sprintf('<input type="hidden" data-field="%1$s" class="of-wa-datafield" name="%2$s" value="%3$s" />',
							esc_attr( $f_name ),
							esc_attr( $name . "[$field_id][$f_name]" ),
							esc_attr( $f_val )
						);	
					}
					
					$output .= '<div class="of_fields_gen_title menu-item-handle" data-id="' . $field_id . '"><span class="dt-menu-item-title">' . esc_attr($title) . '</span>';
					$output .= '</li>';
					
					$i++;
				}
				unset($field);
				
			}
			
			
			$output .= '</ul>';
			
			// control panel
			$output .= '<div class="of_fields_gen_controls">';
			
			$output .= apply_filters('optionsframework_interface_fields_generator', '', $value);

			$output .= '</div>';
			
		break;
		
		// Social icons 
		case 'social_icon':

			if( !isset($value['options']['fields']) || !is_array($value['options']['fields']) ) {
				continue;
			}
			
			$w = $h = '20';
			if( !empty($value['options']['ico_width']) ) {
				$w = intval($value['options']['ico_width']);
			}
			if( !empty($value['options']['ico_height']) ) {
				$h = intval($value['options']['ico_height']);
			}
			$ico_size = sprintf( 'width: %dpx;height: %dpx;', $w, $h );

			foreach( $value['options']['fields'] as $field=>$ico ) {
				
				$defaults = array( 'img' => '', 'desc' => '' );
				$ico = wp_parse_args( (array)$ico, $defaults );
				extract( $ico );
			
				$name = sprintf( '%s[%s][%s]', $option_name, $value['id'], $field );
				$soc_link = isset( $val[ $field ], $val[ $field ]['link'] ) ? $val[ $field ]['link'] : '';
				$src = isset( $val[ $field ], $val[ $field ]['src'] ) ? $val[ $field ]['src'] : '';
				$maxlength = isset( $value['maxlength'] )?' maxlength="' .$value['maxlength']. '"':'';
				
				$output .= '<input class="of-input" name="' . esc_attr( $name .'[link]' ) . '" type="text" value="' . esc_attr( $soc_link ) . '"' .$maxlength. ' style="display: inline-block; width: 300px; vertical-align: middle;" />';

				$output .= '<div class="of-soc-image" style="background: url( ' . $img . ' ) no-repeat 0 0; vertical-align: middle; margin-right: 5px; display: inline-block;' . $ico_size . '"></div>';
			
			}

		break;

		// Slider
		case 'slider':

			$classes = array( 'of-slider' );

			if ( !empty( $value['options']['java_hide_if_not_max'] ) ) {
				$classes[] = 'of-js-hider';
				$classes[] = 'js-hide-if-not-max';
			} else if( !empty( $value['options']['java_hide_global_not_max'] ) ) {
				$classes[] = 'of-js-hider-global';
				$classes[] = 'js-hide-if-not-max';
			}
			$classes = implode( ' ', $classes );

			$output .= '<div class="' . $classes . '"></div>';

			$slider_opts = array(
				'max'   => isset( $value['options']['max'] ) ? intval( $value['options']['max'] ) : 100,
				'min'   => isset( $value['options']['min'] ) ? intval( $value['options']['min'] ) : 0,
				'step'  => isset( $value['options']['step'] ) ? intval( $value['options']['step'] ) : 1,
				'value' => isset( $val ) ? intval( $val ) : 100
			);
			$str = '';
			foreach( $slider_opts as $name=>$val ) {
				$str .= ' data-' . $name . '="' . esc_attr( $val ) . '"';
			}
			
			$output .= '<input type="text" class="of-slider-value"' . $str . ' name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" readonly />';

			break;

		// Hidden area begin
		case 'js_hide_begin':
			$class = 'of-js-hide';
			if ( ! isset( $value['hidden_by_default'] ) || $value['hidden_by_default'] ) {
				$class .= ' hide-if-js';
			}
			if ( !empty( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}
			$output .= '<div class="' . esc_attr($class) . '">';
			break;

		// Hidden area end
		case 'js_hide_end':
			$output .= '</div>';
			break;

		// Social buttons
		case 'social_buttons':
			$social_buttons = (array)apply_filters('optionsframework_interface-social_buttons', array());

			if ( empty($social_buttons) ) {
				$output .= '<p>Use "optionsframework_interface-social_buttons" filter to add some buttons.</p>';
				break;
			}

			$saved_buttons = isset($val) ? (array) $val : array();

			$output .= '<ul class="connectedSortable content-holder">';
			$output .='<li class="ui-dt-sb-hidden"><input type="hidden" name="' . esc_attr($option_name . '[' . $value['id'] . '][]') . '" value="" /></li>';
			foreach ( $saved_buttons as $field ) {
				$output .= '<li class="ui-state-default"><input type="hidden" name="' . esc_attr($option_name . '[' . $value['id'] . '][]') . '" value="' . esc_attr( $field ) . '" data-name="' . esc_attr($option_name . '[' . $value['id'] . '][]') . '"/>' . $social_buttons[ $field ] . '</li>';
			}

			$output .= '</ul>';
						
			$output .= '<ul class="connectedSortable tools-palette">';
			
			foreach ( $social_buttons as $v=>$desc ) {

				if ( in_array($v, $saved_buttons) ) continue;

				$output .= '<li class="ui-state-default"><input type="hidden" value="' . esc_attr( $v ) . '" data-name="' . esc_attr($option_name . '[' . $value['id'] . '][]') . '"/>' . $desc . '</li>';
			}

			$output .= '</ul>';
			
			break;

		// Web fonts
		case 'web_fonts':
			// Replace &amp; coz in db value sanitized with esc_attr().
			$val = str_replace( '&amp;', '&', $val );
			$id = esc_attr( $value['id'] );
			$data_attr = '';

			if ( isset( $value['fonts'] ) ) {
				$value['fonts'] = in_array( $value['fonts'], array( 'safe', 'web', 'all' ) ) ? $value['fonts'] : 'all';
				$data_attr .= ' data-fonts-group="' . esc_attr( $value['fonts'] ) . '"';

				$fonts = optionsframework_get_fonts_options( $value['fonts'] );

				if ( $val && isset( $fonts[ $val ] ) ) {
					$value['options'] = array( $val => $fonts[ $val ] );
				} else {
					reset( $fonts );
					$value['options'] = array( key( $fonts ) => current( $fonts ) );
				}
				unset( $fonts );
			}

			$output .= '<select class="of-input dt-web-fonts" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . $id . '"' . $data_attr . ' style="width: 100%;">';

			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				if ( $val != '' && $val == $key ) {
					$selected = ' selected="selected"'; 
				}
				$output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			}

			$output .= '</select>';

			$output .= '<div class="dt-web-fonts-preview"><span>Silence is a true friend who never betrays.</span><span class="spinner"></span></div>';

			break;

		case 'square_size':
			$id = esc_attr( $value['id'] );

			$output .= '<input type="text" class="of-input dt-square-size" name="' . esc_attr($option_name . '[' . $value['id'] . '][width]') . '" value="' . absint($val['width']) . '" />';
			$output .= '<span>&times;</span>';
			$output .= '<input type="text" class="of-input dt-square-size" name="' . esc_attr($option_name . '[' . $value['id'] . '][height]') . '" value="' . absint($val['height']) . '" />';

			break;

		// import/export theme options
		case 'import_export_options':
			$rows = '8';

			if ( isset( $value['settings']['rows'] ) ) {
				$custom_rows = $value['settings']['rows'];
				if ( is_numeric( $custom_rows ) ) {
					$rows = $custom_rows;
				}
			}

			$valid_settings = $settings;
			$fields_black_list = apply_filters( 'optionsframework_fields_black_list', array() );

			// do not export preserved settings
			foreach ( $fields_black_list as $black_setting ) {
				if ( array_key_exists($black_setting, $valid_settings) ) {
					unset( $valid_settings[ $black_setting ] );
				}
			}

			$val = base64_encode( serialize( $valid_settings ) );

			$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input of-import-export" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '" onclick="this.focus();this.select()">' . esc_textarea( $val ) . '</textarea>';
			break;

		case 'title':
			$output .= '<div class="of-title">';
				$output .= '<h4>' . esc_html( $value['name'] ) . '</h4>';
			$output .= '</div>';
			break;

		case 'divider':
			$output .= '<div class="divider"></div>';
			break;

		// Gradient
		case "gradient":
			$default_color = '';

			if ( isset($value['std'][0]) ) {
				if ( $val !=  $value['std'][0] )
					$default_color_1 = ' data-default-color="' .$value['std'][0] . '" ';
			}

			if ( isset($value['std'][1]) ) {
				if ( $val !=  $value['std'][1] )
					$default_color_2 = ' data-default-color="' .$value['std'][1] . '" ';
			}

			$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][0]' ) . '" id="' . esc_attr( $value['id'] ) . '-0" class="of-color"  type="text" value="' . esc_attr( $val[0] ) . '"' . $default_color_1 .' />';

			$output .= '&nbsp;';

			$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][1]' ) . '" id="' . esc_attr( $value['id'] ) . '-1" class="of-color"  type="text" value="' . esc_attr( $val[1] ) . '"' . $default_color_2 .' />';

			break;

		// sortable
		case 'sortable':

			if ( !empty($value['items']) ) {
				$sortable_items = $value['items'];
			} else {
				$output .= '<p>No items specified. It needs array( id1 => name1, id2 => name2 ).</p>';
				break;
			}

			$saved_items = isset($val) ? (array) $val : array();
			$config_icon = '<span class="sortConfigIcon of-icon-edit"></span>';

			if ( !empty( $value['fields'] ) && is_array($value['fields']) ) {

				$fields_count = 0;

				$output .= '<div class="sortable-fields-holder">';

					foreach ( $value['fields'] as $field_id=>$field_settings ) {

						// classes
						$field_classes = 'connectedSortable content-holder';
						if ( !empty( $field_settings['class'] ) ) {
							$field_classes .= ' ' . $field_settings['class'];
						}

						// items name
						$item_name = esc_attr( sprintf( '%1$s[%2$s][%3$s][]', $option_name, $value['id'], $field_id ) );

						// saved items
						$saved_field_items = array_key_exists($field_id, $saved_items) ? $saved_items[ $field_id ] : array();

						// field title
						if ( !empty($field_settings['title']) ) {
							$output .= '<div class="sortable-field-title">' . ++$fields_count . '. ' . esc_html($field_settings['title']) . '</div>'; 
						}

						$output .= '<div class="sortable-field">';

						// output fields
						$output .= '<ul class="' . esc_attr( $field_classes ) . '" data-sortable-item-name="' . $item_name . '">';

							$output .='<li class="ui-dt-sb-hidden"><input type="hidden" name="' . $item_name . '" value="" /></li>';
							
							if ( !empty($saved_field_items) && is_array( $saved_field_items ) ) {
								
								foreach ( $saved_field_items as $item_value ) {

									if ( ! array_key_exists( $item_value, $sortable_items ) ) {
										continue;
									}

									$item_settings = $sortable_items[ $item_value ];
									$item_title = empty($item_settings['title']) ? 'undefined' : esc_html( $item_settings['title'] );
									$item_class = empty($item_settings['class']) ? '' : ' ' . esc_attr( $item_settings['class'] );

									$output .= '<li class="ui-state-default' . $item_class . '"><input type="hidden" name="' . $item_name . '" value="' . esc_attr( $item_value ) . '" /><span>' . $item_title . '</span>' . $config_icon . '</li>';

									// remove item from palette list
									unset( $sortable_items[ $item_value ] );

								}
							}

						$output .= '</ul>';

						$output .= '</div>';

					}

				$output .= '</div>';

			}

			$output .= '<div class="sortable-items-holder">';

				// palette title
				if ( !empty($value['palette_title']) ) {
					$output .= '<div class="sortable-palette-title">' . esc_html($value['palette_title']) . '</div>'; 
				}

				$output .= '<ul class="connectedSortable tools-palette">';
				
					foreach ( $sortable_items as $item_value=>$item_settings ) {

						$item_title = empty($item_settings['title']) ? 'undefined' : esc_html( $item_settings['title'] );
						$item_class = empty($item_settings['class']) ? '' : ' ' . esc_attr( $item_settings['class'] );

						$output .= '<li class="ui-state-default' . $item_class . '"><input type="hidden" value="' . esc_attr( $item_value ) . '" /><span>' . $item_title . '</span>' . $config_icon . '</li>';
					}

				$output .= '</ul>';

			$output .= '</div>';

			break;

		// Select Box
		case 'pages_list':
			$html = wp_dropdown_pages( array(
				'name' => esc_attr( $option_name . '[' . $value['id'] . ']' ),
				'id' => esc_attr( $value['id'] ),
				'echo' => 0,
				'show_option_none' => __( '&mdash; Select &mdash;', 'the7mk2' ),
				'option_none_value' => '0',
				'selected' => $val,
				'post_status' => 'publish,private,draft'
			) );

			$html = str_replace( '<select', '<select class="of-input"', $html );

			$output .= $html;
			break;

		}

		if ( !in_array( $value['type'], $elements_without_wrap ) ) {

			if ( ! in_array( $value['type'], array( "checkbox", "radio" ) ) ) {
				$output .= '<br/>';
			}

			$output .= '</div>';

			$output .= '<div class="clear"></div>';

			/**
			 * Debug message.
			 */
			if ( $optionsframework_debug ) {
				$output .= '<div class="debug">';

				// ID.
				$output .= '<div class="of-debug-field of-debug-option-id">ID: <code>' . esc_html( $value['id'] ) . '</code></div>';

				// STD.
				$debug_std = null;
				if ( isset( $value['std'] ) && ! is_array( $value['std'] ) ) {
					$debug_std = $value['std'];
				} else if ( isset( $value['std'] ) && 'gradient' === $value['type'] ) {
					$debug_std = implode( ', ', $value['std'] );
				}

				if ( null !== $debug_std ) {
					$output .= '<div class="of-debug-field of-debug-option-std">STD: <code>' . esc_html( $debug_std ) . '</code></div>';
				}

				// EXPORT.
				if ( in_array( $value['id'], $do_not_export ) ) {
					$output .= '<div class="of-debug-field of-debug-option-exportable">EXPORTABLE: <code>no</code></div>';
				}

				// PRESERVE.
				if ( in_array( $value['id'], $preserved_options ) ) {
					$output .= '<div class="of-debug-field of-debug-option-preserved">PRESERVED: <code>yes</code></div>';
				}

				$output .= '</div>';
			}

			$output .= '</div>';

			if ( isset( $value['divider'] ) && in_array( $value['divider'], array( 'bottom', 'surround' ) ) ) {
				$output .= '<div class="divider"></div><!-- divider -->' . "\n";
			}

			$output .= '</div>';
		}

		if ( !empty($value['after']) ) {
			$output .= $value['after'];
		}

		do_action( 'options-interface-before-output', $output, $value, $val );

		echo apply_filters( 'options-interface-output', $output, $value, $val );
	}

	if ( $in_block ) {
		echo '</div>'."\n".'<!-- block_end -->';
	}

	echo '</div>';
}

function optionsframework_get_fonts_options( $group = 'all' ) {
	switch ( $group ) {
		case 'safe':
			return presscore_options_get_safe_fonts();
		case 'web':
			return presscore_options_get_web_fonts();
		case 'all':
		default:
			return presscore_options_get_all_fonts();
	}
}

function optionsframework_fonts_ajax_response() {
	if ( ! check_ajax_referer( 'options-framework-ajax-fonts-nonce', false, false ) || ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error();
	}

	$fonts = optionsframework_get_fonts_options( isset( $_POST['fontsGroup'] ) ? $_POST['fontsGroup'] : '' );
	$html = '';
	foreach ( $fonts as $key => $option ) {
		$html .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
	}
	wp_send_json_success( $html );
}
add_action( 'wp_ajax_of_get_fonts', 'optionsframework_fonts_ajax_response' );

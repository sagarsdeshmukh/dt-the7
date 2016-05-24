<?php
/**
 * Portfolio widget.
 *
 * @package presscore.
 * @since presscore 1.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Inc_Widgets_Portfolio extends WP_Widget {

	/* Widget defaults */
	public static $widget_defaults = array( 
		'title'         => '',
		'order'     	=> 'DESC',
		'orderby'   	=> 'date',
		'select'        => 'all',
		'show'          => 6,
		'max_width'		=> 77,
		'cats'          => array(),
	);

	/* Widget setup  */
	function __construct() {  
		/* Widget settings. */
		$widget_ops = array( 'description' => _x( 'Portfolio projects', 'widget', 'the7mk2' ) );

		/* Create the widget. */
		parent::__construct(
			'presscore-portfolio',
			DT_WIDGET_PREFIX . _x( 'Portfolio projects', 'widget', 'the7mk2' ),
			$widget_ops
		);
	}

	/* Display the widget  */
	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		/* Our variables from the widget settings. */
		$title = apply_filters( 'widget_title', $instance['title'] );

		$args = array(
			'no_found_rows'     => 1,
			'posts_per_page'    => $instance['show'],
			'post_type'         => 'dt_portfolio',
			'post_status'       => 'publish',
			'orderby'           => $instance['orderby'],
			'order'             => $instance['order'],
			'tax_query'         => array( array(
				'taxonomy'      => 'dt_portfolio_category',
				'field'         => 'term_id',
				'terms'         => $instance['cats']
			) ),
		);

		switch( $instance['select'] ) {
			case 'only': $args['tax_query'][0]['operator'] = 'IN'; break;
			case 'except': $args['tax_query'][0]['operator'] = 'NOT IN'; break;
			default: unset( $args['tax_query'] );
		}

		$p_query = new WP_Query( $args ); 

		// for usage as shortcode 
		if ( ! isset( $img_size ) ) {

			$img_size = array( $instance['max_width'], $instance['max_width'] );
		}

		if ( ! isset( $img_size_origin ) ) {

			$img_size_origin = $img_size;
		} else {

			$p = $img_size[1] / $img_size[0];
			$img_size_origin[1] = round( $img_size_origin[0] * $p ); 
		}

		echo $before_widget ;

		// title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if ( $p_query->have_posts() ) {

			echo '<div class="instagram-photos" data-image-max-width="' . absint( $instance['max_width'] ) . '">';

			while( $p_query->have_posts() ) { $p_query->the_post();

				$thumb_id = get_post_thumbnail_id( get_the_ID() );

				if ( ! has_post_thumbnail( get_the_ID() ) ) {

					$args = array(
						'posts_per_page'    => 1,
						'no_found_rows'     => 1,
						'post_type'         => 'attachment',
						'post_mime_type'    => 'image',
						'post_parent'       => get_the_ID(),
						'post_status'       => 'inherit'
					);
					$images = new WP_Query( $args );

					if ( $images->have_posts() ) {
						$thumb_id = $images->posts[0]->ID;
					}
				}

				$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );

				dt_get_thumb_img( array(
					'img_meta'      => $thumb_meta ? $thumb_meta : null,
					'img_id'		=> $thumb_id,
					'use_noimage'   => true,
					'class'			=> 'post-rollover',
					'title'         => get_the_title(),
					'href'          => get_permalink(),
					'options'       => array( 'w' => $img_size_origin[0], 'h' => $img_size_origin[1] ),
					'wrap'          => "\n" . '<a %HREF% %TITLE% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% ' . image_hwstring( $img_size[0], $img_size[1] ) . ' %ALT% /></a>' . "\n",
				) );

			} // while have posts
			wp_reset_postdata();

			echo '</div>';

		} // if have posts

		echo $after_widget;
	}

	/* Update the widget settings  */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['order'] = apply_filters('dt_sanitize_order', $new_instance['order'] );
		$instance['orderby'] = apply_filters('dt_sanitize_orderby', $new_instance['orderby'] );
		$instance['select'] = in_array( $new_instance['select'], array('all', 'only', 'except') ) ? $new_instance['select'] : 'all';
		$instance['show'] = absint($new_instance['show']);
		$instance['cats'] = (array) $new_instance['cats'];
		$instance['max_width'] = absint( $new_instance['max_width'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$terms = get_terms( 'dt_portfolio_category', array(
			'hide_empty'    => 1,
			'hierarchical'  => false 
		) );

		$orderby_list = array(
			'ID'        => _x( 'Order by ID', 'widget', 'the7mk2' ),
			'author'    => _x( 'Order by author', 'widget', 'the7mk2' ),
			'title'     => _x( 'Order by title', 'widget', 'the7mk2' ),
			'date'      => _x( 'Order by date', 'widget', 'the7mk2' ),
			'modified'  => _x( 'Order by modified', 'widget', 'the7mk2' ),
			'rand'      => _x( 'Order by rand', 'widget', 'the7mk2' ),
			'menu_order'=> _x( 'Order by menu', 'widget', 'the7mk2' )
		);

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex('Title:', 'widget',  'the7mk2'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<strong><?php _ex('Category:', 'widget', 'the7mk2'); ?></strong><br />
			<?php if( !is_wp_error($terms) ): ?>

				<div class="dt-widget-switcher">

					<label><input type="radio" name="<?php echo $this->get_field_name( 'select' ); ?>" value="all" <?php checked($instance['select'], 'all'); ?> /><?php _ex('All', 'widget', 'the7mk2'); ?></label>
					<label><input type="radio" name="<?php echo $this->get_field_name( 'select' ); ?>" value="only" <?php checked($instance['select'], 'only'); ?> /><?php _ex('Only', 'widget', 'the7mk2'); ?></label>
					<label><input type="radio" name="<?php echo $this->get_field_name( 'select' ); ?>" value="except" <?php checked($instance['select'], 'except'); ?> /><?php _ex('Except', 'widget', 'the7mk2'); ?></label>

				</div>

				<div class="hide-if-js">

					<?php foreach( $terms as $term ): ?>

					<input id="<?php echo $this->get_field_id($term->term_id); ?>" type="checkbox" name="<?php echo $this->get_field_name('cats'); ?>[]" value="<?php echo $term->term_id; ?>" <?php checked( in_array($term->term_id, $instance['cats']) ); ?> />
					<label for="<?php echo $this->get_field_id($term->term_id); ?>"><?php echo $term->name; ?></label><br />

					<?php endforeach; ?>

				</div>

			<?php endif; ?>

		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'max_width' ); ?>"><?php _ex('Image max width (px):', 'widget', 'the7mk2'); ?></label>
			<input id="<?php echo $this->get_field_id( 'max_width' ); ?>" name="<?php echo $this->get_field_name( 'max_width' ); ?>" value="<?php echo esc_attr($instance['max_width']); ?>" size="3" maxlength="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php _ex('Number of posts:', 'widget', 'the7mk2'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo esc_attr($instance['show']); ?>" size="2" maxlength="2" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _ex('Sort by:', 'widget', 'the7mk2'); ?></label>
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<?php foreach( $orderby_list as $value=>$name ): ?>
				<option value="<?php echo $value; ?>" <?php selected( $instance['orderby'], $value ); ?>><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		</p>
			<label>
			<input name="<?php echo $this->get_field_name( 'order' ); ?>" value="ASC" type="radio" <?php checked( $instance['order'], 'ASC' ); ?> /><?php _ex('Ascending', 'widget', 'the7mk2'); ?>
			</label>
			<label>
			<input name="<?php echo $this->get_field_name( 'order' ); ?>" value="DESC" type="radio" <?php checked( $instance['order'], 'DESC' ); ?> /><?php _ex('Descending', 'widget', 'the7mk2'); ?>
			</label>
		</p>

		<div style="clear: both;"></div>
	<?php
	}
}

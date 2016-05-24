<?php
class Presscore_Posts_Slider_Scroller {

	protected $post_backup = null;
	protected $config_backup = null;
	protected $query = null;
	protected $args = array();

	public function setup( $query, $args = array() ) {
		$defaults = array(
			'class' => '',
			'padding' => '0',
			'autoslide' => false,
			'loop' => false,
			'arrows' => true
		);

		$this->args = wp_parse_args( $args, $defaults );
		$this->query = $query;
	}

	public function render_html() {
		echo $this->get_html();
	}

	public function get_html() {

		$this->backup_post_object();
		$this->backup_theme_config();
		$this->setup_config();
		$this->add_hooks();

		ob_start();

		// loop
		while( $this->query->have_posts() ) { $this->query->the_post();
			echo '<li class="fs-entry">';
			$this->render_slide();
			echo '</li>';
		}

		// store loop html
		$posts_html = ob_get_contents();
		ob_end_clean();

		// shape output
		$output = '<div ' . $this->get_container_html_class() . ' ' . $this->get_container_data_atts() . '>';
		$output .= '<div class="frame fullwidth-slider"><ul class="clearfix">' . $posts_html . '</ul></div>';
		if ( $this->args['arrows'] ) {
			$output .= '<div class="prev"><i></i></div><div class="next"><i></i></div>';
		}
		$output .= '</div>';

		$this->remove_hooks();
		$this->restore_theme_config();
		$this->restore_post_object();

		return $output;
	}

	public function set_image_dimensions( $args ) {
		$args['options'] = array( 'w' => $this->args['width'], 'h' => $this->args['height'] );
		$args['prop'] = false;
		return $args;
	}

	protected function get_container_html_class( $class = array() ) {
		switch ( $this->args['arrows'] ) {
			case 'light':
				$class[] = 'arrows-light';
				break;
			case 'dark':
				$class[] = 'arrows-dark';
				break;
			case 'accent':
				$class[] = 'arrows-accent';
				break;
		}

		$class[] = $this->args['class'];

		$html_class = presscore_masonry_container_class( $class );
		$html_class = str_replace( array( ' iso-grid', 'iso-grid ', ' loading-effect-fade-in', 'loading-effect-fade-in ' ), '', $html_class );

		return $html_class;
	}

	protected function get_container_data_atts() {
		return presscore_get_inlide_data_attr( array(
			'padding-side' => $this->args['padding'],
			'autoslide' => $this->args['autoslide'] ? 'true' : 'false',
			'delay' => $this->args['autoslide'],
			'loop' => $this->args['loop'] ? 'true' : 'false'
		) );
	}

	protected function add_hooks() {
	}

	protected function remove_hooks() {
	}

	protected function backup_post_object() {
		global $post;
		$this->post_backup = $post;
	}

	protected function restore_post_object() {
		global $post;
		$post = $this->post_backup;
		setup_postdata( $post );
		unset( $this->post_backup );
	}

	protected function backup_theme_config() {
		$this->config_backup = presscore_get_config()->get();
	}

	protected function restore_theme_config() {
		presscore_get_config()->reset( $this->config_backup );
		unset( $this->config_backup );
	}

	protected function setup_config() {}

	protected function render_slide() {}

}

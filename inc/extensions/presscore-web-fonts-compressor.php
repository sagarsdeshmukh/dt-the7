<?php
interface Presscore_Web_Font_Interface {
	public function get_family();
	public function get_subset();
	public function get_weight();
	public function get_style();
}

class Presscore_Web_Font implements Presscore_Web_Font_Interface {
	protected $family = '';
	protected $subset = '';
	protected $weight = '';
	protected $style = '';

	public function __construct( $font = '' ) {

		// get font subset
		$font_parts = explode( '&', $font );
		if ( ! empty( $font_parts[1] ) ) {
			$this->subset = str_replace( 'subset=' , '', $font_parts[1] );
		}

		// get font style and weight
		$font_parts = explode(':', $font_parts[0]);
		if ( isset( $font_parts[1] ) ) {
			$font_style = explode( 'italic', $font_parts[1] );

			if ( isset( $font_style[1] ) ) {
				$this->style = 'italic';
			}

			$this->weight = $font_style[0];
		}

		// get font family
		if ( '' != $font_parts[0] ) {
			$this->family = $font_parts[0];
		}
	}

	public function get_family() {
		return $this->family;
	}

	public function get_subset() {
		return $this->subset;
	}

	public function get_weight() {
		return $this->weight;
	}

	public function get_style() {
		return $this->style;
	}
}

if ( ! class_exists( 'Presscore_Web_Fonts_Compressor', false ) ) {

	class Presscore_Web_Fonts_Compressor {

		public function compress_fonts( $fonts ) {
			if ( ! is_array( $fonts ) || empty( $fonts ) ) {
				return '';
			}

			$fonts_obj_list = array();
			foreach ( $fonts as $font ) {
				$fonts_obj_list[] = new Presscore_Web_Font( $font );
			}

			$compressed_fonts = $this->compress( $fonts_obj_list );

			return $this->construct_string( $compressed_fonts );
		}

		protected function construct_string( array $compressed_fonts ) {
			$composed_string_parts = array();
			$subsets = array();

			foreach ( $compressed_fonts as $font_family=>$font_data ) {
				$composed_font = str_replace( ' ', '+', $font_family );

				if ( ! empty( $font_data['weight'] ) ) {

					if ( ! in_array( '400', $font_data['weight'] ) ) {
						$font_data['weight'][] = '400';
					}

					sort( $font_data['weight'] );
					$composed_font .= ':' . implode( ',', $font_data['weight'] );
				}

				if ( ! empty( $font_data['subset'] ) ) {
					$subsets = array_merge( $subsets, $font_data['subset'] );
				}

				$composed_string_parts[] = $composed_font;
			}

			$composed_string = implode( '|', $composed_string_parts );

			$subsets = array_unique( $subsets );
			if ( ! empty( $subsets ) ) {

				if ( ! in_array( 'latin', $subsets ) ) {
					$subsets[] = 'latin';
				}

				$composed_string .= '&subset=' . implode( ',', $subsets );
			}

			return $composed_string;
		}

		protected function compress( array $fonts ) {

			$compressed_fonts = array();

			foreach ( $fonts as $font ) {

				$family = $font->get_family();

				if ( ! $family ) {
					continue;
				}

				// new font family
				if ( ! array_key_exists( $family, $compressed_fonts ) ) {
					$compressed_fonts[ $family ] = array();
				}

				// weight
				$weight = $font->get_weight() . $font->get_style();
				if ( $weight && ! array_key_exists( 'weight', $compressed_fonts[ $family ] ) ) {
					$compressed_fonts[ $family ]['weight'] = array( $weight );
				} else if ( $weight && ! in_array( $weight, $compressed_fonts[ $family ]['weight'] ) ) {
					$compressed_fonts[ $family ]['weight'][] = $weight;
				}

				// subset
				$subset = $font->get_subset();
				if ( $subset && ! array_key_exists( 'subset', $compressed_fonts[ $family ] ) ) {
					$compressed_fonts[ $family ]['subset'] = array( $subset );
				} else if ( $subset && ! in_array( $subset, $compressed_fonts[ $family ]['subset'] ) ) {
					$compressed_fonts[ $family ]['subset'][] = $subset;
				}

			}

			return $compressed_fonts;
		}

	}

}

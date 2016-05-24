<?php
/**
 * Admin icons bar view.
 *
 * @package the7
 * @since 3.0.0 
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

	<div class="presscore-modal-header">
		<div class="presscore-inline presscore-modal-title">
			<span><?php _ex( 'Icons', 'admin icons bar', 'the7mk2' ); ?></span>
		</div>
		<div class="presscore-inline presscore-modal-search">
			<input type="text" id="presscore-icon-search" value="" placeholder="<?php echo esc_attr( _x( 'search', 'admin icons bar', 'the7mk2' ) ); ?>" />
		</div>
	</div>
	<div class="presscore-modal-content presscore-icon-selection">
		<ul class="presscore-icons">

		<?php
			if ( class_exists( 'Presscore_Modules_AdminIconsBarModule', false ) ) {
				$json_file = Presscore_Modules_AdminIconsBarModule::get_json_file_content();

				if ( $json_file ) {
					$icon_prefix = $json_file->css_prefix_text;

					$format = '<li class="%1$s"><h5>%1$s</h5><input type="text" class="presscore-icon-code" readonly value="%2$s"/></span></li>';
					foreach ( $json_file->glyphs as $icon_name ) {
						$icon_class = $icon_prefix . $icon_name->css;
						echo sprintf( $format, esc_attr( $icon_class ), esc_attr( '<i class="fa ' . $icon_class . '"></i>' ) );
					}
				}
			}
		?>

		</ul>
	</div>
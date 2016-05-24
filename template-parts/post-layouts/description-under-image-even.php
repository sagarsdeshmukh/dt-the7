<?php
/**
 * Description under image even post template.
 *
 * @package the7\Core\Templates
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// content parts
$image = isset( $image ) ? $image : '';
$content = isset( $content ) ? $content : '';
$rollover_content = isset( $rollover_content ) ? $rollover_content : '';

// attributes
$media_wrap_atts = isset( $media_wrap_atts ) ? $media_wrap_atts : '';
$content_wrap_atts = isset( $content_wrap_atts ) ? $content_wrap_atts : '';

// classes
$media_wrap_class = isset( $media_wrap_class ) ? $media_wrap_class : '';
$content_wrap_class = isset( $content_wrap_class ) ? $content_wrap_class : '';
$figure_class = isset( $figure_class ) ? ' ' . trim( $figure_class ) : '';
?>
<div class="project-list-content<?php echo esc_attr( $content_wrap_class ); ?>"<?php echo $content_wrap_atts; ?>>
	<?php echo $content; ?>
</div>
<div class="project-list-media<?php echo esc_attr( $media_wrap_class ); ?>"<?php echo $media_wrap_atts; ?>>
	<figure class="buttons-on-img<?php echo esc_attr( $figure_class ); ?>">
		<?php echo $image; ?>
		<?php if ( $rollover_content ): ?>
		<figcaption class="rollover-content">
			<?php echo $rollover_content; ?>
		</figcaption>
		<?php endif; ?>
	</figure>
</div>
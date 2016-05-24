<?php
/**
 * Description on image post template.
 *
 * @package the7\Core\Templates
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// content parts
$image = isset( $image ) ? $image : '';
$before_content = isset( $before_content ) ? $before_content : '';
$after_content = isset( $after_content ) ? $after_content : '';
$content = isset( $content ) ? $content : '';

// classes
$figure_class = isset( $figure_class ) ? ' ' . trim( $figure_class ) : '';
?>
<figure class="rollover-project<?php echo esc_attr( $figure_class ); ?>">
	<?php echo $image; ?>
	<?php if ( $before_content || $after_content || $content ): ?>
	<figcaption class="rollover-content">
		<?php echo $before_content; ?>
		<?php if ( $content ): ?>
		<div class="rollover-content-container">
			<?php echo $content; ?>
		</div>
		<?php endif; ?>
		<?php echo $after_content; ?>
	</figcaption>
	<?php endif; ?>
</figure>
<?php
/**
 * Blog standard post format content part
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

?>
	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h3>

	<?php
	if ( presscore_get_config()->get( 'show_excerpts' ) ) {
		presscore_the_excerpt();
	}
	?>
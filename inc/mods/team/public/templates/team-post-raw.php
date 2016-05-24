<?php
/**
 * Team post
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

	<div <?php post_class( 'team-container' ); ?>>

		<?php include plugin_dir_path( __FILE__ ) . 'team-post-media.php'; ?>

		<div class="team-desc">

			<?php include plugin_dir_path( __FILE__ ) . 'team-post-content.php'; ?>

		</div>
	</div>
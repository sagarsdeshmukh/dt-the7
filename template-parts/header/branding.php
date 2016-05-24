<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
				<div class="branding">

					<?php
					$logo = '';
					$logo .= presscore_get_the_main_logo();

					// Do not display mobile logo on mixed headers
					if ( ! presscore_header_layout_is_mixed() ) {
						$logo .= presscore_get_the_mobile_logo();
					}

					presscore_display_the_logo( $logo );
					unset( $logo );
					?>

					<div id="site-title" class="assistive-text"><?php bloginfo( 'name' ); ?></div>
					<div id="site-description" class="assistive-text"><?php bloginfo( 'description' ); ?></div>

					<?php presscore_render_header_elements( 'near_logo_left' ); ?>

					<?php presscore_render_header_elements( 'near_logo_right' ); ?>

				</div>
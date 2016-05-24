<?php
/**
 * Mobile header.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class='dt-close-mobile-menu-icon'><span></span></div>
<div class='dt-mobile-header'>
	<ul class="mobile-main-nav" role="menu">
		<?php
		if ( ! isset( $location ) ) {
			$location = ( presscore_has_mobile_menu() ? 'mobile' : 'primary' );
		}

		presscore_primary_nav_menu( $location );
		?>
	</ul>
	<div class='mobile-mini-widgets-in-menu'></div>
</div>
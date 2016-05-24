<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the <div class="wf-container wf-clearfix"> and all content after
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( presscore_is_content_visible() ): ?>

			</div><!-- .wf-container -->
		</div><!-- .wf-wrap -->
	</div><!-- #main -->

	<?php
	if ( presscore_config()->get( 'template.footer.background.slideout_mode' ) ) {
		echo '</div>';
	}

	do_action( 'presscore_after_main_container' );
	?>

<?php endif; // presscore_is_content_visible ?>

	<a href="#" class="scroll-top"></a>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
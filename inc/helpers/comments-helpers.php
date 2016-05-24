<?php

if ( ! function_exists( 'presscore_comments_will_be_displayed' ) ) :

	/**
	 * Check if comments will be displayed for this post.
	 *
	 * Return true if post not passwod protected or comments opened or even though one comment exisis.
	 *
	 * @return boolean;
	 */
	function presscore_comments_will_be_displayed() {
		return !( post_password_required() || ( !comments_open() && '0' == get_comments_number() ) );
	}

endif;

if ( ! function_exists( 'presscore_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since 1.0.0
	 */
	function presscore_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="pingback">
			<div class="pingback-content">
				<span><?php _e( 'Pingback:', 'the7mk2' ); ?></span>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __( '(Edit)', 'the7mk2' ), ' ' ); ?>
			</div>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<article id="div-comment-<?php comment_ID(); ?>">

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->

			<div class="comment-meta">
				<time datetime="<?php comment_time( 'c' ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					// TODO: add date/time format (for qTranslate)
					printf( __( '%1$s at %2$s', 'the7mk2' ), get_comment_date(), get_comment_time() ); ?>
				</time>
				<?php edit_comment_link( __( '(Edit)', 'the7mk2' ), ' ' ); ?>
			</div><!-- .comment-meta -->

			<div class="comment-author vcard">
				<?php
				if ( dt_validate_gravatar( $comment->comment_author_email ) ) {
					$avatar = get_avatar( $comment, 60 );
				} else {
					$avatar = '<span class="avatar no-avatar"></span>';
				}

				$author_url = get_comment_author_url();
				if ( empty( $author_url ) || 'http://' == $author_url ) {
					echo $avatar;
				} else {
					echo '<a href="' . $author_url . '" rel="external nofollow" class="rollover" target="_blank">' . $avatar . '</a>';
				}

				printf( '<cite class="fn">%s</cite>', str_replace( 'href', 'target="_blank" href', get_comment_author_link() ) );
				?>
			</div><!-- .comment-author .vcard -->

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'the7mk2' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-content"><?php comment_text(); ?></div>

			</article>

		<?php
				break;
		endswitch;
	}

endif;

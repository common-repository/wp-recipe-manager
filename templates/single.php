<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package    masterchef
 * @since      MasterChef 0.1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the single post content template.
				wprm_get_template_part( 'content-single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				if ( is_singular( 'recipe' ) ) {
					// Previous/next post navigation.
					the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'wp-recipe-manager' ) . '</span> ' .
						               '<span class="screen-reader-text">' . __( 'Next post:', 'wp-recipe-manager' ) . '</span> ' .
						               '<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'wp-recipe-manager' ) . '</span> ' .
						               '<span class="screen-reader-text">' . __( 'Previous post:', 'wp-recipe-manager' ) . '</span> ' .
						               '<span class="post-title">%title</span>',
					) );
				}

				// End of the loop.
			endwhile;
			?>

		</main><!-- .site-main -->

	</div><!-- .content-area -->
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>

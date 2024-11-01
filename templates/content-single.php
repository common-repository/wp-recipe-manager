<?php
/**
 * The template part for displaying single posts
 *
 * @package    WP Recipe Manager
 * @since      0.1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->
	<?php endif; // End has_post_thumbnail() ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<div class="meta-left">
				<?php
				echo wprm_entry_author();
				?>
			</div>
			<div class="meta-right">
				<?php
				echo wprm_entry_categories();
				?>
			</div>
		</div>
	</header><!-- .entry-header -->

	<?php echo wprm_entry_info(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		echo wprm_entry_instructions();
		echo wprm_entry_notes();
		?>
	</div><!-- .entry-content -->

	<div class="entry-ingredients">
		<?php echo wprm_entry_ingredients(); ?>
	</div><!-- .entry-ingredients -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php
			wprm_entry_tags();
			wprm_entry_cuisines();
			?>
		</div>
		<?php
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'wp-recipe-manager' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

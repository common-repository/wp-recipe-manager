<?php

/**
 * Prevent loading this file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get recipe details
 *
 * @param $id
 *
 * @return array
 */
function wprm_get_details( $id = 0 ) {
	if ( ! $id ) {
		global $post;
		$id = isset ( $post->ID ) ? $post->ID : 0;
	}
	$prefix = 'wprm_';

	$details                 = array();
	$details['prep_time']    = tmu_meta( $prefix . 'prep_time', true );
	$details['cook_time']    = tmu_meta( $prefix . 'cook_time', true );
	$details['servings']     = tmu_meta( $prefix . 'servings', true );
	$details['calories']     = tmu_meta( $prefix . 'calories', true );
	$details['ingredients']  = tmu_meta( $prefix . 'ingredients', true );
	$details['instructions'] = tmu_meta( $prefix . 'instructions', true );
	$details['level']        = tmu_meta( $prefix . 'level', true );
	$details['notes']        = tmu_meta( $prefix . 'notes', true );

	return $details;
}


function wprm_time( $time ) {
	$display_time = '';
	if ( ! $time ) {
		return esc_html__( 'Unknown', 'wp-recipe-manager' );
	}
	$hours   = floor( $time / 60 );
	$minutes = $time - $hours * 60;
	if ( $hours ) {
		$display_time .= $hours . ( $hours == 1 ? esc_html__( ' hour', 'wp-recipe-manager' ) : esc_html__( ' hours', 'wp-recipe-manager' ) );
	}
	if ( $minutes ) {
		$display_time .= $minutes . ( $minutes == 1 ? esc_html__( ' minute', 'wp-recipe-manager' ) : esc_html__( ' minutes', 'wp-recipe-manager' ) );
	}

	return $display_time;
}


function wprm_entry_info() {
	$meta = wprm_get_details();
	?>
	<div class="recipe-meta">
		<?php if ( isset( $meta['prep_time'] ) ) : ?>
			<div class="meta-item prep-time">
				<div class="icon"></div>
				<div class="info">
					<label for=""><?php esc_html_e( 'Prep Time', 'wp-recipe-manager' ); ?></label>
					<p><?php echo wprm_time( $meta['prep_time'] ); ?></p>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( isset( $meta['cook_time'] ) ) : ?>
			<div class="meta-item cook-time">
				<div class="icon"></div>
				<div class="info">
					<label for=""><?php esc_html_e( 'Cook Time', 'wp-recipe-manager' ); ?></label>
					<p><?php echo wprm_time( $meta['cook_time'] ); ?></p>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( isset( $meta['servings'] ) ) : ?>
			<div class="meta-item servings">
				<div class="icon"></div>
				<div class="info">
					<label for=""><?php esc_html_e( 'Servings', 'wp-recipe-manager' ); ?></label>
					<p><?php echo esc_html( $meta['servings'] ); ?><?php esc_html_e( ' peoples', 'wp-recipe-manager' ); ?></p>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( isset( $meta['calories'] ) ) : ?>
			<div class="meta-item calories">
				<div class="icon"></div>
				<div class="info">
					<label for=""><?php esc_html_e( 'Calories', 'wp-recipe-manager' ); ?></label>
					<p><?php echo esc_html( $meta['calories'] ); ?><?php esc_html_e( ' kcal', 'wp-recipe-manager' ); ?></p>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( isset( $meta['level'] ) ) : ?>
			<div class="meta-item level">
				<div class="icon"></div>
				<div class="info">
					<label for=""><?php esc_html_e( 'Skill Level', 'wp-recipe-manager' ); ?></label>
					<p><?php echo esc_html( $meta['level'] ); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

function wprm_entry_ingredients() { ?>
	<div class="recipe-ingredients">
		<h3 class="like-heading"><?php esc_html_e( 'Ingredients', 'wp-recipe-manager' ); ?></h3>
		<ul>
			<?php
			$meta = wprm_get_details();
			if ( isset( $meta['ingredients'] ) ) {
				foreach ( $meta['ingredients'] as $ingredient ) {
					echo '<li title="' . esc_attr__( 'Mark Complete', 'wp-recipe-manager' ) . '">' . $ingredient['ingredient'] . '</li>';
				}
			}
			?>
		</ul>
	</div>
	<?php
}


function wprm_entry_instructions() {
	$meta = wprm_get_details();
	$html = '';
	if ( isset( $meta['instructions'] ) ) :
		$html .= '<div class="recipe-instructions">';
		$html .= '<h3 class="like-heading">' . esc_html__( 'Instructions', 'wp-recipe-manager' ) . '</h3>';
		$html .= '<div class="recipe-steps">';
		foreach ( $meta['instructions'] as $step )  :
			$html .= '<div class="step" title="' . esc_attr__( 'Mark Complete', 'wp-recipe-manager' ) . '">';
			if ( isset( $step['title'] ) ) {
				$html .= '<label for="">' . $step['title'] . '</label>';
			}
			if ( isset( $step['content'] ) ) {
				$html .= '<div class="step-content">' . $step['content'] . '</div>';
			}

			$html .= '</div>';
		endforeach;
		$html .= '</div>';
		$html .= '</div>';
	endif;

	return $html;
}

function wprm_entry_notes() {
	$meta = wprm_get_details();
	$html = '';
	if ( isset( $meta['notes'] ) ) :
		$html .= '<div class="recipe-notes">';
		$html .= '	<h3 class="like-heading">' . esc_html__( 'Footnotes', 'wp-recipe-manager' ) . '</h3>';
		$html .= '	<div class="note-content">';
		$html .= $meta['notes'];
		$html .= '	</div>';
		$html .= '</div>';
	endif;

	return $html;
}

function wprm_entry_author() {
	$author_avatar_size = apply_filters( 'wprm_author_avatar_size', 49 );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);


	?>
	<div class="author-wrap">
		<div class="avatar-wrap">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ); ?>
		</div>
		<div class="info-wrap">
			<div class="author-name"><?php
				printf( '<span class="screen-reader-text">%1$s </span> <a class="url fn n" href="%2$s">%3$s</a>',
					_x( 'By', 'Used before post author name.', 'wp-recipe-manager' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				); ?></div>
			<div class="created-date"><?php echo $time_string ?></div>
		</div>
	</div>
	<?php


}

function wprm_entry_tags() {
	$tags_list = get_the_term_list( get_the_ID(), 'recipe_tag' );
	if ( $tags_list && ! is_wp_error( $tags_list ) ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags:', 'Used before tag names.', 'wp-recipe-manager' ),
			$tags_list
		);
	}
}

function wprm_entry_categories() {
	$term_list = get_the_term_list( get_the_ID(), 'recipe_category' ); // get the taxonomy terms
	if ( $term_list ) {
		printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Categories:', 'Used before category names.', 'wp-recipe-manager' ),
			$term_list
		);
	}
}

function wprm_entry_cuisines() {
	$cuisine_list = get_the_term_list( get_the_ID(), 'recipe_cuisine' );
	if ( $cuisine_list && ! is_wp_error( $cuisine_list ) ) {
		printf( '<span class="cuisine-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Cuisines:', 'Used before cuisine names.', 'wp-recipe-manager' ),
			$cuisine_list
		);
	}
}
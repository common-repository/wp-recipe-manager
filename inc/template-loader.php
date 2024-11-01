<?php

/**
 * Created by PhpStorm.
 * User: tomiup
 * Date: 12/5/2017
 * Time: 8:55 AM
 */


/**
 * @param $template_path
 *
 * @return string
 */
function wprm_template_include( $template_path ) {
	if ( get_post_type() == 'recipe' ) {
		if ( is_single() ) {
			// checks if the file exists in the theme first,
			// otherwise serve the file from the plugin
			if ( $theme_file = locate_template( array( 'masterchef/single.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = wprm_get_templates_dir() . '/single.php';
			}
		}
	}

	return $template_path;
}

add_filter( 'template_include', 'wprm_template_include', 1 );

/**
 * @param      $slug
 * @param null $name
 * @param bool $load
 *
 * @return bool|string
 */
function wprm_get_template_part( $slug, $name = null, $load = true ) {
	do_action( 'wprm_get_template_part_' . $slug, $slug, $name );

	$templates = wprm_get_template_file_names( $slug, $name );

	return wprm_locate_template( $templates, $load, false );
}

/**
 * @param $slug
 * @param $name
 *
 * @return mixed|void
 */
function wprm_get_template_file_names( $slug, $name ) {
	if ( isset( $name ) ) {
		$templates[] = $slug . '-' . $name . '.php';
	}
	$templates[] = $slug . '.php';

	return apply_filters( 'wprm_get_template_part', $templates, $slug, $name );
}

/**
 * @param      $template_names
 * @param bool $load
 * @param bool $require_once
 *
 * @return bool|string
 */
function wprm_locate_template( $template_names, $load = false, $require_once = true ) {
	$located        = false;
	$template_names = array_filter( (array) $template_names );
	foreach ( $template_names as $template_name ) {
		$template_name = ltrim( $template_name, '/' );
		foreach ( wprm_get_template_paths() as $template_path ) {
			if ( file_exists( $template_path . $template_name ) ) {
				$located = $template_path . $template_name;
				break;
			}
		}
	}
	if ( $load && $located ) {
		load_template( $located, $require_once );
	}

	return $located;
}

/**
 * @return array
 */
function wprm_get_template_paths() {
	$theme_directory = 'wp-recipe-manager';
	$file_paths      = array(
		10  => trailingslashit( get_template_directory() ) . $theme_directory,
		100 => wprm_get_templates_dir()
	);
	if ( is_child_theme() ) {
		$file_paths[1] = trailingslashit( get_stylesheet_directory() ) . $theme_directory;
	}

	$file_paths = apply_filters( 'wprm_template_paths', $file_paths );
	ksort( $file_paths, SORT_NUMERIC );

	return array_map( 'trailingslashit', $file_paths );
}

/**
 * @return string
 */
function wprm_get_templates_dir() {
	return WPRM_PATH . 'templates';
}


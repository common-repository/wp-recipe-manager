<?php
add_filter( 'tmu_meta_boxes', 'wprm_add_metaboxes' );
function wprm_add_metaboxes( $metaboxes ) {
	$prefix      = 'wprm_';
	$metaboxes[] = array(
		'id'       => $prefix . 'settings',
		'title'    => esc_attr__( 'Recipe Settings', 'wp-recipe-manager' ),
		'screens'  => array( 'recipe' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'id'          => $prefix . 'prep_time',
				'title'       => esc_attr__( 'Preparation Time', 'wp-recipe-manager' ),
				'type'        => 'number',
				'default'     => '0',
				'description' => esc_attr__( 'Time to prepare (in minutes).', 'wp-recipe-manager' ),
			),

			array(
				'id'          => $prefix . 'cook_time',
				'title'       => esc_attr__( 'Cooking Time', 'wp-recipe-manager' ),
				'type'        => 'number',
				'default'     => '0',
				'description' => esc_attr__( 'Time to cook (in minutes).', 'wp-recipe-manager' )
			),

			array(
				'id'          => $prefix . 'servings',
				'title'       => esc_attr__( 'Servings', 'wp-recipe-manager' ),
				'type'        => 'text',
				'description' => esc_attr__( 'Amount of serving.', 'wp-recipe-manager' )
			),

			array(
				'id'          => $prefix . 'calories',
				'title'       => esc_attr__( 'Calories', 'wp-recipe-manager' ),
				'type'        => 'number',
				'default'     => '0',
				'description' => esc_attr__( 'Amount of calories.', 'wp-recipe-manager' )
			),

			array(
				'id'      => $prefix . 'level',
				'title'   => esc_attr__( 'Skill Level', 'wp-recipe-manager' ),
				'type'    => 'text',
				'default' => 'Easy',
			),

			array(
				'id'          => $prefix . 'notes',
				'title'       => esc_attr__( 'Footnotes', 'wp-recipe-manager' ),
				'type'        => 'textarea',
				'description' => esc_attr__( 'Some note for user.', 'wp-recipe-manager' )
			),

			array(
				'id'        => $prefix . 'ingredients',
				'title'     => esc_attr__( 'Ingredients', 'wp-recipe-manager' ),
				'sub-title' => esc_attr__( 'Ingredient', 'wp-recipe-manager' ),
				'type'      => 'repeater',
				'fields'    => array(
					array(
						'id'    => 'ingredient',
						'title' => esc_attr__( 'Title', 'wp-recipe-manager' ),
						'type'  => 'text',
					),
				),
			),

			array(
				'id'        => $prefix . 'instructions',
				'title'     => esc_attr__( 'Instruction Steps', 'wp-recipe-manager' ),
				'sub-title' => esc_attr__( 'Step', 'wp-recipe-manager' ),
				'type'      => 'repeater',
				'fields'    => array(
					array(
						'id'    => 'title',
						'title' => esc_attr__( 'Title', 'wp-recipe-manager' ),
						'type'  => 'text',
					),
					array(
						'id'    => 'content',
						'title' => esc_attr__( 'Content', 'wp-recipe-manager' ),
						'type'  => 'textarea',
					),
				),
			)
		)
	);

	return $metaboxes;
}
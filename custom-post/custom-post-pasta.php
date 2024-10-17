<?php

// Enregistrement d'un type de contenu supplémentaire
function mangia_custom_post_types_pasta() {

	$labels = array(
		'name'              => 'Pastas',
		'singular_name'     => 'Pasta',
		'add_new_item'      => 'Add a pasta',
		'menu_name'			=> 'Pastas'
	);

	$args = array(
		'public' => true,
		'labels'  => $labels,
		'rewrite' => array(
			'slug' => 'pasta',
			'with_front' => false
		),
		'menu_icon' => 'dashicons-food',
		'supports' => array( 'title', 'editor', 'page-attributes'),
		'hierarchical' => false
		// 'taxonomies'  => array( 'category' )
	);

	// Ajout du CPT
	register_post_type( 'pasta', $args );
}
add_action( 'init', 'mangia_custom_post_types_pasta' );


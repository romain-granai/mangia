<?php

// Enregistrement d'un type de contenu supplémentaire
function mangia_custom_post_types_product() {

	$labels = array(
		'name'              => 'Products',
		'singular_name'     => 'Product',
		'add_new_item'      => 'Add a product',
		'menu_name'			=> 'Products'
	);

	$args = array(
		'public' => true,
		'labels'  => $labels,
		'rewrite' => array(
			'slug' => 'product',
			'with_front' => false
		),
		'menu_icon' => 'dashicons-portfolio',
		'supports' => array( 'title', 'editor', 'page-attributes'),
		'hierarchical' => false
		// 'taxonomies'  => array( 'category' )
	);

	// Ajout du CPT
	register_post_type( 'product', $args );
}
add_action( 'init', 'mangia_custom_post_types_product' );

?>
<?php

// // Ajout du menu principal
	function mangia_register_my_menu() {
		register_nav_menus( array(
			'top-left'	=> __( 'Top Left', 'mangia' ),
			'top-right'	=> __( 'Top Right', 'mangia' ),
			// 'legal'	=> __( 'Menu mentions légales', 'mangia' ),
			// 'decouvrir'	=> __( 'Menu footer Decouvrir', 'mangia' )
		));
	}
	add_action( 'after_setup_theme', 'mangia_register_my_menu' );

<?php

/*

@package sunsettheme

	========================
		ADMIN ENQUEUE FUNCTIONS
	========================
*/

function lepetitfleur_load_admin_scripts( $hook ){
	//echo $hook;
	if( 'toplevel_page_le_petit_fleur' == $hook ){

		wp_register_style( 'lepetitfleur_admin', get_template_directory_uri() . '/css/lepetitfleur.admin.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'lepetitfleur_admin' );

		wp_enqueue_media();

		wp_register_script( 'lepetitfleur-admin-script', get_template_directory_uri() . '/js/lepetitfleur.admin.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'lepetitfleur-admin-script' );

	} else if ( 'lepetitfleur_page_le_petit_fleur_css' == $hook ){

		wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/lepetitfleur.ace.css', array(), '1.0.0', 'all' );

		wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.2.1', true );
		wp_enqueue_script( 'lepetitfleur-custom-css-script', get_template_directory_uri() . '/js/lepetitfleur.custom_css.js', array('jquery'), '1.0.0', true );

	} else { return; }

}
add_action( 'admin_enqueue_scripts', 'lepetitfleur_load_admin_scripts' );

/*

	========================
		FRONT-END ENQUEUE FUNCTIONS
	========================
*/

function lepetitfleur_load_scripts(){

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all' );
	wp_enqueue_style( 'lepetitfleur', get_template_directory_uri() . '/css/lepetitfleur.css', array(), '1.0.0', 'all' );

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	wp_enqueue_script( 'lepetitfleur', get_template_directory_uri() . '/js/lepetitfleur.js', array('jquery'), '1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'lepetitfleur_load_scripts' );

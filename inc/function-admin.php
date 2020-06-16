<?php

/*

@package lepetitfleur

	========================
		ADMIN PAGE
	========================
*/

function lepetitfleur_add_admin_page() {

	//Generate Le Petit Fleur Admin Page
	add_menu_page( 'Le Petit Fleur Theme Options', 'Le Petit Fleur', 'manage_options', 'le_petit_fleur', 'lepetitfleur_theme_create_page', get_template_directory_uri() . '/img/flower-icon.png', 110 );

	//Generate Le Petit Fleur Admin Sub Pages
	add_submenu_page( 'le_petit_fleur', 'Le Petit Fleur  Sidebar Options', 'Sidebar', 'manage_options', 'le_petit_fleur', 'lepetitfleur_theme_create_page' );
	add_submenu_page( 'le_petit_fleur', 'Le Petit Fleur Theme Options', 'Theme Options', 'manage_options', 'le_petit_fleur_theme', 'lepetitfleur_theme_support_page' );
  add_submenu_page( 'le_petit_fleur', 'Le Petit Fleur Contact Form', 'Contact Form', 'manage_options', 'le_petit_fleur_theme_contact', 'lepetitfleur_contact_form_page' );
  add_submenu_page( 'le_petit_fleur', 'Le Petit Fleur CSS Options', 'Custom CSS', 'manage_options', 'le_petit_fleur_css', 'lepetitfleur_theme_settings_page');

}
add_action( 'admin_menu', 'lepetitfleur_add_admin_page' );

//Activate custom settings
add_action( 'admin_init', 'lepetitfleur_custom_settings' );

function lepetitfleur_custom_settings() {
	//Sidebar Options
	register_setting( 'lepetitfleur-settings-group', 'profile_picture' );
	register_setting( 'lepetitfleur-settings-group', 'first_name' );
	register_setting( 'lepetitfleur-settings-group', 'last_name' );
	register_setting( 'lepetitfleur-settings-group', 'user_description' );
	register_setting( 'lepetitfleur-settings-group', 'twitter_handler', 'lepetitfleur_sanitize_twitter_handler' );
	register_setting( 'lepetitfleur-settings-group', 'facebook_handler' );
	register_setting( 'lepetitfleur-settings-group', 'gplus_handler' );

	add_settings_section( 'lepetitfleur-sidebar-options', 'Sidebar Option', 'lepetitfleur_sidebar_options', 'le_petit_fleur');

	add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'lepetitfleur_sidebar_profile', 'le_petit_fleur', 'lepetitfleur-sidebar-options');
	add_settings_field( 'sidebar-name', 'Full Name', 'lepetitfleur_sidebar_name', 'le_petit_fleur', 'lepetitfleur-sidebar-options');
	add_settings_field( 'sidebar-description', 'Description', 'lepetitfleur_sidebar_description', 'le_petit_fleur', 'lepetitfleur-sidebar-options');
	add_settings_field( 'sidebar-twitter', 'Twitter handler', 'lepetitfleur_sidebar_twitter', 'le_petit_fleur', 'lepetitfleur-sidebar-options');
	add_settings_field( 'sidebar-facebook', 'Facebook handler', 'lepetitfleur_sidebar_facebook', 'le_petit_fleur', 'lepetitfleur-sidebar-options');
	add_settings_field( 'sidebar-gplus', 'Google+ handler', 'lepetitfleur_sidebar_gplus', 'le_petit_fleur', 'lepetitfleur-sidebar-options');

	//Theme Support Options
	register_setting( 'lepetitfleur-theme-support', 'post_formats' );
	register_setting( 'lepetitfleur-theme-support', 'custom_header' );
	register_setting( 'lepetitfleur-theme-support', 'custom_background' );

	add_settings_section( 'lepetitfleur-theme-options', 'Theme Options', 'lepetitfleur_theme_options', 'le_petit_fleur_theme' );

	add_settings_field( 'post-formats', 'Post Formats', 'lepetitfleur_post_formats', 'le_petit_fleur_theme', 'lepetitfleur-theme-options' );
	add_settings_field( 'custom-header', 'Custom Header', 'lepetitfleur_custom_header', 'le_petit_fleur_theme', 'lepetitfleur-theme-options' );
	add_settings_field( 'custom-background', 'Custom Background', 'lepetitfleur_custom_background', 'le_petit_fleur_theme', 'lepetitfleur-theme-options' );

  //Contact Form Options
	register_setting( 'lepetitfleur-contact-options', 'activate_contact', 'lepetitfleur_sanitize_custom_css' );

	add_settings_section( 'lepetitfleur-contact-section', 'Contact Form', 'lepetitfleur_contact_section', 'le_petit_fleur_theme_contact');

	add_settings_field( 'activate-form', 'Activate Contact Form', 'lepetitfleur_activate_contact', 'le_petit_fleur_theme_contact', 'lepetitfleur-contact-section' );

  //Custom CSS Options
  register_setting( 'lepetitfleur-custom-css-options', 'lepetitfleur_css' );

  add_settings_section( 'lepetitfleur-custom-css-section', 'Custom CSS', 'lepetitfleur_custom_css_section_callback', 'le_petit_fleur_css' );

  add_settings_field( 'custom-css', 'Insert your Custom CSS', 'lepetitfleur_custom_css_callback', 'le_petit_fleur_css', 'lepetitfleur-custom-css-section' );

}

function lepetitfleur_custom_css_section_callback() {
	echo 'Customize your Theme with your own CSS';
}

function lepetitfleur_custom_css_callback() {
	$css = get_option( 'lepetitfleur_css' );
	$css = ( empty($css) ? '/* Le Petit Fleur Theme Custom CSS */' : $css );
	echo '<div id="customCss">'.$css.'</div><textarea id="lepetitfleur_css" name="lepetitfleur_css" style="display:none; visibility:hidden;">'.$css.'</textarea>';
}

function lepetitfleur_theme_options() {
	echo 'Activate and Deactivate specific Theme Support Options';
}

function lepetitfleur_contact_section() {
	echo 'Activate and Deactivate the Built-in contact form';
}

function lepetitfleur_activate_contact() {
	$options = get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.' /></label>';
}

function lepetitfleur_post_formats() {
	$options = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
	}
	echo $output;
}

function lepetitfleur_custom_header() {
	$options = get_option( 'custom_header' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}

function lepetitfleur_custom_background() {
	$options = get_option( 'custom_background' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}

// Sidebar Options Functions
function lepetitfleur_sidebar_options() {
	echo 'Customize your Sidebar Information';
}

function lepetitfleur_sidebar_profile() {
	$picture = esc_attr( get_option( 'profile_picture' ) );
	if( empty($picture) ){
		echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
	} else {
		echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
	}

}
function lepetitfleur_sidebar_name() {
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}
function lepetitfleur_sidebar_description() {
	$description = esc_attr( get_option( 'user_description' ) );
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p class="description">Write your description.</p>';
}
function lepetitfleur_sidebar_twitter() {
	$twitter = esc_attr( get_option( 'twitter_handler' ) );
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}
function lepetitfleur_sidebar_facebook() {
	$facebook = esc_attr( get_option( 'facebook_handler' ) );
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler" />';
}
function lepetitfleur_sidebar_gplus() {
	$gplus = esc_attr( get_option( 'gplus_handler' ) );
	echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ handler" />';
}

//Sanitization settings
function lepetitfleur_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}

function lepetitfleur_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}

//Template submenu functions
function lepetitfleur_theme_create_page() {
	require_once( get_template_directory() . '/inc/templates/lepetitfleur-admin.php' );
}

function lepetitfleur_theme_support_page() {
	require_once( get_template_directory() . '/inc/templates/lepetitfleur-theme-support.php' );
}

function lepetitfleur_contact_form_page() {
	require_once( get_template_directory() . '/inc/templates/lepetitfleur-contact-form.php' );
}

function lepetitfleur_theme_settings_page() {
   require_once( get_template_directory() . '/inc/templates/lepetitfleur-custom-css.php' );
}

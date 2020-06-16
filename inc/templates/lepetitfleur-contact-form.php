<h1>Le Petit Fleur Contact Form</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="lepetitfleur-general-form">
	<?php settings_fields( 'lepetitfleur-contact-options' ); ?>
	<?php do_settings_sections( 'le_petit_fleur_theme_contact' ); ?>
	<?php submit_button(); ?>
</form>

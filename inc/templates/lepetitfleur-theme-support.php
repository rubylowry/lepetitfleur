<h1>Le Petit Fleur Theme Support</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="lepetitfleur-general-form">
	<?php settings_fields( 'lepetitfleur-theme-support' ); ?>
	<?php do_settings_sections( 'le_petit_fleur_theme' ); ?>
	<?php submit_button(); ?>
</form>

<h1>Le Petit Fleur Custom CSS</h1>
<?php settings_errors(); ?>

<form id="save-custom-css-form" method="post" action="options.php" class="lepetitfleur-general-form">
	<?php settings_fields( 'lepetitfleur-custom-css-options' ); ?>
	<?php do_settings_sections( 'le_petit_fleur_css' ); ?>
	<?php submit_button(); ?>
</form>

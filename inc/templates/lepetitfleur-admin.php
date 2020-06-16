<h1>Le Petit Fleur Sidebar Options</h1>
<?php settings_errors(); ?>
<?php

	$picture = esc_attr( get_option( 'profile_picture' ) );
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	$fullName = $firstName . ' ' . $lastName;
	$description = esc_attr( get_option( 'user_description' ) );

?>
<div class="lepetitfleur-sidebar-preview">
	<div class="lepetitfleur-sidebar">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
		</div>
		<h1 class="lepetitfleur-username"><?php print $fullName; ?></h1>
		<h2 class="lepetitfleur-description"><?php print $description; ?></h2>
		<div class="icons-wrapper">

		</div>
	</div>
</div>

<form id="submitForm" method="post" action="options.php" class="lepetitfleur-general-form">
	<?php settings_fields( 'lepetitfleur-settings-group' ); ?>
	<?php do_settings_sections( 'le_petit_fleur' ); ?>
	<?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ); ?>
</form>

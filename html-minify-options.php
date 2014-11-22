<?php

	/**
	 * Fields
	 */

	function html_minify_settings_field_ignore_css() {
		$options = html_minify_get_theme_options();
		?>
		<label for="ignore-css">
			<input type="checkbox" name="html_minify_theme_options[ignore_css]" id="ignore-css" <?php checked( 'on', $options['ignore_css'] ); ?> />
			<?php _e( 'Ignore inline CSS', 'htmlmin' ); ?>
		</label>
		<?php
	}

	function html_minify_settings_field_ignore_js() {
		$options = html_minify_get_theme_options();
		?>
		<label for="ignore-js">
			<input type="checkbox" name="html_minify_theme_options[ignore_js]" id="ignore-js" <?php checked( 'on', $options['ignore_js'] ); ?> />
			<?php _e( 'Ignore inline JavaScript', 'htmlmin' ); ?>
		</label>
		<?php
	}

	function html_minify_settings_field_ignore_comments() {
		$options = html_minify_get_theme_options();
		?>
		<label for="ignore-comments">
			<input type="checkbox" name="html_minify_theme_options[ignore_comments]" id="ignore-comments" <?php checked( 'on', $options['ignore_comments'] ); ?> />
			<?php _e( 'Ignore inline comments', 'htmlmin' ); ?>
		</label>
		<?php
	}


	/**
	 * Menu
	 */

	// Register the theme options page and its fields
	function html_minify_theme_options_init() {
		register_setting(
			'html_minify_options', // Options group, see settings_fields() call in html_minify_theme_options_render_page()
			'html_minify_theme_options', // Database option, see html_minify_get_theme_options()
			'html_minify_theme_options_validate' // The sanitization callback, see html_minify_theme_options_validate()
		);

		// Register our settings field group
		add_settings_section(
			'general', // Unique identifier for the settings section
			'', // Section title (we don't want one)
			'__return_false', // Section callback (we don't want anything)
			'html_minify_theme_options' // Menu slug, used to uniquely identify the page; see html_minify_theme_options_add_page()
		);

		// Register our individual settings fields
		// add_settings_field( $id, $title, $callback, $page, $section );
		// $id - Unique identifier for the field.
		// $title - Setting field title.
		// $callback - Function that creates the field (from the Theme Option Fields section).
		// $page - The menu page on which to display this field.
		// $section - The section of the settings page in which to show the field.

		add_settings_field( 'ignore_css', 'Ignore CSS', 'html_minify_settings_field_ignore_css', 'html_minify_theme_options', 'general' );
		add_settings_field( 'ignore_js', 'Ignore JS', 'html_minify_settings_field_ignore_js', 'html_minify_theme_options', 'general' );
		add_settings_field( 'ignore_comments', 'Ignore Comments', 'html_minify_settings_field_ignore_comments', 'html_minify_theme_options', 'general' );
	}
	add_action( 'admin_init', 'html_minify_theme_options_init' );



	// Create theme options menu
	// The content that's rendered on the menu page.
	function html_minify_theme_options_render_page() {
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2><?php _e( 'HTML Minification Options', 'htmlmin' ); ?></h2>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'html_minify_options' );
					do_settings_sections( 'html_minify_theme_options' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}



	// Add the theme options page to the admin menu
	function html_minify_theme_options_add_page() {
		$theme_page = add_submenu_page(
			'options-general.php', // parent slug
			'HTML Minify', // Label in menu
			'HTML Minify', // Label in menu
			'edit_theme_options', // Capability required
			'html_minify_theme_options', // Menu slug, used to uniquely identify the page
			'html_minify_theme_options_render_page' // Function that renders the options page
		);
	}
	add_action( 'admin_menu', 'html_minify_theme_options_add_page' );



	// Restrict access to the theme options page to admins
	function html_minify_option_page_capability( $capability ) {
		return 'edit_theme_options';
	}
	add_filter( 'option_page_capability_html_minify_options', 'html_minify_option_page_capability' );



	/**
	 * Process
	 */

	// Get the current options from the database.
	// If none are specified, use these defaults.
	function html_minify_get_theme_options() {
		$saved = (array) get_option( 'html_minify_theme_options' );
		$defaults = array(
			'ignore_css' => 'off',
			'ignore_js' => 'off',
			'ignore_comments' => 'off',
		);

		$defaults = apply_filters( 'html_minify_default_theme_options', $defaults );

		$options = wp_parse_args( $saved, $defaults );
		$options = array_intersect_key( $options, $defaults );

		return $options;
	}



	// Sanitize and validate updated theme options
	function html_minify_theme_options_validate( $input ) {
		$output = array();

		if ( isset( $input['ignore_css'] ) )
			$output['ignore_css'] = 'on';

		if ( isset( $input['ignore_js'] ) )
			$output['ignore_js'] = 'on';

		if ( isset( $input['ignore_comments'] ) )
			$output['ignore_comments'] = 'on';

		return apply_filters( 'html_minify_theme_options_validate', $output, $input );
	}



	/**
	 * Get Options
	 */

	function html_minify_get_ignore_css() {
		$options = html_minify_get_theme_options();
		if ( $options['ignore_css'] == 'on' ) {
			$setting = false;
		} else {
			$setting = true;
		}
		return $setting;
	}

	function html_minify_get_ignore_js() {
		$options = html_minify_get_theme_options();
		if ( $options['ignore_js'] == 'on' ) {
			$setting = false;
		} else {
			$setting = true;
		}
		return $setting;
	}

	function html_minify_get_ignore_comments() {
		$options = html_minify_get_theme_options();
		if ( $options['ignore_comments'] == 'on' ) {
			$setting = false;
		} else {
			$setting = true;
		}
		return $setting;
	}
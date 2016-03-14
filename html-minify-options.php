<?php

/**
 * Theme Options v1.1.0
 * Adjust theme settings from the admin dashboard.
 * Find and replace `YourTheme` with your own namepspacing.
 *
 * Created by Michael Fields.
 * https://gist.github.com/mfields/4678999
 *
 * Forked by Chris Ferdinandi
 * http://gomakethings.com
 *
 * Free to use under the MIT License.
 * http://gomakethings.com/mit/
 */


	/**
	 * Theme Options Fields
	 * Each option field requires its own uniquely named function. Select options and radio buttons also require an additional uniquely named function with an array of option choices.
	 */

	// Sample checkbox field
	function html_minify_settings_field_checkboxes() {
		$options = html_minify_get_theme_options();
		?>
		<label>
			<input type="checkbox" name="html_minify_theme_options[ignore_css]" <?php checked( 'on', $options['ignore_css'] ); ?> />
			<?php _e( 'Ignore CSS', 'html-minify' ); ?>
		</label>
		<br>
		<label>
			<input type="checkbox" name="html_minify_theme_options[ignore_comments]" <?php checked( 'on', $options['ignore_comments'] ); ?> />
			<?php _e( 'Ignore comments', 'html-minify' ); ?>
		</label>
		<br>
		<label>
			<input type="checkbox" name="html_minify_theme_options[exclude_info]" <?php checked( 'on', $options['exclude_info'] ); ?> />
			<?php _e( 'Exclude info comment', 'html-minify' ); ?>
		</label>
		<?php
	}



	/**
	 * Theme Option Defaults & Sanitization
	 * Each option field requires a default value under html_minify_get_theme_options(), and an if statement under html_minify_theme_options_validate();
	 */

	// Get the current options from the database.
	// If none are specified, use these defaults.
	function html_minify_get_theme_options() {
		$saved = (array) get_option( 'html_minify_theme_options' );
		$defaults = array(
			'ignore_css' => 'off',
			'ignore_comments' => 'off',
			'exclude_info' => 'off',
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

		if ( isset( $input['ignore_comments'] ) )
			$output['ignore_comments'] = 'on';

		if ( isset( $input['exclude_info'] ) )
			$output['exclude_info'] = 'on';

		return apply_filters( 'html_minify_theme_options_validate', $output, $input );
	}



	/**
	 * Theme Options Menu
	 * Each option field requires its own add_settings_field function.
	 */

	// Create theme options menu
	// The content that's rendered on the menu page.
	function html_minify_theme_options_render_page() {
		?>
		<div class="wrap">
			<h2><?php _e( 'HTML Minification Options', 'html-minify' ); ?></h2>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'html_minify_options' );
					do_settings_sections( 'html_minify_options' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}

	// Register the theme options page and its fields
	function html_minify_theme_options_init() {

		// Register a setting and its sanitization callback
		// register_setting( $option_group, $option_name, $sanitize_callback );
		// $option_group - A settings group name.
		// $option_name - The name of an option to sanitize and save.
		// $sanitize_callback - A callback function that sanitizes the option's value.
		register_setting( 'html_minify_options', 'html_minify_theme_options', 'html_minify_theme_options_validate' );


		// Register our settings field group
		// add_settings_section( $id, $title, $callback, $page );
		// $id - Unique identifier for the settings section
		// $title - Section title
		// $callback - // Section callback (we don't want anything)
		// $page - // Menu slug, used to uniquely identify the page. See html_minify_theme_options_add_page().
		add_settings_section( 'general', null,  '__return_false', 'html_minify_options' );


		// Register our individual settings fields
		// add_settings_field( $id, $title, $callback, $page, $section );
		// $id - Unique identifier for the field.
		// $title - Setting field title.
		// $callback - Function that creates the field (from the Theme Option Fields section).
		// $page - The menu page on which to display this field.
		// $section - The section of the settings page in which to show the field.
		add_settings_field( 'checkboxes', __( 'Exclude from Minification', 'html-minify' ), 'html_minify_settings_field_checkboxes', 'html_minify_options', 'general' );

	}
	add_action( 'admin_init', 'html_minify_theme_options_init' );

	// Add the theme options page to the admin menu
	// Use add_theme_page() to add under Appearance tab (default).
	// Use add_menu_page() to add as it's own tab.
	// Use add_submenu_page() to add to another tab.
	function html_minify_theme_options_add_page() {

		// add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function );
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		// $page_title - Name of page
		// $menu_title - Label in menu
		// $capability - Capability required
		// $menu_slug - Used to uniquely identify the page
		// $function - Function that renders the options page
		// $theme_page = add_theme_page( __( 'Theme Options', 'html-minify' ), __( 'Theme Options', 'html-minify' ), 'edit_theme_options', 'html_minify_options', 'html_minify_theme_options_render_page' );

		// $theme_page = add_menu_page( __( 'Theme Options', 'html-minify' ), __( 'Theme Options', 'html-minify' ), 'edit_theme_options', 'html_minify_options', 'html_minify_theme_options_render_page' );
		$theme_page = add_submenu_page( 'options-general.php', __( 'HTML Minify', 'html-minify' ), __( 'HTML Minify', 'html-minify' ), 'edit_theme_options', 'html_minify_options', 'html_minify_theme_options_render_page' );
	}
	add_action( 'admin_menu', 'html_minify_theme_options_add_page' );



	// Restrict access to the theme options page to admins
	function html_minify_option_page_capability( $capability ) {
		return 'edit_theme_options';
	}
	add_filter( 'option_page_capability_html_minify_options', 'html_minify_option_page_capability' );

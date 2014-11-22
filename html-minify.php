<?php

/**
 * Plugin Name: HTML Minify
 * Plugin URI: http://github.com/cferdinandi/html-minify
 * Description: Minify your HTML output in WordPress. Control what gets minified under <a href="options-general.php?page=html_minify_theme_options">Settings &rarr; HTML Minify</a>.
 * Version: 1.1.0
 * Author: Chris Ferdinandi
 * Author URI: http://gomakethings.com
 * License: MIT
 *
 * Forked from DVS.
 * http://www.intert3chmedia.net/2011/12/minify-html-javascript-css-without.html
 */

	require_once( dirname( __FILE__) . '/html-minify-options.php' );
	require_once( dirname( __FILE__) . '/html-minify-process.php' );

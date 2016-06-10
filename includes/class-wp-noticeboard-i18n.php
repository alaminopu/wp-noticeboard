<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://alaminopu.me
 * @since      1.0.0
 *
 * @package    Wp_Noticeboard
 * @subpackage Wp_Noticeboard/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Noticeboard
 * @subpackage Wp_Noticeboard/includes
 * @author     Md. Al-Amin <alamin.opu10@gmail.com>
 */
class Wp_Noticeboard_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-noticeboard',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

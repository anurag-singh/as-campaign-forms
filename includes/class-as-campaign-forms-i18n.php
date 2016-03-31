<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.anuragsingh.me
 * @since      1.0.0
 *
 * @package    As_Campaign_Forms
 * @subpackage As_Campaign_Forms/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    As_Campaign_Forms
 * @subpackage As_Campaign_Forms/includes
 * @author     Anurag Singh <anuragsinghce@gmail.com>
 */
class As_Campaign_Forms_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'as-campaign-forms',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

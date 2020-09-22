<?php

/*
Widget Name: Contact Form
Description: Contact Form
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/white-label-einbinder/kontaktformular
*/

class Anker_Connect_Wls_ContactForm_Widget extends SiteOrigin_Widget {
	public function __construct() {
		parent::__construct(
			'wls-contact-form',
			__( 'Contact Form', '5-anker-connect' ),
			[
				'description' => __( 'Contact Form', '5-anker-connect' ),
			],
			[
			],
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	public function get_widget_form() {
		return [
			'privacy' => [
				'type'    => 'text',
				'label'   => __( 'Privacy', '5-anker-connect' ),
				'default' => ''
			],
		];
	}

	public function get_html_content( $instance, $args, $template_vars, $css_name ) {
		?>
        <wls-contact-form privacy="<?= $instance['privacy']; ?>"></wls-contact-form>
		<?php
	}
}

siteorigin_widget_register( 'wls-contact-form', __FILE__, 'Anker_Connect_Wls_ContactForm_Widget' );

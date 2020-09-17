<?php

/*
Widget Name: Planbar Login
Description: Planbar Login
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/planbar-login
*/

class Anker_Connect_Wls_PlanbarLogin_Widget extends SiteOrigin_Widget {
	public function __construct() {
		parent::__construct(
			'wls-planbar-login',
			__( 'Planbar Login', 'anker-connect' ),
			[
				'description' => __( 'Planbar Login', 'anker-connect' ),
			],
			[
			],
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	public function get_widget_form() {
		return [
		];
	}

	public function get_html_content( $instance, $args, $template_vars, $css_name ) {
		echo '<wls-planbar-login></wls-planbar-login>';
	}
}

siteorigin_widget_register( 'wls-planbar-login', __FILE__, 'Anker_Connect_Wls_PlanbarLogin_Widget' );

<?php

/*
Widget Name: Boat Book Calendar
Description: Boat Book Calendar
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/buchungskalender-termine
*/

class Anker_Connect_Wls_BoatBookCalendar_Widget extends SiteOrigin_Widget {
	public function __construct() {
		parent::__construct(
			'wls-boat-book-calendar',
			__( 'Boat Book Calendar', '5-anker-connect' ),
			[
				'description' => __( 'Boat Book Calendar', '5-anker-connect' ),
			],
			[
			],
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	public function get_widget_form() {
		return [
			'id' => [
				'type'    => 'number',
				'label'   => __( 'ID', '5-anker-connect' ),
				'default' => ''
			],
		];
	}

	public function get_html_content( $instance, $args, $template_vars, $css_name ) {
		?>
        <wls-boat-book-calendar id="<?php echo esc_attr($instance['id']); ?>"></wls-boat-book-calendar>
		<?php
	}
}

siteorigin_widget_register( 'wls-boat-book-calendar', __FILE__, 'Anker_Connect_Wls_BoatBookCalendar_Widget' );

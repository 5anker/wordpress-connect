<?php

/*
Widget Name: Connect: Boat Book Calendar
Description: Boat Book Calendar
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/buchungskalender-termine
*/

class SiteoriginWlsBoatBookCalendar_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-boat-book-calendar',
			__('Connect: Boat Book Calendar', '5anker'),
			[
				'description' => __('BoatBookCalendar', '5anker'),
			],
			[
			],
			false,
			plugin_dir_path(__FILE__)
		);
	}

	public function get_widget_form()
	{
		return [
			'id' => [
				'type' => 'number',
				'label' => __('ID', '5anker'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-boat-book-calendar id="<?= $instance['id']; ?>"></wls-boat-book-calendar>
		<?php
	}
}

siteorigin_widget_register('wls-boat-book-calendar', __FILE__, 'SiteoriginWlsBoatBookCalendar_Widget');

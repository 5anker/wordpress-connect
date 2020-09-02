<?php

/*
Widget Name: Map
Description: Map
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/seekarte
*/

class SiteoriginWlsMap_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-map',
			__('Map', 'anker-connect'),
			[
				'description' => __('Map', 'anker-connect'),
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
			'lat' => [
				'type' => 'text',
				'label' => __('Latitude', 'anker-connect'),
				'default' => ''
			],

			'lng' => [
				'type' => 'text',
				'label' => __('Longitude', 'anker-connect'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-map lat="<?= $instance['lat']; ?>" lng="<?= $instance['lng']; ?>"></wls-map>
		<?php
	}
}

siteorigin_widget_register('wls-map', __FILE__, 'SiteoriginWlsMap_Widget');

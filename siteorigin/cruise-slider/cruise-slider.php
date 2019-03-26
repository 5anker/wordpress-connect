<?php

/*
Widget Name: Connect: Cruise Slider
Description: Cruise Slider
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/angebotskarussel
*/

class SiteoriginWlsCruiseSlider_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-cruise-slider',
			__('Connect: Cruise Slider', '5anker'),
			[
				'description' => __('Cruise Slider', '5anker'),
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
			'query' => [
				'type' => 'text',
				'label' => __('Query', '5anker'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-cruise-slider query="<?= $instance['query']; ?>"></wls-cruise-slider>
		<?php
	}
}

siteorigin_widget_register('wls-cruise-slider', __FILE__, 'SiteoriginWlsCruiseSlider_Widget');

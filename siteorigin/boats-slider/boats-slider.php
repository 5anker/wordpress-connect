<?php

/*
Widget Name: Connect: Boats Slider
Description: Boats Slider
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/boote-karussel
*/

class SiteoriginWlsBoatsSlider_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-boats-slider',
			__('Connect: Boats Slider', '5anker'),
			[
				'description' => __('Boats Slider', '5anker'),
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

		<wls-boats-slider query="<?= $instance['query'] ?? ''; ?>"></wls-boats-slider>

		<?php
	}
}

siteorigin_widget_register('wls-boats-slider', __FILE__, 'SiteoriginWlsBoatsSlider_Widget');

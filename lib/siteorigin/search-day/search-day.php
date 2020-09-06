<?php

/*
Widget Name: Search Day
Description: Search Day
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/terminsuche
*/

class SiteoriginWlsSearchDay_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-search-day',
			__('Search Day', 'anker-connect'),
			[
				'description' => __('Search Day', 'anker-connect'),
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
				'label' => __('Query', 'anker-connect'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-search<?= !empty($instance['query']) ? " query=\"{$instance['query']}\"" : ''; ?>></wls-search>
		<?php
	}
}

siteorigin_widget_register('wls-search-day', __FILE__, 'SiteoriginWlsSearchDay_Widget');

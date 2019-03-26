<?php

/*
Widget Name: Connect: Search
Description: Search
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/terminsuche
*/

class SiteoriginWlsSearch_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-search',
			__('Connect: Search', '5anker'),
			[
				'description' => __('Search', '5anker'),
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
		<wls-search query="<?= $instance['query']; ?>"></wls-search>
		<?php
	}
}

siteorigin_widget_register('wls-search', __FILE__, 'SiteoriginWlsSearch_Widget');

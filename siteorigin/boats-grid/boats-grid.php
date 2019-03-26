<?php

/*
Widget Name: Boats Grid
Description: Boats Grid
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/boote-uebersicht
*/

class SiteoriginWlsBoatsGrid_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-boats-grid',
			__('Boats Grid', '5anker'),
			[
				'description' => __('Boats Grid', '5anker'),
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
		<wls-boats-grid query="<?= $instance['query']; ?>"></wls-boats-grid>
		<?php
	}
}

siteorigin_widget_register('wls-boats-grid', __FILE__, 'SiteoriginWlsBoatsGrid_Widget');

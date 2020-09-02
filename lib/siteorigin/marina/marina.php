<?php

/*
Widget Name: Marina
Description: Marina
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/destinationsansicht
*/

class SiteoriginWlsMarina_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-marina',
			__('Marina', 'anker-connect'),
			[
				'description' => __('Marina', 'anker-connect'),
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
				'label' => __('ID', 'anker-connect'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-marina id="<?= $instance['id']; ?>"></wls-marina>
		<?php
	}
}

siteorigin_widget_register('wls-marina', __FILE__, 'SiteoriginWlsMarina_Widget');

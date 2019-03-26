<?php

/*
Widget Name: Connect: Boat
Description: Boat
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/bootsansicht
*/

class SiteoriginWlsBoat_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-search',
			__('Connect: Boat', '5anker'),
			[
				'description' => __('Boat', '5anker'),
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

			'fields' => [
				'type' => 'text',
				'label' => __('Fields', '5anker'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-boat id="<?= $instance['id']; ?>" fields="<?= $instance['fields'] ?? ''; ?>"></wls-boat>
		<?php
	}
}

siteorigin_widget_register('wls-search', __FILE__, 'SiteoriginWlsBoat_Widget');

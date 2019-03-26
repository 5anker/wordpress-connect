<?php

/*
Widget Name: Connect: Marinas
Description: Marinas
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/destinationen-uebersicht
*/

class SiteoriginWlsMarinas_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-marinas',
			__('Connect: Marinas', '5anker'),
			[
				'description' => __('Marinas', '5anker'),
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
		<wls-marinas query="<?= $instance['query']; ?>"></wls-marinas>
		<?php
	}
}

siteorigin_widget_register('wls-marinas', __FILE__, 'SiteoriginWlsMarinas_Widget');

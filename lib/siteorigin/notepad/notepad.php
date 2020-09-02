<?php

/*
Widget Name: Notepad
Description: Notepad
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/white-label-einbinder/merkliste
*/

class SiteoriginWlsNotepad_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-notepad',
			__('Notepad', 'anker-connect'),
			[
				'description' => __('Notepad', 'anker-connect'),
			],
			[
			],
			false,
			plugin_dir_path(__FILE__)
		);
	}

	public function get_widget_form()
	{
		return [];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-notepad></wls-notepad>
		<?php
	}
}

siteorigin_widget_register('wls-notepad', __FILE__, 'SiteoriginWlsNotepad_Widget');

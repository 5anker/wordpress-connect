<?php

/*
Widget Name: Newsletter
Description: Newsletter
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/white-label-einbinder/newsletter-opt-in
*/

class SiteoriginWlsNewsletter_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-newsletter',
			__('Newsletter', '5anker'),
			[
				'description' => __('Newsletter', '5anker'),
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
			'privacy' => [
				'type' => 'text',
				'label' => __('Privacy', '5anker'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-newsletter privacy="<?= $instance['privacy']; ?>"></wls-newsletter>
		<?php
	}
}

siteorigin_widget_register('wls-newsletter', __FILE__, 'SiteoriginWlsNewsletter_Widget');

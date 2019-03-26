<?php

/*
Widget Name: Connect: Search Form
Description: Search Form
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/suchleiste
*/

class SiteoriginWlsSearchForm_Widget extends SiteOrigin_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wls-search-form',
			__('Connect: Search Form', '5anker'),
			[
				'description' => __('Search Form', '5anker'),
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

			'fields' => [
				'type' => 'text',
				'label' => __('Fields', '5anker'),
				'default' => ''
			],

			'redirect' => [
				'type' => 'text',
				'label' => __('Redirect', '5anker'),
				'default' => ''
			],

			'class' => [
				'type' => 'text',
				'label' => __('Row Class', '5anker'),
				'default' => ''
			],
		];
	}

	public function get_html_content($instance, $args, $template_vars, $css_name)
	{
		?>
		<wls-search-form query="<?= $instance['query']; ?>" fields="<?= $instance['fields']; ?>" redirect="<?= $instance['redirect']; ?>" row-class="<?= $instance['class']; ?>"></wls-search-form>
		<?php
	}
}

siteorigin_widget_register('wls-search-form', __FILE__, 'SiteoriginWlsSearchForm_Widget');

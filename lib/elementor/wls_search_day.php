<?php

if (! defined('ABSPATH')) {
	exit;
}

class Anker_Connect_Elementor_Wls_SearchDay_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'wls-search-day';
	}

	public function get_title()
	{
		return __('Search Day', '5-anker-connect');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-search';
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__('Settings', '5-anker-connect'),
			]
		);

		$this->add_control(
			'query',
			[
				'label' => __('Query', '5-anker-connect'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5-anker-connect')
			]
		);

		$this->add_control(
			'fields',
			[
				'label' => __('Fields', '5-anker-connect'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5-anker-connect')
			]
		);

		$this->end_controls_section();
	}

	protected function render($instance = [])
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-search-day<?php echo !empty($settings['query']) ? " query=\"{$settings['query']}\"" : ''; ?><?php echo !empty($settings['fields']) ? " fields=\"{$settings['fields']}\"" : ''; ?>></wls-search-day>
		<?php
	}
}

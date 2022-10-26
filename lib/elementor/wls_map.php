<?php

if (! defined('ABSPATH')) {
	exit;
}

class Anker_Connect_Elementor_Wls_Map_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'wls-map';
	}

	public function get_title()
	{
		return __('Map', '5-anker-connect');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-map-o';
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
			'lat',
			[
				'label' => __('Latitude', '5-anker-connect'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5-anker-connect'),
			]
		);

		$this->add_control(
			'lng',
			[
				'label' => __('Longitude', '5-anker-connect'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5-anker-connect'),
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-map lat="<?php echo esc_attr($settings['lat'] ?? ''); ?>" lng="<?php echo esc_attr($settings['lng'] ?? ''); ?>"></wls-map>
		<?php
	}
}

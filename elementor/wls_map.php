<?php

namespace Elementor;

if (! defined('ABSPATH')) {
	exit;
}

class ElementorMap_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'wls-map';
	}

	public function get_title()
	{
		return __('Map', '5anker');
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
				'label' => esc_html__('Settings', '5anker'),
			]
		);

		$this->add_control(
			'lat',
			[
				'label' => __('Latitude', '5anker'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5anker'),
			]
		);

		$this->add_control(
			'lng',
			[
				'label' => __('Longitude', '5anker'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5anker'),
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-map lat="<?= $settings['lat'] ?? ''; ?>" lng="<?= $settings['lng'] ?? ''; ?>"></wls-map>
		<?php
	}
}

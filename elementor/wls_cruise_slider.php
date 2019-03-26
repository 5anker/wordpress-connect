<?php

namespace Elementor;

if (! defined('ABSPATH')) {
	exit;
}

class ElementorCruiseSlider extends Widget_Base
{
	public function get_name()
	{
		return 'wls-cruise-slider';
	}

	public function get_title()
	{
		return __('Cruise slider', '5anker');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-arrows-h';
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
			'query',
			[
				'label' => __('Query', '5anker'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5anker'),
				'section' => 'settings_section',
			]
		);

		$this->end_controls_section();
	}
	protected function render($instance = [])
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-cruise-slider query="<?= $settings['query'] ?? ''; ?>"></wls-cruise-slider>
		<?php
	}
}

<?php

namespace Elementor;

if (! defined('ABSPATH')) {
	exit;
}

class ElementorBoats_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'wls-boats';
	}

	public function get_title()
	{
		return __('Boats', 'anker-connect');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-ship';
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__('Settings', 'anker-connect'),
			]
		);

		$this->add_control(
			'query',
			[
				'label' => __('Query', 'anker-connect'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', 'anker-connect')
			]
		);

		$this->end_controls_section();
	}
	protected function render($instance = [])
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-boats query="<?= $settings['query'] ?? ''; ?>"></wls-boats>
		<?php
	}
}

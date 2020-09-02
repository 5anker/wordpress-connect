<?php

namespace Elementor;

if (! defined('ABSPATH')) {
	exit;
}

class ElementorMarina_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'wls-marina';
	}

	public function get_title()
	{
		return __('Marina', 'anker-connect');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-map-marker';
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
			'id',
			[
				'label' => __('ID', 'anker-connect'),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'title' => __('', 'anker-connect'),
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-marina id="<?= $settings['id'] ?? ''; ?>"></wls-marina>
		<?php
	}
}

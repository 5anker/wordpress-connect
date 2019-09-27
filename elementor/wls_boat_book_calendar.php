<?php

namespace Elementor;

if (! defined('ABSPATH')) {
	exit;
}

class ElementorBoatBookCalendar_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'wls-boat-book-calendar';
	}

	public function get_title()
	{
		return __('Boat Book Calendar', '5anker');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-calendar';
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
			'id',
			[
				'label' => __('ID', '5anker'),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'title' => __('', '5anker'),
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-boat-book-calendar id="<?= $settings['id'] ?? ''; ?>"></wls-boat-book-calendar>
		<?php
	}
}

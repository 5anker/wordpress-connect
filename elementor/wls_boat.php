<?php

namespace Elementor;

if (! defined('ABSPATH')) {
	exit;
}

class ElementorBoat extends Widget_Base
{
	public function get_name()
	{
		return 'wls-boat';
	}

	public function get_title()
	{
		return __('Boat', '5anker');
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
				'section' => 'settings_section'
			]
		);

		$this->add_control(
			'fields',
			[
				'label' => __('Fields', '5anker'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5anker'),
				'section' => 'settings_section'
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-boat id="<?= $settings['id'] ?? ''; ?>" fields="<?= $settings['fields'] ?? ''; ?>"></wls-boat>
		<?php
	}
}

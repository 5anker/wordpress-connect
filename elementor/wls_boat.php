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
			'sections',
			[
				'label' => __('Sections', '5anker'),
				'type' => Controls_Manager::TEXT,
				'default' => 'title,media,props,description,additional,availabilities,prices,infos,details,basement,sidebar,contact,alternatives',
				'title' => __('', '5anker'),
				'section' => 'settings_section'
			]
		);

		$this->add_control(
			'query',
			[
				'label' => __('Query', '5anker'),
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
		<wls-boat id="<?= $settings['id'] ?? ''; ?>" sections="<?= $settings['sections'] ?? ''; ?>" query="<?= $settings['query'] ?? ''; ?>"></wls-boat>
		<?php
	}
}

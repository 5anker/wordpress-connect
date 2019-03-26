<?php

namespace Elementor;

if (! defined('ABSPATH')) {
	exit;
}

class ElementorSearchForm extends Widget_Base
{
	public function get_name()
	{
		return 'wls-search-form';
	}

	public function get_title()
	{
		return __('Search form', '5anker');
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

		$this->add_control(
			'fields',
			[
				'label' => __('Fields', '5anker'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5anker'),
				'section' => 'settings_section',
			]
		);

		$this->add_control(
			'redirect',
			[
				'label' => __('Redirect', '5anker'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __('', '5anker'),
				'section' => 'settings_section',
			]
		);

		$this->add_control(
			'class',
			[
				'label' => __('Row class', '5anker'),
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
		<wls-search-form query="<?= $settings['query'] ?? ''; ?>" fields="<?= $settings['fields'] ?? ''; ?>" redirect="<?= $settings['redirect'] ?? ''; ?>" row-class="<?= $settings['class'] ?? ''; ?>"></wls-search-form>
		<?php
	}
}

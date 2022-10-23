<?php

if (! defined('ABSPATH')) {
	exit;
}

class Anker_Connect_Elementor_Wls_Boats_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'wls-boats';
	}

	public function get_title()
	{
		return __('Boats', '5-anker-connect');
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

		$this->end_controls_section();
	}
	protected function render($instance = [])
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-boats query="<?php echo $settings['query'] ?? ''; ?>"></wls-boats>
		<?php
	}
}

<?php

if (! defined('ABSPATH')) {
	exit;
}

class Anker_Connect_Elementor_Wls_Newsletter_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'wls-newsletter';
	}

	public function get_title()
	{
		return __('Newsletter', '5-anker-connect');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-envelope';
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
			'privacy',
			[
				'label' => __('Privacy', '5-anker-connect'),
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
		<wls-newsletter privacy="<?php echo $settings['privacy'] ?? ''; ?>"></wls-newsletter>
		<?php
	}
}

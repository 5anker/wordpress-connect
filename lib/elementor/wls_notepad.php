<?php

if (! defined('ABSPATH')) {
	exit;
}

class Anker_Connect_Elementor_Wls_Notepad_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'wls-notepad';
	}

	public function get_title()
	{
		return __('Notepad', '5-anker-connect');
	}

	public function get_categories()
	{
		return [ 'connect-wls' ];
	}

	public function get_icon()
	{
		return 'fa fa-list';
	}

	protected function _register_controls()
	{
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>
		<wls-notepad></wls-notepad>
		<?php
	}
}

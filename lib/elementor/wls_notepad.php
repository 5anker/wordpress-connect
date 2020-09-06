<?php

if (! defined('ABSPATH')) {
	exit;
}

class ElementorNotepad_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'wls-notepad';
	}

	public function get_title()
	{
		return __('Notepad', 'anker-connect');
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

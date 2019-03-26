<?php

if (! defined('ABSPATH')) {
	exit;
}

function add_elementor_widget_categories($elements_manager)
{
	$elements_manager->add_category(
		'connect-wls',
		[
			'title' => __('Connect', '5anker'),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');


class ElementorElements
{
	private static $instance = null;

	private $plugins = [
		'wls_boat' => 'Elementor\ElementorBoat',
		'wls_boats' => 'Elementor\ElementorBoats',
		'wls_boats_grid' => 'Elementor\ElementorBoatsGrid',
		'wls_boats_slider' => 'Elementor\ElementorBoatsSlider',
		'wls_search' => 'Elementor\ElementorSearch',
		'wls_cruise_slider' => 'Elementor\ElementorCruiseSlider',
		'wls_search_form' => 'Elementor\ElementorSearchForm',
		'wls_newsletter' => 'Elementor\ElementorNewsletter',
		'wls_contact_form' => 'Elementor\ElementorContactForm',
		'wls_boat_book_calendar' => 'Elementor\ElementorBoatBookCalendar',
		'wls_marinas' => 'Elementor\ElementorMarinas',
		'wls_marina' => 'Elementor\ElementorMarina',
		'wls_map' => 'Elementor\ElementorMap',
		'wls_notepad' => 'Elementor\ElementorNotepad',
	];

	public static function get_instance()
	{
		if (! self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function init()
	{
		add_action('elementor/init', [ $this, 'widgets_registered' ]);
	}

	public function widgets_registered()
	{
		if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
			if (class_exists('Elementor\Plugin')) {
				if (is_callable('Elementor\Plugin', 'instance')) {
					foreach ($this->plugins as $plugin => $pClass) {
						$elementor = Elementor\Plugin::instance();
						if (isset($elementor->widgets_manager)) {
							if (method_exists($elementor->widgets_manager, 'register_widget_type')) {
								$widget_file = 'plugins/connect/elementor/'.$plugin.'.php';
								$template_file = locate_template($widget_file);
								if (!$template_file || !is_readable($template_file)) {
									$template_file = plugin_dir_path(__FILE__).$plugin.'.php';
								}

								if ($template_file && is_readable($template_file)) {
									require_once $template_file;
									Elementor\Plugin::instance()->widgets_manager->register_widget_type(new $pClass());
								}
							}
						}
					}
				}
			}
		}
	}
}

ElementorElements::get_instance()->init();

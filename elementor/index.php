<?php

if (! defined('ABSPATH')) {
	exit;
}

add_action('elementor/elements/categories_registered', function ($elements_manager) {
	$elements_manager->add_category(
		'connect-wls',
		[
			'title' => __('Connect', '5anker'),
			'icon' => 'fa fa-plug',
		]
	);
});

add_action('elementor/widgets/widgets_registered', function () {
	$plugins = [
		'wls_boat' => 'Elementor\ElementorBoat_Widget',
		'wls_boats' => 'Elementor\ElementorBoats_Widget',
		'wls_boats_grid' => 'Elementor\ElementorBoatsGrid_Widget',
		'wls_boats_slider' => 'Elementor\ElementorBoatsSlider_Widget',
		'wls_search' => 'Elementor\ElementorSearch_Widget',
		'wls_search_day' => 'Elementor\ElementorSearchDay_Widget',
		'wls_cruise_slider' => 'Elementor\ElementorCruiseSlider_Widget',
		'wls_search_form' => 'Elementor\ElementorSearchForm_Widget',
		'wls_newsletter' => 'Elementor\ElementorNewsletter_Widget',
		'wls_contact_form' => 'Elementor\ElementorContactForm_Widget',
		'wls_boat_book_calendar' => 'Elementor\ElementorBoatBookCalendar_Widget',
		'wls_marinas' => 'Elementor\ElementorMarinas_Widget',
		'wls_marina' => 'Elementor\ElementorMarina_Widget',
		'wls_map' => 'Elementor\ElementorMap_Widget',
		'wls_notepad' => 'Elementor\ElementorNotepad_Widget',
		'wls_planbar_login' => 'Elementor\ElementorPlanbarLogin_Widget',
	];

	$elementor = Elementor\Plugin::instance();

	foreach ($plugins as $plugin => $pClass) {
		$widget_file = 'plugins/connect/elementor/'.$plugin.'.php';
		$template_file = locate_template($widget_file);

		if (!$template_file || !is_readable($template_file)) {
			$template_file = plugin_dir_path(__FILE__).$plugin.'.php';
		}

		if ($template_file && is_readable($template_file)) {
			require_once $template_file;

			$elementor->widgets_manager->register_widget_type(new $pClass);
		}
	}
});

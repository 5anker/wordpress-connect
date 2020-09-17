<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Anker_Connect_Elementor_Wls_Boat_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'wls-boat';
	}

	public function get_title() {
		return __( 'Boat', 'anker-connect' );
	}

	public function get_categories() {
		return [ 'connect-wls' ];
	}

	public function get_icon() {
		return 'fa fa-ship';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'anker-connect' ),
			]
		);

		$this->add_control(
			'id',
			[
				'label'   => __( 'ID', 'anker-connect' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
				'title'   => __( '', 'anker-connect' ),
			]
		);

		$this->add_control(
			'sections',
			[
				'label'   => __( 'Sections', 'anker-connect' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'title,media,props,description,additional,availabilities,prices,infos,details,basement,sidebar,contact,alternatives',
				'title'   => __( '', 'anker-connect' ),
			]
		);

		$this->add_control(
			'query',
			[
				'label'   => __( 'Query', 'anker-connect' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title'   => __( '', 'anker-connect' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
        <wls-boat
                id="<?= $settings['id'] ?? ''; ?>"<?= ! empty( $settings['sections'] ) ? " sections=\"{$settings['sections']}\"" : ''; ?><?= ! empty( $settings['query'] ) ? " query=\"{$settings['query']}\"" : ''; ?>></wls-boat>
		<?php
	}
}

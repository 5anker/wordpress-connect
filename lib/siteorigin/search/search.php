<?php

/*
Widget Name: Search
Description: Search
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
Documentation: https://docs.5-anker.com/white-label-einbinder/terminsuche
*/

class Anker_Connect_Wls_Search_Widget extends SiteOrigin_Widget {
	public function __construct() {
		parent::__construct(
			'wls-search',
			__( 'Search', '5-anker-connect' ),
			[
				'description' => __( 'Search', '5-anker-connect' ),
			],
			[
			],
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	public function get_widget_form() {
		return [
			'query' => [
				'type'    => 'text',
				'label'   => __( 'Query', '5-anker-connect' ),
				'default' => '',
                'placeholder' => 'group=auto'
			],
			'fields' => [
				'type'    => 'text',
				'label'   => __( 'Fields', '5-anker-connect' ),
				'default' => '',
			],
		];
	}

	public function get_html_content( $instance, $args, $template_vars, $css_name ) {
		?>
        <wls-search<?= ! empty( $instance['query'] ) ? " query=\"{$instance['query']}\"" : '' ?><?= ! empty( $instance['fields'] ) ? " fields=\"{$instance['fields']}\"" : '' ?>></wls-search>
		<?php
	}
}

siteorigin_widget_register( 'wls-search', __FILE__, 'Anker_Connect_Wls_Search_Widget' );

<?php

/*
Widget Name: Finder
Description: Finder
Author: 5 Anker GmbH
Version: 1.0
Author URI: https://www.5-anker.com
*/

class Anker_Connect_Wls_Finder extends SiteOrigin_Widget {
	public function __construct() {
		parent::__construct(
			'wls-finder',
			__( 'Finder', 'anker-connect' ),
			[
				'description' => __( 'Finder', 'anker-connect' ),
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
				'label'   => __( 'Query', 'anker-connect' ),
				'default' => 'group=auto'
			],
		];
	}

	public function get_html_content( $instance, $args, $template_vars, $css_name ) {
		?>
        <form style="display: flex; max-width: 500px; margin: 50px auto; align-items: center" role="search" method="GET"
              action="">
            <input class="form-control" value="<?= $_GET['term']; ?>"
                   placeholder="Suche (z.B. führerscheinfrei, Hund, Müritz)" name="term" type="text"
                   style="height: auto; padding: 10px 10px; margin-right: 1rem;">
            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
        </form>
        <wls-boats-grid query="<?= $instance['query'] ?? ''; ?>"></wls-boats-grid>
		<?php
	}
}

siteorigin_widget_register( 'wls-finder', __FILE__, 'Anker_Connect_Wls_Finder' );

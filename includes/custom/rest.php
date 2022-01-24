<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AnkerRest {
	public static function exec( $method, $url, $obj = [] ) {
		$settings = Anker_Connect::getOptions();
		$body     = [];

		switch ( $method ) {
			case 'DELETE':
			case 'GET':
				if ( strpos( $url, '?' ) === false && ! empty( $obj ) ) {
					$url .= '?' . http_build_query( $obj );
				}
				break;

			case 'POST':
			case 'PUT':
			default:
				$body = $obj;
		}

		$args = [
			'method'  => $method,
			'body'    => $body,
			'headers' => [
				'Authorization' => 'Bearer ' . $settings->private_token,
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
			],
		];

		$host = parse_url( $settings->endpoint ?: 'https://connect.5-anker.com/dnet/com/', PHP_URL_HOST );

		$response = wp_remote_request( 'https://' . $host . '/' . $url, $args );
		$body     = wp_remote_retrieve_body( $response );

		return json_decode( $body );
	}

	public static function get( $url, $obj = [] ) {
		return static::exec( 'GET', $url, $obj );
	}

	public static function post( $url, $obj = [] ) {
		return static::exec( 'POST', $url, $obj );
	}

	public static function put( $url, $obj = [] ) {
		return static::exec( 'PUT', $url, $obj );
	}

	public function delete( $url, $obj = [] ) {
		return static::exec( 'DELETE', $url, $obj );
	}
}

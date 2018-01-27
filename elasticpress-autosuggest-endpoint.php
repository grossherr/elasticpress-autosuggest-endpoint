<?php
/*
 Plugin Name:  Elasticpress Autosuggest Endpoint
 Plugin URI:   https://github.com/grossherr/elasticpress-autosuggest-endpoint
 Description:  Basic WordPress Plugin Header Comment
 Version:      0.3
 Author:       Nicolai
 Author URI:   https://ngcorp.de/
 License:      GPL2
 License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Load Elasticseach PHP Client
 */
require 'vendor/autoload.php';

/**
 * Init Elasticsearch PHP Client
 */
use Elasticsearch\ClientBuilder;

/**
 * Register Elasticpress Autosuggest Endpoint
 */
add_action( 'rest_api_init', function() {
	register_rest_route( 'elasticpress', '/autosuggest/', [
		'methods' => \WP_REST_Server::CREATABLE,
		'callback' => 'ep_autosuggest',
	] );
} );

/**
 * Elasticpress Autosuggest Endpoint Callback
 *
 * @param \WP_REST_Request $data
 * @return array|callable
 */
function ep_autosuggest( \WP_REST_Request $data ) {
	$client = ClientBuilder::create()->build();
	$params = [
		'index' => 'index',
		'type' => 'post',
		'body' => $data->get_body()
	];
	$response = $client->search( $params );
	return $response;
}
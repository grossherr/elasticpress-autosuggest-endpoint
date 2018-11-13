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
 *
 * This is the endpoint you have to specify in the admin
 * like this: http(s)://domain.com/wp-json/elasticpress/autosuggest/
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
 * gets host and index name dynamically. Otherwise,
 * if not specified, host would default to localhost:9200
 * and index name would default to 'index'
 *
 * @param \WP_REST_Request $data
 * @return array|callable
 */
function ep_autosuggest( \WP_REST_Request $data ) {
    $client = ClientBuilder::create();
    $client->setHosts([ep_get_host()]); // get host dynamically
    $client = $client->build();
    $params = [
        'index' => ep_get_index_name(), // get index dynamically
        'type' => 'post',
        'body' => $data->get_body()
    ];
    $response = $client->search( $params );
    return $response;
}
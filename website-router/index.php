<?php
/**
 * Load our application by setting some constants
 * and requiring necessary files
 */

// the absolute directory path to this file
define( 'APP_PATH', dirname( __FILE__ ) );

// general catch-all file for functions
require_once( APP_PATH . '/functions.php' );

/**
 * Handle the visitor's request for a route as determined by the url
 */
// look for a page request, else load the home page content
$route = get_route();

// get the HTML output for this fully executed route
$output = execute_route( $route );

// deliver the HTML response to the visitor's browser
print $output;

// we're done here
exit;
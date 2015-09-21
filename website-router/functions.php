<?php

/**
 * Determine the route as requested by the visitor
 * 
 * @return string
 */
function get_route(){
	// default to the home page
	$route = 'home';
	
	if ( isset( $_GET['page'] ) ) {
		$route = $_GET['page'];
	}
	
	return $route;
}

/**
 * Get the data associated with the route, and prepare output.
 * 
 * @param $route
 * @return string
 */
function execute_route( $route ){
	// retrieve data about the route by executing the page-data
	//  ['page_title']
	//  ['page_content']
	$page_data = get_route_data( $route );

	// include the page wrapper template and pass along our
	// route-determined page_data
	$output = template( 'page-wrapper', $page_data );
	
	// return the completed route output to the caller
	return $output;
}

/**
 * Convert $_GET['page'] value into a predictable filename,
 * and include that file if found.
 *
 * @param $path
 * @return array
 */
function get_route_data( $path ){
	$file_path = APP_PATH . '/page-data/' . $path . '.php';

	// buffer the following output so it can be returned to the caller as data
	ob_start();
	
	// provide a variable within scope for the included file to override
	$page_title = '';
	
	if ( file_exists( $file_path ) ) {
		// if the file exists, execute it
		include_once( $file_path );
	}
	else {
		// if the file doesn't exist, show a 404 page
		include_once( APP_PATH . '/page-data/404.php' );
	}
	
	// retrieve the contents of the output buffer, and clear from memory
	$page_content = ob_get_clean();
	
	// prepare an array with expected keys of page_title and page_content
	$page_data = array(
		'page_title' => $page_title,
		'page_content' => $page_content
	);
	
	return $page_data;
}

/**
 * Include a template file if found, and bring template_variables into scope
 *
 * @param $template_name
 * @param $template_variables
 * @return string
 */
function template( $template_name, $template_variables ){
	// create a controlled path to the template 
	$template_path = APP_PATH . "/templates/$template_name.php";

	// buffer the output for maximum control!!!
	ob_start();
	
	// if the template file is found, extract template_variables into scope
	// and include the file
	if ( file_exists( $template_path ) ) {
		extract( $template_variables );
		include $template_path;
	}
	
	return ob_get_clean();
}
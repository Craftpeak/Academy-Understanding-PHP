<?php

define( 'APP_TEMPLATES', dirname( __DIR__ ) . '/templates' );

/**
 * Include the page header
 */
function get_header(){
	global $page_title;
	include_once APP_TEMPLATES. "/header.php";
}

/**
 * Include the page sidebar
 */
function get_sidebar(){
	include_once APP_TEMPLATES. "/sidebar.php";
}

/**
 * Include the page footer
 */
function get_footer(){
	include_once APP_TEMPLATES. "/footer.php";
}

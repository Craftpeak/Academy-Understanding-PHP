<?php
// show errors
error_reporting(E_ALL);
ini_set( 'display_errors', 'on' );

// run the function that handles form submissions
do_form_submission();

/**
 * Execution of the form submission
 */
function do_form_submission() {
	// make sure some data was send via appropriate request method 
	if ( !empty( $_POST ) ) {
		// ensure that our data array has expected keys
		$data = normalize_submission_data( $_POST );
		
		// clean up data by removing potential malicious code
		$data = array_map( 'sanitize_text', $data );
		
		// determine if our remaining data meets our minimum standards
		$valid = validate_submission_data( $data );
	
		// step 1: test to see if the submitted data is valid
		if ( $valid ) {
			// step 2: attempt to send the email.
			// $success will be true if the email sent, and false if it did not
			$success = send_submission_email( $data );
	
			// handle the result of our attempt 
			if ( $success ) {
				// result was true, go to thankyou page
				redirect_to( 'thankyou.html' );
			}
			else {
				// result was false, go to error page
				redirect_to( 'error.html' );
			}
		}
		else {
			// to submitted data is not valid, go to error page
			redirect_to( 'error.html' );
		}
	}
	else {
		// no request information, go to home
		redirect_to( 'index.html' );
	}
}

/**
 * Set default values for expected keys in the array so that we don't have to
 * check for their existence throughout the rest of the program execution.
 * 
 * @param $submitted_data
 * @return array
 */
function normalize_submission_data( $submitted_data ){
	// create an array that sets the expected submitted data array keys
	// and their default values.
	$default_data = array(
		'name' => '',
		'email' => '',
		'comment' => '',
	);
	
	// replace default values with submitted values to create a new array that
	// has a combination of the two
	$normalized_data = array_replace( $default_data, $submitted_data );
	
	return $normalized_data;
}

/**
 * Simple string sanitation function
 *
 * @param $text - arbitrary string
 * @return string - sanitized string
 */
function sanitize_text( $text ){
	$sanitized =  strip_tags( $text );
	
	return $sanitized;
}

/**
 * Validate the submission data by ensure required data exists and is in the 
 * desired format.
 * 
 * @param $data - data array to validate based on expectations
 * @return bool - whether or not the data validated
 */
function validate_submission_data( $data ){
	// name must not be empty
	if ( empty( $data['name'] ) ) {
		return false;
	}
	
	// email must not be empty, nor invalid
	if ( empty( $data['email'] ) || !is_valid_email( $data['email'] ) ) {
		return false;
	}
	
	// comment must not be empty
	if ( empty( $data['comment'] ) ) {
		return false;
	}
	
	return true;
}

/**
 * Simple validation function using filter_var()
 *
 * @param $email
 * @return bool
 */
function is_valid_email( $email ){
	$valid = filter_var( $email, FILTER_VALIDATE_EMAIL );
	return $valid;
}

/**
 * Prepare date required for sending an email, and attempt to send it.
 * 
 * @param $data
 * @return bool
 */
function send_submission_email( $data ){
	// prepare other required email data
	$to = 'jonathan@daggerhart.com';
	$subject = "New contact form submission from {$data['name']}";
	$message = "{$data['comment']} \n\nFrom: {$data['name']} - {$data['email']}";

	// try to send the email
	$success = mail( $to, $subject, $message );
	
	return $success;
}

/**
 * Simple redirect function using header()
 *
 * @param $location
 */
function redirect_to( $location ){
	header('Location: ' . urlencode( $location ) );
	exit;
}

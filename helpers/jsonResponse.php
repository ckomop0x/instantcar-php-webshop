<?php
/**
 * API response
 * @param null $message
 * @param int  $code
 *
 * @return string
 */
function jsonResponse($message = null, $code = 200) {
	// clear the old headers
	header_remove();

	// set the actual code
	http_response_code($code);

	// set the header to make sure cache is forced
	header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");

	// treat this as json
	header('Content-Type: application/json');
	$status = array(
		200 => '200 OK',
		400 => '400 Bad Request',
		422 => 'Unprocessable Entity',
		500 => '500 Internal Server Error'
	);

	// ok, validation error, or failure
	header('Status: '.$status[$code]);
	return json_encode(array(
		'status' => $code < 300, // success or not?
		'message' => $message
	));
}
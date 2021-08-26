<?php

/* ------------------------------- \
 * Script Bootstrapping
 \-------------------------------- */
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
# * - Request Permissions
header( 'Access-Control-Allow-Origin: *' );
# * - Date and Timezone
date_default_timezone_set( 'Asia/Kolkata' );
# * - Prevent Script Cancellation by Client
ignore_user_abort( true );
# * - Script Timeout
set_time_limit( 0 );



/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );



/* ------------------------------- \
 * Request Parsing
 \-------------------------------- */
# Get JSON as a string
$json = file_get_contents( 'php://input' );
# Convert the JSON string to an object
$error = null;
try {
	$input = json_decode( $json, true );
	if ( empty( $input ) )
		throw new \Exception( "No data provided." );

	$input = $input[ 'data' ];
}
catch ( \Exception $e ) {
	$error = $e->getMessage();
}
if ( ! empty( $error ) ) {

/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );
	http_response_code( 400 );
	echo json_encode( [
		'code' => 400,
		'message' => 'Data not provided'
	] );
	exit;
}



/* ------------------------------------- \
 * Data Validation
 \-------------------------------------- */
if ( empty( $input[ 'name' ] ) or empty( $input[ 'emailAddress' ] ) ) {
	http_response_code( 400 );
	echo json_encode( [
		'code' => 400,
		'message' => 'Data not provided'
	] );
	exit;
}



// /* ------------------------------------- \
//  * Pull in the dependencies
//  \-------------------------------------- */
require_once __DIR__ . '/../../conf.php';
require_once __DIR__ . '/../../inc/utils.php';
require_once __DIR__ . '/../../inc/cms.php';
require_once __DIR__ . '/../google-forms.php';
require_once __DIR__ . '/../mailer.php';

use BFS\CMS;
if ( CMS_ENABLED )
	CMS::setupContext();






/* ------------------------------------- \
 * Interpret the data
 \-------------------------------------- */
// $when = CFD\DateTime::getSpreadsheetDateFromISO8601( $input[ 'when' ] );
$nameOfPerson = $input[ 'name' ];
$emailAddress = $input[ 'emailAddress' ];
$phoneNumber = $input[ 'phoneNumber' ] ?? '';
$institution = $input[ 'institution' ] ?? '';
$programId = (int) ( $input[ 'programId' ] ?? '' );
$program = $input[ 'program' ] ?? '';
$date = $input[ 'date' ] ?? '';



/* ------------------------------------- \
 * Add Enquiry record to the database
 \-------------------------------------- */
# Create the post
$enquiryId = wp_insert_post( [
	'post_type' => 'enquiries',
	'post_title' => wp_strip_all_tags( $nameOfPerson ),
	'post_content' => '',
	'post_author' => 1,
	'post_status' => 'publish'
] );

# Now, set the individual fields
update_field( 'email', $emailAddress, $enquiryId );
update_field( 'phone', $phoneNumber, $enquiryId );
update_field( 'institute', $institution, $enquiryId );
update_field( 'program', $program, $enquiryId );
update_field( 'for', $date, $enquiryId );
update_field( 'status', 'Pending', $enquiryId );



/* ------------------------------------- \
 * Ingest the data onto the Spreadsheet
 \-------------------------------------- */
$data = [
	// 'when' => $when,
	'name' => $nameOfPerson,
	'emailAddress' => $emailAddress,
	'phoneNumber' => $phoneNumber,
	'institution' => $institution,
	'program' => $program,
	'date' => $date
];

// Submit data to the spreadsheet
GoogleForms\submitEnquiry( $data );



/* ------------------------------------- \
 * Send the lead an electronic mail
 \-------------------------------------- */
$mailer = new Mailer();
$mailer->setFrom( 'tours@immersionindia.com', 'ImmersionIndia' );
$mailer->addRecipient( $emailAddress );
$mailer->setSubject( 'Thank you for your enquiry.' );

	// Build the full host domain URL
if ( HTTPS_SUPPORT )
	$httpProtocol = 'https';
else
	$httpProtocol = 'http';
$hostName = $_SERVER[ 'HTTP_HOST' ] ?: $_SERVER[ 'SERVER_NAME' ];
$mailData = [
	'hostDomainURL' => $httpProtocol . '://' . $hostName,
	'name' => $nameOfPerson,
	'emailAddress' => $emailAddress,
	'phoneNumber' => $phoneNumber,
	'institution' => $institution,
	'programId' => $programId,
	'program' => $program,
	'date' => $date
];
$mailer->setBody( __DIR__ . '/../../pages/enquiry-mail.php', $mailData );
try {
	$mailer->send();
}
catch ( \Exception $e ) {
	http_response_code( 500 );
	echo json_encode( [
		'code' => 500,
		'message' => 'The mail could not be sent.',
		'data' => $e->getMessage()
	] );
	exit;
}



/* ------------------------------- \
 * Respond back to the client
 \-------------------------------- */
http_response_code( 200 );
echo json_encode( [
	'code' => 200,
	'message' => 'Enquiry processed successfully.'
] );


$( function () {





/*
 |
 | Set up the Program Booking form
 |
 */
var programBookingForm = new window.__BFS.exports.BFSForm( ".js_program_booking_form" );
	// var domInputName = document.getElementById( "js_form_input_name" );
	// var domInputEmail = document.getElementById( "js_form_input_email" );
	// var domInputPhoneNumber = document.getElementById( "js_form_input_phone" );
	// var domInputInstitution = document.getElementById( "js_form_input_institution" );
	// var domInputProgramId = document.getElementById( "js_form_input_program_id" );
	// var domInputProgram = document.getElementById( "js_form_input_program" );
	// var domInputDate = document.getElementById( "js_form_input_date" );

// Synchronise the program id with the selected program
$( ".js_form_input_program" ).on( "change", function ( event ) {
	var programId = $( event.target ).closest( "select" ).find( ":selected" ).attr( "id" );
	// domInputProgramId.value = programId;
	programBookingForm.fields[ "programId" ].set( programId )
} );

// Set up the enquiry form's input fields, data validators and data assemblers
	// Name
programBookingForm.addField( "name", ".js_form_input_name", function ( values ) {
	var name = values[ 0 ].trim();

	if ( name === "" )
		throw new Error( "Please provide your name." );

	if ( name.match( /\d/ ) )
		throw new Error( "Please provide a valid name." );

	return name;
} );

	// Email address
programBookingForm.addField( "emailAddress", ".js_form_input_email", function ( values ) {
	var emailAddress = values[ 0 ].trim();

	if ( emailAddress === "" )
		throw new Error( "Please provide your email address." );

	if ( emailAddress.indexOf( "@" ) === -1 )
		throw new Error( "Please provide a valid email address." );

	return emailAddress;
} );

	// Phone number
programBookingForm.addField( "phoneNumber", ".js_form_input_phone", function ( values ) {
	var phoneNumber = values[ 0 ].trim();

	if ( phoneNumber.length > 1 )
		if ( ! (
			phoneNumber.match( /^\+?\d[\d\-]+\d$/ )	// this is not a perfect regex, but it's close
			&& phoneNumber.replace( /\D/g, "" ).length > 3
		) )
			throw new Error( "Please provide a valid phone number." );

	return phoneNumber;
} );

	// College / University
programBookingForm.addField( "institution", ".js_form_input_institution", function ( values ) {
	var institution = values[ 0 ].trim();

	if ( institution.length > 1 )
		if ( institution.replace( /[\d\s]/g ).length < 2 )
			throw new Error( "Please provide a college or university." );

	return institution;
} );

	// Study Program Id
programBookingForm.addField( "programId", ".js_form_input_program_id", function ( values ) {
	var programId = values[ 0 ].trim();
	return programId;
} );

	// Study Program
programBookingForm.addField( "program", ".js_form_input_program", function ( values ) {
	var program = values[ 0 ];
	program = typeof program === "string" ? program.trim() : ""
	return program;
} );

	// Date
programBookingForm.addField( "date", ".js_form_input_date", function ( values ) {
	var date = values[ 0 ];
	date = typeof date === "string" ? date.trim() : ""
	return date;
} );

programBookingForm.submit = function submit () {

	var url = "/server/api/post-enquiry-data.php";

	var ajaxRequest = $.ajax( {
		url: url,
		method: "POST",
		data: JSON.stringify( { data: this.data } ),
		contentType: "application/json",
		dataType: "json",
		// xhrFields: {
		// 	withCredentials: true
		// }
	} );

	return new Promise( function ( resolve, reject ) {
		ajaxRequest.done( function ( response ) {
			resolve( response );
		} );
		ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
			var errorResponse = BFSForm.getErrorResponse( jqXHR, textStatus, e );
			reject( errorResponse );
		} );
	} );

}




/*
 * ----- Enquiry Form submission handler
 */
$( document ).on( "submit", ".js_program_booking_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	programBookingForm.disable();

	/*
	 * ----- Provide feedback to the user
	 */
	programBookingForm.giveFeedback( "Sending..." );

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = programBookingForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		programBookingForm.setSubmitButtonLabel()
		programBookingForm.enable()
		programBookingForm.fields[ error.fieldName ].focus()
		return;
	}

	/*
	 * ----- Submit data
	 */
	programBookingForm.submit( data )
		.then( function ( response ) {
			console.log( response )

			/*
			 * ----- Provide further feedback to the user
			 */
			programBookingForm.giveFeedback( "We'll get in touch shortly" );

		} )

} );





} )

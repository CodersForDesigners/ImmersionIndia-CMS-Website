
/*
 *
 * ----- Programs
 *
 */

$( function () {

	/*
	 * ----- Filter the programs on interacting with the filter
	 */
	var $allPrograms = $( ".js_program" );
	$( document ).on( "change", ".js_program_filter", function ( event ) {
		var programType = $( event.target ).val()
		$allPrograms.filter( ":not( [ data-program-type = '" + programType + "' ] )" ).hide()
		$allPrograms.filter( "[ data-program-type = '" + programType + "' ]" ).show()

		// Set the filter status message
		var formattedProgramType = programType[ 0 ].toUpperCase() + programType.slice( 1 ) + " Series";
		$( ".js_program_filter_status_message" ).html( "Filtered by: <b>" + formattedProgramType + "</b>" )
	} );

	/*
	 * ----- On clicking "Customize this Program" against a Program, navigate to the Enquiry Form and auto-select the program
	 */
	var domProgramInput = document.getElementById( "js_form_input_program" );
	var $programInput = $( domProgramInput );
	$( document ).on( "click", ".js_select_program", function ( event ) {
		event.preventDefault();

		// Get and Set the program on the Program input field
		var programId = $( event.target ).data( "program-id" );
		var value = $programInput.find( "#" + programId ).attr( "value" );
		domProgramInput.value = value;
			// So that all the other attached event handlers fire
		$programInput.trigger( "change" );

		// Scroll to the form
		smoothScrollTo( "section-booking" );
	} );

} );


/*
 |
 | Program Filtration
 |
 */
$( function () {



/*
 | Set up a Program Filtration abstraction
 */
class ProgramFiltration {
	constructor ( domSectionNode ) {
		this.$context = domSectionNode ? $( domSectionNode ) : $( document )
		this.$status = this.$context.find( ".js_program_filter_status_message" )
		this.initialStatus = this.$status.data( "text-initial" )

		// Set the initial filtration status
		this.setStatus()

		// When the filters are changed,
			// 1. show the programs that match the filter
			// 2. update the filtration status message
		$( this.$context ).on( "change", ".js_program_filter", event => {
			this.filterPrograms()
			this.setStatus()
		} )
	}
	getDOMFilters () {
		if ( ! this.domFilters )
			this.domFilters = [ ...this.$context.find( ".js_program_filter" ) ]
		return this.domFilters
	}
	getSelectedDOMFilters () {
		return this.getDOMFilters()
			.filter( domFilter => domFilter.checked )
	}
	getSelectedFilterNames () {
		return this.getSelectedDOMFilters()
			.map( domFilter => domFilter.dataset.label )
	}
	filterPrograms () {
		let filterQuerySelector
		if ( this.getSelectedDOMFilters().length === 0 )
			filterQuerySelector = ".js_program"
		else
			filterQuerySelector = this.getSelectedFilterNames()
				.map( n => `[ data-category = '${n.toLowerCase()}' ]` )
				.join( ", " )

		this.$context.find( ".js_program" ).hide()
		this.$context.find( filterQuerySelector ).show()
	}
	setStatus () {
		let statusMessage
		if ( this.getSelectedDOMFilters().length === 0 )
			statusMessage = this.initialStatus
		else
			statusMessage = `Filtered by: <b>${ this.getSelectedFilterNames().join( ", " ) }</b>`

		this.$status.html( statusMessage )
	}
}



// Instantiate the program filters
$( ".js_program_section" ).each( function ( _i, el ) {
	new ProgramFiltration( el )
} )



} )

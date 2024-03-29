<?php
/*
 |
 | Program Booking section
 |
 */
namespace BFS\UI;

function programBooking ( $programs ) {
?>
<!-- Booking Section -->
<section class="booking-section space-100-top-bottom fill-neutral-1" id="section-booking" data-section-title="Booking Section" data-section-slug="booking-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="h2 text-uppercase space-min-bottom">Customize Your Program</div>
				<div class="row">
					<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-pink"></span></div>
					<div class="form columns small-12 large-10">
						<!-- Form -->
						<form class="row space-50-bottom js_program_booking_form">
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase required">Full Name</span>
									<input type="text" class="block js_form_input_name" required>
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase required">Email ID</span>
									<input type="text" class="block js_form_input_email" required>
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">Phone Number</span>
									<input type="text" class="block js_form_input_phone">
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">College/University</span>
									<input type="text" class="block js_form_input_institution">
								</label>
							</div>
							<!-- Program Type Selector-->
							<div class="form-row columns small-12 space-min-bottom" style="padding-right: 0;">
								<div class="program-selector row">
									<label class="columns small-12 space-min-bottom block">
										<span class="label strong text-uppercase">Type of Program</span>
									</label>
									<label class="travel columns small-6 space-min-bottom space-min-right inline">
										<input class="visuallyhidden js_program_type_toggle" type="radio" name="program-toggle" value="Travel">
										<span class="button block fill-pink"><span class="check"></span>Travel Series</span>
									</label>
									<label class="virtual columns small-6 space-min-bottom space-min-left inline">
										<input class="visuallyhidden js_program_type_toggle" type="radio" name="program-toggle" value="Virtual">
										<span class="button block fill-teal"><span class="check"></span>Virtual Series</span>
									</label>
								</div>
							</div>
							<div class="form-row columns small-12">
								<!-- Empty Slot -->
							</div>
							<!-- END: Program Type Selector-->
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">Choose a Program</span>
									<input type="hidden" class="js_form_input_program_id" name="program-id">
									<select class="block js_form_input_program">
										<option value="" disabled selected>-- Select Program --</option>
										<?php foreach ( $programs as $program ) : ?>
											<option id="<?= $program->get( 'ID' ) ?>" value="<?= $program->get( 'type' ) ?>: <?= $program->get( 'subject' ) ?>"><?= $program->get( 'subject' ) ?> [ <?= $program->get( 'post_title' ) ?> ]</option>
										<?php endforeach; ?>
									</select>
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">Suggest a Date</span>
									<input type="date" class="block js_form_input_date">
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<!-- Empty Slot -->
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase invisible">Submit</span>
									<button class="block fill-pink" type="submit">Submit</button>
								</label>
							</div>
						</form>
						<!-- END: Form -->
						<div class="email-action">
							<a href="mailto:experiences@immersionindia.com" target="_blank" class="block fill-neutral-2 space-50" tabindex="-1">
								<div class="icon inline-bottom space-25-right">
									<img class="block" src="../media/icon/icon-email-color.svg<?= $ver ?>">
								</div>
								<div class="inline-bottom">
									<div class="h5 text-neutral-4">or, drop us an email at…</div>
									<div class="email-id h3 strong text-pink w-400" style="letter-spacing: 0.05rem;"><span class="text-underline">experiences</span><span class="w-500">@</span>immersionindia.com</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
( function () {

	window.__BFS = window.__BFS || { }
	window.__BFS.UI = window.__BFS.UI || { }
	window.__BFS.UI.programBookingForm = {
		allPrograms: [ <?= implode( ',', array_map( function ( $p ) { return $p->getJSON(); }, $programs ) ) ?> ]
	}

	$( ".js_program_booking_form" ).on( "change", ".js_program_type_toggle", function ( event ) {
		let programType = event.target.value
		let programsOfSelectedType = window.__BFS.UI.programBookingForm.allPrograms.filter( p => p.type === programType )
		let $programSelectorFormInput = $( ".js_form_input_program" )
		let $defaultOption = $programSelectorFormInput.find( "option:disabled" )

		// Remove the existing program options
		let $currentOptions = $programSelectorFormInput.find( "option:not(:disabled)" )
		$currentOptions.remove()

		// Select the default disabled option
		$defaultOption.prop( "selected", true )

		// Populate the selector input with programs from the selected type
		let newOptionsString = programsOfSelectedType.map( createProgramOptionMarkup )
		$programSelectorFormInput.append( newOptionsString )

	} )

	if ( window.__BFS.env && window.__BFS.env.programId ) {
		$( `.js_program_type_toggle[ value = "${ window.__BFS.env.programType }" ]` ).click()
		$( `#${ window.__BFS.env.programId }` ).prop( "selected", true )
	}
	else
		$( ".js_program_type_toggle" ).first().click()

	function createProgramOptionMarkup ( program ) {
		return `<option id="${ program.ID }" value="${ program.type }: ${ program.subject }">${ program.subject } [ ${ program.post_title } ]</option>`
	}

}() )
</script>
<!-- END: Booking Section -->
<?php
}

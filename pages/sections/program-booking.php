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
						<form class="row space-50-bottom js_enquiry_form">
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase required">Full Name</span>
									<input type="text" id="js_form_input_name" class="block" required>
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase required">Email ID</span>
									<input type="text" id="js_form_input_email" class="block" required>
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">Phone Number</span>
									<input type="text" id="js_form_input_phone" class="block">
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">College/University</span>
									<input type="text" id="js_form_input_institution" class="block">
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">Choose a Program</span>
									<input type="hidden" id="js_form_input_program_id" name="program-id">
									<select class="block" id="js_form_input_program">
										<option value="" disabled selected>-- Select Program --</option>
										<?php foreach ( $programs as $program ) : ?>
											<option id="<?= $program->get( 'ID' ) ?>" value="<?= $program->get( 'type' ) ?>: <?= $program->get( 'subject' ) ?>"><?= $program->get( 'type' ) ?>: <?= $program->get( 'subject' ) ?> [ <?= $program->get( 'title' ) ?> ]</option>
										<?php endforeach; ?>
									</select>
								</label>
							</div>
							<div class="form-row columns small-12 medium-6 space-min-bottom">
								<label>
									<span class="label strong text-uppercase">Suggest a Date</span>
									<input type="date" id="js_form_input_date" class="block">
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
<!-- END: Booking Section -->
<?php
}
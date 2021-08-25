<?php
/**
 * The template for displaying the footer
 *
 */

use BFS\CMS;

if ( ! isset( $navigationMenuItems ) )
	$navigationMenuItems = CMS::getNavigation( 'Main' );

?>

		<!-- Footer Section -->
		<section class="footer-section space-100-top-bottom fill-black" id="footer-section" data-section-title="Footer Section" data-section-slug="footer-section">
			<div class="container">
				<div class="row">
					<div class="columns small-12 medium-10 medium-offset-1">
						<div class="h2 text-uppercase space-min-bottom">Quick Links</div>
						<div class="row">
							<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-orange"></span></div>
							<div class="content columns small-12 large-10">
								<div class="links row">
									<div class="columns small-12 medium-6">
										<?php foreach ( $navigationMenuItems as $item ) : ?>
											<div class="p w-500 space-min-bottom <?= $item[ 'classes' ] ?>"><a href="<?= $item[ 'url' ] ?>" tabindex="-1" class="link line-height-small"><span class="l"><?= $item[ 'title' ] ?></span></a></div>
										<?php endforeach; ?>
									</div>
									<div class="columns small-12 medium-6 xlarge-5">
										<div class="p space-min-bottom"><a target="_blank" href="tel:+919591658632" tabindex="-1" class="link line-height-small" style="line-height: .85"><img class="icon" src="/media/icon/icon-phone.svg<?= $ver ?>"><span class="inline-top"><span class="l">+91 95916 58632</span><br><span class="small opacity-50">Also on WhatsApp & FaceTime.</span></span></a></div>
										<div class="p space-min-bottom"><a target="_blank" href="https://in.linkedin.com/company/immersion-india" tabindex="-1" class="link line-height-small"><img class="icon" src="/media/icon/icon-linkedin.svg<?= $ver ?>"><span class="l">Connect on LinkedIn</span></a></div>
										<div class="p space-min-bottom"><a target="_blank" href="mailto:experiences@immersionindia.com" tabindex="-1" class="link line-height-small"><img class="icon" src="/media/icon/icon-email.svg<?= $ver ?>"><span class="l">experiences@immersionindia.com</span></a></div>
										<div class="p space-min-bottom"><a target="_blank" href="https://g.page/immersion-india?share" tabindex="-1" class="link line-height-small"><img class="icon" src="/media/icon/icon-gmaps.svg<?= $ver ?>"><span class="l">Immersion India</span></a></div>
										<div class="p space-25-top-bottom"><a href="/" tabindex="-1" class="link line-height-small"><img src="../media/logo-immersion-light.svg<?= $ver ?>"></a></div>
										<div class="p space-min-bottom"><span class="opacity-50">303, Milwaukee, 40 Promenade Road, Frazer Town. Bangalore—560005. Karnataka. India.</span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Footer Section -->


	</div> <!-- END : Page Content -->


	<!-- Lazaro Signature -->
	<?php lazaro_signature(); ?>
	<!-- END : Lazaro Signature -->

</div><!-- END : Page Wrapper -->

<?php require_once __ROOT__ . '/inc/modals.php' ?>
<!--  ☠  MARKUP ENDS HERE  ☠  -->

<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<?php echo lazaro_disclaimer(); ?>
<?php endif; ?>

<!-- JS Modules -->
<script type="text/javascript" src="/js/modules/utils.js<?php echo $ver ?>"></script>
<!-- <script type="text/javascript" src="/js/modules/device-charge.js<?php echo $ver ?>"></script> -->
<script type="text/javascript" src="/js/modules/modal_box.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/navigation.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/video_embed.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/plugins/cd-headline/js/main.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/carousel.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/form.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/program-booking-form.js<?php echo $ver ?>"></script>
<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<script type="text/javascript" src="/js/modules/disclaimer.js<?php echo $ver ?>"></script>
<?php endif; ?>
<!-- Slick Carousel -->
<script type="text/javascript" src="/plugins/slick/slick.min.js<?php echo $ver ?>"></script>

<script type="text/javascript" src="/js/programs.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/articles.js<?php echo $ver ?>"></script>

<script type="text/javascript">

	$( function () {

	/*
	 * Slick Slide Gallery
	 */

		$('.slide-gallery').slick({
			autoplay: true,
			arrows: true,
			dots: true,
			infinite: true,
			speed: 800,
			autoplaySpeed: 3000,
			slidesToShow: 1,
			adaptiveHeight: true
		});


		var galleryBlockCarousel = $('.blocks-gallery-grid').slick({
			arrows: true,
			dots: false,
			infinite: true,
			speed: 800,
			autoplaySpeed: 3000,
			slidesToShow: 1,
			centerMode: true,
			variableWidth: true,
			lazyLoad: 'ondemand'
		});
		setTimeout( function () {
			galleryBlockCarousel.slick( 'slickNext' );
		}, 150 );


	} );

</script>

<?php if ( CMS::$isEnabled and ! CMS::$onlySetupContext ) wp_footer() ?>

<?= CMS::get( 'arbitrary_code / before_body_closing' ) ?>

</body>

</html>

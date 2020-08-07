<?php
/*
 *
 * This is a sample page you can copy and use as boilerplate for any new page.
 *
 */

require_once __DIR__ . '/../inc/above.php';


/*
 * ----- Fallback Images
 */
$heroVideoFallbackImage = getContent( '', 'home_landing_video_fallback_image -> sizes -> large' );
$thumbnailFallbackImage = getContent( '', 'list_item_thumbnail_fallback_image -> sizes -> small' );



/*
 * ----- Fact Slides
 */
$slideGallery = [ ];
$slidePosts = getPostsOf( 'slides' );
foreach ( $slidePosts as $slide ) {
	$caption = getContent( '', 'caption', $slide[ 'ID' ] );
	$imageData = getContent( '', 'image', $slide[ 'ID' ] );
	if (
		empty( $caption )
		or empty( $imageData )
		or empty( $imageData[ 'sizes' ] )
	)
		continue;

	$imageVersions = array_values( $imageData[ 'sizes' ] );
	$urls = [ ];
	for ( $_i = 0; $_i < count( $imageVersions ) / 3; $_i += 1 )
		$urls[ ] = $imageVersions[ $_i * 3 ] . ' ' . $imageVersions[ $_i * 3 + 1 ] . 'w';

	$slideGallery[ ] = [
		'caption' => $caption,
		'image' => [
			'fallbackURL' => $imageData[ 'url' ],
			'srcsetURL' => implode( ', ', $urls )
		]
	];
}


/*
 * ----- Programs
 */
$programs = [ ];
$programPosts = getPostsOf( 'programs' );
foreach ( $programPosts as $program ) {
	$type = getContent( '', 'type', $program[ 'ID' ] );
	$bgColor = strtolower( $type ) === 'travel' ? 'pink' : 'teal';

	$programs[ ] = [
		'id' => $program[ 'ID' ],
		'subject' => getContent( '', 'subject', $program[ 'ID' ] ),
		'title' => $program[ 'post_title' ],
		'type' => $type,
		'bgColor' => $bgColor,
		'image' => getContent( null, 'image -> sizes -> small', $program[ 'ID' ] ),
		'description' => getContent( '', 'description', $program[ 'ID' ] ),
		'attachment' => getContent( '', 'details_pdf', $program[ 'ID' ] )[ 'url' ]
	];
}


/*
 * ----- Posts
 */
$posts = [ ];
$postCategories = [ ];
$postObjects = getPostsOf( 'post' );
foreach ( $postObjects as $postObject ) {
	$featuredImage = get_the_post_thumbnail_url( $postObject[ 'ID' ] );
	$categories = get_the_category( $postObject[ 'ID' ] );
	if ( empty( $categories ) )
		$category = '';
	else
		$category = $categories[ 0 ]->name;
	$postCategories[ $category ] = true;

	$excerpt = $postObject[ 'post_excerpt' ] ?: substr( wp_strip_all_tags( $postObject[ 'post_content' ] ), 0, 415 );

	$posts[ ] = [
		'title' => $postObject[ 'post_title' ],
		'slug' => $postObject[ 'post_name' ],
		'category' => $category,
		'featuredImage' => $featuredImage,
		'excerpt' => $excerpt
	];
}
$postCategories = array_keys( $postCategories );


/*
 * ----- Members
 */
$members = [ ];
$memberObjects = getPostsOf( 'members' );
foreach ( $memberObjects as $memberObject ) {	
	$members[ ] = [
		'name' => $memberObject[ 'post_title' ],
		'designation' => getContent( '', 'designation', $memberObject[ 'ID' ] ),
		'image' => getContent( '', 'image -> sizes -> small', $memberObject[ 'ID' ] ),
		'filter_black_white' => getContent( '', 'filter_black_white', $memberObject[ 'ID' ] )
	];
}

?>






<!-- Landing Section -->
<section class="landing-section fill-dark js_sticky_marker" data-section-title="Landing Section" data-section-slug="landing-section">
	<div class="landing-video-bg">
		<div class="video-embed video-embed-bg js_video_embed js_video_get_player" data-src="uYX4uDXS3Kw" data-loop="true" data-autoplay="true" style="padding-top: 51.85%;">
			<div class="video-embed-placeholder" style="background-image: url( <?= $heroVideoFallbackImage ?> );"></div>
			<!-- <div class="video-loading-indicator"></div> -->
		</div>
	</div>
	<div class="landing-content">
		<div class="play-video inline text-center cursor-pointer js_modal_trigger" data-mod-id="immersion-main-film" tabindex="-1">
			<img class="inline-middle" width="64" src="../media/icon/icon-play-video.svg<?= $ver ?>">
			<div class="h5 w-500 text-light text-uppercase space-min-top">Watch Me First</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="columns small-12">
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Landing Section -->

<!-- Intro Section -->
<section class="intro-section fill-neutral-1 space-100-top-bottom" data-section-title="Intro Section" data-section-slug="intro-section">
	<div class="row space-50-bottom">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1 large-8">
				<div class="h4 line-height-medium">
					We guide students, corporate executives, faculty and professionals on <span class="strong"><span class="no-wrap">study-centric</span>, experiential learning programs in urban and rural India.</span>
				</div>
			</div>
		</div>
	</div>
	<div class="new row fill-neutral-2 space-50-top-bottom">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1 large-10">
				<div class="h4 strong text-teal text-uppercase">New</div>
				<div class="h2 space-min-bottom">Virtual Learning Series</div>
				<div class="row">
					<div class="columns small-12 large-7 space-min-bottom">
						<!-- video embed -->
						<div class="video-embed js_video_embed" data-src="Y7oQ8GgWYrE">
							<div class="video-loading-indicator"></div>
						</div>
					</div>
					<div class="columns small-12 large-5 space-25-left">
						<div class="space-25-bottom">
							<div class="h4 strong space-25-bottom">90 minute Live Virtual Sessions</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Business Case Studies</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Business Leader Profiles</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Problem Solving Workshops</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> End with a Q&A Session</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Customizable on Request</div>
						</div>
						<button class="fill-teal">Register Now</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row space-50-top">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1 large-8">
				<div class="h2 text-pink space-min-bottom">Travel. Experience. Learn. Repeat.</div>
				<div class="h5">What you can learn from first-hand experiences in a culturally-diverse developing nation like India, is so much more than what textbooks can teach you. We’ve got learning experiences for everyone – students, corporates, faculty & professionals!</div>
			</div>
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="point space-50-top">
					<div class="h4 text-pink space-min-bottom">Customized High-Impact Experiences</div>
					<div class="row">
						<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-pink"></span></div>
						<div class="columns small-12 medium-9 large-6 xlarge-5">
							<div class="p text-neutral-4">What you want is what you get! You could begin your journey at a start-up company in an Urban Metropolis and maybe wind up in a Wildlife Sanctuary – with us, anything’s possible! Our programs are designed to pack a wide variety of experiences into a 10-15 day schedule</div>
						</div>
					</div>
				</div>
				<div class="point space-50-top">
					<div class="h4 text-pink space-min-bottom">Researched & Handpicked Programs</div>
					<div class="row">
						<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-pink"></span></div>
						<div class="columns small-12 medium-9 large-6 xlarge-5">
							<div class="p text-neutral-4">We have dedicated academic and cultural experts skilled in researching trends and current issues that can provide high-impact learning experiences. We work closely with faculty and program leaders, to get more clarity on how best to adapt study experiences to complement specific academic requirements.</div>
						</div>
					</div>
				</div>
				<div class="point space-50-top">
					<div class="h4 text-pink space-min-bottom">We’ve Got It Covered</div>
					<div class="row">
						<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-pink"></span></div>
						<div class="columns small-12 medium-9 large-6 xlarge-5">
							<div class="p text-neutral-4">Planning the A to Z of your study experience in a foreign country is quite challenging; that requires the ‘We’ve Got It Covered’ superpower - be it airport transfers, local transport, hotel accommodation, breakfast, lunch, dinner, ferry tickets or travel insurance, we’ve got you covered.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="art train"><img class="block" src="../media/section-background/watercolor-train.png<?= $ver ?>"></div>
</section>
<!-- END: Intro Section -->

<!-- Gallery Section -->
<section class="gallery-section" data-section-title="Gallery Section" data-section-slug="gallery-section">
	<div class="slide-gallery block">
		<?php foreach ( $slideGallery as $slide ) : ?>
			<div class="slide">
				<div class="image">
					<img src="<?= $slide[ 'image' ][ 'fallbackURL' ] ?>" srcset="<?= $slide[ 'image' ][ 'srcsetURL' ] ?>" sizes="100vw" loading="lazy">
				</div>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="columns small-12 medium-10 medium-offset-1 large-8 large-offset-2">
								<div class="p w-500 line-height-large text-center"><?= $slide[ 'caption' ] ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<!-- END: Gallery Section -->

<!-- Quote Section -->
<section class="quote-section space-100-top-bottom fill-pink" data-section-title="Quote Section Travel" data-section-slug="quote-section-travel">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1 large-8 large-offset-2">
				<div class="h4 text-center line-height-medium"><span class="cursive">“</span> When overseas you learn more about your own country, than you do the place you’re visiting. <span class="cursive">”</span> – <span class="cursive">Clint Borgen.</span></div>
			</div>
		</div>
	</div>
</section>
<!-- END: Quote Section -->

<!-- Programs Section -->
<section class="programs-section space-100-top-bottom fill-neutral-1" data-section-title="Programs Section" data-section-slug="programs-section">
	<div class="row">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="h2 text-uppercase space-min-bottom">Immersive Study Programs</div>
			</div>
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="row">
					<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-pink"></span></div>
					<div class="columns small-12 medium-9 large-7 xlarge-6">
						<div class="h4 text-pink">Travel Based</div>
						<div class="p text-neutral-4 space-min-bottom">12 to 15 day immersive travel study programs to India. <br>Customized itineraries with turn-key logistics.</div>
						<div class="h4 text-teal">Virtual Series</div>
						<div class="p text-neutral-4">90 minute, live video programs that include a Q&A session.</div>

						<div class="program-filter space-25-top-bottom">
							<div class="feedback p text-neutral-4 opacity-50 space-min-bottom">
								<img class="inline-middle" width="16" src="../media/icon/icon-filter-dark.svg<?= $ver ?>">
								<span class="inline-middle js_program_filter_status_message">Select to Filter by Virtual or Travel Programs</span>
							</div>
							<div class="row toggle">
								<label class="columns small-7 medium-6 large-5 space-min-right space-min-bottom inline">
									<input class="visuallyhidden js_program_filter" type="radio" name="program-toggle" value="virtual">
									<span class="button block fill-teal"><span class="check"></span>Virtual Series</span>
								</label>
								<label class="columns small-7 medium-6 large-5 space-min-right space-min-bottom inline">
									<input class="visuallyhidden js_program_filter" type="radio" name="program-toggle" value="travel">
									<span class="button block fill-pink"><span class="check"></span>Travel Series</span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="programs row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(242, 243, 235, 0) 0%, rgba(242, 243, 235, 1) 50%); --fade-right: linear-gradient( to right, rgba(242, 243, 235, 0) 0%, rgba(242, 243, 235, 1) 50%);">
		<div class="carousel-list js_carousel_content">
			<?php foreach ( $programs as $program ) : ?>
				<div class="program carousel-list-item js_carousel_item js_program" data-program-type="<?= strtolower( $program[ 'type' ] ) ?>">
					<div class="header fill-<?= $program[ 'bgColor' ] ?> space-min">
						<div class="type label text-uppercase"><img width="16" src="../media/icon/icon-<?= strtolower( $program[ 'type' ] ) ?>-light.svg<?= $ver ?>"><span><?= $program[ 'type' ] ?></span></div>
						<div class="subject h6 text-uppercase"><?= $program[ 'subject' ] ?></div>
					</div>
					<div class="thumbnail fill-neutral-3" style="background-image: url('<?= $program[ 'image' ] ?: $thumbnailFallbackImage ?>');"></div>
					<div class="description space-min-top-bottom">
						<div class="title h5 strong space-min-bottom"><?= $program[ 'title' ] ?></div>
						<div class="excerpt p"><?= $program[ 'description' ] ?></div>
					</div>
					<a class="button block fill-<?= $program[ 'bgColor' ] ?> js_select_program" data-program-id="<?= $program[ 'id' ] ?>">Customize <span class="hide-for-small">This </span>Program</a>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="carousel-controls clearfix">
			<div class="prev float-left"><button class="button js_pager" data-dir="left"><img class="block" src="../media/icon/icon-prev-dark.svg<?= $ver ?>"></button></div>
			<div class="next float-right"><button class="button js_pager" data-dir="right"><img class="block" src="../media/icon/icon-next-dark.svg<?= $ver ?>"></button></div>
		</div>
	</div>
	<div class="art splash-3"><img class="block" src="../media/section-background/watercolor-splash-3.png<?= $ver ?>"></div>
</section>
<!-- END: Programs Section -->

<!-- Articles Section -->
<section class="articles-section space-100-top-bottom fill-neutral-2" data-section-title="Articles Section" data-section-slug="articles-section">
	<div class="row">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="h2 text-uppercase space-min-bottom">Articles</div>
				<div class="row">
					<div class="underline columns small-4 medium-3 large-2 space-25-bottom"><span class="fill-teal"></span></div>
				</div>
				<div class="article-filter space-25-bottom">
					<div class="feedback p text-neutral-4 opacity-50 space-min-bottom">
						<img class="inline-middle" width="16" src="../media/icon/icon-filter-dark.svg<?= $ver ?>">
						<span class="inline-middle js_post_filter_status_message" data-text-initial="Select to Filter by Type of Articles"></span>
					</div>
					<div class="toggle">
						<?php foreach ( $postCategories as $category ) : ?>
							<label class="tag inline">
								<input class="visuallyhidden js_post_filter" type="checkbox" name="article-toggle" value="<?= strtolower( $category ) ?>">
								<span class="p"><span class="check"></span><?= $category ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="articles row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(227, 226, 216, 0) 0%, rgba(227, 226, 216, 1) 50%); --fade-right: linear-gradient( to right, rgba(227, 226, 216, 0) 0%, rgba(227, 226, 216, 1) 50%);">
		<div class="carousel-list js_carousel_content">
			<?php foreach ( $posts as $post ) : ?>
				<div class="article carousel-list-item js_carousel_item js_post" data-category="<?= strtolower( $post[ 'category' ] ) ?>">
					<div class="thumbnail fill-neutral-3" style="background-image: url( '<?= $post[ 'featuredImage' ] ?: $thumbnailFallbackImage ?>' );">
						<div class="tag small text-uppercase"><?= $post[ 'category' ] ?></div>
					</div>
					<div class="description space-min-top-bottom">
						<div class="title h5 text-teal strong space-min-bottom"><?= $post[ 'title' ] ?></div>
						<div class="excerpt p"><?= $post[ 'excerpt' ] ?></div>
					</div>
					<a href="<?= $post[ 'slug' ] ?>" class="button block fill-teal">Read The Full Article</a>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="carousel-controls clearfix">
			<div class="prev float-left"><button class="button js_pager" data-dir="left"><img class="block" src="../media/icon/icon-prev-dark.svg<?= $ver ?>"></button></div>
			<div class="next float-right"><button class="button js_pager" data-dir="right"><img class="block" src="../media/icon/icon-next-dark.svg<?= $ver ?>"></button></div>
		</div>
	</div>
</section>
<!-- END: Articles Section -->

<!-- Brochure Section -->
<section class="brochure-section space-100-top-bottom fill-dark" data-section-title="Brochure Section" data-section-slug="brochure-section">
	<div class="row">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="h2 text-uppercase space-min-bottom">In a hurry</div>
				<div class="row">
					<div class="underline columns small-4 medium-3 large-2 space-25-bottom"><span class="fill-orange"></span></div>
				</div>
				<div class="row">
					<div class="columns small-12 medium-6 large-5 space-50-bottom">
						<div class="h5 space-min-bottom">Download our <span class="text-teal">Virtual Series Brochure</span></div>
						<div class="p"><span class="strong text-teal">— &nbsp;</span> 12 Compact Virtual Courses</div>
						<div class="p space-25-bottom"><span class="strong text-teal">— &nbsp;</span> Course Summaries</div>
						<a href="" class="button fill-teal">Download Now <i class="material-icons">get_app</i></a>
					</div>
					<div class="columns small-12 medium-6 large-5">
						<div class="h5 space-min-bottom">Download a <span class="text-pink">Sample Travel Schedule</span></div>
						<div class="p"><span class="strong text-pink">— &nbsp;</span> 12 to 15 day Immersive Travel</div>
						<div class="p space-25-bottom"><span class="strong text-pink">— &nbsp;</span> Customized Itineraries</div>
						<a href="" class="button fill-pink">Download Now <i class="material-icons">get_app</i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="art brochure"><img class="block" src="../media/section-background/brochure-mockup.png<?= $ver ?>"></div>
</section>
<!-- END: Brochure Section -->

<!-- Quote Section -->
<section class="quote-section space-100-top-bottom fill-teal" data-section-title="Quote Section Virtual" data-section-slug="quote-section-virtual">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1 large-8 large-offset-2">
				<div class="h4 text-center line-height-medium"><span class="cursive">“</span> One’s destination is never a place, but rather a new way of looking at things. <span class="cursive">”</span> – <span class="cursive">Henry Miller.</span></div>
			</div>
		</div>
	</div>
</section>
<!-- END: Quote Section -->

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
									<select class="block" id="js_form_input_program">
										<option value="" disabled>-- Select Program --</option>
										<?php foreach ( $programs as $program ) : ?>
											<option id="<?= $program[ 'id' ] ?>" value="[ <?= $program[ 'subject' ] ?> ] <?= $program[ 'title' ] ?>"><?= $program[ 'title' ] ?></option>
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
							<a href="mailto:vineeth@immersionindia.com" target="_blank" class="block fill-neutral-2 space-50" tabindex="-1">
								<div class="icon inline-bottom space-25-right">
									<img class="block" src="../media/icon/icon-email-color.svg<?= $ver ?>">
								</div>
								<div class="inline-bottom">
									<div class="h5 text-neutral-4">or, drop us an email at…</div>
									<div class="email-id h3 strong text-pink w-400" style="letter-spacing: 0.05rem;"><span class="text-underline">vineeth</span><span class="w-500">@</span>immersionindia.com</div>
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

<!-- Team Section -->
<section class="team-section space-100-top-bottom fill-dark" data-section-title="Team Section" data-section-slug="team-section">
	<div class="row space-50-bottom">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="h2 text-uppercase space-min-bottom">Meet the Team</div>
				<div class="row">
					<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-orange"></span></div>
					<div class="description columns small-12 large-10">
						<div class="p space-min-bottom">A group of experienced, fun to work with, <span class="no-wrap">customer-focused</span> individuals – we’ve got heaps of great ideas that take the shape of great learning experiences. We’re passionate about what we do and determined to deliver the best experiential study programs that showcase India’s brilliant urban and rural potential.</div>
						<div class="p space-min-bottom">The leadership team has significant experience in the education sector, complemented by long-standing associations with top-ranked educational institutions. We have also worked with foreign universities, and played a decisive role in curating partnerships and experiences with their Indian counterparts.</div>
						<div class="p space-min-bottom">The long-term working partnerships we’ve forged with many of our clients stand testament to the seamless study programs we’ve curated. Our experiences are completely flexible and we are happy to tackle any aspect of your visit, right from managing the whole trip to simply giving you an experienced set of hands on site.</div>
						<div class="p">Team up with us and ‘Let India Happen To You’!</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Team -->
	<div class="members row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(35, 31, 32, 0) 0%, rgba(35, 31, 32, 1) 50%); --fade-right: linear-gradient( to right, rgba(35, 31, 32, 0) 0%, rgba(35, 31, 32, 1) 50%);">
		<div class="carousel-list js_carousel_content">
			<?php foreach ( $members as $member ) : ?>
				<div class="member carousel-list-item js_carousel_item js_program">
					<div class="thumbnail fill-neutral-3" style="background-image: url('<?= $member[ 'image' ] ?>'); <?php if ( $member['filter_black_white'] ) : ?> filter: grayscale(1);<?php endif; ?>"></div>
					<div class="info space-min-top-bottom">
						<div class="name h4 w-400"><?= $member[ 'name' ] ?></div>
						<div class="designation p text-orange text-uppercase"><?= $member[ 'designation' ] ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="carousel-controls clearfix">
			<div class="prev float-left"><button class="button js_pager" data-dir="left"><img class="block" src="../media/icon/icon-prev-light.svg<?= $ver ?>"></button></div>
			<div class="next float-right"><button class="button js_pager" data-dir="right"><img class="block" src="../media/icon/icon-next-light.svg<?= $ver ?>"></button></div>
		</div>
	</div>
	<!-- END: Team -->
</section>
<!-- END: Team Section -->





<?php require_once __DIR__ . '/../inc/below.php'; ?>

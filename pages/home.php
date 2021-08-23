<?php
/*
 |
 | Home page
 |
 */

require_once __ROOT__ . '/inc/utils.php';
require_once __ROOT__ . '/inc/cms.php';

use BFS\CMS;
CMS::setupContext();



/*
 |
 | Fallback Images
 |
 */
$heroVideoFallbackImage = CMS::get( 'home_landing_video_fallback_image / sizes / large' ) ?? '';
$thumbnailFallbackImage = CMS::get( 'list_item_thumbnail_fallback_image / sizes / small' ) ?? '';



/*
 |
 | Fact Slides
 |
 */
$slidePosts = CMS::getPostsOf( 'slides' );
foreach ( $slidePosts as $slide ) {
	$image = $slide->get( 'image' );
	if ( empty( $image ) )
		continue;

	$imageVersions = array_values( $image[ 'sizes' ] );
	$urls = [ ];
	for ( $_i = 0; $_i < count( $imageVersions ) / 3; $_i += 1 )
		$urls[ ] = $imageVersions[ $_i * 3 ] . ' ' . $imageVersions[ $_i * 3 + 1 ] . 'w';

	$slide->set( 'fallbackImageURL', $image[ 'url' ] );
	$slide->set( 'imageSrcsetURL', implode( ', ', $urls ) );
}


/*
 |
 | Programs
 |
 */
$programs = CMS::getPostsOf( 'programs' );
foreach ( $programs as $program ) {
	$program->set( 'title', $program->get( 'post_title' ) );
	$type = $program->get( 'type' );
	$program->set( 'bgColor', strtolower( $type ) === 'travel' ? 'pink' : 'teal' );
	$image = $program->get( 'image' );
	$program->set( 'image', $image[ 'sizes' ][ 'small' ] ?? $image[ 'sizes' ][ 'thumbnail' ] ?? $image[ 'sizes' ][ 'medium' ] ?? $image[ 'url' ] ?? '/media/fallback-image.png' );
	$program->set( 'attachment', $program->get( 'details_pdf' )[ 'url' ] ?? '#' );
}



/*
 |
 | Travel Programs
 |
 */
$travelPrograms = CMS::getPostsOf( 'travel_programs' );
foreach ( $travelPrograms as $travelProgram ) {
	$travelProgram->set( 'title', $travelProgram->get( 'post_title' ) );
	$travelProgram->set( 'type', 'Travel' );
	$image = $travelProgram->get( 'image' );
	$travelProgram->set( 'image', $image[ 'sizes' ][ 'small' ] ?? $image[ 'sizes' ][ 'thumbnail' ] ?? $image[ 'sizes' ][ 'medium' ] ?? $image[ 'url' ] ?? '/media/fallback-image.png' );
	$travelProgram->set( 'attachment', $travelProgram->get( 'details_pdf' )[ 'url' ] ?? '#' );
}



/*
 |
 | Virtual Series
 |
 */
$virtualSeries = CMS::getPostsOf( 'virtual_series' );
foreach ( $virtualSeries as $series ) {
	$series->set( 'title', $series->get( 'post_title' ) );
	$series->set( 'type', 'Virtual' );
	$image = $series->get( 'image' );
	$series->set( 'image', $image[ 'sizes' ][ 'small' ] ?? $image[ 'sizes' ][ 'thumbnail' ] ?? $image[ 'sizes' ][ 'medium' ] ?? $image[ 'url' ] ?? '/media/fallback-image.png' );
	$series->set( 'attachment', $series->get( 'details_pdf' )[ 'url' ] ?? '#' );
}



/*
 |
 | Posts
 |
 */
$postCategories = [ ];
$posts = CMS::getPostsOf( 'post' );
foreach ( $posts as $post ) {

	$post->set( 'title', $post->get( 'post_title' ) );
	$post->set( 'slug', $post->get( 'post_name' ) );
	$post->set( 'excerpt', $post->get( 'post_excerpt' ) ?: substr( wp_strip_all_tags( $post->get( 'post_content' ) ), 0, 415 ) );
	$post->set( 'featuredImage', get_the_post_thumbnail_url( $post->get( 'ID' ) ) );

	$categories = get_the_category( $post->get( 'ID' ) );
	if ( empty( $categories ) )
		$category = '';
	else
		$category = $categories[ 0 ]->name;

	$post->set( 'category', $category );
	$postCategories[ $category ] = true;

}
$postCategories = array_keys( $postCategories );


/*
 |
 | Brochures
 |
 */
$brochures = [
	'sample_virtual' => CMS::get( 'sample_brochure_virtual' ) ?? '#',
	'sample_travel' => CMS::get( 'sample_brochure_travel' ) ?? '#',
];


/*
 |
 | Members
 |
 */
$members = CMS::getPostsOf( 'members' );
foreach ( $members as $member ) {
	$member->set( 'name', $member->get( 'post_title' ) );
	$member->set( 'image', $member->get( 'image' )[ 'sizes' ][ 'small' ] ?? $thumbnailFallbackImage );
}



/*
 |
 | UI Components
 |
 */
require_once __ROOT__ . '/pages/sections/program-booking.php';



// Pull in the header section
require_once __ROOT__ . '/inc/header.php';

?>






<!-- Landing Section -->
<section class="landing-section fill-dark js_sticky_marker" id="landing-section" data-section-title="Landing Section" data-section-slug="landing-section">
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
	</div>
</section>
<!-- END: Landing Section -->

<!-- Intro Section -->
<section class="intro-section fill-neutral-1 space-100-top" id="intro-section" data-section-title="Intro Section" data-section-slug="intro-section">
	<div class="row space-50-bottom">
		<div class="container">
			<div class="columns small-12 medium-10 medium-offset-1 large-8">
				<div class="h4 line-height-medium space-25-bottom">
					We guide students, corporate executives, faculty and professionals on <span class="strong"><span class="no-wrap">study-centric</span>, experiential learning programs in urban and rural India.</span>
				</div>
				<div class="headline h4 cd-headline slide">
					<span>Come experience our</span>
					<span class="cd-words-wrapper">
						<b class="is-visible">people.</b>
						<b>language.</b>
						<b>industry.</b>
						<b>science.</b>
						<b>economy.</b>
						<b>business.</b>
						<b>history.</b>
						<b>villages.</b>
						<b>cities.</b>
						<b>food.</b>
						<b>transport.</b>
						<b>culture.</b>
						<b>politics.</b>
						<b>education.</b>
						<b>nature.</b>
					</span>
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
							<div class="h4 strong space-25-bottom">Live Virtual Sessions</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Business Leader Profiles</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Case Studies</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Problem Solving Workshops</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Discussion Groups</div>
							<div class="h5"><span class="strong text-teal">— &nbsp;</span> Customizable on Request</div>
						</div>
						<a href="#programs-section" class="button fill-teal">Register Now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Split Intro Section -->
<section class="intro-section fill-neutral-1 space-100-bottom" id="intro-section-travel" data-section-title="Intro Section Travel" data-section-slug="intro-section-travel">
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
							<div class="p text-neutral-4">What you want is what you get! You could begin your journey at a start-up company in an Urban Metropolis and maybe wind up in a Wildlife Sanctuary – with us, anything’s possible! Our programs are designed to pack a wide variety of experiences.</div>
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
<section class="gallery-section" id="gallery-section" data-section-title="Gallery Section" data-section-slug="gallery-section">
	<div class="slide-gallery block">
		<?php foreach ( $slidePosts as $slide ) : ?>
			<div class="slide">
				<div class="image">
					<img src="<?= $slide->get( 'fallbackImageURL' ) ?>" srcset="<?= $slide->get( 'imageSrcsetURL' ) ?>" sizes="100vw" loading="lazy">
				</div>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="columns small-12 medium-10 medium-offset-1 large-8 large-offset-2">
								<div class="p w-500 line-height-large text-center"><?= $slide->get( 'caption' ) ?></div>
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
<section class="quote-section space-100-top-bottom fill-pink" id="quote-section-travel" data-section-title="Quote Section Travel" data-section-slug="quote-section-travel">
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
<section class="programs-section space-100-top-bottom fill-neutral-1" id="programs-section" data-section-title="Programs Section" data-section-slug="programs-section">
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
						<div class="p text-neutral-4 space-min-bottom">Immersive travel study programs to India. <br>Customized itineraries with turn-key logistics.</div>
						<div class="h4 text-teal">Virtual Series</div>
						<div class="p text-neutral-4">Live virtual sessions that include active discussions.</div>

						<div class="program-filter space-25-top-bottom">
							<div class="feedback p text-neutral-4 opacity-50 space-min-bottom">
								<img class="inline-middle" width="16" src="/media/icon/icon-filter-dark.svg<?= $ver ?>">
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
				<div class="program carousel-list-item js_carousel_item js_program" data-program-type="<?= strtolower( $program->get( 'type' ) ) ?>">
					<div class="header fill-<?= $program->get( 'bgColor' ) ?> space-min">
						<div class="type label text-uppercase"><img width="16" src="/media/icon/icon-<?= strtolower( $program->get( 'type' ) ) ?>-light.svg<?= $ver ?>"><span><?= $program->get( 'type' ) ?></span></div>
						<div class="subject h6 text-uppercase"><?= $program->get( 'subject' ) ?></div>
					</div>
					<div class="thumbnail fill-neutral-3" style="background-image: url('<?= $program->get( 'image' ) ?: $thumbnailFallbackImage ?>');"></div>
					<div class="description space-min-top-bottom">
						<div class="title h5 strong space-min-bottom"><?= $program->get( 'title' ) ?></div>
						<div class="excerpt p"><?= $program->get( 'description' ) ?></div>
					</div>
					<a class="button block fill-<?= $program->get( 'bgColor' ) ?> js_select_program" data-program-id="<?= $program->get( 'ID' ) ?>">Customize <span class="hide-for-small">This </span>Program</a>
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
<section class="articles-section space-100-top-bottom fill-neutral-2" id="section-articles" data-section-title="Articles Section" data-section-slug="articles-section">
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
				<div class="article carousel-list-item js_carousel_item js_post" data-category="<?= strtolower( $post->get( 'category' ) ) ?>">
					<div class="thumbnail fill-neutral-3" style="background-image: url( '<?= $post->get( 'featuredImage' ) ?: $thumbnailFallbackImage ?>' );">
						<div class="tag small text-uppercase"><?= $post->get( 'category' ) ?></div>
					</div>
					<div class="description space-min-top-bottom">
						<a href="<?= $post->get( 'slug' ) ?>" class="title h5 text-teal strong space-min-bottom"><?= $post->get( 'title' ) ?></a>
						<div class="excerpt p"><?= $post->get( 'excerpt' ) ?></div>
					</div>
					<a href="<?= $post->get( 'slug' ) ?>" class="button block fill-teal">Read The Full Article</a>
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
<section class="brochure-section space-100-top-bottom fill-dark" id="brochure-section" data-section-title="Brochure Section" data-section-slug="brochure-section">
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
						<a href="<?= $brochures[ 'sample_virtual' ] ?>" target="_blank" class="button fill-teal">Download Now <i class="material-icons">get_app</i></a>
					</div>
					<div class="columns small-12 medium-6 large-5">
						<div class="h5 space-min-bottom">Download a <span class="text-pink">Sample Travel Schedule</span></div>
						<div class="p"><span class="strong text-pink">— &nbsp;</span> 12 to 15 day Immersive Travel</div>
						<div class="p space-25-bottom"><span class="strong text-pink">— &nbsp;</span> Customized Itineraries</div>
						<a href="<?= $brochures[ 'sample_travel' ] ?>" target="_blank" class="button fill-pink">Download Now <i class="material-icons">get_app</i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="art brochure"><img class="block" src="../media/section-background/brochure-mockup.png<?= $ver ?>"></div>
</section>
<!-- END: Brochure Section -->

<!-- Quote Section -->
<section class="quote-section space-100-top-bottom fill-teal" id="quote-section-virtual" data-section-title="Quote Section Virtual" data-section-slug="quote-section-virtual">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1 large-8 large-offset-2">
				<div class="h4 text-center line-height-medium"><span class="cursive">“</span> One’s destination is never a place, but rather a new way of looking at things. <span class="cursive">”</span> – <span class="cursive">Henry Miller.</span></div>
			</div>
		</div>
	</div>
</section>
<!-- END: Quote Section -->

<?php
	// Program Booking section
	BFS\UI\programBooking( $programs )
?>

<!-- Team Section -->
<section class="team-section space-100-top-bottom fill-dark" id="section-team" data-section-title="Team Section" data-section-slug="team-section">
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
					<div class="thumbnail fill-neutral-3" style="background-image: url('<?= $member->get( 'image' ) ?>'); <?php if ( $member->get( 'filter_black_white' ) ) : ?> filter: grayscale( 1 );<?php endif; ?>"></div>
					<div class="info space-min-top-bottom">
						<div class="name h4 w-400"><?= $member->get( 'name' ) ?></div>
						<div class="designation p text-orange text-uppercase"><?= $member->get( 'designation' ) ?></div>
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





<?php require_once __ROOT__ . '/inc/footer.php'; ?>

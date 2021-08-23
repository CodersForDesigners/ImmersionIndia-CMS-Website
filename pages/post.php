<?php

require_once __ROOT__ . '/inc/utils.php';
require_once __ROOT__ . '/inc/cms.php';

use BFS\Router;
use BFS\CMS;
CMS::setupContext();

global $thePost;
$thePost = CMS::getThisPost();

$featuredImageHeight = CMS::get( 'featured_image_height' );
$featuredImageStyle = '';

if ( ! empty( $featuredImageHeight ) )
	$featuredImageStyle = 'padding-top: calc( '. $featuredImageHeight . '% - 60px ) !important;';


$featuredImageFallback = CMS::get( 'post_featured_fallback_image / sizes / medium' );
$featuredImage = get_the_post_thumbnail_url( $thePost->get( 'ID' ) ) ?: $featuredImageFallback;

$socialImage = CMS::get( 'social_image / sizes / medium' );

$postContent = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $thePost->get( 'post_content' ) ) );



require_once __ROOT__ . '/inc/header.php';

?>



<!-- Landing Section -->
<section class="landing-section fill-dark js_sticky_marker" id="landing-section" data-section-title="Landing Section" data-section-slug="landing-section">
	<div class="landing-image-bg">
		<div class="image" style="background-image: url( '<?= $featuredImage ?>' );"></div>
	</div>
	<div class="landing-content" style="<?= $featuredImageStyle ?>">
		<div class="container">
			<div class="row">
				<div class="columns small-12 medium-10 medium-offset-1 space-100-bottom">
					<div class="title h3 space-min-bottom"><?= $thePost->get( 'post_title' ) ?></div>
					<div class="row">
						<div class="underline columns small-4 medium-3 large-2"><span class="fill-orange"></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Landing Section -->

<!-- Post Section -->
<section class="post-section space-50-top-bottom" id="post-content-section" style="min-height: 50vh;">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div>
					<!-- Share -->
					<div class="block share-url js_share_url_widget">
						<span class="share-url-title label text-uppercase inline-middle text-orange js_share_url_title">Share</span>
						<i class="icon material-icons inline-middle text-orange">link</i>
						<a class="share-url-label p inline-middle js_share_url" href="<?= $pageURL ?>" target="_blank"><?= $pageURL ?></a>
						<textarea class="visuallyhidden js_share_url_text"><?= $pageURL ?></textarea>
					</div>
					<!-- END: Share -->
					<?= $postContent ?: 'Um, what happened to the content?' ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Post Section -->




<script type="text/javascript">

	/*
	 *
	 * Share URLs
	 *
	 * When the share button or the URL is clicked/tapped
	 * We copy the URL to the clipboard
	 *
	 */
	$( document ).on( "click", ".js_share_url", function ( event ) {
		event.preventDefault();
	} );
	$( document ).on( "click", ".js_share_url_widget", function ( event ) {

		event.preventDefault();

		var $shareURLWidget = $( event.target ).closest( ".js_share_url_widget" );
		var $feedbackMessage = $shareURLWidget.find( ".js_share_url_title" );

		var $url = $shareURLWidget.find( ".js_share_url_text" );
		$url.get( 0 ).select();
		try {
			document.execCommand( "copy" );
			$feedbackMessage.text( "Copied to Clipboard" );
		}
		catch ( e ) {}
		$url.get( 0 ).blur();

	} );

</script>

<?php require_once __ROOT__ . '/inc/footer.php'; ?>

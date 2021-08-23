<?php

/*
 *
 * Build out the data-structure driving the page navigation markup
 *
 */
$navigationMenuItems = \BFS\CMS::getNavigation( 'Main' );

?>
<!-- Header Section -->
<section class="header-section space-25-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<a href="/" class="logo">
					<img src="/media/logo-immersion-light-banner.svg<?= $ver ?>">
				</a>
			</div>
		</div>
	</div>
</section>
<!-- END: Header Section -->

<!-- Menu Section -->
<section class="menu-section space-25-top-bottom js_nav_open_trigger">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<button class="menu button inline w-500 js_nav_open"><i class="material-icons">menu</i> Menu</button>
			</div>
		</div>
	</div>
</section>
<!-- END: Menu Section -->

<!-- Navigation Section -->
<section class="navigation-section">
	<div class="container">
		<div class="row">
			<div class="navigation-list columns small-12 medium-8 medium-offset-4 large-6 large-offset-6 xlarge-5 xlarge-offset-7 fill-dark space-75-top-bottom space-100-left-right">
				<div class="close-button button fill-orange js_nav_close"><i class="material-icons">close</i></div>
				<div class="title h2 strong opacity-50 text-uppercase space-25-bottom">Menu</div>
				<?php foreach ( $navigationMenuItems as $item ) : ?>
					<div class="h4"><a class="link space-min-top-bottom <?= $item[ 'classes' ] ?>" href="<?= $item[ 'url' ] ?>"><span class="l"><?= $item[ 'title' ] ?></span></a></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="close-area cursor-pointer js_nav_close"></div>
</section>
<!-- END: Navigation Section -->

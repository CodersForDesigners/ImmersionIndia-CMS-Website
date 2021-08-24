<?php

$gallery = get_field( 'gallery' );

?>
<div class="wp-block-gallery">
	<ul class="blocks-gallery-grid">
		<?php foreach ( $gallery as $item ) : ?>
		<?php
			$image = $item[ 'image' ];
			$imageURL = $image[ 'sizes' ][ 'large' ] ?: $image[ 'sizes' ][ 'medium' ] ?: $image[ 'url' ] ?: $image[ 'sizes' ][ 'small' ];
			$link = $item[ 'link' ][ 'url' ] ?? null;
		?>
		<li class="blocks-gallery-item">
			<a href="<?= $link ?? $imageURL ?>" target="_blank">
				<figure>
					<img src="<?= $imageURL ?>" alt="<?= $item[ 'caption' ] ?>" loading="lazy">
					<?php if ( !empty( $item[ 'caption' ] ) ) : ?>
						<figcaption><?= $item[ 'caption' ] ?></figcaption>
					<?php endif; ?>
				</figure>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>

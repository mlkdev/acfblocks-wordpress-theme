<?php

	$fields = get_fields();

	$block_class = [ 'block', basename( __DIR__ ) ];
	if( $is_preview ) $block_class[] = '--layout-preview';
	if( !empty( $fields[ 'layout_gap' ] ) )    $block_class[] = '--layout-'.$fields[ 'layout_gap' ];

	$section_style = [];
	$overlay_style = [];
	if( !empty( $fields[ 'background_color' ] ) ) {
		$section_style[] = 'background-color: '.$fields[ 'background_color' ];
		$overlay_style[] = 'background-color: '.$fields[ 'background_color' ];
	}
	if( !empty( $fields[ 'background_asset' ][ 'url' ] ) ) {
		if( $fields[ 'background_asset' ][ 'type' ] == 'image' ) {
			$section_style[] = 'background-image: url('.$fields[ 'background_asset' ][ 'url' ].')';
		}
	}
	if( !empty( $fields[ 'background_overlay' ] ) ) {
		$overlay_style[] = 'opacity: '.( $fields[ 'background_overlay' ] / 100 );
	}

?>
<section id="<?= $block[ 'id' ] ?>" class="<?= implode( ' ', $block_class ) ?>" style="<?= implode( ';', $section_style ) ?>">

	<?php if( !empty( $fields[ 'background_asset' ][ 'url' ] ) ) : ?>
		<?php if( $fields[ 'background_asset' ][ 'type' ] == 'video' ) : ?>
			<div class="bg-video">
				<video autoplay muted loop>
					<source src="<?= $fields[ 'background_asset' ][ 'url' ] ?>" type="<?= $fields[ 'background_asset' ][ 'mime_type' ] ?>" />
				</video>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if( !empty( $overlay_style ) ) : ?>
		<div class="bg-overlay" style="<?= implode( ';', $overlay_style ) ?>"></div>
	<?php endif; ?>

	<div class="content">
		<div class="interior">
			<InnerBlocks />
		</div>
	</div>

</section>

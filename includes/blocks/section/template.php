<?php

	// Retrieve the ACF fields...

	$fields = get_fields();

	// Construct the block base class...

	$block_class = [ 'block', basename( __DIR__ ) ];

	// Block editor class BEM...

	if( $is_preview ) $block_class[] = '--layout-preview';

	// Add block class BEMs...

	if( !empty( $fields[ 'layout_gap' ] ) )    $block_class[] = '--layout-'.$fields[ 'layout_gap' ];

	// Block instance inline styles (section tag)...

	$section_style = [];
	if( !empty( $fields[ 'background_color' ] ) ) {
		$section_style[] = 'background-color: '.$fields[ 'background_color' ];
	}
	if( !empty( $fields[ 'background_asset' ][ 'url' ] ) ) {
		if( $fields[ 'background_asset' ][ 'type' ] == 'image' ) {
			$section_style[] = 'background-image: url('.$fields[ 'background_asset' ][ 'url' ].')';
		}
	}

	// Block instance inline styles (div .bg-overlay)...

	$overlay_style = [];
	if( !empty( $fields[ 'background_color' ] ) ) {
		$overlay_style[] = 'background-color: '.$fields[ 'background_color' ];
	}
	if( !empty( $fields[ 'background_overlay' ] ) ) {
		$overlay_style[] = 'opacity: '.( $fields[ 'background_overlay' ] / 100 );
	}

?>
<section id="<?= esc_html( $block[ 'id' ] ) ?>" class="<?= esc_html( implode( ' ', $block_class ) ) ?>" style="<?= esc_html( implode( ';', $section_style ) ) ?>">

	<?php if( !empty( $fields[ 'background_asset' ][ 'url' ] ) ) : ?>
		<?php if( $fields[ 'background_asset' ][ 'type' ] == 'video' ) : ?>
			<div class="bg-video">
				<video autoplay muted loop>
					<source src="<?= esc_url( $fields[ 'background_asset' ][ 'url' ] ) ?>" type="<?= esc_html( $fields[ 'background_asset' ][ 'mime_type' ] ) ?>" />
				</video>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if( !empty( $overlay_style ) ) : ?>
		<div class="bg-overlay" style="<?= esc_html( implode( ';', $overlay_style ) ) ?>"></div>
	<?php endif; ?>

	<div class="content">
		<div class="interior">
			<InnerBlocks />
		</div>
	</div>

</section>

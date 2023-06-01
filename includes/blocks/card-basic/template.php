<?php

	// Retrieve the ACF fields...

	$fields = get_fields();

	// Construct the block base class...

	$block_class = [ 'block', basename( __DIR__ ) ];

	// Block editor class BEM...

	if( $is_preview ) $block_class[] = '--layout-preview';

	// Add block class BEMs...

	if( !empty( $fields[ 'layout_sm' ] ) ) $block_class[] = '--layout-'.$fields[ 'layout_sm' ];
	if( !empty( $fields[ 'layout_md' ] ) ) $block_class[] = '--layout-'.$fields[ 'layout_md' ];
	if( !empty( $fields[ 'layout_lg' ] ) ) $block_class[] = '--layout-'.$fields[ 'layout_lg' ];
	if( !empty( $fields[ 'layout_xl' ] ) ) $block_class[] = '--layout-'.$fields[ 'layout_xl' ];
	if( !empty( $fields[ 'corner_radius' ] ) ) $block_class[] = '--corner-'.$fields[ 'corner_radius' ];
	if( !empty( $fields[ 'padding_size' ] ) ) $block_class[] = '--pad-'.$fields[ 'padding_size' ];

	// Block instance inline styles (div .block.card-basic)...

	$block_style = [];
	if( !empty( $fields[ 'bg_color' ] ) ) $block_style[] = 'background-color:'.$fields[ 'bg_color' ];

	// Block ID shortcut...

	$preview_wrapper_id = str_replace( 'block_', 'block-', $block[ 'id' ] );

?>
<div id="<?= esc_attr( $block[ 'id' ] ) ?>" class="<?= esc_attr( implode( ' ', $block_class ) ) ?>" style="<?= esc_attr( implode( ';', $block_style ) ) ?>">
	<style>

		/* This nonsense is required until Firefox supports :has()... */
		/* Once that time arrives this can be ported into BEM classes */

		@media (min-width: 0px) {
			#<?= esc_html( $preview_wrapper_id ) ?> {
				width: 100%;
			}
		}
		@media (min-width: 640px) {
			#<?= esc_html( $preview_wrapper_id ) ?> { width: 100%; }
			<?php if( $fields[ 'layout_sm' ] == 'sm-half' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 2) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 12px) / 2) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 24px) / 2) * 1); }
			<?php endif; ?>
		}
		@media (min-width: 960px) {
			#<?= esc_html( $preview_wrapper_id ) ?> { width: 100%; }
			<?php if( $fields[ 'layout_md' ] == 'md-half' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 2) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 16px) / 2) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 32px) / 2) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_md' ] == 'md-third' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 3) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 32px) / 3) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 64px) / 3) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_md' ] == 'md-third-x2' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 3) * 2); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 32px) / 3) * 2) + 16px); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 64px) / 3) * 2) + 32px); }
			<?php endif; ?>
		}
		@media (min-width: 1280px) {
			#<?= esc_html( $preview_wrapper_id ) ?> { width: 100%; }
			<?php if( $fields[ 'layout_lg' ] == 'lg-half' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 2) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 20px) / 2) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 40px) / 2) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_lg' ] == 'lg-third' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 3) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 40px) / 3) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 80px) / 3) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_lg' ] == 'lg-third-x2' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 3) * 2); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 40px) / 3) * 2) + 20px); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 80px) / 3) * 2) + 40px); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_lg' ] == 'lg-quarter' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 4) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 60px) / 4) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 120px) / 4) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_lg' ] == 'lg-quarter-x2' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 4) * 2); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 60px) / 4) * 2) + 20px); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 120px) / 4) * 2) + 40px); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_lg' ] == 'lg-quarter-x3' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 4) * 3); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 60px) / 4) * 3) + 40px); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 120px) / 4) * 3) + 80px); }
			<?php endif; ?>
		}
		@media (min-width: 1600px) {
			#<?= esc_html( $preview_wrapper_id ) ?> { width: 100%; }
			<?php if( $fields[ 'layout_xl' ] == 'xl-half' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 2) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 24px) / 2) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 48px) / 2) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_xl' ] == 'xl-third' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 3) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 48px) / 3) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 96px) / 3) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_xl' ] == 'xl-third-x2' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 3) * 2); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 48px) / 3) * 2) + 24px); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 96px) / 3) * 2) + 48px); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_xl' ] == 'xl-quarter' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 4) * 1); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 72px) / 4) * 1); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc(((100% - 144px) / 4) * 1); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_xl' ] == 'xl-quarter-x2' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 4) * 2); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 72px) / 4) * 2) + 24px); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 144px) / 4) * 2) + 48px); }
			<?php endif; ?>
			<?php if( $fields[ 'layout_xl' ] == 'xl-quarter-x3' ) : ?>
				.block.section.--layout-gap #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((100% / 4) * 3); }
				.block.section.--layout-gap-half #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-half #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 72px) / 4) * 3) + 48px); }
				.block.section.--layout-gap-full #<?= esc_html( $preview_wrapper_id ) ?>, .block.section.--layout-gap-full #<?= $block[ 'id' ] ?>:not(.--layout-preview) { width: calc((((100% - 144px) / 4) * 3) + 96px); }
			<?php endif; ?>
		}

	</style>
	<div class="interior">

		<?= wp_kses_post( !empty( $fields[ 'content' ] ) ? $fields[ 'content' ] : null ) ?>

	</div>
</div>
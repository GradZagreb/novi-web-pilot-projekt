<?php
/**
 * @var string $iframe_html
 * @var string $aspect_ratio
 * @var bool   $is_background
 * @var bool   $lazy
 * @var bool   $native_lazy
 * @var bool   $animate
 * @var string $loader_bg
 * @var string $modifier_class
 */
if ( empty( $aspect_ratio ) ) {
    $aspect_ratio = '16-9';
}

if ( ! isset( $is_background ) ) {
    $is_background = false;
}

if ( ! isset( $lazy ) ) {
    $lazy = true;
}

if ( ! isset( $native_lazy ) ) {
    $native_lazy = false;
}

if ( ! isset( $animate ) ) {
    $animate = true;
}
?>

<?php if ( ! empty( $iframe_html ) ) { ?>
    <?php $iframe_html = str_replace( 'loading="lazy"', '', $iframe_html ); ?>
    <div class="c-responsive-media <?php echo $is_background ? 'c-responsive-media--background' : ''; ?> <?php echo ! empty( $modifier_class ) ? esc_attr( $modifier_class ) : ''; ?>">
        <div class="c-responsive-media__inner c-responsive-media__inner--<?php echo $aspect_ratio; ?>">
            <?php if ( $lazy ) { ?>
                <?php echo str_replace( 'src="', 'class="js-lazy-load" data-src="', $iframe_html ); ?>
                <?php if ( $animate ) { ?>
                    <?php get_partial( 'components/media-loader', array(
                        'background_color' => ! empty( $loader_bg ) ? esc_attr( $loader_bg ) : '',
                    ) ); ?>
                <?php } ?>
            <?php } elseif ( $native_lazy && ! $lazy ) { ?>
                <?php echo str_replace( 'src="', 'loading="lazy" src="', $iframe_html ); ?>
            <?php } else { ?>
                <?php echo $iframe_html; ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php
/**
 * @var array  $urls
 * @var string $alt
 * @var string $aspect_ratio
 * @var string $object_fit
 * @var string $object_position
 * @var bool   $is_background
 * @var bool   $lazy
 * @var bool   $native_lazy
 * @var bool   $priority
 * @var bool   $animate
 * @var number $width
 * @var number $height
 * @var string $loader_bg
 * @var string $modifier_class
 */
if ( empty( $urls['widescreen'] ) ) {
    $urls['widescreen'] = $urls['desktop'];
}

if ( empty( $urls['widescreen_retina'] ) ) {
    $urls['widescreen_retina'] = $urls['desktop_retina'];
}

if ( empty( $urls['tablet'] ) ) {
    $urls['tablet'] = $urls['desktop'];
}

if ( empty( $urls['tablet_retina'] ) ) {
    $urls['tablet_retina'] = $urls['desktop_retina'];
}

if ( empty( $urls['mobile'] ) ) {
    $urls['mobile'] = $urls['desktop'];
}

if ( empty( $urls['mobile_retina'] ) ) {
    $urls['mobile_retina'] = $urls['desktop_retina'];
}

if ( ! isset( $is_background ) ) {
    $is_background = false;
}

if ( empty( $aspect_ratio ) ) {
    $aspect_ratio = '1-1';
}

if ( ! isset( $lazy ) ) {
    $lazy = true;
}

if ( ! isset( $native_lazy ) ) {
    $native_lazy = false;
}

if ( ! isset( $priority ) ) {
    $priority = false;
}

if ( ! isset( $animate ) ) {
    $animate = true;
}
?>

<?php if ( ! empty( $urls ) && ! empty( $urls['desktop'] ) && ! empty( $urls['desktop_retina'] ) ) { ?>
    <figure class="c-responsive-media <?php echo $is_background ? 'c-responsive-media--background' : ''; ?> <?php echo ! empty( $modifier_class ) ? esc_attr( $modifier_class ) : ''; ?>">
        <picture class="c-responsive-media__inner c-responsive-media__inner--<?php echo $aspect_ratio; ?>">
            <source media="(min-width: 2000px)"
                    <?php echo $lazy ? 'data-' : ''; ?>srcset="<?php echo esc_url( $urls['widescreen'] ); ?> 1x, <?php echo esc_url( $urls['widescreen_retina'] ); ?> 2x"/>
            <source media="(min-width: 1141px)"
                    <?php echo $lazy ? 'data-' : ''; ?>srcset="<?php echo esc_url( $urls['desktop'] ); ?> 1x, <?php echo esc_url( $urls['desktop_retina'] ?? '' ); ?> 2x"/>
            <source media="(min-width: 641px)"
                    <?php echo $lazy ? 'data-' : ''; ?>srcset="<?php echo esc_url( $urls['tablet'] ); ?> 1x, <?php echo esc_url( $urls['tablet_retina'] ?? '' ); ?> 2x"/>
            <source media="(max-width: 640px)"
                    <?php echo $lazy ? 'data-' : ''; ?>srcset="<?php echo esc_url( $urls['mobile'] ); ?> 1x, <?php echo esc_url( $urls['mobile_retina'] ?? '' ); ?> 2x"/>
            <img alt="<?php echo ! empty( $alt ) ? esc_attr( $alt ) : 'Image'; ?>"
                 class="c-responsive-media__img <?php echo ! empty( $object_fit ) ? 'c-responsive-media__img--' . esc_attr( $object_fit ) : ''; ?> <?php echo ! empty( $object_position ) ? 'c-responsive-media__img--' . esc_attr( $object_position ) : ''; ?> <?php echo $lazy ? 'js-lazy-load' : ''; ?> js-responsive-image"
                 <?php echo $lazy ? 'data-' : ''; ?>src="<?php echo esc_url( $urls['desktop'] ); ?>"
                 <?php if ( ! empty( $width ) ) { ?>width="<?php echo esc_attr( $width ); ?>" <?php } ?>
                 <?php if ( ! empty( $height ) ) { ?>height="<?php echo esc_attr( $height ); ?>" <?php } ?>
                <?php echo $priority ? 'fetchpriority="high"' : ''; ?>
                <?php echo $native_lazy && ! $lazy ? 'loading="lazy"' : ''; ?>/>
            <?php if ( $lazy && $animate ) { ?>
                <?php get_partial( 'components/media-loader', array(
                    'background_color' => ! empty( $loader_bg ) ? esc_attr( $loader_bg ) : '',
                ) ); ?>
            <?php } ?>
        </picture>
    </figure>
<?php } ?>

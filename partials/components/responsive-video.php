<?php
/**
 * @var string $qhd_video_url
 * @var string $qhd_video_poster
 * @var string $fhd_video_url
 * @var string $fhd_video_poster
 * @var string $hd_video_url
 * @var string $hd_video_poster
 * @var string $sd_video_url
 * @var string $sd_video_poster
 * @var string $alt
 * @var bool   $autoplay
 * @var bool   $muted
 * @var bool   $loop
 * @var bool   $plays_inline
 * @var bool   $controls
 * @var string $preload
 * @var string $aspect_ratio
 * @var string $object_fit
 * @var string $object_position
 * @var bool   $is_background
 * @var bool   $lazy
 * @var bool   $native_lazy
 * @var bool   $priority
 * @var bool   $animate
 * @var string $loader_bg
 * @var bool   $scroll_trigger
 * @var bool   $play_button
 * @var string $modifier_class
 */
if ( empty( $qhd_video_url ) ) {
    $qhd_video_url = $fhd_video_url;
}

if ( empty( $qhd_video_poster ) ) {
    $qhd_video_poster = $fhd_video_poster;
}

if ( empty( $hd_video_url ) ) {
    $hd_video_url = $fhd_video_url;
}

if ( empty( $hd_video_poster ) ) {
    $hd_video_poster = $fhd_video_poster;
}

if ( empty( $sd_video_url ) ) {
    $sd_video_url = $fhd_video_url;
}

if ( empty( $sd_video_poster ) ) {
    $sd_video_poster = $fhd_video_poster;
}

if ( ! isset( $autoplay ) ) {
    $autoplay = false;
}

if ( $autoplay ) {
    $muted = true;
} elseif ( ! isset( $muted ) ) {
    $muted = false;
}

if ( ! isset( $loop ) ) {
    $loop = false;
}

if ( ! isset( $plays_inline ) ) {
    $plays_inline = true;
}

if ( ! isset( $controls ) ) {
    $controls = true;
}

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

if ( ! isset( $priority ) ) {
    $priority = false;
}

if ( ! isset( $animate ) ) {
    $animate = true;
}

if ( ! isset( $scroll_trigger ) ) {
    $scroll_trigger = false;
}

if ( ! isset( $play_button ) ) {
    $play_button = false;
}
?>

<?php if ( ! empty( $fhd_video_url ) && ! empty( $fhd_video_poster ) ) { ?>
    <div class="c-responsive-media <?php echo $is_background ? 'c-responsive-media--background' : ''; ?> <?php echo ! empty( $modifier_class ) ? esc_attr( $modifier_class ) : ''; ?> <?php echo $scroll_trigger ? 'js-video-on-scroll' : ''; ?> <?php echo $play_button ? 'js-video-play-button' : ''; ?>">
        <div class="c-responsive-media__inner c-responsive-media__inner--<?php echo $aspect_ratio; ?>">
            <video class="c-responsive-media__video <?php echo ! empty( $object_fit ) ? 'c-responsive-media__video--' . esc_attr( $object_fit ) : ''; ?> <?php echo ! empty( $object_position ) ? 'c-responsive-media__video--' . esc_attr( $object_position ) : ''; ?> <?php echo $lazy ? 'js-lazy-load' : ''; ?> <?php echo $scroll_trigger ? 'js-video-on-scroll-video' : ''; ?> <?php if ( $play_button ) { ?>js-video-play-button-video<?php } ?> js-responsive-video"
                   <?php if ( $autoplay ) { ?>autoplay<?php } ?>
                   <?php if ( $muted ) { ?>muted<?php } ?>
                   <?php if ( $loop ) { ?>loop<?php } ?>
                   <?php if ( $plays_inline ) { ?>playsinline<?php } ?>
                   <?php if ( $controls ) { ?>controls<?php } ?>
                   preload="<?php echo ! empty( $preload ) ? esc_attr( $preload ) : 'auto'; ?>"
                   <?php echo $lazy ? 'data-' : ''; ?>poster=""
                   <?php if ( $priority ) { ?>fetchpriority="high"<?php } ?>
                   disablePictureInPicture
                   data-qhd-poster="<?php echo esc_attr( $qhd_video_poster ); ?>"
                   data-fhd-poster="<?php echo esc_attr( $fhd_video_poster ); ?>"
                   data-hd-poster="<?php echo esc_attr( $hd_video_poster ); ?>"
                   data-sd-poster="<?php echo esc_attr( $sd_video_poster ); ?>"
                   aria-label="<?php echo ! empty( $alt ) ? esc_attr( $alt ) : 'Video'; ?>"
                <?php echo $native_lazy && ! $lazy ? 'loading="lazy"' : ''; ?>>
                <source media="(min-width: 2000px)" type="video/mp4"
                        <?php echo $lazy ? 'data-' : ''; ?>src="<?php echo esc_url( $qhd_video_url ); ?>">
                <source media="(min-width: 1141px)" type="video/mp4"
                        <?php echo $lazy ? 'data-' : ''; ?>src="<?php echo esc_url( $fhd_video_url ); ?>">
                <source media="(min-width: 641px)" type="video/mp4"
                        <?php echo $lazy ? 'data-' : ''; ?>src="<?php echo esc_url( $hd_video_url ); ?>">
                <source media="(max-width: 640px)" type="video/mp4"
                        <?php echo $lazy ? 'data-' : ''; ?>src="<?php echo esc_url( $sd_video_url ); ?>">
            </video>
            <?php if ( $lazy && $animate ) { ?>
                <?php get_partial( 'components/media-loader', array(
                    'background_color' => ! empty( $loader_bg ) ? esc_attr( $loader_bg ) : '',
                ) ); ?>
            <?php } ?>
            <?php if ( $play_button && ! $autoplay && ! $scroll_trigger ) { ?>
                <button class="c-media-trigger js-video-play-button-trigger" type="button">
                    <?php echo get_icon( 'play' ); ?>
                </button>
            <?php } ?>
        </div>
    </div>
<?php } ?>

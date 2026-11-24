<?php
/**
 * @var string $link
 * @var string $title
 * @var string $excerpt
 */
?>

<div class="c-search-result-card">
    <div class="c-search-result-card__content">
        <h2 class="c-search-result-card__title u-a2"><?php the_title(); ?></h2>

        <?php if ( ! empty( $excerpt ) ) : ?>
        <div class="c-search-results__excerpt u-b0">
            <?php the_excerpt(); ?>
        </div>
        <?php endif; ?>
    </div>

    <a href="<?php echo $link; ?>" class="c-search-result-card__link u-b1">
        <?php _e( 'Pogledajte više', TEXT_DOMAIN ); ?>
    </a>
</div>

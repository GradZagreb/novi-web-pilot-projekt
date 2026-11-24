<?php
/**
 * @var string $type
 * @var string $title
 * @var string $url
 * @var string $target
 * @var string $dataset
 * @var string $classes
 * @var string $icon
 */
?>

<?php if ( $type === 'link' ) : ?>
<a href="<?php echo esc_url( $url ); ?>" class="c-button <?php echo esc_attr( $classes ); ?>" <?php echo esc_attr( $dataset ); ?>>
    <span><?php echo $title; ?></span>
    <?php echo $icon; ?>
</a>
<?php endif; ?>

<?php if ( $type === 'button' ) : ?>
<button type="button" class="c-button <?php echo esc_attr( $classes ); ?>" <?php echo $dataset; ?>>
    <span><?php echo $title; ?></span>
    <?php echo $icon; ?>
</button>
<?php endif; ?>

<?php if ( $type === 'submit' ) : ?>
<button type="submit" class="c-button <?php echo esc_attr( $classes ); ?>" <?php echo $dataset; ?>>
    <span><?php echo $title; ?></span>
    <?php echo $icon; ?>
</button>
<?php endif; ?>

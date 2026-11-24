<?php
/**
 * @var string $title
 * @var string $content
 * @var string $link
 * @var string $image
 */
?>

<div class="c-split-image-text-cta-block">
    <div class="c-split-image-text-cta-block__text">
        <h3 class="c-split-image-text-cta-block__heading u-a2"><?php echo $title; ?></h3>

        <p class="c-split-image-text-cta-block__content u-b0">
            <?php echo $content; ?>
        </p>

        <?php echo $link; ?>
    </div>

    <div class="c-split-image-text-cta-block__image">
        <?php echo $image; ?>
    </div>
</div>

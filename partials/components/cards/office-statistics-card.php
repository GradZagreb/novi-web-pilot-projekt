<?php
/**
 * @var string $title
 * @var array $data
 */
?>

<div class="c-office-statistics-card">
    <div class="c-office-statistics-card__header">
        <h2 class="u-b1"><?php echo $title; ?></h2>
    </div>

    <div class="c-office-statistics-card__content">
        <?php foreach ( $data as $item ) : ?>
            <div class="c-office-statistics-card__item">
                <span class="c-office-statistics-card__item-value u-a4"><?php echo $item['value']; ?></span>
                <span class="c-office-statistics-card__item-label u-b4"><?php echo $item['label']; ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

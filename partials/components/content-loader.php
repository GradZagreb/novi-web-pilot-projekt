<?php
/**
 * @var string $background_color
 * @var string $spinner_color
 * @var string $modifier_class
 */
?>

<span class="c-content-loader <?php echo !empty($background_color) ? esc_attr($background_color) : ''; ?> <?php echo !empty($modifier_class) ? esc_attr($modifier_class) : ''; ?> js-content-loader">
    <?php get_partial('components/spinner', array(
        'border_color' => !empty($spinner_color) ? esc_attr($spinner_color) : '',
    )); ?>
</span>

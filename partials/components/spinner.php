<?php
/**
 * @var string $border_color
 * @var string $modifier_class
 */
?>

<span class="c-spinner <?php echo !empty($modifier_class) ? esc_attr($modifier_class) : ''; ?> js-spinner">
    <span class="c-spinner__inner <?php echo !empty($border_color) ? esc_attr($border_color) : ''; ?>"></span>
</span>

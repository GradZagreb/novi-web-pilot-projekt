<?php
/**
 * @var string $label
 * @var string $slug
 */
?>

<div class="c-filter-switch">
    <label class="c-filter-switch__label" for="<?php echo $slug; ?>">
        <div class="c-filter-switch__switch">
            <input type="checkbox" name="<?php echo $slug; ?>" id="<?php echo $slug; ?>" class="c-filter-switch__input">
            <span class="c-filter-switch__slider"></span>
        </div>

        <span class="c-filter-switch__text"><?php echo $label; ?></span>
	</label>

</div>

<?php
/**
 * @var string $label
 * @var string $slug
 * @var array $values
 * @var bool $is_multiselect
 * @var string $align
 */
?>

<?php if ( $is_multiselect ) : ?>
<div class="c-filter-dropdown__wrapper <?php echo ! empty( $align ) ? 'c-filter-dropdown__wrapper--align-' . $align : ''; ?>">
	<div class="c-filter-dropdown c-filter-dropdown--multiselect <?php echo ! empty( $align ) ? 'c-filter-dropdown--' . $align : ''; ?> js-filter-dropdown">
		<button class="c-filter-dropdown__trigger js-filter-dropdown-trigger" type="button">
			<span class="js-filter-dropdown-label"><?php echo $label; ?></span>
			<span class="c-filter-dropdown__indicator">
				<?php echo get_icon( 'chevron-down' ); ?>
			</span>
		</button>
		<ul class="c-filter-dropdown__list js-filter-dropdown-list">
			<?php foreach ( $values as $value ) : ?>
			<li>
				<input type="checkbox" id="<?php echo $slug . '_' . $value['id']; ?>" name="<?php echo $slug . '[]'; ?>" value="<?php echo $value['id']; ?>">
				<label for="<?php echo $slug . '_' . $value['id']; ?>"><?php echo $value['name']; ?></label>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php else : ?>
<div class="c-filter-dropdown__wrapper <?php echo ! empty( $align ) ? 'c-filter-dropdown__wrapper--align-' . $align : ''; ?>">
	<label class="c-filter-dropdown__label"><?php echo $label; ?>:</label>
	<div class="c-filter-dropdown">
		<select name="<?php echo $slug; ?>" class="js-select-input" data-content-location="c-filter-dropdown" data-content-position="relative">
			<?php foreach ( $values as $value ) : ?>
			<option value="<?php echo $value['slug']; ?>"><?php echo $value['name']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>
<?php endif; ?>

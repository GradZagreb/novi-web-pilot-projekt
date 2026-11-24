<?php
/**
 * @var string $image
 * @var string $title
 * @var string $function
 */
?>

<div class="c-employee-card">

	<?php if ( ! empty( $image ) ) : ?>
	<div class="c-employee-card__image">
		<?php echo $image; ?>
	</div>
	<?php endif; ?>

	<div class="c-employee-card__info">
		<h3 class="c-employee-card__name u-a1"><?php echo $title; ?></h3>
		<p class="c-employee-card__function u-b6"><?php echo $function; ?></p>
	</div>
</div>

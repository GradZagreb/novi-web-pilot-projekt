<?php
/**
 * @var string $title
 * @var string $contacts
 */
?>

<section class="c-directory-listing-block">
	<?php if ( ! empty( $title ) ) : ?>
	<header class="c-directory-listing-block__header">
		<h2 class="c-directory-listing-block__heading u-a3"><?php echo $title; ?></h2>
	</header>
	<?php endif; ?>

	<div class="c-directory-listing-block__list">
		<?php echo $contacts; ?>
	</div>
</section>

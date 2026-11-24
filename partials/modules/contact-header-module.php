<?php
/**
 * @var array $settings
 * @var string $title
 * @var string $text
 * @var string $form
 */
?>

<header class="o-header">
	<div class="o-container">
		<div class="c-contact-header-module">
			<div class="c-contact-header-module__content">
				<h1 class="c-contact-header-module__title u-a4"><?php echo $title; ?></h1>
				<div class="c-contact-header-module__text u-b0"><?php echo $text; ?></div>
			</div>
			<div class="c-contact-header-module__form">
				<?php echo do_shortcode( $form ); ?>
			</div>
		</div>
	</div>
</header>

<?php
/**
 * @var array $settings
 * @var string $notifications
 */
?>

<section class="o-section o-section--blue">
	<div class="o-container">
		<div class="c-notifications-module">
			<h2 class="u-a2">
				<?php _e( 'Obavijesti', TEXT_DOMAIN ); ?>
			</h2>

			<div class="c-notifications-module__list">
				<?php echo $notifications; ?>
			</div>
		</div>
	</div>
</section>

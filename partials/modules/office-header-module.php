<?php
/**
 * @var array $settings
 * @var string $title
 * @var string $description
 * @var string $actions
 * @var array $infos
 */
?>

<header class="o-header o-header--light-gray">
	<div class="o-container">
		<div class="c-office-header-module">
			<div class="c-office-header-module__header">
				<h1 class="c-office-header-module__title u-a5"><?php echo $title; ?></h1>
			</div>

			<div class="c-office-header-module__content">
				<div class="c-office-header-module__description u-b1"><?php echo $description; ?></div>

				<?php if ( ! empty( $actions ) ) : ?>
				<div class="c-office-header-module__actions">
					<?php echo $actions; ?>
				</div>
				<?php endif; ?>

				<?php if ( ! empty( $infos ) ) : ?>
				<ul class="c-office-header-module__info">
						<?php foreach ( $infos as $info ) : ?>
						<li class="c-office-header-module__info-item u-b3">
							<span class="c-office-header-module__info-icon">
								<img src="<?php echo $info['icon']; ?>" alt="<?php echo $info['text']; ?>">
							</span>
							<span class="c-office-header-module__info-text"><?php echo $info['text']; ?></span>
						</li>
						<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>

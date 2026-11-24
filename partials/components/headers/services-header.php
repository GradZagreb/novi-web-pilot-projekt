<?php
/**
 * @var string $back
 * @var string $title
 */
?>
<header class="o-header">
	<div class="o-container">
		<div class="c-services-header">
			<a class="c-services-header__back-link u-b3" href="<?php echo $back; ?>">
				<?php
				echo get_icon( 'chevron-left' );
				_e( 'Katalog usluga', TEXT_DOMAIN );
				?>
			</a>
			<h1 class="c-services-header__heading u-a5"><?php echo $title; ?></h1>
		</div>
	</div>
</header>

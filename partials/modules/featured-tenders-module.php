<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $link
 * @var string $tenders
 */
$data = array(
	'settings' => $settings,
	'title'    => $title,
	'link'     => $link,
	'tenders'  => $tenders,
);
?>

<section class="o-section o-section--light-gray">
	<div class="o-container">
		<div class="c-featured-tenders-module">
			<header>
				<h2 class="u-a4"><?php echo $title; ?></h2>
                <?php if ( ! empty( $link ) && is_array( $link ) ) : ?>
                <a href="<?php echo esc_url( $link['url'] ); ?>" class="c-link" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
                <?php endif; ?>
			</header>
			<div class="c-featured-tenders-module__list">
				<?php echo $tenders; ?>
			</div>
		</div>
	</div>
</section>

<?php
/**
 * @var array $breadcrumbs
 */
?>

<nav class="c-breadcrumbs">
	<div class="o-container">
		<ul>
			<?php foreach ( $breadcrumbs as $breadcrumb ) : ?>
			<li>
				<a class="u-b3" href="<?php echo esc_url( $breadcrumb['url'] ); ?>">
					<?php echo esc_html( $breadcrumb['text'] ); ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</nav>

<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $contacts
 * @var array $show_items
 */
$link_types  = array( 'link', 'geo' );
$email_types = array( 'email' );

$data = array(
	'show_items' => $show_items,
	'contacts'   => $contacts,
	'title'      => $title,
);
?>

<section class="o-section">
	<div class="o-container">
		<div class="c-directory-listing-module">
			<?php if ( ! empty( $title ) ) : ?>
			<header class="c-directory-listing-module__header">
				<h2 class="c-directory-listing-module__heading u-b1"><?php echo $title; ?></h2>
			</header>
			<?php endif; ?>

			<div class="c-directory-listing-module__list">
				<?php foreach ( $contacts as $contact ) : ?>
				<div class="c-directory-listing-module__item">
					<h3 class="c-directory-listing-module__item-heading u-a2"><?php echo $contact['title']; ?></h3>
					<?php if ( ! empty( $show_items ) && ! empty( $contact['items'] ) ) : ?>
					<ul>
						<?php foreach ( $contact['items'] as $item ) : ?>
							<?php if ( in_array( $item['type'], $show_items ) ) : ?>
							<li>
								<?php echo get_icon( $item['type'] ); ?>

								<?php if ( in_array( $item['type'], $email_types ) ) : ?>
								<a href="mailto:<?php echo $item['info']; ?>" class="u-b3">
									<?php echo $item['info']; ?>
								</a>
								<?php elseif ( in_array( $item['type'], $link_types ) ) : ?>
								<a href="<?php echo $item['info']; ?>" target="_blank" class="u-b3">
									<?php echo $item['info']; ?>
								</a>
								<?php else : ?>
								<span class="u-b3">
									<?php echo $item['info']; ?>
								</span>
								<?php endif; ?>
							</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

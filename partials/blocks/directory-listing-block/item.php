<?php
/**
 * @var string $title
 * @var array $items
 * @var array $show_items
 */
$link_types  = array( 'link', 'geo' );
$email_types = array( 'email' );
?>

<div class="c-directory-listing-block__item">
	<h3 class="c-directory-listing-block__item-heading u-a2"><?php echo $title; ?></h3>
	<?php if ( ! empty( $show_items ) ) : ?>
	<ul>
		<?php foreach ( $items as $item ) : ?>
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

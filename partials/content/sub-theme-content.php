<?php
/**
 * @var WP_Post $post
 */
?>

<header class="o-header">
    <div class="o-container o-container--thin">
        <div class="c-sub-theme-header">
			<header>
				<h1 class="u-a5"><?php echo $post->post_title; ?></h2>
			</header>
        </div>
    </div>
</header>

<section class="o-section">
	<div class="o-container o-container--thin">
		<div class="c-sub-theme-content rte">
            <?php echo apply_filters( 'the_content', $post->post_content ); ?>
		</div>
	</div>
</section>

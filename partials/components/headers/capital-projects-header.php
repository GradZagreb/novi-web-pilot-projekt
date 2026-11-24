<?php
/**
 * @var string $title
 * @var string $capital_project
 * @var string $featured_news
 */
?>

<header class="o-header">
	<div class="o-container">
		<div class="c-capital-projects-header">
			<h1 class="c-capital-projects-header__heading u-a5"><?php echo $title; ?></h1>
			<div class="c-capital-projects-header__featured-project">
				<?php
					echo $capital_project;
				?>
			</div>

			<div class="c-capital-projects-header__featured-news">
				<h2 class="c-capital-projects-header__news-heading u-a2">
					<?php
					echo get_icon( 'news' );
					_e( 'Novosti', TEXT_DOMAIN );
					?>
				</h2>

				<?php echo $featured_news; ?>
			</div>
		</div>
	</div>
</header>

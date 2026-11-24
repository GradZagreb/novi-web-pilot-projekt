<?php
$template_name = 'single';
get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );

?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">
			<h1><?php the_title(); ?></h1>
			<?php echo bf_content(); ?>
		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();

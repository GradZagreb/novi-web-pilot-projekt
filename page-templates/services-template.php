<?php
/** Template Name: Services template */

use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\postTypes\taxonomies\ServiceLevelTaxonomy;

$template_name = 'services';

$service_level_terms = get_terms(
	array(
		'taxonomy'   => ServiceLevelTaxonomy::SLUG,
		'hide_empty' => false,
	)
);

function build_nested_terms( $terms ) {
	$terms_by_id  = array();
	$nested_terms = array();

	foreach ( $terms as $term ) {
		$terms_by_id[ $term->term_id ]           = $term;
		$terms_by_id[ $term->term_id ]->children = array();
	}

	foreach ( $terms_by_id as $term ) {
		if ( $term->parent && isset( $terms_by_id[ $term->parent ] ) ) {
			$terms_by_id[ $term->parent ]->children[] = $term;
		} else {
			$nested_terms[] = $term;
		}
	}

	return $nested_terms;
}

$nested_service_levels = build_nested_terms( $service_level_terms );

get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );
?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">

			<header class="o-header">
				<div class="o-container">
					<div class="c-services-catalogue-header">
						<h1 class="u-a4"><?php the_title(); ?><h1>
					</div>
				</div>
			</header>

			<section class="o-section">
				<div class="o-container">
					<div class="c-services-catalogue-list">
						<div class="c-service-accordion js-accordion is-mono">
							<?php foreach ( $nested_service_levels as $level ) : ?>
							<div class="c-service-accordion__single js-accordion-single">
								<div class="c-service-accordion__header u-a2">
                                    <a href="<?php echo esc_url( get_term_link( $level ) ); ?>">
                                        <?php echo $level->name; ?>
                                    </a>
									<button class="c-service-accordion__indicator js-accordion-header">
										<span></span>
									</button>
								</div>
								<div class="c-service-accordion__panel js-accordion-panel">
									<div class="c-service-accordion__panel-inner">
										<?php if ( ! empty( $level->children ) ) : ?>
										<ul>
											<?php foreach ( $level->children as $child ) : ?>
											<li>
                                                <a class="u-b3" href="<?php echo esc_url( get_term_link( $level ) ); ?>?selected-levels[]=<?php echo $child->term_id; ?>" class="c-services-catalogue-list__link">
													<?php echo $child->name; ?>
												</a>
											</li>
											<?php endforeach; ?>
										</ul>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

			<?php get_modules_partial( ACFProvider::get_instance()->get_field( 'modules' ) ?? array() ); ?>

		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();

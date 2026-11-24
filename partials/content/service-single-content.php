<?php
/**
 * @var string $title
 * @var string $link
 * @var array $themes
 * @var array $offices
 * @var array $levels
 * @var array $users
 * @var array $citizenships
 * @var string $responsible_party
 * @var string $description
 * @var string $documentation
 * @var array $request
 * @var array $request_submission
 * @var array $contacts
 * @var bool $administrative_fee
 * @var string $administrative_fee_amount
 * @var string $prerequisite
 * @var string $procedure
 * @var string $legal_framework
 * @var bool $e_service
 * @var bool $appeal
 */
?>

<header class="o-header">
	<div class="o-container o-container--thin">
		<div class="c-service-single-header">
			<h1 class="c-service-single-header__heading u-a5"><?php echo $title; ?></h1>
		</div>
	</div>
</header>

<section class="o-section">
	<div class="o-container o-container--thin">
		<div class="c-service-single-content">

			<?php if ( ! empty( $description ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Opis usluge', TEXT_DOMAIN ); ?>:</h2>
				<?php echo $description; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $users ) && is_array( $users ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Korisnik usluge', TEXT_DOMAIN ); ?>:</h2>
				<ul>
					<?php foreach ( $users as $user ) : ?>
						<li><?php echo $user->name; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<?php if ( ( ! empty( $offices ) && is_array( $offices ) ) || ! empty( $responsible_party ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Nadležnost', TEXT_DOMAIN ); ?>:</h2>
				<?php if ( ! empty( $offices ) && is_array( $offices ) ) : ?>
				<ul>
					<?php foreach ( $offices as $office ) : ?>
					<li>
						<?php echo $office->name; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if ( ! empty( $responsible_party ) ) : ?>
				<p><?php echo $responsible_party; ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $contacts ) && is_array( $contacts ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Kontakt informacije', TEXT_DOMAIN ); ?>:</h2>
                <div class="c-service-single-content__grid">
				<?php foreach ( $contacts as $contact_group ) : ?>
					<?php if ( ! empty( $contact_group['contact'] ) && is_array( $contact_group['contact'] ) ) : ?>
                        <div class="c-contact-card u-b4">
                        <?php foreach ( $contact_group['contact'] as $item ) : ?>
                            <?php if ( ! empty( $item['text'] ) && ! empty( $item['type'] ) ) : ?>
                                    <?php
                                    $label = '';
                                    switch ( $item['type'] ) {
                                        case 'email':
                                            $label = __( 'E-pošta', TEXT_DOMAIN );
                                            break;
                                        case 'address':
                                            $label = __( 'Adresa', TEXT_DOMAIN );
                                            break;
                                        case 'phone':
                                            $label = __( 'Telefon', TEXT_DOMAIN );
                                            break;
                                        case 'working_hours':
                                            $label = __( 'Radno vrijeme', TEXT_DOMAIN );
                                            break;
                                    }
                                    ?>
                                    <div class="c-contact-card__item">
                                        <span class="c-contact-card__label"><?php echo $label; ?>:</span>
                                        <?php if ( $item['type'] === 'email' ) : ?>
                                            <a href="mailto:<?php echo esc_attr( $item['text'] ); ?>" class="c-contact-card__text">
                                                <?php echo esc_html( $item['text'] ); ?>
                                            </a>
                                        <?php else : ?>
                                            <span class="c-contact-card__text"><?php echo esc_html( $item['text'] ); ?></span>
                                        <?php endif; ?>
                                    </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
					<?php endif; ?>
				<?php endforeach; ?>
                </div>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $documentation ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Dokumentacija', TEXT_DOMAIN ); ?>:</h2>
				<?php echo $documentation; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $request ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Zahtjev', TEXT_DOMAIN ); ?>:</h2>
				<?php echo $request; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $request_submission ) && is_array( $request_submission ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Način podnošenja zahtjeva', TEXT_DOMAIN ); ?>:</h2>
				<ul>
					<?php foreach ( $request_submission as $submission ) : ?>
						<li><?php echo $submission['label']; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Upravna pristojba', TEXT_DOMAIN ); ?>:</h2>
				<?php $administrative_fee ? _e( 'Da', TEXT_DOMAIN ) : _e( 'Ne', TEXT_DOMAIN ); ?>
			</div>

			<?php if ( $administrative_fee && ! empty( $administrative_fee_amount ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Iznos upravne pristojbe', TEXT_DOMAIN ); ?>:</h2>
				<?php echo $administrative_fee_amount; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $prerequisite ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Preduvjet za korištenje usluge', TEXT_DOMAIN ); ?>:</h2>
				<?php echo $prerequisite; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $procedure ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Postupak', TEXT_DOMAIN ); ?>:</h2>
				<?php echo $procedure; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $legal_framework ) ) : ?>
			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Pravni okvir', TEXT_DOMAIN ); ?>:</h2>
				<?php echo $legal_framework; ?>
			</div>
			<?php endif; ?>

			<div class="c-service-single-content__info">
				<h2 class="u-a2"><?php _e( 'Pravni lijek', TEXT_DOMAIN ); ?>:</h2>
				<?php $appeal ? _e( 'Da', TEXT_DOMAIN ) : _e( 'Ne', TEXT_DOMAIN ); ?>
			</div>

		</div>
	</div>
</section>

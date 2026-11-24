<?php
use gradZagrebWeb2024\bundles\GradZagrebWeb2024Assets;

GradZagrebWeb2024Assets::register();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<title>
			<?php echo wp_title( '' ); ?>
		</title>

		<link rel="icon" type="image/png" href="<?php echo bu( 'ui/favicon/favicon-96x96.png' ); ?>" sizes="96x96" />
		<link rel="icon" type="image/svg+xml" href="<?php echo bu( 'ui/favicon/favicon.svg' ); ?>" />
		<link rel="shortcut icon" href="<?php echo bu( 'ui/favicon/favicon.ico' ); ?>" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo bu( 'ui/favicon/apple-touch-icon.png' ); ?>" />
		<meta name="apple-mobile-web-app-title" content="Grad Zagreb" />
		<link rel="manifest" href="<?php echo bu( 'ui/favicon/site.webmanifest' ); ?>" crossorigin="use-credentials" />

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

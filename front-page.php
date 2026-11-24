<?php
use gradZagrebWeb2024\controllers\HomeController;

$home_controller = new HomeController( get_page_template_slug() );
echo $home_controller->get_view();

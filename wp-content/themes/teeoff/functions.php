<?php
defined( 'ABSPATH' ) || exit;

define( 'TEEOFF_VERSION', '1.0.9' );
define( 'TEEOFF_DIR', get_template_directory() );
define( 'TEEOFF_URI', get_template_directory_uri() );

require_once TEEOFF_DIR . '/inc/setup.php';
require_once TEEOFF_DIR . '/inc/icons.php';
require_once TEEOFF_DIR . '/inc/media-helpers.php';
require_once TEEOFF_DIR . '/inc/cpt.php';
require_once TEEOFF_DIR . '/inc/meta-boxes.php';
require_once TEEOFF_DIR . '/inc/page-fields.php';
require_once TEEOFF_DIR . '/inc/customizer.php';
require_once TEEOFF_DIR . '/inc/forms.php';
require_once TEEOFF_DIR . '/inc/security.php';
require_once TEEOFF_DIR . '/inc/seo.php';
require_once TEEOFF_DIR . '/inc/provisioning.php';

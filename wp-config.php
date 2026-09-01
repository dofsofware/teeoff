<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'teeofftechnologiesenegal' );

/** Database username */
define( 'DB_USER', 'suntel' );

/** Database password */
define( 'DB_PASSWORD', 'suntel' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'b?]MXF:l|;J{sg)EzUES^boExxTyHv@M3AxZJx7@Hew%I}]@V4@9jM6kQ /eR;0.' );
define( 'SECURE_AUTH_KEY',  'nv=i/]J! c6K55F#]T.VRz)8H,88F^46cA(n#9.(hXCEDxDorMY?f*A[3*H(]jRe' );
define( 'LOGGED_IN_KEY',    '8j0p6I;}pTys)vXTR)Ll?5^< b*n2S!AhRlNhzIYFXo%8%sbeK9]+^_xfcx=sPaC' );
define( 'NONCE_KEY',        '.TL~NTjI/WBTL870F%n?L1q.|$~nGk 5l1M;kDCkNZ:%L5u>.MdjL~mSpuNNyUfe' );
define( 'AUTH_SALT',        '5ZZx=E-U8E)_vi*}yl=^ao*():fpI_vQY+RoBPC $v8eq0ty!*`d5>}VF)^96MN>' );
define( 'SECURE_AUTH_SALT', ']KitnIWQlQMQwjwfyM5;@|b[*)MGv}aiS56>y~$:zcHn*4HiTCME,NAy1&hj)xHz' );
define( 'LOGGED_IN_SALT',   'C^&m$4cv/Gymdm~7k^i8U^+_;I=27~Q1]:C%uYVsO8U!{kAw-;xY~G2n_@:rjZ96' );
define( 'NONCE_SALT',       '^3y%nlqI/TYd1g]I9gm^@or_|-yy:b&rsgUtb79p2G}SUl;y{(xdD>-/[j_2^|,p' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'tots_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

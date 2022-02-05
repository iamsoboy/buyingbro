<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pur_blog_XcB' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'D7n~&o-qG%9A2Zrqjh:r]?BvOBp@DF(B+5J;1$z2WQ.W!T2Sv*b7?;|f$E,ZatFX' );
define( 'SECURE_AUTH_KEY',  'lI#s.u`WnNVQ<F*uqh09>3/1oAb_ GgV]-6*R$e8;(_2OHboeoyC[V|/E>SVn}Pl' );
define( 'LOGGED_IN_KEY',    ':dr#G/Ys.sOm0kGx,CiafBU(qsON |:W>;]K^andqPx8foHEz}1}%=(!KB|[$p*P' );
define( 'NONCE_KEY',        '!(SwiXqmEh^xwlDP?g]VnogIP9u{fUg/:fzq-,XZhQC9%Qht0!C%m=(yXFvmq:EP' );
define( 'AUTH_SALT',        'z2yx/i881Ts316}P,Z`GOrWuqwYW5(u ~pTG^ Sc`wxO`^dm6X;c<_G]N7]N xoI' );
define( 'SECURE_AUTH_SALT', '0t7 b0)Mz.7$n6HL^<:^3f(rJm)_rxg ],Z+_b,9CVWBG.zyRgLu!wwSM*eu&pvm' );
define( 'LOGGED_IN_SALT',   't8Sx0BQ<EfiA3T&WZ}Su:|53iJ8ywyw;8{V+ PN^#t_rMO~b801)[6m9{xZ/7jt ' );
define( 'NONCE_SALT',       'z>u*n` )!OQYJ7He1wHj`SCa *fJyUsTJ$U/LU99wi!-!+89Gi1*h5qB+28BX#P#' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'Z5ReqL_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

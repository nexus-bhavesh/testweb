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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'rcFpJx/IZBxo/-mI$EYet?L.~3oi*Eu}=_TLj8bp7{$0Pb2j6#SGc&V{zH|A}:aU');
define('SECURE_AUTH_KEY',  'E8i~G~}mzC6_-rxJZa3R W835kTeec0V13c.ZiDs Q :B!?k^;9KE 8c@3Hn=08>');
define('LOGGED_IN_KEY',    ')&WJx3#E^>NCRn$l$Y8:qsY6xz5#Mc4gbDb|?xrDA h8.vok[uASnEH!i_K1p=4x');
define('NONCE_KEY',        'AI_[h:B#rfAF4BBfL4nZg7t7(Y$W`c-` h%MIfkD&s`8@zhTR!$Fz|.BQIA~NNIo');
define('AUTH_SALT',        'e(-M3fA7S<H80W%OOXf=#kDK`DPQ1&!e[-|fvHtuAykk/b;CO?OyvL)qvWbLo9*t');
define('SECURE_AUTH_SALT', 'o(BCh0>%^ex`h/KUbK#Z~QAxzvFlI9n)zlA-O!pKngi~4t&sfzPovg56&wsH$~d5');
define('LOGGED_IN_SALT',   'D*(R9Qw9$,FK+jKYVyq+y[;[E:(=1GA5PQ71}lb]]#ec:R6PF_{!);#l#eu#,}He');
define('NONCE_SALT',       'h_R6~j;9Z[D3as;5Gvw# AiJ#qvI9[1odryJ?6c;>g0rmO/gz]&lQ5I.]EN@L.KE');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

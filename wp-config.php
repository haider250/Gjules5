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
define( 'DB_NAME', 'database_name_here' );

/** Database username */
define( 'DB_USER', 'username_here' );

/** Database password */
define( 'DB_PASSWORD', 'password_here' );

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
define( 'AUTH_KEY',         'p5u0PDYbr1IOuh+j1XZA4VJrxieZyQ1fxeWIYAYGih0WbxiLDVyKTVj0mQEguEgc' );
define( 'SECURE_AUTH_KEY',  'NO6K8UEpF31fthuT0Btduu0goTss9wWT/yUHgAxP8UZm56Qn7vbNOnotsQSODXXD' );
define( 'LOGGED_IN_KEY',    'mJSK0ltDC7j7ezvyq++ksy9qtywqX1KqV6yehgYJIkL8p0fBVtAa0ZBOcRI7SbR7' );
define( 'NONCE_KEY',        'krg8GbUOOawpxqPhrfCZxjEp0etAoLEAvYBVxbzTuyolLM00wJzKDR4wqFJw+281' );
define( 'AUTH_SALT',        'lRHh9MDPrqL9r4Yt1hlxNqW/b7Vjg/7U7Kkl/Vr0FEbox7qYQqpX3GPJEH6n9oml' );
define( 'SECURE_AUTH_SALT', 'I2LNGoZZJ1M+1hq4oaQRnAqX7Z2N3cy0yApE5WN6oPWXYdwGwXd0aEkyl/NH3ktw' );
define( 'LOGGED_IN_SALT',   'yrQ5QoKt63DeDmDkh6sAXAPB/uPhZDjZLA0XfXwkkxoavGzgIN2/PKJedQ/64HCf' );
define( 'NONCE_SALT',       'YScve69q6uND2WvSSkW5Sg5B95vEUT5LdJ2YpMktQ7NLeXFM42dFzj9nhUD78nqP' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

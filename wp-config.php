<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bookswebsite' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '{0<y0Ux0d;0Y05i/[mfTlAiA:o%3mi(yv%oN9dZDvUu`%mk]hfL)x/FX1dayLG#M' );
define( 'SECURE_AUTH_KEY',  'W>ZtT*{qJ4YMLxW]?gA/U=t3X]{obO~u]flt[Qg<W22W!<J6)H9*GN9T9Q< B&].' );
define( 'LOGGED_IN_KEY',    'r%~qv+T61bfKy*ycxFm/Rn>i[_8):FYL^2~P))apaH{r7X]^*DX~@9M(rB5C/4>9' );
define( 'NONCE_KEY',        '%G.UhX{`H&1IXVHb]Id4+t^K3W=dI EwThRWo X/Zp/ofk(!0B:_!Ze&12F0|cua' );
define( 'AUTH_SALT',        'q>SF6%!MR)4K_5_0_%1W n+0vxBOSE6d!3>NCgo](6;yWvofRlcb5]G7zl=ny*.<' );
define( 'SECURE_AUTH_SALT', ' *dr7X_laf7c}f3@q[lFRIO2}q$CsQ*UQN9K7x*jal YAQi)x2Tr@kMi]T!ATacW' );
define( 'LOGGED_IN_SALT',   '_=W*,vgWrjkj,wG1CsDMH){q{F:SNR:J))(zYo8$=K4zAL>:>F{FMDV hiCjY5sQ' );
define( 'NONCE_SALT',       '-l1i8H`sN+dG-~dI&Ly){h;)*?dXUZv*>BTG>R=x&~u~KiB<_{AO[Ktzlm)HW8Oc' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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

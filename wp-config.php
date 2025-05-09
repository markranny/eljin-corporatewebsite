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
define( 'DB_NAME', 'eljin_bakeshop' );

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
define( 'AUTH_KEY',         'jm;F(#x)+*W*t8Qk<?LUS[4w@mWFq7]d4X[k2vv^F>%AP<$zRI8`>c9qbx@qBZhJ' );
define( 'SECURE_AUTH_KEY',  'ziH.rim[k%z<Qi.3e+X0=A[EU@mVIE3?}1C`[@=r%6u-]L8sQp!V0YRwUr10~e}1' );
define( 'LOGGED_IN_KEY',    'R^hdeV(Cc*tw2.@ev*;xb;]qo%X`flhhM/FAUGGKjt,Tkcuq/m=[>3!1Q#bBES?G' );
define( 'NONCE_KEY',        'M fsV}o*K5)K=lY(46wq]&.buJaq +}ze|ZM@K60;Sl9s+OR:Ng;#?ZCEfl4K,o;' );
define( 'AUTH_SALT',        '.IX{OVkq6[:8~`U*szajVD(Tde/M}<UJ%fY2{>./2vsYi)5W|BVP/K}eWf6yfPAT' );
define( 'SECURE_AUTH_SALT', 'I3(k1%pWy1DBfqZM`+(506QH6=ID>.b[p>o8.G|6eoV$afY7mqUs9@ sR%<P@lk*' );
define( 'LOGGED_IN_SALT',   '>4eG;tp03Jt:rK4O0d0YZFUz~tp:0EIC~+>Kv;0{TOEe`o*j/HnXzG8h`NDe`E[J' );
define( 'NONCE_SALT',       'IxcG*!PU[Pj`Swopu1 @#`hnLNW^QW%A3f_v@r2tC[,tA8lx|={zdb&a$E[eKLiv' );

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

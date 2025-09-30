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
define( 'DB_NAME', 'app_web1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'pass' );

/** Database hostname */
define( 'DB_HOST', 'web-mysql' );

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
define( 'AUTH_KEY',         'VZwQ{3P!6mM~LTzRqqi=*+XX_/kWSj5bW:aF3ooDCZ=(V)(-7S/-,e8RApc{u&/*' );
define( 'SECURE_AUTH_KEY',  '3#vZS8Tt2h}Y0+H|.ckD1I^%V2!UV-h;%V>q|??g^iZv2s]){Z}3m^v*Rbl[|qd:' );
define( 'LOGGED_IN_KEY',    '>:0ib,fI_$kBIi?( <6,=C5iXh1F;i/nHN|$40-M)z *Vp2qnw]zHY+JK<A6j@xK' );
define( 'NONCE_KEY',        '(CCiLEtkl{~t++[[P!bi2P,[`8+[EY2F?jl%1w4zh>PSjd/aFU-_{uVT!Km:]n<i' );
define( 'AUTH_SALT',        'mrlKqe69HGO]q8J(m^euh=WC1Ha1Or.8~7E$7$lM4Gv`-+R=JF SwL|>Zi6sk1N2' );
define( 'SECURE_AUTH_SALT', 'PMBz1;m^Sw7#Mn:TDq>:;*i{;ytFF3L9tJ5jkUfE`.KmST2y.){Tiw^TJ6lku1)R' );
define( 'LOGGED_IN_SALT',   '`kmo&g{E=D&x>85#s3}o>#ionU}2?cGJZbo[cU9TzIci<;0V/XQ3V5uYpoH29]u+' );
define( 'NONCE_SALT',       'XU|X=4IY3d7fsNskD~SwKvlga~oW2Q?A`,*-wi:=z3E)pjbZ;cW?KJb>2P6-#*#M' );

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

define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

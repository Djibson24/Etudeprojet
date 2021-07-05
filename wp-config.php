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
define( 'DB_NAME', 'etudesprojet' );

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
define( 'AUTH_KEY',         'wd#gwde9;@GqqIekZ b 8$L)o;Gxzz+XgRhs-&bFvUecy]Co?Vb3)T:rZ#ot9oo^' );
define( 'SECURE_AUTH_KEY',  'LBcPa:6]&vKL8.uE}4FW^-qeI0<4}Sb48v*+!.k48 g4?o2h|_ib{;g.A:=Hm#.=' );
define( 'LOGGED_IN_KEY',    'x)jVUGI.hkm&4=Y6)%2F xRqTWELWJ_H-ajZ*)%#Ld(/Itg.V4X*#2N1Q0fFznKC' );
define( 'NONCE_KEY',        '{TP^V>s!z0i+]FK!vO$wYg@:0XM92*[(p:XRYt5!l/S3eIaC%E_-H)WIPh(cJ_XE' );
define( 'AUTH_SALT',        'ZJYgaY<1Q]:.DF`+RBvc@W1d<lRpw$2KfWn6,)B9}IefcgJV>z&/-ooYVbqr)tM_' );
define( 'SECURE_AUTH_SALT', 'v/B2z^ao$;SeP#ne7W&D;kz^T21P|8*OQM?CjKPrIlSy[CzSZPWaD;5)O+AnM-cN' );
define( 'LOGGED_IN_SALT',   'q;%a[XuI0!YloN}WSv{+_1Tcq%&Bn|^Ci-[e}sucJ0V+#%6AOoH67 NblxQ_&NdR' );
define( 'NONCE_SALT',       'a8ELLJ3~o58u[rddp il;,2*{2r!4A#ZZ*)IF=vI=%|{l)YmXL`MwTvDFBoOxA+|' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

<?php
# BEGIN WP Cache by 10Web
define( 'WP_CACHE', true );
define( 'TWO_PLUGIN_DIR_CACHE', __DIR__ . '/wp-content/plugins/tenweb-speed-optimizer/' );
# END WP Cache by 10Web
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
function wp_env_or_default( $key, $default = null ) {
	$val = getenv( $key );
	if ( $val === false || $val === '' ) {
		return $default;
	}
	return $val;
}

$wp_db_name = wp_env_or_default( 'MYSQLDATABASE', wp_env_or_default( 'DB_NAME', '' ) );
$wp_db_user = wp_env_or_default( 'MYSQLUSER', wp_env_or_default( 'DB_USER', '' ) );
$wp_db_pass = wp_env_or_default( 'MYSQLPASSWORD', wp_env_or_default( 'DB_PASSWORD', '' ) );
$wp_mysql_host = wp_env_or_default( 'MYSQLHOST', null );
$wp_mysql_port = wp_env_or_default( 'MYSQLPORT', null );
$wp_db_host = wp_env_or_default(
	'DB_HOST',
	$wp_mysql_host ? ( $wp_mysql_port ? $wp_mysql_host . ':' . $wp_mysql_port : $wp_mysql_host ) : 'localhost'
);

define( 'DB_NAME', $wp_db_name );

/** Database username */
define( 'DB_USER', $wp_db_user );

/** Database password */
define( 'DB_PASSWORD', $wp_db_pass );

/** Database hostname */
define( 'DB_HOST', $wp_db_host );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'r3&]f@cO?gyMw&Yp^]n$@B#sUR}uMBKam|n6P`(*E4MO_EN:`yeo#Z/w[8U=~N=B' );
define( 'SECURE_AUTH_KEY',   'A)fPjpr,MKr;$&W-UW|5:B=ftKD]ZUkyv/[Q!+ J1>BsUs/OZPY-u`<lo<GHg^b,' );
define( 'LOGGED_IN_KEY',     'cL7iTUYQJpj,`S-K73sIg5BhdKjhgFQ$Z8wALLv=Bxp.Q%{hS=]/w4Y[_sbzhQuH' );
define( 'NONCE_KEY',         '$Ln7bOAjHPu;niV2DU&av|mT1E5<|^}.9(`y|<8qs !Z#DbByegO;=JD=?Vk6xPJ' );
define( 'AUTH_SALT',         ')y$y|:f7E6N1(sF,.TPrgwbSZrXRB|5+4sJ).vVXKMC|D{u1]Ans)>;C7hhp<^.5' );
define( 'SECURE_AUTH_SALT',  'VrlD w`v_xTi[.3?SgH`iiXW@qLFhqQV1E#oQ4Y MmJNl3w6DH$Xps*m@_`u)MIp' );
define( 'LOGGED_IN_SALT',    'm|!_Yh_k3EDF$ADrT{1r9q?S?%i)m3Y?m^]O0GtA>0G*F5.dsD?aM5#K5oIk%K:C' );
define( 'NONCE_SALT',        'm+|rB80mnSW@ >mEmyK9%hn2B~-$e4tx)AD&;l+AydE]WSP|6mqCX1c y@?=G/}]' );
define( 'WP_CACHE_KEY_SALT', 'KdJt,6X]nw*7~=]~HutFzM=ox5Q5c1aF3tT#2c@&*`^m0I)$)i0__5$$IYP9B03d' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

$wp_home = wp_env_or_default( 'WP_HOME', null );
if ( $wp_home ) {
	define( 'WP_HOME', $wp_home );
}

$wp_siteurl = wp_env_or_default( 'WP_SITEURL', null );
if ( $wp_siteurl ) {
	define( 'WP_SITEURL', $wp_siteurl );
}



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '521657e44ea78f7d48e3ecda3ffc362a' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

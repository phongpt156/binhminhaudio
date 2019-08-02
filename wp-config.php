<?php
define( 'WPCACHEHOME', '/home/binhminhau/domains/binhminhaudio.local/public_html/wp-content/plugins/wp-super-cache/' );
define('WP_CACHE', true);

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
define("OTGS_DISABLE_AUTO_UPDATES", true);
define('WP_AUTO_UPDATE_CORE', true );
define('DISALLOW_FILE_MODS', true );
define('DISALLOW_FILE_EDIT', true );

define( 'WP_POST_REVISIONS', false );

define( 'AUTOMATIC_UPDATER_DISABLED', true );

define('DB_NAME', 'binhminhau_admin');

/** MySQL database username */
define('DB_USER', 'zed');

/** MySQL database password */
define('DB_PASSWORD', '123123123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '~zvx.{$Lw{CS_6XStUaBg$8+2Z7x?NN`6[_0#Is]u@X):{/[8cTwpN@#Yk9:Kf.n');
define('SECURE_AUTH_KEY',  '+>B4ww:Z*H$-(jx;0]uOWtW:bXF-}Qj&zg/ !(nSD#bwrb(b6{<+Dn)FGy*P&WDE');
define('LOGGED_IN_KEY',    'sZt[yrhw+E~gGPndv4pe=LE|lAcG%tu{`<NO}5U<;~[E8WqIrr9lts[?!Dib|g+V');
define('NONCE_KEY',        ',.>lB-*{VF?9+J)?Cb?GMvYjt@Cb4a}DillE8N h2[jxdu.P$6!6GWlS`3-/)bI/');
define('AUTH_SALT',        'D;>L@lyA4gt/)UL<$$AFO0Y1%ExL6nbW16p@ `7vaDv}!6}jgkWI$Yf<8#?U3uEm');
define('SECURE_AUTH_SALT', 'TA3*CrN57wLQ|nh&P?f&-X2zZ015;56O.4=aN39CQAyN2xZ7zAg|8x^5Q_9G[0PJ');
define('LOGGED_IN_SALT',   'NCY9{#uJ~nv0$b9RnfAu.oSK]4>y:_RB>c+X?Vgy_-{(BJZS[@}4HWgN/yZkx(1s');
define('NONCE_SALT',       '< E-=?]CYO}~$>T_+[DuFDxYinJ=F*^-JP,^Hh0~$u4HMsq`/Hc.<T$f5>,2pvs}');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

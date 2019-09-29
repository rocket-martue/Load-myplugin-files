<?php
/**
 * Plugin name: Load myplugin files
 * Plugin URI: https://github.com/rocket-martue/Load-myplugin-files
 * Description: Load the php files in the '/ wp-content / myplugin' directory. In that case, the thing whose file name begins with an underscore (example: _example.php) is not included.
 * Version: 1.0.0
 * Author: Rocket Martue
 * Text Domain: load-myplugin-files
 * Domain Path: /languages/
 * Created: April 14, 2016
 * Modified: September 16, 2019
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

$dir = trailingslashit( WP_CONTENT_DIR ).'myplugin/';
if ( ! file_exists( $dir) ) {
	$myplugin = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'myplugin';//basename( 'myplugin' );
	mkdir( $myplugin );
} else {
	opendir( $dir );
	while( ( $file = readdir() ) !== false ) {
		if( ! is_dir( $file ) && ( strtolower( substr( $file, -4 ) ) == ".php" ) && ( substr( $file, 0, 1 ) != "_" ) ) {
			$load_file = $dir.$file;
			require_once( $load_file );
		}
	}
	closedir();
}

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/rocket-martue/Load-myplugin-files/',
	__FILE__,
	'load-myplugin-files'
);
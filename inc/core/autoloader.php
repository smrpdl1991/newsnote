<?php
/**
 * @package: NewsNote
 * @author: NewsNote
 * @since 1.0.0
 */
if( !function_exists( 'newsnote_autoload_register_callback' ) ){

	function newsnote_autoload_register_callback($class_name){

		$class_details = explode( '\\', $class_name );
		if(!isset($class_details[0])){
			return;
		}
		if($class_details[0]!='NewsNote'){
			return;
		}
		unset($class_details[0]);
		if(!$class_details){
			return;
		}
		$file_path = implode( DIRECTORY_SEPARATOR, $class_details);
		$sanitize_path = str_replace('_', '-', $file_path );
		$full_file_path= NEWSNOTE_FILE_PATH.DIRECTORY_SEPARATOR.strtolower($sanitize_path).'.php';
		$sanitize_file_path = wp_normalize_path( $full_file_path );
		require_once $sanitize_file_path;

	}

}
spl_autoload_register( 'newsnote_autoload_register_callback' );

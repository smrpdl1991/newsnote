<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Customizer;
class Index{

	public function __construct(){
		$this->control();
		$this->hooks();
	}

	public function control(){
		require_once NEWSNOTE_FILE_PATH.'/inc/customizer/custom-controls.php';
	}

	public function hooks(){

		new Theme_Options();
		new Header_Options();
		new Footer_Options();
		new Templates();

	}

}
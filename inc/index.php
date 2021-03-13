<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc;
class Index{

	public function __construct(){
		$this->hooks();
	}

	public function hooks(){

		new Hooks\Index();
		new Widgets\Index();
		new Customizer\Index();

	}

}
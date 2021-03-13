<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Hooks;
class Index{

	public function __construct(){
		$this->init();
	}

	public function init(){
		new Setup();
		new Enqueue();
	}

}


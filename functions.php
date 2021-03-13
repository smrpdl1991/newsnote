<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */

if( !class_exists( 'NewsNote_Setup' ) ){

    class NewsNote_Setup{

        public function __construct(){
            $this->definition();
            $this->dependencies();
            $this->starter();
        }

        public function definition(){

            if(!defined('NEWSNOTE_VERSION')){
                define( 'NEWSNOTE_VERSION', '1.0.0' );    
            }

            if(!defined('NEWSNOTE_FILE_PATH')){
                define( 'NEWSNOTE_FILE_PATH', dirname( __FILE__ ) );
            }

        }

        public function dependencies(){
            require_once wp_normalize_path(NEWSNOTE_FILE_PATH.'/inc/core/functions.php');
            require_once wp_normalize_path(NEWSNOTE_FILE_PATH.'/inc/core/autoloader.php');
        }

        public function starter(){

            new \NewsNote\Inc\Index();

        }

    }

}
new \NewsNote_Setup();

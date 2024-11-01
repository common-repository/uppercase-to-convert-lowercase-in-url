<?php
/**
 * Plugin Name:     Uppercase URLs Convert to Lowercase URLs automatically
 * Plugin URI:      https://maczin.com.au
 * Description:     All the Uppercase URLs convert to Lowercase URLs automatically.
 * Version:         1.0
 * Author:          maczin
 * Author URI:      http://maczin.com.au/
 */
if ( !defined('ABSPATH') ) exit; 
if ( !class_exists('MZ_UppertToLowerURLs') ) {
  class MZ_UppertToLowerURLs {
     public static function MZ_UP_TO_LP() {
    $mz_up_lp_url = $_SERVER['REQUEST_URI'];
    $mz_par = $_SERVER['QUERY_STRING'];
     if ( preg_match('/[\.]/', $mz_up_lp_url) ) {
        return;
      }
    if ( preg_match('/[A-Z]/', $mz_up_lp_url) ) {
        $lc_mz_up_lp_url = empty($mz_par)
          ? strtolower($mz_up_lp_url)
          : strtolower(substr($mz_up_lp_url, 0, strrpos($mz_up_lp_url, '?'))).'?'.$mz_par;
       if ($lc_mz_up_lp_url !== $mz_up_lp_url) {
          header('Location: '.$lc_mz_up_lp_url, TRUE, 301);
          exit();
        }
      }
    }
   public static function init() {
     if ( !is_admin() ) {
        add_action( 'init', array('MZ_UppertToLowerURLs', 'MZ_UP_TO_LP') );
      }
    }
   }
  MZ_UppertToLowerURLs::init();
}
<?php
/**
* @package DR
*/
/*
Plugin Name:DR
Plugin URL:
Description:
Version:1.0.0
Author:DR MANIYA
Author URL:
License:
Text-Domain:DR-Plugin

*/
defined('ABSPATH') or die('hey ,what are you doing herr?');
if(!class_exists('DR')){
 class DR
  {
    public $plugin;
		function __construct() {
		  	$this->plugin = plugin_basename( __FILE__ );
    }
      
    function register(){
      add_action('admin_enqueue_scripts',array($this,'enqueue'));
      add_action('admin_menu',array($this,'add_admin_pages'));
      add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
    } 

     public function settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=dr_plugin">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
      }

      public function add_admin_pages(){
         add_menu_page('DR plugin','DR','manage_options','dr_plugin',array($this,'admin_index'),'dashicons-store',110);
      }
      public function admin_index(){
        require_once plugin_dir_path(__FILE__).'templates/admin.php';
      }
      
      protected function create_post_type(){
        add_action('init',array($this,'custom_post_type'));
    }
      function custom_post_type(){
          register_post_type('book',['public'=>true,'label'=>'Books']);
      }
      
      function enqueue(){
          wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css',__FILE__));
          wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js',__FILE__));
      }
      function activate(){
            require_once plugin_dir_path(__FILE__). 'inc/DR_plugin_activate.php';
            DRpluginActivate::activate();
      }
}


   $dr = new DR();	
   $dr->register();
 
register_activation_hook(__FILE__, array($dr,'activate'));

 require_once plugin_dir_path(__FILE__). 'inc/DR_plugin_deactivate.php';
 register_deactivation_hook(__FILE__,array('DR_plugin_deactivate','deactivate'));
}

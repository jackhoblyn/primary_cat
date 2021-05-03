<?php
/**
* @package custom-plugins-beta 
*/

/*
Plugin Name: primary_category
Plugin URI: http://sageexcercise.ie/custom-plugins-beta
Description: My attempt at the Sage plugin excercise
Version: 1.0.0
Author: Jack Hoblyn
Author URI: http://sageexcercise.ie
Licence: GPLv2 or later
Text Domain: primary_category
*/


//Create new dropdown field on posts, primary category

defined ( 'ABSPATH' ) or die("Plugin Error, please contact admin");


class primary_cat 
{
    public $plugin;

    function activate() {
        //Create primary_category field on posts
        global $wpdb;
        $wpdb->query("ALTER TABLE wp_posts ADD primary_category int NOT NULL DEFAULT 1" );
        
    }

    function deactivate() {
        //Remove primary_category field on posts
        global $wpdb;
        $wpdb->query("ALTER TABLE wp_posts DROP COLUMN primary_category" );
       
    }


     function __construct() {
        $this->plugin = plugin_basename( __FILE__ );
     }

    function register() {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue' ) );
        add_action('admin_menu', array( $this, 'add_admin_pages' ) );
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link' ) );
    }

    public function settings_link($links){
        // add custom settings link
        $settings_link = '<a href="admin.php?page=primary_cat">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }

    function enqueue() {
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/style.css', __FILE__ ) );
        wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__ ) );
    }

    function add_admin_pages() {
        add_menu_page( 'Primary Catageory', 'Add primary catageory', 'manage_options', 'primary_cat', array( $this, 'admin_index' ), 'dashicons-store', 110 );

        add_menu_page( 'View Primary Catageories', 'View primary categories/post', 'manage_options', 'view_primary_cat', array( $this, 'admin_view' ), 'dashicons-admin-page', 110 );

    }

    public function admin_index() {
        require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        
    }

    public function admin_view() {
        require_once plugin_dir_path( __FILE__ ) . 'templates/view.php';
        
    }
    
}


if( class_exists( 'primary_cat' )) {
    $primary_cat = new primary_cat();
    $primary_cat->register();
};

        //$primary_cat->register();

    //activation
    register_activation_hook(__FILE__, array( $primary_cat, 'activate' ) );


    //deactivation
    //require_once plugin_dir_path( __FILE__ ) . 'inc/jackPlugin_plugin_deactivate.php';
    register_deactivation_hook(__FILE__, array( $primary_cat, 'deactivate' ) );


    //uninstall
    //register_uninstall_hook(__FILE__, array( $primary_cat, 'uninstall' ) );


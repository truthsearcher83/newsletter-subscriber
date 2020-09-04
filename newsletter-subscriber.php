<?php
/**
* Plugin Name: Newsletter Subscriber 
* Description: Widget to subscribe to a newsletter 
* Version: 1.0
* Author: Rajarshi Bose
*
**/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Load Scripts
require_once (plugin_dir_path(__FILE__).'/includes/newsletter-subscriber-scripts.php');


//Load Widget Class
require_once(plugin_dir_path(__FILE__).'/includes/newsletter-subscriber-class.php');
add_action('widgets_init' , 'register');

function register(){
    register_widget('Newsletter_Subscriber');
}




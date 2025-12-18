<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

// define a constant for the child theme version
define( 'CHILD_THEME_VERSION', '1.2' );

/*
* Add custom css
*/
add_action("wp_enqueue_scripts", "brindle_enqueue_styles");
function brindle_enqueue_styles()
{
  //wp_enqueue_style("parent-style", get_template_directory_uri() . "/style.css");
 
	  wp_enqueue_style("font-awesome",   "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css",array(), CHILD_THEME_VERSION);  
  wp_enqueue_style("aos-style",   "https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css",array(), CHILD_THEME_VERSION);  
  wp_enqueue_style("slick-style",   "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css",array(), CHILD_THEME_VERSION);
  wp_enqueue_style("slick-theme-style",   "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css",array(), CHILD_THEME_VERSION);
 wp_enqueue_style("splide-style",   "https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css",array(), CHILD_THEME_VERSION);
wp_enqueue_style("magnific-popup-style",   "https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.2.0/magnific-popup.min.css");
}


function brindle_enqueue_scripts()
{
    wp_enqueue_script( 'headroom-script', "https://cdnjs.cloudflare.com/ajax/libs/headroom/0.7.0/headroom.min.js",["jquery"],CHILD_THEME_VERSION,true);
    wp_enqueue_script( 'aos-script', "https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js",["jquery"],CHILD_THEME_VERSION,true);
    wp_enqueue_script( 'slick-script', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js",["jquery"],CHILD_THEME_VERSION,true);  
	wp_enqueue_script( 'splide-script', "https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/js/splide.min.js",["jquery"],CHILD_THEME_VERSION,true);
    wp_enqueue_script( 'splide-script-auto-scroll', "https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll/dist/js/splide-extension-auto-scroll.min.js",["jquery"],CHILD_THEME_VERSION,true);
	wp_enqueue_script( 'magnific-popup-script', "https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.2.0/jquery.magnific-popup.min.js",["jquery"],"1.0",true);
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . "/assets/js/script.js",["jquery"],CHILD_THEME_VERSION,true );
}
add_action("wp_enqueue_scripts", "brindle_enqueue_scripts");




add_theme_support("editor-styles");





function available_show_breadcrumb_function()
{
  ob_start();
  include_once get_stylesheet_directory() . "/cpt/show_breadcrumb.php";
  $content = ob_get_clean();
  return $content;
}



function show_menu_list($attr){
    ob_start();
    $menu = '';
    if(isset($attr['menu'])){
        $menu = $attr['menu']; 
    } 
    if($menu !=''){
        ?>
        <div class="widget widget_nav_menu"><?php echo wp_nav_menu( array( 'menu' => $menu ) );?></div>
        <?php

    }
    $output = ob_get_clean();
    return $output;
}


function register_shortcodes()
{
  add_shortcode("brindle-breadcrumb", "available_show_breadcrumb_function");
  add_shortcode("show-menu", "show_menu_list");  
}
add_action("init", "register_shortcodes");

require 'vendor/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/BrindleDigital/brindle-wilder-2/',
    __FILE__,
    'brindle-wilder-2'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
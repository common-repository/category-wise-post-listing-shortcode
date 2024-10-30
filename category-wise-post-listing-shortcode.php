<?php
/**
 * Plugin Name: Category Wise Post Listing Shortcode
 * Plugin URI: https://profiles.wordpress.org/chintan238/
 * Description: A simple shortcode to list a taxonomy and the posts for each term ex: [cat_listing post_type=post taxonomy=category slug=music]. For Set Category Listing Design change design in template/category_listing.php this file. 
 * Version: 1.3
 * Author: Chintan Acharya
 * Author URI: https://profiles.wordpress.org/chintan238/
 * License: GPL2
 */
$default_path = plugin_dir_path( __FILE__ ) . 'template/';
add_shortcode('cat_listing', 'cwls_cat_list_taxonomy');
function cwls_cat_list_taxonomy($atts){
            $a = shortcode_atts( array(
                'post_type' => '',
                'taxonomy' => '',
                'slug'=> '',
            ), $atts );
            $args = array(
                'post_type' => $a['post_type'],
                'tax_query' => array(
                    array(
                        'taxonomy' => $a['taxonomy'],
                        'field' => 'slug',
                        'terms' => $a['slug'] ,
                    ),
                 ),
             );
     $loop = new WP_Query($args);
     if($loop->have_posts()) {
            echo '<h2>'.$custom_term->name.'</h2>';
            if(!is_admin()):
                while($loop->have_posts()) : $loop->the_post();
                    include plugin_dir_path(__FILE__) . 'template/category_listing.php';
                endwhile;
            endif;
     } 
}
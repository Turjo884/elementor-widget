<?php
/**
 * 
 * Demo Imports
 */

function tp_ocdi_import_files() {
    
    return array(
      array(
        'import_file_name'           => 'Home Main',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/demo-data.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-data.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-1.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://storebuild.shop/wp/exdos-ostad/',
      ),
      array(
        'import_file_name'           => 'Home Two',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/demo-data.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-data.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-2.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://storebuild.shop/wp/exdos-ostad/home-02',
      ),
    );
}
add_filter( 'ocdi/import_files', 'tp_ocdi_import_files' );


function tp_ocdi_page($tp_page_name = 'Home'){
    $posts = get_posts(
        array(
            'post_type'              => 'page',
            'title'                  => $tp_page_name,
            'post_status'            => 'all',
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'orderby'                => 'post_date ID',
            'order'                  => 'ASC',
        )
    );

    if ( ! empty( $posts ) ) {
        $page_got_by_title = $posts[0];
    } else {
        $page_got_by_title = null;
    }

    return $page_got_by_title;

}


// after demo imports
function tp_ocdi_after_import_setup( $demo ) {
    $front_page_id = "";
    $blog_page_id = "";
    if( "Home Main" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Home' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    elseif( "Home Two" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Home 02' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );


    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
 
    set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
        ]
    );
 
}
add_action( 'ocdi/after_import', 'tp_ocdi_after_import_setup' );



function tp_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'one-click-demo-import' );
    $default_settings['menu_title']  = esc_html__( 'Import Theme Demos' , 'one-click-demo-import' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'tp_ocdi_plugin_page_setup' );
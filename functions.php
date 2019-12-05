<?php
/**
 * Beetroot functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beetroot
 */

if ( ! function_exists( 'beetroot_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function beetroot_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Beetroot, use a find and replace
		 * to change 'beetroot' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'beetroot', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'beetroot' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'beetroot_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'beetroot_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beetroot_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'beetroot_content_width', 640 );
}
add_action( 'after_setup_theme', 'beetroot_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beetroot_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'beetroot' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'beetroot' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'beetroot_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function beetroot_scripts() {
	wp_enqueue_style( 'beetroot-style', get_stylesheet_uri() );


	wp_enqueue_script( 'beetroot-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.js', array(), '20151215', true );


	wp_enqueue_script( 'beetroot-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'beetroot_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_action('acf/init', 'my_acf_init');
function my_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'testimonial',
            'title'				=> __('Testimonial'),
            'description'		=> __('A custom testimonial block.'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'testimonial', 'quote' ),
        ));

        // register a footer block
        acf_register_block(array(
            'name'				=> 'footer',
            'title'				=> __('Footer'),
            'description'		=> __('A custom footer block.'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'footer', 'quote' ),
        ));


        // register a hero block
        acf_register_block(array(
            'name'				=> 'hero-info',
            'title'				=> __('Hero Info'),
            'description'		=> __('A custom hero-info block.'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'hero-info', 'quote' ),
        ));

        // register a agenda block
        acf_register_block(array(
            'name'				=> 'agenda',
            'title'				=> __('Agenda'),
            'description'		=> __('A custom agenda block.'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'agenda', 'quote' ),
        ));

        // register a map block
        acf_register_block(array(
            'name'				=> 'map',
            'title'				=> __('Map'),
            'description'		=> __('A custom map block.'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'map', 'quote' ),
        ));



    }
}



function my_acf_block_render_callback( $block ) {

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );
    }
}


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));


    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-settings',
    ));

}
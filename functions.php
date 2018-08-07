<?php

// Função para registrar os Scripts e o CSS
function being_scripts() {
	wp_deregister_script('jquery');

	wp_register_script( 'plugins-script', get_template_directory_uri() . 'assets/js/plugins.min.js', array(), false, true );
	wp_register_script( 'main-script', get_template_directory_uri() . 'assets/js/main.min.js', array( 'plugins-script' ), false, true );

	wp_enqueue_script( 'main-script' );
}
add_action( 'wp_enqueue_scripts', 'being_scripts' );

function being_css() {
	wp_register_style( 'main-style', get_template_directory_uri() . '/style.css', array(), false, false );
	wp_enqueue_style( 'main-style' );
}
add_action( 'wp_enqueue_scripts', 'being_css' );

// Funções para Limpar o Header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Habilitar Menus
add_theme_support('menus');
register_nav_menus( array(
	'menu-principal' => esc_html__( 'Menu Principal', 'theme-textdomain' ),
) );
require get_template_directory() . '/bootstrap-navwalker.php';


// Diferentes tamanhos de imagens
if ( function_exists( 'add_image_size' ) ) {
	//add_image_size( 'titulo', 1400, 560, true );
	//add_image_size( 'titulo_m', 800, 560, true );
}

// Modificando o Wordpress para o Cliente

// Login Personalizado

function my_custom_login() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/login-style.css" />';
}
add_action('login_head', 'my_custom_login');

// Definir o que o Cliente pode ver

if ( current_user_can('editor') ) {
	function my_remove_menu_pages() {
		remove_menu_page('index.php');
		remove_menu_page('edit.php');
		remove_menu_page('edit-comments.php');
		remove_menu_page('tools.php');
	}
	add_action( 'admin_menu', 'my_remove_menu_pages' );

// Retira o Símbolo do Wordpress e dos comentários

	function annointed_admin_bar_remove() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('comments');
	}

	add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
}

// Corrige a questão das colunas no dashboard

function wpse126301_dashboard_columns() {
		add_screen_option(
			'layout_columns',
			array(
				'max'			=> 2,
				'default'	=> 1
			)
		);
}
add_action( 'admin_head-index.php', 'wpse126301_dashboard_columns' );

// Remove link das imagens inseridas com o editor

function rkv_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'rkv_imagelink_setup', 10);

// Custom Posts Types Vão Aqui

// Custom post de Produtos

// add_action('init', 'cptui_register_my_cpt_produtos');
// function cptui_register_my_cpt_produtos() {
// register_post_type('produtos', array(
// 'label' => 'Produtos',
// 'description' => 'Produtos',
// 'public' => true,
// 'show_ui' => true,
// 'show_in_menu' => true,
// 'capability_type' => 'post',
// 'map_meta_cap' => true,
// 'hierarchical' => false,
// 'rewrite' => array('slug' => 'produtos', 'with_front' => true),

// 'query_var' => true,
// 'supports' => array('title','page-attributes','post-formats'),
// 'labels' => array (
// 	'name' => 'Produtos',
// 	'singular_name' => 'Produto',
// 	'menu_name' => 'Produtos',
// 	'add_new' => 'Adicionar Novo',
// 	'add_new_item' => 'Adicionar Novo Produto',
// 	'edit' => 'Editar',
// 	'edit_item' => 'Editar Produto',
// 	'new_item' => 'Novo Produto',
// 	'view' => 'Ver Produto',
// 	'view_item' => 'Ver Produto',
// 	'search_items' => 'Procurar Produtos',
// 	'not_found' => 'Nenhum Produto Encontrado',
// 	'not_found_in_trash' => 'Nenhum Produto Encontrado no Lixo',
// 	'parent' => 'Parent Produto',
// )
// ) ); }

// Final dos custom posts

?>

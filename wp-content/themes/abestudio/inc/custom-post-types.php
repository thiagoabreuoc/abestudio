<?php
/**
 * Custom post types and taxonomies for this theme.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the "Portfólio" custom post type.
 */
function abe_register_portfolio_cpt() {
	$labels = array(
		'name'                  => __( 'Portfólio', 'abestudio' ),
		'singular_name'         => __( 'Projeto', 'abestudio' ),
		'add_new'               => __( 'Adicionar novo', 'abestudio' ),
		'add_new_item'          => __( 'Adicionar novo projeto', 'abestudio' ),
		'edit_item'             => __( 'Editar projeto', 'abestudio' ),
		'new_item'              => __( 'Novo projeto', 'abestudio' ),
		'view_item'             => __( 'Ver projeto', 'abestudio' ),
		'view_items'            => __( 'Ver projetos', 'abestudio' ),
		'search_items'          => __( 'Buscar projetos', 'abestudio' ),
		'not_found'             => __( 'Nenhum projeto encontrado', 'abestudio' ),
		'not_found_in_trash'    => __( 'Nenhum projeto na lixeira', 'abestudio' ),
		'all_items'             => __( 'Todos os projetos', 'abestudio' ),
		'archives'              => __( 'Arquivo de projetos', 'abestudio' ),
		'menu_name'             => __( 'Portfólio', 'abestudio' ),
		'featured_image'        => __( 'Imagem do projeto', 'abestudio' ),
		'set_featured_image'    => __( 'Definir imagem do projeto', 'abestudio' ),
		'remove_featured_image' => __( 'Remover imagem do projeto', 'abestudio' ),
	);

	register_post_type(
		'portfolio',
		array(
			'labels'        => $labels,
			'public'        => true,
			'menu_icon'     => 'dashicons-portfolio',
			'menu_position' => 5,
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => 'portfolio', 'with_front' => false ),
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);
}
add_action( 'init', 'abe_register_portfolio_cpt' );

/**
 * Register the "Categoria de Projeto" taxonomy for the portfolio CPT.
 */
function abe_register_portfolio_taxonomy() {
	$labels = array(
		'name'          => __( 'Categorias de Projeto', 'abestudio' ),
		'singular_name' => __( 'Categoria de Projeto', 'abestudio' ),
		'search_items'  => __( 'Buscar categorias', 'abestudio' ),
		'all_items'     => __( 'Todas as categorias', 'abestudio' ),
		'edit_item'     => __( 'Editar categoria', 'abestudio' ),
		'add_new_item'  => __( 'Adicionar nova categoria', 'abestudio' ),
		'menu_name'     => __( 'Categorias', 'abestudio' ),
	);

	register_taxonomy(
		'categoria_portfolio',
		'portfolio',
		array(
			'labels'       => $labels,
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'categoria-projeto', 'with_front' => false ),
		)
	);
}
add_action( 'init', 'abe_register_portfolio_taxonomy' );

<?php 

// Ativa o suporte ao template do woocommerce 
function handel_add_woocommerce_support() {
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'handel_add_woocommerce_support');

// Remove algumas classes do body adicionadas por padrão pelo woocommerce 
function remove_some_body_class($classes) {
  $woo_class = array_search('woocommerce', $classes);
  $woopage_class = array_search('woocommerce-page', $classes);
  $search = in_array('archive', $classes) || in_array('product-template-default', $classes);

  if($woo_class && $woopage_class && $search) {
    unset($classes[$woo_class]);
    unset($classes[$woopage_class]);
  }

  return $classes;
}
add_filter('body_class', 'remove_some_body_class');

// Registra o css inicial do tema
function handel_css() {
	wp_register_style('handel-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', false);
	wp_enqueue_style('handel-style');
}
add_action('wp_enqueue_scripts', 'handel_css');

// Cria novo tamanho de imagem e faz o crop da imagem do tamanho medio
function handel_custom_images() {
	add_image_size('slide', 1000, 800, ['center', 'top']);
	update_option('medium_crop', 1);
}
add_action('after_setup_theme', 'handel_custom_images');

// Quantidade de produtos a serem exibidos no loop de produtos
function handel_loop_shop() {
	return 6;
}
add_filter('loop_shop_per_page', 'handel_loop_shop');

// Habilitar suporte a Menus
add_theme_support('menus');

 // Habilitar suporte a Widgets no menu aparência
 add_theme_support('widgets');
//  add_theme_support('customize-selective-refresh-widgets');
add_filter( 'use_widgets_block_editor', '__return_false' );

// Função para criar multiplos Widgets 
function widget_registration($name, $id, $beforeWidget, $afterWidget, $beforeTitle, $afterTitle) {
  register_sidebar( array(
      'name' => $name,
      'id' => $id,
      'before_widget' => $beforeWidget,
      'after_widget' => $afterWidget,
      'before_title' => $beforeTitle,
      'after_title' => $afterTitle,
  ));
}

function multiple_widget_init(){
  widget_registration('Carrinho', 'sidebar', '<div>', '</div>', '<h5>', '</h5>');
}

add_action('widgets_init', 'multiple_widget_init');


// Função para formatação dos dados do produto e template de lista de produto
include(get_template_directory() . '/inc/format-product.php');

include(get_template_directory() . '/inc/user-custom-menu.php');

?>








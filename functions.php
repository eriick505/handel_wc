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

// Função que formata os dados dos produtos 
function format_products($products, $img_size = 'medium') {
  $products_final = [];

  foreach($products as $product) {
    $products_final[] = [
      'name' => $product->get_name(),
      'price' => $product->get_price_html(),
      'link' => $product->get_permalink(),
      'img' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],

    ];
  }

  return $products_final;
}

// Função que cria o template de lista de produtos
function handel_product_list($products)  { ?>
	<ul class="products-list">
    <?php foreach($products as $product) { ?>
      <li class="product-item">
        <a href="<?= $product['link']; ?>">
          <div class="product-info">
            <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
            <h2><?= $product['name']; ?> - <span><?= $product['price']; ?></span></h2>
          </div>
          <div class="product-overlay">
            <span class="btn-link">Ver Mais</span>
          </div>
        </a>
      </li>
    <?php } ?>
  </ul>
<?php 
} // fecha a função handel_product_list

?>
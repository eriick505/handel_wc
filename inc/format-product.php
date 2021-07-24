<?php 

// Função que formata os dados dos produtos 
function format_products($products, $img_size = 'medium') {
  $products_final = [];

  foreach($products as $product) {
    $products_final[] = [
      'id' => $product->get_id(),
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
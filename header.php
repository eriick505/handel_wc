<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?> <?php wp_title('|'); ?></title>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php 

$img_url = get_stylesheet_directory_uri() . '/assets/img';

$cart_data = WC()->cart;
$cart_subtotal = $cart_data->get_subtotal();
$cart_count = $cart_data->get_cart_contents_count();

?>

<header class="header container">
  <a href="<?= get_site_url(); ?>" class="logo">
    <img src="<?= $img_url; ?>/handel.svg" alt="Logo Handel">
  </a>

  <div class="busca">
    <form action="<?php bloginfo('url'); ?>/loja/" method="get" id="searchForm">
      <input 
        type="text" 
        name="s" 
        id="s" 
        placeholder="Buscar" 
        value="<?php the_search_query(); ?>"
      >
      <input type="text" name="post_type" value="product" class="hidden">
      <input type="submit" id="searchbutton" value="Buscar">
    </form>
  </div>

  <nav class="conta">
    <a href="<?php echo get_site_url(); ?>/minha-conta" class="minha-conta">Minha Conta</a>

    <!-- <button id="btnOpenMenuCart">
      Carrinho
    </button> -->
    
    <a href="<?php echo get_site_url(); ?>/carrinho" class="carrinho">
      Carrinho

      <?php if($cart_count) { ?>
        <span class="carrinho-count"><?= $cart_count; ?></span>
      <?php } ?>
    </a>
  </nav>
</header>

<?php
  wp_nav_menu([
    'menu' => 'categorias',
    'container' => 'nav',
    'container_class' => 'menu-categorias'
  ]);
?>

<div class="menuCart">
  <button class="close">
    &times;
  </button>

  <?php dynamic_sidebar('Carrinho'); ?>
</div>
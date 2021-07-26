<?php 
// Template name: Exclusivo 
get_header(); ?>

<?php 
$user = wp_get_current_user();

$comprou = wc_customer_bought_product($user->user_email, $user->ID, 81);

?>

<?php if(have_posts()) { while(have_posts()) { the_post(); ?>

  <h1 class="titulo-index"><?php the_title(); ?></h1>
  <?php if($comprou) { ?>
    <div class="container">
      <?php the_content(); ?>
    </div>
  <?php } else { ?>
    <div class="container">
      <p>Você precisa comprar um ebook para verificar esta pagina</p>
    </div>
  <?php } ?>

  </main>

<?php } } ?>

<?php get_footer(); ?>
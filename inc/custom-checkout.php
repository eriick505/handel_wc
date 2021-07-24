<?php 

function handel_custom_checkout($fields) {
  // Para alterar 
  // $fields['billing']['billing_first_name']['label'] = 'Primeiro nome';

  // Para remover 
  // unset($fields['billing']['billing_phone']);

  $fields['billing']['billing_presente'] = [
    'label' => 'Embrulhar para presente?',
    'required' => false,
    'class' => ['form-row-wide'],
    'clear' => true,
    'type' => 'select',
    'options' => [
      'nao' => 'Não',
      'sim' => 'Sim'
    ]
  ];

  return $fields;
}

add_filter('woocommerce_checkout_fields', 'handel_custom_checkout');

// Adiciona o custom field na pagina de pedidos do admin 
function show_admin_custom_checkout_presente($order) {
  $presente = get_post_meta($order->get_id(), '_billing_presente', true);

  echo '<p><strong>Embrulhar para presente?</strong> ' . $presente . '</p> ';
}
add_action('woocommerce_admin_order_data_after_shipping_address', 'show_admin_custom_checkout_presente');

// Adiciona campo 
function handel_custom_checkout_field($checkout) {
  woocommerce_form_field('mensagem_personalizada', [
    'type' => 'textarea',
    'class' => ['form-row-wide mensagem-personalizada'],
    'label' => 'Mensagem Personalizada',
    'placeholder' => 'Escreva uma mensagem para a pessoa que você está presenteando',
    'required' => true
  ], $checkout->get_value('mensagem_personalizada'));
}
add_action('woocommerce_after_order_notes', 'handel_custom_checkout_field');

// Validar Campo 
function handel_custom_checkout_field_process() {
  if(!$_POST['mensagem_personalizada']) {
    wc_add_notice('Por favor, escreva uma mensagem personalizada.', 'error');
  }
}
add_action('woocommerce_checkout_process', 'handel_custom_checkout_field_process');

// Adicionar ao banco de dados 
function handel_custom_checkout_field_update($order_id) {
  if(!empty($_POST['mensagem_personalizada'])) {
    update_post_meta($order_id, 'mensagem_personalizada', sanitize_text_field($_POST['mensagem_personalizada']));
  }
}
add_action('woocommerce_checkout_update_order_meta', 'handel_custom_checkout_field_update');

// Adiciona o custom field na pagina de pedidos do admin 
function show_admin_custom_checkout_mensagem($order) {
  $mensagem = get_post_meta($order->get_id(), 'mensagem_personalizada', true);

  echo '<p><strong>Mensagem:</strong> ' . $mensagem . '</p> ';
}
add_action('woocommerce_admin_order_data_after_shipping_address', 'show_admin_custom_checkout_mensagem');

?>
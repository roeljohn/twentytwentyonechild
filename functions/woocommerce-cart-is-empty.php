<?php

add_action( 'woocommerce_cart_is_empty', 'woocommerce_add_empty_cart_text' );

function woocommerce_add_empty_cart_text() {
  echo "This is your secondary information if you woocommerce cart is empty";
}

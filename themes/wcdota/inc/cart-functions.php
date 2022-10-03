<?php

//DECREATE QTY BUTTON CART ------------------------------------------------------

add_action('woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus');

function bbloomer_display_quantity_plus()
{
    echo '<button type="button" class="plus">+</button>';
}

//INCREASE QTY BUTTON CART ------------------------------------------------------
add_action('woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus');

function bbloomer_display_quantity_minus()
{
    echo '<button type="button" class="minus">-</button>';
}

// Trigger update quantity script

add_action('wp_footer', 'bbloomer_add_cart_quantity_plus_minus');

function bbloomer_add_cart_quantity_plus_minus()
{

    if (!is_product() && !is_cart()) return;

    wc_enqueue_js("   
           
      $(document).on( 'click', 'button.plus, button.minus', function() {
  
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
 
      });
        
   ");
}

/* FUNCTION FOR AUTO UPDATE CART ------------------------------------------------------*/
add_action('wp_head', function () { ?>
    <style>
        .woocommerce button[name="update_cart"],
        .woocommerce input[name="update_cart"] {
            display: none;
        }
    </style>
<?php });

add_action('wp_footer', function () { ?>
    <script>
        jQuery(function($) {
            let timeout;
            $('.woocommerce').on('change', 'input.qty', function() {
                if (timeout !== undefined) {
                    clearTimeout(timeout);
                }
                timeout = setTimeout(function() {
                    $("[name='update_cart']").trigger("click"); // trigger cart update
                }, 500); // .5 second delay
            });
        });
    </script>
<?php });

// SHIPPING BANNER ------------------------------------------------------
add_action("woocommerce_before_cart", "add_shipping_banner");

function add_shipping_banner()
{
    $cart_total = WC()->cart->get_subtotal();
    $minimum_amount = 2000;
    $remaining = $minimum_amount - $cart_total;

    wc_clear_notices();


    if ($cart_total < $minimum_amount) {
        wc_print_notice("Spend an additional $remaining SEK to get free shipping.");
    } else {
        wc_print_notice("Free Shipping!");
    }

    wc_clear_notices();
}

<?php

/* Function for adding orders to start account page */
/* function woocommerce_orders()
{
    $user_id = get_current_user_id();
    if ($user_id == 0) {
        return do_shortcode('[woocommerce_my_account]');
    } else {
        ob_start();
        wc_get_template('myaccount/my-orders.php', array(
            'current_user'  => get_user_by('id', $user_id),
            'order_count'   => $order_count 
        ));
        return ob_get_clean();
    }
}
add_shortcode('woocommerce_orders', 'woocommerce_orders'); */

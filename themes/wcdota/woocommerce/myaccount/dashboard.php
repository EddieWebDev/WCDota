<section class="my-page">
    <h2 class="">
        <?php the_title(); ?>
    </h2>


    <!-- MY ORDERS.PHP    -->

    <!-- REMOVING 'numberposts' => $order_count, on line 30 -->

    <?php

    defined('ABSPATH') || exit;

    $my_orders_columns = apply_filters(
        'woocommerce_my_account_my_orders_columns',
        array(
            'order-number'  => esc_html__('Order', 'woocommerce'),
            'order-date'    => esc_html__('Date', 'woocommerce'),
            'order-status'  => esc_html__('Status', 'woocommerce'),
            'order-total'   => esc_html__('Total', 'woocommerce'),
            'order-actions' => '&nbsp;',
        )
    );

    $customer_orders = get_posts(
        apply_filters(
            'woocommerce_my_account_my_orders_query',
            array(
                /* 'numberposts' => $order_count, */
                'meta_key'    => '_customer_user',
                'meta_value'  => get_current_user_id(),
                'post_type'   => wc_get_order_types('view-orders'),
                'post_status' => array_keys(wc_get_order_statuses()),
            )
        )
    );

    if ($customer_orders) : ?>

        <h2><?php echo apply_filters('woocommerce_my_account_my_orders_title', esc_html__('Recent orders', 'woocommerce')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?></h2>

        <table class="shop_table shop_table_responsive my_account_orders">

            <thead>
                <tr>
                    <?php foreach ($my_orders_columns as $column_id => $column_name) : ?>
                        <th class="<?php echo esc_attr($column_id); ?>"><span class="nobr"><?php echo esc_html($column_name); ?></span></th>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($customer_orders as $customer_order) :
                    $order      = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                    $item_count = $order->get_item_count();
                ?>
                    <tr class="order">
                        <?php foreach ($my_orders_columns as $column_id => $column_name) : ?>
                            <td class="<?php echo esc_attr($column_id); ?>" data-title="<?php echo esc_attr($column_name); ?>">
                                <?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
                                    <?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

                                <?php elseif ('order-number' === $column_id) : ?>
                                    <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                                        <?php echo _x('#', 'hash before order number', 'woocommerce') . $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                        ?>
                                    </a>

                                <?php elseif ('order-date' === $column_id) : ?>
                                    <time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>

                                <?php elseif ('order-status' === $column_id) : ?>
                                    <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>

                                <?php elseif ('order-total' === $column_id) : ?>
                                    <?php
                                    /* translators: 1: formatted order total 2: total order items */
                                    printf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    ?>

                                <?php elseif ('order-actions' === $column_id) : ?>
                                    <?php
                                    $actions = wc_get_account_orders_actions($order);

                                    if (!empty($actions)) {
                                        foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                            echo '<a href="' . esc_url($action['url']) . '" class="button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                        }
                                    }
                                    ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- MY ADDRESS.PHP -->
    <?php
    defined('ABSPATH') || exit;

    $customer_id = get_current_user_id();

    if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
        $get_addresses = apply_filters(
            'woocommerce_my_account_get_addresses',
            array(
                'billing'  => __('Billing address', 'woocommerce'),
                'shipping' => __('Shipping address', 'woocommerce'),
            ),
            $customer_id
        );
    } else {
        $get_addresses = apply_filters(
            'woocommerce_my_account_get_addresses',
            array(
                'billing' => __('Billing address', 'woocommerce'),
            ),
            $customer_id
        );
    }

    $oldcol = 1;
    $col    = 1;
    ?>

    <p>
        <?php echo apply_filters('woocommerce_my_account_my_address_description', esc_html__('The following addresses will be used on the checkout page by default.', 'woocommerce')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
    </p>

    <?php if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>
        <div class="u-columns woocommerce-Addresses col2-set addresses">
        <?php endif; ?>

        <?php foreach ($get_addresses as $name => $address_title) : ?>
            <?php
            $address = wc_get_account_formatted_address($name);
            $col     = $col * -1;
            $oldcol  = $oldcol * -1;
            ?>

            <div class="u-column<?php echo $col < 0 ? 1 : 2; ?> col-<?php echo $oldcol < 0 ? 1 : 2; ?> woocommerce-Address">
                <header class="woocommerce-Address-title title">
                    <h3><?php echo esc_html($address_title); ?></h3>
                    <a href="<?php echo esc_url(wc_get_endpoint_url('edit-address', $name)); ?>" class="edit"><?php echo $address ? esc_html__('Edit', 'woocommerce') : esc_html__('Add', 'woocommerce'); ?></a>
                </header>
                <address>
                    <?php
                    echo $address ? wp_kses_post($address) : esc_html_e('You have not set up this type of address yet.', 'woocommerce');
                    ?>
                </address>
            </div>

        <?php endforeach; ?>

        <?php if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>
        </div>
    <?php endif; ?>



    <!-- USER OBJECT -->
    <?php
    $user_id = get_current_user_id();
    $user = get_user_by('ID', $user_id);
    ?>

    <!-- FORM EDIT ACCOUNT.PHP -->

    <?php

    defined('ABSPATH') || exit;

    do_action('woocommerce_before_edit_account_form'); ?>

    <form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

        <?php do_action('woocommerce_edit_account_form_start'); ?>

        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
            <label for="account_first_name"><?php esc_html_e('First name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
            <label for="account_last_name"><?php esc_html_e('Last name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />
        </p>
        <div class="clear"></div>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="account_display_name"><?php esc_html_e('Display name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" /> <span><em><?php esc_html_e('This will be how your name will be displayed in the account section and in reviews', 'woocommerce'); ?></em></span>
        </p>
        <div class="clear"></div>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="account_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
        </p>

        <fieldset>
            <legend><?php esc_html_e('Password change', 'woocommerce'); ?></legend>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
            </p>
        </fieldset>
        <div class="clear"></div>

        <?php do_action('woocommerce_edit_account_form'); ?>

        <p>
            <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
            <button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
            <input type="hidden" name="action" value="save_account_details" />
        </p>

        <?php do_action('woocommerce_edit_account_form_end'); ?>
    </form>

    <?php do_action('woocommerce_after_edit_account_form'); ?>

</section>
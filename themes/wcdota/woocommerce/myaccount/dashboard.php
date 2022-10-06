<section class="my-account-page">
    <h2 class="account-title">
        <?php the_title(); ?>
    </h2>

    <!-- MY ORDERS.PHP    -->
    <?php wc_get_template_part("/template-parts/account-orders"); ?>

    <!-- MY ADDRESS.PHP -->
    <?php wc_get_template_part("/template-parts/account-address"); ?>

    <!-- FORM EDIT ACCOUNT.PHP -->
    <?php wc_get_template_part("/template-parts/account-edit-account"); ?>
</section>
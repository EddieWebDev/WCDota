<?php get_header(); ?>

<?php if (is_account_page()) {
    get_template_part("/template-parts/checkout-before-content");
} ?>

<?php the_content(); ?>

<?php get_footer(); ?>
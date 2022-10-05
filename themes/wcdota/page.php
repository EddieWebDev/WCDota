<?php get_header(); ?>

<?php if (is_account_page()) {
    get_template_part("/template-parts/header-template-my-account");
} ?>

<?php the_content(); ?>

<?php get_footer(); ?>
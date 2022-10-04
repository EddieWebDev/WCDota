<?php get_header(); ?>
<?php if(is_product_taxonomy()):?>
    <?php get_template_part("/template-parts/single-cat-before-content"); ?>
<?php endif ;?>


<?php woocommerce_content(); ?>

<?php if(is_product_taxonomy()):?>
<?php get_template_part("/template-parts/single-cat-after-content"); ?>
    
<?php endif ;?>

<?php get_footer(); ?>
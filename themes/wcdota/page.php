<?php get_header(); ?>

<?php if(is_checkout()):?>
        <?php get_template_part("/template-parts/checkout-before-content"); ?>
<?php endif ;?>

<?php the_content(); ?>

<?php if(is_checkout()):?>
        <?php get_template_part("/template-parts/checkout-after-content"); ?>  
<?php endif ;?>

<?php get_footer(); ?>
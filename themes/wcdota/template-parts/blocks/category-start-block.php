<div class="categories">
    <div class="categories-header-div">
        <h3 class="categories-header">
            <?php the_field("header"); ?>
        </h3>
    </div>
    <div class="vision-text">
        <p>
            <?php the_field("text"); ?>
        </p>
    </div>

    <?php get_categories()?>

</div>
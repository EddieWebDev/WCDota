<?php
$args = array(
    "taxonomy" => "product_cat",
    "hide_empty" => false,
);

$categories = get_terms($args);
?>



<div>
    <div>
        <?php
        foreach($categories as $category){
            if("Uncategorized" !== $category->name){
                //var_dump($category);
                $term_link = get_term_link($category, "product_cat");
                ?>
                    <a href="<?php echo $term_link?>">
                        <?php echo $category->name?>
                    </a>
                <?php the_post_thumbnail(); ?>
                    


                    
                <?php
                

            }
        }
        ?>
    </div>
</div>


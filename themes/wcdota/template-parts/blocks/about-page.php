<?php

$image = get_field('image');
$size = 'medium'; // (thumbnail, medium, large, full or custom size) 
?>


<div class="about-block">
    <h2 class="about-header">
        <?php the_field("header"); ?>
    </h2>

    <div class="about-img">
        <?php if ($image) {
            echo wp_get_attachment_image($image, $size);
        } ?>
    </div>
    <div class="about-content">
        <p>
            <?php the_field("text"); ?>
        </p>
    </div>
</div>
<?php

$image = get_field('image');
$size = 'medium'; // (thumbnail, medium, large, full or custom size) 
?>


<div>
    <h2>
        <?php the_field("header"); ?>
    </h2>

    <?php
    if ($image) {
        echo wp_get_attachment_image($image, $size);
    } ?>
    <p>
        <?php the_field("text"); ?>
    </p>
</div>
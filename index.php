<?php

// Get Header
get_template_part('templates/header');

$content = apply_filters( 'the_content', get_the_content() );
echo $content;


// Get Footer
get_template_part('templates/footer');
?>
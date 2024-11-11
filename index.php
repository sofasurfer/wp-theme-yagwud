<?php

// Get Header
get_template_part('templates/header');


if(get_field('template') == 'default'){
    //get_template_part('templates/header_default');
}


$content = apply_filters( 'the_content', get_the_content() );
echo $content;

if(get_field('template') == 'default'){
    get_template_part('templates/footer_default');
}

// Get Footer
get_template_part('templates/footer');
?>
<?php

// Get Header
get_template_part('templates/header');

?>

<div id="overlay">
    <!--
    <div class="close"></div>
    <div class="next"></div>
    <div class="next"></div>
    -->
</div>

<div id="pevents">
    <?= do_shortcode('[sofa_events_list]'); ?>
    
</div>
<div id="pgallery">

    <?=  apply_filters( 'the_content', get_the_content() ); ?>
        
</div>

<?php

// Get Footer
get_template_part('templates/footer');

?>
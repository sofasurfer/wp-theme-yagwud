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

    <?php
    $files = scandir( get_stylesheet_directory() . '/assets/flyers/');
    $index = 1;
    foreach($files as $file):
        if( strpos($file,".") > 2 ):
        ?>
        <a href="<?= get_stylesheet_directory_uri(); ?>/assets/flyers/<?= $file;?>" target="_blank" data-index="<?=$index;?>">
            <img  src="<?= get_stylesheet_directory_uri(); ?>/assets/flyers/<?= $file;?>"/></a>
        <script>images.push('<?= get_stylesheet_directory_uri(); ?>/assets/flyers/<?= $file;?>');</script>
        <?php
        $index++;
        endif;
    endforeach; ?>
        
</div>

<?php

// Get Footer
get_template_part('templates/footer');

?>
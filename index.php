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
    error_log(wp_upload_dir()['basedir'] . '/flyers');
    $files = scandir( wp_upload_dir()['basedir'] . '/flyers');
    $index = 1;
    foreach($files as $file):
        if( strpos($file,".") > 2 ):
        ?>
        <a href="<?= wp_upload_dir()['baseurl']; ?>/flyers/<?= $file;?>" target="_blank" data-index="<?=$index;?>">
            <img  src="<?= wp_upload_dir()['baseurl']; ?>/flyers/<?= $file;?>"/></a>
        <script>images.push('<?= wp_upload_dir()['baseurl']; ?>/flyers/<?= $file;?>');</script>
        <?php
        $index++;
        endif;
    endforeach; ?>
        
</div>

<?php

// Get Footer
get_template_part('templates/footer');

?>
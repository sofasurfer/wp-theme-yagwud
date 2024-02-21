<?php 
$streaminfo = get_query_var( 'get_stream_info' );
?>
<div class="row">
    <div class="col-md-4 mb-4 mb-md-0">
        <a href="<?= get_the_post_thumbnail_url($streaminfo,'full');?>" target="_blank"><img class="img-fluid" src="<?= get_the_post_thumbnail_url($streaminfo,'large');?>" alt="Responsive image" /></a>
    </div>
    <div class="col-md-8">
        <p><a class="text-meta" href="<?= get_field('stream_url',$streaminfo);?>" target="_blank"><?= get_the_date('d. M Y',$streaminfo);?></a></p>
        <h3><?= get_the_title($streaminfo);?></h3>
        <p><strong><?= get_field('description',$streaminfo);?></strong></p>

        <audio controls="controls">
        <source src="<?= get_field('stream_url',$streaminfo);?>" type="audio/mp3" />
        Your browser does not support the audio tag.
        </audio>
    </div>
    <div class="col-md-12">
        <hr/>
    </div>
</div>
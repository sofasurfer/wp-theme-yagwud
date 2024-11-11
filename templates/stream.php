<?php 
$streaminfo = get_query_var( 'get_stream_info' );

$post_type = get_post_type();
$taxonomies = get_object_taxonomies($post_type, 'stream_category');

if (has_term('video', 'stream_category', $streaminfo)):
?>
<div class="row">
    <div class="col-md-4 mb-4 mb-md-0">
        <a href="<?= get_the_post_thumbnail_url($streaminfo,'full');?>" target="_blank"><img class="img-fluid" src="<?= get_the_post_thumbnail_url($streaminfo,'large');?>" alt="Responsive image" /></a>
    </div>
    <div class="col-md-8">
        <a class="text-meta" href="<?= get_field('stream_url',$streaminfo);?>" target="_blank"><?= get_the_date('d. M Y',$streaminfo);?></a>
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
<?php else:?>
    <div class="row">

    <div class="col-md-12">
        <a class="text-meta" href="<?= get_field('stream_url',$streaminfo);?>" target="_blank"><?= get_the_date('d. M Y',$streaminfo);?></a>
        <h3><?= get_the_title($streaminfo);?></h3>
        <p><strong><?= get_field('description',$streaminfo);?></strong></p>
        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?= get_field('stream_url',$streaminfo);?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="The Live Adventures of Puts Marie"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
    </div>
    <div class="col-md-12">
        <hr/>
    </div>
</div><?php endif;?>
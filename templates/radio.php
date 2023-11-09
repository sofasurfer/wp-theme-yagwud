<?php 
$streaminfo = get_query_var( 'get_stream_info' );
if ( $streaminfo ):
?>
    <div class="col-md-12">
        <p>Start: <?= $streaminfo['stream_start']; ?></p>
    </div>
    <div class="col-md-12">
        <audio src="https://stream.yagwud.com:9005/stream" controls ></audio>
    </div>
<?php else: ?>
    <div class="col-md-12">
        <h3>Stream is offline :(</h3>
    </div>
<?php endif; ?>
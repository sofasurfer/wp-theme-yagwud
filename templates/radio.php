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
    <!--div class="col-md-6">
        <p>Problem streaming: <a class="btn btn-success" target="_blank" href="https://radio.odowok.com:9005/stream">click here</a></p>

        <p><a class="btn btn-success btn-large" target="_blank" href="<?= $streaminfo['listenurl']; ?>">PLAY</a></p>
    </div-->
<?php else: ?>
    <div class="col-md-12">
        <h3>Stream is offline</h3>
    </div>
<?php endif; ?>
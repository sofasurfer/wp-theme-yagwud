
<?php 
$streaminfo = get_query_var( 'get_stream_info' );
if ( $streaminfo ):
?>
    <div class="_col-md-12">
        <p>Start: <?= $streaminfo['stream_start']; ?></p>
        <!--p>Show will start soon</p-->
    </div>
    <div class="col-md-12">
        <audio src="https://stream.yagwud.com:9005/stream" controls ></audio>
    </div>
<?php else: ?>
    <div class="col-md-12">
        <h3>offline :/</h3>
    </div>
<?php endif; ?>
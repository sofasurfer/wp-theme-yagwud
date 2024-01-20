
<div class="row">
    <?php 
    $streaminfo = get_query_var( 'get_stream_info' );
    if ( $streaminfo ):
    ?>
        <div class="col-md-12">
            <h2><span style="color:white;background-color:red;">LIVE: </span> <?= $streaminfo['server_description'];?></h2>
            <!--pre>
                <?php print_r($streaminfo); ?>
            </pre-->
        </div>
        <div class="col-md-12">
            <audio src="https://stream.yagwud.com:9005/stream" controls ></audio>
            <p>Started: <?= $streaminfo['stream_start']; ?></p>
        </div>
    <?php else: ?>
        <div class="col-md-12">
            <h2><span style="color:white;background-color:black;">offline :/</span></h2>
        </div>
    <?php endif; ?>
</div>
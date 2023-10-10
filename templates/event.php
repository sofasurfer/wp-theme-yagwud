<?php

$event = get_query_var( 'y_event' );

?>
<h4><?= get_field( 'startdate', $event );?>: <?= get_the_title( $event );?> - <?= get_field( 'club', $event );?></h4>
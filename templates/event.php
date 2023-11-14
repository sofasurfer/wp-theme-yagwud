<?php

$item = get_query_var( 'y_event' );

?>
<tr class="bounce-table animation-element">
    <td class="fixdate subject">
        <div class="date" itemprop="startDate" content="<?=$item['show_date'];?>">
            <span class="day"><?= date("d", strtotime($item['show_date'])); ?></span>
            <span class="month"><?= date("M", strtotime($item['show_date'])); ?></span>
            <span class="year y-desktop"><?= date("Y", strtotime($item['show_date'])); ?></span>
            <span class="year y-mobile"><?= date("y", strtotime($item['show_date'])); ?></span>
        </div>
        <div class="y-mobile"><?=$item['club_city']['city'];?> (<?=$item['club_city']['country_short'];?>)</div>
    </td>
    <td  class="location subject" itemprop="location" itemscope itemtype="http://schema.org/Place">
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

            <h3><?=$item['title'];?></h3>
            
            <?php if ($item['event_link']): ?>
                <a target="_blank" itemprop="url"  title="<?=$item['club_name'];?> - <?=$item['club_city']['city'];?> (<?=$item['club_city']['country_short'];?>)" href="<?=$item['event_link'];?>"><?=$item['club_name'];?></a>
            <?php else: ?>
                <?=$item['club_name'];?>
            <?php endif; ?>

            <?php if($item['ticket_link']): ?>&nbsp;&nbsp;- 
                <a target="_blank" title="Buy ticket" href="<?=$item['ticket_link'];?>" class="ticket">Tickets</a>
            <?php endif; ?>
        </div>
    </td>
    <td class="category"  itemprop="name">
        <?=$item['category'][0]['name'];?>
    </td>
    <td class="venue subject"  itemprop="name">
        <div class="location-small"><?=$item['club_city']['city'];?> (<?=$item['club_city']['country_short'];?>)</div>
    </td>
</tr>
<?php

$item = get_query_var( 'y_event' );

?>
<tr class="bounce-table animation-element">
    <td class="subject">
        <div class="date" itemprop="startDate" content="<?=$item['show_date'];?>">
            <span class="day"><?= date("d", strtotime($item['show_date'])); ?></span>
            <span class="month"><?= date("M", strtotime($item['show_date'])); ?></span>
            <span class="year"><?= date("Y", strtotime($item['show_date'])); ?></span>
        </div>
    </td>
    <td  class="location subject" itemprop="location" itemscope itemtype="http://schema.org/Place">
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

            <h3><?=$item['title'];?></h3>
            
            <?php if ($item['event_link']): ?>
                <a target="_blank" itemprop="url"  title="<?=$item['club_name'];?> - <?=$item['club_city']['city'];?> (<?=$item['club_city']['country_short'];?>)" href="<?=$item['event_link'];?>"><?=$item['club_name'];?></a>
            <?php else: ?>
                <?=$item['club_name'];?>
            <?php endif; ?>

        </div>
    </td>
    <td class="venue subject"  itemprop="name">
        <?=$item['category'][0]['name'];?>
    </td>
    <td class="venue subject"  itemprop="name">
        <div class="location-small"><?=$item['club_city']['city'];?> (<?=$item['club_city']['country_short'];?>)</div>
    </td>
    <td class="ticket subject">
    <?php if($item['ticket_link']): ?>
        <a target="_blank" title="Buy ticket" href="<?=$item['ticket_link'];?>" class="ticket">
            Tickets
        </a>
    <?php endif; ?>
    </td>
</tr>
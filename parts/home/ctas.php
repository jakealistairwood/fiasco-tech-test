<?php

$ctas = get_field('call_to_actions');
$cta1 = $ctas['call_to_action_1'];
$cta2 = $ctas['call_to_action_2'];
$cta3 = $ctas['call_to_action_3'];

if( count($ctas) > 0 ) : ?>
    <ul class="ctas">
        <?php if( !empty($cta1) ) : if( empty($cta1['title']) ){ $cta1['title'] = 'Click here'; } ?>
            <li class="ctas__link">
                <?php echo '<a href="'.$cta1['url'].'" target="'.$cta1['target'].'">'.$cta1['title'].'</a>'; ?>
            </li>
        <?php endif; ?>

        <?php if( !empty($cta2) ) : if( empty($cta2['title']) ){ $cta2['title'] = 'Click here'; } ?>
            <li class="ctas__link">
                <?php echo '<a href="'.$cta2['url'].'" target="'.$cta2['target'].'">'.$cta2['title'].'</a>'; ?>
            </li>
        <?php endif; ?>

        <?php if( !empty($cta3) ) : if( empty($cta3['title']) ){ $cta3['title'] = 'Click here'; } ?>
            <li class="ctas__link">
                <?php echo '<a href="'.$cta3['url'].'" target="'.$cta3['target'].'">'.$cta3['title'].'</a>'; ?>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>

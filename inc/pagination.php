<?php
    $next_posts = get_next_posts_link('Next'); 
    $prev_posts = get_previous_posts_link('Prev');
?>
<?php if($next_posts || $prev_posts) : ?>
    <div class="pagination-wrapper">
        <div class="next-link">
            <?php if(!empty($next_posts)) : ?>
                <?php echo $next_posts; ?>
            <?php else: ?>
                <a href="#" class="placeholder">Next</a>
            <?php endif; ?>
        </div>
        <div class="prev-link">
            <?php if(!empty($prev_posts)) : ?>
                <?php echo $prev_posts; ?>
            <?php else: ?>
                <a href="#" class="placeholder">Prev</a>
            <?php endif; ?>
        </div>
        <?php the_posts_pagination(); ?>
    </div>
<?php endif; ?>

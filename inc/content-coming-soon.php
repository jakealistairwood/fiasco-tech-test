
<?php
    $page = null;
    
    if (is_post_type_archive('programme')) {
        $page = get_page_by_path('programme');
    } else if (is_post_type_archive('jobs')) {
        $page = get_page_by_path('jobs');
    } else if (is_post_type_archive('spaces')) {
        $page = get_page_by_path('spaces');
    }

    $pageId = $page ? $page->ID : null;

    $title = get_field('ccsm_title', $pageId) ?? get_field('ccsm_title', 'option');
    $text = get_field('ccsm_text', $pageId) ?? get_field('ccsm_text', 'option');
?>

<section class="contained wysiwyg no-content">
    <h3><?php echo $title; ?></h3>
    <p><?php echo $text; ?></p>
</section>

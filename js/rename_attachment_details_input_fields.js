window.addEventListener('DOMContentLoaded', function() {
    let wp_admin_body = document.querySelector('.wp-admin');
    if (wp_admin_body) {
        let MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
        let label_updates_observer = new MutationObserver(do_label_updates);
        label_updates_observer.observe(wp_admin_body, { childList: true, subtree: true });
    }
    function do_label_updates() {
        let att_info_container = document.querySelector('.attachment-info');
        if(att_info_container) {
            let adi_title = att_info_container.querySelector('.setting[data-setting="title"] label');
            let adi_caption = att_info_container.querySelector('.setting[data-setting="caption"] label');
            if (adi_title) {
                adi_title.textContent = 'Production';
            }
            if (adi_caption) {
                adi_caption.textContent = 'Photographer';
            }
        }
    }
});

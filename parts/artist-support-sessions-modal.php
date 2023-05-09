<?php
	if (is_page('our-services') || is_single('artist-support') || is_front_page()) :
		$artss_popup_text = get_field( 'artist_support_sessions_text', 'option' );
		$artss_popup_cta = get_field( 'artist_support_sessions_cta', 'option' );
		$artss_popup_cta_title = $artss_popup_cta ? $artss_popup_cta['title'] : 'Book Now';
		$artss_popup_cta_url = $artss_popup_cta ? $artss_popup_cta['url'] : site_url('service/artist-support');
?>
	<section class="artist-support-sessions">
		<div class="artist-support-sessions__wrapper">
			<div class="content-wrapper">
				<button type="button" class="close-btn">
					<svg xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 25.5 25.5" xml:space="preserve"><path transform="rotate(-45.001 12.739 12.74)" fill="#033" d="M11.7 3.8h2v17.9h-2z"/><path transform="rotate(-45.001 12.739 12.74)" fill="#033" d="M3.8 11.7h17.9v2H3.8z"/><path d="M12.7 1h0c6.5 0 11.7 5.3 11.7 11.7h0c0 6.5-5.3 11.7-11.7 11.7h0C6.3 24.5 1 19.2 1 12.7h0C1 6.3 6.3 1 12.7 1z" fill="none" stroke="#033" stroke-width="2"/></svg>
				</button>

				<h3>Artist<br>Support<br>Sessions</h3>

				<?php if( $artss_popup_text) : ?>
					<p><?php echo $artss_popup_text; ?></p>
				<?php else : ?>
					<p></p>
				<?php endif; ?>

				<a href="<?php echo $artss_popup_cta_url; ?>" class="cta darkgreen" title="<?php echo $artss_popup_cta_title; ?>"><?php echo $artss_popup_cta_title; ?></a>
			</div>
			<div class="overlay"></div>
		</div>
	</section>
	<?php endif; ?>

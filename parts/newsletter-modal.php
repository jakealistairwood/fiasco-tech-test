<section class="newsletter-overlay">
	<div class="newsletter-overlay__wrapper">
		<div class="content-wrapper">
			<button type="button" class="close-btn">
				<svg xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 25.5 25.5" xml:space="preserve"><path transform="rotate(-45.001 12.739 12.74)" fill="#033" d="M11.7 3.8h2v17.9h-2z"/><path transform="rotate(-45.001 12.739 12.74)" fill="#033" d="M3.8 11.7h17.9v2H3.8z"/><path d="M12.7 1h0c6.5 0 11.7 5.3 11.7 11.7h0c0 6.5-5.3 11.7-11.7 11.7h0C6.3 24.5 1 19.2 1 12.7h0C1 6.3 6.3 1 12.7 1z" fill="none" stroke="#033" stroke-width="2"/></svg>
			</button>

			<?php
				// Live site
				echo do_shortcode( '[mc4wp_form id="1646"]' );
				// Istvan localhost
				// echo do_shortcode( '[mc4wp_form id="1638"]' );
			?>
		</div>
		<div class="overlay"></div>
	</div>
</section>

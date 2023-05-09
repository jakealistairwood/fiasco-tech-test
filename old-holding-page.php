<?php
/*
 * HOME PAGE TEMPLATE
 */

get_header(); ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<section class="full contained">

		<a id="overlay" class="button button--overlay" href="#">Where's the old website?</a>

		<h1><span class="highlight">Theatre Bristol</span> exists to improve the live performance sector, to <span class="highlight">make it fairer</span> and more equal, and to <span class="highlight">champion independence.</span></h1>

		<a class="scroll-down" href="#content"></a>

	</section>

	<section id="content" class="gallery full">

		<div class="contained">

			<h2 class="center">We want <span class="red">live performance</span> and performance makers to thrive; to be <span class="red">valued, relevant</span> and <span class="red">deeply connected</span> to more people's lives.</h2>

		</div>

	</section>

	<section class="contained padding">

		<p class="center"><br/><br/><br/><br/><a class="button button--large" href="#" target="_blank">Contact Us</a></p>

	</section>

	<ul class="contacts">
		<li>
			<h3>Emily <br/>Williams</h3>
			<h4>CEO</h4>
			<p><a href="mailto:emily@theatrebristol.net">emily@theatrebristol.net</a></p>
		</li>
		<li>
			<h3>Eloise <br/>Tong</h3>
			<h4>General Manager</h4>
			<p><a href="mailto:eloise@theatrebristol.net">eloise@theatrebristol.net</a></p>
		</li>
		<li>
			<h3>Marcin <br/>Gawin</h3>
			<h4>Administrator</h4>
			<p><a href="mailto:marcin@theatrebristol.net">marcin@theatrebristol.net</a></p>
		</li>
	</ul>

	<section class="contained padding">

		<h4 class="center">Artist Support Activists</h4>
		<p class="center"><a class="red" href="mailto:asa@theatrebristol.net" target="_blank">asa@theatrebristol.net</a></p>

	</section>


	<section class="full contained">

		<h2 class="center">We provide <span class="highlight">free, bespoke support</span> for artists and freelance creatives.</h2>
		<h2 class="center">Whilst our website may be closed our services are still <span class="highlight">very much open.</span></h2>

	</section>

	<section class="grid">
		<div class="first">
			<a class="grid__link" target="_blank" href="https://app.acuityscheduling.com/schedule.php?owner=19370251"></a>
			<h3><a target="_blank" href="https://app.acuityscheduling.com/schedule.php?owner=19370251">Artist<br/>Support<br/> Sessions</a></h3>
			<p class="caps"><a target="_blank" href="https://app.acuityscheduling.com/schedule.php?owner=19370251">Book 1:1 Artist<br>Support sessions</a></p>
		</div>
		<div class="second">
			<a class="grid__link" target="_blank" href="https://www.eventbrite.co.uk/o/theatre-bristol-210213264"></a>
			<h3><a target="_blank" href="https://www.eventbrite.co.uk/o/theatre-bristol-210213264">Theatre<br/>Bristol<br/>Events</a></h3>
			<p class="caps"><a target="_blank" href="https://www.eventbrite.co.uk/o/theatre-bristol-210213264">Industry events</a></p>
		</div>
		<div class="third">
			<a class="grid__link" target="_blank" href="https://theatrebristol.us8.list-manage.com/subscribe?u=05644b2ce6c1d46a317275a47&id=0ab6d96e6e"></a>
			<h3><a target="_blank" href="https://theatrebristol.us8.list-manage.com/subscribe?u=05644b2ce6c1d46a317275a47&id=0ab6d96e6e">Newsletter</a></h3>
			<p class="caps"><a target="_blank" href="https://theatrebristol.us8.list-manage.com/subscribe?u=05644b2ce6c1d46a317275a47&id=0ab6d96e6e">Updates from Theatre Bristol, jobs, opportunities and more</a></p>
		</div>
		<div class="fourth">
			<a class="grid__link" target="_blank" href="https://app.acuityscheduling.com/schedule.php?owner=19370251"></a>
			<h3><a target="_blank" href="https://app.acuityscheduling.com/schedule.php?owner=19370251">South west reading service</a></h3>
			<p class="caps"><a target="_blank" href="https://app.acuityscheduling.com/schedule.php?owner=19370251">Support and advice around funding for first time applicants</a></p>
		</div>
		<div class="fifth">
			<a href="https://www.paypal.com/donate/?cmd=_s-xclick&hosted_button_id=LJUGTE63XASNU" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/support_button.png" alt="Support Theatre Bristol" /></a>
		</div>
	</section>

	<section class="overlay">
		<div class="overlay__content contained">
			<h4 class="h1">Watch this space</h4>
			<p>The time has come for us to acknowledge that theatrebristol.net is no longer fit for purpose and we have taken it down. Over the past 24 months we have seen a significant drop in visits, the journey for visitors is clunky and difficult to navigate. It is also currently unclear who we are, the work that we do and the services we provide.</p>
			<p><b>The website no longer represented the organisation  that we are or want to be. </b></p>
			<p>During late summer 2021 we will launch a new and more accessible website, focussed on the work Theatre Bristol delivers alongside a library of resources and with that reveal our new brand.</p>
			<p><a class="overlay__close" href="#"><b>Close</b></a></p>
		</div>
		<div class="overlay__cover"></div>
	</section>

<?php endwhile; ?>
<?php else: ?>

	<section class="contained">
		<h3>Content coming soon...</h3>
		<p>Sorry this page is not available yet, please try again later.</p>
	</section>

<?php endif; ?>


<?php get_template_part( 'footer' ); ?>
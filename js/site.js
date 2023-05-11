//=======================
// SITE LOADING
//=======================

document.onreadystatechange = function () {
	if (document.readyState === 'interactive') {
		$('body').addClass('loaded');
	}
}


function parallaxImg ( img ) {

	var imgParent = img.target.closest('.module-service');

	if(screen.width > '1024'){

		var speed = img.target.dataset.speed;
		if (imgParent) {
			var imgY = imgParent.offsetTop;
			// console.log(imgY);
		}
		var winY = img.target.scrollTop;
		var winH = img.target.height;
		var parentH = imgParent.offsetHeight;
		var winBottom = winY + winH;
		if (winBottom > imgY && winY < imgY + parentH) {
			var imgBottom = ((winBottom - imgY) * speed);
			var imgTop = winH + parentH;
			var imgPercent = ((imgBottom / imgTop) * 100) + (50 - (speed * 50));
		}
		img.target.style.transform = 'translateY( -' + imgPercent + '%)';

	}
}


function bgColor(entry) {
	var body = $('body'),
		pagecolor = $('#page-background'),
		bgcolor = entry.target.dataset.bgcolor;
	// BG COLOR
	if( bgcolor ){
		pagecolor[0].style.backgroundColor = bgcolor;
	} else {
		pagecolor[0].style.backgroundColor = 'transparent';
	}
}


$(document).ready(function(){



//=======================
// SCROLLING
//=======================

	//
	// SCROLL EVENTS
	//
	let observer = new IntersectionObserver( (entries, observer) => { 
		entries.forEach(entry => {

			if (entry.isIntersecting){
				// SHOW CONTENT
				entry.target.classList.add('in-view');

				entry.target.classList.add('showing');

				// CHANGE BACKGROUND COLOR
				if( entry.target.classList.contains('module-service') ){
					bgColor( entry );
				}

				if( entry.target.classList.contains('module-service__image') ){
					parallaxImg( entry );
				}

				// LAZY LOAD CHAPTERS AND FULLWIDTH IMAGES ONLY
				// if( entry.target.classList.contains('graduate-tile--lazyload') ){
				// 	lazyLoad( entry );
				// } 
			} else {
				entry.target.classList.remove('showing');
			}

		});
	}, {
		//root: null, null is default
		rootMargin: "0px 0px -180px 0px",
		threshold: 0
	});

	// WATCH SECTIONS
	document.querySelectorAll('.animate-in, .module-service, .tile, .lists, .back-to-top').forEach(section => {
		observer.observe(section)
	});


//=======================
// IMAGE CAPTIONS
//=======================

	var cursor = $('#cursor');

	$(document)
	.mousemove(function(e) {
		cursor
		.eq(0)
		.css({
			left: e.pageX,
			top: e.pageY
		});
	});

	$('.featured_image').mouseover(function() {
		cursor.eq(0).addClass('cursor--show');
		// var alt = $(this).attr('alt');
		var caption = $(this).data('caption');
		var title = $(this).data('title');
		// if(alt.length < 1){
		// 	alt = 'N/A';
		// }
		var string = [title, caption].filter(Boolean).join("</span><span>");
		cursor.html( '<span>' + string + '</span>' );
	}).mouseout(function() {
		cursor.eq(0).removeClass('cursor--show');
	});


//========================
// Navigation
//========================

	//nav open and close
	$('.nav__icon').click(function ( event ) {
		event.preventDefault();
		$('body').toggleClass('nav--open');
	});

	//nav open and close
	$('#overlay').click(function ( event ) {
		event.preventDefault();
		if (opened) {
			$('body').removeClass('show--overlay').addClass('close--overlay');
			opened = false;
		} else {
			$('body').removeClass('close--overlay').addClass('show--overlay');
			opened = true;
		}
	});
	//nav open and close
	var opened = false;
	$('.overlay__close').click(function ( event ) {
		event.preventDefault();
		if (opened) {
			$('body').removeClass('show--overlay').addClass('close--overlay');
			opened = false;
		} else {
			$('body').removeClass('close--overlay').addClass('show--overlay');
			opened = true;
		}
	});

	// Resource archive filtering
	let resources = document.querySelector('.resources');
	if (resources) {
		let filterbutton = resources.querySelector('.filters-cta');
		let linksContainer = resources.querySelector('.archive-links');
		if(filterbutton && linksContainer) {
			filterbutton.addEventListener('click', function() {
				if (linksContainer.classList.contains('open')) {
					linksContainer.classList.remove('open')
				} else {
					linksContainer.classList.add('open')
				}
			});
		}
	}

	// Home page Twitter interactions
	const twitterFeedsContainer = document.getElementById('ctf');
	if (twitterFeedsContainer) {
		let twitterFeedsWrapper = twitterFeedsContainer.querySelector('.ctf-tweet-items'),
			twitterFeedItems = twitterFeedsWrapper.querySelectorAll('.ctf-item');

		// Prepare feeds to integrate with Swiper
		twitterFeedsContainer.classList.add('swiper-container');
		twitterFeedsWrapper.classList.add('swiper-wrapper');

		for (let i = 0; i < twitterFeedItems.length; i++) {
			let feed = twitterFeedItems[i];
				feed.classList.add('swiper-slide');

			// Move tweeter feed dates to the footer content
			let dateNode = feed.querySelector('.ctf-tweet-meta .ctf-tweet-date'),
				newParentNode = feed.querySelector('.ctf-tweet-actions');
			if (dateNode && newParentNode) {
				newParentNode.insertAdjacentElement('afterbegin', dateNode);
			}
			let finalNode = feed.querySelector('.ctf-tweet-actions');
			let finalLocation = feed.querySelector('.ctf-tweet-text');
			if (finalNode && finalLocation){
				finalLocation.insertAdjacentElement('afterend', finalNode);
			}
		}

		const twitterFeedsSwiper = new Swiper(twitterFeedsContainer, {
			slidesPerView: 1,
			spaceBetween: 25,
			grabCursor: true,
			breakpoints: {
				768: {
					slidesPerView: 2
				},
				1240: {
					slidesPerView: 3
				}
			}
		});
	}

	// Meet the team toggle interactions
	let teamMembersButtons = document.querySelectorAll('.team-members__name-list li button');
	if (teamMembersButtons.length > 0) {
		let teamMemberContainer = document.querySelector('.team-members');
		if(teamMemberContainer) {
			let teamMembers = teamMemberContainer.querySelectorAll('.team-member');

			let toggleMember = function(activeMember, teamMembers) {
				teamMembers.forEach(function(member) {
					// Set max-height to 0 for all members except for the first one
					if(activeMember.dataset.name === member.dataset.name) {
						setTimeout(function() {
							member.style.maxHeight = member.scrollHeight + 'px';
							member.classList.add('active');
							teamMemberContainer.classList.toggle('team-members--alt');
						}, 300);
					} else {
						if (member.classList.contains('active')) {
							member.classList.add('hiding');

							setTimeout(function() {
								member.classList.remove('hiding');
								member.classList.remove('active');
								member.style.maxHeight = '0px';
							}, 300);
						} else {
							member.classList.remove('hiding');
							member.classList.remove('active');
							member.style.maxHeight = '0px';
						}
					}
				});
			}

			// Show the first member on page load
			toggleMember(teamMembers[0], teamMembers);

			for (let i = 0; i < teamMembersButtons.length; i++) {
				let member = teamMembersButtons[i];

				member.addEventListener('click', function(e) {
					e.preventDefault();

					teamMembersButtons.forEach(function(but) {
						but.classList.remove('active');
					});

					e.target.classList.add('active');

					toggleMember(member, teamMembers);
				});
			}
		}
	}

	// Show show all team members
	let showAllteamMembersButtons = document.querySelector('.show-all-team-members');
	let teamMembersContainer = document.querySelector('.team-members__name-list');
	if (showAllteamMembersButtons && teamMembersContainer) {
		let teamMemberCount = teamMembersContainer.querySelectorAll('li');
		if(teamMemberCount.length < 4) {
			showAllteamMembersButtons.remove();
		} else {
			showAllteamMembersButtons.addEventListener('click', function(e) {
				e.preventDefault();
				let button = e.target;
				if(!button.classList.contains('expanded')) {
					button.classList.add('expanded');
					teamMembersContainer.classList.add('expanded');
				} else {
					button.classList.remove('expanded');
					teamMembersContainer.classList.remove('expanded');
				}
			});
		}
	}

	// Board members interactions
	let boardMembersContainer = document.querySelector('.board-member-list'),
		showAllboardMembersButton = document.querySelector('.board-member.placeholder-first');
	if (boardMembersContainer && showAllboardMembersButton) {
		// Show all board members
		showAllboardMembersButton.addEventListener('click', function(e) {
			e.preventDefault();
			let button = e.target;
			if(!boardMembersContainer.classList.contains('expanded')) {
				button.querySelector('.top-section h6 span').textContent = 'HIDE';
				boardMembersContainer.classList.add('expanded');
			} else {
				button.querySelector('.top-section h6 span').textContent = 'SEE';
				boardMembersContainer.classList.remove('expanded');
			}
		});

		// Hide all team members
		let hideAllboardMembersButton = document.querySelector('.board-member.placeholder-last');
		if(hideAllboardMembersButton) {
			hideAllboardMembersButton.addEventListener('click', function(e) {
				e.preventDefault();
				let button = e.target;
				showAllboardMembersButton.querySelector('.top-section h6 span').textContent = 'SEE';
				boardMembersContainer.classList.remove('expanded');
			});
		}
	}

	// Support modal
	let supportUs = document.querySelector('.support-us');
	if (supportUs) {
		let closeBtn = supportUs.querySelector('.close-btn');
		if (closeBtn) {
			closeBtn.addEventListener('click', function(e) {
				supportUs.classList.remove('support-us--open');
			});
		}

		let openBtn = document.querySelector('.support-us__btn.open-btn');
		if (openBtn) {
			openBtn.addEventListener('click', function(e) {
				supportUs.classList.toggle('support-us--open');
			});
		}
	}

	// Handle successfull contact form submission
	let interactiveContainer = document.querySelector('.contact-form-wrapper');
	if (interactiveContainer) {
		let wpcf7ContactForm = document.querySelector('.contact-form-wrapper .contact-form .wpcf7');
		if(wpcf7ContactForm) {
			wpcf7ContactForm.addEventListener( 'wpcf7submit', function( event ) {
				interactiveContainer.classList.add('message-sent');
			}, false );
		}

		// Show Contact form and remove success components
		let newEnquiryButton = document.querySelector('.contact-form-wrapper .new-enquiry-button');
		if (newEnquiryButton) {
			newEnquiryButton.addEventListener('click', function(e) {
				interactiveContainer.classList.remove('message-sent');
			});
		}
	}

	// Artist Support Sessions interaction
	Date.prototype.addHours = function(h) {
		this.setTime(this.getTime() + (h*60*60*1000));
		return this;
	}

	const ASS_KEY_NAME = 'TB_Artist_Support_PopUp_Dismissed_Timestamp';
	let userLastSeenAssPopUp = localStorage.getItem(ASS_KEY_NAME);
	let date = new Date();

	if(!userLastSeenAssPopUp || userLastSeenAssPopUp > date.addHours(1)) {
		let popupElement = document.querySelector('.artist-support-sessions');
		if(popupElement) {
			localStorage.setItem(ASS_KEY_NAME, Date.now());

			setTimeout(function() {
				popupElement.classList.add('open');
			}, 2000);

			popupElement.addEventListener('click', function(e) {
				let target = e.target;
				if (target.classList.contains('overlay') || target.closest('.close-btn')) {
					popupElement.classList.remove('open');
				}
			});
		}
	}

    const HEADS_UP_MODAL_KEY_NAME = 'TB_Heads_Up_PopUp_Dismissed_Timestamp';
    let userLastSeenHeadsUpPopUp = localStorage.getItem(HEADS_UP_MODAL_KEY_NAME);
    let date2 = new Date();

    if(!userLastSeenHeadsUpPopUp || userLastSeenHeadsUpPopUp > date2.addHours(1)) {

        // Heads up modal
        let headsUpModal = document.querySelector('.heads-up-modal');
        if(headsUpModal) {
            localStorage.setItem(HEADS_UP_MODAL_KEY_NAME, Date.now());
            
            setTimeout(function() {
                headsUpModal.classList.add('open');
            }, 2000);

            headsUpModal.addEventListener('click', function(e) {
                let target = e.target;
                if (target.classList.contains('overlay') || target.closest('.close-btn')) {
                    headsUpModal.classList.remove('open');
                }
            });
        }
    }


	// KEEP IN TOUCH
	$('.keep-in-touch .cta, .newsletter-overlay .close-btn').click(function ( event ) {
		event.preventDefault();
		$('body').toggleClass('newsletter--open');
	});




	const makeDropdowns = function () {

		// MAKE DROPDOWNS OPEN
		for (const dropdown of document.querySelectorAll(".filters__dropdown")) {
			
			dropdown.addEventListener("click", function () {
				this.querySelector(".filters__trigger").parentNode.classList.toggle("filters--open");
			});

		}

		// ORGANISE DROPDOWN CHOICES
		for (const option of document.querySelectorAll(".filters__button")) {
			option.addEventListener("click", function () {
				// Find currently selected
				var current = this.parentNode.querySelector(".filters__button--active");

				// If this selected has already been clicked
				if (current !== null) {
					// If this button is not already selected
					if ( !this.classList.contains("filters__button--active") ) {
						this.parentNode.querySelector(".filters__button--active").classList.remove("filters__button--active");
					}
				}

				event.preventDefault();
				loadResources(option.href);

				// Make clicked button active
				this.classList.add("filters__button--active");
			});
		}

		// CLOSE DROPDOWN AFTER CHOICE IS MADE
		window.addEventListener("click", function (e) {
			for (const select of document.querySelectorAll(".dropdown__select")) {
				if (!select.contains(e.target)) {
					select.classList.remove("filters--open");
				}
			}
		});

	};
	makeDropdowns();


	//
	// MAKE SEARCH FORM DRAWER
	//
	const makeSearchForm = function () {

		let searchform = $("#searchform");
		let searchformButton = $(".searchform__button");
		let searchformClose = $(".searchform__close");
		let searchSubmit = $(".searchform__submit");

		searchformClose.click(function ( event ) {
			$('body').toggleClass("searchform--open");
		});

		searchformButton.click(function ( event ) {
			$('body').toggleClass("searchform--open");
		});

		let form = document.getElementById("searchform");

		if(form != undefined){
			form.addEventListener('submit', (event)=>{
				let input = document.getElementById("s");

				// GETTING CORRECT URL
				if (window.location.host.includes("localhost")) {
					url = "http://" + window.location.host + "/theatre-bristol/";
				} else {
					url = "https://" + window.location.host;
				}
				url += '?s=' + input.value + '&post_type=resources';

				event.preventDefault();
				$('body').removeClass("searchform--open");
				loadResources( url );
			});
		}

	};
	makeSearchForm();

	//
	// MAKE CLEAR RESULTS BUTTON
	//
	const makeClearButton = function () {

		let clearButton = $(".search-results__clear a, .filters__clear a, .clear-button");

		if(clearButton != undefined){

			clearButton.click(function ( event ) {
				event.preventDefault();
				loadResources(clearButton[0].href);
			});

		}

	};
	makeClearButton();


	//
	// GRABBING RESOURCES USING AJAX
	//
	function loadResources(url) {
		$.get(url, function (response) {
			var wrapper = $("#tiles");
			var filtergroup = $("#archive-header");
			var dom = $(document.createElement("html"));
			dom[0].innerHTML = response;
			var posts = dom.find("#tiles").contents();
			var filters = dom.find("#archive-header").contents();
			wrapper.html(posts);
			filtergroup.html(filters);
		})
		.done(function () {
			$("#tiles").removeClass("tiles--loading");

			window.history.pushState(null, document.title, url);

			makeDropdowns();
			makeSearchForm();
			makeClearButton();

			// REDECLARING
			document.querySelectorAll('.animate-in, .module-service, .tile, .lists, .back-to-top').forEach(section => {
				observer.observe(section)
			});
		})
		.fail(function () {
			$("#tiles").removeClass("tiles--loading");
			alert("No posts found. Please try another category.");
		});
		return false;
	}

	/* =======================
	*
	*	MEET THE TEAM BLOCK
	*
	======================= */ 

	if(document.querySelector('.meet-the-team__member-list')) {
		// console.log("This page contains the meet the team block");

		let memberLinks = document.querySelectorAll('[data-memberID]');
		let memberProfiles = document.querySelectorAll('.member-profile');

		let initialActiveLink = [...memberLinks].filter(link => link.classList.contains("meet-the-team__member--active"))[0];
		const initialActiveMemberID = initialActiveLink.dataset.memberid;

		// Display an initial member on page load
		let initialMember = [...memberProfiles].filter(profile => profile.dataset.member == initialActiveMemberID)[0];
		initialMember.classList.remove('hidden');

		const displayTeamMember = (e, memberRef) => {
			e.stopPropagation();
			memberLinks.forEach(link => {
				if(link.classList.contains("meet-the-team__member--active")) link.classList.remove("meet-the-team__member--active");
			})
			e.target.classList.add("meet-the-team__member--active");

			let memberToDisplay = [...memberProfiles].filter(profile => profile.dataset.member == memberRef)[0];

			memberProfiles.forEach(profile => {
				if(!profile.classList.contains("hidden")) profile.classList.add("hidden");
				if(profile.classList.contains("animate")) profile.classList.remove("animate");
				memberToDisplay.classList.remove("hidden");
				memberToDisplay.classList.add("animate");
			})
		}
		
		memberLinks.forEach(link => {
			let linkRef = link.dataset.memberid;
			link.addEventListener('click', (e) => {
				displayTeamMember(e, linkRef)
			});
		})
	};
	


}); // document ready

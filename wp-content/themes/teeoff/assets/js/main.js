(function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		/* Mobile navigation toggle */
		var toggle = document.querySelector( '.nav-toggle' );
		var mobileNav = document.getElementById( 'mobile-nav' );
		if ( toggle && mobileNav ) {
			toggle.addEventListener( 'click', function () {
				var expanded = toggle.getAttribute( 'aria-expanded' ) === 'true';
				toggle.setAttribute( 'aria-expanded', String( ! expanded ) );
				mobileNav.classList.toggle( 'is-open' );
			} );

			mobileNav.querySelectorAll( 'a' ).forEach( function ( link ) {
				link.addEventListener( 'click', function () {
					toggle.setAttribute( 'aria-expanded', 'false' );
					mobileNav.classList.remove( 'is-open' );
				} );
			} );
		}

		var header = document.getElementById( 'site-header' );
		var heroTargets = document.querySelectorAll(
			'.hero__title, .hero__subtitle, .hero__actions .btn, .page-hero .eyebrow, .page-hero h1, .page-hero__lead'
		);
		var revealTargets = document.querySelectorAll(
			'.solution-card, .why-card, .step-card, .partner-card, .news-card, .value-card, .tech-card, .job-card, .section-heading, .mission__media, .mission__text, .technology__content'
		);

		var prefersReduced = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		var hasGSAP = !! ( window.gsap && window.ScrollTrigger );

		function showInstantly( list ) {
			list.forEach( function ( el ) { el.style.opacity = '1'; } );
		}

		function plainHeaderShadow() {
			if ( ! header ) { return; }
			var onScroll = function () {
				header.classList.toggle( 'is-scrolled', window.scrollY > 8 );
			};
			window.addEventListener( 'scroll', onScroll, { passive: true } );
			onScroll();
		}

		if ( ! hasGSAP || prefersReduced ) {
			showInstantly( heroTargets );
			showInstantly( revealTargets );
			plainHeaderShadow();
			return;
		}

		try {
			gsap.registerPlugin( ScrollTrigger );

			/* Hero entrance: a short, calm fade-and-rise on load */
			if ( heroTargets.length ) {
				gsap.set( heroTargets, { opacity: 0, y: 22 } );
				gsap.to( heroTargets, {
					opacity: 1, y: 0, duration: .8, ease: 'power3.out', stagger: .12, delay: .15
				} );
			}

			/* Sections and cards ease in as they enter the viewport */
			if ( revealTargets.length ) {
				gsap.set( revealTargets, { opacity: 0, y: 28 } );
				ScrollTrigger.batch( revealTargets, {
					start: 'top 85%',
					once: true,
					onEnter: function ( batch ) {
						gsap.to( batch, { opacity: 1, y: 0, duration: .7, ease: 'power2.out', stagger: .1 } );
					}
				} );
			}

			/* Subtle parallax drift on the hero media */
			var heroMedia = document.querySelector( '.hero__media' );
			if ( heroMedia ) {
				gsap.to( heroMedia, {
					yPercent: 12,
					ease: 'none',
					scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: true }
				} );
			}

			/* Header shadow once the page has scrolled */
			if ( header ) {
				ScrollTrigger.create( {
					start: 'top -8',
					end: 99999,
					onUpdate: function ( self ) {
						header.classList.toggle( 'is-scrolled', self.scroll() > 8 );
					}
				} );
			}
		} catch ( e ) {
			showInstantly( heroTargets );
			showInstantly( revealTargets );
			plainHeaderShadow();
		}
	} );
})();

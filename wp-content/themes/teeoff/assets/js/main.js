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

			/* Hero entrance: a slow, calm fade-and-rise on load */
			if ( heroTargets.length ) {
				gsap.set( heroTargets, { opacity: 0, y: 26 } );
				gsap.to( heroTargets, {
					opacity: 1, y: 0, duration: 1.4, ease: 'power2.out', stagger: .25, delay: .2
				} );
			}

			/* Sections and cards ease in as they enter the viewport */
			if ( revealTargets.length ) {
				gsap.set( revealTargets, { opacity: 0, y: 32 } );
				ScrollTrigger.batch( revealTargets, {
					start: 'top 88%',
					once: true,
					onEnter: function ( batch ) {
						gsap.to( batch, { opacity: 1, y: 0, duration: 1.2, ease: 'power2.out', stagger: .18 } );
					}
				} );
			}

			/* Subtle parallax drift on every full-bleed background image */
			var parallaxMedia = document.querySelectorAll(
				'.hero__media, .page-hero__media, .technology__media, .about-vision__media'
			);
			parallaxMedia.forEach( function ( media ) {
				var section = media.closest( 'section' );
				if ( ! section ) { return; }
				gsap.to( media, {
					yPercent: 20,
					ease: 'none',
					scrollTrigger: { trigger: section, start: 'top bottom', end: 'bottom top', scrub: true }
				} );
			} );

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

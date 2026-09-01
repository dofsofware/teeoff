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

		/* Scroll reveal for cards and sections */
		var revealTargets = document.querySelectorAll(
			'.solution-card, .why-card, .step-card, .partner-card, .news-card, .value-card, .tech-card, .job-card'
		);
		revealTargets.forEach( function ( el ) { el.setAttribute( 'data-reveal', '' ); } );

		if ( 'IntersectionObserver' in window ) {
			var observer = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
						observer.unobserve( entry.target );
					}
				} );
			}, { threshold: 0.15 } );

			revealTargets.forEach( function ( el ) { observer.observe( el ); } );
		} else {
			revealTargets.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
		}

		/* Header shadow once the page has scrolled */
		var header = document.getElementById( 'site-header' );
		if ( header ) {
			var onScroll = function () {
				header.style.boxShadow = window.scrollY > 8 ? '0 6px 20px rgba(18,31,75,.08)' : 'none';
			};
			window.addEventListener( 'scroll', onScroll, { passive: true } );
			onScroll();
		}
	} );
})();

/**
 * Theme javascript functions file.
 *
 */
( function( a ) {
	"use strict";

	var  
        body = a("body"),
		container = a(".bricks"),
		active = ("active"),
		o = a('.bricks'),
        preload = ('js--preload'),
		dur = 200;

	/* fitVids */
	a("body").fitVids();

	/* Loading Progress Bar */ 
	NProgress.configure({
	     minimum: .2,
	     showSpinner: !1
	}),
		       
	document.onreadystatechange = function () {
		if (document.readyState == "interactive") {
	    		NProgress.start();
		}
	}

	var everythingLoaded = setInterval(function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(everythingLoaded);
			setTimeout(function(){NProgress.done()},2000);
		}
	}, 10);

	function i() {
             o.find(".brick").each(function(b) {
                var c = a(this),
                    d = Math.floor(100 * Math.random() + 101) * b;
                setTimeout(function() {
                    c.addClass("brick--show")
                }, d)
            })
        }

	/* Document Ready */
	a(document).ready(function() {
	     /* Enable menu toggle for small screens */ 
		a( '.mobile-menu-toggle' ).on( 'click', function() {
			body.toggleClass( 'open-nav' );
		} );

		/* Fade out links */ 
		function b() {  window.location = d, body.removeClass(preload) } var d;

		a("a:not(.photoswipe-link)").on("click", function(a) {
			return "" == this.href || null == this.href ? void a.preventDefault() : void(-1 == this.href.indexOf("#") && -1 == this.href.indexOf("mailto:") && -1 == this.href.indexOf("javascript:") && "_blank" != this.target && (a.preventDefault(), d = this.href, 
			body.addClass(preload), setTimeout(b, 200)))
		});
	});

	/* Portfolio Isotope */ 
	function isotope() {

		var container = a('.bricks');
		
		container.imagesLoaded( function(){
			
			container.isotope({
				transitionDuration: '0.2s',
				itemSelector: '.bricks .brick',
		 		resizesContainer: true,
		 		isResizeBound: true,
		 		layoutMode: 'masonry',
		 		getSortData: {
				     views: '[data-views]',
				     date: '[data-date]',
				},
				sortAscending: {
					views: false,
					date: false,
				},
				hiddenStyle: {
				    opacity: 0
				},
				visibleStyle: {
				    opacity: 1
				}
			});

			container.isotope();

			/* Portfolio Filtering */ 
			a('.filter-group a').on( 'click', function(e) {
				var 
				b = a(this).attr('data-filter'),
				c = a(".project-filter a"),
				d = ("active"),
				s = ("shown");

				e.preventDefault();
				container.isotope({ filter: b });
				c.removeClass(d);
				jQuery(this).addClass(d);
				return false;
			});

			/* Portfolio Infinite scrolling */ 
			container.infinitescroll({
				navSelector  : '#page_nav',
				nextSelector : '#page_nav a',
				itemSelector : '.brick-fullwidth.brick .brick',
				loading: {
					loadingText: 'Loading',
					finishedMsg: 'Done Loading',
					img: ''
				}
			},
			function( newElements ) {
				var  newElems = a( newElements ).css({ opacity: 0 });
					picturefill();	
					newElems.imagesLoaded(function(){
						newElems.animate({ opacity: 1 });
						container.isotope( 'appended', newElems );
					});
				});
		});

	}

	a(window).load(function() {
        /* Add loading class */    
        setTimeout(function(){ body.removeClass(preload) }, 20); 
		isotope(),i();
	});

} )( jQuery );
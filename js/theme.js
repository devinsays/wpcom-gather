/*!
 * Script for initializing globally-used functions and libs.
 *
 * @since 1.0.0
 */
(function($) {

	var gather = {

		// Cache selectors
		cache: {
			$document: $(document),
			$window: $(window),
			$postswrap: $('#posts-wrap'),
			masonry : false,
			masonryLoaded: false,
			windowWidth : $(window).width()
		},

		// Init functions
		init: function() {

			this.bindEvents();

		},

		// Bind Elements
		bindEvents: function() {

			var self = this;

			self.navigationInit();

			this.cache.$document.on( 'ready', function() {

				if ( $('body').hasClass('masonry') ) {
					self.cache.masonry = true;
					self.masonryInit();
				}

			} );

			// Handle Navigation on Resize
			this.cache.$window.on( 'resize', self.debounce(
				function() {

					// Required for Mobile Safari bug where resize event triggered on scroll.
					newWindowWidth = self.cache.$window.width();

					if ( newWindowWidth != self.cache.windowWidth ) {

						// Remove any inline styles that may have been added to menu
						$('.main-navigation .menu, .main-navigation .primary-menu, .main-navigation .social-menu').attr('style','');
						$('.main-navigation').find('.children, .sub-menu').each( function(){
			    			$(this).attr('style','');
						});

						$('.main-navigation').find('.dropdown-toggle').each( function(){
							$(this).removeClass('toggled');
						});

						self.cache.windowWidth = newWindowWidth;

					}

				}, 200 )
			);

			// Handle Masonry on Resize
			this.cache.$window.on( 'resize', self.debounce(
				function() {

					if ( self.cache.masonry ) {
						self.masonryInit();
					}

				}, 200 )
			);

		},

		/**
		 * Initialize the mobile menu functionality.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		navigationInit: function() {

			// Add dropdown toggle to display child menu items
			$('.primary-menu > .menu-item-has-children').append( '<span class="dropdown-toggle" />');
			$('.secondary-menu > .menu-item-has-children').append( '<span class="dropdown-toggle" />');

			// When mobile menu is tapped/clicked
			$('.menu-toggle').on( 'click', function() {
				var menu = $(this).data('toggle');
				$(menu).toggle();
			});

			// When mobile submenu is tapped/clicked
			$('.dropdown-toggle').on( 'click', function() {
				var $submenu = $(this).parent().find('.children, .sub-menu'),
					$toggle = $(this);
				$submenu.toggle( 0, function() {
					$toggle.toggleClass('toggled');
				});
			});

		},

		// Initialize Masonry
		masonryInit: function() {

			var width = document.body.clientWidth;

			// If body width is less than 510px we'll display as a single column
			if ( width <= 510 ) {
				return;
			}

			var gutter = 30;

			// If body width is between 510px and 880px, we'll have a smaller gutter
			if ( document.body.clientWidth <= 880 ) {
				gutter = 20;
			}
			
			var $postswrap = this.cache.$postswrap;
			var self = this;

			$postswrap.imagesLoaded(function () {
				$posts = $postswrap.find('.module').css({ 'margin-right' : 0 }).addClass('masonry');

				$postswrap.masonry({
					itemSelector: '.module',
					transitionDuration: 0,
					gutter : gutter
				});
			});
			
			// Handle Masonry on Resize
			$(document.body).on( 'jetpack-lazy-loaded-image', self.debounce(
				function() {
					$postswrap.masonry('reloadItems').masonry('layout');
				}, 200 )
			);

			// Layout posts that arrive via infinite scroll.
			$(document.body).on('post-load', function () {
				var $newItems = $postswrap.find('.module').not('.masonry');
				$newItems.css({ 'margin-right' : 0 }).addClass('masonry');

				$newItems.hide();
				$postswrap.append($newItems);

				$postswrap.imagesLoaded(function () {
					$postswrap.masonry('appended', $newItems, true).masonry('reloadItems').masonry('layout');
					$newItems.show(200);
				});
			});

		},

		/**
		 * Debounce function.
		 *
		 * @since  1.0.0
		 * @link http://remysharp.com/2010/07/21/throttling-function-calls
		 *
		 * @return void
		 */
		debounce: function(fn, delay) {
			var timer = null;
			return function () {
				var context = this, args = arguments;
				clearTimeout(timer);
				timer = setTimeout(function () {
					fn.apply(context, args);
				}, delay);
			};
		}

	};

	gather.init();

})(jQuery);
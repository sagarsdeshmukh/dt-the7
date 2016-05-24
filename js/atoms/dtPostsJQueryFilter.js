
/* #Filter for posts shortcode
================================================== */
// jQuery(document).ready(function($) {
	var dtPostsJQueryFilter = {
		timeouts: {},

		init: function(settings) {
			this.config = {
				postsContainer: null,
				categoryContainer: null,
				paginatorContainer: null,
				curPage: 1,
				curCategory: '*',
				postsPerPage: -1,
				items: []
			};

			$.extend( this.config, settings );

			this._setPostsPerPage();
			this._setCategory();
			this._setCurPage();
			this._setItems();

			this.setup();
		},

		setup: function() {
			$('a', this.config.paginatorContainer).on('click.dtPostsPaginationFilter', {self: this}, this.paginationFilter);
			$('a', this.config.categoryContainer).on('click.dtPostsCategoryFilter', {self: this}, this.categoryFilter);

			this._getActiveElement(this.config.paginatorContainer).trigger('click.dtPostsPaginationFilter', { onSetup: true });
		},

		paginationFilter: function(event, onSetup) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setCurPage();

			if ( ! onSetup ) {
				self._scrollToTopOfContainer( self._filterPosts );
			} else {
				self._filterPosts();
			}
		},

		categoryFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setCategory();
			self._setAsActive(self.config.paginatorContainer.find('a').first());
			self._setCurPage();

			self._showPagination();
			self._filterPosts();
		},

		_showPagination: function() {
			if ( this.config.curCategory && '*' != this.config.curCategory ) {
				var itemsCount = this.config.postsContainer.find(this.config.curCategory).length;
				var maxPage = Math.ceil( itemsCount / this.config.postsPerPage );
				if ( maxPage == 1 ) {
					this.config.paginatorContainer.find('a').hide();
				} else {
					this.config.paginatorContainer.find('a').each(function(index) {
						var $this = $(this);
						if ( (index + 1) > maxPage ) {
							$this.hide();
						} else {
							$this.show();
						}
					});
				}
			} else {
				this.config.paginatorContainer.find('a').show();
			}
		},

		_filterPosts: function() {
			var self = this;

			// category filter emulation
			self.config.items.css("display", "none");

			var itemsCount = 0;
			self.config.items.filter(self.config.curCategory).each(function() {
				if ( self._showOnCurPage(++itemsCount) ) {
					$(this).css("display", "block");
				}
			});
		},

		_setPostsPerPage: function() {
			this.config.postsPerPage = parseInt( this.config.postsContainer.attr('data-posts-per-page') );
		},

		_setCategory: function() {
			this.config.curCategory = this._getActiveElement(this.config.categoryContainer).attr('data-filter') || this.config.curCategory;
		},

		_setCurPage: function(page) {
			this.config.curPage = page ? page : this._getActiveElement(this.config.paginatorContainer).attr('data-page-num');
		},

		_setItems: function() {
			this.config.items = $(".wf-cell", this.config.postsContainer);
		},

		_showOnCurPage: function(index) {
			return this.config.postsPerPage <= 0 || ( this.config.postsPerPage*(this.config.curPage - 1) < index && index <= this.config.postsPerPage*this.config.curPage );
		},

		_setAsActive: function(item) {
			item.addClass('act').siblings().removeClass('act');
		},

		_getActiveElement: function(items) {
			return items.find('a.act').first();
		},

		_isActive: function(item) {
			return item.hasClass('act');
		},

		_scrollToTopOfContainer: function(onComplite) {
			var scrollTo = this.config.postsContainer.parent();

			$("html, body").animate({
				scrollTop: scrollTo.offset().top - $("#phantom").height() - 50
			}, 400, onComplite ? onComplite.bind(this) : undefined);
		},

		_setTimeout: function(id, handler, time) {
			var self = this;

			if ( ! id ) {
				handler.bind(self);
			}

			if ( this.timeouts[id] ) {
				window.clearTimeout( this.timeouts[id] );
			}

			this.timeouts[id] = window.setTimeout(handler.bind(self), time);
		}
	};

	var dtPostsIsotopeFilter = $.extend({}, dtPostsJQueryFilter, {
		init: function(settings) {
			this.config = {
				postsContainer: null,
				categoryContainer: null,
				orderByContainer: null,
				orderContainer: null,
				paginatorContainer: null,
				curPage: 1,
				curCategory: '*',
				initialOrder: '',
				order: '',
				orderBy: '',
				postsPerPage: -1,
				items: [],
				isPhone: false
			};

			$.extend( this.config, settings );

			this._setPostsPerPage();
			this._setCategory();
			this._setOrderBy();
			this._setOrder();
			this._setCurPage();
			this._setItems();

			this.config.initialOrder = this.config.order;

			this.setup();
		},

		setup: function() {
			$('a', this.config.paginatorContainer).on('click.dtPostsPaginationFilter', {self: this}, this.paginationFilter);
			$('a', this.config.categoryContainer).on('click.dtPostsCategoryFilter', {self: this}, this.categoryFilter);
			$('a', this.config.orderContainer).on('click.dtPostsOrderFilter', {self: this}, this.orderFilter);
			$('a', this.config.orderByContainer).on('click.dtPostsOrderByFilter', {self: this}, this.orderByFilter);

			this._getActiveElement(this.config.paginatorContainer).trigger('click.dtPostsPaginationFilter', { onSetup: true });
		},

		orderFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setOrder();
			self._filterPosts();
		},

		orderByFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setOrderBy();
			self._filterPosts();
		},

		_filterPosts: function() {
			var self = this;

			if ( self.config.isPhone ) {

				// category filter emulation
				self.config.items.css("display", "none");

				var itemsCount = 0;
				self.config.items.filter(self.config.curCategory).each(function() {
					if ( self._showOnCurPage(++itemsCount) ) {
						$(this).css("display", "block");
					}
				});

			} else {
				self.config.postsContainer.isotope({ filter: self.config.curCategory, sortAscending: 'asc' == self.config.order, sortBy: self.config.orderBy });

				if ( self.config.curPage ) {
					self._filterByCurPage();
				}
			}
		},

		_filterByCurPage: function() {
			var items = this.config.items.slice(0);
			if ( this.config.initialOrder && this.config.initialOrder != this.config.order ) {
				items.reverse();
			}

			var itemsCount = 0;
			items.map(function(item) {
				if ( ! item.isHidden && ! this._showOnCurPage(++itemsCount) ) {
					item.hide();
				}
			}, this);

			this.config.postsContainer.isotope('layout');
		},

		_setOrderBy: function() {
			this.config.orderBy = this._getActiveElement(this.config.orderByContainer).attr('data-by');
		},

		_setOrder: function() {
			this.config.order = this._getActiveElement(this.config.orderContainer).attr('data-sort');
		},

		_setItems: function() {
			if ( this.config.isPhone ) {
				this.config.items = $(".iso-item, .wf-cell", this.config.postsContainer);
			} else {
				this.config.items = this.config.postsContainer.isotope('getItemElements').map(function(item) { return this.config.postsContainer.isotope('getItem', item); }, this);
			}
		}
	});

	var dtPostsJGridFilter = $.extend({}, dtPostsJQueryFilter, {
		_filterPosts: function() {
			var self = this;

			// category filter emulation
			self.config.items.css("display", "none");

			var itemsCount = 0;
			var visibleItems = [];
			self.config.items.filter(self.config.curCategory).each(function() {
				if ( self._showOnCurPage( ++itemsCount ) ) {
					$(this).css("display", "block");
					visibleItems.push( this );
				}
			});

			visibleItems = $(visibleItems);
			self.config.postsContainer.data('visibleItems', visibleItems);
			self.config.postsContainer.collage({ images: visibleItems });
		},

		_setItems: function() {
			this.config.items = $(".wf-cell", this.config.postsContainer);
		}
	});

	$('.dt-shortcode.with-isotope').each(function() {
		var $this = $(this);
		var $container = $this.find('.wf-container');
		var filterConfig = {
			postsContainer: $container,
			categoryContainer: $this.find('.filter-categories'),
			paginatorContainer: $this.find('.iso-paginator')
		};

		if ( $container.hasClass('dt-isotope') ) {
			var postsFilter = Object.create(dtPostsIsotopeFilter);
			$.extend(filterConfig, {
				orderByContainer: $this.find('.filter-extras .filter-by'),
				orderContainer: $this.find('.filter-extras .filter-sorting'),
				isPhone: dtGlobals.isPhone
			});
		} else {
			var postsFilter = Object.create(dtPostsJGridFilter);
		}

		postsFilter.init(filterConfig);
	});
})

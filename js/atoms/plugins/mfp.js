/*! Magnific Popup - v0.9.9 - 2014-09-06
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2014 Dmitry Semenov; */
;(function($) {

	/*>>core*/
	/**
	 * 
	 * Magnific Popup Core JS file
	 * 
	 */

	/**
	 * Private static constants
	 */
	var CLOSE_EVENT = 'Close',
		BEFORE_CLOSE_EVENT = 'BeforeClose',
		AFTER_CLOSE_EVENT = 'AfterClose',
		BEFORE_APPEND_EVENT = 'BeforeAppend',
		MARKUP_PARSE_EVENT = 'MarkupParse',
		OPEN_EVENT = 'Open',
		CHANGE_EVENT = 'Change',
		NS = 'mfp',
		EVENT_NS = '.' + NS,
		READY_CLASS = 'mfp-ready',
		REMOVING_CLASS = 'mfp-removing',
		PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


	/**
	 * Private vars 
	 */
	var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
		MagnificPopup = function(){},
		_isJQ = !!(window.jQuery),
		_prevStatus,
		_window = $(window),
		_body,
		_document,
		_prevContentType,
		_wrapClasses,
		_currPopupType;


	/**
	 * Private functions
	 */
	var _mfpOn = function(name, f) {
			mfp.ev.on(NS + name + EVENT_NS, f);
		},
		_getEl = function(className, appendTo, html, raw) {
			var el = document.createElement('div');
			el.className = 'mfp-'+className;
			if(html) {
				el.innerHTML = html;
			}
			if(!raw) {
				el = $(el);
				if(appendTo) {
					el.appendTo(appendTo);
				}
			} else if(appendTo) {
				appendTo.appendChild(el);
			}
			return el;
		},
		_mfpTrigger = function(e, data) {
			mfp.ev.triggerHandler(NS + e, data);

			if(mfp.st.callbacks) {
				// converts "mfpEventName" to "eventName" callback and triggers it if it's present
				e = e.charAt(0).toLowerCase() + e.slice(1);
				if(mfp.st.callbacks[e]) {
					mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
				}
			}
		},
		_getCloseBtn = function(type) {
			if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
				mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
				_currPopupType = type;
			}
			return mfp.currTemplate.closeBtn;
		},
		// Initialize Magnific Popup only when called at least once
		_checkInstance = function() {
			if(!$.magnificPopup.instance) {
				mfp = new MagnificPopup();
				mfp.init();
				$.magnificPopup.instance = mfp;
			}
		},
		// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
		supportsTransitions = function() {
			var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
				v = ['ms','O','Moz','Webkit']; // 'v' for vendor

			if( s['transition'] !== undefined ) {
				return true; 
			}
				
			while( v.length ) {
				if( v.pop() + 'Transition' in s ) {
					return true;
				}
			}
					
			return false;
		};



	/**
	 * Public functions
	 */
	MagnificPopup.prototype = {

		constructor: MagnificPopup,

		/**
		 * Initializes Magnific Popup plugin. 
		 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
		 */
		init: function() {
			var appVersion = navigator.appVersion;
			mfp.isIE7 = appVersion.indexOf("MSIE 7.") !== -1; 
			mfp.isIE8 = appVersion.indexOf("MSIE 8.") !== -1;
			mfp.isLowIE = mfp.isIE7 || mfp.isIE8;
			mfp.isAndroid = (/android/gi).test(appVersion);
			mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
			mfp.supportsTransition = supportsTransitions();

			// We disable fixed positioned lightbox on devices that don't handle it nicely.
			// If you know a better way of detecting this - let me know.
			mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
			_document = $(document);

			mfp.popupsCache = {};
		},

		/**
		 * Opens popup
		 * @param  data [description]
		 */
		open: function(data) {

			if(!_body) {
				_body = $(document.body);
			}

			var i;

			if(data.isObj === false) { 
				// convert jQuery collection to array to avoid conflicts later
				mfp.items = data.items.toArray();

				mfp.index = 0;
				var items = data.items,
					item;
				for(i = 0; i < items.length; i++) {
					item = items[i];
					if(item.parsed) {
						item = item.el[0];
					}
					if(item === data.el[0]) {
						mfp.index = i;
						break;
					}
				}
			} else {
				mfp.items = $.isArray(data.items) ? data.items : [data.items];
				mfp.index = data.index || 0;
			}

			// if popup is already opened - we just update the content
			if(mfp.isOpen) {
				mfp.updateItemHTML();
				return;
			}
			
			mfp.types = []; 
			_wrapClasses = '';
			if(data.mainEl && data.mainEl.length) {
				mfp.ev = data.mainEl.eq(0);
			} else {
				mfp.ev = _document;
			}

			if(data.key) {
				if(!mfp.popupsCache[data.key]) {
					mfp.popupsCache[data.key] = {};
				}
				mfp.currTemplate = mfp.popupsCache[data.key];
			} else {
				mfp.currTemplate = {};
			}



			mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
			mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

			if(mfp.st.modal) {
				mfp.st.closeOnContentClick = false;
				mfp.st.closeOnBgClick = false;
				mfp.st.showCloseBtn = false;
				mfp.st.enableEscapeKey = false;
			}
			

			// Building markup
			// main containers are created only once
			if(!mfp.bgOverlay) {

				// Dark overlay
				mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
					mfp.close();
				});

				mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
					if(mfp._checkIfClose(e.target)) {
						mfp.close();
					}
				});

				mfp.container = _getEl('container', mfp.wrap);
			}

			mfp.contentContainer = _getEl('content');
			if(mfp.st.preloader) {
				mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
			}


			// Initializing modules
			var modules = $.magnificPopup.modules;
			for(i = 0; i < modules.length; i++) {
				var n = modules[i];
				n = n.charAt(0).toUpperCase() + n.slice(1);
				mfp['init'+n].call(mfp);
			}
			_mfpTrigger('BeforeOpen');


			if(mfp.st.showCloseBtn) {
				// Close button
				if(!mfp.st.closeBtnInside) {
					mfp.wrap.append( _getCloseBtn() );
				} else {
					_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
						values.close_replaceWith = _getCloseBtn(item.type);
					});
					_wrapClasses += ' mfp-close-btn-in';
				}
			}

			if(mfp.st.alignTop) {
				_wrapClasses += ' mfp-align-top';
			}

		

			if(mfp.fixedContentPos) {
				mfp.wrap.css({
					overflow: mfp.st.overflowY,
					overflowX: 'hidden',
					overflowY: mfp.st.overflowY
				});
			} else {
				mfp.wrap.css({ 
					top: _window.scrollTop(),
					position: 'absolute'
				});
			}
			if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
				mfp.bgOverlay.css({
					height: _document.height(),
					position: 'absolute'
				});
			}

			

			if(mfp.st.enableEscapeKey) {
				// Close on ESC key
				_document.on('keyup' + EVENT_NS, function(e) {
					if(e.keyCode === 27) {
						mfp.close();
					}
				});
			}

			_window.on('resize' + EVENT_NS, function() {
				mfp.updateSize();
			});


			if(!mfp.st.closeOnContentClick) {
				_wrapClasses += ' mfp-auto-cursor';
			}
			
			if(_wrapClasses)
				mfp.wrap.addClass(_wrapClasses);


			// this triggers recalculation of layout, so we get it once to not to trigger twice
			var windowHeight = mfp.wH = _window.height();

			
			var windowStyles = {};

			if( mfp.fixedContentPos ) {
	            if(mfp._hasScrollBar(windowHeight)){
	                var s = mfp._getScrollbarSize();
	                if(s) {
	                    windowStyles.marginRight = s;
	                }
	            }
	        }

			if(mfp.fixedContentPos) {
				if(!mfp.isIE7) {
					windowStyles.overflow = 'hidden';
				} else {
					// ie7 double-scroll bug
					$('body, html').css('overflow', 'hidden');
				}
			}

			
			
			var classesToadd = mfp.st.mainClass;
			if(mfp.isIE7) {
				classesToadd += ' mfp-ie7';
			}
			if(classesToadd) {
				mfp._addClassToMFP( classesToadd );
			}

			// add content
			mfp.updateItemHTML();

			_mfpTrigger('BuildControls');

			// remove scrollbar, add margin e.t.c
			$('html').css(windowStyles);
			
			// add everything to DOM
			mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || _body );

			// Save last focused element
			mfp._lastFocusedEl = document.activeElement;
			
			// Wait for next cycle to allow CSS transition
			setTimeout(function() {
				
				if(mfp.content) {
					mfp._addClassToMFP(READY_CLASS);
					mfp._setFocus();
				} else {
					// if content is not defined (not loaded e.t.c) we add class only for BG
					mfp.bgOverlay.addClass(READY_CLASS);
				}
				
				// Trap the focus in popup
				_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

			}, 16);

			mfp.isOpen = true;
			mfp.updateSize(windowHeight);
			_mfpTrigger(OPEN_EVENT);

			return data;
		},

		/**
		 * Closes the popup
		 */
		close: function() {
			if(!mfp.isOpen) return;
			_mfpTrigger(BEFORE_CLOSE_EVENT);

			mfp.isOpen = false;
			// for CSS3 animation
			if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
				mfp._addClassToMFP(REMOVING_CLASS);
				setTimeout(function() {
					mfp._close();
				}, mfp.st.removalDelay);
			} else {
				mfp._close();
			}
		},

		/**
		 * Helper for close() function
		 */
		_close: function() {
			_mfpTrigger(CLOSE_EVENT);

			var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

			mfp.bgOverlay.detach();
			mfp.wrap.detach();
			mfp.container.empty();

			if(mfp.st.mainClass) {
				classesToRemove += mfp.st.mainClass + ' ';
			}

			mfp._removeClassFromMFP(classesToRemove);

			if(mfp.fixedContentPos) {
				var windowStyles = {marginRight: ''};
				if(mfp.isIE7) {
					$('body, html').css('overflow', '');
				} else {
					windowStyles.overflow = '';
				}
				$('html').css(windowStyles);
			}
			
			_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
			mfp.ev.off(EVENT_NS);

			// clean up DOM elements that aren't removed
			mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
			mfp.bgOverlay.attr('class', 'mfp-bg');
			mfp.container.attr('class', 'mfp-container');

			// remove close button from target element
			if(mfp.st.showCloseBtn &&
			(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
				if(mfp.currTemplate.closeBtn)
					mfp.currTemplate.closeBtn.detach();
			}


			if(mfp._lastFocusedEl) {
				$(mfp._lastFocusedEl).focus(); // put tab focus back
			}
			mfp.currItem = null;	
			mfp.content = null;
			mfp.currTemplate = null;
			mfp.prevHeight = 0;

			_mfpTrigger(AFTER_CLOSE_EVENT);
		},
		
		updateSize: function(winHeight) {

			if(mfp.isIOS) {
				// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
				var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
				var height = window.innerHeight * zoomLevel;
				mfp.wrap.css('height', height);
				mfp.wH = height;
			} else {
				mfp.wH = winHeight || _window.height();
			}
			// Fixes #84: popup incorrectly positioned with position:relative on body
			if(!mfp.fixedContentPos) {
				mfp.wrap.css('height', mfp.wH);
			}

			_mfpTrigger('Resize');

		},

		/**
		 * Set content of popup based on current index
		 */
		updateItemHTML: function() {
			var item = mfp.items[mfp.index];

			// Detach and perform modifications
			mfp.contentContainer.detach();

			if(mfp.content)
				mfp.content.detach();

			if(!item.parsed) {
				item = mfp.parseEl( mfp.index );
			}

			var type = item.type;	

			_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
			// BeforeChange event works like so:
			// _mfpOn('BeforeChange', function(e, prevType, newType) { });
			
			mfp.currItem = item;

			if(!mfp.currTemplate[type]) {
				var markup = mfp.st[type] ? mfp.st[type].markup : false;

				// allows to modify markup
				_mfpTrigger('FirstMarkupParse', markup);

				if(markup) {
					mfp.currTemplate[type] = $(markup);
				} else {
					// if there is no markup found we just define that template is parsed
					mfp.currTemplate[type] = true;
				}
			}

			if(_prevContentType && _prevContentType !== item.type) {
				mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
			}
			
			var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
			mfp.appendContent(newContent, type);

			item.preloaded = true;

			_mfpTrigger(CHANGE_EVENT, item);
			_prevContentType = item.type;
			
			// Append container back after its content changed
			mfp.container.prepend(mfp.contentContainer);

			_mfpTrigger('AfterChange');
		},


		/**
		 * Set HTML content of popup
		 */
		appendContent: function(newContent, type) {
			mfp.content = newContent;
			
			if(newContent) {
				if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
					mfp.currTemplate[type] === true) {
					// if there is no markup, we just append close button element inside
					if(!mfp.content.find('.mfp-close').length) {
						mfp.content.append(_getCloseBtn());
					}
				} else {
					mfp.content = newContent;
				}
			} else {
				mfp.content = '';
			}

			_mfpTrigger(BEFORE_APPEND_EVENT);
			mfp.container.addClass('mfp-'+type+'-holder');

			mfp.contentContainer.append(mfp.content);
		},
		/**
		 * Creates Magnific Popup data object based on given data
		 * @param  {int} index Index of item to parse
		 */
		parseEl: function(index) {
			var item = mfp.items[index],
				type;

			if(item.tagName) {
				item = { el: $(item) };
			} else {
				type = item.type;
				item = { data: item, src: item.src };
			}

			if(item.el) {
				var types = mfp.types;

				// check for 'mfp-TYPE' class
				for(var i = 0; i < types.length; i++) {
					if( item.el.hasClass('mfp-'+types[i]) ) {
						type = types[i];
						break;
					}
				}

				item.src = item.el.attr('data-mfp-src');
				if(!item.src) {
					item.src = item.el.attr('href');
				}
			}

			item.type = type || mfp.st.type || 'inline';
			item.index = index;
			item.parsed = true;
			mfp.items[index] = item;
			_mfpTrigger('ElementParse', item);

			return mfp.items[index];
		},


		/**
		 * Initializes single popup or a group of popups
		 */
		addGroup: function(el, options) {
			var eHandler = function(e) {
				e.mfpEl = this;
				mfp._openClick(e, el, options);
			};

			if(!options) {
				options = {};
			} 

			var eName = 'click.magnificPopup';
			options.mainEl = el;
			
			if(options.items) {
				options.isObj = true;
				el.off(eName).on(eName, eHandler);
			} else {
				options.isObj = false;
				if(options.delegate) {
					el.off(eName).on(eName, options.delegate , eHandler);
				} else {
					options.items = el;
					el.off(eName).on(eName, eHandler);
				}
			}
		},
		_openClick: function(e, el, options) {
			var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


			if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey ) ) {
				return;
			}

			var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

			if(disableOn) {
				if($.isFunction(disableOn)) {
					if( !disableOn.call(mfp) ) {
						return true;
					}
				} else { // else it's number
					if( _window.width() < disableOn ) {
						return true;
					}
				}
			}
			
			if(e.type) {
				e.preventDefault();

				// This will prevent popup from closing if element is inside and popup is already opened
				if(mfp.isOpen) {
					e.stopPropagation();
				}
			}
				

			options.el = $(e.mfpEl);
			if(options.delegate) {
				options.items = el.find(options.delegate);
			}
			mfp.open(options);
		},


		/**
		 * Updates text on preloader
		 */
		updateStatus: function(status, text) {

			if(mfp.preloader) {
				if(_prevStatus !== status) {
					mfp.container.removeClass('mfp-s-'+_prevStatus);
				}

				if(!text && status === 'loading') {
					text = mfp.st.tLoading;
				}

				var data = {
					status: status,
					text: text
				};
				// allows to modify status
				_mfpTrigger('UpdateStatus', data);

				status = data.status;
				text = data.text;

				mfp.preloader.html(text);

				mfp.preloader.find('a').on('click', function(e) {
					e.stopImmediatePropagation();
				});

				mfp.container.addClass('mfp-s-'+status);
				_prevStatus = status;
			}
		},


		/*
			"Private" helpers that aren't private at all
		 */
		// Check to close popup or not
		// "target" is an element that was clicked
		_checkIfClose: function(target) {

			if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
				return;
			}

			var closeOnContent = mfp.st.closeOnContentClick;
			var closeOnBg = mfp.st.closeOnBgClick;

			if(closeOnContent && closeOnBg) {
				return true;
			} else {

				// We close the popup if click is on close button or on preloader. Or if there is no content.
				if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
					return true;
				}

				// if click is outside the content
				if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
					if(closeOnBg) {
						// last check, if the clicked element is in DOM, (in case it's removed onclick)
						if( $.contains(document, target) ) {
							return true;
						}
					}
				} else if(closeOnContent) {
					return true;
				}

			}
			return false;
		},
		_addClassToMFP: function(cName) {
			mfp.bgOverlay.addClass(cName);
			mfp.wrap.addClass(cName);
		},
		_removeClassFromMFP: function(cName) {
			this.bgOverlay.removeClass(cName);
			mfp.wrap.removeClass(cName);
		},
		_hasScrollBar: function(winHeight) {
			return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
		},
		_setFocus: function() {
			(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
		},
		_onFocusIn: function(e) {
			if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
				mfp._setFocus();
				return false;
			}
		},
		_parseMarkup: function(template, values, item) {
			var arr;
			if(item.data) {
				values = $.extend(item.data, values);
			}
			_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

			$.each(values, function(key, value) {
				if(value === undefined || value === false) {
					return true;
				}
				arr = key.split('_');
				if(arr.length > 1) {
					var el = template.find(EVENT_NS + '-'+arr[0]);

					if(el.length > 0) {
						var attr = arr[1];
						if(attr === 'replaceWith') {
							if(el[0] !== value[0]) {
								el.replaceWith(value);
							}
						} else if(attr === 'img') {
							if(el.is('img')) {
								el.attr('src', value);
							} else {
								el.replaceWith( '<img src="'+value+'" class="' + el.attr('class') + '" />' );
							}
						} else {
							el.attr(arr[1], value);
						}
					}

				} else {
					template.find(EVENT_NS + '-'+key).html(value);
				}
			});
		},

		_getScrollbarSize: function() {
			// thx David
			if(mfp.scrollbarSize === undefined) {
				var scrollDiv = document.createElement("div");
				scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
				document.body.appendChild(scrollDiv);
				mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
				document.body.removeChild(scrollDiv);
			}
			return mfp.scrollbarSize;
		}

	}; /* MagnificPopup core prototype end */




	/**
	 * Public static functions
	 */
	$.magnificPopup = {
		instance: null,
		proto: MagnificPopup.prototype,
		modules: [],

		open: function(options, index) {
			_checkInstance();	

			if(!options) {
				options = {};
			} else {
				options = $.extend(true, {}, options);
			}
				

			options.isObj = true;
			options.index = index || 0;
			return this.instance.open(options);
		},

		close: function() {
			return $.magnificPopup.instance && $.magnificPopup.instance.close();
		},

		registerModule: function(name, module) {
			if(module.options) {
				$.magnificPopup.defaults[name] = module.options;
			}
			$.extend(this.proto, module.proto);			
			this.modules.push(name);
		},

		defaults: {   

			// Info about options is in docs:
			// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options
			
			disableOn: 0,	

			key: null,

			midClick: false,

			mainClass: '',

			preloader: true,

			focus: '', // CSS selector of input to focus after popup is opened
			
			closeOnContentClick: false,

			closeOnBgClick: true,

			closeBtnInside: true, 

			showCloseBtn: true,

			enableEscapeKey: true,

			modal: false,

			alignTop: false,
		
			removalDelay: 0,

			prependTo: null,
			
			fixedContentPos: 'auto', 
		
			fixedBgPos: 'auto',

			overflowY: 'auto',

			closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>',

			tClose: 'Close (Esc)',

			tLoading: 'Loading...'

		}
	};



	$.fn.magnificPopup = function(options) {
		_checkInstance();

		var jqEl = $(this);

		// We call some API method of first param is a string
		if (typeof options === "string" ) {

			if(options === 'open') {
				var items,
					itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
					index = parseInt(arguments[1], 10) || 0;

				if(itemOpts.items) {
					items = itemOpts.items[index];
				} else {
					items = jqEl;
					if(itemOpts.delegate) {
						items = items.find(itemOpts.delegate);
					}
					items = items.eq( index );
				}
				mfp._openClick({mfpEl:items}, jqEl, itemOpts);
			} else {
				if(mfp.isOpen)
					mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
			}

		} else {
			// clone options obj
			options = $.extend(true, {}, options);
			
			/*
			 * As Zepto doesn't support .data() method for objects 
			 * and it works only in normal browsers
			 * we assign "options" object directly to the DOM element. FTW!
			 */
			if(_isJQ) {
				jqEl.data('magnificPopup', options);
			} else {
				jqEl[0].magnificPopup = options;
			}

			mfp.addGroup(jqEl, options);

		}
		return jqEl;
	};


	//Quick benchmark
	/*
	var start = performance.now(),
		i,
		rounds = 1000;

	for(i = 0; i < rounds; i++) {

	}
	console.log('Test #1:', performance.now() - start);

	start = performance.now();
	for(i = 0; i < rounds; i++) {

	}
	console.log('Test #2:', performance.now() - start);
	*/


	/*>>core*/

	/*>>inline*/

	var INLINE_NS = 'inline',
		_hiddenClass,
		_inlinePlaceholder, 
		_lastInlineElement,
		_putInlineElementsBack = function() {
			if(_lastInlineElement) {
				_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
				_lastInlineElement = null;
			}
		};

	$.magnificPopup.registerModule(INLINE_NS, {
		options: {
			hiddenClass: 'hide', // will be appended with `mfp-` prefix
			markup: '',
			tNotFound: 'Content not found'
		},
		proto: {

			initInline: function() {
				mfp.types.push(INLINE_NS);

				_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
					_putInlineElementsBack();
				});
			},

			getInline: function(item, template) {

				_putInlineElementsBack();

				if(item.src) {
					var inlineSt = mfp.st.inline,
						el = $(item.src);

					if(el.length) {

						// If target element has parent - we replace it with placeholder and put it back after popup is closed
						var parent = el[0].parentNode;
						if(parent && parent.tagName) {
							if(!_inlinePlaceholder) {
								_hiddenClass = inlineSt.hiddenClass;
								_inlinePlaceholder = _getEl(_hiddenClass);
								_hiddenClass = 'mfp-'+_hiddenClass;
							}
							// replace target inline element with placeholder
							_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
						}

						mfp.updateStatus('ready');
					} else {
						mfp.updateStatus('error', inlineSt.tNotFound);
						el = $('<div>');
					}

					item.inlineElement = el;
					return el;
				}

				mfp.updateStatus('ready');
				mfp._parseMarkup(template, {}, item);
				return template;
			}
		}
	});

	/*>>inline*/

	/*>>ajax*/
	var AJAX_NS = 'ajax',
		_ajaxCur,
		_removeAjaxCursor = function() {
			if(_ajaxCur) {
				_body.removeClass(_ajaxCur);
			}
		},
		_destroyAjaxRequest = function() {
			_removeAjaxCursor();
			if(mfp.req) {
				mfp.req.abort();
			}
		};

	$.magnificPopup.registerModule(AJAX_NS, {

		options: {
			settings: null,
			cursor: 'mfp-ajax-cur',
			tError: '<a href="%url%">The content</a> could not be loaded.'
		},

		proto: {
			initAjax: function() {
				mfp.types.push(AJAX_NS);
				_ajaxCur = mfp.st.ajax.cursor;

				_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
				_mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
			},
			getAjax: function(item) {

				if(_ajaxCur)
					_body.addClass(_ajaxCur);

				mfp.updateStatus('loading');

				var opts = $.extend({
					url: item.src,
					success: function(data, textStatus, jqXHR) {
						var temp = {
							data:data,
							xhr:jqXHR
						};

						_mfpTrigger('ParseAjax', temp);

						mfp.appendContent( $(temp.data), AJAX_NS );

						item.finished = true;

						_removeAjaxCursor();

						mfp._setFocus();

						setTimeout(function() {
							mfp.wrap.addClass(READY_CLASS);
						}, 16);

						mfp.updateStatus('ready');

						_mfpTrigger('AjaxContentAdded');
					},
					error: function() {
						_removeAjaxCursor();
						item.finished = item.loadError = true;
						mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
					}
				}, mfp.st.ajax.settings);

				mfp.req = $.ajax(opts);

				return '';
			}
		}
	});


	/*>>ajax*/

	/*>>image*/
	var _imgInterval,
		_getTitle = function(item) {
			if(item.data && item.data.title !== undefined) 
				return item.data.title;

			var src = mfp.st.image.titleSrc;

			if(src) {
				if($.isFunction(src)) {
					return src.call(mfp, item);
				} else if(item.el) {
					return item.el.attr(src) || '';
				}
			}
			return '';
		};

	$.magnificPopup.registerModule('image', {

		options: {
			markup: '<div class="mfp-figure">'+
						'<div class="mfp-close"></div>'+
						'<figure>'+
							'<div class="mfp-img"></div>'+
							'<figcaption>'+
								'<div class="mfp-bottom-bar">'+
									'<div class="mfp-title"></div>'+
									'<div class="mfp-counter"></div>'+
								'</div>'+
							'</figcaption>'+
						'</figure>'+
					'</div>',
			cursor: 'mfp-zoom-out-cur',
			titleSrc: 'title', 
			verticalFit: true,
			tError: '<a href="%url%">The image</a> could not be loaded.'
		},

		proto: {
			initImage: function() {
				var imgSt = mfp.st.image,
					ns = '.image';

				mfp.types.push('image');

				_mfpOn(OPEN_EVENT+ns, function() {
					if(mfp.currItem.type === 'image' && imgSt.cursor) {
						_body.addClass(imgSt.cursor);
					}
				});

				_mfpOn(CLOSE_EVENT+ns, function() {
					if(imgSt.cursor) {
						_body.removeClass(imgSt.cursor);
					}
					_window.off('resize' + EVENT_NS);
				});

				_mfpOn('Resize'+ns, mfp.resizeImage);
				if(mfp.isLowIE) {
					_mfpOn('AfterChange', mfp.resizeImage);
				}
			},
			resizeImage: function() {
				var item = mfp.currItem;
				if(!item || !item.img) return;

				if(mfp.st.image.verticalFit) {
					var decr = 0;
					// fix box-sizing in ie7/8
					if(mfp.isLowIE) {
						decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
					}
					item.img.css('max-height', mfp.wH-decr);
				}
			},
			_onImageHasSize: function(item) {
				if(item.img) {
					
					item.hasSize = true;

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					
					item.isCheckingImgSize = false;

					_mfpTrigger('ImageHasSize', item);

					if(item.imgHidden) {
						if(mfp.content)
							mfp.content.removeClass('mfp-loading');
						
						item.imgHidden = false;
					}

				}
			},

			/**
			 * Function that loops until the image has size to display elements that rely on it asap
			 */
			findImageSize: function(item) {

				var counter = 0,
					img = item.img[0],
					mfpSetInterval = function(delay) {

						if(_imgInterval) {
							clearInterval(_imgInterval);
						}
						// decelerating interval that checks for size of an image
						_imgInterval = setInterval(function() {
							if(img.naturalWidth > 0) {
								mfp._onImageHasSize(item);
								return;
							}

							if(counter > 200) {
								clearInterval(_imgInterval);
							}

							counter++;
							if(counter === 3) {
								mfpSetInterval(10);
							} else if(counter === 40) {
								mfpSetInterval(50);
							} else if(counter === 100) {
								mfpSetInterval(500);
							}
						}, delay);
					};

				mfpSetInterval(1);
			},

			getImage: function(item, template) {

				var guard = 0,

					// image load complete handler
					onLoadComplete = function() {
						if(item) {
							if (item.img[0].complete) {
								item.img.off('.mfploader');
								
								if(item === mfp.currItem){
									mfp._onImageHasSize(item);

									mfp.updateStatus('ready');
								}

								item.hasSize = true;
								item.loaded = true;

								_mfpTrigger('ImageLoadComplete');
								
							}
							else {
								// if image complete check fails 200 times (20 sec), we assume that there was an error.
								guard++;
								if(guard < 200) {
									setTimeout(onLoadComplete,100);
								} else {
									onLoadError();
								}
							}
						}
					},

					// image error handler
					onLoadError = function() {
						if(item) {
							item.img.off('.mfploader');
							if(item === mfp.currItem){
								mfp._onImageHasSize(item);
								mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
							}

							item.hasSize = true;
							item.loaded = true;
							item.loadError = true;
						}
					},
					imgSt = mfp.st.image;


				var el = template.find('.mfp-img');
				if(el.length) {
					var img = document.createElement('img');
					img.className = 'mfp-img';
					item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
					img.src = item.src;

					// without clone() "error" event is not firing when IMG is replaced by new IMG
					// TODO: find a way to avoid such cloning
					if(el.is('img')) {
						item.img = item.img.clone();
					}

					img = item.img[0];
					if(img.naturalWidth > 0) {
						item.hasSize = true;
					} else if(!img.width) {										
						item.hasSize = false;
					}
				}

				mfp._parseMarkup(template, {
					title: _getTitle(item),
					img_replaceWith: item.img
				}, item);

				mfp.resizeImage();

				if(item.hasSize) {
					if(_imgInterval) clearInterval(_imgInterval);

					if(item.loadError) {
						template.addClass('mfp-loading');
						mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
					} else {
						template.removeClass('mfp-loading');
						mfp.updateStatus('ready');
					}
					return template;
				}

				mfp.updateStatus('loading');
				item.loading = true;

				if(!item.hasSize) {
					item.imgHidden = true;
					template.addClass('mfp-loading');
					mfp.findImageSize(item);
				} 

				return template;
			}
		}
	});



	/*>>image*/

	/*>>zoom*/
	var hasMozTransform,
		getHasMozTransform = function() {
			if(hasMozTransform === undefined) {
				hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
			}
			return hasMozTransform;		
		};

	$.magnificPopup.registerModule('zoom', {

		options: {
			enabled: false,
			easing: 'ease-in-out',
			duration: 300,
			opener: function(element) {
				return element.is('img') ? element : element.find('img');
			}
		},

		proto: {

			initZoom: function() {
				var zoomSt = mfp.st.zoom,
					ns = '.zoom',
					image;
					
				if(!zoomSt.enabled || !mfp.supportsTransition) {
					return;
				}

				var duration = zoomSt.duration,
					getElToAnimate = function(image) {
						var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
							transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
							cssObj = {
								position: 'fixed',
								zIndex: 9999,
								left: 0,
								top: 0,
								'-webkit-backface-visibility': 'hidden'
							},
							t = 'transition';

						cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

						newImg.css(cssObj);
						return newImg;
					},
					showMainContent = function() {
						mfp.content.css('visibility', 'visible');
					},
					openTimeout,
					animatedImg;

				_mfpOn('BuildControls'+ns, function() {
					if(mfp._allowZoom()) {

						clearTimeout(openTimeout);
						mfp.content.css('visibility', 'hidden');

						// Basically, all code below does is clones existing image, puts in on top of the current one and animated it
						
						image = mfp._getItemToZoom();

						if(!image) {
							showMainContent();
							return;
						}

						animatedImg = getElToAnimate(image); 
						
						animatedImg.css( mfp._getOffset() );

						mfp.wrap.append(animatedImg);

						openTimeout = setTimeout(function() {
							animatedImg.css( mfp._getOffset( true ) );
							openTimeout = setTimeout(function() {

								showMainContent();

								setTimeout(function() {
									animatedImg.remove();
									image = animatedImg = null;
									_mfpTrigger('ZoomAnimationEnded');
								}, 16); // avoid blink when switching images 

							}, duration); // this timeout equals animation duration

						}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


						// Lots of timeouts...
					}
				});
				_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
					if(mfp._allowZoom()) {

						clearTimeout(openTimeout);

						mfp.st.removalDelay = duration;

						if(!image) {
							image = mfp._getItemToZoom();
							if(!image) {
								return;
							}
							animatedImg = getElToAnimate(image);
						}
						
						
						animatedImg.css( mfp._getOffset(true) );
						mfp.wrap.append(animatedImg);
						mfp.content.css('visibility', 'hidden');
						
						setTimeout(function() {
							animatedImg.css( mfp._getOffset() );
						}, 16);
					}

				});

				_mfpOn(CLOSE_EVENT+ns, function() {
					if(mfp._allowZoom()) {
						showMainContent();
						if(animatedImg) {
							animatedImg.remove();
						}
						image = null;
					}	
				});
			},

			_allowZoom: function() {
				return mfp.currItem.type === 'image';
			},

			_getItemToZoom: function() {
				if(mfp.currItem.hasSize) {
					return mfp.currItem.img;
				} else {
					return false;
				}
			},

			// Get element postion relative to viewport
			_getOffset: function(isLarge) {
				var el;
				if(isLarge) {
					el = mfp.currItem.img;
				} else {
					el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
				}

				var offset = el.offset();
				var paddingTop = parseInt(el.css('padding-top'),10);
				var paddingBottom = parseInt(el.css('padding-bottom'),10);
				offset.top -= ( $(window).scrollTop() - paddingTop );


				/*
				
				Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

				 */
				var obj = {
					width: el.width(),
					// fix Zepto height+padding issue
					height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
				};

				// I hate to do this, but there is no another option
				if( getHasMozTransform() ) {
					obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
				} else {
					obj.left = offset.left;
					obj.top = offset.top;
				}
				return obj;
			}

		}
	});



	/*>>zoom*/

	/*>>iframe*/

	var IFRAME_NS = 'iframe',
		_emptyPage = '//about:blank',
		
		_fixIframeBugs = function(isShowing) {
			if(mfp.currTemplate[IFRAME_NS]) {
				var el = mfp.currTemplate[IFRAME_NS].find('iframe');
				if(el.length) { 
					// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
					if(!isShowing) {
						el[0].src = _emptyPage;
					}

					// IE8 black screen bug fix
					if(mfp.isIE8) {
						el.css('display', isShowing ? 'block' : 'none');
					}
				}
			}
		};

	$.magnificPopup.registerModule(IFRAME_NS, {

		options: {
			markup: '<div class="mfp-iframe-scaler">'+
						'<div class="mfp-close"></div>'+
						'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
					'</div>',

			srcAction: 'iframe_src',

			// we don't care and support only one default type of URL by default
			patterns: {
				youtube: {
					index: 'youtube.com', 
					id: 'v=', 
					src: '//www.youtube.com/embed/%id%?autoplay=1'
				},
				vimeo: {
					index: 'vimeo.com/',
					id: '/',
					src: '//player.vimeo.com/video/%id%?autoplay=1'
				},
				gmaps: {
					index: '//maps.google.',
					src: '%id%&output=embed'
				}
			}
		},

		proto: {
			initIframe: function() {
				mfp.types.push(IFRAME_NS);

				_mfpOn('BeforeChange', function(e, prevType, newType) {
					if(prevType !== newType) {
						if(prevType === IFRAME_NS) {
							_fixIframeBugs(); // iframe if removed
						} else if(newType === IFRAME_NS) {
							_fixIframeBugs(true); // iframe is showing
						} 
					}// else {
						// iframe source is switched, don't do anything
					//}
				});

				_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
					_fixIframeBugs();
				});
			},

			getIframe: function(item, template) {
				var embedSrc = item.src;
				var iframeSt = mfp.st.iframe;
					
				$.each(iframeSt.patterns, function() {
					if(embedSrc.indexOf( this.index ) > -1) {
						if(this.id) {
							if(typeof this.id === 'string') {
								embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
							} else {
								embedSrc = this.id.call( this, embedSrc );
							}
						}
						embedSrc = this.src.replace('%id%', embedSrc );
						return false; // break;
					}
				});
				
				var dataObj = {};
				if(iframeSt.srcAction) {
					dataObj[iframeSt.srcAction] = embedSrc;
				}
				mfp._parseMarkup(template, dataObj, item);

				mfp.updateStatus('ready');

				return template;
			}
		}
	});



	/*>>iframe*/

	/*>>gallery*/
	/**
	 * Get looped index depending on number of slides
	 */
	var _getLoopedId = function(index) {
			var numSlides = mfp.items.length;
			if(index > numSlides - 1) {
				return index - numSlides;
			} else  if(index < 0) {
				return numSlides + index;
			}
			return index;
		},
		_replaceCurrTotal = function(text, curr, total) {
			return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
		};

	$.magnificPopup.registerModule('gallery', {

		options: {
			enabled: false,
			arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
			preload: [0,2],
			navigateByImgClick: true,
			arrows: true,

			tPrev: 'Previous (Left arrow key)',
			tNext: 'Next (Right arrow key)',
			tCounter: '%curr% of %total%'
		},

		proto: {
			initGallery: function() {

				var gSt = mfp.st.gallery,
					ns = '.mfp-gallery',
					supportsFastClick = Boolean($.fn.mfpFastClick);

				mfp.direction = true; // true - next, false - prev
				
				if(!gSt || !gSt.enabled ) return false;

				_wrapClasses += ' mfp-gallery';

				_mfpOn(OPEN_EVENT+ns, function() {

					if(gSt.navigateByImgClick) {
						mfp.wrap.on('click'+ns, '.mfp-img', function() {
							if(mfp.items.length > 1) {
								mfp.next();
								return false;
							}
						});
					}

					_document.on('keydown'+ns, function(e) {
						if (e.keyCode === 37) {
							mfp.prev();
						} else if (e.keyCode === 39) {
							mfp.next();
						}
					});
				});

				_mfpOn('UpdateStatus'+ns, function(e, data) {
					if(data.text) {
						data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
					}
				});

				_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
					var l = mfp.items.length;
					values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
				});

				_mfpOn('BuildControls' + ns, function() {
					if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
						var markup = gSt.arrowMarkup,
							arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),			
							arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

						var eName = supportsFastClick ? 'mfpFastClick' : 'click';
						arrowLeft[eName](function() {
							mfp.prev();
						});			
						arrowRight[eName](function() {
							mfp.next();
						});	

						// Polyfill for :before and :after (adds elements with classes mfp-a and mfp-b)
						if(mfp.isIE7) {
							_getEl('b', arrowLeft[0], false, true);
							_getEl('a', arrowLeft[0], false, true);
							_getEl('b', arrowRight[0], false, true);
							_getEl('a', arrowRight[0], false, true);
						}

						mfp.container.append(arrowLeft.add(arrowRight));
					}
				});

				_mfpOn(CHANGE_EVENT+ns, function() {
					if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

					mfp._preloadTimeout = setTimeout(function() {
						mfp.preloadNearbyImages();
						mfp._preloadTimeout = null;
					}, 16);
				});


				_mfpOn(CLOSE_EVENT+ns, function() {
					_document.off(ns);
					mfp.wrap.off('click'+ns);
				
					if(mfp.arrowLeft && supportsFastClick) {
						mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick();
					}
					mfp.arrowRight = mfp.arrowLeft = null;
				});

			}, 
			next: function() {
				mfp.direction = true;
				mfp.index = _getLoopedId(mfp.index + 1);
				mfp.updateItemHTML();
			},
			prev: function() {
				mfp.direction = false;
				mfp.index = _getLoopedId(mfp.index - 1);
				mfp.updateItemHTML();
			},
			goTo: function(newIndex) {
				mfp.direction = (newIndex >= mfp.index);
				mfp.index = newIndex;
				mfp.updateItemHTML();
			},
			preloadNearbyImages: function() {
				var p = mfp.st.gallery.preload,
					preloadBefore = Math.min(p[0], mfp.items.length),
					preloadAfter = Math.min(p[1], mfp.items.length),
					i;

				for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
					mfp._preloadItem(mfp.index+i);
				}
				for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
					mfp._preloadItem(mfp.index-i);
				}
			},
			_preloadItem: function(index) {
				index = _getLoopedId(index);

				if(mfp.items[index].preloaded) {
					return;
				}

				var item = mfp.items[index];
				if(!item.parsed) {
					item = mfp.parseEl( index );
				}

				_mfpTrigger('LazyLoad', item);

				if(item.type === 'image') {
					item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
						item.hasSize = true;
					}).on('error.mfploader', function() {
						item.hasSize = true;
						item.loadError = true;
						_mfpTrigger('LazyLoadError', item);
					}).attr('src', item.src);
				}


				item.preloaded = true;
			}
		}
	});

	/*
	Touch Support that might be implemented some day

	addSwipeGesture: function() {
		var startX,
			moved,
			multipleTouches;

			return;

		var namespace = '.mfp',
			addEventNames = function(pref, down, move, up, cancel) {
				mfp._tStart = pref + down + namespace;
				mfp._tMove = pref + move + namespace;
				mfp._tEnd = pref + up + namespace;
				mfp._tCancel = pref + cancel + namespace;
			};

		if(window.navigator.msPointerEnabled) {
			addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
		} else if('ontouchstart' in window) {
			addEventNames('touch', 'start', 'move', 'end', 'cancel');
		} else {
			return;
		}
		_window.on(mfp._tStart, function(e) {
			var oE = e.originalEvent;
			multipleTouches = moved = false;
			startX = oE.pageX || oE.changedTouches[0].pageX;
		}).on(mfp._tMove, function(e) {
			if(e.originalEvent.touches.length > 1) {
				multipleTouches = e.originalEvent.touches.length;
			} else {
				//e.preventDefault();
				moved = true;
			}
		}).on(mfp._tEnd + ' ' + mfp._tCancel, function(e) {
			if(moved && !multipleTouches) {
				var oE = e.originalEvent,
					diff = startX - (oE.pageX || oE.changedTouches[0].pageX);

				if(diff > 20) {
					mfp.next();
				} else if(diff < -20) {
					mfp.prev();
				}
			}
		});
	},
	*/


	/*>>gallery*/

	/*>>retina*/

	var RETINA_NS = 'retina';

	$.magnificPopup.registerModule(RETINA_NS, {
		options: {
			replaceSrc: function(item) {
				return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
			},
			ratio: 1 // Function or number.  Set to 1 to disable.
		},
		proto: {
			initRetina: function() {
				if(window.devicePixelRatio > 1) {

					var st = mfp.st.retina,
						ratio = st.ratio;

					ratio = !isNaN(ratio) ? ratio : ratio();

					if(ratio > 1) {
						_mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
							item.img.css({
								'max-width': item.img[0].naturalWidth / ratio,
								'width': '100%'
							});
						});
						_mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
							item.src = st.replaceSrc(item, ratio);
						});
					}
				}

			}
		}
	});

	/*>>retina*/

	/*>>fastclick*/
	/**
	 * FastClick event implementation. (removes 300ms delay on touch devices)
	 * Based on https://developers.google.com/mobile/articles/fast_buttons
	 *
	 * You may use it outside the Magnific Popup by calling just:
	 *
	 * $('.your-el').mfpFastClick(function() {
	 *     console.log('Clicked!');
	 * });
	 *
	 * To unbind:
	 * $('.your-el').destroyMfpFastClick();
	 * 
	 * 
	 * Note that it's a very basic and simple implementation, it blocks ghost click on the same element where it was bound.
	 * If you need something more advanced, use plugin by FT Labs https://github.com/ftlabs/fastclick
	 * 
	 */

	(function() {
		var ghostClickDelay = 1000,
			supportsTouch = 'ontouchstart' in window,
			unbindTouchMove = function() {
				_window.off('touchmove'+ns+' touchend'+ns);
			},
			eName = 'mfpFastClick',
			ns = '.'+eName;


		// As Zepto.js doesn't have an easy way to add custom events (like jQuery), so we implement it in this way
		$.fn.mfpFastClick = function(callback) {

			return $(this).each(function() {

				var elem = $(this),
					lock;

				if( supportsTouch ) {

					var timeout,
						startX,
						startY,
						pointerMoved,
						point,
						numPointers;

					elem.on('touchstart' + ns, function(e) {
						pointerMoved = false;
						numPointers = 1;

						point = e.originalEvent ? e.originalEvent.touches[0] : e.touches[0];
						startX = point.clientX;
						startY = point.clientY;

						_window.on('touchmove'+ns, function(e) {
							point = e.originalEvent ? e.originalEvent.touches : e.touches;
							numPointers = point.length;
							point = point[0];
							if (Math.abs(point.clientX - startX) > 10 ||
								Math.abs(point.clientY - startY) > 10) {
								pointerMoved = true;
								unbindTouchMove();
							}
						}).on('touchend'+ns, function(e) {
							unbindTouchMove();
							if(pointerMoved || numPointers > 1) {
								return;
							}
							lock = true;
							e.preventDefault();
							clearTimeout(timeout);
							timeout = setTimeout(function() {
								lock = false;
							}, ghostClickDelay);
							callback();
						});
					});

				}

				elem.on('click' + ns, function() {
					if(!lock) {
						callback();
					}
				});
			});
		};

		$.fn.destroyMfpFastClick = function() {
			$(this).off('touchstart' + ns + ' click' + ns);
			if(supportsTouch) _window.off('touchmove'+ns+' touchend'+ns);
		};
})();

/*>>fastclick*/
 _checkInstance(); })(window.jQuery || window.Zepto);

jQuery(document).ready(function($) {
	dtGlobals.magnificPopupBaseConfig = {
	type: 'image',
	tLoading: 'Loading image ...',
	mainClass: 'mfp-img-mobile',
	removalDelay: 300,
	image: {
		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		titleSrc: function(item) {
			return this.st.dt.getItemTitle(item);
		}
	},
	iframe: {
		markup: '<div class="mfp-iframe-scaler">'+
				'<div class="mfp-close"></div>'+
				'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
				'<div class="mfp-bottom-bar">'+
				'<div class="mfp-title"></div>'+
				'<div class="mfp-counter"></div>'+
				'</div>'+
				'</div>'
	},
	callbacks: {
		markupParse: function(template, values, item) {
			if ( 'iframe' == item.type ) {
				template.find('.mfp-title').html( this.st.dt.getItemTitle(item) );
			}

			if ( !this.ev.attr('data-pretty-share') ) {
				template.addClass("no-share-buttons");
			}
		},
		change: function() {
			if (this.isOpen) {
				/*transition between the images in the gallery*/
				this.wrap.addClass('mfp-open');
			}
		},
		beforeClose: function() {
			$('body, html').css('overflow','');
			this.wrap.removeClass('mfp-open');
			this.content.addClass('mfp-removing');
		},
		close: function() {
			this.content.removeClass('mfp-removing'); 
		},
		beforeOpen: function() {

			var magnificPopup = this;
			// create settings container
			if ( typeof this.st.dt == 'undefined' ) {
				this.st.dt = {};
			}

			// save share buttons array
			this.st.dt.shareButtonsList = this.ev.attr('data-pretty-share') ? this.ev.attr('data-pretty-share').split(',') : new Array();

			// share buttons template
			this.st.dt.shareButtonsTemplates = {
				twitter : '<a href="//twitter.com/home?status={location_href}%20{share_title}" class="share-button twitter" target="_blank" title="twitter"><svg class="icon" viewBox="0 0 22 22"><path d="M17.614,5.604c-0.556,0.325-1.171,0.56-1.822,0.688c-0.526-0.551-1.271-0.895-2.099-0.895c-1.586,0-2.873,1.268-2.873,2.83c0,0.221,0.025,0.438,0.074,0.645C8.508,8.753,6.393,7.625,4.977,5.913C4.729,6.33,4.588,6.816,4.588,7.336c0,0.982,0.508,1.85,1.276,2.354c-0.47-0.014-0.912-0.141-1.3-0.354c0,0.013,0,0.024,0,0.035c0,1.372,0.991,2.514,2.304,2.775c-0.241,0.062-0.495,0.101-0.756,0.101c-0.186,0-0.365-0.019-0.541-0.054c0.365,1.127,1.427,1.945,2.682,1.97c-0.982,0.756-2.222,1.208-3.567,1.208c-0.232,0-0.461-0.016-0.686-0.04c1.271,0.804,2.78,1.272,4.402,1.272c5.286,0,8.171-4.312,8.171-8.053c0-0.123-0.003-0.246-0.009-0.367c0.563-0.397,1.05-0.895,1.436-1.463c-0.516,0.225-1.068,0.378-1.648,0.446C16.943,6.817,17.398,6.262,17.614,5.604z"/></svg></a>',
				facebook : '<a href="//www.facebook.com/sharer.php?s=100&amp;p[url]={location_href}&amp;p[title]={share_title}&amp;p[images][0]={image_src}" class="share-button facebook" target="_blank" title="facebook"><svg class="icon" viewBox="0 0 22 22" ><path d="M13.537,10.513l-1.74,0.001l0.051,6.648H9.395l0.014-6.648H7.816V8.413l1.592-0.001L9.407,7.177c0-1.713,0.485-2.755,2.593-2.755h1.758v2.101H12.66c-0.824,0-0.863,0.292-0.863,0.84l-0.004,1.049h1.975L13.537,10.513z"/></svg></a>',
				google : '<a href="////plus.google.com/share?url={location_href}&amp;title={share_title}" class="share-button google" target="_blank" title="google+"><svg class="icon" viewBox="0 0 22 22" ><path d="M18.02,9.145h-1.953l0.021,1.958h-1.344l-0.022-1.937l-1.854-0.019l-0.024-1.258l1.896-0.008V5.864h1.343V7.86l1.936,0.042L18.02,9.145L18.02,9.145z M12.254,14.303c0,1.217-1.108,2.698-3.9,2.698c-2.043,0-3.748-0.884-3.748-2.364c0-1.146,0.725-2.625,4.107-2.625c-0.5-0.412-0.625-0.984-0.318-1.604c-1.98,0-2.995-1.166-2.995-2.645c0-1.447,1.076-2.762,3.271-2.762c0.557,0,3.54,0,3.54,0l-0.809,0.823h-0.923C11.13,6.241,11.52,6.97,11.52,7.813c0,0.778-0.427,1.407-1.036,1.874c-1.085,0.838-0.807,1.354,0.312,2.133c1.091,0.845,1.464,1.47,1.464,2.482H12.254z M9.863,7.771C9.712,6.847,8.967,6.09,8.095,6.068c-0.872-0.021-1.457,0.687-1.307,1.61C6.939,8.615,7.726,9.24,8.663,9.24c0.848,0.093,1.305-0.531,1.201-1.458L9.863,7.771z M10.544,14.486c0-0.707-0.78-1.379-2.087-1.379c-1.178-0.015-2.179,0.615-2.179,1.354c0,0.729,0.833,1.354,1.978,1.359c1.56-0.031,2.338-0.553,2.338-1.334H10.544z"/></svg></a>',
				pinterest : '<a href="//pinterest.com/pin/create/button/?url={location_href}&amp;description={share_title}&amp;media={image_src}" class="share-button pinterest" target="_blank" title="pin it"><svg class="icon" viewBox="0 0 22 22"><path d="M7.318,12.361c0.703-1.242-0.227-1.515-0.372-2.415c-0.596-3.68,4.244-6.193,6.779-3.622c1.754,1.781,0.599,7.257-2.229,6.688C8.786,12.467,12.82,8.11,10.66,7.255c-1.757-0.696-2.689,2.126-1.856,3.528c-0.489,2.412-1.541,4.683-1.114,7.708c1.381-1.002,1.847-2.923,2.228-4.923c0.695,0.422,1.065,0.859,1.951,0.929c3.264,0.253,5.089-3.258,4.641-6.5c-0.396-2.872-3.259-4.335-6.313-3.992c-2.415,0.27-4.822,2.222-4.922,5.014C5.212,10.723,5.697,12.002,7.318,12.361z"/></svg></a>',
				linkedin : '<a href="//www.linkedin.com/shareArticle?mini=true&url={location_href}&title={share_title}" class="share-button linkedin" target="_blank" ><svg class="icon" viewBox="0 0 22 22"><path d="M9.269 7.02c0 0.714-0.586 1.293-1.307 1.293c-0.722 0-1.307-0.579-1.307-1.293 c0-0.712 0.585-1.291 1.307-1.291C8.683 5.7 9.3 6.3 9.3 7.02H9.269z M9.061 9.279H6.873v7.392h2.188V9.279z M12.91 9.3 h-1.795l-0.027 7.392h2.044c0 0 0-2.742 0-3.879c0-1.04 0.775-1.79 1.7-1.665c0.824 0.1 1.1 0.6 1.1 1.7 c0 1.028-0.021 3.915-0.021 3.89h2.025c0 0 0.025-2.729 0.025-4.708c0-1.981-1.006-2.78-2.604-2.78 c-1.599 0-2.248 1.096-2.248 1.096v-1H12.91z"/></svg></a>'
			};

			// share buttons
			this.st.dt.getShareButtons = function ( itemData ) {

				var shareButtons = magnificPopup.st.dt.shareButtonsList,
					pinterestIndex = -1,
					shareButtonsLemgth = shareButtons.length,
					html = '';

				for( var i = 0; i < shareButtons.length; i++ ) {

					if ( 'pinterest' == shareButtons[i] ) {
						pinterestIndex = i;
						break;
					}
				}

				if ( shareButtonsLemgth <= 0 ) {
					return '';
				}

				for ( var i = 0; i < shareButtonsLemgth; i++ ) {

					// exclude pinterest button for iframes
					if ( 'iframe' == itemData['type'] && pinterestIndex == i ) {
						continue;
					}

					var	itemTitle = itemData['title'],
						itemSrc = itemData['src'],
						itemLocation = itemData['location'];

					if ( 'google' == shareButtons[i] ) {
						itemTitle = itemTitle.replace(' ', '+');
					}

					html += magnificPopup.st.dt.shareButtonsTemplates[ shareButtons[i] ].replace('{location_href}', encodeURIComponent(itemLocation)).replace('{share_title}', encodeURIComponent(itemTitle)).replace('{image_src}', encodeURIComponent(itemSrc));
				}

				return '<div class="entry-share"><div class="soc-ico">' + html + '<div></div>';
			}

			// item title
			this.st.dt.getItemTitle = function(item) {
				var imgTitle = item.el.attr('title') || '',
					imgSrc = item.el.attr('href'),
					imgDesc = item.el.attr('data-dt-img-description') || '',
					imgLocation = item.el.attr('data-dt-location') || location.href,
					shareButtons = magnificPopup.st.dt.getShareButtons( { 'title': imgDesc, 'src': imgSrc, 'type': item.type, 'location': imgLocation } );

				return imgTitle + '<small>' + imgDesc + '</small>' + shareButtons;
			}
		}
	}
	};

	// trigger click on first anchor in the gallery container
	// work only for posts list
	$('.dt-gallery-mfp-popup').addClass('mfp-ready').on('click', function(){
		var $this = $(this),
			$container = $this.parents('article.post');
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
		if ( $container.length > 0 ) {
			var $target = $container.find('.dt-gallery-container a.dt-mfp-item');

			if ( $target.length > 0 ) {
				$target.first().trigger('click');
			}
		};

		return false;
	});

	// trigger click on first a.dt-mfp-item in the container
	$('.dt-trigger-first-mfp').addClass('mfp-ready').on('click', function(){
		var $this = $(this),
			$container = $this.parents('article.post');
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

		if ( $container.length > 0 ) {
			var $target = $container.find('a.dt-mfp-item');

			if ( $target.length > 0 ) {
				$target.first().trigger('click');
			}
		};

		return false;
		});

		// single opup
		$('.dt-single-image').addClass('mfp-ready').magnificPopup({
		type: 'image'
		});

		$('.dt-single-video').addClass('mfp-ready').magnificPopup({
		type: 'iframe'
		});
		$('.dt-single-mfp-popup').on("click", function(e){
		var $this = $(this);
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) {
			e.preventDefault();
			e.stopImmediatePropagation();
		};
		if($this.parents(".photo-scroller").length > 0){
			var parScroller = $this.parents(".photo-scroller"),
			parAutoPlay = parScroller.find(".auto-play-btn");

			if( parAutoPlay.hasClass("paused") ){
				parScroller.addClass("mfp-opened");
				parScroller.find(".auto-play-btn.paused").trigger("click");
			};
		};
		if($this.parents(".slider-wrapper").length > 0){
			var parScrollerShor = $this.parents(".slider-wrapper"),
				parAutoPlayShor = parScrollerShor.find(".auto-play-btn");

			if( parAutoPlayShor.hasClass("paused") ){
				parScrollerShor.addClass("mfp-opened");
				parScrollerShor.find(".auto-play-btn.paused").trigger("click");
			};
		}

	});

	$('.dt-single-mfp-popup').addClass('mfp-ready').magnificPopup($.extend( true, dtGlobals.magnificPopupBaseConfig, {
		callbacks: {
			close: function() {
				$(".photo-scroller.mfp-opened").find(".auto-play-btn").trigger("click");
				$(".photo-scroller").removeClass("mfp-opened");
				$(".slider-wrapper.mfp-opened").find(".auto-play-btn").trigger("click");
				$(".slider-wrapper").removeClass("mfp-opened");
			}
		}
		}));


		$(".dt-gallery-container").each(function(){
		if($(this).parents(".slider-wrapper").length > 0){
			var $this = $(this).parents(".slider-wrapper");
		}else{
			var $this = $(this);
		}
		var $thisPlay = $this.find(".auto-play-btn");
		$(this).addClass('mfp-ready').magnificPopup( $.extend( true, dtGlobals.magnificPopupBaseConfig, {
			delegate: 'a.dt-mfp-item',
			tLoading: 'Loading image #%curr%...',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			callbacks: {
				open: function() {
					var stopAutoPlay = ( 'true' === $this.attr("data-autoslide") ) ? true : false;
					if(stopAutoPlay){
						if( $thisPlay.hasClass("paused") ){
							$this.addClass("mfp-opened");
							$this.find(".auto-play-btn.paused").trigger("click");
						};
					}
				},
				close: function() {
					if( $this.hasClass("mfp-opened") ){
						$this.find(".auto-play-btn").trigger("click");
						$this.removeClass("mfp-opened");
					}
				}
			}

		} ) );
	});
})
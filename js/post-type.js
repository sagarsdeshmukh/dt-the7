
/*3D slideshow*/
jQuery(document).ready(function($){
	 
	$.fn.exists = function() {
		if ($(this).length > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* !- Check if element is loaded */
	$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len	= this.length;
		if (len > 0) {
			return this.each(function() {
				var	el		= this,
					$el		= $(el),
					blank	= "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};
	
	var $body = $("body"),
        $window = $(window),
		$mainSlider = $('#main-slideshow'),
		$3DSlider = $('.three-d-slider'),
		adminH = $('#wpadminbar').height(),
		header = $('.masthead:not(.side-header):not(.side-header-v-stroke)').height();
		
	if($body.hasClass("transparent")){
		var headerH = 0;
	}else if($body.hasClass("overlap")){
		var headerH = ($('.masthead:not(.side-header):not(.side-header-v-stroke)').height() + (parseInt($mainSlider.css("marginTop")) + parseInt($mainSlider.css("marginBottom")) ));
	}else{
		var headerH = $('.masthead:not(.side-header):not(.side-header-v-stroke)').height();
	}
	
   
 

/*!
 *
 * jQuery collagePlus Plugin v0.3.2
 * https://github.com/ed-lea/jquery-collagePlus
 *
 * Copyright 2012, Ed Lea twitter.com/ed_lea
 *
 * built for http://qiip.me
 *
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 *
 *
 * Heavily modified by Dream-Theme.com
 */





    $.fn.collagePlus = function( options ) {

        var defaults = {
            // the ideal height you want your images to be
            'targetHeight'          : 400,
            // width of the area the collage will be in
            'albumWidth'            : this.width(),
            // padding between the images
            'padding'               : parseFloat( this.css('padding-left') ),
            // object that contains the images to collage
            'images'                : this.children(),
            // how quickly you want images to fade in once ready can be in ms, "slow" or "fast"
            'fadeSpeed'             : "fast",
            // how the resized block should be displayed. inline-block by default so that it doesn't break the row
            'display'               : "inline-block",
            // which effect you want to use for revealing the images (note CSS3 browsers only),
            'effect'                : 'default',
            // effect delays can either be applied per row to give the impression of descending appearance
            // or horizontally, so more like a flock of birds changing direction
            'direction'             : 'vertical',
            // Sometimes there is just one image on the last row and it gets blown up to a huge size to fit the
            // parent div width. To stop this behaviour, set this to true
            'allowPartialLastRow'   : false
        };

        var settings = $.extend({}, defaults, options);

        return this.each(function() {

            /*
             *
             * set up vars
             *
             */

                // track row width by adding images, padding and css borders etc
            var row         = 0,
                // collect elements to be re-sized in current row
                elements    = [],
                // track the number of rows generated
                rownum = 1;


            settings.images.each(
                function(index){
                    /*
                     *
                     * Cache selector
                     * Even if first child is not an image the whole sizing is based on images
                     * so where we take measurements, we take them on the images
                     *
                     */
                    var $this = $(this),
                        $img  = ($this.is("img")) ? $this : $(this).find("img").not(".blur-effect").first();

                    /*
                     *
                     * get the current image size. Get image size in this order
                     *
                     * 1. from <img> tag
                     * 2. from data set from initial calculation
                     * 3. after loading the image and checking it's actual size
                     *
                     */
                    if ($img.attr("width") != 'undefined' && $img.attr("height") != 'undefined') {
                        var w = (typeof $img.data("width") != 'undefined') ? $img.data("width") : $img.attr("width"),
                            h = (typeof $img.data("height") != 'undefined') ? $img.data("height") : $img.attr("height");
                        
                    }
                    else {
                        var w = (typeof $img.data("width") != 'undefined') ? $img.data("width") : $img.width(),
                            h = (typeof $img.data("height") != 'undefined') ? $img.data("height") : $img.height();
                    }



                    /*
                     *
                     * Get any current additional properties that may affect the width or height
                     * like css borders for example
                     *
                     */
                    var imgParams = getImgProperty($img);


                    /*
                     *
                     * store the original size for resize events
                     *
                     */
                    $img.data("width", w);
                    $img.data("height", h);



                    /*
                     *
                     * calculate the w/h based on target height
                     * this is our ideal size, but later we'll resize to make it fit
                     *
                     */
                    var nw = Math.ceil(w/h*settings.targetHeight),
                        nh = Math.ceil(settings.targetHeight);

                    /*
                     *
                     * Keep track of which images are in our row so far
                     *
                     */
                    elements.push([this, nw, nh, imgParams['w'], imgParams['h']]);

                    /*
                     *
                     * calculate the width of the element including extra properties
                     * like css borders
                     *
                     */
                    row += nw + imgParams['w'] + settings.padding;

                    /*
                     *
                     * if the current row width is wider than the parent container
                     * it's time to make a row out of our images
                     *
                     */
                    if( row > settings.albumWidth && elements.length != 0 ){

                        // call the method that calculates the final image sizes
                        // remove one set of padding as it's not needed for the last image in the row
                        resizeRow(elements, row, settings, rownum);

                        // reset our row
                        delete row;
                        delete elements;
                        row         = 0;
                        elements    = [];
                        rownum      += 1;
                    }


                    /*
                     *
                     * if the images left are not enough to make a row
                     * then we'll force them to make one anyway
                     *
                     */
                    if ( settings.images.length-1 == index && elements.length != 0){
                        resizeRow(elements, row, settings, rownum);

                        // reset our row
                        delete row;
                        delete elements;
                        row         = 0;
                        elements    = [];
                        rownum      += 1;
                    }
                }
            );

            // trigger "jgDone" event when all is ready
            $(this).trigger("jgDone");
        });

        function resizeRow(obj, row, settings, rownum) {
            /*
             *
             * How much bigger is this row than the available space?
             * At this point we have adjusted the images height to fit our target height
             * so the image size will already be different from the original.
             * The resizing we're doing here is to adjust it to the album width.
             *
             * We also need to change the album width (basically available space) by
             * the amount of padding and css borders for the images otherwise
             * this will skew the result.
             *
             * This is because padding and borders remain at a fixed size and we only
             * need to scale the images.
             *
             */
            var imageExtras         = (settings.padding * obj.length) + (obj.length * obj[0][3]),
                albumWidthAdjusted  = settings.albumWidth - imageExtras,
                overPercent         = albumWidthAdjusted / (row - imageExtras),
                // start tracking our width with know values that will make up the total width
                // like borders and padding
                trackWidth          = imageExtras,
                // guess whether this is the last row in a set by checking if the width is less
                // than the parent width.
                lastRow             = (row < settings.albumWidth  ? true : false);



            /*
             * Resize the images by the above % so that they'll fit in the album space
             */
            for (var i = 0; i < obj.length; i++) {



                var $obj        = $(obj[i][0]),
                    fw          = Math.floor(obj[i][1] * overPercent),
                    fh          = Math.floor(obj[i][2] * overPercent),
                // if the element is the last in the row,
                // don't apply right hand padding (this is our flag for later)
                    isNotLast   = !!(( i < obj.length - 1 ));

                /*
                 * Checking if the user wants to not stretch the images of the last row to fit the
                 * parent element size
                 */
                if(settings.allowPartialLastRow === true && lastRow === true){
                     fw = obj[i][1];
                     fh = obj[i][2];
                }


                /*
                 *
                 * Because we use % to calculate the widths, it's possible that they are
                 * a few pixels out in which case we need to track this and adjust the
                 * last image accordingly
                 *
                 */
                trackWidth += fw;


                /*
                 *
                 * here we check if the combined images are exactly the width
                 * of the parent. If not then we add a few pixels on to make
                 * up the difference.
                 *
                 * This will alter the aspect ratio of the image slightly, but
                 * by a noticable amount.
                 *
                 * If the user doesn't want full width last row, we check for that here
                 *
                 */
    /*
                if(!isNotLast && trackWidth < settings.albumWidth){
                    if(settings.allowPartialLastRow === true && lastRow === true){
                        fw = fw;
                    }else{
                        fw = fw + (settings.albumWidth - trackWidth);
                    }
                }
    */

                /*
                 *
                 * We'll be doing a few things to the image so here we cache the image selector
                 *
                 *
                 */
                var $img = ( $obj.is("img") ) ? $obj : $obj.find("img").not(".blur-effect").first();

                /*
                 *
                 * Set the width of the image and parent element
                 * if the resized element is not an image, we apply it to the child image also
                 *
                 * We need to check if it's an image as the css borders are only measured on
                 * images. If the parent is a div, we need make the contained image smaller
                 * to accommodate the css image borders.
                 *
                 */
                $img.width(fw);
                if( !$obj.is("img") ){
                    $obj.width(fw + obj[i][3]);
                }


                /*
                 *
                 * Set the height of the image
                 * if the resized element is not an image, we apply it to the child image also
                 *
                 */
                $img.height(fh);
                if( !$obj.is("img") ){
                    $obj.height(fh + obj[i][4]);
                }


                /*
                 *
                 * Apply the css extras like padding
                 *
                 */
                if (settings.allowPartialLastRow === false &&  lastRow === true) {
                    applyModifications($obj, isNotLast, "none");
                }
                else {
                    applyModifications($obj, isNotLast, settings.display);
                };


                /*
                 *
                 * Assign the effect to show the image
                 * Default effect is using jquery and not CSS3 to support more browsers
                 * Wait until the image is loaded to do this
                 *
                 */
    /*
                $img
                    .load(function(target) {
                    return function(){
                        if( settings.effect == 'default'){
                            target.animate({opacity: '1'},{duration: settings.fadeSpeed});
                        } else {
                            if(settings.direction == 'vertical'){
                                var sequence = (rownum <= 10  ? rownum : 10);
                            } else {
                                var sequence = (i <= 9  ? i+1 : 10);
                            }

                            target.addClass(settings.effect);
                            target.addClass("effect-duration-" + sequence);
                        }
                    }
                    }($obj))
    */
                    /*
                     * fix for cached or loaded images
                     * For example if images are loaded in a "window.load" call we need to trigger
                     * the load call again
                     */
    /*
                    .each(function() {
                            if(this.complete) $(this).trigger('load');
                    });
    */

            }
        }

        /*
         *
         * This private function applies the required css to space the image gallery
         * It applies it to the parent element so if an image is wrapped in a <div> then
         * the css is applied to the <div>
         *
         */
        function applyModifications($obj, isNotLast, settingsDisplay) {
            var css = {
    /*
                    // Applying padding to element for the grid gap effect
                    'margin-bottom'     : settings.padding + "px",
                    'margin-right'      : (isNotLast) ? settings.padding + "px" : "0px",
    */
                    // Set it to an inline-block by default so that it doesn't break the row
                    'display'           : settingsDisplay,
                    // Set vertical alignment otherwise you get 4px extra padding
                    'vertical-align'    : "bottom",
                    // Hide the overflow to hide the caption
                    'overflow'          : "hidden"
                };

            return $obj.css(css);
        }


        /*
         *
         * This private function calculates any extras like padding, border associated
         * with the image that will impact on the width calculations
         *
         */
        function getImgProperty(img) {
            $img = $(img);
            var params =  new Array();
            params["w"] = (parseFloat($img.css("border-left-width")) + parseFloat($img.css("border-right-width")));
            params["h"] = (parseFloat($img.css("border-top-width")) + parseFloat($img.css("border-bottom-width")));
            return params;
        }

    };


/* !- Justified Gallery Initialisation */


    var jgCounter = 0;
    $(".jg-container").each(function() {
        jgCounter++;
        var $jgContainer = $(this),
            $jgItemsPadding = $jgContainer.attr("data-padding"),
            $jgItems = $jgContainer.find(".wf-cell");
        // .iso-item elements are hidden by default, so we show them.

        $jgContainer.attr("id", "jg-container-" + jgCounter + "");

        $("<style type='text/css'>" + ' .content #jg-container-' + jgCounter + ' .wf-cell'  + '{padding:'  + $jgItemsPadding + ';}' + ' .content #jg-container-' + jgCounter + '.wf-container'  + '{'+ 'margin:'  + '-'+ $jgItemsPadding + ';}' + ' .content .full-width-wrap #jg-container-' + jgCounter + '.wf-container'  + '{'+ 'margin-left:'  + $jgItemsPadding + '; '+ 'margin-right:'  + $jgItemsPadding + '; '+ 'margin-top:' + '-' + $jgItemsPadding + '; '+ 'margin-bottom:' + '-' + $jgItemsPadding + ';}' +"</style>").insertAfter($jgContainer);

        $jgContainer.on("jgDone", function() {
            // var layzrJGrid = new Layzr({
            // //   container: ".jg-container",
            //  selector: '[data-layzr-jgrid]',
            //  attr: 'data-layzr-jgrid',
            //  retinaAttr: 'data-layzr-jgrid-retina',
            //  threshold: 0,
            //  callback: function() {
            //      $(this).velocity({
            //          "opacity" : 1
            //      }, 350);
            //  }
            // });
            var layzrJGrid = new Layzr({
                selector: '.jgrid-lazy-load',
                attr: 'data-src',
                attrSrcSet: 'data-srcset',
                retinaAttr: 'data-src-retina',
                threshold: 0,
                before: function() {

                    // For fixed-size images with srcset; or have to be updated on window resize.
                    this.setAttribute("sizes", this.width+"px");
                },
                callback: function() {

                    this.classList.add("jgrid-layzr-loaded");
                    var $this =  $(this);
                    $this.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
                        setTimeout(function(){
                            $this.parent().removeClass("layzr-bg");
                        }, 200)
                    });
                }
            });
        });
    });

    $.fn.collage = function(args) {
        return this.each(function() {
            var $this = $(this);
            var $jgContainer = $(this),
                $jgItemsPadding = $jgContainer.attr("data-padding"),
                $jgItems = $jgContainer.find(".wf-cell");
            var jgPadding = parseFloat($jgItems.first().css('padding-left')) + parseFloat($jgItems.first().css('padding-right')),
                jgTargetHeight = parseInt($jgContainer.attr("data-target-height")),
                jdPartRow = true;

            if ($jgContainer.attr("data-part-row") == "false") {
                jdPartRow = false;
            };


            if($jgContainer.parent(".full-width-wrap").length){
                var jgAlbumWidth = $jgContainer.parents(".full-width-wrap").width() - parseInt($jgItemsPadding)*2;
            }else{
                var jgAlbumWidth = $jgContainer.parent().width() + parseInt($jgItemsPadding)*2;
            }
            
            var $jgCont = {
                'albumWidth'            : jgAlbumWidth,
                'targetHeight'          : jgTargetHeight,
                'padding'               : jgPadding,
                'allowPartialLastRow'   : jdPartRow,
                'fadeSpeed'             : 2000,
                'effect'                : 'effect-1',
                'direction'             : 'vertical'
            };
            $.extend($jgCont, args);

            dtGlobals.jGrid = $jgCont;
            $jgContainer.collagePlus($jgCont);
            $jgContainer.css({
                'width': jgAlbumWidth
            });
        });
    };
    $(window).on("debouncedresize", function() {
        $(".jg-container").not('.jgrid-shortcode').collage();
        $(".jgrid-shortcode").each(function() {
            var $this = $(this);
            var $visibleItems = $this.data('visibleItems');
            if ( $visibleItems ) {
                $this.collage({ 'images': $visibleItems });
            } else {
                $this.collage();
            }
        });
    }).trigger( "debouncedresize" );


/**
 * jquery.hoverdir.js v1.1.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2012, Codrops
 * http://www.codrops.com
 */

    
    'use strict';

    $.HoverDir = function( options, element ) {
        
        this.$el = $( element );
        this._init( options );

    };

    // the options
    $.HoverDir.defaults = {
        speed : 300,
        easing : 'ease',
        hoverDelay : 0,
        inverse : false
    };

    $.HoverDir.prototype = {

        _init : function( options ) {
            
            // options
            this.options = $.extend( true, {}, $.HoverDir.defaults, options );
            // transition properties
            this.transitionProp = 'all ' + this.options.speed + 'ms ' + this.options.easing;
            // support for CSS transitions
            this.support = Modernizr.csstransitions;
            // load the events
            this._loadEvents();

        },
        
        _loadEvents : function() {

            var self = this;
            
            this.$el.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {
                
                var $el = $( this ),
                    $hoverElem = $el.find( '.rollover-content' ),
                    direction = self._getDir( $el, { x : event.pageX, y : event.pageY } ),
                    styleCSS = self._getStyle( direction );
                
                if( event.type === 'mouseenter' ) {
                    
                    $hoverElem.hide().css( styleCSS.from );
                    clearTimeout( self.tmhover );

                    self.tmhover = setTimeout( function() {
                        
                        $hoverElem.show( 0, function() {
                            
                            var $el = $( this );
                            if( self.support ) {
                                $el.css( 'transition', self.transitionProp );
                            }
                            self._applyAnimation( $el, styleCSS.to, self.options.speed );

                        } );
                        
                    
                    }, self.options.hoverDelay );
                    
                }
                else {
                
                    if( self.support ) {
                        $hoverElem.css( 'transition', self.transitionProp );
                    }
                    clearTimeout( self.tmhover );
                    self._applyAnimation( $hoverElem, styleCSS.from, self.options.speed );
                    
                }
                    
            } );

        },
        // credits : http://stackoverflow.com/a/3647634
        _getDir : function( $el, coordinates ) {
            
            // the width and height of the current div
            var w = $el.width(),
                h = $el.height(),

                // calculate the x and y to get an angle to the center of the div from that x and y.
                // gets the x value relative to the center of the DIV and "normalize" it
                x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
                y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
            
                // the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);
                // first calculate the angle of the point,
                // add 180 deg to get rid of the negative values
                // divide by 90 to get the quadrant
                // add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
                direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;
            
            return direction;
            
        },
        _getStyle : function( direction ) {
            
            var fromStyle, toStyle,
                slideFromTop = { left : '0px', top : '-100%' },
                slideFromBottom = { left : '0px', top : '100%' },
                slideFromLeft = { left : '-100%', top : '0px' },
                slideFromRight = { left : '100%', top : '0px' },
                slideTop = { top : '0px' },
                slideLeft = { left : '0px' };
            
            switch( direction ) {
                case 0:
                    // from top
                    fromStyle = !this.options.inverse ? slideFromTop : slideFromBottom;
                    toStyle = slideTop;
                    break;
                case 1:
                    // from right
                    fromStyle = !this.options.inverse ? slideFromRight : slideFromLeft;
                    toStyle = slideLeft;
                    break;
                case 2:
                    // from bottom
                    fromStyle = !this.options.inverse ? slideFromBottom : slideFromTop;
                    toStyle = slideTop;
                    break;
                case 3:
                    // from left
                    fromStyle = !this.options.inverse ? slideFromLeft : slideFromRight;
                    toStyle = slideLeft;
                    break;
            };
            
            return { from : fromStyle, to : toStyle };
                    
        },
        // apply a transition or fallback to jquery animate based on Modernizr.csstransitions support
        _applyAnimation : function( el, styleCSS, speed ) {

            $.fn.applyStyle = this.support ? $.fn.css : $.fn.animate;
            el.stop().applyStyle( styleCSS, $.extend( true, [], { duration : speed + 'ms' } ) );

        },

    };
    
    var logError = function( message ) {

        if ( window.console ) {

            window.console.error( message );
        
        }

    };
    
    $.fn.hoverdir = function( options ) {

        var instance = $.data( this, 'hoverdir' );
        
        if ( typeof options === 'string' ) {
            
            var args = Array.prototype.slice.call( arguments, 1 );
            
            this.each(function() {
            
                if ( !instance ) {

                    logError( "cannot call methods on hoverdir prior to initialization; " +
                    "attempted to call method '" + options + "'" );
                    return;
                
                }
                
                if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {

                    logError( "no such method '" + options + "' for hoverdir instance" );
                    return;
                
                }
                
                instance[ options ].apply( instance, args );
            
            });
        
        } 
        else {
        
            this.each(function() {
                
                if ( instance ) {

                    instance._init();
                
                }
                else {

                    instance = $.data( this, 'hoverdir', new $.HoverDir( options, this ) );
                
                }

            });
        
        }
        
        return instance;
        
    };
    

    /*!-Hover Direction aware init*/
    $('.mobile-false .hover-grid .rollover-project').each( function() { $(this).hoverdir(); } );
    $('.mobile-false .hover-grid-reverse .rollover-project ').each( function() { $(this).hoverdir({
        inverse : true
    }); } );

    /*!Append tag </span> for portfolio round links button*/
    $.fn.hoverLinks = function() {
        if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
            return this.each(function() {
                var $img = $(this);
                if ($img.hasClass("height-ready")) {
                    return;
                }
                $("<span/>").appendTo($(this));

                $img.on({
                    mouseenter: function () {
                        if (0 === $(this).children("span").length) {
                            var a = $("<span/>").appendTo($(this));
                            setTimeout(function () {
                                a.addClass("icon-hover")
                            }, 20)
                        } else $(this).children("span").addClass("icon-hover")
                    },
                    mouseleave: function () {
                        $(this).children("span").removeClass("icon-hover")
                    }
                });

                $img.addClass("height-ready");
            });
        }
    };
    $(".links-container a").hoverLinks();
    /*!Trigger click (direct to post) */
    $.fn.forwardToPost = function() {
        return this.each(function() {
            var $this = $(this);
            if ($this.hasClass("this-ready")) {
                return;
            };
            $this.on("click", function(){
                if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
                window.location.href = $this.find("a").first().attr("href");
                return false;
            });
            $this.addClass("this-ready");
        });
    };
    $(".mobile-false .rollover-project.forward-post").forwardToPost();

    $.fn.touchforwardToPost = function() {
        return this.each(function() {
            var $this = $(this);
            if ($this.hasClass("touch-hover-ready")) {
                return;
            }

            $body.on("touchend", function(e) {
                $(".mobile-true .rollover-content").removeClass("is-clicked");
                $(".mobile-true .rollover-project").removeClass("is-clicked");
            });
            var $this = $(this).find(".rollover-content");
            $this.on("touchstart", function(e) { 
                origY = e.originalEvent.touches[0].pageY;
                origX = e.originalEvent.touches[0].pageX;
            });
            $this.on("touchend", function(e) {
                var touchEX = e.originalEvent.changedTouches[0].pageX,
                    touchEY = e.originalEvent.changedTouches[0].pageY;
                if( origY == touchEY || origX == touchEX ){
                    if ($this.hasClass("is-clicked")) {
                            window.location.href = $this.prev("a").first().attr("href");
                    } else {
                        e.preventDefault();
                        $(".mobile-ture .rollover-content").removeClass("is-clicked");
                        $(".mobile-true .rollover-project").removeClass("is-clicked");
                        $this.addClass("is-clicked");
                        $this.parent(".rollover-project").addClass("is-clicked");
                        return false;
                    };
                };
            });

            $this.addClass("touch-hover-ready");
        });
    };
    $(".mobile-true .rollover-project.forward-post").touchforwardToPost();

    /*!Trigger click on portfolio hover buttons */
    $.fn.followCurentLink = function() {
        return this.each(function() {
            var $this = $(this);
            if ($this.hasClass("this-ready")) {
                return;
            }

            var $thisSingleLink = $this.find(".links-container > a"),
                $thisCategory = $this.find(".portfolio-categories a");
                
            $this.on("click", function(){

                $thisSingleLink.each(function(){
                    $thisTarget = $(this).attr("target") ? $(this).attr("target") : "_self";
                });

                if($thisSingleLink.hasClass("project-details") || $thisSingleLink.hasClass("link") || $thisSingleLink.hasClass("project-link")){
                    window.open($thisSingleLink.attr("href"), $thisTarget);
                    return false;

                }else{
                    $thisSingleLink.trigger("click");
                    return false;
                }
            });

            $this.find($thisCategory).click(function(e) {
                 e.stopPropagation();
                window.location.href = $thisCategory.attr('href');
            });
            $this.addClass("this-ready");
        });
    };
    $(".mobile-false .rollover-project.rollover-active, .mobile-false .buttons-on-img.rollover-active").followCurentLink();

    $.fn.touchHoverImage = function() {
        return this.each(function() {
            var $img = $(this);
            if ($img.hasClass("hover-ready")) {
                return;
            }

            $body.on("touchend", function(e) {
                $(".mobile-true .rollover-content").removeClass("is-clicked");
            });
            var $this = $(this).find(".rollover-content"),
                thisPar = $this.parents(".wf-cell");
            $this.on("touchstart", function(e) { 
                origY = e.originalEvent.touches[0].pageY;
                origX = e.originalEvent.touches[0].pageX;
            });
            $this.on("touchend", function(e) {
                var touchEX = e.originalEvent.changedTouches[0].pageX,
                    touchEY = e.originalEvent.changedTouches[0].pageY;
                if( origY == touchEY || origX == touchEX ){
                    if ($this.hasClass("is-clicked")) {
                    } else {

                        $('.links-container > a', $this).on('touchend', function(e) {
                            e.stopPropagation();
                            $this.addClass("is-clicked");
                        });
                        e.preventDefault();
                        $(".mobile-true .buttons-on-img .rollover-content").removeClass("is-clicked");
                        $this.addClass("is-clicked");
                        return false;
                    };
                };
            });

            $img.addClass("hover-ready");
        });
    };
    $(".mobile-true .buttons-on-img").touchHoverImage();

    $.fn.touchScrollerImage = function() {
        return this.each(function() {
            var $img = $(this);
            if ($img.hasClass("hover-ready")) {
                return;
            }

            $body.on("touchend", function(e) {
                $(".mobile-true .project-list-media").removeClass("is-clicked");
            });
            var $this = $(this),
                $thisSingleLink = $this.find("a.rollover-click-target").first(),
                $thisButtonLink = $this.find(".links-container");
            $this.on("touchstart", function(e) { 
                origY = e.originalEvent.touches[0].pageY;
                origX = e.originalEvent.touches[0].pageX;
            });
            $this.on("touchend", function(e) {
                var touchEX = e.originalEvent.changedTouches[0].pageX,
                    touchEY = e.originalEvent.changedTouches[0].pageY;
                if( origY == touchEY || origX == touchEX ){
                    if ($this.hasClass("is-clicked")) {
                            
                    } else {
                        if($thisSingleLink.length > 0){
                            $thisSingleLink.on("click", function(event) {
                                event.stopPropagation();

                                if ( $(this).hasClass('go-to') ) {
                                    window.location.href = $(this).attr('href');
                                }
                            });
                            $thisSingleLink.trigger("click");
                        };
                        if($thisButtonLink.length > 0){
                            $thisButtonLink.find(" > a ").each(function(){
                                $(this).on("touchend", function(event) {
                                    event.stopPropagation();
                                    $(this).trigger("click");
                                });
                            });
                        }
                        e.preventDefault();
                        $(".mobile-true .fs-entry").removeClass("is-clicked");
                        $this.addClass("is-clicked");
                        return false;
                    };
                };
            });

            $img.addClass("hover-ready");
        });
    };
    $(".mobile-true .project-list-media").touchScrollerImage();

    $.fn.touchHoverLinks = function() {
        return this.each(function() {
            var $img = $(this);
            if ($img.hasClass("hover-ready")) {
                return;
            }

            var $this = $(this);
            $this.on("touchend", function(e) {
                if ($this.hasClass("is-clicked")) {
                    return;
                } else {

                    if( $this.hasClass("project-zoom") ) {
                        $this.trigger("click");
                    }else {
                        window.location.href = $this.attr("href");
                        return false;
                    };

                    $(".mobile-true .links-container > a").removeClass("is-clicked");
                    $this.addClass("is-clicked");
                    return false;
                };
            });

            $img.addClass("hover-ready");
        });
    };
    $(".mobile-true .fs-entry .links-container > a").touchHoverLinks();

    /*!Trigger albums click */
    $.fn.triggerAlbumsClick = function() {
        return this.each(function() {
            var $this = $(this);
            if ($this.hasClass("this-ready")) {
                return;
            }

            var $thisSingleLink = $this.find("a.rollover-click-target, .dt-mfp-item").first(),
                $thisCategory = $this.find(".portfolio-categories a");

            if( $thisSingleLink.length > 0 ){
                $thisSingleLink.on("click", function(event) {
                    event.stopPropagation();

                    if ( $(this).hasClass('go-to') ) {
                        window.location.href = $(this).attr('href');
                    }
                });

                var alreadyTriggered = false;

                $this.on("click", function(){

                    if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

                    if ( !alreadyTriggered ) {
                        alreadyTriggered = true;
                        $thisSingleLink.trigger("click");
                        
                        alreadyTriggered = false;
                    }
                    return false;
                })
                $this.find($thisCategory).click(function(e) {
                     e.stopPropagation();
                    window.location.href = $thisCategory.attr('href');
                });
            }
            $this.addClass("this-ready");
        });
    };
    $(".dt-albums-template .rollover-project, .dt-albums-shortcode .rollover-project, .dt-albums-template .buttons-on-img, .dt-albums-shortcode .buttons-on-img, .archive .type-dt_gallery .buttons-on-img").triggerAlbumsClick();

        /*!Trigger rollover click*/
    
    $.fn.triggerHoverClick = function() {
        return this.each(function() {
            var $this = $(this);
            if ($this.hasClass("click-ready")) {
                return;
            }

            var $thisSingleLink = $this.prev("a:not(.dt-single-mfp-popup):not(.dt-mfp-item)").first(),
                $thisCategory = $this.find(".portfolio-categories a"),
                $thisLink = $this.find(".project-link"),
                $thisTarget = $thisLink.attr("target") ? $thisLink.attr("target") : "_self",
                $targetClick;
                

            if( $thisSingleLink.length > 0 ){
            

                var alreadyTriggered = false;

                $this.on("click", function(e){

                    if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

                    if($(".semitransparent-portfolio-icons").length > 0 || $(".accent-portfolio-icons").length > 0){
                        $targetClick = $(e.target).parent();
                    }else{
                        $targetClick = $(e.target);
                    }
                    if($targetClick.hasClass("project-zoom")){

                        //console.log(( "clicked: " + $(e.target).parent().attr("class") )
                        $(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-single-mfp-popup, .dt-mfp-item").first().trigger('click');
                    }else{
                        if ( !alreadyTriggered ) {
                            alreadyTriggered = true;
                            $thisSingleLink.trigger("click");
                            window.location.href = $thisSingleLink.attr('href');
                            
                            alreadyTriggered = false;
                        }
                    }
                    return false;
                })
                $this.find($thisLink).click(function(e) {
                     e.stopPropagation();
                     e.preventDefault();
                    window.open($thisLink.attr("href"), $thisTarget);
                });

                $this.find($thisCategory).click(function(e) {
                     e.stopPropagation();
                    window.location.href = $thisCategory.attr('href');
                });
            }
            $this.addClass("click-ready");
        });
    };
    $(".mobile-false .rollover-project:not(.rollover-active) .rollover-content, .buttons-on-img:not(.rollover-active) .rollover-content").triggerHoverClick();

    /* !-Smart benefits & logos resize */
        $.fn.smartGrid = function() {
            return this.each(function() {
                var $this = $(this),
                    colNum = parseInt($this.attr("data-columns")),
                    colMinWidth = parseInt($this.attr("data-width")),
                    contWidth = $this.width();

                for ( ; Math.floor(contWidth/colNum) < colMinWidth; ) {
                    colNum--;
                    if (colNum <= 1) break;
                }

                $("> .wf-cell", $this).css({
                    width: (100/colNum).toFixed(6) + "%",
                    display: "inline-block"
                });
            });
        };

        var $benLogColl = $(".benefits-grid, .logos-grid");
        $benLogColl.smartGrid();
        $window.on("debouncedresize", function () {
            $benLogColl.smartGrid();
        });

    /*!Instagram style photos*/

    $.fn.calcPics = function() {
            var $collection = $(".instagram-photos");
            if ($collection.length < 1) return false;

            return this.each(function() {
                var maxitemwidth = maxitemwidth ? maxitemwidth : parseInt($(this).attr("data-image-max-width")),
                    itemmarg = parseInt($(this).find("> a").css("margin-left"));
                $(this).find(" > a").css({
                    "max-width": maxitemwidth,
                    "opacity": 1
                });

                // Cahce everything
                var $container = $(this),
                    containerwidth = $container.width(),
                    itemperc = (100/(Math.ceil(containerwidth/maxitemwidth)));
            
                $container.find("a").css({ "width": itemperc+'%' });
        });
    };
    $(".instagram-photos").calcPics();

    //     /*!-Project floating content*/
    // var $floatContent = $(".floating-content"),
    //     projectPost = $(".project-post");
    // var $parentHeight,
    //     $floatContentHeight,
    //     phantomHeight = 0;

    //var $scrollHeight;

    // function setFloatinProjectContent() {
    //     $(".project-slider .preload-me").loaded(null, function() {
    //         var $sidebar = $(".floating-content");
    //         if ($(".floating-content").length > 0) {
    //             var offset = $sidebar.offset();
    //             if($(".top-bar").length > 0 && $(".phantom-sticky").length > 0){
    //                 var topBarH = $(".top-bar").height();
    //             }else{
    //                 var topBarH = 0;
    //             }
    //                 //$scrollHeight = $(".project-post").height();
    //             var $scrollOffset = $(".project-post").offset();
    //             //var $headerHeight = $phantom.height();
    //             $window.on("scroll", function () {
    //                 if (window.innerWidth > 1050) {
    //                     if (dtGlobals.winScrollTop + $phantom.height() > offset.top) {
    //                         if (dtGlobals.winScrollTop + $phantom.height() + $floatContentHeight + 40 < $scrollOffset.top + $parentHeight) {
    //                             $sidebar.stop().velocity({
    //                                 translateY : dtGlobals.winScrollTop - offset.top + $phantom.height() - topBarH
    //                             }, 300);
    //                         } else {
    //                             $sidebar.stop().velocity({
    //                                 translateY: $parentHeight - $floatContentHeight - 40 - topBarH
    //                             }, 300)
    //                         }
    //                     } else {
    //                         $sidebar.stop().velocity({
    //                             translateY: 0
    //                         }, 300)
    //                     }
    //                 } else {
    //                     $sidebar
    //                         .css({
    //                             "transform": "translateY(0)",
    //                             "-webkit-transform" : "translateY(0)",
    //                         });
    //                 }
    //             })
    //         }
    //     }, true);
    // }
    // setFloatinProjectContent();



/* #Photo slider initialisation
================================================== */
// jQuery(document).ready(function($) {
    var $photoScroller = $(".photo-scroller");
    if($photoScroller.length > 0){
        /* !Set slider */
        $.fn.photoSlider = function() {
            var $el = $(this),
                slides = {},
                thumbs = "";
                $elParent = $el.parents(".photo-scroller");

                slides.$items = $el.children("figure");
                slides.count = slides.$items.length;

            slides.$items.each(function(i) {
                var $this = $(this),
                    $slide = $this.children().first().remove(),
                    src = $slide.attr("href"),
                    $thumbImg = $slide.children("img"),
                    thumbSrc = $thumbImg.attr("src"),
                    thumbDataSrc = $thumbImg.attr("data-src"),
                    thumbDataSrcset = $thumbImg.attr("data-srcset"),
                    thumbClass = $thumbImg.attr("class");
                if($thumbImg.hasClass("lazy-load")){
                    var $layzrBg = "layzr-bg";
                }else{
                    var $layzrBg = "";
                }

                // !Captions copying
                $this.find("figcaption").addClass("caption-" + (i+1) + "");
                var $thisCaptionClone = $(this).find("figcaption").clone(true);
                $(".slide-caption").append($thisCaptionClone);
                if (parseInt($elParent.attr("data-thumb-width")) > 0) {
                    var thisWidth = parseInt($elParent.attr("data-thumb-width")),
                        thisHeight = parseInt($elParent.attr("data-thumb-height"));

                    $elParent.removeClass("proportional-thumbs");
                }
                else {
                    var thisWidth = parseInt($thumbImg.attr("width")),
                        thisHeight = parseInt($thumbImg.attr("height"));

                    $elParent.addClass("proportional-thumbs");
                };

                thumbs = thumbs + '<div class="ts-cell" data-width="'+(thisWidth+5)+'" data-height="'+(thisHeight+10)+'"><div class="ts-thumb-img ' + $layzrBg +'"><img class=" '+thumbClass+'" src="'+thumbSrc+'" data-src="'+thumbDataSrc+'" data-srcset="'+thumbDataSrc+'" width="'+thisWidth+'" height="'+thisHeight+'"></div></div>';

                $this.prepend('<div class="ts-slide-img"><img src="'+src+'" width="'+$this.attr("data-width")+'" height="'+$this.attr("data-height")+'"></div>');

                
            });
            
            $elParent.append('<div class="scroller-arrow prev"><i></i><i></i></div><div class="scroller-arrow next"><i></i><i></i></div>')

            $el.addClass("ts-cont");
            $el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

            var $slider = $el.parents(".ts-wrap"),
                windowW = $window.width(),
                $sliderPar = $elParent,
                $sliderAutoslide = ($sliderPar.attr("data-autoslide") == "true") ? true : false,
                $sliderAutoslideDelay = ($sliderPar.attr("data-delay") && parseInt($sliderPar.attr("data-delay")) > 999) ? parseInt($sliderPar.attr("data-delay")) : 5000,
                $sliderLoop = ($sliderPar.attr("data-loop") === "true") ? true : false,
                $thumbHeight = $sliderPar.attr("data-thumb-height") ? parseInt($sliderPar.attr("data-thumb-height"))+10 : 80+10,
                $slideOpacity = $sliderPar.attr("data-transparency") ? $sliderPar.attr("data-transparency") : 0.5,
                $adminBarH = $("#wpadminbar").length > 0? $("#wpadminbar").height() : 0;

            // !New settings for cells;
            var dataLsMin = $sliderPar.attr("data-ls-min") ? parseInt($sliderPar.attr("data-ls-min")) : 0,
                dataLsMax = $sliderPar.attr("data-ls-max") ? parseInt($sliderPar.attr("data-ls-max")) : 100,
                dataLsFillDt = $sliderPar.attr("data-ls-fill-dt") ? $sliderPar.attr("data-ls-fill-dt") : "fill",
                dataLsFillMob = $sliderPar.attr("data-ls-fill-mob") ? $sliderPar.attr("data-ls-fill-mob") : "fit",
                dataPtMin = $sliderPar.attr("data-pt-min") ? parseInt($sliderPar.attr("data-pt-min")) : 0,
                dataPtMax = $sliderPar.attr("data-pt-max") ? parseInt($sliderPar.attr("data-pt-max")) : 100,
                dataPtFillDt = $sliderPar.attr("data-pt-fill-dt") ? $sliderPar.attr("data-pt-fill-dt") : "fill",
                dataPtFillMob = $sliderPar.attr("data-pt-fill-mob") ? $sliderPar.attr("data-pt-fill-mob") : "fit",
                dataSidePaddings  = $sliderPar.attr("data-padding-side") ? parseInt($sliderPar.attr("data-padding-side")) : 0;

            // !Normalize new settings for cells;
            if (dataLsMax <= 0) dataLsMax = 100;
            if (dataPtMax <= 0) dataPtMax = 100;
            if (dataLsMax < dataLsMax) dataLsMax = dataLsMax;
            if (dataPtMax < dataPtMax) dataPtMax = dataPtMax;

            $slider.addClass("ts-ls-"+dataLsFillDt).addClass("ts-ls-mob-"+dataLsFillMob);
            $slider.addClass("ts-pt-"+dataPtFillDt).addClass("ts-pt-mob-"+dataPtFillMob);

            $slider.find(".ts-slide-img").css({
                "opacity": $slideOpacity
            });
            $slider.find(".video-icon").css({
                "opacity": $slideOpacity
            });


            var $slideTopPadding = ($sliderPar.attr("data-padding-top") && windowW > 760) ? $sliderPar.attr("data-padding-top") : 0,
                $slideBottomPadding = ($sliderPar.attr("data-padding-bottom") && windowW > 760) ? $sliderPar.attr("data-padding-bottom") : 0;

            var $sliderVP = $slider.find(".ts-viewport");
            $sliderVP.css({
                "margin-top": $slideTopPadding+"px",
                "margin-bottom": $slideBottomPadding+"px"
            });
            
            $window.on("debouncedresize", function() {
                if ($sliderPar.attr("data-padding-top") && $window.width() > 760) {
                    $slideTopPadding = $sliderPar.attr("data-padding-top");
                }
                else {
                    $slideTopPadding = 0;
                };

                if ($sliderPar.attr("data-padding-bottom") && $window.width() > 760) {
                    $slideBottomPadding = $sliderPar.attr("data-padding-bottom");
                }
                else {
                    $slideBottomPadding = 0;
                };

                if ($window.width() > 760) {
                    $sliderVP.css({
                        "margin-top": $slideTopPadding+"px",
                        "margin-bottom": $slideBottomPadding+"px"
                    });
                }
                else {
                    $sliderVP.css({
                        "margin-top": 0+"px",
                        "margin-bottom": 0+"px"
                    });
                };
            });

            /* !Initializinig the main slider */
            var $sliderData = $slider.thePhotoSlider({
                mode: {
                    type: "centered",
                    lsMinW: dataLsMin,
                    lsMaxW: dataLsMax,
                    ptMinW: dataPtMin,
                    ptMaxW: dataPtMax,
                },
                height: function() {
                    // if ($(window).width() < 760) {
                    //  return (window.innerHeight);
                    // }else 
                    var $windowH = $window.height(),
                        $adminBarH = $("#wpadminbar").height();
                    if ($(".mixed-header").length > 0){
                        var $headerH = $(".mixed-header").height();
                    }else{                      
                        var $headerH = $(".masthead").height();
                    }
                    if ($body.hasClass("transparent") || $slider.parents(".photo-scroller").hasClass("full-screen")) {

                        if(window.innerWidth < dtLocal.themeSettings.mobileHeader.secondSwitchPoint) {
                            return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
                        }else {
                            return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);                            
                        };

                    }else if ($(".mixed-header").length > 0 || $slider.parents(".photo-scroller").hasClass("full-screen")) {

                        if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
                            return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);                 
                        }else {
                            if($(".side-header-h-stroke").length > 0){
                                return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
                            }else{
                                return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);
                            }
                        };

                    }else if ($(".side-header").length > 0 || $slider.parents(".photo-scroller").hasClass("full-screen")) {

                        if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
                            return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
                        }else {
                            return ($windowH - $slideTopPadding - $slideBottomPadding - $adminBarH);                            
                        };

                    }else {

                        if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
                            return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);                     
                        }else {
                            return ($windowH - $slideTopPadding - $slideBottomPadding - $headerH - $adminBarH);
                        };

                    };
                },
                sidePaddings: dataSidePaddings,
                autoPlay: {
                    enabled: $sliderAutoslide,
                    delay: $sliderAutoslideDelay,
                    loop: $sliderLoop
                }
            }).data("thePhotoSlider");


            var $thumbsScroller = $('<div class="ts-wrap"><div class="ts-viewport"><div class="ts-cont ts-thumbs">'+thumbs+'</div></div></div>');
            $slider.after($thumbsScroller);

            /* !Initializinig the thumbnail stripe */
            var $thumbsScrollerData = $thumbsScroller.thePhotoSlider({
                mode: {
                    type: "scroller"
                },
                height: $thumbHeight
            }).data("thePhotoSlider");


            $(".prev", $this_par).click(function() {
                if (!$sliderData.noSlide) $sliderData.slidePrev();
            });
            $(".next", $this_par).click(function() {
                if (!$sliderData.noSlide) $sliderData.slideNext();
            });

            $sliderData.ev.on("updateNav sliderReady", function() {
                if ($sliderData.lockRight) {
                    $(".next", $elParent).addClass("disabled");
                } else {
                    $(".next", $elParent).removeClass("disabled");
                };

                if ($sliderData.lockLeft) {
                    $(".prev", $elParent).addClass("disabled");
                } else {
                    $(".prev", $elParent).removeClass("disabled");
                };
            });

            /*keyboard navigation*/
            window.addEventListener("keydown", checkKeyPressed, false); 
            function checkKeyPressed(e) {
                if (e.keyCode == "37") {
                    if (!$sliderData.noSlide) $sliderData.slidePrev();
                } else if (e.keyCode == "39") { 
                    if (!$sliderData.noSlide) $sliderData.slideNext();
                } 
            }


            // !Active slide indication and thumbnail mechanics: begin */
            $sliderData.ev.on("sliderReady beforeTransition", function() {
                $sliderData.slides.$items.removeClass("act");
                $sliderData.slides.$items.eq($sliderData.currSlide).addClass("act");

                $thumbsScrollerData.slides.$items.removeClass("act");
                $thumbsScrollerData.slides.$items.eq($sliderData.currSlide).addClass("act");

                if($sliderData.slides.$items.eq($sliderData.currSlide).hasClass("ts-video")){
                    $sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-slider-overlay");
                }else if($sliderData.slides.$items.eq($sliderData.currSlide).find(".ps-link").length > 0){
                    $sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-slider-overlay");
                }else{
                    $sliderData.slides.$items.parents(".ts-wrap ").removeClass("hide-slider-overlay");
                };


                var actCaption = $sliderData.slides.$items.eq($sliderData.currSlide).find("figcaption").attr("class");

                $('.slide-caption > figcaption').removeClass("actCaption");
                $('.slide-caption > .'+actCaption).addClass("actCaption");
            });

            $sliderData.ev.on("afterTransition", function() {
                var viewportLeft    = -($thumbsScrollerData._unifiedX()),
                    viewportRight   = viewportLeft + $thumbsScrollerData.wrap.width,
                    targetLeft      = -$thumbsScrollerData.slides.position[$sliderData.currSlide],
                    targetRight     = targetLeft + $thumbsScrollerData.slides.width[$sliderData.currSlide];

                targetLeft = targetLeft - 50;
                targetRight = targetRight + 50;

                if (targetLeft < viewportLeft) {

                    for (i = $thumbsScrollerData.currSlide; i >= 0; i--) {
                        targetLeft = targetLeft + 50;
                        targetRight = targetRight - 50;

                        var tempViewportLeft    = -$thumbsScrollerData.slides.position[i],
                            tempViewportRight   = tempViewportLeft + $thumbsScrollerData.wrap.width;

                        if (targetRight > tempViewportRight) {
                            $thumbsScrollerData.slideTo(i+1);
                            break;
                        } 
                        else if (i === 0) {
                            $thumbsScrollerData.slideTo(0);
                        }
                    }
                }
                else if (targetRight > viewportRight) {
                    $thumbsScrollerData.slideTo($sliderData.currSlide);
                };
            });

            $thumbsScroller.addClass("scroller-thumbnails");
            $thumbsScrollerData.slides.$items.each(function(i) {
                $(this).on("click", function(event) {
                    var $this = $(this);

                    if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
                    $sliderData.slideTo(i);
                });
            });

            $(".scroller-thumbnails").layzrInitialisation();
            $sliderData.slides.$items.each(function(i) {
                $(this).on("click", function(event) {
                    var $this = $(this);

                    if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
                    $sliderData.slideTo(i);
                });
            });
            // !Active slide indication and thumbnail mechanics: end */

            var $this_par = $slider.parents(".photo-scroller");

            /* !- Autoplay */
            if( $sliderData.st.autoPlay.enabled ){
                $(".auto-play-btn", $this_par).addClass("paused");
            }
            
            $(".auto-play-btn", $this_par).on("click", function(e){
                e.preventDefault();
                var $this = $(this);
                if( $this.hasClass("paused")){
                    $this.removeClass("paused");
                    if (!$sliderData.noSlide) $sliderData.pause();
                    $sliderData.st.autoPlay.enabled = false;
                }else{
                    $this.addClass("paused");
                    if (!$sliderData.noSlide) $sliderData.play();
                    $sliderData.st.autoPlay.enabled = true;
                }
            });

        };

        /* !- Initialize slider */
        $(".photoSlider").photoSlider();


        
        /* !- Show slider*/

        $(".photoSlider").parents(".photo-scroller").css("visibility", "visible");

        
        function launchFullscreen(element) {
            if(element.requestFullscreen) {
                element.requestFullscreen();
            } else if(element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if(element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if(element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        }
        function exitFullscreen() {
            if(document.exitFullscreen) {
                document.exitFullscreen();
            } else if(document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if(document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        };

        /* !- Fullscreen button */
        if(!dtGlobals.isWindowsPhone){
            $(".full-screen-btn").each(function(){
                var $this = $(this),
                    $thisParent = $this.parents(".photo-scroller");
                document.addEventListener("fullscreenchange", function () {
                    if(!document.fullscreen){
                        $this.removeClass("act");
                        $thisParent.removeClass("full-screen");
                        $("body, html").css("overflow", "");
                    }
                }, false);
                document.addEventListener("mozfullscreenchange", function () {
                    if(!document.mozFullScreen){
                        $this.removeClass("act");
                        $thisParent.removeClass("full-screen");
                        $("body, html").css("overflow", "");
                    }
                }, false);
                document.addEventListener("webkitfullscreenchange", function () {
                    if(!document.webkitIsFullScreen){
                        $this.removeClass("act");
                        $thisParent.removeClass("full-screen");
                        $("body, html").css("overflow", "");
                        var scroller = $frame.data("thePhotoSlider");
                        if(typeof scroller!= "undefined"){
                            scroller.update();
                        };
                    }
                }, false);
            })

            $(".full-screen-btn").on("click", function(e){
                e.preventDefault();
                var $this = $(this),
                    $thisParent = $this.parents(".photo-scroller"),
                    $frame = $thisParent.find(".ts-wrap"),
                    $thumbs = $thisParent.find(".scroller-thumbnails").data("thePhotoSlider"),
                    $scroller = $frame.data("thePhotoSlider");
                $this.parents(".photo-scroller").find("figure").animate({"opacity": 0},150);
                if( $this.hasClass("act")){
                
                    $this.removeClass("act");
                    exitFullscreen();
                    $thisParent.removeClass("full-screen");

                    setTimeout(function(){
                        $this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
                    }, 300);
                }else{
                     $this.addClass("act");
                    $thisParent.addClass("full-screen");
                    launchFullscreen(document.documentElement);
                    $("body, html").css("overflow", "hidden");
                    setTimeout(function(){
                        $this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
                    }, 300)
                }
                var scroller = $frame.data("thePhotoSlider");
                if(typeof scroller!= "undefined"){
                    scroller.update();
                };
            });
        }

        /* !- Show/hide thumbs */
        $photoScroller.each(function(){
            var $this = $(this);
            
            $(".btn-cntr, .slide-caption", $this).css({
                "bottom": parseInt($this.attr("data-thumb-height")) + 15
            });

            if( $this.hasClass("hide-thumbs")){
                $this.find(".hide-thumb-btn").addClass("act");
                $(".scroller-thumbnails", $this).css({
                    "bottom": -(parseInt($this.attr("data-thumb-height")) +20)
                });
                $(".btn-cntr, .slide-caption", $this).css({
                    "bottom": 5 + "px"
                });
            }
        });
        $(".hide-thumb-btn").on("click", function(e){
            e.preventDefault();
            var $this = $(this),
                $thisParent = $this.parents(".photo-scroller");
            if( $this.hasClass("act")){
                 $this.removeClass("act");
                $thisParent.removeClass("hide-thumbs");
                $(".scroller-thumbnails", $thisParent).css({
                    "bottom": 0
                });
                $(".btn-cntr, .slide-caption", $thisParent).css({
                    "bottom": parseInt($thisParent.attr("data-thumb-height")) + 15
                });

            }else{
                 $this.addClass("act");
                $thisParent.addClass("hide-thumbs");
                $(".scroller-thumbnails", $thisParent).css({
                    "bottom": -(parseInt($thisParent.attr("data-thumb-height")) +20)
                });
                $(".btn-cntr, .slide-caption", $thisParent).css({
                    "bottom": 5 + "px"
                });
            }
        });
    };
// })

    //porthole Slider
    if ($(".rsHomePorthole").exists()) {
        var portholeSlider = {};
        portholeSlider.container = $("#main-slideshow");
        portholeSlider.hendheld = $window.width() < 740 && dtGlobals.isMobile ? true : false;
        
        $("#main-slideshow-content").appendTo(portholeSlider.container);

           //Scroller porthole slideshow

        $.fn.portholeScroller = function() {
            var $el = $(this),
                slides = {},
                thumbs = "";

                slides.$items = $el.children("li"),
                slides.count = slides.$items.length;

            slides.$items.each(function(i) {
                var $this = $(this),
                     $slide = $this,
                     $thumbImg = $slide.children("img"),
                     thumbSrc = $thumbImg.attr("data-rstmb"),
                     thumbDataSrc = $thumbImg.attr("data-src"),
                     thumbDataSrcset = $thumbImg.attr("data-srcset"),
                     thumbClass = $thumbImg.attr("class");
                 if($thumbImg.hasClass("lazy-load")){
                     var $layzrBg = "layzr-bg";
                 }else{
                     var $layzrBg = "";
                 }
                 thumbs = thumbs + '<div class="ps-thumb-img ' + $layzrBg +'"><img class=" '+thumbClass+'" src="'+thumbSrc+'"  width="150" height="150"></div>';    
             });

            $el.addClass("ts-cont");
            $el.wrap('<div class="ts-wrap"><div class="ts-viewport portholeSlider-wrap"></div></div>');
          

            var $slider = $el.parents(".ts-wrap"),
                $this_par = $el.parents("#main-slideshow"),
                windowW = $window.width(),
                paddings = $this_par.attr("data-padding-side") ? parseInt($this_par.attr("data-padding-side")) : 0,
                $sliderAutoslideEnable = ( 'true' != $this_par.attr("data-paused") && typeof $this_par.attr("data-autoslide") != "undefined" ) ? true : false,
                $sliderAutoslide = ( 'true' === $this_par.attr("data-paused") ) ? false : true,
                $sliderAutoslideDelay = $this_par.attr("data-autoslide") && parseInt($this_par.attr("data-autoslide")) > 999 ? parseInt($this_par.attr("data-autoslide")) : 5000,
                $sliderLoop = (  typeof $this_par.attr("data-autoslide") != "undefined" ) ? true : false,
                $sliderWidth = $this_par.attr("data-width") ? parseInt($this_par.attr("data-width")) : 800,
                $sliderHight = $this_par.attr("data-height") ? parseInt($this_par.attr("data-height")) : 400,
                imgMode = $this_par.attr("data-scale") ? $this_par.attr("data-scale") : "none";

            var $sliderData = $slider.thePhotoSlider({
                mode: {
                    type: "slider"
                },
                height: $sliderHight,
                width: $sliderWidth,
                //sidePaddings: paddings,
                resizeImg: true,
                imageScaleMode: imgMode,
                imageAlignCenter:true,
                autoPlay: {
                    enabled: $sliderAutoslideEnable,
                    delay: $sliderAutoslideDelay,
                    loop: $sliderLoop
                }
            }).data("thePhotoSlider");

            //Create thumbs
            var $thumbsScroller = $('<div class="psThumbs"><div class="psThumbsContainer">'+thumbs+'</div></div>');
            $slider.append($thumbsScroller);
            var $psThumb = $(".ps-thumb-img ");
            $psThumb.each(function(i) {
                $(this).on("click", function(event) {
                     var $this = $(this);

                     //if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
                     $sliderData.slideTo(i);
                });
             });

            //Tumbs progress
            $(".psThumbsContainer").after('<div class="progress-wrapper"><div class="progress-controls"></div></div>');
            $progressWrap = $(".psThumbsContainer").next();
            $progressHtml = '<div class="progress-mask"><div class="progress-spinner-left" style="animation-duration: '+$sliderAutoslideDelay+'ms;"></div></div><div class="progress-mask"><div class="progress-spinner-right" style="animation-duration: '+$sliderAutoslideDelay+'ms;"></div></div>';
            
            if ($sliderData.st.autoPlay.enabled) {
                if ($progressWrap.find(".progress-mask").length < 1) {
                    $progressWrap.prepend($progressHtml);
                }
            }
            $sliderData.ev.on("autoPlayPlay", function() {
                if ($progressWrap.find(".progress-mask").length < 1) {
                    $progressWrap.prepend($progressHtml);
                }
                $progressWrap.removeClass("paused");
            });

            $sliderData.ev.on("autoPlayPause", function() {
                $progressWrap.find(".progress-mask").remove();
                if (!$sliderAutoslideEnable) {
                    $progressWrap.addClass("paused");
                }
            });

            $sliderData.ev.on("sliderReady beforeTransition", function() {
                //Animate thums container
                var newPos = -$sliderData.currSlide * 40;
                if (newPos == 0) {
                    newPos = 20;
                }
                $psThumb.removeClass("psNavSelected psNavPrev psNavNext psNavVis");
                $psThumb.eq($sliderData.currSlide).addClass("psNavSelected");
                $psThumb.eq($sliderData.currSlide).prev().addClass("psNavPrev");
                $psThumb.eq($sliderData.currSlide).next().addClass("psNavNext");
                $psThumb.eq($sliderData.currSlide).prev().prev().addClass("psNavVis");
                $psThumb.eq($sliderData.currSlide).next().next().addClass("psNavVis");
                $(".psThumbsContainer").css({ transform:'translateY(' +  newPos  + 'px)' });
            })
            $sliderData.ev.on("sliderReady beforeTransition", function() {
                //hide thumb progress on slide change
                $progressWrap.addClass("blurred");
            });
            $sliderData.ev.on("sliderReady afterTransition", function() {
                $progressWrap.removeClass("blurred");
            });
            var dtResizeTimeout;
            $window.on("resize", function() {
                clearTimeout(dtResizeTimeout);
                dtResizeTimeout = setTimeout(function() {
                    $progressWrap.removeClass("blurred");
                }, 200);
            });

            //Append slider navigation
            $('<div class="leftArrow"></div><div class="rightArrow"></div>').insertAfter($el);

            $(".leftArrow", $slider).click(function() {
                if (!$sliderData.noSlide) $sliderData.slidePrev();
            });
            $(".rightArrow", $slider).click(function() {
                if (!$sliderData.noSlide) $sliderData.slideNext();
            });

            $sliderData.ev.on("updateNav sliderReady", function() {
                if ($sliderData.lockRight) {
                    $(".rightArrow", $slider).addClass("disabled");
                } else {
                    $(".rightArrow", $slider).removeClass("disabled");
                };

                if ($sliderData.lockLeft) {
                    $(".leftArrow", $slider).addClass("disabled");
                } else {
                    $(".leftArrow", $slider).removeClass("disabled");
                };
                if ($sliderData.lockRight && $sliderData.lockLeft) {
                    $this_par.addClass("hide-arrows");
                };
            });

            //Slider auto play/pause
            if( 'true' === $this_par.attr("data-paused") ){
                $progressWrap.addClass("paused");
            };
            $progressWrap.on("click", function(e){
                e.preventDefault();
                var $this = $(this);
                if( $this.hasClass("paused")){
                    $this.removeClass("paused");
                    if ($progressWrap.find(".progress-mask").length < 1) {
                        $progressWrap.prepend($progressHtml);
                    }
                    if (!$sliderData.noSlide) $sliderData.play();
                    $sliderData.st.autoPlay.enabled = true;
                }else{
                    $this.addClass("paused");
                    if (!$sliderData.noSlide) $sliderData.pause();
                    $sliderData.st.autoPlay.enabled = false;
                    $progressWrap.find(".progress-mask").remove();
                  
                }
            });
            // $(".rsPlayBtn").on("click", function(e){
            //    // e.preventDefault();
            //     var $this = $(this);
            //     if(  $progressWrap.hasClass("paused")){
            //     }else{
            //          $progressWrap.addClass("paused");
            //         if (!$sliderData.noSlide) $sliderData.pause();
            //         $sliderData.st.autoPlay.enabled = false;
            //         $progressWrap.find(".progress-mask").remove();
                  
            //     }
            // });

            // scroller.hover(
            //  function() {
            //      if($sliderAutoslide) {
            //          $sliderData._autoPlayPaused = false;
            //          $sliderData.pause();
            //          $sliderData._pausedByHover = true;
            //      }
            //  },
            //  function() {
            //      if($sliderAutoslide) {
            //          $sliderData._pausedByHover = false;
            //          if(!$sliderData._pausedByClick){
            //              $sliderData.play();
            //          }
            //      }
            //  }
            // );
        };
        $(".rsHomePorthole").each(function(){
            $(this).portholeScroller();
        });
        
    };

});
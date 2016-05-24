
/*3D slideshow*/
 jQuery(document).ready(function($){
	 
	 /* #Check if element exists
================================================== */
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
	
    if ( $3DSlider.length > 0){
        if( $mainSlider.hasClass('fixed') ){
            var ratioFix = $3DSlider.attr('data-height')/$3DSlider.attr('data-width');
            var thisH = $3DSlider.css('height'),
                main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
                //$('.three-d-slider-content').css("height", $3DSlider.width() * (ratioFix) );
            var fixW = $3DSlider.width();
        }else if( $mainSlider.hasClass('fixed-height') ){
            var ratioFix = $3DSlider.attr('data-height')/$3DSlider.attr('data-width');
            var thisH = $3DSlider.css('height'),
                main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
            var fixW = $3DSlider.width();
        }else{
            if($('.boxed').length > 0){
                var boxedM = parseInt($('#page.boxed').css('margin-bottom'));
            }else{
                var boxedM = 0;
            }
            var main = $3DSlider.css({'height': $(window).height() - headerH - boxedM - adminH - boxedM }).addClass('slide-me');    
        }
         
         
        var settings = {  
                useJS : 1, //use JS to prevent mobile Safari crash (if a lot of images are displayed)           
                cellSize : 300, //defines amount of empty space between images. The bigger cellSize, the more space 
                images : [$('#level1 img'),$('#level2 img'),$('#level3 img')], //defines where to get images for each layer
                scale : [0.14, 0.23, 0.35], //image scale-down for each layer
                corner_w : 3, //image corner roll-over width
                corner_l : 30, //image corner roll-over side length
                corner_color : "#ffffff", //image corner roll-over color
                hover_color : "rgba(0, 0, 0, .35)" //entire image roll-over color and opacity
        };
         
        /*------ Control over correct source image feed ------*/       
        var Plane = [], //image layers collection
            $all_images = $([]), //images collection
            real_length = 0; //length of images[] array after dropping out layers with no images
             
        function checkOptions() { //make sure images[] array is set up correctly
            var source = settings.images.slice();
            for (var i = 0; i < source.length; i++) {
                if (source[i] && source[i].length) { //drop out empty and incorrect enties of images[]
                    Plane[real_length] = source[i].slice(0); //create collection of image layers
                    $all_images = $.merge($all_images, source[i]);
                    source[i].parent().addClass('erase-source'); //identify source layers, which need to be removed in the future
                    real_length++;
                }
            }
        }
        checkOptions();
        /*------ Control over correct source image feed END ------*/
        var loaded_imgs = 0, //number of images, which are already loaded
            total = $all_images.length, //total number of images in the collection
            $loading = main.children('#loading'), //image loading progress counter
            windowH = main.height(), //viewport height
            windowW = main.width(), //viewport width
            ratio = windowW/windowH, //viewport aspect ratio
            length = 3,
            indexZ = [3, 6, 9], //z-index for each layer.  Also should be set-up in jquery.magnetize.css
            IEsc = [1, 1, 1], //consider scale if browser is IE
            $hovered, //determines a hovered image
            lightbox_sc = Math.round(100 / settings.scale[length - 1])/100,
            time = {//defines timeouts for layers reordering animation
                layer : 700, //layer moves from one plane to another  
                invis : 850, //layer is invisible
                scrn : 500, //layer moves from  minus infinity to the first plane
                delay : 100, //delay between layers animation
            },
            timer1, timer2, timer3, timer4, timer5, timer6, timer7, timer8, //timers
            n = [], //number of "cells" per layer height
            m = [], //number of "cells" per layer width
            Container = [],  // array of canvas containers
            flags = {// auxiliary variables for appropriate algorithm switching
                allowParallax : length, //parallax animation is initially allowed
                useNavig : 0, //0 - if navigating with a click on an image, 1 - if navigation a click on navigation buttons
                antiStumble : 0, // -> 1 after layers reordering, and is required for more smooth parallax animation
                isLightbox : 0, // -> 1 when a single image is being viewed in a lightbox
                isMobile :(/(Android|BlackBerry|iPhone|iPod|iPad|Palm|Symbian)/.test(navigator.userAgent)), //if a visitor uses a mobile browser
                scrolling : false, // define whether you scroll or simply touch a display  
                noImagesWarning : "There are no slides to display. Please upload images."// is displayed if the plugin is set up incorrectly
            };
         
        if( $mainSlider.hasClass('fixed') ){
                 
                var newWidth,
                    newHeight;
                var fixedW = fixW;
                             
                $(window).on('resize', function(){
                    var asw = $3DSlider.attr('data-width'),
                        ash = $3DSlider.attr('data-height');
                        newWidth = $3DSlider.width();
                         
                        if(newWidth != fixedW) {
                            var main = $3DSlider.css("height", newWidth * (ash / asw) ).addClass('slide-me');
                            newWidth = $3DSlider.width();
                        }else{
                            main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
                        }
                     
                });
            }else if( $mainSlider.hasClass('fixed-height') ){
                var newWidth,
                    newHeight;
                var fixedW = fixW;
                         
                $(window).on('resize', function(){
                    var asw = $3DSlider.attr('data-width'),
                        ash = $3DSlider.attr('data-height');
 
                        newWidth = $3DSlider.width();
                         
                        if(newWidth != fixedW) {
                            var main = $3DSlider.css("height", newWidth * (ash / asw) ).addClass('slide-me');
                            newWidth = $3DSlider.width();
                        }else{
                            main = $3DSlider.css("height", $3DSlider.width() * (ratioFix) ).addClass('slide-me');
                        }
                     
                });
            }else{
                $(window).on('resize', function(){  
                    if($('.boxed').length > 0){
                        var boxedM = parseInt($('#page.boxed').css('margin-bottom'));
                    }else{
                        var boxedM = 0;
                    }       
                    var main = $3DSlider.css({'height': $(window).height() - headerH - boxedM - adminH - boxedM}).addClass('slide-me');    
                });
            }
         
        var main_left = main.offset().left,
            main_top = main.offset().top;
             
        function synthesizePlanes(){
            var imgPerPlane = Math.floor(total/length);
            for (var k = 0; k < length; k++) {
                Plane[k] = [];
                for (var r = 0; r < imgPerPlane+Math.floor((k+1)/length)*(total-3*imgPerPlane); r++) {
                    Plane[k][r] = $all_images[r+k*imgPerPlane];
                }
            }
        }
             
        function start() {
            var dfdStart = $.Deferred();
            if (real_length != length) synthesizePlanes();
            main.addClass('slide-me');
            if (total != 0) {//make sure there are any images to display
                main.append($loading);
                $all_images.loaded(function() {
                    ++loaded_imgs; 
                });
                $.when(showLoadProgress()).done(function(){dfdStart.resolve(); }); //the function is not complete until until all images are loaded
                return main;
                //return dfdStart.promise(); /*Synchronization*/
            } else {    
                main.addClass('lightbox').append('<div class="img-caption"><p>'+flags.noImagesWarning+'</p></div>'); //show warning if there are no images to display
                return main;
            }
        }
         
        function showLoadProgress(){ //image load counter
            var dfdLoad = $.Deferred(); 
            timer7  = setTimeout(function(){
                if (loaded_imgs > 0.5 * total) { //if images are loaded too fast and progress bar does not show up
                    var fakeimgs = 0; //create simulator of images loading
                    timer8 = setInterval(function() {
                        if (fakeimgs < total) { //if not all images are loaded yet
                            $loading.html((++fakeimgs)+'/'+total); //display loading progress
                        } else {
                            $loading.html((total)+'/'+total); //all images are loaded
                            if (loaded_imgs == total) {
                                clearInterval(timer8);
                                $.when( launchSlideshow() ).done( function() {
                                    dfdLoad.resolve(); // IMPORTANT: launch the main script
                                }); 
                            }
                        }
                    },50);
                } else { //if images are loaded with normal speed
                    timer8 = setInterval(function() {
                        $loading.html((loaded_imgs)+'/'+total); //display loading progress
                        if (loaded_imgs == total) { //all images are loaded
                            clearInterval(timer8);
                            $.when( launchSlideshow() ).done( function() {
                                dfdLoad.resolve(); // IMPORTANT: launch the main script
                            });                     
                        }
                    },100);
                }
                clearTimeout(timer7);
            },150);
            return dfdLoad.promise();
        }               
         
        //CSS3 transition depending on browser
            var vP = ""; // What browser is being used
            var transSupport =''; //To check whether CSS3 transitions are supported
        if (/webkit/.test(navigator.userAgent.toLowerCase())) { // Find the transition prefix depending on browser 
            vP = "-webkit-";
            transSupport = 'Webkit';
        } else if (/msie/.test(navigator.userAgent.toLowerCase()) || (!!(navigator.userAgent.match(/Trident/) && !navigator.userAgent.match(/MSIE/)))) {
            vP = "-ms-";
            transSupport = 'ms';
        } else if (/mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase())) {
            vP = "-moz-";
            transSupport = 'Moz';
        } else if (/opera/.test(navigator.userAgent.toLowerCase())) {
            vP = "-o-";
            transSupport = 'O';
        }
 
        //CSS3 transition detection
        function supportsTransforms() {
            var b = document.body || document.documentElement;
            var s = b.style;
            var pp = 'transform';
            if(typeof s[pp] == 'string') return true;
            pp = pp.charAt(0).toUpperCase() + pp.substr(1);
              if(typeof s[transSupport + pp] == 'string') return true;
            return false;
        }
        function supportsTransitions() {
            var b = document.body || document.documentElement;
            var s = b.style;
            var pp = 'transition';
            if(typeof s[pp] == 'string') return true;
            pp = pp.charAt(0).toUpperCase() + pp.substr(1);
              if(typeof s[transSupport + pp] == 'string') return true;
            return false;
        }
         
        //create strings with the appropriate CSS3 attributes in accordance with visitors's browser
        var smart = supportsTransitions() * supportsTransforms(),
            trasitDur = vP+"transition-duration",
            trasitDel = vP+"transition-delay",
            transform = vP+"transform"; 
         
        //normalization of touch events
        function coordinates(event) { 
            if (event.originalEvent.touches !== undefined && event.originalEvent.touches[0]) {
                event.pageX = event.originalEvent.touches[0].pageX;
                event.pageY = event.originalEvent.touches[0].pageY;
            }
            return event;
        }
         
        //reposition if window resize. Only image containers move.
        function makeEasyReposition(){ 
            windowH = main.height();
            windowW = main.width();
            animateLayersBunch(0.5 * windowW, 0.5 * windowH);
        }
         
        //reposition if window resize. Both image containers and images move.
        function makeTotalReposition(){ 
            windowH = main.height();
            windowW = main.width();
            resizePlanes(windowW / windowH);
        }
         
        //create slider HTML
        function createContainers(planes) {
            var CanvasArray = '<div class="close"></div><div class="dark-layer l2"></div><div class="dark-layer l1"></div><div class="img-caption"><p></p></div><div class="navig"><div class="act">1</div><div>2</div><div>3</div></div>',
                corner;
            for (var k=0; k < length; k++) {
                //dealing with a single plane
                CanvasArray += '<div class="container-'+(k + 1)+' container" >';
                var plane_lngth = planes[k].length;
                for (var i = 0; i < plane_lngth; i++) {
                    if ($('<canvas></canvas>')[0].getContext) { //if browser supports Canvas
                        var newImg = '<canvas class="photo"></canvas>';//create canvas
                    } else {
                        var newImg = '<img class="photo" />';//otherwise create images
                    }
                    CanvasArray += newImg;
                }
                CanvasArray += '<div class="dark-layer"></div>';//add black overlay between planes
                if (!flags.isMobile) {//create "corners" roll-over for hovered image. No need in roll-over for mobile browsers
                    if (smart) { //create roll-over with help of Canvas in smart browsers
                        corner = '<canvas class="corners"></canvas>';
                    } else { //create roll-over with help of common HTML in IE
                        corner = '<span class="top-l"></span><span class="top-r"></span><span class="bottom-l"></span><span class="bottom-r"></span>';
                    } 
                    CanvasArray += corner;
                }
                CanvasArray += '</div>';  
            }
            main.append(CanvasArray); //add slideshow HTML to DOM
             
            findInterfaceElems(); //determine navigation, image caption, etc. elements
             
            $(window).resize(function() {
                var wWidth = $(window).width();
                main_left = main.offset().left;
                main_top = main.offset().top;
                if (settings.layout) {
                    if (settings.layout == 1) {
                        main.css({"max-width":wWidth, "height": wWidth/ settings.fixed_ratio});
                    } else if (settings.fixed_width > wWidth ) { 
                        main.css({"max-width":wWidth, "height": wWidth/ settings.fixed_ratio});
                    } else  {
                        main.css({"max-width":settings.fixed_width, "height": settings.fixed_height});
                    }
                } else {
                    main.css("height",$(window).height()-main_top);
                }
 
                if(!flags.isLightbox) {
                    if (settings.img_reposition && smart && !settings.useJS){
                        $navig.css("top" , Math.round(0.5 * (windowH - $navig.height())));
                        makeTotalReposition();
                        return true; 
                    }
                    makeEasyReposition();
                    $navig.css("top" , Math.round(0.5 * (windowH - $navig.height()))); //run after reposition for mobiles to ensure correct landscape-portrait switching
                }
 
            });
            $(document).on("scroll", function() { //consider document scroll when determining coordinates of a click
                $this = $(document);
                scrollTop = $this.scrollTop();
                scrollLeft = $this.scrollLeft();
            });     
            return $('div.container'); 
        }           
         
        //determine main static elements of slideshow layout
        function findInterfaceElems() {
            $closeX = main.children('.close'); //close button (image lightbox)
            $dark_layer1 = main.children('.l1');//1st dark overlay between planes
            $dark_layer2 = main.children('.l2');//2nd dark overlay between planes
            $caption = main.children('.img-caption');//image caption
            $caption_text = $caption.children('p');
            $navig = main.children('.navig');//navigation buttons
            $navig.css("top" , Math.round(0.5 * (windowH - $navig.height())));
            $darkLayers = main.find('div.dark-layer');//gather all dark layers into a single array
            scrollTop = $(document).scrollTop();
            scrollLeft = $(document).scrollLeft();
        }   
         
        //draw canvas images
        function drawCanvas(planes) {  
            for (var k = 0; k < length; k++) {
                var readyImgs = readyCanvas(k), 
                    readyImgsLngth = readyImgs.length;
                for (var i = 0; i < readyImgsLngth; i++) {
                    var real_img = planes[k][i],
                        img_width = $(real_img).width(),
                        img_height = $(real_img).height(),
                        $descr = $(real_img).next();
                    readyImgs[i].width = img_width;
                    readyImgs[i].height = img_height;
                    if ($('<canvas></canvas>')[0].getContext) { //if browser supports Canvas
                        var context = readyImgs[i].getContext("2d");
                        context.drawImage(real_img, 0, 0, img_width, img_height); //redraw images into canvas
                    } else { //if browser does not support canvas
                        $(readyImgs[i]).attr("src" , $(real_img).attr("src")); //leave images as <img>
                    }
                    if (!$descr.is('img')) $(readyImgs[i]).data("descr" , $descr.html());//display image caption
                    getCanvasSize(readyImgs[i]);//determine width and height of each picture
                }
            }
        }
         
        // get all images from i-th Container
        function readyCanvas(i) { 
            return $(Container[i]).children('.photo');
        }   
             
        // get number of cells across picture width and height  
        function getCanvasSize(canva) { 
            var $self = $(canva),
            w = Math.ceil($self.width() / settings.cellSize),
            h = Math.ceil($self.height() / settings.cellSize);
            $self.data({
                "wCanvas" : w,
                "hCanvas" : h,
                "deviationX" : Math.floor((w * settings.cellSize - $self.width()) * Math.random()), // devialtion of left position
                "deviationY" : Math.floor((h * settings.cellSize - $self.height()) * Math.random()) // deviation of top position
            });
        }   
         
        //resize layers in order to make sure all pictures are able to fit them 
        function resizePlanes(ratio) {
            for (var i = 0; i < length; i++) {
                var readyImgs = readyCanvas(i),
                    side = planeSide(readyImgs, ratio);
                    n[i] = side.n;// 1st itteration. Get number of cells across layer height    
                    m[i] = side.m;// 2nd itteration. Get number of cells across layer width 
                var newNM = positionImage(readyImgs, createMatrix(0,m[i],0,n[i]), 0, 0, n[i], m[i]); //position pictures inside of a layer
                    m[i] = newNM[0]; //correction of previously gotten values
                    n[i] = newNM[1];
                 
                Container[i].ind = i; // set initial order of layers
                 
                var vertical = addPaddings(n[i], windowH),
                    horizontal = addPaddings(m[i], windowW),
                    readyImgsLng = readyImgs.length;
                    Container[i].Wo = horizontal[0];//update layer width
                    Container[i].Ho = vertical[0];//update layer height
                for (var index = 0; index < readyImgsLng; index++) {
                    var $img = $(readyImgs[index]), 
                        top = parseFloat($img.css("top")),
                        left = parseFloat($img.css("left"));
                    $img.css({"top" : top + vertical[1], "left" : left + horizontal[1]}); //2nd itteration. Correction of pictures positions
                }
                Container[i].Scale = 1; 
                $(Container[i]).css({"width" : Container[i].Wo, "height" : Container[i].Ho});
                if (!smart || settings.useJS) {//consider scale if browser is IE
                    IEsc[i] = settings.scale[i]; 
                    Container[i] = scaleIE(settings.scale[i], Container[i], 0);
                }
            }
            animateLayersBunch(0.5 * windowW+main_left, 0.5 * windowH+main_top);//center image containers
            flags.allowParallax = length;
            return main;
        }   
         
        //calculate number of cells across image plane width and height
        function planeSide(realImages, proportion) {
            var totalImgArea = 0,
                img_numb = realImages.length,
                max_w = 0, 
                max_h = 0
                giveMoreSpace = 1.3;
            //Calculate the summ of images areas
            for (var i = 0; i < img_numb; i++){
                var imw = realImages[i].width,
                    imh = realImages[i].height;
                max_w = Math.max(max_w, imw); //search for the biggest image width
                max_h = Math.max(max_h, imh); //search for the biggest image height
                totalImgArea += giveMoreSpace * imw * imh + 2 * settings.cellSize * settings.cellSize; // calculate required containner area
            }
            max_w = Math.ceil(max_w / settings.cellSize);
            max_h = Math.ceil(max_h / settings.cellSize);           
            //approx container size when images are not scaled
            var W0 = Math.ceil(Math.sqrt(proportion * totalImgArea) / settings.cellSize), 
                H0;
            if (!(W0 > max_w)) W0 = max_w + 1; //make sure that container is wider than the widest image
            H0 = Math.ceil(giveMoreSpace * W0 / proportion);
            if (!(H0 > max_h)) H0 = max_h + 1; //make sure that container is higher than the highest image
            return {"n" : H0,"m" : W0};
        }
         
        //create a matrix [Mo...M; No...N]
        function createMatrix(Mo, M, No, N) { 
            var Matrix = [];
            for (var j = No; j < N; j++){
                var row = [];
                for (var i = Mo; i < M; i++){
                    row[i] = true; //the cell is ready for usage
                }
                Matrix[j] = row;
            }
            return Matrix;
        }   
         
        //position pictures inside of a layer   
        function positionImage(imagesArray, uMatrix, Jo, Io, matrixN, matrixM){//canvas positioning... God bless you
            /* imagesArray - array of images to place 
            Jo, Io - where to start the search
            matrixN, matrixM - number of cells in vertical and horizontal directions*/
            var maxM = 0,
                maxN = 0,
                Ioo=Io;
            var imgArrLng = imagesArray.length;
            for (var index = 0; index < imgArrLng; index++){ 
                Io=Ioo;
                var $img = $(imagesArray[index]);
                    widthCanvas = $img.data("wCanvas"),
                    heightCanvas = $img.data("hCanvas");
                IamDone :
                for (var j = Jo; j < (matrixN-heightCanvas); j++) {//find empty cells inside of a layer 
                    MoveToNextCellinRow : 
                    for (var i = Io; i < (matrixM - widthCanvas); i++) {
                        for (var r = j; r < (j + heightCanvas); r++) { 
                            for (var s = i; s < (i + widthCanvas); s++) {
                                if (uMatrix[r][s] == false) {
                                    if (j == (matrixN - heightCanvas - 1) && i == (matrixM - widthCanvas - 1)) { //the image is too large and does not fit the container
                                        for (var q = 0; q < matrixN; q++) { //add new column to container and try to position image again
                                            uMatrix[q].push(true);
                                        }
                                        i = Io;
                                        matrixM++; //adding new column
                                        j = 0;
                                    } 
                                    continue MoveToNextCellinRow; //move to the next cell in row
                                }
                            }
                        } 
                        //if an image has already found its place inside of a layer, mark the appropriate cells as "occupied"
                        for (var r = j; r < (j + heightCanvas + 1); r++) { 
                            for (var s = i; s < (i + widthCanvas + 1); s++) {
                                uMatrix[r][s] = false;
                            }   
                        }
                        if ((i + widthCanvas) > maxM) maxM = i + widthCanvas; //cut empty space on the right and in the bottom
                        if ((j + heightCanvas) > maxN) maxN = j + heightCanvas;
                        $img.css({"top" : Math.floor(j*settings.cellSize + $img.data("deviationY")), "left" : Math.floor(i*settings.cellSize + $img.data("deviationX"))});
                        break IamDone;
                    }
                }
            }
            return [maxM, maxN];     
        }
 
        function addPaddings(n_m, H_W) { //add paddings between around image containers
            if(settings.cellSize * n_m * settings.scale[length - 1] < H_W) {
                    var newH_W = Math.round((H_W + 0.5 * settings.cellSize) / settings.scale[length - 1]),
                    newPadding = Math.round(0.5 * (newH_W - settings.cellSize * n_m));
                } else {
                    var newH_W = Math.round(settings.cellSize * n_m + 0.5 * settings.cellSize / settings.scale[length - 1]),
                    newPadding = Math.round(0.25 * settings.cellSize / settings.scale[length - 1]);
                }
            return [newH_W, newPadding];
        }
         
        //image container scroll animation. Very important  
        function animateLayersBunch(epageX, epageY) {
            if (flags.allowParallax != length)  return false;//do not animate layers parallax while BringToTheFront is working
            epageX -= main_left;
            epageY -= main_top;
            var ratioX = epageX/windowW,
                ratioY = epageY/windowH,
                k = length - 1,
                Left = (ratioX - 0.5) * (1 - settings.scale[k] / IEsc[k]) * Container[k].Wo - ratioX * (Container[k].Wo - windowW),
                Top = (ratioY - 0.5) * (1 - settings.scale[k]/IEsc[k]) * Container[k].Ho - ratioY * (Container[k].Ho - windowH);
            for (var s = 0; s < k; s++) {  //animate background image containers 
                var L = settings.scale[s] / IEsc[k] * (Left + 0.5 * (IEsc[s] * Container[s].Wo - windowW)) - 0.5 * (IEsc[s] * Container[s].Wo - windowW)    ,
                    T = settings.scale[s] / IEsc[k] * (Top + 0.5 * (IEsc[s] * Container[s].Ho - windowH)) - 0.5 * (IEsc[s] * Container[s].Ho - windowH);
                if (!flags.antiStumble) {
                    $(Container[s]).css({"left" : Math.round(L), "top" : Math.round(T)});
                } else {
                    flags.allowParallax = 0;
                    $(Container[s]).animate({"left" : Math.round(L), "top" : Math.round(T)}, 120, 'linear');
                }
            }   // animate top image container
                if (!flags.antiStumble) {
                    $(Container[k]).css({"left" : Math.floor(Left), "top" : Math.floor(Top)});
                } else {                    
                    $(Container[k]).animate({"left" : Math.floor(Left), "top" : Math.floor(Top)}, 120, "linear" , function() {flags.antiStumble = false; flags.allowParallax = length});
                }
        }
         
        //image container scroll animation for mobile browsers.
        function animateLayersMobile(){
            var prevX = 0, prevY = 0,
                startX = 0, endX = 0,
                startY = 0, endY = 0,
                d_X = 0, d_Y = 0, //where the previous touch stopped. Initially eq. zero
                _delX, _delY,
                is_move; // prevent touchend bubbling
            main[0].ontouchmove = function(evdef){
                evdef.preventDefault();
            }
             
            main.on('touchstart', function(evstart){
                var start = coordinates(evstart);
                flags.scrolling = false;
                startX = start.pageX - main_left;
                startY = start.pageY - main_top;
                d_X = prevX + (startX - 0.5 * windowW);
                d_Y = prevY + (startY - 0.5 * windowH);
            });
         
            main.on('touchmove', function(evmove){
                var move = coordinates(evmove),
                    moveX = move.pageX - main_left,
                    moveY = move.pageY - main_top,
                    X = moveX - d_X,
                    Y = moveY - d_Y,
                    desktopX, desktopY; // mobile coordinates -> argumets for desktop container scroll animation
                 
                    _delX = moveX; // is required for detecting touchend coordinates
                    _delY = moveY;
                    //it is necessary to disallow scrolling out of the main:
                    desktopX  = ((X > windowW) * (windowW + 0.1) + (X < 0) * 0.1); // will return windowW or 0 if scroll to the boundary (0.1 is added since (X<0)*0 always = false)
                    desktopY  = ((Y > windowH) * (windowH + 0.1) + (Y < 0) * 0.1);
                 
                    if (!desktopX) { // if one scrolls inside of the main
                        desktopX = X;
                    } else { // if one attempts to scroll out of the main. Boundary conditions:
                        desktopX = desktopX - 0.1; //remove the previously added 0.1
                        startX = windowW - desktopX - prevX; // amendment for correct boundary move animation
                    }
                     
                    if (!desktopY) {
                        desktopY = Y;
                    } else {
                        desktopY = desktopY - 0.1; 
                        startY = windowH - desktopY - prevY;
                    }
                flags.scrolling = true;
                animateLayersBunch(windowW - desktopX + main_left , windowH - desktopY + main_top);//transfer event coordinates of touch-screen into coordinates for a desktop browser
                is_move = true; 
            });
         
            main.on('touchend', function(ed){
                if (is_move) {
                    prevX += startX - _delX; //calculate total distance
                    prevY += startY - _delY;
                }
                is_move = 0;
            });
        }           
         
        //draw roll-over ("4 corners")
        function drawCorners(actimg) {
            if (smart) { //roll-over size calculation
                var c_w = actimg.width() + 2 * settings.corner_w,//width
                    c_h = actimg.height() + 2 * settings.corner_w,//height
                    c_l = parseFloat(actimg.css("left")) - settings.corner_w,//"corner" side length
                    c_t = parseFloat(actimg.css("top")) - settings.corner_w,//"corner" side width
                    corners = actimg.siblings(".corners").css({"left" : c_l, "top" : c_t});
                     
                //draw "corners" with help of canvas for smart browsers
                corners[0].width = c_w;
                corners[0].height = c_h;
                var ctx=corners[0].getContext("2d");
                ctx.clearRect(0, 0, c_w, c_h);
                ctx.fillStyle = settings.hover_color;
                ctx.fillRect(
                            settings.corner_w, settings.corner_w, 
                            c_w - 2*settings.corner_w, c_h - 2 * settings.corner_w
                );
                ctx.beginPath();
                ctx.strokeStyle = settings.corner_color;
                ctx.lineWidth = settings.corner_w;
                ctx.lineCap = "square";
                 
                newCorner(
                        ctx, 
                        0.5 * settings.corner_w,settings.corner_l, 
                        0.5 * settings.corner_w,0.5 * settings.corner_w, 
                        settings.corner_l,0.5 * settings.corner_w
                );
                newCorner(
                        ctx, 
                        c_w - settings.corner_l,0.5 * settings.corner_w, 
                        c_w - 0.5 * settings.corner_w,0.5 * settings.corner_w, 
                        c_w - 0.5 * settings.corner_w,settings.corner_l
                );
                newCorner(
                        ctx, 
                        c_w - 0.5 * settings.corner_w,c_h - settings.corner_l, 
                        c_w - 0.5 * settings.corner_w,c_h - 0.5 * settings.corner_w, 
                        c_w - settings.corner_l,c_h - 0.5 * settings.corner_w
                );
                ctx.stroke(); 
                newCorner(
                        ctx, 
                        settings.corner_l,c_h - 0.5 * settings.corner_w, 
                        0.5 * settings.corner_w,c_h - 0.5 * settings.corner_w, 
                        0.5 * settings.corner_w,c_h - settings.corner_l
                );
                ctx.stroke();
                     
                return false;
            } else { //draw "corners" with help of spans for IE
                var $span_t_l = actimg.siblings('span.top-l'),
                $span_b_l = actimg.siblings('span.bottom-l'),
                $span_t_r = actimg.siblings('span.top-r'),
                $span_b_r = actimg.siblings('span.bottom-r'),
                l = parseFloat(actimg.css("left")),
                t = parseFloat(actimg.css("top")),
                w = actimg.width(),
                h = actimg.height();                
                span_side = settings.corner_l - settings.corner_w;
                $span_t_l.css({"opacity" : 0.7,"left" : l,"top" : t});
                $span_b_l.css({"opacity" : 0.7,"left" : l,"top" : t + h - span_side});
                $span_t_r.css({"opacity" : 0.7,"left" : l + w - span_side,"top" : t});
                $span_b_r.css({"opacity" : 0.7,"left" : l + w - span_side,"top" : t + h - span_side});
             
                actimg.on('mouseleave', function() {
                    $span_t_l.css("opacity" , 0);
                    $span_b_l.css("opacity" , 0);
                    $span_t_r.css("opacity" , 0);
                    $span_b_r.css("opacity" , 0);
                });
            }
        }   
         
        //draw a line for the roll-over corner      
        function newCorner(brush, startX,startY, angleX,angleY, endX,endY) {
            brush.moveTo(startX, startY);
            brush.lineTo(angleX, angleY);
            brush.lineTo(endX, endY);
        }           
         
        //determine whether a click is made on a picture    
        function findOnClickImage(planes, ev) {
            var count = planes.length - 1,
            el_below = ev.target;
            switchDarkLayers();//make dark overlays invisible while searching for a target picture
            while (!$(el_below).hasClass("photo") && (count != 0)){//if no images from the 1st layer were clicked, proceed to the rest of layers
                var e = new jQuery.Event("click");
                e.pageX = ev.pageX - scrollLeft; //calculate click coordinates considering document scroll correction
                e.pageY = ev.pageY - scrollTop;
                $(planes[count]).addClass("toBG");//hide upper layers -> make images below clickable
                el_below = document.elementFromPoint(e.pageX, e.pageY);
                count--;
            }   
            var planes_length = planes.length;
            for (var pp = 0; pp < planes_length; pp++) {
                $(planes[pp]).removeClass("toBG"); //bring upper layers back
            } 
            switchDarkLayers(); //make dark layers visible again
            if (!$(el_below).hasClass("photo")) el_below = false //if no imagess has been clicked, return flase
            return el_below; //return the target image
        }       
             
        function switchDarkLayers(){ // switch on/off dark layers when searching for an onclick target image
            for (var i = 0; i < $darkLayers.length; i++){    
                $($darkLayers[i]).toggleClass('toBG');//reduce layer z-index
            }
            return $darkLayers;
        }   
         
        //bring chosen image container to the top
        function bringToTheFront(img) { 
            if (!flags.useNavig) { //if layers reordering started after a click on an image 
                var $this = $(img),
                    $self = $this.parent('div.container');
                    $navig.children('div.act').removeClass('act');          
                    $navig.children(':nth-child('+(length - $self.index('div.container'))+')').addClass('act');//highlight the appropriate navigation button
                    viewImg($this); //display the selected image in a lighbox
            } else { //if layers reordering statred after a click on a navigation button
                var $self = $(img);
                animateLayersBunch(0.5 * windowW+main_left, 0.5 * windowH+main_top); //correction of layers position in a center of a screen
            }
                flags.allowParallax = 0;
                var current = $self[0].ind,
                    dif = length - 1 - current,
                    reOrderCont = [];               
                main.addClass('scale-me').removeClass('slide-me');//disallow "right-left" and "top-buttom" animation
                for (var i = 0; i < current+1; i++) { //determine new order of layers, which only moves forward
                    var ind = (i + dif) % length,
                    duration = (ind - i) * time.layer;
                    reOrderCont[ind] = bringOnlyToFront(Container[i], settings.scale[ind], indexZ[ind], duration);  
                    reOrderCont[ind].ind = ind;
                    if (flags.useNavig) {   
                        timer2 = setTimeout(function() { 
                            flags.allowParallax++;
                            flags.useNavig--;
                        }, 1.25 * (duration - time.layer));
                    }
                }
                 
                for (var ii = current+1; ii < length; ii++) { //determine new order of layers, which moves forward-back-forward
                    var ind = (ii + dif) % length,
                    durBefore = (length - 1 - ii) * time.layer,
                    durAfter = (ind) * time.layer;
                    reOrderCont[ind] = bringToFrontAndBack(Container[ii], settings.scale[ind], indexZ[ind], durBefore, durAfter);                   
                    reOrderCont[ind].ind = ind;
                    if (flags.useNavig) {   
                        timer3 = setTimeout(function() { 
                            flags.allowParallax++;
                            flags.useNavig--;
                            Math.floor(flags.allowParallax/length) * main.removeClass('scale-me').addClass('slide-me');
                        }, durBefore + time.scrn + time.delay + 300 + durAfter + time.invis);
                    }
                }
            return reOrderCont;
        }   
             
        function bringOnlyToFront(el, scaling, Zindex, duration0){ // animate image container, which moves forward only
            $dark_layer1.removeClass('l1'); // disable dark layers when an image is coming to the front
            $dark_layer2.removeClass('l2');                         
            if (smart && !settings.useJS) {
                $(el).css(trasitDur,time.layer+"ms").css(trasitDel,"0ms")
                    .css(transform, "scale("+scaling+","+scaling+")");
                } else {
                    el = scaleIE(scaling, el, duration0);
                }                   
                timer4 = setTimeout(function() { 
                    $(el).css({"zIndex" : Zindex});
                    $dark_layer1.addClass('l1');
                    $dark_layer2.addClass('l2');
                }, 1.25 * (duration0 - time.layer));
                 
                return el;
        }
     
        function bringToFrontAndBack(el, scaling, Zindex, duration1, duration2) { // animate image container, which moves forward -> back -> target position
            var ttt1 = duration1 + time.scrn; ttt2 = 0.5 * duration1;
            $(el).css("zIndex" , 90 * scaling); //the bigger is scale, the more z-index should be
            if (smart && !settings.useJS) {
                $(el).css(trasitDur,ttt1+"ms, "+time.scrn+"ms").css(trasitDel," 0ms, "+ttt2+"ms") //layer moves to the front
                    .css(transform, "scale(1,1)").css({"opacity" : 0});
            } else {
                el = scaleIE(1, el, ttt1);
                if (flags.isMobile) $(el).css({"opacity" :0}).css(trasitDur,time.scrn+"ms").css(trasitDel,ttt2+"ms");
            }
             
            timer5 = setTimeout(function() {
                $(el).css({"zIndex" : Zindex}); //layer disappears and moves back
                if (smart && !settings.useJS) {
                    $(el).css(trasitDur,"0ms").css(trasitDel,"0ms").css(transform, "scale(0.1,0.1)");
                } else {
                    el = scaleIE(0.1, el, 0);
                    if (!flags.isMobile) $(el).css("visibility" , "hidden");
                }
            }, duration1 + time.scrn + time.delay);
            var ttt3 = duration2 + time.invis; ttt4 = 0.5 * time.invis;
                 
            timer6 = setTimeout(function() { //layer is visible again and moves to its target position  
                if (smart && !settings.useJS) {
                    $(el).css(trasitDur,ttt3+"ms, "+ttt4+"ms").css(trasitDel," 0ms")
                    .css(transform, "scale("+scaling+","+scaling+")").css({"opacity" : 1});
                } else {
                    $(el).css("visibility" , "visible");
                    el = scaleIE(scaling, el, ttt3);
                    if (flags.isMobile) {
                        $(el).css({"opacity" : 1}).css(trasitDur,ttt4+"ms").css(trasitDel," 0ms");
                    } else {$(el).css("visibility" , "visible");}
                }
            }, duration1 + time.scrn + time.delay + 300);   
            return el;  
        }           
         
        //scale planes for old IE with help of JS, since it does not undertsand CSS3
        function scaleIE(scale, plane, time){ 
            var newscale = scale/plane.Scale;
            plane.Scale = scale;
            var inContW = plane.Wo,
                inContH = plane.Ho,
                inContT = parseFloat($(plane).css("top")),
                inContL = parseFloat($(plane).css("left")),
                images = $(plane).children('.photo'),
                ieW = Math.round(newscale * inContW),
                ieH = Math.round(newscale * inContH);
                 
            $(plane).animate({
                "width" : ieW,
                "height" : ieH,
                "top" : Math.round(inContT + 0.5 * (1 - newscale) * inContH),
                "left" : Math.round(inContL + 0.5 * (1 - newscale) * inContW)
            }, time);
             
            //for correct animateLayersBunch functioning
            plane.Wo = ieW;
            plane.Ho = ieH;
            var images_length = images.length;
            for (var j = 0; j < images_length; j++){
                 
                var inImW = parseFloat($(images[j]).css("width")), //.css('width') instead of .width() - to satisfy both IE8 and IE9
                    inImH = parseFloat($(images[j]).css("height")),
                    inImT = parseFloat($(images[j]).css("top")),
                    inImL = parseFloat($(images[j]).css("left"));
             
                if (!$(images[j]).hasClass('show')) {   
                    $(images[j]).animate({
                        "width" : Math.round(newscale * inImW),
                        "height" : Math.round(newscale * inImH),
                        "top" : Math.round(newscale * inImT),
                        "left" : Math.round(newscale * inImL)
                    }, time); 
                } 
            }
            return plane;
        }
         
        function scaleContainers(i) { //apply scaling to containers and lightbox black background
            var l3_scale = Math.round((100 / settings.scale[0])) / 100;
            $(Container[i]).css(transform, "scale("+settings.scale[i]+","+settings.scale[i]+")")
                            .children('div.dark-layer').css(transform, "scale("+l3_scale+","+l3_scale+")");
        }   
                     
        // launch slider script 
        function launchSlideshow() { 
            clearInterval(timer7); // clear the timer of image preloader
            $loading.css("display" , "none");
            Container = createContainers(Plane);
            if (settings.useJS *= flags.isMobile) main.addClass('useJS'); //use JS for mobile only
            if (smart && !settings.useJS) for (var k = 0; k < length; k++){
                scaleContainers(k);
            }
            drawCanvas(Plane);
            $('.erase-source').remove();
             
            resizePlanes(windowW/windowH);//calculate size and scale for all planes 
             
            if (!smart) {
                $closeX.css("display" , "none"); //hide static slideshow elements, until they are not required
                $caption.css("display" , "none")
            } else {
                settings.corner_w = Math.round(settings.corner_w / settings.scale[length - 1]); //image roll-over width considering css3 scale();
                settings.corner_l = Math.round(settings.corner_l / settings.scale[length - 1]);//image roll-over height considering css3 scale();
            }   
             
            //start animation only in case all containers are positioned
            if ($(Container[length - 1]).width()) { 
                /*animate the top container and position the rest of layers according to its position*/
                main.on('click',function(ev){
                    if ((flags.allowParallax == length)&& (!$(ev.target).hasClass("act"))) {
                        var targ = findOnClickImage(Container, ev);
                        if (targ) {
                            Container = bringToTheFront(targ); //bring container with the target image to the front
                        }                       
                    }
                });
            }   
             
            // launch container scroll animation for desktop
            if (!flags.isMobile){
                main.on('mousemove',function(ex){ 
                    animateLayersBunch(ex.pageX, ex.pageY);
                });
     
                main.children('div.container').children('.photo').on('click', function() {
                    if ($(this).parent(".container")[0] == Container[length - 1])  // necessary for IE: it has all layers clickable
                        viewImg($(this));
                });
                 
                main.children('div.container').children('canvas.corners').on('click touchend',function(){
                    viewImg($hovered);
                });
                main.children('div.container').children('.photo').not('.top-slice').on('mouseenter', function(evnt) { // image "corners" roll-over
                    $hovered = $(evnt.target);
                    if(($hovered.parent(".container")[0] == Container[length - 1]) && (!$hovered.hasClass('top-slice'))) { // necessary for IE: it has all layers clickable
                        drawCorners($hovered);
                    }
                });
                 
            // launch container scroll animation for mobile 
            } else {
                animateLayersMobile();
                main.children('div.container').children('.photo').on('touchend', function() {
                    if (!flags.scrolling)  // prevent click if touchmove, or if previous lightbox image animation is not finished yet
                        viewImg($(this));
                });
            }
          
            $navig.children('div').on('click touchend',function(){ //reorder layers in accordance with navigation button that had been clicked
              layersNavig($(this));
            });
            return main;    
        }
             
        // view a single image in a lightbox
        function viewImg($IMG) {
            if (!$IMG.hasClass('show') && (flags.allowParallax == length)) { //first click - to open lightbox
                flags.isLightbox = true; 
                flags.allowParallax = 0;
                inImW = $IMG.width(); //determine image width, height, top and left position
                inImH = $IMG.height();
                inImT = parseFloat($IMG.css("top"));
                inImL = parseFloat($IMG.css("left"));
                $parent = $IMG.parent(); //determine layer which contains the target image
                sc = settings.scale[length-1];
                inScale = settings.scale[$parent[0].ind];
                $dark_bg = $IMG.siblings('.dark-layer').addClass('l3'); //display black lightbox background
     
                main[0].ontouchstart = function(evdef){
                    evdef.preventDefault();//prevent bouncing on touch devices
                }
                             
                var parentT = parseFloat($parent.css("top")), //determine image parent layer width, height, top and left position
                    parentL = parseFloat($parent.css("left")),
                    parentW = $parent[0].Wo,
                    parentH = $parent[0].Ho;
                    main.addClass('lightbox');
                 
                if ($IMG.data('descr')) {$caption_text.html($IMG.data('descr'));}
                $IMG.addClass('show top-slice');
                imgFitScreen($IMG, inImW, inImH, sc, inScale, parentW, parentH, parentL, parentT, $dark_bg); //display the image in lightbox. If the image is too large, downscale  
                if (smart && !settings.useJS) {
                    $IMG.css(transform, "scale("+lightbox_sc+","+lightbox_sc+")");
                    $dark_bg.css({"width" : windowW, "height" : windowH, //set the appropriate size and position of lightbox black background
                                "left" : Math.round((0.5 * (parentW - windowW) * (inScale - 1) - parentL) / inScale), 
                                "top" : Math.round((0.5 * (parentH - windowH) * (inScale - 1) - parentT) / inScale)
                    });
                } else {
                    $IMG.siblings('span').css("opacity" , 0);
                    $dark_bg.css({"width" : windowW, "height" : windowH, 
                        "left" :    Math.round(-parentL - 0.5 * (1 - sc / inScale) * parentW), 
                        "top" : Math.round(-parentT - 0.5 * (1 - sc / inScale) * parentH),
                        "display" : "none"
                    });
                }
                $(window).resize(function() {
                    if (flags.isLightbox && smart) {
                        main_left = main.offset().left;
                        main_top = main.offset().top;
                        makeEasyReposition();
                        parentT = parseFloat($parent.css("top"));   
                        parentL = parseFloat($parent.css("left"));
                        imgFitScreen(main.children('div.container').children('.show.top-slice'), inImW, inImH, sc, inScale, parentW, parentH, parentL, parentT, $dark_bg);  //otherwise, it caches all IMGs
                    }
                });
                $closeX.on('mouseover', function(){
                    $closeX.addClass('hovered'); //remove delay of opacity animation
                })
                $closeX.on('click touchend', function() { // 'close' button is pressed
                    viewImg($IMG)
                }); 
                $(document).keyup(function(e) {
                    if (e.keyCode == 27) viewImg($IMG);   // ESC is pressed
                });
                return true;
                     
            } else if ($IMG.hasClass('show') && (Container.length == length) && ($closeX[0].offsetWidth)) { //second click - to close lightbox
                main[0].ontouchstart = function(evdef){
                    return true;
                }
                 
                main.removeClass("lightbox"); 
                $closeX.removeClass('hovered'); // add delay of opacity animation
                $IMG.siblings(".dark-layer").removeClass('l3'); 
                $caption_text.empty();
                /*put the image back to its initial position*/
                if (smart && !settings.useJS) {
                    $IMG.removeClass('show').css({"left" : Math.round(inImL), "top" : Math.round(inImT), "maxWidth" : "none", "maxHeight" : "none"}).css(transform, "none");
                } else { 
                    $IMG.removeClass('show').animate({
                        "left" : Math.round(sc * inImL / inScale), "top" : Math.round(sc * inImT / inScale), 
                        "width" : Math.round(sc * inImW / inScale), "height" : Math.round(sc * inImH / inScale)}, 400)
                        .css({"maxWidth" : "none", "maxHeight" : "none"});
                    $closeX.fadeOut();
                    $dark_bg.fadeOut();
                    $caption.fadeOut();
                }
                    timer1 = setTimeout(function() { 
                        $IMG.removeClass('top-slice');
                        flags.allowParallax = length; // important. It is possible to unclick an image while container still are being reordered 
                        flags.isLightbox = false;
                        flags.antiStumble = true;
                        main.removeClass('scale-me').addClass('slide-me');
                         
                    }, 400);
                return true;    
            }
        }           
     
        //display the image in lightbox. If the image is too large, downscale
        function imgFitScreen($Img, inImgW, inImgH, sc, inScle, parntW, parntH, parntL, parntT, $darkbg) {
            var w, h, 
                $closeX_left = 20,
                ifsmart = (smart * !settings.useJS) + (!smart + settings.useJS) * inScle;
            if ((inImgW/ifsmart > windowW)||(inImgH/ifsmart > (windowH - 110))) { //if image does not fit the viewport
                if ((inImgW/inImgH) > (windowW/windowH)) { //if the image is wider than the window
                    var maxW = windowW - 2 * $closeX.width(),//calculate image max-width, max-height
                        maxH = Math.round((windowW - 2 * $closeX.width()) * inImgH / inImgW);
                    $closeX_left = 0.5 * $closeX.width();
                } else {//if the image is higher than the window
                    var maxW = Math.round((windowH - 110) * inImgW / inImgH), //calculate image max-width, max-height
                        maxH = windowH - 110;
                }
                $Img.css({"maxHeight" : maxH, "maxWidth" : maxW});//do not use "auto" because of Opera
                w = maxW * ifsmart;
                h = maxH * ifsmart;
            } else {//if image fits the viewport, do nothing with its width and height
                w = inImgW;
                h = inImgH;
            }
             
            //finally, display the image in the lightbox, with image real size or as large as possible 
            if (smart && !settings.useJS) { 
                $Img.css({
                  "left" : Math.round(0.5 * (windowW - w * sc - 2 * parntL - parntW * (1 - sc)) / sc), 
                  "top" : Math.round(0.5 * (windowH - h * sc - 2 * parntT - parntH * (1 - sc)) / sc)
                });
            } else {
                $Img.animate({
                    "left" :    Math.round(-parntL - 0.5 * (1 - sc / inScle) * parntW + 0.5 * (windowW - w / inScle)), 
                    "top" : Math.round(-parntT - 0.5 * (1 - sc/inScle) * parntH + 0.5 * (windowH - h / inScle)),
                    "width" : Math.round((w / inScle)),
                    "height" : Math.round((h / inScle))
                }, 850,function(){$closeX.delay(700).fadeIn(400);
                    $darkbg.delay(700).fadeIn(400);
                    $caption.delay(700).fadeIn(400);
                });      
            }   
             
            //display "close" button and text caption
            $caption.css("top" , Math.round(0.5 * (windowH + h / ((smart * !settings.useJS) + (!smart + settings.useJS) * inScle))));       
            $closeX.css({"top" : Math.round(0.5 * (windowH - h / ((smart * !settings.useJS) + (!smart + settings.useJS) * inScle))), 
                        "left" : Math.round(0.5 * w / ((smart * !settings.useJS) + (!smart + settings.useJS) * inScle) + $closeX_left)
            });
            return $Img;
        }           
         
        // navigation buttons functioning
        function layersNavig($ths) { 
            if ((flags.allowParallax >= length) && (!$ths.hasClass('act'))) { //if it allowed to reorder layers
                animateLayersMobile();
                flags.useNavig = length;
                var actind = length - $navig.children('.act').index(), //determine new order of layers
                    curind = length - $ths.index(),
                    difr = length - 1 - actind;
                $navig.children('.act').removeClass('act');
                $ths.addClass('act'); //highlight new target navigation button
                Container = bringToTheFront($(Container[(curind + difr) % length]));//bring the appropriate layer to teh front
            }
        }   
         
        //destroy the slideshow
        function totalDestroy () {
            clearTimeout(timer1);
            clearTimeout(timer2);
            clearTimeout(timer3);
            clearTimeout(timer4);
            clearTimeout(timer5);
            clearTimeout(timer6);
            clearTimeout(timer7);
            clearInterval(timer8);
            main.children('div.container').children('.photo').off("click");
            $closeX.off("click");
            main.off("click");
            main.off("mousemove");
            main.children('div.container').children('.photo').off('mouseenter');
            main.children('div.container').children('.photo').off('mouseleave');
            !flags.isMobile * main.children('div.container').children('canvas.corners').off('click');
            $dark_layer1.remove();
            $dark_layer2.remove();
            $closeX.remove();
            $caption.remove();
            Container.remove();
        }   
        return start(); //run the slideshow script and return "main" - slideshow viewport element       
    }
 
    /* external sub-plugin for image loading */
    $.fn.loaded = function(callback, jointCallback, ensureCallback){
        var len = this.length;
        if (len > 0) {
            return this.each(function() {
                var el      = this,
                    $el     = $(el),
                    blank   = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                 
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
 
 
 
});
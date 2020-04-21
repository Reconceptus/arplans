// detect ie
// Get IE or Edge browser version
var version = detectIE();

/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}

if (version){
    if(version < 11){
        document.getElementById('wrapper').innerHTML = 'This version is not supported';
    };
    document.getElementById('wrapper').classList.add('ie');
}

// device js
/*! current-device js */
/* @see https://github.com/matthewhudson/current-device */

!function(n,e){"object"==typeof exports&&"object"==typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?exports.device=e():n.device=e()}(window,function(){return function(n){var e={};function o(t){if(e[t])return e[t].exports;var i=e[t]={i:t,l:!1,exports:{}};return n[t].call(i.exports,i,i.exports,o),i.l=!0,i.exports}return o.m=n,o.c=e,o.d=function(n,e,t){o.o(n,e)||Object.defineProperty(n,e,{configurable:!1,enumerable:!0,get:t})},o.r=function(n){Object.defineProperty(n,"__esModule",{value:!0})},o.n=function(n){var e=n&&n.__esModule?function(){return n.default}:function(){return n};return o.d(e,"a",e),e},o.o=function(n,e){return Object.prototype.hasOwnProperty.call(n,e)},o.p="",o(o.s=1)}([function(n,e,o){"use strict";o.r(e);var t="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(n){return typeof n}:function(n){return n&&"function"==typeof Symbol&&n.constructor===Symbol&&n!==Symbol.prototype?"symbol":typeof n},i=window.device,r={},a=[];window.device=r;var c=window.document.documentElement,d=window.navigator.userAgent.toLowerCase(),u=["googletv","viera","smarttv","internet.tv","netcast","nettv","appletv","boxee","kylo","roku","dlnadoc","roku","pov_tv","hbbtv","ce-html"];function l(n){return-1!==d.indexOf(n)}function s(n){return c.className.match(new RegExp(n,"i"))}function f(n){var e=null;s(n)||(e=c.className.replace(/^\s+|\s+$/g,""),c.className=e+" "+n)}function b(n){s(n)&&(c.className=c.className.replace(" "+n,""))}function p(){r.landscape()?(b("portrait"),f("landscape"),w("landscape")):(b("landscape"),f("portrait"),w("portrait")),h()}function w(n){for(var e in a)a[e](n)}r.macos=function(){return l("mac")},r.ios=function(){return r.iphone()||r.ipod()||r.ipad()},r.iphone=function(){return!r.windows()&&l("iphone")},r.ipod=function(){return l("ipod")},r.ipad=function(){return l("ipad")},r.android=function(){return!r.windows()&&l("android")},r.androidPhone=function(){return r.android()&&l("mobile")},r.androidTablet=function(){return r.android()&&!l("mobile")},r.blackberry=function(){return l("blackberry")||l("bb10")||l("rim")},r.blackberryPhone=function(){return r.blackberry()&&!l("tablet")},r.blackberryTablet=function(){return r.blackberry()&&l("tablet")},r.windows=function(){return l("windows")},r.windowsPhone=function(){return r.windows()&&l("phone")},r.windowsTablet=function(){return r.windows()&&l("touch")&&!r.windowsPhone()},r.fxos=function(){return(l("(mobile")||l("(tablet"))&&l(" rv:")},r.fxosPhone=function(){return r.fxos()&&l("mobile")},r.fxosTablet=function(){return r.fxos()&&l("tablet")},r.meego=function(){return l("meego")},r.cordova=function(){return window.cordova&&"file:"===location.protocol},r.nodeWebkit=function(){return"object"===t(window.process)},r.mobile=function(){return r.androidPhone()||r.iphone()||r.ipod()||r.windowsPhone()||r.blackberryPhone()||r.fxosPhone()||r.meego()},r.tablet=function(){return r.ipad()||r.androidTablet()||r.blackberryTablet()||r.windowsTablet()||r.fxosTablet()},r.desktop=function(){return!r.tablet()&&!r.mobile()},r.television=function(){for(var n=0;n<u.length;){if(l(u[n]))return!0;n++}return!1},r.portrait=function(){return screen.orientation&&Object.prototype.hasOwnProperty.call(window,"onorientationchange")?screen.orientation.type.includes("portrait"):window.innerHeight/window.innerWidth>1},r.landscape=function(){return screen.orientation&&Object.prototype.hasOwnProperty.call(window,"onorientationchange")?screen.orientation.type.includes("landscape"):window.innerHeight/window.innerWidth<1},r.noConflict=function(){return window.device=i,this},r.ios()?r.ipad()?f("ios ipad tablet"):r.iphone()?f("ios iphone mobile"):r.ipod()&&f("ios ipod mobile"):r.macos()?f("macos desktop"):r.android()?r.androidTablet()?f("android tablet"):f("android mobile"):r.blackberry()?r.blackberryTablet()?f("blackberry tablet"):f("blackberry mobile"):r.windows()?r.windowsTablet()?f("windows tablet"):r.windowsPhone()?f("windows mobile"):f("windows desktop"):r.fxos()?r.fxosTablet()?f("fxos tablet"):f("fxos mobile"):r.meego()?f("meego mobile"):r.nodeWebkit()?f("node-webkit"):r.television()?f("television"):r.desktop()&&f("desktop"),r.cordova()&&f("cordova"),r.onChangeOrientation=function(n){"function"==typeof n&&a.push(n)};var m="resize";function y(n){for(var e=0;e<n.length;e++)if(r[n[e]]())return n[e];return"unknown"}function h(){r.orientation=y(["portrait","landscape"])}Object.prototype.hasOwnProperty.call(window,"onorientationchange")&&(m="orientationchange"),window.addEventListener?window.addEventListener(m,p,!1):window.attachEvent?window.attachEvent(m,p):window[m]=p,p(),r.type=y(["mobile","tablet","desktop"]),r.os=y(["ios","iphone","ipad","ipod","android","blackberry","windows","fxos","meego","television"]),h(),e.default=r},function(n,e,o){n.exports=o(0)}]).default});

// svg-use
/*!
 * @copyright Copyright (c) 2017 IcoMoon.io
 * @license   Licensed under MIT license
 *            See https://github.com/Keyamoon/svgxuse
 * @version   1.2.6
 */
(function(){if("undefined"!==typeof window&&window.addEventListener){var e=Object.create(null),l,d=function(){clearTimeout(l);l=setTimeout(n,100)},m=function(){},t=function(){window.addEventListener("resize",d,!1);window.addEventListener("orientationchange",d,!1);if(window.MutationObserver){var k=new MutationObserver(d);k.observe(document.documentElement,{childList:!0,subtree:!0,attributes:!0});m=function(){try{k.disconnect(),window.removeEventListener("resize",d,!1),window.removeEventListener("orientationchange",
d,!1)}catch(v){}}}else document.documentElement.addEventListener("DOMSubtreeModified",d,!1),m=function(){document.documentElement.removeEventListener("DOMSubtreeModified",d,!1);window.removeEventListener("resize",d,!1);window.removeEventListener("orientationchange",d,!1)}},u=function(k){function e(a){if(void 0!==a.protocol)var c=a;else c=document.createElement("a"),c.href=a;return c.protocol.replace(/:/g,"")+c.host}if(window.XMLHttpRequest){var d=new XMLHttpRequest;var m=e(location);k=e(k);d=void 0===
d.withCredentials&&""!==k&&k!==m?XDomainRequest||void 0:XMLHttpRequest}return d};var n=function(){function d(){--q;0===q&&(m(),t())}function l(a){return function(){!0!==e[a.base]&&(a.useEl.setAttributeNS("http://www.w3.org/1999/xlink","xlink:href","#"+a.hash),a.useEl.hasAttribute("href")&&a.useEl.setAttribute("href","#"+a.hash))}}function p(a){return function(){var c=document.body,b=document.createElement("x");a.onload=null;b.innerHTML=a.responseText;if(b=b.getElementsByTagName("svg")[0])b.setAttribute("aria-hidden",
"true"),b.style.position="absolute",b.style.width=0,b.style.height=0,b.style.overflow="hidden",c.insertBefore(b,c.firstChild);d()}}function n(a){return function(){a.onerror=null;a.ontimeout=null;d()}}var a,c,q=0;m();var f=document.getElementsByTagName("use");for(c=0;c<f.length;c+=1){try{var g=f[c].getBoundingClientRect()}catch(w){g=!1}var h=(a=f[c].getAttribute("href")||f[c].getAttributeNS("http://www.w3.org/1999/xlink","href")||f[c].getAttribute("xlink:href"))&&a.split?a.split("#"):["",""];var b=
h[0];h=h[1];var r=g&&0===g.left&&0===g.right&&0===g.top&&0===g.bottom;g&&0===g.width&&0===g.height&&!r?(f[c].hasAttribute("href")&&f[c].setAttributeNS("http://www.w3.org/1999/xlink","xlink:href",a),b.length&&(a=e[b],!0!==a&&setTimeout(l({useEl:f[c],base:b,hash:h}),0),void 0===a&&(h=u(b),void 0!==h&&(a=new h,e[b]=a,a.onload=p(a),a.onerror=n(a),a.ontimeout=n(a),a.open("GET",b),a.send(),q+=1)))):r?b.length&&e[b]&&setTimeout(l({useEl:f[c],base:b,hash:h}),0):void 0===e[b]?e[b]=!0:e[b].onload&&(e[b].abort(),
delete e[b].onload,e[b]=!0)}f="";q+=1;d()};var p=function(){window.removeEventListener("load",p,!1);l=setTimeout(n,0)};"complete"!==document.readyState?window.addEventListener("load",p,!1):p()}})();

// touch-or-mouse
/*! Touch Or Mouse - v0.2 - 2014-10-10
 * Shared at https://gist.github.com/lmeurs/e5db12f0b3ef43f9cd65
 * Demonstrated at http://jsfiddle.net/lmeurs/uo4069nh
 * Discussed at http://stackoverflow.com/a/26145343/328272
 * Copyright (c) 2014 Laurens Meurs, wiedes.nl; Licensed MIT */
(function(e){"use strict";var t={ghostEventDelay:1e3};var n={init:function(n){var r=this;if(!r.data("touchOrMouse")){r.on("touchstart.touchOrMouse touchend.touchOrMouse",function(t){e(this).data("touchOrMouse").touchEventInProgress=t.type==="touchstart";e(this).data("touchOrMouse").lastTouchEventTimestamp=Date.now()}).data("touchOrMouse",{options:e.extend(t,n||{}),touchEventInProgress:false,lastTouchEventTimestamp:0})}return r},get:function(t){var n=this,r=n.data("touchOrMouse"),i=e(t.delegateTarget).data("touchOrMouse");if(!i){e(t.delegateTarget).data("touchOrMouse",i={})}var s=r.touchEventInProgress||r.lastTouchEventTimestamp>Date.now()-r.options.ghostEventDelay||t.type==="mouseleave"&&i.lastMouseEnterEventWasInvokedByTouch;if(t.type==="mouseenter"){i.lastMouseEnterEventWasInvokedByTouch=s}return s?"touch":"mouse"}};e.fn.touchOrMouse=function(e,t){return n[e].call(this,t)}})(jQuery);

// scripts
(function( $ ) {
    $.fn.projectGallery = function() {

        var $this = $(this),
            $dataForClone = $('.gallery-list',this).clone(),
            $data = $dataForClone[0].children,
            $elements = [],
            $current = 1,
            $firstVisible = 1,
            $lastVisible = 4,
            $listMargin = 0;

        for(var i = 0; i < $data.length; i++){
            $elements[i] = $data[i];
        }

        $(this).prepend('<div class="gallery-main"></div>');

        $('.gallery-main').append($elements);

        function itemLength() {
            if($('.gallery-list .item').length < 5){
                $('.buttons .up').hide();
                $('.buttons .down').hide();
            }
        }

        function defaultActiveItem() {
            $('.gallery-list .item').first().addClass('current');
            $('.gallery-main .item').first().addClass('current');
            $('.gallery-list .item:nth-child(-n+4)').addClass('visible');
        }

        function setActiveItem() {
            showInList();
            $('.current', $this).removeClass('current');
            $('[data-num="'+$current+'"]', $this).addClass('current');
            endAction();
        }

        function clickItem(item) {
            $current = item.attr('data-num');
            setActiveItem();
        }

        function clickArrowLR(dir) {
            $current = +$current;
            if(dir == 'next'){
                $current = $current + 1;
            }
            if(dir == 'prev'){
                $current = $current - 1;
            }
            setActiveItem();
        }

        function listMargin(dir) {
            if(dir == 'up'){
                $listMargin = $listMargin - 75;
            }
            if(dir == 'down'){
                $listMargin = $listMargin + 75;
            }
            return $listMargin+'%';
        }


        function showInList() {
            if($current > $lastVisible){
                $('.gallery-list').css('margin-top',listMargin('up'));

                $lastVisible = $lastVisible + 1;
                $firstVisible = $firstVisible + 1;
            }
            if($current < $firstVisible){
                $('.gallery-list').css('margin-top',listMargin('down'));
                $lastVisible = $lastVisible - 1;
                $firstVisible = $firstVisible - 1;
            }
        }

        function endAction() {
            $current == 1 ?
                $('.buttons .back').addClass('hide') :
                $('.buttons .back').removeClass('hide');

            $current == $elements.length ?
                $('.buttons .forw').addClass('hide') :
                $('.buttons .forw').removeClass('hide');
        }

        function addFancyBox() {
            var $item = $('.gallery-main .item'),
                $itemsCount = $('.gallery-main .item').length;

            for(var i = 0; i < $itemsCount; i++){
                var $itemAddress = $('figure',$item[i]).data('url-fancybox');
                var $galleryLink = '<a href="'+$itemAddress+'" data-fancybox="gallery"></a>';
                $('figure',$item[i]).append($galleryLink);
            }
        }

        itemLength();
        defaultActiveItem();
        setActiveItem();
        addFancyBox();
        $('.gallery-list .item').click(function () {
            clickItem($(this));
        });
        $('.buttons .back').click(function () {
            clickArrowLR('prev');
        });
        $('.buttons .forw').click(function () {
            clickArrowLR('next');
        });
    };
})(jQuery);

// functions
var project = {},
    scrollTop,
    scrollVar = 0,
    $html,
    $header,
    $search;

/* ----------------------------------- functions ----------------------------------- */

    /*
     ============= header fixed
    */

project.headerFixed = function(){
    scrollTop = $(window).scrollTop();

    if(scrollTop > scrollVar){
        $header.addClass('minimized');
        scrollVar = scrollTop;
    }
    else {
        $header.removeClass('minimized');
        scrollVar = scrollTop;
    }
};

    /*
     ============= home video height
    */

project.videoBoxHeight = function(){
    var $videoBox = $('.video-box'),
        $winHeight, $winWidth;

    function setMinHeight(){
        $winWidth = $(window).width();
        $winHeight = $(window).height();
        $winHeight = $winHeight - 60;
        if($winWidth <= 767){
            $videoBox.css('min-height',$winHeight+'px');
        }
        else {
            $videoBox.css('min-height',0);
        }
    }

    setMinHeight();

    $(window).resize(function () {
        setMinHeight();
    });

};

    /*
     ============= home tabs
    */

project.homeTabs = function(){
    $('[data-filter]').click(function () {
        var num = $(this).attr('data-filter');
        $('[data-filter-box]').removeClass('active');
        $('[data-filter]').removeClass('current');

        $('[data-filter-box='+num+']').addClass('active');
        $('[data-filter='+num+']').addClass('current');
    });
};

    /*
     ============= file input in support
    */

project.supportInputFile = function() {
    var input = document.getElementById( 'supportFileUpload' ),
        infoArea = document.getElementById( 'supportFileName' ),
        infoDefault = infoArea.dataset.default,
        removeFile = document.getElementById('supportFileRemove');

    input.addEventListener( 'change', showFileName );
    removeFile.addEventListener('click', removingFile);

    function showFileName( event ) {
        var input = event.srcElement;
        var fileName = input.files[0].name;

        infoArea.textContent = fileName;
        removeFile.classList.remove('hide');
    }

    function removingFile() {
        input.value = '';
        infoArea.textContent = infoDefault;
        removeFile.classList.add('hide');
    }
};

    /*
     ============= file input in contacts
    */

project.customInputFile = function() {
    var input = document.getElementById( 'customFileUpload' ),
        infoArea = document.getElementById( 'customFileName' ),
        infoDefault = infoArea.dataset.default,
        removeFile = document.getElementById('customFileRemove');

    input.addEventListener( 'change', showFileName );
    removeFile.addEventListener('click', removingFile);

    function showFileName( event ) {
        var input = event.srcElement;
        var fileName = input.files[0].name;

        infoArea.textContent = fileName;
        removeFile.classList.remove('hide');
    }

    function removingFile() {
        input.value = '';
        infoArea.textContent = infoDefault;
        removeFile.classList.add('hide');
    }
};

    /*
      ============= show more
    */

project.showMore = function() {
    var showMore = $('.show-more');

    showMore.each(function () {
        var $this = $(this),
            $thisParent = $this.closest('.show-more-parent'),
            $thisHideBlock = $thisParent.find('.show-more-hidden');

        $this.click(function () {
            $thisHideBlock.slideToggle(300);
            if($thisParent.hasClass('show')){
                $thisParent.removeClass('show');
            }
            else {
                $thisParent.addClass('show');
            }
        })

    })
};

    /*
      ============= alert message
    */

project.alertMessage = function(title,text) {
    var $customModal = $('.modal[data-modal="custom"]');
    bodyScrollLock.disableBodyScroll();
    if(title){
        $customModal.find('.modal-custom--title').html(title)
    }
    if(text){
        $customModal.find('.modal-custom--text').html(text)
    }
    $customModal.addClass('active');
};

    /*
     ============= show region dropbox
    */

project.regionDropBox = function() {
    var $dropBox = $('.region-dropbox'),
        $dropInput = $dropBox.find('input'),
        $dropLink = $dropBox.find('a');

    $dropInput.focus(function () {
        $dropBox.addClass('active')
    });
    $dropLink.click(function () {
        $dropBox.removeClass('active')
    });
};

    /*
     ============= project tabs
    */

project.tabsBox = function() {
    var $dropBox = $('.tabs-nav'),
        $dropInput = $dropBox.find('.selected'),
        $dropLink = $dropBox.find('label');

    $dropInput.click(function () {
        $dropBox.toggleClass('active');
    });
    $dropLink.click(function () {
        $dropBox.removeClass('active');
        $dropInput.text($(this).text())
    });
};

    /*
     ============= mapboxMarkers
    */

project.mapMarkers = function() {
    $('.map-box').on('click','.on-map',function () {
        var thisLink = $(this),
            thisMarker = thisLink.attr('data-map-object');
        if(thisMarker != undefined){
            $('.map-box .item').removeClass('current');
            thisLink.closest('.item').addClass('current');
            $('.map-box .scaled').removeClass('scaled');
            $('.map-box img[src*='+thisMarker+']')
                .parent()
                .addClass('scaled');
        }
    });

    $('.map-box').on('click','img[src*=custom_marker]',function () {

        $('.map-box img[src*=custom_marker]').parent().removeClass('scaled');

        var thisSrc = $(this).attr('src'),
            thisMarker = thisSrc.split('custom_')[1];

        $('.map-box img[src*='+thisMarker+']').parent().addClass('scaled');

        $('.map-box .item').removeClass('current');
        $('[data-map-object='+thisMarker+']').closest('.item').addClass('current');

        $('.map-box--aside').addClass('short');

    });

    $('.map-box').on('click','.show-all-btn',function () {

        $('.map-box--aside').removeClass('short');

    });
};


    /*
     ============= fixed sidebar
    */

project.fixedSidebar = function() {
    var $thisBar = $('.fixed-scrollbar'),
        $thisBox = $thisBar.find('.fixing'),
        $headerHeight = 180,
        $thisBarTopOffset,
        $thisBarLeftOffset,
        $needBarTopOffset,
        $barPosition,
        $barHeight,
        $barBoxHeight,
        $winScroll;

    function setOffsets() {
        $thisBarTopOffset = $thisBar.offset().top;
        $thisBarLeftOffset = $thisBar.offset().left;
        $barHeight = $thisBar.height();
        $barBoxHeight = $thisBox.height();
    }

    function setFixPosition() {
        $winScroll = scrollTop;
        $needBarTopOffset = $winScroll + $headerHeight;
        $barPosition = $needBarTopOffset - $thisBarTopOffset;

        if($needBarTopOffset >= $thisBarTopOffset){

            if($barHeight > ($barBoxHeight + $barPosition)){

                $thisBar.addClass('fixed');
                $thisBar.removeClass('bottom');
                $thisBox.css({
                    'top':$headerHeight+'px',
                    'left':$thisBarLeftOffset+'px'
                });
            }
            else {
                $thisBar.addClass('bottom');
                $thisBar.removeClass('fixed');
            }

        }
        else {
            $thisBar.removeClass('fixed');
        }

    }

    setOffsets();
    setFixPosition();

    $(window).resize(function () {
        setOffsets();
        setFixPosition();
    });

    $(window).scroll(function () {
        setOffsets();
        setFixPosition();
    });

    setTimeout(function () {
        setOffsets();
        setFixPosition();
    },500);

    $('.show-modal-filter').click(function () {
        $('.fixing').slideToggle(300);
    });
};

    /*
    ============= parsing text elements
   */

project.textImagesParcing = function () {
    $('.text-box img').each(function () {
        var $thisIMG = $(this);
        if($thisIMG.css('float') == 'left'){
            $thisIMG.addClass('left-align');
            $thisIMG.attr('style','');
        }
        if($thisIMG.css('float') == 'right'){
            $thisIMG.addClass('right-align');
            $thisIMG.attr('style','');
        }

    });
};


    /*
    ============= counter
   */

project.counter = function() {
    var counterBox = $('.counter');
    counterBox.each(function () {
        var $this = $(this),
            $this_plus = $this.find('.plus'),
            $this_minus = $this.find('.minus'),
            $this_result = $this.find('.result'),
            $this_value = $this_result.val();

        $this_minus.click(function () {
            if($this_value == 1){
                $this_value = $this_value - 1;
                $this_minus.addClass('disabled');
            }
            else if($this_value > 1) {
                $this_value = $this_value - 1;
            }
            $this_result.val($this_value);
        });

        $this_plus.click(function () {
            $this_value = +$this_value + 1;
            $this_minus.removeClass('disabled');
            $this_result.val($this_value);
        });
    });
};

/* ----------------------------------- plugins ----------------------------------- */

project.blogCarousel = function() {
    var $carouselBox = $('[data-owl="blog"]'),
        $carousel = $carouselBox.find('.owl-carousel');

    $carousel.owlCarousel({
        loop: false,
        nav: true,
        navText: ['',''],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2,
                margin: 20
            },
            1201: {
                items: 3,
                margin: 30
            },
            1367: {
                items: 3,
                margin: 50
            }
        }
    })
};

project.reviewCarousel = function() {
    var $carouselBox = $('[data-owl="reviews"]'),
        $carousel = $carouselBox.find('.owl-carousel');

    $carousel.owlCarousel({
        loop: true,
        nav: true,
        navText: ['',''],
        dots: false,
        navSpeed: 300,
        responsive: {
            0: {
                items: 1,
                margin: 20
            },
            601: {
                items: 4,
                margin: 30
            },
            1025: {
                items: 4,
                margin: 40
            },
            1201: {
                items: 4,
                mouseDrag: false,
                margin: 60
            }
        }
    })

    $('#t_prev').click(function () {
        $carouselBox.find('.owl-prev').click()
    })
    $('#t_next').click(function () {
        $carouselBox.find('.owl-next').click()
    })
    $('#t_prev').click();
};

project.projectsCarousel = function() {
    var $carouselBox = $('[data-owl="projects"]'),
        $carousel = $carouselBox.find('.owl-carousel');

    $carousel.owlCarousel({
        loop: false,
        nav: true,
        navText: ['',''],
        dots: false,
        responsive: {
            0: {
                items: 2,
                margin: 20
            },
            601: {
                items: 3,
                margin: 20
            },
            768: {
                items: 4,
                margin: 20
            },
            1025: {
                items: 5,
                margin: 20
            },
            1201: {
                items: 6,
                margin: 30
            },
            1367: {
                items: 7,
                margin: 30
            },
            1601: {
                items: 8,
                margin: 40
            }
        }
    })
};

project.likesCarousel = function() {
    var $carouselBox = $('[data-owl="likes"]'),
        $carousel = $carouselBox.find('.owl-carousel');

    $carousel.owlCarousel({
        loop: false,
        nav: true,
        navText: ['',''],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            800: {
                items: 2,
                margin: 30
            },
            1200: {
                items: 4,
                margin: 40
            }
        }
    })
};

project.planCarousel = function() {
    var $carouselBox = $('[data-owl="plans"]'),
        $carousel = $carouselBox.find('.owl-carousel');

    $carousel.owlCarousel({
        loop: false,
        nav: true,
        navText: ['',''],
        dots: false,
        items: 1
    });

    $('.plan-item [data-plan]').click(function () {
        var $thisPlan = $(this).data('plan');
        $('.gallery-items [data-plan='+$thisPlan+']').click();
    })
};

project.objectCarousel = function() {
    var $carouselBox = $('[data-owl="objects"]'),
        $carousel = $carouselBox.find('.owl-carousel');

    $carousel.owlCarousel({
        loop: true,
        nav: true,
        navText: ['',''],
        dots: false,
        items: 1,
        onTranslated: function (e) {
            var currentNum = $carousel.find('.owl-item.active .object-item').attr('data-num');
            $('#owlCurrent').text(currentNum)
        }
    });
};

project.partnerCarousel = function() {
    var $carouselBox = $('[data-owl="partner"]'),
        $carousel = $carouselBox.find('.owl-carousel');

    $carousel.owlCarousel({
        loop: true,
        nav: true,
        navText: ['',''],
        dots: true,
        items: 1
    });
};

project.customScroll = function() {
    $('.scrolled').each(function () {
        var $this = $(this);
        if($this.hasClass('catalog-filters') || $this.hasClass('catalog-filters--form')){
            if($(window).width() > 1200){
                $this.mCustomScrollbar({
                    theme: 'minimal-dark'
                });
            }
        }
        else {
            $this.mCustomScrollbar({
                theme: 'minimal-dark'
            });
        }

    });
};

project.initProjectGallery = function () {
    $('.project-gallery').projectGallery();
};

// scripts
!function(e,o){if("function"==typeof define&&define.amd)define(["exports"],o);else if("undefined"!=typeof exports)o(exports);else{var t={};o(t),e.bodyScrollLock=t}}(this,function(exports){"use strict";Object.defineProperty(exports,"__esModule",{value:!0});var n=!1;if("undefined"!=typeof window){var e={get passive(){n=!0}};window.addEventListener("testPassive",null,e),window.removeEventListener("testPassive",null,e)}var i="undefined"!=typeof window&&window.navigator&&window.navigator.platform&&/iPad|iPhone|iPod|(iPad Simulator)|(iPhone Simulator)|(iPod Simulator)/.test(window.navigator.platform),d=null,l=[],u=!1,c=-1,a=void 0,s=void 0,v=function(e){var o=e||window.event;return 1<o.touches.length||(o.preventDefault&&o.preventDefault(),!1)},t=function(){setTimeout(function(){void 0!==s&&(document.body.style.paddingRight=s,s=void 0),void 0!==a&&(document.body.style.overflow=a,a=void 0)})};exports.disableBodyScroll=function(r,e){var t;i?r&&!l.includes(r)&&(l=[].concat(function(e){if(Array.isArray(e)){for(var o=0,t=Array(e.length);o<e.length;o++)t[o]=e[o];return t}return Array.from(e)}(l),[r]),r.ontouchstart=function(e){1===e.targetTouches.length&&(c=e.targetTouches[0].clientY)},r.ontouchmove=function(e){var o,t,n,i;1===e.targetTouches.length&&(t=r,i=(o=e).targetTouches[0].clientY-c,t&&0===t.scrollTop&&0<i?v(o):(n=t)&&n.scrollHeight-n.scrollTop<=n.clientHeight&&i<0?v(o):o.stopPropagation())},u||(document.addEventListener("touchmove",v,n?{passive:!1}:void 0),u=!0)):(t=e,setTimeout(function(){if(void 0===s){var e=!!t&&!0===t.reserveScrollBarGap,o=window.innerWidth-document.documentElement.clientWidth;e&&0<o&&(s=document.body.style.paddingRight,document.body.style.paddingRight=o+"px")}void 0===a&&(a=document.body.style.overflow,document.body.style.overflow="hidden")}),d||(d=r))},exports.clearAllBodyScrollLocks=function(){i?(l.forEach(function(e){e.ontouchstart=null,e.ontouchmove=null}),u&&(document.removeEventListener("touchmove",v,n?{passive:!1}:void 0),u=!1),l=[],c=-1):(t(),d=null)},exports.enableBodyScroll=function(o){i?(o.ontouchstart=null,o.ontouchmove=null,l=l.filter(function(e){return e!==o}),u&&0===l.length&&(document.removeEventListener("touchmove",v,n?{passive:!1}:void 0),u=!1)):d===o&&(t(),d=null)}});

$(document).ready(function () {

    /* ----------------------------------- variables ----------------------------------- */

    $win = document.body;
    $html = $('html');
    $header = $('#header');
    $search = $('#searchForm');

    /* ----------------------------------- functions ----------------------------------- */

    /*
     ============= header burger
    */

    $('.burger').click(function () {
        if($header.hasClass('is-open')){
            $header.removeClass('is-open');
            $html.removeClass('ovh');
        }
        else {
            $header.addClass('is-open')
            $html.addClass('ovh');
        }
    });

    /*
     ============= modals open/close
    */

    $(document).on('click','.show-modal',function (e) {
        e.preventDefault();
        var $thisData = $(this).attr('data-modal');
        $('.modal[data-modal="'+$thisData+'"]').addClass('active');
        bodyScrollLock.disableBodyScroll();
    });

    $('.modal .close').click(function (e) {
        e.preventDefault();
        $('.modal').removeClass('active successful');
        bodyScrollLock.enableBodyScroll();
    });

    $('.modal[data-modal="custom"] .close').click(function (e) {
        var $customModal = $('.modal[data-modal="custom"]');
        $customModal.find('.modal-custom--title').html('');
        $customModal.find('.modal-custom--text').html('');
    });

    /*
     ============= close item on the map
    */

    $('.map-item .close').click(function () {
        $(this).closest('.map-item').removeClass('active');
    });

    /*
     ============= document click events
    */

    function documentClick() {
        $(document).click(function(e){
            var targ = $(e.target);
            // console.log(targ);

            if(targ.parents('#searchForm').length == 0){
                $search.removeClass('active-search');
            }
            else {
                $search.addClass('active-search');
            }

            if(targ.parents('.region-dropbox').length == 0){
                $('.region-dropbox').removeClass('active');
            }

        })
    }

    /*
     ============= copy ref link
    */

    var isPrevent = false;
    $('.copy-btn').click(function (e) {
        var _link = $(this).closest('.link');
        if (isPrevent){
            e.preventDefault;
        }
        else {
            _link.addClass('copied');
            isPrevent = true;
            setTimeout(function () {
                isPrevent = false;
                _link.removeClass('copied');
            },3000)
        }

    });

    /*
     ============= toggle ref link
    */

    $(document).on('click','.ref-link--toggle',function () {
        var _this = $(this),
            _ref = _this.closest('.ref-link');

        _ref.toggleClass('hidden');
    });

    /* --------------------------------- document load --------------------------------- */

    documentClick();
    project.headerFixed();

    if($('select').length > 0){}
    if($('[data-owl="blog"]').length > 0){
        project.blogCarousel();
    }
    if($('[data-owl="reviews"]').length > 0){
        project.reviewCarousel();
    }
    if($('[data-owl="projects"]').length > 0){
        project.projectsCarousel();
    }
    if($('[data-owl="likes"]').length > 0){
        project.likesCarousel();
    }
    if($('[data-owl="plans"]').length > 0){
        project.planCarousel();
    }
    if($('[data-owl="objects"]').length > 0){
        project.objectCarousel();
    }
    if($('[data-owl="partner"]').length > 0){
        project.partnerCarousel();
    }
    if($('input[type="file"]').length > 0){
        if($('#supportFileUpload').length > 0){project.supportInputFile();}
        if($('#customFileUpload').length > 0){project.customInputFile();}
    }
    if($('.text-box').length > 0){
        project.textImagesParcing();
    }
    if($('.video-box').length > 0){
        project.videoBoxHeight();
    }
    if($('.counter').length > 0){
        project.counter();
    }
    if($('.show-more').length > 0){
        project.showMore();
    }
    if($('.projects-filters').length > 0){
        project.homeTabs();
    }
    if($('.tabs-nav').length > 0){
        project.tabsBox();
    }
    if($('.region-dropbox').length > 0){
        project.regionDropBox();
    }
    if($('.map-box').length > 0){
        project.mapMarkers();
    }
    if($('.fixed-scrollbar').length > 0){
        project.fixedSidebar();
    }
    if($('.scrolled').length > 0){
        project.customScroll();
    }
    if($('.project-gallery').length > 0){
        project.initProjectGallery();
    }

    /* --------------------------------- document resize --------------------------------- */

    $(window).resize(function () {

    });

    /* --------------------------------- document scroll --------------------------------- */

    $(window).scroll(function (e) {
        project.headerFixed();
    });

});
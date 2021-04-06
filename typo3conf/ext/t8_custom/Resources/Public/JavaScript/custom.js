$(document).ready(function() {

    /** Navigation **/
    // on touch devices -> open subnav on first tap, open page if hasclass .hovered
    // -> users won't be able to open the hover-submenu (normal navigation) without that
    $('.navigation .navigation__link').on('touchstart', function(event){
        if (!$(this).parents('.navigation__item').hasClass('hovered') && $(this).siblings('.navigation__level2').length > 0) {
            event.preventDefault();
            $(this).parents('.navigation__item').addClass('hovered');
        }
    });

    // mobile Navigation
    $('.navigation__mobile__burger').click(function(){
        $(this).parents('.header__main').toggleClass('header__main--open');
        $(this).toggleClass('navigation__mobile__burger--open');
    });
    // mobile Navigation Submenu
    function findNavLevel(el, level) {
        if (level === undefined){
            level = 2;
        }
        if (el.parents('.navigation__level' + level).length > 0) {
            level++;
            return findNavLevel(el,level);
        } else {
            return level;
        }
    }
    $('.navigation__arrow').click(function(event){
        event.preventDefault();
        var level = findNavLevel($(this));
        var level2 = $(this).parents('.navigation__link').siblings('.navigation__level' + level),
            height = 0;
        level2.addClass('navigation__level'+level+'--in-progress');
        level2.children('.navigation__item').each(function(){
            height += $(this).outerHeight();
        });
        level2.css('height', height);
        level2.toggleClass('navigation__level'+level+'--open');
        $(this).toggleClass('navigation__arrow--open');

        setTimeout(function(){
            level2.removeClass('navigation__level'+level+'--in-progress');
            level2.parents('[class^="navigation__level"][class*="--open"]').each(function(){
                openMenuSetHeight($(this));
            });
        }, 300);
    });
    // set height if open on load (for animation)
    function openMenuSetHeight(el) {
        var level2 = el,
            height = 0;
        level2.children('.navigation__item').each(function(){
            height += $(this).outerHeight();
        });
        level2.css('height', height);
    }
    $('[class^="navigation__level"][class*="--open"]').each(function(){
        openMenuSetHeight($(this));
    });


    /** Lightbox **/
    // http://lokeshdhakar.com/projects/lightbox2/#options
    function applyLightboxFunctionality() {
        lightbox.option({
            'albumLabel': "%1 / %2"
        });
    }
    applyLightboxFunctionality();


    /** Videos (Plyr) **/
    // Videos: Konfiguration für reguläre Inhaltselemente
    function videos() {
        $('.video__video').each(function() {
            if ($(this).find('iframe').length > 0) {
                var src = $(this).find('iframe').attr('src');
                if (src.includes('youtube.com') || src.includes('youtube-nocookie.com') || src.includes('youtu.be')) {
                    src += '&playsinline=1';
                    $(this).find('iframe').attr('src',src);
                }
            }
            /*if ($(this)[0].hasAttribute('autoplay')) {
                $(this).prop("muted",true);
            }*/
        });
        const players = Plyr.setup(document.querySelectorAll('.video__video'), {
            // https://github.com/sampotts/plyr#options
            // controls: [],
            //hideControls: true,
            /*autoplay: true,
            playsinline: true,
            clickToPlay: true,
            //controls: ["play", "progress", "mute", "fullscreen"],
            controls: [],
            hideControls: true,
            debug: false,
            loop: { active: true },
            fullscreen: { enabled: false }*/
        });

        if (players) {
            players.forEach(function(instance) {
                /**
                 * Fixes pausing on click on mobile
                 * https://github.com/sampotts/plyr/issues/718
                 */
                var videoWrapper = document.getElementsByClassName("plyr__video-wrapper")[0];
                videoWrapper.addEventListener("click", function (event) {
                    instance.togglePlay();
                    event.stopPropagation(); // Necessary or the video will toggle twice => no playback
                });
                instance.toggleControls(false);
            });
        }
    }
    videos();


    /*** Tables ***/
    $('.ce-bodytext td, .ce-bodytext th').addClass(function() {
        return $.trim(this.textContent).length > 20
               ? 'td--allowlinebreak'
               : null;
    });


    /** Totop Button **/
    // einblenden
    function totopFunctionality() {

        var toTopButton = $('.totop-button');
        var tolerance = 50;
        var elOffScreenHeight = $('.header').outerHeight() + tolerance;

        $(window).scroll(function() {
            if ($(window).scrollTop() > elOffScreenHeight) {
                toTopButton.addClass('totop-button--visible');
            } else {
                toTopButton.removeClass('totop-button--visible');
            }
        });
    }
    totopFunctionality();


    /** Scrollslider **/
    function slide(slider, sliderPos) {
        slider.attr('data-pos', sliderPos);

        if ('scroll-behavior' in document.documentElement.style === false) {
            slider.stop().animate({
              scrollLeft: slider[0].scrollLeft + slider.children('*:nth-child('+sliderPos+')').position().left
          }, 350);
        } else {
            slider.stop().animate({
              scrollLeft: slider[0].scrollLeft + slider.children('*:nth-child('+sliderPos+')').position().left
          }, 0);
        }
    }
    $('.scrollslider__btn').click(function(){
        var slider = $(this).parents('.scrollslider__nav').siblings('.scrollslider__inner'),
            sliderPos = slider.attr('data-pos'),
            sliderItemNumber = slider.children().length;
        
        if($(this).hasClass('scrollslider__btn--prev')) {
            if (sliderPos == 1) {
                sliderPos = sliderItemNumber;
            } else {
                sliderPos--;
            }
        } else {
            if (sliderPos == sliderItemNumber) {
                sliderPos = 1;
            } else {
                sliderPos++;
            }
        }
        slide(slider, sliderPos);
    });
    $('.scrollslider__dots__item').click(function(){
        var slider = $(this).parents('.scrollslider__dots').siblings('.scrollslider__inner'),
            sliderPos = $(this).index() + 1;

        slide(slider, sliderPos);
    });
    $('.scrollslider__inner').scroll(function() {
        clearTimeout($.data(this, 'scrollTimer'));
        $.data(this, 'scrollTimer', setTimeout(function() {
            // do something
            checkScrollPos();
        }, 10));
    });
    // update dots on horizontal scroll
    function checkScrollPos() {
        $('.scrollslider__inner').each(function(){
            var slider = $(this),
                sliderPos = slider.scrollLeft(),
                sliderElOffsets = [],
                parentOffset = slider.offset().left;

            slider.children().each(function(){
                var offset = $(this).offset();
                sliderElOffsets.push(offset.left - parentOffset);
            });

            /* find closest to 0 */
            var activeValue = sliderElOffsets.reduce(function(prev, curr) {
                return (Math.abs(curr - 0) < Math.abs(prev - 0) ? curr : prev);
            });

            activeChild = arraySearch(sliderElOffsets,activeValue) + 1;
            /*console.log(sliderElOffsets);
            console.log(activeValue);
            console.log(activeChild);*/

            slider.attr('data-pos', activeChild);
            slider.siblings('.scrollslider__dots').find('.scrollslider__dots__item').removeClass('scrollslider__dots__item--active');
            slider.siblings('.scrollslider__dots').find('.scrollslider__dots__item:nth-child('+activeChild+')').addClass('scrollslider__dots__item--active');
            slider.children().removeClass('scrollslider__item--active');
            slider.children('*:nth-child('+activeChild+')').addClass('scrollslider__item--active');
        });
    }
    checkScrollPos();
    function arraySearch(arr,val) {
        for (var i=0; i<arr.length; i++)
            if (arr[i] === val)
                return i;
        return false;
    }
    
    /* Object Fit fallback (used in scroll slider, news detail page) */
    // IE/Edge fallback for responsive images while 'object-fit' property is not supported
    function ObjectFitIt() {
        $('.news-detail__media .imageslider__image').each(function(){
            var imgSrc = $(this).attr('src');
            var fitType = 'contain';
            /*if($(this).data('fit-type')) {
                fitType = $(this).data('fit-type');
            }*/
            $(this).parent().css({ 'background' : 'transparent url("'+imgSrc+'") no-repeat left center/'+fitType, });
            $(this).css('opacity','0');
        });
    }
    if('objectFit' in document.documentElement.style === false) {
        ObjectFitIt();
    }

    /** Powermail, show uploaded File Name **/
    function powermailFileUploadLabel(){
        var inputs = document.querySelectorAll( '.form__input--file' );
        Array.prototype.forEach.call( inputs, function( input )
        {
            var label    = input.nextElementSibling;
            var labelVal = label.lastChild.innerHTML;

            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '#count#', this.files.length );
                else
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    label.lastChild.innerHTML = fileName;
                else
                    label.lastChild.innerHTML = labelVal;
            });
        });
    }
    powermailFileUploadLabel();

    /** Google Analytics Opt Out **/
    // google analytics opt out (impressum, opt out function in site template)
    $('[href$="#gaOptout"]').click(function(){
        gaOptout();
    });

    /** Cookie Banner **/
    setTimeout(function(){
        if ($('#cc-notification').length > 0) {
            var bannerHeight = $('#cc-notification').outerHeight();
            $('.footer').css('padding-bottom', bannerHeight + 'px');
            $('.totop-button').css('margin-bottom', bannerHeight + 'px');
        }
    }, 500);
    // Background image Player if Cookies not accepted
    $('.video__video').find('.image_off').each(function(){
        var image = $(this).parents('.video__video').attr('data-preview');
        $(this).css('background-image', 'url('+image+')');
    });

    /** Animated anchor scroll **/
    $('a[href^="#"]').on('click', function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top }, 750);
    });
    $('a[href*="#"]').on('click', function(event){
        var url = window.location.pathname,
            href = $(this).attr('href').split('#')[0];
        if (url == href) {
            // same page
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top }, 750);
        }
    });

});

// Check scroll position on page load -> show totopButton if is scrolled on load
window.addEventListener('load', function() {
    if ( document.documentElement.scrollTop > 0 ) {
        // show totop button if scroll position is grater than 0
        $('.totop-button').addClass('totop-button--visible');
    }
});

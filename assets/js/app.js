import infiniteMarquee from "https://cdn.skypack.dev/infinite-marquee@1.0.7";

$(document).ready(function () {

    let mm = gsap.matchMedia();

    const lenis = new Lenis({
        duration: .5,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // https://www.desmos.com/calculator/brs54l4xou
        direction: 'vertical', // vertical, horizontal
        gestureDirection: 'vertical', // vertical, horizontal, both
        smooth: true,
        // mouseMultiplier: 1,
        smoothTouch: false,
        // touchMultiplier: 2,
        infinite: false,
        prevent: (node) => node.classList.contains('woocommerce-MyAccount-navigation')
    });

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    };
      
    requestAnimationFrame(raf);

    lenis.on('scroll', (e) => {
        
        // // console.log(e);
        // if(e.direction == 1){
        //     circleTl.timeScale( (1 *  e.velocity/2) + 1);
        // }
        
    });

    lenis.stop();

    barba.use(barbaPrefetch);

    barba.init({
        preventRunning: true,
        prevent: ({el, event, href}) => {
            const hrefToReload = ['my-account', 'checkout', 'cart', 'product', 'shop'];
            let currentUrl = window.location.href;

            return hrefToReload.some(url => href.includes(url)) || hrefToReload.some(url => currentUrl.includes(url));
        },
        transitions: [{
            name: 'switch',
            once({current, next, trigger}) {
                console.log('GLOBAL ONCE');
                
                if($('.curtain').length){

                var introAnim = gsap.timeline({
                    paused: true,
                    onComplete: function(){
                        lenis.start();
                        $('.curtain').removeClass('curtain__logo--is-animating');
                        gsap.set('.curtain', {'--top-left-clip': '100%', '--top-right-clip': '100%', '--bottom-left-clip': '100%', '--bottom-right-clip': '100%'});
                    }
                });

                introAnim   .to('.curtain', {duration: .75, '--top-left-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top')
                            .to('.curtain', {duration: .75, '--top-right-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top+=.05')
                            .fromTo('.curtain__logo', {duration: .75, autoAlpha: 0}, {autoAlpha: 1}, 'bottom-to-top+=.25')
                            .set('.curtain', {className: 'curtain curtain__logo--is-animating'}, 'bottom-to-top+=.1')
                            .set('.white-curtain', {autoAlpha: 0, display: 'none'}, 'bottom-to-top+=1.05')
                            .to('.curtain', {duration: .75, '--bottom-left-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top+=1')
                            .to('.curtain', {duration: .75, '--bottom-right-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top+=1.05');
                
                
                introAnim.play();

                } else {
                    lenis.start();
                };
                
               
                mobileNav(); 
                topbar();
                topBarMArquee();
                accountNav();
                preventLenis();
                footer();
                wrapBtnContent();
                preventSamePageReload();
            
            },
            leave({current, next, trigger}) {
                console.log('GLOBAL LEAVE');

               return new Promise(resolve => {
                    const leavingAnim = gsap.timeline({
                        onComplete(){
                            resolve();
                        }
                    });

                    leavingAnim .to('.curtain', {duration: .75, '--top-left-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top')
                                .to('.curtain', {duration: .75, '--top-right-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top+=.05')
                                .fromTo('.curtain__logo', {duration: .75, autoAlpha: 0}, {autoAlpha: 1}, 'bottom-to-top+=.25')
                                .set('.curtain', {className: 'curtain curtain__logo--is-animating'}, 'bottom-to-top+=.1')
                                .set(current.container, { autoAlpha: 0, display: 'none'})
                                .set('.white-curtain', {autoAlpha: 0, display: 'none'}, 'bottom-to-top+=1.05');
                });
            },
            beforeLeave({current, next, trigger}){
                console.log('GLOBAL BEFORE LEAVE');

                
                
            },
            beforeEnter({current, next, trigger}) {
                console.log('GLOBAL BEFORE ENTER');

                window.scrollTo(0, 0);

                killAllScrollTrigger();
                preventSamePageReload();
                gsap.set('.topbar__logo__letter, .footer__logo g', {clearProps: 'all'});
                topbar();
                footer();

            },
            enter({current, next, trigger}) {
                console.log('GLOBAL ENTER');

                console.log(current);
                console.log(next);
                console.log(trigger);

               return new Promise(resolve => {
                    
                    const enterAnim = gsap.timeline({
                        onComplete(){
                            resolve();
                            
                            $('.curtain').removeClass('curtain__logo--is-animating');
                            gsap.set('.curtain', {'--top-left-clip': '100%', '--top-right-clip': '100%', '--bottom-left-clip': '100%', '--bottom-right-clip': '100%', clearProps: '--curtain-bg'});

                            if (next.url.hash != undefined) {
                                gsap.to(window, { duration: 1, scrollTo: {offsetY: ()=>{return ($('.topbar').innerHeight() - 24.6)}, y: '#' + next.url.hash }, ease: Power4.easeInOut });
                            };
                        }
                    });

                    enterAnim   .fromTo(next.container, 0, {autoAlpha: 0}, {autoAlpha: 1, ease: Expo.easeInOut})
                                .to('.curtain', {duration: .75, '--bottom-left-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top')
                                .to('.curtain', {duration: .75, '--bottom-right-clip': 0, ease: Expo.easeInOut}, 'bottom-to-top+=.05');
                });
            },
        }],
        views: [{
            namespace: 'home',
            beforeEnter(data) {
                var cf7Form = $(data.next.container).find('.wpcf7-form')[0];

                setTimeout(function(){

                    scrollHeader();
                    introBlock();
                    // scrollProducts();
                    regionSlider();
                    socialMarquee();
                    curtainColor();
                    pastaForm();
                    popup();
                    socialMarquee();
                    reInitCF7(cf7Form);
                    changeBrowserColor('#FFD12D');

                }, 200);
                
            }
        },{
            namespace: 'single-product',
            beforeEnter(data) {
                
                setTimeout(function(){
                    var productColor = $('.section--single-product').data('color');

                    dropdowns();
                    productSwiper();
                    changeBrowserColor(productColor);

                }, 200);
            }
        },{
            namespace: 'single-pasta',
            beforeEnter(data) {
                
                setTimeout(function(){
                    var productColor = $('.section--single-product').data('color');

                    productSwiper();
                    changeBrowserColor(productColor);

                }, 200);
            }
        },{
            namespace: 'page',
            beforeEnter(data) {
                setTimeout(function(){

                    doDontScroll();
                    dropdowns();
                    changeBrowserColor('#FFD12D');

                }, 200);
            }
        }]


    },
    
    );

    // topbar();
    // mobileNav();
    // scrollHeader();
    // scrollProducts();
    // footer();
    // introBlock();
    // regionSlider();
    // socialMarquee();
    // curtainColor();
    // pastaForm();
    // productSwiper();



    function topbar(){

        // ScrollTrigger.create({
        //     trigger: 'body',
        //     start: self => 'top ' + (window.innerHeight / 5 * -1) + 'px',
        //     invalidateOnRefresh: true,
        //     refreshPriority: -1000,
        //     onEnter: () => {
        //         $('.topbar').addClass('topbar--is-scrolled');
        //     },
        //     onLeaveBack: (e) => {
        //         $('.topbar').removeClass('topbar--is-scrolled');
        //     }
        // });

        // $('.topbar').on('mouseover, mouseenter, mousemove', function(e){
        //     $(this).removeClass('topbar--is-scrolled');
        // });

        ScrollTrigger.create({
            trigger: 'body',
            start: self => 'top ' + (window.innerHeight / 4 * -1) + 'px',
            end: 'bottom bottom',
            invalidateOnRefresh: true,
            refreshPriority: -1000,
            onUpdate: (self) => {
                // self.direction === -1 ? $('.topbar').removeClass('topbar--is-hidden') : $('.topbar').addClass('topbar--is-hidden')

                if(self.direction === -1){ // scrolling Up
                    $('.topbar').removeClass('topbar--is-scrolled');
                } else { // scrolling Down
                    $('.topbar').addClass('topbar--is-scrolled');                    
                }

            }
        });

        ScrollTrigger.create({
            trigger: 'body',
            start: self => 'top top',
            end: ()=>{ return 'top ' + $('.topbar__marquee').innerHeight(true) * -1 + 'px'},
            invalidateOnRefresh: true,
            refreshPriority: -1000,
            onUpdate: (self) => {
                // self.direction === -1 ? $('.topbar').removeClass('topbar--is-hidden') : $('.topbar').addClass('topbar--is-hidden')

                if(self.direction === -1){ // scrolling Up
                    $('.topbar').removeClass('topbar--is-scrolled');
                } else { // scrolling Down
                    $('.topbar').addClass('topbar--is-scrolled');                    
                }

            }
        });



        // mm.add('(min-width: 769px)', () => {
            gsap.to('.topbar__marquee', {
                scrollTrigger: {
                    trigger: 'body',
                    start: 'top top',
                    end: '+=24.6',
                    invalidateOnRefresh: true,
                    refreshPriority: -1000,
                    scrub: true
                },
                scaleY: 0
            });
    
            gsap.to('.topbar', {
                scrollTrigger: {
                    trigger: 'body',
                    start: 'top top',
                    end: '+=24.6',
                    invalidateOnRefresh: true,
                    refreshPriority: -1000,
                    scrub: true
                },
                y: -24.6
            });

        // });

        $( '.topbar__nav a[href*="#"], .mobile-nav a[href*="#"]' ).on('click', function(e){
            var thisHash = $(this).attr('href').split('#')[1];
            var targetElement = $('#' + thisHash);

            if (targetElement.length) {
                e.preventDefault();
                gsap.to(window, { duration: 1, scrollTo: {offsetY: ()=>{return ($('.topbar').innerHeight() - 24.6)}, y: '#' + thisHash }, ease: Power4.easeInOut });
            }

        });

       
    };

    function mobileNav(){
        var $burger = $('.burger');

        $burger.on('click', function(e){
            e.preventDefault();

            $(this).toggleClass('burger--close');
            $('.mobile-nav').toggleClass('mobile-nav--is-open');

            if($(this).hasClass('burger--close')){
                lenis.stop();
            } else {
                lenis.start();
            }

        });

        $('.mobile-nav a').on('click', function(){
            $('.burger').removeClass('burger--close');
            $('.mobile-nav').removeClass('mobile-nav--is-open');
            lenis.start();
        });

        var resizeDebounce = debounce(function() {
            if(window.innerWidth > 768){
                $('.burger').removeClass('burger--close');
                $('.mobile-nav').removeClass('mobile-nav--is-open');
                lenis.start();
            };
        }, 100);
        
        $(window).on('resize', resizeDebounce);

    };

    function scrollHeader(){

        // var headerLogo = gsap.timeline({
        //     onComplete: function(){
        //         $('.header__logo').remove();
        //         headerLogo.kill();
        //     },
        //     scrollTrigger: {
        //       trigger: '.header--home',
        //       start: 'top top',
        //       end: 'bottom center',
        //       scrub: .1,
        //     //   markers: true
        //     }
        // }
        // );

        // headerLogo  .to('.header__logo__letter', {autoAlpha: 0, scaleY: 1.1, yPercent: -5, stagger: {
        //     each: .1,
        // }, duration: .25}, 'sameTime')
                    // .from('.topbar__logo__letter', {autoAlpha: 0, scaleY: 1.1, yPercent: -15, stagger: {
                    //     each: .1
                    // }, duration: .25}, 'sameTime');

    };

    // function scrollProducts(){
    //     var numOfItem = $('.block--product-slide').length;

    //     var scrollProduct = gsap.timeline({
    //         scrollTrigger: {
    //           trigger: '.section--product-slide',
    //         //   start: () => { return window.innerWidth > 768 ? 'top top' : 'top 70px' },
    //         //   start: () => { return window.innerWidth > 768 ? 'top 70px' : 'top 60px' },
    //           start: () => { return 'top ' + ($('.topbar').innerHeight() - 24.6)},
    //           end: () => {
    //             // return "+=" + window.innerHeight * (numOfItem - 1);
	// 			return "+=" + window.innerHeight * (numOfItem - 1) * 2;
	// 		    },
    //             scrub: true,
    //           pin: true,
    //         //   snap: {
    //         //     snapTo: 1 / (numOfItem - 1),
    //         //     delay: 0,
    //         //     duration: {min: 0.5, max: .7},
    //         //     // directional: true,
    //         //     ease: Expo.easeOut,
                    
	// 		//     },
    //         }
    //     });

    //     for (let i = 0; i < numOfItem - 1; i++) {
    //         // scrollProduct.to($('.block--product-slide')[i+1], {yPercent: -100, ease: 'none'}, 'item-' + i)
    //         scrollProduct.to($('.block--product-slide')[i+1], {yPercent: -100, ease: 'none', delay: 1}, 'item-' + i)
    //     };

    // };

    function accountNav(){

        function scrollToActiveItem() {
            var $activeItem = $('.is-active');
    
            if ($activeItem.length) {
                var $parentContainer = $activeItem.parents('.woocommerce-MyAccount-navigation');
                var itemOffsetLeft = $activeItem.position().left; // Position relative to the parent
    
                // Set the scroll position of the parent container to make the active item visible
                $parentContainer.scrollLeft(itemOffsetLeft + $parentContainer.scrollLeft() - ($parentContainer.width() / 2) + ($activeItem.outerWidth() / 2));
            }
        };
    
        // Call the function to scroll to the active item
        scrollToActiveItem();

        var myAccountNav = document.querySelector('.woocommerce-MyAccount-navigation');
        console.log(myAccountNav);
        if (myAccountNav) {
            myAccountNav.setAttribute('data-lenis-prevent', 'true');
        }
    };

    function preventLenis(){
        var tables = document.querySelectorAll('table');

        tables.forEach((e)=>{
            e.setAttribute('data-lenis-prevent', 'true');
        });
    };

    function footer(){

        // console.log('footer');

        var footerLogo = gsap.timeline({
            scrollTrigger: {
              trigger: '.footer__logo',
              start: 'top bottom',
              endTrigger: 'footer',
              end: 'bottom bottom',
              scrub: .1,
            }
        });

          footerLogo.from('.footer__logo g', {yPercent: 25, stagger: {
            from: 'end',
            each: .1
          }})

    };

    function introBlock(){
        var circleTl = gsap.timeline({repeat: -1, paused: true});

        circleTl.to('.intro__circle', {rotation: -360, ease: Power0.easeNone, duration: 20});

        ScrollTrigger.create({
            trigger: '.section--intro',
            start: 'top bottom',
            end: 'bottom top',
            onEnter: self => {
                circleTl.play();
            },
            onEnterBack: self => {
                circleTl.play();
            },
            onLeave: self => {
                circleTl.timeScale(1).pause();
            },
            onLeaveBack: self => {
                circleTl.timeScale(1).pause();
            },
            onUpdate: self => {
            //   console.log("progress:", self.progress.toFixed(3), "direction:", self.direction, "velocity", self.getVelocity());
                if(self.direction == 1){
                    circleTl.timeScale( (1 *  self.getVelocity()/120) + 1);
                }
            }
        });

    };

    function regionSlider(){
        var activeSlide = 0,
            isAnimating = false,
            itemsLength = $('.region-slider__info').length - 1,
            $regionInfo = $('.region-slider__info'),
            $regionImg = $('.region-slider__media img'),
            $regionCircle = $('.region-slider__circle'),
            circles = document.getElementsByClassName('region-slider__circle');

            circles[0].addEventListener('animationstart', function(){
                isAnimating = true;
            }, false);

            circles[0].addEventListener('animationend', function(){
                $('.region-slider__circles').removeClass('is-animating');
                isAnimating = false;
            }, false);

        function getPrev(){
            gsap.set('.region-slider__circle', {'--direction' : 'reverse'})

            $regionInfo.removeClass('is-active');
            $regionImg.removeClass('is-active');
            $regionCircle.removeClass('is-active');

            if(activeSlide < 1){
                activeSlide = itemsLength;
            } else {
                activeSlide --;
            };


            $($regionInfo[activeSlide]).addClass('is-active');
            $($regionImg[activeSlide]).addClass('is-active');
            $($regionCircle[activeSlide]).addClass('is-active');


            $('.region-slider__circles').addClass('is-animating');

        }
        
        function getNext(){
            gsap.set('.region-slider__circle', {'--direction' : 'normal'})

            activeSlide ++;

            $regionInfo.removeClass('is-active');
            $regionImg.removeClass('is-active');
            $regionCircle.removeClass('is-active');

            if(activeSlide > itemsLength){
                activeSlide = 0;
            }

            $($regionInfo[activeSlide]).addClass('is-active');
            $($regionImg[activeSlide]).addClass('is-active');
            $($regionCircle[activeSlide]).addClass('is-active');

            $('.region-slider__circles').addClass('is-animating');
            
        }
        


        document.onkeydown = function(e) {
            switch(e.which) {
                case 37: // left
                    if(!isAnimating){
                        getPrev();
                    }
                        
                break;
        
                case 39: // right
                    if(!isAnimating){
                        getNext();
                    }
                        
                break;
        
                default: return; // exit this handler for other keys
            }
            e.preventDefault(); // prevent the default action (scroll / move caret)
        };
        
        $('.region-slider .prev-next button').on('click', function(e){
            e.preventDefault();
            
            if($(this).hasClass('prev-next__arrow--prev')){
                if(!isAnimating){
                    getPrev();
                }
            } else {
                if(!isAnimating){
                    getNext();
                }
            }
            
        });
    
    };

    function socialMarquee(){

        if (!$('.social-marquee').length)
            return
        

        $('.social-marquee').each(function (e) {

            var socialMarquee = new infiniteMarquee({
              //el: document.querySelector('.marquee'),
              el: $(this)[0],
              direction: "left",
              duration: 20,
              css: false
            });
      
            var details = { speed: 1 };
      
            socialMarquee.animation.timeScale(details.speed);
      
            $(this).on('mouseenter mouseover', function () {
                // console.log('mouseenter');

              gsap.to(details, {
                duration: 1,
                speed: 0,
                onUpdate: function () {
                  socialMarquee.animation.timeScale(details.speed);
                },
              });
            });
      
            $(this).on('mouseleave', function () {
                // console.log('mouseleave');
              gsap.to(details, {
                duration: 1,
                speed: 1,
                onUpdate: function () {
                  socialMarquee.animation.timeScale(details.speed);
                },
              });
            });

            ScrollTrigger.create({
                trigger: '.section--social-marquee',
                start: 'top bottom',
                end: 'bottom center',
                onEnter: self => {
                    // console.log('ON ENTER');
                },
                onEnterBack: self => {
                    // console.log('ON ENTER BACK');
                },
                onLeave: self => {
                    socialMarquee.animation.timeScale(1);
                },
                onLeaveBack: self => {
                    socialMarquee.animation.timeScale(1);
                },
                onUpdate: self => {
                //   console.log("progress:", self.progress.toFixed(3), "direction:", self.direction, "velocity", self.getVelocity());
                    if(self.direction == 1){
                        socialMarquee.animation.timeScale( (1 *  self.getVelocity()/300) + 1);
                    }
                }

            });

            
            
            var resizeDebounceMarquee = debounce(function() {
                socialMarquee.animation.timeScale(1);
                // console.log('resize debounce')
            }, 100);

            $(window).on('resize', resizeDebounceMarquee);

      });
    };

    function topBarMArquee(){
        var topbarMarquee = new infiniteMarquee({
            //el: document.querySelector('.marquee'),
            el: $('.topbar-marquee')[0],
            direction: "left",
            duration: 30,
            css: false
          });

          var details = { speed: 1 };

          $('.topbar-marquee').on('mouseenter', function () {
            gsap.to(details, {
              duration: 1,
              speed: 0,
              onUpdate: function () {
              //   console.log(details.speed);
                topbarMarquee.animation.timeScale(details.speed);
              },
            });
          });
    
          $('.topbar-marquee').on('mouseleave', function () {
            gsap.to(details, {
              duration: 1,
              speed: 1,
              onUpdate: function () {
              //   console.log(details.speed);
                topbarMarquee.animation.timeScale(details.speed);
              },
            });
          });

          var resizetopBarDebounceMarquee = debounce(function() {
            topbarMarquee.animation.timeScale(1);
        }, 100);

        $(window).on('resize', resizetopBarDebounceMarquee);
    };

    function curtainColor(){
        $('[data-curtain]').on('click', function(){
            var thisColor = $(this).data('curtain');
            
            gsap.set('.curtain', {'--curtain-bg': thisColor});
        });
    };

    function pastaForm(){
        $('.pasta-form .wpcf7-list-item-label').each(function () {
            var split = $(this).splitText({ type: 'letters', useLite: true });
            // var words = $(this).find('span');
            // var parentIndex = $(this).parents('.section').index();

            
        });
    };

    function popup(){
        var $popupCta = $('.popup__cta'),
            $popup = $('.popup__popup'),
            $popupContentWrap = $('.popup__content'),
            $popupTitle = $('.poupup__text');

        $popupCta.on('click', function(e){
            e.preventDefault();
        });

        $popupCta.on('mouseenter', function(e){
            var thisText = $(this).data('text'),
                textMarkup = '<p>'+ thisText +'</p>',
                thisColor = $(this).css('--hover-color'),
                $thisRelatedImg = $(this).data('related-img');

                // console.log(thisColor);

            $popupContentWrap.html(textMarkup);
            $popup.addClass('popup__popup--is-visible');
            $popup.css('--bg-shadow', thisColor);

            // $('.popup__media img').removeClass('is-visible');
            // $('.popup__media img[data-index="'+ $thisRelatedImg +'"]').addClass('is-visible');

        });

        $popupCta.on('mouseleave', function(){
            $popup.removeClass('popup__popup--is-visible');
            // $('.popup__media img').removeClass('is-visible');
            // $('.popup__media img:first-child').addClass('is-visible');
        });
        
        $popupTitle.on('mouseenter', function(e){
            var per = (e.pageX - $(this).offset().left) / $(this).outerWidth() * 100;

            // console.log(per + '%');

            gsap.set($popup, {left: per + '%'})
        });

        $popupTitle.on('mousemove', function(e){
            var perX = (e.pageX - $(this).offset().left) / $(this).outerWidth() * 100;
            var perY = (e.pageY - $(this).offset().top) / $(this).outerHeight() * 100;

            // console.log(perX + '%');

            gsap.to($popup, {left: perX + '%'})
            gsap.to($popup, {'--top': perY + '%'});
        });

        Observer.create({
            target: $popupTitle,         // can be any element (selector text is fine)
            type: 'pointer',    // comma-delimited list of what to listen for ("wheel,touch,scroll,pointer")
            // onUp: () => previous(), 
            // onDown: () => next(),
            onMove: (data)=>{
                var velX = data._vx.getVelocity() / -200 + '%';
                var velY = data._vy.getVelocity() / -200 + '%';
                gsap.to('.popup__popup', {'--velocity-x': velX, '--velocity-y': velY, duration: .2});
            },
            onStop: ()=>{
                gsap.to('.popup__popup', {'--velocity-x': 0, '--velocity-y': 0, duration: .2});
            }
          });

    };

    function productSwiper(){
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            // direction: 'vertical',
            // effect: 'fade',
            effect: 'cards',
            cardsEffect: {                  // added
                perSlideOffset: 2000,         // added(slide gap(px)
                perSlideRotate: 105,         // added(Rotation angle of second and subsequent slides
                rotate: true,               // added(Rotation presence of second and subsequent slides(true/false)
                slideShadows: false,        // added(Shadow presence of second and subsequent slides(true/false)
            },  
            // loop: true,
            grabCursor: true,
            speed: 500,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            // If we need pagination
            // pagination: {
            //   el: '.swiper-pagination',
            // },
          
            // Navigation arrows
            navigation: {
              nextEl: '.prev-next__arrow--next',
              prevEl: '.prev-next__arrow--prev',
            },
          
            // // And if we need scrollbar
            // scrollbar: {
            //   el: '.swiper-scrollbar',
            // },
          });
          
    };

    function doDontScroll(){

        if($('body').find('.manifesto-list__item').length){

            console.log('DO DONT');
            $('.manifesto-list__do-dont').each(function(){
                var $this = $(this);

                ScrollTrigger.create({
                    trigger: $this,
                    start: 'top 80%',
                    // markers: true,
                    onEnter: ()=>{
                        $this.parent('.manifesto-list__item').addClass('manifesto-list__item--is-visible');
                    }
                });

            });

        };

    };

    function dropdowns(){
        $('.dropdown__trigger').on('click', function(){
            var $this = $(this),
                dpContentH = $this.parent().find('.dropdown__content > div').outerHeight(true),
                $dpContent = $this.parent().find('.dropdown__content');

            if($this.hasClass('dropdown__trigger--is-open')){
                $this.removeClass('dropdown__trigger--is-open');
                gsap.fromTo($dpContent, {'height': dpContentH}, {'height': 0, duration: .3, onComplete: function(){
                    // console.log('YO');
                    ScrollTrigger.refresh();
                }} );
            } else {
                $this.addClass('dropdown__trigger--is-open');
                gsap.to($dpContent, {'height': dpContentH + 'px', duration: .3, onComplete: function(){
                    // console.log('LOL');
                    gsap.set($dpContent, {'height': 'auto'});
                    ScrollTrigger.refresh();
                }} );
            };
        });
    };

    function changeBrowserColor(color){
        gsap.to('[name="theme-color"]', 1, {attr:{'content': color}});
        // $('[name="theme-color"]').attr('content', color);
    };

    function killAllScrollTrigger() {

        let triggers = ScrollTrigger.getAll();
        triggers.forEach(trigger => {
            trigger.kill();
        });

    };

    function wrapBtnContent(){

        const buttons = document.querySelectorAll('.button');

        buttons.forEach(button => {
            const span = document.createElement('span');
            
            span.innerHTML = button.innerHTML;

            button.innerHTML = '';
            
            button.appendChild(span);
        });

    };

    function preventSamePageReload() {
        var links = document.querySelectorAll('a[href]');
        var cbk = function (e) {
            if (e.currentTarget.href === window.location.href) {
                e.preventDefault();
                e.stopPropagation();

                // if (!navIsClosed) {
                //     closeNavTl.play();
                // }
            }
        };

        for (var i = 0; i < links.length; i++) {
            links[i].addEventListener('click', cbk);
        }
    };

    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    function reInitCF7(form){
        if(form){
            try {
                wpcf7.reset(form);
            } catch (ev) {
                wpcf7.init(form);
            };
        }
    };

});
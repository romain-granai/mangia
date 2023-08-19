import infiniteMarquee from "https://cdn.skypack.dev/infinite-marquee@1.0.7";

$(document).ready(function () {

    const lenis = new Lenis({
        duration: .5,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // https://www.desmos.com/calculator/brs54l4xou
        direction: 'vertical', // vertical, horizontal
        gestureDirection: 'vertical', // vertical, horizontal, both
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
        infinite: false,
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

    barba.init({
        preventRunning: true,
        transitions: [{
            name: 'switch',
            once({current, next, trigger}) {
                console.log('OPEN ANIMATION ONCE');
                var introAnim = gsap.timeline({
                    paused: true, 
                    // delay: .5, 
                    // onStart: function(){},
                    onComplete: function(){
                        lenis.start()
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
                
                // animLogo.timeScale(0.8);
                introAnim.play();
                isOnce = true;

                // var nextPageTitle = $(next.html).find('.page-top-bar-info').html();
                // $('.page-name').empty().html(nextPageTitle);
                
            },
            leave({current, next, trigger}) {

               return new Promise(resolve => {
                    const leavingAnim = gsap.timeline({
                        onComplete(){
                            resolve();
                        }
                    });

                    leavingAnim .to('.bottom-bar', 1, {y: 0, ease: Expo.easeInOut}, 'leaving')
                                .to('.page-name', 1, {y: '10px', autoAlpha: 0, ease: Expo.easeOut}, 'leaving')
                                .to(current.container, 1, {autoAlpha: 0, display: 'none', ease: Expo.easeInOut}, 'leaving');
                });
            },
            beforeLeave({current, next, trigger}){
                
                setTimeout(function(){ 
                    $('.top-bar').removeClass('top-bar--transparent');
                    $('.bottom-bar').removeClass('bottom-bar--light') 
                }, 500);
                
            },
            beforeEnter({current, next, trigger}) {
                // console.log('BEFORE ENTER GLOBAL')
                // window.scrollTo(0, 0);

                // killAllScrollTrigger();

                // isOnce = false;

                // global();
            },
            enter({current, next, trigger}) {
                // var nextPageTitle = $(next.html).find('.page-top-bar-info').html();
                // $('.page-name').empty().html(nextPageTitle);

                preventSamePageReload();

                return new Promise(resolve => {
                    
                    const enterAnim = gsap.timeline({
                        onComplete(){
                            resolve();
                            navIsOpen = false;
                            openNav.restart().pause();
                        }
                    });

                    enterAnim   .to('.bottom-bar', 1, {y: ()=>{ return - $('.bottom-bar > a').outerHeight(true) + 'px'}, ease: Expo.easeInOut}, 'entering')
                                .fromTo('.page-name', 1, {y: '-10px', autoAlpha: 0}, {y: 0, autoAlpha: 1, ease: Expo.easeOut}, 'entering')
                                .fromTo(next.container, 1, {autoAlpha: 0}, {autoAlpha: 1, ease: Expo.easeInOut}, 'entering');
                });
            }
        }],
        // views: [{
        //     namespace: 'home',
        //     beforeEnter(data) {
        //         home();
        //     }

        //   }, {
        //     namespace: 'projects',
        //     beforeEnter(data){
        //         projects();
        //     },

        //   }, {
        //     namespace: 'single-project',
        //     beforeEnter(data) {

        //     },
        //     afterEnter(data) {
        //         singleProject();
        //     },
        //   },
        //   {
        //     namespace: 'news',
        //     beforeEnter(data) {
        //         news();
        //     },

        //   },
        //   {
        //     namespace: 'single-news',
        //     beforeEnter(data) {
        //         singleNews();
        //     },

        //   }, {
        //     namespace: 'regular-page',
        //     beforeEnter(data) {
        //         regularPage();
        //     },

        //   }, {
        //     namespace: 'atelier',
        //     beforeEnter(data) {
        //         atelierPage();
        //     },

        //   }
          
        // ]
    },
    
    );

    topbar();
    scrollHeader();
    scrollProducts();
    footer();
    introBlock();
    regionSlider();
    socialMarquee();
    curtainColor();
    pastaForm();



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
    };

    function scrollHeader(){
        // var topBarLogoW = $('.topbar__logo').innerWidth() / 100 * 75;
        // var headerLogoW = $('.header__logo').innerWidth();
        // var scaleHeaderLogo = topBarLogoW/headerLogoW;

        // gsap.set('.header__logo', {transformOrigin: 'bottom center'});

        // gsap.to('.header__logo', {
        //     scrollTrigger: {
        //         trigger: '.header',
        //         start: 'bottom bottom',
        //         endTrigger: '.header__logo',
        //         end: 'bottom 100px',
        //         scrub: .25,
        //         // markers: true,
        //         onLeave: ()=>{
        //             console.log('TOUCH TOP NOW')
        //             // gsap.set('.topbar__logo', {opacity: 1, visibility: 'visible'});
        //             // gsap.set('.header__logo', {autoALpha: 0, visibility: 'hidden'});
                    
        //             gsap.set('.topbar__logo', {autoAlpha: 1});
        //             gsap.set('.header__logo', {autoAlpha: 0});
        //         },
        //         onEnterBack: ()=>{
        //             // gsap.set('.topbar__logo', {opacity: 0, visibility: 'hidden'});
        //             // gsap.set('.header__logo', {autoALpha: 1, visibility: 'visible'});
    
        //             gsap.set('.topbar__logo', {autoAlpha: 0});
        //             gsap.set('.header__logo', {autoAlpha: 1}); 
        //         }
        //     }, // start the animation when ".box" enters the viewport (once)
        //     scale: scaleHeaderLogo
        // });

        var headerLogo = gsap.timeline({
            scrollTrigger: {
              trigger: '.header--home',
              start: 'top top',
              end: 'bottom 25%',
              scrub: .1,
            }
        });

        headerLogo  .to('.header__logo__letter', {autoAlpha: 0, scaleY: 1.1, yPercent: -5, stagger: {
            each: .1,
            // from: 'end'
        }, duration: .25}, 'sameTime')
                .from('.topbar__logo__letter', {autoAlpha: 0, scaleY: 1.1, yPercent: -15, stagger: {
                    each: .1
                }, duration: .25}, 'sameTime')


    };

    function scrollProducts(){
        var numOfItem = $('.block--product-slide').length;

        var scrollProduct = gsap.timeline({
            scrollTrigger: {
              trigger: '.section--product-slide',
              start: 'top top',
              end: () => {
				return "+=" + window.innerHeight * (numOfItem - 1);
			    },
                scrub: true,
              pin: true
            }
        });

        for (let i = 0; i < numOfItem - 1; i++) {
            scrollProduct.to($('.block--product-slide')[i+1], {yPercent: -100}, 'item-' + i)
        };

    };

    function footer(){

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
        $('.marquee').each(function (e) {

            var marquee = new infiniteMarquee({
              //el: document.querySelector('.marquee'),
              el: $(this)[0],
              direction: "left",
              duration: 20,
              css: false
            });
      
            var details = { speed: 1 };
      
            marquee.animation.timeScale(details.speed);
      
            $(this).find('a').on('mouseenter', function () {
              gsap.to(details, {
                duration: 1,
                speed: 0,
                onUpdate: function () {
                //   console.log(details.speed);
                  marquee.animation.timeScale(details.speed);
                }
              });
            });
      
            $(this).find('a').on('mouseleave', function () {
              gsap.to(details, {
                duration: 1,
                speed: 1,
                onUpdate: function () {
                //   console.log(details.speed);
                  marquee.animation.timeScale(details.speed);
                }
              });
            });

            ScrollTrigger.create({
                trigger: '.section--social-marquee',
                start: 'top bottom',
                end: 'bottom top',
                // onEnter: self => {
                //     circleTl.play();
                // },
                // onEnterBack: self => {
                //     circleTl.play();
                // },
                // onLeave: self => {
                //     circleTl.timeScale(1).pause();
                // },
                // onLeaveBack: self => {
                //     circleTl.timeScale(1).pause();
                // },
                onUpdate: self => {
                //   console.log("progress:", self.progress.toFixed(3), "direction:", self.direction, "velocity", self.getVelocity());
                    if(self.direction == 1){
                        marquee.animation.timeScale( (1 *  self.getVelocity()/300) + 1);
                    }
                }
            });

      });
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

});
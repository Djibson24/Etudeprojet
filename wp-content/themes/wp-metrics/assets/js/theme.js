;(function($){

    /**
     * Extra pseudo for the theme
     */
    $.expr[':'].hasClassStartingWith = function(el, i, selector) {
        var re = new RegExp("\\b" + selector[3]);
        return re.test(el.className);
    };

    function MetricsPieChart( el )
    {
        if ( ! el )
        {
            return false;
        }

        this.el = el;
        this.parseOptions();
        this.whichTransitionEnd = function()
        {
            var t,
                el = document.createElement( "fakeelement" );

            var transitions = {
                "transition"      : "transitionend",
                "OTransition"     : "oTransitionEnd",
                "MozTransition"   : "transitionend",
                "WebkitTransition": "webkitTransitionEnd"
            };

            for ( t in transitions )
            {
                if ( el.style[ t ] !== undefined )
                {
                    return transitions[ t ];
                }
            }
        };
        this.doAnimations();
    }

    MetricsPieChart.prototype.parseOptions = function()
    {
        var options,
            defaults = {
                width: 5,
                value: 50,
                duration: 2500
            },
            settings = {};

        try
        {
            options = JSON.parse( this.el.getAttribute( 'data-options' ) );
        }
        catch ( e )
        {
            options = {};
        }

        for ( var key in defaults )
        {
            if ( options.hasOwnProperty( key ) )
            {
                settings[ key ] = options[ key ];
            }
            else
            {
                settings[ key ] = defaults[ key ];
            }

            settings[ key ] = parseFloat( settings[ key ] );
        }

        if ( settings.duration < 100 )
        {
            settings.duration = defaults.duration;
        }

        if ( settings.value > 100 || settings.value < 0 )
        {
            settings.value = defaults.value;
        }

        if ( settings.width < 0 )
        {
            settings.width = defaults.width;
        }

        this.options = settings;
    };

    MetricsPieChart.prototype.doAnimations = function()
    {
        var valueHolder = this.el.querySelector( '[data-role="value"]' ),
            pies        = this.el.querySelector( '[data-role="graphic"]' ),
            pie1, pie2, v = 0, d1 = 0, d2 = 0, timelt50 = 0;

        var options = this.options;

        if ( 'true' == pies.getAttribute( 'ready') )
        {
            return;
        }

        pie1 = document.createElement( 'span' );
        pie1.setAttribute( 'class', 'cms-pie' );
        pie1.style.borderWidth = options.width + 'px';

        pies.appendChild( pie1 );

        if ( options.value <= 50 )
        {
            pie1.classList.add( 'cms-pies-lt50' );
            d1 = parseFloat( options.duration * options.value / 100 );
            step = d1 / 100;
            pie1.style.transitionDuration = d1.toFixed( 2 ) + 'ms';
            pie1.style.WebkitTransitionDuration = d1.toFixed( 2 ) + 'ms';

            setTimeout( function()
            {
                pie1.style.transform = 'rotate(' + ( 45 + options.value * 3.6 ) + 'deg)';
            }, 100 );
        }
        else
        {
            pie2 = document.createElement( 'span' );
            pie2.setAttribute( 'class', 'cms-pie cms-pie-gt50' );
            pie2.style.borderWidth = options.width + 'px';
            pies.appendChild( pie2 );

            timelt = parseFloat( options.duration / 2 ).toFixed( 2 );
            pie1.style.transitionDuration = timelt + 'ms';

            d2 = parseFloat( options.value * options.duration / 100 );
            step = d2 / 100;

            pie2.style.transitionDuration = d2.toFixed( 2 ) + 'ms';

            pie1.addEventListener( this.whichTransitionEnd(), function( e )
            {
                pies.classList.add( 'cms-pies-gt50' );
                e.target.removeEventListener( e.type, arguments.callee );
            });

            setTimeout( function()
            {
                pie1.style.transform = 'rotate(225deg)';
                pie2.style.transform = 'rotate(' + ( 225 + ( options.value - 50 ) * 3.6 ) + 'deg)';
            }, 10 );
        }

        pies.setAttribute( 'ready', 'true' );

        if ( valueHolder )
        {
            var s = setInterval( function()
            {
                v += options.value / 100;

                if ( v > options.value )
                {
                    v = options.value;
                    valueHolder.innerHTML = v;
                    clearInterval( s );
                    return;
                }
                
                valueHolder.innerHTML = parseInt( v, 10 );
            }, step );
        }
    };

    /**
     * The main object
     * @type {Object}
     */
    var Metrics = {
        _initialized: false,
        _lastWindowHeight: 0,
        _lastWindowWidth: 0,

        on_ready: function()
        {
            var _this = this;
            if ( _this._initialized ) return;

            _this._initialized = true;
            _this._lastWindowHeight = window.innerHeight;

            // Select tag customize
            $('select').wrap( '<div class="cms-select"></div>' );

            // Nav menu scripts
            if ( $.fn.metrics_nav_menu ) {
                $.fn.metrics_nav_menu();
            }

            // Sticky header
            if ( $.fn.cmsStickyHeader ) {
                $.fn.cmsStickyHeader();
            }

            // Page title settings
            _this.pageTitle();

            // Back to top button
            _this.backToTop();

            // Carousel scripts
            if ( $.fn.owlCarousel ) {
                _this.carousels();
            }

            // Vertical slider
            if ( $.fn.bxSlider ) {
               // _this.sliders();
            }

            // Gallery Popup
            if ( $.fn.magnificPopup ) {
                _this.magnificPopup();
            }
            
            // Progress bar script
            _this.progressBar();

            // Counter script
            _this.count_up();

            // Shuffle script
            _this.shuffle();

            // Overlay block
            _this.vcOverlay();

            _this.pieChart();
        },

        whichTransitionEvent: function()
        {
            var t,
            el = document.createElement( "fakeelement" );

            var transitions = {
                "transition"      : "transitionend",
                "OTransition"     : "oTransitionEnd",
                "MozTransition"   : "transitionend",
                "WebkitTransition": "webkitTransitionEnd"
            };

            for ( t in transitions )
            {
                if ( el.style[ t ] !== undefined )
                {
                    return transitions[ t ];
                }
            }
        },

        /**
         * Page title placeholder
         */
        pageTitle: function() {
            var header = $('#masthead'),
                header_placeholder = $('#masthead_placeholder'),
                page_title_inner = $('#page_title .page-title-inner');

            if ( header.length == 0 || header_placeholder.length == 0 ) return;
            
            if ( page_title_inner.length ) {
                page_title_inner.prepend( '<div class="page-title-placeholder" style="height:' + header.innerHeight() + 'px"></div>');
            }
            else {
                header_placeholder.css( 'height', header.innerHeight() );
            }
        },

        /**
         * Back to top button
         */
        backToTop: function() {
            var btn = $( '#backtotop' );

            if ( btn.length == 0 ) return;

            btn.on( 'click', function(e) {
                e.stopPropagation();
                $( this ).blur();
                $( 'html, body' ).stop().animate( { scrollTop: 0 }, 1500, 'swing' );
            });

            $(window).scroll(function () {
                if ( $( window ).scrollTop() > 480 )
                {
                    if ( ! btn.hasClass( 'active' ) )
                    {
                        btn.addClass( 'active' );
                    }
                }
                else
                {
                    btn.removeClass( 'active' );
                }
            });
        },

        /**
         * Ability to make vc_column filling remaining space
         */
        vc_column: function() {
            var _this = this;
            $('.vc_column_container.column-fill-place').each(function(){
                var $this = $(this);
                var $row = $this.closest('[data-vc-full-width="true"]');
                if ( 'undefined' == typeof $row || $row.length == 0 ) return;
                var windowWidth = window.innerWidth;
                var smallDelay = 100;
                var startWidth = 768;

                if ( $this.is(':hasClassStartingWith("vc_col-lg")') ) {
                    startWidth = 1200;
                }
                else if ( $this.is(':hasClassStartingWith("vc_col-md")') && ! $this.hasClass('vc_col-md-12') ) {
                    startWidth = 992;
                }
                else if ( $this.is(':hasClassStartingWith("vc_col-sm")') && ! $this.hasClass('vc_col-sm-12') ) {
                    startWidth = 768;
                }
                if ( $this.is(':first-child') || $this.is(':last-child') ) {
                    $this.imagesLoaded( function(){
                        _this.vc_column_fill($this,$row,startWidth);
                        $(window).on('resize', function(e){
                            if (window.innerWidth !== _this._lastWindowWidth) {
                                window.clearTimeout(smallDelay);
                                smallDelay = window.setTimeout(function () {
                                    _this._lastWindowWidth = window.innerWidth;
                                    _this.vc_column_fill($this,$row,startWidth);
                                }, 100);
                            }
                        });
                    } );
                }
            });
        },

        /**
         * Column filling remain space
         */
        vc_column_fill:function(col, parent_row, start_width) {
            col.css({'padding-left':'','margin-left':'','padding-right':'','margin-right':'','width':'','height':'','overflow':''});
            col.removeClass('column-fill-place-computed');
            parent_row.css({'overflow':''});
            var col_inner = col.children('.vc_column-inner');
            var parent_height = col.parent().height();
            var col_inner_content = col_inner.children();
            var col_inner_h = 0;
            if ( col_inner_content.length ) {
                col_inner_content = col_inner_content.first();
                col_inner_content.css({'height':'','overflow':''});
            }
            col_inner.css({'padding-left':'','padding-right':'','height':''});

            var windowWidth = window.innerWidth;
            var colWidth = col.innerWidth();
            var remainSpace = 0;

            if ( col.is(':first-child') || col.prev('.vc_column_container').length == 0 ) {
                if ( windowWidth >= start_width ) {
                    if ( parent_row.data('vc-stretch-content') ) {
                        remainSpace = col.offset().left - 1;
                    } else {
                        remainSpace = 0.5*(windowWidth - parent_row.width());
                    }
                    col.css({'padding-left':'0'});
                    col.css({'width':colWidth + remainSpace + 'px', 'margin-left':'-' + ( remainSpace + 1 ) + 'px', 'height': parent_height + 'px','overflow':'hidden'});
                    col_inner.css({'padding-left':'0','height':'100%'});
                    parent_row.css({'overflow':'hidden'});
                    if ( col_inner_content.length ) {
                        col_inner_content.css({'height':'0'});
                        col_inner_h = col_inner.height();
                        col_inner_content.css({'height':col_inner_h + 'px', 'overflow':'hidden'});
                        col.addClass('column-fill-place-computed');
                    }
                }
            }
            if ( col.is(':last-child') || col.next('.vc_column_container').length == 0 ) {
                if ( windowWidth >= start_width ) {
                    remainSpace = 0.5*(windowWidth - parent_row.width());
                    col.css({'padding-right':'0'});
                    col.css({'width':colWidth + remainSpace + 'px', 'margin-right':'-' + ( remainSpace + 1 ) + 'px', 'height': parent_height + 'px','overflow':'hidden'});
                    col_inner.css({'padding-right':'0','height':'100%'});
                    parent_row.css({'overflow':'hidden'});
                    if ( col_inner_content.length ) {
                        col_inner_content.css({'height':'0'});
                        col_inner_h = col_inner.height();
                        col_inner_content.css({'height':col_inner_h + 'px', 'overflow':'hidden'});
                        col.addClass('column-fill-place-computed');
                     }
                }
            }
        },

        vcOverlay: function() {
            var _this = this,
                $overlayEls = $( '.vc_section.section-has-overlay, .vc_row.row-has-overlay' );

            if ( ! $overlayEls.length )
            {
                return;
            }

            $overlayEls.each( function(){
                $( this ).prepend( '<div class="overlay-block"></div>' );
            });
        },

        /**
         * Carousels
         */
        carousels: function() {
            $('.cms-carousel').each(function(){
                var owl = $(this).find('.carousel-items');
                if ( owl.length == 0 || ! owl.data('carousel-options') ) return;
                var nav = $(this).find('.carousel-navigation');
                var options = {};
                if ( nav.length > 0 ) {
                    var nav_prev = nav.find('.nav-link.nav-prev');
                    var nav_next = nav.find('.nav-link.nav-next');
                    options = {
                        addClassActive: true,
                        afterMove: function() {
                            var owl_data = owl.data('owlCarousel');
                            if ( owl_data.currentItem == 0 && 'undefined' != typeof nav_prev ) {
                                nav_prev.addClass('disabled');
                            }
                            else {
                                nav_prev.removeClass('disabled');
                            }
                            if ( owl_data.currentItem == owl_data.maximumItem && 'undefined' != typeof nav_next ) {
                                nav_next.addClass('disabled');
                            }
                            else {
                                nav_next.removeClass('disabled');
                            }
                        }
                    }
                }
                
                options = $.extend( options, owl.data('carousel-options') );

                owl.owlCarousel( options );
                //owl.removeAttr('data-carousel-options');

                if ( 'undefined' != typeof nav_prev ) {
                    nav_prev.on('click', function(e){
                        e.preventDefault();
                        if ( ! $(this).hasClass('disabled') ) {
                            owl.trigger('owl.prev');
                        }
                    });
                }
                if ( 'undefined' != typeof nav_next ) {
                    nav_next.on('click', function(e){
                        e.preventDefault();
                        if ( ! $(this).hasClass('disabled') ) {
                            owl.trigger('owl.next');
                        }
                    });
                }
            });
        },

        /**
         * Vertical slider
         */
        sliders: function() {
            $('.cms-slider').each(function(){
                var _this = $(this);
                var row = _this.closest('.vc_row'),
                    bx = _this.find('.slider-items'),
                    controls = _this.find('.slider-controls'),
                    control_prev = false,
                    control_next = false,
                    hideControlsOnEnd = false;
                var settings = bx.data('slider-options'),
                    options = {};

                if ( ! settings ) return;

                if ( ! row.data('vc-full-width') || ! row.data('vc-stretch-content') ) return;

                if ( 'undenfined' != typeof bx && bx.length > 0 ) {
                    bx = bx.first();
                }

                if ( 'undefined' != typeof settings.controls && settings.controls == true ) {
                    if ( 'undefined' == typeof controls || controls.length == 0 ) {
                        bx.insertAfter('<div class="slider-controls"><div class="control-prev"></div><div class="control-next"></div></div>');
                        controls = _this.find('.slider-controls');
                    }
                    control_prev = controls.children('.control-prev');
                    control_next = controls.children('.control-next');

                    options.prevSelector = control_prev;
                    options.nextSelector = control_next;
                }

                options = $.extend( options, {
                    onSliderLoad: function( currentIndex ) {
                        var slides = bx.children();
                        bx.children().each( function(){
                            $(this).css({'margin-left':'auto','margin-right':'auto'});
                        } );
                        if ( 'undefined' != slides && slides.length > 0 ) {
                            var curSlide = $(slides[currentIndex]);
                            if ( curSlide.hasClass('bx-clone') ) {
                                curSlide.addClass('slide-prev');
                                curSlide = curSlide.next().first();
                                curSlide.addClass('slide-active');

                                var nextSlide = curSlide.next().first();
                                if ( 'undefined' != nextSlide && nextSlide.length > 0 ) {
                                    nextSlide.addClass('slide-next');
                                }
                            }
                            else {
                                curSlide.addClass('slide-active');
                                var prevSlide = curSlide.prev().first();
                                var nextSlide = curSlide.next().first();
                                if ( 'undefined' != nextSlide && nextSlide.length > 0 ) {
                                    nextSlide.addClass('slide-next');
                                }
                                if ( 'undefined' != prevSlide && prevSlide.length > 0 ) {
                                    prevSlide.addClass('slide-next');
                                }
                            }
                        }
                    },
                    onSlideBefore: function( $slideElement, oldIndex, newIndex ) {
                        var $otherSlides = $slideElement.siblings();
                        var $next = $slideElement.next();
                        var $prev = $slideElement.prev();

                        $otherSlides.removeClass('slide-next');
                        $otherSlides.removeClass('slide-prev');

                        $slideElement.removeClass('slide-next');
                        $slideElement.removeClass('slide-prev');

                        $slideElement.addClass('slide-active');

                        $otherSlides.removeClass('slide-active');


                        if ( 'undefined' != $prev && $prev.length > 0 ) {
                            $prev.first().addClass('slide-prev');
                        }
                        if ( 'undefined' != $next && $next.length > 0 ) {
                            $next.first().addClass('slide-next');
                        }
                    }
                } );

                if ( true == _this.data('hide-controls-on-end') ) {
                    hideControlsOnEnd = true;
                    control_prev.addClass('disabled');
                    options = $.extend( options, {
                        onSlideAfter: function( $slideElement, oldIndex, newIndex ) {
                            if ( hideControlsOnEnd && 'undenfined' != typeof slider ) {
                                if ( 0 == newIndex ) {
                                    control_prev.addClass('disabled');
                                }
                                else {
                                    control_prev.removeClass('disabled');
                                }
                                if ( slider.getSlideCount() == newIndex + 1 ) {
                                    control_next.addClass('disabled');
                                }
                                else {
                                    control_next.removeClass('disabled');
                                }
                            }
                        }
                    } );
                }

                options = $.extend( options, settings );

                var slider = null;
                slider = bx.bxSlider(options);
                // Reposition first slide on small screen
                bx.css('top', -bx.children('.slide-next').innerHeight());
            });
        },

        /**
         * Gallery Popup
         */
        magnificPopup: function() {
            $('[data-gallery-id]').each(function(){
                $(this).magnificPopup({
                    delegate: 'a[data-gallery^="gallery-lightbox"]',
                    type: 'image',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true
                    }
                });
            });
        },


        /**
         * Page loading
         */
        page_loading: function( init ) {
            if ( init ) {
                $( '#cms_page_loader' ).on( Metrics.whichTransitionEvent(), function(){
                    $( this ).remove();
                });
            }
            else {
                $( '#cms_page_loader' ).removeClass( 'loading' );
                //$( '#cms_page_loader' )
            }

            //fadeOut( 500 );
        },

        /**
         * Progress bar
         */
        progressBar: function() {
            if ( ! $.fn.progressbar ) return;
            var options = {
                use_percentage: true,
                display_text: 'center'
            }
            $('.cms-progress-bar').each(function(){
                var _this = $(this);
                var bar = $(this).find('.progress-bar');
                if ( bar.length == 0 ) return;
                if ( $.fn.waypoint ) {
                    bar.waypoint(function() {
                        bar.progressbar( options );
                    },{
                        offset: '95%',
                        triggerOnce: true
                    });
                }
                else {
                    bar.progressbar( options );
                }
            });
        },

        /**
         * Counter
         */
        count_up: function() {
            $(".cms-counter-wrapper").each( function() {
                var start = 0,
                    end = 1;
               
                var counterSelector = $(this).find('.counter-text');

                if ( 'undefined' != typeof counterSelector && counterSelector.length > 0 ) {
                    counterSelector = counterSelector.first();
                }
                else {
                    return;
                }

                var counterOptions = counterSelector.data('counter-options');
                var counterExtras = counterSelector.data('counter-extras');
                if ( ! counterOptions || ! counterExtras ) return;

                counterOptions = $.extend( {
                    useEasing : true, 
                    useGrouping : true, 
                    separator : ',', 
                    decimal : '.', 
                    prefix : '', 
                    suffix : '' 
                }, counterOptions );

                counterExtras = $.extend( {
                    start: 0,
                    end: 1,
                    decimals: 0,
                    duration: 2.5
                }, counterExtras )

                start = counterExtras.start;
                end = counterExtras.end;

                if ( counterExtras.start == 'random' ) {
                    if ( end != 0 ) {
                        start = Math.random() * end * 2;
                    }
                    else {
                        start = Math.random() * 2;
                    }
                }
                else {
                    start = counterExtras.start;
                }

                var count = new CountUp( counterSelector.attr("id"), start, end, counterExtras.decimals, counterExtras.duration, counterOptions );

                if ( $.fn && $.fn.waypoint ) {
                    counterSelector.waypoint( function() {
                        count.start();
                    }, {
                        offset : '95%',
                        triggerOnce : true
                    });
                }
                else {
                    count.start();
                }
            });
        },

        shuffle: function() {
            var _this_obj = this;
            $('.cms-grid-wrapper').each(function(){
                var _this = $(this);
                var grid, items, current, filter, pagination, loadmore, overlay, id;
                var shuffled = false;

                var init = function(){
                    grid = _this.find('.cms-grid');
                    items = _this.find( '.grid-items' );
                    current = null;
                    filter = _this.find( '.grid-filter' );
                    pagination = _this.find('a.page-numbers');
                    loadmore = _this.find('a.btn-grid-loadmore');
                    overlay = $('<div class="grid-overlay"><div class="cms-page-loader-spinner"></div></div>');
                    id = _this.attr('id');

                    if ( 'undefined' == typeof grid || grid.length == 0 ) return;
                    grid = grid.first();

                    if ( 'undefined' == typeof items || items.length == 0 ) return;
                    items = items.first();
                    current = items.data('current-group');

                    if ( undefined == id || '' == id ) return;
                };

                var bindClick = function() {
                    if ( $.fn.magnificPopup ) {
                        _this_obj.magnificPopup();
                    }
                    if ( 'undefined' != typeof filter && filter.length > 0 ) {
                        filter = filter.first();
                        filter.on( 'click', 'li a', filterClick );
                        filter.find('li:first-child a').trigger('click');
                    }
                    if ( 'undefined' != typeof pagination && pagination.length > 0 ) {
                        pagination.on('click', paginationClick );
                    }
                    if ( 'undefined' != typeof loadmore && loadmore.length > 0 ) {
                        loadmore.on('click',loadmoreClick);
                    }
                }

                var filterClick = function(e) {
                    e.preventDefault();
                    var filtered = $(this).data('group');
                    if ( 'undefined' == typeof filtered ) {
                        items.attr('data-current-group','');
                    }
                    else {
                        items.attr('data-current-group', filtered);
                    }

                    $(this).parent().siblings().removeClass('active');
                    $(this).parent().addClass('active');
                    if ( shuffled ) {
                        items.shuffle( 'shuffle', filtered );
                    }
                    return false;
                }
                

                var paginationClick = function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    var overlay_selector = _this.children('.grid-overlay');
                    
                    if ( 'undefined' == typeof url || '' == url ) return;
                    if ( 'undefined' == typeof overlay_selector || overlay_selector.length == 0 ) {
                        _this.append(overlay);
                        overlay_selector = _this.children('.grid-overlay');
                    }

                    $.get( url, function(response) {
                        _this.fadeTo(100, 0.1, function(){
                            _this.html( $(response).find( "#" + id ).html() );
                        });
                        
                        _this.fadeTo(300, 1,function(){
                            overlay_selector.remove();
                            init();
                            bindClick();
                        });
                    });
                };

                var loadmoreClick = function(e) {
                    e.preventDefault();
                    var _thisBtn = $(this);
                    var url = _thisBtn.attr('href');
                    var overlay_selector = _this.children('.grid-overlay');
                    
                    if ( 'undefined' == typeof url || '' == url ) return;

                    if ( 'undefined' == typeof overlay_selector || overlay_selector.length == 0 ) {
                        _this.append(overlay);
                        overlay_selector = _this.children('.grid-overlay');
                    }

                    $.get( url, function(response) {
                        var loaded_wrapper = $(response).find( "#" + id ),
                            loaded_items_arr = [];

                        if ( undefined == typeof loaded_wrapper || loaded_wrapper.length == 0 ) return;

                        var loaded_filters = loaded_wrapper.find('.grid-filter [data-group]');
                        var current_filters = [];

                        filter.find('[data-group]').each( function(){
                            if ( '' != $(this).data('group') ) {
                                current_filters.push($(this).data('group'));
                            }
                        });

                        loaded_filters.each(function(){
                            if ( current_filters.indexOf( $(this).data('group') ) == -1 ) {
                                filter.append('<li>' + $(this).parent().html() + '</li>');
                            }
                        });

                        if ( loaded_filters.length > 0 ) {
                            loaded_filters = loaded_filters.find('[data-group]');
                        } else {
                            loaded_filters = false;
                        }

                        var loaded_items = loaded_wrapper.find('.grid-items');
                        var loaded_items_more = loaded_wrapper.find('.navigation .btn-grid-loadmore');

                        var loaded_item_arr = loaded_items.children().first();

                        loaded_items.children().first().remove();

                        loaded_items.children().each(function(){
                            loaded_item_arr = loaded_item_arr.add($(this));
                        });

                        items.append(loaded_item_arr);
                        
                        if ( shuffled ) {
                            items.imagesLoaded(function(){
                                items.shuffle('appended', loaded_item_arr);
                            });
                        }

                        _thisBtn.parent().append(loaded_items_more);
                        _thisBtn.remove();
                        overlay_selector.remove();
                        init();
                        bindClick();
                    });
                };

                init();

                if ( $.fn.shuffle && $.fn.imagesLoaded && grid.data('shuffle') == true ) {
                    items.imagesLoaded(function(){
                        items.shuffle({
                            itemSelector: '.grid-item'
                        });
                        shuffled = true;
                    });

                    if ( undefined != current ) {
                        items.shuffle( 'shuffle', current );
                    }
                }

                bindClick();
            });
        },

        pieChart: function()
        {
            var pies = document.querySelectorAll( '[data-cms-element="piechart"]' );

            if ( pies )
            {
                pies = Array.prototype.slice.call( pies );

                pies.forEach( function( pie )
                {
                    var p = null;

                    if ( $.fn.waypoint && ! p ) {
                        $( pie ).waypoint(function() {
                            p = new MetricsPieChart( pie );
                        },{
                            offset: '95%',
                            triggerOnce: true
                        });
                    }
                    else {
                        p = new MetricsPieChart( pie );
                    }
                });
            }
        }
    };

    /**
     * Initialize after DOM has been loaded
     */
    $( document ).ready( function(){
        Metrics.on_ready();
        Metrics.page_loading( true );
    });
    $( window ).load( function() {
        Metrics.vc_column();
        if ( $.fn.bxSlider ) {
            Metrics.sliders();
        }
        Metrics.page_loading( false );
    });

})(jQuery);
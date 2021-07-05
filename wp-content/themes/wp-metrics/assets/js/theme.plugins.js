;(function($){
    "use strict";
    $.fn.extend( {
        metrics_nav_menu: function() {

            var site_nav = $( '#site_nav_main' ).length ? $( '#site_nav_main' ) : null;
            var menu = $( '#primary_menu' ).length ? $( '#primary_menu' ) : null;
            var menu_extras = $( '#site_nav_main .cms-menu-extras' ).length ? $( '#site_nav_main .cms-menu-extras' ).first() : null;
            var scroll_bar_width = window.innerWidth - $( window ).width();
            var site_search_popup = $( '#site_search_popup' ).length ? $( '#site_search_popup' ) : null;
            var site_side_panel_popup = $( '#site_side_panel_popup' ).length ? $( '#site_side_panel_popup' ) : null;
            var side_menu = $( '#side_menu' ).length ? $( '#side_menu' ) : null;

            if ( menu == null ) {
                menu = $('#site_nav_main .cms-menu-main').length ? $('#site_nav_main .cms-menu-main').first() : null;
            }

            if ( menu == null || site_nav == null ) {
                console.log( 'Primary menu does not exist' );
                return;
            }


            /**
             * Script for main site navigation
             * -->
             */
            
            // Primary menu first
            menu.find( 'li' ).each( function() {
                var _this = $( this );
                var submenu = _this.find( '> ul' );
                if ( submenu.length == 0 ) return;

                var sub_item_width = submenu.attr( 'data-item-width' );
                var sub_item_cols = submenu.attr( 'data-item-cols' );
                
                if ( 'undefined' != typeof sub_item_width && ! isNaN( sub_item_width ) ) {
                    submenu.find( '>li' ).css( 'width', sub_item_width + 'px' );
                    if ( 'undefined' != typeof sub_item_cols && ! isNaN( sub_item_cols ) ) {
                        submenu.css( 'width', sub_item_cols * sub_item_width + ( submenu.innerWidth() - submenu.width() ) );    
                        submenu.removeAttr( 'data-item-cols' );
                    }
                    submenu.removeAttr( 'data-item-width' );
                }

                _this.hover( function() {
                    if ( submenu.offset().left + submenu.innerWidth() > $( window ).width() ) {
                        submenu.addClass( 'drop-oposite' );
                    } else if ( submenu.offset().left < 0 ) {
                        submenu.addClass( 'drop-oposite' );
                    }
                    if ( window.innerWidth > 991 ) {
                        if ( _this.hasClass( 'menu-item-has-sub-menu-full' ) ) {
                            _this.addClass( 'menu-item-pos-temp' );
                            submenu.css({
                                'width': submenu.outerWidth() + 'px',
                                'left': '-' + ( _this.offset().left - submenu.offset().left ) + 'px',
                                'right': 'auto'
                            });
                            _this.removeClass('menu-item-pos-temp');
                        }
                    }
                }, function() {
                    submenu.removeClass( 'drop-oposite' );
                    if ( window.innerWidth > 991 ) {
                        if ( _this.hasClass( 'menu-item-has-sub-menu-full' ) ) {
                            submenu.css( {'width': '', 'left': '', 'right': '' });
                        }
                    }
                });
                _this.children( 'a' ).append( '<span class="sub-menu-toggle"></span>' );
                if ( _this.hasClass( 'current-menu-ancestor' ) || _this.hasClass( 'current-menu-item' ) || _this.hasClass( 'current_page_parent' ) ) {
                    _this.addClass( 'has-sub-menu-open' );
                    var submenu_toggle = _this.find( '> a > .sub-menu-toggle' );
                    if ( submenu_toggle.length ) {
                        submenu_toggle.addClass( 'active' );
                    }
                }
            });

            // Primary menu on mobile
            menu.on( 'click', '.sub-menu-toggle', function(e) {
                e.preventDefault();
                $( this ).toggleClass( 'active' );
                $( this ).parent().next( '.sub-menu' ).toggleClass( 'sub-menu-open' );
                $( this ).closest( 'li' ).toggleClass( 'has-sub-menu-open' );
            });

            // Primary menu on mobile toggle
            $( '.mobile-menu-toggle' ).on( 'click', function( event ) {
                var controls = $( $( this ).attr( 'aria-controls' ) );
                site_nav = ( controls.length ? controls : site_nav );
                site_nav.toggleClass( 'site-nav-mobile-open' );
                $( this ).toggleClass( 'active' );
            });

            // Extra features for additional elements of main navigation
            if ( menu_extras != null ) {
                if ( site_side_panel_popup != null ) {
                    menu_extras.on( 'click', '.side-nav-toggle' , function( event ) {
                        event.preventDefault();
                        sideNavToggle();
                    });
                }
                if ( site_search_popup != null ) {
                    menu_extras.on( 'click', '.search-toggle', function(event) {
                        event.preventDefault();
                        siteSearchToggle();
                    });
                }

                menu_extras.on( 'click', '.cart-toggle', function(event) {
                    event.preventDefault();
                    $(this).closest('li').toggleClass('active');
                });
            }
            // <-- End Main nagivation


            /**
             * Script for side navitaion.
             * -->
             */
            if ( side_menu != null ) {

                // Setting up stuffs
                side_menu.find( 'li' ).each( function() {
                    var _this = $( this );
                    var submenu = _this.find( '> ul' );
                    if ( submenu.length == 0 ) return;
                    
                    _this.children( 'a' ).append( '<span class="sub-menu-toggle"></span>' );
                    if ( _this.hasClass( 'current-menu-ancestor' ) || _this.hasClass( 'current-menu-item' ) || _this.hasClass( 'current_page_parent' ) ) {
                        _this.addClass( 'has-sub-menu-open' );
                        var submenu_toggle = _this.find( '> a > .sub-menu-toggle' );
                        if ( submenu_toggle.length ) {
                            submenu_toggle.addClass( 'active' );
                        }
                    }
                });

                // Process events
                side_menu.on( 'click', '.sub-menu-toggle', function(e) {
                    e.preventDefault();
                    $( this ).toggleClass( 'active' );
                    $( this ).parent().next( '.sub-menu' ).toggleClass( 'sub-menu-open' );
                    $( this ).closest( 'li' ).toggleClass( 'has-sub-menu-open' );
                });
            }



            /* Page Fixed Menu */
            $( '.header-fixed-page' ).parents('body').addClass( 'remove-margin-top' );
            $( '#cms-header.no-sticky' ).parents('body').addClass( 'remove-margin-top' );


            

            $('.side-panel-toggle').on('click', function(event){
                event.preventDefault();
                sideNavToggle();
            });

            $(document).on('keyup',function(event){
                if ( event.which == 27 ) {
                    if ( site_side_panel_popup.hasClass('opened') ) {
                        sideNavToggle();
                    }
                    if ( site_search_popup.hasClass('opened') ) {
                        siteSearchToggle();
                    }
                    $('.menu-extras-container .active').removeClass('active');
                    menu_extras.children('li').removeClass('active');
                }
            });

            $( 'body' ).on('click', '#site_side_panel_popup', function(e){
                if ( site_side_panel_popup.hasClass('opened') ) {
                    if ( $(e.target).closest('.side-panel').length == 0 ) {
                        sideNavToggle();
                    }
                }
                
            });

            $( 'body' ).on('click', '#site_search_popup', function(e){
                if ( site_search_popup.hasClass('opened') ) {
                    if ( $(e.target).closest('.search-form').length == 0 ) {
                        siteSearchToggle();
                    }
                }
            });

            $( 'body' ).on('click', function(e){
                if ( $(e.target).closest('.cms-menu-extras').length == 0 ) {
                    $('.menu-extras-container .active').removeClass('active');
                }
            });

            var sideNavToggle = function() {
                if ( site_side_panel_popup != null ) {
                    if ( site_side_panel_popup.hasClass('opened') ) {
                        site_side_panel_popup.removeClass('opened');
                        $( 'body' ).css( { 'overflow':'', 'padding-right':'' } );
                    } else {
                        site_side_panel_popup.addClass('opened');
                        $( 'body' ).css( { 'overflow':'hidden', 'padding-right':scroll_bar_width + 'px' } );
                    }
                }
            }

            var siteSearchToggle = function() {
                if ( site_search_popup != null ) {
                    if ( site_search_popup.hasClass('opened') ) {
                        site_search_popup.removeClass('opened');
                        $( 'body' ).css( { 'overflow':'', 'padding-right':'' } );
                    } else {
                        site_search_popup.addClass('opened');
                        site_search_popup.find( '.search-field' ).focus();
                        $( 'body' ).css( { 'overflow':'hidden', 'padding-right':scroll_bar_width + 'px' } );
                    }
                }
            }
        },

        cmsStickyHeader: function() {
            var header = $('#masthead');
            var scrollTimeout = 250;
            var temp_timeout = 10;
            var header_main = header.find('#header_main');
            var header_sticky_height = header.attr('data-sticky-height');

            if ( ('undefined' == typeof header) || header.length == 0 || ! header.hasClass('header-sticky') ) return;
            if ( 'undefined' == typeof header_main || header_main.length == 0 ) return;
            if ( 'undefined' == typeof header_sticky_height || isNaN(header_sticky_height) ) header_sticky_height = 80;

            var scrollHandler = function () {
                if ( $(window).scrollTop() > header.height() ) {
                    header_main.css( 'height', header_sticky_height );
                    if ( ! header.hasClass('header-sticky-activated') ) {
                        header.addClass('header-sticky-activating').delay(150).queue(function(){
                            $(this).addClass('header-sticky-activated');

                            clearTimeout( temp_timeout );
                            temp_timeout = setTimeout( function(){
                                header.removeClass( 'header-sticky-activating' );
                            }, 10 );

                            $(this).dequeue();
                        });
                    }
                } else {
                    if ( header.hasClass('header-sticky-activated') ) {
                        header_main.css( 'height', '' );
                        header.addClass('header-sticky-deactivating').delay(150).queue(function(){
                            $(this).removeClass('header-sticky-activated');
                            clearTimeout( temp_timeout );
                            temp_timeout = setTimeout( function(){
                                header.removeClass( 'header-sticky-deactivating' );
                            }, 10 );
                            $(this).dequeue();
                        });
                    }
                }
            };
            scrollHandler();
            $(window).scroll(function () {
                if (scrollTimeout) {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = null;
                }
                scrollTimeout = setTimeout(scrollHandler, 250);
            });
        }
    });
})(jQuery);

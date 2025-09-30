// Menu
function online_education_classes_openNav() {
  jQuery(".sidenav").addClass('show');
}
function online_education_classes_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function online_education_classes_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const online_education_classes_nav = document.querySelector( '.sidenav' );

      if ( ! online_education_classes_nav || ! online_education_classes_nav.classList.contains( 'show' ) ) {
        return;
      }
      const elements = [...online_education_classes_nav.querySelectorAll( 'input, a, button' )],
        online_education_classes_lastEl = elements[ elements.length - 1 ],
        online_education_classes_firstEl = elements[0],
        online_education_classes_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && online_education_classes_lastEl === online_education_classes_activeEl ) {
        e.preventDefault();
        online_education_classes_firstEl.focus();
      }

      if ( shiftKey && tabKey && online_education_classes_firstEl === online_education_classes_activeEl ) {
        e.preventDefault();
        online_education_classes_lastEl.focus();
      }
    } );
  }
  online_education_classes_keepFocusInMenu();
} )( window, document );

(function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");

    });

    $(document).ready(function () {

       // $(".toggle-button").click(function () {
       //      $(this).parent().toggleClass("menu-collapsed");
       //  });

        /*--- adding dropdown class to menu -----*/
        $("ul.sub-menu,ul.children").parent().addClass("dropdown");
        $("ul.sub-menu,ul.children").addClass("dropdown-menu");
        $("ul#menuid li.dropdown a,ul.children li.dropdown a").addClass("dropdown-toggle");
        $("ul.sub-menu li a,ul.children li a").removeClass("dropdown-toggle");
        $('nav li.dropdown > a, .page_item_has_children a').append('<span class="caret"></span>');
        $('a.dropdown-toggle').attr('data-toggle', 'dropdown');

        /*-- Mobile menu --*/
        if ($('#site-navigation').length) {
            $('#site-navigation .menu li.dropdown,li.page_item_has_children').append(function () {
                return '<i class="bi bi-caret-down-fill" aria-hd="true"></i>';
            });
            $('#site-navigation .menu li.dropdown .bi,li.page_item_has_children .bi').on('click', function () {
                $(this).parent('li').children('ul').slideToggle();
            });
        }

        /*-- tooltip --*/
        $('[data-toggle="tooltip"]').tooltip();

        /*-- scroll Up --*/
        jQuery(document).ready(function ($) {
            $(document).on('click', '.btntoTop', function (e) {
                e.preventDefault();
                $('html, body').stop().animate({ scrollTop: 0 }, 700);
            });

            $(window).on('scroll', function () {
                if ($(this).scrollTop() > 200) {
                    $('.btntoTop').addClass('active');
                } else {
                    $('.btntoTop').removeClass('active');
                }
            });
        });


        /*-- Reload page when width is between 320 and 768px and only from desktop */
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
        $(window).on('resize', function () {
            var win = $(this); //this = window
            if (win.width() > 320 && win.width() < 991 && isMobile == false && !$("body").hasClass("elementor-editor-active")) {
                location.reload();
            }
        });
    });

})(this.jQuery);


// banner section
jQuery('document').ready(function(){
  var owl = jQuery('.slider-sec .owl-carousel');
    owl.owlCarousel({
    margin:0,
    nav: true,
    autoplay :true,
    lazyLoad: true,
    autoplayTimeout: 9000,
    loop: true,
    dots:false,
    navText : ['<i class="bi bi-chevron-double-left"></i>', '<i class="bi bi-chevron-double-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});

// experiences section
jQuery('document').ready(function(){
  var owl = jQuery('.experiences-box .owl-carousel');
    owl.owlCarousel({
    margin:20,
    nav: true,
    autoplay :true,
    lazyLoad: true,
    autoplayTimeout: 9000,
    loop: true,
    dots:false,
    navText : ['<i class="bi bi-chevron-left"></i>', '<i class="bi bi-chevron-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 3
      },
      1000: {
        items: 4
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});

// custom-header-text
(function( $ ) {
    // Update site title and description color in real-time
    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( newval ) {
            if ( 'blank' === newval ) {
                $( '.site-title a, .site-description' ).css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $( '.site-title a, .site-description' ).css({
                    'clip': 'auto',
                    'position': 'relative',
                    'color': newval
                });
            }
        });
    });
})( jQuery );

// custom-logo
( function( $ ) {
    wp.customize( 'online_education_classes_logo_width', function( value ) {
        value.bind( function( newVal ) {
            $( '.logo .custom-logo' ).css( 'max-width', newVal + 'px' );
        } );
    } );
} )( jQuery );
export default {
  init() {
    // JavaScript to be fired on all pages
    $(".icon-cancel-circled").click(function() {
      $(".topbar").addClass("hiddenTop");
      $(".hiddenTop .container").hide();
    });

    $(".tab").click(function() {
      $(".tab").removeClass("tab-active");
      $(this).addClass("tab-active");
      var filterValue = $(this).attr("data-filter");
      $(".grid").isotope({
        itemSelector: ".element-item",
        layoutMode: "fitRows",
        filter: filterValue
        //filter: ".tourism, .oib_development"
      });
      if ($(".fliter-btns-group-inner").length) {   /* for business page or any page has a double filters */
        var innerFilter = $(filterValue).find(".inner-tab:first");
        $(innerFilter).addClass("tab-active");
        $(innerFilter).trigger("click");
        $(".grid").isotope({
          itemSelector: ".element-item",
          layoutMode: "fitRows",
          filter: filterValue
          //filter: ".tourism, .oib_development"
        });
      }
    });



    $(".inner-tab").click(function() {
      $(".inner-tab").removeClass("tab-active");
      $(this).addClass("tab-active");
      var filterValue = $(this).attr("data-filter");
      $(".grid-inner").isotope({
        itemSelector: ".element-item-inner",
        layoutMode: "fitRows",
        filter: filterValue
      });
    });

    $(window).load(function() {
      if ($(".fliter-btns-group-inner").length) {
        $(".fliter-btns-group-inner").each(function( index ) {
          $(this).find(".tab-active").trigger("click");
        });
        $(".tab-active:not(.inner-tab)").trigger("click");

        //$(".tab-active:not(.inner-tab)").trigger("click");
        //$(".inner-tab.tab-active").trigger("click");
      } else {
        if ($(".fliter-btns-group").length) {
          $(".tab-active:not(.inner-tab)").trigger("click");
        }
      }
      /*if ($(".inner-tab").length) {
        $(".inner-tab.tab-active").trigger("click");
      }*/
    });

    var initScroll = function() {
      if ($(".grid.infinitescroll").length) {
        $(".grid").infinitescroll({
          behavior: "twitter",
          bufferPx: 40,
          //debug  : false,
          loading: {
            msgText: "",
            //img : 'data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==',
            //img: loadImg,
            finishedMsg: ""
          },
          navSelector: "#wp_pagination",
          // selector for the paged navigation (it will be hidden)
          nextSelector: "#wp_pagination a.next:first",
          // selector for the NEXT link (to page 2)
          itemSelector: ".element-item"
          // selector for all items you'll retrieve
        });
      }
    };

    initScroll();

    $(".bxslider").bxSlider({
      adaptiveHeight: false,
      controls: true,
      auto: false,
      randomStart: false,
      hideControlOnEnd: true,
      infiniteLoop: false,
      pager: false,
      slideWidth: 1280,
      //pagerCustom: '#bx-pager'+(index),
      touchEnabled: true
    });

    /*if( $(".banner").offset().top > 0 ) {
      $(".banner").addClass("fixed");
    }
    else {
      $(".banner").removeClass("fixed");
    }*/

    $(window).scroll(function (event) {
      var scroll = $(window).scrollTop();
      if(scroll>110) {
        $(".banner").addClass("fixed");
      }
      else {
        $(".banner").removeClass("fixed");
      }
    });

    /*if ($(".fliter-btns-group").length) {
      $(".fliter-btns-group .tab").first().trigger("click");
    }*/

    /*var setTab = function() {
      if ($(".fliter-btns-group").length) {
        var filterValue = $(".fliter-btns-group .tab:first-child").attr(
          "data-filter"
        );
        if (filterValue !== "*") {
          $(".grid").isotope({
            itemSelector: ".element-item",
            layoutMode: "fitRows",
            filter: filterValue,
          });
        }
      }
    };

    setTab();*/

    $(".member-fancybox").click(function() {
      var lightbox = $(this).attr("data-lightbox");
      //console.log("."+lightbox);
      $(lightbox).fancybox({
        smallBtn : true,
        toolbar  : false,
        btnTpl: {
          smallBtn:
            '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">' +
            '<i class="icon-cancel-circled-after fRight">Close</i>' +
            "</button>",
        },
      }).trigger("click");
    });

    $(".fancyboxVideo").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });

    if( $(".banner").offset().top > 110 ) {
      $(".banner").addClass("fixed");
    }
    else {
      $(".banner").removeClass("fixed");
    }

    $('a.anchor[href*="#"]:not([href="#"])').click(function() {
      if (
        location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
        location.hostname === this.hostname
      ) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate(
            {
              scrollTop: target.offset().top - 50
            },
            1000
          );
          return false;
        }
      }
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  }
};

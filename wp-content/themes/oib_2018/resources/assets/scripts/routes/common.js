export default {
  init() {
    // JavaScript to be fired on all pages
    $(".icon-cancel-circled").click(function() {
      $(".topbar").addClass("hiddenTop");
      $(".hiddenTop .container").hide();
    });

    var desktopSlider = $(".bxslider").bxSlider({
      adaptiveHeight: false,
      controls: true,
      auto: false,
      randomStart: false,
      hideControlOnEnd: true,
      infiniteLoop: false,
      pager: false,
      mode: 'fade',
      touchEnabled: true,
    });

    $(".tab:not(.mobile-tab)").click(function() {
      $(".tab:not(.mobile-tab)").removeClass("tab-active");
      $(this).addClass("tab-active");
      var filterValue = $(this).attr("data-filter");
      var $grid = '';
      if($("body").hasClass("newsroom")) {
        $grid = $(".grid").isotope({
          itemSelector: ".element-item",
          layoutMode: "fitRows",
          filter: filterValue,
        });
      } else {
        $grid = $(".grid").isotope({
          itemSelector: ".element-item",
          layoutMode: "fitRows",
          filter: filterValue,
          transitionDuration: 0
        });
        if ($(".bxslider").is(':visible')) {
          desktopSlider.redrawSlider();
          //var newHeightCur = $(".bx-wrapper").parent().outerHeight();
          //$(".grid.section-content").css("height",newHeightCur);
        }
        //var newHeightCur = $(".bx-wrapper").parent().outerHeight();
        //$(".grid.section-content").css("height",newHeightCur);
      }
      //console.log("filterValue: " + filterValue);
      var itemHeight = $(filterValue).outerHeight();
      //console.log("itemHeight: " + itemHeight);
      $(".grid.section-content").css("height",itemHeight);

      $grid.on( 'arrangeComplete', function( event, filteredItems ) {
        if ($(".bxslider").is(':visible')) {
          //$(".section-content").css("height",$(".bx-wrapper").parent().outerHeight());
          desktopSlider.redrawSlider();
          var newHeight = $(".bx-wrapper").parent().outerHeight();
          $(".grid.section-content").css("height",newHeight);
          //$(".grid.section-content").height(newHeight);
          //$(".section-content").css("height",$(".bx-wrapper").parent().outerHeight());
          //$(".section-tabs-system").css("height",$(".section-content").height());
        }
      });

      if ($(".fliter-btns-group-inner").length) {   /* for business page or any page has a double filters */
        var innerFilter = $(filterValue).find(".inner-tab:first");
        $(innerFilter).addClass("tab-active");
        $(innerFilter).trigger("click");
        $(".grid").isotope({
          itemSelector: ".element-item",
          layoutMode: "fitRows",
          filter: filterValue,
          transitionDuration: 0
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
        filter: filterValue,
        transitionDuration: 0
      });
      $(".grid").height($(this).parent().next().height());
    });

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

    $(window).scroll(function (event) {
      var scroll = $(window).scrollTop();
      if(scroll>118) {
        $(".banner").addClass("fixed");
      }
      else {
        $(".banner").removeClass("fixed");
      }
    });

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

    $(".mobile-tab").click(function() {
      if(!$(this).hasClass("mobile-tab-active")) {
        $(".mobile-tab-active").removeClass("mobile-tab-active");
        $(".mobile-content-active").removeClass("mobile-content-active");
        $(this).addClass("mobile-tab-active");
        $(this).next().addClass("mobile-content-active");
      } else {
        $(this).removeClass("mobile-tab-active");
        $(this).next().removeClass("mobile-content-active");
      }
      if($(".filter-div-select").length) {  // for double filters
        //$(".mobileV-container .element-item-inner").removeClass("mobile-content-active");
        var selectOption = $(this).next().find('.filter-div-select option:selected').val();
        if($(selectOption).hasClass("mobile-content-active")) {
          $(selectOption).removeClass("mobile-content-active");
        } else {
          $(".mobileV-container .element-item-inner").removeClass("mobile-content-active");
          $(selectOption).addClass("mobile-content-active");
        }
      }
    });

    if($(".filter-div-select").length) {
      $('.filter-div-select').select2(
        {
          minimumResultsForSearch: -1,
        }
      );

      $('.filter-div-select').on('change', function() {
        $(".mobileV-container .element-item, .mobileV-container .element-item-inner").removeClass("mobile-content-active");
        //console.log("sds");
        var selectOption = $(this).find(":selected").attr("value");
        $(selectOption).addClass("mobile-content-active");
        //if($(selectOption))
      });
    }

    $(".hide-desktop .nav li").click(function() {
      if($(this).hasClass("menu-item-has-children")) {
        if($(this).hasClass("open")) {
          $(this).removeClass("open");
        }
        else {
          $(".menu-item-has-children").removeClass("open");
          $(this).addClass("open");
        }
      }
    });

    if($(".mobile-primary").is(':visible')) {
      if(!$(".icon-menu").hasClass("close")) {
        $(".mobile-primary").click(function() {
          $(".icon-menu").addClass("close");
          $(".hide-desktop").addClass("open");
          $("body").addClass("open");
        });
      }
    }


      $('.main-container').on('click touchstart', function(e) {
         if( $("body").hasClass("open") ){
          if($(".icon-menu").hasClass("close")) {
            $(".icon-menu").removeClass("close");
            $(".hide-desktop").removeClass("open");
            $("body").removeClass("open");
          }
        }
      }).on('click', '.mobile-primary', function(e) {
        e.stopPropagation();
      });


//element-item-inner
    $(window).load(function() {
      if( $(".banner").offset().top > 110 ) {
        $(".banner").addClass("fixed");
      }
      else {
        $(".banner").removeClass("fixed");
      }

      if($(".filter-div-select").length) {
        var selectOption = $(".filter-div-select option:first").attr("value");
        $(selectOption).addClass("mobile-content-active");
      }
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
      if ($(".bxslider").length) {
        desktopSlider.reloadSlider();
      }
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  }
};

export default {
  init() {
    // JavaScript to be fired on all pages
    $(".icon-cancel-circled").click(function() {
      $(".topbar").addClass("hiddenTop");
    });

    $(".tab").click(function() {
      $(".tab").removeClass("tab-active");
      $(this).addClass("tab-active");
      var filterValue = $(this).attr("data-filter");
      $(".grid").isotope({
        itemSelector: ".element-item",
        layoutMode: "fitRows",
        filter: filterValue
      });
    });

    $(window).load(function() {
      if ($(".fliter-btns-group").length) {
        $(".tab-active").trigger("click");
      }
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
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  }
};

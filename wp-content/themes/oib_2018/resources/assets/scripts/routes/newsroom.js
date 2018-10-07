export default {
  init() {
    // JavaScript to be fired on the home page
    // init Isotope
    /*$(".tab").click(function() {
      $(".tab").removeClass("tab-active");
      $(this).addClass("tab-active");
      var filterValue = $(this).attr("data-filter");
      $(".grid").isotope({
        itemSelector: ".element-item",
        layoutMode: "fitRows",
        filter: filterValue,
      });
    });

    var initScroll = function() {
      if ($(".grid.infinitescroll").length) {
        $(".grid").infinitescroll({
          behavior  : 'twitter',
          bufferPx: 40,
          //debug  : false,
          loading: {
            msgText: "",
            //img : 'data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==',
            //img: loadImg,
            finishedMsg: "",
          },
          navSelector: "#wp_pagination",
          // selector for the paged navigation (it will be hidden)
          nextSelector: "#wp_pagination a.next:first",
          // selector for the NEXT link (to page 2)
          itemSelector: ".element-item",
          // selector for all items you'll retrieve
        });
      }
    };
    initScroll();*/
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};

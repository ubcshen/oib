export default {
  init() {
    // JavaScript to be fired on the home page
    var changeHeight = function() {
      var ratio = 1440/807;
      var ww = $(window).width();
      $(".home .section-banner").height(ww/ratio);
    }

    $(window).resize(function() {
      changeHeight();
    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};

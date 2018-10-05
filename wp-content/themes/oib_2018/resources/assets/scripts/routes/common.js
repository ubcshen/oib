export default {
  init() {
    // JavaScript to be fired on all pages
    $(".icon-cancel-circled").click(function() {
      $(".topbar").addClass("hiddenTop");
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

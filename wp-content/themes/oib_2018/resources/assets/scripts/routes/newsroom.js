export default {
  init() {
    // JavaScript to be fired on the home page
    var loadMore = function() {
      var itemHeight = $(".element-item")[0].scrollHeight;
      //console.log("sds: " + itemHeight*2);
      //console.log($(".infinitescroll")[0].scrollHeight);
      var oneItemHeight = itemHeight;
      var addItemHeight = itemHeight*2 + 121;
      itemHeight = itemHeight*2 + 142;
      $('.infinitescroll').height(itemHeight);
      $('#wp_pagination a').click(function (e) {
        e.preventDefault();
        //console.log($('.infinitescroll').height());
        //console.log($(".infinitescroll")[0].scrollHeight);
        if( $('.infinitescroll').height() < ($(".infinitescroll")[0].scrollHeight - (addItemHeight)) ) {
          //console.log($(".infinitescroll")[0].scrollHeight - (oneItemHeight));
          $('.infinitescroll').animate({
            height: '+='+addItemHeight+'px'
          }, 500);
        }
        else {
          $('.infinitescroll').height($(".infinitescroll")[0].scrollHeight - (addItemHeight));
          $('.infinitescroll').css({
            height: '+=' + ( oneItemHeight + 80 ) + 'px'
          });
          $("#wp_pagination a").hide();
        }
      });
    };
    $(window).load(function() {
      loadMore();
    });
    $( window ).resize(function() {
      loadMore();
    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};

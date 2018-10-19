export default {
  init() {
    // JavaScript to be fired on the home page
    var loadMore = function(wid) {
      var itemHeight = $(".element-item")[0].scrollHeight;
      //console.log("sds: " + itemHeight*2);
      //console.log($(".infinitescroll")[0].scrollHeight);
      var oneItemHeight = itemHeight;
      var addItemHeight = 0;
      if(wid>750) {
        addItemHeight = itemHeight*2 + 121;
        itemHeight = itemHeight*2 + 142;
      }
      else {
        addItemHeight = itemHeight*3 + 90;
        itemHeight = itemHeight*3 + 90+15*2;
      }
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
          if(wid<=750) {
            addItemHeight = addItemHeight/3;
          }
          $('.infinitescroll').height($(".infinitescroll")[0].scrollHeight - addItemHeight);
          $('.infinitescroll').css({
            height: '+=' + ( oneItemHeight + 80 ) + 'px'
          });
          $("#wp_pagination a").hide();
        }
      });
    };
    $(window).load(function() {
      loadMore($(window).width());
    });
    $( window ).resize(function() {
      loadMore($(window).width());
    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};

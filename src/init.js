
/* RVB main functions */
var rvb = {
  init: function() {
    console.log('rvb init');
    if(Modernizr.touch) {
      // Scroll away iOS browser chrome
      rvb.scrollToTop();
    }
  },
  scrollToTop: function() {
    setTimeout(function(){
      window.scrollTo(0, 1);
    }, 0);
  }
};

/* Listen to document load and run init */
jQuery(document).ready(function($) {
  console.log('document ready');
  rvb.init();
});
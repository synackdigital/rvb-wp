
/* Namespace functions */
var rvb = {
  init: function() {
    console.log('rvb init');
  }
};

/* Listen to document load and run init */
jQuery(document).ready(function($) {
  rvb.init();
});

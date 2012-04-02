
/* rvb functions */
var rvb = {
  init: function() {
    console.log('rvb:init');
    
    if(Modernizr.touch) {
      rvb.scrollToTop(); // Scroll away iOS browser chrome
    }
    
    if (rvb.campaign.domObj.length) {
      rvb.campaign.init();
    }
  },
  scrollToTop: function() {
    console.log('rvb:scrollToTop');
    setTimeout(function(){
      window.scrollTo(0, 1);
    }, 0);
  },
  
  // campaign module
  campaign: {
    init: function() {
      console.log('rvb:campaign:init');

      // start toggle timer if more than one item
      if ( rvb.campaign.domObj.children('.campaign').length > 1 ) {
        // generate pagination indicator
        rvb.campaign.domObj.append('<ul class="pagination"><li></li><li></li><li></li></ul>');
        
        // start animation
        rvb.campaign.start();
      }
    },
    start: function() {
      console.log('rvb:campaign:start');
      rvb.campaign.interval = setInterval(rvb.campaign.showNext, 8000);
      jQuery('li', rvb.campaign.domObj).first().addClass('active');
    },
    stop: function() {
      console.log('rvb:campaign:stop');
      clearInterval(rvb.campaign.interval);
    },
    reset: function() {
      console.log('rvb:campaign:reset');
    },
    resize: function() {
      rvb.campaign.domObj.css('height', rvb.campaign.domObj.children('.campaign').last().find('img').first().outerHeight() );
    },
    showNext: function() {
      console.log('rvb:campaign:showNext');
      
      var items = rvb.campaign.domObj.children('.campaign');
      var page_item = jQuery('li.active', rvb.campaign.domObj);

      page_item.removeClass('active');
      if ( page_item.is(':last-child') ) {
        jQuery('li:first-child', rvb.campaign.domObj).addClass('active');
      }
      else {
        page_item.next('li').addClass('active');
      }
      
      if (Modernizr.csstransitions && Modernizr.opacity) {
        // animate item switching
        items.last().fadeOut('slow', function() {
          items.first().before(items.last());
        });
        items.first().show();
      }
      else {
        // no animation; just item switching
        items.first().before(items.last());
      }
    },
    showPrev: function() {
      console.log('rvb:campaign:showPrev');
    }
  }
};

/* document load listener */
jQuery(document).ready(function($) {
  console.log('rvb:document:ready');
  
  // store references to dom objects
  rvb.campaign.domObj = $('#campaign');
  
  rvb.init();
});

/* window resize listener */
jQuery(window).resize(function() {
  rvb.campaign.resize();
});

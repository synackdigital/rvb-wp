
/* RVB main functions */
var rvb = {
  init: function() {
    console.log('rvb init');
    
    var mainNavigation = jQuery('#access');
        mainContent = jQuery('#primary');
        mainSidebars = jQuery('#main').find('.widget-area');
        metaSidebar = jQuery('#sidebar-header');
        metaSidebarToggleLink = mainNavigation.find('li.menu-item-type-search');
    
    if(Modernizr.touch) {
      // Scroll away iOS browser chrome
      rvb.scrollToTop();
    }
    
    if(metaSidebar && metaSidebarToggleLink) {
      // Bind click event to the search field toggle link in the main navigation
      metaSidebarToggleLink.on('click', 'a', function() {
        metaSidebar.toggleClass('js-visible');
        // Auto-focus on search field
        if (metaSidebar.hasClass('js-visible')) {
          metaSidebar.find('input.field.search').focus();
        }
      });
    }
  },
  scrollToTop: function() {
    setTimeout(function(){
      window.scrollTo(0, 1);
    }, 0);
  },
  toggleMetaSidebar: function() {
    $('#sidebar-header').toggle('slow', function() {
      console.log('meta sidebar was toggled');
    });
  }
};

/* Listen to document load and run init */
jQuery(document).ready(function($) {
  console.log('document ready');
  rvb.init();
});
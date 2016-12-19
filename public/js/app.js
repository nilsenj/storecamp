(function() {
  (function() {
    var anchor, current, definedLinks, i, nav;
    nav = $('.sidebar-menu');
    anchor = nav.find('a');
    current = window.location.pathname;
    i = 0;
    while (i < anchor.length) {
      definedLinks = anchor[i].pathname;
      if (definedLinks === current) {
        $(anchor[i]).parent().addClass('active');
      }
      i++;
    }
  })();

}).call(this);

//# sourceMappingURL=app.js.map

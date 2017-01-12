(function() {
  (function($) {
    var items;
    items = [$('.sidebar-menu'), $('.media_tags')];
    items.forEach(function(item, i, arr) {
      var anchor, current, definedLinks, nav, results;
      nav = item;
      anchor = nav.find('a');
      current = window.location.href;
      i = 0;
      results = [];
      while (i < anchor.length) {
        definedLinks = anchor[i].href;
        if (definedLinks === current) {
          $(anchor[i]).parent().addClass('active');
        }
        results.push(i++);
      }
      return results;
    });
  })($);

}).call(this);

//# sourceMappingURL=app.js.map

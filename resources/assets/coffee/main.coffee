do ($) ->
  items = [$('.sidebar-menu'), $('.media_tags')]
  items.forEach (item, i , arr) ->
    nav = item
    anchor = nav.find('a')
    current = window.location.href
    i = 0
    while i < anchor.length
      definedLinks = anchor[i].href
      if definedLinks == current
        $(anchor[i]).parent().addClass('active')
      i++
  return


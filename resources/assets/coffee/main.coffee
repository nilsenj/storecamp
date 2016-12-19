do ->
  nav = $('.sidebar-menu')
  anchor = nav.find('a')
  current = window.location.pathname
  i = 0
  while i < anchor.length
    definedLinks = anchor[i].pathname
    if definedLinks == current
      $(anchor[i]).parent().addClass('active')
    i++
  return

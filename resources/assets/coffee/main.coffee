###*
# StoreCamp Demo Menu
# ------------------
# You should not use this file in production.
# This file is for demo purposes only.
###

(($, StoreCamp) ->

  ###*
  # Toggles layout classes
  #
  # @param String cls the layout class to toggle
  # @returns void
  ###

  change_layout = (cls) ->
    $('body').toggleClass cls
    StoreCamp.layout.fixSidebar()
    #Fix the problem with right sidebar and layout boxed
    if cls == 'layout-boxed'
      StoreCamp.controlSidebar._fix $('.control-sidebar-bg')
    if $('body').hasClass('fixed') and cls == 'fixed'
      StoreCamp.pushMenu.expandOnHover()
      StoreCamp.layout.activate()
    StoreCamp.controlSidebar._fix $('.control-sidebar-bg')
    StoreCamp.controlSidebar._fix $('.control-sidebar')
    return

  ###*
  # Replaces the old skin with the new skin
  # @param String cls the new skin class
  # @returns Boolean false to prevent link's default action
  ###

  change_skin = (cls) ->
    $.each my_skins, (i) ->
      $('body').removeClass my_skins[i]
      return
    $('body').addClass cls
    store 'skin', cls
    false

  ###*
  # Store a new settings in the browser
  #
  # @param String name Name of the setting
  # @param String val Value of the setting
  # @returns void
  ###

  store = (name, val) ->
    if typeof Storage != 'undefined'
      localStorage.setItem name, val
    else
      window.alert 'Please use a modern browser to properly view this template!'
    return

  ###*
  # Get a prestored setting
  #
  # @param String name Name of of the setting
  # @returns String The value of the setting | null
  ###

  get = (name) ->
    if typeof Storage != 'undefined'
      return localStorage.getItem(name)
    else
      window.alert 'Please use a modern browser to properly view this template!'
    return

  ###*
  # Retrieve default settings and apply them to the template
  #
  # @returns void
  ###

  setup = ->
    tmp = get('skin')
    if tmp and $.inArray(tmp, my_skins)
      change_skin tmp
    #Add the change skin listener
    $('[data-skin]').on 'click', (e) ->
      if $(this).hasClass('knob')
        return
      e.preventDefault()
      change_skin $(this).data('skin')
      return
    #Add the layout manager
    $('[data-layout]').on 'click', ->
      change_layout $(this).data('layout')
      return
    $('[data-controlsidebar]').on 'click', ->
      change_layout $(this).data('controlsidebar')
      slide = !StoreCamp.options.controlSidebarOptions.slide
      StoreCamp.options.controlSidebarOptions.slide = slide
      if !slide
        $('.control-sidebar').removeClass 'control-sidebar-open'
      return
    $('[data-sidebarskin=\'toggle\']').on 'click', ->
      sidebar = $('.control-sidebar')
      if sidebar.hasClass('control-sidebar-dark')
        sidebar.removeClass 'control-sidebar-dark'
        sidebar.addClass 'control-sidebar-light'
      else
        sidebar.removeClass 'control-sidebar-light'
        sidebar.addClass 'control-sidebar-dark'
      return
    $('[data-enable=\'expandOnHover\']').on 'click', ->
      $(this).attr 'disabled', true
      StoreCamp.pushMenu.expandOnHover()
      if !$('body').hasClass('sidebar-collapse')
        $('[data-layout=\'sidebar-collapse\']').click()
      return
    # Reset options
    if $('body').hasClass('fixed')
      $('[data-layout=\'fixed\']').attr 'checked', 'checked'
    if $('body').hasClass('layout-boxed')
      $('[data-layout=\'layout-boxed\']').attr 'checked', 'checked'
    if $('body').hasClass('sidebar-collapse')
      $('[data-layout=\'sidebar-collapse\']').attr 'checked', 'checked'
    return

  'use strict'

  ###*
  # List of all the available skins
  #
  # @type Array
  ###

  my_skins = [
    'skin-blue'
    'skin-black'
    'skin-red'
    'skin-yellow'
    'skin-purple'
    'skin-green'
    'skin-blue-light'
    'skin-black-light'
    'skin-red-light'
    'skin-yellow-light'
    'skin-purple-light'
    'skin-green-light'
  ]
  #Create the new tab
  tab_pane = $('<div />',
    'id': 'control-sidebar-theme-demo-options-tab'
    'class': 'tab-pane active')
  #Create the tab button
  tab_button = $('<li />', 'class': 'active').html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'>' + '<i class=\'fa fa-wrench\'></i>' + '</a>')
  #Add the tab button to the right sidebar tabs
  $('[href=\'#control-sidebar-home-tab\']').parent().before tab_button
  #Create the menu
  demo_settings = $('<div />')
  #Layout options
  demo_settings.append '<h4 class=\'control-sidebar-heading\'>' + 'Layout Options' + '</h4>' + '<div class=\'form-group\'>' + '<label class=\'control-sidebar-subheading\'>' + '<input type=\'checkbox\' data-layout=\'fixed\' class=\'pull-right\'/> ' + 'Fixed layout' + '</label>' + '<p>Activate the fixed layout. You can\'t use fixed and boxed layouts together</p>' + '</div>' + '<div class=\'form-group\'>' + '<label class=\'control-sidebar-subheading\'>' + '<input type=\'checkbox\' data-layout=\'layout-boxed\'class=\'pull-right\'/> ' + 'Boxed Layout' + '</label>' + '<p>Activate the boxed layout</p>' + '</div>' + '<div class=\'form-group\'>' + '<label class=\'control-sidebar-subheading\'>' + '<input type=\'checkbox\' data-layout=\'sidebar-collapse\' class=\'pull-right\'/> ' + 'Toggle Sidebar' + '</label>' + '<p>Toggle the left sidebar\'s state (open or collapse)</p>' + '</div>' + '<div class=\'form-group\'>' + '<label class=\'control-sidebar-subheading\'>' + '<input type=\'checkbox\' data-enable=\'expandOnHover\' class=\'pull-right\'/> ' + 'Sidebar Expand on Hover' + '</label>' + '<p>Let the sidebar mini expand on hover</p>' + '</div>' + '<div class=\'form-group\'>' + '<label class=\'control-sidebar-subheading\'>' + '<input type=\'checkbox\' data-controlsidebar=\'control-sidebar-open\' class=\'pull-right\'/> ' + 'Toggle Right Sidebar Slide' + '</label>' + '<p>Toggle between slide over content and push content effects</p>' + '</div>' + '<div class=\'form-group\'>' + '<label class=\'control-sidebar-subheading\'>' + '<input type=\'checkbox\' data-sidebarskin=\'toggle\' class=\'pull-right\'/> ' + 'Toggle Right Sidebar Skin' + '</label>' + '<p>Toggle between dark and light skins for the right sidebar</p>' + '</div>'
  skins_list = $('<ul />', 'class': 'list-unstyled clearfix')
  #Dark sidebar skins
  skin_blue = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-blue\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px; background: #367fa9;\'></span><span class=\'bg-light-blue\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #222d32;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\'>Blue</p>')
  skins_list.append skin_blue
  skin_black = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-black\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div style=\'box-shadow: 0 0 2px rgba(0,0,0,0.1)\' class=\'clearfix\'><span style=\'display:block; width: 20%; float: left; height: 7px; background: #fefefe;\'></span><span style=\'display:block; width: 80%; float: left; height: 7px; background: #fefefe;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #222;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\'>Black</p>')
  skins_list.append skin_black
  skin_purple = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-purple\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-purple-active\'></span><span class=\'bg-purple\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #222d32;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\'>Purple</p>')
  skins_list.append skin_purple
  skin_green = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-green\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-green-active\'></span><span class=\'bg-green\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #222d32;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\'>Green</p>')
  skins_list.append skin_green
  skin_red = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-red\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-red-active\'></span><span class=\'bg-red\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #222d32;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\'>Red</p>')
  skins_list.append skin_red
  skin_yellow = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-yellow\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-yellow-active\'></span><span class=\'bg-yellow\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #222d32;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\'>Yellow</p>')
  skins_list.append skin_yellow
  #Light sidebar skins
  skin_blue_light = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-blue-light\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px; background: #367fa9;\'></span><span class=\'bg-light-blue\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #f9fafc;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\' style=\'font-size: 12px\'>Blue Light</p>')
  skins_list.append skin_blue_light
  skin_black_light = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-black-light\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div style=\'box-shadow: 0 0 2px rgba(0,0,0,0.1)\' class=\'clearfix\'><span style=\'display:block; width: 20%; float: left; height: 7px; background: #fefefe;\'></span><span style=\'display:block; width: 80%; float: left; height: 7px; background: #fefefe;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #f9fafc;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\' style=\'font-size: 12px\'>Black Light</p>')
  skins_list.append skin_black_light
  skin_purple_light = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-purple-light\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-purple-active\'></span><span class=\'bg-purple\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #f9fafc;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\' style=\'font-size: 12px\'>Purple Light</p>')
  skins_list.append skin_purple_light
  skin_green_light = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-green-light\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-green-active\'></span><span class=\'bg-green\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #f9fafc;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\' style=\'font-size: 12px\'>Green Light</p>')
  skins_list.append skin_green_light
  skin_red_light = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-red-light\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-red-active\'></span><span class=\'bg-red\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #f9fafc;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\' style=\'font-size: 12px\'>Red Light</p>')
  skins_list.append skin_red_light
  skin_yellow_light = $('<li />', style: 'float:left; width: 33.33333%; padding: 5px;').append('<a href=\'javascript:void(0);\' data-skin=\'skin-yellow-light\' style=\'display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)\' class=\'clearfix full-opacity-hover\'>' + '<div><span style=\'display:block; width: 20%; float: left; height: 7px;\' class=\'bg-yellow-active\'></span><span class=\'bg-yellow\' style=\'display:block; width: 80%; float: left; height: 7px;\'></span></div>' + '<div><span style=\'display:block; width: 20%; float: left; height: 20px; background: #f9fafc;\'></span><span style=\'display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;\'></span></div>' + '</a>' + '<p class=\'text-center no-margin\' style=\'font-size: 12px;\'>Yellow Light</p>')
  skins_list.append skin_yellow_light
  demo_settings.append '<h4 class=\'control-sidebar-heading\'>Skins</h4>'
  demo_settings.append skins_list
  tab_pane.append demo_settings
  $('#control-sidebar-home-tab').after tab_pane
  setup()
  return
) jQuery, $.StoreCamp

# ---
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


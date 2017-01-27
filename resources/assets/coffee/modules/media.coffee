$.StoreCamp.media =
  options: {
    players: plyr.setup()
    playerStatus: $('.play-status')
    mediaItems: $('.media-plyr-item')
  }
  activate: ->
    _this = this
    if(_this.options.mediaItems.length > 0)
      _this.mediaEvents()
      _this.reindex(_this.options.mediaItems, _this.options.players)
    return

  mediaEvents: ->
    _this = this
    _this.options.players.forEach (player, i, arr) ->
      player.on 'ready timeupdate pause ended play playing', (event) ->
        switch event.type
          when 'ended'
            if arr.length - 1 > i
              _this.options.players[i + 1].play()
              _this.options.playerStatus.toggle 200
              _this.options.playerStatus.html '<a href="#"><i class="fa fa-step-forward"></i></a>'
              setTimeout(() ->
                _this.options.playerStatus.html '<a onclick="$.StoreCamp.media.pausePlayers()" href="#"><i class="fa fa-pause"></i></a>'
              , 2000)
            else
              _this.options.players[0].play()
              _this.options.playerStatus.toggle 200
              _this.options.playerStatus.html '<a href="#"><i class="fa  fa-step-forward"></i></a>'
              setTimeout(() ->
                _this.options.playerStatus.html '<a onclick="$.StoreCamp.media.pausePlayers()" href="#"><i class="fa fa-pause"></i></a>'
              , 2000)
          when 'pause'
            console.log 'fuck off'
            _this.options.playerStatus.toggle 200
            _this.options.playerStatus.html '<a onclick="$.StoreCamp.media.pausePlayers()" href="#"><i class="fa fa-pause"></i></a>'
          when 'play'
            $('.media-plyr-item').removeClass('playing')
            playInstanse = $(event.target)
            playInstanse.closest('.media-plyr-item').addClass('playing')
        return
      return
    $("#folder-body a.delete-file").on "click", (event) ->
      event.preventDefault()
      btn = $(this)
      deleteUrl = btn.attr('href')
      fileItem = btn.closest('.file-item')
      folderBody = $('#folder-body')
      _this.deleteFile(deleteUrl, fileItem)
      console.log(btn.attr('href'))

  reindex: (mediaItems, players) ->
    _this = this
    [].forEach.call mediaItems, (item, i, arr) ->
      $(item).attr 'data-media-number', i
      return
     _this._triggerNewFile(mediaItems, players)
  deleteFile: (deleteUrl, fileItem) ->
    _this = this
    $.ajax
      url: deleteUrl
      type: 'GET'
      success: (data) ->
        fileItem.remove()
        $.StoreCamp.templates.alert('success', data.title , data.message)
        console.log(data);
        return
      error: (xhr, textStatus, errorThrown) ->
        $.StoreCamp.templates.alert('danger', xhr.statusText, xhr.responseText)
        console.error xhr
        return
      false
  pausePlayers: () ->
    _this = this
    players = _this.options.players
    players.forEach (player, i, arr) ->
      player.stop()
      players[i].pause()
      $('.media-plyr-item').removeClass('playing')
      return
  _triggerNewFile: (mediaItems, players) ->
    _this = this
    playButtons = [mediaItems.find('.plyr__controls button[data-plyr="play"]'), $('.plyr .plyr__play-large')]
    playButtons.forEach (item, i, arr) ->
      item.on 'click', (event) ->
        audioItemClass = $(event.target).closest('.media-plyr-item')
        audioItem = audioItemClass.data('media-number')
        $('.media-plyr-item').removeClass('playing')
        players.forEach (player, i, arr) ->
          player.pause()
          players[audioItem].play()
          audioItemClass.addClass('playing')
          return
        return
    return
  # ---

$.StoreCamp.media.activate()
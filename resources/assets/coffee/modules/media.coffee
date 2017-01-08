$.StoreCamp.media =
  options: {
    players: plyr.setup()
    playerStatus: $('.play-status')
    mediaItems: $('.media-plyr-item')
  }
  activate: ->
    _this = this
    _this.mediaEvents()
    _this.reindex(_this.options.mediaItems, _this.options.players)
    return

  mediaEvents: ->
    _this = this
    _this.options.players.forEach (player, i, arr) ->
      player.on 'ready timeupdate pause ended playing', (event) ->
        switch event.type
          when 'ended'
            if arr.length - 1 > i
              _this.options.players[i + 1].play()
              _this.options.playerStatus.toggle 2000
              _this.options.playerStatus.html '<i class="fa  fa-step-forward"></i>'
            else
              _this.options.players[0].play()
              _this.options.playerStatus.toggle 2000
              _this.options.playerStatus.html '<i class="fa  fa-step-forward"></i>'
          when 'pause'
            console.log 'fuck off'
            _this.options.playerStatus.toggle 2000
            _this.options.playerStatus.html '<i class="fa fa-pause"></i>'
        return
      return
  reindex: (mediaItems, players) ->
    _this = this
    [].forEach.call mediaItems, (item, i, arr) ->
      $(item).attr 'data-media-number', i
      return
     _this._triggerNewFile(mediaItems, players)
  _triggerNewFile: (mediaItems, players) ->
    _this = this
    mediaItems.find('.plyr__controls button[data-plyr="play"]').on 'click', (event) ->
      audioItem = $(event.target).closest('.media-plyr-item').data('media-number')
      players.forEach (player, i, arr) ->
        player.stop()
        players[audioItem].play()
        return
      return

  # ---

$.StoreCamp.media.activate()
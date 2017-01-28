$.StoreCamp.fileLinker =
  options: {
    typesAvailable: ['']
    fileLinker: $('.file-linker')
    requestUrl: $('.file-linker').attr('data-requestUrl') ? APP_URL + "/admin/media/file_linker/local"
    fileTypes: $('.file-linker').attr('data-file-types') ? "image, document, audio, video, archive"
    fileMultiple: $('.file-linker').attr('data-multiple') ? false
    fileAttachOutputPath: $('.file-linker').attr('data-attach-output-path') ? "form .tab-content"
    fileLinkerModal: $('#fileLinker-modal')
    submitBtn: $('#fileLinker-modal').find('button[type=submit]')
    modalTitle:$('#fileLinker-modal').find('.modal-title')
    modalBody: $('#fileLinker-modal').find('.modal-body')
  }
  activate: ->
    _this = this
    _this.fileSystemEvents()
  fileSystemEvents: ->
    _this = this
    _this.options.fileLinkerModal.on 'shown.bs.modal', (event) ->
      fileLinker = $(event.relatedTarget)
      $(this).modal('show')
      _this.showFiles()
      return

    $(".file-item .select-file").on "click", (event) ->
      event.preventDefault()
      btn = $(this)
      selectUrl = btn.attr('data-href')
      fileItem = btn.closest('.file-item')
      folderBody = $('#folder-body')
      _this.selectFile(selectUrl, fileItem)
      console.log(btn.attr('href'))
      return
    $(".directory-item .select-folder").on "click", (event) ->
      event.preventDefault()
      btn = $(this)
      folderUrl = btn.attr('data-href')
      folderId = btn.attr('data-file-id')
      folderDisk = btn.attr('data-disk')
      fileItem = btn.closest('.directory-item')
      folderBody = $('#folder-body')
      _this.selectFolder(folderUrl, fileItem)
      return
    return

  showFiles: () ->
    _this = this
    dataObject = {
      multiple: _this.options.fileMultiple
      dataTypes: _this.options.fileTypes
    }
    $.ajax
      url: _this.options.requestUrl
      type: 'POST'
      data: dataObject
      success: (data) ->
        _this.options.modalBody.html(data)
        return
      error: (xhr, textStatus, errorThrown) ->
        $.StoreCamp.templates.alert('danger', xhr.statusText, 'Sorry error appeared')
        console.error xhr
        return
      false
  reindex: (mediaItems, players) ->
    _this = this
    [].forEach.call mediaItems, (item, i, arr) ->
      $(item).attr 'data-media-number', i
      return
      _this._triggerNewFile(mediaItems, players)
  selectFile: (fileURL, fileItem) ->
    _this = this
  #TODO Perform list of selected arrays
  #TODO and store them in input
  selectFolder: (folderUrl) ->
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

$.StoreCamp.fileLinker.activate()
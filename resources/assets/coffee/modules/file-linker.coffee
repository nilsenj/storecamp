$.StoreCamp.fileLinker =
  options: {
    typesAvailable: ['']
    fileLinker: $('.file-linker')
    fileLinkerSelectedBlock: $('.selected-block')
    requestUrl: $('.file-linker').attr('data-requestUrl') ? APP_URL + "/admin/media/file_linker/local"
    fileTypes: $('.file-linker').attr('data-file-types') ? "image, document, audio, video, archive"
    fileMultiple: $('.file-linker').attr('data-multiple') ? false
    disk: $('.file-linker').attr('data-disk') ? 'local'
    fileAttachOutputPath: $('.file-linker').attr('data-attach-output-path') ? "form .tab-content"
    fileLinkerModal: $('#fileLinker-modal')
    submitBtn: $('#fileLinker-modal').find('button[type=submit]')
    modalTitle:$('#fileLinker-modal').find('.modal-title')
    modalBody: $('#fileLinker-modal').find('.modal-body')
    fileBlockTemplate: (selectorId, content, fileName) ->
      "<div data-id='#{selectorId}' class='col-xs-6 col-md-3 col-lg-2'>#{content}<strong class='text-muted'>#{fileName}</strong></div>"
  }
  activate: () ->
    _this = this
    _this.fileSystemEvents()
  fileSystemEvents: ->
    _this = this
    _this.options.fileLinkerModal.on 'shown.bs.modal', (event) ->
      fileLinker = $(event.relatedTarget)
      $(this).modal('show')
      _this.showFiles()
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
        _this.fileEvents()
        return
      error: (xhr, textStatus, errorThrown) ->
        $.StoreCamp.templates.alert('danger', xhr.statusText, 'Sorry error appeared')
        console.error xhr
        return
      false
  fileEvents: () ->
    _this = this
    $(".files .file-item").on "click", (event) ->
      event.preventDefault()
      btn = $(this)
      selectId = btn.attr('data-file-id')
      fileItemCheckBox = btn.find('input:checkbox')
      selectUrl = btn.attr('data-href')
      selectFileName = btn.attr('data-file-name')
      folderBody = $('#folder-body')
      _this.selectFile(btn, selectId, fileItemCheckBox, selectFileName, selectUrl)
      console.log(btn.attr('data-href'))
  folderEvents: () ->
    _this = this
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
  selectFile: (btn, selectId, fileItemCheckBox, selectFileName, selectUrl) ->
    _this = this
    console.log("select file not triggered")
    $('.file-item').find('input:checkbox').iCheck('disable')
    if (!_this.options.fileMultiple)
      $('.file-item').find('input:checkbox').iCheck('uncheck')
      fileItemCheckBox.iCheck('enable')
      fileItemCheckBox.iCheck('check')
      $('.file-item').removeClass 'checked'
      fileItemCheckBox.iCheck('disable')
      btn.addClass 'checked'
      _this.manageToFileBlock(btn, selectFileName, selectId, selectUrl, 'add')
    else
      if btn.hasClass 'checked'
        btn.removeClass 'checked'
        fileItemCheckBox.iCheck('uncheck')
        fileItemCheckBox.iCheck('disable')
        _this.manageToFileBlock(btn, selectFileName, selectId, selectUrl, 'remove')
      else
        btn.addClass 'checked'
        fileItemCheckBox.iCheck('enable')
        fileItemCheckBox.iCheck('check')
        _this.manageToFileBlock(btn, selectFileName, selectId, selectUrl, 'add')
        fileItemCheckBox.iCheck('disable')
    return
  manageToFileBlock: (btn, selectFileName, selectId, selectUrl, methodType) ->
    _this = this
    switch methodType
      when "add" then _this.fileBlockAddTemplate(btn)
      when "remove" then _this.fileBlockRemoveTemplate(btn)
      else return
  fileBlockAddTemplate: (btn) ->
    _this = this
    selectorId = btn.attr('data-file-id')
    content = btn.find(".mailbox-attachment-icon").html()
    fileName = btn.find(".mailbox-attachment-name").html()
    htmlContent = _this.options.fileBlockTemplate(selectorId, content, fileName)
    _this.options.fileLinkerSelectedBlock.append(htmlContent)
  fileBlockRemoveTemplate: (btn) ->
    blockItem = $(".selected-block [data-id='#{btn.attr('data-file-id')}']");
    console.log(blockItem)
    blockItem.remove()

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
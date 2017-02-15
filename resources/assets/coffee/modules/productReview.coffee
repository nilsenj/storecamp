$.StoreCamp.productReview =
  options: {
    editMessageClass:  "editMessage"
    commentsBlock: "box-comments"
    confirmBtn: "confirm-edit"
  }
  activate: () ->
    this.editMessage()
  editMessage: () ->
    _this = this
    $("."+ this.options.editMessageClass).on "click", (e) ->
      messsageBlockAttr = $(e.target).attr("data-message-block")
      messageBlock = $(".#{_this.options.commentsBlock} ##{messsageBlockAttr}")
      message = messageBlock.text()
      href = $(e.target).attr("data-href")
      textArea = "<textarea id='body-#{messsageBlockAttr}' name='message' class='form-control' rows='6' style='height: auto;margin-bottom: 10px'>#{message}</textarea><button class='btn btn-primary pull-right #{_this.options.confirmBtn}'>Edit Message</button>"
      $.StoreCamp.templates.modal("review-"+messsageBlockAttr, textArea, "Edit Message")
      $(".#{_this.options.confirmBtn}").on "click", (e) ->
        e.preventDefault()
        console.log(e)
        dataObject = {
          body: $("#body-#{messsageBlockAttr}").val()
        }
        $.ajax
          url: href
          type: 'POST'
          data: dataObject
          _method: "post"
          success: (data) ->
            $.StoreCamp.templates.alert('success', "Message Saved", 'Everything Ok')
            genericModal = $("#review-"+messsageBlockAttr)
            genericModal.modal 'hide'
            messageBlock.html(data.body)
            return
          error: (xhr, textStatus, errorThrown) ->
            $.StoreCamp.templates.alert('danger', xhr.statusText, 'Sorry error appeared')
            console.error xhr
            return
          false

$.StoreCamp.productReview.activate()

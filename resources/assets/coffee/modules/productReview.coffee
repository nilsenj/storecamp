$.StoreCamp.productReview =
  options: {

  }
  activate: () ->
    this.editMessage()
  editMessage: () ->
    _this = this
    $(".editMessage").on "click", (e) ->
      messsageBlockAttr = $(e.target).attr("data-message-block")
      messageBlock = $(".box-comments ##{messsageBlockAttr}")
      message = messageBlock.text()
      href = $(e.target).attr("data-href")
      textArea = "<textarea id='body-#{messsageBlockAttr}' name='message' class='form-control' rows='6' style='height: auto;'>#{message}</textarea><button class='btn btn-primary pull-right confirm-edit'>Edit Message</button>"
      $.StoreCamp.templates.modal("review-"+messsageBlockAttr, textArea, "Edit Message")
      $(".confirm-edit").on "click", (e) ->
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

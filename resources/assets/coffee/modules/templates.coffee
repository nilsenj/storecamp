$.StoreCamp.templates =
  options: {
    alertTemplate: (type, title, message) ->
      """<div class="alert alert-#{type} alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4>#{title}</h4>
          #{message}
          </div>"""
  }
  activate: ->
    _this = this
  alert: (type, title, message) ->
    _this = this
    $('#alerts').append(_this.options.alertTemplate(type, title, message))


$.StoreCamp.templates.activate()
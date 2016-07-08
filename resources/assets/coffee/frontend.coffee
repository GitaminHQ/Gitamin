window.FrontendView = Backbone.View.extend
  el: "body"
  clearHightTimer: null

  initialize: (opts) ->
    @parentView = opts.parentView

    @initComponents()

  initComponents : ->
    self = this
    
    self.initScrollToTop()
    self.initToolTips()
    self.initTimeAgo()

  initScrollToTop : ->
    $.scrollUp.init()

  initToolTips: ->
    $('[data-toggle="tooltip"]').tooltip()
    return

  initTimeAgo: ->
    moment.locale 'zh-cn'
    $('.timeago').each ->
      time_str = $(this).text()
      if moment(time_str, 'YYYY-MM-DD HH:mm:ss', true).isValid()
        $(this).text moment(time_str).fromNow()
      return
    return

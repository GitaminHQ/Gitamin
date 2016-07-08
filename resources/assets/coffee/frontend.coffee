window.FrontendView = Backbone.View.extend
  el: "body"
  clearHightTimer: null

  initialize: (opts) ->
    @parentView = opts.parentView

    @initComponents()

  initComponents : ->
    self = this
    
    self.initScrollToTop()

  initScrollToTop : ->
    $.scrollUp.init()

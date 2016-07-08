GitaminView = Backbone.View.extend
  el: "body"
  windowInActive: true

  initialize: ->
    @initComponents()

  initComponents: () ->
    #$("abbr.timeago").timeago()
    $(".alert").alert()
    $('.dropdown-toggle').dropdown()
    $('.bootstrap-select').remove()

window.Gitamin =
  Config:
    locale: 'zh-CN'
    current_user_id: null
    token: ''
    emoj_cdn : ''
    notification_url: ''
    uploader_url: ''
    asset_url : ''
    root_url : ''

  isLogined : ->
    Gitamin.Config.current_user_id != null

  needLogined : ->
    if !Gitamin.isLogined()
      location.href = "/auth/login"
      return false

  loading : () ->
    console.log "loading..."

  fixUrlDash : (url) ->
    url.replace(/\/\//g,"/").replace(/:\//,"://")

  # 警告信息显示, to 显示在那个dom前(可以用 css selector)
  alert : (msg,to) ->
    $(".alert").remove()
    $(to).before("<div class='alert alert-warning'><a class='close' href='#' data-dismiss='alert'>X</a>#{msg}</div>")

  # 成功信息显示, to 显示在那个dom前(可以用 css selector)
  notice : (msg,to) ->
    $(".alert").remove()
    $(to).before("<div class='alert alert-success'><a class='close' data-dismiss='alert' href='#'>X</a>#{msg}</div>")

  openUrl : (url) ->
    window.open(url)

  initTextareaAutoResize: ->
    $('textarea').autosize()
    return

  initAjax: ->
    # Ajax Setup
    $.ajaxPrefilter (options, originalOptions, jqXHR) ->
      token = null
      if !options.crossDomain
        token = $('meta[name="token"]').attr('content')
        if token
          jqXHR.setRequestHeader 'X-CSRF-Token', token
      jqXHR
  
    $.ajaxSetup beforeSend: (xhr) ->
      xhr.setRequestHeader 'Accept', 'application/json'
      # xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
      return
    # Prevent double form submission
    $('form').submit ->
      $form = $(this)
      $form.find(':submit').prop 'disabled', true
      return
    return

  initDeleteForm: ->
    $('[data-method]').append(->
      data_url = $(this).attr('data-url')
      '\n' + '<form action=\'' + data_url + '\' method=\'POST\' style=\'display:none\'>\n' + '   <input type=\'hidden\' name=\'_method\' value=\'' + $(this).attr('data-method') + '\'>\n' + '   <input type=\'hidden\' name=\'_token\' value=\'' + Gitamin.Config.token + '\'>\n' + '</form>\n'
    ).attr('style', 'cursor:pointer;').removeAttr('href').click ->
      button = $(this)
      if button.hasClass('confirm-action')
        swal {
          type: 'warning'
          title: 'Confirm your action'
          text: 'Are you sure you want to do this?'
          confirmButtonText: 'Yes'
          confirmButtonColor: '#FF6F6F'
          showCancelButton: true
        }, ->
          button.find('form').submit()
          return
      else
        button.find('form').submit()
      return
    return

$ ->
  window._gitaminView = new GitaminView()